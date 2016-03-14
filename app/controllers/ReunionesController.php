<?php
/** 
*
* @Redil Software. ReunionesController.php” 
* @versión: 1.0.0     @modificado: 29 de Octubre del 2014 
* @autor última modificación: Juan Carlos velasquez  
* 
*/
class ReunionesController extends BaseController
{


	public function __construct()
	{
		$this->beforeFilter('auth');  //bloqueo de acceso
	}


	public function getIndex()
	{
		return Redirect::to('reuniones/lista/todos');
	}

	public function getLista($tipo)
	{
		if(isset($_GET["buscar"]))
		{
			$cantidad_busqueda=0;
			$buscar= htmlspecialchars(Input::get("buscar"));
			$buscar_array=explode(" ", $buscar);
			Global $sql_buscar;
			$c=0;

			foreach($buscar_array as $palabra)
			{
				if($c!=0)
					$sql_buscar.=" AND ";

				$sql_buscar.=" (translate (reuniones.nombre, 'áéíóúÁÉÍÓÚäëïöüÄËÏÖÜñ', 'aeiouAEIOUaeiouAEIOUÑ') ILIKE '%$palabra%' OR reuniones.lugar ILIKE '%$palabra%' OR reuniones.descripcion ILIKE '%$palabra%'";
				
				if(ctype_digit($palabra))
				{
					$sql_buscar.=" OR reuniones.id=$palabra";
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

			$reuniones= Reunion::where(function($query)
			{
			    $sql_buscar_l=$GLOBALS['sql_buscar']; /// sql_buscar_l local
			    $query->whereRaw($sql_buscar_l);
			})
			->orderBy('id', 'asc')
			->where('reuniones.dado_baja', '=', '0')
			
			->paginate(10);


			$cantidad_busqueda=$reuniones->count();


			return View::make('reuniones.index')-> with(
			array(
				'reuniones' => $reuniones,
				'buscar' => $buscar,
				'cantidad_busqueda' => $cantidad_busqueda,
			));

		}
		else
		{
			//$reunions = Reunion::where('dado_baja', '=', '0')->get(); //Reuniones no dadas de baja 
			$reuniones = Reunion::orderBy('id', 'asc')
			->where('reuniones.dado_baja', '=', '0')
			
			->paginate(10);

			$cantidad_todos= $reuniones->count();

			return View::make('reuniones.index')-> with(
				array(
					'reuniones' => $reuniones,
					'cantidad_todos' => $cantidad_todos,
					));
		}
	}

	public function getNuevo()
	{
		$reuniones =  Reunion::all();
		return  View::make('reuniones.nuevo')->with('reuniones', $reuniones);
	}

	public function postNew()
	{

		// -- creacion de la nueva reunion
	 	$nueva_reunion = new Reunion;
	 	$nueva_reunion->nombre = Input::get("nombre"); 
	 	$nueva_reunion->descripcion = Input::get("descripcion");	 	
	 	$nueva_reunion->hora = Input::get("hora");
	 	$nueva_reunion->dia = Input::get("dia");
	 	$nueva_reunion->lugar = Input::get("lugar"); 
	 	$nueva_reunion->dado_baja = 0;
	 	$nueva_reunion->save();
	 	// -- fin de creacion de la nueva reunion

		return Redirect::to('reuniones/nuevo')->with (array(
			'status'  => 'ok_update',
			'dia'=>$nueva_reunion->dia,
			));

	}

	public function getActualizar($id)
	{
		$reunion = Reunion::find($id);
			return View::make('reuniones.actualizar')->with(
				array('reunion' => $reunion));
	}

	public function postUpdate($id)
	{
		$reunion= Reunion::find($id);
		$reunion->nombre = Input::get("nombre"); 
	 	$reunion->descripcion = Input::get("descripcion");	 	
	 	$reunion->hora = Input::get("hora");
	 	$reunion->dia = Input::get("dia"); 	 	
	 	$reunion->lugar = Input::get("lugar"); 
	 	$reunion->save();

        return Redirect::to('reuniones/actualizar/'.$id)->with (array('status'  => 'ok_update'));
	}

    public function getDardebaja($id)
	{
		$reunion= Reunion::find($id);
		$reunion->dado_baja = 1;
	 	$reunion->save();

 		return Redirect::to('reuniones/lista/todos')->with (array(
 			'status'  => 'ok_down',
 			'nombre_reunion'=>$reunion->nombre,
 			));

	}

 	public function getPerfil($id)
	{
		$reunion = Reunion::find($id);
		if(!isset($reunion)) return App::abort(404);

		return View::make('reuniones.perfil')->with(
			array('reunion' => $reunion));;
	}

	public function getInformepdf($id)
	{
		$reunion=Reunion::find($id);
		$html=View::make('reuniones.pdf.informe_pdf')-> with(
			array('reunion' => $reunion));
	    return PDF::load(utf8_decode($html), 'letter', 'portrait')->show();	

	}

	public function getInformes(){
		return View::make('reuniones.informes.lista-informes');
	}

	public function getInformePromediosAsistencia(){
		$buscar=null;
		$rango=null;
		$anio=null;
		$fecha_inicio=null;
		$fecha_fin=null;
		$linea=null;
		$grupo=null;
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
				if(isset(Auth::user()->asistente->grupo->id))
					$grupo=Auth::user()->asistente->grupo->id;
			}

		}

		$reuniones= Reunion::where('reuniones.dado_baja', '=', 0);

		if (isset($_GET["linea"])){
			$linea=$_GET["linea"];
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

				$sql_buscar.=" (translate (reuniones.nombre, 'áéíóúÁÉÍÓÚäëïöüÄËÏÖÜñ', 'aeiouAEIOUaeiouAEIOUÑ') ILIKE '%$palabra%' OR reuniones.lugar ILIKE '%$palabra%' OR reuniones.descripcion ILIKE '%$palabra%'";
				
				if(ctype_digit($palabra))
				{
					$sql_buscar.=" OR reuniones.id=$palabra";
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
			$sql_buscar.=")";

			$reuniones->whereRaw($sql_buscar);
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
			$ordenado_por='reuniones.id';
		}

		$mes_inicio=(int)date('m', strtotime($fecha_inicio));
		$mes_fin=(int)date('m', strtotime($fecha_fin));
		$total_meses=($mes_fin-$mes_inicio)+1;

		$reuniones= $reuniones->orderBy($ordenado_por, $orden)
		->groupBy("reuniones.id", 'reuniones.nombre', 'descripcion', 'lugar', 'dia', 'hora', 'reuniones.dado_baja', 'reuniones.updated_at', 'reuniones.created_at')
		->paginate(10);

		return View::make('reuniones.informes.promedios-asistencia')-> with(
			array(
				'reuniones' => $reuniones,
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


	public function getInformeGeneral(){
		$buscar=null;
		$rango=null;
		$anio=null;
		$fecha_inicio=null;
		$fecha_fin=null;
		$reunion="";

		$tipos_asistente=TipoAsistente::all();

		if(Auth::user()->id==1)
			$lineas=Linea::all();
		else
		{
			if(Auth::user()->asistente->lineas()->count()>0)
			{
				$lineas=Auth::user()->asistente->lineas;
			}
			else
			{
				$lineas=Linea::where('id', Auth::user()->asistente->linea->id)->get();
			}

		}

		$reuniones= Reunion::where('dado_baja', '=', 0);
		if(Reunion::where('dado_baja', '=', 0)->count()==1)
			$reunion=$reuniones->first();

		$reuniones=$reuniones->get();
		
		if(isset($_GET["reunion"])){
			$reunion=$_GET["reunion"];
		}

		if(isset($_GET["fecha-inicio"])){
			$fecha_inicio=$_GET["fecha-inicio"];
		}
		else
		{
			$fecha_inicio= date('Y')."-".date('m')."-01";
		}
		

		if(isset($_GET["fecha-fin"])){
			$fecha_fin=$_GET["fecha-fin"];
		}
		else
		{
			$fin= date('t'); 
			$fecha_fin=date('Y')."-".date('m').'-'.$fin;
		}

		//se obtiene primeros y utlimos grupos con asistencia a los cultos
		$grupos_primeros=Grupo::where('grupos.dado_baja', 0);

		$grupos_primeros= $grupos_primeros->leftJoin("asistentes", "grupos.id", "=", "asistentes.grupo_id")
		->leftJoin("asistencia_reuniones", "asistentes.id", "=", "asistencia_reuniones.asistente_id")
		->leftJoin("reporte_reuniones", "reporte_reuniones.id", "=", "asistencia_reuniones.reporte_reunion_id")
		->select(DB::raw("grupos.id, grupos.nombre, CASE WHEN count(DISTINCT reporte_reuniones.id)>0 THEN (count(asistencia_reuniones.id)/count(DISTINCT reporte_reuniones.id)) ELSE 0 END as promedio"))
		->whereRaw("((reporte_reuniones.fecha>='$fecha_inicio' AND reporte_reuniones.fecha<='$fecha_fin'))");

		if($reunion!="")
			$grupos_primeros=$grupos_primeros->where('reporte_reuniones.reunion_id', $reunion);

		$grupos_ultimos= clone $grupos_primeros;
		
		$grupos_primeros=$grupos_primeros->orderBy('promedio', 'desc')
		->groupBy("grupos.id", 'grupos.nombre', 'grupos.direccion', 'telefono', 'rhema', 'fecha_apertura', 'dia', 'hora', 'nivel', 'inactivo', 'grupos.dado_baja', 'tipo_grupo_id',  'grupos.updated_at', 'grupos.created_at', 'grupo_padre', 'reuniones_por_mes')
		->take(10)
		->get();

		$grupos_ultimos=$grupos_ultimos->orderBy('promedio', 'asc')
		->groupBy("grupos.id", 'grupos.nombre', 'grupos.direccion', 'telefono', 'rhema', 'fecha_apertura', 'dia', 'hora', 'nivel', 'inactivo', 'grupos.dado_baja', 'tipo_grupo_id',  'grupos.updated_at', 'grupos.created_at', 'grupo_padre', 'reuniones_por_mes')
		->take(10)
		->get();

		//se obtiene ahora los primeros y ultimos asistentes con asistencia a los cultos
		$asistentes_primeros=Asistente::whereRaw('1=1');

		$asistentes_primeros= $asistentes_primeros->leftJoin("asistencia_reuniones", "asistentes.id", "=", "asistencia_reuniones.asistente_id")
		->leftJoin("reporte_reuniones", "reporte_reuniones.id", "=", "asistencia_reuniones.reporte_reunion_id")
		->select(DB::raw("asistentes.id, asistentes.nombre||' '||asistentes.apellido as nombre, (count(asistencia_reuniones.id)) as asistencias"))
		->whereRaw("((reporte_reuniones.fecha>='$fecha_inicio' AND reporte_reuniones.fecha<='$fecha_fin'))");

		if($reunion!="")
			$asistentes_primeros=$asistentes_primeros->where('reporte_reuniones.reunion_id', $reunion);

		$asistentes_ultimos= clone $asistentes_primeros;
		
		$asistentes_primeros=$asistentes_primeros->orderBy('asistencias', 'desc')
		->groupBy('asistentes.id', 'asistentes.nombre',  'apellido', 'asistentes.genero', 'asistentes.tipo_identificacion', 'asistentes.identificacion', 'asistentes.nacionalidad', 'asistentes.fecha_nacimiento', 'asistentes.direccion', 'asistentes.telefono_fijo', 'asistentes.telefono_movil', 'asistentes.telefono_otro', 'asistentes.estado_civil', 'asistentes.ocupacion', 'asistentes.fecha_ingreso', 'asistentes.tipo_sangre', 'asistentes.indicaciones_medicas', 'asistentes.limitaciones', 'asistentes.foto', 'asistentes.inactivo_grupo', 'asistentes.inactivo_iglesia', 'asistentes.tipo_asistente_id', 'asistentes.grupo_id', 'asistentes.updated_at', 'asistentes.created_at', 'asistentes.linea_id' )
		->take(10)
		->get();

		$asistentes_ultimos=$asistentes_ultimos->orderBy('asistencias', 'asc')
		->groupBy('asistentes.id', 'asistentes.nombre',  'apellido', 'asistentes.genero', 'asistentes.tipo_identificacion', 'asistentes.identificacion', 'asistentes.nacionalidad', 'asistentes.fecha_nacimiento', 'asistentes.direccion', 'asistentes.telefono_fijo', 'asistentes.telefono_movil', 'asistentes.telefono_otro', 'asistentes.estado_civil', 'asistentes.ocupacion', 'asistentes.fecha_ingreso', 'asistentes.tipo_sangre', 'asistentes.indicaciones_medicas', 'asistentes.limitaciones', 'asistentes.foto', 'asistentes.inactivo_grupo', 'asistentes.inactivo_iglesia', 'asistentes.tipo_asistente_id', 'asistentes.grupo_id', 'asistentes.updated_at', 'asistentes.created_at', 'asistentes.linea_id' )
		->take(10)
		->get();


		$mes_inicio=(int)date('m', strtotime($fecha_inicio));
		$mes_fin=(int)date('m', strtotime($fecha_fin));
		$total_meses=($mes_fin-$mes_inicio)+1;

		return View::make('reuniones.informes.informe-general')-> with(
			array(
				'reuniones' => $reuniones,
				'buscar' => $buscar,
			    'reunion' => $reunion,
				'fecha_inicio' => $fecha_inicio,
				'fecha_fin' => $fecha_fin,
				'rango' => $rango,
			    'lineas' => $lineas,
			    'mes_inicio' => $mes_inicio,
			    'mes_fin' => $mes_fin,
			    'anio' => $anio,
			    'tipos_asistente' => $tipos_asistente,
			    'grupos_ultimos' => $grupos_ultimos,
			    'grupos_primeros' => $grupos_primeros,
			    'asistentes_ultimos' => $asistentes_ultimos,
			    'asistentes_primeros' => $asistentes_primeros,
				 )
		);
	}

	/////////////////////////Esta es la parte de la busqueda tipo FACEBOOK de reuniones/////////////////////////////////////////////////////////
	//Metodo ajax: LineaSeleccionada
	//  Recibe como parámetro el id de la línea que se seleccione. 
	//  Retorna de forma grafica el nombre de la reunion, el codigo, el dia y la descripción(s)
	
	
	public function postReunionSeleccionada($id) 
	{
		App::setLocale('es'); 
		date_default_timezone_set('America/Bogota');
		$reunion=Reunion::find($id);
		$respuesta='<div class="item-seleccionado">';
		$respuesta.='<div id="ico-reunion" class="col-xs-4 col-md-3 col-lg-3 bg-blue" >';
        $respuesta.=   '<center><i class="fa fa fa-home fa-4x" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></i></center>';
        $respuesta.='</div>';
        $respuesta.='<div id="info-reunion" class="col-xs-8 col-md-9 col-lg-9 ">';
		$respuesta.='<h4><b>Reunion </b>'.$reunion->id.' - '.$reunion->nombre.'</h4>';
		$respuesta.='<p><b>Día: </b>';
		$dia=$reunion->dia;
        
        if($reunion->dia != 0 && $reunion->dia !="" ){
		$dia=Lang::choice('general.dias', $reunion->dia);
        }

		$respuesta.=$dia.'<br>';
		$respuesta.='<b>Descripción: </b>'.$reunion->descripcion.'<br>';
		$respuesta.='</p></div></div>';
		return $respuesta;
	}

	////////// este es el ajax que devuelve las siguientes 10 reuniones para el panel de reuniones 
	public function postObtieneReunionesParaBusquedaAjax($cant_reuniones_cargadas, $sql_adicional="", $buscar="")
	{
		App::setLocale('es'); 
		date_default_timezone_set('America/Bogota');

		$cant_reuniones=0;
		$prueba=0;
		if($buscar=="")
		{			
			$reuniones= Reunion::orderBy("id", 'asc')
			->where('reuniones.dado_baja', '=', '0')
	        
	        ->skip($cant_reuniones_cargadas)
	        ->take(10)
	        ->get();

		}else
		{

            $buscar= htmlspecialchars($buscar);
			$buscar_array=explode(" ", $buscar);
			Global $sql_buscar;
			$c=0;

			foreach($buscar_array as $palabra)
			{
				if($c!=0)
					$sql_buscar.=" AND ";

				$sql_buscar.=" (translate (reuniones.nombre, 'áéíóúÁÉÍÓÚäëïöüÄËÏÖÜñ', 'aeiouAEIOUaeiouAEIOUÑ') ILIKE '%$palabra%' OR reuniones.lugar ILIKE '%$palabra%' OR reuniones.descripcion ILIKE '%$palabra%'";
				
				if(ctype_digit($palabra))
				{
					$sql_buscar.=" OR reuniones.id=$palabra";
				}

				$busqueda_por_dia=false;

				if(strpos("lunes", $palabra)!== false)
				{
					$palabra=2;
					$busqueda_por_dia=true;
				}
				else if(strpos("martes", $palabra)!== false)
				{
					$palabra=3;
					$busqueda_por_dia=true;
				}
				else if (strpos("miercoles", $palabra)!== false)
				{	
					$palabra=4;
					$busqueda_por_dia=true;
				}
				else if (strpos("jueves", $palabra)!== false)
				{	
					$palabra=5;
					$busqueda_por_dia=true;
				}
				else if (strpos("viernes", $palabra)!== false)
				{
					$palabra=6;
					$busqueda_por_dia=true;
				}
				else if (strpos("sabado", $palabra)!== false)
				{	
					$palabra=7;
					$busqueda_por_dia=true;
				}
				else if (strpos("domingo", $palabra)!== false)
				{	
					$palabra=1;
					$busqueda_por_dia=true;
				}

				if($busqueda_por_dia)
				$sql_buscar.=" OR reuniones.dia=$palabra";

				$sql_buscar.=")";
				$c++;
			}

			$reuniones= Reunion::where(function($query)
			{
			    $sql_buscar_l=$GLOBALS['sql_buscar']; /// sql_buscar_l local
			    $query->whereRaw($sql_buscar_l);
			})
			->where('reuniones.dado_baja', '=', '0')
			->orderBy('id', 'asc')
			
			->skip($cant_reuniones_cargadas)
			->take(10)
			->get();
		}	

        $lista=""; 

        if($reuniones->count()>0)
        {
	        foreach($reuniones as $reunion)
	        {
	        	$lista.=' <li id="" class="" style="cursor:pointer"><!-- start message --> 
	                        <a class="seleccionar-reunion" data-nombre="'.$reunion->nombre.'" data-id="'.$reunion->id.'">                                      
	                          <div class="col-lg-7  col-md-7 col-xs-7">
	                            <p style="white-space: normal !important">
	                            <b>CÓDIGO: </b>'.$reunion->id.'<br>
	                            <b>NOMBRE: </b> '.$reunion->nombre.'
	                            </p> 
	                          </div> 
	                          <div class="col-lg-5  col-md-5 col-xs-5">
	                          <b>Día: </b>';
	                          $dia=$reunion->dia;
        						if($dia != 0 && $dia !="" ){
								$dia=Lang::choice('general.dias', $dia);
        						}
								$lista.=$dia.'<br>';
				$lista.='<b>Hora: </b>'.$reunion->hora.'<br>';
							         
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
	                      		 <i class="fa fa-home fa-2x"> </i> No hay reuniones que coincidan con la búsqueda <b>"'.$buscar.'"</b> 	                      	
	                      </center>
	                     <br>
	                    </div>  
        			</li>';
        	
        }
        $lista.=     '
                     <script type="text/javascript">
					  var cant_registros='.$reuniones->count().';
					  var total_registros_ajax='.Reunion::where('dado_baja', '0')->count().';
					</script>';

		return $lista; 
	}

	public function postCantidadReunionesAjax($buscar="")
	{
		if($buscar=="")
		{
			$cant=Reunion::where('reuniones.dado_baja', '=', '0')
			->count();	
		}else
		{
            $buscar= htmlspecialchars($buscar);
			$buscar_array=explode(" ", $buscar);
			Global $sql_buscar;
			$c=0;

			foreach($buscar_array as $palabra)
			{
				if($c!=0)
					$sql_buscar.=" AND ";

				$sql_buscar.=" (translate (reuniones.nombre, 'áéíóúÁÉÍÓÚäëïöüÄËÏÖÜñ', 'aeiouAEIOUaeiouAEIOUÑ') ILIKE '%$palabra%' OR reuniones.lugar ILIKE '%$palabra%' OR reuniones.descripcion ILIKE '%$palabra%'";
				
				if(ctype_digit($palabra))
				{
					$sql_buscar.=" OR reuniones.id=$palabra";
				}

				$busqueda_por_dia=false;

				if(strpos("lunes", $palabra)!== false)
				{
					$palabra=2;
					$busqueda_por_dia=true;
				}
				else if(strpos("martes", $palabra)!== false)
				{
					$palabra=3;
					$busqueda_por_dia=true;
				}
				else if (strpos("miercoles", $palabra)!== false)
				{	
					$palabra=4;
					$busqueda_por_dia=true;
				}
				else if (strpos("jueves", $palabra)!== false)
				{
					$palabra=5;
					$busqueda_por_dia=true;
				}
				else if (strpos("viernes", $palabra)!== false)
				{
					$palabra=6;
					$busqueda_por_dia=true;
				}
				else if (strpos("sabado", $palabra)!== false)
				{	
					$palabra=7;
					$busqueda_por_dia=true;
				}
				else if (strpos("domingo", $palabra)!== false)
				{	
					$palabra=1;
					$busqueda_por_dia=true;
				}

				if($busqueda_por_dia)
				$sql_buscar.=" OR reuniones.dia=$palabra";

				$sql_buscar.=")";
				$c++;
			}


			$cant= Reunion::where(function($query)
			{
			    $sql_buscar_l=$GLOBALS['sql_buscar']; /// sql_buscar_l local
			    $query->whereRaw($sql_buscar_l);
			})
			->where('reuniones.dado_baja', '=', '0')
			->count();
			
		}


		return $cant;
	}



	/////////////////aqui termina la parte de la busqueda tipo FACEBOOK

}
?>