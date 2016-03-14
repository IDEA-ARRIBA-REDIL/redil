<?php
/** 
*
* @Redil Software. IglesiasController.php” 
* @versión: 1.0.0     @modificado: 11 de Julio del 2014 
* @autor última modificación: Mairon Piedrahita 
* 
*/

class ReporteReunionesController extends BaseController
{
	
	public function __construct()
	{
		$this->beforeFilter('auth');  //bloqueo de acceso
	}
	
	public function getIndex()
	{
		return Redirect::to('reporte-reuniones/lista/todos');
	
	}
	public function getLista($reunión)
	{
		$buscar=null;
		$fecha_inicio=null;
		$fecha_fin=null;
		$reunion=null;

		$reuniones=Reunion::all();

		$reportes= ReporteReunion::whereRaw("1=1");
		
		if(isset($_GET["buscar"]))
		{
			if($_GET["buscar"]!="")
			{
				$buscar= htmlspecialchars(Input::get("buscar"));
				$buscar_array=explode(" ", $buscar);
				Global $sql_buscar;
				$c=0;

				foreach($buscar_array as $palabra)
				{
					if($c!=0)
						$sql_buscar.=" AND ";

					$sql_buscar.=" (translate (reuniones.nombre, 'áéíóúÁÉÍÓÚäëïöüÄËÏÖÜñ', 'aeiouAEIOUaeiouAEIOUÑ') ILIKE '%$palabra%' OR reuniones.lugar ILIKE '%$palabra%' OR reuniones.descripcion ILIKE '%$palabra%'";
	                //al sql usado en reuniones se le añade el sql de reportes de reuniones. 
					$sql_buscar.=" OR reporte_reuniones.observaciones ILIKE '%$palabra%' OR reporte_reuniones.predicador_invitado ILIKE '%$palabra%' OR reporte_reuniones.predicador_diezmos_invitado ILIKE '%$palabra%'";	
		            //luego se añade el sql de asistentes para encontrar el predicador que pertenece a la iglesia por medio del nombre
		            $sql_buscar.=" OR predicador.nombre ILIKE '%$palabra%' OR predicador_diezmos.nombre ILIKE '%$palabra%' OR predicador.apellido ILIKE '%$palabra%' OR predicador_diezmos.apellido ILIKE '%$palabra%'";

					
					if(ctype_digit($palabra))
					{
						$sql_buscar.=" OR reuniones.id=$palabra";
						$sql_buscar.=" OR reporte_reuniones.id=$palabra";
					}

					$busqueda_por_dia=false;

					if($palabra=="lunes")
					{
						$palabra=2;
						$busqueda_por_dia=true;
					}
					else if($palabra=="martes")
					{
						$palabra=3;
						$busqueda_por_dia=true;
					}
					else if ($palabra=="miercoles")
					{	
						$palabra=4;
						$busqueda_por_dia=true;
					}
					else if ($palabra=="jueves")
					{	
						$palabra=5;
						$busqueda_por_dia=true;
					}
					else if ($palabra=="viernes")
					{
						$palabra=6;
						$busqueda_por_dia=true;
					}
					else if ($palabra=="sabado")
					{	
						$palabra=7;
						$busqueda_por_dia=true;
					}
					else if ($palabra=="domingo")
					{	
						$palabra=1;
						$busqueda_por_dia=true;
					}

					if($busqueda_por_dia)
					$sql_buscar.=" OR reuniones.dia=$palabra";

					$sql_buscar.=")";
					$c++;
				}

				/////////////////////fin del codigo para crear la consultas

				$reportes= $reportes->leftJoin('reuniones', 'reporte_reuniones.reunion_id', '=', 'reuniones.id')
				->leftJoin('asistentes AS predicador', 'reporte_reuniones.predicador', '=', 'predicador.id')
				->leftJoin('asistentes AS predicador_diezmos', 'reporte_reuniones.predicador_diezmos', '=', 'predicador_diezmos.id')
				->where(function($query)
				{
				    $sql_buscar_l=$GLOBALS['sql_buscar']; /// sql_buscar_l local
				    $query->whereRaw($sql_buscar_l);
				})
				->get(array('reporte_reuniones.id'));

				$reportes=ReporteReunion::whereIn('reporte_reuniones.id', Helper::obtenerArrayIds($reportes));
					
			}
		}

		if (isset($_GET["reunion"])){
			$reunion=$_GET["reunion"];

			if($reunion!=""){				
				$reportes=  $reportes->where('reunion_id', $reunion);
				
			}
		}

		if(isset($_GET["fecha-inicio"])){
			$fecha_inicio=$_GET["fecha-inicio"];
			$reportes=$reportes->where('reporte_reuniones.fecha', '>=', $fecha_inicio);
		}
		else
		{
			$fecha_inicio= date('Y')."-".date('m')."-01";
			$reportes=$reportes->where('reporte_reuniones.fecha', '>=', $fecha_inicio);
		}
		

		if(isset($_GET["fecha-fin"])){
			$fecha_fin=$_GET["fecha-fin"];
			$reportes=$reportes->where('reporte_reuniones.fecha', '<=', $fecha_fin);
		}
		else
		{
			$fin= date('t'); 
			$fecha_fin=date('Y')."-".date('m').'-'.$fin;
			$reportes=$reportes->where('reporte_reuniones.fecha', '<=', $fecha_fin);
		}

	    $reportes = $reportes->orderBy('fecha', 'desc')
		->paginate(10);

		return View::make('reporte-reuniones.index')-> with(
			array(
				'reporte_reuniones' => $reportes,
				'reuniones' => $reuniones,
				'reunion' => $reunion,
				'fecha_inicio' => $fecha_inicio,
				'fecha_fin' => $fecha_fin,
				'buscar' => $buscar
				));		
	}

