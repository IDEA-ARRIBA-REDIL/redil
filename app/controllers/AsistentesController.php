<?php
/** 
*
* @Redil Software. AsistenteController.php 
* @versión: 1.0.0  @modificado: 10 de Julio del 2014 
* @autor última modificación: Mairon Piedrahita 
* 
*/
class AsistentesController extends BaseController
{
	public function __construct()
	{
		$this->beforeFilter('auth');  //bloqueo de acceso
	}

	//lsta de asistentes, como parametro envío el tipo de asistente $tipo
	public function getIndex()
	{
		return Redirect::to('asistentes/lista/todos');


	}


	public function getLista($tipo="todos")
	{
		$buscar=null;
		$cantidad_busqueda=null;
		// Obtenemos los registros que aparecen sin grupo
		$iglesia= Iglesia::find(1);
		//Asistente::definirInactivosGrupo();
		$pastores_principales=$iglesia->pastoresEncargados()->get(array('asistentes.id'));
		$array_pastores_principal= Helper::obtenerArrayIds($pastores_principales);
		$cantidad_sin_linea = Asistente::where('asistentes.linea_id','=', null)->whereNotIn('asistentes.id', $array_pastores_principal)->count();
		$cantidad_sin_grupo = Asistente::where('asistentes.grupo_id','=', null)->whereNotIn('asistentes.id', $array_pastores_principal);

		/// clasificamos los registros por tipo de asistente
		if($tipo=="nuevos")
		{
			$asistentes_ids_fin= Asistente::where('asistentes.tipo_asistente_id', '=', '1');					
		}
		else if($tipo=="ovejas")
		{
			$asistentes_ids_fin= Asistente::where('asistentes.tipo_asistente_id', '=', '2');
		}
		else if($tipo=="miembros")
		{
			$asistentes_ids_fin= Asistente::where('asistentes.tipo_asistente_id', '=', '3');
		}
		else if($tipo=="lideres")
		{
			$asistentes_ids_fin= Asistente::where('asistentes.tipo_asistente_id', '=', '4');

		}
		else if($tipo=="pastores")
		{
			$asistentes_ids_fin= Asistente::where('asistentes.tipo_asistente_id', '=', '5');
		}
		else if($tipo=="sin-actividad-grupo")
		{
			$asistentes_ids_fin= Asistente::whereRaw('(asistentes.inactivo_grupo = TRUE)')
			->distinct();
		}
		else if($tipo=="sin-actividad-culto")
		{
			$asistentes_ids_fin= Asistente::whereRaw('(asistentes.inactivo_iglesia = TRUE)')
			->distinct();
		}
		else if($tipo=="sin-actividad-iglesia")
		{
			$asistentes_ids_fin= Asistente::whereRaw('(asistentes.inactivo_iglesia = TRUE and asistentes.inactivo_grupo = TRUE)')
			->distinct();
		}
		else if($tipo=="dados-de-baja")
		{
			$asistentes_ids_fin= Asistente::onlyTrashed();
		}
		else if($tipo=="sin-grupo")
		{
				$asistentes_ids_fin= Asistente::where('asistentes.grupo_id','=', null)
				->whereNotIn('asistentes.id', $array_pastores_principal );						
		}
		else if($tipo=="sin-linea")
		{
				$asistentes_ids_fin= Asistente::where('asistentes.linea_id','=', null)
				->whereNotIn('asistentes.id', $array_pastores_principal );						
		}
		else
		{
			$asistentes_ids_fin=Asistente::whereRaw("(1=1)");
			$tipo="todos"; 
		}

		//si el usuario es diferente al super admin entonces se filtran solo sus discipulos
		if(Auth::user()->id!=1)
		{	
			$discipulos_id=Auth::user()->asistente->discipulos("array");
			if(!isset(Auth::user()->asistente->iglesiaEncargada()->first()->id)){
				if(isset(Auth::user()->asistente->linea->id))
					$cantidad_sin_grupo=$cantidad_sin_grupo->where('asistentes.linea_id', Auth::user()->asistente->linea->id);
				else
					$cantidad_sin_grupo=$cantidad_sin_grupo->whereRaw("1=2");
				if($tipo=="sin-grupo")
					$asistentes_ids_fin=$cantidad_sin_grupo;
				else if($tipo!="sin-linea")
				$asistentes_ids_fin=$asistentes_ids_fin->whereIn('asistentes.id', $discipulos_id);
			}
			
			if($tipo=="dados-de-baja")
				$asistentes_ids_fin=Auth::user()->asistente->discipulos("objeto", "solo-eliminados");
		}

		///Obtenemos la cantidad de asistentes de cada tipo 
		if(Auth::user()->id==1) //si el logueado es el super admin
		{			
			
			$cantidad_todos = Asistente::all()->count();
			$cantidad_nuevos = Asistente::where('tipo_asistente_id', '=', '1')->count();
			$cantidad_ovejas = Asistente::where('tipo_asistente_id', '=', '2')->count();
			$cantidad_miembros = Asistente::where('tipo_asistente_id', '=', '3')->count();
			$cantidad_lideres = Asistente::where('tipo_asistente_id', '=', '4')->count();
			$cantidad_pastores = Asistente::where('tipo_asistente_id', '=', '5')->count();
			$cantidad_sin_actividad_culto = Asistente::whereRaw('(inactivo_iglesia = TRUE)')->count();
			$cantidad_sin_actividad_grupo = Asistente::whereRaw('(inactivo_grupo = TRUE)')->count();
			$cantidad_sin_actividad_total = Asistente::whereRaw('(inactivo_grupo = TRUE AND inactivo_iglesia = TRUE)')->count();
			$cantidad_dados_baja = Asistente::onlyTrashed()->count();
			$cantidad_sin_grupo = $cantidad_sin_grupo->count(); //esta variable esta al principio del metodo

		}
		else ///si es un usuario diferente
		{
			$cantidad_todos = Asistente::whereIn('asistentes.id', $discipulos_id)->count();
			$cantidad_nuevos = Asistente::whereIn('asistentes.id', $discipulos_id)->where('tipo_asistente_id', '=', '1')->count();
			$cantidad_ovejas = Asistente::whereIn('asistentes.id', $discipulos_id)->where('tipo_asistente_id', '=', '2')->count();
			$cantidad_miembros = Asistente::whereIn('asistentes.id', $discipulos_id)->where('tipo_asistente_id', '=', '3')->count();
			$cantidad_lideres = Asistente::whereIn('asistentes.id', $discipulos_id)->where('tipo_asistente_id', '=', '4')->count();
			$cantidad_pastores = Asistente::whereIn('asistentes.id', $discipulos_id)->where('tipo_asistente_id', '=', '5')->count();
			$cantidad_sin_actividad_culto = Asistente::whereIn('asistentes.id', $discipulos_id)->whereRaw('(inactivo_iglesia = TRUE)')->count();
			$cantidad_sin_actividad_grupo = Asistente::whereIn('asistentes.id', $discipulos_id)->whereRaw('(inactivo_grupo = TRUE)')->count();
			$cantidad_sin_actividad_total = Asistente::whereIn('asistentes.id', $discipulos_id)->whereRaw('(inactivo_grupo = TRUE AND inactivo_iglesia = TRUE)')->count();
			$cantidad_dados_baja = Auth::user()->asistente->discipulos("objeto", "solo-eliminados")->count();
			//if(isset(Auth::user()->asistente->iglesiaEncargada()->first()->id))
				$cantidad_sin_grupo = $cantidad_sin_grupo->count(); //esta variable esta al principio del metodo
			//else
			//	$cantidad_sin_grupo = $cantidad_sin_grupo->whereIn('linea_id', Auth::user()->asistente->linea->id)->count();
		}
		
		///si el usuario ejecuto una busqueda se añaden las consultas necesarias
		if (isset($_GET["buscar"]))
		{    
			$buscar= htmlspecialchars(Input::get('buscar'));
			$buscar_array=explode(" ", $buscar);
			Global $sql_buscar;
			$c=0;
			foreach($buscar_array as $palabra)
			{
				if($c!=0)
					$sql_buscar.=" AND ";
				//$sql_buscar.="asistente.nombre ILIKE '%$palabra%' OR asistente.apellido ILIKE '%$palabra%' OR asistente.identificacion ILIKE '%$palabra%' ";
				$sql_buscar.="(asistentes.nombre ILIKE '%$palabra%' OR asistentes.apellido ILIKE '%$palabra%' OR encargado.nombre ILIKE '%$palabra%' OR encargado.apellido ILIKE '%$palabra%' OR grupos.nombre ILIKE '%$palabra%' OR asistentes.direccion ILIKE '%$palabra%'";
				if(ctype_digit($palabra))
					$sql_buscar.=" OR asistentes.id=$palabra";
				$sql_buscar.=")";
				$c++;
			}

			//se hacen los respectivas uniones para ejecutar la busqueda y se añade el sql de la busqueda
			$asistentes_ids_fin= $asistentes_ids_fin->leftJoin('grupos', 'asistentes.grupo_id', '=', 'grupos.id')
			->leftJoin('encargados_grupo', 'grupos.id', '=', 'encargados_grupo.grupo_id')
			->leftJoin('asistentes AS encargado', 'encargado.id', '=', 'encargados_grupo.asistente_id')
			->where(function($query)
			{
            	$sql_buscar_l=$GLOBALS['sql_buscar']; /// sql_buscar_l local
                $query->whereRaw($sql_buscar_l);
            });
			///se obtienen los registros y se convierten en array
			$asistentes_ids_fin=$asistentes_ids_fin->get(array('asistentes.id'));
			$asistentes_ids_fin=Helper::obtenerArrayIds($asistentes_ids_fin);

			//se obtiene la cantidad de registros que arrojó la busqueda
			$cantidad_busqueda= Asistente::whereIn('asistentes.id', $asistentes_ids_fin)->count();
		}
		else{ //si no hay busqueda simplemente se obtienen los registros
			$asistentes_ids_fin=$asistentes_ids_fin->get(array('asistentes.id'));
			$asistentes_ids_fin=Helper::obtenerArrayIds($asistentes_ids_fin);
		}

		//se obtienes los registros ordenados y por paginas
		if($tipo!="dados-de-baja")
		{
			$asistentes=Asistente::whereIn('asistentes.id', $asistentes_ids_fin)
						->orderBy('id', 'asc')
						->paginate(10);
		}
		else{
			$asistentes=Asistente::onlyTrashed()
						->whereIn('asistentes.id', $asistentes_ids_fin)
						->orderBy('id', 'asc')
						->paginate(10);
		}

		return View::make('asistentes.index')-> with(
			array(
			'asistentes' => $asistentes, 
			'tipo' => $tipo,
			'cantidad_todos' => $cantidad_todos,
			'cantidad_nuevos' => $cantidad_nuevos,
			'cantidad_ovejas' => $cantidad_ovejas,
			'cantidad_miembros' => $cantidad_miembros,
			'cantidad_lideres' => $cantidad_lideres,
			'cantidad_pastores' => $cantidad_pastores,
			'cantidad_sin_actividad_grupo' => $cantidad_sin_actividad_grupo,
			'cantidad_sin_actividad_culto' => $cantidad_sin_actividad_culto,
			'cantidad_sin_actividad_total' => $cantidad_sin_actividad_total,
			'cantidad_dados_baja' => $cantidad_dados_baja,
			'cantidad_sin_grupo' => $cantidad_sin_grupo,
			'cantidad_sin_linea' => $cantidad_sin_linea,
			'buscar' => $buscar,
			'cantidad_busqueda' => $cantidad_busqueda,
		));
	}


