@if(Auth::check())
@include('includes.lenguaje')
<!DOCTYPE html>
<!-- Vista creada por: Darwin Castaño
     Fecha creacíón: 24-07-2014
     Fecha Ultima modificación: 24-07-2014 12:43pm
     funcion vista: esta es la vista que contiene el formulario para actualizar la linea
     software REDIL version 1.0
-->
<html>
    <head>
      <meta charset="UTF-8">
      <title>Redil | {{ Lang::get('lineas.al_title') }}</title>
      <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
      @include('includes.styles')
      <!-- datepicker.css -->
      <link href="/css/datepicker.css" rel="stylesheet" type="text/css" />
      <link href="/css/datepicker3.css" rel="stylesheet" type="text/css" />
       
        
      <!-- DATA TABLES -->
      <link href="/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
      <!-- iCheck for checkboxes and radio inputs -->
      <link href="/css/iCheck/all.css" rel="stylesheet" type="text/css" />
      <!-- bootstrap multiselect-->
      <link rel="stylesheet" href="/css/bootstrap-multiselect.css" type="text/css"/>
      <!-- Bootstrap time Picker -->
      <link href="/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
        
      <!-- HTML5 Shim and Repond.js IE8 support of HTML5 elements and media queries -->
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

        <form role="form" action="../update/{{ $linea->id }}" method="post">
        <!-- Right side column. Contains the navbar and content of the page -->
        <aside class="right-side">                
          <!-- Content Header (Page header) -->  
          <!-- contendio cabezote -->
           <section class="content-header">
              <div class="box-header">
                <h3 class="content-header barra-titulo">
                    <span class="mayusculas">{{ Lang::get('lineas.al_header') }}</span>
                    <small> {{ Lang::get('lineas.al_subtitulo') }} </small>
                </h3>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-padding pull-right box-tools">
                  <ul class="pull-right nav nav-pills">
                    <li class="active" role="presentation"><a href="/lineas/actualizar/{{ $linea->id }}"><small class="badge">1</small> Información Principal</a></li>
                    <li role="presentation"><a href="/lineas/anadir-lideres/{{ $linea->id }}"><small class="badge">2</small> Añadir Lideres</a></li>
                  </ul>
                </div>
              </div>
            </section>
            <!-- /contendio cabezote -->


                <!-- Contenido Principal -->
                <section class="content">

                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button type="submit" class="btn btn-danger"> <i class="fa fa-save"></i> {{ Lang::get('lineas.al_bt_guardar') }}</button>
                    <a href="/lineas/lista" class="btn bg-light-redil"> <i class="fa fa-undo"></i> {{ Lang::get('lineas.al_bt_volver') }}</a>
                    <br>
                  </div>
                        <div class="row">

                          <!-- columna del boton guardar -->
                          <div class="mensaje col-lg-12 col-md-12 col-xs-12 col-sm-12">
                              <div>
                                <?php $status=Session::get('status'); ?>
                                @if($status=='ok_update')
                                <div class=" alert alert-success col-lg-12" style="padding-bottom:5px; padding-top:5px;" >
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                  {{ Lang::get('lineas.al_ms_ok_update') }} 
                                </div>
                                @endif

                              </div>
                          </div>
                           <!-- /columna del boton guardar -->
                          <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                       	   	<div class="panel">
                              <div class="panel-heading"> <!-- aqui arranca en panel heading del formulario -->
                              	<h4 class="modal-title"> {{ Lang::get('lineas.al_mt_titulo') }}</h4>     
                              </div><!-- aqui termina en panel heading del formulario -->

                              <div class="panel-body"> <!-- aqui arranca en panel body del formulario -->
                                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                      <div class="form-group"> <!-- div dodnde se pone el nombre de la linea a crear del formulario -->
                                          <label><span class=" campo-obligatorio">*</span>{{ Lang::get('lineas.al_lb_nombre_linea') }}</label>
                                          <input type="text" id="nombre" name="nombre" class="form-control" placeholder="{{Lang::get('lineas.al_ph_nombre') }}" value="{{ $linea->nombre }}"/>
                                      </div><!-- cierra div dodnde se pone el nombre de la linea a crear del formulario -->
                                                         
                                      <div class="form-group">
                                          <label>{{ Lang::get('lineas.al_lb_descripcion') }}</label>
                                          <textarea id="descripcion" name="descripcion" placeholder="{{ Lang::get('lineas.al_lb_descripcion') }}" class="form-control" rows="3">{{$linea->descripcion}}</textarea>
                                      </div>

                                  </div>
                       
                                                       
                                  <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
                                    <div class="form-group">
                                        <label>{{ Lang::get('lineas.al_lb_palabra_rhema') }}</label>
                                        <textarea id="rhema" name="rhema" class="form-control" rows="3"  placeholder="{{ Lang::get('lineas.al_lb_palabra_rhema') }}">{{$linea->rhema}}</textarea>
                                    </div>
     					                                          
                                  </div> <!-- div que cierra la col-lg6  del panel completo-->  
                                          
                     		      </div><!-- div que cierra el panel body-->
                                    
                            </div> <!-- div que cierra box box primary-->
                          </div>
                        </div> <!-- div que cierra toda la row numero 1 de informacion principal del grupo-->

                        <!-- columna del boton guardar -->
                        <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
                          <div class="pull-right">
                            <button type="submit" class="btn btn-danger"> <i class="fa fa-save"></i> {{ Lang::get('lineas.al_bt_inf_guardar') }}</button>
                            <a href="/lineas/lista" class="btn bg-light-redil"> <i class="fa fa-undo"></i> {{ Lang::get('lineas.al_bt_volver') }}</a>
                          </div>
                            <h4 class="pull-left"><span class=" campo-obligatorio">*</span> Campos obligatorios </h4>
                        </div>
                        <!-- /columna del boton guardar -->

                                                           			 	 
                </section><!-- /.content -->
            </aside><!-- /.right- side -->
            </form> 
      </div><!-- ./wrapper -->   
                
                 
   

    @include('includes.scripts') 
       
    </body>
</html>
@endif