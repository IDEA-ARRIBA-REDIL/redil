<?php
/** 
*
* @Redil Software. Iglesia.php” 
* @versión: 1.0.0     @modificado: 03 de Julio del 2014 
* @autor última modificación: Mairon Piedrahita 
* 
*/

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Iglesia extends Eloquent {
	//relacion para saber los pastores principales de la iglesia
	public function pastoresEncargados()
    {
        return $this->belongsToMany("Asistente", "pastores_principales")->withTimestamps(); ;
    }
}

?>