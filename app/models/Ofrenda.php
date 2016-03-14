<?php
/** 
*
* @Redil Software. Ofrenda.php
* @versión: 1.0.0     @modificado: 01 de Agosto del 2014 
* @autor última modificación: Mairon Piedrahita 
* 
*/

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Ofrenda extends Eloquent {
	//funcion para crear relacion entre Ofrenda y Asistente
	public function asistente()
    {
        return $this->belongsTo("Asistente");
    }

  

    public function reporte_grupo()
    {
        return $this->belongsTo("ReporteGrupo");
    }

    public function reporte_reunion()
    {
        return $this->belongsTo("ReporteReunion");
    }

/*


  //relacion para saber a que reporte de grupo pertenece la ofrenda
    //aunque la relacion correcta es de uno a muchos se hizo asi 
    //para no dejar el campo reporte_id vacio en al tabla de ofrendas 
    //cuando la ofrenda pertenezca a un culto
    public function reporte_grupo()
    {
        return $this->belongsToMany("ReporteGrupo", "ofrenda_grupos")->withTimestamps(); 
    }

    public function reporte_culto()
    {
        return $this->belongsToMany("ReporteReunion", "ofrenda_reuniones")->withTimestamps(); 
    }



*/

}

?>