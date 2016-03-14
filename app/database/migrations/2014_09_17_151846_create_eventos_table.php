<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('eventos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre', 100);
			$table->text('descripcion')->nullable();
			$table->date('fecha_inicio')->nullable();
			$table->time('hora_inicio')->nullable();
			$table->date('fecha_fin')->nullable();
			$table->time('hora_fin')->nullable();
			$table->integer('precio');
			$table->text('web')->nullable();
			$table->date('fecha_limite_pago')->nullable();
			$table->date('fecha_limite_inscripcion')->nullable();
			$table->boolean('privacidad');
			$table->text('observaciones')->nullable();
			$table->integer('tipo_evento');
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
		Schema::drop('eventos');
	}

}
