<?php namespace sistemaDeportivo;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model {

	protected $table="equipos";

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['CodigoEquipo','CodigoCarrera','Nombre','PuntosAcumulados','FaltasAcumuladas'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['Estado'];


}
