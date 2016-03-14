<?php
/** 
*
* @Redil Software. ReporteGruposController.php 
* @versión: 1.0.0     @modificado: 31 de Julio del 2014 
* @autor última modificación: Mairon Andres Piedrahita
* 
*/
class ReporteGruposController extends BaseController
{
	public function __construct()
	{
		
		$this->beforeFilter('auth');  //bloqueo de acceso
		
	}

	public function getIndex()
	{
		return Redirect::to('reporte-grupos/lista/todos');

	}

	public function getPerfil($id)
	{
		
		$reporte=ReporteGrupo::find($id);
		$reportes=ReporteGrupo::all();
		$grupo=Grupo::find($reporte->grupo_id);
		return View::make('reporte-grupos.perfil')-> with(
			array(
				'reportes' => $reportes,
				'reporte' => $reporte,
				'grupo'=> $grupo,
				 ));
	}

	public function getReporte($id)
	{

		$reporte=ReporteGrupo::find($id);
	
		$grupo=Grupo::find($reporte->grupo_id);
		$html=View::make('reporte-grupos.reportes.reporte_grupo_pdf')-> with(
			array(
				'reporte' => $reporte,
				'grupo'=> $grupo,
				 ));
	return PDF::load(utf8_decode($html), 'letter', 'portrait')->show();	
	}

