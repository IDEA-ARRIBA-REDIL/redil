<?php
/** 
*
* @Redil Software. AsistenteController.php 
* @versión: 1.0.0     @modificado: 24 de Julio del 2014 
*ultima mofificacion 03:19 pm
* @autor última modificación: Darwin Castaño
* 
*/
class 	DepartamentosController extends BaseController
{
	public function __construct()
	{
		
		$this->beforeFilter('auth');  //bloqueo de acceso
		
	}

	public function getIndex()
	{
		return Redirect::to('departamentos/lista');
		

	}
	
	public function getLista()
	{
		
		$departamentos = Departamento::all();
		return View::make('departamentos.index')->with('departamentos', $departamentos);
	}

	public function getPerfil($id)
	{
		$departamentos= Departamento::find($id);

		return View::make('departamentos.perfil')->with(
			array(
				'departamentos' => $departamentos,
				 
				));
	}


	
public function postAjax($id_encargado)
	{
		$asistente_seleccionado=Asistente::find($id_encargado);  
		
		  $tr= '<tr>';
		  $tr.= '<td>'.$asistente_seleccionado['id'].'</td>';
		  $tr.= '<td>'.$asistente_seleccionado['nombre'].' '.$asistente_seleccionado['apellido'].'</td>';
		  $tr.= " <td class='text-center'>
                      <a style='display:none' id='borrar_director' class='borrar-fila  btn btn-danger btn-sm' > <b>X</b> </a>
                </td>";
		  $tr.= '</tr>';

		 
		return $tr;
	}

	public function getNuevo ()
	{
		
		$asistentes_lista_encargados= Asistente::whereRaw("dado_baja= ? and tipo_asistente_id > ?", array(0, 3))->get();
		//$asistentes_lista_integrantes=Asistente::where("dado_baja", "=","0")->get();
		$asistentes_lista_integrantes=Asistente::all();

		return  View::make('departamentos.nuevo')->with(
		array(
			  'asistentes_lista_encargados'=>$asistentes_lista_encargados,
			  'asistentes_lista_integrantes'=>$asistentes_lista_integrantes,
			));
	}




	public function postNew ()
	{
		$departamento= new Departamento;
		$departamento->nombre= Input::get ('nombre');
		$departamento->descripcion= Input::get ('descripcion');
		$departamento->rhema= Input::get ('rhema');
		if(Input::get('fecha_creacion')!="")
		$departamento->fecha_creacion=Input::get('fecha_creacion');

		$departamento->save();

		//// voy a guardar los integrantes del departamento

		$json_ids=Input::get('integrantes_id');
		$datos_ids=(json_decode($json_ids));

		$json_cargos=Input::get('integrantes_cargo');
		$datos_cargo=(json_decode($json_cargos));

		$json_funciones=Input::get('integrantes_funciones');
		$datos_funciones=(json_decode($json_funciones));

		
		for ($i=0; $i < count($datos_ids); $i++) 	
		{
			$departamento->integrantes()->attach($datos_ids[$i], array("cargo"=>$datos_cargo[$i],"funcion"=>$datos_funciones[$i]));
		
		}
      	// guardado director y sus funciones
 		if(Input::get('encargados_ids')!=""){
		$string_ids_directores=Input::get('encargados_ids');

		$datos_ids_encargados= explode(',', $string_ids_directores);
		$funciones_director=Input::get('funciones_director');
		for ($j=0; $j < count($datos_ids_encargados) ; $j++) 
		 {
		 	
		 	$departamento->encargados()->attach($datos_ids_encargados[$j], array("funcion"=>$funciones_director));
		
		}


			};
		 
		//return Redirect::to('users')->with('status', 'ok_update');
		return Redirect::to('departamentos/nuevo')->with (array(
			'status'  => 'ok_update',
			'julio'=> $datos_ids,
			'departamento'=>$departamento->nombre
				)
			);

		
		
		

	}


	public function getActualizar($id)
	{
		$departamentos= Departamento::find($id);
		$asistentes_lista_encargados= Asistente::whereRaw("dado_baja = ? and tipo_asistente_id > ?", array(0, 3))->get();
		//$asistentes_lista_integrantes= Asistente::where("dado_baja", "=","0")->get();
		$asistentes_lista_integrantes=Asistente::all();


		return View::make('departamentos.actualizar')->with(
			array(
				'departamentos' => $departamentos,
				 'asistentes_lista_encargados'=>$asistentes_lista_encargados,
			  'asistentes_lista_integrantes'=>$asistentes_lista_integrantes,
				));
	}

	public function postUpdate($id)
	{
		$departamento= Departamento::find($id);
		$departamento->nombre= Input::get('nombre');
		$departamento->descripcion= Input::get('descripcion');
		$departamento->rhema= Input::get('rhema');
		$departamento->fecha_creacion= Input::get('fecha_creacion');
		
		
		$departamento->save();


		$encargados=$departamento->encargados()->get();

		foreach ($encargados as $encargado )
		 {
			$encargado->pivot->funcion=Input::get('funcion_director');


		}

		//return Redirect::to('users')->with('status', 'ok_update');

		// empieza guardado de nuevos integrantes, con sus funciones y sus cargos en departamento

		$json_ids=Input::get('integrantes_anadidos_ids');
		$datos_ids=(json_decode($json_ids));

		$json_cargos=Input::get('integrantes_cargo_anadidos');
		$datos_cargo=(json_decode($json_cargos));

		$json_funciones=Input::get('integrantes_funciones_anadidos');
		$datos_funciones=(json_decode($json_funciones));

		if(Input::get('integrantes_anadidos_ids')!="" && Input::get('integrantes_anadidos_ids')!="[]")
		{	
				for ($i=0; $i < count($datos_ids); $i++) 	
			{
				$departamento->integrantes()->attach($datos_ids[$i], array("cargo"=>$datos_cargo[$i],"funcion"=>$datos_funciones[$i]));
			
			}

		}
		//// guaradado de nuevos encargados de departamento
		if(Input::get('encargados_anadidos_ids')!="" && Input::get('encargados_anadidos_ids')!="[]" )
		{
			$string_ids_directores=Input::get('encargados_anadidos_ids');

			$datos_ids_encargados= explode(',', $string_ids_directores);
			$funciones_director=Input::get('funciones_director');
			for ($j=0; $j < count($datos_ids_encargados) ; $j++) 
			 {
			 	
			 	$departamento->encargados()->attach($datos_ids_encargados[$j], array("funcion"=>$funciones_director));
			
			}	

		}
		//// eliminar a los encargados de un departamento
		
		if (Input::get('encargados_eliminados_ids')!="" )
		{
			$encargados_a_eliminar=explode(",",Input::get('encargados_eliminados_ids'));
				for ($j=0; $j < count($encargados_a_eliminar) ; $j++) 
			 	{
			 	
			 		$departamento->encargados()->detach($encargados_a_eliminar[$j]);
			
				}	

		}

		//fin de eliminar los	encargados de un departamento


		//eliminar los integrantes de un departamento

			if (Input::get('integrantes_eliminados_ids')!="")
			{
				$string_integrantes_eliminados=Input::get('integrantes_eliminados_ids');
				$datos_integrantes_eliminados=explode(',', $string_integrantes_eliminados);

					for ($j=0; $j < count($datos_integrantes_eliminados) ; $j++) 
				 	{
				 	
				 		$departamento->integrantes()->detach($datos_integrantes_eliminados[$j]);
				
					}	

			}




			return Redirect::to('/departamentos/actualizar/'.$id)->with('status', 'ok_update');
	

	}


}