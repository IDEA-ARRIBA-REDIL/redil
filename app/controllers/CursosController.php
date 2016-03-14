<?php
/**
*
* @Redil Software. CursosController.php
* @versión: 1.0.0     @modificado: 06 de Septiembre del 2014
* @autor última modificación: Mairon Piedrahita 
* 
*/
class CursosController extends BaseController
{
	public function __construct()
	{
		
		$this->beforeFilter('auth');  //bloqueo de acceso
		
	}

	//lsta de escuelas, como parametro envío el tipo de asistente $tipo
	public function getIndex()
	{
		return Redirect::to('cursos/lista');
	}

	public function getLista()
	{
		//$departamentos = Departamento::all();
		return View::make('escuelas.cursos.index')/*->with('departamentos', $departamentos)*/;
	}

	public function getAnadirCursos($id)
	{
		$escuela= Escuela::find($id);
		if(!isset($escuela)) return App::abort(404);
		
		$escuela = Escuela::find($id);
        $cursos_escuela = $escuela->cursos()->get();

		return View::make('escuelas.cursos.anadir-cursos')->with(
			array(
				'escuela'=> $escuela,
				'cursos_escuela'=> $cursos_escuela,
			));
	}

	public function postNew($id)
	{
		$curso = new Curso;
		$curso->nombre=Input::get("nombre");
		$curso->descripcion = Input::get("descripcion");
		$curso->objetivos = Input::get("objetivos");
		$curso->escuela_id = $id;

		if(Input::get("requisitos") != "")
		$curso->requisitos = Input::get("requisitos");
		
		if(Input::get("radio")=="opcion1")
        $curso->obligatorio = true;
	    else
	    $curso->obligatorio = false;

		if(Input::get("paso_crecimiento_id") != "")
        $curso->paso_culminar_id = Input::get("paso_crecimiento_id");

        $curso->save();

        $escuela = Escuela::find($id);
        $cursos_escuela = $escuela->cursos()->get();
    
		return Redirect::to('/cursos/anadir-cursos/'.$id)->with(
			array(
				'status' => 'ok_new',
				'id_nuevo' => $curso->id,
				'nombre_nuevo' => $curso->nombre,
				'cursos_escuela'=> $cursos_escuela,
				)
		);
    }
}

?>