<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaestroCursoPeridosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('maestro_curso_periodos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('maestro_id');///Foranea que representa al maestro
			$table->integer('curso_periodo_id');///Foranea que representa al curso periodos
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
		Schema::drop('maestro_curso_periodos');
	}

}
