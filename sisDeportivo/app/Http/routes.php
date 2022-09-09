<?php
use sistemaDeportivo\Rol;

//LOGUEO

Route::get('/','LoginController@index');
Route::resource('login','LoginController');
Route::get('logout','LoginController@logout');

//OLVIDO CONTRASEÑA

Route::get('enviar','LoginController@enviar');
Route::post('enviarPassword',[
	'uses' =>'LoginController@enviarPassword',
	'as' =>'enviarPassword'
	]);

//CAMBIAR CONTRASEÑA

Route::GET('cambiarpass', 'InicioController@password');
Route::POST('.cambiarPassword', [
	'uses' =>'InicioController@cambiarPassword',
	'as' =>'cambiarPassword'
	]);

//USARIOS.
Route::resource('usuario','UsuarioController');
Route::POST('crearUsuario', 'UsuarioController@crearUsuario');
Route::POST('cambiarEstado', 'UsuarioController@cambiarEstado');
Route::GET('usuario/{id}/cambiarEstado',[
	'uses' =>'UsuarioController@cambiarEstado',
	'as' =>'usuario.cambiarEstado'
	]);
Route::POST('editarusuario','UsuarioController@editarusuario');
Route::GET('search','UsuarioController@search');
Route::GET('search/?page={id}','UsuarioController@search');

//ADMINISTRADOR

Route::group(['middleware' => ['auth','Administrador'], 'prefix' =>'Administrador'], function(){
	Route::get('/', function(){
		return view('Administrador.index');
	});
});


//INVITADO

Route::group(['middleware' => ['auth','Invitado'], 'prefix' =>'Invitado'], function(){
	Route::get('/', function(){
		return view('Invitado.index');
	});
});

//ARBITRO
Route::resource('arbitro','ArbitroController');
//ARBRITROS
Route::POST('crearArbitro', 'ArbitroController@crearArbitro');
Route::POST('cambEstado', 'ArbitroController@cambEstado');
Route::GET('arbitro/{id}/cambEstado',[
	'uses' =>'ArbitroController@cambEstado',
	'as' =>'arbitro.cambEstado'
	]);
Route::GET('arbitro/{id}/modificar',[
	'uses' =>'ArbitroController@modificar',
	'as' =>'arbitro.modificar'
	]);
Route::POST('editarArbitro','ArbitroController@editarArbitro');
Route::GET('searc','ArbitroController@searc');
Route::GET('searc/?page={id}','ArbitroController@searc');




//JUGADORES
Route::resource('jugador','JugadorController');
Route::GET('buscarjugador','JugadorController@search');
Route::GET('buscarjugador/?page={id}','JugadorController@search');
Route::get('importar_estudiante','JugadorController@importar');
Route::POST('importar','JugadorController@postImport');
Route::POST('importar_jugador','JugadorController@postImportJugador');
Route::POST('editarjugador','JugadorController@editarjugador');
Route::POST('cambiarEstadoJugador', 'JugadorController@cambiarEstado');
Route::GET('jugador/{id}/cambiarEstado',[
	'uses' =>'JugadorController@cambiarEstado',
	'as' =>'jugador.cambiarEstado'
	]);
Route::POST('verificarEstudiante', 'JugadorController@verificarEstudiante');
Route::POST('crearJugador', 'JugadorController@crearJugador');


Route::get('/inicio','InicioController@index');
Route::resource('campeonato','CampeonatoController');
Route::resource('equipo','EquipoController');

Route::resource('partido','PartidoController');
Route::post('updatepassword', 'InicioController@updatePassword');

//HORARIO
Route::get('horario-enfrentamiento','HorarioController@index');
//INFORMES
Route::get('informe-general', 'InformeController@general');
Route::get('informe-campeonato', 'InformeController@campeonato');





Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