	public function getLista($tipo = "todos")
	{

		$buscar=null;
		$cantidad_busqueda=null;
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

		if ($tipo=="aprobados")
		{
			$reportes= ReporteGrupo::where('aprobado', '=', 'TRUE');
		} 
		else if ($tipo=="no-aprobados")
		{
			$reportes= ReporteGrupo::where('aprobado', '=', 'FALSE');
		}
		else{
			$reportes=ReporteGrupo::whereRaw("(1=1)");
			$tipo="todos"; 
		}

		// si no es el administrador filtra solo los reportes que le corresponden al usuario.  
		if(Auth::user()->id!=1)
		{
			//este es para conocer todos los grupos indirectos del usuario logueado
			$grupos_ids= Auth::user()->asistente->gruposMinisterio('array');
			
			//$asistentes = Asistente::whereIn('grupo_id', $grupos_ids)->get(); 
			$reportes= $reportes->whereIn('reporte_grupos.grupo_id', $grupos_ids);
		
		}

		if (isset($_GET["buscar"]))
		{ 
			// este codigo es el que me permite buscar por palabra
			$buscar= htmlspecialchars(Input::get('buscar'));
			$buscar_array=explode(" ", $buscar);
			Global $sql_buscar;
			$c=0;
			foreach($buscar_array as $palabra)
			{
				if($c!=0)
					$sql_buscar.=" AND ";
				$sql_buscar.="(reporte_grupos.tema ILIKE '%$palabra%' OR encargado.nombre ILIKE '%$palabra%' OR encargado.apellido ILIKE '%$palabra%' OR grupos.nombre ILIKE '%$palabra%'";
				
				$palabra_aux=str_replace("/", "", "$palabra", $count);
				if($count>0 && $count<3)
				{
					if(ctype_digit($palabra_aux))
					{
						$fecha=date("Y-m-d", strtotime(str_replace('/', '-',$palabra)) );
						$sql_buscar.=" OR reporte_grupos.fecha='$fecha'";
					}
				}

				if(ctype_digit($palabra))
					$sql_buscar.=" OR reporte_grupos.id=$palabra";
				$sql_buscar.=")";
				$c++;
			}

			$reportes= $reportes->leftJoin('grupos', 'reporte_grupos.grupo_id', '=', 'grupos.id')
			    ->leftJoin('encargados_grupo', 'grupos.id', '=', 'encargados_grupo.grupo_id')
				->leftJoin('asistentes AS encargado', 'encargado.id', '=', 'encargados_grupo.asistente_id')
				->where(function($query)
				{
	            	$sql_buscar_l=$GLOBALS['sql_buscar']; /// sql_buscar_l local
	                $query->whereRaw($sql_buscar_l);
	            })
				->get(array('reporte_grupos.id'));
							
			$reportes=ReporteGrupo::whereIn('reporte_grupos.id', Helper::obtenerArrayIds($reportes));
		}

		if (isset($_GET["linea"])){
			$linea=$_GET["linea"];

			if($linea!=""){
				//$linea_seleccionada=Linea::find($linea);
				//$grupos_id=$linea_seleccionada->grupos('array');
				
				$reportes=  $reportes->leftJoin('asistencia_grupos', 'reporte_grupos.id', '=', 'asistencia_grupos.reporte_grupo_id')
				->leftJoin('asistentes', 'asistencia_grupos.asistente_id', '=', 'asistentes.id')->where('asistentes.linea_id', $linea);
				$reportes=ReporteGrupo::whereIn('reporte_grupos.id', Helper::obtenerArrayIds($reportes->get(array('reporte_grupos.id'))));
				
			}
		}

		if(isset($_GET["fecha-inicio"])){
			$fecha_inicio=$_GET["fecha-inicio"];
			if ($tipo!="no-aprobados")
				$reportes=$reportes->where('reporte_grupos.fecha', '>=', $fecha_inicio);
		}
		else
		{
			$fecha_inicio= date('Y')."-".date('m')."-01";
			if ($tipo!="no-aprobados")
				$reportes=$reportes->where('reporte_grupos.fecha', '>=', $fecha_inicio);
		}
		

		if(isset($_GET["fecha-fin"])){
			$fecha_fin=$_GET["fecha-fin"];
			if ($tipo!="no-aprobados")
				$reportes=$reportes->where('reporte_grupos.fecha', '<=', $fecha_fin);
		}
		else
		{
			$fin= date('t'); 
			$fecha_fin=date('Y')."-".date('m').'-'.$fin;
			if ($tipo!="no-aprobados")
				$reportes=$reportes->where('reporte_grupos.fecha', '<=', $fecha_fin);
		}

		$reportes= $reportes->orderBy('fecha', 'desc')->paginate(10);

		if(Auth::user()->id==1)
		{
			$cantidad_todos= ReporteGrupo::where('reporte_grupos.fecha', '>=', $fecha_inicio)->where('reporte_grupos.fecha', '<=', $fecha_fin)->count();
            $cantidad_no_aprobados= ReporteGrupo::where('aprobado', '=', 'FALSE')->count();;
            $cantidad_aprobados= ReporteGrupo::where('reporte_grupos.fecha', '>=', $fecha_inicio)->where('reporte_grupos.fecha', '<=', $fecha_fin)->where('aprobado', '=', 'TRUE')->count();;

		}else
		{
			$cantidad_todos= ReporteGrupo::where('reporte_grupos.fecha', '>=', $fecha_inicio)->where('reporte_grupos.fecha', '<=', $fecha_fin)->whereIn('reporte_grupos.grupo_id', $grupos_ids)->count();
            $cantidad_no_aprobados= ReporteGrupo::where('aprobado', '=', 'FALSE')->count();
            $cantidad_aprobados= ReporteGrupo::where('reporte_grupos.fecha', '>=', $fecha_inicio)->where('reporte_grupos.fecha', '<=', $fecha_fin)->whereIn('reporte_grupos.grupo_id', $grupos_ids)->whereIn('reporte_grupos.grupo_id', $grupos_ids)->where('aprobado', '=', 'TRUE')->count();;
		}
        

		return View::make('reporte-grupos.index')-> with(
			array(
				'reportes' => $reportes,
				'cantidad_todos' => $cantidad_todos, 
				'cantidad_no_aprobados' => $cantidad_no_aprobados,
				'cantidad_aprobados' => $cantidad_aprobados,
				'buscar' => $buscar,
			    'cantidad_busqueda' => $cantidad_busqueda,
			    'linea' => $linea,
				'fecha_inicio' => $fecha_inicio,
				'fecha_fin' => $fecha_fin,
			    'lineas' => $lineas,
				'fecha_inicio' => $fecha_inicio,
				'fecha_fin' => $fecha_fin,
				'tipo' => $tipo
				 )
		);


		
		
	}

	public function getNuevo($id="0")
	{
		$grupo=Grupo::find($id);
		if(isset($grupo->id))
			return View::make('reporte-grupos.nuevo')-> with(
				array(
					'grupo_seleccionado' => $grupo,
				 ));
		else 
			return View::make('reporte-grupos.nuevo');
	}

