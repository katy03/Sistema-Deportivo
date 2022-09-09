<?php namespace sistemaDeportivo\Http\Controllers;
use Illuminate\Http\Request;
use sistemaDeportivo\Http\Requests;
use sistemaDeportivo\Http\Controllers\Controller;
use Auth;
use Redirect;
use Session;
use sistemaDeportivo\User;
use Illuminate\Support\Facades\Validator;
use sistemaDeportivo\Http\Requests\LoginRequest;
use Mail;

class LoginController extends Controller {




	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('login.index');

	}

	public function enviar( ){
		return view('layouts.login');
	}

	public function enviarPassword(Request $request){
		Mail::Send('layouts.login',$request->all(), function($mensaje){
			$mensaje->subject('hola');
			$mensaje->to('torneos.univalle@gmail.com');
		});
	}


    /**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
    public function create()
    {

    }




	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */

	public function vaciarIntentos($id){
	   $user = User::findOrFail($id);
	   $intentos=0;
	   $user->intentos=$intentos;
	   $user->save();
	}


	public function store(LoginRequest $request){

		if($request['IDUsuario']=='' or $request['password']==''){
			Session::flash('message-error','Debe ingresar los campos completamente');
			return Redirect::to('/');


		}elseif(Auth::attempt(['IDUsuario' =>$request['IDUsuario'],'password' =>$request['password'],'Estado'=>true])){
			$this->vaciarIntentos($request['IDUsuario']);
			return Redirect::to('/inicio');		

		}else{

			try{
				$user = User::findOrFail($request['IDUsuario']);
				$intentos = User::find($request['IDUsuario'])->intentos;
			}catch(\Exception $ex){
				Session::flash('message-error','Cuenta no existente');
				return Redirect::to('/');
			}

			if ($intentos ==5){
				$user->Estado =false;
				$user->save();
				Session::flash('message-error','Cuenta inactivada');
				return Redirect::to('/');

			}else{
				$intentos+=1;
				$user->intentos=$intentos;
				$user->save();
				Session::flash('message-error','Lleva :'.$intentos.' intentos errados, al quinto intento fallido su cuenta será inactivada');
				return Redirect::to('/');
			}
		}
	}


	public function logout(){
		Auth::logout();
		return Redirect::to('/');
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
		//
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
		return view('login.bloqueado');

	}

}
