<?php 
/** 
*
* @Redil Software. LineaTableSeeder.php” 
* @versión: 1.0.0     @modificado: 03 de Julio del 2014 
* @autor última modificación: Mairon Piedrahita 
* 
*/

class LineaTableSeeder extends Seeder{
	public function run()
    {
        DB::table('lineas')->delete();

        /*Linea::create(array(
        	'nombre' => 'Juda', 
        	'descripcion' => 'Ministerio de niños',
            'rhema'=>'salmo 1'
        ));

        Linea::create(array(
        	'nombre' => 'Neftaly', 
        	'descripcion' => 'Ministerio de jovenes',
            'rhema'=>'isaias 60: 1-5'
        ));*/
    }
}