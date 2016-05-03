<?php namespace Wash\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Wash\Event;
use Wash\Http\Controllers\Controller;
use Wash\TicketType;


class TicketTypesController extends Controller
{

    /**
     * @var array
     */
    protected $rules = [
      'max_tickets'  => 'required',
      'ticket_name'  => 'required',
      'ticket_price' => 'required|regex:/^\d*(\.\d{2})?$/',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $ticketTypes = TicketType::all();

        return view('admin.tickettypes.index', compact('ticketTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $events = Event::all();

        return view('admin.tickettypes.create', compact('events'));
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

        $ticketType = TicketType::create($request->all());

        foreach ($request->input('event') as $eventId) {
            $event = Event::find($eventId);
            $ticketType->event()->attach($event);
        }

        $ticketType->save();

        return redirect()->route('admin.tickettypes.show', [$ticketType->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  TicketType $ticketType
     *
     * @return Response
     */
    public function show(TicketType $ticketType)
    {
        return view('admin.tickettypes.show', compact('ticketType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TicketType $ticketType
     *
     * @return Response
     */
    public function edit(TicketType $ticketType)
    {

        $events = Event::all();

        return view('admin.tickettypes.edit', compact('ticketType', 'events'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request    $request ,
     *
     * @param TicketType $ticketType
     *
     * @return Response
     */
    public function update(Request $request, TicketType $ticketType)
    {
        $this->validate($request, $this->rules);

        $ticketType->event()->detach();

        foreach ($request->input('event') as $eventId) {
            $event = Event::find($eventId);
            $ticketType->event()->attach($event);
        }

        $ticketType->fill($request->all());

        $ticketType->save();

        return redirect()->route('admin.tickettypes.show', [$ticketType->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TicketType $ticketType
     *
     * @return Response
     */

    public function destroy(TicketType $ticketType)
    {
        $ticketType->event()->detach();

        $ticketType->delete();

        flash('Ticket Type Deleted Successfully');

        return redirect()->route('admin.tickettypes.index');
    }

}
