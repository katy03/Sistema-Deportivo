<?php namespace sistemaDeportivo\Http\Controllers;

use sistemaDeportivo\Http\Requests;
use sistemaDeportivo\Http\Controllers\Controller;
use sistemaDeportivo\Arbitro;
use Illuminate\Http\Request;
use Session;
use Redirect;
use Input;
use DB;
use Excel;

class ArbitroController extends Controller {

	public function __construct(){
		$this->middleware('auth');
		$this->middleware('Administrador', ['only' =>['index']]);
	}


	public function index()
	{
		return view('arbitro.index');

	}

	public function searc(Request $request){		
		if($request->ajax()){
			$salida = "";
			$arbitros=DB::table('arbitros')->where('IDArbitro','LIKE',$request->id.'%')
			->orwhere('Nombres','LIKE',$request->id.'%')
			->orwhere('Apellidos','LIKE',$request->id.'%')
			->orwhere('Email','LIKE',$request->id.'%')->orderBy('Apellidos','ASC')->paginate(10);
			if($arbitros){
				$mensaje='<table class="table table-bordered">
				<thead>
					<tr>
						<th>Identificación</th>
						<th>Nombres</th>
						<th>Apellidos</th>
						<th>Correo electrónico</th>
						<th>Usuario</th>
						<th>Estado</th>
						<th>Opciones</th>
					</tr>
				</thead><tbody>';				
				foreach ($arbitros as  $arbitro) {
					if($arbitro->Estado==true){
						$Estado='ACTIVO';
					}else{
						$Estado = 'INACTIVO';
					}
					$salida .='
					<tr>'.
						'<td>'.$arbitro->IDArbitro.'</td>'.
						'<td>'.$arbitro->Nombres.'</td>'.
						'<td>'.$arbitro->Apellidos.'</td>'.
						'<td>'.$arbitro->Email.'</td>'.
						'<td>'.$arbitro->IDUsuario_id.'</td>'.
						'<td>'.$Estado.'</td>'.
						'<td><button class="btn btn-danger" OnClick="Mostrar(this);" value='.$arbitro->IDArbitro.'>
						<span class="glyphicon glyphicon-edit"  data-toggle="modal" data-target="#modificar">
						</span>Modificar</button>
						<a href="http://localhost:8000/arbitro/'.$arbitro->IDArbitro.'/cambEstado"  class="btn btn-danger" value='.$arbitro->IDArbitro.'>
							<span class="glyphicon glyphicon-refresh">
							</span>Activar/Desactivar</a>
						</td></tr>'
						;
					}
				/*	$paginacion='</tbody></table>
					<div class="container">
						<div class="row">
							<div class="col-md-6 text-center" id="paginacion">
							 '.$arbitros->render().'
							</div>
						</div>
					</div>';*/
					$mensaje.=$salida;
				//	$mensaje.=$paginacion;
					

					return Response($mensaje);
				}else{
					return Response('<h4 class="text-center">arbitro no se encuentra registrado</h4>');		}
			}
		}
		public function cambEstado($id){

			$arbitro = Arbitro::find($id);
			$Estado = $arbitro->Estado;
			if($Estado==true){

				$arbitro->Estado=false;
				$arbitro->save();
				Session::flash('message-error','Se ha modificado el estado del arbitro satisfactoriamente');
				return Redirect::to('arbitro');

			}else{
				$arbitro->Estado=true;
				$arbitro->save();
				Session::flash('message-error','Se ha modificado el estado del arbitro satisfactoriamente');
				return Redirect::to('arbitro');


			}
		}

	


	public function editarArbitro(Request $request)
		{
			$id = $request->identificacion;
			$arbitro = arbitro::find($id);
			$arbitro->Email=$request->correo;
			try{
				$arbitro->save();
				return "true";
			}catch(\Exception $e){
				return "false";
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

	public function crearArbitro(Request $request){
		try{
				$data = $request;
				$arbitro = new Arbitro;
				$arbitro->IDArbitro=$data['IDArbitro'];
				$arbitro->IDUsuario_id=$data['IDUsuario_id'];
				$arbitro->Nombres=$data['Nombres'];
				$arbitro->Apellidos=$data['Apellidos'];
				$arbitro->Email=$data['Email'];
				$arbitro->Estado=true;
				if($arbitro->save()){
					return "true";
				}else{
					return "false";
				}
			}catch(\Exception $e){
			return "false";
		}
		}

		public function modificar($id){

			$arbitro = Arbitro::find($id);
			$arbitro->Email=$request->dato;
			$arbitro->save();
		}

		public function crear(Request $request){

			if($request->ajax()){
				$arbitro=Arbitro::create($request->all());
				return response()->json($arbitro);
			}

		}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
		return view('arbitro.create');
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
		$arbitro = Arbitro::find($id);
		return response()->json(
			$arbitro->toArray()
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
		$arbitro = Arbitro::find($id);
		$arbitro->fill($request->all());
		$genre->save();

		return response()->json([
			"mensaje"=>'modificado'
			]);


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
