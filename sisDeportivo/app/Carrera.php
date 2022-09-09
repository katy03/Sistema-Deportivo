<?php namespace sistemaDeportivo;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model {

	protected $table="carreras";

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id','Nombre'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];


}
