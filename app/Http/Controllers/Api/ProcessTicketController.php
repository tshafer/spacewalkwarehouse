<?php

namespace Wash\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Wash\Ticket;

class ProcessTicketController extends Controller
{


    /**
     * @param $ticket_id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleGet($ticket_id)
    {
        return $this->handler($ticket_id);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function handlePost(Request $request)
    {
        return $this->handler($request->get('ticket_id'));
    }

    /**
     * Mark as Ticket as redeemed or not
     *
     * @param $ticketId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler($ticketId)
    {

        $ticket = Ticket::whereTicketId($ticketId)->first();

        if ($ticket) {

            if ( ! $ticket->redeemed_at) {
                $ticket->redeemed_at = Carbon::now()->toDateTimeString();
                $ticket->qr_status = true;
                $ticket->save();

                return view('api.processing.checkedin', compact($ticket));
            } else {
                return view('api.processing.alreadyredeemed', compact($ticket));
            }
        } else {
            return view('api.processing.error');
        }
    }
}
