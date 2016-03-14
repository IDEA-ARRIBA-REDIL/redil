<?php 
/** 
*
* @Redil Software. NotificacionTableSeeder.php” 
* @versión: 1.0.0     @modificado: 03 de Agosto del 2015
* @autor última modificación: Felipe Fajardo
* 
*/

class NotificacionTableSeeder extends Seeder{
	public function run()
    {
        DB::table('notificaciones')->delete();

	      $date = new DateTime(); // obtiene la fecha del sistema
	      date_default_timezone_set('America/Bogota');
	      $fecha = $date->format('Y-m-d H:i:s'); // le doy formato a la fecha obtenida

        Notificacion::create(array(
            'tipo_notificacion_id' => '2', 
            'nombre' => 'Bienvenido Administrador',
            'descripcion' => 'Gracias por utilizar REDIL, Para empezar te invitamos a actualizar los datos principales de la iglesia',
            'user_id' => '1',
            'asistente_id' => '0',
            'fecha' => $fecha,
            'estado' => '0',
            'url' => '/iglesia'
        ));

        Notificacion::create(array(
            'tipo_notificacion_id' => '2', 
            'nombre' => 'Cambia tu Contraseña',
            'descripcion' => 'Por la seguridad de la administración, es necesario que cambies la contraseña.',
            'user_id' => '1',
            'asistente_id' => '0',
            'fecha' => $fecha,
            'estado' => '0',
            'url' => '/usuarios/actualizar-password'
        ));
    }
}