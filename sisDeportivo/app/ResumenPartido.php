<?php namespace sistemaDeportivo;

use Illuminate\Database\Eloquent\Model;

class ResumenPartido extends Model {

protected $table="resumen_partidos";

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['CodigoResumen','CodigoPartido','CodigoEquipo','TotalGoles','TotalFaltas','TotalPenales','TotalTirosBanda','TotalTirosEsquina','TotalTirosLibres'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

}
