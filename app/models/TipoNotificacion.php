<?php
/** 
*
* @Redil Software. Notificacion.php” 
* @versión: 1.0.0     @modificado: 07 de Abril del 2015
* @autor última modificación: Mairon Andres Piedrahita castro 
* 
*/

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class TipoNotificacion extends Eloquent {

	protected $table = 'tipo_notificaciones';


	///relacion entre notificaciones y tipo notificaciones
	public function notificaciones()
    {
        return $this->hasMany("Notificacion", "tipo_notificacion_id");
    } 

}

?>