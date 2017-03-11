<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Record;
use Validator, Input, Redirect, Session; 
class RecordController extends Controller
{
    function index() {
	    $records = Record::orderBy('id', 'asc')->get();
	    return view('records.index' ,[
	    'records' => $records
	    ]);
	}

	public function create() {
		return view('records.create');
	}

	public function store()
	{
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

	public function update($id)
	{
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
            $record->save();

            // Session::flash('message','Successfully updates Record!');
            return Redirect::to('records');
        }
	}
}
