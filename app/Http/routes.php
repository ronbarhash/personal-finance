<?php

use App\Event;
use Illuminate\Http\Request;

Route::get('/', function () {

    $events = Event::orderBy('id', 'asc')->get();
    return view('events' ,[
    'events' => $events
    ]);

});


Route::post('/events', function (Request $request) {

    $event = new Event;
    $event->title = $request->title;
    $event->save();

    return redirect('/');

});

 
Route::delete('/event/{id}', function ($id) {

    Event::findOrFail($id)->delete();
    return redirect('/');

});

