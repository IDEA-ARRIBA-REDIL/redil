<?php 
/** 
*
* @Redil Software. GrupoTableSeeder.php” 
* @versión: 1.0.0     @modificado: 03 de Julio del 2014 
* @autor última modificación: Mairon Piedrahita 
* 
*/

class GrupoTableSeeder extends Seeder{
	public function run()
    {
        DB::table('grupos')->delete();

        /*Grupo::create(array(
            'nombre' => 'G12 Primario', 
            'direccion' => 'Calle falsa #123',
            'telefono' => '232 77 77',
            'rhema' => 'Prov. 8:24',
            'fecha_apertura' => '2014-07-03',
            'dia' => '2',
            'hora' => '19:00:00',
            'nivel' => '2',
            'linea_id' => '0',
            'tipo_grupo_id' => '2',
            'inactivo' => '0',
            'dado_baja'=> '0'
        ));

        Grupo::create(array(
            'nombre' => 'G12 Juda ', 
            'direccion' => 'Calle verdadera #456',
            'telefono' => '232 75 04',
            'rhema' => 'Prov. 3:24',
            'fecha_apertura' => '2013-09-03',
            'dia' => '2',
            'hora' => '19:00:00',
            'nivel' => '1',
            'linea_id' => '1',
            'tipo_grupo_id' => '2',
            'inactivo' => '0',
            'dado_baja'=> '0'
        ));

        

        Grupo::create(array(
            'nombre' => 'G12 Neftaly', 
            'direccion' => 'Calle desconocida #123',
            'telefono' => '233 65 14',
            'rhema' => 'Isaias 6',
            'fecha_apertura' => '2014-05-09',
            'dia' => '2',
            'hora' => '21:00:00',
            'nivel' => '2',
            'linea_id' => '2',
            'tipo_grupo_id' => '2',
            'inactivo' => '0',
            'dado_baja'=> '0'
        ));

        Grupo::create(array(
            'nombre' => 'Jará', 
            'direccion' => 'Calle 24 #12-51',
            'telefono' => '232 75 04',
            'rhema' => 'Isaias 6',
            'fecha_apertura' => '2008-05-09',
            'dia' => '5',
            'hora' => '20:00:00',
            'nivel' => '3',
            'linea_id' => '2',
            'tipo_grupo_id' => '1',
            'inactivo' => '0',
            'dado_baja'=> '0'
        ));

        Grupo::create(array(
            'nombre' => 'El gran celulon', 
            'direccion' => 'Calle 25 #11-51',
            'telefono' => '233 23 55',
            'rhema' => 'Genesis 6',
            'fecha_apertura' => '2009-05-09',
            'dia' => '5',
            'hora' => '20:00:00',
            'nivel' => '3',
            'linea_id' => '2',
            'tipo_grupo_id' => '0',
            'inactivo' => '0',
          'dado_baja'=> '1'
        )); */


    }
}