<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEscuelasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('escuelas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre', 100);
			$table->text('descripcion')->nullable();
			$table->integer('director_id')->nullable(); // foranea de la tabla asistente que reprenseta al director escuelas
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
		Schema::drop('escuelas');
	}

}
