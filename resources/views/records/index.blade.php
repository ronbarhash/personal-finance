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
        <table class="table table-striped task-table">

          <!-- Заголовок таблицы -->
          <thead>
            <th>record</th>
            <th>&nbsp;</th>
          </thead>

          <!-- Тело таблицы -->
          <tbody>
            @foreach ($records as $record)
              <tr>
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
                    <form action="/record/{{ $record->id }}" method="POST">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}

                      <button>Удалить запись</button>
                    </form>
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