<!doctype html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/table_pantalla.css') }}">
</head>

<body>

<table class="table_pantalla table-striped table-bordered" style="width: 100%">
    <thead>
        <tr>
            <th></th>            <th></th>            <th style="width: 11%;"></th>
            <th></th>            <th></th>            <th></th>
            <th></th>
        </tr>
      <tr>
        <th colspan="2"><strong>Sanna - Clínica Belén</strong></th>
        <th colspan="3"><strong>{{ strtoupper($equipo->name) }}</strong></th>
        <th colspan="2"><img src="{{ asset('images/sanna_table.png') }}" alt="" height="30%" style="float: right"></th>
      </tr>
      <tr>
        <th></th>            <th></th>            <th></th>
        <th></th>            <th></th>            <th></th>
        <th></th>
    </tr>
        <tr>
        <td class="medium text-center" scope="col" style="width: 8%; "><strong>HABITACIÓN</strong></th>
        <td class="medium text-center" colspan="2" scope="col" style="width: 30%;"><strong>PACIENTE</strong></th>
        
        <td class="medium text-center" colspan="2" scope="col" style="width: 30%"><strong>MÉDICO</strong></th>
        <td class="medium text-center" scope="col"><strong>ESPECIALIDAD</strong></th>
        <td class="medium text-center" scope="col"><strong>OBSERVACIÓN</strong></th>
      </tr>
    </thead>

    <tbody>
      @foreach ($habitaciones as $habitacion)
      <tr>
      <td class="text-center"><strong>{{$habitacion->habitacion}}</strong></td>
      @if ($habitacion->hospitalizacion->where('Estado_Anulacion','1')->first())
        
        <td class="text-center" colspan="2"><strong>{{
          $habitacion->hospitalizacion->where('Estado_Anulacion','1')->first()->paciente->fullname
         }} </strong></td>

        <td class="text-center" colspan="2"><strong>{{
          $habitacion->hospitalizacion->where('Estado_Anulacion','1')->first()->medico->person->fullname
        }}</strong></td>

        <td class="text-center"><strong>{{
          $habitacion->hospitalizacion->where('Estado_Anulacion','1')->first()->medico->especialidad->especialidad  
        }}</strong></td>

        <td class="text-center">
          <strong>{{$habitacion->hospitalizacion->where('Estado_Anulacion','1')->first()->observacion}}</strong>
        </td>

         @else
         <td colspan="2"></td>
         <td colspan="2"></td>
         <td class="text-center"></td>
      <td></td>
      @endif


        
        
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>