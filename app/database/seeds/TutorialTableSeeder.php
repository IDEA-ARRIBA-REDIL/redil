<?php 
/** 
*
* @Redil Software. GrupoTableSeeder.php” 
* @versión: 1.0.0     @modificado: 03 de Julio del 2014 
* @autor última modificación: Mairon Piedrahita 
* 
*/

class TutorialTableSeeder extends Seeder{
	public function run()
    {
        DB::table('tutoriales')->delete();

        Tutorial::create(array(
            'titulo' => '¿Cómo crear un nuevo asistente?', 
            'descripcion' => '',
            'url' => 'https://www.youtube.com/embed/zxNfeEcH2XI?list=PLRKx5MFuKK9lKUqYe2lfyd5Fqz1m1Sl10'
        ));


    }
}