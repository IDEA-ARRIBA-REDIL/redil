<?php 
/** 
*
* @Redil Software. UserTableSeeder.php” 
* @versión: 1.0.0     @modificado: 04 de Julio del 2014 
* @autor última modificación: Mairon Piedrahita 
* 
*/

class UserTableSeeder extends Seeder{
	public function run()
    {
        DB::table('users')->delete();

        User::create(array(
            'email' =>'administrador@redil.com',
            'privilegios' => '4', 
            'password' => Hash::make("123456"),
            'asistente_id' => '0',
            'activo' => 1,
        ));
    }
}