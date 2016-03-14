<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificacionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notificaciones', function(Blueprint $table)
		{
			$table->bigIncrements('id')->unsigned();
			$table->integer('tipo_notificacion_id')->nullable();
			$table->string('nombre', 100)->nullable();
			$table->text('descripcion')->nullable();
			$table->integer('user_id')->nullable(); ///este es para saber a quien se envia la notificacion
			$table->integer('asistente_id')->nullable(); ///este es para saber quien genero el evento de la notificacion
			$table->date('fecha')->nullable();
			$table->tinyInteger('estado');// 0 pendiente | 1 vista | 2 revisada
			$table->string('url')->nullable();
			$table->string('dato_adicional')->nullable();
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
		Schema::drop('notificaciones');
	}

}
