<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrecimientoAsistentesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('crecimiento_asistentes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('paso_crecimiento_id');
			$table->integer('asistente_id');
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
		Schema::drop('crecimiento_asistentes');
	}

}
