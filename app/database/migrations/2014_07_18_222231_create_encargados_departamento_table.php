<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncargadosDepartamentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('encargados_departamento', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('asistente_id');
			$table->integer('departamento_id');
			$table->string('funcion',200)->nullable();
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
		Schema::drop('encargados_departamento');
	}

}
