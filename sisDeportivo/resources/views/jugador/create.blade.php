@extends('layouts.modales')
@section('header')
<div class="row">
  <div class="col-md-9">
    <h3 class="modal-title" id="modal-register-label">
      Registrar jugador
    </h3>
    <small class="modal-title" id="modal-register-label">
      Registro de jugadores en el sistema</small>
    </div>
    <div class="col-md-3">
      <img src="balon.png" alt="Cinque Terre" width="80" height="63">
    </div>
  </div>
  @overwrite
  @section('modal_div')
  <div class="modal fade" id="registrar" role="dialog">
    @overwrite
    @section('body')
    <form id="analizar-form" method="POST" class="form-horizontal" >
      <div class="form-group">            
        <input type="number" class="form-control-modal" id="IDUsuario" name="IDUsuario" placeholder="Código" />
      </div>
      <div class="pull-right">
        <button type="submit" class="btn btn-default btn-lg">Analizar</button>
      </div>
    </form>
    <form id="registration-form" method="POST" class="form-horizontal" >
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="form-group">
        <input type="text" class="form-control-modal" id="Nombres" name="Nombres" placeholder="Nombres" disabled/>  
      </div>  
      <div class="form-group">
        <input type="text" class="form-control-modal" id="Apellidos" name="Apellidos" placeholder="Apellidos" disabled/>  
      </div>
      <div class="form-group">
        <input type="email" class="form-control-modal" id="email" name="email" placeholder="Email" disabled/>  
      </div> 
      <div class="form-group">
        <div class="col-xs-13 selectContainer">
          <select class="form-control-modal" name="jornada" id="jornada">
            <option value="DIURNA">DIURNA</option>
            <option value="NOCTURNA">NOCTURNA</option>
          </select>
        </div>  
      </div> 
      <h5>  Escoger una carrera</h5>
      <div class="form-group">
        {!! Form::select('carreras_id',$carreras,[ 'class' => 'form-control-modal']) !!}
      </div>
      <h5>  Escoger número de jugador</h5>
      <div class="form-group">
       {!! Form::select('numeros_id', $numeros,[ 'class' => 'form-control-modal']) !!}
     </div>
     @overwrite
     @section('mensajes')
     <div class="alert alert-success alert-dismissible"  style="display:none;" id="msjsuccess" role="alert">  
      <p class="text-center">Jugador registrado satisfactoriamente</p>
    </div>
    <div class="alert alert-danger alert-dismissible" style="display:none;" id="msjmatricula" role="alert">  
      <p class="text-center">El estudiante ingresado no se encuentra matriculado</p>
    </div>
    <div class="alert alert-danger alert-dismissible" style="display:none;" id="msjdanger" role="alert">  
      <p class="text-center">El jugador ya se encuentra registrado</p>
    </div>
    @overwrite    
    @section('footer')
    <a type="submit" OnClick="limpiar();" class="btn btn-default btn-lg">Limpiar</a>
    <button type="submit" id="aceptar" class="btn btn-danger btn-lg" disabled="disabled">Registrar</button>
  </form>
  @overwrite
  @section('script')
  
  <script type="text/javascript">

  function limpiar(){
         $("#msjsuccess").hide();
         $("#msjdanger").hide();
         $("#msjmatricula").hide();
         $("#IDUsuario").val("");
         $("#IDUsuario").removeAttr("disabled");
         $("#Nombres").val("");
         $("#Apellidos").val("");
         $("#email").val("");
         $('#analizar-form').bootstrapValidator("resetForm",true); 
         $('#registration-form').bootstrapValidator("resetForm",true); 
         document.getElementById("aceptar").disabled = true;
       }

   $(document).ready(function () {
    var validator = $("#analizar-form").bootstrapValidator({
      feedbackIcons: {
        valid: "glyphicon glyphicon-ok",
        invalid: "glyphicon glyphicon-remove", 
        validating: "glyphicon glyphicon-refresh"
      },excluded: [':disabled'],
      fields : {
        IDUsuario :{
          validators : {
            notEmpty : {
              message : "Identificación es requerida"
            }, 
            stringLength: {
              min : 4, 
              max: 35,
              message: "Identificación debe ser min :4  y max :35 caracteres"
            }
          }
        }
      }
    });
    validator.on("success.form.bv", function (e) {
      e.preventDefault();
      var token = $("#token").val();
      var estudiante= $('#IDUsuario').val();
      $.ajax({
        type: "POST",
        url: './verificarEstudiante',
        headers: {'X-CSRF-TOKEN' : token},
        data: {estudiante},
        success: function(res) {
         respuesta = res;
         if (typeof respuesta === 'string'){
          $("#msjmatricula").show();
          $("#IDUsuario").val("");


        }else{
          $("#Nombres").val(respuesta.nombres);
          $("#Apellidos").val(respuesta.apellidos);
          $("#email").val(respuesta.email);
          document.getElementById('IDUsuario').disabled = true;
          document.getElementById('aceptar').disabled = false;

        }
      }});
    });
  });



   $(document).ready(function () {
    var validator = $("#registration-form").bootstrapValidator({
      feedbackIcons: {
        valid: "glyphicon glyphicon-ok",
        invalid: "glyphicon glyphicon-remove", 
        validating: "glyphicon glyphicon-refresh"
      }, 
      fields : {
        IDUsuario :{
          validators : {
            notEmpty : {
              message : "Identificación es requerida"
            }, 
            stringLength: {
              min : 8, 
              max: 35,
              message: "Identificación debe ser min :8  y max :35 caracteres"
            }
          }
        }
      }
    });

  
    validator.on("success.form.bv", function (e) {
     e.preventDefault();
     var token = $("#token").val();   
     var codigojugador= $('#IDUsuario').val();
     var codigocarrera_id =document.getElementsByName("carreras_id")[0].value;
     var idusuario_id="1144185472";
     var nombres= $('#Nombres').val();
     var apellidos =$('#Apellidos').val();
     var jornada= $('#jornada').val();
     var email= $('#email').val();
     var idnumero_id= document.getElementsByName("numeros_id")[0].value;


     $.ajax({
      type: "POST",
      url: './crearJugador',
      headers: {'X-CSRF-TOKEN' : token},
      data: {codigojugador,codigocarrera_id,idusuario_id,nombres,apellidos,jornada,email,idnumero_id},
      success: function(res) {
       respuesta = res;
       var n = respuesta.localeCompare("true");
       $("#msjsuccess").hide();
             $("#msjdanger").hide();
             if(n==0){
              $("#msjsuccess").show();
            }else if (n!=0){
              $("#msjdanger").show();
            }
          }});
        });
      });
    </script>
    @overwrite



































