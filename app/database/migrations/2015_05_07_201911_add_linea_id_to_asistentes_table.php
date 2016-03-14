<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLineaIdToAsistentesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('asistentes', function(Blueprint $table)
		{
			
			$table->integer('linea_id')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('asistentes', function(Blueprint $table)
		{
			//
			$table->dropColumn('linea_id');
		});
	}

}
