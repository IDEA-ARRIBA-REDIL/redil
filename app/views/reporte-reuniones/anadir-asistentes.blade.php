@if(Auth::check())
@include('includes.lenguaje')
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Redil | Actualizar Reporte</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
         @include('includes.styles')
        <link href="/css/ionicons.min.css" rel="stylesheet" type="text/css" />
         <!-- DATA TABLES -->
        <link href="/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="/css/datepicker.css" rel="stylesheet" type="text/css" />
        <link href="/css/datepicker3.css" rel="stylesheet" type="text/css" />
         <!-- DATA TABLES -->
        <link href="/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap time Picker -->
        <link href="/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <!-- header logo: style can be found in header.less -->
        <!-- Header Navbar: style can be found in header.less -->
             @include('includes.header')

        <div id ="contenedor" name="contenedor" class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">                
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    @include('includes.menu')
                </section>
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
              
              <!-- contendio cabezote -->
              <section class="content-header">
                <div class="box-header">
                  <h3 class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-padding content-header barra-titulo">
                      <span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">ACTUALIZAR REPORTE DE REUNIÓN </span>
                      <small class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">Aqui se podrán actualizar los reportes de reuniones.</small>
                  </h3>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-padding pull-right box-tools">
                      <ul class="pull-right nav nav-pills">
                        <li role="presentation"><a href="/reporte-reuniones/actualizar/{{ $reporte->id }}"><small class="badge">1</small> Información Principal</a></li>
                        <li role="presentation" class="active"><a href="/reporte-reuniones/anadir-asistentes/{{ $reporte->id }}"><small class="badge">2</small> Añadir Asistentes</a></li>
                        <li role="presentation"><a href="/reporte-reuniones/anadir-ingresos/{{ $reporte->id }}"><small class="badge">3</small> Añadir Ingresos</a></li>
                      </ul>
                  </div>
                    
                    
                </div>
              </section>
              <!-- /contendio cabezote --> 

             <!-- contenido principal -->
              <section class="content">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <br>
                  <!-- cuadro todos -->
                  <div class="contador col-lg-2 col-md-2 col-sm-3 col-xs-6" data-toggle="tooltip" data-placement="top" title= "Muestra todos los asistentes que asistieron a la reunión">
                    <div class="small-box bg-yellow">
                      <div class="inner">
                        <h3 id="cantidad-todos">{{ (int)$reporte->asistentes()->count()+(int)$reporte->invitados }}</h3>
                        <p>
                            {{ ucwords(Lang::choice('asistentes.tipo_asistente', 0)) }}
                        </p>
                      </div>
                      <div class="icon">
                          <i class="fa fa-certificate"></i>
                      </div>
                      <a id="porcentaje-todos" class="small-box-footer">@if($cantidad_total_asistentes!=0){{ (int) ($reporte->asistentes()->count()/$cantidad_total_asistentes*100) }}% de la iglesia @else No hay asistentes registrados @endif
                      </a>
                    </div>
                  </div>
                  <!-- /cuadro todos -->
                  <div class="col-lg-10 no-padding">
                    <!-- cuadro nuevos -->
                    <div class="contador col-lg-2 col-md-2 col-sm-3 col-xs-6" data-toggle="tooltip" data-placement="top" title= "Muestra todos los asistentes tipo Nuevo que asistieron a la reunión">
                      <div class="small-box bg-teal">
                            <div class="inner">
                                <h3 id="cantidad-nuevos" >
                                  {{ $reporte->asistentes()->where('asistentes.tipo_asistente_id', '=', '1')->count() }}
                                </h3>
                                <p>
                                    {{ ucwords(Lang::choice('asistentes.tipo_asistente', 1)) }}
                                </p>
                            </div>
                        <div class="icon">
                          <i class="fa fa-heart"></i>
                        </div>
                          <a id="porcentaje-nuevos" class="small-box-footer">@if($cantidad_total_nuevos!=0) {{ (int) ($reporte->asistentes()->where('asistentes.tipo_asistente_id', '=', '1')->count()/$cantidad_total_nuevos*100) }}% de los nuevos @else No hay nuevos registradas @endif
                          </a>
                      </div>
                    </div>
                    <!-- /cuadro nuevos -->
                            
                    <!-- Cuadro ovejas -->
                    <div class="contador col-lg-2 col-md-2 col-sm-3 col-xs-6" data-toggle="tooltip" data-placement="top" title= "Muestra todos los asistentes tipo Oveja que asistieron a la reunión">
                      <div class="small-box bg-aqua">
                        <div class="inner">
                          <h3 id="cantidad-ovejas" >
                             {{ $reporte->asistentes()->where('asistentes.tipo_asistente_id', '=', '2')->count() }}
                          </h3>
                          <p>
                              {{ ucwords(Lang::choice('asistentes.tipo_asistente', 2)) }}
                          </p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-group"></i>
                        </div>
                        <a id="porcentaje-ovejas" class="small-box-footer">@if($cantidad_total_ovejas!=0) {{ (int) ($reporte->asistentes()->where('asistentes.tipo_asistente_id', '=', '2')->count()/$cantidad_total_ovejas*100) }}% de las ovejas @else No hay Ovejas registradas @endif
                        </a>
                      </div>
                    </div>
                    <!-- /cuadro ovejas -->
                            
                    <!-- cuadro miembros -->
                    <div class="contador col-lg-2 col-md-2 col-sm-3 col-xs-6" data-toggle="tooltip" data-placement="top" title= "Muestra todos los asistentes tipo Miembro que asistieron a la reunión">
                      <div class="small-box bg-blue">
                        <div class="inner">
                          <h3 id="cantidad-miembros" >
                            {{ $reporte->asistentes()->where('asistentes.tipo_asistente_id', '=', '3')->count() }}</h3>
                          <p>
                              {{ ucwords(Lang::choice('asistentes.tipo_asistente', 3)) }}
                          </p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-child"></i>
                        </div>
                        <a id="porcentaje-miembros" class="small-box-footer">@if($cantidad_total_miembros!=0) {{ (int) ($reporte->asistentes()->where('asistentes.tipo_asistente_id', '=', '3')->count()/$cantidad_total_miembros*100) }}% de los miembros @else No hay ningun Miembro Registrado @endif
                        </a>
                      </div>
                    </div>
                    <!-- /cuadro miembros-->
                            
                    <!-- cuadro lideres -->
                    <div class="contador col-lg-2 col-md-2 col-sm-3 col-xs-6" data-toggle="tooltip" data-placement="top" title= "Muestra todos los asistentes tipo Lider que asistieron a la reunión">
                      <div class="small-box bg-orange">
                        <div class="inner">
                        <h3 id="cantidad-lideres">
                          {{ $reporte->asistentes()->where('asistentes.tipo_asistente_id', '=', '4')->count() }}</h3>
                          <p>
                              {{ ucwords(Lang::choice('asistentes.tipo_asistente', 4)) }}
                          </p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-star"></i>
                        </div>
                        <a id="porcentaje-lideres" class="small-box-footer">@if($cantidad_total_lideres!=0) {{ (int) ($reporte->asistentes()->where('asistentes.tipo_asistente_id', '=', '4')->count()/$cantidad_total_lideres*100) }}% de los líderes @else No hay ningún Lider registrado @endif
                        </a>
                      </div>
                    </div> 
                    <!-- /cuadro lideres -->

                    <!-- cuadro pastores -->
                    <div class="contador col-lg-2 col-md-2 col-sm-3 col-xs-6" data-toggle="tooltip" data-placement="top" title= "Muestra todos los asistentes tipo Pastor que asistieron a la reunión">
                      <div class="small-box bg-purple">
                        <div class="inner">
                            <h3 id="cantidad-pastores" >
                              {{ $reporte->asistentes()->where('asistentes.tipo_asistente_id', '=', '5')->count() }}</h3>
                            <p>
                                {{ ucwords(Lang::choice('asistentes.tipo_asistente', 5)) }}
                            </p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-book fa-1x"></i>
                        </div>
                        <a id="porcentaje-pastores" class="small-box-footer">@if($cantidad_total_pastores) {{ (int) ($reporte->asistentes()->where('asistentes.tipo_asistente_id', '=', '5')->count()/$cantidad_total_pastores*100) }}% de los pastores @else No hay Pastores registrados @endif
                        </a>
                      </div>
                    </div>
                    <!-- /cuadro pastores -->

                    <!-- cuadro invitados -->
                    <div class="contador col-lg-2 col-md-2 col-sm-3 col-xs-6" data-toggle="tooltip" data-placement="top" title= "Muestra todos las personas que asistieron a la reunión pero que no estan registradas en el programa.">
                      <div class="small-box bg-redil">
                        <div class="inner">
                          <a id="del-invitado" class="badge pull-right bg-red"  style="width: 22px; height: 22px; font-size: 14px!important; font-weight: bold!important;font-family: 'Arial', 'Source Sans Pro', sans-serif!important;">-</a> 
                          <a id="add-invitado" class="badge pull-right bg-green" style="margin-right: 5px; width: 22px; height: 22px; font-size: 14px!important; font-weight: bold!important;font-family: 'Arial', 'Source Sans Pro', sans-serif!important;">+</a>
                          
                            <h3 id="cantidad-invitados">
                              {{ $reporte->invitados }}</h3>

                            <p>
                                Invitados
                            </p>
                        </div>
                        
                        <a id="porcentaje-invitados" class="small-box-footer">@if($cantidad_total_asistentes) {{ (int)((int)$reporte->invitados/($cantidad_total_asistentes)*100) }}% de la iglesia @else No hay asistentes registrados @endif
                        </a>
                      </div>
                    </div>
                    <!-- /cuadro invitados -->
                  </div>
                          
                </div>
                <!-- cierra el div row -->


              <!-- asistentereunion --> 
              <div class="box box-primary col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div id="contenido-asistentes" name="contenido-asistentes" class="nav navbar-nav text-center panel-ppl-busqueda" style="margin-bottom: 20px;">
                  <br>
                  <h1> 
                    <span class="badge bg-blue" >  
                      <i class="fa fa-user fa-4x"></i>
                    </span>
                  </h1>
                  <br>
                  <h4 style="margin-top:-20px">Seleccione los asistentes que asistieron a la reunión</h4>
                  <br>
                  <li class="dropdown messages-menu " style="margin:0 auto;float:none">
                    <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style="margin: 0 auto" >
                      <input type="text" id="busqueda_asistente_reunion" class="form-control buscar" autocomplete="off"  placeholder="Buscar asistente por código, nombre o cédula..."/>
                      <span class="input-group-btn">
                        <button type='button' class="btn btn-flat" style="border-color:#CCC;background:#fff" ><i class="fa fa-search" style="color:#00545E" ></i></button>
                      </span>
                    </div> 
                    <br> 
                    <br> 

                    <ul id="panel-ppl-asistentes-reunion" class="dropdown-menu " style="overflow: auto; width: 100%; position: relative;display:block" >
                      <li>
                          <!-- el siguiente es el panel que se llenara con los registros de la busqueda, se deja vacio -->
                        <ul class="menu" id="panel-asistentes" style="height: auto!important;">
                        </ul>
                      </li>
                    </ul>
                  </li>
                </div> 
              </div> 
            </section>
            <!-- contenido principal -->
          </aside>  

        </div>

         @include('includes.scripts') 

        <!-- busqueda tipo facebook -->
        <script src="/js/AdminLTE/busqueda-fc.js" type="text/javascript"></script>

        <!-- script para buscar los asistentes de un grupo -->
        <script type="text/javascript">
        //la siguiente variable "bandera_alterar_resultados_busqueda" es opcional 
        //y se enciende cuando un asistente es eliminado o añadido y al volver a abrir el panel de resulatdos de busqueda
        //necesito actualizarlo para que desaparazca o aparezca nuevamente como opcion para vovler a añadir
            var bandera_alterar_resultados_busqueda=0;
            ////la siguiente variable es pla que nos guardara el objeto de la busqueda tipo facebook
            var busqueda_asistente;

            var idreporte = "{{ $reporte->id }}";
            var porcentaje=0;
            var asistentes_total = parseInt("{{ $cantidad_total_asistentes }}");
            var nuevos_total = parseInt("{{ $cantidad_total_nuevos }}");
            var ovejas_total = parseInt("{{ $cantidad_total_ovejas }}");
            var miembros_total = parseInt("{{ $cantidad_total_miembros }}");
            var lideres_total = parseInt("{{ $cantidad_total_lideres }}");
            var pastores_total = parseInt("{{ $cantidad_total_pastores }}");

            cantidad_total=parseInt("{{ (int)$reporte->asistentes()->count()+(int)$reporte->invitados }}");
            cantidad_nuevos=parseInt("{{ $reporte->asistentes()->where('asistentes.tipo_asistente_id', '=', '1')->count() }}");
            cantidad_ovejas=parseInt("{{ $reporte->asistentes()->where('asistentes.tipo_asistente_id', '=', '2')->count() }}");
            cantidad_miembros=parseInt("{{ $reporte->asistentes()->where('asistentes.tipo_asistente_id', '=', '3')->count() }}");
            cantidad_lideres=parseInt("{{ $reporte->asistentes()->where('asistentes.tipo_asistente_id', '=', '4')->count() }}");
            cantidad_pastores=parseInt("{{ $reporte->asistentes()->where('asistentes.tipo_asistente_id', '=', '5')->count() }}");
            cantidad_invitados=parseInt("{{ $reporte->invitados }}");
            ///esta función nos permitira determinar que evento sucedera si se le da clic 
            //a un item de los resultados de la busqueda o a cualquier objeto denrto del item, como el boton cerrar
            function seleccionar_asistente(){
              $('.seleccionar-asistente').unbind('click');///primero se eliminan todos los ateriores eventos click
              $('.seleccionar-asistente').click(function () {
                var idasistente = $(this).attr("data-id");

                if($("#boton-"+idasistente).attr("estado")=="asistio"){

                  $.ajax({url:"/reporte-reuniones/elimina-asistentes-reunion-ajax/"+idreporte+"/"+idasistente,cache:false, type:"POST",success:function(resp)
                    {
                           $boton='<br><button  data-id="" data-nombre=""  class="seleccionar-linea btn btn-danger btn-sm">No Asistió <i class="fa fa-times"></i></button>';
                           $("#boton-"+idasistente).attr("estado","noasistio");
                           $("#boton-"+idasistente).html($boton); 

                          if($("#boton-"+idasistente).attr("tipo-asistente")=="1"){
                            cantidad_nuevos--;
                            $("#cantidad-nuevos").html(cantidad_nuevos); 
                            porcentaje=parseInt(cantidad_nuevos/nuevos_total*100);
                            $("#porcentaje-nuevos").html(porcentaje+"% de los nuevos");
                           }
                          else if($("#boton-"+idasistente).attr("tipo-asistente")=="2"){
                            cantidad_ovejas--;
                            $("#cantidad-ovejas").html(cantidad_ovejas); 
                             porcentaje=parseInt(cantidad_ovejas/ovejas_total*100);
                            $("#porcentaje-ovejas").html(porcentaje+"% de los ovejas");
                           }
                           else if($("#boton-"+idasistente).attr("tipo-asistente")=="3"){
                            cantidad_miembros--;
                            $("#cantidad-miembros").html(cantidad_miembros); 
                            porcentaje=parseInt(cantidad_miembros/miembros_total*100);
                            $("#porcentaje-miembros").html(porcentaje+"% de los miembros");
                           }
                           else if($("#boton-"+idasistente).attr("tipo-asistente")=="4"){
                            cantidad_lideres--;
                            $("#cantidad-lideres").html(cantidad_lideres); 
                            porcentaje=parseInt(cantidad_lideres/lideres_total*100);
                            $("#porcentaje-lideres").html(porcentaje+"% de los lideres");
                           }
                           else if($("#boton-"+idasistente).attr("tipo-asistente")=="5"){
                            cantidad_pastores--;
                            $("#cantidad-pastores").html(cantidad_pastores); 
                            porcentaje=parseInt(cantidad_pastores/pastores_total*100);
                            $("#porcentaje-pastores").html(porcentaje+"% de los pastores");
                           }

                          cantidad_total--;
                          $("#cantidad-todos").html(cantidad_total); 
                           porcentaje=parseInt(cantidad_total/asistentes_total*100);
                          $("#porcentaje-todos").html(porcentaje+"% de la iglesia");
                    }
                  });
                }
                else{

                  $.ajax({url:"/reporte-reuniones/registra-asistentes-reunion-ajax/"+idreporte+"/"+idasistente,cache:false, type:"POST",success:function(resp)
                    {  
                      //alert(resp);
                       $boton='<br><button  data-id="" data-nombre=""  class="seleccionar-linea btn btn-success btn-sm">Asistió <i class="fa fa-check"></i></button>';
                       $("#boton-"+idasistente).attr("estado","asistio");
                       $("#boton-"+idasistente).html($boton); 
                    
                      if($("#boton-"+idasistente).attr("tipo-asistente")=="1"){
                        cantidad_nuevos++;
                        $("#cantidad-nuevos").html(cantidad_nuevos); 
                        porcentaje=parseInt(cantidad_nuevos/nuevos_total*100);
                        $("#porcentaje-nuevos").html(porcentaje+"% de los nuevos");
                       }
                      else if($("#boton-"+idasistente).attr("tipo-asistente")=="2"){
                        cantidad_ovejas++;
                        $("#cantidad-ovejas").html(cantidad_ovejas); 
                         porcentaje=parseInt(cantidad_ovejas/ovejas_total*100);
                        $("#porcentaje-ovejas").html(porcentaje+"% de los ovejas");
                       }
                       else if($("#boton-"+idasistente).attr("tipo-asistente")=="3"){
                        cantidad_miembros++;
                        $("#cantidad-miembros").html(cantidad_miembros); 
                         porcentaje=parseInt(cantidad_miembros/miembros_total*100);
                        $("#porcentaje-miembros").html(porcentaje+"% de los miembros");
                       }
                       else if($("#boton-"+idasistente).attr("tipo-asistente")=="4"){
                        cantidad_lideres++;
                        $("#cantidad-lideres").html(cantidad_lideres); 
                        porcentaje=parseInt(cantidad_lideres/lideres_total*100);
                        $("#porcentaje-lideres").html(porcentaje+"% de los lideres");
                       }
                       else if($("#boton-"+idasistente).attr("tipo-asistente")=="5"){
                        cantidad_pastores++;
                        $("#cantidad-pastores").html(cantidad_pastores); 
                        porcentaje=parseInt(cantidad_pastores/pastores_total*100);
                        $("#porcentaje-pastores").html(porcentaje+"% de los pastores");
                       }

                      cantidad_total++;
                      $("#cantidad-todos").html(cantidad_total); 
                      porcentaje=parseInt(cantidad_total/asistentes_total*100);
                      $("#porcentaje-todos").html(porcentaje+"% de la iglesia");


                    }
                  });
                }
              }); 
            }

              

            $(document).ready(function() {
              var sql_adicional="" //si no hay sql adicional dejar la variable vacia
              

              //se crea un objeto de la Clase BusquedaFB y se cargan los primeros registros
              
              busqueda_asistente = new BusquedaFB($("#busqueda_asistente_reunion"), $(window), "panel-asistentes","/asistentes/obtener-asistentes-para-reportar-ajax/"+idreporte, seleccionar_asistente, sql_adicional);
              busqueda_asistente.cargarPrimerosRegistros();

              ///en caso de que el panel de resultados de la busqueda se necesite abrir con 
              ///un evento se colocan las siguientes lineas, en este caso con el evento focus del input de busqueda
              ////evento de añadir invitado
              
              $("#add-invitado").click(function(){
                  //alert("jajaja");
                    $.ajax({url:"/reporte-reuniones/ajax-add-invitado/{{ $reporte->id }}", cache:false, type:"POST",success:function(resp)
                    {
                      //$("#cantidad-invitados").html(resp);
                      cantidad_invitados++;
                      cantidad_total++;
                      $("#cantidad-invitados").html(cantidad_invitados);
                      porcentaje=parseInt(cantidad_invitados/asistentes_total*100);
                      $("#porcentaje-invitados").html(porcentaje+"% de la iglesia");

                      $("#cantidad-todos").html(cantidad_total);
                      porcentaje=parseInt(cantidad_total/asistentes_total*100);
                      $("#porcentaje-todos").html(porcentaje+"% de la iglesia");
                    }
                  });
                })

                ////evento de eliminar invitado
                $("#del-invitado").click(function(){
                  if(cantidad_invitados>0){
                    $.ajax({url:"/reporte-reuniones/ajax-del-invitado/{{ $reporte->id }}", cache:false, type:"POST",success:function(resp)
                      {
                        //$("#cantidad-invitados").html(resp);
                          cantidad_invitados--;
                          cantidad_total--;
                          $("#cantidad-invitados").html(cantidad_invitados);
                           porcentaje=parseInt(cantidad_invitados/asistentes_total*100);
                          $("#porcentaje-invitados").html(porcentaje+"% de la iglesia");

                          $("#cantidad-todos").html(cantidad_total);
                          porcentaje=parseInt(cantidad_total/asistentes_total*100);
                          $("#porcentaje-todos").html(porcentaje+"% de la iglesia");
                      }
                    });
                  }
                });
              
            });
            
        </script> 
        <!-- fin script busqueda de asistentes -->


            <!-- page script -->
        <script type="text/javascript">
         $(document).ready(function() {
            $("#menu_reuniones").children("a").first().trigger('click');
          });
        </script>

    </body>
</html>
@endif