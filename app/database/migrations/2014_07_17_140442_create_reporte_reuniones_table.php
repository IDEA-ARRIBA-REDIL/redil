<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReporteReunionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reporte_reuniones', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('reunion_id');
			$table->date('fecha');
			$table->integer('predicador')->nullable();
			$table->integer('predicador_diezmos')->nullable();
			$table->string('predicador_invitado', 50)->nullable();
			$table->string('predicador_diezmos_invitado', 50)->nullable();
			$table->integer('asistentes_invitados');///este es el campo para guardar la cantidad de asistentes invitados
			$table->text('observaciones')->nullable();
			$table->integer('invitados')->nullable();
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
		Schema::drop('reporte_reuniones');
	}

}