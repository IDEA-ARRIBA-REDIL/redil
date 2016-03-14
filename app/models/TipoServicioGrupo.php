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

class TipoServicioGrupo extends Eloquent {

	public function servidorGrupo()
    {
        return $this->belongsToMany('ServidorGrupo', 'servicios_servidores_grupo' , 'tipo_servicio_grupos_id' ,'servidores_grupo_id' )->withTimestamps();    
    }

	
}

?>