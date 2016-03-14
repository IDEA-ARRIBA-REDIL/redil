<?php
/** 
*
* @Redil Software. OfrendaController.php 
* @versión: 1.0.0     @modificado: 24 de Abril del 2015
* @autor última modificación: Felipe Fajardo 
* 
*/
class OfrendasController extends BaseController
{
	public function __construct()
	{
		
		$this->beforeFilter('auth');  //bloqueo de acceso
		
	}

	//lista financiera
	public function getIndex()
	{
		return Redirect::to('ofrendas/lista/por-ingreso');
	}

	public function getLista($tipo="todos")
	{	
		$total_diezmos=0;
        $total_ofrendas=0;
        $total_pactos=0;
        $total_primicias=0;
        $total_protemplo=0;
        $total_siembras=0;
        $total_otros=0;
        $total_ofrendas_sueltas=0;
        $total_ingresos=0;

		$buscar=null;
		$linea=null;
		$fecha_inicio=null;
		$fecha_fin=null;
		$asistentes=null;
		$asistentes_ids=null;

		$cantidad_busqueda=null;
		$lineas=Linea::all();
		$valor="";
		$listar_tipo_ingreso=false;
		$fecha_actual=new DateTime();
		$ano = $fecha_actual->format('Y');
		$ano.= "-01-01";

		$mes = $fecha_actual->format('Y-m');
		$mes.= "-01";

		$ofrendas= Ofrenda::leftJoin('reporte_grupos', 'ofrendas.reporte_grupo_id', '=', 'reporte_grupos.id')->whereRaw('(reporte_grupos.aprobado=TRUE OR reporte_grupos.id IS NULL)');
		$asistentes= Asistente::whereRaw('(3=3)');

		if(Auth::user()->id!=1)
		{
			//Carga en un arreglo los ids de todos los asistentes que pertenecen al usuario autenticado
			$asistentes_ids= Auth::user()->asistente->discipulos('array');

            //Carga ademas el id del usuario autenticado
			$usuario_id=Auth::user()->asistente->id;
			array_push($asistentes_ids, $usuario_id);

			$ofrendas=  Ofrenda::whereIn('ofrendas.asistente_id', $asistentes_ids);
			$asistentes= Asistente::whereIn('asistentes.id', $asistentes_ids);
		}


		if($tipo=="por-reunion")
		{
			$ofrendas= $ofrendas->where('ofrendas.ingresada_por', '=', '0');
		}
		else if ($tipo=="por-grupo")
		{	
			$ofrendas= $ofrendas->where('ofrendas.ingresada_por', '=', '1');
		}
		else if ($tipo=="otros")
		{	
			$ofrendas= $ofrendas->where('ofrendas.ingresada_por', '=', '2');
		}

		if (isset($_GET["buscar"]))
		{
			if($_GET["buscar"]!="")
			{
				$cantidad_busqueda=0;
				$buscar= htmlspecialchars(Input::get('buscar'));
				$buscar_array=explode(" ", $buscar);
				Global $sql_buscar;
				$c=0;

				foreach($buscar_array as $palabra)
				{
					if($c!=0)
					  $sql_buscar.=" AND ";

					$sql_buscar.="(asistentes.nombre ILIKE '%$palabra%' OR asistentes.apellido ILIKE '%$palabra%'";
					if(ctype_digit($palabra))
					{
						if($tipo=="por-ingreso")
							$sql_buscar.=" OR ofrendas.asistente_id=$palabra OR ofrendas.valor=$palabra";
						if($tipo=="por-asistente")
							$sql_buscar.=" OR asistentes.id=$palabra";
					}

					$portipo=false;

					if($palabra=="diezmo" || $palabra=="diezmos")
					{
						$palabra=0;
						$portipo=true;
					}
					else if ($palabra=="ofrenda" || $palabra=="ofrendas")
					{	
						$palabra=1;
						$portipo=true;
					}
					else if ($palabra=="pacto" || $palabra=="pactos")
					{	
						$palabra=2;
						$portipo=true;
					}
					else if ($palabra=="pro-templo" || $palabra=="protemplo")
					{	
						$palabra=3;
						$portipo=true;
					}
					else if ($palabra=="siembra" || $palabra=="siembras")
					{	
						$palabra=4;
						$portipo=true;
					}
					else if ($palabra=="primicia" || $palabra=="primicias")
					{	
						$palabra=5;
						$portipo=true;
					}
					else if ($palabra=="suelta" || $palabra=="sueltas")
					{	
						$palabra=7;
						$portipo=true;
					}

					if($portipo && $tipo=="por-ingreso")
						$sql_buscar.=" OR ofrendas.tipo_ofrenda=$palabra";
					$sql_buscar.=")";
                    $c++;
				}//foreach
			

				//Busqueda especial  sin separar la frase por palabras.
				if (($buscar=="ofrenda suelta" || $buscar=="ofrendas sueltas")&& $tipo=="por-ingreso")
				{
					$sql_buscar="(ofrendas.tipo_ofrenda=7)";
				}

				$ofrendas=  $ofrendas->leftJoin('asistentes', 'ofrendas.asistente_id', '=', 'asistentes.id')->whereRaw('('.$sql_buscar.')');
				
				$ofrendas=Ofrenda::whereIn('ofrendas.id', Helper::obtenerArrayIds($ofrendas->get(array('ofrendas.id'))));
				
				if($tipo=="por-asistente")
				$asistentes=$asistentes->whereRaw('('.$sql_buscar.')');
			
			}
		}

			if (isset($_GET["linea"])){
				$linea=$_GET["linea"];

				if($linea!=""){
					$linea_seleccionada=Linea::find($linea);
					$grupos_id=$linea_seleccionada->grupos('array');
					$ofrendas_sueltas=clone $ofrendas;
					$ofrendas_sueltas=$ofrendas_sueltas->leftJoin('grupos', 'reporte_grupos.grupo_id', '=', 'grupos.id')->whereIn('grupos.id', $grupos_id)->where('ofrendas.tipo_ofrenda', '7')->sum('ofrendas.valor');
					$ofrendas=  $ofrendas->leftJoin('asistentes', 'ofrendas.asistente_id', '=', 'asistentes.id')->where('asistentes.linea_id', $linea);
					$ofrendas=Ofrenda::whereIn('ofrendas.id', Helper::obtenerArrayIds($ofrendas->get(array('ofrendas.id'))));
					
					$asistentes=$asistentes->where('asistentes.linea_id', $linea);
				}
			}

			if(isset($_GET["fecha-inicio"])){
				$fecha_inicio=$_GET["fecha-inicio"];
				$ofrendas=$ofrendas->where('ofrendas.fecha', '>=', $fecha_inicio);
			}
			else
			{
				$fecha_inicio= date('Y')."-".date('m')."-01";
				$ofrendas=$ofrendas->where('ofrendas.fecha', '>=', $fecha_inicio);
			}
			

			if(isset($_GET["fecha-fin"])){
				$fecha_fin=$_GET["fecha-fin"];
				$ofrendas=$ofrendas->where('ofrendas.fecha', '<=', $fecha_fin);
			}
			else
			{
				$fin= date('t'); 
				$fecha_fin=date('Y')."-".date('m').'-'.$fin;
				$ofrendas=$ofrendas->where('ofrendas.fecha', '<=', $fecha_fin);
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
				$ordenado_por='total';
			}

			$total_ingresos= clone $ofrendas;
			$total_ingresos=$total_ingresos->sum('valor');

			$total_diezmos=clone $ofrendas;
			$total_diezmos=$total_diezmos->where('tipo_ofrenda', '0')->sum('valor');

			$total_ofrendas=clone $ofrendas;
			$total_ofrendas=$total_ofrendas->where('tipo_ofrenda', '1')->sum('valor');

			$total_pactos=clone $ofrendas;
			$total_pactos=$total_pactos->where('tipo_ofrenda', '2')->sum('valor');

			$total_protemplo=clone $ofrendas;
			$total_protemplo=$total_protemplo->where('tipo_ofrenda', '3')->sum('valor');

			$total_siembras=clone $ofrendas;
			$total_siembras=$total_siembras->where('tipo_ofrenda', '4')->sum('valor');

			$total_primicias=clone $ofrendas;
			$total_primicias=$total_primicias->where('tipo_ofrenda', '5')->sum('valor');

			$total_otros=clone $ofrendas;
			$total_otros=$total_otros->where('tipo_ofrenda', '6')->sum('valor');

			if($linea!="" && $linea!=null)
			{
				$total_ofrendas_sueltas=$ofrendas_sueltas;
				$total_ingresos=$total_ingresos+$ofrendas_sueltas;
			}
			else
			{
				$total_ofrendas_sueltas=clone $ofrendas;
				$total_ofrendas_sueltas=$total_ofrendas_sueltas->where('tipo_ofrenda', '7')->sum('valor');
			}

			$ofrendas=$ofrendas->orderBy('ofrendas.fecha', 'desc')->paginate(10);

			
			if($tipo=="por-asistente")
			{
				//$asistentes=$asistentes->orderBy('id', $orden)->paginate(10);
				
					$asistentes=$asistentes->leftJoin("ofrendas", "asistentes.id", "=", "ofrendas.asistente_id")
					 ->select(DB::raw("asistentes.id, asistentes.nombre, asistentes.apellido, sum(ofrendas.valor) as total"))
                     ->whereRaw("ofrendas.asistente_id=asistentes.id")
                     ->where('ofrendas.fecha', '>=', $fecha_inicio)
                     ->where('ofrendas.fecha', '<=', $fecha_fin)
                     ->groupBy("asistentes.id", "asistentes.nombre", "asistentes.apellido")
                     ->orderBy($ordenado_por, $orden)
                     ->paginate(10);
			}
		    
		    return View::make('ofrendas.index')-> with(
			array(
				'ofrendas' => $ofrendas, 
				'asistentes' => $asistentes, 
				'tipo' => $tipo,
				'buscar' => $buscar,
				'linea' => $linea,
				'fecha_inicio' => $fecha_inicio,
				'fecha_fin' => $fecha_fin,
				'lineas' => $lineas,
				'ordenado_por' => $ordenado_por,
				'orden' => $orden,
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

		public function getNuevo()
		{

			$asistentes = Asistente::orderBy('id', 'asc')
						->take(10)
						->get();

			return  View::make('ofrendas.nuevo')->with('asistentes', $asistentes);
		}


		public function postNew ()
		{
			$ofrenda= new Ofrenda;
			$ofrenda->tipo_ofrenda= Input::get ('tipo_ofrenda');
			$ofrenda->valor= Input::get ('valor');
			$ofrenda->fecha= Input::get ('fecha');
		$ofrenda->ingresada_por=2; // Por defecto es 2(otros) ya que el ingreso de este formulario no es de culto ni de grupo
		$ofrenda->observacion= Input::get ('observacion');
		$ofrenda->asistente_id=Input::get('asistente_id');; //Usuario al que sera asignado el ingreso (Ingreso no de grupo ni de reunion) 
		
		$ofrenda->save();

			//return Redirect::to('users')->with('status', 'ok_update');
		return Redirect::to('ofrendas/nuevo')->with (array(
			'status'  => 'ok_update',
			'ofrenda'=>$ofrenda->valor,
			'ofrenda_id'=>$ofrenda->id,
			));

		}


	public function getInforme($id)
	{
		$ofrenda = Ofrenda::find($id);
		if(!isset($ofrenda)) return App::abort(404);

		return View::make('ofrendas.informe')->with(
			array('ofrenda' => $ofrenda));;
	}

	public function getActualizar($id)
	{
		$ofrenda = Ofrenda::find($id);
			return View::make('ofrendas.actualizar')->with(
				array('ofrenda' => $ofrenda));
	}

    public function getEliminar($id)
	{
          $ofrenda= Ofrenda::find($id);
          $ofrenda->delete();
          return Redirect::to('ofrendas/lista/todos')->with (array(
          	'status'  => 'ok_delete',
            'ofrenda_id_eliminada'=>$id,
            ));
	}


	public function getInformePdf($id)
	{
		$ofrenda=Ofrenda::find($id);
		$html=View::make('ofrendas.pdf.informe_pdf')-> with(
			array('ofrenda' => $ofrenda));
	    return PDF::load(utf8_decode($html), 'letter', 'portrait')->show();	

	}

	public function getReportesOfrendas($fecha_inicio, $fecha_fin, $linea="")
	{
		$linea_seleccionada="";
		$ofrendas= Ofrenda::whereRaw('(1=1)');
		//$ofrendas=Ofrenda::whereIn('ofrendas.id', Helper::obtenerArrayIds($ofrendas->get(array('ofrendas.id'))));

		if(Auth::user()->id!=1)
		{
			//Carga en un arreglo los ids de todos los asistentes que pertenecen al usuario autenticado
			$asistentes_ids= Auth::user()->asistente->discipulos('array');

            //Carga ademas el id del usuario autenticado
			$usuario_id=Auth::user()->asistente->id;
			array_push($asistentes_ids, $usuario_id);

			$ofrendas=  Ofrenda::whereIn('ofrendas.asistente_id', $asistentes_ids);
		}

		if($linea!=""){
				$linea_seleccionada=Linea::find($linea);
				$ofrendas=  $ofrendas->leftJoin('asistentes', 'ofrendas.asistente_id', '=', 'asistentes.id')->where('asistentes.linea_id', $linea);
				$ofrendas=Ofrenda::whereIn('ofrendas.id', Helper::obtenerArrayIds($ofrendas->get(array('ofrendas.id'))));
		}

		$ofrendas=$ofrendas->where('ofrendas.fecha', '>=', $fecha_inicio);		

		$ofrendas=$ofrendas->where('ofrendas.fecha', '<=', $fecha_fin);
		
		$ofrendas=$ofrendas->orderBy('ofrendas.fecha', 'desc')->get();

		$html=View::make('ofrendas.pdf.ofrendas-pdf')-> with(
			array('ofrendas' => $ofrendas, 
				'linea' => $linea_seleccionada, 
				'fecha_inicio' => $fecha_inicio,
				'fecha_fin' => $fecha_fin));
	    return PDF::load(utf8_decode($html), 'letter', 'portrait')->show();	

	}

	public function postUpdate($id)
	{
		$ofrenda= Ofrenda::find($id);
		$fecha=date("Y-m-d", strtotime(str_replace('/', '-',Input::get ('fecha'))) );
		$ofrenda->fecha= $fecha;
		$ofrenda->tipo_ofrenda= Input::get ('tipo_ofrenda');
		$ofrenda->valor= Input::get ('valor');
		$ofrenda->observacion= Input::get ('observacion');
        $ofrenda->save();

        return Redirect::to('ofrendas/actualizar/'.$id)->with (array('status'  => 'ok_update'));
	}



/////////////////////////esta es la parte de la busqueda tipo FACEBOOK de asistentes/////////////////////////////////////////////////////////
	//Metodo ajax: LineaSeleccionada
	//  Recibe como parámetro un el id de la línea que se seleccione. 
	//  Retrona un de forma grafica el nombre de la linea, el codigo y los encargado(s)

	public function postAsistenteSeleccionado($id) 
	{
		$asistente=Asistente::find($id);
		$respuesta='<div id="ico-asistente" class="col-xs-3 col-md-3 col-lg-3 bg-blue" style="min-height: 106px; box-shadow: 0 1px 1px rgba(0,0,0,0.1); ">';
        $respuesta.=   '<center><i class="fa fa fa-share-alt fa-4x" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></i></center>';
        $respuesta.='</div>';
        $respuesta.='<div id="info-asistente" class="col-xs-9 col-md-9 col-lg-9 " style="min-height: 106px;box-shadow: 0 1px 1px 0 rgba(0,0,0,0.1);">';
		$respuesta.='<h4><b>Asistente </b>'.$asistente->id.' - '.$asistente->nombre.'</h4>';
		$respuesta.='<p><b>Linea: </b>'.$asistente->grupo->linea->nombre.'<br>';
		          if ($asistente->tipo_asistente_id==5)
		          {
		          	$respuesta.='<label class="label arrowed-right bg-purple" data-toggle="tooltip" data-placement="top" title="'.$asistente->tipoAsistente->nombre.'"><i class="fa fa-book" style="margin-right:15 px;"> </i></label>';
		          }elseif($asistente->tipo_asistente_id==4)
		          {
		          	$respuesta.='<label class="label arrowed-right bg-orange" data-toggle="tooltip" data-placement="top" title="'.$asistente->tipoAsistente->nombre['nombre'].'"><i class="fa fa-star" style="margin-right:15 px;"> </i></label>';
		          }
		            
		           $respuesta.=' '.$asistente->tipoAsistente->nombre.'<br>';
		        
		$respuesta.='</p></div>';
		return $respuesta;
	}

	////////// este es el ajax que devuelve las siguientes 10 grupos para el panel de grupos 
	public function postObtieneAsistentesAjax($cant_asistentes_cargados, $buscar="")
	{
		$cant_asistentes=0;
		if($buscar=="")
		{			
			
			$asistentes= Asistente::orderBy("id", 'asc')
		        ->skip($cant_asistentes_cargados)
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
				$sql_buscar.="(asistentes.nombre ILIKE '%$palabra%' OR asistentes.apellido ILIKE '%$palabra%'";
				if(ctype_digit($palabra))
					$sql_buscar.=" OR asistentes.id=$palabra";
				$sql_buscar.=")";
				$c++;
			}


			$asistentes = Asistente::where(function($query)
						{
			            	$sql_buscar_l=$GLOBALS['sql_buscar']; /// sql_buscar_l local
			                $query->whereRaw($sql_buscar_l);
			            })
						->get(array('asistentes.id'));
									
			$asistentes_ids_fin=array();
			foreach ($asistentes as $asistente) {
				array_push($asistentes_ids_fin, $asistente->id);
			}

			$asistentes=Asistente::whereIn('asistentes.id', $asistentes_ids_fin)
						->orderBy("id", 'asc')
				        ->skip($cant_asistentes_cargados)
				        ->take(10)
				        ->get();

			
		}	

        $lista=""; 

        if($asistentes->count()>0)
        {
	        foreach($asistentes as $asistente)
	        {
	        	$lista.=' <li id="" class="" style="cursor:pointer"><!-- start message --> 
	                        <a class="seleccionar-asistente" data-nombre="'.$asistente->nombre.'" data-id="'.$asistente->id.'">                                      
	                          <div class="col-lg-4  col-md-4 col-xs-4">
	                            <p>
	                            <b>CÓDIGO: </b>'.$asistente->id.'<br>
	                            <b>NOMBRE: </b> '.$asistente->nombre.'
	                            </p> 
	                          </div>  
	                          <div class="col-lg-8  col-md-8 col-xs-8">
	                            <b>TIPO DE ASISTENTE: </b> <br>';

							          if ($asistente->tipo_asistente_id==5)
							          {
							          	$lista.='<label class="label arrowed-right bg-purple" data-toggle="tooltip" data-placement="top" title="'.$asistente->tipoAsistente->nombre.'"><i class="fa fa-book" style="margin-right:15 px;"> </i></label>';
							          }elseif($asistente->tipo_asistente_id==4)
							          {
							          	$lista.='<label class="label arrowed-right bg-orange" data-toggle="tooltip" data-placement="top" title="'.$asistente->tipoAsistente->nombre.'"><i class="fa fa-star" style="margin-right:15 px;"> </i></label>';
							          }
							            
							           $lista.=' '.$asistente->tipoAsistente->nombre.'<br>';
							        
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
	                      		 <i class="fa fa-share-alt fa-2x"> </i> No hay asistentes que coincidan con la busqueda <b>"'.$buscar.'"</b> 	                      	
	                      </center>
	                     <br>
	                    </div>  
        			</li>';
        }
        $lista.=     '
                     <script type="text/javascript">
					  var cant_asistentes='.$asistentes->count().';
					</script>';
		return $lista; 
	}

	public function postCantidadAsistentesAjax($buscar="")
	{
		if($buscar=="")
		{
			$cant=Asistente::all()->count();
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
				$sql_buscar.="(asistentes.nombre ILIKE '%$palabra%' OR asistentes.apellido ILIKE '%$palabra%'";
				if(ctype_digit($palabra))
					$sql_buscar.=" OR asistentes.id=$palabra";
				$sql_buscar.=")";
				$c++;
			}


			$asistentes = Asistente::where(function($query)
						{
			            	$sql_buscar_l=$GLOBALS['sql_buscar']; /// sql_buscar_l local
			                $query->whereRaw($sql_buscar_l);
			            })
						->get(array('asistentes.id'));
									
			$asistentes_ids_fin=array();
			foreach ($asistentes as $asistente) {
				array_push($asistentes_ids_fin, $asistente->id);
			}

			$asistentes= Asistente::whereIn('asistentes.id', $asistentes_ids_fin)
						->orderBy("id", 'asc')
				        ->count();

		    $cant=$asistentes->count();
			
		}


		return $cant;
	}

	/////////////////aqui termina la parte de la busqueda tipo FACEBOOK







}
?>
