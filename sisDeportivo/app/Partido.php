<?php namespace sistemaDeportivo;

use Illuminate\Database\Eloquent\Model;

class Partido extends Model {

	protected $table="partidos";

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['CodigoPartido','Nombre','IDArbitro','CodigoEquipoA','CodigoEquipoB','CodigoCampeonato'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['Estado'];

}
