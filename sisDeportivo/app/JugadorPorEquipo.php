<?php namespace sistemaDeportivo;

use Illuminate\Database\Eloquent\Model;

class JugadorPorEquipo extends Model {

	protected $table="jugador_por_equipos";

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['ID','CodigoEquipo','CodigoJugador','CodigoCampeonato'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];
}
