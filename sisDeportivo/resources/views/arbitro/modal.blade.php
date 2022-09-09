@extends('layouts.modales')
@section('header')
<div class="row">
  <div class="col-md-9">
    <h3 class="modal-title" id="modal-register-label">
      Modificar arbitro
    </h3>
    <small class="modal-title" id="modal-register-label">
      Modificación de arbitros en el sistema</small>
    </div>
    <div class="col-md-3">
      <img src="balon.png" alt="Cinque Terre" width="80" height="63">
    </div>
  </div>
  @overwrite

  @section('modal_div')
  <div class="modal fade" id="modificar" role="dialog" aria-labelledby="myModalLabel">
    @overwrite

    @section('body')
    <form id="modification-form" method="POST"  class="form-horizontal">
     <input type="hidden" name="_token" value="{{ csrf_token() }}">
       <div class="form-group">
        <input type="number" class="form-control-modal" id="identificacion" name="identicacion" disabled/>
      </div>
      <div class="form-group">
        <input type="text" class="form-control-modal" id="nombre" name="Nombres" disabled />    
      </div>  
      <div class="form-group">
        <input type="text" class="form-control-modal" id="apellido" name="apellido" disabled />  
      </div>
      <div class="form-group">
        <input type="email" class="form-control-modal" id="emmail" name="emmail" placeholder="Email" />  
        </div>

        @overwrite
        @section('mensajes')
        <div class="alert alert-success alert-dismissible" style="display:none;" id="msjmodify" role="alert">  
          <p class="text-center">Arbitro modificado satisfactoriamente</p>
        </div>
        <div class="alert alert-danger alert-dismissible" style="display:none;" id="msjnomodify" role="alert">  
          <p class="text-center">Email del arbitro ya se encuentra registrado</p>
        </div> 
        @overwrite 
        @section('footer')
        <button type="submit" class="btn btn-danger btn-lg">Modificar</button>
      </form>
      @overwrite
      @section('script')
      <script type="text/javascript">
      $('.modal').on('hidden.bs.modal', function(){
      $("#msjmodify").hide();
      $("#msjnomodify").hide();
      $('#modification-form').bootstrapValidator("resetForm",true); 

    });
        $(document).ready(function () {
          var validator = $("#modification-form").bootstrapValidator({
            feedbackIcons: {
              valid: "glyphicon glyphicon-ok",
              invalid: "glyphicon glyphicon-remove", 
              validating: "glyphicon glyphicon-refresh"
            },excluded: [':disabled'],
            fields : {

              emmail :{
            validators : {
              notEmpty : {
                message : "Email es requerido"
              }, 
              emailAddress: {
                message: 'Formato de correo electrónico invalido'
              }
            }
          }
            }
          });

          validator.on("success.form.bv", function (e) {
            e.preventDefault();
            var identificacion = $("#identificacion").val();
            var correo = $("#emmail").val().toUpperCase();
            var token = $("#token").val();


            $.ajax({
              type: "POST",
              url: './editarArbitro',
              headers: {'X-CSRF-TOKEN' : token},

              data: { identificacion,correo},
              success: function(res) {
                respuesta = res;
                var n = respuesta.localeCompare("true");
                $("#msjmodify").hide();
                $("#msjnomodify").hide();
                if(n==0){
                  $("#msjmodify").show();
                }else if (n!=0){
                  $("#msjnomodify").show();
                }
              }});
          });
        });
      </script>
      @overwrite


