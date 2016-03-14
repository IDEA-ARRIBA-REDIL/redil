<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePastoresPrincipalesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pastores_principales', function(Blueprint $table)
		{
			$table->increments('id');
			//llave foranea de asistentes tipo pastor
			$table->integer('asistente_id');
			//llave foranea de iglesias
			$table->integer('iglesia_id');
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
		Schema::drop('pastores_principales');
	}

}
