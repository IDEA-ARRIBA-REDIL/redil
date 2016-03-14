@if(Auth::check())
@include('includes.lenguaje')
<?php include '../app/views/includes/terminos.php'; ?>
<!DOCTYPE html>
<html>
  <head>
      <meta charset="UTF-8">
      <title>{{Lang::get('reporte_grupos.texto_reporte_index_titulo_pagina')}} | {{Lang::get('reporte_grupos.texto_reporte_nombre_pagina')}}</title>
      <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
      @include('includes.styles')
      <!-- daterangepicker -->
      <link href="/css/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="/css/chosen/bootstrap-chosen.css">
      
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
      <!-- contendio cabezote -->
      <section class="content-header">
        <div class="box box-filtro" >
          <div class="box-header">
            <div class="pull-right box-tools" >
              <a href="../nuevo" class="btn btn-danger btn-md"> <i class="fa fa-plus"></i> {{Lang::get('reporte_grupos.texto_boton_nuevo_reporte')}}</a>
              <!--<button data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Imprimir"  onclick="window.print();" ><i class="fa fa-print"></i></button>-->
              <!--<button data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Enviar por Email"><i class="fa fa-envelope"></i></button> -->
              <!--<button data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Generar Archivo PDF"><i class="fa fa-file-pdf-o "></i></button> -->
             
            </div>
            <h3 class="content-header" style="font-size:24px">
              {{Lang::get('reporte_grupos.texto_titulo_header')}}
              <small>{{Lang::get('reporte_grupos.texto_subtitulo_header')}} </small></h3>
            </h3>  
          </div>
                  
          <div class="box-body">
          </div>
        </div>
      </section>
      <!-- /contendio cabezote -->
      
      <!-- contenido principal -->
      <section class="content">
        <!-- row de cuadro de colores -->
            <div class="row-fluid">
                <!-- cuadro todos -->
                <div class="col-lg-2 col-md-2 col-xs-4 col-sm-2 contador" data-toggle="tooltip" data-placement="top" title= "{{Lang::get('reporte_grupos.texto_place_holder_filtro_todos')}}">
                  <div class="small-box bg-yellow">
                    <div class="inner">
                      <h3>{{ $cantidad_todos }}</h3>
                      <p>
                        {{Lang::get('reporte_grupos.texto_filtro_todos')}}
                      </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-certificate"></i>
                    </div>
                    <a href="/reporte-grupos/lista/todos?buscar={{ $buscar }}&fecha-inicio={{ $fecha_inicio }}&fecha-fin={{ $fecha_fin }}&linea={{ $linea }}" class="small-box-footer">{{LAng::get('reporte_grupos.texto_ver_todos_los_filtros')}} <i class="fa fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div>
                <!-- /cuadro todos -->  

                <!-- cuadro reportes aprobados -->
                <div class="col-lg-2 col-md-2 col-xs-4 col-sm-2 contador" data-toggle="tooltip" data-placement="top" title= "{{Lang::get('reporte_grupos.texto_place_holder_filtro_aprobados')}}">
                  <div class="small-box bg-green">
                    <div class="inner">
                      <h3  >{{ $cantidad_aprobados }}</h3>
                      <p>
                        {{Lang::get('reporte_grupos.texto_filtro_aprobados')}}
                      </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-check-circle"></i>
                    </div>
                    <a href="/reporte-grupos/lista/aprobados?buscar={{ $buscar }}&fecha-inicio={{ $fecha_inicio }}&fecha-fin={{ $fecha_fin }}&linea={{ $linea }}" class="small-box-footer">{{Lang::get('reporte_grupos.texto_ver_todos_los_filtros')}} <i class="fa fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div>
                <!-- /cuadro reportes aprobados --> 

                <!-- cuadro reportes no aprobados -->
                <div class="col-lg-2 col-md-2 col-xs-4 col-sm-2 contador" data-toggle="tooltip" data-placement="top" title= "{{Lang::get('reporte_grupos.texto_place_holder_filtro_no_aprobados')}}">
                  <div class="small-box bg-red">
                    <div class="inner">
                      <h3 >{{ $cantidad_no_aprobados }}</h3>
                      <p>
                        {{Lang::get('reporte_grupos.texto_filtro_no_aprobados')}}
                      </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-exclamation-circle"></i>
                    </div>
                    <a href="/reporte-grupos/lista/no-aprobados?buscar={{ $buscar }}&fecha-inicio={{ $fecha_inicio }}&fecha-fin={{ $fecha_fin }}&linea={{ $linea }}" class="small-box-footer">{{Lang::get('reporte_grupos.texto_ver_todos_los_filtros')}} <i class="fa fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div>
                <!-- /cuadro reportes no aprobados --> 
            
            </div>
          <!-- row de cuadro de colores -->


        <!-- row de la tabla -->
        <div class="row">   
          <!-- div de 12 columnas -->                    
          <div class="col-xs-12">
            <div class="box box-primary">
              <div class="panel-body">
                <!-- tabla lista-->
                <div class="box-body table-responsive">
                  <!--<div class="collapse" id="busqueda-avanzada">
                    <div class="well">
                      Proximamente busqueda detallada ... 
                    </div>
                  </div> --> 
                  <!-- div de busqueda-->
                  <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                      @if(isset($buscar))
                          @if($buscar!="")
                              @if($cantidad_busqueda == 1)
                                 <h4>{{Lang::get('reporte_grupos.texto_resultados_la_busqueda_arrojo')}} <b>{{ $reportes->getTotal() }}</b> {{Lang::get('reporte_grupos.texto_termino_reporte_singular')}}. </h4>
                               @else
                                 <h4>{{Lang::get('reporte_grupos.texto_resultados_la_busqueda_arrojo')}}  <b>{{ $reportes->getTotal() }}</b> {{Lang::get('reporte_grupos.texto_termino_reporte_plural')}}. </h4>
                               @endif  
                          @endif
                      @endif
                    <form id="filtros" action="" method="get" role="form" class="form-inline">
                      <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 campo-filtro">
                        <div class="input-group">
                          <input type="text" id="buscar" name="buscar" class="form-control" value="{{ Input::get('buscar') }}" placeholder=" {{LAng::get('reporte_grupos.texto_placeholder_campo_busqueda')}}" >
                          <span class="input-group-btn">
                            @if(isset($buscar) && $buscar!="")
                            <button id="limpiar" class="btn btn-danger" ><i class="fa fa-times"></i></button>
                            
                            @endif 
                            <button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
                            <!--<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#busqueda-avanzada" aria-expanded="false" aria-controls="collapseExample">
                             Busqueda avanzada 
                           </button>-->
                          </span>
                        </div>
                      </div>
                      @if($tipo!="no-aprobados")
                      <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 campo-filtro">
                        <input id="fecha-filtro-inicio" name="fecha-inicio" type="hidden" />
                        <input id="fecha-filtro-fin" name="fecha-fin" type="hidden" />
                        <div id="reportrange" style="background: #fff; cursor: pointer; padding: 6px 10px; border: 1px solid #ccc;">
                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                            <span></span> <b class="caret"></b>
                        </div>
                      </div>
                      @endif
                      @if($lineas->count()>0)
                      <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 campo-filtro">
                        <select style="width:100%" id="linea" name="linea" class="chosen-select" data-placeholder="Filtro por línea" >
                            <option value="" @if(isset($linea)) @if($linea=="") selected @endif @endif >{{Lang::get('reporte_grupos.texto_filtro_todas_las_lineas')}}</option>
                            @foreach($lineas as $lin) <!-- Se le coloco lin porque linea ya era una variable que viene del controlador -->
                            <option value="{{ $lin->id }}" @if(isset($linea)) @if($linea==$lin->id) selected @endif @endif>{{ $lin->id." - ".$lin->nombre  }}</option>
                            @endforeach
                        </select>
                      </div>
                      @endif
                      
                    </form>
                  </div>
                  <!-- fin div de busqueda-->
                  
                  <!-- div vacio-->
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h4 class="descripcion-filtro">Listado de reporte de celulas <b>@if($tipo=="aprobados") aprobados @endif @if($tipo=="no-aprobados") no aprobados @endif </b> @if($linea!="" && $linea!=null) de la linea <b>{{ Linea::find($linea)->nombre }}</b> @endif @if($tipo!="no-aprobados") del <b>{{ Helper::fechaFormateada($fecha_inicio) }}</b> hasta el <b>{{ Helper::fechaFormateada($fecha_fin) }}</b> @endif</h4>
                  </div>
                   <!-- fin vacio-->
                   
                   <br><br>
                   <!-- div de paginacion-->
                  <div class="col-md-12  col-xs-12">
                      <h4 ALIGN=right> {{Lang::get('reporte_grupos.texto_simple_pagina')}}<b>{{ $reportes->getCurrentPage() }}</b> {{Lang::get('reporte_grupos.texto_simple_de')}} <b>{{ $reportes->getLastPage() }}</b>  </h4>                                           
                  </div>
                  <!-- fin de paginacion-->

                 
                                      
                  <table id="lista-reportes" class="table table-striped display " cellspacing="0" width="100%">
                    <thead>
                      <tr>
                      	<th>{{Lang::get('reporte_grupos.texto_tabla_listado_reporte_th_celda_1')}}</th>
                        <th>{{Lang::get('reporte_grupos.texto_tabla_listado_reporte_th_celda_2')}}</th>
                        <th>{{Lang::get('reporte_grupos.texto_tabla_listado_reporte_th_celda_3')}}</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach( $reportes as $reporte)
                      <tr>
                        <td>

                          <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="{{Lang::get('reporte_grupos.title_campo_fecha_reporte')}}"> <i class="fa fa-calendar"></i> </label>  {{ Helper::fechaFormateada($reporte->fecha)  }} <br> 
                          @if($reporte->aprobado == true)
                            <label class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="{{Lang::get('reporte_grupos.texto_title_estado_del_reporte')}}"> <i class="fa fa-check-circle"></i> Reporte aprobado</label>   <br> 
                          @elseif($reporte->aprobado == false)
                            <label class="label arrowed-right label-danger"  data-toggle="tooltip" data-placement="top" title="{{Lang::get('reporte_grupos.texto_title_estado_del_reporte')}}"> <i class="fa fa-exclamation-circle"></i> Reporte no aprobado</label>   <br> 
                          @endif
                          <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="{{Lang::get('reporte_grupos.texto_title_numero_reporte')}}">{{Lang::get('reporte_grupos.texto_campo_numero_reporte')}}</label> {{ $reporte->id }}<br>   
                          <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="{{Lang::get('reporte_grupos.texto_title_tema_reporte')}}"> <i class="fa fa-bookmark"></i> {{Lang::get('reporte_grupos.texto_campo_tema_reporte')}}</label>  {{ $reporte->tema }} <br>
                          <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="{{Lang::get('reporte_grupos.texto_title_finanzas_reporte')}}"> <i class="fa fa-money"></i>  {{Lang::get('reporte_grupos.texto_campo_finanzas_reporte')}}</label>  {{ $reporte->ofrendas()->sum('valor') }} <br>
                        </td>
                        <td>
                          <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="{{Lang::get('reporte_grupos.texto_title_codigo_grupo')}}"> <span class='capitalize'>{{Lang::get('reporte_grupos.texto_simple_grupo')}}</span></label>  <b> {{ $reporte->grupo['id']}} - </b> <span class="capitalize">{{$reporte->grupo['nombre'] }} </span><br>                     
                          <?php $grupo= Grupo::find($reporte->grupo['id']);?> 
                          @foreach($grupo->encargados as $encargado)   
                             @if ($encargado->tipoAsistente['id']==5)
                                <label class="label arrowed-right" style="background-color: purple;" data-toggle="tooltip" data-placement="top" title="{{ $encargado->tipoAsistente['nombre'] }}"> <i class="fa fa-book"></i> {{ $encargado->tipoAsistente['nombre'] }}</label> 
                             @elseif($encargado->tipoAsistente['id']==3)
                                 <label class="label arrowed-right bg-blue" data-toggle="tooltip" data-placement="top" title="{{ $encargado->tipoAsistente['nombre'] }}"><i class="fa fa-child"></i> {{ $encargado->tipoAsistente['nombre'] }}</label> 
                                     
                             @elseif($encargado->tipoAsistente['id']==4)
                                 <label class="label arrowed-right bg-orange" data-toggle="tooltip" data-placement="top" title="{{ $encargado->tipoAsistente['nombre'] }}"><i class="fa fa-star-o"></i> {{ $encargado->tipoAsistente['nombre'] }}</label> 
                             @elseif($encargado->tipoAsistente['id']==2)
                                 <label class="label arrowed-right bg-aqua" data-toggle="tooltip" data-placement="top" title="{{ $encargado->tipoAsistente['nombre'] }}"><i class="fa fa-group"></i> {{ $encargado->tipoAsistente['nombre'] }} </label> 

                             @elseif($encargado->tipoAsistente['id']==1)
                                 <label class="label arrowed-right bg-teal" data-toggle="tooltip" data-placement="top" title="{{ $encargado->tipoAsistente['nombre'] }}"><i class="fa fa-heart"></i> {{ $encargado->tipoAsistente['nombre'] }}</label> 
                             @endif 
                             <span class="capitalize"> <b> {{ $encargado['id'] }} - </b> {{$encargado['nombre'].' '.$encargado['apellido'] }}</span> <br>
                          @endforeach
                          @if(isset($grupo->linea()->nombre))<label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{Lang::get('reporte_grupos.texto_simple_campo_linea')}}"><span class='capitalize'>{{Lang::get('reporte_grupos.texto_simple_campo_linea')}}</span></label> {{ $grupo->linea()->nombre }} @endif
                        </td>
                        <td>
                          <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{Lang::get('reporte_grupos.texto_simple_campo_asistieron')}}">{{Lang::get('reporte_grupos.texto_simple_campo_asistieron')}}:</label> {{ $reporte->cantidadAsistentes() }} {{Lang::get('reporte_grupos.texto_simple_personas')}} <br>
                          <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Total Integrantes"><span class='capitalize'>{{Lang::get('reporte_grupos.texto_simple_total')}}:</span></label> 
                          {{ $grupo->integrantesALaFecha($reporte->fecha)->count() }} {{Lang::get('reporte_grupos.texto_simple_personas')}}
                        </td>                            
                        <td>
                          <div class="btn-group">
                            <button type="button" class="btn btn-success btn-info dropdown-toggle" data-toggle="dropdown">
                                {{Lang::get('reporte_grupos.texto_boton_opciones')}} 
                                <i class="fa fa-caret-down"> </i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="../perfil/{{$reporte->id}}">{{Lang::get('reporte_grupos.texto_opcion_1')}}</a></li>
                                @if($reporte->aprobado == true && Auth::user()->id==1)                               
                                  <li><a href="../actualizar/{{ $reporte->id }}">{{Lang::get('reporte_grupos.texto_opcion_2')}}</a></li>                                
                                @elseif($reporte->aprobado == false)
                                  <li><a href="../actualizar/{{ $reporte->id }}">{{Lang::get('reporte_grupos.texto_opcion_2')}}</a></li>
                                @endif
                                
                                @if($reporte->aprobado == false && Auth::user()->id==1) 
                                  <li><a id="aprobar_reporte_{{$reporte->id}}" href="#" onclick="return false;"  class="aprobar_reporte"  data-id="{{$reporte->id}}">{{Lang::get('reporte_grupos.texto_opcion_3')}}</a></li>
                                @endif

                                @if(Auth::user()->id==1)
                                <li><a href="#">{{Lang::get('reporte_grupos.texto_opcion_4')}}</a></li>
                                @endif
                            </ul>
                          </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /tabla -->
              </div> <!-- /panel body -->  
              <div class="box-footer">                                   
                <div class="row">                                        
                    <div class="col-lg-4">                                            
                      <h4> <b>{{ $reportes->getFrom() }}</b> - <b>{{ $reportes->getTo() }}</b> {{Lang::get('reporte_grupos.texto_simple_de')}} <b>{{ $reportes->getTotal() }} </b> {{Lang::get('reporte_grupos.texto_simple_registros')}}.</h4> 
                    </div>
                      <div class="col-lg-8 text-right" style="padding-right: 30px!important;"> {{ $reportes->appends(array('buscar' => $buscar, 'fecha-inicio' => $fecha_inicio, 'fecha-fin' => $fecha_fin, 'linea' => $linea))->links() }}</div>
                    
                </div>
              </div>          

            </div><!-- /Box primary -->

          </div><!-- /Div de 12 columnas -->
        </div><!-- /row -->
      </section>
      <!-- contenido principal -->
    </aside>  

    <!-- /modal mensaje para cuando se apruebe reporte -->
    <div id="msn_modal_aprobado_exito" class="modal modal-exito fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h3 class="titulo">{{Lang::get('reporte_grupos.texto_titulo_modal_reporte_aprobado')}} </h3 class="titulo">
            </div>
            <div class="modal-body">
                  <h4 id="msn_aprobado_exito" class="modal-title bg-danger" id="myModalLabel">{{Lang::get('reporte_grupos.texto_mensaje_modal_reporte_aprobado')}}  </h4>
      
            </div>
            <div class="modal-footer">
              <center><a id="btn_aprobado_exito" href="#" type="button" class="btn bg-light-redil" data-dismiss="modal">{{Lang::get('reporte_grupos.texto_boton_modal_aceptar')}}</a></center>
            </div>
        </div>
      </div>
    </div>
    <!-- /modal   -->
    
    @include('includes.scripts')
      
    <!-- plugins para filtros -->
    <script src="/js/plugins/moment/moment.js" type="text/javascript"></script>
    <script src="/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <script type="text/javascript" src="/js/plugins/chosen/chosen.js"></script>

    <!-- Script para los filtros -->
    <script type="text/javascript">
      $(function() {
        //select con buscador
        $('#linea').chosen({ allow_single_deselect: true });

        //esta bandera impide que entre en un bucle cuando se ejecuta la funcion cb(start, end)
        band=0;

        moment.locale('es');
          function cb(start, end) {
            $('#fecha-filtro-inicio').val(start.format('YYYY-MM-DD'));
            $('#fecha-filtro-fin').val(end.format('YYYY-MM-DD'));
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            if(band==1)
            $("#filtros").submit();
            band=1;
          }

          //comprobamos si existe la fecha incio y fecha fin y creamos las fechas con el formato aceptado
          @if(isset($fecha_inicio))
          var fecha_ini = moment('{{$fecha_inicio}}'); 
          fecha_ini.format("MM-DD-YYYY"); //2014-07-10
          @endif

          @if(isset($fecha_fin))
          var fecha_fin = moment('{{$fecha_fin}}'); 
          fecha_fin.format("MM-DD-YYYY"); //2014-07-10
          @endif

          @if(isset($fecha_inicio) && isset($fecha_fin))
          cb(fecha_ini, fecha_fin);
          @else
          cb(moment().startOf('month'), moment().endOf('month'));
          @endif

         

          $('#reportrange').daterangepicker({
              ranges: {
                 '{{Lang::get("general.texto_simple_hoy")}}': [moment(), moment()],
                 //'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                 '{{Lang::get("general.texto_simple_ultimos_7")}}': [moment().subtract(6, 'days'), moment()],
                 '{{Lang::get("general.texto_simple_ultimos_30")}}': [moment().subtract(29, 'days'), moment()],
                 '{{Lang::get("general.texto_simple_este_mes")}}': [moment().startOf('month'), moment().endOf('month')],
                 '{{Lang::get("general.texto_simple_mes_anterior")}}': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                 '{{Lang::get("general.texto_simple_este_año")}}': [moment().startOf('year'), moment().endOf('year')],
                 '{{Lang::get("general.texto_simple_año_anterior")}}': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
              },
              "locale": {
                "format": "MM/DD/YYYY",
                "separator": " - ",
                "applyLabel": "{{Lang::get('general.texto_simple_aplicar')}}",
                "cancelLabel": "{{Lang::get('general.texto_simple_cancelar')}}",
                "fromLabel": "{{Lang::get('general.texto_simple_desde')}}",
                "toLabel": "{{Lang::get('general.texto_simple_hasta')}}",
                "customRangeLabel": "{{Lang::get('general.texto_simple_otro_rango')}}",
                "monthNames": [
                    "{{Lang::get('general.texto_simple_mes_enero')}} ",
                    "{{Lang::get('general.texto_simple_mes_febrero')}} ",
                    "{{Lang::get('general.texto_simple_mes_marzo')}} ",
                    "{{Lang::get('general.texto_simple_mes_abril')}} ",
                    "{{Lang::get('general.texto_simple_mes_mayo')}} ",
                    "{{Lang::get('general.texto_simple_mes_junio')}} ",
                    "{{Lang::get('general.texto_simple_mes_julio')}} ",
                    "{{Lang::get('general.texto_simple_mes_agosto')}} ",
                    "{{Lang::get('general.texto_simple_mes_septiembre')}} ",
                    "{{Lang::get('general.texto_simple_mes_octubre')}} ",
                    "{{Lang::get('general.texto_simple_mes_noviembre')}} ",
                    "{{Lang::get('general.texto_simple_mes_diciembre')}} "
                ],
                "firstDay": 1
              },
              @if(isset($fecha_inicio))
              "startDate": fecha_ini,
              @endif
              @if(isset($fecha_fin))
              "endDate": fecha_fin,
              @endif
              showDropdowns: true
              
          }, cb);

         
          $("#linea").on('change', function(){
            $("#filtros").submit();
          });

          $("#limpiar").on('click', function(){
            $("#buscar").val("");
            $("#filtros").submit();
          });
      });
      </script>

    <!-- page script -->
    <script type="text/javascript">

      $(document).ready(function() {
        $("#menu_grupos").children("a").first().trigger('click');


        $('.aprobar_reporte').click (function () {                  
          var id = $(this).attr("data-id");
          $.ajax({url:"/reporte-grupos/aprueba-reporte-ajax/"+id,cache:false, type:"POST",success:function(resp)
            {
              if(resp=="aprobado")
                $('#msn_aprobado_exito').html('<h3>El reporte ha sido aprobado con éxito.</h3>');
              else
                $('#msn_aprobado_exito').html('<h3><b>¡Hubo un error!<b>El reporte no ha sido aprobado con éxito.</h3>');

              $('#msn_modal_aprobado_exito').modal('show'); 

              
            }
          }); 
        });


        $('#btn_aprobado_exito').click (function () {          
          location.reload();
        });

			});
    </script>
  </body>
</html>

@endif