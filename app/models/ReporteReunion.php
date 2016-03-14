<?php
/** 
*
* @Redil Software. Asistente.php 
* @versión: 1.0.0     @modificado: 28 de Octubre del 2014 
* @autor última modificación: Juan Carlos Velasquez  
* 
*/

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class ReporteReunion extends Eloquent {

    protected $table = 'reporte_reuniones';

	///relacion para concer la tipo de reunion
    public function reunion()
    {
        return $this->belongsTo("Reunion");

    }

    //funcion para crear relacion muchos a muchos entre Reporte_Reunions (reuniones)  y Asistente
	public function asistentes()
    {
        return $this->belongsToMany("Asistente", "asistencia_reuniones")->withPivot('created_at','updated_at');
    }

    //relacion para saber las ofrendas que pertenecen a un reporte de Reunion
    public function ofrendas()
    {
        return $this->hasMany("Ofrenda"); 
    }

    // relacion para saber el predicador 
    public function asistentePredicador ()
    {
    	return $this->belongsTo('Asistente','predicador');
    }

    // asistente para saber el predicador de diezmos 
    public function asistentePredicadorDiezmos()
    {
    	return $this->belongsTo('Asistente','predicador_diezmos'); 
    }

    public function cantAsistentesTotal($id)
    {
        $reporte=ReporteReunion::find($id);
        $total=$reporte->asistentes()->count()+$reporte->invitados;
        return $total;
    }

    public function cantidadAsistentesTotal($linea="", $tipo_asistente_id="", $asistentes_id="")
    {
        $reunion=$this;
        $total=$reunion->asistentes()->count()+$reunion->invitados;

        if($linea!="" && $linea!=null)
        {
            $total= $reunion->asistentes()->where("linea_id", $linea)->count();
        }
        if($asistentes_id!="" && $asistentes_id!=null)
        {
            $total= $reunion->asistentes()->where("grupo_id", $asistentes_id)->count();
        }
        if($tipo_asistente_id!="" && $tipo_asistente_id!=null)
        {
            $total=$reunion->asistentes()->where("tipo_asistente_id", $tipo_asistente_id)->count();
        }
        
        return $total;
    }

/*

    public function ofrendas()
    {
        return $this->belongsToMany("Ofrenda", "ofrenda_reuniones")->withTimestamps(); 
    }

*/
}

?>
	