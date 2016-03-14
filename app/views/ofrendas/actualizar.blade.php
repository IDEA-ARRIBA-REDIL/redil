@if(Auth::check())
@include('includes.lenguaje')
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Redil | Modificar Ingreso</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <!-- bootstrap 3.0.2 -->
  <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- font Awesome -->
  <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <!-- Ionicons -->
  <link href="../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
  <!-- datepicker.css -->
  <link href="../../css/datepicker.css" rel="stylesheet" type="text/css" />
  <link href="../../css/datepicker3.css" rel="stylesheet" type="text/css" />


  <!-- Theme style -->
  <link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.../../js/1.3.0/respond.min.js"></script>
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
            <form action="../update/{{ $ofrenda->id }}" method="post" role="form">
            <aside class="right-side">                
              <!-- contendio cabezote -->
              <section class="content-header">
                <div class="box-header">
                  <h3 class="content-header barra-titulo">
                        ACTUALIZAR INGRESO
                        <small> Aquí podrás actualizar un ingreso financiero de un asistente. </small>
                  </h3>
                  <div class="pull-right box-tools">
                    <button type="submit" class="btn btn-danger"> <i class="fa fa-save"></i> Guardar</button>
                    <a href="lista/todos" class="btn bg-light-redil"> <i class="fa fa-undo"></i> Cancelar</a>
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
                          <?php $status=Session::get('status'); ?>
                          @if($status=='ok_update')
                          <div class="alert alert-success col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom:5px; padding-top:5px;" >
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            El Ingreso fue modificado satisfactoriamente. 
                          </div>
                          @endif
                          
                        </div>
                      </div>

                    <!-- columna de 12 -->
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                      <div class="panel">
                        <div class="panel-heading">
                         <h4 class="modal-title"> Información para modificar el Ingreso </h4>  
                        </div>

                        <div class="panel-body">
                          <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">

                            <div id="asistente-seleccionado">  
                              <?php
                              $asistente=$ofrenda->asistente
                              ?>
                              @if(isset($asistente))
                              <div id="ico-asistente" class="col-xs-3 col-md-3 col-lg-3" style="min-height: 106px; box-shadow: 0 1px 1px rgba(0,0,0,0.1); ">
                                <center><img style="margin-left:-9px;margin-top:4px" src="/img/fotos/{{$asistente->foto}}" class="img-circle" width="100px" alt="User Image"></center> 
                              </div>
                              <div id="info-asistente" class="col-xs-9 col-md-9 col-lg-9 " style="min-height: 106px;box-shadow: 0 1px 1px 0 rgba(0,0,0,0.1);">
                                <h4><b>Asistente </b></h4>
                                <p><b>Código: </b>{{$asistente->id}}<br>
                                  <b>Nombre: </b>{{$asistente->nombre}} {{$asistente->apellido}}<br>
                                  <b>Tipo de Asistente: </b>
                                  {{$asistente->tipoAsistente->nombre}}<br>
                                </p>
                              </div>
                              @endif
                            </div>   

                           <!-- Valor -->
                           <div class="form-group" >
                            <label style="margin-top:20px" >Valor</label>
                            <input type="text" id="valor" name="valor" class="form-control" placeholder="Ejemplo:2000" value="{{$ofrenda->valor}}" />
                          </div>
                          <!-- /valor -->
                          <!-- Tipo de id -->
                          <div class="form-group">
                            <label>Tipo</label>
                            <select id="tipo_ofrenda" name="tipo_ofrenda" class="form-control" value="{{$ofrenda->descripcion}}">
                              <option value="" @if($ofrenda->tipo_ofrenda=="") selected @endif></option>
                              <option value="1" @if($ofrenda->tipo_ofrenda=="1") selected @endif>Ofrenda</option>
                              <option value="0" @if($ofrenda->tipo_ofrenda=="0") selected @endif>Diezmo</option>
                              <option value="2" @if($ofrenda->tipo_ofrenda=="2") selected @endif>Pacto</option>
                              <option value="3" @if($ofrenda->tipo_ofrenda=="3") selected @endif>Pro-templo</option>
                              <option value="4" @if($ofrenda->tipo_ofrenda=="4") selected @endif>Siembra</option>
                              <option value="5" @if($ofrenda->tipo_ofrenda=="5") selected @endif>Primicia</option>
                              <option value="6" @if($ofrenda->tipo_ofrenda=="6") selected @endif>Otro</option>
                              <option value="7" @if($ofrenda->tipo_ofrenda=="7") selected @endif>Suelta</option>
                            </select>
                          </div>
                          <!-- /tipo de id -->
                        </div> 
                        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                         <!-- Fecha de reunion mm/dd/yyyy -->
                         <div class="form-group">
                          <label>Fecha</label>
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <?php $fecha=date_create($ofrenda->fecha); ?>
                            <input id="fecha" name ="fecha" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask value="{{ date_format($fecha, 'd/m/Y') }}"/>
                          </div>
                        </div>
                        <!-- /.fin Fecha de reunion -->

                        <!-- Observaciones -->
                        <div class="form-group">
                          <label>Observaciones</label>
                          <textarea id ="observacion" name="observacion" class="form-control" rows="5"  maxlength="500" placeholder="" >{{$ofrenda->observacion}}</textarea>
                        </div>
                        <!-- /Observaciones -->
                      </div>     
                    </div>
                  </div>
                </div>
                <!-- /columna de 12 -->

                <!-- columna del boton guardar -->
                <div class="col-md-12">
                  <div class=" box-header">
                    <button type="submit" class="btn btn-danger"> <i class="fa fa-save"></i> Guardar</button>
                    <a href="../informe/{{$ofrenda->id}}" class="btn bg-light-redil"> <i class="fa fa-undo"></i> Cancelar</a>
                  </div>
                </div>
                <!-- /columna del boton guardar -->


              </div>  
              <!-- /row para el formulario -->  
          </section>
          <!-- contenido principal -->
        </aside>  
        </form>



    @include('includes.scripts')

    <!-- InputMask -->
    <script src="../../js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="../../js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
    <script src="../../js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>

    <!-- bootstra datepicker-->
    <script src="../../js/bootstrap-datepicker.js"></script>
    <script src="../../js/locales/bootstrap-datepicker.es.js"></script>


  <script type="text/javascript">
    var nombre_class_asistente="asistente"
    ///este es el panel donde se cargaran los registros seleccioandos por el usuario
    var panel_asistente_seleccionado=$("#asistente-seleccionado"); 

    ///las sgtes lineas cargan los registros seleccionados
    @if(isset($ofrenda->asistente->id))
      construyeItemAsistente({{ $ofrenda->asistente->id }}, panel_asistente_seleccionado, $("#asistente_id"), nombre_class_asistente);
    @endif

    function construyeItemAsistente(id, panel, input, nombre_cl){
      ///el primer parametro es el ID el segundo el nombre de la class adicionales, el tercero cantidad de col para lg y md y el cuarto cantidad de col para sm y xs
      $.ajax({url:"/asistentes/asistente-seleccionado/"+id+"/"+nombre_cl+"/12/12",cache:false, type:"POST",success:function(resp)
        {
          panel.html(resp);///si se quiere añadir un item en lugar de reemplazar se cambia por .append 
          
          $('.cerrar-'+nombre_cl+'-seleccionado').hide();
        }
      });
    }

    $(function() {
      $("[data-mask]").inputmask();
      //Date range picker
      $('#fecha').datepicker({
          language: 'es',
          format: 'dd/mm/yyyy'
      });        
      $("#menu_ofrendas").children("a").first().trigger('click');
    });
  </script>
@endif
</body>
</html>