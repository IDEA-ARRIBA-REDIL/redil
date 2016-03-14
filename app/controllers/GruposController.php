<?php
/** 
*
* @Redil Software. GruposController.php 
* @versión: 1.0.0     @modificado: 21 de Julio del 2014 
* @autor última modificación: Juan Carlos Velasquez
* 
*/

class GruposController extends BaseController
{

	public function __construct()
	{
		
		$this->beforeFilter('auth');  //bloqueo de acceso
		
	}

	public function getIndex()
	{
		return Redirect::to('grupos/lista/todos');

	}

	public function getLista($tipo="todos")
	{
		
		$fecha_actual = date('Y-m-j'); // Me trae la fecha actual de sistema
      	$nueva_fecha = strtotime ( '-30 day' , strtotime ( $fecha_actual ) ) ; // Esta funcion me coge la fecha_actual y le resta 30 dias
		$nueva_fecha = date ( 'Y-m-d' , $nueva_fecha ); // le doy formato Y-M-J a mi nueva fecha
		$buscar=null;
		$cantidad_busqueda=null;

		$cantidad_nuevos= Grupo::gruposNuevos()->count();
		$cantidad_grupos_sin_lideres=Grupo::gruposSinLider()->count();
		$grupos="";

		if(Auth::user()->id==1 || isset(Auth::user()->asistente->iglesiaEncargada()->first()->id))
		{
			$grupos=Grupo::whereRaw("1=1");
			$cantidad_todos= Grupo::where('grupos.dado_baja', '=', '0')->count();
			$cantidad_sin_actividad= Grupo::where('inactivo', '=', '1')->where('grupos.dado_baja', '=', '0')->count();
			$cantidad_dados_baja= Grupo::where('grupos.dado_baja', '=', '1')->count();
		}
		else
		{
			$grupos=Auth::user()->asistente->gruposMinisterio();
			$cantidad_todos= $grupos->where('grupos.dado_baja', '=', '0')->count();
			$cantidad_sin_actividad= $grupos->where('inactivo', '=', '1')->where('grupos.dado_baja', '=', '0')->count();
			$cantidad_dados_baja= $grupos->where('grupos.dado_baja', '=', '1')->count();
			$grupos=Auth::user()->asistente->gruposMinisterio();
		}
		

		if($tipo=="nuevos")
		{	
			$grupos = Grupo::gruposNuevos();
		}
		else if($tipo=="sin-actividad")
		{
			$grupos = $grupos->where('inactivo', '=', 1 )->where('dado_baja', 0);

		}
		else if($tipo=="dados-de-baja")
		{
			$grupos = $grupos->where('grupos.dado_baja', '=', '1');

		}
		else if($tipo=="grupos-sin-lideres")
		{
			$grupos=Grupo::gruposSinLider();
		}	
		else
		{
			Grupo::calcularGruposActivos();
			$grupos = $grupos->where('grupos.dado_baja', '=', '0');
		}

		if(isset($_GET["buscar"]))
		{
			$cantidad_busqueda=0;
			////////codigo para crear la consulta de la busqueda
			$buscar=Input::get("buscar");
			Global $sql_buscar;
			$buscar_array=explode(" ", $buscar);
			$sql_buscar="(";
			$c=0;
			
			foreach($buscar_array as $palabra)
			{
				if($c!=0)
					$sql_buscar.=" AND ";

				$sql_buscar.="(grupos.nombre ILIKE '%$palabra%' OR grupos.direccion ILIKE '%$palabra%' OR asistentes.nombre ILIKE '%$palabra%' OR asistentes.apellido ILIKE '%$palabra%'";
				if(ctype_digit($palabra))
					$sql_buscar.=" OR grupos.id=$palabra";
				$sql_buscar.=")";
				$c++;
			}
			$sql_buscar.=")";

			$grupos->whereRaw($sql_buscar)->leftJoin('encargados_grupo', 'grupos.id', '=', 'encargados_grupo.grupo_id')
				->leftJoin('asistentes', 'asistentes.id', '=', 'encargados_grupo.asistente_id');
			
			$grupos_ids_fin=Helper::obtenerArrayIds($grupos->get(array("grupos.id")));
			$grupos=Grupo::whereIn('grupos.id', $grupos_ids_fin);

			$cantidad_busqueda=$grupos->count();
		}

		$grupos=$grupos->orderBy('grupos.id', 'asc')->paginate(10);

		return View::make('grupos.index')-> with(
			array(
				'grupos' => $grupos,
				'tipo' => $tipo,
				'cantidad_todos' => $cantidad_todos,
				'cantidad_nuevos' => $cantidad_nuevos,
				'cantidad_sin_actividad' => $cantidad_sin_actividad,
				'cantidad_dados_baja' => $cantidad_dados_baja,
				'cantidad_grupos_sin_lideres' => $cantidad_grupos_sin_lideres,
				'nueva_fecha' => $nueva_fecha,
				'buscar' => $buscar,
				'cantidad_busqueda' => $cantidad_busqueda,
			));


	}


	public function postNew()
	{
		$grupo = new Grupo;
		$grupo->nombre=strtolower(Input::get('nombre'));
		$grupo->telefono = Input::get("telefono");
		$grupo->direccion = Input::get("direccion");
		$grupo->rhema = Input::get("rhema");
		$grupo->dia = Input::get("dia");
		$grupo->hora = Input::get("hora");
		if (Input::get ('fecha')!="")
		{
			$date = new DateTime(str_replace("/","-",Input::get ('fecha')));
			$fecha = $date->format('Y-m-d');
			$grupo->fecha_apertura = $fecha;
		}
		$grupo->tipo_grupo_id = Input::get("tipo_grupo");
		$grupo->inactivo = 0;
		$grupo->dado_baja = 0;

		$grupo->save();

		// Guardando las redes de ese grupo
		$redes= Input::get("redes");
		for ($i=0; $i < count($redes); $i++) { 
			$grupo->redes()->attach($redes[$i]);
		}

		////se notifica el super usuario que es el user 1
		if(Auth::user()->id!=1)
		{
			$descripcion_asistente="ha creado un nuevo grupo";
			$descripcion_administrador="";
			$url="/grupos/perfil/$grupo->id";
			Notificacion::notificarLideres(Auth::user()->asistente->id,2, "Nuevo Grupo", $descripcion_asistente, $descripcion_administrador, $url);
		}

		//////////fin notificacioens

		return Redirect::to('/grupos/actualizar/'.$grupo->id)->with(
			array(
				'status' => 'ok_new',
				'id_nuevo' => $grupo->id,
				'nombre_nuevo' => $grupo->nombre,
				)
		);

    }

