<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampeonatosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('campeonatos', function(Blueprint $table)
		{
			$table->increments('CodigoCampeonato');
			$table->string('IDUsuario_id')->unsigned();
			$table->foreign('IDUsuario_id')->references('IDUsuario')->on('users');
			$table->string('Nombre');
			$table->integer('CantidadPartidos');
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
		Schema::drop('campeonatos');
	}

}
