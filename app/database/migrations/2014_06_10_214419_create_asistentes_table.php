<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsistentesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('asistentes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre', 50);
			$table->string('apellido', 50);
			$table->tinyInteger('genero')->nullable();
			$table->tinyInteger('tipo_identificacion')->nullable();
			$table->string('identificacion', 20)->nullable();
			$table->string('nacionalidad', 50)->nullable();
			$table->date('fecha_nacimiento')->nullable();
			$table->string('direccion', 200)->nullable();
			$table->string('telefono_fijo', 20)->nullable();
			$table->string('telefono_movil', 20)->nullable();
			$table->string('telefono_otro', 20)->nullable();
			//$table->string('email', 100);
			$table->tinyInteger('estado_civil')->nullable();
			$table->string('ocupacion', 100)->nullable();
			$table->date('fecha_ingreso')->nullable();
			$table->string('tipo_sangre', 5)->nullable();
			$table->text('indicaciones_medicas')->nullable();
			$table->text('limitaciones')->nullable();
			$table->string('foto', 20);
			$table->boolean('inactivo_grupo');
			$table->boolean('inactivo_iglesia');
			//$table->boolean('dado_baja'); // dado de alta=0  --  dado de baja=1
			$table->integer('tipo_asistente_id');///foranea
			//$table->foreign('tipo')->references('id')->on('tipos_asistentes');
			$table->integer('grupo_id')->nullable();
			//$table->foreign('grupo')->references('id')->on('grupos');
			$table->timestamps();
			$table->softDeletes(); 
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('asistentes');
	}

}
