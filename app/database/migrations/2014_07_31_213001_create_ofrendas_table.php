<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfrendasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ofrendas', function(Blueprint $table)
		{
			//ingresada_por: 0 reuniones - 1 grupos - 2 otros
			//tipo_ofrenda: 0 diezmo - 1 ofrenda - 2 pacto - 3 pro-templo - 4 siembra - 5 primicia - 6 otro - 7 suelta
			$table->increments('id');
			$table->tinyInteger('tipo_ofrenda');
			$table->integer('valor');
			$table->date('fecha');
			$table->tinyInteger('ingresada_por'); //este campo es para saber si se ingreso por un culto o por grupo o por otro
			$table->string('observacion', 200)->nullable();
			$table->integer('asistente_id')->nullable();
			$table->integer('reporte_reunion_id')->nullable();
			$table->integer('reporte_grupo_id')->nullable();
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
		Schema::drop('ofrendas');
	}

}
