<?php
/** 
*
* @Redil Software. EscuelasController.php 
* @versión: 1.0.0     @modificado: 06 de Septiembre del 2014 
* @autor última modificación: Mairon Piedrahita
* 
*/
class PasosCrecimientoController extends BaseController
{
	public function __construct()
	{
		
		$this->beforeFilter('auth');  //bloqueo de acceso
		
	}

	public function getLista()
	{
		
		return View::make('pasos-crecimiento.index');
	}

	public function getNuevo()
	{
		return View::make('pasos-crecimiento.nuevo');
	}


	///////////////////////AJAX


	////////// este es el ajax que devuelve los pasos de crecimiento para el panel de pasos
	public function postObtienePasosCrecimientoParaBusquedaAjax($class="paso_crecimiento", $cant_pasos_crecimiento_cargados, $sql_adicional="1=1", $buscar="")
	{
		if(Auth::check())
		{
			$pasos_crecimiento="";
			$pasos_crecimiento_aptos="";//esta variable recoge los pasos_crecimiento que pueden ser seleccionados, dependera del sql adicional
			$cant_pasos_crecimiento=0;
			$total_pasos_crecimiento=0;
			$sql_adicional=str_replace("~", " ", $sql_adicional);

			$pasos_crecimiento=PasoCrecimiento::whereRaw("1=1");
			$pasos_crecimiento_aptos=PasoCrecimiento::whereRaw("1=1");

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

						$sql_buscar.="(pasos_crecimiento.nombre ILIKE '%$palabra%' OR pasos_crecimiento.descripcion ILIKE '%$palabra%'";
						if(ctype_digit($palabra))
							$sql_buscar.=" OR pasos_crecimiento.id=$palabra";
						$sql_buscar.=")";
						$c++;
				}
				$pasos_crecimiento=$pasos_crecimiento->whereRaw($sql_buscar);
				$pasos_crecimiento_aptos=$pasos_crecimiento_aptos->whereRaw($sql_buscar);				
			}

			if($sql_adicional!="1=1")
				$pasos_crecimiento_aptos=$pasos_crecimiento_aptos->whereRaw($sql_adicional)->get();

			$total_pasos_crecimiento=$pasos_crecimiento->get()->count();
			$pasos_crecimiento=$pasos_crecimiento->orderBy('id', 'asc')->skip($cant_pasos_crecimiento_cargados)->take(10)->get();

	        $lista=""; 

	        if($pasos_crecimiento->count()>0)
	        {
				foreach($pasos_crecimiento as $paso_crecimiento)
		        {
		        	$bloquear="item";
		        	if($sql_adicional!="1=1")
		        		if(!$pasos_crecimiento_aptos->find($paso_crecimiento->id))
		        			$bloquear="item-bloqueado";
		        	$lista.=' <li class="'.$bloquear.'" id="" style="cursor:pointer"><!-- start message --> 
		                        <a class="seleccionar-'.$class.'" data-nombre="'.$paso_crecimiento->nombre.'" data-id="'.$paso_crecimiento->id.'">                                      
		                          <div class="col-lg-3  col-md-3 col-xs-3">
	                             <center><img style="margin-right: -15px;" src="/img/fotos/default-m.png" class="img-item img-circle" width="70px" alt="User Image"></center> 
	                              </div>
		                          <div class="col-lg-5  col-md-5 col-xs-5">
		                            <p style="white-space: normal !important">
		                            <b>CÓDIGO: </b>'.$paso_crecimiento->id.'<br>
		                            <b>NOMBRE: </b>'.$paso_crecimiento->nombre.'
		                            </p>
		                          </div>
		                          <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4" style="margin-left: -15px;" >
		                          <b>DESCRIPCIÓN</b><br>'.$paso_crecimiento->decripcion;		         
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
	                  		 <i class="fa fa-home fa-2x"> </i> No hay pasos de crecimiento que coincidan con la búsqueda <b>"'.$buscar.'"</b> 	                      	
	                         <a style="color:#0073B7" href="../../pasos-crecimiento/nuevo" target="_blank"> <br >   Click Aquí para Agregar un Nuevo Paso de Crecimiento </a>
	                  </center>
	                 <br>
	                </div>  
				</li>';
		
			}
	        $lista.=     '
	                     <script type="text/javascript">
						  var cant_registros='.$pasos_crecimiento->count().';
						   var total_registros_ajax='.$total_pasos_crecimiento.';
						</script>';
			return $lista;
		}
		else
		{
			return "logout";
		}

	}

	public function postPasoCrecimientoSeleccionado($id, $class="asistente", $col_lg="12", $col_md="12", $col_sm="12", $col_xs="12" ) 
	{
		$respuesta=$this->construyeItemPasoCrecimiento($id, $class, $col_lg, $col_md, $col_sm, $col_xs);
		return $respuesta;
	}

	public function construyeItemPasoCrecimiento($id, $class="paso_crecimiento", $col_lg="12", $col_md="12", $col_sm="12", $col_xs="12", $adicional=""){
		$paso_crecimiento=PasoCrecimiento::find($id);
		$respuesta='<div style="padding: 5px;" id="item-'.$class.'-'.$id.'" class="col-lg-'.$col_lg.' col-md-'.$col_md.' col-sm-'.$col_sm.' col-xs-'.$col_xs.'">';
		$respuesta.='<div class="item-seleccionado">';
		$respuesta.='<div id="ico-'.$class.'" class="no-padding col-xs-11 col-sm-4 col-md-4 col-lg-4" >';
        $respuesta.='<center><img style="margin-left:-9px;margin-top:4px" src="/img/fotos/default-m.png" class="img-circle img-responsive" width="100px" alt="User Image"></center>'; 
        $respuesta.='</div>';
        $respuesta.='<div id="info-'.$class.'" class="info-item no-padding col-xs-11 col-sm-7 col-md-7 col-lg-7 ">';
		$respuesta.='<h4 class="titulo"><b> Paso de Crecimiento </b></h4>';
		$respuesta.='<p><b>Código: </b>'.$paso_crecimiento->id.'';
		$respuesta.='<p class="puntos">'.$paso_crecimiento->nombre.'</p>';
		$respuesta.=$adicional;
		$respuesta.='<br></p></div>';
		$respuesta.='<div class="cerrar no-padding col-xs-1 col-sm-1 col-md-1 col-lg-1" style="background-color:#fff;border-color:#fff" alert alert-success>
		<button id="cerrar-'.$class.'" data-id="'.$id.'" name="cerrar-'.$class.'" type="button" class="close cerrar-'.$class.'-seleccionado" style="font-size:27px;outline:none" aria-hidden="true">×</button>
		</div>';
		$respuesta.='</div></div>';

		return $respuesta;
	}

}

?>