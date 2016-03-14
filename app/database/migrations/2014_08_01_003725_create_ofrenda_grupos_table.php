<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfrendaGruposTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ofrenda_grupos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('ofrenda_id');
			$table->integer('reporte_grupo_id');
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
		Schema::drop('ofrenda_grupos');
	}

}
