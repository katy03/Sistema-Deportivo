@extends('layouts.principal')

@section('tittle')
Importación de información a la BD
@stop

@section('encabezado')
Importación de información
@stop

@section('mensaje_advertencia')
@include('jugador.errors')
@if (Session::has('message-success'))
<div class="alert alert-success alert-dismissible" role="alert">	
	{{Session::get('message-success')}}
</div>
@endif
@if (Session::has('message-error'))
<div class="alert alert-danger alert-dismissible" role="alert">
	{{Session::get('message-error')}}
</div>
@endif
@stop

@section('encabezado_tabla')
  Importación de información a la BD
@stop

@section('content')
<div id="myTable_wrapper" class="panel-body-downloadbtn">

	<div class="col-md-12">
		<div class="col-sm-2">
			<a href="estudiantes.xls" class="btn btn-default" download><span class="glyphicon glyphicon-download-alt" ></span> Formato estudiantes</a>
		</div>	
		<div class="col-sm-2">
			<a href="jugadores.xls" class="btn btn-default" download><span class="glyphicon glyphicon-download-alt" ></span> Formato jugadores</a>
		</div>
	</div>							
</div>
<div class="container-exact">
	<form action="importar" method="post" class="form-horizontal" enctype="multipart/form-data">
		<input type="hidden" name="_token" value="{{csrf_token()}}"></input>
		<div class="form-group">
			<label class="control-label col-sm-2" for="importarestudiantes">Importar estudiantes</label>
			<div class="col-sm-7">
				<input type="file" class="filestyle form-control-modal" name="estudiante" id="estudiante" data-buttonText="Cargar estudiantes">
			</div>
			<div class="col-sm-3">
			<button type="submit" class="btn btn-danger">Aceptar</button>
			</div>
		</div>
	</form>
</div>
<div class="container-exact">
	<form action="importar_jugador" method="post" class="form-horizontal" enctype="multipart/form-data">
		<input type="hidden" name="_token" value="{{csrf_token()}}"></input>
		<div class="form-group">
			<label class="control-label col-sm-2" for="email">Importar jugadores</label>
			<div class="col-sm-7">
				<input type="file" class="filestyle form-control-modal" name="jugador" data-buttonText="Cargar jugadores">
			</div>
			<div class="col-sm-3">
			<button type="submit" class="btn btn-danger">Aceptar</button>
			</div>
		</div>
	</form>
</div>
@stop
@section('script')
<script type="text/javascript">
</script>
@overwrite

