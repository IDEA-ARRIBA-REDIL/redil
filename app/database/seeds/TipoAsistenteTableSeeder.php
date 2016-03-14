<?php 
/** 
*
* @Redil Software. TipoAsistenteTableSeeder.php” 
* @versión: 1.0.0     @modificado: 03 de Julio del 2014 
* @autor última modificación: Mairon Piedrahita 
* 
*/

class TipoAsistenteTableSeeder extends Seeder{
	public function run()
    {
        DB::table('tipo_asistentes')->delete();

        TipoAsistente::create(array(
        	'nombre' => 'Nuevo', 
        	'descripcion' => 'Este tipo de asistente hace referencia a las personas que aun no han completado el proceso de consolidación'
        ));

        TipoAsistente::create(array(
        	'nombre' => 'Oveja', 
        	'descripcion' => 'Este tipo de asistente hace referencia a las personas que ya superaron el proceso de consolidación'
        ));

        TipoAsistente::create(array(
        	'nombre' => 'Miembro', 
        	'descripcion' => 'Este tipo de asistente hace referencia a las personas que ya han estado en encuentro y fueron bautizadas'
        ));

        TipoAsistente::create(array(
        	'nombre' => 'Lider', 
        	'descripcion' => 'Este tipo de asistente hace referencia a las personas que dirigen un grupo celular'
        ));

        TipoAsistente::create(array(
        	'nombre' => 'Pastor', 
        	'descripcion' => 'Este tipo de asistente hace referencia a las personas que han sido nombradas pastores'
        ));
    }
}