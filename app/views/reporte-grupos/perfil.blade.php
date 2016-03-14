@if(Auth::check())
@include('includes.lenguaje')
<?php $id_integrante; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{{Lang::get('reporte_grupos.texto_reporte_index_titulo_pagina')}} | {{Lang::get('reporte_grupos.texto_nombre_pagina_perfil')}}</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        @include('includes.styles')
        <!-- datepicker.css -->
        <link href="/css/datepicker.css" rel="stylesheet" type="text/css" />
        <link href="/css/datepicker3.css" rel="stylesheet" type="text/css" />
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
                    <div class="pull-right box-tools">
                      @if($reporte->aprobado==false && Auth::user()->id==1)
                        <button id="aprobar_reporte" href="../lista/todos" class=" btn bg-green" data-id="{{ $reporte->id }}"  data-toggle="tooltip" data-original-title="Este botón sirve para aprobar el reporte.">
                          <i class="fa fa-check-circle"></i> Aprobar
                        </button>
                      @endif
                      <div class="btn-group">
                        <button type="button" class="btn btn-success btn-info dropdown-toggle" data-toggle="dropdown">
                            {{ Lang::get('grupos.lg_bt_opciones') }}  
                            <i class="fa fa-caret-down"> </i>
                        </button>
                        <ul class="dropdown-menu">
                            @if($reporte->aprobado == true)
                              @if(Auth::user()->id==1)
                                <li><a href="../actualizar/{{$reporte->id}}">{{ Lang::get('grupos.lg_bt_opciones_1') }}</a></li>
                              @endif
                            @elseif($reporte->aprobado == false)
                               <li><a href="../actualizar/{{$reporte->id}}">{{ Lang::get('grupos.lg_bt_opciones_1') }}</a></li>
                            @endif
                           
                            @if(Auth::user()->id==1)
                            <li><a href="#">{{Lang::get('reporte_grupos.texto_simple_boton_eliminar')}}</a></li>
                            @endif
                            
                            <li><a href="../nuevo">{{Lang::get('reporte_grupos.texto_simple_boton_nuevo')}}</a></li>
                        </ul>
                      </div>                                               
                        <!--<button data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Imprimir"  onclick="window.print();" ><i class="fa fa-print"></i></button>
                        <button data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Enviar por Email"><i class="fa fa-envelope"></i></button> 
                        <a href="../reporte/{{$reporte->id}}" target="_blank" data-toggle="tooltip" title="" class="btn btn-info" data-original-title=""><i class="fa fa-file-pdf-o "></i></a> -->
                        <a  href="../lista/todos" class=" btn bg-red"> <i class="fa fa-undo"></i> {{Lang::get('reporte_grupos.texto_simple_boton_cancelar')}}</a>
                    </div>
                  </div>
                  <h3 class="content-header barra-titulo">
                   <span class="mayusculas">{{Lang::get('reporte_grupos.texto_titulo_info_reporte_grupo')}} </span>
                    <small> {{Lang::get('reporte_grupos.texto_subtitulo_info_reporte_grupo')}}</small>
                  </h3>
                </section>
                 <!-- /contendio cabezote -->
                 

             <!-- contenido principal -->
              <section class="content">
                  <div class="row-fluid">
                    <!-- <div class="col-lg-3">
                          <div class="box-body text-center"> 
                                  <img src="img/avatar.png" class="img-circle" alt="User Image" />
                            </div>
                    </div> -->
                   <!-- Nombre y fecha de entrada a la iglesia-->
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                      <div class="box-body text-left"> 
                         <!-- informacion Grupo inmediato-->
                         <div class="col-lg-12 col-sm-8 col-md-8 col-xs-12">
                           <h1 class="col-lg-12 no-padding no-margin"> 
                              {{Lang::get('reporte_grupos.texto_simple_cod_reporte')}}  {{$reporte->id}}
                          </h1>                             
                          <!-- informacion Grupo inmediato -->
                          <h3 class="page-header col-lg-12 no-padding"> <span class="capitalize">{{Lang::get('reporte_grupos.texto_simple_grupo')}}:</span> {{ $reporte->grupo['id'].' - '.$reporte->grupo['nombre']}} </h3>
                        </div>
                        <div class="col-lg-12 col-sm-4 col-md-4 col-xs-12">
                          
                          @if($reporte->aprobado==true)
                            <small  class="label label-success col-lg-2 col-md-10 col-xs-12 col-sm-12" style="font-size: 14px; margin: 0 10px 10px 0;">
                              <i  class="fa fa-check-square"></i> {{Lang::get('reporte_grupos.texto_simple_estado_reporte_aprobado')}}
                            </small> 
                          @elseif($reporte->aprobado==false)
                            <small id="estado-reporte" class="label label-danger col-lg-2 col-md-10 col-xs-12 col-sm-12" style="font-size: 14px; margin: 0 10px 10px 0;">
                              <i id="icono-estado-reporte" class="fa fa-exclamation-circle"></i> {{Lang::get('reporte_grupos.texto_simple_estado_reporte_no_aprobado')}}
                            </small> 
                          @endif
                          <h3 class="col-lg-6 col-md-10 col-xs-12 col-sm-12 no-margin">
                               @if(isset($grupo->linea()->id))<i class="fa fa-share-alt"> </i> <span class="capitalize">{{Lang::get('reporte_grupos.texto_simple_linea')}}</span> 
                               {{ $grupo->linea()->nombre }}@endif            
                          </h3>
                          
                        </div>
                      </div>
                    </div>
                      
                      @if ($grupo->tipo_grupo_id ==2)
                    <!-- Tipo de miembro y rendimiento -->
                      <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                        <div class="small-box " style="background:orangered; color:white;">
                                <div class="inner">
                                    <h3>
                                       <sub style="font-size: 16px;">{{Lang::get('reporte_grupos.texto_simple_modal_campo_tipo_ofrendas')}}</sub>
                                    </h3>
                                        
                                </div>
                                <div class="icon">
                                    <i class="fa fa-lock"></i>
                                </div>
                                <div class="small-box-footer">
                                    <h3>{{Lang::get('reporte_grupos.texto_simple_tipo_celula')}} </h3>
                                </div>
                            </div>
                      </div>
                   
                    @else 

                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                        <div class="small-box" style="background:crimson; color:white">
                                <div class="inner">
                                    <h3>
                                       
                                        <sub style="font-size: 16px;">{{Lang::get('reporte_grupos.texto_simple_modal_campo_tipo_ofrendas')}}</sub>
                                    </h3>
                                        
                                </div>
                                <div class="icon">
                                    <i class="fa fa-unlock"></i>
                                </div>
                                <div class="small-box-footer">
                                    <h3>{{Lang::get('reporte_grupos.texto_simple_tipo_celula2')}} </h3>
                                </div>
                            </div>
                    </div>
                    @endif
                    
                </div>
                        
                  <!-- Estadisticas de creciemiento, escuelas y aistencia  
                    <div class="col-md-2 col-xs-4 col-lg-1 text-center" style="border-right: 1px solid #f4f4f4">
                                            <input type="text" class="knob" data-readonly="true" value="80" data-width="60" data-height="60" data-fgColor="#03B7CD"/>
                        <div class="knob-label">Crecimiento</div>
                    </div>
                    <div class="col-md-2 col-xs-4 col-lg-1 text-center" style="border-right: 1px solid #f4f4f4">
                                            <input type="text" class="knob" data-readonly="true" value="70" data-width="60" data-height="60" data-fgColor="#DF0045"/>
                        <div class="knob-label">Asistencia</div>
                    </div>
                    <div class="col-md-2 col-xs-4 col-lg-1 text-center" style="border-right: 1px solid #f4f4f4">
                                            <input type="text" class="knob" data-readonly="true" value="100" data-width="60" data-height="60" data-fgColor="#FFB703"/>
                        <div class="knob-label">Escuelas</div>
                    </div>
                    
                    
                  </div>
                    
                  </div>  -->
                             
                  <form id="form-reporte" action="../update/{{ $reporte->id }}" method="post" role="form" >
                  
                  <!-- row para el formulario -->
                                         
                 
              

                      <div class="row">
                         <!-- columna Seleccionar grupo -->
                        <div class="col-lg-7 col-sm-7 col-xs-12 col-md-7">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h4 class="modal-title"> <span class="badge bg-blue">  <i class="fa fa-info fa-1x"></i> </span>  Información principal del reporte </h4>
                                    </div>
                                    
                                    <div class="panel-body">
                                            
                                        
                                        
                                        <!-- Fecha de reunion mm/dd/yyyy -->
                                        <h4> 
                                           <i class="fa fa-calendar"></i>   {{Lang::get('reporte_grupos.texto_simple_campo_fecha_reunion')}} 
                                            <?php $fecha=date_create($reporte->fecha); ?>
                                               {{ date_format($fecha, 'd/m/Y') }}
                                        </h4>
                                          <!-- Día de reunión -->
                                      <h4><i class="fa fa-calendar-o"></i> Día de reunión: 
                                          @if(date_format($fecha, 'N')=="2"){{ Lang::choice ('general.dias', 3) }}@endif
                                          @if(date_format($fecha, 'N')=="3"){{ Lang::choice ('general.dias', 4) }}@endif
                                          @if(date_format($fecha, 'N')=="4"){{ Lang::choice ('general.dias', 5) }}@endif
                                          @if(date_format($fecha, 'N')=="5"){{ Lang::choice ('general.dias', 6) }}@endif
                                          @if(date_format($fecha, 'N')=="6"){{ Lang::choice ('general.dias', 7) }}@endif
                                          @if(date_format($fecha, 'N')=="7"){{ Lang::choice ('general.dias', 1) }}@endif
                                          @if(date_format($fecha, 'N')=="1"){{ Lang::choice ('general.dias', 2) }}@endif 
                                      </h4>
                                        <!-- /.fin Fecha de reunion -->
                                         <!-- predicaicon o tema -->
                                        <h4>
                                          <i class="fa fa-book"></i>  {{Lang::get('reporte_grupos.texto_simple_campo_tema')}} 
                                            {{ $reporte->tema }} 
                                         </h4>
                                          <!-- /predicaicon o tema -->
                                          <!-- Observaciones -->
                                          <h4>
                                             {{Lang::get('reporte_grupos.texto_simple_modal_ofrenda_suelta_observaciones')}}: </h4>
                                              <div>{{ $reporte->observacion }}</div>
                                          
                                         <!-- /Observaciones -->
                                                                                                           
                                        
                                  </div>     
                               </div>
                               
                        </div>

                        <!-- /columna  Seleccionar grupo -->

                        <!-- columna Seleccionar grupo -->
                        <div class="col-lg-5 col-sm-5 col-xs-12 col-md-5">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h4 class="modal-title" class="box-title "><span class="badge bg-orange">  <i class="fa fa-star fa-1x"></i> </span>  {{Lang::get('reporte_grupos.texto_simple_campo_encargado')}}</h4>
                                    </div>
                                    
                                    <div class="panel-body">
                                             <!-- informacion del lider-->
                                        <div class="form-group">
                                           
                                            <table id="tabla_encargados" class="table  display " cellspacing="0" width="100%">
                                              
                                              <tbody> 
                                                <?php $grupo=Grupo::find($reporte->grupo['id']);  ?>
                                                @foreach($grupo->encargados as $encargado)  
                                                  <tr>
                                                    <td class="text-center" width="40px"> <img src="/img/fotos/{{ $encargado->foto }}" class="img-circle"  width="40px" alt="User Image" />
                                                    </td>                                               
                                                    <td>
                                                      
                                                      
                                                      <a target="blank" href="/asistentes/perfil/{{ $encargado->id }}" class="capitalize"> Cod. {{ $encargado->id }} - {{ $encargado->nombre." ".$encargado->apellido }}</a>                                          
                                                      <?php $ingresos= $encargado->ofrendas()->where("reporte_grupo_id", $reporte->id)->sum("valor"); ?>
                                                      @if($ingresos!=0)<span class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="">$ {{ $ingresos }}</span>@endif
                                                    </td>
                                                  </tr>
                                                @endforeach
                                              </tbody>
                                            </table>
                                        </div>
                                        <!-- informacion del lider -->
                                       
                                        
                                      
                                    
                               </div>
                        </div>
                        <!-- /columna  Seleccionar reportar -->   
                      </div>                    

                      </div>	                     
                        <div class="row ">
                              <div class="col-lg-7 col-sm-7 col-xs-12 col-md-7">

                              <div class="panel">
                                <div class="panel-heading with-border">
                                  <h4 class="modal-title"><span class="badge bg-light-blue"> <i class="fa fa-male fa-1x"></i> <i class="fa fa-female fa-1x"></i></span> {{ $reporte->asistentes()->count() }} {{Lang::get('reporte_grupos.texto_simple_integrantes')}}</h4>
                                  
                                </div><!-- /.box-header -->
                                <div class="panel-body">
                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                    <div class=""><h3 class="box-title bg-green cinta" >Asistieron {{ $reporte->asistentes()->where('asistio', '=', '1')->count() }} {{Lang::get('reporte_grupos.texto_simple_integrantes')}}: </h3></div>
                                    @foreach($reporte->asistentes()->where('asistio', '=', '1')->get() as $integrante)
                                    <div class="col-lg-3 asistente-lista" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ $integrante->nombre.' '.$integrante->apellido }}">
                                      
                                        <a target="blank" href="/asistentes/perfil/{{ $integrante->id }}"><img src="/img/fotos/{{ $integrante->foto }}" class="img-circle" width="90px" alt="User Image">
                                        <div class="asistente-lista-nombre"> {{ $integrante->nombre.' '.$integrante->apellido }} </div>
                                        <span class="asistente-lista-id">Cod. {{ $integrante->id }} </span>
                                        <?php $ingresos=$integrante->ofrendas()->where("reporte_grupo_id", $reporte->id)->sum("valor"); ?>
                                        @if($ingresos!=0)<span class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="">$ {{ $ingresos }}</span>@endif
                                      </a>
                                    </div> 
                                    @endforeach
                                  </div><!-- /.box-body -->
                                  @if($reporte->invitados>0)
                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                    <div class=""><h3 class="box-title bg-blue cinta" >Asistieron {{ $reporte->invitados }} {{Lang::get('reporte_grupos.texto_simple_invitados')}}: </h3></div>
                                    @for($i=0; $i<$reporte->invitados; $i++)
                                    <div class="col-lg-3 asistente-lista" data-toggle="tooltip" data-placement="top" title="" data-original-title="Invitados">
                                      
                                      <img src="/img/invitado.jpg" class="img-circle" width="90px" alt="User Image">
                                      <div class="asistente-lista-nombre"> Invitado </div>
                                    </div> 
                                    @endfor
                                  </div><!-- /.box-body -->
                                  @endif
                                  @if($reporte->noAsistieron()->count()>0)
                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                    <div class=""><h3 class="box-title bg-red cinta" >No asistieron {{ $reporte->noAsistieron->count() }} {{Lang::get('reporte_grupos.texto_simple_integrantes')}}: </h3></div>
                                    @foreach($reporte->noAsistieron()->get() as $integrante)
                                    <div class="col-lg-3 asistente-lista" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ $integrante->nombre.' '.$integrante->apellido }}">
                                      
                                        <a target="blank" href="/asistentes/perfil/{{ $integrante->id }}"><img src="/img/fotos/{{ $integrante->foto }}" class="img-circle" width="90px" alt="User Image">
                                        <div class="asistente-lista-nombre"> {{ $integrante->nombre.' '.$integrante->apellido }} </div>
                                        <span class="asistente-lista-id">Cod. {{ $integrante->id }} </span>
                                        <?php $ingresos=$integrante->ofrendas()->where("reporte_grupo_id", $reporte->id)->sum("valor"); ?>
                                        @if($ingresos!=0)<span class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="">$ {{ $ingresos }}</span>@endif
                                      </a>
                                    </div> 
                                    @endforeach
                                  </div><!-- /.box-footer -->
                                  @endif
                                </div>
                              </div>

                            </div>

                                  <!-- columna Resumen Financiero -->
                              <div class="col-lg-5 col-sm-5 col-xs-12 col-md-5">
                                      <div class="panel">
                                          <div class="panel-heading">
                                              <h4 class="modal-title"> <span class="badge bg-green">  <i class="fa fa-money fa-1x"></i> </span> {{Lang::get('reporte_grupos.texto_simple_resumen_financiero')}}</h4>
                                          </div>
                                          <div class="panel-body">
                                              <table id="tabla_resumen_financiero" class="table table-condensedres table-hover" cellspacing="0" width="100%">
                                                  <thead>
                                                      <tr>
                                                          <th><span class="mayusuculas"> {{Lang::get('reporte_grupos.texto_simple_modal_campo_tipo_ofrendas')}}</span></th>
                                                          <th>{{Lang::get('reporte_grupos.texto_simple_col_total')}}</th>
                                                          <th></th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                             
                                                      <tr>
                                                          
                                                          
                                                          <td>
                                                              <h4> {{Lang::get('reporte_grupos.texto_simple_diezmos')}} </h4>
                                                          </td>

                                                          <td>
                                                              <h4><label class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="">$</label> <label id="diezmos"> {{ $reporte->ofrendas()->where("tipo_ofrenda", 0)->sum('valor') }} </label> </h4> 

                                                          </td>
                                                              
                                                           <td>
                                                                
                                                                                                  
                                                          </td>
                                                          
                                                      </tr>

                                                       <tr>
                                                          
                                                          
                                                          <td>
                                                              <h4> {{Lang::get('reporte_grupos.texto_simple_ofrenda')}}  </h4>
                                                          </td>

                                                          <td>
                                                              <h4><label class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="">$</label> <label id="ofrendas"> {{ $reporte->ofrendas()->where("tipo_ofrenda", 1)->sum('valor') }} </label> </h4> 

                                                          </td>
                                                              
                                                           <td>
                                                                
                                                                                                  
                                                          </td>
                                                          
                                                      </tr>
                                                      <tr>
                                                          
                                                          
                                                          <td>
                                                              <h4> {{Lang::get('reporte_grupos.texto_simple_pactos')}} </h4>
                                                          </td>

                                                          <td>
                                                              <h4><label class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="">$</label> <label id="pactos"> {{ $reporte->ofrendas()->where("tipo_ofrenda", 2)->sum('valor') }} </label> </h4> 

                                                          </td>
                                                              
                                                           <td>
                                                                
                                                                                                  
                                                          </td>
                                                          
                                                      </tr>
                                                      <tr>
                                                          
                                                          
                                                          <td>
                                                              <h4>{{Lang::get('reporte_grupos.texto_simple_primicias')}}</h4>
                                                          </td>

                                                          <td>
                                                              <h4><label class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="">$</label> <label id="primicias"> {{ $reporte->ofrendas()->where("tipo_ofrenda", 5)->sum('valor') }} </label> </h4> 

                                                          </td>
                                                              
                                                           <td>
                                                                
                                                                                                  
                                                          </td>
                                                          
                                                      </tr>
                                                      <tr>
                                                          
                                                          
                                                          <td>
                                                              <h4> {{Lang::get('reporte_grupos.texto_simple_pro_templo')}} </h4>
                                                          </td>

                                                          <td>
                                                              <h4><label class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="">$</label> <label id="protemplo"> {{ $reporte->ofrendas()->where("tipo_ofrenda", 3)->sum('valor') }} </label> </h4> 

                                                          </td>
                                                              
                                                           <td>
                                                                
                                                                                                  
                                                          </td>
                                                          
                                                      </tr>

                                                      <tr>
                                                          <td>
                                                              <h4> {{Lang::get('reporte_grupos.texto_simple_siembra')}} </h4>
                                                          </td>

                                                          <td>
                                                              <h4><label class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="">$</label> <label id="siembras"> {{ $reporte->ofrendas()->where("tipo_ofrenda", 4)->sum('valor') }} </label> </h4> 

                                                          </td>
                                                              
                                                           <td>
                                                                
                                                                                                  
                                                          </td>
                                                          
                                                      </tr>

                                                      <tr>
                                                          <td>
                                                              <h4> {{Lang::get('reporte_grupos.texto_simple_otro')}} </h4>
                                                          </td>

                                                          <td>
                                                              <h4><label class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="">$</label> <label id="otros"> {{ $reporte->ofrendas()->where("tipo_ofrenda", 6)->sum('valor') }} </label> </h4> 

                                                          </td>
                                                              
                                                           <td>
                                                                
                                                                                                  
                                                          </td>
                                                          
                                                      </tr>
                                                      
                                                      <tr>
                                                          <td>
                                                              <h4> {{Lang::get('reporte_grupos.texto_simple_ofrenda_sueltas')}} </h4>
                                                          </td>

                                                          <td>
                                                              <h4><label class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="">$</label> <label id="sueltas"> {{ $reporte->ofrendas()->where("tipo_ofrenda", 7)->sum('valor') }} </label> </h4> 
                                                          </td>                                    
                                                      </tr>

                                                       <tr>
                                                          <td class="text-right">
                                                              <h4><b>{{Lang::get('reporte_grupos.texto_simple_col_total')}}</b></h4>
                                                          </td>

                                                          <td>
                                                              <h4><label class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="">$</label> <label id="total"> {{ $reporte->ofrendas()->sum('valor') }} </label> </h4> 
                                                          </td>
                                                              
                                                           <td>
                                                          </td>

                                                      </tr>
                                                  </tbody>
                                                  
                                              </table>
                                          </div> <!-- /box-body -->
                                      </div>
                                          
                              </div>
                                  <!-- /columna  Resumen Financiero -->   
                    </div>   

                    
                    <!-- inputs ofrenda suelta -->
                    <input id="valor_ofrenda_suelta" name="valor_ofrenda_suelta" type="text" class="hide form-control" placeholder=""/>
                    <textarea id="observacion_ofrenda_suelta" name="observacion_ofrenda_suelta" class=" hide form-control" rows="5"  maxlength="500" placeholder=""></textarea>
                    <!-- /input ofrenda suelta  -->
                    <!-- /row para el formulario -->  
                   </form>
              </section>
              <!-- contenido principal -->
            </aside>  
        </div>


        <!-- /modal mensaje para cuando se apruebe reporte -->
        <div id="msn_modal_aprobado_exito" class="modal modal-exito fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h3 class="titulo"> {{Lang::get('reporte_grupos.texto_simple_reporte_aprobado')}} </h3 class="titulo">
                </div>
                <div class="modal-body">
                      <h4 id="msn_aprobado_exito" class="modal-title bg-danger" id="myModalLabel"> {{Lang::get('reporte_grupos.texto_simple_mensaje')}}  </h4>
          
                </div>
                <div class="modal-footer">
                  <center><button id="btn_aprobado_exito"type="button" class="btn bg-light-redil" data-dismiss="modal">{{Lang::get('reporte_grupos.texto_boton_modal_aceptar')}}</button></center>
                </div>
            </div>
          </div>
        </div>
        <!-- /modal   -->



        @include('includes.scripts')
       
        

         <!-- DATA TABES SCRIPT -->
         <script src="{{ Lang::get('general.url-datatables') }}" type="text/javascript"></script>
        <script src="/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script src="/js/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
        

        <!-- page script -->
          <script type="text/javascript">
              
              $(document).ready(function() {

                $("#menu_grupos").children("a").first().trigger('click');

                var tabla_integrantes = $('#tabla_integrantes').dataTable({
                });

                var id_seleccionado={{$reporte->grupo_id}};

                var tabla_ofrendas= $('#ofrendas-integrante').dataTable( {
                  "bPaginate": true,
                  "bLengthChange": false,
                  "bFilter": false,
                  "bSort": true,
                  "bInfo": false,
                  "bAutoWidth": false
                                 
                });

                $('#example2').dataTable({
                });


                $('#aprobar_reporte').click (function () {                  

                  var id = $(this).attr("data-id");
                  $.ajax({url:"/reporte-grupos/aprueba-reporte-ajax/"+id,cache:false, type:"POST",success:function(resp)
                    {
                      if(resp=="aprobado")
                        $('#msn_aprobado_exito').html('<h3>{{Lang::get("reporte_grupos.texto_simple_mensaje_reporte_aprobado")}}</h3>');
                      else
                        $('#msn_aprobado_exito').html('<h3><b>{{Lang::get("reporte_grupos.texto_simple_mensaje_reporte_reprobado")}}</h3>');

                      $('#msn_modal_aprobado_exito').modal('show'); 

                    }
                  });

                });

                $('#btn_aprobado_exito').click (function () {
                  
                  $('#aprobar_reporte').hide(); // oculta el boton aprobar_reporte 

                  $('#estado-reporte').attr({
                     'class': 'label label-success col-lg-2 col-md-10 col-xs-12 col-sm-12'
                  });

                  $('#estado-reporte').html('<i id="icono-estado-reporte" class="fa fa-check-square"></i> Aprobado');

                });
                  
              });
          </script>

    </body>
</html>

@endif