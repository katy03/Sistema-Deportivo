<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNumeroJugadorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('numero_jugadors', function(Blueprint $table)
		{
			$table->increments('IDNumero');
			$table->integer('NumeroJugador');
			$table->integer('IDPosicion_id')->unsigned();
			$table->foreign('IDPosicion_id')->references('IDPosicion')->on('posicions');

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
		Schema::drop('numero_jugadors');
	}

}