	public function getActualizar($id)
	{
		$reporte=ReporteGrupo::find($id);
		
		return View::make('reporte-grupos.actualizar')-> with(
			array(
				'reporte' => $reporte
				 ));
	}


	///con esto puedo conocer si la fecha dada ya cuenta con un reporte
	//////////////////funcion para hallar la fecha del reporte proximo a reportar
	public function postExisteReporteAjax($id_grupo, $fecha)
	{
		$grupo= Grupo::find($id_grupo);
		if($grupo->reportes()->where("fecha", date("Y-m-d",strtotime($fecha)))->count()>0)
			return "true";
		else
			return "false";
	}

	//////////////////funcion para hallar la fecha del reporte proximo a reportar
	public function postFechaReporte($id_grupo)
	{
		if(ReporteGrupo::where('grupo_id', '=', $id_grupo)->orderBy('fecha', 'desc')->count() > 0)
	    {
	    	$reporte=ReporteGrupo::where('grupo_id', '=', $id_grupo)->orderBy('fecha', 'desc')->first();

	   		///queda pendiente si teien un dado de alta con una fecha mayor a la del ultimo reporte debe hacer otra cosa
	   		
	   		if(ReporteGrupoBajaAlta::where('grupo_id', '=', $id_grupo)->where('dado_baja', '=', 'FALSE')->where('fecha', '>', $reporte->fecha)->orderBy('fecha', 'desc')->count() >0)
	   		{
	   			$reporte_alta=ReporteGrupoBajaAlta::where('grupo_id', '=', $id_grupo)->where('dado_baja', '=', 'FALSE')->where('fecha', '>', $reporte->fecha)->orderBy('fecha', 'desc')->first();
	   			$fecha=date_create($reporte_alta->fecha);
			    $fecha_formato=date_format($fecha, 'Y-m-j') ; 
			    $nuevafecha = strtotime('+7 day', strtotime($fecha_formato));
			    $nuevafecha = date('d-m-Y' , $nuevafecha);
			    return $nuevafecha;
	   		}
	      	else
	      	{
			    //$fecha=$reporte->fecha;
			    $fecha=date_create($reporte->fecha);
			    $fecha_formato=date_format($fecha, 'Y-m-j') ; 
			    $nuevafecha = strtotime('+7 day', strtotime($fecha_formato));
			    $fecha_aux = date('Y-m-d' , $nuevafecha);
			    /////queda pendiente saber si el reporte ya existe.
			    if(strtotime($fecha_aux)>strtotime(date("d-m-Y")))
			    {
			    	return "fecha_mayor";
			    }
			    else
			    {
			    	$nuevafecha = date('d-m-Y' , $nuevafecha);
			    	return $nuevafecha;
			    }
			    
			}
	    }
	    else
	    {
	    	$grupo=Grupo::find($id_grupo);
	    	$dia_hoy=date("w");
	    	$dia_celula=($grupo->dia)-1;
	    	$dias_restar=0;
	    	if($dia_celula<=$dia_hoy)
	    	{
	    		$dias_restar=$dia_hoy-$dia_celula;
	    	}
	    	else
	    	{
	    		$dias_restar=7-($dia_celula-$dia_hoy);
	    	}
	    	$fecha=date('Y-m-j');
	    	//$fecha = $grupo->fecha_apertura;
			$nuevafecha = strtotime ( '-'.$dias_restar.' day' , strtotime ( $fecha ) ) ;
			$nuevafecha = date ( 'd-m-Y' , $nuevafecha );
	      return $nuevafecha;
	    }
	}


	public function postFechasReportesGrupoAjax($id_grupo)
	{
		$reportes=ReporteGrupo::where("grupo_id", $id_grupo)->get(array("fecha"));
		
		return json_encode($reportes);
	}

	public function postSeleccionaGrupo($id_grupo)
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

