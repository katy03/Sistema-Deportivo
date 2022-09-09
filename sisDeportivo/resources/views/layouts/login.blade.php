    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistema Torneo Deportivo - @yield('title')</title>
        <link href="css/loguin.css" rel="stylesheet" type="text/css" >
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/style.css">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="css/sb-admin.css" rel="stylesheet">
        <!-- Morris Charts CSS -->
        <link href="css/plugins/morris.css" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    </head>
    <body >
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" >
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-left"><img  style="margin-left:8px;"src="logo.png"> Sistema Torneo Deportivo - Bienestar Universitario</a>
            </div>
        </nav>
        
        <div id="wrappermessage">

            <div class="container">
              <div class="info">
                  <h1>Bienvenidos</h1>
              </div>
          </div>
          <div class="form">
              <div class="thumbnail"><img src="balon.png"/></div>
              <form class="register-form" method="POST" action="{{ route('enviarPassword') }}">
                  <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
                  <input type="text" placeholder="correo electrónico"/>
                  <button type="submit">Enviar contraseña</button>
                  <p class="message"><a href="#">Ingresar al sistema</a></p>
              </form>
              {!! Form::open(['route'=>'login.store','method'=>'POST','class' =>'login-form'])!!}
              <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
              @yield('mensaje')
              <input type="number" name="IDUsuario" id="IDUsuario"  placeholder="Usuario"/>
              <input  type="password" name="password" id="password"  placeholder="Contraseña" maxlength="20"/>
              <button type="submit" method="POST" name="Ingresar">Ingresar</button>
              <p class="message"><a href="#">¿ Olvidó su contraseña ?</a></p>
              {!!Form::close()!!}
          </div>
          <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
          <script src="js/index.js"></script>
      </body>
      </html>
