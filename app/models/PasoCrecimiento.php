<?php
/** 
*
* @Redil Software. PasoCrecimiento.php” 
* @versión: 1.0.0     @modificado: 13 de Agosto del 2014 
* @autor última modificación: Mairon Piedrahita 
* 
*/

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class PasoCrecimiento extends Eloquent {

	protected $table = 'pasos_crecimiento';

	public function tipoAsistente()
    {
        return $this->belongsTo('TipoAsistente')->withTimestamps();    
    }

    public function asistentes()
    {
        return $this->belongsToMany('Asistente', 'crecimiento_asistentes' , 'paso_crecimiento_id' ,'asistente_id' )->withPivot('created_at','updated_at');    
    }
	
}

?>