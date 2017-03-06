@extends('layouts.app')

@section('content')
<p><a href="{{ URL::route('events.create') }}" class="btn btn-success">add new</a></p>
<!-- Текущие задачи -->
  @if (count($events) > 0)
    <div class="panel panel-default">
      <div class="panel-heading">
        Текущая задача
      </div>

      <div class="panel-body">
        <table class="table table-striped task-table">

          <!-- Заголовок таблицы -->
          <thead>
            <th>Event</th>
            <th>&nbsp;</th>
          </thead>

          <!-- Тело таблицы -->
          <tbody>
            @foreach ($events as $event)
              <tr>
                <!-- Имя задачи -->
                <td class="table-text">
                  <div>{{ $event->title }}</div>
                </td>

                <td>
                    <form action="/event/{{ $event->id }}" method="POST">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}

                      <button>Удалить event</button>
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