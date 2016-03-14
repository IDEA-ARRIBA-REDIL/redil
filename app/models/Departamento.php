<?php
/** 
*
* @Redil Software. Grupo.php” 
* @versión: 1.0.0     @modificado: 03 de Julio del 2014 
* @autor última modificación: Mairon Piedrahita 
* 
*/

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Departamento extends Eloquent
 {


	//funcion para crear relacion entre asistentes y grupos
	public function encargados()
    {
        return $this-> belongsToMany("Asistente", "encargados_departamento")->withPivot('funcion','created_at','updated_at');

    }

public function integrantes()
    {
        return $this-> belongsToMany("Asistente", "integrantes_departamento")->withPivot('cargo','funcion','created_at','updated_at');

    }

    

}

?>