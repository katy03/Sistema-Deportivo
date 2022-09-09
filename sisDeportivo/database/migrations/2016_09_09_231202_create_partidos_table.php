<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartidosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('partidos', function(Blueprint $table)
		{
			$table->increments('CodigoPartido');
			$table->string('Nombre');
			$table->string('IDUsuario_id')->unsigned();
			$table->foreign('IDUsuario_id')->references('IDUsuario')->on('users');
			$table->string('IDArbitro_id')->unsigned();
			$table->foreign('IDArbitro_id')->references('IDArbitro')->on('arbitros');
			$table->integer('CodigoEquipoA_id')->unsigned();
			$table->foreign('CodigoEquipoA_id')->references('CodigoEquipo')->on('equipos');
			$table->integer('CodigoEquipoB_id')->unsigned();
			$table->foreign('CodigoEquipoB_id')->references('CodigoEquipo')->on('equipos');
			$table->integer('CodigoCampeonato_id')->unsigned();
			$table->foreign('CodigoCampeonato_id')->references('CodigoCampeonato')->on('campeonatos');
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
		Schema::drop('partidos');
	}

}
