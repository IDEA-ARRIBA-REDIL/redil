<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipacionEventosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('participacion_eventos', function(Blueprint $table)
		{
			$table->increments('id');			
			$table->integer('estado');
			$table->boolean('asistio');
			$table->integer('asistente_id');
			$table->integer('evento_id');
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
		Schema::drop('participacion_eventos');
	}

}
