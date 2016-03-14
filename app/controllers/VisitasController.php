<?php
/** 
*
* @Redil Software. visitasController.php 
* @versión: 1.0.0     @modificado: 25 de marzo del 2015
*ultima mofificacion 11:00 am
* @autor última modificación: Darwin Castaño
* 
*/
class 	VisitasController extends BaseController
{
	public function __construct()
	{
		
		$this->beforeFilter('auth');  //bloqueo de acceso
		
	}

	public function getIndex()

	{

		return Redirect::to('visitas/lista/todas');
		
	}

	
	public function getLista($tipo) // con esta función se listan las visitas y sus vistas con y sin busqueda
	{
		if (isset($_GET["buscar"]))
			{		////////codigo para crear la consulta de la busqueda
				$buscar=htmlspecialchars(Input::get('buscar'));
				$buscar_array=explode(" ", $buscar);
				GLOBAL $sql_buscar;
				$c=0;
				foreach($buscar_array as $palabra)
				{
					if($c!=0)
						$sql_buscar.=" OR ";
					$sql_buscar.="asistentes.nombre ILIKE '%$palabra%' OR asistentes.apellido ILIKE '%$palabra%' OR encargado.nombre ILIKE '%$palabra%' OR encargado.apellido ILIKE '%$palabra%' OR grupos.nombre ILIKE '%$palabra%'";
					if(ctype_digit($palabra))
						$sql_buscar.=" OR grupos.id=$palabra OR asistentes.id=$palabra OR encargado.id=$palabra";
					$c++;
				}
				/////////////////////fin del codigo para crear la consulta
					if (Auth::user()->id==1) //////// aqui inicia  la condicion cuando hay una  busqueda, y primero en este if pregunta si quien consulta es el  super administrador
						{
							
							$visitas_programadas=Visita::where('estado','=','0')->count();
							$visitas_no_realizadas=Visita::where('estado','=','2')->count();
							$visitas_realizadas=Visita::where('estado','=','1')->count();
							$fono_visitas=Visita::where('tipo','=','0')->count();
							$presencial=Visita::where('tipo','=','1')->count();
							$total_visitas=Visita::all()->count();
							///// de aqui en adelante inician las condiciones segun los filtros que ya tienen la busqueda
							if($tipo=="programadas")
								{
									///////// esta es la union de tablas para realizar la busqueda
									$visitas= Visita::leftJoin('asistentes', 'visitas.asistente_id', '=', 'asistentes.id')
									->leftJoin('grupos', 'grupos.id', '=', 'asistentes.grupo_id')
									->leftJoin('encargados_grupo', 'encargados_grupo.grupo_id','=', 'grupos.id')
									->leftJoin('asistentes AS encargado', 'encargados_grupo.asistente_id','=', 'encargado.id')
									->where(function($query)
						            {
						            	$sql_buscar_l=$GLOBALS['sql_buscar']; /// sql_buscar_l local
						                $query->whereRaw($sql_buscar_l);
						            })
									->where('grupos.dado_baja', '=', '0')
									->get(array('visitas.id'));
									
									$visitas_ids_fin=array();
									foreach ($visitas as $visita) {
										array_push($visitas_ids_fin, $visita->id);
									}
									$visitas=Visita::whereIn('visitas.id', $visitas_ids_fin)->where('estado','=','0')->paginate(10);
								}
							else if ($tipo=="realizadas") 
								{
									///////// esta es la union de tablas para realizar la busqueda
									$visitas= Visita::leftJoin('asistentes', 'visitas.asistente_id', '=', 'asistentes.id')
									->leftJoin('grupos', 'grupos.id', '=', 'asistentes.grupo_id')
									->leftJoin('encargados_grupo', 'encargados_grupo.grupo_id','=', 'grupos.id')
									->leftJoin('asistentes AS encargado', 'encargados_grupo.asistente_id','=', 'encargado.id')
									->where(function($query)
						            {
						            	$sql_buscar_l=$GLOBALS['sql_buscar']; /// sql_buscar_l local
						                $query->whereRaw($sql_buscar_l);
						            })
									->where('grupos.dado_baja', '=', '0')
									->get(array('visitas.id'));
									
									$visitas_ids_fin=array();
									foreach ($visitas as $visita) {
										array_push($visitas_ids_fin, $visita->id);
									}
									$visitas=Visita::whereIn('visitas.id', $visitas_ids_fin)->where('estado','=','1')->paginate(10);
								}
							else if ($tipo=="no_realizadas") 
								{
									///////// esta es la union de tablas para realizar la busqueda
									$visitas= Visita::leftJoin('asistentes', 'visitas.asistente_id', '=', 'asistentes.id')
									->leftJoin('grupos', 'grupos.id', '=', 'asistentes.grupo_id')
									->leftJoin('encargados_grupo', 'encargados_grupo.grupo_id','=', 'grupos.id')
									->leftJoin('asistentes AS encargado', 'encargados_grupo.asistente_id','=', 'encargado.id')
									->where(function($query)
						            {
						            	$sql_buscar_l=$GLOBALS['sql_buscar']; /// sql_buscar_l local
						                $query->whereRaw($sql_buscar_l);
						            })
									->where('grupos.dado_baja', '=', '0')
									->get(array('visitas.id'));
									
									$visitas_ids_fin=array();
									foreach ($visitas as $visita) {
										array_push($visitas_ids_fin, $visita->id);
									}
									$visitas=Visita::whereIn('visitas.id', $visitas_ids_fin)->where('estado','=','2')->paginate(10);	
									
								}
							else if($tipo=="telefonica")
								{
									///////// esta es la union de tablas para realizar la busqueda
									 $visitas= Visita::leftJoin('asistentes', 'visitas.asistente_id', '=', 'asistentes.id')
									->leftJoin('grupos', 'grupos.id', '=', 'asistentes.grupo_id')
									->leftJoin('encargados_grupo', 'encargados_grupo.grupo_id','=', 'grupos.id')
									->leftJoin('asistentes AS encargado', 'encargados_grupo.asistente_id','=', 'encargado.id')
									->where(function($query)
						            {
						            	$sql_buscar_l=$GLOBALS['sql_buscar']; /// sql_buscar_l local
						                $query->whereRaw($sql_buscar_l);
						            })
									->where('grupos.dado_baja', '=', '0')
									->get(array('visitas.id'));
									
									$visitas_ids_fin=array();
									foreach ($visitas as $visita) {
										array_push($visitas_ids_fin, $visita->id);
									}
									$visitas=Visita::whereIn('visitas.id', $visitas_ids_fin)->where('tipo','=','0')->paginate(10);	
								}
							else if($tipo=="presencial")
								{    
									///////// esta es la union de tablas para realizar la busqueda
									$visitas= Visita::leftJoin('asistentes', 'visitas.asistente_id', '=', 'asistentes.id')
									->leftJoin('grupos', 'grupos.id', '=', 'asistentes.grupo_id')
									->leftJoin('encargados_grupo', 'encargados_grupo.grupo_id','=', 'grupos.id')
									->leftJoin('asistentes AS encargado', 'encargados_grupo.asistente_id','=', 'encargado.id')
									->where(function($query)
						            {
						            	$sql_buscar_l=$GLOBALS['sql_buscar']; /// sql_buscar_l local
						                $query->whereRaw($sql_buscar_l);
						            })
									->where('grupos.dado_baja', '=', '0')
									->get(array('visitas.id'));
									
									$visitas_ids_fin=array();
									foreach ($visitas as $visita) {
										array_push($visitas_ids_fin, $visita->id);
									}
									$visitas=Visita::whereIn('visitas.id', $visitas_ids_fin)->where('tipo','=','1')->paginate(10);	
															
									
								}
							else ////// aquí por efcto sera el tipo todas 
								{
									///////// esta es la union de tablas para realizar la busqueda
									$visitas= Visita::leftJoin('asistentes', 'visitas.asistente_id', '=', 'asistentes.id')
									->leftJoin('grupos', 'grupos.id', '=', 'asistentes.grupo_id')
									->leftJoin('encargados_grupo', 'encargados_grupo.grupo_id','=', 'grupos.id')
									->leftJoin('asistentes AS encargado', 'encargados_grupo.asistente_id','=', 'encargado.id')
									->where(function($query)
						            {
						            	$sql_buscar_l=$GLOBALS['sql_buscar']; /// sql_buscar_l local
						                $query->whereRaw($sql_buscar_l);
						            })
									->where('grupos.dado_baja', '=', '0')
									->get(array('visitas.id'));
									
									$visitas_ids_fin=array();
									foreach ($visitas as $visita) {
										array_push($visitas_ids_fin, $visita->id);
									}
									$visitas=Visita::whereIn('visitas.id', $visitas_ids_fin)->paginate(10);				


								}
									

								return View::make('visitas.index')->with(

									array('visitas' => $visitas,
									  'visitas_programadas' => $visitas_programadas,
									  'fono_visitas'=> $fono_visitas,
									  'presencial'=> $presencial,
									  'visitas_no_realizadas'=>	$visitas_no_realizadas,
									  'visitas_realizadas'=>	$visitas_realizadas,
									  'total_visitas'=>$total_visitas,
									  'buscar' => $buscar,
									  'tipo' => $tipo,

									));


						}
						else// Aqui es cuando se logue una persona diferente al super administrador, aun con busqueda. 
						{   
							//este sql es para conocer todos los grupos indirectos del usuario logueado
							$sql2=""; 
								$grupos=Auth::user()->asistente->grupos()->get();
								$c=0;
									foreach ($grupos as $grupo) 
									{
										if($c!=0)
											$sql2.=" OR ";
										$sql2.="branch LIKE '%,".$grupo->id.",%'";
										$c++;
									}

							
							$grupos_ids= array();

							$grupos=Grupo::whereRaw($sql2)->where('dado_baja', '!=', '1')->get(array('grupos.id'));

							foreach ($grupos as $grupo)
								 {
										array_push($grupos_ids, $grupo->id);
								 }
							// aqui termina la construccion del sql para conocer los grupos indirectos del logueado	 

							//este es para conocer los asistentes que estan en los grupos ya seleccionados
							$asistentes=Asistente::whereIn('grupo_id',$grupos_ids)->get(array("asistentes.id"));

							$asistente_ids=array();

							foreach ($asistentes as $asistente) 
									{

										array_push($asistente_ids,$asistente->id);
									}
							// aqui termina la busqueda de los asistentes perteneientes a los grupos indirectos eprenecintes al usuario logueado		
							// de aqui en adelante son las consultas que hago con los anteriores sql
							$visitas_programadas=Visita::whereIn('asistente_id', $asistente_ids)->where('estado','=','0')->count();
							$visitas_realizadas=Visita::whereIn('asistente_id', $asistente_ids)->where('estado','=','1')->count();
							$visitas_no_realizadas=Visita::whereIn('asistente_id', $asistente_ids)->where('estado','=','2')->count();
							$fono_visitas=Visita::whereIn('asistente_id', $asistente_ids)->where('tipo','=','0')->count();
							$presencial=Visita::whereIn('asistente_id', $asistente_ids)->where('tipo','=','1')->count();
							$total_visitas=Visita::whereIn('asistente_id', $asistente_ids)->count();
							
							/////// aqui arrancan las condiciones de los filtros en la busqueda del usuario logeado
							if ($tipo=="programadas")
								{
									$visitas= Visita::leftJoin('asistentes', 'visitas.asistente_id', '=', 'asistentes.id')
									->leftJoin('grupos', 'grupos.id', '=', 'asistentes.grupo_id')
									->leftJoin('encargados_grupo', 'encargados_grupo.grupo_id','=', 'grupos.id')
									->leftJoin('asistentes AS encargado', 'encargados_grupo.asistente_id','=', 'encargado.id')
									//->whereIn('grupos.id', $grupos_ids)
									->where(function($query)
						            {
						            	$sql_buscar_l=$GLOBALS['sql_buscar']; /// sql_buscar_l local
						                $query->whereRaw($sql_buscar_l);
						            })
									->where('grupos.dado_baja', '=', '0')
									->get(array('visitas.id'));
									
									$visitas_ids_fin=array();
									foreach ($visitas as $visita) {
										array_push($visitas_ids_fin, $visita->id);
									}
									$visitas=Visita::whereIn('visitas.id', $visitas_ids_fin)->where('estado','=','0')->paginate(10);
								}
							else if ($tipo=="realizadas")
								{
									$visitas= Visita::leftJoin('asistentes', 'visitas.asistente_id', '=', 'asistentes.id')
									->leftJoin('grupos', 'grupos.id', '=', 'asistentes.grupo_id')
									->leftJoin('encargados_grupo', 'encargados_grupo.grupo_id','=', 'grupos.id')
									->leftJoin('asistentes AS encargado', 'encargados_grupo.asistente_id','=', 'encargado.id')
									//->whereIn('grupos.id', $grupos_ids)
									->where(function($query)
						            {
						            	$sql_buscar_l=$GLOBALS['sql_buscar']; /// sql_buscar_l local
						                $query->whereRaw($sql_buscar_l);
						            })
									->where('grupos.dado_baja', '=', '0')
									->get(array('visitas.id'));
									
									$visitas_ids_fin=array();
									foreach ($visitas as $visita) {
										array_push($visitas_ids_fin, $visita->id);
									}
									$visitas=Visita::whereIn('visitas.id', $visitas_ids_fin)->where('estado','=','1')->paginate(10);
								}
							else if ($tipo=="no_realizadas")
								{
									$visitas= Visita::leftJoin('asistentes', 'visitas.asistente_id', '=', 'asistentes.id')
									->leftJoin('grupos', 'grupos.id', '=', 'asistentes.grupo_id')
									->leftJoin('encargados_grupo', 'encargados_grupo.grupo_id','=', 'grupos.id')
									->leftJoin('asistentes AS encargado', 'encargados_grupo.asistente_id','=', 'encargado.id')
									//->whereIn('grupos.id', $grupos_ids)
									->where(function($query)
						            {
						            	$sql_buscar_l=$GLOBALS['sql_buscar']; /// sql_buscar_l local
						                $query->whereRaw($sql_buscar_l);
						            })
									->where('grupos.dado_baja', '=', '0')
									->get(array('visitas.id'));
									
									$visitas_ids_fin=array();
									foreach ($visitas as $visita) {
										array_push($visitas_ids_fin, $visita->id);
									}
									$visitas=Visita::whereIn('visitas.id', $visitas_ids_fin)->where('estado','=','2')->paginate(10);
									
								}
							else if ($tipo=="telefonica")
								{
									$visitas= Visita::leftJoin('asistentes', 'visitas.asistente_id', '=', 'asistentes.id')
									->leftJoin('grupos', 'grupos.id', '=', 'asistentes.grupo_id')
									->leftJoin('encargados_grupo', 'encargados_grupo.grupo_id','=', 'grupos.id')
									->leftJoin('asistentes AS encargado', 'encargados_grupo.asistente_id','=', 'encargado.id')
									//->whereIn('grupos.id', $grupos_ids)
									->where(function($query)
						            {
						            	$sql_buscar_l=$GLOBALS['sql_buscar']; /// sql_buscar_l local
						                $query->whereRaw($sql_buscar_l);
						            })
									->where('grupos.dado_baja', '=', '0')
									->get(array('visitas.id'));
									
									$visitas_ids_fin=array();
									foreach ($visitas as $visita) {
										array_push($visitas_ids_fin, $visita->id);
									}
									$visitas=Visita::whereIn('visitas.id', $visitas_ids_fin)->where('tipo','=','0')->paginate(10);	
									
								}
							else if ($tipo=="presencial")
								{
									$visitas= Visita::leftJoin('asistentes', 'visitas.asistente_id', '=', 'asistentes.id')
									->leftJoin('grupos', 'grupos.id', '=', 'asistentes.grupo_id')
									->leftJoin('encargados_grupo', 'encargados_grupo.grupo_id','=', 'grupos.id')
									->leftJoin('asistentes AS encargado', 'encargados_grupo.asistente_id','=', 'encargado.id')
									//->whereIn('grupos.id', $grupos_ids)
									->where(function($query)
						            {
						            	$sql_buscar_l=$GLOBALS['sql_buscar']; /// sql_buscar_l local
						                $query->whereRaw($sql_buscar_l);
						            })
									->where('grupos.dado_baja', '=', '0')
									->get(array('visitas.id'));
									
									$visitas_ids_fin=array();
									foreach ($visitas as $visita) {
										array_push($visitas_ids_fin, $visita->id);
									}
									$visitas=Visita::whereIn('visitas.id', $visitas_ids_fin)->where('tipo','=','1')->paginate(10);	
									
								}

							else 
								{
									///// aqui por defecto seran todas las visitas en su busqueda
									
									$visitas= Visita::leftJoin('asistentes', 'visitas.asistente_id', '=', 'asistentes.id')
									->leftJoin('grupos', 'grupos.id', '=', 'asistentes.grupo_id')
									->leftJoin('encargados_grupo', 'encargados_grupo.grupo_id','=', 'grupos.id')
									->leftJoin('asistentes AS encargado', 'encargados_grupo.asistente_id','=', 'encargado.id')
									//->whereIn('grupos.id', $grupos_ids)
									->where(function($query)
						            {
						            	$sql_buscar_l=$GLOBALS['sql_buscar']; /// sql_buscar_l local
						                $query->whereRaw($sql_buscar_l);
						            })
									->where('grupos.dado_baja', '=', '0')
									->get(array('visitas.id'));
									
									$visitas_ids_fin=array();
									foreach ($visitas as $visita) {
										array_push($visitas_ids_fin, $visita->id);
									}
									$visitas=Visita::whereIn('visitas.id', $visitas_ids_fin)->paginate(10);			
								}
							return View::make('visitas.index')->with(
								array('visitas' => $visitas,
								  'visitas_programadas' => $visitas_programadas,
								  'fono_visitas'=> $fono_visitas,
								  'presencial'=> $presencial,
								  'visitas_no_realizadas'=>	$visitas_no_realizadas,
								  'visitas_realizadas'=>	$visitas_realizadas,
								  'total_visitas'=>$total_visitas,
								   'buscar' => $buscar,
								  'tipo' => $tipo,


								));

						}
 			}


	 else 	{///// aqui arranca el de lo contrario principal si no hay una busqueda
	 				if (Auth::user()->id==1) ///// aqui si no hay busqueda pregunta  si el que se logueo es el super administrador
							{
								
										$visitas_programadas=Visita::where('estado','=','0')->count();
										$visitas_no_realizadas=Visita::where('estado','=','2')->count();
										$visitas_realizadas=Visita::where('estado','=','1')->count();
										$fono_visitas=Visita::where('tipo','=','0')->count();
										$presencial=Visita::where('tipo','=','1')->count();
										$total_visitas=Visita::all()->count();
										if($tipo=="programadas")
											{
												$visitas=Visita::where('estado','=','0')->paginate(10);
											}
										else if ($tipo=="realizadas") 
											{
												$visitas=Visita::where('estado','=','1')->paginate(10);
											}
										else if ($tipo=="no_realizadas") 
											{
												$visitas=Visita::where('estado','=','2')->paginate(10);
											}
										else if($tipo=="telefonica")
											{
												$visitas=Visita::where('tipo','=','0')->paginate(10);
											}
										else if($tipo=="presencial")
											{
												$visitas=Visita::where('tipo','=','1')->paginate(10);
											}
										else 
											{ 
												$tipo='todas';/// qui asigne el valor a tipo para que se puedan mantener la busqueda en la pagina actual o filtro actual
												$visitas=Visita::paginate(10);


											}
								

								return View::make('visitas.index')->with(

									array('visitas' => $visitas,
									  'visitas_programadas' => $visitas_programadas,
									  'fono_visitas'=> $fono_visitas,
									  'presencial'=> $presencial,
									  'visitas_no_realizadas'=>	$visitas_no_realizadas,
									  'visitas_realizadas'=>	$visitas_realizadas,
									  'total_visitas'=>$total_visitas,
									  'tipo'=>$tipo,

									));
							}
					else// Aqui es cuando se logue una persona diferente al super administrador
						{   
							//este sql es para conocer todos los grupos indirectos del usuario logueado
							$sql2="";
								$grupos=Auth::user()->asistente->grupos()->get();
								$c=0;
								foreach ($grupos as $grupo) 
								{
									if($c!=0)
										$sql2.=" OR ";
									$sql2.="branch LIKE '%,".$grupo->id.",%'";
									$c++;
								}

								//este es para conocer todos los grupos indirectos del usuario logueado
								$grupos_ids= array();
								
								$grupos=Grupo::whereRaw($sql2)->where('dado_baja', '!=', '1')->get(array('grupos.id'));

								foreach ($grupos as $grupo)
									 {
											array_push($grupos_ids, $grupo->id);

									 }

								// aqui termina la construccion del sql para conocer los grupos indirectos del logueado	
								//este es para conocer los asistentes que estan en los grupos ya seleccionados
								$asistentes=Asistente::whereIn('grupo_id',$grupos_ids)->get(array("asistentes.id"));

								$asistente_ids=array();

								foreach ($asistentes as $asistente) 
										{

											array_push($asistente_ids,$asistente->id);
										}				
								// de aqui en adelante son las consultas que hago con los anteriores sql
								$visitas_programadas=Visita::whereIn('asistente_id', $asistente_ids)->where('estado','=','0')->count();
								$visitas_realizadas=Visita::whereIn('asistente_id', $asistente_ids)->where('estado','=','1')->count();
								$visitas_no_realizadas=Visita::whereIn('asistente_id', $asistente_ids)->where('estado','=','2')->count();
								$fono_visitas=Visita::whereIn('asistente_id', $asistente_ids)->where('tipo','=','0')->count();
								$presencial=Visita::whereIn('asistente_id', $asistente_ids)->where('tipo','=','1')->count();
								$total_visitas=Visita::whereIn('asistente_id', $asistente_ids)->count();
										if ($tipo=="programadas")
											{
												$visitas= Visita::leftJoin('asistentes', 'visitas.asistente_id', '=', 'asistentes.id')
													->leftJoin('grupos', 'grupos.id', '=', 'asistentes.grupo_id')
													->leftJoin('encargados_grupo', 'encargados_grupo.grupo_id','=', 'grupos.id')
													->leftJoin('asistentes AS encargado', 'encargados_grupo.asistente_id','=', 'encargado.id')
													->whereIn('grupos.id',$grupos_ids)
													->whereIn('asistentes.id', $asistente_ids)
													->where('grupos.dado_baja', '=', '0')
													->get(array('visitas.id'));
													
													$visitas_ids_fin=array();
													foreach ($visitas as $visita) 
													{
														array_push($visitas_ids_fin, $visita->id);
													}
													$visitas=Visita::whereIn('visitas.id', $visitas_ids_fin)->where('estado','=','0')->paginate(10);
												
											}
										else if ($tipo=="realizadas")
											{
												$visitas= Visita::leftJoin('asistentes', 'visitas.asistente_id', '=', 'asistentes.id')
													->leftJoin('grupos', 'grupos.id', '=', 'asistentes.grupo_id')
													->leftJoin('encargados_grupo', 'encargados_grupo.grupo_id','=', 'grupos.id')
													->leftJoin('asistentes AS encargado', 'encargados_grupo.asistente_id','=', 'encargado.id')
													->whereIn('grupos.id',$grupos_ids)
													->whereIn('asistentes.id', $asistente_ids)
													->where('grupos.dado_baja', '=', '0')
													->get(array('visitas.id'));
													
													$visitas_ids_fin=array();
													foreach ($visitas as $visita)
													 {
														array_push($visitas_ids_fin, $visita->id);
													}
													$visitas=Visita::whereIn('visitas.id', $visitas_ids_fin)->where('estado','=','1')->paginate(10);
												
											}
										else if ($tipo=="no_realizadas")
											{
												$visitas= Visita::leftJoin('asistentes', 'visitas.asistente_id', '=', 'asistentes.id')
													->leftJoin('grupos', 'grupos.id', '=', 'asistentes.grupo_id')
													->leftJoin('encargados_grupo', 'encargados_grupo.grupo_id','=', 'grupos.id')
													->leftJoin('asistentes AS encargado', 'encargados_grupo.asistente_id','=', 'encargado.id')
													->whereIn('grupos.id',$grupos_ids)
													->whereIn('asistentes.id', $asistente_ids)
													->where('grupos.dado_baja', '=', '0')
													->get(array('visitas.id'));
													
													$visitas_ids_fin=array();
													foreach ($visitas as $visita) 
													{
														array_push($visitas_ids_fin, $visita->id);
													}
													$visitas=Visita::whereIn('visitas.id', $visitas_ids_fin)->where('estado','=','2')->paginate(10);
												
											}
										else if ($tipo=="telefonica")
											{
												$visitas= Visita::leftJoin('asistentes', 'visitas.asistente_id', '=', 'asistentes.id')
													->leftJoin('grupos', 'grupos.id', '=', 'asistentes.grupo_id')
													->leftJoin('encargados_grupo', 'encargados_grupo.grupo_id','=', 'grupos.id')
													->leftJoin('asistentes AS encargado', 'encargados_grupo.asistente_id','=', 'encargado.id')
													->whereIn('grupos.id',$grupos_ids)
													->whereIn('asistentes.id', $asistente_ids)
													->where('grupos.dado_baja', '=', '0')
													->get(array('visitas.id'));
													
													$visitas_ids_fin=array();
													foreach ($visitas as $visita) 
													{
														array_push($visitas_ids_fin, $visita->id);
													}
													$visitas=Visita::whereIn('visitas.id', $visitas_ids_fin)->where('tipo','=','0')->paginate(10);
												
											}
										else if ($tipo=="presencial")
											{
												$visitas= Visita::leftJoin('asistentes', 'visitas.asistente_id', '=', 'asistentes.id')
													->leftJoin('grupos', 'grupos.id', '=', 'asistentes.grupo_id')
													->leftJoin('encargados_grupo', 'encargados_grupo.grupo_id','=', 'grupos.id')
													->leftJoin('asistentes AS encargado', 'encargados_grupo.asistente_id','=', 'encargado.id')
													->whereIn('grupos.id',$grupos_ids)
													->whereIn('asistentes.id', $asistente_ids)
													->where('grupos.dado_baja', '=', '0')
													->get(array('visitas.id'));
													
													$visitas_ids_fin=array();
													foreach ($visitas as $visita) 
													{
														array_push($visitas_ids_fin, $visita->id);
													}
													$visitas=Visita::whereIn('visitas.id', $visitas_ids_fin)->where('tipo','=','1')->paginate(10);	
												
											}

										else 
											{
												///aqui por defectos colocamos el valor a tipo de todas porque asi inicia y se mantiene el valor de la variable $tipo
													$tipo='todas';
													$visitas= Visita::leftJoin('asistentes', 'visitas.asistente_id', '=', 'asistentes.id')
													->leftJoin('grupos', 'grupos.id', '=', 'asistentes.grupo_id')
													->leftJoin('encargados_grupo', 'encargados_grupo.grupo_id','=', 'grupos.id')
													->leftJoin('asistentes AS encargado', 'encargados_grupo.asistente_id','=', 'encargado.id')
													->whereIn('grupos.id',$grupos_ids)
													->whereIn('asistentes.id', $asistente_ids)
													->where('grupos.dado_baja', '=', '0')
													->get(array('visitas.id'));
													
													$visitas_ids_fin=array();
													foreach ($visitas as $visita) {
														array_push($visitas_ids_fin, $visita->id);
													}
													$visitas=Visita::whereIn('visitas.id', $visitas_ids_fin)->paginate(10);			
											 }
												return View::make('visitas.index')->with(
													array('visitas' => $visitas,
													  'visitas_programadas' => $visitas_programadas,
													  'fono_visitas'=> $fono_visitas,
													  'presencial'=> $presencial,
													  'visitas_no_realizadas'=>	$visitas_no_realizadas,
													  'visitas_realizadas'=>	$visitas_realizadas,
													  'total_visitas'=>$total_visitas,
													  'tipo'=>$tipo,

														));

						}
	 	  	}
		
	}
	
