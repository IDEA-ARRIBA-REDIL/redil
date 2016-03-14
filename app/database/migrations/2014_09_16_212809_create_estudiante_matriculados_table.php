<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstudianteMatriculadosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('estudiante_matriculados', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->integer('estado_matricula_id');
			$table->boolean('estado_curso');
			$table->integer('curso_periodo_id');///Foranea
			$table->integer('asistente_id');///Foranea que representa al asistente
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
		Schema::drop('estudiante_matriculados');
	}

}