    public function postUpdate($id)
	{
		$cont=0;
		$grupo = Grupo::find($id);
		if(!isset($grupo)) return App::abort(404);

		$grupo->nombre=strtolower(Input::get('nombre'));
		$grupo->telefono = Input::get("telefono");
		$grupo->direccion = Input::get("direccion");
		$grupo->rhema = Input::get("rhema");
		$grupo->dia = Input::get("dia");
		$grupo->hora = Input::get("hora");
		if (Input::get ('fecha')!="")
		{
			$date = new DateTime(str_replace("/","-",Input::get ('fecha')));
			$fecha = $date->format('Y-m-d');
			$grupo->fecha_apertura = $fecha;
		}
		$grupo->tipo_grupo_id = Input::get("tipo_grupo");
		
		$grupo->save();

		//  ------------- ACTUALIZACION DE LAS REDES 
		$redes_actuales= $grupo->redes;
		foreach ($redes_actuales as $red) {
			$grupo->redes()->detach($red);
		}
		$nuevas_redes= Input::get("redes"); // arreglo de nuevas redes. 
		for ($i=0; $i < count($nuevas_redes); $i++) { 
			$grupo->redes()->attach($nuevas_redes[$i]);
		}

		//  ------------- fin ACTUALIZACION DE LAS REDES 
		
		 // ------------- fin ACTUALIZACION ASISTENTES AL GRUPO   

		//return Redirect::to('users')->with('status', 'ok_update');
		return Redirect::to('/grupos/actualizar/'.$id)->with(
			array(
				'status' => 'ok_update',
				 ));
	}

	public function getNuevo()
	{
		
		$redes = Red:: all ();
		$tipo_grupos = TipoGrupo:: all ();
		
		return View::make('grupos.nuevo')->with(
			array(
				'redes'=> $redes,
				'tipo_grupos'=> $tipo_grupos,
			));
	}

	public function getInformes(){
		return View::make('grupos.informes.lista-informes');
	}

	public function getMapa(){
		return View::make('grupos.mapa-grupos');
	}

	public function getInformePromediosAsistencia(){
		$buscar=null;
		$rango=null;
		$anio=null;
		$fecha_inicio=null;
		$fecha_fin=null;
		$linea=null;
		if(Auth::user()->id==1)
			$lineas=Linea::all();
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

		}

		$grupos= Grupo::where('grupos.dado_baja', '=', 0);

		// si no es el administrador filtra solo los grupos que le corresponden al usuario.  
		if(Auth::user()->id!=1)
		{
			$grupos= Auth::user()->asistente->gruposMinisterio();
		}

		if (isset($_GET["linea"])){
			$linea=$_GET["linea"];

			if($linea!=""){
				$linea_seleccionada=Linea::find($linea);
				$grupos=$linea_seleccionada->grupos();
			}
		}

		if(isset($_GET["buscar"]))
		{
			$cantidad_busqueda=0;
			////////codigo para crear la consulta de la busqueda
			$buscar=Input::get("buscar");
			Global $sql_buscar;
			$buscar_array=explode(" ", $buscar);
			$sql_buscar="(";
			$c=0;
			
			foreach($buscar_array as $palabra)
			{
				if($c!=0)
					$sql_buscar.=" AND ";

				$sql_buscar.="(grupos.nombre ILIKE '%$palabra%' OR grupos.direccion ILIKE '%$palabra%' OR asistentes.nombre ILIKE '%$palabra%' OR asistentes.apellido ILIKE '%$palabra%'";
				if(ctype_digit($palabra))
					$sql_buscar.=" OR grupos.id=$palabra";
				$sql_buscar.=")";
				$c++;
			}
			$sql_buscar.=")";

			$grupos->whereRaw($sql_buscar)->leftJoin('encargados_grupo', 'grupos.id', '=', 'encargados_grupo.grupo_id')
				->leftJoin('asistentes', 'asistentes.id', '=', 'encargados_grupo.asistente_id');
			
			$grupos_ids_fin=Helper::obtenerArrayIds($grupos->get(array("grupos.id")));
			$grupos=Grupo::whereIn('grupos.id', $grupos_ids_fin);

			$cantidad_busqueda=$grupos->count();
		}
		$meses=array();

		if(!isset($_GET["rango"]))
		{
			//$trimestre=(int)floor(date('m', strtotime(date('Y-m-d'))) / 3.1) + 1;
			//$rango= $trimestre.'t';
			$rango= 'anio';
		}
		else
		{
			$rango=$_GET["rango"];
		}

		if(!isset($_GET["anio"])){
			$anio=date('Y');
		}
		else
		{
			$anio=$_GET["anio"];
		}

		if($rango=="1t")
		{
			$fecha_inicio=$anio.'-01-01';
			$fecha_fin=Helper::finalMes($anio,3);
		}
		else if($rango=="2t")
		{
			$fecha_inicio=$anio.'-04-01';
			$fecha_fin=Helper::finalMes($anio,6);
		}
		else if($rango=="3t")
		{
			$fecha_inicio=$anio.'-07-01';
			$fecha_fin=Helper::finalMes($anio,9);
		}
		else if($rango=="4t")
		{
			$fecha_inicio=$anio.'-10-01';
			$fecha_fin=Helper::finalMes($anio,12);
		}
		else if($rango=="1s")
		{
			$fecha_inicio=$anio.'-01-01';
			$fecha_fin=Helper::finalMes($anio,6);
		}
		else if($rango=="2s")
		{
			$fecha_inicio=$anio.'-07-01';
			$fecha_fin=Helper::finalMes($anio,12);
		}
		else if($rango=="anio")
		{
			$fecha_inicio=$anio.'-01-01';
			$fecha_fin=Helper::finalMes($anio,12);
		}

