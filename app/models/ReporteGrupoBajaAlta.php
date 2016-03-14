<?php
/** 
*
* @Redil Software. ReporteGrupoBajaAlta.php” 
* @versión: 1.0.0     @modificado: 13 de Agosto del 2014 
* @autor última modificación: Mairon Piedrahita 
* 
*/

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class ReporteGrupoBajaAlta extends Eloquent {

	protected $table = 'reportes_grupo_bajas_altas';

	public function grupo()
    { 
        return $this->belongsTo('Grupo'); 
    }
	
}

?>