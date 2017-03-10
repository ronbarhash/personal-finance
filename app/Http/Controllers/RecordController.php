<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Record;
use Validator, Input, Redirect, Session; 
use DB;
use Carbon\Carbon;

class RecordController extends Controller
{
    public function index(Request $request) {
    	

    	$from = Carbon::now()->subMonth()->formatLocalized('%Y/%m/%d'); 
		
		$to = Carbon::now()->formatLocalized('%Y/%m/%d'); 
		

        $income = DB::table('records') 
                ->where('records.record_type','=',1)
                ->whereBetween('date_of', [$from, $to])
                ->sum('records.cost');
        $expense = DB::table('records') 
                ->where('records.record_type','=',2)
                ->whereBetween('date_of', [$from, $to])
                ->sum('records.cost');	        	
                	
	    $records = DB::table('records')->where([
                   
                    ['date_of', '>', $from],
                     ['date_of', '<=', $to]
                ])->get();
	    // var_dump($records->get());
	    return view('records.index' ,[
	    'records' => $records,
	    'income' => $income,
	    'expense' => $expense,
	    'from' => $from,
	    'to' => $to
	    ]);

	}
	public function show(Request $request) {
		var_dump($request);
/*
    	$from = $request->input('from'); 
		
		$to = $request->input('to');
		

        $income = DB::table('records') 
                ->where('records.record_type','=',1)
                ->whereBetween('date_of', [$from, $to])
                ->sum('records.cost');
        $expense = DB::table('records') 
                ->where('records.record_type','=',2)
                ->whereBetween('date_of', [$from, $to])
                ->sum('records.cost');	        	
                	
	    $records = DB::table('records')->where([
                   
                    ['date_of', '>', $from],
                     ['date_of', '<=', $to]
                ])->get();
	    // var_dump($records->get());
	    return view('records.index' ,[
	    'records' => $records,
	    'income' => $income,
	    'expense' => $expense,
	    'from' => $from,
	    'to' => $to
	    ]);
*/
	}

	public function create() {
		return view('records.create');
	}

	public function store()	{
        $rules = array(
			'title'       => 'required',
			'record_type'       => 'required'
		);

        $validator = \Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
			return Redirect::to('records/create')
				->withErrors($validator);				
		} else {
			// store
			$record = new Record;
			$record->title = Input::get('title');
			$record->record_type = Input::get('record_type');
			$record->date_of = Input::get('date_of');
			$record->cost = Input::get('cost');
			$record->rate = $this->_getRate();	
			$record->save();

            // redirect
            //Session::flash('message', 'Successfully created event!');
            return Redirect::to('records');
        }
	}
	public function destroy($id) {

		$record = Record::find($id);
        $record->delete();       
        return Redirect::route('records.index');

	}

	public function edit($id) {

		$record = Record::find($id);
        return view('records.edit')
            ->with('record',$record);

	}

	public function update($id)	{
        $rules = array(
			'title'       => 'required',
			'record_type'       => 'required'			
		);
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('records/' . $id . '/edit')
                ->withErrors($validator);
                // ->withInput(Input::except('img_src'));
        } else {
            $record = Record::find($id);
          
			$record->title = Input::get('title');
			$record->record_type = Input::get('record_type');
			$record->date_of = Input::get('date_of');
			$record->cost = Input::get('cost');
			$record->rate = $this->_getRate();	
            $record->save();

            // Session::flash('message','Successfully updates Record!');
            return Redirect::to('records');
        }
	}

	protected function _getRate() {
		return 1;
	}
}
