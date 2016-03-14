@if(Auth::check())
@include('includes.lenguaje')
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>{{Lang::get('reuniones.texto_reporte_index_titulo_pagina')}} | {{Lang::get('reuniones.texto_simple_titulo_pagina_nueva')}}</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <!-- bootstrap 3.0.2 -->
  <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- font Awesome -->
  <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <!-- Ionicons -->
  <link href="../css/ionicons.min.css" rel="stylesheet" type="text/css" />
  <!-- datepicker.css -->
  <link href="../css/datepicker.css" rel="stylesheet" type="text/css" />
  <link href="../css/datepicker3.css" rel="stylesheet" type="text/css" />
  <!-- DATA TABLES -->
  <link href="../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
  <link href="/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>

  <!-- Theme style -->
  <link href="../css/AdminLTE.css" rel="stylesheet" type="text/css" />
  <link href="http://cdn.datatables.net/1.10.0/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.../js/1.3.0/respond.min.js"></script>
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


                <!-- sidebar menu: : style can be found in sidebar.less -->
                @include('includes.menu')

              </section>
              <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
              <!-- contendio cabezote -->
              <section class="content-header">
                 <br>
                <h1>
                 <span class="mayusculas"> {{Lang::get('reuniones.texto_simple_nueva_reunion')}} </span>
                  <small> {{Lang::get('reuniones.texto_simple_subtitulo_pagina')}} </small></h1>
                           
                  <br>
                </section>
                <!-- /contendio cabezote -->


                <!-- contenido principal -->
                <section class="content">
                  <form action="new" method="post" role="form">

                    <!-- row para el formulario -->
                    <div class="row">

                     <!-- columna del boton guardar -->
                     <div class="col-md-12" style="margin-bottom: 10px;">
                      <div class=" box-header">
                        <div class="col-lg-4">
                        <button type="submit" class="btn btn-danger"> <i class="fa fa-save"></i>  {{Lang::get('reuniones.texto_boton_guardar')}}</button>
                        <a href="lista/todos" class="btn bg-light-redil"> <i class="fa fa-undo"></i> {{Lang::get('reuniones.texto_boton_cancelar')}}</a>
                      </div>
                      <div class="col-lg-8">
                                    <?php $status=Session::get('status'); ?>
                                    @if($status=='ok_update')
                                    <div class="alert alert-success col-lg-12 desvanecer" style="padding-bottom:5px; padding-top:5px; margin-bottom: -5px" >
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <?php $dia=Session::get('dia'); ?>
                                   {{Lang::get('reuniones.texto_mensaje_nuevo_culto_creado1')}} @if($dia != 0 && $dia !="" ){{ Lang::choice('general.dias', $dia) }} @endif  {{Lang::get('reuniones.texto_mensaje_nuevo_culto_creado2')}}
                                    @endif
                                    </div>
                               </div>
                      </div>
                    </div>
                    <!-- /columna del boton guardar -->
                    <!-- columna de 12 -->
                    <div class="col-md-12">
                      <div class="box box-primary">
                        <div class="panel-heading">
                         <h4 class="modal-title">  </h4>  
                        </div>

                        <div class="panel-body">
                          <div class="col-md-6">

                           <!-- Nombre -->
                           <div class="form-group">
                            <label>{{Lang::get('reuniones.texto_simple_campo_nombre')}}</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ejemplo: Reunión de Líderes"/>
                          </div>
                          <!-- /Nombre -->
                          <!-- Tipo de día -->
                          <div class="form-group">
                            <label>{{Lang::get('reuniones.texto_simple_campo_dia')}}</label>
                            <select name="dia" class="form-control" required>
                              <option value="">{{ Lang::choice ('general.dias', 0) }}</option>
                              <option value="2">{{ Lang::choice ('general.dias', 2) }}</option>
                              <option value="3">{{ Lang::choice ('general.dias', 3) }}</option>
                              <option value="4">{{ Lang::choice ('general.dias', 4) }}</option>
                              <option value="5">{{ Lang::choice ('general.dias', 5) }}</option>
                              <option value="6">{{ Lang::choice ('general.dias', 6) }}</option>
                              <option value="7">{{ Lang::choice ('general.dias', 7) }}</option>
                              <option value="1">{{ Lang::choice ('general.dias', 1) }}</option>
                            </select>
                          </div>
                          <!-- /tipo de día-->
                          <!-- Hora -->
                          <div class="form-group">
                            <div class="bootstrap-timepicker">
                              <label>{{Lang::get('reuniones.texto_simple_campo_hora')}}</label>
                              <div class="input-group">
                                <div class="input-group-addon"> <i class="fa fa-clock-o"></i></div>
                                <input name="hora" type="text" class="form-control timepicker"/>
                              </div>
                            </div> <!-- div que cierrra el bootstrap picker-->
                          </div>
                          <!-- /Hora -->
                        </div> 
                        <div class="col-md-6">
                                <!--Lugar -->
                           <div class="form-group">
                            <label>{{Lang::get('reuniones.texto_simple_campo_lugar')}}</label>
                            <input type="text" id="lugar" name="lugar" class="form-control" placeholder="Ejemplo: Sede Principal-MCM Tuluá"/>
                          </div>
                          <!-- /Lugar -->
                        <!-- Descripción -->
                        <div class="form-group">
                          <label>{{Lang::get('reuniones.texto_simple_campo_descripcion')}}</label>
                          <textarea id ="descripcion" name="descripcion" class="form-control" rows="5"  maxlength="500" placeholder=""></textarea>
                        </div>
                        <!-- /Descripción -->
                      </div>     
                    </div>
                  </div>
                </div>
                <!-- /columna de 12 -->

                <!-- columna del boton guardar -->
                <div class="col-md-12">
                  <div class=" box-header">
                    <button type="submit" class="btn btn-danger"> <i class="fa fa-save"></i>  {{Lang::get('reuniones.texto_boton_guardar')}}</button>
                    <a href="lista/todos" class="btn bg-light-redil"> <i class="fa fa-undo"></i> {{Lang::get('reuniones.texto_boton_cancelar')}}</a>
                  </div>
                </div>
                <!-- /columna del boton guardar -->


              </div>  
              <!-- /row para el formulario -->  
            </form>
          </section>
          <!-- contenido principal -->
        </aside>  


    @include('includes.scripts')

    <!-- InputMask -->
    <script src="../js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="../js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
    <script src="../js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
    <!-- date-range-picker -->
    <script src="../js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- bootstrap color picker -->
    <script src="../js/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
    <!-- bootstrap time picker -->
    <script src="../js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <!-- bootstra datepicker-->
    <script src="../js/bootstrap-datepicker.js"></script>
    <script src="../js/locales/bootstrap-datepicker.es.js"></script>

    <!-- DATA TABES SCRIPT -->
    <script src="http://cdn.datatables.net/1.10.0/js/jquery.dataTables.js" type="text/javascript"></script>
    <script src="../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

    <!-- page script -->
    <script type="text/javascript">

    $(document).ready(function() {
      $("#menu_reuniones").attr('class', 'treeview active');
      $("#submenu_reuniones").attr('style', 'display: block;');
      $("#flecha_reuniones").attr('class', 'fa fa-angle-down pull-right');
      $(".timepicker").timepicker({
          showInputs: false
        });
      $('#example1').dataTable( {

      } );
    } );

        //Timepicker hora de reunion



    </script>
    <!-- Page script -->

    
@endif
</body>
</html>