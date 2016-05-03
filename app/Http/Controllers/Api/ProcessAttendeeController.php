<?php

namespace Wash\Http\Controllers\Api;

use Cartalyst\Stripe\Stripe;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Wash\Attendee;
use Barryvdh\Snappy\Facades\SnappyPdf as Pdf;
use Wash\Coupon;
use Wash\Event;
use Wash\Ticket;
use Wash\TicketType;

class ProcessAttendeeController extends Controller
{

    /**
     * @var Stripe
     */
    protected $stripe;

    /**
     * @var int
     */
    protected $numberOfTicketsArray = [];

    /**
     * @var int
     */
    protected $totalAmount = 0;


    /**
     *
     */
    public function __construct()
    {
        $this->stripe = Stripe::make(env('STRIPE_SECRET'), env('STRIPE_API_V'));
    }


    /**
     * Check for a valid coupon code.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkCouponCode(Request $request)
    {
        if ($request->has('coupon_code')) {

            $event = Event::whereId($request->get('event'))->first();

            $coupons = $event->coupons->lists('code')->all();

            $coupons = array_map(function ($item) {
                return trim(strtolower($item));
            }, $coupons);

            $couponCode = trim(strtolower($request->get('coupon_code')));


            if (in_array($couponCode, $coupons)) {
                $coupon = Coupon::whereCode($couponCode)->first();

                return response()->json([
                    'error'    => false,
                    'message'  => 'Coupon Valid.',
                    'response' => $coupon,
                ]);
            } else {
                return response()->json([
                    'error'    => true,
                    'message'  => 'Coupon Invalid.',
                    'response' => $request->get('coupon_code'),
                ]);
            }
        }
    }


    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function create(Request $request)
    {

        // Create the attendee
        $attendee = Attendee::create([
            'first_name' => $request->input('first_name'),
            'last_name'  => $request->input('last_name'),
            'address'    => $request->input('address'),
            'city'       => $request->input('city'),
            'state'      => $request->input('state'),
            'zipcode'    => $request->input('zipcode'),
            'email'      => $request->input('email_address'),
        ]);

        if ($request->has('custom')) {
            $attendee->extra_fields_answers = json_encode($request->input('custom'));
            $attendee->save();
        }

        // Find the event
        $event = Event::find($request->input('event_id'));

        if ( ! $request->has('num_tickets')) {

            return response()->json([
                'error'    => true,
                'message'  => 'Please choose how many tickets you would like to purchase.',
                'response' => null,
            ]);
        }

        // Generate the amount to be processed
        $amount = $this->processAmount($request, $attendee, $event);

        // Create the customer in stripe
        $attendee->createStripeCustomer([
            'email' => $attendee->email,
        ]);

        if ($amount > 0.00) {
            try {
                $charge = $attendee->charge()->setToken($request->input('stripeToken'))->create($amount, [
                    'description' => $event->name,
                ]);

                if ($charge->isPaid()) {

                    if ($request->has('num_tickets')) {
                        foreach ($request->get('num_tickets') as $id => $value) {
                            $this->numberOfTicketsArray = array_merge($this->numberOfTicketsArray, $this->numberOfTickets($value, $id));
                        }
                    }

                    $attendee->event()->associate($event);
                    $attendee->num_tickets = count($this->numberOfTicketsArray);
                    $attendee->save();

                    foreach ($this->numberOfTicketsArray as $ticket => $ticketType) {

                        $ticketType = TicketType::find($ticketType);

                        $ticketRedeemed = new Ticket([
                            'ticket_id' => $attendee->id . $attendee->event->id . ($ticket + 1),
                        ]);

                        $ticketRedeemed->ticketType()->associate($ticketType);
                        $ticketRedeemed->event()->associate($event);
                        $ticketRedeemed->attendee()->associate($attendee);
                        $ticketRedeemed->save();
                    }

                    // Generate Ticket
                    $ticket = $this->generateTickets($event, $attendee);

                    // Email Ticket
                    $this->sendMail($attendee, $ticket);

                    return response()->json([
                        'error'    => false,
                        'message'  => $event->response,
                        'response' => 'Card processed successfully.',
                    ]);
                } else {

                    $attendee->delete();

                    return response()->json([
                        'error'    => true,
                        'message'  => 'Error Processing Card. Please try again.',
                        'response' => null,
                    ]);
                }
            } catch (\Exception $e) {

                $attendee->deleteStripeCustomer();
                $attendee->delete();

                return response()->json([
                    'error'    => true,
                    'message'  => $e->getMessage(),
                    'response' => null,
                ]);
            }
        } else {
            //$attendee->delete();

            return response()->json([
                'error'    => true,
                'message'  => 'Tickets could not be processed.',
                'response' => null,
            ]);
        }
    }


    /**
     * @param $request
     * @param $attendee
     * @param $event
     *
     * @return int
     */
    protected function processAmount($request, $attendee, $event)
    {
        if ($request->has('num_tickets')) {
            foreach ($request->get('num_tickets') as $id => $value) {
                $ticketType = TicketType::find($id);
                if ($ticketType) {
                    $this->totalAmount += ($ticketType->ticket_price * $value);
                }
            }
        }
        if ($request->has('coupon_code')) {
            $this->processCoupon($request, $attendee, $event);
        }

        return $this->totalAmount;
    }


