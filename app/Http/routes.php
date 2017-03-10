<?php

use App\Record;
use Illuminate\Http\Request;

Route::group(['middleware' => ['web']], function () {
	Route::get('/', function() {
	    return Redirect::to('records');
	});
	
    Route::resource('records', 'RecordController');  
    Route::post('records/data', function(Request $request)  {
  //  		$from = $request->input('from'); 
		
		// $to = $request->input('to');

		// $records = DB::table('records')->where([
                   
  //                   ['date_of', '>', $from],
  //                    ['date_of', '<=', $to]
  //               ])->get();
         var_dump($request);      	


	   
	});  

});



