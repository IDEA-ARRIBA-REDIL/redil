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

class ReporteBajaAlta extends Eloquent {

	protected $table = 'reporte_bajas_altas';

	public function asistente()
    { 
        return $this->belongsTo('Asistente'); 
    }
	
}

?>