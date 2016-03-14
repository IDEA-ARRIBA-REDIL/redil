<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReunionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reuniones', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('lugar', 100);
			$table->time('hora')->nullable();
			$table->tinyInteger('dia')->nullable();
			$table->string('nombre', 100);
			$table->text('descripcion')->nullable();
			$table->boolean('dado_baja'); // dado de alta=0  --  dado de baja=1
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
		Schema::drop('reuniones');
	}

}
