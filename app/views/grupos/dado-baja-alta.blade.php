@if(Auth::check())
@include('includes.lenguaje')
<!DOCTYPE html>
<!-- Vista creada por: Juan Carlos Velasquez 
     Fecha creacíón: 06-04-2015
     Fecha Ultima modificación: 06-04-2015 
     funcion vista: Esta vista permite dar de (Baja/Alta) a los asistentes y especificar el motivo y hacer las observaciones pertinentes.
     software REDIL version 1.0
-->
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    <title>Redil | Dar de baja un grupo</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    @include('includes.styles')
    <!-- Ionicons -->
    <link href="/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
     
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
      <![endif]-->
  </head>
  <body class="skin-black">
    <!-- header logo: style can be found in header.less -->
    @include('includes.header')
    <div class="wrapper row-offcanvas row-offcanvas-left">
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="left-side sidebar-offcanvas">                
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            @include('includes.menu')
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Right side column. Contains the navbar and content of the page -->
      <aside class="right-side">    

        <!-- contenido principal -->
        <section class="content">   
          <!-- row de cuadro de colores -->
            <!-- row de la tabla -->
          <div class="row">  

            <!-- columna del boton guardar -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 10px;">
              <div class=" box-header">
                  <?php $mensaje=Session::get('mensaje'); ?>
                  @if($mensaje != "") 
                    <div class="alert alert-success" style="padding-bottom:5px; padding-top:5px; margin-bottom: -5px; margin-top: 10px;" >
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <b> {{$mensaje}} </b>  
                    </div>
                  @endif             
              </div>
            </div>
            <!-- /columna del boton guardar --> 

            <!-- columna formulario dado (baja/alta)-->
           
            <div class="col-md-7 col-lg-7 col-sm-7 col-xs-12">
              <form role="form" action="../cambiar-dado-baja-alta/{{$grupo->id}}" method="post">              
                <div class="panel">
                  <div class="panel-heading">
                    <h4 class="modal-title">Deseas dar de @if($grupo->dado_baja == 0) baja @else alta @endif  al grupo <b>  {{ $grupo->nombre }}</b></h4>
                    <h5 class="modal-title">Los campos con (*) son obligatorios.</b></h5>
                  </div>
                  <div class="panel-body">
                    <!-- Motivo de dado (baja/alta) -->
                    <div class="form-group">
                       <label>Motivo (*)</label>
                       <input id="motivo" name="motivo" type="text" class="form-control" maxlength="100" placeholder=""  required/>
                    </div>
                    <!-- /Motivo de dado (baja/alta) -->

                    <!-- Observaciones del dado (baja/alta) -->
                    <div class="form-group">
                        <label>Observaciones</label>
                        <textarea id="observaciones" name="observaciones" class="form-control" rows="5"  maxlength="500" placeholder="" required> </textarea>
                    </div>
                    <!-- /Observaciones del dado (baja/alta) -->

                    @if($grupo->dado_baja==0)
                      <!-- Seleccion de grupo para los nuevos asistentes  -->
                      @if($cantidad_asistentes!=0)
                        <br>
                        <div class="alert alert-warning col-lg-12" style="margin-left: -2px;">                        
                          <p><b>NOTA: </b>Actualmente el grupo tiene <b>{{$cantidad_asistentes}} de asistente(s)</b>, si deseas asignarlos a otro grupo haz clic en el botón "CAMBIAR DE GRUPO",  de lo contrario  al dar de baja al grupo actual todos sus asistentes pasaran a ser asistentes sin grupo.   </p> 
                          <br>
                          <center>
                            <button class="btn btn-warning" type="button" data-toggle="collapse" data-target="#nuevo-grupo" aria-expanded="false" aria-controls="collapseExample">
                              Cambiar de grupo
                            </button> 
                          </center>
                        </div>          
                        
                        <div class="collapse" id="nuevo-grupo">                                                
                          <!-- grupo --> 
                            <div id="panel-grupo" class="nav navbar-nav panel-ppl-busqueda">
                              <label> Seleccione el grupo a donde se pasarán todos los asistentes:</label>
                              <li class="dropdown messages-menu">
                                <div class="input-group "  >
                                  <input type="hidden" id="grupo_id" name="grupo_id"/>
                                  <input type="text" id="busqueda_grupo" class="form-control buscar" autocomplete="off" placeholder="Buscar grupo por código, nombre o cédula..."/>
                                  <span class="input-group-btn">
                                    <button type='button' class="btn btn-flat" style="border-color:#CCC;background:#fff" ><i class="fa fa-search" style="color:#00545E" ></i></button>
                                  </span>
                                </div> 

                                <ul id="panel-ppl-grupos" class="panel-busqueda-moviles dropdown-menu">
                                  <li>
                                    <!-- el siguiente es el panel que se llenara con los registros de la busqueda, se deja vacio -->
                                    <ul class="menu" id="panel-grupos">

                                    </ul>
                                  </li>
                                </ul>
                                <div class="footer">Mostrando 0 resultados de 0</div>
                              </li>
                            </div>  
                            <div id="grupo-seleccionado">  

                            </div>
                          <!-- Script de funciones para las busquedas de grupos-->        
                        </div>

                      @endif
                      <!-- /Seleccion de grupo para los nuevos asistentes  -->

                    @else 
                      @if($grupo->id!=1)
                        <!-- Seleccion de la nueva linea  -->
                        <hr> 
                        <div class="form-group row-fluid">                         
                                               
                          <label> Seleccione la nueva línea a la que va pertenecer el grupo:</label>  
                          
                          <div class="nav navbar-nav">
                            <li class="dropdown messages-menu">
                              <div class="input-group "  >
                                <input type="text" id="busqueda_linea" class="form-control buscar" autocomplete="off" onfocus="focusInputLineas()" placeholder="Buscar linea por codigo, nombre o encargados de las líneas." onkeydown="doSearchLineas(arguments[0]||event)" />
                                <span class="input-group-btn">
                                    <button type='button' name='seach' id='search-btn' class="btn btn-flat bg"><i class="fa fa-search"></i></button>
                                </span>
                              </div> 

                              <ul id="panel-ppl-lineas" class="panel-busqueda-moviles dropdown-menu " style="overflow: auto; width: 100%; max-height: 200px; position: relative; display:none;">
                                <li>
                                  <!-- inner menu: contains the actual data -->
                                  <ul class="menu" id="panel-lineas">
                                    @foreach($lineas as $linea)
                                    <li id="" class="" style="cursor:pointer"><!-- start message -->
                                      <a  class="seleccionar-linea" data-nombre="{{$linea->nombre}}" data-id="{{$linea->id}}">                                      
                                        <div class="col-lg-4  col-md-4 col-xs-4">
                                          <p>
                                          <b>CÓDIGO: </b>{{$linea->id}}<br>
                                          <b>NOMBRE: </b> {{$linea->nombre}}
                                          </p> 
                                        </div>  
                                        <div class="col-lg-8  col-md-8 col-xs-8">
                                          <b>ENCARGADOS: </b> <br>
                                          @if($linea->encargados->count() > 0) 
                                            @foreach ($linea->encargados as $encargado)
                                              @if ($encargado->tipoAsistente['id']==5)
                                                <label class="label arrowed-right bg-purple" data-toggle="tooltip" data-placement="top" title="{{ $encargado->tipoAsistente['nombre'] }}"><i class="fa fa-book" style="margin-right:15 px;"> </i></label> 
                                              @elseif($encargado->tipoAsistente['id']==4)
                                                <label class="label arrowed-right bg-orange" data-toggle="tooltip" data-placement="top" title="{{ $encargado->tipoAsistente['nombre'] }}"><i class="fa fa-star" style="margin-right:15 px;"> </i></label> 
                                              @endif
                                              {{ $encargado->nombre." ".$encargado->apellido }}
                                              <br>
                                            @endforeach  
                                          @else 
                                            Esta Linea no tiene ningun encargado. 
                                          @endif
                                        </div> 
                                      </a>
                                    </li><!-- end message -->
                                    @endforeach
                                  </ul>
                                </li>
                              </ul>
                            </li>
                          </div>                    
                            
                          <input name="linea_id" id="linea_id" type="text" class="form-control" placeholder="" style="position:relative; top:-34px; z-index:-1;" title="{{ Lang::get('grupos.ng_ph_linea') }}" value="@if(isset($grupo->encargados()->first()->linea->id)){{$grupo->encargados()->first()->linea->id}} @endif" />
                          <div id="linea-seleccionada">  
                            <div  id="ico-linea" class="col-xs-3 col-md-3 col-lg-3 bg-blue" style="min-height: 106px; box-shadow: 0 1px 1px rgba(0,0,0,0.1);">
                              <center><i class="fa fa-code-fork fa-4x" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></i></center>
                            </div>  
                            <div  id="info-linea" class="col-xs-9 col-md-9 col-lg-9 " style="min-height: 106px;box-shadow: 0 1px 1px 0 rgba(0,0,0,0.1);">
                              <h4><b>Línea </b>{{$linea->id}} - {{$linea->nombre}}</h4>
                              @if(isset($grupo->encargados()->first()->linea_id))
                                @if($grupo->encargados()->first()->linea->encargados()->count() > 0) 
                                  @foreach ($grupo->encargados()->first()->linea->encargados as $encargado)
                                    @if ($encargado->tipoAsistente['id']==5)
                                      <label class="label arrowed-right bg-purple" data-toggle="tooltip" data-placement="top" title="{{ $encargado->tipoAsistente['nombre'] }}"><i class="fa fa-book" style="margin-right:15 px;"> </i></label> 
                                    @elseif($encargado->tipoAsistente['id']==4)
                                      <label class="label arrowed-right bg-orange" data-toggle="tooltip" data-placement="top" title="{{ $encargado->tipoAsistente['nombre'] }}"><i class="fa fa-star" style="margin-right:15 px;"> </i></label> 
                                    @endif
                                    {{ $encargado->nombre." ".$encargado->apellido }}
                                    <br>
                                  @endforeach
                                @else
                                 Esta Linea no tiene ningun encargado. 
                                @endif
                              @endif
                              </p> 
                            </div> 
                           </div>
                        </div>
                        <!-- /fin Seleccion de la nueva linea  -->
                             
                        <!-- Seleccion de los nuevos encargados  -->
                        <div class="form-group row-fluid"  >
                          <br><br><br><br><br><hr>                      
                          <label>Seleccione los nuevos encargados:</label>  
                          
                          <div class="nav navbar-nav">
                            <li class="dropdown messages-menu">
                              <div class="input-group "  >
                                <input type="text" id="busqueda_encargado" class="form-control buscar" autocomplete="off" onfocus="focusInputEncargados()" placeholder="Buscar asistente por codigo, nombre o numero de identificación" onkeydown="doSearchEncargados(arguments[0]||event)" />
                                <span class="input-group-btn">
                                    <button type='button' name='seach' id='search-btn' class="btn btn-flat bg"><i class="fa fa-search"></i></button>
                                </span>
                              </div> 

                              <ul id="panel-ppl-encargados" class="panel-busqueda-moviles dropdown-menu " style="overflow: auto; width: 100%; max-height: 200px; position: relative; display:none;">
                                <li>
                                  <!-- inner menu: contains the actual data -->
                                  <ul class="menu" id="panel-encargados">
                                    @foreach($asistentes as $asistente)
                                    <li id="" class="" style="cursor:pointer"><!-- start message -->
                                      <a  class="seleccionar-encargado" data-nombre="{{$asistente->nombre}} {{$asistente->apellido}}" data-id="{{$asistente->id}}" data-foto="{{$asistente->foto}}" data-tipo-asistente="{{ $asistente->tipoAsistente->id}}">                                      
                                        <div class="col-lg-4  col-md-4 col-xs-4">
                                          <center><img src="/img/fotos/{{ $asistente->foto }}" class="img-circle" width="70px" alt="User Image"></center>          
                                        </div>  
                                        <div class="col-lg-8  col-md-8 col-xs-8">
                                          @if ($asistente->tipo_asistente_id==3)
                                               <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="{{ Lang::get('grupos.ng_lb_codigo_del') }} {{ $asistente->tipoAsistente['nombre'] }}" > {{ Lang::get('grupos.ng_lb_codigo') }} </label> {{ $asistente->id }} <br> 
                                               <label class="label arrowed-right bg-blue" data-toggle="tooltip" data-placement="top" title="{{ $asistente->tipoAsistente['nombre'] }}"> <i class="fa fa-child"></i></label>
                                          @elseif ($asistente->tipo_asistente_id==4)
                                               <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="{{ Lang::get('grupos.ng_lb_codigo_del') }} {{ $asistente->tipoAsistente['nombre'] }}" > {{ Lang::get('grupos.ng_lb_codigo') }} </label> {{ $asistente->id }} <br> 
                                               <label class="label arrowed-right label-warning" data-toggle="tooltip" data-placement="top" title="{{ $asistente->tipoAsistente['nombre'] }}"> <i class="fa fa-star-o"></i></label>
                                          @elseif ($asistente->tipo_asistente_id==5)
                                               <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="{{ Lang::get('grupos.ng_lb_codigo_del') }} {{ $asistente->tipoAsistente['nombre'] }}" > {{ Lang::get('grupos.ng_lb_codigo') }} </label> {{ $asistente->id }} <br> 
                                               <label class="label arrowed-right bg-purple" data-toggle="tooltip" data-placement="top" title="{{ $asistente->tipoAsistente['nombre'] }}"> <i class="fa fa-book"></i></label>
                                          @endif

                                          {{ $asistente->nombre }} {{ $asistente->apellido }} <br>
                                          <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title=" @if($asistente->tipo_identificacion != 0 && $asistente->tipo_identificacion != "") {{ Lang::choice( 'asistentes.na_tipo_id', $asistente->tipo_identificacion ) }}@endif " >@if($asistente->tipo_identificacion != 0 && $asistente->tipo_identificacion != "") {{ Lang::choice('asistentes.na_tipo_id_corta', $asistente->tipo_identificacion ) }} @endif</label>{{ $asistente->identificacion }}
                       
                                        </div> 
                                      </a>
                                    </li><!-- end message -->
                                    @endforeach
                                  </ul>
                                </li>
                              </ul>
                            </li>
                          </div>  
                          <input id="lideres_id" name="lideres_id" type="" class="form-control"  title="{{ Lang::get('grupos.ng_ph_lideres') }}" value="" />
                          <input id="lideres_eliminados" name="lideres_eliminados" type="" class="form-control"  title="{{ Lang::get('grupos.ng_ph_lideres') }}" value="" />
                          <input id="lideres_anadidos" name="lideres_anadidos" type="" class=" form-control"  title="{{ Lang::get('grupos.ng_ph_lideres') }}" value="" />
                   
                        </div >

                        <div id="panel-encargados-seleccionados" class="row-fluid">
                          <br><br>
                          @foreach ($grupo->encargados as $encargado)   
                          <div id="encargado-seleccionado-{{$encargado->id}}" class="col-xs-4 col-md-4 col-lg-4" style=" padding: 0px 8px; box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);">
                            <div class="box-body"> 
                              <div class="pull-right box-tools" style="margin-right:-11px">                    
                                <a id="quitar-encargado-{{$encargado->id}}" class="btn btn-danger btn-sm" data-id="{{$encargado->id}}"><i class="fa fa-times"></i></a>
                              </div>
                              <center><img style="margin-right: -15px;" src="/img/fotos/{{ $encargado->foto }}" class="img-circle" width="70px" alt="User Image"></center>  
                            </div><!-- /.box-body -->
                            <div class="box-footer text-black">
                               <center><p>
                                  @if ($encargado->tipoAsistente['id']==5)
                                    <label class="label arrowed-right bg-purple" data-toggle="tooltip" data-placement="top" title="{{ $encargado->tipoAsistente['nombre'] }}"><i class="fa fa-book" style="margin-right:15 px;"> </i></label> 
                                  @elseif($encargado->tipoAsistente['id']==4)
                                    <label class="label arrowed-right bg-orange" data-toggle="tooltip" data-placement="top" title="{{ $encargado->tipoAsistente['nombre'] }}"><i class="fa fa-star" style="margin-right:15 px;"> </i></label> 
                                  @endif
                                  {{ $encargado->nombre." ".$encargado->apellido }}
                               </p></center>
                            </div>
                          </div>  
                          @endforeach  
                            
                        </div>
                        <!-- /fin seleccion de los nuevos encargados  -->
                      @endif
                    @endif 
                    

                  </div>
                  <div class="panel-footer">
                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Aceptar </button>
                    <a href="/grupos" class="btn bg-btn btn-danger"> <i class="fa fa-undo"></i> Cancelar</a>  
                    </div> 
                </div>
              </form>
            </div>
            <!-- /columna formulario dado (baja/alta)-->

             <!-- Cuadro de informacion-->
              <div class="col-lg-5 col-md-6">
                @if($grupo->dado_baja == 0)
                  <div class="box">
                    <div class="panel-heading text-center bg-light-redil ">
                                     
                    </div>
                    <div class="panel-body text-center bg-light-redil ">
                      <i class="fa fa-hand-o-down fa-4x"></i>
                      <h2><b>Dar de baja</b></h2>  
                      <h4><b>Nombre del grupo: </b> {{$grupo->nombre}} </h4>  
                      <h4><b>Cantidad de asistentes: </b> {{$cantidad_asistentes}} </h4>                      
                      <h4><b>Encargado(s) del grupo: </b>  </h4>
                       @foreach($grupo->encargados as $encargado)
                           @if ($encargado->tipoAsistente['id']==5)
                              <label class="label arrowed-right bg-purple" data-toggle="tooltip" data-placement="top" title="{{ $encargado->tipoAsistente['nombre'] }}"><i class="fa fa-book" style="margin-right:15 px;"> </i></label> 
                          @elseif($encargado->tipoAsistente['id']==4)
                              <label class="label arrowed-right bg-orange" data-toggle="tooltip" data-placement="top" title="{{ $encargado->tipoAsistente['nombre'] }}"><i class="fa fa-star" style="margin-right:15 px;"> </i></label> 
                          @endif
                          {{ $encargado["nombre"] ." ".$encargado["apellido"] }}<br>
                       @endforeach 

                       @if(isset($grupo->encargados()->first()->linea->nombre))<h4><b>Linea: </b> {{$grupo->encargados()->first()->linea->nombre}} </h4>@endif 
                       @if($grupos_dependientes!=0)
                       <h4><b>De este grupo dependen </b> {{$grupos_dependientes}} <b> grupo(s)</b></h4>       
                       @endif              
                    </div>
                  </div>
                @else 
                  <div class="box">
                    <div class="panel-heading text-center bg-light-redil ">
                                        
                    </div>
                    <div class="panel-body text-center bg-light-redil ">                                    
                      <i class="fa fa-hand-o-up fa-4x"></i>
                      <h2><b>Dar de alta</b></h2>
                      <h4><b>Nombre del grupo: </b> {{$grupo->nombre}} </h4>    
                      @if($grupo->encargados()->count() > 0)                   
                        <h4><b>El grupo sera asignado a : </b>  </h4>
                         @foreach($grupo->encargados as $encargado)
                             @if ($encargado->tipoAsistente['id']==5)
                                <label class="label arrowed-right bg-purple" data-toggle="tooltip" data-placement="top" title="{{ $encargado->tipoAsistente['nombre'] }}"><i class="fa fa-book" style="margin-right:15 px;"> </i></label> 
                            @elseif($encargado->tipoAsistente['id']==4)
                                <label class="label arrowed-right bg-orange" data-toggle="tooltip" data-placement="top" title="{{ $encargado->tipoAsistente['nombre'] }}"><i class="fa fa-star" style="margin-right:15 px;"> </i></label> 
                            @endif
                            {{ $encargado["nombre"] ." ".$encargado["apellido"] }}<br>
                         @endforeach 

                         @if(isset($grupo->encargados()->first()->linea->nombre))<h4><b>Linea: </b> {{$grupo->encargados()->first()->linea->nombre}} </h4>@endif 
                         @if($grupos_dependientes!=0)
                         <h4><b>De este grupo dependen </b> {{$grupos_dependientes}} <b> grupo(s)</b></h4>       
                         @endif  
                      @else 
                        <p>El grupo no posee ningun encargado, por lo tanto será dado de alta como grupo sin encargados.  </p>                        
                      @endif
                    </div>
                  </div>
                @endif 
                <div class="box">
                  <div class="panel-heading text-center bg-light-redil ">
                                      
                  </div>
                  <div class="panel-body text-center bg-light-redil ">
                                  
                  <i class="fa fa-info fa-4x"></i>
                  <h2><b>Recuerda</b></h2>
                  <p> 
                    Es importante especificar el motivo por el cual el grupo sera dado de baja o dado de alta.   
                  </p>
                  </div>
                </div>
              </div>
              <!-- /Cuadro de informacion -->
          </div><!-- /row -->
        </section>
      <!-- contenido principal -->
      </aside>  
    </div>  


    
  @include('includes.scripts')
   <!-- DATA TABES SCRIPT -->
  <script src="{{ Lang::get('general.url-datatables') }}" type="text/javascript"></script>
  <script src="/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

  <!-- script de busqueda tìpo facebook -->
  <script src="/js/AdminLTE/busqueda-fc.js" type="text/javascript"></script>
        
  <script type="text/javascript">                  

          var nombre_class_grupo="grupo"
          ///este es el panel donde se cargaran los registros seleccioandos por el usuario
          var panel_grupo_seleccionado=$("#grupo-seleccionado"); 

          function seleccionar_grupo(){
            $('.seleccionar-'+nombre_class_grupo).unbind('click');///primero se eliminan todos los ateriores eventos click
            $('.seleccionar-'+nombre_class_grupo).click(function () {
              var idgrupo = $(this).attr("data-id");
              $("#grupo_id").val(idgrupo);
              construyeItemgrupo(idgrupo, panel_grupo_seleccionado, $("#grupo_id"), nombre_class_grupo);
            });
          } 


          function construyeItemgrupo(id, panel, input, nombre_cl){
            // solo añade el cargando si no existe ya uno en pantalla.
            if (!$('#grupo-seleccionado #item-cargando').length){
             panel_grupo_seleccionado.html('<div style="padding: 5px;" id="item-cargando" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><center><img class="img-responsive" src="/img/ajax-loader1.gif" /><center></div>'); 
            }
            ///el primer parametro es el ID el segundo el nombre de la class adicionales, el tercero cantidad de col para lg y md y el cuarto cantidad de col para sm y xs
            $.ajax({url:"/grupos/grupo-seleccionado/"+id+"/"+nombre_cl+"/12/12",cache:false, type:"POST",success:function(resp)
              {
                panel.html(resp);///si se quiere añadir un item en lugar de reemplazar se cambia por .append 
                
                $('.cerrar-'+nombre_cl+'-seleccionado').click(function () {
                  //alert("jeje");
                  $("#item-"+nombre_cl+"-"+id).remove();
                  input.val("");
                }); 
              }
            });
          }

          $(document).ready(function() {
            $("#menu_asistentes").children("a").first().trigger('click');
            sql_adicional="";
            //se crea un objeto de la Clase BusquedaFB y se cargan los primeros registros
            var busqueda_grupo = new BusquedaFB($("#busqueda_grupo"), $("#panel-ppl-grupos"), "panel-grupos", "/grupos/obtiene-grupos-para-busqueda-ajax/"+nombre_class_grupo+"/todos", seleccionar_grupo, sql_adicional);
            busqueda_grupo.cargarPrimerosRegistros();


            ///las sgtes grupos cargan los registros seleccionados
            /*@if(isset($reporte->asistentegrupo->id))
            construyeItemgrupo({{ $reporte->asistentegrupo->id }}, panel_grupo_seleccionado, $("#grupo_id"), nombre_class_grupo);
            @endif*/

            ///en caso de que el panel de resultados de la busqueda se necesite abrir con 
            ///un evento se colocan las siguientes grupos, en este caso con el evento focus del input de busqueda
            $("#busqueda_grupo").focus(function() {
              busqueda_grupo.muestraPanel($("html"));
            });
          });
        </script>
        <!--Finaliza Script del document ready para la busqueda de grupos-->

  <!-- page script -->
  <script type="text/javascript">
