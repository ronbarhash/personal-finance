@extends('layouts.app')

@section('content')
 @foreach ($errors->all() as $error)
      <div class="errors">
        {{ $error }}
      </div>
    @endforeach
{{ Form::open(array('url' => 'records')) }}
        
   
    <div class="form-group">
        {{ Form::label('title', 'Название') }}
        {{ Form::text('title', Input::old('title'), array('class' => 'form-control')) }} 
        {{ Form::label('date_of', 'Дата') }}
        <div class="input-group">

        {{ Form::text('date_of', \Carbon\Carbon::now(), array('class' => 'form-control','data-provide'=>"datepicker", 'id'=>'date_of')) }}
            <div class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </div>
        </div>
         

        {{ Form::label('cost', 'Сумма') }}
        {{ Form::text('cost', Input::old('cost'), array('class' => 'form-control')) }}      
    </div>
    <div class="form-group">
        {{ Form::label('record_type', 'Тип') }}
        {{ Form::select('record_type', array('1' => 'Доход', '2' => 'Расход'), '2',array('class' => 'form-control')) }}       
    </div>

    <div class="form-group">
        {{ Form::submit('Add event', array('class' => 'btn btn-primary')) }}
    </div>

{{ Form::close() }}

@stop