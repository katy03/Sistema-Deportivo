<?php namespace sistemaDeportivo\Http\Controllers;
use sistemaDeportivo\App\Http\Controllers;
use sistemaDeportivo\Http\Requests;
use sistemaDeportivo\Http\Controllers\Controller;
use sistemaDeportivo\User;
use Session;
use Redirect;
use sistemaDeportivo\Http\Request\usuarioRequest;
use sistemaDeportivo\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;


class UsuarioController extends Controller {


	public function __construct(){
		$this->middleware('auth');
		$this->middleware('Administrador', ['only' =>['index']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{	
		
		return view('usuario.index');

	}

	public function search(Request $request){
		
		if($request->ajax()){
			$salida = "";
			$users=DB::table('users')->where('IDUsuario','LIKE',$request->id.'%')
			->orwhere('Nombres','LIKE',$request->id.'%')
			->orwhere('Apellidos','LIKE',$request->id.'%')
			->orwhere('email','LIKE',$request->id.'%')->orderBy('Apellidos','ASC')->paginate(10);

			if($users){

				$mensaje='<table class="table table-bordered">
				<thead>
					<tr>
						<th>Identificación</th>
						<th>Nombres</th>
						<th>Apellidos</th>
						<th>Email</th>
						<th>Estado</th>
						<th>Opciones</th>
					</tr>
				</thead><tbody>';
				
				foreach ($users as  $user) {

					if($user->Estado==true){
						$estado='ACTIVO';
					}else{
						$estado = 'INACTIVO';
					}

					$salida .='
					<tr>'.
						'<td>'.$user->IDUsuario.'</td>'.
						'<td>'.$user->Nombres.'</td>'.
						'<td>'.$user->Apellidos.'</td>'.
						'<td>'.$user->email.'</td>'.
						'<td>'.$estado.'</td>'.
						'<td><button class="btn btn-danger" OnClick="Mostrar(this);"  value='.$user->IDUsuario.'>
						<span class="glyphicon glyphicon-edit"  data-toggle="modal" data-target="#modificar">
						</span>Modificar</button>
						<a href="http://localhost:8000/usuario/'.$user->IDUsuario.'/cambiarEstado"  class="btn btn-danger" value='.$user->IDUsuario.'>
							<span class="glyphicon glyphicon-refresh">
							</span>Cambiar estado</a>
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


		public function editarusuario(Request $request)
		{
			$id = $request->identificacion;
			$user = User::find($id);
			$user->email=$request->correo;
			try{
				$user->save();
				return "true";
			}catch(\Exception $e){
				return "false";
			}
		}


		public function cambiarEstado($id){

			$usuario = User::find($id);
			$estado = $usuario->Estado;
			if($estado==true){
				$usuario->Estado=false;
				$usuario->save();
				Session::flash('message-error','Se ha modificado el estado del usuario satisfactoriamente');
				return Redirect::to('usuario');

			}else{
				$usuario->Estado=true;
				$usuario->save();
				Session::flash('message-error','Se ha modificado el estado del usuario satisfactoriamente');
				return Redirect::to('usuario');


			}
		}

		public function crearUsuario(Request $request){
			
			try{
				$data = $request;
				$user = new User;
				$pass =Hash::make($data['password']);
				$user->IDUsuario=$data['IDUsuario'];
				$user->Nombres=$data['Nombres'];
				$user->Apellidos=$data['Apellidos'];
				$user->email=$data['email'];
				$user->IDRol_id=1;
				$user->password=$pass;

				if($user->save()){
					return "true";
				}else{
					return "false";
				}
			}catch(\Exception $e){
				return "false";
			}
		}

		public function modificar($id){

			$user = User::find($id);
			$user->email=$request->dato;
			$user->save();
		}

		public function crear(Request $request){

			if($request->ajax()){
				$user=User::create($request->all());
				return response()->json($user);
			}

		}




	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::find($id);
		return response()->json(
			$user->toArray()
			);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,$id)
	{
		$user = User::find($id);
		$user->fill($request->all());
		$genre->save();

		return response()->json([
			"mensaje"=>'modificado'
			]);


	}

}
