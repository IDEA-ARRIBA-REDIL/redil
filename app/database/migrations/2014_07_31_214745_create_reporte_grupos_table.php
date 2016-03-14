<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReporteGruposTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reporte_grupos', function(Blueprint $table)
		{
			
			$table->increments('id');
			$table->date('fecha');
			$table->string('tema', 50);
			$table->string('observacion', 200)->nullable();
			//aprobado: 0 no; 1 si   este campo es para saber si el reporte de grupo ya fue aprobada o no.
			$table->boolean('aprobado');
			$table->integer('grupo_id');
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
		Schema::drop('reporte_grupos');
	}

}
