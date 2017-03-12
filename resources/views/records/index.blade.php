@extends('layouts.app')

@section('content')
 @foreach ($errors->all() as $error)
      <div class="errors">
        {{ $error }}
      </div>
    @endforeach
<p><a href="{{ URL::route('records.create') }}" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span></a></p>

  {{-- @if (count($records) > 0) --}}
    <div class="panel panel-default">
      <div class="panel-heading">
        
        <div class="container">
        <div class="col-sm-3 ">
                <div class="input-group date" data-provide="datepicker">
                    <input type="text" class="form-control" id="from" value="{{$from}}">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </div>
                </div>  
            </div>
            <div class="col-sm-3 ">
                <div class="input-group date" data-provide="datepicker">
                    <input type="text" class="form-control" id="to" value="{{$to}}">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </div>
                </div>  
            </div>

            <div class="col-sm-3 ">
             <button  class="btn btn-primary" id="search">Поиск</button>
            </div>            
          
        </div>
        
      </div>

      <div class="panel-body">
        <table class="table task-table">

          <!-- Заголовок таблицы -->
          <thead>
            <th>Записи</th>
            <th>&nbsp;</th>
          </thead>

          <!-- Тело таблицы -->

        </table>
        <div class="panel panel-default">
          <div class="panel-body">
            <h4>Итоги:</h4>
            <p>Доходы: <span class="badge"> $ {{isset($income) ? $income : 0}}</span></p>
            <p>Расходы: <span class="badge"> $ {{isset($expense) ? $expense : 0}}</span></p>
            <p>Остаток: <span class="badge"> $ {{$income - $expense}}</span></p>
          </div>
        </div>
      </div>
    </div>
   {{-- @endif --}}

  <!-- TODO: Текущие задачи -->
@endsection