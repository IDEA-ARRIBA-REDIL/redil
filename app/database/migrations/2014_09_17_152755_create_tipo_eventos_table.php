<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoEventosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tipo_eventos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre', 100);
			$table->text('descripcion')->nullable();
			$table->integer('paso_crecimiento');
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
		Schema::drop('tipo_eventos');
	}

}
