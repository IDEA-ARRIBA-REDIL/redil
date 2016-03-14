@if(Auth::check())
@include('includes.lenguaje')
<!DOCTYPE html>
<html>
<!-- ULTIMA MODIFICACION HECHA EL 24 DE MARZO DE 2015 POR ADRWIN CASTAÑO 14:34 -->
    <head>
        <meta charset="UTF-8">
        <title>Redil | Listado de Visitas </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        
@include('includes.styles')

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
                              <!-- contendio cabezote -->
                         <section class="content-header">

                                <div class="box box-filtro" >
                                    <div class="box-header" style="height:70px;" >
                                      <div class="pull-right box-tools" >

                                     <!-- columna boton añadir nueva visita -->
                                        <a href="/visitas/nuevo" class="btn btn-danger btn-md"> <i class="fa fa-plus"></i> Crear una nueva visita </a >
                                                
                                        <button data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Imprimir"  onclick="window.print();" ><i class="fa fa-print"></i></button>
                                       <!-- <button data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Enviar por Email"><i class="fa fa-envelope"></i></button> -->
                                        <a href="../reportes-visitas/{{ $tipo }}"  data-toggle="tooltip" title="" class="btn btn-info" data-original-title="por medio de este boton podras crear archivos pdfs con la informacion de tus visitas"><i class="fa fa-file-pdf-o "></i></a>
                                        <button class="btn btn-danger btn-md" data-widget='collapse' data-toggle="tooltip" title="Desplegar Filtros"><i class="fa fa-filter"></i></button>
                                     
                                      </div> 
                                       <h3 class=" content-header" style="font-size:24px">
                                     VISITAS
                                      <small style="font-size:15px; font-weight:300;"> Desde aqui podras verificar y editar todas las visitas que tu grupo tiene programadas. </small>
                                    </h3>
                                 <br><br>
                                                     
                                    </div>
                               <!-- row de cuadro de colores -->

                                  <div class="row"> 
                                      <!-- cuadro dados de baja -->
                                            <div class="col-lg-3 col-md-2 col-xs-6">    
                                                <div class="small-box bg-yellow">
                                                    <div class="inner">
                                                        <h3>
                                                            {{ $total_visitas }}
                                                        </h3>
                                                        <p>
                                                            TODAS LAS VISITAS
                                                        </p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="fa fa-share-alt"></i>
                                                    </div>
                                                    <a href="todas" class="small-box-footer">Ver<i class="fa fa-arrow-circle-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <!-- /cuadro dados de baja -->
                                            

                                        <!-- cuadro todos -->
                                            <div class="col-lg-3 col-md-2 col-xs-6">
                                                    
                                                  <div class="small-box bg-teal">
                                                            <div class="inner">
                                                                <h3>{{$visitas_programadas}}</h3>
                                                                <p>
                                                                    VISITAS PROGRAMADAS
                                                                </p>
                                                            </div>
                                                            <div class="icon">
                                                                <i class=" fa fa-flag-checkered"></i>
                                                            </div>
                                                            <a href="programadas" class="small-box-footer">Ver<i class="fa fa-arrow-circle-right"></i>
                                                            </a>
                                                  </div>
                                             </div>
                                              <!-- /cuadro todos -->
                                              <!-- cuadro dados de alta -->
                                            <div class="col-lg-3 col-md-2 col-xs-6">
                                                        
                                                      <div class="small-box bg-aqua">
                                                                <div class="inner">
                                                                    <h3>{{$fono_visitas}}</h3>
                                                                    <p>
                                                                       FONOVISITAS
                                                                    </p>
                                                                </div>
                                                                <div class="icon">
                                                                    <i class="fa fa-phone-square"></i>
                                                                </div>
                                                                <a href="telefonica" class="small-box-footer">Ver<i class="fa fa-arrow-circle-right"></i>
                                                                </a>
                                                      </div>
                                            </div>
                                                  <!-- /cuadro dados de alta -->
                                                <!-- cuadro sin actividad --> 
                                            <div class="col-lg-3 col-md-2 col-xs-6">
                                              <div class="small-box bg-maroon">
                                                      <div class="inner">
                                                          <h3>
                                                              {{$presencial}}
                                                          </h3>
                                                          <p>
                                                             PRESENCIAL
                                                          </p>
                                                      </div>
                                                  <div class="icon">
                                                          <i class="fa fa-female"></i>
                                                          <i class="fa fa-male"></i>
                                                </div>
                                                      <a href="presencial" class="small-box-footer">Ver<i class="fa fa-arrow-circle-right"></i>
                                                      </a>
                                              </div>
                                            </div><!-- /cuadro sin actividad -->
                                           
                                            <div class="col-lg-3 col-md-2 col-xs-6">
                                              <div class="small-box bg-green">
                                                    <div class="inner">
                                                        <h3>{{$visitas_realizadas}}</h3>
                                                        <p>
                                                            REALIZADAS
                                                        </p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="fa fa-child"></i>
                                                    </div>
                                                    <a href="realizadas" class="small-box-footer">Ver<i class="fa fa-arrow-circle-right"></i>
                                                    </a>
                                              </div>
                                            </div>
                                          <!-- cuadro nuevos -->
                                            <div class="col-lg-3 col-md-2 col-xs-6">
                                              <div class="small-box bg-red">
                                                    <div class="inner" title="corresponden a las visitas que no se hicieron en el ultimo mes">
                                                        <h3>
                                                            {{$visitas_no_realizadas}}
                                                        </h3>
                                                        <p>
                                                            NO REALIZADAS
                                                        </p>
                                                    </div>
                                                <div class="icon">
                                                        <i class="fa  fa-hand-o-down"></i>
                                                </div>
                                                  <a href="no_realizadas" class="small-box-footer">Ver<i class="fa fa-arrow-circle-right"></i>
                                                  </a>
                                              </div>
                                            </div>
                                            <!-- /cuadro nuevos -->
                                  </div>
                                     <!-- /row de cuadro de colores -->
                                </div>
                         </section>
                               <!-- /contendio cabezote -->
                               
                                  <!-- row de la tabla -->
                        <section class="content">
                                  <div class="row">   
                                         <div class="col-lg-12">
                                          <div class="box box-primary"> 
                                              <!-- tabla -->
                                              <div class="panel-body">
                                                <div class="box-body table-responsive">
                                                       
                                                           <!-- /columna boton añadir nueva visita -->
                                     
                                                          <div class="collapse" id="busqueda-avanzada">
                                                            <div class="well">
                                                              Proximamente busqueda detallada ... 
                                                            </div>
                                                          </div>   
                                                          <!-- div de relleno para cuadrar el div de busqueda a lado derecho-->
                                                          <div class="col-md-4">
                                                          </div>
                                                           <!-- fin div de relleno-->
                                                          <!-- div de busqueda-->
                                                          <div class="col-md-8 col-xs-12">
                                                            <form action="/visitas/lista/{{$tipo}}/" method="get" role="form" class="form-inline">
                                                              <div class="input-group">
                                                                  
                                                                  <input type="text" id="buscar" name="buscar" class="form-control" value="{{ Input::get('buscar') }}" placeholder=" Busque aqui ..." >
                                                                  <span class="input-group-btn">
                                                                      @if(isset($buscar))
                                                                      <a class="btn btn-danger" href="/grupos/lista/{{$tipo}}" type="submit"><i class="fa fa-times"></i></a>
                                                                      @endif
                                                                      <button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
                                                                      <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                                       Busqueda avanzada 
                                                                      </button>
                                                                  </span>
                                                                  

                                                              </div>
                                                            </form>
                                                          </div>
                                                          <!-- fin div de busqueda-->
                                                  
                                                  
                                                        <table id="example1" class="table table-striped display " cellspacing="0" width="100%">
                                                              <thead>
                                                                  <tr>
                                                                  	<th>Información Asistente</th>
                                                                      <th> Información de Contacto</th>
                                                                      <th> Información de Visita</th>
                                                                      <th> Programación de Visita</th>
                                                                      <th> Lider Inmediato</th>
                                                                      <th></th>
                                                                </tr>
                                                              </thead>
                                                              <tbody>
                                                                    @foreach ($visitas as $visita)     
                                                                  <tr>
                                                                      
                                                                      <td>
                                                                      	<label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Codigo">Cod</label> {{$visita->asistente_id}}<br>
                                                                          <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Nombre del Grupo"><i class="fa fa-user" style="margin-right:7px;"> </i>Nombre Asistente</label> {{$visita->asistente->nombre}} <br>
                                                                      	 <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Nombre del Grupo"><i class="fa  fa-share-alt" style="margin-right:7px;"> </i>Nombre Grupo</label> {{$visita->asistente->apellido}} <br>
                                                                        <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Nombre del Grupo"><i class="fa  fa-share-alt" style="margin-right:7px;"> </i>Nombre Grupo</label> {{ $asistente= $visita->asistente()->get->();
                                                                                                                                                                                                                                                                             $asistente->grupo->nombre  }} <br>
                                                        
                                                                      </td>

                                                                      <td>
                                                                        <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Telefono"><i class="fa fa-phone"> </i> Teléfono</label>{{$visita->asistente->telefono_movil}} <br>                             
                                                                          <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Direccion"><i class="fa fa-home"> </i> </label>{{$visita->asistente->direccion}}<br>      
                                                                      </td>
                                                                      
                                                                      <td>
                                                                      	<label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Grupo Principal"> Fecha limite Visita</label> {{$visita->fecha_limite}} <br>
                                                                          <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Tipo de Grupo"> Fecha de Visita</label> {{$visita->fecha}} <br>
                                                                      	<label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Lider Grupo">Estado de Visita</label>@if ($visita->estado == 0) {{"Programada"}}
                                                                                                                                                                                                                 @else($visita->estado == 1) {{"Realizada"}} 
                                                                                                                                                                                                                 @if($visita->estado == 2){{"No realizada"}} @endif @endif <br>
                                                                          
                                                                      </td>
                                                                      <td>
                                                                      	<label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Lider Grupo">Tipo de Visita</label> @if ($visita->tipo == 0) {{"Telefonica"}}
                                                                                                                                                                                                                  @else {{"Presencial"}} @endif <br>
                                                                          <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Lider Grupo">Motivo de Visita</label> {{$visita->motivo}}<br>
                                                                			<label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Lider Grupo">Observacion </label> {{$visita->observacion}}<br>
                                                                      <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Lider Grupo">Asignado por </label>

                                                                      @if($visita->asignado_por == 0)
                                                                            Super Administrador

                                                                            @else 
                                                                                  <?php
                                                                                  $usuario=Asistente::find($visita->asignado_por);
                                                                                  ?>  
                                                                                    {{$usuario->nombre}}
                                                                                    {{$usuario->apellido}}
                                                                      @endif
                                                                      </td>

                                                                      <td>
                                                                      	@foreach($visita->asistente->grupo->encargados as $encargado )
                                                                      	<label class="label arrowed-right label-warning" data-toggle="tooltip" data-placement="top" title="Nombre del Grupo"><i class="fa fa-star-o" style="margin-right:7px;"> </i></label> {{$encargado->nombre}}<br>
                                                                     		@endforeach
                                                                      </td>
                                                                  
                                                                      <td>
                                                                      	<div class="btn-group">
                                                                              <button type="button" class="btn btn-success btn-info dropdown-toggle" data-toggle="dropdown">
                                                                                  <i class="fa fa-gear"></i>
                                                                              </button>
                                                                              <ul class="dropdown-menu">
                                                                                  
                                                                                  <li><a href="/visitas/actualizar/{{$visita->id}}">Modificar</a></li>
                                                                                  <li><a href="#">Eliminar</a></li>
                                                                                  
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
                                                              <div class="col-lg-6"> </div>
                                                              @if(!isset($buscar))
                                                              <div class="col-lg-6 text-right" style="padding-right: 30px!important;"> {{ $visitas->links() }}</div>
                                                              @else
                                                              <div class="col-lg-6 text-right" style="padding-right: 30px!important;"> {{ $visitas->appends(array('buscar' => $buscar))->links() }}</div>
                                                              @endif
                                                          </div>
                                                      
                                                  </div>
                                                   
                                                </div>
                                                <!-- /div de 12 columnas -->
                                              </div>
                                  </div>
                                      		<!-- /row de la tabla -->
                        </section>
                              <!-- contenido principal -->
                     </aside>  
                </div>
                      


        
        @include('includes.scripts') 
        <!-- DATA TABES SCRIPT -->
         <script src="{{ Lang::get('general.url-datatables') }}" type="text/javascript"></script>
        <script src="http://cdn.datatables.net/1.10.0/js/jquery.dataTables.js" type="text/javascript"></script>
        <script src="/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
           
        
        
        <!-- page script -->
        <script type="text/javascript">
      
            $(document).ready(function() {
            
              $("#menu_asistente").attr('class', 'treeview active');
              $("#submenu_asistente").attr('style', 'display: block;');
              $("#flecha_asistente").attr('class', 'fa fa-angle-down pull-right');
              
            });
        </script>
  </body>
</html>

@endif