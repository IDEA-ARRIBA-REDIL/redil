@if(Auth::check())
@include('includes.lenguaje')
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Redil | Nuevo Ingreso</title>
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
            <form action="new" method="post" role="form">
            <aside class="right-side">   

              <!-- contendio cabezote -->
              <section class="content-header">
                <div class="box-header">
                  <h3 class="content-header barra-titulo">
                        NUEVO INGRESO
                        <small> Aquí podrás realizar un nuevo ingreso financiero. </small>
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
                            El nuevo ingreso con <b>valor de {{Session::get('ofrenda')}} </b>fue creado satisfactoriamente. <a href="/ofrendas/actualizar/{{Session::get('ofrenda_id')}}">Si desea modificarlo clic aquí</a>
                          </div>
                          @endif
                          
                        </div>
                      </div>

                    <!-- columna de 12 -->
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                      <div class="panel">
                        <div class="panel-heading">
                          <h4 class="modal-title"> Información para crear un Nuevo Ingreso </h4>  
                        </div>
                        <div class="panel-body">
                          <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                            <!-- asistente --> 
                            <div class="nav navbar-nav panel-ppl-busqueda panel-ppl-busqueda" style="margin-bottom: 30px;">
                              <label> Seleccione el asistente que realizó el ingreso:</label>
                              <li class="dropdown messages-menu">
                                <div class="input-group "  >
                                  <input type="text" id="busqueda_asistente" class="form-control buscar" autocomplete="off" placeholder="Buscar asistente por código, nombre o cédula..."/>
                                  <span class="input-group-btn">
                                    <button type='button' class="btn btn-flat" style="border-color:#CCC;background:#fff" ><i class="fa fa-search" style="color:#00545E" ></i></button>
                                  </span>
                                </div> 

                                <ul id="panel-ppl-asistentes" class="panel-busqueda-moviles dropdown-menu">
                                  <li>
                                    <!-- el siguiente es el panel que se llenara con los registros de la busqueda, se deja vacio -->
                                    <ul class="menu" id="panel-asistentes">

                                    </ul>
                                  </li>
                                </ul>
                                <div class="footer">Mostrando 0 resultados de 0</div>
                              </li>
                            </div>  
                            <div id="asistente-seleccionado">  

                            </div>    

                            <input id="asistente_id" name="asistente_id" type="text" class="form-control" value="" placeholder="" title="Seleccione el asistente para poder continuar" style="position:relative; top:-34px; z-index:-1;"/> 
                          <!-- /Asistente -->          

                           <!-- Valor -->
                           <div class="form-group">
                            <label>Valor</label>
                            <input type="text" id="valor" name="valor" class="form-control number" placeholder="Ejemplo: 2000"/>
                          </div>
                          <!-- /valor -->
                          <!-- Tipo de id -->
                          <div class="form-group">
                            <label>Tipo</label>
                            <select id="tipo_ofrenda" name="tipo_ofrenda" class="form-control">
                              <option value="" selected ></option>
                              <option value="0" >Diezmo</option>
                              <option value="1" >Ofrenda</option>
                              <option value="2" >Pacto</option>
                              <option value="3" >Pro-templo</option>
                              <option value="4" >Siembra</option>
                              <option value="5" >Primicia</option>
                              <option value="6" >Otro</option>
                              <option value="7" >Suelta</option>
                            </select>
                          </div>
                          <!-- /tipo de id -->
                        </div> 
                        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                         <!-- Fecha de asistente mm/dd/yyyy -->
                         <div class="form-group">
                          <label>Fecha</label>
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input id="fecha" name ="fecha" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
                          </div>
                        </div>
                        <!-- /.fin Fecha de asistente -->

                        <!-- Observaciones -->
                        <div class="form-group">
                          <label>Observaciones</label>
                          <textarea id ="observacion" name="observacion" class="form-control" rows="5"  maxlength="500" placeholder=""></textarea>
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
                    <button type="submit" class="btn btn-danger"> <i class="fa fa-save"></i>  Guardar</button>
                    <a href="lista/todos" class="btn bg-light-redil"> <i class="fa fa-undo"></i> Cancelar</a>
                  </div>
                </div>
                <!-- /columna del boton guardar -->
              </div>
            
          </section>
          <!-- contenido principal -->
        </aside> 
        </form> 
      </div>


        


    @include('includes.scripts')

    <!-- InputMask -->
    <script src="../js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="../js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
    <script src="../js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>

    <!-- bootstra datepicker-->
    <script src="../js/bootstrap-datepicker.js"></script>
    <script src="../js/locales/bootstrap-datepicker.es.js"></script>


    <script src="/js/AdminLTE/busqueda-fc.js" type="text/javascript"></script>

 

    <!-- Script de funciones para las busquedas de asistentes (palabra principal y diezmos)-->
  <script type="text/javascript">                  

  var nombre_class_asistente="asistente"
  ///este es el panel donde se cargaran los registros seleccioandos por el usuario
  var panel_asistente_seleccionado=$("#asistente-seleccionado"); 

  function seleccionar_asistente(){
    $('.seleccionar-'+nombre_class_asistente).unbind('click');///primero se eliminan todos los ateriores eventos click
    $('.seleccionar-'+nombre_class_asistente).click(function () {
      var idasistente = $(this).attr("data-id");
      $("#asistente_id").val(idasistente);
      construyeItemAsistente(idasistente, panel_asistente_seleccionado, $("#asistente_id"), nombre_class_asistente);
    });
  } 


  function construyeItemAsistente(id, panel, input, nombre_cl){
    // solo añade el cargando si no existe ya uno en pantalla.
    if (!$('#asistente-seleccionado #item-cargando').length){
     panel_asistente_seleccionado.html('<div style="padding: 5px;" id="item-cargando" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><center><img class="img-responsive" src="/img/ajax-loader1.gif" /><center></div>'); 
    }
    ///el primer parametro es el ID el segundo el nombre de la class adicionales, el tercero cantidad de col para lg y md y el cuarto cantidad de col para sm y xs
    $.ajax({url:"/asistentes/asistente-seleccionado/"+id+"/"+nombre_cl+"/12/12",cache:false, type:"POST",success:function(resp)
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

  $(document).ready(function() {
    sql_adicional="";
    //se crea un objeto de la Clase BusquedaFB y se cargan los primeros registros
    var busqueda_asistente = new BusquedaFB($("#busqueda_asistente"), $("#panel-ppl-asistentes"), "panel-asistentes", "/asistentes/obtiene-asistentes-para-busqueda-ajax/"+nombre_class_asistente+"/todos", seleccionar_asistente, sql_adicional);
    busqueda_asistente.cargarPrimerosRegistros();


    ///las sgtes lineas cargan los registros seleccionados
    @if(isset($ofrenda->asistente->id))
    construyeItemAsistente({{ $ofrenda->asistente->id }}, panel_asistente_seleccionado, $("#asistente_id"), nombre_class_asistente);
    @endif

    ///en caso de que el panel de resultados de la busqueda se necesite abrir con 
    ///un evento se colocan las siguientes lineas, en este caso con el evento focus del input de busqueda
    $("#busqueda_asistente").focus(function() {
      busqueda_asistente.muestraPanel($("html"));
    });

  });
  </script>
  <!--Finaliza Script del document ready para la busqueda de asistentes-->

  <script type="text/javascript"> 

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