		if(isset($_GET["orden"])){
			$orden=$_GET["orden"];
		}
		else
		{
			$orden='desc';
		}

		if(isset($_GET["ordenado-por"])){
			$ordenado_por=$_GET["ordenado-por"];
		}
		else
		{
			$ordenado_por='promedio';
		}

		$mes_inicio=(int)date('m', strtotime($fecha_inicio));
		$mes_fin=(int)date('m', strtotime($fecha_fin));
		$total_meses=($mes_fin-$mes_inicio)+1;

		$grupos= $grupos->leftJoin("reporte_grupos", "grupos.id", "=", "reporte_grupos.grupo_id")
		->leftJoin("asistencia_grupos", "reporte_grupos.id", "=", "asistencia_grupos.reporte_grupo_id")
		->select(DB::raw("grupos.id, grupos.nombre, CASE WHEN count(DISTINCT reporte_grupos.id)>0 THEN ((count(asistencia_grupos.id)+reporte_grupos.invitados)/count(DISTINCT reporte_grupos.id)) ELSE 0 END as promedio"))
		->whereRaw("((reporte_grupos.fecha>='$fecha_inicio' AND reporte_grupos.fecha<='$fecha_fin'))")
		
		->orderBy($ordenado_por, $orden)
		->groupBy("grupos.id", 'nombre', 'invitados', 'direccion', 'telefono', 'rhema', 'fecha_apertura', 'dia', 'hora', 'nivel', 'inactivo', 'dado_baja', 'tipo_grupo_id',  'grupos.updated_at', 'grupos.created_at', 'grupo_padre', 'reuniones_por_mes')
		->paginate(10);