	public function getNuevo ($id="0")
	{
		$reunion=Reunion::find($id);

		$reuniones = Reunion::where('reuniones.dado_baja', '=', '0')
			->orderBy('id', 'asc')
			->take(10)
			->get();

		$asistentes = Asistente::orderBy('id', 'asc')
				->take(10)
				->get();

		return  View::make('reporte-reuniones.nuevo')->with(
			array(
				'asistentes' => $asistentes,
				'reuniones' => $reuniones,
				'reunion_seleccionada' => $reunion,
			));
	}

	public function postNew ()
	{
		
		$reporte_reuniones= new ReporteReunion;
		$reporte_reuniones->reunion_id=Input::get('reunion_id');
		if (Input::get('fecha')!="")
			{
				$date = new DateTime(str_replace("/","-",Input::get('fecha')));
				$fecha = $date->format('Y-m-d');
				$reporte_reuniones->fecha = $fecha;
			}
		$reporte_reuniones->observaciones= Input::get ('observacion');
		$predicador=Input::get('predicador_id');
		$predicadordiezmos=Input::get('predicadordiezmos_id');
		if($predicador==""){
        $reporte_reuniones->predicador=null;
		}
	    else{
	    $reporte_reuniones->predicador=$predicador;
	    }
		if($predicadordiezmos==""){
        $reporte_reuniones->predicador_diezmos=null;
		}
		else{
		$reporte_reuniones->predicador_diezmos=$predicadordiezmos;
		}
		$reporte_reuniones->predicador_invitado= Input::get ('invitado');
		$reporte_reuniones->predicador_diezmos_invitado= Input::get ('invitado_diezmos');
		$reporte_reuniones->invitados=0;
		$reporte_reuniones->save();
		$id=$reporte_reuniones->id;
		$reunion_seleccionada=$reporte_reuniones->reunion;

		Asistente::definirInactivosCulto();

		return Redirect::to('reporte-reuniones/actualizar/'.$id)->with (array(
			'status'  => 'ok_save',
			'codigo_reunion'=>$id,
			'nombre_reunion'=>$reporte_reuniones->reunion->nombre,
			));
		
		

	}


	public function getActualizar($id)
	{
		$asistentes = Asistente::orderBy('id', 'asc')
		->paginate(10);

			$reuniones = Reunion::where('reuniones.dado_baja', '=', '0')
				->orderBy('id', 'asc')
				->take(10)
				->get();


		$reporte = ReporteReunion::find($id);
		$reunion_seleccionada=$reporte->reunion;

		return View::make('reporte-reuniones.actualizar')->with(
			array(
				'asistentes' => $asistentes,
				'reuniones' => $reuniones,
				'reporte' => $reporte,
				'reunion_seleccionada' => $reunion_seleccionada,
				'status'  => '',
			));
	}

	public function getAnadirAsistentes($id)
	{
		$asistentes = Asistente::orderBy('id', 'asc')
		->paginate(10);
		
			$reuniones = Reunion::where('reuniones.dado_baja', '=', '0')
				->orderBy('id', 'asc')
				->take(10)
				->get();

		$reporte = ReporteReunion::find($id);
		$reunion_seleccionada=$reporte->reunion;
        
        //Para realizar la comparacion de porcentajes
		$cantidad_total_asistentes = Asistente::count();
        $cantidad_total_nuevos = Asistente::where('tipo_asistente_id', '=', '1')->count();
        $cantidad_total_ovejas = Asistente::where('tipo_asistente_id', '=', '2')->count();
        $cantidad_total_miembros = Asistente::where('tipo_asistente_id', '=', '3')->count();
        $cantidad_total_lideres = Asistente::where('tipo_asistente_id', '=', '4')->count();
        $cantidad_total_pastores = Asistente::where('tipo_asistente_id', '=', '5')->count();

		return View::make('reporte-reuniones.anadir-asistentes')->with(
			array(
				'asistentes' => $asistentes,
				'reuniones' => $reuniones,
				'reporte' => $reporte,
				'reunion_seleccionada' => $reunion_seleccionada,
				'cantidad_total_asistentes' => $cantidad_total_asistentes,
				'cantidad_total_nuevos' => $cantidad_total_nuevos,
				'cantidad_total_ovejas' => $cantidad_total_ovejas,
				'cantidad_total_miembros' => $cantidad_total_miembros,
				'cantidad_total_lideres' => $cantidad_total_lideres,
				'cantidad_total_pastores' => $cantidad_total_pastores,
				'status'  => '',
			));
	}

