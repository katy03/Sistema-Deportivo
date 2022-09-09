@extends('layouts.principal')

@section('tittle')
Inicio
@stop

@section('encabezado')
<h2>¡ Bienvenido !</h2>
@stop

@section('mensaje_advertencia')
@if (Session::has('message-success'))
<div class="alert alert-success alert-dismissible" role="alert">	
{{Session::get('message-success')}}
</div>
@endif
@if (Session::has('message'))
<div class="alert alert-danger alert-dismissible" role="alert">	
{{Session::get('message')}}
</div>
@endif
@if (Session::has('message-error'))
<div class="alert alert-danger alert-dismissible" role="alert">
  {{$errors->first('password')}}
</div>
@endif
@stop

@section('encabezado_tabla')
Página principal
@stop

@section('content')
<img src="soccer.png" class="img-responsive" alt="Cinque Terre" width="5504" height="5236" />
@stop