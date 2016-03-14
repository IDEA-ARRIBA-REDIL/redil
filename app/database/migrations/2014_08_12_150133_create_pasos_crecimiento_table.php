<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasosCrecimientoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pasos_crecimiento', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre', 50);
			$table->string('descripcion', 200)->nullable();
			$table->integer('tipo_asistente_id');
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
		Schema::drop('pasos_crecimiento');
	}

}
