<?php
/** 
*
* @Redil Software. Red.php” 
* @versión: 1.0.0     @modificado: 07 de Agosto del 2014 
* @autor última modificación: Juan Carlos Velasquez 
* 
*/

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class ServidorGrupo extends Eloquent {

	protected $table = 'servidores_grupo';

	public function tipoServicioGrupo()
    {
        return $this->belongsToMany('TipoServicioGrupo', 'servicios_servidores_grupo', 'servidores_grupo_id', 'tipo_servicio_grupos_id' )->withTimestamps();    
    }


}

?>