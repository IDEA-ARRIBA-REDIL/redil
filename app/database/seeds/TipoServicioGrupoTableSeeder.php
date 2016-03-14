<?php 
/** 
*
* @Redil Software. TipoGrupoTableSeeder.php” 
* @versión: 1.0.0     @modificado: 01 de Agosto del 2014 
* @autor última modificación: Mairon Piedrahita 
* 
*/

class TipoServicioGrupoTableSeeder extends Seeder{
	public function run()
    {
        DB::table('tipo_servicio_grupos')->delete();

        TipoServicioGrupo::create(array(
        	'nombre' => 'Timoteo', 
        	'descripcion' => 'Se encarga de anteder y estar pendiente de los asistentes de un grupo en especifico'
        ));

        TipoServicioGrupo::create(array(
        	'nombre' => 'Anfitrion', 
        	'descripcion' => 'Es el encargado de tener el lugar ordenado'
        ));

        TipoServicioGrupo::create(array(
            'nombre' => 'Tesorero', 
            'descripcion' => 'Se encarga de recoger y contar el sobre de diezmos y ofrendas'
        ));
    }
}