<?php
/** 
*
* @Redil Software. TutorialesController.php 
* @versión: 1.0.0  @modificado: 25 de Febrero del 2016 
* @autor última modificación: Juan Carlos Velasquez 
* 
*/
class TutorialesController extends BaseController
{
	public function __construct()
	{
		$this->beforeFilter('auth');  //bloqueo de acceso
	}

	//lsta de asistentes, como parametro envío el tipo de asistente $tipo
	public function getIndex()
	{

		
		return Redirect::to('tutoriales/categorias/todas');


	}

	public function getCategorias($categoria="todas")
	{
		$categorias= Tutorial::select('categoria')
								->groupBy('categoria')
								->get();
								
		if (isset($_GET["categoria"]))
		{
			if ($_GET["categoria"] != "todas" && $_GET["categoria"] !=""){

			$categoria= $_GET["categoria"];			
			$tutoriales= Tutorial::where('categoria', '=', $categoria)->get();
			
			}else		
			{	
				$categoria=$_GET["categoria"];
				$tutoriales= Tutorial::all();
			}

		}else		
		{
			$tutoriales= Tutorial::all();
		}
		return View::make('tutoriales.index')-> with(
			array(
				'tutoriales' => $tutoriales,
				'categorias' => $categorias,
				'seleccionada' => $categoria
			));

	}

}
?>