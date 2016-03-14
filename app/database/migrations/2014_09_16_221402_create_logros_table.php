<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogrosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('logros', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre', 100);
			$table->text('descripcion')->nullable();
			$table->integer('porcentajes');
			$table->integer('materia_id');//Foranea que representa a la materia
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
		Schema::drop('logros');
	}

}
