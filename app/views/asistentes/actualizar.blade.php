@if(Auth::check())
@include('includes.lenguaje')
<?php include '../app/views/includes/terminos.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{{Lang::get('asistentes.na_title_pagina')}}| {{Lang::get('asistentes.na_title_pagina2')}} {{$termino_asistente->singular}}</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        @include('includes.styles')
        <!-- Ionicons -->
        <link href="/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- datepicker.css -->
        <link href="/css/datepicker.css" rel="stylesheet" type="text/css" />
        <link href="/css/datepicker3.css" rel="stylesheet" type="text/css" />
         <!-- DATA TABLES -->
        <link href="/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="/css/bootstrap-switch.css" rel="stylesheet">        
        <!-- JCrop -->
        <link href="/css/jcrop/jquery.Jcrop.min.css" rel="stylesheet"/>

        <!--style necesario para usar el recoret de la imagen -->
        <style type="text/css">
           .jcrop-keymgr {opacity: 0;}
           .jcrop-holder { margin: 0 auto;}
           #panel-imagen { padding-top: 10px; padding-bottom: 10px; overflow:auto;}
           #footer-imagen { margin-top: 0px; padding: 10px;}
           #header-imagen {padding: 10px;}
           @media(max-height: :450px) {
              .panel-image{
                width: 300px!important;
              }
            }

            @media(max-height: :320px) {
              .panel-image{
                width: 280px!important;
              }
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
       
            <!-- Header Navbar: style can be found in header.less -->
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
            <form role="form" action="../update/{{ $asistente->id }}" id="formulario" method="post" enctype="multipart/form-data">
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- contendio cabezote -->
               <section class="content-header">
                  <div class="box-header">
                    <h3 class="content-header barra-titulo">
                     <span class="mayusculas">{{Lang::get('asistentes.na_tittle_encabezado')}}</span>  
                        <small>   {{Lang::get('asistentes.na_subtitle_encabezado_minuscula')}}</small>
                    </h3>
                    <div class="pull-right box-tools">
                      <button type="submit" class="btn btn-danger"> <i class="fa fa-save"></i> {{Lang::get('asistentes.boton_guardar')}}</button>
                      <a href="../lista/todos" class="btn bg-light-redil"> <i class="fa fa-undo"></i> {{Lang::get('asistentes.boton_cancelar')}}</a>
                      
                    </div>
                    
                    
                  </div>
                </section>
                <!-- /contendio cabezote -->
                 

             <!-- contenido principal -->
              <section class="content">
              		
              		<!-- row para el formulario -->
                    <div class="row">
                     
                      	<!-- columna del boton guardar -->
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class=" box-header">
                              <?php $status=Session::get('status'); ?>
                              @if($status=='ok_update')
                              <div class=" alert alert-success col-lg-12" style="padding-bottom:5px; padding-top:5px;" >
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <b>{{Lang::get('asistentes.mensaje_actualizado_ok')}}</b>  {{Lang::get('asistentes.mensaje_satisfactoriamente')}}
                              </div>
                              @endif

                              <?php $mensaje=Session::get('mensaje');
                                    $nombre=Session::get('nombre_dado_baja'); 
                                    $apellido=Session::get('apellido_dado_baja');  
                              ?>
                              @if($mensaje=='de_alta')
                              <div class=" alert alert-success col-lg-12" style="padding-bottom:5px; padding-top:5px;" >
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{Lang::get('asistentes.texto_dado_alta_asistente', array('nombre'=> $nombre, 'apellido'=>$apellido))}}
                              </div>
                              @endif
                            </div>
                        </div>
                         <!-- /columna del boton guardar -->
                    	<!-- columna informacion basica -->
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                            <div class="panel">
                              <div class="panel-heading">
                                <h4 class="modal-title">{{Lang::get('asistentes.texto_informacion_basica_asistente')}}</h4>
                              </div>
                                <div class="panel-body">
                                      <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">

                                          <!-- subir foto -->
                                          <div class="form-group">
                                            <label for="exampleInputFile">{{Lang::get('asistentes.texto_subir_foto_asistente')}}</label><br>
                                            <?php
                                              $fechaSegundos = time(); 
                                              $strNoCache = "?nocache=$fechaSegundos"; 
                                            ?>
                                            <div style="padding-left: 8px; padding-right: 8px" class="col-lg-3 col-md-12 col-xs-12 col-sm-2">
                                              <img style="padding-left: 4px; padding-right: 4px; margin-bottom: 10px" id="foto-cortada" src="/img/fotos/{{ $asistente->foto.$strNoCache }}" align="left" class="img-circle col-lg-12 col-md-6 col-sm-11 col-xs-5 col-sm-offset-0 col-md-offset-3 col-xs-offset-4 col-lg-offset-0"   />
                                            </div>
                                            
                                            <div class="col-lg-9 col-md-12 col-xs-12 col-sm-10">
                                              <div id="div-nueva-foto" class="input-group" style="display:none">
                                                <div class="input-group-btn">
                                                    <button id="limpiar-foto" type="button" class="btn btn-danger">{{Lang::get('asistentes.texto_limpiar_asistente')}}</button>
                                                </div><!-- /btn-group -->                     
                                                <input class="form-control" type="text" id="foto-hide" name="foto-hide" readonly />
                                              </div><br>
                                              <input class="" type="file" id="foto" name="foto" accept="image/*">
                                              <p class="help-block">{{Lang::get('asistentes.texto_ancho_alto_asistentes')}}</p>
                                            </div>
                                          </div><br><br>
                                          <div id="saltos-linea"><br><br><br></div>
                                          <!-- /subir foto -->

                                          <!-- Nombre -->
                                          <div class="form-group">
                                             <label><span class="campo-obligatorio">*</span> {{Lang::get('asistentes.texto_campo_nombres')}}</label>
                                             <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Escribe tu nombre..." value="{{ $asistente->nombre }}" required/>
                                          </div>
                                          <!-- /Nombre -->

                                          <!-- Apellido -->
                                          <div class="form-group">
                                             <label><span class="campo-obligatorio">*</span> {{Lang::get('asistentes.texto_campo_apellidos')}}</label>
                                             <input id="apellido" name="apellido" type="text" class="form-control" placeholder="Escribe tu apellido..." value="{{ $asistente->apellido }}" required/>
                                          </div>
                                          <!-- /Apellido -->

                                          <!-- Genero sexual -->
                                          <div class="form-group"> 
                                              <label><span class="campo-obligatorio">*</span> {{Lang::get('asistentes.texto_campo_genero')}}</label>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="genero" id="optionsRadios1" value="0" @if($asistente->genero=="0") checked @endif required>
                                                           {{Lang::get('asistentes.texto_campo_genero_masculino')}}
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="genero" id="optionsRadios2" value="1" @if($asistente->genero=="1") checked @endif required>
                                                            {{Lang::get('asistentes.texto_campo_genero_femenino')}}
                                                        </label>
                                                    </div>
                                          </div>
                                           <!-- /Genero sexual -->
                                           <!-- Estado Civil -->
                                            <div class="form-group">
                                                    <label>{{Lang::get('asistentes.texto_campo_estado_civil')}}</label>
                                                    <select id="estado_civil" name="estado_civil" class="form-control">
                                                        <option value="0" @if($asistente->estado_civil=="") selected @endif></option>
                                                        <option value="1" @if($asistente->estado_civil=="1") selected @endif>{{Lang::get('asistentes.texto_campo_estado_civil_soltero')}}</option>
                                                        <option value="2" @if($asistente->estado_civil=="2") selected @endif >{{Lang::get('asistentes.texto_campo_estado_civil_casado')}}</option>
                                                        <option value="3" @if($asistente->estado_civil=="3") selected @endif >{{Lang::get('asistentes.texto_campo_estado_civil_libre')}}</option>
                                                        <option value="4" @if($asistente->estado_civil=="4") selected @endif >{{Lang::get('asistentes.texto_campo_estado_civil_divorciado')}}</option>
                                                        <option value="5" @if($asistente->estado_civil=="5") selected @endif >{{Lang::get('asistentes.texto_campo_estado_civil_viudo')}}</option>
                                                    </select>
                                            </div>
                                            <!-- /Estado Civil -->
                                        </div>
                                   
                                      <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                                           <!-- Tipo de id -->
                                           <div class="form-group">
                                                    <label>{{Lang::get('asistentes.texto_campo_tipoid')}}</label>
                                                    <select id="tipo_identificacion" name="tipo_identificacion" class="form-control">
                                                        <option value="0" @if($asistente->tipo_identificacion=="") selected @endif></option>
                                                        <option value="1" @if($asistente->tipo_identificacion=="1") selected @endif>{{Lang::get('asistentes.texto_campo_tipoid_registro')}}</option>
                                                        <option value="2" @if($asistente->tipo_identificacion=="2") selected @endif>{{Lang::get('asistentes.texto_campo_tipoid_tarjeta')}}</option>
                                                        <option value="3" @if($asistente->tipo_identificacion=="3") selected @endif>{{Lang::get('asistentes.texto_campo_tipoid_cedula')}}</option>
                                                        <option value="4" @if($asistente->tipo_identificacion=="4") selected @endif>{{Lang::get('asistentes.texto_campo_tipoid_cedula_ext')}}</option>
                                                        <option value="5" @if($asistente->tipo_identificacion=="5") selected @endif>{{Lang::get('asistentes.texto_campo_tipoid_otro')}}</option>
                                                    </select>
                                           </div>
                                           <!-- /tipo de id -->
                                       
                                           <div class="form-group">
                                             <label>{{Lang::get('asistentes.texto_campo_identificacion')}}</label>
                                             <input id="identificacion" name="identificacion" type="text" class="form-control" placeholder="Escribe tu identificación..." value="{{ $asistente->identificacion }}"/>
                                          </div>
                                          <div class="form-group">
                                             <label>{{Lang::get('asistentes.texto_campo_nacionalidad')}}</label>
                                             <input id="nacionalidad" name="nacionalidad" type="text" class="form-control" placeholder="Escribe tu pais natal..."  value="{{ $asistente->nacionalidad }}"/>
                                          </div>
                                      
                                            <!-- Fecha de nacimiento mm/dd/yyyy -->
                                            <div class="form-group">
                                                <label>{{Lang::get('asistentes.texto_campo_fecha_nacimiento')}}</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <?php $fecha_nac=date_create($asistente->fecha_nacimiento); ?>
                                                    <input id="fecha_nacimiento" name="fecha_nacimiento" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask value="{{ date_format($fecha_nac, 'd-m-Y') }}"/>
                                                </div>
                                            </div>
                                            <!-- /.fin Fecha de nacimiento -->
                                            <!-- Fecha de ingreso mm/dd/yyyy -->
                                            <div class="form-group">
                                                <label><span class="campo-obligatorio">*</span>{{Lang::get('asistentes.texto_campo_fecha_ingreso')}}</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <?php $fecha_ing=date_create($asistente->fecha_ingreso); ?>
                                                    <input required id="fecha_ingreso" name="fecha_ingreso" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask value="{{ date_format($fecha_ing, 'd-m-Y') }}"/>
                                                </div>
                                            </div>
                                            <!-- /.fin Fecha de ingreso -->
                                            
                                      </div>
                                 </div> <!-- /box-body -->
                            </div>
                        </div>
                        <!-- /columna informacion basica -->

                       

                        <!-- columna informacion Contacto -->
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h4 class="modal-title">{{Lang::get('asistentes.texto_title_info_contacto')}}</h4>
                                </div>
                                <div class="panel-body">
                                  <!-- Telefono fijo -->
                                    <div class="form-group">
                                        <label> {{Lang::get('asistentes.texto_campo_tel_fijo')}}</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <input id="telefono_fijo" name="telefono_fijo" type="text" class="form-control" data-inputmask='"mask": "999-9999"' data-mask value="{{ $asistente->telefono_fijo }}"/>
                                        </div>
                                    </div>
                                    <!-- /Telefono fijo -->
                                    <!-- Telefono Movil #1 -->
                                    <div class="form-group">
                                        <label> {{Lang::get('asistentes.texto_campo_tel_movil')}}</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-mobile-phone"></i>
                                            </div>
                                            <input id="telefono_movil" name="telefono_movil" type="text" class="form-control" data-inputmask='"mask": "999-999-9999"' data-mask value="{{ $asistente->telefono_movil }}"/>
                                        </div>
                                    </div>
                                    <!-- /Telefono Movil #1 -->
                                     <!-- Telefono  otro Telefono -->
                                    <div class="form-group">
                                        <label>{{Lang::get('asistentes.texto_campo_tel_otro')}} </label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <input id="telefono_otro" name="telefono_otro" type="text" class="form-control"  value="{{ $asistente->telefono_otro }}"/>
                                        </div>
                                    </div>
                                    <!-- /Telefono otro Telefono -->
                                    <!-- /Email -->
                                    <div class="form-group">
                                            <label for="exampleInputEmail1">{{Lang::get('asistentes.texto_campo_correo')}} </label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="">@</i>
                                                </div>
                                            <input type="email" name="email" class="form-control" id="email" placeholder="Escriba su E-mail"  value="{{ $asistente->user->email }}">
                                            </div>
                                    </div>
                                    <!-- /Email -->
                                    <!-- Direccion -->
                                       <div class="form-group">
                                          <label>{{Lang::get('asistentes.texto_campo_direccion')}}</label>
                                          <textarea id="direccion" name="direccion" class="form-control" rows="3"  maxlength="200"  placeholder="Escribe tu dirección y barrio ..."> {{ $asistente->direccion }}</textarea>
                                       </div>
                                     <!-- /Direccion -->
                                    
                                </div>
                            </div>
                        </div>
                        <!-- /columna informacion Medica -->


                        <!-- columna informacion Medica -->
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="panel">
                              <div class="panel-heading">
                                <h4 class="modal-title">{{Lang::get('asistentes.texto_title_info_medica')}}</h4>
                              </div>
                                <div class="panel-body">
                                  <div class="form-group">
                                     <label>{{Lang::get('asistentes.texto_campo_tipo_sangre')}}</label>
                                     <input id="tipo_sangre" name="tipo_sangre" type="text" class="form-control" placeholder="Ej. A+" value="{{ strtoupper($asistente->tipo_sangre) }}"/>
                                  </div>
                                  <!-- Indicaciones medicas -->
                                  <div class="form-group">
                                      <label>{{Lang::get('asistentes.texto_campo_indicaciones_medicas')}}</label>
                                      <textarea id="indicaciones_medicas" name="indicaciones_medicas" class="form-control" rows="5"  maxlength="500" placeholder="">{{ $asistente->indicaciones_medicas }}</textarea>
                                  </div>
                                  <!-- /Indicaciones medicas -->
                                  <!-- Limitaciones -->
                                   <div class="form-group">
                                      <label>{{Lang::get('asistentes.texto_campo_limitaciones')}}</label>
                                      <textarea id="limitaciones" name="limitaciones" class="form-control" rows="7"  maxlength="500" placeholder="">{{ $asistente->limitaciones }}</textarea>
                                   </div>
                                 <!-- /Limitaciones -->


                                    
                                </div>
                            </div>
                        </div>
                        <!-- /columna informacion Medica -->
                        
                        <!-- columna Pasos culminados -->
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="panel">
                                  <div class="panel-heading">
                                    <h4 class="modal-title">{{Lang::get('asistentes.texto_title_crecimiento')}}</h4>
                                  </div>
                                    
                                    <div class="panel-body">

                                         <!-- Tipo de asistente -->
                                           <div class="form-group">
                                                    <label><span class="campo-obligatorio">*</span> {{Lang::get('asistentes.texto_campo_tipo_asistente')}}</label>
                                                    <select id="tipo_asistente_id" name="tipo_asistente_id" class="form-control" required>
                                                        <option value="" @if($asistente->tipo_asistente_id=="") selected @endif ></option>
                                                        <option value="1" @if($asistente->tipo_asistente_id=="1") selected @endif>{{Lang::get('asistentes.texto_campo_tipo_asistente_nuevo')}}</option>
                                                        <option value="2" @if($asistente->tipo_asistente_id=="2") selected @endif>{{Lang::get('asistentes.texto_campo_tipo_asistente_oveja')}}</option>
                                                        <option value="3" @if($asistente->tipo_asistente_id=="3") selected @endif>{{Lang::get('asistentes.texto_campo_tipo_asistente_miembro')}}</option>
                                                        <option value="4" @if($asistente->tipo_asistente_id=="4") selected @endif>{{Lang::get('asistentes.texto_campo_tipo_asistente_lider')}}</option>
                                                        @if(Auth::user()->id==1)
                                                        <option value="5" @if($asistente->tipo_asistente_id=="5") selected @endif>{{Lang::get('asistentes.texto_campo_tipo_asistente_pastor')}}</option>
                                                        @endif
                                                        
                                                    </select>
                                           </div>
                                           <!-- /Tipo de asistente-->
                                            <!-- pasos -->
                                              <label>{{Lang::get('asistentes.texto_campo_pasos')}}</label>
                                              @foreach($pasos as $paso)
                                              <?php
                                                  $paso_aux= $asistente->pasosCrecimiento()->get();
                                                  $paso_aux= $paso_aux->find($paso->id);
                                              ?>
                                              <p>
                                              <div class="checkbox" data-toggle="tooltip" data-placement="left" data- data-original-title="{{ $paso->descripcion }}" >
                                                  <input style="width: 100%;" @if(isset($paso_aux)) checked @endif data-id="switch-{{ $paso->id }}" id="{{ $paso->id }}" class="paso-crecimiento" name="switch-pasos" data-tipo-asistente="{{ $paso->tipo_asistente_id }}" type="checkbox"/>
                                              </div>
                                            </p>
                                              @endforeach
                                              <input class="hide" name="pasos_anadidos" id="pasos_anadidos" type="text" class="form-control" placeholder="" readonly />
                                              <input class="hide" name="pasos_eliminados" id="pasos_eliminados" type="text" class="form-control" placeholder="" readonly />
                                            
                                            <!-- /pasos -->
                                     </div>

                                </div>
                     </div>
                        
                        <!-- /columna pasos culminados -->
                        

                       <!-- columna Ubicacion grupo -->
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                            <div class="panel">
                              
                                <div class="panel-heading">
                                    <h4 class="modal-title">{{Lang::get('asistentes.texto_title_info_ministerial')}}</h4>
                                </div>
                                
                                <div class="panel-body">
                                    
                                  <!-- linea --> 
                                  <div class="nav navbar-nav panel-ppl-busqueda" style="margin-bottom: 30px;">
                                    <label><span class="campo-obligatorio">*</span>{{Lang::get('asistentes.texto_campo_info_ministerial')}}</label>
                                    <li class="dropdown messages-menu">
                                      <div class="input-group" >
                                        <input class="oculto-required" type="text" name="linea_id" id="linea_id" value="{{ $asistente->linea_id }}"/>
                                        <input type="text" id="busqueda_linea" class="form-control buscar" autocomplete="off" placeholder="{{Lang::get('asistentes.texto_placeholder_campo_info_ministerial')}}"/>
                                        <span class="input-group-btn">
                                          <button type='button' class="btn btn-flat" style="border-color:#CCC;background:#fff" ><i class="fa fa-search" style="color:#00545E" ></i></button>
                                        </span>
                                      </div> 

                                      <ul id="panel-ppl-lineas" class="panel-busqueda-moviles dropdown-menu">
                                        <li>
                                          <!-- el siguiente es el panel que se llenara con los registros de la busqueda, se deja vacio -->
                                          <ul class="menu" id="panel-lineas">

                                          </ul>
                                        </li>
                                      </ul>
                                      <div class="footer">{{Lang::get('asistentes.texto_mostrar_resultados')}}</div>
                                    </li>
                                  </div>  
                                  <div id="linea-seleccionada">  

                                  </div> 

                                  <!-- grupo --> 
                                  <div id="panel-grupo" class="nav navbar-nav panel-ppl-busqueda" style="display:none; margin-bottom: 30px; margin-top: 30px;">
                                    
                                    <label> Seleccione {{Helper::articulo($termino_grupo->genero, 'singular')}} {{$termino_grupo->singular}} donde asiste {{Helper::articulo($termino_asistente->genero, 'singular')}} {{$termino_asistente->singular}}:</label>
                                    <li class="dropdown messages-menu">
                                      <div class="input-group "  >
                                        <input type="hidden" id="grupo_id" name="grupo_id" value="{{ $asistente->grupo_id }}" />
                                        <input type="text" id="busqueda_grupo" class="form-control buscar" autocomplete="off" placeholder="Buscar grupo por código, nombre o cédula..."/>
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
                                      <div class="footer">{{Lang::get('asistentes.texto_fotter_resultados')}}</div>
                                    </li>
                                  </div>  
                                  <div id="grupo-seleccionado">  

                                  </div>
                                        
                                </div>
                                
                            </div>
                        </div>
                        <!-- /columna  Ubicacion grupo -->
                        @endif
                        <!-- /columna  Ubicacion grupo -->
                        
                        <!-- columna del boton guardar -->
                        <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
                          <div class="pull-right">
                            <button type="submit" class="btn btn-danger"> <i class="fa fa-save"></i> {{Lang::get('asistentes.boton_guardar')}}</button>
                            <a href="../lista/todos" class="btn bg-light-redil"> <i class="fa fa-undo"></i> {{Lang::get('asistentes.boton_cancelar')}}</a>
                          </div>
                            <h4 class="pull-left"><span class=" campo-obligatorio">*</span>{{Lang::get('asistentes.texto_title_campos_obligatorios')}} </h4>
                        </div>
                         <!-- /columna del boton guardar -->
                        
                      
                   </div>  
                    <!-- /row para el formulario -->  
                   
              </section>
              <!-- contenido principal -->
            </aside>  
            </form>

          </div>


            <!-- Modal -->
            <div id="modal_recorta_foto" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                     <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header" id="header-imagen">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">{{Lang::get('asistentes.texto_modal_recorte_imagen')}}</h4>
                            </div>
                        <div class="modal-body text-center" id="panel-imagen">
                            <img src="/img/ajax-loader1.gif" id="cargando" />
                        </div>
                        <div class="modal-footer" id="footer-imagen">
                          <button id="90" type="button" class="rotar btn btn-primary" title="" data-original-title="Rotar a la izquierda."><i class="fa fa-undo"></i></button>
                          <button id="-90" type="button" class="rotar btn btn-primary" title="" data-original-title="Rotar a la derecha."><i class="fa fa-repeat"></i></button>
                          
                          <button id="recortar" type="button" class="btn btn-primary">{{Lang::get('asistentes.texto_boton_recortar_imagen')}}</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">{{Lang::get('asistentes.boton_cancelar')}}</button>
                        </div>
                    </div>
                </div>
            </div>

        @include('includes.scripts')                           
        <!-- InputMask -->
        <script src="/js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="/js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="/js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        
        <script src="/js/AdminLTE/busqueda-fc.js" type="text/javascript"></script>

        <!-- bootstra datepicker-->
        <script src="/js/bootstrap-datepicker.js"></script>
        <script src="/js/locales/bootstrap-datepicker.es.js"></script>


        <!-- jcrop esta es para la edicion de imagenes -->
        <script type="text/javascript" src="/js/plugins/jcrop/jquery.Jcrop.min.js"></script>
       

        <script src="/js/bootstrap-switch.js"></script>

        <!-- page script -->
        <script type="text/javascript">
         
          @include('includes.procesa-foto-js')

            /// pasos culminados por el asistente
            var pasos_culminados=new Array();
            var pasos_eliminados=new Array();
            var pasos_anadidos=new Array();

            <?php
                $pasos_aux= $asistente->pasosCrecimiento()->get();
            ?>

            @foreach($pasos_aux as $paso_aux)
              pasos_culminados.push( {{$paso_aux->id}} );
            @endforeach

            //alert(pasos_culminados);
              $("[name='switch-pasos']").bootstrapSwitch({
                onText: 'Si',
                offText: 'No',
                onColor: "success",
                offColor: "danger"
              });
              @foreach($pasos as $paso)
                $('input[data-id="switch-{{ $paso->id }}"]').bootstrapSwitch('labelText', '{{ $paso->nombre }}' );
              @endforeach
              

              $('.paso-crecimiento').on('switchChange.bootstrapSwitch', function(event, state) {
                //alert("jajajaja");
                var paso_culminado= $(this).attr("id");
                if($(this).is(':checked'))
                {
                  //alert(paso_culminado);
                  //alert(pasos_culminados);
                  //alert(pasos_culminados.indexOf(parseInt(paso_culminado)));
                  if(pasos_culminados.indexOf(parseInt(paso_culminado))==-1)
                  {

                    pasos_anadidos.push(paso_culminado);
                  }
                  else
                  {
                    var pos=pasos_eliminados.indexOf($(this).attr('id')); // obtengo la posicion de arreglo segun el data-id
                    pasos_eliminados.splice(pos,1);
                  }
                }
                else
                {
                  //alert(pasos_anadidos.indexOf(paso_culminado));
                  if(pasos_anadidos.indexOf(paso_culminado)!=-1)
                  {
                    var pos2=pasos_anadidos.indexOf($(this).attr('id')); // obtengo la posicion de arreglo segun el data-id
                    pasos_anadidos.splice(pos2,1);
                  }
                  else
                  {
                    pasos_eliminados.push(paso_culminado);
                  }
                }
                //alert("a eliminar: "+pasos_eliminados);
                //alert("a anadir: "+pasos_anadidos);
                if(pasos_eliminados.length==0)
                  $("#pasos_eliminados").val("");
                else
                  $("#pasos_eliminados").val(pasos_eliminados);

                if(pasos_anadidos.length==0)
                  $("#pasos_anadidos").val("");
                else
                  $("#pasos_anadidos").val(pasos_anadidos);
              });


              $('#tipo_asistente_id').change (function () {
                
                //pasos_anadidos.length=0;
                pasos_eliminados.length=0;
                if($('#tipo_asistente_id').val()=="1")
                {
                  //alert(pasos_culminados);
                  $("input[data-tipo-asistente='1']").bootstrapSwitch('state', false, false);
                  $("input[data-tipo-asistente='2']").bootstrapSwitch('state', false, false);
                  $("input[data-tipo-asistente='3']").bootstrapSwitch('state', false, false);
                  $("input[data-tipo-asistente='4']").bootstrapSwitch('state', false, false);
                  $("input[data-tipo-asistente='5']").bootstrapSwitch('state', false, false);
                  pasos_anadidos.length=0;
                  
                }
                else if($('#tipo_asistente_id').val()=="2")
                {
                  $("input[data-tipo-asistente='1']").bootstrapSwitch('state', true, true);
                  $("input[data-tipo-asistente='2']").bootstrapSwitch('state', false, false);
                  $("input[data-tipo-asistente='3']").bootstrapSwitch('state', false, false);
                  $("input[data-tipo-asistente='4']").bootstrapSwitch('state', false, false);
                  $("input[data-tipo-asistente='5']").bootstrapSwitch('state', false, false);
                  pasos_anadidos.length=0;
                  <?php $tipo_asistente=TipoAsistente::where("id", "<", "2")->get();?>
                  @foreach($tipo_asistente as $tipo)
                  @foreach($tipo->pasosCrecimiento as $paso)
                    if(pasos_culminados.indexOf(parseInt("{{$paso->id}}"))==-1)
                    {
                      pasos_anadidos.push("{{$paso->id}}");
                    }
                    
                  @endforeach
                  @endforeach

                  <?php $tipo_asistente=TipoAsistente::where("id", ">=", "2")->get();?>
                  @foreach($tipo_asistente as $tipo)
                  @foreach($tipo->pasosCrecimiento as $paso)
                    if(pasos_culminados.indexOf(parseInt("{{$paso->id}}"))!=-1)
                    {
                      //alert(pasos_eliminados.indexOf("{{$paso->id}}"));
                      if(pasos_eliminados.indexOf("{{$paso->id}}")==-1)
                      pasos_eliminados.push("{{$paso->id}}");
                    }
                    
                  @endforeach
                  @endforeach
                  //alert("eliminados: "+pasos_eliminados);
                  //alert("anadidos: "+pasos_anadidos);
                  
                }
                else if($('#tipo_asistente_id').val()=="3")
                {
                  $("input[data-tipo-asistente='1']").bootstrapSwitch('state', true, true);
                  $("input[data-tipo-asistente='2']").bootstrapSwitch('state', true, true);
                  $("input[data-tipo-asistente='3']").bootstrapSwitch('state', false, false);
                  $("input[data-tipo-asistente='4']").bootstrapSwitch('state', false, false);
                  $("input[data-tipo-asistente='5']").bootstrapSwitch('state', false, false);
                  pasos_anadidos.length=0;

                  <?php $tipo_asistente=TipoAsistente::where("id", "<", "3")->get();?>
                  @foreach($tipo_asistente as $tipo)
                  @foreach($tipo->pasosCrecimiento as $paso)
                    if(pasos_culminados.indexOf(parseInt("{{$paso->id}}"))==-1)
                    {
                      pasos_anadidos.push("{{$paso->id}}");
                    }
                    
                  @endforeach
                  @endforeach

                  <?php $tipo_asistente=TipoAsistente::where("id", ">=", "3")->get();?>
                  @foreach($tipo_asistente as $tipo)
                  @foreach($tipo->pasosCrecimiento as $paso)
                    if(pasos_culminados.indexOf(parseInt("{{$paso->id}}"))!=-1)
                    {
                      //alert(pasos_eliminados.indexOf("{{$paso->id}}"));
                      if(pasos_eliminados.indexOf("{{$paso->id}}")==-1)
                      pasos_eliminados.push("{{$paso->id}}");
                    }
                    
                  @endforeach
                  @endforeach
                  //alert("eliminados: "+pasos_eliminados);
                  //alert("anadidos: "+pasos_anadidos);
                  
                }

                else if($('#tipo_asistente_id').val()=="4")
                {
                  $("input[data-tipo-asistente='1']").bootstrapSwitch('state', true, true);
                  $("input[data-tipo-asistente='2']").bootstrapSwitch('state', true, true);
                  $("input[data-tipo-asistente='3']").bootstrapSwitch('state', true, true);
                  $("input[data-tipo-asistente='4']").bootstrapSwitch('state', false, false);
                  $("input[data-tipo-asistente='5']").bootstrapSwitch('state', false, false);
                  pasos_anadidos.length=0;
                  <?php $tipo_asistente=TipoAsistente::where("id", "<", "4")->get();?>
                  @foreach($tipo_asistente as $tipo)
                  @foreach($tipo->pasosCrecimiento as $paso)
                    if(pasos_culminados.indexOf(parseInt("{{$paso->id}}"))==-1)
                    {
                      pasos_anadidos.push("{{$paso->id}}");
                    }
                    
                  @endforeach
                  @endforeach

                  <?php $tipo_asistente=TipoAsistente::where("id", ">=", "4")->get();?>
                  @foreach($tipo_asistente as $tipo)
                  @foreach($tipo->pasosCrecimiento as $paso)
                    if(pasos_culminados.indexOf(parseInt("{{$paso->id}}"))!=-1)
                    {
                      //alert(pasos_eliminados.indexOf("{{$paso->id}}"));
                      if(pasos_eliminados.indexOf("{{$paso->id}}")==-1)
                      pasos_eliminados.push("{{$paso->id}}");
                    }
                    
                  @endforeach
                  @endforeach
                  //alert("eliminados: "+pasos_eliminados);
                  //alert("anadidos: "+pasos_anadidos);
                   
                }

                else if($('#tipo_asistente_id').val()=="5")
                {
                  $("input[data-tipo-asistente='1']").bootstrapSwitch('state', true, true);
                  $("input[data-tipo-asistente='2']").bootstrapSwitch('state', true, true);
                  $("input[data-tipo-asistente='3']").bootstrapSwitch('state', true, true);
                  $("input[data-tipo-asistente='4']").bootstrapSwitch('state', true, true);
                  $("input[data-tipo-asistente='5']").bootstrapSwitch('state', false, false);
                  pasos_anadidos.length=0;
                  <?php $tipo_asistente=TipoAsistente::where("id", "<", "5")->get();?>
                  @foreach($tipo_asistente as $tipo)
                  @foreach($tipo->pasosCrecimiento as $paso)
                    if(pasos_culminados.indexOf(parseInt("{{$paso->id}}"))==-1)
                    {
                      pasos_anadidos.push("{{$paso->id}}");
                    }
                    
                  @endforeach
                  @endforeach

                  <?php $tipo_asistente=TipoAsistente::where("id", ">=", "5")->get();?>
                  @foreach($tipo_asistente as $tipo)
                  @foreach($tipo->pasosCrecimiento as $paso)
                    if(pasos_culminados.indexOf(parseInt("{{$paso->id}}"))!=-1)
                    {
                      //alert(pasos_eliminados.indexOf("{{$paso->id}}"));
                      if(pasos_eliminados.indexOf("{{$paso->id}}")==-1)
                      pasos_eliminados.push("{{$paso->id}}");
                    }
                    
                  @endforeach
                  @endforeach
                  //alert("eliminados: "+pasos_eliminados);
                  //alert("anadidos: "+pasos_anadidos);
                  
                }
                if(pasos_eliminados.length==0)
                  $("#pasos_eliminados").val("");
                else
                  $("#pasos_eliminados").val(pasos_eliminados);

                if(pasos_anadidos.length==0)
                  $("#pasos_anadidos").val("");
                else
                  $("#pasos_anadidos").val(pasos_anadidos);
                //alert("array eliminados: "+pasos_eliminados);
                //alert("array anadidos: "+pasos_anadidos);
              });

          });
        </script>
        <!-- Page script -->


        

        <script type="text/javascript">
            $(function() {
                //para las mascaras en los input
                $("[data-mask]").inputmask();

                //Date range picker$
                $('#fecha_nacimiento').datepicker({
                    language: 'es',
                    format: 'dd/mm/yyyy'
                });
                //Date range picker with time picker
                 //Date range picker$
                $('#fecha_ingreso').datepicker({
                    language: 'es',
                    format: 'dd/mm/yyyy'
                });
                //Date range picker with time picker


            });
        </script>

        <!-- Script de funciones para las busquedas de lineas (palabra principal y diezmos)-->
        <script type="text/javascript">                  
        
          var nombre_class_linea="{{ Helper::sanearString($termino_linea->singular) }}";
          
          ///este es el panel donde se cargaran los registros seleccioandos por el usuario
          var panel_linea_seleccionado=$("#linea-seleccionada"); 

          function construyeItemlinea(id, panel, input, nombre_cl){
            // solo añade el cargando si no existe ya uno en pantalla.
            if (!$('#linea-seleccionada #item-cargando').length){
             panel_linea_seleccionado.html('<div style="padding: 5px;" id="item-cargando" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><center><img class="img-responsive" src="/img/ajax-loader1.gif" /><center></div>'); 
            }
            ///el primer parametro es el ID el segundo el nombre de la class adicionales, el tercero cantidad de col para lg y md y el cuarto cantidad de col para sm y xs
            $.ajax({url:"/lineas/linea-seleccionada/"+id+"/"+nombre_cl+"/12/12",cache:false, type:"POST",success:function(resp)
              {
                panel.html(resp);///si se quiere añadir un item en lugar de reemplazar se cambia por .append 
                $("#panel-grupo").show();

                muestraPanelElegirGrupo(id);

                $("#ico-"+nombre_cl).css("height", $("#info-"+nombre_cl).height());
                @if(Auth::user()->id!=1)
                  $('.cerrar-'+nombre_cl+'-seleccionado').hide();
                @endif
                $('.cerrar-'+nombre_cl+'-seleccionado').click(function () {
                  $("#item-"+nombre_cl+"-"+id).remove();
                  $("#panel-grupo").hide();
                  input.val("");
                  $("#grupo_id").val("");
                  $(".grupo_seleccionado").remove();
                }); 
              }
            });
          }

          function seleccionar_linea(){
            $('.seleccionar-'+nombre_class_linea).unbind('click');///primero se eliminan todos los ateriores eventos click
            $('.seleccionar-'+nombre_class_linea).click(function () {
              var idlinea = $(this).attr("data-id");
              $("#linea_id").val(idlinea);
              $("#grupo_id").val("");
              $(".grupo_seleccionado").remove();
              construyeItemlinea(idlinea, panel_linea_seleccionado, $("#linea_id"), nombre_class_linea);
            });
          }           

          $(document).ready(function() {
            sql_adicional="";
            //se crea un objeto de la Clase BusquedaFB y se cargan los primeros registros
            var busqueda_linea = new BusquedaFB($("#busqueda_linea"), $("#panel-ppl-lineas"), "panel-lineas", "/lineas/obtiene-lineas-para-busqueda-ajax/"+nombre_class_linea+"/todas", seleccionar_linea, sql_adicional);
            busqueda_linea.cargarPrimerosRegistros();

            ///en caso de que el panel de resultados de la busqueda se necesite abrir con 
            ///un evento se colocan las siguientes lineas, en este caso con el evento focus del input de busqueda
            $("#busqueda_linea").focus(function() {
              busqueda_linea.muestraPanel($("html"));
            });

          });

          ///lo siguiente carga la linea a la que pertenece actualzmente el asistente
          @if(isset($asistente->linea->id))
          construyeItemlinea({{ $asistente->linea_id }}, panel_linea_seleccionado, $("#linea_id"), nombre_class_linea);
          @endif 

        </script>
        <!--Finaliza Script del document ready para la busqueda de lineas-->

        <!-- Script de funciones para las busquedas de grupos (palabra principal y diezmos)-->
        <script type="text/javascript">                  

          var nombre_class_grupo="{{Helper::sanearString($termino_grupo->singular)}}"
          ///este es el panel donde se cargaran los registros seleccioandos por el usuario
          var panel_grupo_seleccionado=$("#grupo-seleccionado"); 

          function seleccionar_grupo(){
            $('.seleccionar-'+nombre_class_grupo).unbind('click');///primero se eliminan todos los ateriores eventos click
            $('.seleccionar-'+nombre_class_grupo).click(function () {
              var idgrupo = $(this).attr("data-id");
              $("#grupo_id").val(idgrupo);
              construyeItemGrupo(idgrupo, panel_grupo_seleccionado, $("#grupo_id"), nombre_class_grupo);
            });
          } 


          function construyeItemGrupo(id, panel, input, nombre_cl){
            // solo añade el cargando si no existe ya uno en pantalla.
            if (!$('#grupo-seleccionado #item-cargando').length){
             panel_grupo_seleccionado.html('<div style="padding: 5px;" id="item-cargando" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><center><img class="img-responsive" src="/img/ajax-loader1.gif" /><center></div>'); 
            }
            ///el primer parametro es el ID el segundo el nombre de la class adicionales, el tercero cantidad de col para lg y md y el cuarto cantidad de col para sm y xs
            $.ajax({url:"/grupos/grupo-seleccionado/"+id+"/"+nombre_cl+"/12/12",cache:false, type:"POST",success:function(resp)
              {
                panel.html(resp);///si se quiere añadir un item en lugar de reemplazar se cambia por .append 
                
                $('.cerrar-'+nombre_cl+'-seleccionado').click(function () {
                  //alert("jeje");
                  $("#item-"+nombre_cl+"-"+id).remove();
                  input.val("");
                }); 
              }
            });
          }

          function muestraPanelElegirGrupo(id_linea){
            sql_adicional="";
            //se crea un objeto de la Clase BusquedaFB y se cargan los primeros registros
            var busqueda_grupo = new BusquedaFB($("#busqueda_grupo"), $("#panel-ppl-grupos"), "panel-grupos", "/grupos/obtiene-grupos-para-busqueda-ajax/"+nombre_class_grupo+"/"+id_linea, seleccionar_grupo, sql_adicional);
            busqueda_grupo.cargarPrimerosRegistros();


            ///en caso de que el panel de resultados de la busqueda se necesite abrir con 
            ///un evento se colocan las siguientes grupos, en este caso con el evento focus del input de busqueda
            $("#busqueda_grupo").focus(function() {
              busqueda_grupo.muestraPanel($("html"));
            });
          }

          $(document).ready(function() {

            ///lo siguiente carga la linea a la que pertenece actualzmente el asistente
            @if(isset($asistente->grupo->id))
            construyeItemGrupo({{ $asistente->grupo_id }}, panel_grupo_seleccionado, $("#grupo_id"), nombre_class_grupo);
            @endif
            
            $("#menu_asistentes").children("a").first().trigger('click');
          });
        </script>
        <!--Finaliza Script del document ready para la busqueda de grupos-->

    </body>
</html>