	public function postTablaAsistentes($id_grupo)
	{
		//$asistentes=Asistente::where('grupo_id','=',$id_grupo)->where('dado_baja', '=', '0')->get(); 
		$asistentes=Asistente::where('grupo_id','=',$id_grupo)->get();  
		$tabla='<script type="text/javascript"> var finanzasLocal= new Array();
		var ids_integrantes= new Array(); </script>';
		$tabla.='<table id="tabla_integrantes" class="table table-striped display stripe" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>ASISTENTE</th>
                        <th class="text-center">INFORMACIÓN FINANCIERA</th>
                        <th></th>
                        <th class="text-center">¿ASISTÍO?</th>
                        
                        
                        
                  </tr>
                </thead>
                <tbody>';
		foreach($asistentes as $integrante) 
		{  
		  $tabla.='<tr>
                                                            
                    <td>
                        <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Codigo">Cod</label> '.$integrante->id.'<br>
                        <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Nombre"> <i class="fa fa-user"></i></label> '.$integrante->nombre.' '.$integrante->apellido.'                                                                                
                    </td>
                    
                    <td class= "text-center">
                       
                             <h4><label class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="Diezmo/ofrenda"> <i class="fa fa-money"></i></label> <label id="ofrenda_'.$integrante->id.'">$0 </label>
                             
                             </h4> 
                                                                                                                                      
                    </td>
                            
                    <td class= "text-center">
                            <button class="btn btn-success abrir-panel-ofrendas" data-nombre="'.$integrante->nombre.' '.$integrante->apellido.'" data-id="'.$integrante->id.'" data-toggle="modal" data-target=".modal-financiero"> + </button>
                    </td>
                    
                    <td class= "text-center">
                         <div class="form-group"> 
                            <!-- /asitio SI NO -->
                              <div class="form-group"> 
                                  
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="asistio'.$integrante->id.'" id="optionsRadios1" value="1" required> Si
                                            </label>
                                            <label>
                                                <input type="radio" name="asistio'.$integrante->id.'" id="optionsRadios2" value="0" required> No
                                            </label>
                                        </div> 
                                       
                              </div>
                            <!-- /asitio SI NO -->
                                          
                        </div>    


                    </td>
                    
                </tr>';
                $tabla.='<script type="text/javascript">
                $(document).ready(function() {
                	finanzasLocal.push(new Array('.$integrante->id.', new Array(), 0));
                	ids_integrantes.push('.$integrante->id.');
                });</script>';		
            }
		$tabla.= '</tbody>
			</tabla>';

		return $tabla;
	}

