<?php namespace sistemaDeportivo;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model {

	protected $table="estudiantes";
	protected $primaryKey = 'codigo';



	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['codigo','nombres','apellidos', 'identificacion','direccion','telefono','celular','email'];

}
