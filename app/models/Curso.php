<?php
/** 
*
* @Redil Software. Curso.php” 
* @versión: 1.0.0     @modificado: 09 de Octubre del 2015 
* @autor última modificación: Felipe Fajardo
* 
*/

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Curso extends Eloquent {

	public function escuela()
    {
        return $this->belongsTo('Escuela', 'escuela_id'); 
    }
	  
}

?>