	public function getAnadirIngresos($id)
	{
		$reporte= ReporteReunion::find($id);
		$asistentes=$reporte->asistentes()->get(array('asistentes.id'));
		$asistentes_ids_fin=array();
		foreach ($asistentes as $asistente) {
			array_push($asistentes_ids_fin, $asistente->id);
		}
		$asistentes=Asistente::whereIn('asistentes.id', $asistentes_ids_fin)
			->orderBy('id', 'asc')
			->take(10)
			->get();

        $total_diezmos=0;
        $total_ofrendas=0;
        $total_pactos=0;
        $total_primicias=0;
        $total_protemplo=0;
        $total_siembras=0;
        $total_otros=0;
        $total_ofrendas_sueltas=0;
        $total_ingresos=0;

        $total_diezmos = Ofrenda::where('reporte_reunion_id', '=', $id)->where('ofrendas.tipo_ofrenda', 0)->sum('valor');
        $total_ofrendas = Ofrenda::where('reporte_reunion_id', '=', $id)->where('ofrendas.tipo_ofrenda', 1)->sum('valor');
        $total_pactos = Ofrenda::where('reporte_reunion_id', '=', $id)->where('ofrendas.tipo_ofrenda', 2)->sum('valor');
        $total_protemplo = Ofrenda::where('reporte_reunion_id', '=', $id)->where('ofrendas.tipo_ofrenda', 3)->sum('valor');
        $total_siembras = Ofrenda::where('reporte_reunion_id', '=', $id)->where('ofrendas.tipo_ofrenda', 4)->sum('valor');
        $total_primicias = Ofrenda::where('reporte_reunion_id', '=', $id)->where('ofrendas.tipo_ofrenda', 5)->sum('valor');
        $total_otros = Ofrenda::where('reporte_reunion_id', '=', $id)->where('ofrendas.tipo_ofrenda', 6)->sum('valor');
        $total_ofrendas_sueltas = Ofrenda::where('reporte_reunion_id', '=', $id)->where('ofrendas.tipo_ofrenda', 7)->sum('valor');

		

        $total_ingresos=$total_diezmos+$total_ofrendas+$total_pactos+$total_primicias+
        $total_protemplo+$total_siembras+$total_otros+$total_ofrendas_sueltas;

		return View::make('reporte-reuniones.anadir-ingresos')->with(
			array(
				'asistentes' => $asistentes,
				'reporte' => $reporte,
				'status'  => '',
				'total_diezmos' => $total_diezmos,
		        'total_ofrendas' => $total_ofrendas,
		        'total_pactos' => $total_pactos,
		        'total_primicias' => $total_primicias,
		        'total_protemplo' => $total_protemplo,
		        'total_siembras' => $total_siembras,
		        'total_otros' => $total_otros,
		        'total_ofrendas_sueltas' => $total_ofrendas_sueltas,
		        'total_ingresos' => $total_ingresos,
			));
	}

	public function postUpdate($id)
	{
		$reporte= ReporteReunion::find($id);
		$fecha=date("Y-m-d", strtotime(str_replace('/', '-',Input::get ('fecha'))) );
		$reporte->fecha= $fecha;
		$predicador=Input::get('predicador_id');
		$predicadordiezmos=Input::get('predicadordiezmos_id');
		if($predicador==""){
        $reporte->predicador=null;
		}
	    else{
	    $reporte->predicador=$predicador;
	    }
		if($predicadordiezmos==""){
        $reporte->predicador_diezmos=null;
		}
		else{
		$reporte->predicador_diezmos=$predicadordiezmos;
		}
		$reporte->predicador_invitado= Input::get ('invitado');
		$reporte->predicador_diezmos_invitado= Input::get ('invitado_diezmos');
		$reporte->observaciones= Input::get ('observaciones');
		$reporte->reunion_id=Input::get('reunion_id');
        $reporte->save();

        return Redirect::to('reporte-reuniones/actualizar/'.$id)->with (array(
			'status'  => 'ok_update',
			'nombre_reunion'=>$reporte->reunion->nombre,
			));
	}

