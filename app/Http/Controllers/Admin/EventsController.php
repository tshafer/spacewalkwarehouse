<?php namespace Wash\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Wash\Event;
use Wash\Http\Controllers\Controller;
use Wash\Ticket;
use Wash\TicketType;


class EventsController extends Controller
{


    /**
     * @var array
     */
    protected $rules = [
      'name'        => 'required|max:255',
        //'address'     => 'required',
        //'city'        => 'required',
        //'state'       => 'required',
        //'zip_code'    => 'required',
        //'country'     => 'required',
        //'description' => 'required',
      'event_start' => 'required|date_format:m/d/Y g:i A|after:now',
      'event_end'   => 'required|date_format:m/d/Y g:i A|after:event_start',

    ];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $events = $event = new Event;

        if ($column = Input::get('sort_by')) {
            $events = $events->orderBy($column, Input::get('dir', 'asc'));
        }

        $events = $events->paginate();

        return view('admin.events.index', compact('events', 'event'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $ticketTypes = TicketType::all();

        return view('admin.events.create', compact('ticketTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function store(Request $request)
    {

        $this->validate($request, $this->rules);

        $event = Event::create($request->all());

        if ($request->file('image')) {
            $event->addMedia($request->file('image'))->toCollection('images');
        }
        if ($request->has('ticketType')) {
            foreach ($request->input('ticketType') as $tickettype) {
                $ticketType = TicketType::find($tickettype);
                $event->ticketTypes()->attach($ticketType);
            }
        }

        $event->save();

        return redirect()->route('admin.events.show', [$event->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Event $event
     *
     * @return Response
     */
    public function show(Event $event)
    {

        $mediaItems = $event->getMedia('images');

        return view('admin.events.show', compact('event', 'mediaItems'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Event $event
     *
     * @return Response
     */
    public function edit(Event $event)
    {
        $ticketTypes = TicketType::all();

        return view('admin.events.edit', compact('event', 'ticketTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request ,
     *
     * @param Event   $event
     *
     * @return Response
     */
    public function update(Request $request, Event $event)
    {

        $this->validate($request, $this->rules);

        if ($request->file('image')) {
            $event->addMedia($request->file('image'))->toCollection('images');
        }

        $event->ticketTypes()->detach();

        if ($request->has('ticketType')) {
            foreach ($request->input('ticketType') as $tickettype) {
                $ticketType = TicketType::find($tickettype);

                $event->ticketTypes()->attach($ticketType);
                $event->save();
            }
        }

        $event->fill($request->all());
        $event->save();

        return redirect()->route('admin.events.show', [$event->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Event $event
     *
     * @return Response
     */

    public function destroy(Event $event)
    {
        $event->ticketTypes()->detach();

        $event->delete();

        flash('Event Deleted Successfully');

        return redirect()->route('admin.events.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  Event $event
     *
     * @return Response
     */
    public function checkin(Event $event)
    {

        $mediaItems = $event->getMedia('images');

        return view('admin.events.checkin', compact('event', 'mediaItems'));
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function process(Request $request)
    {
        $ticket = Ticket::find($request->input('id'));
        $ticket->redeemed_at = Carbon::now()->toDateTimeString();
        $ticket->qr_status = false;
        $ticket->save();

        return $ticket;
    }
}
