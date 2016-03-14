<?php
/** 
*
* @Redil Software. Visita.php” 
* @versión: 1.0.0     @modificado: 03 de Julio del 2014 
* @autor última modificación: Mairon Piedrahita 
* 
*/

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Visita extends Eloquent {

	public function asistente()
    { 
        return $this->belongsTo('Asistente'); 
    }

    public function asignadaPor()
    { 
        return $this->belongsTo('Asistente'); 
    }
}


?>