<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cursos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre', 100);
			$table->text('descripcion')->nullable();
			$table->text('objetivos')->nullable();
			$table->text('requisitos')->nullable();
			$table->boolean('obligatorio');
			$table->integer('paso_culminar_id')->nullable(); // foranea 
			$table->integer('escuela_id')->nullable(); // foranea de la tabla Escuelas		
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
		Schema::drop('cursos');
	}

}
