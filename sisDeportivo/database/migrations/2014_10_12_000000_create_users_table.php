<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->primary('IDUsuario');
			$table->string('IDUsuario');
			$table->string('Nombres');
			$table->string('Apellidos');
			$table->string('email')->unique();
			$table->string('password', 60);
			$table->integer('IDRol_id')->unsigned()->default(true);
			$table->foreign('IDRol_id')->references('ID')->on('rols');	
			$table->boolean('Estado')->default(true);
			$table->integer('intentos')->unsigned()->default(0);
			$table->rememberToken();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
