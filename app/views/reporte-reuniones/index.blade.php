@if(Auth::check())
@include('includes.lenguaje')
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{{Lang::get('general.texto_encabezado_pagina')}} |  {{Lang::get('reporte_reuniones.texto_simple_pestana')}} </title>
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
         @include('includes.header')
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">                
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">                   
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    @include('includes.menu')
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- contendio cabezote -->
                <section class="content-header">   
                    <div class="box" style="background-color:transparent; border:none; box-shadow:none; margin-left:-5px; margin-bottom:-40px; ">
                        <div class="box-header">
                            <div class="pull-right box-tools" >
                                @if(Auth::user()->id==1)<a href="../nuevo" class="btn btn-danger btn-md"> <i class="fa fa-plus"></i> Nuevo Reporte </a>@endif
                                <button data-toggle="tooltip" title="" class="btn btn-info" data-original-title=" {{ Lang::get('general.dot_imprimir') }} "  onclick="window.print();" ><i class="fa fa-print"></i></button>
                                <a href="#"  data-toggle="tooltip" title="" class="btn btn-info" data-original-title=" {{ Lang::get('general.dot_pdf') }} "><i class="fa fa-file-pdf-o "></i></a>
                            </div>  
                            <h3 class="content-header" style="font-size:24px">
                                 <span class="mayusculas">{{Lang::get('reporte_reuniones.texto_simple_titulo_pagina')}}</span>
                                <small> {{Lang::get('reporte_reuniones.texto_simple_subtitulo_pagina')}} </small>
                            </h3>
                        </div>
                    </div>
                </section>
                <!-- /contendio cabezote --> 
                <br>
                <!-- contenido principal -->
                <section class="content">
                    <!-- row de la tabla -->
                    <div class="row"> 
                        <div class="col-lg-12">  
                            <div class="box box-primary"> 
                                <div class="panel-body">
                                    <!-- tabla -->
                                    <div class="box-body table-responsive">
                                        <!--<div class="collapse" id="busqueda-avanzada">
                                          <div class="well">
                                            Proximamente busqueda detallada ... 
                                          </div>
                                        </div>   -->
                                        <!-- div de busqueda-->
                                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                            @if(isset($buscar))
                                                @if($buscar!="")
                                                    @if($cantidad_busqueda == 1)
                                                       <h4>{{Lang::get('reporte_reuniones.texto_simple_mensaje_busqueda')}} <b>{{ $cantidad_busqueda }}</b> {{Lang::get('reporte_reuniones.texto_simple_culto')}}. </h4>
                                                     @else
                                                       <h4>{{Lang::get('reporte_reuniones.texto_simple_mensaje_busqueda')}} <b>{{ $cantidad_busqueda }}</b> {{Lang::get('reporte_reuniones.texto_simple_cultos')}}. </h4>
                                                     @endif  
                                                @endif
                                            @endif
                                            <form id="filtros" action="" method="get" role="form" class="form-inline">
                                              <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 campo-filtro">
                                                <div class="input-group">
                                                  <input type="text" id="buscar" name="buscar" class="form-control" value="{{ Input::get('buscar') }}" placeholder=" Busque aqui ..." >
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
                                              <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 campo-filtro">
                                                <input id="fecha-filtro-inicio" name="fecha-inicio" type="hidden" />
                                                <input id="fecha-filtro-fin" name="fecha-fin" type="hidden" />
                                                <div id="reportrange" style="background: #fff; cursor: pointer; padding: 6px 10px; border: 1px solid #ccc;">
                                                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                                    <span></span> <b class="caret"></b>
                                                </div>
                                              </div>
                                              
                                              <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 campo-filtro">
                                                <select style="width:100%" id="reunion" name="reunion" class="chosen-select" data-placeholder="Filtro por línea" >
                                                    <option value="" @if(isset($reunion)) @if($reunion=="") selected @endif @endif >{{Lang::get('reporte_reuniones.texto_simple_filtro_todos')}}</option>
                                                    @foreach($reuniones as $reun) <!-- Se le coloco reun porque reunion ya era una variable que viene del controlador -->
                                                    <option value="{{ $reun->id }}" @if(isset($reunion)) @if($reunion==$reun->id) selected @endif @endif>{{ $reun->id." - ".$reun->nombre  }} - @if($reun->dia != 0 && $reun->dia !="" ){{ Lang::choice('general.dias', $reun->dia) }} @endif</option>
                                                    @endforeach
                                                </select>
                                              </div>
                                              
                                              
                                            </form>
                                        <!-- fin div de busqueda-->
                                        
                                        <!-- div vacio-->
                                        <div class="col-md-4">
                                          
                                        </div>
                                         <!-- fin vacio-->
                                         
                                         <br><br>
                                         <!-- div de paginacion-->
                                        <div class="col-md-12  col-xs-12">
                                            <h4 ALIGN=right> {{Lang::get('general.texto_simple_pagina')}}<b>{{ $reporte_reuniones->getCurrentPage() }}</b> de <b>{{ $reporte_reuniones->getLastPage() }}</b>  </h4>                                           
                                        </div>
                                        <!-- fin de paginacion-->
                                        <table id="example1" class="table table-striped display " cellspacing="0" width="100%">
                                            <thead>
                                                <tr>  
                                                  <th>{{Lang::get('reporte_reuniones.texto_tabla_reportes_col1')}}</th>
                                                    <th>{{Lang::get('reporte_reuniones.texto_tabla_reportes_col2')}}</th>
                                                    <th>{{Lang::get('reporte_reuniones.texto_tabla_reportes_col3')}}</th>                                                                                                    
                                                    <th></th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                             @foreach($reporte_reuniones as $reporte)     
                                                <tr>                                                    
                                                    <td style="width:25%">
                                                      <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title= " Código "> {{Lang::get('general.texto_simple_cod')}} </label> {{ $reporte->id }}<br>
                                                        <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title= " Nombre "> <i class="fa fa-home"> </i> {{Lang::get('general.texto_simple_nombre')}} </label> {{ $reporte->reunion->nombre }} <br>       
                                                        <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Fecha"> <i class="fa fa-calendar"></i> {{Lang::get('general.texto_simple_fecha')}}</label> {{ Helper::fechaFormateada($reporte->fecha) }}<br>                                                                    
                                                    </td>

                                                    <td style="width:45%">
                                                        @if(isset($reporte->predicador_invitado) && ($reporte->predicador_invitado!=""))
                                                        <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title= " Hora "><i class="fa fa-male"></i> </label>{{Lang::get('reporte_reuniones.texto_simple_predicador_principal')}} <span class="capitalize">{{ $reporte->predicador_invitado }} </span> {{Lang::get('reporte_reuniones.texto_simple_predicador_invitado')}}<br> 
                                                        @else
                                                         <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title= " Hora "><i class="fa fa-user"></i> {{Lang::get('reporte_reuniones.texto_simple_predicador_principal')}}</label> <span class="capitalize">{{ $reporte->asistentePredicador['nombre'] }} {{ $reporte->asistentePredicador['apellido'] }} </span><br> 
                                                        @endif 
                                                        @if(isset($reporte->predicador_diezmos_invitado) && ($reporte->predicador_diezmos_invitado!=""))
                                                        <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title= " Día "><i class="fa fa-male"></i> {{Lang::get('reporte_reuniones.texto_simple_predicador_diezmos')}}</label> <span class="capitalize">{{ $reporte->predicador_diezmos_invitado }} </span> {{Lang::get('reporte_reuniones.texto_simple_predicador_invitado')}}<br>   
                                                        @else
                                                        <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title= " Día "><i class="fa fa-user"></i> {{Lang::get('reporte_reuniones.texto_simple_predicador_diezmos')}}</label> <span class="capitalize">{{ $reporte->asistentePredicadorDiezmos['nombre'] }} {{ $reporte->asistentePredicadorDiezmos['apellido'] }} </span><br>   
                                                        @endif
                                                    </td>
                                                    
                                                    <td style="width:30%">

                                                        <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title= " Lugar "><i class="fa fa-users"> </i> {{Lang::get('reporte_reuniones.texto_simple_total_asistentes')}}</label> {{ $reporte->cantAsistentesTotal($reporte->id) }} {{Lang::get('general.texto_simple_personas')}} <br> 
                                                        @if(Auth::user()->id!=1)
                                                        <?php
                                                        $grupos_ids=Auth::user()->asistente->gruposMinisterio('array');
                                                        $cant_asistentes=$reporte->asistentes()->whereIn('grupo_id', $grupos_ids)->count();
                                                        ?>
                                                        <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title= " Lugar "><i class="fa fa-users"> </i> {{Lang::get('reporte_reuniones.texto_simple_asistente_ministerio')}}</label> {{ $cant_asistentes }} {{Lang::get('general.texto_simple_personas')}}  <br> @endif
                                                    </td>

                                                    <td>
                                                        <div class="btn-group">

                                                            <button type="button" class="btn btn-success btn-info dropdown-toggle" data-toggle="dropdown">
                                                                {{Lang::get('general.texto_simple_boton_opciones')}}  
                                                                <i class="fa fa-caret-down"> </i>
                                                           </button>
                                                            <ul class="dropdown-menu">
                                                                
                                                                    <li><a href="../perfil/{{$reporte->id}}"> {{Lang::get('general.texto_simple_opcion_perfil')}} </a></li>
                                                                    @if(Auth::user()->id==1)
                                                                    <li><a href="../actualizar/{{$reporte->id}}"> {{Lang::get('general.texto_simple_modificar')}} </a></li>
                                                                    <li><a href="../dado-baja-alta/{{$reporte->id}}"> {{Lang::get('general.texto_simple_eliminar')}} </a></li> 
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
                                </div>
                                <div class="box-footer">                                   
                                    <div class="row">                                        
                                        <div class="col-lg-4">                                            
                                          <h4> <b>{{ $reporte_reuniones->getFrom() }}</b> - <b>{{ $reporte_reuniones->getTo() }}</b> {{Lang::get('general.texto_simple_de')}} <b>{{ $reporte_reuniones->getTotal() }} </b> {{Lang::get('general.texto_simple_registros')}}.</h4> 
                                        </div>
                                        
                                        <div class="col-lg-8 text-right" style="padding-right: 30px!important;"> {{ $reporte_reuniones->appends(array('buscar' => $buscar, 'fecha-inicio' => $fecha_inicio, 'fecha-fin' => $fecha_fin, 'reunion' => $reunion))->links() }}</div>
                                        
                                    </div>
                                </div>
                            
                        </div>
                        <!-- /div de 12 columnas -->
                    </div>
                  <!-- /row de la tabla -->
                </section>
                <!-- contenido principal -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        @include('includes.scripts')   

        <!-- plugins para filtros -->
    <script src="/js/plugins/moment/moment.js" type="text/javascript"></script>
    <script src="/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <script type="text/javascript" src="/js/plugins/chosen/chosen.js"></script>

    <!-- Script para los filtros -->
    <script type="text/javascript">
      $(function() {
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
     
        
        <!-- page script -->
        <script type="text/javascript">
      
            $(document).ready(function() {
                $("#menu_reuniones").children("a").first().trigger('click');

      } );

        </script>

        
        
    </body>
</html>
@endif