	public function getPerfil($id, $tipo="todos")
	{
		$total_diezmos=0; $total_ofrendas=0; $total_pactos=0; $total_primicias=0; $total_protemplo=0;
        $total_siembras=0; $total_otros=0; $total_ofrendas_sueltas=0; $total_ingresos=0;
        $cantidad_todos=0; $cantidad_nuevos=0; $cantidad_ovejas=0; $cantidad_miembros=0; $cantidad_lideres=0;
        $cantidad_pastores=0;

		$asistentes_ids_fin=array();
		$asistentes_total;
		$grupos_ids= array();

		$linea=null;
		$grupo=null;
		if(Auth::user()->id==1)
		{
			$lineas=Linea::all();
			$grupos=Grupo::where('dado_baja', '0')->get();
		}
		else
		{
			if(Auth::user()->asistente->lineas()->count()>0)
			{
				$lineas=Auth::user()->asistente->lineas;
				if(Auth::user()->asistente->lineas()->count()==1)
					$linea=Auth::user()->asistente->lineas()->first()->id;
			}
			else
			{
				$lineas=Linea::where('id', Auth::user()->asistente->linea->id)->get();
				if(isset(Auth::user()->asistente->linea->id))
					$linea=Auth::user()->asistente->linea->id;
			}

			$grupos=Auth::user()->asistente->gruposMinisterio()->where('dado_baja', '0')->get();

		}

		/// clasificamos los registros por tipo de asistente
		if($tipo=="nuevos")
		{
			$tipo= 1;					
		}
		else if($tipo=="ovejas")
		{
			$tipo= 2;
		}
		else if($tipo=="miembros")
		{
			$tipo= 3;
		}
		else if($tipo=="lideres")
		{
			$tipo= 4;
		}
		else if($tipo=="pastores")
		{
			$tipo= 5;
		}

		

		$reporte= ReporteReunion::find($id);
		$asistentes=$reporte->asistentes();


        $fecha_reporte=$reporte->fecha;
        $sql_fecha="(asistentes.fecha_ingreso<'$fecha_reporte' OR asistentes.fecha_ingreso is NULL)";

		//si es el super administrador o
		if(Auth::user()->id==1 || isset(Auth::user()->asistente->iglesiaEncargada()->first()->id)){

			$cantidad_total_asistentes = Asistente::whereRaw($sql_fecha);
	        $cantidad_total_nuevos = Asistente::where('tipo_asistente_id', '=', '1')->whereRaw($sql_fecha);
	        $cantidad_total_ovejas = Asistente::where('tipo_asistente_id', '=', '2')->whereRaw($sql_fecha);
	        $cantidad_total_miembros = Asistente::where('tipo_asistente_id', '=', '3')->whereRaw($sql_fecha);
	        $cantidad_total_lideres = Asistente::where('tipo_asistente_id', '=', '4')->whereRaw($sql_fecha);
	        $cantidad_total_pastores = Asistente::where('tipo_asistente_id', '=', '5')->whereRaw($sql_fecha);
		}
		else
		{
			$asistentes_ids=Auth::user()->asistente->discipulos('array');
			$asistentes=$asistentes->whereIn('asistentes.id', $asistentes_ids);

			$cantidad_total_asistentes = Asistente::whereRaw($sql_fecha);
	        $cantidad_total_nuevos = Asistente::where('tipo_asistente_id', '=', '1')->whereRaw($sql_fecha);
	        $cantidad_total_ovejas = Asistente::where('tipo_asistente_id', '=', '2')->whereRaw($sql_fecha);
	        $cantidad_total_miembros = Asistente::where('tipo_asistente_id', '=', '3')->whereRaw($sql_fecha);
	        $cantidad_total_lideres = Asistente::where('tipo_asistente_id', '=', '4')->whereRaw($sql_fecha);
	        $cantidad_total_pastores = Asistente::where('tipo_asistente_id', '=', '5')->whereRaw($sql_fecha);
			
		}
		if (isset($_GET["grupo"])){
			$grupo=$_GET["grupo"];
			if($grupo!=""){
				$asistentes=  $asistentes->where('asistentes.grupo_id', $grupo);
				$cantidad_total_asistentes = $cantidad_total_asistentes->where('asistentes.grupo_id', $grupo);
		        $cantidad_total_nuevos = $cantidad_total_nuevos->where('asistentes.grupo_id', $grupo);
		        $cantidad_total_ovejas = $cantidad_total_ovejas->where('asistentes.grupo_id', $grupo);
		        $cantidad_total_miembros = $cantidad_total_miembros->where('asistentes.grupo_id', $grupo);
		        $cantidad_total_lideres = $cantidad_total_lideres->where('asistentes.grupo_id', $grupo);
		        $cantidad_total_pastores = $cantidad_total_pastores->where('asistentes.grupo_id', $grupo);
		    	$grupo_aux=Grupo::find($grupo);
		    	if(isset($grupo_aux->linea()->id))
		    	{
		    		$linea=$grupo_aux->linea()->id;
		    		$linea_aux=Linea::find($linea);
		    		$grupos=$linea_aux->grupos()->where('dado_baja', 0)->get();
		    	}
		    }
		}
		if (isset($_GET["linea"]) && (!isset($_GET["grupo"]) || $grupo=="")){
			$linea=$_GET["linea"];

			if($linea!=""){
				$asistentes=  $asistentes->where('asistentes.linea_id', $linea);
				$cantidad_total_asistentes = $cantidad_total_asistentes->where('asistentes.linea_id', $linea);
		        $cantidad_total_nuevos = $cantidad_total_nuevos->where('asistentes.linea_id', $linea);
		        $cantidad_total_ovejas = $cantidad_total_ovejas->where('asistentes.linea_id', $linea);
		        $cantidad_total_miembros = $cantidad_total_miembros->where('asistentes.linea_id', $linea);
		        $cantidad_total_lideres = $cantidad_total_lideres->where('asistentes.linea_id', $linea);
		        $cantidad_total_pastores = $cantidad_total_pastores->where('asistentes.linea_id', $linea);
		    	$linea_aux=Linea::find($linea);
		    	$grupos=$linea_aux->grupos()->where('dado_baja', 0)->get();
		    }
		    
		}

		$cantidad_total_asistentes = $cantidad_total_asistentes->count();
        $cantidad_total_nuevos = $cantidad_total_nuevos->count();
        $cantidad_total_ovejas = $cantidad_total_ovejas->count();
        $cantidad_total_miembros = $cantidad_total_miembros->count();
        $cantidad_total_lideres = $cantidad_total_lideres->count();
        $cantidad_total_pastores = $cantidad_total_pastores->count();

		
        $asistentes_aux=clone $asistentes;
        $asistentes_aux=Helper::obtenerArrayIds($asistentes_aux->get());
		$cantidad_todos=Asistente::whereIn('asistentes.id', $asistentes_aux)->count();
        $cantidad_nuevos=Asistente::whereIn('asistentes.id', $asistentes_aux)->where('asistentes.tipo_asistente_id', '=', '1')->count();
        $cantidad_ovejas=Asistente::whereIn('asistentes.id', $asistentes_aux)->where('asistentes.tipo_asistente_id', '=', '2')->count();
        $cantidad_miembros=Asistente::whereIn('asistentes.id', $asistentes_aux)->where('asistentes.tipo_asistente_id', '=', '3')->count();
        $cantidad_lideres=Asistente::whereIn('asistentes.id', $asistentes_aux)->where('asistentes.tipo_asistente_id', '=', '4')->count();
        $cantidad_pastores=Asistente::whereIn('asistentes.id', $asistentes_aux)->where('asistentes.tipo_asistente_id', '=', '5')->count();

        $asistentes->orderBy('id', 'asc')->take(10)->get();

        $total_ingresos = Ofrenda::where('reporte_reunion_id', '=', $id)->whereIn('asistente_id', $asistentes_aux)->sum("valor");

        $total_diezmos=Ofrenda::where('reporte_reunion_id', $id)->where('tipo_ofrenda', 0)->whereIn('asistente_id', $asistentes_aux)->sum("valor");
        $total_ofrendas=Ofrenda::where('reporte_reunion_id', $id)->where('tipo_ofrenda', 1)->whereIn('asistente_id', $asistentes_aux)->sum("valor");
        $total_pactos=Ofrenda::where('reporte_reunion_id', $id)->where('tipo_ofrenda', 2)->whereIn('asistente_id', $asistentes_aux)->sum("valor");
        $total_protemplo=Ofrenda::where('reporte_reunion_id', $id)->where('tipo_ofrenda', 3)->whereIn('asistente_id', $asistentes_aux)->sum("valor");
        $total_siembras=Ofrenda::where('reporte_reunion_id', $id)->where('tipo_ofrenda', 4)->whereIn('asistente_id', $asistentes_aux)->sum("valor");
        $total_primicias=Ofrenda::where('reporte_reunion_id', $id)->where('tipo_ofrenda', 5)->whereIn('asistente_id', $asistentes_aux)->sum("valor");
        $total_otros=Ofrenda::where('reporte_reunion_id', $id)->where('tipo_ofrenda', 6)->whereIn('asistente_id', $asistentes_aux)->sum("valor");
        $total_ofrendas_sueltas=Ofrenda::where('reporte_reunion_id', $id)->where('tipo_ofrenda', 7)->whereIn('asistente_id', $asistentes_aux)->sum("valor");
		
		
      
		if(!isset($reporte)) return App::abort(404);
		return View::make('reporte-reuniones.perfil')->with(array(
				'reporte' => $reporte,
				'status'  => '',
				'total_diezmos' => $total_diezmos,
		        'total_ofrendas' => $total_ofrendas,
		        'total_pactos' => $total_pactos,
		        'total_primicias' => $total_primicias,
		        'total_protemplo' => $total_protemplo,
		        'total_siembras' => $total_siembras,
		        'total_otros' => $total_otros,
		        'total_ofrendas_sueltas' => $total_ofrendas_sueltas,
		        'total_ingresos' => $total_ingresos,
		        'cantidad_total_asistentes' => $cantidad_total_asistentes,
				'cantidad_total_nuevos' => $cantidad_total_nuevos,
				'cantidad_total_ovejas' => $cantidad_total_ovejas,
				'cantidad_total_miembros' => $cantidad_total_miembros,
				'cantidad_total_lideres' => $cantidad_total_lideres,
				'cantidad_total_pastores' => $cantidad_total_pastores,
				'cantidad_todos' => $cantidad_todos,
				'cantidad_nuevos' => $cantidad_nuevos,
				'cantidad_ovejas' => $cantidad_ovejas,
				'cantidad_miembros' => $cantidad_miembros,
				'cantidad_lideres' => $cantidad_lideres,
				'cantidad_pastores' => $cantidad_pastores,
				'linea' => $linea,
				'lineas' => $lineas,
				'grupos' => $grupos,
				'grupo' => $grupo,
				'tipo' => $tipo,
			));

	}



/////////////////////////////METODOS AJAX

