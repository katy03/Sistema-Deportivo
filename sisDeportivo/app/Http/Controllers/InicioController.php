<?php namespace sistemaDeportivo\Http\Controllers;

use sistemaDeportivo\Http\Controllers\Controller;
use Auth;
use Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use sistemaDeportivo\User;

class InicioController extends Controller {


	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('index');
	}

    public function password(){
        return view('cambiarpass');
    }



    public function cambiarPassword(Request $request){
         if(Hash::check($request->mypassword, Auth::user()->password)){
            $User=new User;
            $User->where('IDUsuario','=',Auth::User()->IDUsuario)
                ->update(['password'=>hash::make($request->password)]);
    return "true";
            }
            else{
    return "false";
            }
        
    }
}