	public function getNuevo()
	{
		
		$pasos= PasoCrecimiento::orderBy('id', 'asc')->get();

		return View::make('asistentes.nuevo')->with(
			array(
				'pasos' => $pasos,
		));
	}

	//peticion ajax para cargar los lideres de una celula en una tabla del formulario
	public function postAjax($id_grupo)
	{
		$grupo_seleccionado=Grupo::find($id_grupo);  
		$tbody='<tbody>';
		foreach($grupo_seleccionado->encargados as $encargado) 
		{  
		  $tbody.= '<tr>';
		  $tbody.= '<td>'.$encargado['id'].'</td>';
		  $tbody.= '<td>'.$encargado['nombre'].' '.$encargado['apellido'].'</td>';
		  $tbody.= '</tr>';
		}
		$tbody.= '</tbody>';
		return $tbody;
	}

	public function getPerfil($id)
	{
		$asistente = Asistente::withTrashed()->find($id);
		if(!isset($asistente)) return App::abort(404);

		return View::make('asistentes.perfil')->with(
			array(
				'asistente' => $asistente,
		));;
	}

	public function getActualizar($id)
	{
		$asistente = Asistente::find($id);
		if(!isset($asistente)) return App::abort(404);

		if(Auth::user()->id!=1)
		{
			if((!isset(Auth::user()->asistente->discipulos()->find($id)->id) && Auth::user()->asistente->id!=$asistente->id))
			{
				return App::abort(404);
			}
		}

		$pasos= PasoCrecimiento::orderBy('id', 'asc')->get();
	
		$data['imagem']=Session::get('img');
		return View::make('asistentes.actualizar', compact('data'))->with(
			array(
				'asistente' => $asistente,
				'pasos' => $pasos,
		));
	}

