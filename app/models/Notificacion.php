<?php
/** 
*
* @Redil Software. Notificacion.php” 
* @versión: 1.0.0     @modificado: 07 de Abril del 2015
* @autor última modificación: Mairon Andres Piedrahita castro 
* 
*/

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Notificacion extends Eloquent {

	protected $table = 'notificaciones';

/////este metodo es para saber el usuario que debe ser notificado
	public function user()
    {
        return $this->belongsTo("User");
    }

//////este es el metodo para saber el asistente que genero la notificacion
    public function asistente()
    {
        return $this->belongsTo("Asistente");
    }

	///relacion entre notificaciones y tipo notificaciones
	public function tipoNotificacion()
    {
        return $this->belongsTo("TipoNotificacion");
    } 

    /////////////////////////////////////////////////////
    ////////////////FUNCIONES ALTERNAS///////////////////
    /////////////////////////////////////////////////////
    

    public function tiempoTranscurrido()
    {
        return Helper::transcurrido(strtotime($this->fecha));
    }

    //funcion para notificar los lideres del asistente que se envie como primer atributo
    public static function notificarLideres($asistente_id,$tipo_notificacion, $titulo, $descripcion_asistente, $descripcion_administrador="", $url, $dato_adicional=""){
        $asistente=Asistente::find($asistente_id);
        if($asistente->grupo_id!="")
        {
            $encargados=$asistente->lideres()->get();
            foreach ($encargados as $encargado) 
            {
                if(Auth::user()->id!=$encargado->user->id)
                {
                    Notificacion::notificarUsuario($encargado->user->id,$tipo_notificacion, $titulo, $descripcion_asistente, $descripcion_administrador, $url, $dato_adicional);
                }
            }
            //en caso de que el que creo el asistente sea alguien diferente al super administrador
            //se notifica al super administrador el ingreso de la nueva persona
            if(Auth::user()->id!=1)
            {
                Notificacion::notificarUsuario(1, $tipo_notificacion, $titulo, $descripcion_asistente, $descripcion_administrador, $url, $dato_adicional);
            }
        }
    }

    public static function notificarUsuario($user_id,$tipo_notificacion, $titulo, $descripcion_asistente, $descripcion_administrador, $url, $dato_adicional=""){
        $notificacion= new Notificacion;
        $notificacion->tipo_notificacion_id=$tipo_notificacion;
        $notificacion->nombre=$titulo;
        if(Auth::user()->id==1)
            $notificacion->descripcion="El Administrador ".$descripcion_asistente;
        else
        $notificacion->descripcion="El ".Auth::user()->asistente->tipoAsistente->nombre." ".Auth::user()->asistente->nombre." ".Auth::user()->asistente->apellido." ".$descripcion_asistente;
        $notificacion->estado=0;
        $date = new DateTime(); // obtiene la fecha del sistema
        date_default_timezone_set('America/Bogota');
        $fecha = $date->format('Y-m-d H:i:s'); // le doy formato a la fecha obtenida
        $notificacion->fecha=$fecha;
        $notificacion->url=$url;
        if(Auth::user()->id==1)
        $notificacion->asistente_id=0;
        else
            $notificacion->asistente_id=Auth::user()->asistente->id; //el usuario que generó la solicitud
        $notificacion->user_id=$user_id;
        if($dato_adicional!="")
            $notificacion->dato_adicional=$dato_adicional;
        $notificacion->save();
    }

}

?>