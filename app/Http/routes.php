<?php

use App\Record;
use Illuminate\Http\Request;

Route::group(['middleware' => ['web']], function () {
	Route::get('/', function() {
	    return Redirect::to('records');
	});
	
    Route::resource('records', 'RecordController');    

});