/*
    // ------ arreglo de lideres ---------------
    var lideres_id=new Array(); // array para guardar los  ID de los lideres del grupo;
    var lideres_eliminados=new Array();  // array para guardar los  ID de los lideres que van a ser eliminados;
    var lideres_anadidos=new Array(); // array para guardar los  ID de los lideres que van hacer añadidos;
    // ------ fin arreglo de lideres ------------


    var tiempoTrascurrido;
    var busqueda_linea=""; // variable que va a ser llena con lo que tenga el input llamado "busqueda_linea"

    var bandera_linea=0;
    var win=$("#panel-ppl-lineas");
    var alto=$("#panel-ppl-lineas").height();
    var cant_lineas_cargadas=10;
    var total_lineas=0;


    var busqueda_encargado=""; // variable que va a ser llena con lo que tenga el input llamado "busqueda_encargado"


    // Esta funcion llena una array con los id de los lideres enviados, y su respectivo input
    function inicializador () 
    {      
      @foreach ($grupo->encargados as $encargado)
        lideres_id.push("{{$encargado->id}}");  
        $("#lideres_id").val(lideres_id);
        quitarEncargado("{{$encargado->id}}");  
      @endforeach
    }

    function focusInputLineas() {
      $("#panel-ppl-lineas").fadeIn(200);
    }


    function doSearchLineas(ev){
      if(tiempoTrascurrido)
      {
        clearTimeout(tiempoTrascurrido);
      }        
      tiempoTrascurrido = setTimeout(buscarLinea,150);
      
    }

    function focusInputEncargados() {
      $("#panel-ppl-encargados").fadeIn(200);
    }


    function doSearchEncargados(ev){
      if(tiempoTrascurrido)
      {
        clearTimeout(tiempoTrascurrido);
      }        
      tiempoTrascurrido = setTimeout(buscarEncargado,150);
      
    }

    function seleccionar_linea(){
      ///este es el codigo es para seleccionar y mostrar de forma grafica la linea seleccionada.  
      $('.seleccionar-linea').click (function () 
      {                      
        var id = $(this).attr("data-id");
        var nombre = $(this).attr("data-nombre");
        $("#linea_id").val(id);

        $.ajax({url:"/lineas/linea-seleccionada/"+id,cache:false, type:"POST",success:function(resp)
          {
           
            $("#linea-seleccionada").html(resp); 
            $("#ico-linea").css("height", $("#info-linea").height());
          }
        });
      });
    }

     function seleccionar_encargado(){
      //este es el codigo es para seleccionar y mostrar de forma grafica la linea seleccionada.  

      $('.seleccionar-encargado').click (function () 
      {                      
        var id = $(this).attr("data-id");
        var nombre = $(this).attr("data-nombre");
        var foto = $(this).attr("data-foto");
        var tipo_asistente = $(this).attr("data-tipo-asistente");

        $.ajax({url:"/asistentes/asistente-seleccionado-ajax/"+id+"/encargado-seleccionado-/quitar-encargado",cache:false, type:"POST",success:function(resp)
          {
            alert("si entre homeee");
            $("#panel-encargados-seleccionados").append(resp);

            // funcion para quitar encargado
            quitarEncargado(id); 

          }
        });

        if(lideres_id.indexOf(id)!=-1)
        {
          var pos2=lideres_eliminados.indexOf($(this).attr('data-id')); // obtengo la posicion de arreglo segun el data-id
          lideres_eliminados.splice(pos2,1);
        }else
        {
          lideres_anadidos.push(id);
        }

        $("#lideres_eliminados").val(lideres_eliminados);
        $("#lideres_anadidos").val(lideres_anadidos);

     
      });
    }

    function quitarEncargado(id)
    {
       $('#quitar-encargado-'+id).click (function () 
        { 
          var id_encargado=$(this).attr("data-id");                     
          alert("encargado-seleccionado-"+id_encargado);
          $( "#encargado-seleccionado-"+id_encargado).remove();

          if(lideres_id.indexOf(id_encargado)!=-1)
          {
            

            lideres_eliminados.push(id_encargado);
          }
          else
          {
            var pos2=lideres_anadidos.indexOf($(this).attr('data-id')); // obtengo la posicion de arreglo segun el data-id
            
            alert("soy yo: "+lideres_anadidos.splice(pos2,1));
          }

          $("#lideres_eliminados").val(lideres_eliminados);
          $("#lideres_anadidos").val(lideres_anadidos); 
        }); 
    }

    function buscarEncargado()
    { 
      
      busqueda_encargado=$("#busqueda_encargado").val();
      alert(busqueda_encargado);
    }

    function buscarLinea()
    {
      busqueda_linea=$("#busqueda_linea").val();
      cant_lineas_cargadas=0;
      total_lineas=0;
      bandera_linea=0;       
      //////aqui añade el cargando
      $("#panel-lineas li").remove();
      $("#panel-lineas").append("<li id='cargando-notif'><center><img class='img-responsive' width='30px' src='/img/ajax-loader.gif' /><center></li>");
     
      if(busqueda_linea!="")
        var url="/lineas/obtiene-lineas-ajax/"+cant_lineas_cargadas+"/"+busqueda_linea;
      else
        var url="/lineas/obtiene-lineas-ajax/"+cant_lineas_cargadas;

      $.ajax({url:url, cache:false, type:"POST",success:function(resp)
        {
           //alert(resp);          
          $("#panel-lineas li").remove();
          $("#panel-lineas").append(resp);

          /////// icono cargando
          $("#panel-lineas #cargando-notif").remove();
          cant_lineas_cargadas=cant_lineas;  // cantidad_lineas es enviada desde el controlador.
          $("#panel-ppl-lineas").scrollTop(0);

          seleccionar_linea();
          
        }
      });
    }


    $(document).ready(function() 
    {  
      seleccionar_linea();
      seleccionar_encargado();
      inicializador ();


      // este codigo me ajusta el panel donde se encuentra el icono de seleccion de linea
      $("#ico-linea").css("height", $("#info-linea").height());

///////////////////////estos  eventos permiten que se cierre el panel de busqueda cuando se le de clic a cualquier elemento d ela web
      $('html').click(function () {
        $("#panel-ppl-lineas").fadeOut(100);
      });

      ////en caso de que se de clic en el input de busqueda o en el panel se anulara el evento de cerrar el panel
      $('#busqueda_linea').click(function (e) {
        e.stopPropagation();
      });

      $('html').click(function () {
        $("#panel-ppl-encargados").fadeOut(100);
      });

      ////en caso de que se de clic en el input de busqueda o en el panel se anulara el evento de cerrar el panel
      $('#busqueda_encargado').click(function (e) {
        e.stopPropagation();
      });
////////////////////////////aqui etrminan los tres eventos 


      $("#busqueda_linea").focusin(function() {
        setTimeout(function() {
          alto=$("#panel-lineas").height()-200;
          //alert(alto);
        }, 100);
        
      });       

      
      

      win.scroll(function () {

         //alert(win.scrollTop());
          if (win.scrollTop() > alto && bandera_linea==0) {
              bandera_linea=1;

              //////aqui añade el cargando
              $("#panel-lineas li:last").after("<li id='cargando-notif'><center><img class='img-responsive' width='30px' src='/img/ajax-loader.gif' /><center></li>");
              
             if(busqueda_linea!="")
                var url="/lineas/obtiene-lineas-ajax/"+cant_lineas_cargadas+"/"+busqueda_linea;
              else
                var url="/lineas/obtiene-lineas-ajax/"+cant_lineas_cargadas;

              $.ajax({url:url, cache:false, type:"POST",success:function(resp)
                {
                   
                  $("#panel-lineas li:last").after(resp);
                  /////// icono cargando
                  $("#panel-lineas #cargando-notif").remove();
                  alto=$("#panel-lineas").height()-200;
                  alto+=$("#panel-ppl-lineas").height();
                  cant_lineas_cargadas+=cant_lineas; // cantidad_lineas es enviada desde el controlador.

                  if(busqueda_linea!="")
                    var url_cant="/lineas/cantidad-lineas-ajax/"+busqueda_linea;
                  else
                    var url_cant="/lineas/cantidad-lineas-ajax";

                  $.ajax({url:url_cant, cache:false, type:"POST",success:function(resp)
                    {    
                     
                      total_lineas=resp;
                     
             
                      //////bandera se enciende siempre y cuando hayan mas registros por mostrar
                      ///$cant_lineas_cargadas me guarda la cantidad de notificaciones cargadas hasta el momento
                      if(cant_lineas_cargadas<total_lineas){
                        bandera_linea=0;
                      }
                          
                      seleccionar_linea();
                    }
                  });                   
                }
              });
          }
      });

      ///este es el codigo para modificar el grupo con los botones del modal
      $('.seleccionar').click (function () {
        var id_seleccionado = $(this).attr("id");
        var linea = $(this).attr("data-linea");
        var nombre = $(this).attr("data-nombre");
        var tbody="";

        $.ajax({url:"/asistentes/ajax/"+id_seleccionado,cache:false, type:"POST",success:function(resp)
          {
            tbody=resp;
            $("#tabla_encargados tbody").remove();
            $("#tabla_encargados").append(tbody);
          }
        });
        $("#grupo_id").val(id_seleccionado);
        $("#grupo").val(id_seleccionado+" - "+nombre);
        $("#linea").val(linea);   
        $('#modal_selecciona_grupo').modal('hide');
        $('#borrar').show();
        $("#seleccionar-grupo").hide();
      });

      $('#borrar').click (function () {
        $("#seleccionar-grupo").show();
        $(this).hide();
        $("#grupo_id").val("");
        $("#grupo").val("");
        $("#linea").val("");  
        var tbody="";
        $("#tabla_encargados tbody").remove();
        $("#tabla_encargados").append(tbody);

      });


      $('#tabla-grupos').dataTable( {
             
      });
      
    });*/
  </script>
  @endif
  </body>
</html>