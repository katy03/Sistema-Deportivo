<?php namespace sistemaDeportivo;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
	protected $primaryKey = 'IDUsuario';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['IDUsuario','Nombres', 'Apellidos', 'email','password','Estado'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [ 'remember_token', 'IDRol_id','intentos'];

	public function getPassword()
    {
        return $this->Password; // case sensitive
    }

    public function scopesearch($query,$IDUsuario)
    {
    	return $query->where('IDUsuario','LIKE','%'.$IDUsuario.'%');
    }


}