    /**
     * @param $request
     * @param $attendee
     * @param $event
     *
     * @return float|int
     */
    protected function processCoupon($request, $attendee, $event)
    {

        try {

            $coupons = $event->coupons->lists('code')->all();

            $coupons = array_map(function ($item) {
                return trim(strtolower($item));
            }, $coupons);

            $couponCode = trim(strtolower($request->get('coupon_code')));

            if (in_array($couponCode, $coupons)) {
                $validCoupon = true;
            } else {
                $validCoupon = false;
            }
        } catch (\Exception $e) {
            $validCoupon = false;
        }

        if ($validCoupon) {

            $attendee->coupon_code = $request->get('coupon_code');

            $attendee->save();

            $coupon = Coupon::where('code', '=', $request->get('coupon_code'))->first();

            if ($coupon->amount_off && $coupon->amount_off != '0.00') {
                $this->totalAmount -= $coupon->amount_off;
            } elseif ($coupon->percent_off && $coupon->percent_off != 0) {
                $this->totalAmount = round($this->totalAmount * ((100 - $coupon->percent_off) / 100), 2);
            }
        }

        return $this->totalAmount;
    }


    /**
     * @param            $numTickets
     * @param bool|false $ticketId
     *
     * @return array
     */
    protected function numberOfTickets($numTickets, $ticketId)
    {
        return array_fill(0, $numTickets, $ticketId);
    }


    /**
     * @param $event
     * @param $attendee
     *
     * @return string
     */
    protected function generateTickets($event, $attendee)
    {
        if ($event->getMedia('images')->count()) {
            $img = public_path() . '/' . $event->getMedia('images')->last()->getUrl();
        } else {
            $img = null;
        }
        if ($event->id == 1) {
            $pdf = Pdf::loadView('api.ticket_legacy', compact('attendee', 'img'));
        } else {
            $pdf = Pdf::loadView('api.ticket', compact('attendee'));
        }
        $ticket_name = $attendee->first_name . '_' . $attendee->last_name . '_' . time() . '.pdf';
        $ticket      = public_path() . '/uploads/events/' . $ticket_name;
        $pdf->save($ticket);

        /** @var Save Ticket ticket_path */
        $attendee->ticket_path = $ticket_name;
        $attendee->save();

        return $ticket;
    }


    /**
     * @param $attendee
     * @param $ticket
     */
    protected function sendMail($attendee, $ticket)
    {
        Mail::send('emails.tickets', ['data' => $attendee], function ($m) use ($attendee, $ticket) {
            $m->to($attendee->email, $attendee->name)->subject('Your Tickets!');
            $m->bcc('tshafer@washingtonian.com', $attendee->name)->subject('Your Tickets Admin!');

            $m->attach($ticket);
        });
    }
}
