<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArbitrosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('arbitros', function(Blueprint $table)
		{
			$table->primary('IDArbitro');
			$table->string('IDArbitro');
			$table->string('IDUsuario_id')->unsigned();
			$table->foreign('IDUsuario_id')->references('IDUsuario')->on('users');
			$table->string('Nombres');
			$table->string('Apellidos');
			$table->string('Email');
			$table->boolean('Estado')->default(true);
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
		Schema::drop('arbitros');
	}

}
