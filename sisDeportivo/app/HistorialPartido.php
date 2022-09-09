<?php namespace sistemaDeportivo;

use Illuminate\Database\Eloquent\Model;

class HistorialPartido extends Model {

	protected $table="historial_partidos";

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['ID','CodigoJugador','CodigoPartido','CodigoCaracter','Cantidad'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

}
