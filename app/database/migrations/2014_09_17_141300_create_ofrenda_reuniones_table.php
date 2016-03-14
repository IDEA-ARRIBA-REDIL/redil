<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfrendaReunionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ofrenda_reuniones', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('reporte_reunion_id');
			$table->integer('ofrenda_id');
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
		Schema::drop('ofrenda_reuniones');
	}

}
