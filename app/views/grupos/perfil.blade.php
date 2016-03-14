@if(Auth::check())
@include('includes.lenguaje')
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Redil |  Perfil de Grupo </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        @include('includes.styles')    

        <!-- Ionicons -->
        <link href="/css/ionicons.min.css" rel="stylesheet" type="text/css" />
         <!-- Morris charts -->
        <link href="/css/morris/morris.css" rel="stylesheet" type="text/css" />

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
                	
                	<h1>
                    {{Lang::get('grupos.texto_titulo_pagina_perfil')}}
                    <small> Aqui podras observar la información detallada de un grupo. </small>
                    </h1>
                   
                 </section>
                 <!-- /contendio cabezote -->
                 

                <!-- contenido principal -->
                <section class="content">

                    <!-- columna cabezote de grupo -->    
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="panel-body text-left"> 
                             <div class="btn-group pull-right">
                                <button type="button" class="btn btn-success btn-info dropdown-toggle" data-toggle="dropdown">
                                    {{ Lang::get('grupos.lg_bt_opciones') }}  
                                    <i class="fa fa-caret-down"> </i>
                               </button>
                               <ul class="dropdown-menu">
                                    @if($grupo->dado_baja==0)
                                        <li><a href="../actualizar/{{$grupo->id}}">{{ Lang::get('grupos.lg_bt_opciones_1') }}</a></li>
                                        <li><a href="../dado-baja-alta/{{$grupo->id}}">{{ Lang::get('grupos.lg_bt_opciones_3') }}</a></li>
                                    @else
                                        <li><a href="../dado-baja-alta/{{$grupo->id}}">Dar de alta</a></li>
                                    @endif
                                    <li><a href="#">{{ Lang::get('grupos.lg_bt_opciones_2') }}</a></li>                                                               
                                </ul>
                                
                            </div> 
                            <h1 class="user-header capitalize">
                                 Grupo: {{$grupo->nombre}}                                 
                            </h1> 
                            <h3 class="page-header"><b>Cod. {{$grupo->id}}</b>  </h3>
                           
                            

                            @if (isset($grupo->linea()->nombre))          
                            <h4><b><i class="fa fa-share-alt"></i> Línea: {{$grupo->linea()->nombre}} </b> </h4> 
                            @endif

                            @if($grupo->inactivo == 0)
                            <small class="label label-success" style="font-size: 14px"><i class="fa fa-check-square"></i> Activo</small>   
                            @elseif($grupo->inactivo == 1)   
                            <small class="label label-danger" style="font-size: 14px"><i class="fa fa-check-square"></i> Inactivo</small> 
                            @endif   
                                
                        </div>
                    </div>
                    <br>
                    <!-- /columna cabezote del grupo -->

                                    
              		<!-- row  -->
                    <div class="row">
                        
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <!-- columna informacion principal de grupo -->
                            <div class="panel">
                                <div class="panel-heading">
                                    <h4 class="modal-title"><i class="fa fa-info fa-1x"></i> Información principal </h4>
                                </div>
                                <div class="panel-body">                                    
                                    <h4><i class="fa fa-flag-o"></i> Palabra rhema: {{$grupo->rhema}}</h4>
                                    <h4><i class="fa fa-calendar-o"></i> Día de reunión: 
                                        @if($grupo->dia=="2"){{ Lang::choice ('general.dias', 2) }}@endif
                                        @if($grupo->dia=="3"){{ Lang::choice ('general.dias', 3) }}@endif
                                        @if($grupo->dia=="4"){{ Lang::choice ('general.dias', 4) }}@endif
                                        @if($grupo->dia=="5"){{ Lang::choice ('general.dias', 5) }}@endif
                                        @if($grupo->dia=="6"){{ Lang::choice ('general.dias', 6) }}@endif
                                        @if($grupo->dia=="7"){{ Lang::choice ('general.dias', 7) }}@endif
                                        @if($grupo->dia=="1"){{ Lang::choice ('general.dias', 1) }}@endif 
                                    </h4>
                                    <h4><i class="fa fa-clock-o"></i> {{ date('h:i A', strtotime($grupo->hora)) }}</h4>
                                    <h4><i class="fa fa-phone"></i> {{$grupo->telefono}}</h4>
                                    <h4><i class="fa fa-home"></i> {{$grupo->direccion}} </h4>
                                    <h4><i class="fa fa-calendar"></i>  Fecha de apertura: @if($grupo->fecha_apertura!="") {{ Helper::fechaFormateada($grupo->fecha_apertura) }} @else No hay fecha de apertura @endif </h4>
                                    <h4><i class="fa fa-code-fork"></i> Red(es): 
                                        @foreach ($grupo->redes as $red)
                                            {{$red->nombre}}
                                        @endforeach 
                                    </h4>
                                    <h4><i class="fa fa-circle-o"></i> Tipo: {{ $grupo->tipo_grupo->nombre }}</h4>
                                    <!--<h4><i class="fa fa-male"></i> Cantidad de integrantes: {{ $grupo->asistentes()->count() }}</h4>-->
                                    <h4><i class="fa fa-male"></i> Cantidad de integrantes: {{ $grupo->asistentes()->count() }}</h4>
                                </div>
                            </div>
                            <!-- /columna informacion principal de grupo -->

                            <!-- Estadistica de crecimiento  -->
                            <div class="panel">

                                <div class="panel-heading">
                                    <h4 class="modal-title"><i class="fa fa-bar-chart-o fa-1x"></i> Integrantes / Promedio asistencia <small>Ultimos 6 meses</small></h3>
                                    <div class="pull-right panel-tools">
                                        <button class="btn btn-info btn-sm " data-toggle="tooltip" title="" data-original-title="Esta grafica muestra un comparativo de la cantidad de integrantes del grupo versus el promedio de asistencia en los últimos 6 meses"><i class="fa fa-info"></i></button>  
                                                                              
                                    </div>

                                </div>
                                <div class="panel-body chart-responsive">
                                    <div class="chart" id="bar-chart" style="height: 200px;"></div>

                                </div><!-- /.panel-body -->
                            </div><!-- /.box -->
                            <!-- /Estadistica de crecimiento  -->

                        </div>
                       
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                            <!-- columna Lideres Encargados -->
                            <div class="panel">
                                <div class="panel-heading">
                                    <h4 class="modal-title "><i class="fa fa-star fa-1x"></i> Encargado(s) </h3>

                                </div>
                                <div class="panel-body ">
                                    <table id="example1" class="table table-condensed table-hover" cellspacing="0" width="100%">
                                        
                                        <tbody>
                                            <thead>
                                                <tr>
                                                    <th>CÓDIGO</th>
                                                    <th>NOMBRE</th>                                                      
                                                </tr>
                                            </thead>  
                                            @foreach ($grupo->encargados as $encargado)                                                 
                                            <tr>                                                
                                                <td>
                                                    {{$encargado->id}}
                                                </td>
                                                <td>
                                                    <a href="/asistentes/perfil/{{ $encargado->id }}" class="capitalize">
                                                             {{$encargado->nombre}} {{$encargado->apellido}} </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        
                                    </table>                                    
                                </div>


                            </div>
                             <!-- /columna Lideres Encargados -->

                            <!-- columna servidores -->
                            <div class="panel">
                                <div class="panel-heading">
                                    <h4 class="modal-title"> <i class="fa fa-bookmark fa-1x"></i> Servidores</h3>
                                </div>
                                <div class="panel-body">
                                    <table id="example1" class="table table-condensedres table-hover" cellspacing="0" width="100%">
                                        
                                        <tbody>
                                            <thead>
                                                <tr>
                                                    <th>CÓDIGO</th>
                                                    <th>NOMBRE</th> 
                                                    <th>CARGO</th>                                                      
                                                </tr>
                                            </thead>  
                                            @foreach ($grupo->servidores as $servidor)        
                                            <tr>
                                                <td>
                                                    {{$servidor->id}}
                                                </td>
                                                <td>
                                                     <a href="/asistentes/perfil/{{ $servidor->id }}" class="capitalize">
                                                             {{$servidor->nombre}} {{$servidor->apellido}} </a>
                                                                                        
                                                </td>
                                                <td>
                                                    <?php
                                                        $servidor_grupo= ServidorGrupo::where("asistente_id","=", $servidor->id)->where("grupo_id", "=", $grupo->id)->first();
                                                        $los_cargos=$servidor_grupo->tipoServicioGrupo()->get();
                                                    ?>
                                                    @foreach ($los_cargos as $cargo)
                                                        {{$cargo->nombre}}   
                                                    @endforeach 
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        
                                    </table>      
                                </div> <!-- /panel-body -->
                            </div>
                            <!-- /columna servidores -->

                             <!-- Estadistica Asistencia al grupo  -->
                            <div class="panel">

                                <div class="panel-heading">
                                    <h4 class="modal-title"><i class="fa fa-bar-chart-o fa-1x"></i> Asistencia ultimos 10 reportes</h3>
                                    <div class="pull-right panel-tools">
                                        <button class="btn btn-info btn-sm " data-toggle="tooltip" title="" data-original-title="Esta grafica muestra el comportamiento de la asistencia al grupo, segun los ultimos 10 reportes del grupo"><i class="fa fa-info"></i></button>  
                                           
                                    </div> 
                                   
                                </div>
                                <div class="panel-body chart-responsive">
                                    <div class="chart" id="asistencia-semanal-grupos" style="height: 120px;"></div>
                                </div><!-- /.panel-body -->
                            </div><!-- /.box -->
                            <!-- /Estadistica Asistencia al grupo  -->

                            <!-- Estadistica de crecimiento  
                            <div class="panel">

                                <div class="panel-heading">
                                    <h4 class="modal-title"><span class="badge bg-red">  <i class="fa fa-bar-chart-o fa-1x"></i> </span> Promedio de asistencia - ultimos 6 meses</h4>
                                    <div class="pull-right panel-tools">
                                        <button class="btn btn-info btn-sm " data-toggle="tooltip" title="" data-original-title="Esta grafica muestra el promedio de la asistencia al grupo en los utlimos 6 meses"><i class="fa fa-info"></i></button>  
                                        <button class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>                                      
                                    </div>

                                </div>
                                <div class="panel-body chart-responsive">
                                    <div class="chart" id="promedio-asistencia" style="height: 200px;"></div>

                                </div><!-- /.panel-body 
                            </div><!-- /.box -->
                            <!-- /Estadistica de crecimiento  -->

                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h4 class="modal-title"><i class="fa fa-users fa-1x"></i> Integrantes</h4> 
                                    <div class="pull-right panel-tools" >
                                        <a href="../pdf/{{ $grupo->id }}" target="blank" data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Generar Archivo PDF"><i class="fa fa-file-pdf-o "></i></a>
                                    </div>
                                </div>
                                    
                                <div class="panel-body table-responsive">
                                    
                                    <table id="tabla_asistentes_grupos" class="table  table-striped display stripe" cellspacing="0" width="100%"> 
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>ASISTENTE</th>  
                                                <th>CONTACTO</th> 
                                                <th>ACTIVIDAD</th>                                                 
                                          </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($grupo->asistentes as $asistente)                                            
                                             <tr> 
                                                <td class="text-center"> <img src="/img/fotos/{{ $asistente->foto }}" class="img-circle"  width="80px" alt="User Image" />
                                                </td>                                               
                                                <td>
                                                  <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Codigo">Cod</label> {{ $asistente->id }}<br>
                                                    
                                                  @if ($asistente->tipoAsistente['id']==5)
                                                    <label class="label arrowed-right" style="background-color: purple;" data-toggle="tooltip" data-placement="top" title="{{ $asistente->tipoAsistente['nombre'] }}"> <i class="fa fa-book"></i> {{ $asistente->tipoAsistente['nombre'] }}</label> 
                                                  @elseif($asistente->tipoAsistente['id']==3)
                                                    <label class="label arrowed-right bg-blue" data-toggle="tooltip" data-placement="top" title="{{ $asistente->tipoAsistente['nombre'] }}"><i class="fa fa-child"></i> {{ $asistente->tipoAsistente['nombre'] }}</label> 
                                                  @elseif($asistente->tipoAsistente['id']==4)
                                                    <label class="label arrowed-right bg-orange" data-toggle="tooltip" data-placement="top" title="{{ $asistente->tipoAsistente['nombre'] }}"><i class="fa fa-star-o"></i> {{ $asistente->tipoAsistente['nombre'] }}</label> 
                                                  @elseif($asistente->tipoAsistente['id']==2)
                                                    <label class="label arrowed-right bg-aqua" data-toggle="tooltip" data-placement="top" title="{{ $asistente->tipoAsistente['nombre'] }}"><i class="fa fa-group"></i></label> 
                                                  @elseif($asistente->tipoAsistente['id']==1)
                                                    <label class="label arrowed-right bg-teal" data-toggle="tooltip" data-placement="top" title="{{ $asistente->tipoAsistente['nombre'] }}"><i class="fa fa-heart"></i> {{ $asistente->tipoAsistente['nombre'] }}</label> 
                                                  @endif 

                                                  <a href="../../asistentes/perfil/{{ $asistente->id }}" class="capitalize">{{ $asistente->nombre." ".$asistente->apellido }}</a><br>
                                                  <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Id">Id</label> {{ $asistente->identificacion }}<br>                                           
                                                </td>
                                                <td >
                                                    <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Telefono fijo"><i class="fa fa-phone"></i></label> {{ $asistente->telefono_fijo }}<br>
                                                    <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Celular"> <i class="fa fa-mobile-phone"></i></label> {{ $asistente->telefono_movil }}<br>
                                                    <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="E-mail">@</label> 
                                                    {{ $asistente->user['email'] }}<br>                      
                                                    <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Direccion"> <i class="fa fa-home"></i></label> {{ $asistente->direccion }}<br>
                                                </td >
                                                <td >
                                                   @if($asistente->inactivo_grupo == 0)
                                                       <span class="badge bg-aqua"><i class=""> Activo en grupo</i> </span></h3> <br>
                                                    @elseif($asistente->inactivo_grupo == 1)
                                                       <span class="badge bg-red"><i class=""> Inactivo en grupo</i> </span></h3> <br>
                                                    @endif
                                                    @if($asistente->inactivo_iglesia == 0)
                                                       <span class="badge bg-aqua"><i class=""> Activo en iglesia</i> </span></h3> <br>
                                                    @elseif($asistente->inactivo_iglesia == 1)
                                                       <span class="badge bg-red"><i class=""> Inactivo en iglesia</i> </span></h3> <br>
                                                    @endif
                                                   <!-- Grupo: <span class="badge bg-red"><i class=""> No Activo </i> </span></h3>-->       
                                                </td>
                                            
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        
                                    </table>                                                                                         
                                </div>

                            </div>
                        </div>
                       
                   </div>  
                    <!-- /row --> 
                </section>
                <!-- contenido principal -->
            </aside>  
        </div>
           
        @include('includes.scripts') 
        
        <!-- Morris.js charts -->
        <script src="/js/raphael-min.js"></script>
        <script src="/js/plugins/morris/morris.min.js" type="text/javascript"></script>

        <!-- js data tables-->
        <script src="{{ Lang::get('general.url-datatables') }}" type="text/javascript"></script>
        <script src="/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>


         <!-- page script -->
        <script type="text/javascript">     
           $(document).ready(function() {
                "use strict";
                //estadistica de crecimiento
                var meses = new Array ("", "Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov", "Dic");
                var bar = new Morris.Bar({
                    element: 'bar-chart',
                    resize: true,
                    data: [
                    @for($i=5; $i>=0; $i--)
                        <?php $mes = Helper::sumaMesesFecha($mes_actual, "-$i", 'Y-m');?>
                        {y: meses[parseInt("{{date('m', strtotime($mes))}}")], a: {{ $grupo->integrantesALaFecha(Helper::finalMes(date("Y",strtotime($mes)), date("m",strtotime($mes))))->count(); }}, b: {{ (int)$grupo->promedioAsistencia(date('Y-m-d', strtotime($mes)), Helper::finalMes(date("Y",strtotime($mes)), date("m",strtotime($mes)))) }} },
                    @endfor   
                    ],
                    barColors: ['#f4543c', '#00a65a'],
                    xkey: 'y',
                    ykeys: ['a', 'b'],
                    labels: ['Integrantes', 'Asistentes'],
                    hideHover: 'auto'
                });

                

                //estadistica de asistencia 
                //var meses = new Array ("En","Fe","Mar","Ab","May","Jun","Jul","Ag","Se","Oc","No", "Di");
                <?php 
                    $reportes =$grupo->reportes()
                                     ->orderBy('fecha','desc')
                                     ->take(10)
                                     ->get();

                    $reportes_count= $reportes->count();

                    $ultimo_reporte =$grupo->reportes()
                                     ->orderBy('fecha','desc')
                                     ->take(1)
                                     ->get();

                    $contador=1;
                ?> 
                                            
                Morris.Line({
                  element: 'asistencia-semanal-grupos',
                  resize: true,  
                   
                                    data: [
                                            @foreach($reportes as $reporte)
                                            <?php $cant_asistieron=$reporte->asistentes()->where('asistio', '=', '1')->count();
                                             ?>
                                                {y: '{{$reporte->fecha}}', item1: {{$cant_asistieron}} },

                                            <?php $contador++; ?>
                                            @endforeach
                                        
                                    ],

                                    xkey: 'y',
                                    ykeys: ['item1'],
                                    labels: ['Asistentes'],
                                    lineColors: ['#3c8dbc'],
                                    hideHover: 'auto',
                                    xLabels: 'day',
                  xLabelFormat: function (x) { 
                    var dia=x.getDate();
                    if(dia<10)
                      dia="0"+dia;
                    return dia; }
                });

                ///este es el codigo para modificar el grupo con los botones del modal
                  $('#btn_buscar').click (function () {
                        var la_busqueda= document.getElementById('buscar').value;
                        alert(la_busqueda+"");
                  });

                // tabla de lineas 
                $('#tabla_asistentes_grupos').dataTable( {
                    
                });
                $("#menu_grupos").children("a").first().trigger('click');           
            });
       </script>

    </body>
</html>
@endif