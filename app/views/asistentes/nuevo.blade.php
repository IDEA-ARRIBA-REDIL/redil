@if(Auth::check())
@include('includes.lenguaje')
<?php include '../app/views/includes/terminos.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{{Lang::get('asistentes.na_title_pagina')}}|{{$texto_nuevo_asistente}} {{$termino_asistente->singular}}</title>
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

            <form role="form" action="new" id="formulario" method="post" enctype="multipart/form-data"> 

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">    
                       
                <!-- contendio cabezote -->
                <section class="content-header">
                  <div class="box-header">
                    <h3 class="content-header barra-titulo">
                          {{Lang::get('asistentes.texto_nueva_persona')}}
                          <small> {{Lang::get('asistentes.na_subtitle_encabezado_minuscula')}} </small>
                    </h3>
                    <div class="pull-right box-tools">
                      <button type="submit" class="btn btn-danger"> <i class="fa fa-save"></i> {{Lang::get('asistentes.boton_guardar')}}</button>
                      <a href="lista/todos" class="btn bg-light-redil"> <i class="fa fa-undo"></i> {{Lang::get('asistentes.boton_cancelar')}}</a>
                    </div>
                      
                      
                  </div>
                </section>
                <!-- /contendio cabezote -->
                 

             <!-- contenido principal -->
              <section class="content">
                  
                  
                  <!-- row para el formulario -->
                    <div class="row">
                     
                        <!-- columna del boton guardar -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class=" box-header" style="margin-bottom: 10px;">
                              <?php 
                                $status=Session::get('status'); 
                              ?>
                              @if($status=='ok_new')
                              <?php 
                                $id=Session::get('id_nuevo'); 
                                $nombre=Session::get('nombre_nuevo'); 
                                $apellido=Session::get('apellido_nuevo'); 
                              ?>
                                <div class="alert alert-success col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom:5px; padding-top:5px;" >
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <b>{{Lang::get('asistentes.texto_asistente_individual')}} <a title="{{Lang::get('asistentes.texto_simple_title_asistente_individual')}}" href="/asistentes/actualizar/{{ $id }}">{{ $id }} es {{ $nombre." ".$apellido }}</a> creado exitosamente.</b> Si deseas editarlo <a title="Clic aquí para editar" href="/asistentes/actualizar/{{ $id }}">Clic Aquí </a>
                              </div>
                              @endif
                            </div>
                        </div>
                        
                         <!-- /columna del boton guardar -->
                      <!-- columna informacion basica -->
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 ">
                            <div class="panel">
                              <div class="panel-heading">
                                <h4 class="modal-title">{{Lang::get('asistentes.texto_informacion_basica_asistente')}}</h4>
                              </div>
                                <div class="panel-body">
                                      <div class="col-md-6">

                                          <!-- subir foto -->
                                          <div class="form-group">
                                            <label for="exampleInputFile">{{Lang::get('asistentes.texto_subir_foto_asistente')}}</label><br>
                                            <?php
                                              $fechaSegundos = time(); 
                                              $strNoCache = "?nocache=$fechaSegundos"; 
                                            ?>
                                            <div style="padding-left: 8px; padding-right: 8px" class="col-lg-3 col-md-12 col-xs-12 col-sm-2">
                                              <img style="padding-left: 4px; padding-right: 4px; margin-bottom: 10px" id="foto-cortada" src="/img/fotos/default-m.png" align="left" class="img-circle col-lg-12 col-md-6 col-sm-11 col-xs-5 col-sm-offset-0 col-md-offset-3 col-xs-offset-4 col-lg-offset-0"   />
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
                                             <label><span class="campo-obligatorio">*</span>{{Lang::get('asistentes.texto_campo_nombres')}}</label>
                                             <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Escribe tu nombre..." required/>
                                          </div>
                                          <!-- /Nombre -->

                                          <!-- Apellido -->
                                          <div class="form-group">
                                             <label><span class="campo-obligatorio">*</span>{{Lang::get('asistentes.texto_campo_apellidos')}}</label>
                                             <input id="apellido" name="apellido" type="text" class="form-control" placeholder="Escribe tu apellido..." required/>
                                          </div>
                                          <!-- /Apellido -->

                                          <!-- Genero sexual -->
                                          <div class="form-group"> 
                                              <label><span class="campo-obligatorio">*</span>{{Lang::get('asistentes.texto_campo_genero')}}</label>
                                                    <div class="radio">
                                                        <label class="label-genero">
                                                            <input type="radio" name="genero" id="genero-m" value="0" required >
                                                           {{Lang::get('asistentes.texto_campo_genero_masculino')}}
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label class="label-genero">
                                                            <input type="radio" name="genero" id="genero-f" value="1" required>{{Lang::get('asistentes.texto_campo_genero_femenino')}}
                                                        </label>
                                                    </div>
                                          </div>
                                           <!-- /Genero sexual -->
                                           <!-- Estado Civil -->
                                            <div class="form-group">
                                                    <label>{{Lang::get('asistentes.texto_campo_estado_civil')}}</label>
                                                    <select id="estado_civil" name="estado_civil" class="form-control">
                                                        <option value="0" selected ></option>
                                                        <option value="1" >{{Lang::get('asistentes.texto_campo_estado_civil_soltero')}}</option>
                                                        <option value="2" >{{Lang::get('asistentes.texto_campo_estado_civil_casado')}}</option>
                                                        <option value="3" >{{Lang::get('asistentes.texto_campo_estado_civil_libre')}}</option>
                                                        <option value="4" >{{Lang::get('asistentes.texto_campo_estado_civil_divorciado')}}</option>
                                                        <option value="5">{{Lang::get('asistentes.texto_campo_estado_civil_viudo')}}</option>
                                                    </select>
                                            </div>
                                            <!-- /Estado Civil -->
                                        </div>
                                   
                                      <div class="col-md-6">
                                           <!-- Tipo de id -->
                                           <div class="form-group">
                                                    <label>{{Lang::get('asistentes.texto_campo_tipoid')}}</label>
                                                    <select id="tipo_identificacion" name="tipo_identificacion" class="form-control">
                                                        <option value="0" selected></option>
                                                        <option value="1" >{{Lang::get('asistentes.texto_campo_tipoid_registro')}}</option>
                                                        <option value="2" >{{Lang::get('asistentes.texto_campo_tipoid_tarjeta')}}</option>
                                                        <option value="3" >{{Lang::get('asistentes.texto_campo_tipoid_cedula')}}</option>
                                                        <option value="4" >{{Lang::get('asistentes.texto_campo_tipoid_cedula_ext')}}</option>
                                                        <option value="5" >{{Lang::get('asistentes.texto_campo_tipoid_otro')}}</option>
                                                    </select>
                                           </div>
                                           <!-- /tipo de id -->
                                       
                                           <div class="form-group">
                                             <label>{{Lang::get('asistentes.texto_campo_identificacion')}}</label>
                                             <input id="identificacion" name="identificacion" type="text" class="form-control" placeholder="Escribe tu identificación..." />
                                          </div>
                                          <div class="form-group">
                                             <label>{{Lang::get('asistentes.texto_campo_nacionalidad')}}</label>
                                             <input id="nacionalidad" name="nacionalidad" type="text" class="form-control" placeholder="Escribe tu pais natal..." />
                                          </div>
                                      
                                            <!-- Fecha de nacimiento mm/dd/yyyy -->
                                            <div class="form-group">
                                                <label>{{Lang::get('asistentes.texto_campo_fecha_nacimiento')}}</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input id="fecha_nacimiento" name="fecha_nacimiento" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask />
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
                                                    <input required id="fecha_ingreso" name="fecha_ingreso" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
                                                </div>
                                            </div>
                                            <!-- /.fin Fecha de ingreso -->
                                            
                                      </div>
                                 </div> <!-- /box-body -->
                            </div>
                        </div>
                        <!-- /columna informacion basica -->

                       

                        <!-- columna informacion Contacto -->
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
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
                                            <input id="telefono_fijo" name="telefono_fijo" type="text" class="form-control" data-mask />
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
                                            <input id="telefono_movil" name="telefono_movil" type="text" class="form-control" data-mask />
                                        </div>
                                    </div>
                                    <!-- /Telefono Movil #1 -->
                                     <!-- Telefono  otro Telefono -->
                                    <div class="form-group">
                                        <label> {{Lang::get('asistentes.texto_campo_tel_otro')}} </label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <input id="telefono_otro" name="telefono_otro" type="text" class="form-control" />
                                        </div>
                                    </div>
                                    <!-- /Telefono otro Telefono -->
                                    <!-- /Email -->
                                    <div class="form-group">
                                            <label for="exampleInputEmail1">{{Lang::get('asistentes.texto_campo_correo')}}</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="">@</i>
                                                </div>
                                            <input type="email" name="email" class="form-control" id="email" placeholder="Escriba su E-mail" >
                                            </div>
                                    </div>
                                    <!-- /Email -->
                                    <!-- Direccion -->
                                       <div class="form-group">
                                          <label>{{Lang::get('asistentes.texto_campo_direccion')}}</label>
                                          <textarea id="direccion" name="direccion" class="form-control" rows="3"  maxlength="200"  placeholder="Escribe tu dirección y barrio ..."> </textarea>
                                       </div>
                                     <!-- /Direccion -->                                    
                                </div>
                            </div>
                        </div>
                        <!-- /columna informacion Medica -->


                        <!-- columna informacion Medica -->
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                            <div class="panel">
                              <div class="panel-heading">
                                <h4 class="modal-title">{{Lang::get('asistentes.texto_title_info_medica')}}</h4>
                              </div>
                                <div class="panel-body">
                                  <div class="form-group">
                                     <label>{{Lang::get('asistentes.texto_campo_tipo_sangre')}}</label>
                                     <input id="tipo_sangre" name="tipo_sangre" type="text" class="form-control" placeholder="Ej. A+" />
                                  </div>
                                  <!-- Indicaciones medicas -->
                                  <div class="form-group">
                                      <label>{{Lang::get('asistentes.texto_campo_indicaciones_medicas')}}</label>
                                      <textarea id="indicaciones_medicas" name="indicaciones_medicas" class="form-control" rows="5"  maxlength="500" placeholder=""> </textarea>
                                  </div>
                                  <!-- /Indicaciones medicas -->
                                  <!-- Limitaciones -->
                                   <div class="form-group">
                                      <label>{{Lang::get('asistentes.texto_campo_limitaciones')}}</label>
                                      <textarea id="limitaciones" name="limitaciones" class="form-control" rows="7"  maxlength="500" placeholder=""> </textarea>
                                   </div>
                                 <!-- /Limitaciones -->                                    
                                </div>
                            </div>
                        </div>
                        <!-- /columna informacion Medica -->
                        
                        <!-- columna Pasos culminados -->
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                                <div class="panel">
                                  <div class="panel-heading">
                                    <h4 class="modal-title">{{Lang::get('asistentes.texto_title_crecimiento')}}</h4>
                                  </div>
                                    
                                    <div class="panel-body">

                                         <!-- Tipo de asistente -->
                                           <div class="form-group">
                                                    <label><span class="campo-obligatorio">*</span>{{Lang::get('asistentes.texto_campo_tipo_asistente')}}</label>
                                                    <select id="tipo_asistente_id" name="tipo_asistente_id" class="form-control" required>
                                                        <option value="" selected ></option>
                                                        <option value="1" >{{Lang::get('asistentes.texto_campo_tipo_asistente_nuevo')}}</option>
                                                        <option value="2" >{{Lang::get('asistentes.texto_campo_tipo_asistente_oveja')}}</option>
                                                        <option value="3" >{{Lang::get('asistentes.texto_campo_tipo_asistente_miembro')}}</option>
                                                        <option value="4" >{{Lang::get('asistentes.texto_campo_tipo_asistente_lider')}}</option>
                                                        @if(Auth::user()->id==1)
                                                        <option value="5" >{{Lang::get('asistentes.texto_campo_tipo_asistente_pastor')}}</option>
                                                        @endif
                                                    </select>
                                            </div>
                                            <!-- /Tipo de asistente-->
                                            <!-- pasos -->
                                              <label>{{Lang::get('asistentes.texto_campo_pasos')}}</label>
                                              @foreach($pasos as $paso)
                                              <p>
                                              <div class="checkbox" data-toggle="tooltip" data-placement="left" data- data-original-title="{{ $paso->descripcion }}" >
                                                  <input style="width: 100%;" data-id="switch-{{ $paso->id }}" id="{{ $paso->id }}" class="paso-crecimiento" name="switch-pasos" data-tipo-asistente="{{ $paso->tipo_asistente_id }}" type="checkbox"/>
                                              </div>
                                            </p>
                                              @endforeach
                                              <input class="hide" name="pasos" id="pasos" type="text" class="form-control" placeholder="" readonly />
                                            
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
                                    <label>{{Lang::get('asistentes.texto_campo_info_ministerial')}}</label>
                                    <li class="dropdown messages-menu">
                                      <div class="input-group" @if(Auth::user()->id!=1 && Auth::user()->asistente->iglesiaEncargada()->count()==0) style="display:none;" @endif >
                                        <input class="oculto-required" type="text" name="linea_id" id="linea_id" @if(Auth::user()->id!=1 && Auth::user()->asistente->iglesiaEncargada()->count()==0) value="{{ Auth::user()->asistente->id }} @endif"/>
                                        <input @if(Auth::user()->id!=1 && Auth::user()->asistente->iglesiaEncargada()->count()==0)type="hidden" @else type="text"@endif id="busqueda_linea" class="form-control buscar" autocomplete="off" placeholder="Buscar linea por código, nombre o cédula..."/>
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
                                  <div id="panel-grupo" class="nav navbar-nav panel-ppl-busqueda" style="@if(Auth::user()->id==1 || Auth::user()->asistente->iglesiaEncargada()->count()>0)display:none;@endif margin-bottom: 30px; margin-top: 30px;">
                                    <label> Seleccione {{Helper::articulo($termino_grupo->genero, 'singular')}} {{$termino_grupo->singular}} donde asiste {{Helper::articulo($termino_asistente->genero, 'singular')}} {{$termino_asistente->singular}}:</label>
                                    <li class="dropdown messages-menu">
                                      <div class="input-group "  >
                                        <input type="hidden" id="grupo_id" name="grupo_id"/>
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
                                      <div class="footer">{{Lang::get('asistentes.texto_mostrar_resultados')}}</div>
                                    </li>
                                  </div>  
                                  <div id="grupo-seleccionado">  

                                  </div>
                                        
                                </div>
                                
                            </div>
                        </div>
                        <!-- /columna  Ubicacion grupo -->
                        
                         <!-- columna del boton guardar -->
                        <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
                          <div class="pull-right">
                            <button type="submit" class="btn btn-danger"> <i class="fa fa-save"></i> {{Lang::get('asistentes.boton_guardar')}}</button>
                            <a href="../lista/todos" class="btn bg-light-redil"> <i class="fa fa-undo"></i>  {{Lang::get('asistentes.boton_cancelar')}}</a>
                          </div>
                            <h4 class="pull-left"><span class=" campo-obligatorio">*</span> {{Lang::get('asistentes.texto_title_campos_obligatorios')}} </h4>
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
                                <h4 class="modal-title" id="myModalLabel">{{Lang::get('asistentes.texto_modal_recorte_imagen')}}n</h4>
                            </div>
                        <div class="modal-body text-center" id="panel-imagen">
                            <img src="/img/ajax-loader1.gif" id="cargando" />
                        </div>
                        <div class="modal-footer" id="footer-imagen">
                          <button id="90" type="button" class="rotar btn btn-primary" title="" data-original-title="{{Lang::get('asistentes.texto_simple_rotar_izquierda')}}"><i class="fa fa-undo"></i></button>
                          <button id="-90" type="button" class="rotar btn btn-primary" title="" data-original-title="{{Lang::get('asistentes.texto_simple_rotar_izquierda')}}"><i class="fa fa-repeat"></i></button>
                          
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


        <!-- bootstra datepicker-->
        <script src="/js/bootstrap-datepicker.js"></script>
        <script src="/js/locales/bootstrap-datepicker.es.js"></script>

        <script src="/js/bootstrap-switch.js"></script>

        <!-- script de busqueda tìpo facebook -->
        <script src="/js/AdminLTE/busqueda-fc.js" type="text/javascript"></script>

        <!-- jcrop esta es para la edicion de imagenes -->
        <script type="text/javascript" src="/js/plugins/jcrop/jquery.Jcrop.min.js"></script>

        <script type="text/javascript">

            @include('includes.procesa-foto-js')

            $(".iCheck-helper").click(function(){
              if($("#foto-hide").val()=="")
              if($(this).siblings("input[name=genero]").attr("id")=="genero-m")
              {
                $("#foto-cortada").attr("src", "/img/fotos/default-m.png");
              }
              else
              {
                $("#foto-cortada").attr("src", "/img/fotos/default-f.png");
              }
            });

            $(".label-genero").click(function(){
              if($("#foto-hide").val()=="")
              if($(this).find("input[name=genero]").attr("id")=="genero-m")
              {
                $("#foto-cortada").attr("src", "/img/fotos/default-m.png");
              }
              else
              {
                $("#foto-cortada").attr("src", "/img/fotos/default-f.png");
              }
            });

            var pasos_culminados=new Array();

            $("[name='switch-pasos']").bootstrapSwitch({
              onText: 'Si',
              offText: 'No',
              onColor: "success",
              offColor: "danger"
            });

             @foreach($pasos as $paso)
              $('input[data-id="switch-{{ $paso->id }}"]').bootstrapSwitch('labelText', '{{ $paso->nombre }}' );
             @endforeach
             
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

              //Date range picker with time picker
             // $(".iCheck-helper").
              $('.paso-crecimiento').on('switchChange.bootstrapSwitch', function(event, state) {
                var paso_culminado= $(this).attr("id");
                if($(this).is(':checked'))
                  pasos_culminados.push(paso_culminado);
                else
                {
                  var pos=pasos_culminados.indexOf($(this).attr('id')); // obtengo la posicion de arreglo segun el data-id
                  //alert("arreglo: "+pasos_culminados+" elemento: "+$(this).attr('id')+" pos: "+pos);
                  pasos_culminados.splice(pos,1);
                }
                //alert(pasos_culminados);
                if(pasos_culminados.length==0)
                  $("#pasos").val("");
                else
                  $("#pasos").val(pasos_culminados);
              });


              $('#tipo_asistente_id').change (function () {
                
                pasos_culminados.length=0;
                if($('#tipo_asistente_id').val()=="1")
                {
                  //alert(pasos_culminados);
                  $("input[data-tipo-asistente='1']").bootstrapSwitch('state', false, false);
                  $("input[data-tipo-asistente='2']").bootstrapSwitch('state', false, false);
                  $("input[data-tipo-asistente='3']").bootstrapSwitch('state', false, false);
                  $("input[data-tipo-asistente='4']").bootstrapSwitch('state', false, false);
                  $("input[data-tipo-asistente='5']").bootstrapSwitch('state', false, false);
                  
                }
                else if($('#tipo_asistente_id').val()=="2")
                {
                  <?php $tipo_asistente=TipoAsistente::find(1);?>
                  @foreach($tipo_asistente->pasosCrecimiento as $paso)
                    pasos_culminados.push("{{$paso->id}}");
                  @endforeach
                  //alert(pasos_culminados);
                  $("input[data-tipo-asistente='1']").bootstrapSwitch('state', true, true);
                  $("input[data-tipo-asistente='2']").bootstrapSwitch('state', false, false);
                  $("input[data-tipo-asistente='3']").bootstrapSwitch('state', false, false);
                  $("input[data-tipo-asistente='4']").bootstrapSwitch('state', false, false);
                  $("input[data-tipo-asistente='5']").bootstrapSwitch('state', false, false);
                }
                else if($('#tipo_asistente_id').val()=="3")
                {
                  <?php $tipo_asistente=TipoAsistente::where("id", "<", "3")->get();?>
                  @foreach($tipo_asistente as $tipo)
                  @foreach($tipo->pasosCrecimiento as $paso)
                    pasos_culminados.push("{{$paso->id}}");
                  @endforeach
                  @endforeach
                  //alert(pasos_culminados);
                  $("input[data-tipo-asistente='1']").bootstrapSwitch('state', true, true);
                  $("input[data-tipo-asistente='2']").bootstrapSwitch('state', true, true);
                  $("input[data-tipo-asistente='3']").bootstrapSwitch('state', false, false);
                  $("input[data-tipo-asistente='4']").bootstrapSwitch('state', false, false);
                  $("input[data-tipo-asistente='5']").bootstrapSwitch('state', false, false);
                }

                else if($('#tipo_asistente_id').val()=="4")
                {
                  <?php $tipo_asistente=TipoAsistente::where("id", "<", "4")->get();?>
                  @foreach($tipo_asistente as $tipo)
                  @foreach($tipo->pasosCrecimiento as $paso)
                    pasos_culminados.push("{{$paso->id}}");
                  @endforeach
                  @endforeach
                  //alert(pasos_culminados);
                   $("input[data-tipo-asistente='1']").bootstrapSwitch('state', true, true);
                  $("input[data-tipo-asistente='2']").bootstrapSwitch('state', true, true);
                  $("input[data-tipo-asistente='3']").bootstrapSwitch('state', true, true);
                  $("input[data-tipo-asistente='4']").bootstrapSwitch('state', false, false);
                  $("input[data-tipo-asistente='5']").bootstrapSwitch('state', false, false);
                }

                else if($('#tipo_asistente_id').val()=="5")
                {
                  <?php $tipo_asistente=TipoAsistente::where("id", "<", "5")->get();?>
                  @foreach($tipo_asistente as $tipo)
                  @foreach($tipo->pasosCrecimiento as $paso)
                    pasos_culminados.push("{{$paso->id}}");
                  @endforeach
                  @endforeach
                  //alert(pasos_culminados);
                  $("input[data-tipo-asistente='1']").bootstrapSwitch('state', true, true);
                  $("input[data-tipo-asistente='2']").bootstrapSwitch('state', true, true);
                  $("input[data-tipo-asistente='3']").bootstrapSwitch('state', true, true);
                  $("input[data-tipo-asistente='4']").bootstrapSwitch('state', true, true);
                  $("input[data-tipo-asistente='5']").bootstrapSwitch('state', false, false);
                }
                if(pasos_culminados.length==0)
                  $("#pasos").val("");
                else
                  $("#pasos").val(pasos_culminados);
                
              });

            
          });
        </script>

        <!-- Script de funciones para las busquedas de lineas (palabra principal y diezmos)-->
        <script type="text/javascript">                  
        
          var nombre_class_linea="linea"
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
                $("#grupo_id").val("");
                $(".grupo_seleccionado").remove();
                $("#panel-grupo").show();

                muestraPanelElegirGrupo(id);

                $("#ico-"+nombre_cl).css("height", $("#info-"+nombre_cl).height());
                @if(Auth::user()->id!=1)
                  $('.cerrar-'+nombre_cl+'-seleccionado').hide();
                @endif
                $('.cerrar-'+nombre_cl+'-seleccionado').click(function () {
                  //alert("jeje");
                  $("#item-"+nombre_cl+"-"+id).remove();
                  $("#panel-grupo").hide();
                  input.val("");
                  $("#grupo_id").val("");
                  $(".grupo_seleccionado").remove();
                }); 
              }
            });
          }

          @if(Auth::user()->id==1 || Auth::user()->asistente->iglesiaEncargada()->count()>0)
          function seleccionar_linea(){
            $('.seleccionar-'+nombre_class_linea).unbind('click');///primero se eliminan todos los ateriores eventos click
            $('.seleccionar-'+nombre_class_linea).click(function () {
              var idlinea = $(this).attr("data-id");
              $("#linea_id").val(idlinea);
              construyeItemlinea(idlinea, panel_linea_seleccionado, $("#linea_id"), nombre_class_linea);
            });
          }           

          $(document).ready(function() {
            sql_adicional="";
            //se crea un objeto de la Clase BusquedaFB y se cargan los primeros registros
            var busqueda_linea = new BusquedaFB($("#busqueda_linea"), $("#panel-ppl-lineas"), "panel-lineas", "/lineas/obtiene-lineas-para-busqueda-ajax/"+nombre_class_linea+"/todas", seleccionar_linea, sql_adicional);
            busqueda_linea.cargarPrimerosRegistros();


            ///las sgtes lineas cargan los registros seleccionados
            /*@if(isset($asistente->asistentelinea->id))
            construyeItemlinea({{ $reporte->asistentelinea->id }}, panel_linea_seleccionado, $("#linea_id"), nombre_class_linea);
            @endif*/

            ///en caso de que el panel de resultados de la busqueda se necesite abrir con 
            ///un evento se colocan las siguientes lineas, en este caso con el evento focus del input de busqueda
            $("#busqueda_linea").focus(function() {
              busqueda_linea.muestraPanel($("html"));
            });

          });
        @else
          construyeItemlinea({{ Auth::user()->asistente->linea_id }}, panel_linea_seleccionado, $("#linea_id"), nombre_class_linea);
        @endif
        </script>
        <!--Finaliza Script del document ready para la busqueda de lineas-->

        <!-- Script de funciones para las busquedas de grupos-->
        <script type="text/javascript">                  

          var nombre_class_grupo="grupo"
          ///este es el panel donde se cargaran los registros seleccioandos por el usuario
          var panel_grupo_seleccionado=$("#grupo-seleccionado"); 

          function seleccionar_grupo(){
            $('.seleccionar-'+nombre_class_grupo).unbind('click');///primero se eliminan todos los ateriores eventos click
            $('.seleccionar-'+nombre_class_grupo).click(function () {
              var idgrupo = $(this).attr("data-id");
              $("#grupo_id").val(idgrupo);
              construyeItemgrupo(idgrupo, panel_grupo_seleccionado, $("#grupo_id"), nombre_class_grupo);
            });
          } 


          function construyeItemgrupo(id, panel, input, nombre_cl){
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


            ///las sgtes grupos cargan los registros seleccionados
            /*@if(isset($reporte->asistentegrupo->id))
            construyeItemgrupo({{ $reporte->asistentegrupo->id }}, panel_grupo_seleccionado, $("#grupo_id"), nombre_class_grupo);
            @endif*/

            ///en caso de que el panel de resultados de la busqueda se necesite abrir con 
            ///un evento se colocan las siguientes grupos, en este caso con el evento focus del input de busqueda
            $("#busqueda_grupo").focus(function() {
              busqueda_grupo.muestraPanel($("html"));
            });
          }

          $(document).ready(function() {
            
            $("#menu_asistentes").children("a").first().trigger('click');
          });
        </script>
        <!--Finaliza Script del document ready para la busqueda de grupos-->

    </body>
</html>
@endif