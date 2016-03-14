<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartamentosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('departamentos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre', 50);
			$table->string('descripcion', 200)->nullable();
			$table->string('rhema')->nullable();
			$table->date('fecha_creacion')->nullable();
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
		Schema::drop('departamentos');
	}

}
