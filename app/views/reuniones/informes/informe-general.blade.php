@if(Auth::check())
@include('includes.lenguaje')
<?php include '../app/views/includes/terminos.php'; ?>
<!DOCTYPE html>
<html>
  <head>
      <meta charset="UTF-8">
      <title>{{Lang::get('reporte_grupos.texto_reporte_index_titulo_pagina')}} | {{ Lang::get('reuniones.informe_promedio_asistencia_titulo') }}</title>
      <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
      @include('includes.styles')
      <!-- daterangepicker -->
      <link href="/css/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="/css/chosen/bootstrap-chosen.css">
      <!-- Morris charts -->
        <link href="/css/morris/morris.css" rel="stylesheet" type="text/css" />
      
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
            <h3 class="content-header barra-titulo">
              <span class="mayusculas"> {{ Lang::get('reuniones.informe_general_titulo') }} </span><br>
              <small> {{ Lang::get('reuniones.informe_general_descripcion') }} </small>
            </h3>  
          </div>
                  
          <div class="box-body">
          </div>
        </div>
      </section>
      <!-- /contendio cabezote -->
      
      <!-- contenido principal -->
      <section class="content">
        <!-- row de la tabla -->
        <div class="row">   
          <!-- div de 12 columnas -->                    
          <div class="col-lg-12 col-md- 12 col-sm-12 col-xs-12">
            <div class="box box-primary">
              <div class="panel-body">
                <!-- tabla lista-->
                <div class="box-body">
                  <!--<div class="collapse" id="busqueda-avanzada">
                    <div class="well">
                      Proximamente busqueda detallada ... 
                    </div>
                  </div> --> 
                  <!-- div de busqueda-->
                  <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    
                    <form id="filtros" action="" method="get" role="form" class="form-inline">
                      <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 campo-filtro">
                        <input id="fecha-filtro-inicio" name="fecha-inicio" type="hidden" />
                        <input id="fecha-filtro-fin" name="fecha-fin" type="hidden" />
                        <div id="reportrange" style="background: #fff; cursor: pointer; padding: 6px 10px; border: 1px solid #ccc;">
                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                            <span></span> <b class="caret"></b>
                        </div>
                      </div>
                      @if($reuniones->count()>0)
                      <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12 campo-filtro">
                        <select style="width:100%" id="reunion" name="reunion" class="chosen-select" data-placeholder="Filtro por línea" >
                            <option value="" @if(isset($reunion)) @if($reunion=="") selected @endif @endif >{{Lang::get('reuniones.texto_filtro_todas_las_reuniones')}}</option>
                            @foreach($reuniones as $reunion_aux) <!-- Se le coloco lin porque linea ya era una variable que viene del controlador -->
                            <option value="{{ $reunion_aux->id }}" @if(isset($reunion)) @if($reunion==$reunion_aux->id) selected @endif @endif>{{ $reunion_aux->id." - ".$reunion_aux->nombre  }}</option>
                            @endforeach
                        </select>
                      </div>
                      @endif
                      
                    </form>
                  </div>
                  <!-- fin div de busqueda-->
                   <!-- div de paginacion-->
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <h4 ALIGN=right>   </h4>                                           
                  </div>

                   @if($lineas->count()>1)
                  <!-- Estadistica de crecimiento  -->
                  <div class="panel col-lg-12 col-md-12 col-sm-12 col-xs-12">

                      <div class="box-header">
                          <h3 class="box-title"><span class="badge bg-red">  <i class="fa fa-bar-chart-o fa-2x"></i> </span> {{ Lang::get('reuniones.grafica_promedio_asistencia_linea') }} </h3>
                          <div class="pull-right box-tools">
                              <button class="btn btn-info btn-sm " data-toggle="tooltip" title="" data-original-title="Esta grafica muestra el crecimiento del grupo en los últimos 6 meses"><i class="fa fa-info"></i></button>  
                                                                    
                          </div>

                      </div>
                      <div class="box-body chart-responsive">
                          <div class="chart" id="asistencia-lineas" style="height: 200px;"></div>

                      </div><!-- /.box-body -->
                  </div><!-- /.box -->
                  <!-- /Estadistica de crecimiento  -->
                  @endif

                  <!-- Estadistica de crecimiento  -->
                  <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="panel">

                        <div class="box-header">
                            <h3 class="box-title"><span class="badge bg-aqua">  <i class="fa fa-bar-chart-o fa-2x"></i> </span> {{ Lang::get('reuniones.grafica_promedio_asistencia_tipo_asistente') }} </h3>
                            <div class="pull-right box-tools">
                                <button class="btn btn-info btn-sm " data-toggle="tooltip" title="" data-original-title="Esta grafica muestra el crecimiento del grupo en los últimos 6 meses"><i class="fa fa-info"></i></button>  
                                                                      
                            </div>

                        </div>
                        <div class="box-body chart-responsive">
                            <div class="chart" id="asistencia-tipo-asistentes" style="height: 200px;"></div>

                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                  </div>
                  <!-- /Estadistica de crecimiento  -->

                  <!-- Estadistica de crecimiento  -->
                  <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="panel">

                        <div class="box-header">
                            <h3 class="box-title"><span class="badge bg-green">  <i class="fa fa-bar-chart-o fa-2x"></i> </span> {{ Lang::get('reuniones.grafica_promedio_asistencia_reunion') }} </h3>
                            <div class="pull-right box-tools">
                                <button class="btn btn-info btn-sm " data-toggle="tooltip" title="" data-original-title="Esta grafica muestra el crecimiento del grupo en los últimos 6 meses"><i class="fa fa-info"></i></button>  
                                                                      
                            </div>

                        </div>
                        <div class="box-body chart-responsive">
                            <div class="chart" id="asistencia-reunion" style="height: 200px;"></div>

                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                  </div>
                  <!-- /Estadistica de crecimiento  -->

                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <div class="panel">
                        <div class="box-header">
                            <h3 class="box-title"><span class="badge bg-green">  <i class="fa fa-share-alt fa-2x"></i> </span> {{ Lang::get('reuniones.texto_10_primeros_grupos') }}</h3>
                            <div class="pull-right box-tools">
                                <button class="btn btn-info btn-sm " data-toggle="tooltip" title="" data-original-title="Esta grafica muestra el crecimiento del grupo en los últimos 6 meses"><i class="fa fa-info"></i></button>  
                                                                      
                            </div>

                        </div>
                        <!-- fin de paginacion-->
                        <div class="box-body table">     
                          <table id="tabla-promedios" class="table table-bordered " cellspacing="0" width="100%">
                            <thead style="background: #3C8DBC;color: #FFFFFF;">
                                <tr>
                                  <th>{{ Lang::get('grupos.ig_th_informacion_grupo') }}</th>
                                  <th style="border-left-width: 3px;text-align: center;" align="center">Promedio<br>Asistencia</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($grupos_primeros as $grupo)        
                                <tr>                                                    
                                    <td>
                                      <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title= " {{ Lang::get('grupos.lg_ttl_codigo') }} "> {{ Lang::get('grupos.lg_lb_codigo') }} {{ $grupo->id }} </label> 
                                      <a href="/grupos/perfil/{{ $grupo->id }}"> {{ $grupo->nombre }}</a><br>
                              
                                        @foreach($grupo->encargados as $encargado)
                                            @if ($encargado->tipoAsistente['id']==5)
                                                <label class="label arrowed-right bg-purple" data-toggle="tooltip" data-placement="top" title="{{ $encargado->tipoAsistente['nombre'] }}"><i class="fa fa-book" style="margin-right:15 px;"> </i></label> 
                                            @elseif($encargado->tipoAsistente['id']==4)
                                                <label class="label arrowed-right bg-orange" data-toggle="tooltip" data-placement="top" title="{{ $encargado->tipoAsistente['nombre'] }}"><i class="fa fa-star" style="margin-right:15 px;"> </i></label> 
                                            @endif
                                            {{ $encargado["nombre"] ." ".$encargado["apellido"] }}<br>
                                        @endforeach  

                                        <?php $linea_grupo=$grupo->linea(); ?>
                                        @if (isset($linea_grupo->nombre)) 
                                           <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="{{ Lang::get('grupos.lg_ttl_linea') }} "> {{ Lang::get('grupos.lg_lb_linea') }}</label> {{ $linea_grupo->nombre }} <br> 
                                        @endif

                                    </td>
                                   <td style="border-left-width: 3px;vertical-align: middle; background: #3C8DBC;color: #FFFFFF;" align="center"> {{ $grupo->promedio }} </td>
                                    
                                </tr>
                                
                              @endforeach
                            </tbody>  
                          </table>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <div class="panel">
                        <div class="box-header">
                            <h3 class="box-title"><span class="badge bg-green">  <i class="fa fa-share-alt fa-2x"></i> </span> {{ Lang::get('reuniones.texto_10_ultimos_grupos') }}</h3>
                            <div class="pull-right box-tools">
                                <button class="btn btn-info btn-sm " data-toggle="tooltip" title="" data-original-title="Esta grafica muestra el crecimiento del grupo en los últimos 6 meses"><i class="fa fa-info"></i></button>  
                                                                      
                            </div>

                        </div>
                        <!-- fin de paginacion-->
                        <div class="box-body table">     
                          <table id="tabla-promedios" class="table table-bordered " cellspacing="0" width="100%">
                            <thead style="background: #3C8DBC;color: #FFFFFF;">
                                <tr>
                                  <th>{{ Lang::get('grupos.ig_th_informacion_grupo') }}</th>
                                  <th style="border-left-width: 3px;text-align: center;" align="center">Promedio<br>Asistencia</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($grupos_ultimos as $grupo)        
                                <tr>                                                    
                                    <td>
                                      <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title= " {{ Lang::get('grupos.lg_ttl_codigo') }} "> {{ Lang::get('grupos.lg_lb_codigo') }} {{ $grupo->id }} </label> 
                                      <a href="/grupos/perfil/{{ $grupo->id }}"> {{ $grupo->nombre }}</a><br>
                              
                                        @foreach($grupo->encargados as $encargado)
                                            @if ($encargado->tipoAsistente['id']==5)
                                                <label class="label arrowed-right bg-purple" data-toggle="tooltip" data-placement="top" title="{{ $encargado->tipoAsistente['nombre'] }}"><i class="fa fa-book" style="margin-right:15 px;"> </i></label> 
                                            @elseif($encargado->tipoAsistente['id']==4)
                                                <label class="label arrowed-right bg-orange" data-toggle="tooltip" data-placement="top" title="{{ $encargado->tipoAsistente['nombre'] }}"><i class="fa fa-star" style="margin-right:15 px;"> </i></label> 
                                            @endif
                                            {{ $encargado["nombre"] ." ".$encargado["apellido"] }}<br>
                                        @endforeach  

                                        <?php $linea_grupo=$grupo->linea(); ?>
                                        @if (isset($linea_grupo->nombre)) 
                                           <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="{{ Lang::get('grupos.lg_ttl_linea') }} "> {{ Lang::get('grupos.lg_lb_linea') }}</label> {{ $linea_grupo->nombre }} <br> 
                                        @endif

                                    </td>
                                   <td style="border-left-width: 3px;vertical-align: middle; background: #3C8DBC;color: #FFFFFF;" align="center"> {{ $grupo->promedio }} </td>
                                    
                                </tr>
                                
                              @endforeach
                            </tbody>  
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <div class="panel">
                        <div class="box-header">
                            <h3 class="box-title"><span class="badge bg-blue">  <i class="fa fa-user fa-2x"></i> </span> {{ Lang::get('reuniones.texto_10_primeros_asistentes') }}</h3>
                            <div class="pull-right box-tools">
                                <button class="btn btn-info btn-sm " data-toggle="tooltip" title="" data-original-title="Esta grafica muestra el crecimiento del grupo en los últimos 6 meses"><i class="fa fa-info"></i></button>  
                                                                      
                            </div>

                        </div>
                        <!-- fin de paginacion-->
                        <div class="box-body table">     
                          <table id="tabla-promedios" class="table table-bordered " cellspacing="0" width="100%">
                            <thead style="background: #3C8DBC;color: #FFFFFF;">
                                <tr>
                                  <th>{{ Lang::get('reuniones.ir_th_informacion_asistente') }}</th>
                                  <th style="border-left-width: 3px;text-align: center;" align="center">Cantidad<br>Asistencias</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($asistentes_primeros as $asistente)        
                                <tr>                                                    
                                    <td>
                                      <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title= " {{ Lang::get('grupos.lg_ttl_codigo') }} "> {{ Lang::get('grupos.lg_lb_codigo') }} {{ $asistente->id }} </label> 
                                      <a href="/grupos/perfil/{{ $asistente->id }}"> {{ $asistente->nombre }}</a><br>
                                    </td>
                                   <td style="border-left-width: 3px;vertical-align: middle; background: #3C8DBC;color: #FFFFFF;" align="center"> {{ $asistente->asistencias }} </td>
                                    
                                </tr>
                                
                              @endforeach
                            </tbody>  
                          </table>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <div class="panel">
                        <div class="box-header">
                            <h3 class="box-title"><span class="badge bg-blue">  <i class="fa fa-user fa-2x"></i> </span> {{ Lang::get('reuniones.texto_10_ultimos_asistentes') }}</h3>
                            <div class="pull-right box-tools">
                                <button class="btn btn-info btn-sm " data-toggle="tooltip" title="" data-original-title="Esta grafica muestra el crecimiento del grupo en los últimos 6 meses"><i class="fa fa-info"></i></button>  
                                                                      
                            </div>

                        </div>
                        <!-- fin de paginacion-->
                        <div class="box-body table">     
                          <table id="tabla-promedios" class="table table-bordered " cellspacing="0" width="100%">
                            <thead style="background: #3C8DBC;color: #FFFFFF;">
                                <tr>
                                  <th>{{ Lang::get('reuniones.ir_th_informacion_asistente') }}</th>
                                  <th style="border-left-width: 3px;text-align: center;" align="center">Cantidad<br>Asistencias</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($asistentes_ultimos as $asistente)        
                                <tr>                                                    
                                    <td>
                                      <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title= " {{ Lang::get('grupos.lg_ttl_codigo') }} "> {{ Lang::get('grupos.lg_lb_codigo') }} {{ $asistente->id }} </label> 
                                      <a href="/grupos/perfil/{{ $asistente->id }}"> {{ $asistente->nombre }}</a><br>
                                    </td>
                                   <td style="border-left-width: 3px;vertical-align: middle; background: #3C8DBC;color: #FFFFFF;" align="center"> {{ $asistente->asistencias }} </td>
                                    
                                </tr>
                                
                              @endforeach
                            </tbody>  
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
                <!-- /tabla -->
              </div> <!-- /panel body -->  
                       

            </div><!-- /Box primary -->

          </div><!-- /Div de 12 columnas -->
        </div><!-- /row -->
      </section>
      <!-- contenido principal -->
    </aside>  
  </div>
    
    @include('includes.scripts')
      
    <!-- plugins para filtros -->
    <script src="/js/plugins/moment/moment.js" type="text/javascript"></script>
  <script src="/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <script type="text/javascript" src="/js/plugins/chosen/chosen.js"></script>
    
     <!-- Morris.js charts -->
        <script src="/js/raphael-min.js"></script>
        <script src="/js/plugins/morris/morris.min.js" type="text/javascript"></script>

  
    <script type="text/javascript">
      $(function() {
        //alert("{{ $fecha_inicio }}");
        //alert("{{ $fecha_fin }}");
        //select con buscador
        $('#reunion').chosen({ allow_single_deselect: true });

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
                 'Hoy': [moment(), moment()],
                 //'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                 'Ultimos 7 Dias': [moment().subtract(6, 'days'), moment()],
                 'Untimos 30 Dias': [moment().subtract(29, 'days'), moment()],
                 'Este mes': [moment().startOf('month'), moment().endOf('month')],
                 'Mes anterior': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                 'Este año': [moment().startOf('year'), moment().endOf('year')],
                 'Año anterior': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
              },
              "locale": {
                "format": "MM/DD/YYYY",
                "separator": " - ",
                "applyLabel": "Aplicar",
                "cancelLabel": "Cancelar",
                "fromLabel": "Desde",
                "toLabel": "Hasta",
                "customRangeLabel": "Otro Rango",
                "monthNames": [
                    "Enero ",
                    "Febrero",
                    "Marzo",
                    "Abril",
                    "Mayo",
                    "Junio",
                    "Julio",
                    "Agosto",
                    "Septiembre",
                    "Octubre",
                    "Noviembre",
                    "Diciembre"
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
     
          $("#reunion").on('change', function(){
            $("#filtros").submit();
          });

          $("#limpiar").on('click', function(){
            $("#buscar").val("");
            $("#filtros").submit();
          });
      });
      </script>

      <!-- Script para graficas -->
      <script type="text/javascript">
      $(document).ready(function(){
        //Grafica comparativa de asistencia a cultos
        @if($lineas->count()>1)
        var grafica_lineas = new Morris.Bar({
            element: 'asistencia-lineas',
            resize: true,
            data: [
            @foreach($lineas as $linea)
              @if($reunion!="")
              <?php $reunion_aux=Reunion::find($reunion);?>
                {y: "{{$linea->nombre}}", a: {{ round($reunion_aux->promedioAsistencia($fecha_inicio, $fecha_fin, $linea->id)) }} },
              @else
                {y: "{{$linea->nombre}}", a: {{ round(Reunion::promedioAsistenciaTotal($fecha_inicio, $fecha_fin, $linea->id)) }} },
              @endif
            @endforeach   
            ],
            barColors: ['#f4543c'],
            xkey: 'y',
            ykeys: ['a'],
            labels: ['Personas'],
            xLabelAngle: 35,
            hideHover: 'false'
        });
        @endif

        var grafica_tipo_asistente = new Morris.Bar({
            element: 'asistencia-tipo-asistentes',
            resize: true,
            data: [
            @foreach($tipos_asistente as $tipo_asistente)
              @if($reunion!="")
              <?php $reunion_aux=Reunion::find($reunion);?>
                {y: "{{$tipo_asistente->nombre}}", a: {{ round($reunion_aux->promedioAsistencia($fecha_inicio, $fecha_fin, "", $tipo_asistente->id)) }} },
              @else
                {y: "{{$tipo_asistente->nombre}}", a: {{ round(Reunion::promedioAsistenciaTotal($fecha_inicio, $fecha_fin, "", $tipo_asistente->id)) }} },
              @endif
            @endforeach   
            ],
            barColors: ['#00C0EF'],
            xkey: 'y',
            ykeys: ['a'],
            labels: ['Personas'],
            xLabelAngle: 35,
            hideHover: 'false'
        });

        var grafica_reunion = new Morris.Bar({
            element: 'asistencia-reunion',
            resize: true,
            data: [
            @foreach($reuniones as $reunion_aux)
                {y: "{{$reunion_aux->nombre}}", a: {{ round($reunion_aux->promedioAsistencia($fecha_inicio, $fecha_fin)) }} },
            @endforeach   
            ],
            barColors: ['#00a65a'],
            xkey: 'y',
            ykeys: ['a'],
            labels: ['Personas'],
            xLabelAngle: 35,
            hideHover: 'false'
        });

      });
      </script>

    <!-- page script -->
    <script type="text/javascript">

      $(document).ready(function() {
        $("#menu_reuniones").children("a").first().trigger('click');
			});
    </script>
  </body>
</html>

@endif