<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursoPeriodoMateriasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('curso_periodo_materias', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('materia_id');//Foranea que representa a la materia
			$table->integer('curso_periodo_materia_id');//Foranea que representa a la curso periodo materias
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
		Schema::drop('curso_periodo_materias');
	}

}