	public function getReportesVisitas($tipo)
	{

		$fecha_actual = date('Y-m-d'); // Me trae la fecha actual de sistema
      	$nueva_fecha = strtotime ( '-30 day' , strtotime ( $fecha_actual ) ) ; // Esta funcion me coge la fecha_actual y le resta 30 dias
		$nueva_fecha = date ( 'Y-m-d' , $nueva_fecha ); // le doy formato Y-M-J a mi nueva fecha
		
		
		if($tipo=="programadas")
		{	
			$visitas = Visita::where('estado', '=', '0' )->get();			
			$cantidad= Visita::where('estado', '=', '0' )->count();

		}
		else if($tipo=="realizadas")
		{
			$visitas = Visita::where('estado', '=', '1' )->get();			
			$cantidad= Visita::where('estado', '=', '1' )->count();
		}
		else if($tipo=="no realizadas")
		{
			$visitas = Visita::where('estado', '=', '2' )->get();			
			$cantidad= Visita::where('estado', '=', '2' )->count();
		}
		else if($tipo=="telefonica")
		{
			$visitas = Visita::where('tipo', '=', '0' )->get();			
			$cantidad= Visita::where('tipo', '=', '0' )->count();

		}	
		else if ($tipo=="presencial")
		{
			$visitas = Visita::where('tipo', '=', '1')->get();
			$cantidad= Visita::where('tipo', '=', '1')->count();
		}
		else  
		{
			
			$visitas = Visita::where('tipo', '=', '1')->get();
			$cantidad= Visita::where('tipo', '=', '1')->count();
		}
		
		$html=View::make('visitas.reportes.visitas-pdf')-> with(
			array(
				'visitas' => $visitas,
				'cantidad' => $cantidad,
				'tipo' => $tipo,
				 ));
    	return PDF::load(utf8_decode($html), 'A4', 'landscape')->show();//->download('my_pdf');
	}

