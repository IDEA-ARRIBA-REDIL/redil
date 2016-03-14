<?php
/** 
*
* @Redil Software. IglesiasController.php” 
* @versión: 1.0.0     @modificado: 11 de Julio del 2014 
* @autor última modificación: Mairon Piedrahita 
* 
*/
class IglesiasController extends BaseController
{
	
	public function __construct()
	{
		
		$this->beforeFilter('auth');  //bloqueo de acceso
		
	}
	

	public function getIndex()
	{
		$iglesia = Iglesia::find(1);

		$pastores=Asistente::where('tipo_asistente_id', '=', '5')->get();
		$pastores_principales= $iglesia->pastoresEncargados()->get();
		

		return View::make('iglesias.index')-> with(array(
	
				 'iglesia'=> $iglesia,
				  'pastores'=>$pastores,
				  'pastores_principales'=>$pastores_principales,
				 
		
			));

		
		
	}

	public function postUpdate() 
	{
		$iglesia = Iglesia::find(1);
		$iglesia->nombre = Input::get('nombre');
		$iglesia->direccion = Input::get('direccion');
		$iglesia->ciudad = Input::get('ciudad');
		if (Input::get('fecha')!="")
		{
			$date = new DateTime(str_replace("/","-",Input::get('fecha')));
			$fecha = $date->format('Y-m-d');
			$iglesia->fecha_apertura = $fecha;
		}
		$iglesia->telefono1 = preg_replace("/[^0-9]/", "", Input::get('telefono1'));
		$iglesia->telefono2 = preg_replace("/[^0-9]/", "", Input::get('telefono2')); 
		$iglesia->departamento = Input::get('departamento');
		$iglesia->pais = Input::get('pais');
		$iglesia->rhema = Input::get('rhema');
		$iglesia->texto_rhema = Input::get('texto-rhema');
		$iglesia->metas = Input::get('metas');

		if (Input::get('pastores_eliminados_id')!="")
		{
			$pastores_eliminados=explode(",",Input::get('pastores_eliminados_id'));
			for ($i=0; $i < count($pastores_eliminados); $i++) 
			{
					$iglesia->pastoresEncargados()->detach($pastores_eliminados[$i]);
			}
		}
		

		if (Input::get('pastores_actualizados_id')!="")
		{
			$pastores_actualizados=explode(",",Input::get('pastores_actualizados_id'));
			for ($i=0; $i < count($pastores_actualizados); $i++) 
			{
					$iglesia->pastoresEncargados()->attach($pastores_actualizados[$i]);
			}
		}


		if($iglesia->save() && Input::get('foto-hide')!="")
		{
			$id="new-".Auth::user()->id;
			$img= Image::make("img/temp/imagen-temp-mini-".$id.".jpg");
			$img->resize(215, 215);
			$img->save("img/iglesia/logo-iglesia-".$iglesia->id.".jpg");
			$iglesia->logo="logo-iglesia-".$iglesia->id.".jpg";
			$iglesia->save();
			////borramos la imagen mini de la carpeta temporal
			unlink("img/temp/imagen-temp-mini-".$id.".jpg");
	        

		}

		//// aqui le asigno al grupo principal los nuevos plideres de grupo o los verifico

		$grupo=Grupo::find(1);

		if (Input::get('pastores_actualizados_id')!="")
		{
			$pastores_actualizados=explode(",",Input::get('pastores_actualizados_id'));
			for ($i=0; $i < count($pastores_actualizados); $i++) 
			{
					$grupo->encargados()->attach($pastores_actualizados[$i]);
			}
		};

		if (Input::get('pastores_eliminados_id')!="")
		{
			$pastores_eliminados=explode(",",Input::get('pastores_eliminados_id'));
			for ($i=0; $i < count($pastores_eliminados); $i++) 
			{
					$grupo->encargados()->detach($pastores_eliminados[$i]);
			}
		};
		
		
		
		
		
		//return Redirect::to('users')->with('status', 'ok_update');
		return Redirect::to('iglesia');
	}
}





?>