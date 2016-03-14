<?php
/** 
*
* @Redil Software. ReporteGrupo.php
* @versión: 1.0.0     @modificado: 01 de Agosto del 2014 
* @autor última modificación: Mairon Piedrahita 
* 
*/

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class ReporteGrupo extends Eloquent {

    //funcion para crear relacion uno a muchos entre Reporte_Grupos y Grupo
    public function grupo()
    {
        return $this->belongsTo("Grupo");
    }

	//funcion para crear relacion muchos a muchos entre Reporte_Grupos y Asistente
	public function asistentes()
    {
        return $this->belongsToMany("Asistente", "asistencia_grupos")->withPivot('asistio','created_at','updated_at');
    }
    // nueva funcion para crear relacion de uno a muchos entre reporte y ofrendas
	public function ofrendas()
    {
        return $this->hasMany("Ofrenda"); 
    }

/*

    //anterior relacion de muchos a muchos con ofrendas
    public function ofrendas()
    {
        return $this->belongsToMany("Ofrenda", "ofrenda_grupos")->withTimestamps(); 
    }

*/
    //////////////////////Otras funciones diferenets a las del modelo laravel

    // funcion para obtener los no asistentes a un reporte de grupo
    public function noAsistieron()
    {
        $asistieron=Helper::obtenerArrayIds($this->asistentes()->where('asistio', '=', '1')->get());

        $no_asistieron=$this->grupo->asistentes()->whereNotIn('asistentes.id', $asistieron);

        return $no_asistieron;
    }

    public function cantidadAsistentes()
    {
        $reporte=$this;
        $total=$reporte->asistentes()->count()+$reporte->invitados;
        return $total;
    }

}

?>