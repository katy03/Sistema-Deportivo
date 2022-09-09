<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJugadorPorEquiposTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jugador_por_equipos', function(Blueprint $table)
		{
			$table->increments('ID');
			$table->integer('CodigoEquipo_id')->unsigned();
			$table->foreign('CodigoEquipo_id')->references('CodigoEquipo')->on('equipos');			
			$table->integer('CodigoCampeonato_id')->unsigned();
			$table->foreign('CodigoCampeonato_id')->references('CodigoCampeonato')->on('campeonatos');
			$table->string('CodigoJugador_id')->unsigned();
			$table->foreign('CodigoJugador_id')->references('CodigoJugador')->on('jugadors');		
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
		Schema::drop('jugador_por_equipos');
	}

}