	public function postNew()
	{
		$asistente = new Asistente;
        // Revisamos si la data es válido
        //if ($asistente->isValid($data))
        //{
			$asistente->nombre = strtolower(Input::get('nombre'));
			$asistente->apellido = strtolower(Input::get('apellido'));
			$asistente->genero = Input::get('genero');
			$asistente->estado_civil = Input::get('estado_civil');
			$asistente->tipo_identificacion = Input::get('tipo_identificacion');
			$asistente->identificacion = Input::get('identificacion');
			$asistente->nacionalidad = Input::get('nacionalidad');
			if (Input::get('fecha_nacimiento')!="")
			{
				$date = new DateTime(str_replace("/","-",Input::get('fecha_nacimiento')));
				$fecha = $date->format('Y-m-d');
				$asistente->fecha_nacimiento = $fecha;
			}
			if(Input::get('fecha_ingreso')!="")
			{
				$date = new DateTime(str_replace("/","-",Input::get('fecha_ingreso')));
				$fecha = $date->format('Y-m-d');
				$asistente->fecha_ingreso = $fecha;
			}

			$asistente->telefono_fijo = preg_replace("/[^0-9]/", "", Input::get('telefono_fijo'));
			$asistente->telefono_movil = preg_replace("/[^0-9]/", "", Input::get('telefono_movil'));
			$asistente->telefono_otro = Input::get('telefono_otro');
			$asistente->direccion = Input::get('direccion');
			$asistente->tipo_sangre = Input::get('tipo_sangre');
			$asistente->indicaciones_medicas = Input::get('indicaciones_medicas');
			$asistente->limitaciones = Input::get('limitaciones');
			$asistente->tipo_asistente_id = Input::get('tipo_asistente_id');
			$asistente->inactivo_iglesia = 1;
			$asistente->inactivo_grupo = 1;
			$asistente->foto="";

			if(Input::get('linea_id')!="")
				$asistente->linea_id=Input::get('linea_id');

			if(Input::get('grupo_id')!="")
				$asistente->grupo_id = Input::get('grupo_id');

			if($asistente->save())
			{
				if(Input::get('foto-hide')!="")
				{
					$id="new-".Auth::user()->id;
					$img= Image::make("img/temp/imagen-temp-mini-".$id.".jpg");
					$img->resize(215, 215);
					$img->save("img/fotos/asistente-".$asistente->id.".jpg");
					////borramos la imagen mini de la carpeta temporal
					unlink("img/temp/imagen-temp-mini-".$id.".jpg");
					$asistente->foto = "asistente-".$asistente->id.".jpg";
					$asistente->save();
				}
				else
				{
					if(Input::get('genero')=="0")
						$asistente->foto = "default-m.png";
					else
						$asistente->foto = "default-f.png";
					$asistente->save();
				}
		        
			}

			/////// --- Se crean los pasos culminados por el asistente ---///////////////////////
			if(Input::get("pasos")!="")
			{
				$pasos= explode(",",Input::get("pasos"));
				for ($i=0; $i < count($pasos); $i++) {
					$asistente->pasosCrecimiento()->attach($pasos[$i]);
				}
			}

			$user= new User;
			$user->email =Input::get('email');
	        $user->privilegios = '4';
	        $user->password = Hash::make("123456");
	        $user->asistente_id = $asistente->id; 
	        $user->activo=0;
	        $user->save();

	        $descripcion_asistente="creó un asistente dentro de tu ministerio";
			$descripcion_administrador="creó un asistente en uno de sus grupos";
			$url="/asistentes/perfil/$asistente->id";
			Notificacion::notificarLideres($asistente->id,2, "Nuevo Asistente", $descripcion_asistente, $descripcion_administrador, $url);
			
			//return Redirect::to('users')->with('status', 'ok_update');
			return Redirect::to('/asistentes/nuevo')->with(
				array(
					'status' => 'ok_new',
					'id_nuevo' => $asistente->id,
					'nombre_nuevo' => $asistente->nombre,
					'apellido_nuevo' => $asistente->apellido
					)
			);
		/*}
		else
		{
			//return Redirect::to('users')->with('status', 'ok_update');
			return Redirect::to('/asistentes/nuevo')->with(
				array(
					'status' => 'asistente_existe',
					'nombre_nuevo' => $asistente->nombre,
					'apellido_nuevo' => $asistente->apellido
					)
			);
		}*/
	}

	public function postUpdate($id)
	{
		$asistente = Asistente::find($id);
		if(!isset($asistente)) return App::abort(404);
		$asistente->nombre = strtolower(Input::get('nombre'));
		$asistente->apellido = strtolower(Input::get('apellido'));
		$asistente->genero = Input::get('genero');
		$asistente->estado_civil = Input::get('estado_civil');
		$asistente->tipo_identificacion = Input::get('tipo_identificacion');
		$asistente->identificacion = Input::get('identificacion');
		$asistente->nacionalidad = Input::get('nacionalidad');		
		if (Input::get('fecha_nacimiento')!="")
		{
			$date = new DateTime(str_replace("/","-",Input::get('fecha_nacimiento')));
			$fecha = $date->format('Y-m-d');
			$asistente->fecha_nacimiento = $fecha;
		}
		if(Input::get('fecha_ingreso')!="")
		{
			$date = new DateTime(str_replace("/","-",Input::get('fecha_ingreso')));
			$fecha = $date->format('Y-m-d');
			$asistente->fecha_ingreso = $fecha;
		}

		$asistente->telefono_fijo = preg_replace("/[^0-9]/", "", Input::get('telefono_fijo'));
		$asistente->telefono_movil = preg_replace("/[^0-9]/", "", Input::get('telefono_movil'));
		$asistente->telefono_otro = Input::get('telefono_otro');

		$asistente->user->email = Input::get('email');
		$asistente->user->save();
		$asistente->direccion = Input::get('direccion');
		$asistente->tipo_sangre = Input::get('tipo_sangre');
		$asistente->indicaciones_medicas = Input::get('indicaciones_medicas');
		$asistente->limitaciones = Input::get('limitaciones');
		$asistente->tipo_asistente_id = Input::get('tipo_asistente_id');
		if(Input::get('grupo_id')=="" && $asistente->linea!=Input::get('linea_id'))
		{
			if(Input::get('linea_id')=="")
				$asistente->cambiarLinea("", "con-ministerio");
			else
			$asistente->cambiarLinea(Input::get('linea_id'), "con-ministerio");
		}
			
			
		if(Input::get('grupo_id')!="")
		{
			if($asistente->grupo_id!=Input::get('grupo_id'))
			{
				$asistente->cambiarGrupo(Input::get('grupo_id'),'con-ministerio');
			}
		}
		else{
			$asistente->grupo_id = null;
		}
		
		
		if($asistente->save()  && Input::get('foto-hide')!="")
		{
			
				$img= Image::make("img/temp/imagen-temp-mini-".$id.".jpg");
				$img->resize(215, 215);
				$img->save("img/fotos/asistente-".$id.".jpg");
				////borramos la imagen mini de la carpeta temporal
				unlink("img/temp/imagen-temp-mini-".$id.".jpg");
				$asistente->foto = "asistente-".$asistente->id.".jpg";
				$asistente->save();
	        

		}

		/////// --- Se crean los pasos anadidos al asistente ---///////////////////////
		if(Input::get("pasos_anadidos")!="")
		{
			$pasos= explode(",",Input::get("pasos_anadidos"));
			for ($i=0; $i < count($pasos); $i++) {
				$asistente->pasosCrecimiento()->attach($pasos[$i]);
			}
		}

		/////// --- Se eliminan los pasos quitados al asistente ---///////////////////////
		if(Input::get("pasos_eliminados")!="")
		{
			$pasos= explode(",",Input::get("pasos_eliminados"));
			for ($i=0; $i < count($pasos); $i++) {
				$asistente->pasosCrecimiento()->detach($pasos[$i]);
			}
		}

		//return Redirect::to('users')->with('status', 'ok_update');
		return Redirect::to('/asistentes/actualizar/'.$id)->with('status', 'ok_update');
	}

