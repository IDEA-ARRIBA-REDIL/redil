<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIglesiasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('iglesias', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre', 100);
			$table->string('direccion', 200)->nullable();
			$table->string('ciudad', 200)->nullable();
			$table->string('departamento', 200)->nullable();
			$table->string('pais', 200)->nullable();
			$table->string('telefono1', 20)->nullable();
			$table->string('telefono2', 20)->nullable();
			$table->string('rhema', 20)->nullable();
			$table->string('texto_rhema')->nullable();
			$table->string('metas')->nullable();
			$table->date('fecha_apertura')->nullable();
			$table->string('logo');
			$table->integer('user_id');///Foranea
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
		Schema::drop('iglesias');
	}

}
