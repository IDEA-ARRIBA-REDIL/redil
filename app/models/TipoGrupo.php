<?php
/** 
*
* @Redil Software. TipoGrupo.php” 
* @versión: 1.0.0     @modificado: 03 de Julio del 2014 
* @autor última modificación: Mairon Piedrahita 
* 
*/

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class TipoGrupo extends Eloquent {

	//funcion para crear relacion entre grupos y TipoGrupo
	public function grupos()
    {
        return $this->hasMany("Grupo");
    }

	
}

?>