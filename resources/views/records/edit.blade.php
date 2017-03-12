@extends('layouts.app')

@section('content')
 @foreach ($errors->all() as $error)
      <div class="errors">
        {{ $error }}
      </div>
    @endforeach
{{ Form::model($record, array('action' => array('RecordController@update', $record->id), 'method' => 'PUT')) }}
        
   
    <div class="form-group">
        {{ Form::label('title', 'Название') }}
        {{ Form::text('title', Input::old('title'), array('class' => 'form-control', 'placeholder'=>'Название')) }} 

        {{ Form::label('date_of', 'Дата') }}
        {{ Form::text('date_of', \Carbon\Carbon::now(), array('class' => 'form-control')) }} 

        {{ Form::label('cost', 'Сумма') }}
        {{ Form::text('cost', Input::old('cost'), array('class' => 'form-control', 'placeholder'=>'0.00')) }}      
    </div>
    <div class="form-group">
        {{ Form::label('record_type', 'Тип') }}
        {{ Form::select('record_type', array('1' => 'Доход', '2' => 'Расход'), '2',array('class' => 'form-control')) }}       
    </div>

    <div class="form-group">
        {{ Form::submit('Сохранить', array('class' => 'btn btn-primary')) }}
    </div>

{{ Form::close() }}

@stop