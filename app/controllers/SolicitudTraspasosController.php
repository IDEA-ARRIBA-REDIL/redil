<?php
/** 
*
* @Redil Software. SolicitudTraspasosController.php” 
* @versión: 1.0.0     @modificado: 29 de Octubre del 2014 
* @autor última modificación: Juan Carlos velasquez  
* 
*/
class SolicitudTraspasosController extends BaseController
{


	public function __construct()
	{
		$this->beforeFilter('auth');  //bloqueo de acceso
	}

	public function getIndex()
	{
		return Redirect::to('asistentes/lista/todos');
	}

	public function getPerfil($id)
	{
		$solicitud= SolicitudTraspaso::find($id);
		$asistente=$solicitud->asistente;
		$grupo_actual= $solicitud->grupoActual;
		$grupo_destino= $solicitud->grupoDestino;
		if(Auth::user()->id!=1)
		{
			if(!isset(Auth::user()->asistente->discipulos()->find($asistente->id)->id) && Auth::user()->asistente->id!=$solicitud->solicitante->id && !isset($grupo_actual->encargados()->find(Auth::user()->asistente->id)->id))
				return App::abort(404);
		}
		return View::make('solicitud-traspaso.perfil')-> with(
			array(
			'solicitud' => $solicitud,
			'asistente' => $asistente,
			'grupo_actual' => $grupo_actual,
			'grupo_destino' => $grupo_destino,
		));
	}

	public function postResponderSolicitud($id, $estado, $cambio="sin-ministerio")
	{
		$solicitud=SolicitudTraspaso::find($id);
		if($solicitud->responde_id=="" || $solicitud->responde_id==NULL)
		{
			$asistente=$solicitud->asistente;

			if($estado==1)
			{
				if($asistente->cambiarGrupo($solicitud->grupo_destino, $cambio))
				{
					$solicitud->observacion_respuesta=Input::get('descripcion');
					$solicitud->estado=$estado;//1 significa aceptada
					if(Auth::user()->id==1)
						$solicitud->responde_id=0;
					else
						$solicitud->responde_id=Auth::user()->asistente->id;
					date_default_timezone_set('UTC');
					$fecha=date('Y-m-d');
					$solicitud->fecha_respuesta=$fecha;
					if($solicitud->save()){
						$descripcion_asistente="ha respondido una solicitud de traspaso";
						$descripcion_administrador="";
						$url="/solicitudes-traspaso/perfil/".$solicitud->id;
						Notificacion::notificarUsuario($solicitud->solicitante->user->id,2, "Respuesta de solicitud de traspaso", $descripcion_asistente, $descripcion_administrador, $url);
					}
				}
			}
			else
			{
				$solicitud->observacion_respuesta=Input::get('descripcion');
				$solicitud->estado=$estado;//1 significa aceptada
				if(Auth::user()->id==1)
					$solicitud->responde_id=0;
				else
					$solicitud->responde_id=Auth::user()->asistente->id;
				date_default_timezone_set('UTC');
				$fecha=date('Y-m-d');
				$solicitud->fecha_respuesta=$fecha;
				if($solicitud->save()){
					$descripcion_asistente="ha respondido una solicitud de traspaso";
					$descripcion_administrador="";
					$url="/solicitudes-traspaso/perfil/".$solicitud->id;
					Notificacion::notificarUsuario($solicitud->solicitante->user->id,2, "Respuesta de solicitud de traspaso", $descripcion_asistente, $descripcion_administrador, $url);
				}
			}
		}

		//return Redirect::to('users')->with('status', 'ok_update');
		return Redirect::to('/solicitudes-traspaso/perfil/'.$id);

	}


	////METODOS AJAX////////////////////////////////////////////
	public function postCrearSolicitudAjax($id_asistente, $grupo_destino, $grupo_actual)
	{
		$motivo=$_POST['motivo'];
		$descripcion=$_POST['descripcion'];
		$solicitud_traspaso=new SolicitudTraspaso;
		$solicitud_traspaso->asistente_id=$id_asistente;
		if(isset(Auth::user()->asistente->id))
			$solicitud_traspaso->solicita_id=Auth::user()->asistente->id;
		else
			$solicitud_traspaso->solicita_id=0;
		$solicitud_traspaso->grupo_destino=$grupo_destino;
		$solicitud_traspaso->grupo_actual=$grupo_actual;
		$solicitud_traspaso->motivo=$motivo;
		$solicitud_traspaso->descripcion=$descripcion;
		$solicitud_traspaso->asistente_id=$id_asistente;
		$solicitud_traspaso->estado=0;
		date_default_timezone_set('UTC');
		$fecha=date('Y-m-d');
		$solicitud_traspaso->fecha_solicitud=$fecha;
		if($solicitud_traspaso->save())
		{
			//se crea la notificacion
			$descripcion_asistente="ha solicitado el traspaso de uno de tus asistentes a otro grupo";
			$descripcion_administrador="ha solicitado el traspaso de un asistente a otro grupo";
			$url="/solicitudes-traspaso/perfil/".$solicitud_traspaso->id;
			Notificacion::notificarLideres($solicitud_traspaso->asistente_id,2, "Solicitud de Traspaso", $descripcion_asistente, $descripcion_administrador, $url);
			return "true";
		}
		else
			return "false";
	}

}