<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncargadosLineaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('encargados_linea', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('asistente_id');
			//$table->foreign('asistente')->references('id')->con('asistentes');
			$table->integer('linea_id');
			//$table->foreign('linea')->references('id')->con('lineas');
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
		Schema::drop('encargados_linea');
	}

}