	public function postNew ()
	{
		$fecha=date("Y-m-d", strtotime(str_replace('/', '-',Input::get ('fecha'))) );
		if(ReporteGrupo::where('fecha', '=', $fecha)->where('grupo_id', '=', Input::get('grupo_id'))->count() == 0)
		{
			$reporte_grupo= new ReporteGrupo;
			$reporte_grupo->fecha= $fecha;
			$reporte_grupo->tema= Input::get ('tema');
			$reporte_grupo->observacion= Input::get ('observacion');
			$reporte_grupo->grupo_id=Input::get('grupo_id');
			$reporte_grupo->invitados=Input::get('invitados');
			if(Auth::user()->id==1)
				$reporte_grupo->aprobado=1;
			else
				$reporte_grupo->aprobado=0;
			$reporte_grupo->save();

			if($reporte_grupo->grupo->inactivo==1)
			{
				$reporte_grupo->grupo->inactivo=0;
				$reporte_grupo->grupo->save();
			}
			//// voy a guardar las asistencias de los integrantes

			$array_ids=Input::get('ids_integrantes');
			$integrantes=(explode(",", $array_ids));

			$json_finanzas=Input::get('finanzas');
			$finanzas=(json_decode($json_finanzas));
			$asistio="";
			$json_finanzas_lider=Input::get('finanzas_lideres');
			$finanzas_lider=(json_decode($json_finanzas_lider));
			$asistio="";
			$cantidad_integrantes=count($integrantes);
			$cantidad_lideres=$reporte_grupo->grupo->encargados()->count();
			$asistencia= explode(",",Input::get("asistencia"));

			for ($i=0; $i < $cantidad_integrantes; $i++) 	
			{
				//if(Input::get("pasos")!="")
				//{
				
				if (!in_array($integrantes[$i], $asistencia))
				//if(Input::get('asistio'.$integrantes[$i])==null)
				{
					//$reporte_grupo->asistentes()->attach($integrantes[$i], array("asistio"=>"0"));
					$hoy = date("Y-m-j");
					$hace30dias = strtotime ( '-30 day' , strtotime ( $hoy ) ) ;
					$hace30dias = date ( 'Y-m-d' , $hace30dias );
					global $integrantes_aux;
					global $i_aux;
					$integrantes_aux=$integrantes;
					$i_aux=$i;
					$grupo_aux=Grupo::find($reporte_grupo->grupo_id);
					$asistio=$grupo_aux->reportes()->where("fecha", ">", $hace30dias)->whereHas('asistentes', function($q){global $integrantes_aux; global $i_aux; $q->where('asistio', '=', "1" )->where('asistente_id', "=", $integrantes_aux[$i_aux]);});
					$asistente=Asistente::find($integrantes[$i]);
					//$ultimos_reportes=$asistente->reportesGrupo()->where("fecha", ">", $hace30dias);
					//$asistio=$ultimos_reportes->whereHas('asistentes', function($q){global $integrantes; global $i; $q->where('asistio', '=', "1" )->where('asistente_id', "=", $integrantes[$i]);})->get();
					if($asistio->count()==0)
					{
						
						$asistente->inactivo_grupo=1;
						$asistente->save();
					} 
					else
					{
						$asistente->inactivo_grupo=0;
						$asistente->save();
					}
				}
				else
				{
					$reporte_grupo->asistentes()->attach($integrantes[$i], array("asistio"=>"1"));
					$asistente=Asistente::find($integrantes[$i]);
					$asistente->inactivo_grupo=0;
					$asistente->save();
				}
			
			}
			
	      	// guardando las ofrendas de cada integrante del reporte
			for ($j=0; $j < $cantidad_integrantes; $j++) 
			{
			 	for($i=0; $i<count($finanzas[$j][1]) ; $i++)
			 	{
			 		$ofrenda= new Ofrenda();
					$ofrenda->tipo_ofrenda=$finanzas[$j][1][$i][1];
					$ofrenda->valor=$finanzas[$j][1][$i][0];
					$ofrenda->fecha=$fecha;
					$ofrenda->ingresada_por=1;
					$ofrenda->observacion=$finanzas[$j][1][$i][2];
					$ofrenda->asistente_id=$integrantes[$j];
					$ofrenda->reporte_grupo_id=$reporte_grupo->id;

					$ofrenda->save();

			 	}
			}

			$j=0;
			// guardando las ofrendas de cada lider del reporte
			foreach($reporte_grupo->grupo->encargados as $encargado)
			{
			 	for($i=0; $i<count($finanzas_lider[$j][1]) ; $i++)
			 	{
			 		$ofrenda= new Ofrenda();
					$ofrenda->tipo_ofrenda=$finanzas_lider[$j][1][$i][1];
					$ofrenda->valor=$finanzas_lider[$j][1][$i][0];
					$ofrenda->fecha=$fecha;
					$ofrenda->ingresada_por=1;
					$ofrenda->observacion=$finanzas_lider[$j][1][$i][2];
					$ofrenda->asistente_id=$encargado->id;
					$ofrenda->reporte_grupo_id=$reporte_grupo->id;

					$ofrenda->save();

			 	}
			 	$j++;
			}

			//guardando la ofrenda suelta en caso de que haya
			$ofrenda_suelta=Input::get('valor_ofrenda_suelta');
			if($ofrenda_suelta!="" && $ofrenda_suelta!="0")
			{
				$ofrenda= new Ofrenda();
				$ofrenda->tipo_ofrenda=7;
				$ofrenda->valor=$ofrenda_suelta;
				$ofrenda->fecha=$fecha;
				$ofrenda->ingresada_por=1;
				$ofrenda->observacion=Input::get('observacion_ofrenda_suelta');
				$ofrenda->reporte_grupo_id=$reporte_grupo->id;

				$ofrenda->save();
			}

			//////Notificaciones del nuevo reporte de grupo
	        ///////////////depende de la branch se hace un for
	        $descripcion_asistente="ha reportado uno de tus grupos";
			$descripcion_administrador="ha registrado uno de sus grupos";
			$url="/reporte-grupos/perfil/$reporte_grupo->id";
			$grupo= Grupo::find(Input::get('grupo_id'));
			$grupo->notificarLideres(2, "Nuevo Reporte de Grupo", $descripcion_asistente, $descripcion_administrador, $url);
			//////////fin notificacioens


			 
			//return Redirect::to('users')->with('status', 'ok_update');
			return Redirect::to('reporte-grupos/nuevo')->with (array(
				'status'  => 'ok_update',
				'reporte' => $reporte_grupo->id
					)
				);
		}
		else
		{
			//return Redirect::to('users')->with('status', 'ok_update');
			return Redirect::to('reporte-grupos/nuevo')->with (array(
				'status'  => 'error_update',
				'fecha' => Input::get ('fecha'),
				'reporte' => ReporteGrupo::where('fecha', '=', $fecha)->where('grupo_id', '=', Input::get('grupo_id'))->first(),
					)
				);
		}
	}

