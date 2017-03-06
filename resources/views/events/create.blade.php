@extends('layouts.app')

@section('content')
{{ Form::open(array('url' => 'events')) }}

    
    <div class="form-group">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', Input::old('title'), array('class' => 'form-control')) }}       
    </div>
    <div class="form-group">
        {{ Form::label('event_type', 'Event type') }}
        {{ Form::text('event_type', Input::old('event_type'), array('class' => 'form-control')) }}       
    </div>

    <div class="form-group">
        {{ Form::submit('Add event', array('class' => 'btn btn-primary')) }}
    </div>

{{ Form::close() }}

@stop