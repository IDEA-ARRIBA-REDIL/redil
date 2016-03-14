<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('email', 255)->nullable();
			$table->string('privilegios', 255);
			$table->string('password', 255);
			$table->string('remember_token', 100)->nullable();
			$table->integer('asistente_id')->nullable();///Foranea
			$table->boolean('activo');
			//$table->foreign('asistente')->references('id')->on('asistentes');
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
		Schema::drop('users');
	}

}
