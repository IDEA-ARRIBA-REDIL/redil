<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGruposTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('grupos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre', 100);
			$table->string('direccion', 200)->nullable();
			$table->string('telefono', 20)->nullable();
			$table->string('rhema', 20)->nullable();
			$table->date('fecha_apertura')->nullable();
			$table->tinyInteger('dia')->nullable();
			$table->tinyInteger('reuniones_por_mes')->nullable();
			$table->time('hora')->nullable();
			$table->integer('nivel')->nullable();
			$table->boolean('inactivo');
			$table->boolean('dado_baja');
			$table->integer('linea_id')->nullable();
			$table->string('branch')->nullable();
			//$table->foreign('linea')->references('id')->on('lineas');
			//$table->integer('red');
			//$table->foreign('red')->references('id')->on('redes');
			$table->integer('tipo_grupo_id');
			//$table->foreign('tipo')->references('id')->on('tipos_grupos');
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
		Schema::drop('grupos');
	}

}
