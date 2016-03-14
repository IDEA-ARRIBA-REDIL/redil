<?php
/** 
*
* @Redil Software. AsistenteController.php 
* @versión: 1.0.0     @modificado: 24 de Julio del 2014 
* @hora modificacion 03:21pm
* @autor última modificación: Darwin Castaño
* 
*/
class 	LineasController extends BaseController
{
	public function __construct()
	{
		
		$this->beforeFilter('auth');  //bloqueo de acceso
		
	}

	public function getIndex()
	{
		return Redirect::to('lineas/lista');
		

	}

	public function getLista()
	{
		if (isset($_GET["buscar"]))
		{ 
			
			$cantidad_busqueda=0;
			// este codigo es el que me permite buscar por palabra
			$buscar= htmlspecialchars(Input::get('buscar'));
			$buscar_array=explode(" ", $buscar);
			Global $sql_buscar;
			$c=0;
			foreach($buscar_array as $palabra)
			{
				if($c!=0)
					$sql_buscar.=" AND ";
				$sql_buscar.="(lineas.nombre ILIKE '%$palabra%' OR lineas.descripcion ILIKE '%$palabra%' OR encargado.nombre ILIKE '%$palabra%' OR encargado.apellido ILIKE '%$palabra%'";
				if(ctype_digit($palabra))
					$sql_buscar.=" OR lineas.id=$palabra";
				$sql_buscar.=")";
				$c++;
			}

			if(Auth::user()->id!=1)
				$iglesia_enc= Auth::user()->asistente->iglesiaEncargada()->count(); 

			if(Auth::user()->id==1 || $iglesia_enc>0)
			{

				$lineas = Linea::leftJoin('encargados_linea', 'lineas.id', '=', 'encargados_linea.linea_id')
							->leftJoin('asistentes AS encargado', 'encargado.id', '=', 'encargados_linea.asistente_id')
							->where(function($query)
							{
				            	$sql_buscar_l=$GLOBALS['sql_buscar']; /// sql_buscar_l local
				                $query->whereRaw($sql_buscar_l);
				            })
							->get(array('lineas.id'));
										
				$lineas_ids_fin=array();
				foreach ($lineas as $linea) {
					array_push($lineas_ids_fin, $linea->id);
				}

				$lineas=Linea::whereIn('lineas.id', $lineas_ids_fin)
							->orderBy('id', 'asc')
							->paginate(10);

				$cantidad_busqueda= Linea::whereIn('lineas.id', $lineas_ids_fin)->count();

				return View::make('lineas.index')->with(
					array(
						'lineas' => $lineas,
						'cantidad_busqueda' => $cantidad_busqueda,
						'buscar' => $buscar,
						)
					
					);
			}
			else
			{
				$lineas = Auth::user()->asistente->lineas()
							->leftJoin('asistentes AS encargado', 'encargado.id', '=', 'encargados_linea.asistente_id')
							->where(function($query)
							{
				            	$sql_buscar_l=$GLOBALS['sql_buscar']; /// sql_buscar_l local
				                $query->whereRaw($sql_buscar_l);
				            })
							->get(array('lineas.id'));
										
				$lineas_ids_fin=array();
				foreach ($lineas as $linea) {
					array_push($lineas_ids_fin, $linea->id);
				}

				$lineas=Linea::whereIn('lineas.id', $lineas_ids_fin)
							->orderBy('id', 'asc')
							->paginate(10);

				$cantidad_busqueda= Linea::whereIn('lineas.id', $lineas_ids_fin)->count();

				return View::make('lineas.index')->with(
					array(
						'lineas' => $lineas,
						'cantidad_busqueda' => $cantidad_busqueda,
						'buscar' => $buscar,
						)
					
					);
			}

		} else
		{
			///esta primer linea es para poder verificar si quien esta logueado es el pator prinicipal
			if(Auth::user()->id!=1)
				$iglesia_enc= Auth::user()->asistente->iglesiaEncargada()->count(); 

			if(Auth::user()->id==1 || $iglesia_enc>0)
			{
				$lineas = Linea::paginate(10);
			}
			else
			{
				$lineas =Auth::user()->asistente->lineas()->paginate(10);
			}
			return View::make('lineas.index')->with('lineas', $lineas);
		}


	}
	
