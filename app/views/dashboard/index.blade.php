@if(Auth::check())
@include('includes.lenguaje')
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Redil </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        @include('includes.styles')
        
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
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
       
            @include('includes.header')
        
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">                
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    
                    
                    @include('includes.menu')
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                
                <!-- Main content -->
                <section class="content" style="margin-top:10px;">
                    <div class="row">
                        <!--
                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
                            <div class="box box-header box-widget widget-user">
                                <div class="box-tools">
                                    <button class="btn btn-box-tool text-white" data-toggle="tooltip" title="Mark as read"><i class="fa fa-circle-o"></i></button>
                                    <button class="btn btn-box-tool text-white" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button class="btn btn-box-tool text-white" data-widget="remove"><i class="fa fa-times"></i></button>
                                  </div>                                <div class="widget-user-header bg-aqua-active">
                                  <h3 class="widget-user-username">Alexander Pierce</h3>
                                  <h5 class="widget-user-desc">Founder &amp; CEO</h5>
                                </div>
                                <div class="widget-user-image">
                                  <img class="img-circle" src="/img/fotos/asistente-8.jpg" alt="User Avatar">
                                </div>
                                <div class="box-footer">
                                  <div class="row">
                                    <div class="col-sm-4 border-right">
                                      <div class="description-block">
                                        <h5 class="description-header">3,200</h5>
                                        <span class="description-text">SALES</span>
                                      </div>
                                    </div>
                                    <div class="col-sm-4 border-right">
                                      <div class="description-block">
                                        <h5 class="description-header">13,000</h5>
                                        <span class="description-text">FOLLOWERS</span>
                                      </div>
                                    </div>
                                    <div class="col-sm-4">
                                      <div class="description-block">
                                        <h5 class="description-header">35</h5>
                                        <span class="description-text">PRODUCTS</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </div>-->
                        <?php $iglesia=Iglesia::find(1); ?>


                        <div class="col-lg-8 col-xs-12 col-sm-7 col-md-7">
                            <!-- Datos iglesia -->
                           
                                
                                <div class="panel text-center bg-light-redil">
                                    <div class="panel-body">
                                      <div class="col-lg-3 col-md-5 col-sm-5 col-xs-4">
                                        <img style="border: 16px solid; border-color: rgba(255, 255, 255, 0.2);" src="img/iglesia/{{ $iglesia->logo }}" class="img-circle logo-inicio" />
                                      </div>
                                      <div class="col-lg-9 col-md-7 col-sm-7 col-xs-8">
                                        <h2><b>{{ $iglesia->nombre }}</b></h2>
                                        <p class="no-moviles no-margin"><i>{{$iglesia->texto_rhema }}</i></p>
                                        <h4 class="no-moviles no-margin"><b><i>{{ $iglesia->rhema }}</i></b></h4>
                                      </div>
                                    </div>
                                   
                                </div>
                          
                            <!-- /Datos iglesia -->
                            @if(Auth::user()->id!=1)
                              @foreach(Auth::user()->asistente->grupos as $grupo)
                              <!-- Estadistica de crecimiento  -->
                              <div class="box box-danger">

                                  <div class="box-header">
                                      <h3 class="box-title"><span class="badge bg-red">  <i class="fa fa-bar-chart-o fa-2x"></i> </span> Celula {{ $grupo->id." - ".$grupo->nombre }}: Integrantes / Promedio asistencia <small>Ultimos 6 meses</small></h3>
                                      <div class="pull-right box-tools">
                                          <button class="btn btn-info btn-sm " data-toggle="tooltip" title="" data-original-title="Esta grafica muestra un comparativo de la cantidad de integrantes del grupo versus el promedio de asistencia en los últimos 6 meses"><i class="fa fa-info"></i></button>  
                                      </div>

                                  </div>
                                  <div class="box-body chart-responsive">
                                      <div class="chart" id="bar-chart-{{ $grupo->id }}" style="height: 180px;"></div>

                                  </div><!-- /.box-body -->
                              </div><!-- /.box -->
                              <!-- /Estadistica de crecimiento  -->
                              @endforeach
                            @endif

                            
                            
                            <!-- Metas -->
                            <div class="no-moviles panel bg-red">
                                <div class="panel-body text-center  ">
                                  
                                    <i class="fa fa-check-square fa-5x"></i>
                                    <h2><b>Metas {{date ("Y")}}</b></h2>
                                    <p> {{$iglesia->metas}}
                                    </p>
                                </div>
                            </div>
                            <!-- /Metas--> 
                        </div>
                        
                        
                        <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12">
                          @if(Auth::user()->id==1 && ReporteGrupo::where('aprobado', 'FALSE')->count()>0)                            
                            <div class="info-box">
                              <a href="/reporte-grupos/lista/no-aprobados" >
                                  <span class="info-box-icon bg-yellow"><i class="fa fa-exclamation-triangle"></i></span>

                                  <div class="info-box-content">
                                      <span class="info-box-number">¡Nuevos reportes de grupo!</span>
                                    <span class="info-box-text">Tienes {{ ReporteGrupo::where('aprobado', 'FALSE')->count() }} reporte(s) de grupo para aprobar.
                                      <br>
                                    </span>
                                    
                                  </div>
                              </a>
                              <!-- /.info-box-content -->
                            </div>
                          @endif

                          @foreach($ultimos_reportes as $ultimo_reporte)
                          <?php $fecha_reporte=strtotime(Helper::sumaDiasFecha(date($ultimo_reporte['fecha']), '+8'));
                          $fecha_actual=strtotime(date("d-m-Y H:i:00",time()));?>
                              @if($fecha_reporte>$fecha_actual)
                                  
                                <div class="info-box">
                                  <a href="/reporte-grupos/lista" >
                                      <span class="info-box-icon bg-green"><i class="fa fa-check-circle"></i></span>

                                      <div class="info-box-content">
                                          <span class="info-box-number">¡Felicitaciones!</span>
                                        <span class="info-box-text">Tu grupo {{ $ultimo_reporte['grupo']['id'] }} {{ $ultimo_reporte['grupo']['nombre'] }}, está al día! 
                                          <br>
                                        </span>
                                        
                                      </div>
                                  </a>
                                  <!-- /.info-box-content -->
                                </div>
                                  
                              @else                                  
                                <div class="info-box">
                                  <a href="/reporte-grupos/nuevo/{{ $ultimo_reporte['grupo_id'] }}" >
                                      <span class="info-box-icon bg-yellow"><i class="fa fa-exclamation-triangle"></i></span>

                                      <div class="info-box-content">
                                          <span class="info-box-number">¡Necesitas ponerte al día!</span>
                                        <span class="info-box-text">Tu grupo {{ $ultimo_reporte['grupo']['id'] }} {{ $ultimo_reporte['grupo']['nombre'] }}, debió ser reportado hace {{Helper::transcurrido($fecha_reporte)}}.
                                          <br>
                                        </span>
                                        
                                      </div>
                                  </a>
                                  <!-- /.info-box-content -->
                                </div>
                              @endif
                          @endforeach

                          @if($inactivos_grupo>0)
                            <div class="info-box">
                              <a href="/asistentes/lista/sin-actividad-grupo">
                                <span class="info-box-icon bg-red"><i class="fa fa-user-times"></i></span>

                                <div class="info-box-content">
                                  <span class="info-box-number">¡Cuidado! {{ $inactivos_grupo }} asistentes</span>
                                  <span class="info-box-text">no han vuelto a un grupo</span>
                                  
                                  <div class="progress">
                                    <div class="progress-bar bg-red" style="width: {{ $inactivos_grupo_porcentaje }}%"></div>
                                  </div>
                                      <span class="progress-description">
                                        {{ $inactivos_grupo_porcentaje }}% de tu ministerio.
                                      </span>
                                </div>
                              </a>
                              <!-- /.info-box-content -->
                            </div>
                          @endif

                          @if($inactivos_culto>0)
                            <div class="info-box">
                              <a href="/asistentes/lista/sin-actividad-culto">
                                <span class="info-box-icon bg-red"><i class="fa fa-bank"></i></span>

                                <div class="info-box-content">
                                  <span class="info-box-number">¡Cuidado! {{ $inactivos_culto }} asistentes</span>
                                  <span class="info-box-text">no han vuelto a culto</span>
                                  
                                  <div class="progress">
                                    <div class="progress-bar bg-red" style="width: {{ $inactivos_culto_porcentaje }}%"></div>
                                  </div>
                                      <span class="progress-description">
                                        {{ $inactivos_culto_porcentaje }}% de tu ministerio.
                                      </span>
                                </div>
                              </a>
                              <!-- /.info-box-content -->
                            </div>
                          @endif

                          @if($grupos_inactivos>0)
                            <div class="info-box">
                              <a href="/grupos/lista/sin-actividad">
                                <span class="info-box-icon bg-red"><i class="fa fa-share-alt"></i></span>

                                <div class="info-box-content">
                                  <span class="info-box-number">¡Cuidado! {{ $grupos_inactivos }} grupos</span>
                                  <span class="info-box-text">no se han vuelto a reportar</span>
                                  
                                  <div class="progress">
                                    <div class="progress-bar bg-red" style="width: {{ $grupos_inactivos_porcentaje }}%"></div>
                                  </div>
                                      <span class="progress-description">
                                        {{ $grupos_inactivos_porcentaje }}% de tus grupos.
                                      </span>
                                </div>
                              </a>
                              <!-- /.info-box-content -->
                            </div>
                          @endif
                            
                            @if($ultimos_asistentes->count()>0)
                              <!-- USERS LIST -->
                              <div class="box box-danger">
                                <div class="box-header with-border">
                                  <h3 class="box-title">Ultimos Asistentes</h3>

                                  <div class="box-tools pull-right">
                                    <span class="label label-danger">{{$ultimos_asistentes->count()}} Nuevos Asistentes</span>

                                  </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body no-padding">
                                  <ul class="users-list clearfix">
                                    @foreach($ultimos_asistentes->get() as $ultimo_asistente)
                                    <li>
                                        <a class="users-list-name" href="/asistentes/perfil/{{ $ultimo_asistente->id }}">
                                            <img src="/img/fotos/{{ $ultimo_asistente->foto }}" alt="User Image">
                                        </a>
                                        <a class="users-list-name" href="/asistentes/perfil/{{ $ultimo_asistente->id }}">{{ $ultimo_asistente->nombre.' '.$ultimo_asistente->apellido }}</a>
                                        <span class="users-list-date">{{ Helper::transcurrido(strtotime($ultimo_asistente->created_at)); }}</span>
                                    </li>
                                    @endforeach
                                  </ul>
                                  <!-- /.users-list -->
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer text-center">
                                  <a href="/asistentes/nuevos" class="uppercase">Ver todos los asistentes</a>
                                </div>
                                <!-- /.box-footer -->
                              </div>
                              <!--/.box -->
                            @endif

                            <!-- Palabra rhema -->
                            <div class="solo-moviles panel bg-green">
                                <div class="panel-body text-center ">
                                    <div class="col-lg-2 no-padding" style="margin-top: 7%;">
                                        <i class="fa fa-pagelines fa-4x"></i>
                                    </div>
                                    <div class="col-lg-10 no-padding">
                                        <h3><b>{{ $iglesia->rhema }}</b></h3>
                                        <p>{{$iglesia->texto_rhema }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- /Palabra rhema --> 

                            <!-- Tienes una idea -->
                            <div class="panel bg-yellow ">
                                <div class="panel-body text-center ">
                                      <i class="fa fa-lightbulb-o fa-5x"></i>
                                      <h2><b>¿Tienes una idea?</b></h2>
                                      <p>Haznos llegar tus fantásticas ideas y opiniones para hacer de REDIL una herramienta mas precisa a tus necesidades, queremos mejorar cada día.</p>
                                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#mensajeIdea"><h4><i class="fa fa-envelope"></i> Enviar sugerencia</h4></button>
                                     
                                </div>
                            </div>
                            <!-- /Tienes una idea -->

                            <!-- Comparte esta herramienta -->
                            <div class="panel bg-light-redil ">
                                <div class="panel-body text-center">
                                      <i class="fa fa-paper-plane fa-5x"></i>
                                      <h2><b></b></h2>
                                      <p>Comparte y ayudanos a que otros conozcan REDIL.</p>

                                      <button class="btn btn-danger"> <h4><i class="fa fa-facebook fa-2x"></i></h4></button>
                                      <button class="btn btn-danger"> <h4><i class="fa fa-twitter fa-2x"></i></h4></button>
                                      <button class="btn btn-danger"> <h4><i class="fa fa-instagram fa-2x"></i></h4></button>
                                </div>
                            </div>
                        </div>

                        <div class="solo-moviles col-lg-8 col-xs-12 col-sm-7 col-md-7">
                            
                            <!-- Metas -->
                            <div class="panel bg-red">
                                <div class="panel-body text-center  ">
                                  
                                    <i class="fa fa-check-square fa-5x"></i>
                                    <h2><b>Metas {{date ("Y")}}</b></h2>
                                    <p> {{$iglesia->metas}}
                                    </p>
                                </div>
                            </div>
                            <!-- /Metas--> 

                            <!-- Datos iglesia -->
                                <div class="panel text-center bg-light-redil">
                                    <div class="panel-body">
                                        <h4><b>{{ $iglesia->nombre }}</b></h4>
                                        <p class="no-margin"><b>DIRECCIÓN:</b> {{ $iglesia->direccion }} - <b>TEL: </b>{{ $iglesia->telefono1 }}
                                            @if($iglesia->telefono2!="")
                                                {{ " - ".$iglesia->telefono2 }}
                                            @endif
                                        </p class="no-margin">
                                        <p class="no-margin">{{ $iglesia->ciudad." - ".$iglesia->departamento." - ".$iglesia->pais }}</p class="no-margin">
                                    </div>
                                   
                                </div>
                          
                            <!-- /Datos iglesia -->

                        </div>
                        <?php /* 
                        
                            <!-- Calendario de eventos  -->
                            <div class="panel box-danger">
                                <div class="box-header">
                                    <i class="fa fa-calendar"></i>
                                    <div class="box-title">CALENDARIO DE EVENTOS</div>
                                    
                                    <!--  -->
                                    <div class="pull-right box-tools">
                                        <!-- button with a dropdown -->
                                        <div class="btn-group">
                                            <button class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                                            <ul class="dropdown-menu pull-right" role="menu">
                                                <li><a href="#">Añadir nuevo evento</a></li>
                                                
                                            </ul>
                                        </div>
                                    </div><!-- /. tools -->                                    
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                   
                                    <div id="calendar"></div>
                                </div>
                            </div>
                            <!-- /Calendario de eventos  -->


                            <!-- Preguntas frecuentes y ayudas -->
                            <div class="box ">
                                <div class="panel-heading text-center bg-redil" >
                                    
                                </div>
                                <div class="panel-body text-center bg-redil">
                                    <i class="fa fa-question fa-5x"></i>
                                    <h2><b>Preguntas frecuentes y ayudas</b></h2>
                                    <br>

                                    <section class="sidebar text-left">
                                        <ul class="sidebar-menu">

                                            <li class="treeview bg-black">
                                                <a href="#">
                                                    <i class="fa fa-info"></i>
                                                    <span>¿Como crear...? </span> 
                                                    <i class="fa fa-angle-left pull-right"></i>
                                                </a>
                                                <ul class="treeview-menu">
                                                    <li><a><i class="fa fa-file"></i> Nuevo asistente </a></li>
                                                    <li><a><i class="fa fa-file"></i> Nuevo grupo</a></li>
                                                    <li><a><i class="fa fa-file"></i> Nueva linea</a></li>
                                                    <li><a><i class="fa fa-file"></i> Nuevo reporte de reunión</a></li>
                                                </ul>
                                            </li>

                                            <li class="treeview bg-black">
                                                <a href="#">
                                                    <i class="fa fa-info"></i>
                                                    <span>Glosario de terminos </span> 
                                                    <i class=""></i>
                                                </a>
                                                
                                            </li>

                                             <li class="treeview bg-black">
                                                <a href="#">
                                                    <i class="fa fa-info"></i>
                                                    <span>¿Como crear...? </span> 
                                                    <i class="fa fa-angle-left pull-right"></i>
                                                </a>
                                                <ul class="treeview-menu">
                                                    <li><a><i class="fa fa-file"></i> Nuevo asistente </a></li>
                                                    <li><a><i class="fa fa-file"></i> Nuevo grupo</a></li>
                                                    <li><a><i class="fa fa-file"></i> Nueva linea</a></li>
                                                    <li><a><i class="fa fa-file"></i> Nuevo reporte de reunión</a></li>
                                                </ul>
                                            </li>

                                            <li class="treeview bg-black">
                                                <a href="#">
                                                    <i class="fa fa-info"></i>
                                                    <span>Glosario de terminos </span> 
                                                    <i class=""></i>
                                                </a>
                                                
                                            </li>

                                             <li class="treeview bg-black">
                                                <a href="#">
                                                    <i class="fa fa-info"></i>
                                                    <span>¿Como crear...? </span> 
                                                    <i class="fa fa-angle-left pull-right"></i>
                                                </a>
                                                <ul class="treeview-menu">
                                                    <li><a><i class="fa fa-file"></i> Nuevo asistente </a></li>
                                                    <li><a><i class="fa fa-file"></i> Nuevo grupo</a></li>
                                                    <li><a><i class="fa fa-file"></i> Nueva linea</a></li>
                                                    <li><a><i class="fa fa-file"></i> Nuevo reporte de reunión</a></li>
                                                </ul>
                                            </li>

                                            <li class="treeview bg-black">
                                                <a href="#">
                                                    <i class="fa fa-info"></i>
                                                    <span>Glosario de terminos </span> 
                                                    <i class=""></i>
                                                </a>
                                                
                                            </li>
                                            <li class="treeview bg-black">
                                                <a href="#">
                                                    <i class="fa fa-info"></i>
                                                    <span>¿Como crear...? </span> 
                                                    <i class="fa fa-angle-left pull-right"></i>
                                                </a>
                                                <ul class="treeview-menu">
                                                    <li><a><i class="fa fa-file"></i> Nuevo asistente </a></li>
                                                    <li><a><i class="fa fa-file"></i> Nuevo grupo</a></li>
                                                    <li><a><i class="fa fa-file"></i> Nueva linea</a></li>
                                                    <li><a><i class="fa fa-file"></i> Nuevo reporte de reunión</a></li>
                                                </ul>
                                            </li>

                                            <li class="treeview bg-black">
                                                <a href="#">
                                                    <i class="fa fa-info"></i>
                                                    <span>Glosario de terminos </span> 
                                                    <i class=""></i>
                                                </a>
                                                
                                            </li>
                                        </ul> 
                                    </section> 
                                </div>
                            
                            <!-- /Preguntas frecuentes y ayudas -->

                        */
                        ?>
                        </div>
                    
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        <!-- ./wrapper -->

        <div class="modal fade" id="mensajeIdea" name="mensajeIdea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <form action="/cuentanos-tu-idea/" method="get" role="form" class="">
                <div class="modal-content">
                    <div class="modal-header bg-yellow">
                        <button type="button" class="close btn-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <center>
                            <h2><i class="fa fa-lightbulb-o fa-5x"></i> </h2>
                            <h2> <b>¿Tienes una idea?</b></h2>
                        </center>                 
                    </div>
                    <div class="modal-body">                    
                        <div class="form-group">
                            <label for="message-text"class="control-label"> Cuentanos tu maravillosa idea:</label>
                            <textarea class="form-control"  rows="6"  id="mensaje" name="mensaje"></textarea>
                        </div>                   
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i class="fa fa-envelope"></i> Enviar </h4></button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancelar </button>
                    </div>               
                </div>
            </form>
          </div>
        </div>

        <div class="modal fade" id="mensajeIdeaRespuesa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-yellow">
                    <button type="button" class="close btn-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <center>
                        <h2><i class="fa fa-lightbulb-o fa-5x"></i> </h2>
                        <h3> La idea ya ha sido envida, muchas gracias. </h3>
                    </center>                 
                </div>                            
            </div>
          </div>
        </div>


       
         
        <!-- jQuery 2.0.2 -->
        <script src="/js/jquery-2.1.1.js"  type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="/js/AdminLTE/app.js" type="text/javascript"></script>
        <script src="/js/raphael-min.js"></script>
        <script src="/js/plugins/morris/morris.min.js" type="text/javascript"></script>
        


          <!-- page script -->
          <script type="text/javascript">
            $(document).ready(function() {
            <?php $mensaje=Session::get('mensaje_enviado'); ?>
            @if($mensaje!="")
            $("#mensajeIdeaRespuesa").modal("show");
            @endif

            @if(Auth::user()->id!=1)
              @foreach(Auth::user()->asistente->grupos as $grupo)
                <?php $mes_actual = date('Y-m'); // Me trae la fecha actual de sistema?>
                var meses = new Array ("", "Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov", "Dic");
                var bar = new Morris.Bar({
                  element: 'bar-chart-{{ $grupo->id }}',
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
              @endforeach
            @endif
                
            });
          </script> 
    </body>
</html>
@endif