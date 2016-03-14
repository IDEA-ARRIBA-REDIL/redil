<?php
/** 
*
* @Redil Software. SolicitudTraspaso.php 
* @versión: 1.0.0     @modificado: 04 de Septiembre del 2015 
* @autor última modificación: Juan Carlos Velasquez  
* 
*/

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class SolicitudTraspaso extends Eloquent {

	//relacion para conocer cual es el asistente a traspasar
    public function asistente() 
    { 
        return $this->belongsTo('Asistente'); 
    }

    //relacion para conocer el solicitante del traspaso
    public function solicitante() 
    { 
        return $this->belongsTo('Asistente', 'solicita_id'); 
    }

    //relacion para conocer quien responde la solicitud
    public function respondidoPor() 
    { 
        return $this->belongsTo('Asistente', 'responde_id'); 
    }

    //relacion para conocer el grupo donde esta el asistente a traspasar
    public function grupoActual() 
    { 
        return $this->belongsTo('Grupo', 'grupo_actual'); 
    }

    //relacion para conocer el grupo donde se traspasara el asistente
    public function grupoDestino() 
    { 
        return $this->belongsTo('Grupo', 'grupo_destino'); 
    }
}