		return View::make('grupos.informes.promedios-asistencia')-> with(
			array(
				'grupos' => $grupos,
				'buscar' => $buscar,
			    'linea' => $linea,
				'fecha_inicio' => $fecha_inicio,
				'fecha_fin' => $fecha_fin,
				'rango' => $rango,
			    'lineas' => $lineas,
			    'mes_inicio' => $mes_inicio,
			    'mes_fin' => $mes_fin,
			    'anio' => $anio,
			    'ordenado_por' => $ordenado_por,
				'orden' => $orden,
				 )
		);
	}


	public function getInformeCantidadReportes(){
		$buscar=null;
		$rango=null;
		$anio=null;
		$fecha_inicio=null;
		$fecha_fin=null;
		$linea=null;
		if(Auth::user()->id==1)
			$lineas=Linea::all();
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

		}

		$grupos= Grupo::where('grupos.dado_baja', '=', 0);

		// si no es el administrador filtra solo los grupos que le corresponden al usuario.  
		if(Auth::user()->id!=1)
		{
			$grupos= Auth::user()->asistente->gruposMinisterio();
		}

		if (isset($_GET["linea"])){
			$linea=$_GET["linea"];

			if($linea!=""){
				$linea_seleccionada=Linea::find($linea);
				$grupos=$linea_seleccionada->grupos();
			}
		}

		if(isset($_GET["buscar"]))
		{
			$cantidad_busqueda=0;
			////////codigo para crear la consulta de la busqueda
			$buscar=Input::get("buscar");
			Global $sql_buscar;
			$buscar_array=explode(" ", $buscar);
			$sql_buscar="(";
			$c=0;
			
			foreach($buscar_array as $palabra)
			{
				if($c!=0)
					$sql_buscar.=" AND ";

				$sql_buscar.="(grupos.nombre ILIKE '%$palabra%' OR grupos.direccion ILIKE '%$palabra%' OR asistentes.nombre ILIKE '%$palabra%' OR asistentes.apellido ILIKE '%$palabra%'";
				if(ctype_digit($palabra))
					$sql_buscar.=" OR grupos.id=$palabra";
				$sql_buscar.=")";
				$c++;
			}
			$sql_buscar.=")";

			$grupos->whereRaw($sql_buscar)->leftJoin('encargados_grupo', 'grupos.id', '=', 'encargados_grupo.grupo_id')
				->leftJoin('asistentes', 'asistentes.id', '=', 'encargados_grupo.asistente_id');
			
			$grupos_ids_fin=Helper::obtenerArrayIds($grupos->get(array("grupos.id")));
			$grupos=Grupo::whereIn('grupos.id', $grupos_ids_fin);
		}
		$meses=array();

		if(!isset($_GET["rango"]))
		{
			//$trimestre=(int)floor(date('m', strtotime(date('Y-m-d'))) / 3.1) + 1;
			//$rango= $trimestre.'t';
			$rango= 'anio';
		}
		else
		{
			$rango=$_GET["rango"];
		}

		if(!isset($_GET["anio"])){
			$anio=date('Y');
		}
		else
		{
			$anio=$_GET["anio"];
		}

		if($rango=="1t")
		{
			$fecha_inicio=$anio.'-01-01';
			$fecha_fin=Helper::finalMes($anio,3);
		}
		else if($rango=="2t")
		{
			$fecha_inicio=$anio.'-04-01';
			$fecha_fin=Helper::finalMes($anio,6);
		}
		else if($rango=="3t")
		{
			$fecha_inicio=$anio.'-07-01';
			$fecha_fin=Helper::finalMes($anio,9);
		}
		else if($rango=="4t")
		{
			$fecha_inicio=$anio.'-10-01';
			$fecha_fin=Helper::finalMes($anio,12);
		}
		else if($rango=="1s")
		{
			$fecha_inicio=$anio.'-01-01';
			$fecha_fin=Helper::finalMes($anio,6);
		}
		else if($rango=="2s")
		{
			$fecha_inicio=$anio.'-07-01';
			$fecha_fin=Helper::finalMes($anio,12);
		}
		else if($rango=="anio")
		{
			$fecha_inicio=$anio.'-01-01';
			$fecha_fin=Helper::finalMes($anio,12);
		}

		if(isset($_GET["orden"])){
			$orden=$_GET["orden"];
		}
		else
		{
			$orden='desc';
		}

		if(isset($_GET["ordenado-por"])){
			$ordenado_por=$_GET["ordenado-por"];
		}
		else
		{
			$ordenado_por='cantidad_reportes';
		}

		$mes_inicio=(int)date('m', strtotime($fecha_inicio));
		$mes_fin=(int)date('m', strtotime($fecha_fin));
		$total_meses=($mes_fin-$mes_inicio)+1;

		$grupos= $grupos->leftJoin("reporte_grupos", "grupos.id", "=", "reporte_grupos.grupo_id")
		->select(DB::raw("grupos.id, grupos.nombre, CASE WHEN (count(DISTINCT reporte_grupos.id)>0) THEN count(DISTINCT reporte_grupos.id) ELSE 0 END as cantidad_reportes, 
			CASE WHEN (count(DISTINCT reporte_grupos.id)>0) THEN sum(to_timestamp((reporte_grupos.fecha)||' '||grupos.hora,'yyyy-mm-dd hh24:mi:ss')-reporte_grupos.created_at) ELSE '00:00:00' END as retrazo_reportar"))
		->whereRaw("((reporte_grupos.fecha>='$fecha_inicio' AND reporte_grupos.fecha<='$fecha_fin'))")
		->orderBy($ordenado_por, $orden)
		->orderBy("retrazo_reportar", $orden)
		->groupBy("grupos.id", 'nombre', 'direccion', 'telefono', 'rhema', 'fecha_apertura', 'dia', 'hora', 'nivel', 'inactivo', 'dado_baja', 'tipo_grupo_id',  'grupos.updated_at', 'grupos.created_at', 'grupo_padre', 'reuniones_por_mes')
		->paginate(10);

		return View::make('grupos.informes.cantidad-reportes')-> with(
			array(
				'grupos' => $grupos,
				'buscar' => $buscar,
			    'linea' => $linea,
				'fecha_inicio' => $fecha_inicio,
				'fecha_fin' => $fecha_fin,
				'rango' => $rango,
			    'lineas' => $lineas,
			    'mes_inicio' => $mes_inicio,
			    'mes_fin' => $mes_fin,
			    'anio' => $anio,
			    'ordenado_por' => $ordenado_por,
				'orden' => $orden,
				 )
		);
	}

	public function getInformeCantidadIntegrantes(){
		$buscar=null;
		$anio=null;
		$fecha_inicio=null;
		$fecha_fin=null;
		$linea=null;
		if(Auth::user()->id==1)
			$lineas=Linea::all();
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

		}

		$grupos= Grupo::where('grupos.dado_baja', '=', 0);

		// si no es el administrador filtra solo los grupos que le corresponden al usuario.  
		if(Auth::user()->id!=1)
		{
			$grupos= Auth::user()->asistente->gruposMinisterio();
		}

		if (isset($_GET["linea"])){
			$linea=$_GET["linea"];

			if($linea!=""){
				$linea_seleccionada=Linea::find($linea);
				$grupos=$linea_seleccionada->grupos();
			}
		}

		if(isset($_GET["buscar"]))
		{
			$cantidad_busqueda=0;
			////////codigo para crear la consulta de la busqueda
			$buscar=Input::get("buscar");
			Global $sql_buscar;
			$buscar_array=explode(" ", $buscar);
			$sql_buscar="(";
			$c=0;
			
			foreach($buscar_array as $palabra)
			{
				if($c!=0)
					$sql_buscar.=" AND ";

				$sql_buscar.="(grupos.nombre ILIKE '%$palabra%' OR grupos.direccion ILIKE '%$palabra%' OR asistentes.nombre ILIKE '%$palabra%' OR asistentes.apellido ILIKE '%$palabra%'";
				if(ctype_digit($palabra))
					$sql_buscar.=" OR grupos.id=$palabra";
				$sql_buscar.=")";
				$c++;
			}
			$sql_buscar.=")";

			$grupos->whereRaw($sql_buscar)->leftJoin('encargados_grupo', 'grupos.id', '=', 'encargados_grupo.grupo_id')
				->leftJoin('asistentes', 'asistentes.id', '=', 'encargados_grupo.asistente_id');
			
			$grupos_ids_fin=Helper::obtenerArrayIds($grupos->get(array("grupos.id")));
			$grupos=Grupo::whereIn('grupos.id', $grupos_ids_fin);

			$cantidad_busqueda=$grupos->count();
		}
		$meses=array();

		if(!isset($_GET["anio"])){
			$anio=date('Y');
		}
		else
		{
			$anio=$_GET["anio"];
		}

		$fecha_inicio=$anio.'-01-01';
		$fecha_fin=Helper::finalMes($anio,12);


		$mes_inicio=(int)date('m', strtotime($fecha_inicio));
		$mes_fin=(int)date('m', strtotime($fecha_fin));
		$total_meses=($mes_fin-$mes_inicio)+1;

		$grupos= $grupos->orderBy('grupos.id', 'asc')->groupBy('id', 'nombre', 'direccion', 'telefono', 'rhema', 'fecha_apertura', 'dia', 'hora', 'nivel', 'inactivo', 'dado_baja', 'tipo_grupo_id',  'grupos.updated_at', 'grupos.created_at', 'grupo_padre', 'reuniones_por_mes')->paginate(10);

		return View::make('grupos.informes.cantidad-integrantes')-> with(
			array(
				'grupos' => $grupos,
				'buscar' => $buscar,
			    'linea' => $linea,
				'fecha_inicio' => $fecha_inicio,
				'fecha_fin' => $fecha_fin,
			    'lineas' => $lineas,
			    'mes_inicio' => $mes_inicio,
			    'mes_fin' => $mes_fin,
			    'anio' => $anio,
				 )
		);
	}


	public function getArbol()
	{
		
		$linea=null;
		$grupo=null;
		$grupos_arbol=Grupo::gruposPrincipales()->get();
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

		return View::make('grupos.arbol')-> with(
			array(
				'linea' => $linea,
				'lineas' => $lineas,
				'grupos' => $grupos,
				'grupos_arbol' => $grupos_arbol,
				'grupo' => $grupo,
			));
	}

	public function getAnadirLideres($id)
	{
		$grupo= Grupo::find($id);
		if(!isset($grupo)) return App::abort(404);
		if(Auth::user()->id!=1)
		{
			if(!isset(Auth::user()->asistente->gruposMinisterio()->find($id)->id)) return App::abort(404);
		}
		return View::make('grupos.anadir-lideres')->with(
			array(
				'grupo'=> $grupo,
			));
	}

	///función para mostrar la vista de añadir integrantes al grupo
	public function getAnadirAsistentes($id)
	{
		$grupo= Grupo::find($id);
		if(!isset($grupo)) return App::abort(404);
		if(Auth::user()->id!=1)
		{
			if(!isset(Auth::user()->asistente->gruposMinisterio()->find($id)->id)) return App::abort(404);
		}
		return View::make('grupos.anadir-asistentes')->with(
			array(
				'grupo'=> $grupo,
			));
	}

	public function getPerfil($id)
	{
		$grupo = Grupo::find($id);
		$mes_actual = date('Y-m'); // Me trae la fecha actual de sistema
		if(!isset($grupo)) return App::abort(404);
		if(Auth::user()->id!=1)
		{
			if(!isset(Auth::user()->asistente->gruposMinisterio()->find($id)->id)) return App::abort(404);
		}

		return View::make('grupos.perfil')->with(
			array(
				'grupo' => $grupo,
				'mes_actual' => $mes_actual,
		));
	}

	public function getActualizar($id)
	{
		$grupo = Grupo::find($id);
		if(!isset($grupo)) return App::abort(404);
		if(Auth::user()->id!=1)
		{
			if(!isset(Auth::user()->asistente->gruposMinisterio()->find($id)->id)) return App::abort(404);
		}

		$redes = Red:: all ();
		$tipo_grupos = TipoGrupo:: all ();
		
		return View::make('grupos.actualizar')->with(
			array(
				'grupo'=> $grupo,
				'redes'=> $redes,
				'tipo_grupos'=> $tipo_grupos,
			));
	}

	public function getPdf($id)
	{
		$grupo = Grupo::find($id);
		$html=View::make('grupos.reportes.asistentes-grupo-pdf')-> with(
			array(
				'grupo' => $grupo,
				 ));
    	return PDF::load(utf8_decode($html), 'A4', 'portrait')->show();//->download('my_pdf');
	}

	public function getReportesGrupos($tipo)
	{

		$fecha_actual = date('Y-m-d'); // Me trae la fecha actual de sistema
      	$nueva_fecha = strtotime ( '-30 day' , strtotime ( $fecha_actual ) ) ; // Esta funcion me coge la fecha_actual y le resta 30 dias
		$nueva_fecha = date ( 'Y-m-d' , $nueva_fecha ); // le doy formato Y-M-J a mi nueva fecha
		
		
		if($tipo=="nuevos")
		{	
			$grupos = Grupo::where('fecha_apertura', '>', $nueva_fecha )->get();			
			$cantidad= Grupo::where('fecha_apertura', '>', $nueva_fecha )->count();

		}
		else if($tipo=="sin-actividad")
		{
			$grupos = Grupo::where('inactivo', '=', 1 )->where('dado_baja', 0)->get();
			$cantidad=Grupo::where('inactivo', '=', 1 )->where('dado_baja', 0)->count();
		}
		else if($tipo=="dados-de-baja")
		{
			$grupos = Grupo::where('dado_baja', '=', '1')->get();
			$cantidad= Grupo::where('dado_baja', '=', '1')->count();
		}
		else if($tipo=="grupos-sin-lideres")
		{
			$grupos= Grupo::gruposSinLider()->get();

	        $cantidad= Grupo::gruposSinLider()->count();
		}	
		else
		{
			$grupos = Grupo::where('dado_baja', '=', '0')->get();
			$cantidad= Grupo::where('dado_baja', '=', '0')->count();
		}
		
		$html=View::make('grupos.reportes.grupos-pdf')-> with(
			array(
				'grupos' => $grupos,
				'cantidad' => $cantidad,
				'tipo' => $tipo,
				 ));
    	return PDF::load(utf8_decode($html), 'A4', 'landscape')->show();//->download('my_pdf');
	}

	public function postDiaCelula($id_grupo)
	{
		return Grupo::find($id_grupo)->dia;
	}


	public function getDadoBajaAlta($id)
	{
		
		$grupo= Grupo::find($id);

		$lineas= Linea::orderBy("id", 'asc')
            ->take(10)
            ->get();



		//esto es para conocer la cantidad de grupos a cargo del grupo	
		$grupos_dependientes=$grupo->gruposHijos()->count();
		// ------

		$cantidad_asistentes=$grupo->asistentes->count();

		$grupos= Grupo::where('dado_baja','=','0')->get();

		// Obtiene los asistentes que pueden ser encargados de grupo + los lideres de linea

			// encargados_linea son los asistentes que no estan dados de baja y que pertenecen a una linea
			//$encargados_linea= $grupo->linea->encargados;

			// asistentes son los encargados de la linea + los asistentes que pertentece a la linea 
			//$asistentes= Asistente::where('dado_baja','=','0')
			$asistentes= Asistente::where('linea_id','=', $grupo->linea_id)
							->where('tipo_asistente_id','>', '2')
							//->unionAll($encargados_linea)
							->take(10)
				            ->get();

		//  fin Obtiene los asistentes que pueden ser encargados de grupo + los lideres de linea

		return View::make('grupos.dado-baja-alta')->with(
			array(
				'grupo' => $grupo,
				'grupos_dependientes' => $grupos_dependientes,
				'cantidad_asistentes' => $cantidad_asistentes,
				'grupos' => $grupos,
				'lineas' => $lineas,
				'asistentes' => $asistentes,
			)
		);
		
	}

	public function postCambiarDadoBajaAlta($id)
	{
		include '../app/views/includes/terminos.php'; 
		$grupo= Grupo::find($id);

		// Esto es para guardar el reporte de dado (baja/alta)
		$reporte = new ReporteGrupoBajaAlta;
		$reporte->motivo= Input::get('motivo');
		$reporte->observaciones= Input::get('observaciones');		
			
		if ($grupo->dado_baja == 0)
		{
			$reporte->dado_baja= 1;

			$nuevo_grupo= Input::get('grupo_id');
			if($nuevo_grupo!="")
			{
				$asistentes= $grupo->asistentes;

				foreach ($asistentes as  $asistente) {
					// Le asiguno al asistente a su nuevo grupo
					$asistente->cambiarGrupo($nuevo_grupo);
					$asistente->save();
				}

			} else
			{
				$asistentes= $grupo->asistentes;

				foreach ($asistentes as  $asistente) {
					// Le asiguno al asistente en su grupo_id=NULL
					$asistente->grupo_id= null;
					$asistente->save();
				}
			}
			// codigo para eliminar los servidores del grupo al que se esta dando de baja
			foreach ($grupo->servidores as $asistente) {
				$servidor=ServidorGrupo::where('grupo_id', $grupo->id)->where('asistente_id', $asistente->id)->first();
				if(isset($servidor->id))
				{
					$servicios=$servidor->tipoServicioGrupo()->detach();
				}
			}
			$grupo->servidores()->detach();

			// fin codigo para eliminar los servidores del grupo al que se esta dando de baja

		} else
		{
			$reporte->dado_baja= 0;
		}
			
		$reporte->grupo_id= $id;
		// ---------- Fecha -------------
		$date = new DateTime(); // obtiene la fecha del sistema
		$fecha = $date->format('Y-m-d'); // le doy formato a la fecha obtenida
		$reporte->fecha= $fecha; 
		// ---------- Fecha -------------

		$reporte->save();

		// Convierte el grupo 
		if ($grupo->dado_baja == 0)
		{
			$grupo->dado_baja= 1; 
			
			$mensaje= Helper::articulo($termino_grupo->genero, 'singular')." ".$termino_grupo->singular." fue $texto_dado da baja con exito.";
			$opcion="baja";
		} else
		{
			$grupo->dado_baja= 0;	
			$mensaje= Helper::articulo($termino_grupo->genero, 'singular')." ".$termino_grupo->singular." fue $texto_dado de alta con exito.";
			$opcion="alta";
		}	
		if($grupo->save()){
			foreach ($grupo->encargados as $encargado) {
				$contador_grupos= $encargado->grupos()->where('dado_baja', 0)->count();
                if($contador_grupos<1){
                    $encargado->tipo_asistente_id=3;
                    $encargado->user->activo=0; // cambia el a inactivo, es decir no lo deja entrar a la plataforma. 
                    $encargado->user->save(); // Guarda los cambio de usuario. 
                    $encargado->save();
                }
                else{
                	$encargado->tipo_asistente_id=4;
                    $encargado->user->activo=1; // cambia el a inactivo, es decir no lo deja entrar a la plataforma. 
                    $encargado->user->save(); // Guarda los cambio de usuario. 
                    $encargado->save();
                }
			}
			if(isset($grupo->encargados()->first()->id))
			{
				$descripcion_asistente="ha dado de $opcion a uno de tus grupos";
				$descripcion_administrador="ha dado de $opcion a un grupo";
				$url="/grupos/perfil/$grupo->id";
				Notificacion::notificarLideres($grupo->encargados()->first()->id, 2, "Grupo dado de baja", $descripcion_asistente, $descripcion_administrador, $url);
			}
		}

		return Redirect::to('/grupos/dado-baja-alta/'.$id)->with(
			array(
				'mensaje'=> $mensaje,
			)
		);
		
	}

	public function postGrupoSeleccionado($id, $class, $col_lg, $col_sm) 
	{
		$grupo=Grupo::find($id);
		$respuesta='<div class="grupo_seleccionado" style="padding: 5px;" id="item-'.$class.'-'.$id.'" class="col-lg-'.$col_lg.' col-md-'.$col_lg.' col-sm-'.$col_sm.' col-xs-'.$col_sm.'">';
		$respuesta.='<div class="item-seleccionado">';
		$respuesta.='<div id="ico-'.$class.'" class="col-xs-4 col-sm-4 col-md-3 col-lg-3 bg-orange" >';
        $respuesta.=   '<center><i class="fa fa fa-share-alt fa-4x" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></i></center>';
        $respuesta.='</div>';
        $respuesta.='<div id="info-'.$class.'" class="info-item col-xs-7 col-sm-7 col-md-8 col-lg-8 ">';
		$respuesta.='<h4 class="titulo"><b>'.$class.' </b></h4>';
		$respuesta.='<h3 class="capitalize">'.$grupo->nombre.'</h3>';
		$respuesta.='<p><b>Codigo de '.$class.':</b>'.$grupo->id.'</p>';
		if(isset($grupo->linea()->id))
		$respuesta.='<p><b>Linea: </b>'.$grupo->linea()->nombre.'<br>';
	    	if ($grupo->encargados->count()>0)
		        foreach ($grupo->encargados as $encargado)
		        {
		          if ($encargado->tipoAsistente['id']==5)
		          {
		          	$respuesta.='<label class="label arrowed-right bg-purple" data-toggle="tooltip" data-placement="top" title="'.$encargado->tipoAsistente['nombre'].'"><i class="fa fa-book" style="margin-right:15 px;"> </i></label>';
		          }elseif($encargado->tipoAsistente['id']==4)
		          {
		          	$respuesta.='<label class="label arrowed-right bg-orange" data-toggle="tooltip" data-placement="top" title="'.$encargado->tipoAsistente['nombre'].'"><i class="fa fa-star" style="margin-right:15 px;"> </i></label>';
		          }
		            
		           $respuesta.=' <span class="capitalize">'.$encargado->nombre.' '.$encargado->apellido.'</span><br>';
		        }
		    else 
		    {
		    	 $respuesta.='Esta grupo no tiene ningun encargado. ';
		    }
		$respuesta.='</p></div>';
		$respuesta.='<div class="cerrar no-padding col-xs-1 col-sm-1 col-md-1 col-lg-1" style="background-color:#fff;border-color:#fff" alert alert-success>
		<button id="cerrar-'.$class.'" data-id="'.$id.'" name="cerrar-'.$class.'" type="button" class="close cerrar-'.$class.'-seleccionado" style="font-size:27px;outline:none" aria-hidden="true">×</button>
		</div>';
		$respuesta.='</div></div>';
		return $respuesta;
	}