	public function getNuevo ()
	{
		if(Auth::user()->id==1) 
		{
			$asistentes = Asistente::all(); 
			return  View::make('visitas.nuevo')->with('asistentes', $asistentes);
		}
		else
		{
			$grupos_ids= array();
			$grupos=Auth::user()->asistente->grupos()->where('dado_baja', '!=', '1')->get(array('grupos.id'));

			foreach ($grupos as $grupo) {
				array_push($grupos_ids, $grupo->id);
			}
			
			$asistentes = Asistente::whereIn('grupo_id', $grupos_ids)->get(); 
			
			return  View::make('visitas.nuevo')->with(
				array('asistentes' => $asistentes,
				  
				));
		}
		
	}

	//peticion ajax para cargar los lideres de una celula en una tabla del formulario
	public function postAjax($id_visitado)
	{
		$asistente=Asistente::find($id_visitado);
		$grupo= $asistente->grupo()->get();


		$tbody='<tbody>';

		foreach($grupo->encargados as $encargado) 
		{  
		  $tbody.= '<tr>';
		  $tbody.= '<td>'.$encargado['id'].'</td>';
		  $tbody.= '<td>'.$encargado['nombre'].' '.$encargado['apellido'].'</td>';
		  $tbody.= '</tr>';
		}
		$tbody.= '</tbody>';
		return $tbody;
	}

