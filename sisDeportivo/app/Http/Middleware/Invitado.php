<?php namespace sistemaDeportivo\Http\Middleware;

use Closure;

class Invitado {

	protected $auth;
	public function__construct(Guard $auth)
	{
		$this->auth = $auth;
	}
	
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{

		
		$usuarioActual =\Auth::user();
		if($usuarioActual->IDRol_id!=2){
			return view("mensajes.msj_rechazado")->with("msj","No posee privilegios para ingresar al modulo.");
		}
		return $next($request);
	}

	return $next($request);
}

}
