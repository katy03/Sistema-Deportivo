  @extends('layouts.modales')
  @section('header')
  <div class="row">
    <div class="col-md-9">
      <h3 class="modal-title" id="modal-register-label">
        Registrar usuario
      </h3>
      <small class="modal-title" id="modal-register-label">
        Registro de usuarios en el sistema</small>
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
      <form id="registration-form" method="POST" class="form-horizontal" >
        <div class="form-group">            
          <input type="number" class="form-control-modal" id="IDUsuario" name="IDUsuario" placeholder="Identificación" />
        </div>    
        <div class="form-group">
          <input type="text" class="form-control-modal" id="Nombres" name="Nombres" placeholder="Nombres" />  
        </div>  
        <div class="form-group">
          <input type="text" class="form-control-modal" id="Apellidos" name="Apellidos" placeholder="Apellidos" />  
        </div>
        <div class="form-group">
          <input type="email" class="form-control-modal" id="email" name="email" placeholder="Email" />  
        </div> 
        <div class="form-group">
          <input type="password" class="form-control-modal" id="password" name="password" placeholder="Contraseña" /> 
        </div>
        <div class="form-group">
          <input type="password" class="form-control-modal" id="confirmacion" name="confirmacion" placeholder="Confirmación" /> 
        </div>
        @overwrite
        @section('mensajes')
        <div class="alert alert-success alert-dismissible"  style="display:none;" id="msjsuccess" role="alert">  
          <p class="text-center">Usuario registrado satisfactoriamente</p>
        </div>
        <div class="alert alert-danger alert-dismissible" style="display:none;" id="msjdanger" role="alert">  
          <p class="text-center">No se registro usuario,Identificación o email ya se encuentran registrados</p>
        </div>
        @overwrite    
        @section('footer')
        <a type="submit" OnClick="limpiar();" class="btn btn-default btn-lg">Limpiar</a>

        <button type="submit" class="btn btn-danger btn-lg">Registrar</button>
      </form>
      @overwrite
      @section('script')
      <script type="text/javascript">

        function limpiar(){
         $("#msjsuccess").hide();
         $("#msjdanger").hide();
         $("#IDUsuario").val("");
         $("#Nombres").val("");
         $("#Apellidos").val("");
         $("#email").val("");
         $("#password").val("");
         $("#confirmacion").val("");
         $('#registration-form').bootstrapValidator("resetForm",true); 
       }

       $(document).ready(function () {
        var validator = $("#registration-form").bootstrapValidator({
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
                  min : 8, 
                  max: 35,
                  message: "Identificación debe ser min :8  y max :35 caracteres"
                }
              }
            }, 
            Nombres :{
              validators : {
                notEmpty : {
                  message : "Nombres es requerido"
                }, 
                stringLength: {
                  min : 3, 
                  max: 35,
                  message: "Nombres debe ser min :3  y max :35 caracteres"
                }
              }
            },
            Apellidos :{
              validators : {
                notEmpty : {
                  message : "Apellidos es requerido"
                }, 
                stringLength: {
                  min : 4, 
                  max: 35,
                  message: "Apellidos debe ser min :4  y max :35 caracteres"
                }
              }
            },
            email :{
              validators : {
                notEmpty : {
                  message : "Email es requerido"
                }, 
                emailAddress: {
                  message: 'Formato de correo electrónico invalido'
                }
              }
            },
            password : {
              validators: {
                notEmpty : {
                  message : "Contraseña nueva es requerida"
                },
                stringLength : {
                  min: 8,
                  max: 35,
                  message: "Contraseña actual debe ser min :8  y max :35 caracteres"
                }
              }
            }, 
            confirmacion: {
              validators: {
                notEmpty : {
                  message: "Confirmación es requerida"
                }, 
                identical : {
                  field: "password", 
                  message : "Contraseña nueva y onfirmación deben ser iguales"
                }
              }
            }
          }
        });
        validator.on("success.form.bv", function (e) {
          e.preventDefault();
          var token = $("#token").val();
          var IDUsuario= $('#IDUsuario').val();
          var Nombres =$('#Nombres').val().toUpperCase();;
          var Apellidos= $('#Apellidos').val().toUpperCase();;
          var email =$('#email').val().toUpperCase();;
          var password= $('#password').val();
          $.ajax({
            type: "POST",
            url: './crearUsuario',
            headers: {'X-CSRF-TOKEN' : token},
            data: {IDUsuario,Nombres,Apellidos,email,password},
            success: function(res) {
             respuesta = res;
             console.log(res);
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


















