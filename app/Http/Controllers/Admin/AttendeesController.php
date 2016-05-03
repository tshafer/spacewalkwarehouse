<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use App\Attendee;

class AttendeesController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendees = Attendee::sorted(Input::get('sort_by'),
          Input::get('dir', 'asc'))->paginate();

        return view('admin.attendees.index', compact('attendees'));
    }


    /**
     * Display the specified resource.
     *
     * @param Attendee $attendee
     *
     * @internal param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Attendee $attendee)
    {
        $attendee->with('ticket', 'event')->get();

        return view('admin.attendees.show', compact('attendee'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Attendee $attendee
     *
     * @internal param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendee $attendee)
    {
        return view('admin.attendees.edit', compact('attendee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.attendees.create');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Attendee                      $attendee
     * @param \Illuminate\Support\Facades\Request $request
     *
     * @return mixed
     */
    public function update(Attendee $attendee, Request $request)
    {
        $attendee->fill($request->all());

        $attendee->save();

        flash('Attendee updated!');

        return redirect()->route('admin.attendees.show', $attendee->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Attendee $attendee
     *
     * @internal param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendee $attendee)
    {

        $attendee->delete();

        flash('Attendee deleted!');

        return redirect()->route('admin.attendees.index');
    }
}
