<?php namespace sistemaDeportivo;

use Illuminate\Database\Eloquent\Model;

class CaracteristicaPartido extends Model {


	protected $table="caracteristica_partidos";

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['CodigoCaracter','Nombre','Descripcion'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];
}
}
