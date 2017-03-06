<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Event;
use Validator, Input, Redirect, Session; 
class EventController extends Controller
{
    function index() {
	    $events = Event::orderBy('id', 'asc')->get();
	    return view('events.index' ,[
	    'events' => $events
	    ]);
	}

	public function create() {
		return view('events.create');
	}

	public function store()
	{
        $rules = array(
			'title'       => 'required',
			'event_type'       => 'required'
		);

        $validator = \Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
			return Redirect::to('events/create')
				->withErrors($validator);				
		} else {
			// store
			$event = new Event;
			$event->title       = Input::get('title');
			$event->event_type       = Input::get('event_type');
			$event->save();

            // redirect
            //Session::flash('message', 'Successfully created event!');
            return Redirect::to('events');
        }
	}
}
