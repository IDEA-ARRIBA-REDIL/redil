<?php
/** 
*
* @Redil Software. Red.php” 
* @versión: 1.0.0     @modificado: 03 de Julio del 2014 
* @autor última modificación: Mairon Piedrahita 
* 
*/

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Red extends Eloquent {

	protected $table = 'redes';
	
    ///relacion para conocer las REDES del GRUPO
    public function grupos()
    {
        return $this->belongsToMany("Grupo","redes_grupo")->withTimestamps();
    }
}

?>