	////////// este es el ajax que devuelve los siguientes 10 asistentes para el panel de asistentes 
	public function postObtenerAsistentesAjax($id_linea_grupo="0;0;0;0", $vista, $cant_asistentes_cargados, $sql_adicional="", $buscar="")
	{
		$asistentes="";
		$total_asistentes=0;
		$cant_asistentes=0;
		$array=explode(';', $id_linea_grupo);
		$idreporte=$array[0];
		$grupo=$array[1];
		$linea=$array[2];
		$tipo=$array[3];

		$reporte= ReporteReunion::find($idreporte);
		$asistentes=$reporte->asistentes();

		if(Auth::user()->id!=1)
		{
			$discipulos=Auth::user()->asistente->discipulos('array');
			$asistentes=$asistentes->whereIn('asistentes.id', $discipulos);
		}

		

		if($grupo!="0"){
			$asistentes=  $asistentes->where('asistentes.grupo_id', $grupo);
			$linea="0";
	    }
		if($linea!="0"){
			$asistentes=$asistentes->where('linea_id', $linea);
	    }

	    $asistentes=Asistente::whereIn('id', Helper::obtenerArrayIds($asistentes->get()));

	    if($sql_adicional!="")
			$asistentes=$asistentes->whereRaw($sql_adicional);

	    $asistentes_aux=clone $asistentes;
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
		

		$total_asistentes=clone $asistentes;
		$total_asistentes=$total_asistentes->count();
		$asistentes=$asistentes->orderBy('asistentes.id', 'asc')->skip($cant_asistentes_cargados)->take(10)->get();

        $lista=""; 

        if($asistentes->count()>0)
        {
        	foreach($asistentes as $asistente)
	        {
				$ofrendas_asistente=$asistente->ofrendas()->where('reporte_reunion_id', '=', $idreporte)->get();
               	$total_asistente=0;
               	foreach ($ofrendas_asistente as $ofrenda_asistente) {
                        $total_asistente=$total_asistente+$ofrenda_asistente->valor;
               	}

	        	$lista.=' <li class="item-ingresos row"><!-- start message --> 
	                          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-5">
                             <center><img style="margin-right:-15px" src="/img/fotos/'.$asistente->foto.'" class="img-circle" width="70px" alt="User Image"></center> 
                              </div>
	                          <div class="col-lg-5 col-md-5 col-sm-5 col-xs-7">
	                            <p style="white-space: normal !important">
	                            <b>CÓDIGO: </b>'.$asistente->id.'<br>
	                            <b>NOMBRE: </b> '.$asistente->nombre.' '.$asistente->apellido.'
	                            </p> 
	                          </div> 
	                          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 text-center" >';
	            if ($vista=="perfil"){

	              	$lista.='<h4 style="margin:5px!important">
	                         <label id="ofrenda_'.$asistente->id.'" class="label arrowed-right label-success" data-total-asistente="'.$total_asistente.'">$';  
					$lista.=number_format((int)$total_asistente,0,',','.');             
	                      
	          		$lista.='</label>
	                       </h4>';
		        }
	            else
	            {

                    $lista.='<h4 style="margin:0px!important">
		                     <label id="ofrenda_'.$asistente->id.'" data-total-asistente="'.$total_asistente.'">$';  
					$lista.=number_format((int)$total_asistente,0,',','.');            
					$lista.='</label>
		                     </h4>
                             <a class="btn arrowed-right btn-sm btn-success abrir-panel-ofrendas" data-placement="top" data-nombre="'.$asistente->nombre.' '.$asistente->apellido.'" data-id="'.$asistente->id.'" data-toggle="modal" data-target=".modal-financiero">
                               <i class="fa fa-money fa-1x"></i> 
                               Actualizar Ingreso 
                             </a>';
			    }

                $lista.='</div> 
                            <br> 
	                     </li><!-- fin li --> ';
					                    
			}

		}
		else
		{
			$lista.='<li id="" class="" style="cursor:pointer">
	            <div class="col-xs-12 col-md-12 col-lg-12  bg-gray" >
	            <br>
	              <center>	                      	
	              		 <i class="fa fa-home fa-2x"> </i> ';
	        if($asistentes_aux->count()==0){
	        	$lista.="No se reporto ningún asistente";
	        	if($tipo!="todos")
	        	{
	        		if($tipo=="1")
	        			$lista.=" de tipo Nuevo";
	        		else if($tipo=="2")
	        			$lista.=" de tipo Oveja";
	        		else if($tipo=="3")
	        			$lista.=" de tipo Miembro";
	        		else if($tipo=="4")
	        			$lista.=" de tipo Lider";
	        		else if($tipo=="5")
	        			$lista.=" de tipo Pastor";
	        	}
	        	if($linea!="0")
	        	{
	        		$linea=Linea::find($linea);
	        		$lista.=" de la línea $linea->id - $linea->nombre";
	        	}
	        	if($grupo!="0")
	        	{
	        		$grupo_consultado=Grupo::find($grupo);
	        		$lista.=" del grupo $grupo_consultado->id - $grupo_consultado->nombre";
	        	}

	        	$lista.=" en esta reunión";
	        }
	        else{
	            $lista.='No hay asistentes que coincidan con la búsqueda <b>"'.$buscar.'"</b>';
	        }                      	
	                     
	        $lista.='</center>
	             <br>
	            </div>  
			</li>';
		}
        
        $lista.='<script type="text/javascript">
					  var cant_registros='.$asistentes->count().';
					  var total_registros_ajax='.$total_asistentes.';
				 </script>';
		return $lista;
	}
	