	public function postUpdate ($id)
	{
		$fecha=date("Y-m-d", strtotime(str_replace('/', '-',Input::get ('fecha'))) );
		$reporte_grupo= ReporteGrupo::find($id);
		if(ReporteGrupo::where('fecha', '=', $fecha)->where('grupo_id', '=', Input::get('grupo_id'))->count() == 0 || $fecha==$reporte_grupo->fecha)
		{
			$reporte_grupo= ReporteGrupo::find($id);
			$reporte_grupo->fecha= $fecha;
			$reporte_grupo->tema= Input::get ('tema');
			$reporte_grupo->observacion= Input::get ('observacion');
			$reporte_grupo->invitados=Input::get('invitados');
			$reporte_grupo->save();

			//// voy a guardar las asistencias de los integrantes

			$array_ids=Input::get('ids_integrantes');
			$integrantes=(explode(",", $array_ids));

			
			$cantidad_integrantes=count($integrantes);


			$asistentes=$reporte_grupo->asistentes()->get();

			$asistencia= explode(",",Input::get("asistencia"));

			for ($i=0; $i < $cantidad_integrantes; $i++) 	
			{
				$asistente=$asistentes->find($integrantes[$i]);				
				
				if (!in_array($integrantes[$i], $asistencia))
				{
					if(isset($reporte_grupo->asistentes()->find($integrantes[$i])->id))
						$reporte_grupo->asistentes()->detach($integrantes[$i]);
					$hoy = date("Y-m-d");
					$hace30dias = strtotime ( '-30 day' , strtotime ( $hoy ) ) ;
					$hace30dias = date ( 'Y-m-d' , $hace30dias );
					global $integrantes_aux;
					global $i_aux;
					$integrantes_aux=$integrantes;
					$i_aux=$i;
					$grupo_aux=Grupo::find($reporte_grupo->grupo_id);
	                $asistio=$grupo_aux->reportes()->where("fecha", ">", $hace30dias)->whereHas('asistentes', function($q){global $integrantes_aux; global $i_aux; $q->where('asistio', '=', "1" )->where('asistente_id', "=", $integrantes_aux[$i_aux]);});
					$asistente=Asistente::find($integrantes[$i]);
					//$ultimos_reportes=$asistente->reportesGrupo()->where("fecha", ">", $hace30dias);
					//$asistio=$ultimos_reportes->whereHas('asistentes', function($q){global $integrantes; global $i; $q->where('asistio', '=', "1" )->where('asistente_id', "=", $integrantes[$i]);})->get();
					if($asistio->count()==0)
					{
						$asistente->inactivo_grupo=1;
						$asistente->save();
					} 
					else
					{
						$asistente->inactivo_grupo=0;
						$asistente->save();
					}
				}
				else
				{
					if(!isset($reporte_grupo->asistentes()->find($integrantes[$i])->id))
						$reporte_grupo->asistentes()->attach($integrantes[$i], array("asistio"=>"1"));
					$asistente=Asistente::find($integrantes[$i]);
					$asistente->inactivo_grupo=0;
					$asistente->save();
				}

			}

			if(Input::get('finanzas')!="")
			{
				$json_eliminadas=Input::get('ofrendas_eliminar');
				$eliminadas=(json_decode($json_eliminadas));

				$json_finanzas=Input::get('finanzas');
				$finanzas=(json_decode($json_finanzas));

				for ($j=0; $j < count($eliminadas); $j++) 
				{

					if($eliminadas[$j][3]==0)
					{
						
						$of_eliminar=Ofrenda::find($eliminadas[$j][4]);
						$of_eliminar->delete();
					}
				}

		      	// guardando las ofrendas de cada integrante del reporte
				for ($j=0; $j < $cantidad_integrantes; $j++) 
				{
				 	for($i=0; $i<count($finanzas[$j][1]) ; $i++)
				 	{
				 		if($finanzas[$j][1][$i][3]==1)
				 		{
					 		$ofrenda= new Ofrenda();
							$ofrenda->tipo_ofrenda=$finanzas[$j][1][$i][1];
							$ofrenda->valor=$finanzas[$j][1][$i][0];
							$ofrenda->fecha=$fecha;
							$ofrenda->ingresada_por=1;
							$ofrenda->observacion=$finanzas[$j][1][$i][2];
							$ofrenda->asistente_id=$integrantes[$j];
							$ofrenda->reporte_grupo_id=$reporte_grupo->id;

							$ofrenda->save();
						}
				 	}
				}
			}

			if(Input::get('finanzas_lideres')!="")
			{
				$json_eliminadas=Input::get('ofrendas_eliminar_lider');
				$eliminadas=(json_decode($json_eliminadas));

				$json_finanzas=Input::get('finanzas_lideres');
				$finanzas=(json_decode($json_finanzas));

				for ($j=0; $j < count($eliminadas); $j++) 
				{
					if($eliminadas[$j][3]==0)
					{
						$of_eliminar=Ofrenda::find($eliminadas[$j][4]);
						$of_eliminar->delete();
					}
				}

				$cantidad_lideres=count($finanzas);
		      	// guardando las ofrendas de cada lider del reporte
		      	$j=0;
				foreach($reporte_grupo->grupo->encargados as $encargado)
				{
				 	for($i=0; $i<count($finanzas[$j][1]) ; $i++)
				 	{
				 		if($finanzas[$j][1][$i][3]==1)
				 		{
					 		$ofrenda= new Ofrenda();
							$ofrenda->tipo_ofrenda=$finanzas[$j][1][$i][1];
							$ofrenda->valor=$finanzas[$j][1][$i][0];
							$ofrenda->fecha=$fecha;
							$ofrenda->ingresada_por=1;
							$ofrenda->observacion=$finanzas[$j][1][$i][2];
							$ofrenda->asistente_id=$encargado->id;
							$ofrenda->reporte_grupo_id=$reporte_grupo->id;

							$ofrenda->save();
						}
				 	}
				 	$j++;
				}
			}

			//guardando la ofrenda suelta en caso de que haya
			$valor_ofrenda_suelta=Input::get('valor_ofrenda_suelta');
			if($valor_ofrenda_suelta!="")
			{
				$ofrenda=$reporte_grupo->ofrendas()->where('tipo_ofrenda','=','7')->first();
				if(isset($ofrenda))
				{
					if($valor_ofrenda_suelta=="0")
					{
						$ofrenda->delete();
					}
					else
					{
						$ofrenda->valor=$valor_ofrenda_suelta;
						$ofrenda->fecha=$fecha;
						$ofrenda->observacion=Input::get('observacion_ofrenda_suelta');
						$ofrenda->save();
					}
				}
				else
				{
					if($valor_ofrenda_suelta!="0")
					{
						$ofrenda= new Ofrenda();
						$ofrenda->tipo_ofrenda=7;
						$ofrenda->valor=$valor_ofrenda_suelta;
						$ofrenda->fecha=$fecha;
						$ofrenda->ingresada_por=1;
						$ofrenda->observacion=Input::get('observacion_ofrenda_suelta');
						$ofrenda->reporte_grupo_id=$reporte_grupo->id;

						$ofrenda->save();
					}
				}
				
			}
			
			
			 
			//return Redirect::to('users')->with('status', 'ok_update');
			return Redirect::to('reporte-grupos/actualizar/'.$id)->with (array(
				'status'  => 'ok_update',
				'reporte' => $reporte_grupo->id)
			);
		}/////cierre del if
		else
		{
			//return Redirect::to('users')->with('status', 'ok_update');
			return Redirect::to('reporte-grupos/actualizar/'.$id)->with (array(
				'status'  => 'error_update',
				'fecha' => Input::get ('fecha'),
					)
				);
		}////cierre del else
	}


	public function postApruebaReporteAjax ($id_reporte)
	{
		$reporte= ReporteGrupo::find($id_reporte);
		$reporte->aprobado = 1;    
        $reporte->save();

        if($reporte->aprobado==TRUE)
        	return "aprobado";
        else 
        	return "no-aprobado"; 

	}
}

?>