<?php 
/** 
*
* @Redil Software. LineaTableSeeder.php” 
* @versión: 1.0.0     @modificado: 22 de Julio del 2014 
* @autor última modificación: Darwin Castaño
*/

class DepartamentoTableSeeder extends Seeder{
	public function run()
    {
        DB::table('departamentos')->delete();

        /*Departamento::create(array(
        	'nombre' => 'Salmistas', 
        	'descripcion' => 'Hombres y Mujeres que tocan el corazon de Dios',
            'rhema'=>'salmo 1',
            'fecha_creacion'=>'2014/05/14'

        ));

        Departamento::create(array(
        	'nombre' => 'Ujieres', 
        	'descripcion' => 'Servicio en todo tiempo',
            'rhema'=>'isaias 60: 1-5',
            'fecha_creacion'=>'2014/06/14'
        ));
        Departamento::create(array(
            'nombre' => 'Danza', 
            'descripcion' => 'danzando solo a el',
            'rhema'=>'isaias 3:3',
            'fecha_creacion'=>'2014/07/14'
        ));*/
    }
}