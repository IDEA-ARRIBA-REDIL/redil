  @if(Auth::check())
  @include('includes.lenguaje')
  <!DOCTYPE html>
  <html>
      <head>
          <meta charset="UTF-8">
          <title>{{Lang::get('reporte_grupos.texto_reporte_index_titulo_pagina')}} |{{Lang::get('reporte_grupos.texto_nuevo_reporte_nombre_pagina')}}</title>
          <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
          @include('includes.styles')
          <!-- datepicker.css -->
          <link href="/css/datepicker.css" rel="stylesheet" type="text/css" />
          <link href="/css/datepicker3.css" rel="stylesheet" type="text/css" />
           <!-- DATA TABLES -->
          <link href="/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
          <link href="/css/bootstrap-switch/bootstrap-switch.css" rel="stylesheet">

          <!-- fullCalendar -->
        <link href="/css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <style type="text/css"> 
          .fc-event-container a:hover { 
          color: #eeeeee;  
          } 

          .bootstrap-switch.bootstrap-switch-small {
            min-width: 59px;
          }
          .icheckbox_minimal{
            width: 0px;
            height: 0px;
            margin-top: 25px;
          }
        </style> 
          
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

              <form id="form-reporte" action="../new" method="post" role="form" > 
              <!-- Right side column. Contains the navbar and content of the page -->
              <aside class="right-side">    
                           
                   <!-- contendio cabezote -->
                    <section class="content-header">
                      <div class="box-header">
                        <h3 class="content-header barra-titulo">
                             {{Lang::get('reporte_grupos.texto_nuevo_reporte_titulo_header')}}
                              <small> {{Lang::get('reporte_grupos.texto_nuevo_reporte_subtitulo_header')}} </small>
                        </h3>
                        <div class="pull-right box-tools">
                          <button id="btn-reportar" type="submit" class="btn btn-danger">{{Lang::get('reporte_grupos.texto_nuevo_reporte_boton_reportar')}} </button>
                          <a href="/reporte-grupos/lista/todos" class="btn bg-light-redil"> <i class="fa fa-undo"></i> {{Lang::get('reporte_grupos.texto_nuevo_reporte_boton_cancelar')}}</a>
                        </div>
                          
                          
                      </div>
                    </section>
                    <!-- /contendio cabezote -->
                   

               <!-- contenido principal -->
                <section class="content">
                  	
                		<!-- row para el formulario -->
                      <div class="container-fluid">

                        <div class="row">
                          <!-- columna del boton guardar -->
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <div class=" box-header" style="margin-bottom: 10px;">
                                <?php $status=Session::get('status');
                                $reporte=Session::get('reporte');?>
                                  @if($status=='ok_update')
                                  <div class="alert alert-success col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom:5px; padding-top:5px;" >
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{Lang::get('reporte_grupos.texto_nuevo_reporte_mensaje_reporte_creado')}} <a title='Clic Aqui!' target='blank' href='perfil/{{$reporte}}'> {{Lang::get('reporte_grupos.texto_nuevo_reporte_mensaje_reporte_creado2')}} </a>
                                  </div>
                                   @elseif($status=='error_update')
                                  <div class="alert alert-danger col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom:5px; padding-top:5px;" >
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <?php 
                                    $fecha_buscar=Session::get('fecha');
                                    $reporte=Session::get('reporte');
                                    ?>
                                   {{Lang::get('reporte_grupos.texto_nuevo_reporte_mensaje_reporte_existente')}} $reporte->grupo->nombre }} {{Lang::get('reporte.texto_nuevo_reporte_mensaje_reporte_existente2')}} {{ Session::get('fecha') }}, {{Lang::get('reporte.texto_nuevo_reporte_mensaje_reporte_existente3')}}<a title="Clic Aqui!" target='blank' href="perfil/{{ $reporte->id }}">{{Lang::get('reporte_grupos.texto_simple_reporte')}}</a> {{Lang::get('reporte.texto_nuevo_reporte_mensaje_reporte_existente4')}}
                                  </div>
                                  @endif
                              </div>
                          </div>
                          <!-- /columna del boton reportar -->
                        </div>
                        <div class="row">
                          <!-- columna Seleccionar grupo -->
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                  <div class="panel">
                                      <div class="panel-heading">
                                        <h4 class="modal-title">{{Lang::get('reporte_grupos.texto_nuevo_reporte_titulo_info_grupo')}}</h4>
                                      </div>              
                                      
                                      <div class="panel-body">
                                        <!-- grupo --> 
                                        <div class="nav navbar-nav panel-ppl-busqueda" style="margin-bottom: 30px;">
                                          <label> {{Lang::get('reporte_grupos.texto_nuevo_reporte_campo_seleccionar_grupo')}}</label>
                                          <li class="dropdown messages-menu">
                                            <div class="input-group "  >
                                              <input type="text" id="busqueda_grupo" class="form-control buscar" autocomplete="off" placeholder="{{Lang::get('reporte_grupos.texto_nuevo_reporte_campo_seleccionar_placeholder')}}"/>
                                              <span class="input-group-btn">
                                                <button type='button' class="btn btn-flat" style="border-color:#CCC;background:#fff" ><i class="fa fa-search" style="color:#00545E" ></i></button>
                                              </span>
                                            </div> 

                                            <ul id="panel-ppl-grupos" class="panel-busqueda-moviles dropdown-menu">
                                              <li>
                                                <!-- el siguiente es el panel que se llenara con los registros de la busqueda, se deja vacio -->
                                                <ul class="menu" id="panel-grupos">

                                                </ul>
                                              </li>
                                            </ul>
                                            <div class="footer">{{Lang::get('reporte_grupos.texto_simple_campo_resultado_busqueda')}}</div>
                                          </li>
                                        </div>  
                                        <div id="grupo-seleccionado">  

                                        </div>  

                                        @if(isset($grupo_seleccionado))
                                         <input id="grupo_id" name="grupo_id" type="text" class="form-control" value="{{ $grupo_seleccionado->id }}" placeholder="" title="Seleccione el grupo para poder continuar" required style="position:relative; top:-34px; z-index:-1;"/>
                                        @endif
                                        <!-- predicaicon o tema -->
                                            <div class="form-group">
                                               <label>{{Lang::get('reporte_grupos.texto_nuevo_reporte_campo_predicacion')}}</label>
                                               <input @if(!isset($grupo_seleccionado)) readonly @endif name="tema" type="text" class="form-control" placeholder="{{Lang::get('reporte_grupos.texto_nuevo_reporte_campo_predicacion_placeholder')}}" required/>
                                               <input id="finanzas" name="finanzas" class="hide" type="text" class="form-control" />
                                               <input id="finanzas_lideres" name="finanzas_lideres" class="hide" type="text" class="form-control" />
                                               <input id="ids_integrantes" name="ids_integrantes" class="hide" type="text" class="form-control" />
                                            </div>
                                            <!-- /predicaicon o tema -->
                                            <!-- Observaciones -->
                                            <div class="form-group">
                                                <label>{{Lang::get('reporte_grupos.texto_nuevo_reporte_campo_observaciones')}}</label>
                                                <textarea @if(!isset($grupo_seleccionado)) readonly @endif name="observacion" class="form-control" rows="5"  maxlength="500" placeholder=""></textarea>
                                            </div>
                                            <!-- /Observaciones -->
                                         
                                      </div>
                                  </div>
                            </div>
                          <!-- /columna  Seleccionar grupo -->


                          
                          <!-- columna Seleccionar grupo -->
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="panel">
                            <div id="titulo-calendario"  class="panel-heading">
                              <h4 class="modal-title">{{Lang::get('reporte_grupos.texto_nuevo_reporte_titulo_seleccione_fecha')}} @if(!isset($grupo_seleccionado))<small>   </small>@endif</h4> 
                              <div class="form-group" style="height:0px; margin:0px; top:-20px; left:-100px; position:relative;">
                                <input title="Seleccione una fecha valida en el calendario" required style="z-index: -1; position: relative; top:0px; height:0px;" id="seleccionaFecha" name="fecha" type="text" class="form-control" value="" autocomplete="off"/>
                              </div>
                            </div>
                            
                                  
                                <div class="box-body no-padding">
                                  <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <label style="display:none" class=" col-lg-12 badge bg-red" id="dia_seleccionado"> {{Lang::get('reportee_grupos.texto_nuevo_reporte_mensaje_error_fecha_grupo')}} </label>
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label style="font-size: 16px; display:none;" class="badge bg-green pull-right" id="fecha_seleccionada"> Jueves, 04 ar 2009 </label>
                                  </div>
                                    <!--The calendar -->
                                    <div id="calendar" style="margin-top: 10px;"></div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                               
                          </div>
                          <!-- /columna  Seleccionar reportar -->                          
                        </div>
                         
                        <div class="row">
                          <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                               <div class="panel">
                                      <div class="panel-heading">
                                          <h4 class="modal-title"><span class="badge bg-light-blue"> <i class="fa fa-male fa-1x"></i> <i class="fa fa-female fa-1x"></i></span>
                                            @if(isset($grupo_seleccionado))
                                              {{$grupo_seleccionado->asistentes()->count()}} {{Lang::get('reporte_grupos.texto_simple_integrantes')}}
                                            @else
                                            0 {{Lang::get('reporte_grupos.texto_simple_integrantes')}} <small>{{Lang::get('reporte_grupos.texto_nuevo_reporte_titulo_seleccione_fecha2')}} </small>
                                            @endif
                                            </h4>
                                      </div>
                                      
                                      <div class="panel-body">
                                          <!-- tabla -->
                                          <div id="div_integrantes">
                                            <div class="col-lg-12">
                                              <!-- cuadro lideres -->
                                              <div class="contador col-lg-4 col-md-4 col-sm-4 col-xs-6" data-toggle="tooltip" data-placement="top" title= "Muestra la cantidad de personas que asistieron al grupo incluyendo invitados">
                                                <div class="small-box bg-default">
                                                  <div class="inner">
                                                  <h3 id="label-total">
                                                    <span id="cantidad-total">0</span>
                                                  <small>
                                                        Total
                                                    </small></h3>
                                                    
                                                  </div>
                                                </div>
                                              </div> 
                                              <!-- /cuadro lideres -->

                                              <!-- cuadro pastores -->
                                              <div class="contador col-lg-4 col-md-4 col-sm-4 col-xs-6" data-toggle="tooltip" data-placement="top" title= "Muestra la cantidad de personas que no asistieron al grupo">
                                                <div class="small-box bg-default">
                                                  <div class="inner">
                                                      <h3 id="label-integrantes" >
                                                        <span id="cantidad-integrantes">0</span>
                                                        <small>
                                                           Integrantes
                                                      </small></h3>
                                                      
                                                  </div>
                                                </div>
                                              </div>
                                              <!-- /cuadro pastores -->

                                              <!-- cuadro invitados -->
                                              <div class="contador col-lg-4 col-md-4 col-sm-4 col-xs-12" data-toggle="tooltip" data-placement="top" title= "Muestra la cantidad de personas que no estan registradas en el sistema pero que asistieron al grupo">
                                                <div class="small-box bg-default">
                                                  <div class="inner">
                                                    <a @if(isset($grupo_seleccionado)) id="del-invitado" @endif class="badge pull-right bg-red"  style="width: 22px; height: 22px; font-size: 14px!important; font-weight: bold!important;font-family: 'Arial', 'Source Sans Pro', sans-serif!important;">-</a> 
                                                    <a @if(isset($grupo_seleccionado)) id="add-invitado" @endif class="badge pull-right bg-green" style="margin-right: 5px; width: 22px; height: 22px; font-size: 14px!important; font-weight: bold!important;font-family: 'Arial', 'Source Sans Pro', sans-serif!important;">+</a>
                                                    
                                                      <h3 id="label-invitados">
                                                        <span id="cantidad-invitados">0</span>
                                                        <input id="invitados" name="invitados" type="hidden" value="0" autocomplete="off"/>
                                                        <small>
                                                          Invitados
                                                      </small></h3>

                                                      
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                                <table id="tabla_integrantes" class="table-responsive table table-striped display stripe" cellspacing="0" width="100%">
                                                      <thead>
                                                          <tr>
                                                              <th>{{lang::get('reporte_grupos.texto_simple_col_asistente')}}</th>
                                                              <th class="text-center">{{Lang::get('reporte_grupos.texto_simple_col_info_financiera')}}</th>
                                                              <th class="text-center">{{Lang::get('reporte_grupos.texto_simple_col_asistencia')}}</th> 
                                                          </tr>
                                                      </thead>
                                                      <tbody>
                                                        @if(isset($grupo_seleccionado))
                                                              @foreach($grupo_seleccionado->asistentes()->get() as $integrante)
                                                                <tr>
                                                                  <td>
                                                                    <div class="col-lg-2 text-left" style="padding: 0px;">
                                                                      <a target="blank" href="/asistentes/perfil/{{ $integrante->id }}"><img src="/img/fotos/{{ $integrante->foto }}" class="img-circle" width="60px" alt="User Image"></a>
                                                                    </div> 
                                                                    <div class="col-lg-10" style="padding-right: 0px;">
                                                                      <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Codigo">Cod</label> {{$integrante->id}}<br>
                                                                      <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Nombre"> <i class="fa fa-user"></i></label> {{$integrante->nombre}} {{$integrante->apellido}}                                                                                
                                                                    </div>
                                                                  </td>
                                                                  
                                                                  <td style="vertical-align:text-middle;" valign="middle" class= "text-center">
                                                                     <h4 style="margin: 0px;"><label id="ofrenda_{{$integrante->id}}">$0 </label></h4>
                                                                          <a class="btn arrowed-right btn-sm btn-success abrir-panel-ofrendas" data-placement="top" data-nombre="{{$integrante->nombre}} {{$integrante->apellido}}" data-id="{{$integrante->id}}" data-toggle="modal" data-target=".modal-financiero"> <i class="fa fa-money fa-1x"></i> {{Lang::get('reporte_grupos.texto_simple_boton_añadir_ingreso')}} </a> 
                                                                                                                                               
                                                                  </td>
                                                                  
                                                                  <td valign="middle" class= "text-left">
                                                                                <input class="asistencia" id="{{ $integrante->id }}" name="asistio{{$integrante->id}}" type="checkbox"/>
                                                                            
                                                                  </td>
                                                                  
                                                              </tr>
                                                              @endforeach


                                                      @endif
                                                                 
                                                         
                                                      </tbody>
                                                      
                                                  </table>
                                                  <input type="hidden" id="asistencia" name="asistencia" class="form-control" />
                                           </div>
                                           <!-- /tabla -->
                                      </div>
                                   </div>
                          </div>

                          <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                               <div class="panel">
                                      <div class="panel-heading">
                                          <h4 class="modal-title">
                                             @if(isset($grupo_seleccionado))
                                              {{$grupo_seleccionado->encargados()->count()}} {{Lang::get('reporte_grupos.texto_simple_campo_encargado')}}
                                            @else
                                            0 {{Lang::get('reporte_grupos.texto_simple_campo_encargado')}} <small>{{Lang::get('reporte_grupos.texto_nuevo_reporte_titulo_seleccione_fecha2')}} </small>
                                            @endif
                                                
                                            </h4>
                                      </div>
                                      
                                      <div class="panel-body">
                                          <!-- tabla -->
                                          <div id="div_integrantes">
                                            
                                                <table id="tabla_lideres" class="table-responsive table table-striped display stripe" cellspacing="0" width="100%">
                                                      <thead>
                                                          <tr>
                                                              <th>{{lang::get('reporte_grupos.texto_simple_col_asistente')}}</th>
                                                              <th class="text-center">{{Lang::get('reporte_grupos.texto_simple_col_info_financiera')}}</th>
                                                          </tr>
                                                      </thead>
                                                      <tbody>
                                                         @if(isset($grupo_seleccionado))
                                                              @foreach($grupo_seleccionado->encargados()->get() as $integrante)
                                                                <tr>
                                                                  <td>
                                                                    <div class="col-lg-3 text-left" style="padding: 0px;">
                                                                      <a target="blank" href="/asistentes/perfil/{{ $integrante->id }}"><img src="/img/fotos/{{ $integrante->foto }}" class="img-circle" width="60px" alt="User Image"></a>
                                                                    </div> 
                                                                    <div class="col-lg-9" style="padding-right: 0px;">
                                                                      <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Codigo">Cod</label> {{$integrante->id}}<br>
                                                                      <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Nombre"> <i class="fa fa-user"></i></label> {{$integrante->nombre}} {{$integrante->apellido}}                                                                                
                                                                    </div>
                                                                  </td>
                                                                  
                                                                  <td style="vertical-align:text-middle;" valign="middle" class= "text-center">
                                                                     <h4 style="margin: 0px;"><label id="ofrenda_{{$integrante->id}}">$0 </label></h4>
                                                                          <a class="btn arrowed-right btn-sm btn-success abrir-panel-ofrendas-lider" data-placement="top" data-nombre="{{$integrante->nombre}} {{$integrante->apellido}}" data-id="{{$integrante->id}}" data-toggle="modal" data-target=".modal-financiero-lideres"> <i class="fa fa-money fa-1x"></i> {{Lang::get('reporte_grupos.texto_simple_boton_anadir_ofrenda')}} </a>                                                                       
                                                                  </td>
                                                                  
                                                                  
                                                              </tr>
                                                              @endforeach
                                                          @endif                                                         
                                                      </tbody>
                                                      
                                                  </table>
                                           </div>
                                           <!-- /tabla -->
                                      </div>
                                   </div>
                                  </div>
                          

                          <!-- columna Resumen Financiero -->
                          <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                              <div class="panel">
                                  <div class="panel-heading">
                                      <h4 class="modal-title"> <span class="badge bg-green">  <i class="fa fa-money fa-1x"></i> </span> {{Lang::get('reporte_grupos.texto_simple_titulo_resumen_financiero')}}</h4>
                                  </div>
                                  <div class="panel-body">
                                      <table id="tabla_resumen_financiero" class="table table-condensedres table-hover" cellspacing="0" width="100%">
                                          <thead>
                                              <tr>
                                                  <th>{{Lang::get('reporte_grupos.texto_simple_col_tipo_ofrenda')}}</th>
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
                                                      <h4><label class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="">$</label> <label id="diezmos"> 0 </label> </h4> 

                                                  </td>
                                                      
                                                   <td>
                                                        
                                                                                          
                                                  </td>
                                                  
                                              </tr>

                                               <tr>
                                                  
                                                  
                                                  <td>
                                                      <h4> {{Lang::get('reporte_grupos.texto_simple_ofrenda')}} </h4>
                                                  </td>

                                                  <td>
                                                      <h4><label class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="">$</label> <label id="ofrendas"> 0 </label> </h4> 

                                                  </td>
                                                      
                                                   <td>
                                                        
                                                                                          
                                                  </td>
                                                  
                                              </tr>
                                              <tr>
                                                  
                                                  
                                                  <td>
                                                      <h4> {{Lang::get('reporte_grupos.texto_simple_pactos')}} </h4>
                                                  </td>

                                                  <td>
                                                      <h4><label class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="">$</label> <label id="pactos"> 0 </label> </h4> 

                                                  </td>
                                                      
                                                   <td>
                                                        
                                                                                          
                                                  </td>
                                                  
                                              </tr>
                                              <tr>
                                                  
                                                  
                                                  <td>
                                                      <h4> {{Lang::get('reporte_grupos.texto_simple_primicias')}} </h4>
                                                  </td>

                                                  <td>
                                                      <h4><label class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="">$</label> <label id="primicias"> 0 </label> </h4> 

                                                  </td>
                                                      
                                                   <td>
                                                        
                                                                                          
                                                  </td>
                                                  
                                              </tr>
                                              <tr>
                                                  
                                                  
                                                  <td>
                                                      <h4> {{Lang::get('reporte_grupos.texto_simple_pro_templo')}} </h4>
                                                  </td>

                                                  <td>
                                                      <h4><label class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="">$</label> <label id="protemplo"> 0 </label> </h4> 

                                                  </td>
                                                      
                                                   <td>
                                                        
                                                                                          
                                                  </td>
                                                  
                                              </tr>

                                              <tr>
                                                  
                                                  
                                                  <td>
                                                      <h4> {{Lang::get('reporte_grupos.texto_simple_siembra')}} </h4>
                                                  </td>

                                                  <td>
                                                      <h4><label class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="">$</label> <label id="siembras"> 0 </label> </h4> 

                                                  </td>
                                                      
                                                   <td>
                                                        
                                                                                          
                                                  </td>
                                                  
                                              </tr>

                                              <tr>
                                                  
                                                  
                                                  <td>
                                                      <h4>{{Lang::get('reporte_grupos.texto_simple_otro')}} </h4>
                                                  </td>

                                                  <td>
                                                      <h4><label class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="">$</label> <label id="otros"> 0 </label> </h4> 

                                                  </td>
                                                      
                                                   <td>
                                                        
                                                                                          
                                                  </td>
                                                  
                                              </tr>
                                              
                                              <tr>
                                                  <td>
                                                      <h4> {{Lang::get('reporte_grupos.texto_simple_ofrenda_sueltas')}} </h4>
                                                  </td>

                                                  <td>
                                                      <h4><label class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="">$</label> <label id="sueltas"> 0 </label> </h4> 
                                                  </td>
                                                      
                                                   <td> 
                                                    @if(isset($grupo_seleccionado))
                                                      <button id="abrir_modal_o_s" class="btn btn-danger btn-sm" data-toggle="modal" data-target=".modal-ofrenda-suelta"> <i class="fa ">+</i> {{Lang::get('reporte_grupos.texto_simple_boton_anadir')}} </button>
                                                    @endif                                                 
                                                  <!--
                                                      <input name="ofrenda_suelta" type="number" class="form-control" placeholder="$" data-toggle="tooltip" data-placement="top" title="Si hay ofrenda suelta ingrese el valor en este campo, de lo contrario simplemente dejelo vacio"/>
                                                  --></td>
                                                  
                                              </tr>

                                               <tr>
                                                  <td class="text-right">
                                                      <h4><b>{{Lang::get('reporte_grupos.texto_simple_col_total')}}</b></h4>
                                                  </td>

                                                  <td>
                                                      <h4><label class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="">$</label> <label id="total"> 0 </label> </h4> 
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
                           

                        <div class="row">
                          <!-- columna del boton reportar -->
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <div class=" box-header">
                                    <button type="submit" class="btn btn-danger">{{Lang::get('reporte_grupos.texto_nuevo_reporte_boton_reportar')}}</button>
                                    <a href="/reporte-grupos/lista/todos" class="btn bg-light-redil"> <i class="fa fa-undo"></i> {{Lang::get('reporte_grupos.texto_nuevo_reporte_boton_cancelar')}}</a>
                              </div>
                          </div>
                           <!-- /columna del boton reportar -->
                        </div>
                          
                    
                     </div>  
                      <!-- inputs ofrenda suelta -->
                      <input id="valor_ofrenda_suelta" name="valor_ofrenda_suelta" type="text" class="hide form-control" placeholder=""/>
                      <textarea id="observacion_ofrenda_suelta" name="observacion_ofrenda_suelta" class=" hide form-control" rows="5"  maxlength="500" placeholder=""></textarea>
                      <!-- /input ofrenda suelta  -->
                      <!-- /row para el formulario -->  
                     
                </section>
                <!-- contenido principal -->
                
              </aside>  
              </form>
          </div>



              <!-- modal informacion financiera de los integrantes -->
              <div class="modal fade modal-financiero" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                      <h4 id="titulo-informacion-financiera" class="modal-title" id="myModalLabel">{{Lang::get('reporte_grupos.texto_simple_modal_titulo_ofrendas')}} </h4>
                                  </div>
                              <div class="modal-body">

                                  <div class="box box-filtro " >
                                    
                                    <div class="box-body">
                                      <!-- Valor -->
                                        <div class="form-group col-lg-6">
                                           <label>{{Lang::get('reporte_grupos.texto_simple_modal_campo_valor_ofrendas')}}</label>
                                           <input id="valor" type="text" class="number form-control" placeholder=""/>
                                        </div>
                                        <!-- /valor -->
                                        <!-- Tipo de id -->
                                             <div class="form-group col-lg-6">
                                                      <label>{{Lang::get('reporte_grupos.texto_simple_modal_campo_tipo_ofrendas')}}</label>
                                                      <select id="tipo-ofrenda" class="form-control">
                                                          <option value=""></option>
                                                          <option value="0">{{Lang::get('reporte_grupos.texto_simple_diezmos')}}</option>
                                                          <option value="1">{{Lang::get('reporte_grupos.texto_simple_ofrenda')}}</option>
                                                          <option value="2">{{Lang::get('reporte_grupos.texto_simple_pactos')}}</option>
                                                          <option value="3">{{Lang::get('reporte_grupos.texto_simple_pro_templo')}}</option>
                                                          <option value="4">{{Lang::get('reporte_grupos.texto_simple_siembra')}}</option>
                                                          <option value="5">{{Lang::get('reporte_grupos.texto_simple_primicias')}}</option>
                                                          <option value="6">{{Lang::get('reporte_grupos.texto_simple_otro')}}</option>
                                                      </select>
                                             </div>
                                             <!-- /tipo de id -->
                                        <!-- Observaciones -->
                                        <div class="form-group col-lg-12">
                                            <label>{{Lang::get('reporte_grupos.texto_nuevo_reporte_campo_observaciones')}}</label>
                                            <textarea id="observacion" class="form-control" rows="2"  maxlength="500" placeholder=""></textarea>
                                        </div>
                                        <!-- /Observaciones -->

                                         <!-- Boton añadir -->
                                         <div class="col-lg-12">
                                        <div id="error_add_ofrenda" class="alert alert-danger col-lg-8" style="display:none;" >
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                          {{Lang::get('reporte_grupos.texto_simple_modal_mesajes_campos_por_llenar')}}                                   
                                        </div>
                                        <button class="col-lg-3 add-ofrenda btn btn-success btn-lg pull-right" ><i class="fa fa-plus"></i> {{Lang::get('reporte_grupos.texto_simple_boton_anadir')}}</button>
                                        </div>
                                    </div>
                                  </div> <br><br>
                                        <!-- /Boton añadir -->
                                      <table id="ofrendas-integrante" class="table table-striped display stripe" cellspacing="0" width="100%">
                                          <thead>
                                              <tr>
                                                  <th><span class="mayusculas"> {{Lang::get('reporte_grupos.texto_simple_modal_campo_valor_ofrendas')}} </span></th>
                                                  <th><span class="mayusculas">{{Lang::get('reporte_grupos.texto_simple_modal_campo_tipo_ofrendas')}} </span> </th>
                                                  <th><span class="mayusculas">{{Lang::get('reporte_grupos.texto_nuevo_reporte_campo_observaciones')}} </span></th>
                                                  <th></th>
                                                  
                                                  
                                            </tr>
                                          </thead>
                                          <tbody>
                                                     
                                              
                                          </tbody>
                                          
                                      </table>
                                  </div>
                              </div>
                      </div>
              </div>


              <!-- modal informacion financiera lideres -->
              <div class="modal fade modal-financiero-lideres" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                      <h4 id="titulo-informacion-financiera-lider" class="modal-title" id="myModalLabel">{{Lang::get('reporte_grupos.texto_simple_modal_titulo_ofrendas')}}</h4>
                                  </div>
                              <div class="modal-body">

                                  <div class="box box-filtro " >
                                    
                                    <div class="box-body">
                                      <!-- Valor -->
                                        <div class="form-group col-lg-6">
                                           <label>{{Lang::get('reporte_grupos.texto_simple_modal_campo_valor_ofrendas')}}</label>
                                           <input id="valor_lider" type="text" class="number form-control" placeholder=""/>
                                        </div>
                                        <!-- /valor -->
                                        <!-- Tipo de id -->
                                             <div class="form-group col-lg-6">
                                                      <label>{{Lang::get('reporte_grupos.texto_simple_modal_campo_tipo_ofrendas')}}</label>
                                                      <select id="tipo-ofrenda-lider" class="form-control">
                                                          <option value=""></option>
                                                          <option value="0">{{Lang::get('reporte_grupos.texto_simple_diezmos')}}</option>
                                                          <option value="1">{{Lang::get('reporte_grupos.texto_simple_ofrenda')}}</option>
                                                          <option value="2">{{Lang::get('reporte_grupos.texto_simple_pactos')}}</option>
                                                          <option value="3">{{Lang::get('reporte_grupos.texto_simple_pro_templo')}}</option>
                                                          <option value="4">{{Lang::get('reporte_grupos.texto_simple_siembra')}}</option>
                                                          <option value="5">{{Lang::get('reporte_grupos.texto_simple_primicias')}}</option>
                                                          <option value="6">{{Lang::get('reporte_grupos.texto_simple_otro')}}</option>
                                                      </select>
                                             </div>
                                             <!-- /tipo de id -->
                                        <!-- Observaciones -->
                                        <div class="form-group col-lg-12">
                                            <label>{{Lang::get('reporte_grupos.texto_nuevo_reporte_campo_observaciones')}}</label>
                                            <textarea id="observacion-lider" class="form-control" rows="2"  maxlength="500" placeholder=""></textarea>
                                        </div>
                                        <!-- /Observaciones -->

                                         <!-- Boton añadir -->
                                         <div class="col-lg-12">
                                        <div id="error_add_ofrenda" class="alert alert-danger col-lg-8" style="display:none;" >
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                          {{Lang::get('reporte_grupos.texto_simple_modal_mesajes_campos_por_llenar')}}                                   
                                        </div>
                                        <button class="col-lg-3 add-ofrenda-lider btn btn-success btn-lg pull-right" ><i class="fa fa-plus"></i>  {{Lang::get('reporte_grupos.texto_simple_boton_anadir')}}</button>
                                        </div>
                                    </div>
                                  </div> <br><br>
                                        <!-- /Boton añadir -->
                                      <table id="ofrendas-lideres" class="table table-striped display stripe" cellspacing="0" width="100%">
                                          <thead>
                                              <tr>
                                                  <th><span class="mayusculas"> {{Lang::get('reporte_grupos.texto_simple_modal_campo_valor_ofrendas')}} </span></th>
                                                  <th><span class="mayusculas">{{Lang::get('reporte_grupos.texto_simple_modal_campo_tipo_ofrendas')}} </span> </th>
                                                  <th><span class="mayusculas">{{Lang::get('reporte_grupos.texto_nuevo_reporte_campo_observaciones')}} </span></th>
                                                  <th></th>
                                                  
                                                  
                                            </tr>
                                          </thead>
                                          <tbody>
                                                     
                                              
                                          </tbody>
                                          
                                      </table>
                                  </div>
                              </div>
                      </div>
              </div>

              <!-- modal informacion ofrenda suelta  -->
                      <div class="modal fade modal-ofrenda-suelta" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                      <h4 class="modal-title" id="myModalLabel"><i class="fa fa-money fa-1x"></i> {{Lang::get('reporte_grupos.texto_simple_modal_ofrenda_suelta')}}</h4>
                                  </div>
                              <div class="modal-body">
                                    
                                    <div class="box-body">
                                      <!-- Valor -->
                                        <div class="form-group">
                                           <label>{{Lang::get('reporte_grupos.texto_simple_modal_campo_valor_ofrendas')}}</label>
                                           <input id="valor_o_s" type="text" class="number form-control" placeholder="" required/>
                                           
                                        </div>
                                        <!-- /valor -->
                                        <!-- Observaciones -->
                                        <div class="form-group">
                                            <label>{{Lang::get('reporte_grupos.texto_simple_modal_ofrenda_suelta_observaciones')}}</label>
                                            <textarea id="observacion_o_s" class="form-control" rows="5"  maxlength="500" placeholder=""></textarea>
                                            
                                        </div>
                                        <!-- /Observaciones -->
                                        <div class="modal-footer">
                                          <!-- Boton añadir -->
                                          <button class="add-ofrenda-suelta btn btn-success btn-md" data-dismiss="modal" ><i class="fa fa-save"></i> {{Lang::get('reporte_grupos.texto_simple_boton_guardar')}}</button>  
                                          <button type="button" class="btn btn-danger btn-md" data-dismiss="modal"><i class="fa fa-times-cricle"></i>   {{Lang::get('reporte_grupos.texto_nuevo_reporte_boton_cancelar')}}</button>
                                        </div>
                                    </div>
                                  </div> 
                              </div>
                          </div>
                      </div>
                                          
          <div id="mensaje" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">{{Lang::get('reporte_grupos.texto_simple_mensaje_advertencia')}}</h4>
                </div>
                <div class="modal-body">
                  <p>{{Lang::get('reporte_grupos.texto_simple_mensaje_grupo_sin_dia')}}</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">{{Lang::get('reporte_grupos.texto_simple_boton_cerrar')}}</button>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

          <div id="mensaje_al_dia" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-green">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">{{Lang::get('reporte_grupos.texto_simple_modal_grupo_al_dia')}}</h4>
                </div>
                <div class="modal-body bg-green">
                  <p id="mensaje-reporte-al-dia">{{Lang::get('reporte_grupos.texto_simple_mensaje_grupo_al_dia')}}</p>
                </div>
                <div class="modal-footer">
                  <button id="continuar-reporte" class="btn btn-success btn-md" ><i class="fa fa-check-square"></i>  {{Lang::Get('reporte_grupos.texto_simple_continuar_reporte')}}</button>  
                  <button type="button" class="btn btn-danger btn-md" data-dismiss="modal"><i class="fa fa-times-cricle"></i>   {{Lang::get('reporte_grupos.texto_simple_reporte_otro_grupo')}}</button>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

          
          @include('includes.scripts')
         
          <!-- jQuery UI 1.10.3 -->
        <script src="/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>

           <!-- DATA TABES SCRIPT -->
           <script src="{{ Lang::get('general.url-datatables') }}" type="text/javascript"></script>
          <script src="/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
          <script src="/js/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
          
          <!-- bootstra datepicker-->
          <script src="/js/bootstrap-datepicker.js"></script>
          <script src="/js/locales/bootstrap-datepicker.es.js"></script>

          <!-- script de busqueda tìpo facebook -->
        <script src="/js/AdminLTE/busqueda-fc.js" type="text/javascript"></script>


          <script src="/js/bootstrap-switch.js"></script>

          <!-- fullCalendar -->
            @include('includes.calendario-reportes-grupo');
          <!-- fin codigos calendario -->

          });
        </script>

        <!-- Script de funciones para  añadir invitados-->
        <script type="text/javascript">     
          var invitados=0;
          var total=0;
          var integrantes=0;
          $('#add-invitado').click(function () {
            invitados++;
            total++;
            $("#cantidad-invitados").html(invitados);
            $("#cantidad-total").html(total);
            $("#invitados").val(invitados);
          });

          $('#del-invitado').click(function () {
            if(invitados>0){
              invitados--;
              total--;
              $("#cantidad-invitados").html(invitados);
              $("#cantidad-total").html(total);
              $("#invitados").val(invitados);
            }
          });

          $('.asistencia').on('switchChange.bootstrapSwitch', function(event, state) {
            if($(this).is(':checked'))
            {
              integrantes++;
              total++;
              $("#cantidad-integrantes").html(integrantes);
              $("#cantidad-total").html(total);
            }
            else
            {
              integrantes--;
              total--;
              $("#cantidad-integrantes").html(integrantes);
              $("#cantidad-total").html(total);
            }
          });
        </script>

        <!-- Script de funciones para las busquedas de grupos (palabra principal y diezmos)-->
        <script type="text/javascript">                  

        var nombre_class_grupo="grupo";
        ///este es el panel donde se cargaran los registros seleccioandos por el usuario
        var panel_grupo_seleccionado=$("#grupo-seleccionado"); 

        function seleccionar_grupo(){
          $('.seleccionar-'+nombre_class_grupo).unbind('click');///primero se eliminan todos los ateriores eventos click
          $('.seleccionar-'+nombre_class_grupo).click(function () {
            var idgrupo = $(this).attr("data-id");
            window.location.href = "/reporte-grupos/nuevo/"+idgrupo;
          });
        } 


        function construyeItemgrupo(id, panel, input, nombre_cl){
          // solo añade el cargando si no existe ya uno en pantalla.
          if (!$('#grupo-seleccionada #item-cargando').length){
           panel_grupo_seleccionado.html('<div style="padding: 5px;" id="item-cargando" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><center><img class="img-responsive" src="/img/ajax-loader1.gif" /><center></div>'); 
          }
          ///el primer parametro es el ID el segundo el nombre de la class adicionales, el tercero cantidad de col para lg y md y el cuarto cantidad de col para sm y xs
          $.ajax({url:"/grupos/grupo-seleccionado/"+id+"/"+nombre_cl+"/12/12",cache:false, type:"POST",success:function(resp)
            {
              panel.html(resp);///si se quiere añadir un item en lugar de reemplazar se cambia por .append 
              $("#ico-"+nombre_cl).css("height", $("#info-"+nombre_cl).height());
              $('.cerrar-'+nombre_cl+'-seleccionado').click(function () {
                //alert("jeje");
                window.location.href = "/reporte-grupos/nuevo";
              }); 
            }
          });
        }

        $(document).ready(function() {
          sql_adicional="";
          //se crea un objeto de la Clase BusquedaFB y se cargan los primeros registros
          var busqueda_grupo = new BusquedaFB($("#busqueda_grupo"), $("#panel-ppl-grupos"), "panel-grupos", "/grupos/obtiene-grupos-para-busqueda-ajax/"+nombre_class_grupo+"/todos", seleccionar_grupo, sql_adicional);
          busqueda_grupo.cargarPrimerosRegistros();


          ///las sgtes grupos cargan los registros seleccionados
          @if(isset($grupo_seleccionado))
          construyeItemgrupo({{ $grupo_seleccionado->id }}, panel_grupo_seleccionado, $("#grupo_id"), nombre_class_grupo);
          @endif

          ///en caso de que el panel de resultados de la busqueda se necesite abrir con 
          ///un evento se colocan las siguientes grupos, en este caso con el evento focus del input de busqueda
          $("#busqueda_grupo").focus(function() {
            busqueda_grupo.muestraPanel($("html"));
          });

        });
        </script>
        <!--Finaliza Script del document ready para la busqueda de grupos-->
          <!-- page script -->
        
        <script type="text/javascript">
        $(document).ready(function() {
          ///despliega el menu de grupos
          $("#menu_grupos").children("a").first().trigger('click');

                      $(".asistencia").bootstrapSwitch({
                        onText: 'Si',
                        offText: 'No',
                        onColor: "success",
                        offColor: "danger",
                        size: 'small',
                      });

                      var asistencia= new Array();

                      //////////////////el siguiente codigo es para guardar la asistencia de integrantes del frupo en un iput que se enviará al otro lado
                      $('.asistencia').on('switchChange.bootstrapSwitch', function(event, state) {
                        var asistio= $(this).attr("id");
                        if($(this).is(':checked'))
                          asistencia.push(asistio);
                        else
                        {
                          var pos=asistencia.indexOf($(this).attr('id')); // obtengo la posicion de arreglo segun el data-id
                          //alert("arreglo: "+pasos_culminados+" elemento: "+$(this).attr('id')+" pos: "+pos);
                          asistencia.splice(pos,1);
                        }
                        //alert(pasos_culminados);
                        if(asistencia.length==0)
                          $("#asistencia").val("");
                        else
                          $("#asistencia").val(asistencia);
                        //alert(asistencia);
                      });

                      

                          var dia_reunion;
                          var aPos;///esta variable me guarda la posicion de la tabla a la que le dieron clic para abrir el panel de ofrendas
                          var diezmos=0, ofrendas=0, pactos=0, primicias=0;
                          var total=0, protemplo=0, siembras=0, otros=0;
                          var cant_ofrendas=0;

                          
                          var finanzas= new Array();
                          var finanzas_lideres= new Array();
                          var ids_integrantes= new Array();
                          

                          @if(isset($grupo_seleccionado))
                          @foreach($grupo_seleccionado->asistentes()->get() as $integrante)
                            finanzas.push(new Array({{$integrante->id}}, new Array(), 0));
                            ids_integrantes.push({{$integrante->id}});
                          @endforeach

                          @foreach($grupo_seleccionado->encargados()->get() as $integrante)
                            finanzas_lideres.push(new Array({{$integrante->id}}, new Array(), 0));
                          @endforeach
                          @endif

                          $('#ids_integrantes').val(ids_integrantes);
                          
                          var tabla_ofrendas= $('#ofrendas-integrante').dataTable( {
                              "bPaginate": false,
                              "bLengthChange": false,
                              "bFilter": false,
                              "bSort": true,
                              "bInfo": false,
                              "bAutoWidth": false
                               
                          });

                          var tabla_ofrendas_lideres= $('#ofrendas-lideres').dataTable( {
                              "bPaginate": false,
                              "bLengthChange": false,
                              "bFilter": false,
                              "bSort": true,
                              "bInfo": false,
                              "bAutoWidth": false
                               
                          });

                          $('.abrir-panel-ofrendas').click (function () {
                            tabla_ofrendas.fnClearTable();
                            var nombre_integrantre=$(this).attr('data-nombre');
                            $("#titulo-informacion-financiera").html("{{Lang::get('reporte_grupos.texto_simple_modal_titulo_ofrendas')}} - <b class='text-uppercase'>"+nombre_integrantre+"</b>");
                            var fila = $(this).parent().parent().get(0); // this line did the trick
                            aPos = tabla_integrantes.fnGetPosition(fila); ///me tiene la posicion del tr al que le dieron clic para abrir el panel de ofrendas
                            var count=finanzas[aPos][1].length;
                            
                            
                            for(var i=0; i<count; i++)
                            {
                                var tipo_ofrenda="";
                                if(finanzas[aPos][1][i][1]==0) tipo_ofrenda="Diezmo";
                                else if(finanzas[aPos][1][i][1]==1) tipo_ofrenda="Ofrenda";
                                else if(finanzas[aPos][1][i][1]==2) tipo_ofrenda="Pacto";
                                else if(finanzas[aPos][1][i][1]==3) tipo_ofrenda="Pro-templo";
                                else if(finanzas[aPos][1][i][1]==4) tipo_ofrenda="Siembra";
                                else if(finanzas[aPos][1][i][1]==5) tipo_ofrenda="Primicia";
                                else if(finanzas[aPos][1][i][1]==6) tipo_ofrenda="Otro";

                                tabla_ofrendas.fnAddData([Moneda(finanzas[aPos][1][i][0]+""),tipo_ofrenda,finanzas[aPos][1][i][2],'<a class="borrar-ofrenda'+i+' btn btn-danger btn-sm" > <b>X</b> </a>']);

                                $('.borrar-ofrenda'+i).click (function () {
                                  var target_row = $(this).parent().parent().get(0); // this line did the trick
                                  var fila = tabla_ofrendas.fnGetPosition(target_row); 
                                  tabla_ofrendas.fnDeleteRow(fila);
                                  eliminada=finanzas[aPos][1].splice(fila, 1);
                                  finanzas[aPos][2]-=parseInt(eliminada[0]);
                                  $("#ofrenda_"+finanzas[aPos][0]).html("$"+Moneda(finanzas[aPos][2]+""));
                                  total-=(parseInt(eliminada[0][0]));
                                  $("#total").html(total);

                                  if(eliminada[0][1]==0)
                                  {
                                      diezmos-=(parseInt(eliminada[0][0]));
                                      $("#diezmos").html(Moneda(diezmos+""));
                                  }
                                  else if(eliminada[0][1]==1)
                                  {
                                      ofrendas-=(parseInt(eliminada[0][0]));
                                      $("#ofrendas").html(Moneda(ofrendas+""));
                                  }
                                  else if(eliminada[0][1]==2)
                                  {
                                      pactos-=(parseInt(eliminada[0][0]));
                                      $("#pactos").html(Moneda(pactos+""));
                                  }
                                  else if(eliminada[0][1]==3)
                                  {
                                      protemplo-=(parseInt(eliminada[0][0]));
                                      $("#protemplo").html(Moneda(protemplo+""));
                                  }
                                  else if(eliminada[0][1]==4)
                                  {
                                      siembras-=(parseInt(eliminada[0][0]));
                                      $("#siembras").html(Moneda(siembras+""));
                                  }
                                  else if(eliminada[0][1]==5)
                                  {
                                      primicias-=(parseInt(eliminada[0][0]));
                                      $("#primicias").html(Moneda(primicias+""));
                                  }
                                  else if(eliminada[0][1]==6)
                                  {
                                      otros-=(parseInt(eliminada[0][0]));
                                      $("#otros").html(Moneda(otros+""));
                                  }

                                  cant_ofrendas--;
                                  $("#finanzas").val(JSON.stringify(finanzas));
                                  $("#valor").focus();
                                });
                            }

                            ///al abrir el panel se perdia el foco asi que se hace el focus unas milesimas despues de que abre el panel
                            setTimeout(function() {
                                $("#valor").focus();
                            }, 500);
                            
                          }); 

                          

                          $('.add-ofrenda').click (function () {

                              if($("#valor").val()!="" && $("#tipo-ofrenda").val()!="")
                              {
                                  var tipo_ofrenda="";
                                  finanzas[aPos][1].push(new Array($("#valor").val(), $("#tipo-ofrenda").val(), $("#observacion").val()));
                                  if($("#tipo-ofrenda").val()==0){
                                      tipo_ofrenda="Diezmo";
                                      diezmos+=parseInt($("#valor").val());
                                      $("#diezmos").html(Moneda(diezmos+""));
                                  } 
                                  else if($("#tipo-ofrenda").val()==1)
                                  {
                                      tipo_ofrenda="Ofrenda";
                                      ofrendas+=parseInt($("#valor").val());
                                      $("#ofrendas").html(Moneda(ofrendas+""));
                                  } 
                                  else if($("#tipo-ofrenda").val()==2)
                                  {
                                      tipo_ofrenda="Pacto";
                                      pactos+=parseInt($("#valor").val());
                                      $("#pactos").html(Moneda(pactos+""));
                                  } 
                                  else if($("#tipo-ofrenda").val()==3)
                                  {
                                      tipo_ofrenda="Pro-templo";
                                      protemplo+=parseInt($("#valor").val());
                                      $("#protemplo").html(Moneda(protemplo+""));
                                  } 
                                  else if($("#tipo-ofrenda").val()==4)
                                  {
                                      tipo_ofrenda="Siembra";
                                      siembras+=parseInt($("#valor").val());
                                      $("#siembras").html(Moneda(siembras+""));
                                  } 
                                  else if($("#tipo-ofrenda").val()==5){
                                      tipo_ofrenda="Primicia";
                                      primicias+=parseInt($("#valor").val());
                                      $("#primicias").html(Moneda(primicias+""));
                                  } 
                                  else if($("#tipo-ofrenda").val()==6)
                                  {
                                      tipo_ofrenda="Otro";
                                      otros+=parseInt($("#valor").val());
                                      $("#otros").html(Moneda(otros+""));
                                  } 
                                  finanzas[aPos][2]+=parseInt($("#valor").val());
                                  $("#ofrenda_"+finanzas[aPos][0]).html("$"+Moneda(finanzas[aPos][2]+""));
                                  total+=parseInt($("#valor").val());
                                  $("#total").html(Moneda(total+""));
                                  tabla_ofrendas.fnAddData( [
                                      Moneda($("#valor").val()),
                                      tipo_ofrenda,
                                      $("#observacion").val(),
                                  '<a class="borrar-ofrenda'+cant_ofrendas+' btn btn-danger btn-sm" > <b>X</b> </a>'
                                  ]);
                                  $('.borrar-ofrenda'+cant_ofrendas).click (function () {
                                      var target_row = $(this).parent().parent().get(0); // this line did the trick
                                      var fila = tabla_ofrendas.fnGetPosition(target_row); 
                                      tabla_ofrendas.fnDeleteRow(fila);
                                      eliminada=finanzas[aPos][1].splice(fila, 1);
                                      finanzas[aPos][2]-=parseInt(eliminada[0]);
                                      $("#ofrenda_"+finanzas[aPos][0]).html("$"+Moneda(finanzas[aPos][2]+""));
                                      total-=(parseInt(eliminada[0][0]));
                                      $("#total").html(Moneda(total+""));

                                      if(eliminada[0][1]==0)
                                      {
                                          diezmos-=(parseInt(eliminada[0][0]));
                                          $("#diezmos").html(Moneda(diezmos+""));
                                      }
                                      else if(eliminada[0][1]==1)
                                      {
                                          ofrendas-=(parseInt(eliminada[0][0]));
                                          $("#ofrendas").html(Moneda(ofrendas+""));
                                      }
                                      else if(eliminada[0][1]==2)
                                      {
                                          pactos-=(parseInt(eliminada[0][0]));
                                          $("#pactos").html(Moneda(pactos+""));
                                      }
                                      else if(eliminada[0][1]==3)
                                      {
                                          protemplo-=(parseInt(eliminada[0][0]));
                                          $("#protemplo").html(Moneda(protemplo+""));
                                      }
                                      else if(eliminada[0][1]==4)
                                      {
                                          siembras-=(parseInt(eliminada[0][0]));
                                          $("#siembras").html(Moneda(siembras+""));
                                      }
                                      else if(eliminada[0][1]==5)
                                      {
                                          primicias-=(parseInt(eliminada[0][0]));
                                          $("#primicias").html(Moneda(primicias+""));
                                      }
                                      else if(eliminada[0][1]==6)
                                      {
                                          otros-=(parseInt(eliminada[0][0]));
                                          $("#otros").html(Moneda(otros+""));
                                      }

                                      cant_ofrendas--;
                                      $("#finanzas").val(JSON.stringify(finanzas));
                                      $("#valor").focus();
                                  });
                                  cant_ofrendas++;
                                  $("#valor").val("");
                                  $("#tipo-ofrenda").val("");
                                  $("#observacion").val("");
                                  $("#finanzas").val(JSON.stringify(finanzas));
                                  $("#tipo-ofrenda").css("background-color", "#fff");
                                  $("#valor").css("background-color", "#fff");
                              }
                              else
                              {
                                  if($("#valor").val()=="")
                                  {
                                      $("#error_add_ofrenda").html("{{Lang::get('reporte_grupos.texto_mensaje_modal_error_valor')}}");
                                      $("#valor").css("background-color", "#f2dede");
                                      
                                  }
                                  else if($("#tipo-ofrenda").val()=="")
                                  {
                                      $("#error_add_ofrenda").html("{{Lang::get('reporte_grupos.texto_mensaje_modal_error_tipo')}}");
                                      $("#tipo-ofrenda").css("background-color", "#f2dede");
                                      $("#valor").css("background-color", "#fff");
                                  }
                                  
                                  $("#error_add_ofrenda").show(300);
                                  setTimeout(function() {
                                      $("#error_add_ofrenda").hide(300)
                                  }, 6000);
                                  $("#error_add_ofrenda").attr("alert alert-danger col-lg-12 desvanecer")
                              }
                              $("#valor").focus();
                          });


                        $('.abrir-panel-ofrendas-lider').click (function () {
                            tabla_ofrendas_lideres.fnClearTable();
                            ///al abrir el panel se perdia el foco asi que se hace el focus unas milesimas despues de que abre el panel
                            setTimeout(function() {
                                $("#valor_lider").focus();
                            }, 500);

                            var nombre_integrantre=$(this).attr('data-nombre');
                            $("#titulo-informacion-financiera-lider").html("{{Lang::get('reporte_grupos.texto_simple_modal_titulo_ofrendas')}} - <b class='text-uppercase'>"+nombre_integrantre+"</b>");
                            var fila = $(this).parent().parent().get(0); // this line did the trick
                            aPos = tabla_lideres.fnGetPosition(fila); ///me tiene la posicion del tr al que le dieron clic para abrir el panel de ofrendas
                            var count=finanzas_lideres[aPos][1].length;
                            
                            
                            for(var i=0; i<count; i++)
                            {
                                var tipo_ofrenda="";
                                if(finanzas_lideres[aPos][1][i][1]==0) tipo_ofrenda="Diezmo";
                                else if(finanzas_lideres[aPos][1][i][1]==1) tipo_ofrenda="Ofrenda";
                                else if(finanzas_lideres[aPos][1][i][1]==2) tipo_ofrenda="Pacto";
                                else if(finanzas_lideres[aPos][1][i][1]==3) tipo_ofrenda="Pro-templo";
                                else if(finanzas_lideres[aPos][1][i][1]==4) tipo_ofrenda="Siembra";
                                else if(finanzas_lideres[aPos][1][i][1]==5) tipo_ofrenda="Primicia";
                                else if(finanzas_lideres[aPos][1][i][1]==6) tipo_ofrenda="Otro";

                                tabla_ofrendas_lideres.fnAddData( [
                                    Moneda(finanzas_lideres[aPos][1][i][0]+""),
                                    tipo_ofrenda,
                                    finanzas_lideres[aPos][1][i][2],
                                '<a class="borrar-ofrenda-lider'+i+' btn btn-danger btn-sm" > <b>X</b> </a>'
                                ]);


                                $('.borrar-ofrenda-lider'+i).click (function () {
                                  var target_row = $(this).parent().parent().get(0); // this line did the trick
                                  var fila = tabla_ofrendas_lideres.fnGetPosition(target_row); 
                                  tabla_ofrendas_lideres.fnDeleteRow(fila);
                                  eliminada=finanzas_lideres[aPos][1].splice(fila, 1);
                                  finanzas_lideres[aPos][2]-=parseInt(eliminada[0]);
                                  $("#ofrenda_"+finanzas_lideres[aPos][0]).html("$"+Moneda(finanzas_lideres[aPos][2]+""));
                                  total-=(parseInt(eliminada[0][0]));
                                  $("#total").html(Moneda(total+""));

                                  if(eliminada[0][1]==0)
                                  {
                                      diezmos-=(parseInt(eliminada[0][0]));
                                      $("#diezmos").html(Moneda(diezmos+""));
                                  }
                                  else if(eliminada[0][1]==1)
                                  {
                                      ofrendas-=(parseInt(eliminada[0][0]));
                                      $("#ofrendas").html(Moneda(ofrendas+""));
                                  }
                                  else if(eliminada[0][1]==2)
                                  {
                                      pactos-=(parseInt(eliminada[0][0]));
                                      $("#pactos").html(Moneda(pactos+""));
                                  }
                                  else if(eliminada[0][1]==3)
                                  {
                                      protemplo-=(parseInt(eliminada[0][0]));
                                      $("#protemplo").html(Moneda(protemplo+""));
                                  }
                                  else if(eliminada[0][1]==4)
                                  {
                                      siembras-=(parseInt(eliminada[0][0]));
                                      $("#siembras").html(Moneda(siembras+""));
                                  }
                                  else if(eliminada[0][1]==5)
                                  {
                                      primicias-=(parseInt(eliminada[0][0]));
                                      $("#primicias").html(Moneda(primicias+""));
                                  }
                                  else if(eliminada[0][1]==6)
                                  {
                                      otros-=(parseInt(eliminada[0][0]));
                                      $("#otros").html(Moneda(otros+""));
                                  }

                                  cant_ofrendas--;
                                  $("#finanzas_lideres").val(JSON.stringify(finanzas_lideres));
                                  $("#valor_lider").focus();
                              });
                            }
                          }); 

                          

                          $('.add-ofrenda-lider').click (function () {

                              if($("#valor_lider").val()!="" && $("#tipo-ofrenda-lider").val()!="")
                              {
                                //alert("entre1");
                                  var tipo_ofrenda="";
                                  finanzas_lideres[aPos][1].push(new Array($("#valor_lider").val(), $("#tipo-ofrenda-lider").val(), $("#observacion-lider").val()));
                                  if($("#tipo-ofrenda-lider").val()==0){
                                      tipo_ofrenda="Diezmo";
                                      diezmos+=parseInt($("#valor_lider").val());
                                      $("#diezmos").html(Moneda(diezmos+""));
                                  } 
                                  else if($("#tipo-ofrenda-lider").val()==1)
                                  {
                                      tipo_ofrenda="Ofrenda";
                                      ofrendas+=parseInt($("#valor_lider").val());
                                      $("#ofrendas").html(Moneda(ofrendas+""));
                                  } 
                                  else if($("#tipo-ofrenda-lider").val()==2)
                                  {
                                      tipo_ofrenda="Pacto";
                                      pactos+=parseInt($("#valor_lider").val());
                                      $("#pactos").html(Moneda(pactos+""));
                                  } 
                                  else if($("#tipo-ofrenda-lider").val()==3)
                                  {
                                      tipo_ofrenda="Pro-templo";
                                      protemplo+=parseInt($("#valor_lider").val());
                                      $("#protemplo").html(Moneda(protemplo+""));
                                  } 
                                  else if($("#tipo-ofrenda-lider").val()==4)
                                  {
                                      tipo_ofrenda="Siembra";
                                      siembras+=parseInt($("#valor_lider").val());
                                      $("#siembras").html(Moneda(siembras+""));
                                  } 
                                  else if($("#tipo-ofrenda-lider").val()==5){
                                      tipo_ofrenda="Primicia";
                                      primicias+=parseInt($("#valor_lider").val());
                                      $("#primicias").html(Moneda(primicias+""));
                                  } 
                                  else if($("#tipo-ofrenda-lider").val()==6)
                                  {
                                      tipo_ofrenda="Otro";
                                      otros+=parseInt($("#valor_lider").val());
                                      $("#otros").html(Moneda(otros+""));
                                  } 
                                  finanzas_lideres[aPos][2]+=parseInt($("#valor_lider").val());
                                  $("#ofrenda_"+finanzas_lideres[aPos][0]).html("$"+Moneda(finanzas_lideres[aPos][2]+""));
                                  total+=parseInt($("#valor_lider").val());
                                  $("#total").html(total);
                                  tabla_ofrendas_lideres.fnAddData( [
                                      Moneda($("#valor_lider").val()),
                                      tipo_ofrenda,
                                      $("#observacion-lider").val(),
                                  '<a class="borrar-ofrenda-lider'+cant_ofrendas+' btn btn-danger btn-sm" > <b>X</b> </a>'
                                  ]);
                                 
                                  $('.borrar-ofrenda-lider'+cant_ofrendas).click (function () {
                                      var target_row = $(this).parent().parent().get(0); // this line did the trick
                                      var fila = tabla_ofrendas_lideres.fnGetPosition(target_row); 
                                      tabla_ofrendas_lideres.fnDeleteRow(fila);
                                      eliminada=finanzas_lideres[aPos][1].splice(fila, 1);
                                      finanzas_lideres[aPos][2]-=parseInt(eliminada[0]);
                                      $("#ofrenda_"+finanzas_lideres[aPos][0]).html("$"+Moneda(finanzas_lideres[aPos][2]+""));
                                      total-=(parseInt(eliminada[0][0]));
                                      $("#total").html(Moneda(total+""));

                                      if(eliminada[0][1]==0)
                                      {
                                          diezmos-=(parseInt(eliminada[0][0]));
                                          $("#diezmos").html(Moneda(diezmos+""));
                                      }
                                      else if(eliminada[0][1]==1)
                                      {
                                          ofrendas-=(parseInt(eliminada[0][0]));
                                          $("#ofrendas").html(Moneda(ofrendas+""));
                                      }
                                      else if(eliminada[0][1]==2)
                                      {
                                          pactos-=(parseInt(eliminada[0][0]));
                                          $("#pactos").html(Moneda(pactos+""));
                                      }
                                      else if(eliminada[0][1]==3)
                                      {
                                          protemplo-=(parseInt(eliminada[0][0]));
                                          $("#protemplo").html(Moneda(protemplo+""));
                                      }
                                      else if(eliminada[0][1]==4)
                                      {
                                          siembras-=(parseInt(eliminada[0][0]));
                                          $("#siembras").html(Moneda(siembras+""));
                                      }
                                      else if(eliminada[0][1]==5)
                                      {
                                          primicias-=(parseInt(eliminada[0][0]));
                                          $("#primicias").html(Moneda(primicias+""));
                                      }
                                      else if(eliminada[0][1]==6)
                                      {
                                          otros-=(parseInt(eliminada[0][0]));
                                          $("#otros").html(Moneda(otros+""));
                                      }

                                      cant_ofrendas--;
                                      $("#finanzas_lideres").val(JSON.stringify(finanzas_lideres));
                                      $("#valor_lider").focus();
                                  });
                                  cant_ofrendas++;
                                  $("#valor_lider").val("");
                                  $("#tipo-ofrenda-lider").val("");
                                  $("#observacion-lider").val("");
                                  $("#finanzas_lideres").val(JSON.stringify(finanzas_lideres));
                                  $("#tipo-ofrenda-lider").css("background-color", "#fff");
                                  $("#valor_lider").css("background-color", "#fff");
                              }
                              else
                              {
                                alert("entre else");
                                  if($("#valor_lider").val()=="")
                                  {
                                      $("#error_add_ofrenda").html("{{Lang::get('reporte_grupos.texto_mensaje_modal_error_valor')}}");
                                      $("#valor_lider").css("background-color", "#f2dede");
                                      
                                  }
                                  else if($("#tipo-ofrenda-lider").val()=="")
                                  {
                                      $("#error_add_ofrenda").html("{{Lang::get('reporte_grupos.texto_mensaje_modal_error_tipo')}}");
                                      $("#tipo-ofrenda-lider").css("background-color", "#f2dede");
                                      $("#valor_lider").css("background-color", "#fff");
                                  }
                                  
                                  $("#error_add_ofrenda").show(300);
                                  setTimeout(function() {
                                      $("#error_add_ofrenda").hide(300)
                                  }, 6000);
                                  $("#error_add_ofrenda").attr("alert alert-danger col-lg-12 desvanecer")
                              }
                              $("#valor_lider").focus();
                          });

                          $('#abrir_modal_o_s').click (function () {
                            setTimeout(function() {
                                $("#valor_o_s").focus();
                            }, 500);
                          });

                          $('.add-ofrenda-suelta').click (function () {
                              $("#valor_ofrenda_suelta").val($("#valor_o_s").val());
                              //alert($("#valor_ofrenda_suelta").val());
                              $("#observacion_ofrenda_suelta").val($("#observacion_o_s").val());
                              if($("#valor_o_s").val()!="")
                              {
                                  total=diezmos+ofrendas+pactos+primicias+protemplo+otros+siembras+parseInt($("#valor_o_s").val());
                                  $("#sueltas").html(Moneda($("#valor_o_s").val()+""));
                                  $("#total").html(Moneda(total+""));
                              }
                              else
                              {
                                  total=diezmos+ofrendas+pactos+primicias+protemplo+otros+siembras;
                                  $("#sueltas").html("0");
                                  $("#total").html(Moneda(total+""));
                              }
                          });

                          var tabla_integrantes=$('#tabla_integrantes').dataTable({});
                          var tabla_lideres=$('#tabla_lideres').dataTable({"bPaginate": false,
                              "bLengthChange": false,
                              "bFilter": false,});                         
                          

              });

          </script>

      </body>
  </html>

  @endif