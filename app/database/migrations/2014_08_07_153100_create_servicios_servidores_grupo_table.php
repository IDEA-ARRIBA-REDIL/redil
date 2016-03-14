<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiciosServidoresGrupoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('servicios_servidores_grupo', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('servidores_grupo_id');
			$table->integer('tipo_servicio_grupos_id');
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
		Schema::drop('servicios_servidores_grupo');
	}

}
