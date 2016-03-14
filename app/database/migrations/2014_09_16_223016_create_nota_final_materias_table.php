<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotaFinalMateriasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('nota_final_materias', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('materia_id');//Foranea que representa a la materia
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
		Schema::drop('nota_final_materias');
	}

}
