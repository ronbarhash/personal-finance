<?php

use App\Event;
use Illuminate\Http\Request;


Route::get('/', function()
{
    return Redirect::to('events');
});

/*Route::get('/', function () {

    $events = Event::orderBy('id', 'asc')->get();
    return view('events' ,[
    'events' => $events
    ]);

});*/

Route::group(['middleware' => ['web']], function () {
    Route::resource('events', 'EventController');
});



