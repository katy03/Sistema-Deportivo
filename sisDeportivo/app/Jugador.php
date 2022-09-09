<?php namespace sistemaDeportivo;

use Illuminate\Database\Eloquent\Model;

class Jugador extends Model {

	protected $table="jugadors";


	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $primaryKey = 'codigojugador';
	protected $fillable = ['codigojugador','codigocarrera_id','idusuario_id','nombres', 'apellidos', 'email','jornada','idnumero_id','estado'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];


}
