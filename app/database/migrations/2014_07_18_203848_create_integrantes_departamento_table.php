<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntegrantesDepartamentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('integrantes_departamento', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('asistente_id');
			$table->integer('departamento_id');
			$table->string('funcion',200)->nullable();
			$table->string('cargo',100)->nullable();
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
		Schema::drop('integrantes_departamento');
	}

}
