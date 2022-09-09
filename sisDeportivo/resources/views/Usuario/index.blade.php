	@extends('layouts.principal')
	@section('tittle')
	Usuario
	@stop
	@section('encabezado')
	Usuario
	@stop
	@section('encabezado_tabla')
	Listado de usuarios en el sistema
	@stop

	@section('registro')			
	<div id="container-fluid">
		@include('usuario.create')
	</div>

	<div id="msj-success" class="alert alert-success alert-dismissible" role="alert" style="display:none">
		<strong> ¡ Usuario modificado satisfactoriamente !</strong>
	</div>
	<table class="table table-responsive">
		<thead>
			<tr>
				<td>
					<div class="col-md-9">
						<div id="myTable_wrapper" class="panel-body-tittle ">
							<button title="Registrar usuario" class="btn btn-danger" id="registraruser">Registrar Usuario
								<span class="glyphicon glyphicon-user"></span>
							</button>
						</div>							
					</div>
					<div class="col-md-3">
						<div id="custom-search-input">
							<div class="input-group col-md-12">
								<div class="input-group">
									<input type="text" class="form-control-search" id="search" name="search" placeholder="Buscar usuario"></input>
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
	@include('usuario.modal')
	@overwrite


	@section('scripts')

	<script type="text/javascript">	


		
		$('#registraruser').on('click', function(){
			$('#registrar').modal('show');
		}); 

		$('.modal').on('hidden.bs.modal', function(){
			$("#msjsuccess").hide();
        	$("#msjdanger").hide();
			$(this).find('form')[0].reset();
			$('#registration-form').bootstrapValidator("resetForm",true); 

		});

		$('#search').on('keyup',function(){
			$value=$(this).val().toUpperCase();

			$.ajax({
				type : 'GET',
				url : '{{URL::to('search')}}',
				data: {id:$value},
				success:function(data){

					$('#usuarios').html(data);

					
				}

			});
		})

		

		function Mostrar(btn){

			var route = "usuario/"+btn.value+"/edit";

			$.get(route, function(res){
				$("#identificacion").val(res.IDUsuario);
				$("#nombre").val(res.Nombres);
				$("#apellido").val(res.Apellidos);
				$("#emmail").val(res.email);
			});
		}			
	</script>
	@overwrite
