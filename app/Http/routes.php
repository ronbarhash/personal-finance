<?php

use App\Record;
use Illuminate\Http\Request;




// Route::get('/', function () {

//     $records = Record::orderBy('id', 'asc')->get();
//     return view('records.index' ,[
//     'records' => $records
//     ]);

// });

Route::group(['middleware' => ['web']], function () {
	Route::get('/', function() {
	    return Redirect::to('records');
	});
	
    Route::resource('records', 'RecordController');
    Route::get('record/{id}', 'RecordController@destroy');
});



