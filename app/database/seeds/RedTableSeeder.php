<?php 
/** 
*
* @Redil Software. RedTableSeeder.php” 
* @versión: 1.0.0     @modificado: 03 de Julio del 2014 
* @autor última modificación: Mairon Piedrahita 
* 
*/

class RedTableSeeder extends Seeder{
	public function run()
    {
        DB::table('redes')->delete();

        Red::create(array(
        	'nombre' => 'Niños', 
        	'descripcion' => 'Asistentes menores de 12 años'
        ));

        Red::create(array(
        	'nombre' => 'Jovenes', 
        	'descripcion' => 'Asistentes mayores de 12 años y menores de 28 años'
        ));

        Red::create(array(
        	'nombre' => 'Adultos', 
        	'descripcion' => 'Asistentes mayores de 28 años'
        ));
    }
}