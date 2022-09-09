<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquiposTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('equipos', function(Blueprint $table)
		{
			$table->increments('CodigoEquipo');
			$table->string('IDUsuario_id')->unsigned();
			$table->foreign('IDUsuario_id')->references('IDUsuario')->on('users');
			$table->string('CodigoCarrera_id')->unsigned();
			$table->foreign('CodigoCarrera_id')->references('CodigoCarrera')->on('carreras');
			$table->integer('PuntosAcumulados');
			$table->integer('FaltasAcumuladas');
			$table->boolean('Estado');
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
		Schema::drop('equipos');
	}

}