	public function getEstadisticas()
	{
		return View::make('asistentes.estadisticas')->with(
			array(
			)
		);
	}

	
	// funcion que carga los datos y llama la vista para dar de ALTA a un asistente
	public function getDadoAlta($id)
	{
		$asistente = Asistente::onlyTrashed()->find($id);		
		return View::make('asistentes.dado-alta')->with(
			array(
				'asistente' => $asistente,
			)
		);
	}

	// funcion que permite darle de ALTA al asistente
	public function postDarDeAlta($id)
	{
		$asistente = Asistente::onlyTrashed()->find($id);
		
		// Esto es para guardar el reporte de dado (baja/alta)
		$reporte = new ReporteBajaAlta;
		$reporte->motivo= Input::get('motivo');
		$reporte->observaciones= Input::get('observaciones'); 
		$reporte->asistente_id= $id;
		// ---------- Fecha -------------
		$date = new DateTime(); // obtiene la fecha del sistema
		$fecha = $date->format('Y-m-d'); // le doy formato a la fecha obtenida
		$reporte->fecha= $fecha; 
		$reporte->dado_baja= 0; 
		// ---------- Fecha -------------
		$reporte->save();


		//$asistente->dado_baja= 0;
		$asistente->restore(); // restaura al asistente de el softDelete
		$asistente->tipo_asistente_id= Input::get('tipo_asistente_id'); 		
	
		$asistente->save();

		return Redirect::to('/asistentes/actualizar/'.$id)->with(
			array(
				'mensaje'=> 'de_alta',
				'nombre_dado_baja' => $asistente->nombre,
				'apellido_dado_baja' => $asistente->apellido
				)
		);
	}

	// funcion que carga los datos y llama la vista para dar de BAJA a un asistente
	public function getDadoBaja($id)
	{
		$asistente = Asistente::find($id);
		$lineas= $asistente->lineas()->count();
		$grupos_directos= $asistente->grupos()->count();
		$grupos_indirectos= 0;
		if ($grupos_directos > 0 )
		{
			$grupos_indirectos= $asistente->gruposMinisterio()->count();
			$grupos_indirectos= $grupos_indirectos - $grupos_directos;
		} 
		
		return View::make('asistentes.dado-baja')->with(
			array(
				'asistente' => $asistente,
				'lineas' => $lineas,
				'grupos_directos' => $grupos_directos,
				'grupos_indirectos' => $grupos_indirectos,
			)
		);

	}

	// Esta funcion permite darle de BAJA al usuario. 
	public function postDarDeBaja($id)
	{
		$asistente = Asistente::find($id);
		$lineas= $asistente->lineas()->get();
		$grupos= $asistente->grupos()->get();

		if ($lineas->count() > 0)
		{
			// Desvincula al asistente de la linea a la que esta encartado. 
			foreach ($lineas as $linea) {
				$linea->encargados()->detach($id);
			}
		}
		
		if ($grupos->count() > 0)
		{
			// Desvincula al asistente de los grupos a la que esta encartado. 
			foreach ($grupos as $grupo) {
				$grupo->encargados()->detach($id);
			}
		}
		
		// Esto es para guardar el reporte de dado (baja/alta)
		$reporte = new ReporteBajaAlta;
		$reporte->motivo= Input::get('motivo');
		$reporte->observaciones= Input::get('observaciones');
		$reporte->asistente_id= $id;

		// ---------- Fecha -------------
		$date = new DateTime(); // obtiene la fecha del sistema
		$fecha = $date->format('Y-m-d'); // le doy formato a la fecha obtenida
		$reporte->fecha= $fecha; 
		// ---------- Fecha -------------
		$reporte->dado_baja= 1; 
		$reporte->save();
		//$asistente->dado_baja= 1; 
		$asistente->delete(); // este metodo delete() es de softDelete
		$asistente->user->activo=0; // cambia el a inactivo, es decir no lo deja entrar a la plataforma. 
		$asistente->user->save(); // Guarda los cambio de usuario.		
		//$mensaje= '<b>'.$asistente->nombre.' '.$asistente->apellido.'</b> fue dado da baja con exito.';	
		//$asistente->save();	


		return Redirect::to('/asistentes/lista/todos')->with(
				array(
					'mensaje'=> 'de_baja', 
					'id_dado_baja' => $asistente->id,
					'nombre_dado_baja' => $asistente->nombre,
					'apellido_dado_baja' => $asistente->apellido
					)
			);
	}
	
	public function postEliminar($id)
	{
		$asistente = Asistente::withTrashed()->find($id);
		if(isset($asistente->user->id))
			$asistente->user->delete(); // Elimina el USUARIO del ASISTENTE
		
		$asistente->forceDelete();	// Elimina el asistente

		return "eliminado";
	}

