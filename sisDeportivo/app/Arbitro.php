<?php namespace sistemaDeportivo;

use Illuminate\Database\Eloquent\Model;

class Arbitro extends Model {

	protected $table="arbitros";
		protected $primaryKey = 'IDArbitro';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['IDArbitro','Nombres','Apellidos','Email'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['Estado'];
}
