<?php 
/** 
*
* @Redil Software. IglesiaTableSeeder.php” 
* @versión: 1.0.0     @modificado: 05 de Julio del 2014 
* @autor última modificación: Mairon Piedrahita 
* 
*/

class IglesiaTableSeeder extends Seeder{
	public function run()
    {
        DB::table('iglesias')->delete();

       Iglesia::create(array(
            'nombre' => 'Iglesia Ejemplo - Redil', 
            'direccion' => 'Calle #00  - Carrera #00',
            'ciudad' => 'N. Ciudad',
            'departamento' => 'N. Departamento',
            'pais' => 'N. Pais',
            'telefono1' => '111 22 33',
            'telefono2' => '444 55 66',
            'rhema' => 'Prov. 27:23',
            'texto_rhema' => 'Sé diligente en conocer el estado de tus ovejas, Y mira con cuidado por tus rebaños.',
            'logo' => 'logo-iglesia-1.jpg',
            'fecha_apertura' => '2003/04/12',
            'metas' => '- Evangelizar en los colegios. 
            - Levantar 30 lideres nuevos. 
            - Tener el 2do templo construido. 
            - Comprar nuevo equipo de sonido.',
            'user_id' => '1'
        ));
    }
}