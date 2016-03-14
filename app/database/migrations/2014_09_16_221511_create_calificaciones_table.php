<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalificacionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('calificaciones', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('logro_id');//Foranea que representa a logro
			$table->integer('estudiante_matriculado_id');//Foranea que representa a estudiante matriculado
			$table->integer('nota');
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
		Schema::drop('calificaciones');
	}

}
