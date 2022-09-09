<?php namespace sistemaDeportivo;

use Illuminate\Database\Eloquent\Model;

class Campeonato extends Model {


	protected $table="campeonatos";

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['CodigoCampeonato','Nombre','CantidadPartidos'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['Estado'];
}
}
