@if(Auth::check())
@include('includes.lenguaje')
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    <title>{{Lang::get('asistentes.na_title_pagina')}} | {{ Lang::get('asistentes.title')}}</title>
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
            <div class="box-header">
              <div class="pull-right box-tools" >
                <a href="/asistentes/nuevo" class="btn btn-danger btn-md"> <i class="fa fa-plus"></i> {{ Lang::get('asistentes.boton_nuevo')}} </a>
                <button data-toggle="tooltip" title="" class="btn btn-info" data-original-title="{{Lang::get('asistentes.texto_simple_title_imprimir')}}"  onclick="window.print();" ><i class="fa fa-print"></i></button>
                <!-- <button data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Enviar por Email"><i class="fa fa-envelope"></i></button> -->
                <button data-toggle="tooltip" title="" class="btn btn-info" data-original-title="{{Lang::get('asistentes.texto_simple_title_PDF')}}"><i class="fa fa-file-pdf-o "></i></button>
                <!--<button class="btn btn-danger btn-md" data-widget='collapse' data-toggle="tooltip" title="Desplegar Filtros"><i class="fa fa-filter"></i></button> -->
              </div>
              <h3 class=" content-header" style="font-size:24px">
                {{ Lang::get('asistentes.header') }} ({{ ucwords(str_replace("-", " ", $tipo)) }}) 
                <small style="font-size:15px; font-weight:300;"> {{ Lang::get('asistentes.subtitulo' )}} </small>
              </h3>                          
            </div>           
          <!-- /row de cuadro de colores -->
        </section>
        <!-- /contendio cabezote -->  

        <!-- columna de mensaje -->
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"style="margin-bottom: 10px;">
              <div class=" box-header">
                <?php 
                  $mensaje=Session::get('mensaje'); 
                ?>
                @if($mensaje == 'de_baja') 
                <?php 
                  $nombre=Session::get('nombre_dado_baja'); 
                  $apellido=Session::get('apellido_dado_baja'); 
                ?>
                  <div class="alert alert-success col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom:5px; padding-top:5px;" >
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{Lang::get('asistentes.texto_mensaje_dado_baja', array('nombre'=>$nombre, 'apellido' =>$apellido)) }} 
                  </div>
                @endif

                @if($mensaje == 'eliminar') 
                <?php 
                  $nombre=Session::get('nombre_dado_baja'); 
                  $apellido=Session::get('apellido_dado_baja'); 
                ?>
                  <div class="alert alert-success col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom:5px; padding-top:5px;" >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Lang::get('asistentes.texto_eliminado_asistente', array('$nombre'=>$nombre, 'apellido'=>$apellido)) }}
                </div>
                @endif
              </div>
          </div>
        <!-- /columna de mensaje -->           

        <!-- contenido principal -->
        <section class="content">   

          <!-- row de cuadro de colores -->
              <div class="row-fluid">
                <!-- cuadro todos -->
                <div class="col-lg-2 col-md-2 col-xs-4 col-sm-2 contador" data-toggle="tooltip" data-placement="top" title= "{{Lang::get('asistentes.texto_simple_title_filtro_todos')}}">
                  <div class="small-box bg-yellow">
                    <div class="inner">
                      <h3>{{ $cantidad_todos }}</h3>
                      <p>
                          {{ ucwords(Lang::choice('asistentes.tipo_asistente', 0)) }} <small style="display: initial;">{{Lang::get('asistentes.texto_filtro_todos_asistentes')}}</small>
                      </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-certificate"></i>
                    </div>
                    <a href="/asistentes/lista/todos" class="small-box-footer">{{Lang::get('asistentes.texto_ver_filtros')}}<i class="fa fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div>
                <!-- /cuadro todos -->
                
                <!-- cuadro nuevos -->
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 contador" data-toggle="tooltip" data-placement="top" title= "{{Lang::get('asistentes.texto_simple_title_filtro_nuevos')}}">
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
                      <a href="/asistentes/lista/nuevos" class="small-box-footer">{{Lang::get('asistentes.texto_ver_filtros')}}<i class="fa fa-arrow-circle-right"></i>
                      </a>
                  </div>
                </div>
                <!-- /cuadro nuevos -->
                        
                <!-- Cuadro ovejas -->
                <div class="col-lg-2 col-md-2 col-xs-4 col-sm-2 contador" data-toggle="tooltip" data-placement="top" title= "{{Lang::get('asistentes.texto_simple_title_filtro_ovejas')}}">
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
                    <a href="/asistentes/lista/ovejas" class="small-box-footer">{{Lang::get('asistentes.texto_ver_filtros')}}


                      <i class="fa fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div>
                <!-- /cuadro ovejas -->
                        
                <!-- cuadro miembros -->
                <div class="col-lg-2 col-md-2 col-xs-4 col-sm-2 contador" data-toggle="tooltip" data-placement="top" title= "{{Lang::get('asistentes.texto_simple_title_filtro_miembro')}}">
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
                    <a href="/asistentes/lista/miembros" class="small-box-footer">{{Lang::get('asistentes.texto_ver_filtros')}}


                      <i class="fa fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div>
                <!-- /cuadro miembros-->
                        
                <!-- cuadro lideres -->
                <div class="col-lg-2 col-md-2 col-xs-4 col-sm-2 contador" data-toggle="tooltip" data-placement="top" title= "{{Lang::get('asistentes.texto_simple_title_filtro_lideres')}}">
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
                    <a href="/asistentes/lista/lideres" class="small-box-footer">{{Lang::get('asistentes.texto_ver_filtros')}}


                      <i class="fa fa-arrow-circle-right"></i>
                    </a>
                  </div>
              <!-- fin cuadrp lideres -->
            </div> 
              
                
                <!-- cuadro pastores -->
                <div class="col-lg-2 col-md-2 col-xs-4 col-sm-2 contador" data-toggle="tooltip" data-placement="top" title= "{{Lang::get('asistentes.texto_simple_title_filtro_pastores')}}.">
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
                    <a href="/asistentes/lista/pastores" class="small-box-footer">{{Lang::get('asistentes.texto_ver_filtros')}}


                      <i class="fa fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div>
                <!-- /cuadro pastores -->

                <!-- cuadro sin actividad --> 
                <div class="col-lg-2 col-md-2 col-xs-4 col-sm-2 contador" data-toggle="tooltip" data-placement="top" title= "{{Lang::get('asistentes.texto_simple_title_filtro_inactivo_iglesia')}} ">
                  <div class="small-box bg-red">
                    <div class="inner">
                      <h3>
                          {{ $cantidad_sin_actividad_culto }}
                      </h3>
                      <p>
                        <span class="capitalize">
                          {{Lang::get('asistentes.texto_inactivos_culto_asistentes')}}
                        </span>
                      </p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-bank"></i>
                    </div>
                    <a href="/asistentes/lista/sin-actividad-culto" class="small-box-footer">{{Lang::get('asistentes.texto_ver_filtros')}}


                      <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div><!-- /cuadro sin actividad -->

                <!-- cuadro sin actividad --> 
                <div class="col-lg-2 col-md-2 col-xs-4 col-sm-2 contador" data-toggle="tooltip" data-placement="top" title= "{{Lang::get('asistentes.texto_simple_title_filtro_inactivo_grupo')}}">
                  <div class="small-box bg-red">
                    <div class="inner">
                      <h3>
                          {{ $cantidad_sin_actividad_grupo }}
                      </h3>
                      <p>
                        <span class="capitalize">
                         {{Lang::get('asistentes.texto_inactivos_grupo_asistentes')}}
                       </span>
                      </p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-user-times"></i>
                    </div>
                    <a href="/asistentes/lista/sin-actividad-grupo" class="small-box-footer">{{Lang::get('asistentes.texto_ver_filtros')}}


                      <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div><!-- /cuadro sin actividad -->

                <!-- cuadro sin actividad --> 
                <div class="col-lg-2 col-md-2 col-xs-4 col-sm-2 contador" data-toggle="tooltip" data-placement="top" title= "{{Lang::get('asistentes.texto_simple_title_filtro_inactivo_total')}} ">
                  <div class="small-box bg-red">
                    <div class="inner">
                      <h3>
                          {{ $cantidad_sin_actividad_total }}
                      </h3>
                       <p>
                        <span class="capitalize">
                          {{Lang::get('asistentes.texto_inactivos_todo_asistentes')}} 
                        </span>
                      </p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-share-alt"></i>
                    </div>
                    <a href="/asistentes/lista/sin-actividad-iglesia" class="small-box-footer">{{Lang::get('asistentes.texto_ver_filtros')}}


                      <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div><!-- /cuadro sin actividad -->

                <!-- cuadro dados de baja -->
                <div class="col-lg-2 col-md-2 col-xs-4 col-sm-2 contador" data-toggle="tooltip" data-placement="top" title= "Muestra los asistentes de toda la iglesia que no poseen un grupo.  ">   
                  <div class="small-box bg-green">
                    <div class="inner">
                      <h3>
                          {{ $cantidad_sin_linea }}
                      </h3>
                      <p>
                        <span class="capitalize">
                          {{Lang::get('asistentes.texto_sinlinea_asistentes')}}
                        </span>
                       </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-code-fork"></i>
                    </div>
                    <a href="/asistentes/lista/sin-linea" class="small-box-footer">{{Lang::get('asistentes.texto_ver_filtros')}}


                      <i class="fa fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div>
                <!-- /cuadro dados de baja -->

                <!-- cuadro dados de baja -->
                <div class="col-lg-2 col-md-2 col-xs-4 col-sm-2 contador" data-toggle="tooltip" data-placement="top" title= "Muestra los asistentes de toda la iglesia que no poseen un grupo.  ">   
                  <div class="small-box bg-green">
                    <div class="inner">
                      <h3>
                          {{ $cantidad_sin_grupo }}
                      </h3>
                      <p>
                         {{Lang::get('asistentes.texto_singrupo_asistentes')}}
                      </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-share-alt"></i>
                    </div>
                    <a href="/asistentes/lista/sin-grupo" class="small-box-footer">{{Lang::get('asistentes.texto_ver_filtros')}}


                      <i class="fa fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div>
                <!-- /cuadro dados de baja -->

                <!-- cuadro dados de baja -->
                <div class="col-lg-2 col-md-2 col-xs-4 col-sm-2 contador"  data-toggle="tooltip" data-placement="top" title= "Muestra a las personas que por alguna razón ya no asisten a la iglesia. ">    
                  <div class="small-box bg-gray">
                    <div class="inner">
                        <h3>
                            {{ $cantidad_dados_baja }}
                        </h3>
                        <p>
                          <span class="capitalize">
                            {{ Lang::get('asistentes.texto_dados_baja_asistentes') }}
                          </span>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-minus-circle"></i>
                    </div>
                    <a href="/asistentes/lista/dados-de-baja" class="small-box-footer">{{Lang::get('asistentes.texto_ver_filtros')}}


                      <i class="fa fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div>
                <!-- /cuadro dados de baja -->  
        
            
            </div>
          <!-- row de cuadro de colores -->
            <!-- row de la tabla -->
          <div class="row">   
            <!-- div de 12 columnas -->                     
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
              <div class="box box-primary">
                <div class="panel-body">
                  <!-- tabla -->
                  <!--
                  <div class="box-body ">
                    <div class="collapse" id="busqueda-avanzada">
                      <div class="well">
                        Proximamente busqueda detallada ... 
                      </div>
                    </div>-->                                        
                   
                    <!-- div de busqueda-->
                    <div class="col-md-8 col-xs-12">
                      @if(isset($buscar))
                        @if($buscar!="")
                          @if($cantidad_busqueda == 1)
                            <h4>{{Lang::get('asistentes.texto_resultado_busqueda')}} <b>{{ $cantidad_busqueda }}</b> {{Lang::get('asistentes.texto_simple_termino_grupo_singular')}} </h4>
                          @else
                            <h4>{{Lang::get('asistentes.texto_resultado_busqueda')}}  <b>{{ $cantidad_busqueda }}</b> {{Lang::get('asistentes.texto_simple_termino_grupo_plural')}} </h4>
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
                            <!--<button class="btn btn-primary hide" type="button" data-toggle="collapse" data-target="#busqueda-avanzada" aria-expanded="false" aria-controls="collapseExample">
                             Busqueda avanzada 
                            </button>-->
                          </span>
                        </div>
                      </form>
                      
                    </div>
                    <!-- fin div de busqueda-->

                    <!-- div vacio-->
                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                      
                    </div>
                     <!-- fin vacio-->

                    <br><br>
                     <!-- div de paginacion-->
                    <div class="col-lg-12 col-sm-12 col-md-12  col-xs-12">
                       <h4 ALIGN=right> {{Lang::get('asistentes.texto_simple_pagina')}}<b>{{ $asistentes->getCurrentPage() }}</b> {{Lang::get('asistentes.texto_simple_de')}} <b>{{ $asistentes->getLastPage() }}</b>  </h4> 
                    </div>
                     <!-- fin de paginacion-->
                    
                    <div id="example1" class="table  table-striped display stripe" cellspacing="0" width="100%">
                      <div class="row thead">
                        <div class="tr">
                        	<div class="th @if ($tipo=='dados-de-baja') col-lg-3 @else col-lg-4 @endif col-md-5 col-sm-8 col-xs-12">{{Lang::get('asistentes.texto_informacion_principal')}}</div>
                          
                          <div class="th col-lg-2 oculta-celdas col-md-3 col-sm-4 col-xs-12">{{Lang::get('asistentes.texto_simple_contacto')}}</div>
                          <div class="th @if($tipo=='dados-de-baja') col-lg-2 col-md-3 col-sm-4 @else col-lg-3 col-md-2 col-sm-8 @endif col-xs-12">{{Lang::get('asistentes.texto_simple_informacion_ministerial')}}</div>
                          @if ($tipo=="dados-de-baja") <div class="th col-lg-2 col-md-2 col-sm-8 col-xs-12"> {{Lang::get('asistentes.texto_informacion_dado_baja_asistente')}} </div> @endif
                          <div class="th col-lg-2 @if($tipo=='dados-de-baja') col-md-2 @else col-md-2 @endif col-sm-4 col-xs-12">{{Lang::get('asistentes.texto_simple_actividad')}} </div>
                          
                          <div class="th col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
                        </div>
                      </div>
                      <div class="tbody">
                        @foreach($asistentes as $asistente)
                        <?php
                        $class="";
                        if($asistente->inactivo_grupo==1 || $asistente->inactivo_iglesia==1)
                        {
                            $class=" inactivo";
                        }
                     ?>
                          <div class="tr row-fluid {{$class}}" >
                            <div style="" class="td col-lg-1 col-md-2 col-sm-3 col-xs-4 text-center {{$class}}"> <a href="../perfil/{{ $asistente->id }}"><img src="/img/fotos/{{ $asistente->foto }}" class="img-circle col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0" alt="User Image" /></a>
                            </div>

                            <div class="td @if ($tipo=='dados-de-baja') col-lg-2 @else col-lg-3 @endif col-md-3 col-sm-5 col-xs-8 {{$class}}">
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

                              <a href="../perfil/{{ $asistente->id }}"><span class="capitalize">{{ $asistente->nombre." ".$asistente->apellido }}</span></a><br>
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
                            </div> 

                            <div class="td col-lg-2 col-md-3 col-sm-4 col-xs-6 {{$class}}  oculta-celdas">
                              <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Telefono fijo"><i class="fa fa-phone"></i></label> {{ $asistente->telefono_fijo }}<br>
                              <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Celular"> <i class="fa fa-mobile-phone"></i></label> {{ $asistente->telefono_movil }}<br>
                              <span class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="E-mail">@</span> 
                              <p class="puntos" data-toggle="tooltip" data-placement="top" title="{{ $asistente->user['email'] }}">{{ $asistente->user['email'] }}</p>                    
                              <!--<label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Direccion"> <i class="fa fa-home"></i></label> {{ $asistente->direccion }}<br>   -->                            
                            </div>
                              
                            <div class="td @if($tipo=='dados-de-baja')min-height-120 col-lg-2 col-md-3 col-sm-4 @else col-lg-3 col-md-4 col-sm-5 @endif col-xs-8  {{$class}}">
                                <!-- <?php $grupo= Grupo::find($asistente['grupo_id']); ?>  -->
                               <?php $grupo= $asistente->grupo ?>
                              @if($grupo!="")
                              <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Grupo inmediato"><i class="fa fa-share-alt"></i> </label>
                                <span class="capitalize">{{ $asistente->grupo['nombre'] }}</span><br>

                              @foreach($grupo->encargados as $encargado)
                              @if ($encargado->tipoAsistente['id']==5)
                                <label class="label arrowed-right bg-purple" data-toggle="tooltip" data-placement="top" title="{{ $encargado->tipoAsistente['nombre'] }}"><i class="fa fa-book" style="margin-right:15 px;"> </i></label> 
                              @elseif($encargado->tipoAsistente['id']==4)
                                <label class="label arrowed-right bg-orange" data-toggle="tooltip" data-placement="top" title="{{ $encargado->tipoAsistente['nombre'] }}"><i class="fa fa-star" style="margin-right:15 px;"> </i></label> 
                              @endif
                              <span class="capitalize">{{ $encargado['nombre']." ".$encargado['apellido']}}</span>.<br>
                              @endforeach

                              <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Linea">{{Lang::get('asistentes.texto_linea_individual')}}</label> {{ $asistente->linea['nombre'] }}<br>
                              @endif                                
                            </div>
                            

                            @if ($tipo=="dados-de-baja")
                            <?php $reporte= ReporteBajaAlta::where( 'asistente_id', '=', $asistente->id)
                                            ->orderBy('id', 'desc')
                                            ->first() ?>  
                              <div class="td col-lg-2  col-xs-6 @if($tipo=='dados-de-baja')col-md-3 col-sm-5 @else col-md-4 col-sm-4 @endif {{$class}}">
                                <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Fecha de la ultima dada de baja"> Fecha de la baja:</label> {{ $reporte->fecha }} <br> 
                                <p>  <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Motivo de la baja"> Motivo:</label> {{ $reporte->motivo }}</p> 
                              </div>
                            @endif

                            <div class="td col-lg-3 col-xs-12 col-sm-4 @if($tipo=='dados-de-baja')col-md-3 @else col-md-4 @endif {{$class}}" style="padding:15px 0;"> 
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="padding:0">
                                @if($asistente->inactivo_grupo==1)
                                <span class="badge bg-red">Inactivo {{Lang::get('asistentes.texto_grupo_individual')}}</span>
                                @else
                                <span class="badge bg-aqua">Activo {{Lang::get('asistentes.texto_grupo_individual')}}</span>
                                @endif
                                <br>
                                @if($asistente->inactivo_iglesia==1)
                                <span class="badge bg-red">{{Lang::get('asistentes.texto_simple_inactivo')}} {{Lang::get('asistentes.texto_simple_iglesia')}}</span>
                                @else
                                <span class="badge bg-aqua">{{Lang::get('asistentes.texto_simple_activo')}} {{Lang::get('asistentes.texto_simple_iglesia')}}</span>
                                @endif
                              </div>
                              <div class="btn-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <button type="button" class="btn btn-success btn-info dropdown-toggle" data-toggle="dropdown">
                                  {{Lang::get('asistentes.texto_boton_opciones')}}  
                                  <i class="fa fa-caret-down"> </i>
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a href="../perfil/{{ $asistente->id }}">{{Lang::get('asistentes.texto_opciones_perfil')}}</a></li>                                

                                  @if($asistente->trashed())
                                    <li><a href="../dado-alta/{{ $asistente->id }}">{{Lang::Get('asistentes.texto_opciones_dar_alta')}}</a></li>
                                  @else
                                    <li><a href="../actualizar/{{$asistente->id}}">{{Lang::get('asistentes.texto_opciones_modificar')}}</a></li>  
                                    <li><a href="../dado-baja/{{ $asistente->id }}">{{Lang::get('asistentes.texto_opciones_dar_baja')}}</a></li>
                                    @if(Auth::user()->id==1)
                                    <li><a href="/usuarios/actualizar-password-usuario/{{$asistente->id}}">{{Lang::get('asistentes.texto_opciones_contraseña')}}</a></li>
                                    @endif                                    
                                  @endif
                                  <li><a  class="btn-eliminar" data-id="{{ $asistente->id }}" data-nombre-apellido="{{ $asistente->nombre }} {{ $asistente->apellido }}"  style="cursor:pointer;">Eliminar</a></li>
                                  
                                </ul>
                              </div>
                            </div>                                                  
                          </div>
                        @endforeach 
                      </div>
                    </div>
                  </div>
                  <!-- /tabla -->                                    
                </div> <!-- /panel body -->
                <div class="box-footer">
                  <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> 
                      <h4> <b>{{ $asistentes->getFrom() }}</b> - <b>{{ $asistentes->getTo() }}</b> de <b>{{ $asistentes->getTotal() }} </b> registros.</h4> 
                    </div>
                    @if(!isset($buscar))
                      <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 text-right" style="padding-right: 30px!important;"> {{ $asistentes->links() }}</div>
                    @else
                      <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 text-right" style="padding-right: 30px!important;"> {{ $asistentes->appends(array('buscar' => $buscar))->links() }}</div>
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

    <!-- /modal mensaje de confirmación eliminar-->
    <div id="msn_modal_eliminar" class="modal modal-advertencia fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <br>
            </div>
            <div class="modal-body">
              <h4 id="msn_confirmacion_eliminar" class="modal-title bg-danger" id="myModalLabel"> Mensaje ...  </h4>     
            </div>
            <div class="modal-footer">
              <a  id="btn_confirmacion_eliminar" data-id=""  type="button" class="btn bg-light-redil">Si</a>
              <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
            </div>
        </div>
      </div>
    </div>
    <!-- /modal   -->

    <!-- /modal mensaje que apararecera si deseas eliminar el asistente y este tiene registros -->
    <div id="msn_modal_tiene_registros" class="modal modal-advertencia fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">  
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h3 class="titulo">No es posible eliminar el {{Lang::get('asistentes.texto_asistente_individua')}}</h3 class="titulo">
            </div>
            <div class="modal-body">
                  <h4 id="msn_confirmacion_si_tiene_registros" class="mensaje " id="myModalLabel"> Mensaje ...  </h4>
      
            </div>
            <div class="modal-footer">
               <a id="btn_dado_baja" data-id="" type="button" class="btn bg-light-redil">Dar de baja</a>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
      </div>
    </div>
    <!-- /modal   -->

    <!-- /modal mensaje que apararecerasi se elimino correctamente -->
    <div id="msn_modal_eliminado_exito" class="modal modal-exito fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">              
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <br>
            </div>
            <div class="modal-body">
                  <h4 id="msn_eliminado_exito" class="modal-title bg-danger" id="myModalLabel"> Mensaje ...  </h4>
      
            </div>
            <div class="modal-footer">
              <center><button type="button" class="btn bg-light-redil" data-dismiss="modal">Aceptar</button></center>
            </div>
        </div>
      </div>
    </div>
    <!-- /modal   -->

    @include('includes.scripts')
        
      <!-- DATA TABES SCRIPT -->
      <script src="{{ Lang::get('general.url-datatables') }}" type="text/javascript"></script>
      <script src="/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        
      <!-- page script -->
      <script type="text/javascript">
        $(document).ready(function() {
          $("#menu_asistentes").children("a").first().trigger('click');
        });
      </script>

      <!-- page script para boton de eliminar  -->
      <script type="text/javascript">
        $(document).ready(function() {

          $('#msn_modal_tiene_registros').modal('hide');
          $('#msn_modal_eliminar').modal('hide');

          $('.btn-eliminar').click (function () 
          {
                 
            var id = $(this).attr("data-id");
            var nombre= $(this).attr("data-nombre-apellido");
            //alert("El id es: "+id);

            $.ajax({url:"/asistentes/comprueba-si-tiene-registro-ajax/"+id, cache:false, type:"POST", success:function(resp)
              {
                
                if(resp.indexOf('0')==-1)
                {
                  var mensaje="El asistente <b>"+nombre+"</b><br><br><ul type = disk >";
                  if(resp.indexOf('1')>=0)
                    mensaje=mensaje+"<li> Tiene registros en algunos reportes de grupo.</li>"; 
                  if(resp.indexOf('2')>=0 )
                    mensaje=mensaje+"<li> Tiene registros en algunos reportes de reunión.</li>"; 
                  if(resp.indexOf('3')>=0 )
                    mensaje=mensaje+"<li> Tiene registros de ofrendas.</li>"; 

                  mensaje+="</ul> En lugar de eliminarlo del sistema se recomienda <b>darle de baja.</b>";
                  $('#msn_modal_tiene_registros').modal('show');
                  $('#msn_confirmacion_si_tiene_registros').html(mensaje);
                  $('#btn_dado_baja').attr('href', '../dado-baja/'+id);
                  
                }else
                {
                  $('#msn_modal_eliminar').modal('show');
                  $('#msn_confirmacion_eliminar').html('<h3>Esta seguro que quiere eliminar al asistente <b>'+nombre+'</b></h3>');
                  $('#btn_confirmacion_eliminar').attr({'data-id':id, 'data-nombre-apellido':nombre});
                }
              } 

            });         

          });
          
          $('#btn_confirmacion_eliminar').click (function () 
          {   
            var id = $(this).attr("data-id");
            var nombre = $(this).attr("data-nombre-apellido");
          
            $.ajax({url:"/asistentes/eliminar/"+id, cache:false, type:"POST", success:function(resp)
              {
                if(resp=="eliminado")
                {
                  $('#msn_modal_eliminar').modal('hide');
                  $('#msn_eliminado_exito').html('<h3>El Asistente <b>'+nombre+'</b> se elimino con exito.</h3>');
                  $('#msn_modal_eliminado_exito').modal('show'); 

                }
              }
            });

          });
          

        });
      </script>
  @endif
  </body>
</html>