<?php 
/** 
*
* @Redil Software. TipoNotificacionTableSeeder.php” 
* @versión: 1.0.0     @modificado: 03 de Agosto del 2015
* @autor última modificación: Felipe Fajardo
* 
*/

class TipoNotificacionTableSeeder extends Seeder{
	public function run()
    {
        
        TipoNotificacion::create(array(
            'nombre' => 'Información', 
            'descripcion' => 'Notificación para brindar información relacionada con la iglesia o el sistema',
            
        ));
        
        TipoNotificacion::create(array(
            'nombre' => 'Sugerencia', 
            'descripcion' => 'Notificación para sugerir algún cambio o tarea conveniente pero no obligatoria',
            
        ));

        TipoNotificacion::create(array(
            'nombre' => 'Bienvenida', 
            'descripcion' => 'Notificación para brindar información en el primer ingreso al sistema',
            
        ));

        TipoNotificacion::create(array(
            'nombre' => 'Urgente', 
            'descripcion' => 'Notificación con información relevante acerca de alguna tarea de vital importancia o con tiempo límite',
            
        ));


    }
}