<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('visitas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->tinyInteger('tipo')->nullable();
			$table->integer('estado');
			$table->date('fecha_limite')->nullable();
			$table->date('fecha')->nullable();
			$table->string('motivo', 100)->nullable();
			$table->time('hora')->nullable();
			$table->text('observacion')->nullable();
			$table->integer('asignado_por')->nullable();
			$table->integer('asistente_id');

			
			//$table->foreign('asistente')->references('id')->on('asistentes');
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
		Schema::drop('visitas');
	}

}
