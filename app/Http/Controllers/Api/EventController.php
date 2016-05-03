<?php

namespace Wash\Http\Controllers\Api;

use Dingo\Api\Routing\Helpers;
use Illuminate\Support\Facades\Input;
use Wash\Http\Controllers\Controller;
use Wash\Event;
use Wash\Http\Requests;

class EventController extends Controller
{

    use Helpers;

    /**
     * Display the specified resource.
     *
     * @param  $id
     *
     * @return Response
     */
    public function show($id)
    {

        $event = Event::with('tickets')->findOrFail($id);
        return response()->json([
          'html' => (string) view('api.event', compact('event')),
        ])->setCallback(Input::get('callback'));
    }

}