	public function postNew()
	{

		$visita= new Visita;
		$visita->tipo=Input::get('tipo_visita');
		$visita->estado=Input::get('estado');
		$visita->fecha_limite=Input::get('fecha_limite');
		
		if (Input::get('fecha visita')!= "" )
			{
				$visita->fecha=Input::get('fecha_visita');
			}
		$visita->motivo=Input::get('motivo');
		$visita->hora=Input::get('hora');
		$visita->observacion=Input::get('observacion');
		$visita->asistente_id=Input::get('integrantes_id');
		$visita->asignado_por=Input::get('asignado_por');

		$visita->save();

		$asistente=Asistente::find($visita->asistente_id);
		$grupo= $asistente->grupo;
        
		foreach ($grupo->encargados as $encargado ) {
			     $nombre_lider=$encargado->nombre;
			     $apellido_lider=$encargado->apellido;
			     $id_lider=$encargado->id;
			     Global $correo;
			     $correo=$encargado->user->email;
			
				View::make('emails.email_visitas')->with(array(

							'observacion' =>$visita->observacion,
					  'estado'=>$visita->estado,
					  'tipo'=>$visita->tipo,
					  'hora'=>$visita->hora,
					  'motivo'=>$visita->motivo,
					  'fecha'=>$visita->fecha,
					  'nombre'=>$visita->asistente->nombre,
					  'fecha_limite'=>$visita->fecha_limite,
					  'apellido'=>$visita->asistente->apellido,
					  'nombre_lider'=>$nombre_lider,
					  'apellido_lider'=>$apellido_lider,
					  'id_lider'=>$id_lider,
					  
							));

				 $datos= array('observacion'=>$visita->observacion,
					  'estado'=>$visita->estado,
					  'tipo'=>$visita->tipo,
					  'hora'=>$visita->hora,
					  'motivo'=>$visita->motivo,
					  'fecha'=>$visita->fecha,
					  'nombre'=>$visita->asistente->nombre,
					  'fecha_limite'=>$visita->fecha_limite,
					 	'apellido'=>$visita->asistente->apellido,
					  'nombre_lider'=>$nombre_lider,
					  'apellido_lider'=>$apellido_lider,
					  'id_lider'=>$id_lider,
					 
					  );

					Mail::send('emails.email_visitas', $datos, function($message) 
			{

				$email_iglesia=User::find(1);
                $email_iglesia=$email_iglesia->email;
				$fromemail=($email_iglesia);
				$correo_lider=$GLOBALS['correo'];
                $fromemail= $email_iglesia;
				
				$message->to($correo_lider);
				$message->from($fromemail);
				$message->subject('usted envio este correo bn');

			});
		}			

					return Redirect::to('/visitas/nuevo')->with (array(
						'nombre'=>$visita->asistente->nombre,
						'apellido'=>$visita->asistente->apellido,
						'status'  => 'ok_update',
						'julio'=> $visita,

							)
						);
	}

	
		public function getActualizar($id)
	{
		$visitas = Visita::find($id);
		$asistentes = Asistente::all();
		return View::make('visitas.actualizar')->with(
			array(
				'visitas' => $visitas,
				'asistentes'=>$asistentes,
				
				));
	}
	public function postUpdate($id)
	{
		$visita=Visita::find($id);
		
		if (Input::get('fecha_visita')!= "" )
			{
				$visita->fecha=Input::get('fecha_visita');
				$visita->estado=Input::get('1');

			}
				$visita->tipo=Input::get('tipo_visita');
				$visita->motivo=Input::get('motivo');
				$visita->hora=Input::get('hora');
				$visita->observacion=Input::get('observacion');
				$visita->asistente_id=Input::get('integrantes_id');
				$visita->asignado_por=Input::get('asignado_por');
				$visita->estado=Input::get('estado');
		if (Input::get('fecha visita')!= "" )
			{
				$visita->fecha=Input::get('fecha_visita');
			}
		$visita->fecha_limite=Input::get('fecha_limite');

		$asistente=Asistente::find($visita->asistente_id);
		$grupo= $asistente->grupo;
			
		foreach ($grupo->encargados as $encargado )
			 {
			     $nombre_lider=$encargado->nombre;
			     $apellido_lider=$encargado->apellido;
			     $id_lider=$encargado->id;
			     Global $correo;
			     $correo=$encargado->user->email;
			
				View::make('emails.email_visitas')->with(array(

							'observacion' =>$visita->observacion,
					  'estado'=>$visita->estado,
					  'tipo'=>$visita->tipo,
					  'hora'=>$visita->hora,
					  'motivo'=>$visita->motivo,
					  'fecha'=>$visita->fecha,
					  'nombre'=>$visita->asistente->nombre,
					  'fecha_limite'=>$visita->fecha_limite,
					  'apellido'=>$visita->asistente->apellido,
					  'nombre_lider'=>$nombre_lider,
					  'apellido_lider'=>$apellido_lider,
					  'id_lider'=>$id_lider,
					  
							));

				 $datos= array('observacion'=>$visita->observacion,
					  'estado'=>$visita->estado,
					  'tipo'=>$visita->tipo,
					  'hora'=>$visita->hora,
					  'motivo'=>$visita->motivo,
					  'fecha'=>$visita->fecha,
					  'nombre'=>$visita->asistente->nombre,
					  'fecha_limite'=>$visita->fecha_limite,
					 	'apellido'=>$visita->asistente->apellido,
					  'nombre_lider'=>$nombre_lider,
					  'apellido_lider'=>$apellido_lider,
					  'id_lider'=>$id_lider,
					 
					  );

				Mail::send('emails.email_visitas', $datos, function($message) 
						{

								$email_iglesia=User::find(1);
					            $email_iglesia=$email_iglesia->email;
								$fromemail=($email_iglesia);
								$correo_lider=$GLOBALS['correo'];
					            $fromemail= $email_iglesia;
								
								$message->to($correo_lider);
								$message->from($fromemail);
								$message->subject('Asignación de una visita REDIL');

						});
		}
			$visita->save();

		return Redirect::to('/visitas/actualizar/'.$id)->with (array(
			'status'  => 'ok_update',
			'julio'=> $visita,
				)
			);
	}
	
}