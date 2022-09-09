<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJugadorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jugadors', function(Blueprint $table)
		{
			$table->primary('codigojugador');
			$table->string('codigojugador');
			$table->string('codigocarrera_id')->unsigned();
			$table->foreign('codigocarrera_id')->references('CodigoCarrera')->on('carreras');
			$table->string('idUsuario_id')->unsigned();
			$table->foreign('idUsuario_id')->references('IDUsuario')->on('users');
			$table->string('nombres');
			$table->string('apellidos');
			$table->string('email')->unique();
			$table->string('jornada');
			$table->integer('idnumero_id')->unsigned();
			$table->foreign('idnumero_id')->references('IDNumero')->on('numero_jugadors');
			$table->boolean('estado')->default(true);
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
		Schema::drop('jugadors');
	}

}
