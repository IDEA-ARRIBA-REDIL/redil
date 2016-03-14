<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicioServidorEventosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('servicio_servidor_eventos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('servidor_evento_id');
			$table->integer('tipo_servicio_evento_id');
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
		Schema::drop('servicio_servidor_eventos');
	}

}
