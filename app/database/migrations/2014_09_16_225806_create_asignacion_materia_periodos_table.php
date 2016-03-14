<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsignacionMateriaPeriodosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('asignacion_materia_maestros', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('materia_id');///Foranea que representa al materia
			$table->integer('maestro_curso_periodo_id');///Foranea que representa al maestro curso peridos
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
		Schema::drop('asignacion_materia_maestros');
	}

}
