<?php namespace sistemaDeportivo\Http\Controllers\Auth;
use sistemaDeportivo\User;

use sistemaDeportivo\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Session;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}

	//Login

	protected function getLogin()
	{
		return view("login.index");
	}



	public function postLogin(Request $request)
	{
		$this->validate($request,[
			'IDUsuario' => 'required',
			'password' => 'required',
			]);

		$credentials = $request->only('IDUsuario','password');

		if ($this->auth->attempt($credentials,$request->has('remember')))
		{
			return view("index");
		}
		return view("login.index")->with('mensaje', 'credenciales de autenticación incorrectas');
		
	}


	protected function getRegister(){


		return view("usuario.registrar");
	}


	protected function postRegister(Request $request)
	{

		$this->validate($request,[
			'IDUsuario' =>'required',
			'Nombres' =>'required',
			'Apellidos' => 'required',
			'email' =>'required',
			'password' => 'required',
		]);


		$data = $request;

		$user = new User;
		$user->IDUsuario=$data['IDUsuario'];
		$user->Nombres=$data['Nombres'];
		$user->Apellidos=$data['Apellidos'];
		$user->email=$data['email'];
		$user->password=Hash::make($data['password']);
		$user->IDRol_id=$data['roles'];

		if($user->save()){
			return ("se ha registrado correctamente");
		}
	}

	protected function getLogout()
	{
		$this->auth->logout();
		Session::flush();
		return redirect('login.index');
	}



}

