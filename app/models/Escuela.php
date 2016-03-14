<?php
/** 
*
* @Redil Software. Escuela.php” 
* @versión: 1.0.0     @modificado: 07 de Octubre del 2015 
* @autor última modificación: Felipe Fajardo
* 
*/

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Escuela extends Eloquent {

	public function director()
    {
        return $this->belongsTo('Asistente', 'director_id'); 
    }

    public function cursos()
    { 
        return $this->hasMany("Curso", 'escuela_id');
    }
	  
}

?>