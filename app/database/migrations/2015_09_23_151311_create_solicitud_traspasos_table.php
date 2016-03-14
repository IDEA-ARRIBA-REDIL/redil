<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudTraspasosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('solicitud_traspasos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('asistente_id');
			$table->integer('solicita_id');
			$table->integer('grupo_actual');
			$table->integer('grupo_destino')->nullable();
			$table->date('fecha_solicitud'); //aqui se guardara la fecha en que se realiza la solicitud
			$table->string('motivo', 200)->nullable();
			$table->text('descripcion')->nullable();
			$table->tinyInteger('estado');// 0 pendiente | 1 aceptada | 2 revisada
			$table->integer('responde_id')->nullable();// relacion con la tabla user y es para saber que usuario respondio la solicitud
			$table->date('fecha_respuesta')->nullable(); //aqui se guardara la fecha en que se respondió la solicitud
			$table->text('observacion_respuesta')->nullable();
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
		Schema::drop('solicitud_traspasos');
	}

}
