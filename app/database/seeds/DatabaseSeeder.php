<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('IglesiaTableSeeder');
		$this->call('RedTableSeeder');
		$this->call('TipoAsistenteTableSeeder');
		$this->call('TipoGrupoTableSeeder');	
		$this->call('UserTableSeeder');
		$this->call('TipoServicioGrupoTableSeeder');
		$this->call('PasosCrecimientoTableSeeder');
		$this->call('NotificacionTableSeeder');
		$this->call('TipoNotificacionTableSeeder');
		$this->call('GrupoTableSeeder');
		$this->call('TutorialTableSeeder');
		//$this->call('AsistenteTableSeeder');
		//$this->call('DepartamentoTableSeeder');
		//$this->call('VisitasTableSeeder');
		//$this->call('OfrendaTableSeeder');
		//$this->call('ReporteGrupoTableSeeder');
		//$this->call('LineaTableSeeder');s

	}

}