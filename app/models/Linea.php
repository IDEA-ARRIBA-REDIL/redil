<?php
/** 
*
* @Redil Software. Linea.php” 
* @versión: 1.0.0     @modificado: 03 de Julio del 2014 
* @autor última modificación: Mairon Piedrahita 
* 
*/

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Linea extends Eloquent {
	
	///relacion para conocer el o los encargados de una Linea
	public function encargados()
    {
        return $this->belongsToMany("Asistente", "encargados_linea")->withTimestamps(); 
    }   

    ///relacion entre linea y grupos
	public function asistentes()
    {
        return $this->hasMany("Asistente");
    }

    //////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////FUNCIONES ADICIONALES/////////////////////////////////////
    public function grupos($tipo="objeto"){
        $grupos=array();
        $asistentes=$this->asistentes;
        foreach ($asistentes as $asistente) {
            foreach ($asistente->grupos()->where('dado_baja', 0)->get() as $grupo) {
                array_push($grupos, $grupo->id);
            }
        }
        $grupos=array_unique($grupos);
        if($tipo=="objeto")
        {
            $grupos= Grupo::whereIn('grupos.id', $grupos)->distinct(); 
        }
        return $grupos;
    }
    

    public function asignarEncargado($id_asistente){
        $linea= $this;
        $band=0;
        if(!$linea->encargados()->attach($id_asistente))
        {
            $asistente=Asistente::find($id_asistente);
            $asistente->cambiarLinea($linea->id, "con-ministerio");
            //se hace la notificaciones correspondientes
            //se notifica el asistente
            $descripcion_asistente="te ha asignado como lider de una línea";
            $url="/lineas/perfil/".$this->id;
            Notificacion::notificarUsuario($id_asistente,2, "Ahora eres lider de línea", $descripcion_asistente, "", $url);
            //fin notificacion

            return "true";
        }
        else{
            return "false";
        }
    }

    public function eliminarEncargado($id_asistente){
        $linea= $this;
        $band=0;
        if($linea->encargados()->detach($id_asistente))
        {
            $asistente=Asistente::find($id_asistente);
            $asistente->cambiarLinea($linea->id);
            return "true";
        }
        else{
            return "false";
        }
    }

    /////Devuelve las ofrendas que pertenecen a una linea, incluyendo las ofrendas sueltas
    public function ofrendas($tipo="objeto"){
        $ofrendas="";
        return $ofrendas;
    }
}

?>