	public function postAjaxEstadisticas($fecha)
	{
		
		return $fecha;
	}

	public function postUploadFotoAjax($id, $anchoNav, $altoNav)
	{
		$error=0;
		if (Input::hasFile('foto'))
		{
			$file = Input::file("foto");
			$tipo=$file->getMimeType();
			$size=$file->getSize();
			if($tipo != "image/jpg" && $tipo != "image/jpeg" && $tipo!= "image/png" && $tipo != "image/gif")
			{
				$error=1;
				return "Error, el archivo no es una imagen <script type='text/javascript'> var error=".$error.";</script>";
			}
			else
			{
				//guardamos la imagen en img/temp con el nombre temporal
		        $file->move("img/temp","imagen-temp-".$id.".jpg");
		        
		        $img= Image::make("img/temp/imagen-temp-".$id.".jpg");
		        $img->backup();
		        $width=$img->width();
		        $height=$img->height();

		        if($width < 215 || $height < 215)
				{
					//unlink("img/temp/asistente-temp-".$id.".jpg");
					$error=2;
					return "Error, el ancho de la imagen debe ser mayor a 215px <script type='text/javascript'> var error=".$error.";</script>";

				}
				else
				{	
					if($altoNav<570)
						$alto=$altoNav-140;
					else
						$alto=430;
			        // resize the image to a height of 200 and constrain aspect ratio (auto width)
					$img->resize(null, $alto, function ($constraint) {
					    $constraint->aspectRatio();
					});
					$img->save();
					$width=$img->width();
					$height=$img->height();
					if(($width>560 && intval($anchoNav)>770) || ($width>intval($anchoNav)-20 && intval($anchoNav)<771))
					{
						if(intval($anchoNav)>770)
							$img->resize(540, null, function ($constraint) {
							    $constraint->aspectRatio();
							});
						else
							$img->resize(intval($anchoNav)-60, null, function ($constraint) {
							    $constraint->aspectRatio();
							});
					}
					$img->save();
					$width=$img->width();
					$height=$img->height();
					$img->reset();
					$img->save();
					$fechaSegundos = time(); 
        			$strNoCache = "?nocache=$fechaSegundos"; 
					return "<img src='/img/temp/imagen-temp-".$id.".jpg".$strNoCache."' id='crop' style='height: ".$height."px; width: ".$width.";' /> <script type='text/javascript'> var ancho=".$width."; var alto=".$height."; var error=".$error.";</script>";
				}
			}
			
	    }
	}

	public function postRecortaFotoAjax($id, $x, $y, $w, $h)
	{
		$width=$_POST['ancho'];
		$img= Image::make("img/temp/imagen-temp-".$id.".jpg");
		$width_orig=$img->width();
		$escala=intval($width_orig)/intval($width);

		$img->crop(intval($w*$escala),intval($h*$escala),intval($x*$escala),intval($y*$escala));
		//$img->fit(215);
		$img->save("img/temp/imagen-temp-mini-".$id.".jpg");

		///borramos la imagen completa guardada en temporales para dejar solo la imagen mini temporal
		//el guardado definitivo se hace en el update
		unlink("img/temp/imagen-temp-".$id.".jpg");
		$fechaSegundos = time();
        $strNoCache = "?nocache=$fechaSegundos";
		return "/img/temp/imagen-temp-mini-".$id.".jpg".$strNoCache;
	}

	public function postRotaFotoAjax($id, $angulo, $anchoNav, $altoNav)
	{
		$img= Image::make("img/temp/imagen-temp-".$id.".jpg");
		$img->rotate($angulo);
		$img->save();
		$img->backup();
		if($altoNav<570)
			$alto=$altoNav-140;
		else
			$alto=430;
        // resize the image to a height of 200 and constrain aspect ratio (auto width)
		$img->resize(null, $alto, function ($constraint) {
		    $constraint->aspectRatio();
		});
		$width=$img->width();
		$height=$img->height();
		$img->save();
		if(($width>560 && intval($anchoNav)>770) || ($width>intval($anchoNav)-20 && intval($anchoNav)<771))
		{
			if(intval($anchoNav)>770)
				$img->resize(560, null, function ($constraint) {
				    $constraint->aspectRatio();
				});
			else
				$img->resize(intval($anchoNav)-40, null, function ($constraint) {
				    $constraint->aspectRatio();
				});
		}
		$img->save();
		$width=$img->width();
		$height=$img->height();
		$img->reset();
		$img->save();
		$fechaSegundos = time(); 
        $strNoCache = "?nocache=$fechaSegundos"; 
		return "<img src='/img/temp/imagen-temp-".$id.".jpg".$strNoCache."' id='crop' style='height: ".$height."px; width: ".$width.";' /> <script type='text/javascript'> var ancho=".$width."; var alto=".$height."; </script>";
	}

	/////////////////////////Esta es la parte de la busqueda tipo FACEBOOK de asistentes/////////////////////////////////////////////////////////
	//Metodo ajax: LineaSeleccionada
	
	//La siguiente función recibe el id del asistente, y otros atributos mas que son opcionales.
	//  Retorna de forma grafica el nombre del asistente, el codigo y el tipo de asistente
	
