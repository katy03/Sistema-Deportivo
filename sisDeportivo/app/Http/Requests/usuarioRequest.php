<?php namespace sistemaDeportivo\Http\Requests;

use sistemaDeportivo\Http\Requests\Request;

class usuarioRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'identificacion' => 'required',
			'Nombres' => 'required',
			'Apellidos' => 'required',
			'email' => 'required',
			'password' => 'required',
			'confirmacion' => 'required',

		];
	}

}
