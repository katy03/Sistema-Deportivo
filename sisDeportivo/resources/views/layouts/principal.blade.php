        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="description" content="">
            <meta name="author" content="">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <title>Sistema Torneo Deportivo - @yield('title')</title>
            <link href="../css/bootstrap.min.css" rel="stylesheet">
            <link href="../css/bootstrapValidator.min.css" rel="stylesheet"/>
            <link href="../css/sb-admin.css" rel="stylesheet">   
            <script src="../js/jquery.min.js"></script>
            <script src="../js/script.js" type="text/javascript"></script>
            <script src="../js/jquery-ui.js"></script>
            <script src="../js/bootstrap.min.js" type="text/javascript"></script> 
            <script src="../js/bootstrapValidator.min.js" type="text/javascript"></script>
              <script src="../js/bootstrap-select.js"></script>
            <script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
            <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


        </head>
        <body>
            <div id="wrapper">
                <!-- Navigation -->
                <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="inicio"class="navbar-left"><img  style="margin-left:8px;"src="../logo.png"> Sistema Torneo Deportivo - Bienestar Universitario</a>
                </div>
                <!-- Top Menu Items -->
                <ul class="nav navbar-right top-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {!!Auth::user()->Nombres." ".Auth::user()->Apellidos!!} <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                           
                            <li>
                                <a href="/logout"><i class="fa fa-fw fa-power-off"></i> Cerrar sesión</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                      @if (Auth::user()->IDRol_id ==1)
                      <div class="container-brand">
                          <div class="col-md-3 col-md-offset-1">
                             <img src="../brand.png" width="150" height="130">

                         </div>
                     </div>
                     <div class="container-key">
                         <a href="/cambiarpass"><i class="fa fa-key"></i> Cambiar contraseña</a>
                     </div>
                     <li>
                         <a href="/usuario"><i class="glyphicon glyphicon-lock"></i> Gestión Usuarios</a>
                     </li>
                     <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#personal"><i class="glyphicon glyphicon-user"></i> Gestión Personal<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="personal" class="collapse">
                            <li>
                                <a href="/jugador">Jugador</a>
                            </li>
                            <li>
                                <a href="/arbitro">Árbitro</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-futbol-o"></i> Gestión Juego <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="/campeonato">Campeonato</a>
                            </li>
                            <li>
                                <a href="/equipo">Equipo</a>
                            </li>
                            <li>
                                <a href="/horario-enfrentamiento">Horario</a>
                            </li>
                            <li>
                                <a href="/partido">Partido</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#informe"><i i class="fa fa-fw fa-bar-chart-o"></i> Gestión Informes <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="informe" class="collapse">
                            <li>
                                <a href="/informe-general">General</a>
                            </li>
                            <li>
                                <a href="/informe-campeonato">Por Campeonato</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="page-wrapper">
            <div class="container-fluid-tittle">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           <small>@yield('encabezado')</small>
                       </h1>
                   </div>
               </div>
               <!-- /.row -->
               <div class="row">
                <div class="col-lg-12">

                </div>
            </div>
            @yield('mensaje_advertencia')

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="glyphicon glyphicon-home"></i>@yield('encabezado_tabla') </h3>
                        </div>
                        @yield('registro') 
                        <div class="panel-body">
                            @yield('content')
                        </div>
                        @yield('pie')
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    </div>
     <!-- Foooter
================== -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <!-- Contact us form -->
                <div class="col-md-4">
                    <div class="headline">
                    <img class="logo-img" src="https://campusvirtual.univalle.edu.co/moodle/theme/crisp/pix/logo-footer.png" alt="Universidad del Valle" height="159" width="112" id="yui_3_17_2_2_1477580986037_25">
                    </div>
                    <hr />
                    <div class="content">
                        <h3>Sistema Torneos Deportivo</h3>
                        <ul>
                        Bienestar universitario</ul>
                    </div>
                </div>
                <!-- Go social -->
                <div class="col-md-8">
                    <div class="headline">
                        <h3>CONTACTANOS</h3>
                    </div>
                    <hr />
                    <div class="content">
                        <p>
                            Cali , Colombia <br />
                            Teléfono: 301-783-6122<br />
                            Email: ivan.guzman@correounivalle.edu.co
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
<!-- wrapper -->
@yield('scripts')


<script type="text/javascript">



          /*  function Mostrar(btn){
                var route = "usuario/"+"111"+"/edit";

                $.get(route, function(res){
                    $("#IDUsuario").val(res.IDUsuario);
                    $("#Nombres").val(res.Nombres);
                    $("#Apellidos").val(res.Apellidos);
                    $("#email").val(res.email);

                });
            }
            $('#cambiar').on('click', function(){
               $('#cambiarcon').modal('show');
           });

            $('#add').on('click', function(){
                $('#registrar').modal('show');
            });   */
        </script>
        @show


    </body>
    </html>