	//////función para crear el registro del asistente que llega a la reunión
	public function postRegistraAsistentesReunionAjax($idreporte="", $idasistente="")
	{
     	$reporte= ReporteReunion::find($idreporte);
	    $reporte->asistentes()->attach($idasistente); 
        //$respuesta='registrado con reporte '.$idreporte.' y asistente '.$idasistente;
	    $asistente=Asistente::find($idasistente);
	    $asistente->inactivo_iglesia=0;
		$asistente->save();

		///crea notificación
		$notificacion= new Notificacion;
		$notificacion->tipo_notificacion_id=1;
		$notificacion->nombre="Asistencia a la reunión";
		$notificacion->descripcion='Gracias por tu asistencia a la reunión "'.$reporte->reunion->nombre.'" del '.$reporte->fecha;
		$notificacion->estado=0;
		$date = new DateTime(); // obtiene la fecha del sistema
		date_default_timezone_set('America/Bogota');
		$fecha = $date->format('Y-m-d H:i:s'); // le doy formato a la fecha obtenida
		$notificacion->fecha=$fecha;
		$notificacion->url="#";
		if(Auth::user()->id==1)
		$notificacion->asistente_id=0;
		else
			$notificacion->asistente_id=Auth::user()->asistente->id;
		$notificacion->user_id=$asistente->user->id;
		///la siguiente informacion es para poder encontrar la notificacion en caso de que se borre al asistente de la asistencia a la reunion
		$notificacion->dato_adicional=$reporte->fecha;
		$notificacion->save();
		///lista la notificacion

		return "hecho";
	}