	public function construyeItemAsistente($id, $class="asistente", $col_lg="12", $col_md="12", $col_sm="12", $col_xs="12", $adicional=""){
		$titulo=str_replace("-", " ", $class);
		$asistente=Asistente::find($id);
		$respuesta='<div style="padding: 5px;" id="item-'.$class.'-'.$id.'" class="col-lg-'.$col_lg.' col-md-'.$col_md.' col-sm-'.$col_sm.' col-xs-'.$col_xs.'">';
		$respuesta.='<div class="item-seleccionado">';
		$respuesta.='<div id="ico-'.$class.'" class="no-padding col-xs-11 col-sm-4 col-md-4 col-lg-4" >';
        $respuesta.='<center><img style="margin-left:-9px;margin-top:4px" src="/img/fotos/'.$asistente->foto.'" class="img-circle img-responsive" width="100px" alt="User Image"></center>'; 
        $respuesta.='</div>';
        $respuesta.='<div id="info-'.$class.'" class="info-item no-padding col-xs-11 col-sm-7 col-md-7 col-lg-7 ">';
		$respuesta.='<h4 class="titulo"><b>'.$class.' </b></h4>';
		$respuesta.='<p><b>Código: </b>'.$asistente->id.'';
		$respuesta.='<p class="puntos capitalize">'.$asistente->nombre.' '.$asistente->apellido.'</p>';
		if($asistente->tipo_asistente_id==5){
					$respuesta.='<label class="label arrowed-right bg-purple" data-toggle="tooltip" data-placement="top" title="'.$asistente->tipoAsistente->nombre.'"><i class="fa fa-book" style="margin-right:15 px;"> </i>';
		}
		else if($asistente->tipo_asistente_id==4){
			$respuesta.='<label class="label arrowed-right bg-orange" data-toggle="tooltip" data-placement="top" title="'.$asistente->tipoAsistente->nombre.'"><i class="fa fa-star" style="margin-right:15 px;"> </i>'; 	
		}
		else if($asistente->tipo_asistente_id==3){
			$respuesta.='<label class="label arrowed-right bg-blue" data-toggle="tooltip" data-placement="top" title="'.$asistente->tipoAsistente->nombre.'"><i class="fa fa-child" style="margin-right:15 px;"> </i>'; 	
		}
		else if($asistente->tipo_asistente_id==2){
			$respuesta.='<label class="label arrowed-right bg-aqua" data-toggle="tooltip" data-placement="top" title="'.$asistente->tipoAsistente->nombre.'"><i class="fa fa-group" style="margin-right:15 px;"> </i>'; 	
		}
		else if($asistente->tipo_asistente_id==1){
			$respuesta.='<label class="label arrowed-right bg-teal" data-toggle="tooltip" data-placement="top" title="'.$asistente->tipoAsistente->nombre.'"><i class="fa fa-heart" style="margin-right:15 px;"> </i>'; 	
		}
		$respuesta.=' '.$asistente->tipoAsistente->nombre.'</label> ';
		$respuesta.=$adicional;
		$respuesta.='<br></p></div>';
		$respuesta.='<div class="cerrar no-padding col-xs-1 col-sm-1 col-md-1 col-lg-1" style="background-color:#fff;border-color:#fff" alert alert-success>
		<button id="cerrar-'.$class.'" data-id="'.$id.'" name="cerrar-'.$class.'" type="button" class="close cerrar-'.$class.'-seleccionado" style="font-size:27px;outline:none" aria-hidden="true">×</button>
		</div>';
		$respuesta.='</div></div>';

		return $respuesta;
	}

	////funcion que devuelve los asistentes para la busqueda general
	public function postAsistenteSeleccionado($id, $class="asistente", $col_lg="12", $col_md="12", $col_sm="12", $col_xs="12" ) 
	{
		$respuesta=$this->construyeItemAsistente($id, $class, $col_lg, $col_md, $col_sm, $col_xs);
		return $respuesta;
	}

	///función que devuelve los asistentes para la busqueda de servidores para grupos
	public function postServidorSeleccionado($asistente_id, $class="asistente", $id_grupo, $col_lg_md="12", $col_sm_xs="12") 
	{
		$adicional="";
		$grupo=Grupo::find($id_grupo);
		$tipo_servicios=TipoServicioGrupo::all();
		$adicional.='<select class="multiselectServicios" multiple="multiple">';
        foreach ($tipo_servicios as $tipo_servicio){
            $servidor_grupo= ServidorGrupo::where("asistente_id","=", $asistente_id)->where("grupo_id", "=", $grupo->id)->first();
            $cargo=$servidor_grupo->tipoServicioGrupo()->get();
            $cargo=$cargo->find($tipo_servicio->id);

            $adicional.='<option name="'.$asistente_id.'" class="servicio" data-id-asistente="'.$asistente_id.'" data-tipo-servicio="'.$tipo_servicio->id.'"';
            if(isset($cargo))
            	$adicional.=' selected';
            $adicional.='> '.$tipo_servicio->nombre.'</option>';
        }
    	$adicional.='</select>';
    	$respuesta=$this->construyeItemAsistente($asistente_id, $class, $col_lg_md, $col_lg_md, $col_sm_xs, $col_sm_xs, $adicional);
		return $respuesta;
	}