/////////////////////////esta es la parte de la busqueda tipo FACEBOOK de grupos/////////////////////////////////////////////////////////
	//Metodo ajax: LineaSeleccionada
	//  Recibe como parámetro un el id de la línea que se seleccione. 
	//  Retrona un de forma grafica el nombre de la linea, el codigo y los encargado(s)
	

	////////// este es el ajax que devuelve las siguientes 10 grupos para el panel de grupos 
	public function postObtieneGruposParaBusquedaAjax($class, $id, $cant_grupos_cargados, $sql_adicional="", $buscar="")
	{
		
		$grupos="";
		$cant_grupos=0;
		$total_grupos=0;

		$grupos=Grupo::where('grupos.dado_baja', '0');

		if($id!="todos" && $id!="0"){
			$linea=Linea::find($id);
			$grupos=$linea->grupos();
		}

		if(Auth::user()->id!=1)
	    {
	    	$grupos= Auth::user()->asistente->gruposMinisterio();
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
				$sql_buscar.="(grupos.nombre ILIKE '%$palabra%' OR encargado.nombre ILIKE '%$palabra%' OR encargado.apellido ILIKE '%$palabra%'";
				if(ctype_digit($palabra))
					$sql_buscar.=" OR grupos.id=$palabra";
				$sql_buscar.=")";
				$c++;
			}


			$grupos = Helper::obtenerArrayIds($grupos->leftJoin('encargados_grupo', 'grupos.id', '=', 'encargados_grupo.grupo_id')
						->leftJoin('asistentes AS encargado', 'encargado.id', '=', 'encargados_grupo.asistente_id')
						->where(function($query)
						{
			            	$sql_buscar_l=$GLOBALS['sql_buscar']; /// sql_buscar_l local
			                $query->whereRaw($sql_buscar_l);
			            })
						->get(array('grupos.id')));

			$grupos=Grupo::whereIn('grupos.id', $grupos);


		}

		$total_grupos=$grupos->get()->count();
		$grupos=$grupos->orderBy('grupos.id', 'asc')->skip($cant_grupos_cargados)->take(10)->get();

        $lista=""; 

        if($grupos->count()>0)
        {
	        foreach($grupos as $grupo)
	        {
	        	$lista.=' <li id="" class="" style="cursor:pointer"><!-- start message --> 
	                        <a class="seleccionar-'.$class.'" data-nombre="'.$grupo->nombre.'" data-id="'.$grupo->id.'">                                      
	                          <div class="col-lg-4  col-md-4 col-xs-4">
	                            <p style="white-space: normal!important;">
	                            <b>CÓDIGO: </b>'.$grupo->id.'<br>
	                            <b>NOMBRE: </b> <span class="capitalize">'.$grupo->nombre.'</span>
	                            </p> 
	                          </div>  
	                          <div style="white-space: normal!important;" class="col-lg-8  col-md-8 col-xs-8">
	                            <b>ENCARGADOS: </b> <br>';
	                            if ($grupo->encargados->count()>0)
							        foreach ($grupo->encargados as $encargado)
							        {
							          if ($encargado->tipoAsistente['id']==5)
							          {
							          	$lista.='<label class="label arrowed-right bg-purple" data-toggle="tooltip" data-placement="top" title="'.$encargado->tipoAsistente['nombre'].'"><i class="fa fa-book" style="margin-right:15 px;"> </i></label>';
							          }elseif($encargado->tipoAsistente['id']==4)
							          {
							          	$lista.='<label class="label arrowed-right bg-orange" data-toggle="tooltip" data-placement="top" title="'.$encargado->tipoAsistente['nombre'].'"><i class="fa fa-star" style="margin-right:15 px;"> </i></label>';
							          }
							            
							           $lista.=' <span class="capitalize">'.$encargado->nombre.' '.$encargado->apellido.'</span><br>';
							        }
							    else 
							    {
							    	 $lista.='Esta Grupo no tiene ningun encargado. ';
							    }
	            $lista.=     '</div> 
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
	                      		 <i class="fa fa-share-alt fa-2x"> </i> No hay grupos que coincida con la busqueda <b>"'.$buscar.'"</b> 	                      	
	                      </center>
	                     <br>
	                    </div>  
        			</li>';
        }
        $lista.=     '
                     <script type="text/javascript">
					  var cant_registros='.$grupos->count().';
					  var total_registros_ajax='.$total_grupos.';
					</script>';
		return $lista; 
	}
	

