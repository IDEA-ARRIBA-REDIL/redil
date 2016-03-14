<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsistenciaGruposTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('asistencia_grupos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->boolean('asistio'); //0 NO - 1 SI
			$table->integer('asistente_id');
			$table->integer('reporte_grupo_id');
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
		Schema::drop('asistencia_grupos');
	}

}
