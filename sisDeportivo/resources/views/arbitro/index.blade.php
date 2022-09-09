			@extends('layouts.principal')
			@section('tittle')
			Arbitro
			@stop
			@section('encabezado')
			Arbitro
			@stop
			@section('encabezado_tabla')
			Listado de arbitros en el sistema
			@stop

			@section('registro')			
			<div id="container-fluid">
				@include('arbitro.create')
			</div>

			<div id="msj-success" class="alert alert-success alert-dismissible" role="alert" style="display:none">
				<strong> ยก Arbitro modificado satisfactoriamente !</strong>
			</div>
			<table class="table table-bordered">
				<thead>
					<tr>
						<td>
							<div class="col-md-9">
								<div id="myTable_wrapper" class="panel-body-tittle ">
									<button title="Registrar arbitro" class="btn btn-danger" id="registrararbitro">Registrar arbitro 
										<span class="glyphicon glyphicon-user"></span>
									</button>
								</div>							
							</div>
							<div class="col-md-3">
								<div id="custom-search-input">
									<div class="input-group col-md-12">
										<div class="input-group">
											<input type="text" class="form-control-search" id="search" name="search" placeholder="Buscar arbitro"></input>
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
			<div id="arbitros">
			</div>
			@include('arbitro.modal')
			@overwrite


			@section('scripts')

			<script type="text/javascript">	
				$('.modal').on('hidden.bs.modal', function(){
					$("#msjsuccess").hide();
					$("#msjdanger").hide();
					$(this).find('form')[0].reset();
					$('#registration-form').bootstrapValidator("resetForm",true); 

				});

				
				$('#registrararbitro').on('click', function(){
					$('#registrar').modal('show');
				}); 

				$('#search').on('keyup',function(){
					$value=$(this).val().toUpperCase();

					$.ajax({
						type : 'GET',
						url : '{{URL::to('searc')}}',
						data: {id:$value},
						success:function(data){

							$('#arbitros').html(data);

							
						}

					});
				})


				function Mostrar(btn){
					var route = "arbitro/"+btn.value+"/edit";

					$.get(route, function(res){
						$("#identificacion").val(res.IDArbitro);

						$("#usuario").val(res.IDUsuario_id);
						$("#nombre").val(res.Nombres);
						$("#apellido").val(res.Apellidos);
						$("#emmail").val(res.Email);
					});
				}			
			</script>
			@endsection
