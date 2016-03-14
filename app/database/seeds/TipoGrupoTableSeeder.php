<?php 
/** 
*
* @Redil Software. TipoGrupoTableSeeder.php” 
* @versión: 1.0.0     @modificado: 03 de Julio del 2014 
* @autor última modificación: Mairon Piedrahita 
* 
*/

class TipoGrupoTableSeeder extends Seeder{
	public function run()
    {
        DB::table('tipo_grupos')->delete();

        TipoGrupo::create(array(
        	'nombre' => 'Abierto', 
        	'descripcion' => 'Celulas abiertas para cualquier asistente'
        ));

        TipoGrupo::create(array(
        	'nombre' => 'Cerrado', 
        	'descripcion' => 'Celulas solo para lideres'
        ));
    }
}