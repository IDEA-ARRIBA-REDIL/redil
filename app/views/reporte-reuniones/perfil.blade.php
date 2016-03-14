@if(Auth::check())
@include('includes.lenguaje')
<?php $id_integrante; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{{Lang::get('general.texto_encabezado_pagina')}} | {{Lang::get('reporte_reuniones.texto_simple_titulo_pagina')}}</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        @include('includes.styles')
        <!-- datepicker.css -->
        <link rel="stylesheet" href="/css/chosen/bootstrap-chosen.css">
        
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
                    <div class="pull-right box-tools">
                      
                      @if(Auth::user()->id==1 || isset(Auth::user()->asistente->iglesiaEncargada()->first()->id) || isset(Auth::user()->asistente->iglesiaEncargada()->first()->id))
                        <div class="btn-group">
                          <button type="button" class="btn btn-success btn-info dropdown-toggle" data-toggle="dropdown">
                              {{ Lang::get('grupos.lg_bt_opciones') }}  
                              <i class="fa fa-caret-down"> </i>
                         </button>
                          <ul class="dropdown-menu">
                              <li><a href="../actualizar/{{$reporte->id}}">{{ Lang::get('grupos.lg_bt_opciones_1') }}</a></li>
                              <li><a href="../eliminar/{{$reporte->id}}">{{Lang::get('general.btn_eliminar')}}</a></li>
                          </ul> 
                         </div>   
                        @endif                                            
                        <button data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Imprimir"  onclick="window.print();" ><i class="fa fa-print"></i></button>
                       <!-- <button data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Enviar por Email"><i class="fa fa-envelope"></i></button> -->
                        <a href="../informepdf/{{$reporte->id}}" target="_blank" data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Por medio de este botón podrás crear un archivo pdf con la información del informe"><i class="fa fa-file-pdf-o "></i></a>
                        <a  href="../lista/todos" class=" btn bg-red"> <i class="fa fa-undo"></i> {{Lang::get('general.btn_volver')}}</a>
                    </div>
                    <h3 class="content-header barra-titulo">
                     {{Lang::get('reporte_reuniones.texto_simple_titulo_reporte')}}
                      <small> {{Lang::get('reporte_reuniones.texto_simple_subtitulo_admin')}} @if(Auth::user()->id!=1) {{Lang::get('reporte_reuniones.texto_simple_subtitulo_miembro')}} @endif</small>
                    </h3> 
                      
                  </div>
              </section>

              <!-- contenido principal -->
              <section class="content">
                <div class="panel-default">
                  <div class="row-fluid">

                    <div class="col-lg-9 col-md-9 col-xs-8">
                      <div class="box-body text-left"> 
                         <!-- informacion Grupo inmediato-->
                         <div class="col-lg-12 col-sm-6 col-md-6 col-xs-12">
                           <h1 class="col-lg-12 no-padding no-margin"> 
                           {{Lang::get('reporte_reuniones.texto_simple_cod_reporte')}} {{ $reporte->id }} 
                               
                           </h1>  
                           <h3 class="page-header col-lg-12 no-padding"> {{ $reporte->reunion->nombre }}  </h3> 
                         </div>
                         <div class="col-lg-12 col-sm-6 col-md-6 col-xs-12">
                           <small class="label label-info col-lg-5 col-md-10 col-xs-12 col-sm-12" style="font-size: 14px; margin: 0 10px 10px 0;"><i class="fa fa-users"></i> 
                            {{Lang::get('reporte_reuniones.texto_Simple_asistencia_reunion')}}
                            {{ $reporte->cantAsistentesTotal($reporte->id) }} </small>

                            @if(Auth::user()->id!=1 && !isset(Auth::user()->asistente->iglesiaEncargada()->first()->id))
                              <small class="label label-primary col-lg-5 col-md-10 col-xs-12 col-sm-12" style="font-size: 14px; margin: 0 10px 10px 0;"><i class="fa fa-users"></i> 
                                {{Lang::get('reporte_reuniones.texto_simple_asistencia_ministerio')}}
                                {{ $cantidad_todos }} 
                              </small>
                            @endif  

                          </div>                        
                      </div>
                   </div>

                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-4">
                        <div class="small-box bg-teal"  style="color:white">
                                <div class="inner">
                                    <h3>
                                       
                                        <sub style="font-size: 16px;">{{Lang::get('general.texto_simple_dia')}}</sub>
                                    </h3>
                                        
                                </div>
                                <div class="icon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <div class="small-box-footer">
                                    <h3>
                                    @if($reporte->reunion->dia != 0 && $reporte->reunion->dia !="" )
                                    {{ Lang::choice('general.dias', $reporte->reunion->dia) }} 
                                    @endif
                                    </h3>
                                </div>
                            </div>
                    </div>
                  </div>
                </div>
                    
                <!-- /contendio cabezote -->
                 
                <div class="row">
                   <!-- columna Reporte -->
                  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                          <div class="panel">
                              <div class="panel-heading">
                                  <h4 class="modal-title"> {{Lang::get('reporte_reuniones.texto_simple_titulo_info_reporte')}} </h4>
                              </div>
                              
                              <div class="panel-body">
                                  
                                  <!-- /.fin Fecha de reunion -->
                                   <!-- predicaicon o tema -->
                                  <h4>
                                    <i class="fa fa-calendar"></i>  {{Lang::get('reporte_reuniones.texto_simple_fecha')}}:  
                                      {{ Helper::fechaFormateada($reporte->fecha) }} 
                                   </h4>
                                    <!-- /predicaicon o tema -->
                                   <h4>
                                    @if(isset($reporte->predicador) && ($reporte->predicador!=""))
                                    <i class="fa fa-user"></i>  {{Lang::get('reporte_reuniones.texto_simple_predicador_principal')}} :
                                     {{ $reporte->asistentePredicador['nombre'] }} {{ $reporte->asistentePredicador['apellido'] }}
                                    @endif
                                    </h4>
                                    <h4>
                                    @if(isset($reporte->predicador_invitado) && ($reporte->predicador_invitado!=""))
                                    <i class="fa fa-male"></i>   {{Lang::get('reporte_reuniones.texto_simple_predicador_principal')}} {{Lang::get('reporte_reuniones.texto_simple_predicador_invitado')}}:  
                                      {{ $reporte->predicador_invitado }} 
                                    @endif
                                    </h4>
                                    <h4>
                                    @if(isset($reporte->predicador_diezmos) && ($reporte->predicador_diezmos!=""))
                                    <i class="fa fa-user"></i>  {{Lang::get('reporte_reuniones.texto_simple_predicador_diezmos')}}:
                                     {{ $reporte->asistentePredicadorDiezmos['nombre'] }} {{ $reporte->asistentePredicadorDiezmos['apellido'] }}
                                    @endif
                                    </h4>
                                    <h4>
                                    @if(isset($reporte->predicador_diezmos_invitado) && ($reporte->predicador_diezmos_invitado!="") )
                                    <i class="fa fa-male"></i>  {{Lang::get('reporte_reuniones.texto_simple_predicador_diezmos')}}:
                                      {{ $reporte->predicador_diezmos_invitado }} 
                                    @endif
                                   </h4>
                                    <h4>
                                    <i class="fa fa-info-circle"></i>  {{Lang::get('reporte_reuniones.texto_simple_campo_observaciones')}}:  
                                      {{ $reporte->observaciones }} 
                                   </h4>                                    

                            </div>    
                         </div>
                         
                  </div>
                  <!-- /columna  Reporte -->

                  <!-- columna Reunión -->
                  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                          <div class="panel">
                              <div class="panel-heading">
                                  <h4 class="modal-title"> {{Lang::get('reporte_reuniones.texto_simple_titulo_reunion')}} </h4>
                              </div>
                              
                              <div class="panel-body">
                                  
                                  <!-- /.fin Fecha de reunion -->
                                   <!-- predicaicon o tema -->
                                   <h4>
                                    <i class="fa fa-info-circle"></i>  {{Lang::get('general.texto_simple_nombre')}}:  
                                    <a href="../../reuniones/perfil/{{$reporte->reunion->id}}" style="color:#F39C12"> {{ $reporte->reunion->nombre }} </a> 
                                   </h4>
                                  <h4>
                                    <i class="fa fa-clock-o"></i>  {{Lang::get('general.texto_simple_hora')}}/
                                      {{ $reporte->reunion->hora }} 
                                   </h4>
                                    <!-- /predicaicon o tema -->
                                    <h4>
                                    <i class="fa fa-home"></i>  {{Lang::get('general.texto_simple_lugar')}}:
                                      {{ $reporte->reunion->lugar }} 
                                   </h4>
                                    <h4>
                                    <i class="fa fa-info-circle"></i>  {{Lang::get('general.texto_simple_descripción')}}:  
                                      {{ $reporte->reunion->descripcion }}                                   
                                    </h4>
                            </div>    
                         </div>
                         
                  </div>
                  <!-- /columna  Runión -->

                </div> 
                  
        <div class="row">   
          <!-- div de 12 columnas -->                     
          <div class="col-sm-12 col-lg-12 col-sx-12 col-md-12">
            <div class="box box-primary">


              <div class="col-lg-12" style="background:#fff">
          
                <!-- cuadro todos -->
                <div class="contadores" style=" margin-top: 10px;">
                  <div class="contador col-lg-2 col-md-2 col-xs-6" data-toggle="tooltip" data-placement="top" title= "{{Lang::get('reporte_reuniones.texto_simple_filtro_todos_placeholder')}}">
                    <div class="small-box bg-yellow">
                      <div class="inner">
                        <h3 id="cantidad-todos">{{ $cantidad_todos }}</h3>
                        <p>
                            {{ ucwords(Lang::choice('asistentes.tipo_asistente', 0)) }}
                        </p>
                      </div>
                      <div class="icon">
                          <i class="fa fa-certificate"></i>
                      </div>
                      <a id="porcentaje-todos"  href="/reporte-reuniones/perfil/{{ $reporte->id }}?linea={{ $linea }}&grupo={{ $grupo }}" class="small-box-footer">@if($cantidad_total_asistentes!=0){{ (int) ($cantidad_todos/$cantidad_total_asistentes*100) }}% @if(Auth::user()->id==1 || isset(Auth::user()->asistente->iglesiaEncargada()->first()->id)) {{Lang::get('reporte_reuniones.texto_simple_filtro_todos_miembros1')}} @else {{Lang::get('reporte_reuniones.texto_simple_filtro_todos_miembros2')}} @endif @else {{Lang::get('reporte_reuniones.texto_simple_filtro_todos_miembros3')}} @endif
                      </a>
                    </div>
                  </div>
                  @if(Auth::user()->id!=1 && !isset(Auth::user()->asistente->iglesiaEncargada()->first()->id))
                  <?php $col=3;?>
                  <!-- cuadro nuevos -->
                    <div class="contador col-lg-2 col-md-2 col-xs-6" data-toggle="tooltip" data-placement="top" title= "{{Lang::get('reporte_reuniones.texto_simple_filtro_nuevos_placeholder')}}">
                      <div class="small-box bg-teal">
                            <div class="inner">
                                <h3 id="cantidad-nuevos" >
                                  {{ $cantidad_nuevos }}
                                </h3>
                                <p>
                                    {{ ucwords(Lang::choice('asistentes.tipo_asistente', 1)) }}
                                </p>
                            </div>
                        <div class="icon">
                          <i class="fa fa-heart"></i>
                        </div>
                          <a id="porcentaje-nuevos" href="/reporte-reuniones/perfil/{{ $reporte->id }}/nuevos?linea={{ $linea }}&grupo={{ $grupo }}" class="small-box-footer">@if($cantidad_total_nuevos!=0) {{ (int) ($cantidad_nuevos/$cantidad_total_nuevos*100) }}% {{Lang::get(reporte_nuevos.texto_simple_filtro_nuevos_miembros1)}} @else No hay nuevos registradas @endif
                          </a>
                      </div>
                    </div>
                    <!-- /cuadro nuevos -->
                  <!-- /cuadro todos -->
                  <div class="col-lg-8 no-padding">
                  @endif
                  
                  @if(Auth::user()->id==1 || isset(Auth::user()->asistente->iglesiaEncargada()->first()->id)) 
                  <!-- /cuadro todos -->
                  <div class="col-lg-10 no-padding">
                  <?php $col=2;?>
                    <!-- cuadro nuevos -->
                    <div class="contador col-lg-2 col-md-2 col-xs-6" data-toggle="tooltip" data-placement="top" title= "{{Lang::get('reporte_reuniones.texto_simple_filtro_nuevos_placeholder')}}">
                      <div class="small-box bg-teal">
                            <div class="inner">
                                <h3 id="cantidad-nuevos" >
                                  {{ $cantidad_nuevos }}
                                </h3>
                                <p>
                                    {{ ucwords(Lang::choice('asistentes.tipo_asistente', 1)) }}
                                </p>
                            </div>
                        <div class="icon">
                          <i class="fa fa-heart"></i>
                        </div>
                          <a id="porcentaje-nuevos" href="/reporte-reuniones/perfil/{{ $reporte->id }}/nuevos?linea={{ $linea }}&grupo={{ $grupo }}" class="small-box-footer">@if($cantidad_total_nuevos!=0) {{ (int) ($cantidad_nuevos/$cantidad_total_nuevos*100) }}% {{Lang::get('reporte_reuniones.texto_simple_filtro_nuevos_miembros1')}} @else {{Lang::get('reporte_reuniones.texto_simple_filtro_nuevos_miembros2')}} @endif
                          </a>
                      </div>
                    </div>
                    <!-- /cuadro nuevos -->
                  @endif
                            
                    <!-- Cuadro ovejas -->
                    <div class="contador col-lg-{{ $col}} col-md-2 col-xs-6" data-toggle="tooltip" data-placement="top" title= "{{Lang::get('reporte_reuniones.texto_simple_filtro_ovejas_placeholder')}}">
                      <div class="small-box bg-aqua">
                        <div class="inner">
                          <h3 id="cantidad-ovejas" >
                             {{ $cantidad_ovejas }}
                          </h3>
                          <p>
                              {{ ucwords(Lang::choice('asistentes.tipo_asistente', 2)) }}
                          </p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-group"></i>
                        </div>
                        <a id="porcentaje-ovejas" href="/reporte-reuniones/perfil/{{ $reporte->id }}/ovejas?linea={{ $linea }}&grupo={{ $grupo }}" class="small-box-footer">@if($cantidad_total_ovejas!=0) {{ (int) ($cantidad_ovejas/$cantidad_total_ovejas*100) }}% {{Lang::get('reporte_reuniones.texto_simple_filtro_ovejas_miembros1')}} @else {{Lang::get('reporte_reuniones.texto_simple_filtro_ovejas_miembros2')}} @endif
                        </a>
                      </div>
                    </div>
                    <!-- /cuadro ovejas -->
                            
                    <!-- cuadro miembros -->
                    <div class="contador col-lg-{{ $col}} col-md-2 col-xs-6" data-toggle="tooltip" data-placement="top" title= "{{Lang::get('reporte_reuniones.texto_simple_filtro_miembro_placeholder')}}">
                      <div class="small-box bg-blue">
                        <div class="inner">
                          <h3 id="cantidad-miembros" >
                            {{ $cantidad_miembros }}</h3>
                          <p>
                              {{ ucwords(Lang::choice('asistentes.tipo_asistente', 3)) }}
                          </p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-child"></i>
                        </div>
                        <a id="porcentaje-miembros" href="/reporte-reuniones/perfil/{{ $reporte->id }}/miembros?linea={{ $linea }}&grupo={{ $grupo }}" class="small-box-footer">@if($cantidad_total_miembros!=0) {{ (int) ($cantidad_miembros/$cantidad_total_miembros*100) }}% {{Lang::get('reporte_reuniones.texto_simple_filtro_miembro_miembros1')}} @else {{Lang::get('reporte_reuniones.texto_simple_filtro_miembro_miembros2')}} @endif
                        </a>
                      </div>
                    </div>
                    <!-- /cuadro miembros-->
                            
                    <!-- cuadro lideres -->
                    <div class="contador col-lg-{{ $col}} col-md-2 col-xs-6" data-toggle="tooltip" data-placement="top" title= "{{Lang::get('reporte_reuniones.texto_simple_filtro_lider_placeholder')}}">
                      <div class="small-box bg-orange">
                        <div class="inner">
                        <h3 id="cantidad-lideres">
                          {{ $cantidad_lideres }}</h3>
                          <p>
                              {{ ucwords(Lang::choice('asistentes.tipo_asistente', 4)) }}
                          </p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-star"></i>
                        </div>
                        <a id="porcentaje-lideres" href="/reporte-reuniones/perfil/{{ $reporte->id }}/lideres?linea={{ $linea }}&grupo={{ $grupo }}" class="small-box-footer">@if($cantidad_total_lideres!=0) {{ (int) ($cantidad_lideres/$cantidad_total_lideres*100) }}% {{Lang::get('reporte_reuniones.texto_simple_filtro_lider_miembros1')}} @else {{Lang::get('reporte_reuniones.texto_simple_filtro_lider_miembros2')}}  @endif
                        </a>
                      </div>
                    </div> 
                    <!-- /cuadro lideres -->

                    <!-- cuadro pastores -->
                    <div class="contador col-lg-{{ $col}} col-md-2 col-xs-6" data-toggle="tooltip" data-placement="top" title= "{{Lang::get('reporte_reuniones.texto_simple_filtro_pastor_placeholder')}}">
                      <div class="small-box bg-purple">
                        <div class="inner">
                            <h3 id="cantidad-pastores" >
                              {{ $cantidad_pastores }}</h3>
                            <p>
                                {{ ucwords(Lang::choice('asistentes.tipo_asistente', 5)) }}
                            </p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-book fa-1x"></i>
                        </div>
                        <a id="porcentaje-pastores" href="/reporte-reuniones/perfil/{{ $reporte->id }}/pastores?linea={{ $linea }}&grupo={{ $grupo }}" class="small-box-footer">@if($cantidad_total_pastores) {{ (int) ($cantidad_pastores/$cantidad_total_pastores*100) }}% {{Lang::get('reporte_reuniones.texto_simple_filtro_pastor_miembros1')}} @else {{Lang::get('reporte_reuniones.texto_simple_filtro_pastor_miembros1')}} @endif
                        </a>
                      </div>
                    </div>
                    <!-- /cuadro pastores -->

                    @if(Auth::user()->id==1 || isset(Auth::user()->asistente->iglesiaEncargada()->first()->id))
                    <!-- cuadro invitados -->
                    <div class="contador col-lg-2 col-md-2 col-xs-6" data-toggle="tooltip" data-placement="top" title= "{{Lang::get('reporte_reuniones.texto_simple_filtro_invitados_placeholder')}}">
                      <div class="small-box bg-redil">
                        <div class="inner">
                          
                            <h3 id="cantidad-invitados">
                              {{ $reporte->invitados }}</h3>

                            <p>
                                Invitados
                            </p>
                        </div>
                        
                        <a id="porcentaje-invitados" class="small-box-footer">@if($cantidad_total_asistentes) {{ (int)((int)$reporte->invitados/($cantidad_total_asistentes)*100) }}% @if(Auth::user()->id==1 || isset(Auth::user()->asistente->iglesiaEncargada()->first()->id)) {{Lang::get('reporte_reuniones.texto_simple_filtro_invitados1')}} @else{{Lang::get('reporte_reuniones.texto_simple_filtro_invitados2')}} @endif @else{{Lang::get('reporte_reuniones.texto_simple_filtro_invitados3')}} @endif
                        </a>
                      </div>
                    </div>
                    <!-- /cuadro invitados -->
                  </div>
                  @else
                  </div>
                  @endif
                          
                </div>
              </div>
              <!-- cierra el div row -->
          <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <form id="filtros" action="" method="get" role="form" class="form-inline">
              @if($lineas->count()>0)
              <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 campo-filtro">
                <select style="width:100%" id="linea" name="linea" class="chosen-select" data-placeholder="Filtro por línea" >
                    <option value="" @if(isset($linea)) @if($linea=="") selected @endif @endif >{{Lang::get('reporte_reuniones.texto_simple_filtro_busqueda_lineas')}}</option>
                    @foreach($lineas as $lin) <!-- Se le coloco lin porque linea ya era una variable que viene del controlador -->
                    <option value="{{ $lin->id }}" @if(isset($linea)) @if($linea==$lin->id) selected @endif @endif>{{ $lin->id." - ".$lin->nombre  }}</option>
                    @endforeach
                </select>
              </div>
              @endif

              @if($grupos->count()>0)
              <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 campo-filtro">
                <select style="width:100%" id="grupo" name="grupo" class="chosen-select" data-placeholder="Filtro por línea" >
                    <option value="" @if(isset($grupo)) @if($grupo=="") selected @endif @endif >{{Lang::get('reporte_reuniones.texto_simple_filtro_busqueda_grupos')}}</option>
                    @foreach($grupos as $grup) <!-- Se le coloco grup porque grupo ya era una variable que viene del controlador -->
                    <option value="{{ $grup->id }}" @if(isset($grupo)) @if($grupo==$grup->id) selected @endif @endif>{{ $grup->id." - ".$grup->nombre  }}</option>
                    @endforeach
                </select>
              </div>
              @endif
              
            </form>
          </div>


            <div id="contenido-ingresos" name="contenido-ingresos" class="row" style="background:#fff;margin-left:1px;margin-right:1px">
       
                                 
              <div style="margin-top:-40px" >

                <div class="col-lg-6 no-padding col-md-6 col-sm-6 col-xs-12">
                  <div class="col-lg-12 form-group pull-center text-center" >
                    <h1 > 
                      <span class="badge @if($tipo==1)bg-teal @elseif($tipo==2)bg-aqua @elseif($tipo==3)bg-blue @elseif($tipo==4)bg-orange @elseif($tipo==5)bg-purple @else bg-yellow @endif">  
                      <i class="fa @if($tipo==1)fa-heart @elseif($tipo==2)fa-group @elseif($tipo==3)fa-child @elseif($tipo==4)fa-star @elseif($tipo==5)fa-book @else fa-certificate @endif fa-4x"></i>
                      </span>
                    </h1>
                    <h4 class="no-margin">Búsqueda de <b>@if($tipo==1)Nuevos @elseif($tipo==2)Ovejas @elseif($tipo==3)Miembros @elseif($tipo==4)Lideres @elseif($tipo==5)Pastores @else Asistentes @endif</b> de la Reunión</h4>

                  </div>
                  <div class="col-lg-12" >
                    <!-- asistente --> 
                    <!-- asistente --> 
                    <div class="nav navbar-nav">
                      <li class="dropdown lista-busqueda">
                        <div class="input-group "  >
                          <input type="text" id="busqueda_asistente" class="form-control buscar" autocomplete="off" placeholder="Buscar predicador por código, nombre o cédula..." />
                          <span class="input-group-btn">
                              <button type='button' class="btn btn-flat" style="border-color:#CCC;background:#fff" ><i class="fa fa-search" style="color:#00545E" ></i></button>
                          </span>
                        </div> 

                        <ul id="panel-ppl-asistentes" class="panel-busqueda-moviles dropdown-menu " style="overflow: auto; width: 100%; max-height: 685px; position: relative; display:block;z-index:200">
                          <li>
                              <!-- inner menu: contains the actual data -->
                            <ul class="menu" id="panel-asistentes" style="overflow-y: hidden;">
                              
                            </ul>
                          </li>
                        </ul>

                      </li>
                    </div>    
                    <!-- /asistente -->        
                    </div>
                </div>

                <!-- Sección de finanzas -->
                <div class="col-lg-6 no-padding col-md-6 col-sm-6 col-xs-12">
                  <div class="col-lg-12 form-group pull-center text-center" >
                    <h1 > 
                        <span class="badge bg-blue" style="background-color:#00A65A !important">  
                        <i class="fa fa-money fa-4x"></i>
                        </span>
                    </h1>
                    <h4 class="no-margin">Ingresos Financieros de la Reunión</h4>
                  </div>
                  <div class="col-lg-12">
                    <div class="panel">
                      <div class="panel-heading">
                          <h3 class="modal-title"> <span class="badge bg-green">  <i class="fa fa-money fa-1x"></i> </span> Resumen Financiero</h3>
                      </div>
                        <div class="panel-body">
                            <table id="tabla_resumen_financiero" class="table table-condensedres table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>TIPO</th>
                                        <th>TOTAL</th>
                                        <th></th>
                                  </tr>
                                </thead>
                                <tbody>
                                           
                                    <tr>
                                        
                                        
                                        <td>
                                            <h4> Diezmos </h4>
                                        </td>

                                        <td>
                                            <h4><label id="total_diezmos" data-total="{{$total_diezmos}}" class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="">$</label> <label id="diezmos"> {{$total_diezmos}} </label> </h4> 

                                        </td>
                                            
                                         <td>
                                              
                                                                                
                                        </td>
                                        
                                    </tr>

                                     <tr>
                                        
                                        
                                        <td>
                                            <h4> Ofrendas </h4>
                                        </td>

                                        <td>
                                            <h4><label id="total_ofrendas" data-total="{{$total_ofrendas}}" class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="">$</label> <label id="ofrendas"> {{$total_ofrendas}} </label> </h4> 

                                        </td>
                                            
                                         <td>
                                              
                                                                                
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        
                                        
                                        <td>
                                            <h4> Pactos </h4>
                                        </td>

                                        <td>
                                            <h4><label id="total_pactos" data-total="{{$total_pactos}}" class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="">$</label> <label id="pactos"> {{$total_pactos}} </label> </h4> 

                                        </td>
                                            
                                         <td>
                                              
                                                                                
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        
                                        
                                        <td>
                                            <h4> Primicias </h4>
                                        </td>

                                        <td>
                                            <h4><label id="total_primicias" data-total="{{$total_primicias}}" class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="">$</label> <label id="primicias"> {{$total_primicias}} </label> </h4> 

                                        </td>
                                            
                                         <td>
                                              
                                                                                
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        
                                        
                                        <td>
                                            <h4> Pro-templo </h4>
                                        </td>

                                        <td>
                                            <h4><label id="total_protemplo" data-total="{{$total_protemplo}}" class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="">$</label> <label id="protemplo"> {{$total_protemplo}} </label> </h4> 

                                        </td>
                                            
                                         <td>
                                              
                                                                                
                                        </td>
                                        
                                    </tr>

                                    <tr>
                                        
                                        
                                        <td>
                                            <h4> Siembra </h4>
                                        </td>

                                        <td>
                                            <h4><label id="total_siembras" data-total="{{$total_siembras}}" class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="">$</label> <label id="siembras"> {{$total_siembras}} </label> </h4> 

                                        </td>
                                            
                                         <td>
                                              
                                                                                
                                        </td>
                                        
                                    </tr>

                                    <tr>
                                        
                                        
                                        <td>
                                            <h4> Otro </h4>
                                        </td>

                                        <td>
                                            <h4><label id="total_otros" data-total="{{$total_otros}}" class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="">$</label> <label id="otros"> {{$total_otros}} </label> </h4> 

                                        </td>
                                            
                                         <td>
                                              
                                                                                
                                        </td>
                                        
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <h4> Ofrendas sueltas </h4>
                                        </td>

                                        <td>
                                            <h4><label id="total_ofrendas_sueltas" data-total="{{$total_ofrendas_sueltas}}" class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="">$</label> <label id="sueltas"> {{$total_ofrendas_sueltas}} </label> </h4> 
                                        </td>
                                            
                                         <td> 
                                                                                           
                                        <!--
                                            <input name="ofrenda_suelta" type="number" class="form-control" placeholder="$" data-toggle="tooltip" data-placement="top" title="Si hay ofrenda suelta ingrese el valor en este campo, de lo contrario simplemente dejelo vacio"/>
                                        --></td>
                                        
                                    </tr>

                                     <tr>
                                        <td class="text-right">
                                            <h4><b>TOTAL</b></h4>
                                        </td>

                                        <td>
                                            <h4><label id="total_ingresos" data-total="{{$total_ingresos}}" class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="">$</label> <label id="total"> {{$total_ingresos}} </label> </h4> 
                                        </td>
                                            
                                         <td>
                                        </td>

                                    </tr>
                                </tbody>
                                
                            </table>
                        </div> <!-- /box-body -->
                    </div>        
                  </div>
                </div> <!-- Fin Sección de finanzas -->
            

            </div>
                 
          </div><!-- Cierre div contenido-ingresos-->
                                      <!-- /cierra row  --> 
            </div><!-- /Box primary -->
        </div><!-- /Div de 12 columnas -->
      </div><!-- /row -->
      </section>  

    </div><!-- /Box primary -->
  </div><!-- /Div de 12 columnas -->
