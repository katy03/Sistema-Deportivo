@extends('layouts.principal')

@section('tittle')
Cambiar contraseña
@stop

@section('encabezado')
Cambiar contraseña
@stop

@section('mensaje_advertencia')
<div class="alert alert-success alert-dismissible" style="display:none;" id="msjsuccess" role="alert">	
	Contraseña cambiada satisfactoriamente
</div>
<div class="alert alert-danger alert-dismissible" style="display:none;" id="msjdanger" role="alert">	
	No se actualizó la contraseña,"Contraseña actual" es errónea

</div>
@stop

@section('encabezado_tabla')
  Cambio de contraseña en el sistema
@stop

@section('content')
<div class="container-password">
	<form id="registration-form" method="POST"  class="form-horizontal" >
		<input name="_token" id="token" type="hidden" value="{!! csrf_token() !!}" />
		<div class="container-form">

			<div class="form-group">
				<label class="control-label col-sm-3" for="passactual">Contraseña actual:</label>
				<div class="col-sm-9">

					<input type="password" class="form-control-modal" id="passactual" name="passactual"  />   </div>		
				</div> 
				<div class="form-group">
					<label class="control-label col-sm-3" for="passactual">Contraseña nueva:</label>
					<div class="col-sm-9">

						<input type="password" class="form-control-modal" id="passnueva" name="passnueva"  /> </div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="passactual">Confirmación:</label>
						<div class="col-sm-9">

							<input type="password" class="form-control-modal" id="passwordconfirmacion" name="passwordconfirmacion" /> 
						</div></div>
					</div>
					<div class="col-sm-9">
						
					</div>
					<div class="col-sm-2">

						<button type="submit" class="btn btn-danger btn-lg">Cambiar contraseña</button>
					</div>
				</form>
			</div>
			@stop
			@section('scripts')
			<script type="text/javascript">
				$(document).ready(function () {
					var validator = $("#registration-form").bootstrapValidator({
						feedbackIcons: {
							valid: "glyphicon glyphicon-ok",
							invalid: "glyphicon glyphicon-remove", 
							validating: "glyphicon glyphicon-refresh"
						}, 
						fields : {
							passactual :{
								validators : {
									notEmpty : {
										message : "Contraseña actual requerida"
									}, 
									stringLength: {
										min : 3, 
										max: 35,
										message: "Contraseña actual debe ser min :3  y max :35 caracteres"
									}
								}
							},
							passnueva : {
								validators: {
									notEmpty : {
										message : "Contraseña nueva es requerida"
									},
									stringLength : {
										min: 3,
										max: 35,
										message: "Contraseña actual debe ser min :3  y max :35 caracteres"
									}
								}
							}, 
							passwordconfirmacion: {
								validators: {
									notEmpty : {
										message: "Confirmación es requerida"
									}, 
									identical : {
										field: "passnueva", 
										message : "Contraseña nueva y confirmación deben ser iguales"
									}
								}
							}
						}
					});

					validator.on("success.form.bv", function (e) {
						var token = $("#token").val();
						var password = $('#passnueva').val();
						var mypassword =$('#passactual').val();

						$.ajax({
							type: "POST",
							url: '/.cambiarPassword',
							headers: {'X-CSRF-TOKEN' : token},

							data: {  password, mypassword},
							success: function(res) {
								respuesta = res;
								var n = respuesta.localeCompare("true");
								$("#msjsuccess").hide();
								$("#msjdanger").hide();
								if(n==0){
									location.reload();
									$("#msjsuccess").show();
								}else if (n!=0){
									location.reload();
									$("#msjdanger").show();
								}
							}});
					});
				});
			</script>
			@overwrite
















