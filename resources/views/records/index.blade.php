@extends('layouts.app')

@section('content')
 @foreach ($errors->all() as $error)
      <div class="errors">
        {{ $error }}
      </div>
    @endforeach
<p><a href="{{ URL::route('records.create') }}" class="btn btn-success">add new</a></p>
<!-- Текущие задачи -->
  @if (count($records) > 0)
    <div class="panel panel-default">
      <div class="panel-heading">
        Текущая запись
      </div>

      <div class="panel-body">
        <table class="table task-table">

          <!-- Заголовок таблицы -->
          <thead>
            <th>record</th>
            <th>&nbsp;</th>
          </thead>

          <!-- Тело таблицы -->
          <tbody>
            @foreach ($records as $record)
              <tr  class=" @if($record->record_type == 1) table-success
               @else 
               table-danger
               @endif
               ">
                <!-- Имя задачи -->
                <td class="table-text">
                  <div>{{ $record->title }}</div>
                </td>
                <td class="table-text">
                  <div>{{ $record->cost }}</div>
                </td>
                <td class="table-text">
                  <div>{{ $record->record_type }}</div>
                </td>
                <td class="table-text">
                  <div>{{ $record->date_of }}</div>
                </td>

                <td>
                    {{ Form::open(array('url' => 'records/' . $record->id, 'class' => 'pull-right')) }}
                      {{ Form::hidden('_method', 'DELETE') }}
                      {{ Form::submit('Delete', array('class' => 'btn btn-small btn-danger')) }}
                    {{ Form::close() }}
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
   @endif

  <!-- TODO: Текущие задачи -->
@endsection