</div><!-- /row -->




                            
        

        @include('includes.scripts')
       
        <script type="text/javascript" src="/js/plugins/chosen/chosen.js"></script>
  <!-- busqueda tipo facebook -->
        <script src="/js/AdminLTE/busqueda-fc.js" type="text/javascript"></script>

        <!-- script para buscar los asistentes de un grupo -->
        <script type="text/javascript">
           //select con buscador
          $('#linea').chosen({ allow_single_deselect: true });

           //select con buscador
          $('#grupo').chosen({ allow_single_deselect: true });
            ////la siguiente variable es pla que nos guardara el objeto de la busqueda tipo facebook
            var busqueda_asistente;

            var idreporte = "{{ $reporte->id }}";

            ///esta función nos permitira determinar que evento sucedera si se le da clic 
            //a un item de los resultados de la busqueda o a cualquier objeto denrto del item, como el boton cerrar
            function seleccionar_asistente(){
            }

            $(document).ready(function() {
              var sql_adicional="" //si no hay sql adicional dejar la variable vacia
              @if($tipo!="todos")
                sql_adicional+="tipo_asistente_id={{ $tipo }}";
              @endif
              var linea="0"
              var grupo="0"
              idreporte = "{{ $reporte->id }}";
              //se crea un objeto de la Clase BusquedaFB y se cargan los primeros registros
              
              @if($linea!=null && $linea!="")
              linea="{{ $linea }}";
              @endif

              @if($grupo!=null && $grupo!="")
              grupo="{{ $grupo }}";
              @endif
              var array=idreporte+";"+grupo+";"+linea+";{{ $tipo }}";
              busqueda_asistente = new BusquedaFB($("#busqueda_asistente"), $("#panel-ppl-asistentes"), "panel-asistentes","/reporte-reuniones/obtener-asistentes-ajax/"+array+"/perfil", seleccionar_asistente, sql_adicional);
              //busqueda_asistente.inicializar();
              busqueda_asistente.cargarPrimerosRegistros();
              
            });
            
            $(document).ready(function() {
              $("#menu_reuniones").children("a").first().trigger('click');

              $("#linea").on('change', function(){
                $("#grupo").val('');
                $("#filtros").submit();

              });

              $("#grupo").on('change', function(){
                $("#filtros").submit();
              });

              $("#limpiar").on('click', function(){
                $("#buscar").val("");
                $("#filtros").submit();
              });
            });
        </script> 
        <!-- fin script busqueda de asistentes -->


    </body>
</html>

@endif