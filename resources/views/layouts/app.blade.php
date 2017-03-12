<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Personal finance - Basic</title>

    <!-- Fonts -->
    <link href="../../../public/css/bootstrap-theme.min.css" rel='stylesheet' type='text/css'>
  
    
    <!-- Styles -->
    <link href="../../../public/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../public/css/jquery-ui.min.css" rel="stylesheet">
  
    
    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }

        .table-danger {
            background-color: #f2dede;
        }
        .table-success {
            background-color: #dff0d8;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">

                <a class="navbar-brand" href="{{ url('/records') }}">
                    <span class='glyphicon glyphicon-credit-card'></span> Домашние финансы
                </a>
            </div>

        </div>
    </nav>
    <div class="container"> 
        @yield('content')
    </div> 
    
    <!-- JavaScripts -->
    <script src="../../../public/js/jquery.js"></script>

    <script src="../../../public/js/bootstrap.min.js"></script>
    <script src="../../../public/js/jquery-ui.js"></script>

  <script>
  $( function() {
    load_data();
    var dateFormat = "yy/mm/dd",
      from = $( "#from" )
        .datepicker({
          dateFormat: dateFormat,
          defaultDate: "-3w",
          changeMonth: true,
          numberOfMonths: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#to" ).datepicker({
        dateFormat: dateFormat,
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      }),
      date_of = $( "#date_of" )
        .datepicker({
          dateFormat: dateFormat,
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 2
        })
        .on( "change", function() {
          date_of.datepicker( "option", "minDate", getDate( this ) );
        });
    
    function records_data(data){
      var data = JSON.parse(data);
      var table = $('.task-table');
      var r= "";   
      var str = "";
      table.html("");
      
      for(var row in data) {
        r = data[row];
        
        str += "<tr> <td class='table-text'>" + r['title'] +"</td><td class='table-text'>" + r['cost'] +"</td><td class='table-text'>" + r['date_of'] +"</td><td><a class='btn btn-small btn-default pull-right' href='/records/"+r['id']+"/edit'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a><form action='/records/"+r['id']+"' class='pull-right' method='POST' ><input type='hidden' name='_token' value='"+ $('[name=csrf-token]').attr('content')+"'><input type='hidden' name='_method' value='DELETE'><button type='submit' class='btn btn-small btn-default'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button></form></td></tr>";
      }
      if( !str ) {
          table.append("<thead><th>Записи</th><th>&nbsp;</th></thead><tr class='text-center table-text'><td> Нет данных </td></tr>");
      } else {
          table.append(str);        
      }
      
    }

    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }

    function load_data(){
     
        var from = $('#from').val(), to = $('#to').val();
        
        $.post('/data',
          {from:from, to:to,_token: $('[name=csrf-token]').attr('content')},
          records_data
          );

    }

  $('#search').on('click', load_data);

  } );

  </script> 
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