/* /////////////// METODOS AJAX PARA BUSQUEDA PARA ASIGNACIÓN DE LIDERES /////////////*/
	/*esta funcion es para la busqueda de asistentes para asignar lideres,
	construye el sql necesario para saber que asistentes pueden ser añadidos*/
	public function postConstruyeSqlLideresAptosAjax($id_grupo){
		$grupo= Grupo::find($id_grupo);
		$sql_adicional="(3=3 ";
		if(isset($grupo->encargados()->first()->grupo->id))
		{
	      	$grupo_id=$grupo->encargados()->first()->grupo_id;
	    	$sql_adicional.="AND asistentes.grupo_id=".$grupo_id;
	    }

	    foreach($grupo->encargados as $encargado)
	    {
	      $sql_adicional.=" AND asistentes.id<>".$encargado->id;
	    }

	    foreach($grupo->asistentes as $asistente)
	    {
	      $sql_adicional.=" AND asistentes.id<>".$asistente->id;
	    }

	    $pastores=Iglesia::find(1)->pastoresEncargados;
        foreach($pastores as $encargado){
          $sql_adicional.=" AND asistentes.id<>".$encargado->id;
        }

	    $sql_adicional.=" AND asistentes.grupo_id IS NOT NULL AND asistentes.linea_id IS NOT NULL)";
	    
	    return $sql_adicional;
	}


	public function postAsignarLiderGrupoAjax($id_grupo, $id_asistente){
		$grupo= Grupo::find($id_grupo);
		return $grupo->asignarEncargado($id_asistente);
	}

	public function postEliminarLiderGrupoAjax($id_grupo, $id_asistente){
		$grupo= Grupo::find($id_grupo);
		return $grupo->eliminarEncargado($id_asistente);
	}
	/* /////////////// FIN METODOS AJAX PARA BUSQUEDA PARA ASIGNACIÓN DE </LIDERES >/////////////*/

	/* /////////////// METODOS AJAX PARA BUSQUEDA PARA ASIGNACIÓN DE SERVIDORES /////////////*/
	/*esta funcion es para la busqueda de asistentes para asignar servidores,
	construye el sql necesario para saber que asistentes pueden ser añadidos*/
	public function postConstruyeSqlServidoresAptosAjax($id_grupo){
		$grupo= Grupo::find($id_grupo);
		$sql_adicional="";
		if($grupo->servidores->count()>0)
		{
          $sql_adicional="(1=1 ";
          foreach($grupo->servidores as $servidore)
          {
            $sql_adicional.=" AND asistentes.id<>".$servidore->id;
          }
          $sql_adicional.=")";
        }
        return $sql_adicional;
	}


	public function postAsignarServidorGrupoAjax($id_grupo, $id_asistente){
		$grupo= Grupo::find($id_grupo);
		if(!$grupo->servidores()->attach($id_asistente))
		{
			return "true";
		}
		else{
			return "false";
		}
	}

	public function postEliminarServidorGrupoAjax($id_grupo, $id_asistente){
		$servidor_grupo= ServidorGrupo::where("asistente_id","=", $id_asistente)->where("grupo_id", "=", $id_grupo)->first();
		
		if($servidor_grupo->tipoServicioGrupo()->detach())
		{
			if($servidor_grupo->delete())
				return "true";
			else 
				return "false";
		}
		else
			return "false";
	}

	public function postAsignarTipoServicioServidorAjax($id_grupo, $id_asistente, $ids_tipo_servicio)
	{
		$band=0;
		$servidor_grupo= ServidorGrupo::where("asistente_id","=", $id_asistente)->where("grupo_id", "=", $id_grupo)->first();//find($servidores[$i]);
		$ids_tipo_servicio=explode("-", $ids_tipo_servicio);
		DB::table("servicios_servidores_grupo")->where("servidores_grupo_id", $servidor_grupo->id)
			->whereNotIn("tipo_servicio_grupos_id", $ids_tipo_servicio)->delete();

		for($i=1; $i<count($ids_tipo_servicio); $i++)
		{
			if(!isset($servidor_grupo->tipoServicioGrupo()->find($ids_tipo_servicio[$i])->id))
			{
				$tipo_servicio= TipoServicioGrupo::find($ids_tipo_servicio[$i]); 
				if(!$tipo_servicio->servidorGrupo()->attach($servidor_grupo->id))
				{
					$band=0;
				}
				else
					$band=1;
			}
		}
		if($band==0) return "true";
		else return "false";
	}
	/* /////////////// FIN METODOS AJAX PARA BUSQUEDA PARA ASIGNACIÓN DE LIDERES /////////////*/

	

	/* /////////////// METODOS AJAX PARA BUSQUEDA PARA ASIGNACIÓN DE INTEGRANTES /////////////*/
	/*esta funcion es para la busqueda de asistentes para asignar INTEGRANTES,
	construye el sql necesario para saber que asistentes pueden ser añadidos*/
	public function postConstruyeSqlIntegrantesAptosAjax($id_grupo){
		$grupo= Grupo::find($id_grupo);
		$sql_adicional="";
    $sql_adicional="(1=1 ";
    
    foreach($grupo->asistentes as $asistente)
    {
      $sql_adicional.=" AND asistentes.id<>".$asistente->id;
    }
    if(isset($grupo->encargados()->first()->id))
    {
	    foreach($grupo->encargados()->first()->lideres()->get() as $encargado)
	    {
	      $sql_adicional.=" AND asistentes.id<> $encargado->id";
	    }
	  }
    foreach($grupo->encargados as $encargado)
    {
      $sql_adicional.=" AND asistentes.id<> $encargado->id ";
    }
    $pastores=Iglesia::find(1)->pastoresEncargados;
    foreach($pastores as $encargado)
    {
      $sql_adicional.=" AND asistentes.id<> $encargado->id ";
    }
    $sql_adicional.=") OR asistentes.grupo_id IS NULL";
    
    return $sql_adicional;
	}


	public function postAsignarIntegranteGrupoAjax($id_grupo, $id_asistente, $cambio="sin-ministerio"){
		$asistente= Asistente::find($id_asistente);
		if($asistente->cambiarGrupo($id_grupo, $cambio))
		{
			return "true";
		}
		else{
			return "false";
		}
	}

	public function postEliminarIntegranteGrupoAjax($id_grupo, $id_asistente){
		$asistente= Asistente::find($id_asistente);
		$asistente->grupo_id=null;
		if($asistente->save())
		{
			return "true";
		}
		else{
			return "false";
		}
	}
	/* /////////////// FIN METODOS AJAX PARA BUSQUEDA PARA ASIGNACIÓN DE integrantes /////////////*/

	/////////////////aqui termina la parte de la busqueda tipo FACEBOOK


	
}
?>
