<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutorialesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tutoriales', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('titlulo', 100);
			$table->string('url', 300);
			$table->integer('categoria'); // 0=general, 1=asistente, 2=celulas, 3=cultos, 4=linea, 5=donaciones 6=iglesia
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
		Schema::drop('tutoriales');
	}

}
