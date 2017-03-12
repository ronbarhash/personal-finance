<?php

use App\Record;
use Illuminate\Http\Request;

Route::group(['middleware' => ['web']], function () {
	Route::get('/', function() {
	    return Redirect::to('records');
	});
	
    Route::resource('records', 'RecordController');  

    Route::post('/data', function(Request $request)  {
    	$request = $request->all();
    	if(is_array($request)) {
	   		$from = $request['from']; 		
			$to = $request['to'];
			
			$records = DB::table('records')->whereBetween(                   
	                  'date_of', [ $from,$to]
	                )->get();		
	        $records = json_encode($records);    
	        
        } else {$records = json_encode([]); }
        echo $records;
	});  

});