	////////// este es el ajax que devuelve los siguientes 10 asistentes para el panel de asistentes 
	public function postObtenerAsistentesParaReportarAjax( $idreporte="", $cant_asistentes_cargados, $sql_adicional="", $buscar="")
	{
		$asistentes="";
		$cant_asistentes=0;
		$total_asistentes=0;

		$asistentes=Asistente::whereRaw("4=4");

		if($buscar!="")
		{

            $buscar= htmlspecialchars($buscar);
			$buscar_array=explode(" ", $buscar);
			Global $sql_buscar;
			$c=0;

			foreach($buscar_array as $palabra)
			{
					if($c!=0)
						$sql_buscar.=" AND ";

					$sql_buscar.="(asistentes.nombre ILIKE '%$palabra%' OR asistentes.apellido ILIKE '%$palabra%' OR asistentes.identificacion ILIKE '%$palabra%'";
					if(ctype_digit($palabra))
						$sql_buscar.=" OR asistentes.id=$palabra";
					$sql_buscar.=")";
					$c++;
			}
			$asistentes=$asistentes->whereRaw($sql_buscar);			
		}


		$total_asistentes=$asistentes->get()->count();
		$asistentes=$asistentes->orderBy('id', 'asc')->skip($cant_asistentes_cargados)->take(10)->get();

        $lista=""; 

        if($asistentes->count()>0)
        {

	        foreach($asistentes as $asistente)
	        {
	        	$lista.=' <li id="" class="" style="cursor:pointer"><!-- start message --> 
	                        <a class="seleccionar-asistente" data-grupo-id="'.$asistente->grupo_id.'" data-nombre="'.$asistente->nombre.'" data-id="'.$asistente->id.'">                                      
	                          <div class="col-lg-2 ">
                             <center><img style="margin-right: -15px;" src="/img/fotos/'.$asistente->foto.'" class="img-circle" width="70px" alt="User Image"></center> 
                              </div>

							<div class="col-lg-3">
                            <p style="white-space: normal !important">
                            <b>CÓDIGO: </b>'.$asistente->id.'<br>
                            '.$asistente->nombre.' '.$asistente->apellido.'
                            </p>
                            </div>
							<div class="col-lg-3 " style="margin-left: -35px;">
                             <b>TIPO DE ASISTENTE</b> <br>';
				if($asistente->tipo_asistente_id==5){
					$lista.='<label class="label arrowed-right bg-purple" data-toggle="tooltip" data-placement="top" title="'.$asistente->tipoAsistente->nombre.'"><i class="fa fa-book" style="margin-right:15 px;"> </i></label>';
				}
				else if($asistente->tipo_asistente_id==4){
					$lista.='<label class="label arrowed-right bg-orange" data-toggle="tooltip" data-placement="top" title="'.$asistente->tipoAsistente->nombre.'"><i class="fa fa-star" style="margin-right:15 px;"> </i></label>'; 	
				}
				else if($asistente->tipo_asistente_id==3){
					$lista.='<label class="label arrowed-right bg-blue" data-toggle="tooltip" data-placement="top" title="'.$asistente->tipoAsistente->nombre.'"><i class="fa fa-child" style="margin-right:15 px;"> </i></label>'; 	
				}
				else if($asistente->tipo_asistente_id==2){
					$lista.='<label class="label arrowed-right bg-aqua" data-toggle="tooltip" data-placement="top" title="'.$asistente->tipoAsistente->nombre.'"><i class="fa fa-group" style="margin-right:15 px;"> </i></label>'; 	
				}
				else if($asistente->tipo_asistente_id==1){
					$lista.='<label class="label arrowed-right bg-teal" data-toggle="tooltip" data-placement="top" title="'.$asistente->tipoAsistente->nombre.'"><i class="fa fa-heart" style="margin-right:15 px;"> </i></label>'; 	
				}
                $lista.=$asistente->tipoAsistente->nombre;
                if(isset($asistente->linea['id'])){
	      			$lista.='<br>
	            	<b>LÍNEA: </b>'.$asistente->linea['nombre'];
                }


                $lista.='<br>
                </div>';

				$lista.='<div class="col-lg-3">
                    <p style="white-space: normal !important">
                     <b>LÍDER(ES):  </b><br>';

                $contador=0;
                if(isset($asistente->grupo['id'])){
	                $encargados=$asistente->grupo->encargados;
		            foreach($encargados as $encargado){
			            if($contador!=0)
			            $lista.=", ";
		                $lista.=$encargado['nombre']." ".$encargado['apellido'];
		                $contador=$contador+1;
	        		}
        		}
        		else
        		{
        	    	$lista.="Asistente sin Grupo Asignado";
        		}

	            $lista.='</p>';
	            $lista.='</div><div class="col-lg-1" >';
				
	            $asistio=$asistente->reportesReunion()->where('reporte_reunion_id', '=',$idreporte)->count();

	            if($asistio>0){
		            $lista.='<p id="boton-'.$asistente->id.'" name="boton-'.$asistente->id.'" estado="asistio" tipo-asistente="'.$asistente->tipo_asistente_id.'" style="white-space: normal !important">
		            <br>
		            <button data-id="" data-nombre="" class="seleccionar-linea btn btn-success btn-sm">Asistió <i class="fa fa-check"></i></button>';	
	            }
	            else{
		            $lista.='<p id="boton-'.$asistente->id.'" name="boton-'.$asistente->id.'" estado="noasistio" tipo-asistente="'.$asistente->tipo_asistente_id.'" style="white-space: normal !important">
		            <br>
		            <button data-id="" data-nombre="" class="seleccionar-linea btn btn-danger btn-sm">No Asistió <i class="fa fa-times"></i></button>';	
	            }
	            
	            $lista.='</p></div>
	            </a>
	         	</li><!-- end message --> ';
	        }

	    }
        else
        {
			$lista.='<li id="" class="" style="cursor:pointer">
                <div class="col-xs-12 col-md-12 col-lg-12  bg-gray" >
                <br>
                  <center>	                      	
                  		 <i class="fa fa-home fa-2x"> </i> No hay asistentes que coincidan con la búsqueda <b>"'.$buscar.'"</b> 	                      	
                         <a style="color:#0073B7" href="../../asistentes/nuevo" target="_blank"> <br >   Click Aquí para Agregar un Nuevo Asistente </a>
                  </center>
                 <br>
                </div>  
			</li>';
	
		}
        $lista.=     '
                    <script type="text/javascript">
					  var cant_registros='.$asistentes->count().';
					  var total_registros_ajax='.$total_asistentes.';
					</script>';
		return $lista;
	}

