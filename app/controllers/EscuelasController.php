<?php
/** 
*
* @Redil Software. EscuelasController.php 
* @versión: 1.0.0     @modificado: 06 de Septiembre del 2014 
* @autor última modificación: Mairon Piedrahita
* 
*/
class EscuelasController extends BaseController
{
	public function __construct()
	{
		
		$this->beforeFilter('auth');  //bloqueo de acceso
		
	}

	//lsta de escuelas, como parametro envío el tipo de asistente $tipo
	public function getIndex()
	{
		return Redirect::to('escuelas/lista');
	}

	public function getLista()
	{
		//$departamentos = Departamento::all();
		return View::make('escuelas.index')/*->with('departamentos', $departamentos)*/;
	}

	public function getNuevo()
	{
		//$grupos= Grupo::where('dado_baja', '!=', '1')->get();
		return View::make('escuelas.nuevo')/*->with(
			array(
				'grupos' => $grupos,
				'pasos' => $pasos,
		))*/;
	}

	public function postNew()
	{
		$escuela = new Escuela;
		$escuela->nombre=Input::get("nombre");
		$escuela->descripcion = Input::get("descripcion");
		if(Input::get("director_id") != ""){
        $escuela->director_id = Input::get("director_id");
		}
		$escuela->save();

		////se notifica el super usuario que es el user 1
		if(Auth::user()->id!=1)
		{
			$descripcion_asistente="ha creado una nueva escuela";
			$descripcion_administrador="";
			$url="/escuelas/perfil/$escuela->id";
			Notificacion::notificarUsuario(1,2, "Nueva Escuela", $descripcion_asistente, $descripcion_administrador, $url);
		}

		//////////fin notificaciones

		return Redirect::to('/escuelas/actualizar/'.$escuela->id)->with(
			array(
				'status' => 'ok_new',
				'id_nuevo' => $escuela->id,
				'descripcion_nueva' => $escuela->descripcion,
				)
		);
    }

    public function getActualizar($id)
	{
		$escuela = Escuela::find($id);
		if(!isset($escuela)) return App::abort(404);
		
		return View::make('escuelas.actualizar')->with(
			array(
				'escuela'=> $escuela,
			));
	}

    public function postUpdate($id)
	{
		$escuela = Escuela::find($id);
		if(!isset($escuela)) return App::abort(404);

		$escuela->nombre=Input::get("nombre");
		$escuela->descripcion = Input::get("descripcion");
		if(Input::get("director_id") == ""){
        $escuela->director_id = null;
		}
		else{
        $escuela->director_id = Input::get("director_id");
		}
		$escuela->save();

		return Redirect::to('/escuelas/actualizar/'.$id)->with(
			array(
				'status' => 'ok_update',
				 ));
	}

	///////////////////////AJAX

}

?>