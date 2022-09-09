<?php namespace sistemaDeportivo;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model {

protected $table="rols";

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['ID','Nombre'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [''];

}