	////////// este es el ajax que devuelve los siguientes 10 asistentes para el panel de asistentes, la variable asistentes_solicitados se cambia en caso de que se quieran obtener no solo los discipulos del usuario logueado
	public function postObtieneAsistentesParaBusquedaAjax($class="asistente",$asistentes_solicitados="solo_discipulos", $cant_asistentes_cargados, $sql_adicional="1=1", $buscar="")
	{
		if(Auth::check())
		{
			$asistentes="";
			$asistentes_aptos="";//esta variable recoge los asistentes que pueden ser seleccionados, dependera del sql adicional
			$cant_asistentes=0;
			$total_asistentes=0;
			$sql_adicional=str_replace("~", " ", $sql_adicional);

			$asistentes=Asistente::whereRaw("4=4");
			$asistentes_aptos=Asistente::whereRaw("5=5");

			if(Auth::user()->id!=1 && $asistentes_solicitados=="solo_discipulos")
		    {
		    	$asistentes= Auth::user()->asistente->discipulos();
		    }

		    if(Auth::user()->id!=1)
		    {
		    	$asistentes_aptos= Auth::user()->asistente->discipulos();
		    }

			if($buscar!="")
			{

	            $buscar= htmlspecialchars($buscar);
				$buscar_array=explode(" ", $buscar);
				Global $sql_buscar;
				$c=0;

				foreach($buscar_array as $palabra)
				{
						if($c!=0)
							$sql_buscar.=" AND ";

						$sql_buscar.="(asistentes.nombre ILIKE '%$palabra%' OR asistentes.apellido ILIKE '%$palabra%' OR asistentes.identificacion ILIKE '%$palabra%'";
						if(ctype_digit($palabra))
							$sql_buscar.=" OR asistentes.id=$palabra";
						$sql_buscar.=")";
						$c++;
				}
				$asistentes=$asistentes->whereRaw($sql_buscar);
				$asistentes_aptos=$asistentes_aptos->whereRaw($sql_buscar);				
			}

			if($sql_adicional!="1=1")
				$asistentes_aptos=$asistentes_aptos->whereRaw($sql_adicional)->get();

			$total_asistentes=$asistentes->get()->count();
			$asistentes=$asistentes->orderBy('id', 'asc')->skip($cant_asistentes_cargados)->take(10)->get();

	        $lista=""; 

	        if($asistentes->count()>0)
	        {
				foreach($asistentes as $asistente)
		        {
		        	$bloquear="item";
		        	if($sql_adicional!="1=1")
		        		if(!$asistentes_aptos->find($asistente->id))
		        			$bloquear="item-bloqueado";
		        	$grupo="Sin grupo";
		        	if(isset($asistente->grupo->id))
		        		$grupo=$asistente->grupo->nombre;
		        	$lista.=' <li class="'.$bloquear.'" id="" style="cursor:pointer"><!-- start message --> 
		                        <a class="seleccionar-'.$class.'" data-cant-grupos-min="'.$asistente->gruposMinisterio()->count().'" data-cant-discipulos="'.$asistente->discipulos()->count().'" data-grupo-nombre="'.$grupo.'" data-grupo-id="'.$asistente->grupo_id.'" data-linea-id="'.$asistente->linea_id.'" data-nombre="'.$asistente->nombre.' '.$asistente->apellido.'" data-id="'.$asistente->id.'">                                      
		                          <div class="col-lg-3  col-md-3 col-xs-3">
	                             <center><img style="margin-right: -15px;" src="/img/fotos/'.$asistente->foto.'" class="img-item img-circle" width="70px" alt="User Image"></center> 
	                              </div>
		                          <div class="col-lg-5  col-md-5 col-xs-5">
		                            <p style="white-space: normal !important">
		                            <b>CÓDIGO: </b>'.$asistente->id.'<br>
		                            <b>NOMBRE: </b>'.$asistente->nombre.' '.$asistente->apellido.'
		                            </p> 
		                          </div> 
		                          <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4" style="margin-left: -15px;" >
		                          <b>TIPO DE ASISTENTE</b><br>';
					if($asistente->tipo_asistente_id==5){
						$lista.='<label class="tipo-asistente label arrowed-right bg-purple" data-toggle="tooltip" data-placement="top" title="'.$asistente->tipoAsistente->nombre.'"><i class="fa fa-book" style="margin-right:15 px;"> </i>';
					}
					else if($asistente->tipo_asistente_id==4){
						$lista.='<label class="tipo-asistente label arrowed-right bg-orange" data-toggle="tooltip" data-placement="top" title="'.$asistente->tipoAsistente->nombre.'"><i class="fa fa-star" style="margin-right:15 px;"> </i>'; 	
					}
					else if($asistente->tipo_asistente_id==3){
						$lista.='<label class="tipo-asistente label arrowed-right bg-blue" data-toggle="tooltip" data-placement="top" title="'.$asistente->tipoAsistente->nombre.'"><i class="fa fa-child" style="margin-right:15 px;"> </i>'; 	
					}
					else if($asistente->tipo_asistente_id==2){
						$lista.='<label class="tipo-asistente label arrowed-right bg-aqua" data-toggle="tooltip" data-placement="top" title="'.$asistente->tipoAsistente->nombre.'"><i class="fa fa-group" style="margin-right:15 px;"> </i>'; 	
					}
					else if($asistente->tipo_asistente_id==1){
						$lista.='<label class="tipo-asistente label arrowed-right bg-teal" data-toggle="tooltip" data-placement="top" title="'.$asistente->tipoAsistente->nombre.'"><i class="fa fa-heart" style="margin-right:15 px;"> </i>'; 	
					}
	                $lista.=" ".$asistente->tipoAsistente['nombre'];
	                if(isset($asistente->linea['id'])){
		      			$lista.='</label><br>
		            	<b>LÍNEA: </b>'.$asistente->linea['nombre'];
	                }
								         
		            $lista.='</div> 
		                        </a>
		                     </li><!-- end message --> '; 
		        }
		    }
	        else
	        {
				$lista.='<li id="" class="" style="cursor:pointer">
	                <div class="col-xs-12 col-md-12 col-lg-12  bg-gray" >
	                <br>
	                  <center>	                      	
	                  		 <i class="fa fa-home fa-2x"> </i> No hay asistentes que coincidan con la búsqueda <b>"'.$buscar.'"</b> 	                      	
	                         <a style="color:#0073B7" href="../../asistentes/nuevo" target="_blank"> <br >   Click Aquí para Agregar un Nuevo Asistente </a>
	                  </center>
	                 <br>
	                </div>  
				</li>';
		
			}
	        $lista.=     '
	                     <script type="text/javascript">
						  var cant_registros='.$asistentes->count().';
						   var total_registros_ajax='.$total_asistentes.';
						</script>';
			return $lista;
		}
		else
		{
			return "logout";
		}

	}

	// Este codigo sirve para confirmar si el ASISTENTE: 
	// - ha sido reportado en un grupo. 
	// - ha sido reportado en una reunion. 
	// - Si ha dado ofrendas. 
	// INFORMACION NECESARIA PARA SABER SI SE LE DA DE BAJA O VERDADERAMENTE SE ELIMINA. 
	public function postCompruebaSiTieneRegistroAjax($id) 
	{
		$asistente = Asistente::withTrashed()->find($id);
		$respuesta="";
		$reportes_grupo=$asistente->reportesGrupo()->first();
		$reporte_reunion=$asistente->reportesReunion()->first();
		$reporte_ofrendas=$asistente->ofrendas()->first();

		if(isset($reportes_grupo) || isset($reporte_reunion) || isset($reporte_ofrendas))
		{
			if (isset($reportes_grupo))
				$respuesta.="1";
			if (isset($reporte_reunion))
				$respuesta.="2";
			if (isset($reporte_ofrendas))
				$respuesta.="3";
		} else 
		{
			$respuesta="0";
		}

		return $respuesta;
	} 


    /////////////HASTA AQUI VAN LOS METODOS PARA LA BUSQUEDA TIPO FACEBOOK


        //Funcion para definir estado inactivo a los que llevan mas de un mes sin reportarse en la iglesia
		public function definirInactivos(){

	       	$hoy = date("Y-m-d");
			$hace30dias = strtotime ( '-30 day' , strtotime ( $hoy ) ) ;
			$hace30dias = date ( 'Y-m-d' , $hace30dias );
			$reportes_recientes = ReporteReunion::where("fecha", ">", $hace30dias)->get();

	        $asistentes=array();
			foreach ($reportes_recientes as $reporte) {
				array_push($asistentes, $reporte->asistentes()->get()); 
			}

			$asistentes_ids_fin=array();
			for ($i=0;$i<count($asistentes); $i++) {
				$asistentes_reporte=$asistentes[$i];
				foreach($asistentes_reporte as $asistente)
				{
					if(isset($asistente->id))
					array_push($asistentes_ids_fin, $asistente->id);
				}
			}
			$asistentes_ids = array_unique($asistentes_ids_fin);
			
			$asistentes_inactivos=  Asistente::whereNotIn('id', $asistentes_ids)
							->where('asistentes.id', '!=', '0')
							->get();

			foreach($asistentes_inactivos as $asistente)
				{
					$asistente->inactivo_iglesia=1;
					$asistente->save();
				}				

	       	return "done";
		}

	}
	?>