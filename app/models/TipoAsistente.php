<?php
/** 
*
* @Redil Software. TipoAsistente.php” 
* @versión: 1.0.0     @modificado: 03 de Julio del 2014 
* @autor última modificación: Mairon Piedrahita 
* 
*/

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class TipoAsistente extends Eloquent
 {
	public function asistente ()
    {
        return $this->hasMany("Asistente");
    }

    public function pasosCrecimiento ()
    {
        return $this->hasMany("PasoCrecimiento");
    }


}


?>