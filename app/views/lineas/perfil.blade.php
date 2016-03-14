@if(Auth::check())
@include('includes.lenguaje')
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Redil |  Perfil de grupo </title>
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
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- contendio cabezote -->
                <section class="content-header">
                    <h1>
                    PERFIL DE LINEA
                    <small> Aqui podras observar la información detallada de las lineas. </small></h1>                        
                    <br>
                </section>
                <!-- /contendio cabezote -->
                 

                <!-- contenido principal -->
                <section class="content">

                <!-- columna cabezote de grupo -->
                <div class="row">
                    <div class="col-lg-4">
                        <div class="box-body text-left"> 
                            <h1 class="user-header"><i class="fa fa-share-alt"></i>
                                Linea: {{ $linea->nombre}}
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-info dropdown-toggle" data-toggle="dropdown">
                                        {{ Lang::get('lineas.ll_bt_opciones') }} 
                                        <i class="fa fa-caret-down"> </i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="../../lineas/actualizar/{{$linea->id}}">{{ Lang::get('lineas.ll_lb_modificar') }}</a></li>
                                    </ul>
                                </div>
                            </h1>           
                             
                            <small class="label label-success" style="font-size: 14px"><i class="fa fa-check-square"></i> Cod. {{ $linea->id }}</small>               
                            <br>
                            <br>
                                  
                        </div>
                    </div>
                    
                </div><!-- /div que cierra row cabezote -->
                        
                <!-- /columna cabezote del grupo -->
                                    
                <!-- row  -->
                <div class="row">

                    <?php
                    $numero_integrantes=0; 
                    $total_integrantes=0;

                    $nuevos=0;
                    $ovejas=0;
                    $miembros=0;
                    $lideres=0;
                    $pastores=0;    

                    $masculinos=0;
                    $femeninos=0;                                                            

                    $mes_actual = date('Y-m'); // Me trae la fecha actual de sistema

                    $un_mes_atras = strtotime ( '-1 month' , strtotime ( $mes_actual ) ); // Esta funcion me coge la mes_actual y le resta n meses
                    $un_mes_atras = date ( 'Y-m' , $un_mes_atras ); // le doy formato Y-M-J a mi nueva fecha

                    $segundo_mes_atras = strtotime ( '-2 month' , strtotime ( $mes_actual ) ); // Esta funcion me coge la mes_actual y le resta n meses
                    $segundo_mes_atras = date ( 'Y-m' , $segundo_mes_atras ); // le doy formato Y-M-J a mi nueva fecha

                    $tercer_mes_atras = strtotime ( '-3 month' , strtotime ( $mes_actual ) ); // Esta funcion me coge la mes_actual y le resta n meses
                    $tercer_mes_atras = date ( 'Y-m' , $tercer_mes_atras ); // le doy formato Y-M-J a mi nueva fecha

                    $cuarto_mes_atras = strtotime ( '-4 month' , strtotime ( $mes_actual ) ); // Esta funcion me coge la mes_actual y le resta n meses
                    $cuarto_mes_atras = date ( 'Y-m' , $cuarto_mes_atras ); // le doy formato Y-M-J a mi nueva fecha

                    $quinto_mes_atras = strtotime ( '-5 month' , strtotime ( $mes_actual ) ); // Esta funcion me coge la mes_actual y le resta n meses
                    $quinto_mes_atras = date ( 'Y-m' , $quinto_mes_atras ); // le doy formato Y-M-J a mi nueva fecha

                    $cant_asistentes_mes0=0;
                    $cant_asistentes_mes1=0;
                    $cant_asistentes_mes2=0;
                    $cant_asistentes_mes3=0;
                    $cant_asistentes_mes4=0;
                    $cant_asistentes_mes5=0;

                    $cant_grupos_mes0=0;
                    $cant_grupos_mes1=0;
                    $cant_grupos_mes2=0;
                    $cant_grupos_mes3=0;
                    $cant_grupos_mes4=0;
                    $cant_grupos_mes5=0;

                    $bebes=0;
                    $niños=0;
                    $adolecentes=0;
                    $jovenes=0;
                    $jovenes_adultos=0;
                    $adultos=0;
                    $sin_edad=0;

                    $cuenta_sin_redes=0 ;
                    ?>
                    @foreach ($linea->asistentes as $asistente)

                        @if($asistente->tipo_asistente_id == 1)
                            <?php                                                                        
                                $nuevos++;                                                             
                            ?>
                        @elseif($asistente->tipo_asistente_id == 2)
                            <?php                                                                        
                                $ovejas++;                                                             
                            ?>
                        @elseif($asistente->tipo_asistente_id == 3)
                            <?php                                                                        
                                $miembros++;                                                             
                            ?>
                        @elseif($asistente->tipo_asistente_id == 4)
                            <?php                                                                        
                                $lideres++;                                                             
                            ?>
                        @elseif($asistente->tipo_asistente_id == 4)
                            <?php                                                                        
                                $pastores++;                                                             
                            ?>
                        @endif

                        @if($asistente->genero == 0)
                            <?php                                                                        
                                $masculinos++;                                                             
                            ?>
                        @elseif($asistente->genero == 1)
                            <?php                                                                        
                                $femeninos++;                                                             
                            ?>
                        @endif


                        @if($asistente->fecha_ingreso != "")
                            <?php $fecha_ing=date_create($asistente->fecha_ingreso);
                            $fecha_ing=date_format($fecha_ing, 'Y-m') ; 
                            ?>                            

                            @if ($fecha_ing<=$mes_actual)
                                <?php  $cant_asistentes_mes0=$cant_asistentes_mes0+1 ?>
                            @endif
                            @if($fecha_ing<=$un_mes_atras)
                                 <?php  $cant_asistentes_mes1=$cant_asistentes_mes1+1 ?>
                            @endif
                            @if($fecha_ing<=$segundo_mes_atras)
                                <?php  $cant_asistentes_mes2=$cant_asistentes_mes2+1 ?>
                            @endif
                            @if($fecha_ing<=$tercer_mes_atras)
                                <?php  $cant_asistentes_mes3=$cant_asistentes_mes3+1 ?>
                            @endif
                            @if($fecha_ing<=$cuarto_mes_atras)
                                <?php  $cant_asistentes_mes4=$cant_asistentes_mes4+1 ?>
                            @endif
                            @if($fecha_ing<=$quinto_mes_atras)
                                <?php  $cant_asistentes_mes5=$cant_asistentes_mes5+1 ?>
                            @endif

                        @endif

                        <?php 
                            if($asistente->fecha_nacimiento == ""){
                                $edad=-1; 
                                $fecha_naci="sin fecha";                                 

                            }else{
                                $fecha_naci=date_create($asistente->fecha_nacimiento);
                                $fecha_naci=date_format($fecha_naci, 'Y-m-j') ; 
                                list($Y,$m,$d) = explode("-",$fecha_naci);
                                $edad=( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );

                            }
                          
                        ?>


                        @if( $edad > 0 &&  $edad <= 2 )
                            <?php  $bebes= $bebes+1; ?>
                        @elseif( $edad > 2 &&  $edad <= 12 )
                            <?php  $niños= $niños+1; ?>
                        @elseif( $edad > 12 &&  $edad <= 18 )
                            <?php  $adolecentes= $adolecentes+1; ?>
                        @elseif( $edad > 18 &&  $edad <= 25 )
                            <?php  $jovenes= $jovenes+1; ?>
                        @elseif( $edad > 25 &&  $edad <= 35 )
                            <?php  $jovenes_adultos= $jovenes_adultos+1; ?>
                        @elseif( $edad > 35 )
                            <?php  $adultos= $adultos+1; ?>
                        @else 
                            <?php $sin_edad= $sin_edad+1; ?>
                        @endif 
                    @endforeach

                    @foreach($linea->grupos()->get() as $grupo)
                        @if($grupo->fecha_apertura!="")
                            <?php $fecha_ing2=date_create($grupo->fecha_apertura);
                            $fecha_ing2=date_format($fecha_ing2, 'Y-m') ; 
                            ?>
                                                   
                            @if ($fecha_ing2<=$mes_actual)
                                <?php  $cant_grupos_mes0=$cant_grupos_mes0+1 ?>
                            @endif
                            @if($fecha_ing2<=$un_mes_atras)
                                 <?php  $cant_grupos_mes1=$cant_grupos_mes1+1 ?>
                            @endif
                            @if($fecha_ing2<=$segundo_mes_atras)
                                <?php  $cant_grupos_mes2=$cant_grupos_mes2+1 ?>
                            @endif
                            @if($fecha_ing2<=$tercer_mes_atras)
                                <?php  $cant_grupos_mes3=$cant_grupos_mes3+1 ?>
                            @endif
                            @if($fecha_ing2<=$cuarto_mes_atras)
                                <?php  $cant_grupos_mes4=$cant_grupos_mes4+1 ?>
                            @endif
                            @if($fecha_ing2<=$quinto_mes_atras)
                                <?php  $cant_grupos_mes5=$cant_grupos_mes5+1 ?>
                            @endif
                        @endif

                        <?php $las_redes= $grupo->redes()->count(); ?>
                        @if($las_redes==0) 
                            <?php $cuenta_sin_redes=$cuenta_sin_redes+1  ?>
                        @endif
                    @endforeach
                        
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <!-- columna informacion principal de grupo -->
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="modal-title"> <span class="badge bg-light-redil">  <i class="fa fa-info fa-1x"></i> </span>  Información principal</h3>
                            </div>
                            <div class="panel-body">                                    
                                <h4><i class="fa fa-flag-o"></i> Palabra rhema: {{ $linea->rhema }}</h4>
                               
                                <h4><i class="fa fa-circle-o"></i> Descripción: {{ $linea->descripcion }}</h4>
                                <h4><i class="fa fa-share-alt"></i> Cantidad de grupos: {{ $linea->grupos()->count() }}</h4>
                                <h4><i class="fa fa-male"></i> Cantidad de integrantes: {{ $linea->asistentes->count() }}</h4>
                            </div>
                        </div>
                         <!-- columna Lideres Encargados -->
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="modal-title "><span class="badge bg-orange"><i class="fa fa-star fa-1x"></i></span> Lider(es) encargado(s)</h3>
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
                                        @foreach ( $linea->encargados as $encargado)                                                  
                                        <tr>                                                
                                            <td>
                                               {{ $encargado->id }} 
                                            </td>
                                            <td>
                                                <a href='/asistentes/perfil/{{ $encargado->id }}' class="capitalize"> {{ $encargado->nombre }} {{ $encargado->apellido }} </a> 
                                            </td>
                                        </tr>  
                                        @endforeach                                      
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                        <!-- /columna Lideres Encargados -->

                        <!-- Estadistica crecimientos grupos mensual  -->
                        <div class="box box-info">
                            <div class="box-header">
                                <h3 class="box-title"><span class="badge bg-light-redil">  <i class="fa fa-bar-chart-o fa-1x"></i> </span> Crecimiento Grupos Linea</h3>
                                <div class="pull-right box-tools">
                                    <button class="btn btn-info btn-sm " data-toggle="tooltip" title="" data-original-title="Esta grafica muestra el crecimiento o decrecimiento de los grupos de la linea mensualmente."><i class="fa fa-info"></i></button>  
                                    <button class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>                                      
                                </div>
                            </div>
                                    
                            <div class="box-body chart-responsive">
                                <div class="chart" id="graf-crecimiento-asistentes-grupo" style="height: 120px;"></div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                        <!-- /Estadistica crecimientos grupo mensual  -->

                        <!-- grafica de aportes financieros lineas-->
                        <div class="box box-info hide">
                            <div class="box-header">
                                <h3 class="box-title">Aportes Financieros Linea</h3>
                                <div class="pull-right box-tools">
                                    <button class="btn btn-info btn-sm " data-toggle="tooltip" title="" data-original-title="Esta grafica muestra los aportes financieros totales de la linea."><i class="fa fa-info"></i></button>  
                                    <button class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>                                      
                                </div>
                            </div>
                            <div class="box-body chart-responsive">
                                  <div class="chart" id="graf-finanzas" style="height: 120px;"></div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                        <!-- /grafica finanzas linea  -->
                        <!-- Estadistica de asistencia por tipo asistente-->
                        <div class="box box-info">
                            <div class="box-header">
                                <h3 class="box-title"><span class="badge bg-light-redil">  <i class="fa fa-bar-chart-o fa-1x"></i> </span> Graficación por tipo de asistente</h3>
                                <div class="pull-right box-tools">
                                    <button class="btn btn-info btn-sm " data-toggle="tooltip" title="" data-original-title="Esta grafica muestra el total de asistentes distribuidos según su la clasificacion de los asistentes."><i class="fa fa-info"></i></button> 
                                    <button class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>                                       
                                </div>
                            </div>
                            <div class="box-body chart-responsive">
                                <div class="chart" id="sales-chart-clasificacion" style="height: 300px; position: relative;"></div>
                                <table class="table table-condensedres table-hover" cellspacing="0" width="100%">
                                    <tbody>
                                        <thead>
                                            <tr>
                                                <th>TIPO</th>
                                                <th># DE ASISTENTES</th>                                                      
                                            </tr>
                                        </thead>  
                                               
                                        <tr>
                                            <td>
                                                Nuevos                  
                                            </td>
                                            <td>
                                                {{$nuevos}} 
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <td>
                                                Ovejas
                                                                                    
                                            </td>
                                            <td>
                                                {{$ovejas}}                               
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Miembros                             
                                            </td>
                                            <td>
                                                {{$miembros}}                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Lideres                             
                                            </td>
                                            <td>
                                                {{$lideres}}                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Pastores
                                                                                    
                                            </td>
                                            <td>
                                                {{$pastores}}                               
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                    
                                </table>    
                            </div><!-- /.box-body -->
                        </div>
                        <!-- /Estadistica de asistencia por tipo de asistente-->

                        <!-- Asistencia por sexo-->
                        <div class="box box-info">
                            <div class="box-header">
                                <h3 class="box-title"><span class="badge bg-light-redil">  <i class="fa fa-bar-chart-o fa-1x"></i> </span> Graficación por sexo</h3>
                                <div class="pull-right box-tools">
                                    <button class="btn btn-info btn-sm " data-toggle="tooltip" title="" data-original-title="Esta grafica muestra como esta distribuidos la cantidad total asistente por sexo."><i class="fa fa-info"></i></button> 
                                    <button class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>                                       
                                </div>
                            </div>
                            <div class="box-body chart-responsive">
                                <div class="chart" id="graf-sexo" style="height: 300px; position: relative;"></div>

                                <table class="table table-condensedres table-hover" cellspacing="0" width="100%">
                                    
                                    <tbody>
                                        <thead>
                                            <tr>
                                                <th>SEXO</th> 
                                                <th># DE ASISTENTES</th>                                                      
                                            </tr>
                                        </thead>  
                                               
                                        <tr>
                                           
                                            <td>
                                                Masculino
                    
                                                                                    
                                            </td>
                                            <td>
                                                {{$masculinos}}
                                            </td>
                                            
                                            
                                        </tr>
                                        <tr>
                                            
                                            <td>
                                                Femenino  
                                                                                    
                                            </td>
                                            <td>
                                             {{$femeninos}}                              
                                            </td>
                                        </tr>
                                                                                  
                                    </tbody>
                                    
                                </table>    
                            </div><!-- /.box-body -->
                        </div>
                        <!-- /Asistencia por sexo-->


                    </div> <!-- div que cierra el col-lg-6 col-md-6 col-sm-6 col-xs-12 del lado izquierdo-->
                       
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                        <!-- graficas por grupos de la linea-->                            
                        <div class="box box-danger"> 
                            <div class="panel-heading">
                                <h3 class="box-title"> <span class="badge bg-red">  <i class="fa fa-users fa-1x"></i> </span>  Grupos de la Linea</h3>
                            </div>
                            
                            <div class="panel-body">
                                 <table id="tabla_grupos_linea" class="table  table-striped display stripe" cellspacing="0" width="100%">                                    
                                    <thead>
                                        <tr>
                                            <th>CÓDIGO</th>
                                            <th>NOMBRE GRUPO</th>   
                                            <th title="este reporte se refiere a la entrega semanal del reporte de cada grupo.">ESTADO GRUPO</th> 
                                            <th title="este reporte se refiere a la entrega semanal del reporte de cada grupo.">REPORTADO</th>     
                                                                                               
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($linea->grupos()->where('dado_baja', 0)->get() as $grupo)
                                        <tr>
                                            <td>
                                                {{$grupo->id}}
                                                
                                            </td>
                                            <td>
                                                <a href='/grupos/perfil/{{$grupo->id}}'>{{$grupo->nombre}} </a>      
                                            </td>
                                            <td title="este reporte se refiere a la entrega semanal del reporte de cada grupo."> 
                                                @if($grupo->inactivo==0)
                                                <span class="badge bg-green"><i class=""> Activo</i> </span>
                                                @else
                                                <span class="badge bg-red"><i class=""> Inactivo</i> </span> 
                                                @endif          
                                            </td>
                                            <td>
                                                <?php $reporte=ReporteGrupo::where('grupo_id', "$grupo->id")->orderBy('fecha', 'desc')->first(); ?>
                                                @if(isset($reporte->id))
                                                <span class="badge bg-light-blue">Ultimo reporte: {{ $reporte->fecha }} </span>
                                                @else
                                                <span class="badge bg-red">
                                                    Nunca ha reportado
                                                </span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>                                            
                                </table>    
                            </div>
                        </div>
                         <!--  grafica grupos de la linea -->

                        <!-- Estadistica de crecimiento  -->
                        <div class="box box-danger ">
                            <div class="box-header">
                                <h3 class="box-title"><span class="badge bg-red">  <i class="fa fa-bar-chart-o fa-1x"></i> </span> Crecimiento de la linea</h3> 
                                <div class="pull-right box-tools">
                                    <button class="btn btn-info btn-sm " data-toggle="tooltip" title="" data-original-title="Esta grafica muestra el creciemiento de la linea mesualmente, en base de la cantidad de integrantes"><i class="fa fa-info"></i></button>  
                                    <button class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>                                      
                                </div>
                               
                            </div>
                            <div class="box-body chart-responsive">
                                <div class="chart" id="bar-asistentes-linea" style="height: 200px;"></div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                        <!-- /Estadistica de crecimiento  -->

                        <!-- Estadistica Asistencia a la iglesia  -->
                        <div class="box box-danger hide">

                            <div class="box-header">
                                <h3 class="box-title"><span class="badge bg-red">  <i class="fa fa-bar-chart-o fa-1x"></i> </span> Asitencia semanal</h3>
                                <div class="pull-right box-tools">
                                <button class="btn btn-info btn-sm " data-toggle="tooltip" title="" data-original-title="Esta grafica muestra la asistencia semanal de la linea."><i class="fa fa-info"></i></button>  
                                <button class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>                                      
                            </div>
                               
                            </div>
                            <div class="box-body chart-responsive">
                                <div class="chart" id="graf-iglesia" style="height: 120px;"></div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                        <!-- /Estadistica Asistencia a la iglesia  -->

                        <!-- Estadistica Asistencia a la iglesia mensual  -->
                        <div class="box box-danger hide">

                            <div class="box-header">
                                <h3 class="box-title"><span class="badge bg-red">  <i class="fa fa-bar-chart-o fa-1x"></i> </span> Asitencia Mensual</h3>
                               <div class="pull-right box-tools">
                                <button class="btn btn-info btn-sm " data-toggle="tooltip" title="" data-original-title="Esta grafica muestra el promedio de asistencia mensual de la linea."><i class="fa fa-info"></i></button>  
                                <button class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>                                      
                            </div>
                            </div>
                            
                            <div class="box-body chart-responsive">
                                <div class="chart" id="graf-iglesia-mensual" style="height: 120px;"></div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                        <!-- /Estadistica Asistencia a la iglesia mensual  -->
                        
                        <!-- Asistencia por redes-->
                        <!-- en esta grafica se mostraran solamente la cantidad de grupos segun als redes y no los miembros ubiados en cada tipo de red para no generar datos repetidos.--> 
                        <div class="box box-danger">
                            <div class="box-header">
                                <h3 class="box-title"><span class="badge bg-red">  <i class="fa fa-bar-chart-o fa-1x"></i> </span> Graficación por Redes</h3>
                                <div class="pull-right box-tools">
                                    <button class="btn btn-info btn-sm " data-toggle="tooltip" title="" data-original-title="Esta grafica muestra la cantidad de redes que existen según los grupos  que hay en  la línea, hay que tener que un grupo puede tener más de una red."><i class="fa fa-info"></i></button>  
                                    <button class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>                                      
                                </div>
                            </div>
                            <div class="box-body chart-responsive">
                                <div class="chart" id="graf-redes" style="height: 300px; position: relative;"></div>

                                <table class="table table-condensedres table-hover" cellspacing="0" width="100%">
                                    
                                    <tbody>
                                        <thead>
                                            <tr>
                                                <th>ETAPA</th> 
                                                <th># DE GRUPOS</th>                                                      
                                            </tr>
                                        </thead>  
                                        <?php $array_redes = array(); 
                                              $nombre_red=0;
                                              $contador_redes=0; 
                                              ?>
                                        @foreach($redes as $red)
                                        <tr>
                                            <td>
                                                <?php $nombre_red=$red->nombre ?>
                                                {{$nombre_red}}            
                                            </td>
                                            <td>
                                                <?php 
                                                $grupos_id=$linea->grupos('array');
                                                $contador_redes= $red->grupos()->whereIn('grupos.id', $grupos_id )->count(); ?>
                                                {{ $contador_redes }}                                                   
                                            </td>  
                                        </tr> 
                                            <?php $array_redes[$nombre_red] = $contador_redes; ?>                                                
                                        @endforeach
                                        <tr>
                                            <td>
                                                Grupos sin redes           
                                            </td>
                                            <td>
                                                {{$cuenta_sin_redes}}                                                  
                                            </td>  
                                        </tr> 

                                    </tbody>
                                    
                                </table>    
                            </div><!-- /.box-body -->
                        </div>
                        <!-- /Asistencia por redes-->
                        
                        <!-- Asistencia por edades-->
                        <div class="box box-danger">
                            <div class="box-header">
                                <h3 class="box-title"><span class="badge bg-red">  <i class="fa fa-bar-chart-o fa-1x"></i> </span> Graficación por edades</h3>
                                <div class="pull-right box-tools">
                                    <button class="btn btn-info btn-sm " data-toggle="tooltip" title="" data-original-title="Esta grafica muestra la distribución de los integrantes pertenecientes a la línea según su edad."><i class="fa fa-info"></i></button>  
                                    <button class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>                                      
                                </div>
                            </div>
                            <div class="box-body chart-responsive">
                                <div class="chart" id="graf-edades" style="height: 300px; position: relative;"></div>

                                <table class="table table-condensedres table-hover" cellspacing="0" width="100%">
                                    
                                    <tbody>
                                        <thead>
                                            <tr>
                                                <th>ETAPA</th> 
                                                <th># DE ASISTENTES</th>                                                      
                                            </tr>
                                        </thead>  
                                               
                                        <tr>
                                           
                                            <td>
                                                Bebes 0 - 2 años                                
                                            </td>
                                            <td>
                                                {{$bebes}} 
                                            </td>
                                            
                                            
                                        </tr>
                                        <tr>
                                            
                                            <td>
                                                Niños  3 - 12 años                                                                                         
                                            </td>
                                            <td>
                                                {{$niños}}                            
                                            </td>
                                        </tr>
                                        <tr>
                                            
                                            <td>
                                               Adolecentes  13 - 18 años                      
                                            </td>
                                            <td>
                                                {{$adolecentes}}                            
                                            </td>
                                        </tr>

                                        <tr>
                                            
                                            <td>
                                               Jovenes 18 - 25 años                    
                                            </td>
                                            <td>
                                                {{$jovenes}}                             
                                            </td>
                                        </tr>

                                        <tr>
                                            
                                            <td>
                                               Jovenes Adultos 26 - 35 años                        
                                            </td>
                                            <td>
                                                {{$jovenes_adultos}}                            
                                            </td>
                                        </tr>

                                        <tr>
                                            
                                            <td>
                                               Adultos 36 años  en adelante                       
                                            </td>
                                            <td>
                                                {{$adultos}}                        
                                            </td>
                                        </tr>

                                        <tr>
                                            
                                            <td>
                                               Sin fecha de nacimiento                   
                                            </td>
                                            <td>
                                                {{$sin_edad}}                             
                                            </td>
                                        </tr>                                            
                                    </tbody>                                        
                                </table>    
                            </div><!-- /.box-body -->
                        </div>
                        <!-- /Asistencia por edades-->
                       

                       </div><!-- div que cierra la col6 del lado derecho-->
                       
                   </div>  
                    <!-- /row --> 




                   
              </section>
              <!-- contenido principal -->
            </aside>  



         @include('includes.scripts')   

        <!-- Morris.js charts -->
        <script src="/js/raphael-min.js"></script>
        <script src="/js/plugins/morris/morris.min.js" type="text/javascript"></script>

        <!-- js data tables-->
        <script src="{{ Lang::get('general.url-datatables') }}" type="text/javascript"></script>
        <script src="/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>


         <!-- page script -->
        <script type="text/javascript">
            $(function() {
                
                // arreglo de variables para graficas
                var mesesC = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre", "Diciembre");
                var meses = new Array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov", "Dic");
                
                //estadistica de crecimiento
                var bar = new Morris.Bar({
                    element: 'bar-asistentes-linea',
                    resize: true,
                    data: [
                        {y: "{{date('M', strtotime($quinto_mes_atras));}}", a: {{ $cant_asistentes_mes5 }} },
                        {y: "{{date('M', strtotime($cuarto_mes_atras));}}", a: {{$cant_asistentes_mes4}} },
                        {y: "{{date('M', strtotime($tercer_mes_atras));}}", a: {{$cant_asistentes_mes3}} },
                        {y: "{{date('M', strtotime($segundo_mes_atras));}}", a: {{$cant_asistentes_mes2}} },
                        {y: "{{date('M', strtotime($un_mes_atras));}}", a: {{$cant_asistentes_mes1}} },
                        {y: "{{date('M', strtotime($mes_actual));}}", a: {{$cant_asistentes_mes0}} }
                    ],
                    barColors: ['#f4543c'],
                    xkey: 'y',
                    ykeys: ['a'],
                    labels: ['Nuevas Personas'],
                    xLabels: 'day',
                    hideHover: 'auto'
                });
                
               
                //grafica crecimiento linea en barras 
                    Morris.Line({
                      element: 'graf-iglesia',
                      resize: true,
                                        data: [
                                            {y: '2014-05-01', item1: 3},
                                            {y: '2014-05-08', item1: 3},
                                            {y: '2014-05-15', item1: 8},
                                            {y: '2014-05-22', item1: 4},
                                            {y: '2014-05-29', item1: 3},
                                            {y: '2014-06-05', item1: 3},
                                            {y: '2014-06-12', item1: 4},
                                            {y: '2014-06-19', item1: 4},
                                            {y: '2014-06-26', item1: 3}
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
   
                // Javascript grafica finanzas
             
                var line = new Morris.Line({
                    element: 'graf-finanzas',
                    resize: true,
                    data: [
                        {y: '2014-01-01', x: 50000},
                        {y: '2014-02-01', x: 120000},
                        {y: '2014-03-01', x: 35000},
                        {y: '2014-04-01', x: 180000},
                        {y: '2014-05-01', x: 24000},
                        {y: '2014-06-01', x: 114500}
                        
                        
                    ],
                    xkey: 'y',
                    ykeys: ['x'],
                    labels: ['Asistencias'],
                    lineColors: ['#3c8dbc'],
                    hideHover: 'auto',
                    xLabels: 'month',
                    hoverCallback: function (index, options, content) {
                      var row = options.data[index];
                      var f=Date.parse(row.y);
                      var fecha = new Date(f);
                      var mes=mesesC[fecha.getMonth()+1];
                      if(fecha.getMonth()=='12')
                      mes=mesesC[0];
                      return mes+"<br><span class='text-blue'>Asistencias: "+row.x+"</span>";
                    },
                    xLabelFormat: function (x) { return meses[x.getMonth()]; }
                });
                // termina javascript de finanzas

                //javascript de estadistaca mensual asistencia
                var line = new Morris.Line({
                    element: 'graf-iglesia-mensual',
                    resize: true,
                    data: [
                        {y: '2014-01-01', x: 500},
                        {y: '2014-02-01', x: 120},
                        {y: '2014-03-01', x: 350},
                        {y: '2014-04-01', x: 180},
                        {y: '2014-05-01', x: 240},
                        {y: '2014-06-01', x: 114}                       
                        
                    ],
                    xkey: 'y',
                    ykeys: ['x'],
                    labels: ['Asistencias'],
                    lineColors: ['#3c8dbc'],
                    hideHover: 'auto',
                    xLabels: 'month',
                    hoverCallback: function (index, options, content) {
                      var row = options.data[index];
                      var f=Date.parse(row.y);
                      var fecha = new Date(f);
                      var mes=mesesC[fecha.getMonth()+1];
                      if(fecha.getMonth()=='12')
                      mes=mesesC[0];
                      return mes+"<br><span class='text-blue'>Asistencias: "+row.x+"</span>";
                    },
                    xLabelFormat: function (x) { return meses[x.getMonth()]; }
                });
                // termina javascript estadistica mesual asistencia
                
                //javascript de estadistaca crecimiento grupo mensual 

                var line = new Morris.Line({
                    element: 'graf-crecimiento-asistentes-grupo',
                    resize: true,
                    parseTime:false,
                    data: [
                        {y: "{{date('M', strtotime($quinto_mes_atras));}}", x: {{ $cant_grupos_mes5 }} }, 
                        {y: "{{date('M', strtotime($cuarto_mes_atras));}}", x: {{$cant_grupos_mes4}} },
                        {y: "{{date('M', strtotime($tercer_mes_atras));}}", x: {{$cant_grupos_mes3}} },
                        {y: "{{date('M', strtotime($segundo_mes_atras));}}", x: {{$cant_grupos_mes2}} },
                        {y: "{{date('M', strtotime($un_mes_atras));}}", x: {{$cant_grupos_mes1}} },
                        {y: "{{date('M', strtotime($mes_actual));}}", x: {{$cant_grupos_mes0}} }                    
                        
                    ],
                    xkey: 'y',
                    ykeys: ['x'],
                    labels: ['Nuevos Grupos'],
                    lineColors: ['#3c8dbc'],
                    hideHover: 'auto',
                    xLabels: 'month',
                    
                });
                // termina javascript estadistica cremiento mesual grupo
                       //ESTADISTICAS POR tipo asistente
                var donutn = new Morris.Donut({
                    element: 'sales-chart-clasificacion',
                    resize: true,
                    colors: ["#3ccdbc", "#f56954", "#5ba65a","#e3aa23", "#f56321", "#cca600"],
                    data: [
                        {label: "Nuevos", value: {{$nuevos}}},
                        {label: "Ovejas", value: {{$ovejas}}},
                        {label: "Miembros", value: {{$miembros}}},
                        {label: "Lideres", value: {{$lideres}}},
                        {label: "Pastores", value: {{$pastores}}}
                    ],
                    hideHover: 'auto'
                });
                // termina javascript de clasificacion por tipo de asistente

                //ESTADISTICA POR RED
                var donut = new Morris.Donut({
                    element: 'graf-redes',
                    resize: true,
                    colors: ["#3c8dbc", "#f56954", "#00a65a","#3c8923", "#f56321", "#00a600"],
                    data: [
                            
                            @foreach( $array_redes as $key => $value )
                                  {label: "{{$key}}", value: {{$value}} },                               
                            @endforeach
                            {label: "Grupos sin red", value: {{$cuenta_sin_redes}} }
                    ],
                    hideHover: 'auto'
                });
                // ESTADISTICAS POR RED FINALIZA AQUI
                //ESTADISTICA POR edades
                var donut = new Morris.Donut({
                    element: 'graf-edades',
                    resize: true,
                    colors: ["#3c8dbc", "#f56954", "#00a65a","#3c8923", "#f56321", "#00a600"],
                    data: [
                         {label: "Bebes", value: {{$bebes}} },
                        {label: "Niños", value: {{$niños}} },
                        {label: "Adolecentes", value: {{$adolecentes}} },
                        {label: "Jovenes", value: {{$jovenes}} },
                        {label: "Jovenes Adultos", value: {{$jovenes_adultos}} },
                        {label: "Adultos", value: {{$adultos}} },
                        {label: "Sin fecha de nacimiento", value: {{$sin_edad}} }                    
                        
                    ],
                    hideHover: 'auto'
                });
                // ESTADISTICAS POR edades FINALIZA AQUI
                
                //ESTADISTICAS POR SEXO
                var donutn = new Morris.Donut({
                    element: 'graf-sexo',
                    resize: true,
                    colors: ["#3c8dbc", "#f7819f"],
                    data: [
                        {label: "Masculino", value: {{$masculinos}}},
                        {label: "Femenino", value: {{$femeninos}}}
                    ],
                    hideHover: 'auto'
                });
                // ESTADISTICAS POR SEXO
                
             // tabla de lineas 
            $('#tabla_grupos_linea').dataTable( {
                         
            });

            //activa (desplega) emnu correspondiente
            $("#menu_lineas").children("a").first().trigger('click');

        });
       </script>

    </body>
</html>
@endif