	////función que elimina el registro de una persona a quien se le dio que asistió por error
	public function postEliminaAsistentesReunionAjax($idreporte="", $idasistente="")
	{
     	$reporte= ReporteReunion::find($idreporte);
	    $reporte->asistentes()->detach($idasistente);


		$hoy = date("Y-m-d");
		$hace30dias = strtotime ( '-30 day' , strtotime ( $hoy ) ) ;
		$hace30dias = date ( 'Y-m-d' , $hace30dias );
      
	    $asistente=Asistente::find($idasistente);
	    $cantidad=0;
	    $cantidad=$asistente->reportesReunion()->where("reporte_reuniones.fecha", ">", $hace30dias)->count();
	    if($cantidad>0){
        $asistente->inactivo_iglesia=0;
	    }
	    else{
	    	$asistente->inactivo_iglesia=1;
	    }
		$asistente->save();

		//elimina la notificación
		$notificacion= Notificacion::where('dato_adicional', '=', $reporte->fecha)->where('user_id', '=', $asistente->user->id)->first();
		if(isset($notificacion))
		$notificacion->delete();

	    return "hecho";
	}

	///carga  los ingresos de una asistente en el modal financiero del reporte
    public function postCargaIngresosAjax($idreporte="", $idasistente="")
	{
		$ofrendas=  Ofrenda::where('asistente_id', '=', $idasistente)
		->where('reporte_reunion_id', '=', $idreporte)
		->get();

		$array_ofrendas = array(); 
        $i=0;
		foreach($ofrendas as $ofrenda) {
		$array_ofrendas[$i] = array('id'=>$ofrenda->id, 
							'tipo_ofrenda'=> $ofrenda->tipo_ofrenda, 
							'valor'=> $ofrenda->valor, 
							'observacion'=> $ofrenda->observacion, 
             				'asistente_id'=> $ofrenda->asistente_id,
							'reporte_reunion_id'=> $ofrenda->reporte_reunion_id); 
		$i++;
		}

        $json_ofrendas = json_encode($array_ofrendas);
	    return $json_ofrendas;

	}


