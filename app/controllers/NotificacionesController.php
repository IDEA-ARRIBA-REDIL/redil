<?php
/** 
*
* @Redil Software. NotificacionesController.php 
* @versión: 1.0.0     @modificado: 13 de Abril del 2015
* @autor última modificación: Mairon Piedrahita 
* 
*/
class NotificacionesController extends BaseController
{
	public function __construct()
	{
		
		$this->beforeFilter('auth');  //bloqueo de acceso
		
	}

	//lsta de asistentes, como parametro envío el tipo de asistente $tipo
	public function getIndex()
	{
		return Redirect::to('notificaciones/lista/todos');

	}

	

	////////// este es el ajax que devuelve las siguientes 10 notificaciones para el panel de notificaciones
	public function postSiguientesNotificacionesAjax($cant_notif)
	{
        $user=Auth::user();
        $notificaciones=$user->notificaciones()
            ->orderBy("fecha", 'desc')
            ->skip($cant_notif)
            ->take(10)
            ->get();

        $lista=""; 

        foreach($notificaciones as $notificacion)
        {
        	$lista.="
                    <li><!-- start message -->
                        <a href='$notificacion->url'>
                            <div class='pull-left'>";

            $asitente_accion=Asistente::find($notificacion->asistente_id); //este es quien genero la notificacion no quien la recibe
            if($notificacion->asistente_id==0)
                $foto='iglesia/logo-iglesia-1.jpg';
            else
                $foto='fotos/'.$notificacion->asistente->foto;

            $lista.="<img src='/img/".$foto."' class='img-circle' alt='User Image' />
                            </div>
                            <h4>
                                 ".$notificacion->nombre."
                                <small><i class='fa fa-clock-o'></i> Hace ".$notificacion->transcurido(strtotime($notificacion->fecha))." </small>
                            </h4>
                            <p> ".$notificacion->descripcion." </p>
                        </a>
                    </li><!-- end message -->";
        }
		return $lista;
	}

	public function postCantidadNotificacionesAjax()
	{
		$cant=Auth::user()->notificaciones()->count();
		return $cant;
	}

    public function getCantidadNotificacionesSinVerAjax()
    {
        $cant=Auth::user()->notificaciones()->where('estado', '=', '0')->count();
        return $cant;
    }

    public function getCantidadNotificacionesSinRevisarAjax()
    {
        $cant=Auth::user()->notificaciones()->where('estado', '<', '3')->count();
        return $cant;
    }


////////////se accede por ajax y es para cambiar el estado de todas las notificaciones
    public function postCambiaEstadoNotificaciones($estado_ant, $estado)
    {
        $notificaciones=Auth::user()->notificaciones()->where('estado', '<', "$estado_ant")->get();
        foreach ($notificaciones as $notificacion) {
            $notificacion->estado=$estado;
            $notificacion->save();
        }
        return "true";
    }

    public function postNotificacionRevisada($id)
    {
        $notificacion=Notificacion::find($id);
        $notificacion->estado=3;
        $notificacion->save();
        return "true";
    }

    public function getAnadeNotificacionesEstado0Ajax()
    {
        $li_notificaciones="";
        $notificaciones=Auth::user()->notificaciones()->where('estado', '0')->get();
        foreach ($notificaciones as $notificacion) {
            $notificacion->estado=1;
            $notificacion->save();
            if($notificacion->asistente_id==0)
                $foto='iglesia/logo-iglesia-1.jpg';
            else
                $foto="fotos/".$notificacion->asistente->foto;
            $asitente_accion=Asistente::find($notificacion->asistente_id); //este es quien genero la notificacion no quien la recibe
            $li_notificaciones.='<li id="li-'.$notificacion->id.'" class="item-notif"><!-- start message -->
                                    <a id="notificacion-'.$notificacion->id.'" class="item-notificacion" data-estado="'.$notificacion->estado.'" data-id="'.$notificacion->id.'" href="'.$notificacion->url.'">
                                        <div class="pull-left"><img src="/img/'.$foto.'" class="img-circle" alt="User Image" />
                                        </div>
                                        <h4>
                                            '.$notificacion->nombre.'
                                            <small><i class="fa fa-clock-o"></i> Hace menos de un minuto</small>
                                        </h4>
                                        <p>'.$notificacion->descripcion.'</p>
                                    </a>
                                </li><!-- end message -->';
        }
        return $li_notificaciones;
    }

    public function getCambiaUltimaNotificacionAjax()
    {
        $notificacion=Auth::user()->notificaciones()->where('estado', '0')->orderBy("fecha", 'desc')
            ->first();
        $notificacion->estado=1;
        $notificacion->save();
        return "true";
    }
    public function getUltimaNotificacionAjax()
    {
        $body="";
        $notificacion=Auth::user()->notificaciones()->where('estado', '0')->orderBy("fecha", 'desc')
            ->first();
        

        if($notificacion->asistente_id==0)
        {
            $foto='iglesia/logo-iglesia-1.jpg';
        }
        else
        {
            $foto="fotos/".$notificacion->asistente->foto; 
        }
        $body.='<img src="/img/'.$foto.'" alt="user image" class="img-circle col-lg-4 col-md-4 col-xs-4">';
        $body.='<p class="message">'.$notificacion->descripcion.'</p>';

        return $body;
    }

}

?>