	public function getNuevo ()
	{
		$asistentes =  Asistente::where("tipo_asistente_id",">","3")->get();

		return  View::make('lineas.nuevo')->with('asistentes', $asistentes);
	}

	public function postNew ()
	{
		$linea= new Linea;
		$linea->nombre= Input::get ('nombre');
		$linea->descripcion= Input::get ('descripcion');
		$linea->rhema= Input::get ('rhema');
		
		$linea->save();

		$ids=explode(',',Input::get ('ids_encargados'));
		 foreach ($ids as $id ) 
		 {
				$asistente=Asistente::find($id);
				$linea->encargados()->save($asistente);

				// primero pregunto si existe el asistente encargado de la nueva linea 
				// creo la notificación
				
		}
		
			//return Redirect::to('users')->with('status', 'ok_update');
			return Redirect::to('lineas/nuevo')->with (array(
				'status'  => 'ok_update',
				
				'linea'=>$linea->nombre,
					)
				);

	}

	public function getActualizar($id)
	{
		$linea = Linea::find($id);
		$asistentes = Asistente::where("tipo_asistente_id",">","3")->get();
		return View::make('lineas.actualizar')->with(
			array(
				'linea' => $linea,
				'asistentes' => $asistentes,
				));
	}

	public function postUpdate($id)
	{
		$linea= Linea::find($id);
		$linea->nombre= Input::get('nombre');
		$linea->descripcion= Input::get('descripcion');
		$linea->rhema= Input::get('rhema');
		$linea->save();


		//  -------------  ACTUALIZACION ENCARGADOS DE LINEA 
		if(Input::get("lideres_anadidos")!="")
		{
			$lideres= explode(",",Input::get("lideres_anadidos"));
			for ($i=0; $i < count($lideres); $i++) {
				$linea->encargados()->attach($lideres[$i]);

				
			}
		}

		if(Input::get("lideres_eliminados")!="")
		{
			$lideres= explode(",",Input::get("lideres_eliminados"));
			for ($i=0; $i < count($lideres); $i++) {
				$linea->encargados()->detach($lideres[$i]);

			}
		}
		//  ------------- fin ACTUALIZACION LIDERES 

		//return Redirect::to('users')->with('status', 'ok_update');
		return Redirect::to('/lineas/actualizar/'.$id)->with('status', 'ok_update');

	}

	public function getAnadirLideres($id)
	{
		$linea= Linea::find($id);
		if(!isset($linea)) return App::abort(404);
		if(Auth::user()->id!=1)
		{
			if(!isset(Auth::user()->asistente->gruposMinisterio()->find($id)->id)) return App::abort(404);
		}
		$grupos_principales=Grupo::gruposPrincipales()->get();
		return View::make('lineas.anadir-lideres')->with(
			array(
				'linea'=> $linea,
				'grupos_principales' => $grupos_principales,
			));
	}

	public function getPerfil($id)
	{
		$linea = Linea::find($id);
		if(!isset($linea)) return App::abort(404);

		$redes= Red::all();

		return View::make('lineas.perfil')->with(
			array(
				'linea' => $linea,
				'redes' => $redes,
		));
	}

	public function getEliminar($id)
	{
		$linea = Linea::find($id);
		$nombre_linea=$linea->nombre;

		   $los_encargados=$linea->encargados()->get();
		   if(isset($los_encargados)){
		   		foreach ($los_encargados as $encargado) {
		   			$linea->encargados()->detach($encargado->id);
		   		}
		   }

		    $linea->delete();
		    
		    return Redirect::to('lineas/lista')->with (array(
				'status'  => 'ok_update',				
				'id'=> $id,
				'nombre'=> $nombre_linea,
				)
			);
				
	}


