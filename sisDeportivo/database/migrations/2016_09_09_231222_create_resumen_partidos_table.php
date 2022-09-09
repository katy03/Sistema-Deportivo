<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResumenPartidosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('resumen_partidos', function(Blueprint $table)
		{
			$table->increments('CodigoResumen');
			$table->integer('CodigoPartido_id')->unsigned();
			$table->foreign('CodigoPartido_id')->references('CodigoPartido')->on('partidos');
			$table->integer('CodigoEquipo_id')->unsigned();
			$table->foreign('CodigoEquipo_id')->references('CodigoEquipo')->on('equipos');
			$table->integer('TotalGoles');
			$table->integer('TotalFaltas');
			$table->integer('TotalPenales');
			$table->integer('TotalTirosBanda');
			$table->integer('TotalTirosEsquina');
			$table->integer('TotalTirosLibres');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('resumen_partidos');
	}

}
