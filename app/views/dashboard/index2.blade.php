@if(Auth::check())
@include('includes.lenguaje')
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Redil </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        @include('includes.styles')
        <!-- fullCalendar -->
        <link href="/css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        
        
        
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
                        <div class="col-lg-6 col-xs-12 col-sm-6 col-md-6">
                            <!-- Datos iglesia -->
                           
                                
                                <div class="panel text-center bg-light-redil">
                                    <div class="panel-body">
                                        <?php $iglesia=Iglesia::find(1); ?>
                                        <img style="border: 16px solid; border-color: rgba(255, 255, 255, 0.2);" src="img/iglesia/{{ $iglesia->logo }}" class="img-circle"  style="height: 200px"/>
                                        
                                        <h2><b>{{ $iglesia->nombre }}</b></h2>
                                        <h4><b>DIRECCIÓN:</b> {{ $iglesia->direccion }}</h4>
                                        <h4><b>TEL: </b>{{ $iglesia->telefono1 }}
                                            @if($iglesia->telefono2!="")
                                                {{ " - ".$iglesia->telefono2 }}
                                            @endif
                                        </h4>
                                        <h4>{{ $iglesia->ciudad." - ".$iglesia->departamento." - ".$iglesia->pais }}</h4>
                                    </div>
                                   
                                </div>
                          
                            <!-- /Datos iglesia -->

                            
                            
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
                        </div>
                        <div class="col-lg-6 col-xs-12 col-sm-6 col-md-6">

                            <!-- Palabra rhema -->
                            <div class="panel bg-green">
                                <div class="panel-body text-center ">
                                  
                                    <i class="fa fa-pagelines fa-5x"></i>
                                    <h2><b>{{ $iglesia->rhema }}</b></h2>
                                    <p>{{$iglesia->texto_rhema }}</p>
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
                            <!-- /Comparte esta herramienta -->
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
          
        


          <!-- page script -->
          <script type="text/javascript">
            $(document).ready(function() {
            <?php $mensaje=Session::get('mensaje_enviado'); ?>
            @if($mensaje!="")
            $("#mensajeIdeaRespuesa").modal("show");
            @endif
                                  
                
            });
          </script> 
    </body>
</html>
@endif