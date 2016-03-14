<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaestrosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('maestros', function(Blueprint $table)
		{
			$table->increments('id');
			$table->date('fecha_inicio')->nullable();
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
		Schema::drop('maestros');
	}

}
