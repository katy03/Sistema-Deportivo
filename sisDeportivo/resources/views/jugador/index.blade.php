@extends('layouts.principal')

@section('tittle')
Jugador
@stop

@section('encabezado')
Jugador
@stop


@section('encabezado_tabla')
  Listado de jugadores en el sistema
@stop

@section('registro')			
<div id="container-fluid">
	@include('jugador.create')
</div>

<div id="msj-success" class="alert alert-success alert-dismissible" role="alert" style="display:none">
	<strong> ¡ Jugador modificado satisfactoriamente !</strong>
</div>
<table class="table table-bordered">
	<thead>
		<tr>
			<td>
				<div class="col-md-9">
					<div id="myTable_wrapper" class="panel-body-tittle ">
						<button title="Registrar usuario" class="btn btn-danger" id="registraruser">Registrar Jugador
							<span class="glyphicon glyphicon-user"></span>
						</button>
						<a href="/importar_estudiante" class="btn btn-default">Importar
							<span class="glyphicon glyphicon-open"></span>
						</a>
					</div>							
				</div>
				<div class="col-md-3">
					<div id="custom-search-input">
						<div class="input-group col-md-12">
							<div class="input-group">
								<input type="text" class="form-control-search" id="search" name="search" placeholder="Buscar jugador"></input>
								<span class="input-group-addon" id="search">
									<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
								</span>
							</div>

						</div>
					</div>
				</div>
			</td>
		</tr>
	</thead>
</table>
@overwrite


@section('mensaje_advertencia')
@if (Session::has('message-error'))
<div class="alert alert-success">
	{{Session::get('message-error')}}
</div>
@endif
@overwrite


@section('content')
<div id="usuarios">
</div>
@include('jugador.modal')
@overwrite


@section('scripts')

<script type="text/javascript">	



	$('#registraruser').on('click', function(){
		$('#registrar').modal('show');
	}); 

	$('.modal').on('hidden.bs.modal', function(){
			document.getElementById('IDUsuario').disabled = false;
			$('#analizar-form').bootstrapValidator("resetForm",true); 
			$("#msjsuccess").hide();
        	$("#msjdanger").hide();
        	$("#msjmatricula").hide();
			$(this).find('form')[1].reset();

		});

	$('#search').on('keyup',function(){
		$value=$(this).val().toUpperCase();

		$.ajax({
			type : 'GET',
			url : '{{URL::to('buscarjugador')}}',
			data: {id:$value},
			success:function(data){

				$('#usuarios').html(data);


			}

		});
	})


	function Mostrarjugador(btn){

		var route = "jugador/"+btn.value+"/edit";

		$.get(route, function(res){
			$("#msjdanger").hide();
			$("#msjsuccess").hide();
			$("#identificacion").val(res.codigojugador);
			$("#nombre").val(res.nombres);
			$("#apellido").val(res.apellidos);
			$("#emmail").val(res.email);
			$("#horario").val(res.jornada);
			$("#numeros_id").val(res.idnumero_id);
		});
	}			
</script>
@endsection
