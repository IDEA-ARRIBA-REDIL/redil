<?php
/** 
*
* @Redil Software. Tutorial.php (Es la tabla para personalizar los diferentes Tutorial del sistema)
* @versión: 1.0.0     @modificado: 23 de Febrero del 2016
* @autor última modificación: Juan Carlos Velasquez
* 
*/

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Tutorial extends Eloquent {

	protected $table = 'tutoriales';
	
	  
}

?>