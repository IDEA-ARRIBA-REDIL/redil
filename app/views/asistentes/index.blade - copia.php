@if(Auth::check())
@include('includes.lenguaje')
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    <title>Redil | {{ Lang::get('asistentes.title')}}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    @include('includes.styles')
    <!-- Ionicons -->
    <link href="/css/ionicons.min.css" rel="stylesheet" type="text/css" />
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
            <div class="box-header">
              <div class="pull-right box-tools" >
                <a href="/asistentes/nuevo" class="btn btn-danger btn-md"> <i class="fa fa-plus"></i> {{ Lang::get('asistentes.boton_nuevo')}} </a>
                <button data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Imprimir"  onclick="window.print();" ><i class="fa fa-print"></i></button>
                <!-- <button data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Enviar por Email"><i class="fa fa-envelope"></i></button> -->
                <button data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Generar Archivo PDF"><i class="fa fa-file-pdf-o "></i></button>
                <button class="btn btn-danger btn-md" data-widget='collapse' data-toggle="tooltip" title="Desplegar Filtros"><i class="fa fa-filter"></i></button>
              </div>
              <h3 class=" content-header" style="font-size:24px">
                {{ Lang::get('asistentes.header') }} ( {{ ucwords(str_replace("-", " ", $tipo)) }} ) 
                <small style="font-size:15px; font-weight:300;"> {{ Lang::get('asistentes.subtitulo' )}} </small>
              </h3>                          
            </div>

            <div class="box-body">
              <!-- row de cuadro de colores -->
              <div class="row">
                <!-- cuadro todos -->
                <div class="col-lg-3 col-md-2 col-xs-6" data-toggle="tooltip" data-placement="top" title= "Muestra todos los asistentes excepto a los dados de baja.">
                  <div class="small-box bg-yellow">
                    <div class="inner">
                      <h3>{{ $cantidad_todos }}</h3>
                      <p>
                          {{ ucwords(Lang::choice('asistentes.tipo_asistente', 0)) }}
                      </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-certificate"></i>
                    </div>
                    <a href="todos" class="small-box-footer">Ver<i class="fa fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div>
                <!-- /cuadro todos -->

                <!-- cuadro nuevos -->
                <div class="col-lg-3 col-md-2 col-xs-6" data-toggle="tooltip" data-placement="top" title= "Muestra todos los asistentes que han ingresado en los últimos 30 días.">
                  <div class="small-box bg-teal">
                        <div class="inner">
                            <h3>
                                {{ $cantidad_nuevos }}
                            </h3>
                            <p>
                                {{ ucwords(Lang::choice('asistentes.tipo_asistente', 1)) }}
                            </p>
                        </div>
                    <div class="icon">
                      <i class="fa fa-heart"></i>
                    </div>
                      <a href="nuevos" class="small-box-footer">Ver<i class="fa fa-arrow-circle-right"></i>
                      </a>
                  </div>
                </div>
                <!-- /cuadro nuevos -->
                        
                <!-- Cuadro ovejas -->
                <div class="col-lg-3 col-md-2 col-xs-6" data-toggle="tooltip" data-placement="top" title= "Muestra las ovejas, es decir, las personas que están ubicados en un grupo.">
                  <div class="small-box bg-aqua">
                    <div class="inner">
                      <h3>
                          {{ $cantidad_ovejas }}
                      </h3>
                      <p>
                          {{ ucwords(Lang::choice('asistentes.tipo_asistente', 2)) }}
                      </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-group"></i>
                    </div>
                    <a href="ovejas" class="small-box-footer">Ver<i class="fa fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div>
                <!-- /cuadro ovejas -->
                        
                <!-- cuadro miembros -->
                <div class="col-lg-3 col-md-2 col-xs-6" data-toggle="tooltip" data-placement="top" title= "Muestra los miembros, es decir las personas que han sido bautizados y han ido a encuentro.">
                  <div class="small-box bg-blue">
                    <div class="inner">
                      <h3>{{ $cantidad_miembros }}</h3>
                      <p>
                          {{ ucwords(Lang::choice('asistentes.tipo_asistente', 3)) }}
                      </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-child"></i>
                    </div>
                    <a href="miembros" class="small-box-footer">Ver<i class="fa fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div>
                <!-- /cuadro miembros-->
                        
                <!-- cuadro lideres -->
                <div class="col-lg-3 col-md-2 col-xs-6" data-toggle="tooltip" data-placement="top" title= "Muestra todos los lideres.">
                  <div class="small-box bg-orange">
                    <div class="inner">
                    <h3>{{ $cantidad_lideres }}</h3>
                      <p>
                          {{ ucwords(Lang::choice('asistentes.tipo_asistente', 4)) }}
                      </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-star"></i>
                    </div>
                    <a href="lideres" class="small-box-footer">Ver<i class="fa fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div> 
                <!-- /cuadro lideres -->

                <!-- cuadro pastores -->
                <div class="col-lg-3 col-md-2 col-xs-6" data-toggle="tooltip" data-placement="top" title= "Muestra todos los pastores.">
                  <div class="small-box bg-purple">
                    <div class="inner">
                        <h3>{{ $cantidad_pastores }}</h3>
                        <p>
                            {{ ucwords(Lang::choice('asistentes.tipo_asistente', 5)) }}
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-book"></i>
                    </div>
                    <a href="pastores" class="small-box-footer">Ver<i class="fa fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div>
                <!-- /cuadro pastores -->

                <!-- cuadro sin actividad --> 
                <div class="col-lg-2 col-md-2 col-xs-4" data-toggle="tooltip" data-placement="top" title= "Muestra las personas que desde hace 30 días no asisten a los grupos o a la iglesia. ">
                  <div class="small-box bg-red">
                    <div class="inner">
                      <h3>
                          {{ $cantidad_sin_actividad }}
                      </h3>
                      <p>
                          {{ ucwords(Lang::choice('asistentes.tipo_asistente', 6)) }}
                      </p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-heart-o"></i>
                    </div>
                    <a href="sin-actividad" class="small-box-footer">Ver<i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div><!-- /cuadro sin actividad -->

                <!-- cuadro dados de baja -->
                <div class="col-lg-2 col-md-2 col-xs-4" data-toggle="tooltip" data-placement="top" title= "Muestra los asistentes de toda la iglesia que no poseen un grupo.  ">   
                  <div class="small-box bg-green">
                    <div class="inner">
                      <h3>
                          {{ $cantidad_sin_grupo }}
                      </h3>
                      <p>
                          Sin grupo
                      </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-share-alt"></i>
                    </div>
                    <a href="sin-grupo" class="small-box-footer">Ver<i class="fa fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div>
                <!-- /cuadro dados de baja -->

                <!-- cuadro dados de baja -->
                <div class="col-lg-2 col-md-2 col-xs-4"  data-toggle="tooltip" data-placement="top" title= "Muestra a las personas que por alguna razón ya no asisten a la iglesia. ">    
                  <div class="small-box bg-gray">
                    <div class="inner">
                        <h3>
                            {{ $cantidad_dados_baja }}
                        </h3>
                        <p>
                            {{ ucwords(Lang::choice('asistentes.tipo_asistente', 7)) }}
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-minus-circle"></i>
                    </div>
                    <a href="dados-de-baja" class="small-box-footer">Ver<i class="fa fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div>
                <!-- /cuadro dados de baja -->                           
              </div>
            </div>
          </div>
          <!-- /row de cuadro de colores -->
        </section>
        <!-- /contendio cabezote -->             

        <!-- contenido principal -->
        <section class="content">   
          <!-- row de cuadro de colores -->
            <!-- row de la tabla -->
          <div class="row">   
            <!-- div de 12 columnas -->                     
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="panel-body">
                  <!-- tabla -->
                  <div class="box-body table-responsive">
                    <div class="collapse" id="busqueda-avanzada">
                      <div class="well">
                        Proximamente busqueda detallada ... 
                      </div>
                    </div>                                        
                   
                    <!-- div de busqueda-->
                    <div class="col-md-8 col-xs-12">
                      @if(isset($buscar))
                        @if($buscar!="")
                          @if($cantidad_busqueda == 1)
                            <h4>La busqueda arrojo <b>{{ $cantidad_busqueda }}</b> asistente. </h4>
                          @else
                            <h4>La busqueda arrojo <b>{{ $cantidad_busqueda }}</b> asistentes. </h4>
                          @endif                       
                        @endif
                      @endif
                      <form action="/asistentes/lista/{{$tipo}}/" method="get" role="form" class="form-inline">
                        <div class="input-group">
                          <input type="text" id="buscar" name="buscar" class="form-control" value="{{ Input::get('buscar') }}" placeholder=" Busque aqui ..." >
                          <span class="input-group-btn">
                            @if(isset($buscar))
                                <a class="btn btn-danger" href="/asistentes/lista/{{$tipo}}" type="submit"><i class="fa fa-times"></i></a>
                      
                            @endif 
                            <button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
                            <button class="btn btn-primary hide" type="button" data-toggle="collapse" data-target="#busqueda-avanzada" aria-expanded="false" aria-controls="collapseExample">
                             Busqueda avanzada 
                            </button>
                          </span>
                        </div>
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
                       <h4 ALIGN=right> Página<b>{{ $asistentes->getCurrentPage() }}</b> de <b>{{ $asistentes->getLastPage() }}</b>  </h4> 
                    </div>
                     <!-- fin de paginacion-->
                    
                    <table id="example1" class="table  table-striped display stripe" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th></th>
                        	<th>Información Principal</th>
                          
                          <th class="oculta-celdas">Contacto</th>
                          <th>Información Ministerial</th>
                          <th>Actividad </th>
                          @if ($tipo=="dados-de-baja") <th> Información Dado Bajo </th> @endif
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($asistentes as $asistente)
                        <?php
                        $class="";
                        if($asistente->inactivo_grupo==1 || $asistente->inactivo_iglesia==1)
                        {
                            $class=" inactivo";
                        }
                     ?>
                          <tr>
                            <td class="text-center {{$class}}"> <a href="../perfil/{{ $asistente->id }}"><img src="/img/fotos/{{ $asistente->foto }}" class="img-circle"  width="90px" alt="User Image" /></a>
                            </td>

                            <td class="{{$class}}">
                              <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Codigo">Cod</label> {{ $asistente->id }}<br>
                                
                              @if ($asistente->tipoAsistente['id']==5)
                                <label class="label arrowed-right" style="background-color: purple;" data-toggle="tooltip" data-placement="top" title="{{ $asistente->tipoAsistente['nombre'] }}"> <i class="fa fa-book"></i> {{ $asistente->tipoAsistente['nombre'] }}</label> 
                              @elseif($asistente->tipoAsistente['id']==3)
                                <label class="label arrowed-right bg-blue" data-toggle="tooltip" data-placement="top" title="{{ $asistente->tipoAsistente['nombre'] }}"><i class="fa fa-child"></i> {{ $asistente->tipoAsistente['nombre'] }}</label> 
                              @elseif($asistente->tipoAsistente['id']==4)
                                <label class="label arrowed-right bg-orange" data-toggle="tooltip" data-placement="top" title="{{ $asistente->tipoAsistente['nombre'] }}"><i class="fa fa-star-o"></i> {{ $asistente->tipoAsistente['nombre'] }}</label> 
                              @elseif($asistente->tipoAsistente['id']==2)
                                <label class="label arrowed-right bg-aqua" data-toggle="tooltip" data-placement="top" title="{{ $asistente->tipoAsistente['nombre'] }}"><i class="fa fa-group"></i> {{ $asistente->tipoAsistente['nombre'] }}</label> 
                              @elseif($asistente->tipoAsistente['id']==1)
                                <label class="label arrowed-right bg-teal" data-toggle="tooltip" data-placement="top" title="{{ $asistente->tipoAsistente['nombre'] }}"><i class="fa fa-heart"></i> {{ $asistente->tipoAsistente['nombre'] }}</label> 
                              @endif 

                              <a href="../perfil/{{ $asistente->id }}">{{ $asistente->nombre." ".$asistente->apellido }}</a><br>
                              <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Id">Id</label> {{ $asistente->identificacion }}<br>                                           
                              <!--@if( $asistente->genero==0 )
                                <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Sexo"> Sexo </label> Hombre
                              @else  
                                <label class="label arrowed-right" style="background-color: pink;" data-toggle="tooltip" data-placement="top" title="Sexo"> Sexo </label> Mujer
                              @endif

                              <?php //@if($asistente->genero!=""){{ Lang::choice('asistentes.genero', $asistente->genero) }}@endif ?>
                              <br> 
                              <?php 
                                if($asistente->fecha_nacimiento == "")
                                {
                                  $edad="Sin dato";  
                                }else{
                                  $fecha_naci=date_create($asistente->fecha_nacimiento);
                                  $fecha_naci=date_format($fecha_naci, 'Y-m-j') ; 
                                  list($Y,$m,$d) = explode("-",$fecha_naci);
                                  $edad=( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
                                }                              
                              ?>
                              <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Edad"> Edad</label> {{ $edad }} <br>      
                              <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Estado civil"> Estado Civil</label> @if($asistente->estado_civil!="" && $asistente->estado_civil!=0){{ Lang::choice('asistentes.estado_civil', $asistente->estado_civil) }}@endif<br> -->
                            </td> 

                            <td class="oculta-celdas {{$class}}">
                              <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Telefono fijo"><i class="fa fa-phone"></i></label> {{ $asistente->telefono_fijo }}<br>
                              <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Celular"> <i class="fa fa-mobile-phone"></i></label> {{ $asistente->telefono_movil }}<br>
                              <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="E-mail">@</label> 
                              {{ $asistente->user['email'] }}<br>                      
                              <!--<label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Direccion"> <i class="fa fa-home"></i></label> {{ $asistente->direccion }}<br>   -->                            
                            </td>
                              
                            <td class="{{$class}}">

                               <?php $grupo= $asistente->grupo; ?>
                              @if($grupo!="")
                              <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Grupo inmediato"><i class="fa fa-share-alt"></i> </label>
                                {{ $asistente->grupo['nombre'] }}<br>

                              @foreach($grupo->encargados as $encargado)
                              @if ($encargado->tipoAsistente['id']==5)
                                <label class="label arrowed-right bg-purple" data-toggle="tooltip" data-placement="top" title="{{ $encargado->tipoAsistente['nombre'] }}"><i class="fa fa-book" style="margin-right:15 px;"> </i></label> 
                              @elseif($encargado->tipoAsistente['id']==4)
                                <label class="label arrowed-right bg-orange" data-toggle="tooltip" data-placement="top" title="{{ $encargado->tipoAsistente['nombre'] }}"><i class="fa fa-star" style="margin-right:15 px;"> </i></label> 
                              @endif
                              {{ $encargado['nombre']." ".$encargado['apellido']}}.<br>
                              @endforeach

                              <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Linea">Linea</label> {{ $asistente->linea['nombre'] }}<br>
                              @endif                                
                            </td>
                            <td class="{{$class}}"> 

                              @if($asistente->inactivo_grupo==1)
                              <span class="badge bg-red">Inactivo Grupo</span>
                              @else
                              <span class="badge bg-aqua">Activo Grupo</span>
                              @endif
                              <br>
                              @if($asistente->inactivo_iglesia==1)
                              <span class="badge bg-red">Inactivo Iglesia</span>
                              @else
                              <span class="badge bg-aqua">Activo Iglesia</span>
                              @endif

                            </td>

                            @if ($tipo=="dados-de-baja")
                            <?php $reporte= ReporteBajaAlta::where( 'asistente_id', '=', $asistente->id)
                                            ->orderBy('id', 'desc')
                                            ->first() ?>  
                              <td class="{{$class}}">
                                <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Fecha de la ultima dada de baja"> Fecha de la baja:</label> {{ $reporte->fecha }} <br> 
                                <p>  <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Motivo de la baja"> Motivo:</label> {{ $reporte->motivo }}</p> 
                              </td>
                            @endif
                              
                            <td class="{{$class}}">
                              <div class="btn-group">
                                <button type="button" class="btn btn-success btn-info dropdown-toggle" data-toggle="dropdown">
                                  Opciones  
                                  <i class="fa fa-caret-down"> </i>
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a href="../perfil/{{ $asistente->id }}">Ver perfil</a></li>                                

                                  @if($asistente->dado_baja==0)
                                    <li><a href="../actualizar/{{$asistente->id}}">Modificar</a></li>  
                                    <li><a href="../dado-baja-alta/{{ $asistente->id }}">Dar de baja</a></li>
                                    @if(Auth::user()->id==1)
                                    <li><a href="/usuarios/actualizar-password-usuario/{{$asistente->id}}">Cambiar contraseña</a></li>
                                    @endif
                                  @else
                                    <li><a href="../dado-baja-alta/{{ $asistente->id }}">Dar de alta</a></li>
                                  @endif
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
                </div> <!-- /panel body -->
                <div class="box-footer">
                  <div class="row">
                    <div class="col-lg-4"> 
                      <h4> <b>{{ $asistentes->getFrom() }}</b> - <b>{{ $asistentes->getTo() }}</b> de <b>{{ $asistentes->getTotal() }} </b> registros.</h4> 
                    </div>
                    @if(!isset($buscar))
                      <div class="col-lg-8 text-right" style="padding-right: 30px!important;"> {{ $asistentes->links() }}</div>
                    @else
                      <div class="col-lg-8 text-right" style="padding-right: 30px!important;"> {{ $asistentes->appends(array('buscar' => $buscar))->links() }}</div>
                    @endif
                    
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
        
      <!-- DATA TABES SCRIPT -->
      <script src="{{ Lang::get('general.url-datatables') }}" type="text/javascript"></script>
      <script src="/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        
      <!-- page script -->
      <script type="text/javascript">

          $(document).ready(function() {
            $("#menu_asistente").attr('class', 'treeview active');
            $("#submenu_asistente").attr('style', 'display: block;');
            $("#flecha_asistente").attr('class', 'fa fa-angle-down pull-right');



		      });
      </script>
  @endif
  </body>
</html>