	public function postAnadeIngresosAjax($idreporte="", $idasistente="", $valor_ingresado="", $tipo_ofrenda="", $observacion="")
	{

		            if($tipo_ofrenda!="7"){

					$reporte= ReporteReunion::find($idreporte);
     				$ofrenda= new Ofrenda();
					$ofrenda->tipo_ofrenda=$tipo_ofrenda;
					$ofrenda->valor=$valor_ingresado;
					$ofrenda->fecha=$reporte->fecha;
					$ofrenda->ingresada_por=0;
					$ofrenda->observacion=$observacion;
					$ofrenda->asistente_id=$idasistente;
					$ofrenda->reporte_reunion_id=$reporte->id;
					$ofrenda->save();
					$id=$ofrenda->id;

		            }
		            else{
                        
                        $cantidad=0;
		            	$cantidad= Ofrenda::where('tipo_ofrenda', '=', '7')
                        ->where('reporte_reunion_id', '=', $idreporte)
		            	->count();

		            	if($cantidad>0){

                        $id=$this->actualizarOfrenda($idreporte,$valor_ingresado,$observacion);

		            	}else{

		            		$reporte= ReporteReunion::find($idreporte);
		     				$ofrenda= new Ofrenda();
							$ofrenda->tipo_ofrenda=$tipo_ofrenda;
							$ofrenda->valor=$valor_ingresado;
							$ofrenda->fecha=$reporte->fecha;
							$ofrenda->ingresada_por=0;
							$ofrenda->observacion=$observacion;
							$ofrenda->reporte_reunion_id=$idreporte;
							$ofrenda->save();
							$id=$ofrenda->id;
		            	}
		            
		            }

	    return $id;
	}

	//añade un invitado en el reporte, es decir alguien que asiste pero no esta registrado en el programa.
	public function postAjaxAddInvitado($id_reporte)
	{
		$reporte= ReporteReunion::find($id_reporte);
		$invitados=$reporte->invitados;
		if($invitados!="")
			$invitados=((int)$invitados)+1;
		else
			$invitados=1;
		$reporte->invitados=$invitados;
		$reporte->save();
		return $invitados;
	}

	///elimina el registro de un invitado que se añadio por error.
	public function postAjaxDelInvitado($id_reporte)
	{
		$reporte= ReporteReunion::find($id_reporte);
		$invitados=$reporte->invitados;
		if($invitados!="" && $invitados!="0")
		{
			$invitados=((int)$invitados)-1;
			$reporte->invitados=$invitados;
			$reporte->save();
		}
		else
			$invitados=0;
		
		return $invitados;
	}

	///actualiza la ofrenda suelta del reporte
	public function actualizarOfrenda($idreporte="",$valor_ingresado="",$observacion=""){

		$ofrenda= Ofrenda::where('tipo_ofrenda', '=', '7')
        ->where('reporte_reunion_id', '=', $idreporte)
        ->first();
        $ofrenda->valor=$valor_ingresado;
        $ofrenda->observacion=$observacion;
        $ofrenda->save();
        $id=$ofrenda->id;
       	return $idreporte;                 
	}

	///elimina un ingreso del reporte
	public function postEliminaIngresosAjax($id_ofrenda="")
	{
        $ofrenda= Ofrenda::find($id_ofrenda);
			$ofrenda->delete();
     				
	    return $id_ofrenda;
	}

}
