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

class Reunion extends Eloquent {

	protected $table = 'reuniones';


    public function reportes()
    {
        return $this->hasMany("ReporteReunion");

    }


    ////funciones personalizadas
   public function promedioAsistencia($fecha_desde, $fecha_hasta, $linea="", $tipo_asistente_id="", $grupo=""){
        $reportes=$this->reportes()->where('fecha','<=', $fecha_hasta)->where('fecha', '>=', $fecha_desde)->get();
        //$mes_inicio=(int)date('m', strtotime($fecha_desde));
        //$mes_fin=(int)date('m', strtotime($fecha_hasta));
        //$minimo_de_reportes_mes=($mes_fin-($mes_inicio-1))*(int)$this->reuniones_por_mes;
        $promedio=0;
        foreach ($reportes as $reporte) {
            $promedio+=(int)$reporte->cantidadAsistentesTotal($linea, $tipo_asistente_id, $grupo);
        }
        if($reportes->count()>0/*$minimo_de_reportes_mes*/)
        {
            $promedio=$promedio/(int)$reportes->count();
        }
        /*else
        {
            $promedio=$promedio/$minimo_de_reportes_mes;
        }*/
        return $promedio;
    }

     ////funciones personalizadas
   public static function promedioAsistenciaTotal($fecha_desde, $fecha_hasta, $linea="", $tipo_asistente_id="", $grupo=""){
        $reportes=ReporteReunion::where('fecha','<=', $fecha_hasta)->where('fecha', '>=', $fecha_desde)->get();

        $promedio=0;
        foreach ($reportes as $reporte) {
            $promedio+=(int)$reporte->cantidadAsistentesTotal($linea, $tipo_asistente_id, $grupo);
        }
        if($reportes->count()>0/*$minimo_de_reportes_mes*/)
        {
            $promedio=$promedio/(int)$reportes->count();
        }

        return $promedio;
    }

}

?>
	