<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportesGrupoBajasAltasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reportes_grupo_bajas_altas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('motivo', 100);
			$table->text('observaciones')->nullable();
			$table->date('fecha')->nullable();
			$table->boolean('dado_baja');
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
		Schema::drop('reportes_grupo_bajas_altas');
	}

}
