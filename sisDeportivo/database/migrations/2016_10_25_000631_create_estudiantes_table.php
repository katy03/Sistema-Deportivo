<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstudiantesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('estudiantes', function(Blueprint $table)
		{
			$table->primary('codigo');
			$table->string('codigo');
			$table->string('nombres');
			$table->string('apellidos');
			$table->string('email')->unique();
			$table->string('telefono');
			$table->string('celular');
			$table->string('direccion');
			$table->string('identificacion');
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
		Schema::drop('estudiantes');
	}

}
