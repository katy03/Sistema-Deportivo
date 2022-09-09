<?php namespace sistemaDeportivo\Http\Controllers;
use sistemaDeportivo\App\Http\Controllers;
use sistemaDeportivo\Http\Requests;
use sistemaDeportivo\Http\Requests\importaRequest;
use sistemaDeportivo\Http\Requests\jugadorRequest;
use sistemaDeportivo\Http\Controllers\Controller;
use sistemaDeportivo\Jugador;
use sistemaDeportivo\Carrera;
use sistemaDeportivo\Estudiante;
use sistemaDeportivo\NumeroJugador;
use Illuminate\Http\Request;
use Session;
use Redirect;
use Input;
use DB;
use Excel;

class JugadorController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function crearJugador(Request $request){
		try{
			$data = $request;
			$jugador = new Jugador;
			$jugador->codigojugador=$data['codigojugador'];
			$jugador->codigocarrera_id=$data['codigocarrera_id'];
			$jugador->idusuario_id=$data['idusuario_id'];
			$jugador->nombres=$data['nombres'];
			$jugador->apellidos=$data['apellidos'];
			$jugador->email=$data['email'];
			$jugador->jornada=$data['jornada'];
			$jugador->idnumero_id=$data['idnumero_id'];
			$jugador->estado=true;		
			if($jugador->save()){
				return "true";
			}else{
				return "false";
			}
		}catch(\Exception $e){
			return "false";
		}

	}
	public function index()
	{
		$carreras =Carrera::lists('Nombre','CodigoCarrera');
		$numeros = NumeroJugador::lists('NumeroJugador','IDNumero');
		return view('jugador.index',compact('Nombre', 'carreras'),compact('NumeroJugador', 'numeros'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	}



	public function verificarEstudiante(Request $request){
		$est= Estudiante::find($request->estudiante);

		if($est==NULL){
			return "false";
		}else{
			return $est;
		}
		
	}

	public function cambiarEstado($id){


		$jugador = Jugador::find($id);
		$estado = $jugador->estado;
		if($estado==true){
			$jugador->estado=false;
			$jugador->save();
			Session::flash('message-error','Se ha modificado el estado del jugador satisfactoriamente');
			return Redirect::to('jugador');

		}else{
			$jugador->estado=true;
			$jugador->save();
			Session::flash('message-error','Se ha modificado el estado del jugador satisfactoriamente');
			return Redirect::to('jugador');


		}
	}

	

	public function search(Request $request){
		
		if($request->ajax()){
			$salida = "";
			$users=DB::table('jugadors')->where('codigojugador','LIKE',$request->id.'%')
			->orwhere('nombres','LIKE',$request->id.'%')
			->orwhere('apellidos','LIKE',$request->id.'%')
			->orwhere('email','LIKE',$request->id.'%')->orderBy('apellidos','ASC')->paginate(10);

			if($users){

				$mensaje='<table class="table table-bordered">
				<thead>
					<tr>
						<th>Código</th>
						<th>Nombres</th>
						<th>Apellidos</th>
						<th>Correo electrónico</th>
						<th>Estado</th>
						<th>Opciones</th>
					</tr>
				</thead><tbody>';
				
				foreach ($users as  $user) {

					if($user->estado==true){
						$estado='ACTIVO';
					}else{
						$estado = 'INACTIVO';
					}

					$salida .='
					<tr>'.
						'<td>'.$user->codigojugador.'</td>'.
						'<td>'.$user->nombres.'</td>'.
						'<td>'.$user->apellidos.'</td>'.
						'<td>'.$user->email.'</td>'.
						'<td>'.$estado.'</td>'.								
						'<td><button class="btn btn-danger" OnClick="Mostrarjugador(this);" value='.$user->codigojugador.'>
						<span class="glyphicon glyphicon-edit"  data-toggle="modal" data-target="#modificar">
						</span>Modificar</button>
						<a href="http://localhost:8000/jugador/'.$user->codigojugador.'/cambiarEstado"  class="btn btn-danger" value='.$user->codigojugador.'>
							<span class="glyphicon glyphicon-refresh">
							</span>Activar/Desactivar</a>
						</td></tr>'
						;
					}
				/*	$paginacion='</tbody></table>
					<div class="container">
						<div class="row">
							<div class="col-md-6 text-center" id="paginacion">
							 '.$users->render().'
							</div>
						</div>
					</div>';*/
					$mensaje.=$salida;
				//	$mensaje.=$paginacion;
					

					return Response($mensaje);
				}else{
					return Response('<h4 class="text-center">Usuario no se encuentra registrado</h4>');

				}

			}
		}




	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function importar()
	{
		return view('jugador.importar');

	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */

	public function postImportJugador(jugadorRequest $request){
		
		try{
			Excel::load(Input::file('jugador'),function($reader){
				$reader->each(function($sheet){
					Jugador::firstOrCreate($sheet->toArray());
				});
			});

			Session::flash('message-success','Se ha cargado los jugadores satisfactoriamente');
			return Redirect::to('importar_estudiante');

		}catch(\Exception $e){
			$codigo= $e->getCode();
			$errores =$e->errorInfo;
			$mensaje = explode(" ", $errores[2]);
			switch ($codigo) {
				case '23505':
				$err = $e->getMessage();
				Session::flash('message-error','El campo ya se encuentra en la BD : '.$mensaje[14]);
				return Redirect::to('importar_estudiante');
				break;

				case '23502':
				Session::flash('message-error','Verifique que ningún campo este vacio');
				return Redirect::to('importar_estudiante');
				break;
				
				case '42703':
				Session::flash('message-error','Verifique que los titulos estén digitados correctamente');
				return Redirect::to('importar_estudiante');
				break;
				
			}
		}
	}
	


	public function postImport(importaRequest $request){
		try{
			Excel::load(Input::file('estudiante'),function($reader){
				$reader->each(function($sheet){
					Estudiante::firstOrCreate($sheet->toArray());
				});
			});

			Session::flash('message-success','Se ha cargado los estudiantes satisfactoriamente');
			return Redirect::to('importar_estudiante');

		}catch(\Exception $e){
			$codigo= $e->getCode();
			$errores =$e->errorInfo;
			$mensaje = explode(" ", $errores[2]);
			switch ($codigo) {
				case '23505':
				$err = $e->getMessage();
				Session::flash('message-error','El campo ya se encuentra en la BD : '.$mensaje[14]);
				return Redirect::to('importar_estudiante');
				break;

				case '23502':
				Session::flash('message-error','Verifique que ningún campo este vacio');
				return Redirect::to('importar_estudiante');
				break;
				
				case '42703':
				Session::flash('message-error','Verifique que los titulos estén digitados correctamente');
				return Redirect::to('importar_estudiante');
				break;
				
			}
		}
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$jugador = Jugador::find($id);
		return response()->json(
			$jugador->toArray()
			);
	}


	public function editarjugador(Request $request)
	{

		$id = $request->identificacion;
		$jugador = Jugador::find($id);
		$jugador->email=$request->correo;
		$jugador->jornada=$request->jornada;
		$jugador->idnumero_id =$request->numero;
		try{
			$jugador->save();
			return "true";
		}catch(\Exception $e){
			return "false";
		}
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
