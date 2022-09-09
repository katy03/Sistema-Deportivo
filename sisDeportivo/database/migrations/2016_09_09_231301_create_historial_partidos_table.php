<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistorialPartidosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('historial_partidos', function(Blueprint $table)
		{
			$table->increments('ID');
			$table->string('CodigoJugador_id')->unsigned();
			$table->foreign('CodigoJugador_id')->references('CodigoJugador')->on('jugadors');
			$table->integer('CodigoPartido_id')->unsigned();
			$table->foreign('CodigoPartido_id')->references('CodigoPartido')->on('partidos');
			$table->integer('CodigoCaracter_id')->unsigned();
			$table->foreign('CodigoCaracter_id')->references('CodigoCaracter')->on('caracteristica_partidos');
					
			$table->integer('Cantidad');
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
		Schema::drop('historial_partidos');
	}

}
