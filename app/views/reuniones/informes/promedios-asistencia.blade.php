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
              <span class="mayusculas">{{ Lang::get('reuniones.informe_promedio_asistencia_titulo') }}</span><br>
              <small>{{ Lang::get('reuniones.informe_promedio_asistencia_descripcion') }} </small>
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
          <div class="col-xs-12">
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
                      @if(isset($buscar))
                          @if($buscar!="")
                              @if($reuniones->getTotal() == 1)
                                 <h4>{{Lang::get('reporte_grupos.texto_resultados_la_busqueda_arrojo')}} <b>{{ $reuniones->getTotal() }}</b> {{Lang::get('reporte_grupos.texto_termino_reporte_singular')}}. </h4>
                               @else
                                 <h4>{{Lang::get('reporte_grupos.texto_resultados_la_busqueda_arrojo')}}  <b>{{ $reuniones->getTotal() }}</b> {{Lang::get('reporte_grupos.texto_termino_reporte_plural')}}. </h4>
                               @endif  
                          @endif
                      @endif
                    <form id="filtros" action="" method="get" role="form" class="form-inline">
                      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 campo-filtro">
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
                      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 campo-filtro">
                        <div class="col-lg-6 col-md-7 col-sm-7 col-xs-7 no-padding" style="padding-right: 5px !important;">
                          <select id="rango" name="rango" class="form-control" style="width: 100%;">
                              <option value="1t" @if(isset($rango)) @if($rango=="1t") selected @endif @endif> 1er trimestre </option>
                              <option value="2t" @if(isset($rango)) @if($rango=="2t") selected @endif @endif> 2do trimestre </option>
                              <option value="3t" @if(isset($rango)) @if($rango=="3t") selected @endif @endif> 3er trimestre </option>
                              <option value="4t" @if(isset($rango)) @if($rango=="4t") selected @endif @endif> 4to trimestre </option>
                              <option value="1s" @if(isset($rango)) @if($rango=="1s") selected @endif @endif> 1er semestre </option>
                              <option value="2s" @if(isset($rango)) @if($rango=="2s") selected @endif @endif> 2do semestre </option>
                              <option value="anio" @if(isset($rango)) @if($rango=="anio") selected @endif @endif> Todo el año </option>
                          </select>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-3 col-xs-3 no-padding" style="padding-right: 5px !important;">
                          <input id="anio" name="anio" type="number" class="number form-control" value="{{ $anio }}"> 
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 no-padding" style="padding-right: 5px !important;">
                          <button class="btn btn-info" style="padding: 6px 10px;!important" type="submit">Ver</button>
                        </div>
                      </div>
                      @if($lineas->count()>0)
                      <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12 campo-filtro">
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
                  <div class="col-md-4">
                    
                  </div>
                   <!-- fin vacio-->
                   
                   <br><br>
                   <!-- div de paginacion-->
                  <div class="col-md-12  col-xs-12">
                      <h4 ALIGN=right> {{Lang::get('reporte_grupos.texto_simple_pagina')}}<b>{{ $reuniones->getCurrentPage() }}</b> {{Lang::get('reporte_grupos.texto_simple_de')}} <b>{{ $reuniones->getLastPage() }}</b>  </h4>                                           
                  </div>
                  <!-- fin de paginacion-->
                  <div class="table-responsive">     
                    <table id="tabla-promedios" class="table table-bordered " cellspacing="0" width="100%">
                      <thead style="background: #3C8DBC;color: #FFFFFF;">
                          <tr>
                            <th>{{ Lang::get('reuniones.ir_th_informacion_reunion') }}</th>
                            {{--*/ $meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");/*--}}
                            @for($i=$mes_inicio; $i<=$mes_fin; $i++)
                              <th style="border-left-width: 3px;text-align: center;" align="center">{{ $meses[$i-1] }}</th>
                            @endfor
                            <th style="border-left-width: 3px;text-align: center;" align="center">Promedio<br>Periodo</th>
                          </tr>
                      </thead>
                      <tbody>
                       @foreach($reuniones as $reunion)        
                          <tr>                                                    
                              <td>
                                <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title= " {{ Lang::get('reuniones.lg_ttl_codigo') }} "> {{ Lang::get('reuniones.texto_simple_cod') }} {{ $reunion->id }} </label> 
                                <a href="/reuniones/perfil/{{ $reunion->id }}"> {{ $reunion->nombre }}</a><br>

                              </td>
                              {{--*/ $mes_requerido=$fecha_inicio /*--}}
                              @for($i=$mes_inicio; $i<=$mes_fin; $i++)
                                @if(strtotime($mes_requerido) <= strtotime(Helper::finalMes(date("Y"), date("m"))))
                                  <td style="border-left-width: 3px;vertical-align: middle; background:#f3f4f5;" align="center"> {{ (int)$reunion->promedioAsistencia(date('Y-m-d', strtotime($mes_requerido)), Helper::finalMes(date("Y",strtotime($mes_requerido)), date("m",strtotime($mes_requerido))), $linea) }}</td>
                                @else
                                  <td style="border-left-width: 3px;vertical-align: middle; background:#f3f4f5;" align="center"> - </td>
                                @endif  
                                {{--*/ $mes_requerido=Helper::sumaMesesFecha($mes_requerido, '+1') /*--}}
                              @endfor
                             <td style="border-left-width: 3px;vertical-align: middle; background: #3C8DBC;color: #FFFFFF;" align="center"> {{ (int)$reunion->promedioAsistencia($fecha_inicio, $fecha_fin, $linea) }} </td>
                              
                              
                          </tr>
                          
                         @endforeach
                      </tbody>  
                    </table>
                  </div>
                </div>
                <!-- /tabla -->
              </div> <!-- /panel body -->  
              <div class="box-footer">                                   
                <div class="row">                                        
                    <div class="col-lg-4">                                            
                      <h4> <b>{{ $reuniones->getFrom() }}</b> - <b>{{ $reuniones->getTo() }}</b> {{Lang::get('reporte_grupos.texto_simple_de')}} <b>{{ $reuniones->getTotal() }} </b> {{Lang::get('reporte_grupos.texto_simple_registros')}}.</h4> 
                    </div>
                      <div class="col-lg-8 text-right" style="padding-right: 30px!important;"> {{ $reuniones->appends(array('buscar' => $buscar, 'rango' => $rango, 'orden' => $orden, 'ordenado-por' => $ordenado_por, 'anio' => $anio, 'linea' => $linea))->links() }}</div>
                    
                </div>
              </div>          

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
    <script type="text/javascript" src="/js/plugins/chosen/chosen.js"></script>
    <script type="text/javascript" src="/js/plugins/floatThead/jquery.floatThead.js"></script>

  
    <script type="text/javascript">
      $(function() {
        var $table = $('#tabla-promedios');
        if($table.width()<$(window).width())
        {
          $table.floatThead();
        }
        //alert("{{ $fecha_inicio }}");
        //alert("{{ $fecha_fin }}");
        //select con buscador
        $('#linea').chosen({ allow_single_deselect: true });
     
          $("#linea").on('change', function(){
            $("#filtros").submit();
          });

          $("#ordenado-por").on('change', function(){
            $("#filtros").submit();
          });

          $("#orden").on('change', function(){
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
        $("#menu_reuniones").children("a").first().trigger('click');
			});
    </script>
  </body>
</html>

@endif