<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursoPeriodosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('curso_periodos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('lugar', 100);
			$table->text('horarios')->nullable();
			$table->date('fecha_inicio')->nullable();
			$table->date('fecha_fin')->nullable();
			$table->integer('costo');
			$table->integer('curso_id');///Foranea
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
		Schema::drop('curso_periodos');
	}

}