	///////////////////////////////////METODOS AJAX////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////
	//Metodo ajax: LineaSeleccionada
	//  Recibe como parámetro un el id de la línea que se seleccione. 
	//  Retrona un de forma grafica el nombre de la linea, el codigo y los encargado(s)
	public function postLineaSeleccionada($id, $class, $col_lg, $col_sm) 
	{
		$linea=Linea::find($id);
		$respuesta='<div style="padding: 5px;" id="item-'.$class.'-'.$id.'" class="col-lg-'.$col_lg.' col-md-'.$col_lg.' col-sm-'.$col_sm.' col-xs-'.$col_sm.'">';
		$respuesta.='<div class="item-seleccionado">';
		$respuesta.='<div id="ico-'.$class.'" class="col-xs-4 col-sm-4 col-md-3 col-lg-3 bg-green" >';
        $respuesta.='<center><i class="fa fa-code-fork fa-4x" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></i></center>
                    </div>';
        $respuesta.='<div id="info-'.$class.'" class="info-item col-xs-7 col-sm-7 col-md-8 col-lg-8 ">';
		$respuesta.='<h4 class="titulo"><b>'.$class.' </b></h4>';
		$respuesta.='<h3>'.$linea->nombre.'</h3>';
		$respuesta.='<p><b>Código de '.$class.': </b>'.$linea->id.'<br>';
	    	if ($linea->encargados->count()>0)
		        foreach ($linea->encargados as $encargado)
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
		    	 $respuesta.='Esta Linea no tiene ningun encargado. ';
		    }
		$respuesta.='</p></div>';
		$respuesta.='<div class="cerrar no-padding col-xs-1 col-sm-1 col-md-1 col-lg-1" style="background-color:#fff;border-color:#fff" alert alert-success>
		<button id="cerrar-'.$class.'" data-id="'.$id.'" name="cerrar-'.$class.'" type="button" class="close cerrar-'.$class.'-seleccionado" style="font-size:27px;outline:none" aria-hidden="true">×</button>
		</div>';
		$respuesta.='</div></div>';
		return $respuesta;
	}

	////////// este es el ajax que devuelve las siguientes 10 lineas para el panel de lineas 
	public function postObtieneLineasParaBusquedaAjax($class="linea", $lineas_solicitadas, $cant_lineas_cargadas, $sql_adicional="", $buscar="")
	{
		$lista="";
		$lineas="";
		$cant_lineas=0;
		$total_lineas=0;

		$lineas=Linea::whereRaw("4=4");
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
				$sql_buscar.="(lineas.nombre ILIKE '%$palabra%' OR lineas.descripcion ILIKE '%$palabra%' OR encargado.nombre ILIKE '%$palabra%' OR encargado.apellido ILIKE '%$palabra%'";
				if(ctype_digit($palabra))
					$sql_buscar.=" OR lineas.id=$palabra";
				$sql_buscar.=")";
				$c++;
			}

			$lineas = Helper::obtenerArrayIds(Linea::leftJoin('encargados_linea', 'lineas.id', '=', 'encargados_linea.linea_id')
						->leftJoin('asistentes AS encargado', 'encargado.id', '=', 'encargados_linea.asistente_id')
						->where(function($query)
						{
			            	$sql_buscar_l=$GLOBALS['sql_buscar']; /// sql_buscar_l local
			                $query->whereRaw($sql_buscar_l);
			            })
						->get(array('lineas.id')));

			$lineas=Linea::whereIn('lineas.id', $lineas);

		}

		$total_lineas=$lineas->get()->count();
		$lineas=$lineas->orderBy('id', 'asc')->skip($cant_lineas_cargadas)->take(10)->get();
        
        if($lineas->count()>0)
        {
        	foreach($lineas as $linea)
	        {
	        	$lista.=' <li id="" class="" style="cursor:pointer"><!-- start message --> 
	                        <a class="seleccionar-'.$class.'" data-nombre="'.$linea->nombre.'" data-id="'.$linea->id.'">                                      
	                          <div class="col-lg-4  col-md-4 col-xs-4">
	                            <p>
	                            <b>CÓDIGO: </b>'.$linea->id.'<br>
	                            <b>NOMBRE: </b> '.$linea->nombre.'
	                            </p> 
	                          </div>  
	                          <div class="col-lg-8  col-md-8 col-xs-8">
	                            <b>ENCARGADOS: </b> <br>';
	                            if ($linea->encargados->count()>0)
							        foreach ($linea->encargados as $encargado)
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
							    	 $lista.='Esta Linea no tiene ningun encargado. ';
							    }
	            $lista.=     '</div> 
	                        </a>
	                     </li><!-- end message --> ';
	                    
	        }
        }else
        {
        	$lista.='<li id="" class="" style="cursor:pointer">
	                    <div class="col-xs-12 col-md-12 col-lg-12  bg-gray" >
	                    <br>
	                      <center>	                      	
	                      		 <i class="fa fa-code-fork fa-2x"> </i> No hay líneas que coincida con la busqueda <b>"'.$buscar.'"</b> 	                      	
	                      </center>
	                     <br>
	                    </div>  
        			</li>';
        }
        
        $lista.=     '
                     <script type="text/javascript">
					  var cant_registros='.$lineas->count().';
					  var total_registros_ajax='.$total_lineas.';
					</script>';
		return $lista; 
	}

	public function postAsignarLiderLineaAjax($id_linea, $id_asistente, $id_grupo=""){
		$linea= Linea::find($id_linea);
		if($id_grupo!="")
		{
			$asistente=Asistente::find($id_asistente);
			$asistente->cambiarGrupo($id_grupo, "con-ministerio");
		}
		return $linea->asignarEncargado($id_asistente);
	}

	public function postEliminarLiderLineaAjax($id_linea, $id_asistente){
		$linea= Linea::find($id_linea);
		return $linea->eliminarEncargado($id_asistente);
	}

	/*esta funcion es para la busqueda de asistentes para asignar lideres,
	construye el sql necesario para saber que asistentes pueden ser añadidos*/
	public function postConstruyeSqlLideresAptosAjax($id_linea){
		$linea= Grupo::find($id_linea);
		$sql_adicional="(3=3 ";
		if(isset($linea->encargados()->first()->grupo->id))
		{
	      	$grupo_encargado_id=$linea->encargados()->first()->grupo_id;
	    	$sql_adicional.="AND asistentes.grupo_id=".$grupo_encargado_id;
	    }

	    foreach($linea->encargados as $encargado)
	    {
	      $sql_adicional.=" AND asistentes.id<>".$encargado->id;
	    }

	    $pastores=Iglesia::find(1)->pastoresEncargados;
        foreach($pastores as $encargado){
          $sql_adicional.=" AND asistentes.id<>".$encargado->id;
        }

	    $sql_adicional.=" AND asistentes.grupo_id IS NOT NULL AND asistentes.linea_id IS NOT NULL)";
	    
	    return $sql_adicional;
	}

	public function postCantidadLineasAjax($buscar="")
	{
		if($buscar=="")
		{
			$cant=Linea::all()->count();
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
				$sql_buscar.="(lineas.nombre ILIKE '%$palabra%' OR lineas.descripcion ILIKE '%$palabra%' OR encargado.nombre ILIKE '%$palabra%' OR encargado.apellido ILIKE '%$palabra%'";
				if(ctype_digit($palabra))
					$sql_buscar.=" OR lineas.id=$palabra";
				$sql_buscar.=")";
				$c++;
			}


			$lineas = Linea::leftJoin('encargados_linea', 'lineas.id', '=', 'encargados_linea.linea_id')
						->leftJoin('asistentes AS encargado', 'encargado.id', '=', 'encargados_linea.asistente_id')
						->where(function($query)
						{
			            	$sql_buscar_l=$GLOBALS['sql_buscar']; /// sql_buscar_l local
			                $query->whereRaw($sql_buscar_l);
			            })
						->get(array('lineas.id'));
									
			$lineas_ids_fin=array();
			foreach ($lineas as $linea) {
				array_push($lineas_ids_fin, $linea->id);
			}

			$lineas=Linea::whereIn('lineas.id', $lineas_ids_fin)
						->orderBy("id", 'asc')
				        ->get();

		    $cant=$lineas->count();
			
		}

		return $cant;
	}



}	