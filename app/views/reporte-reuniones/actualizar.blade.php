@if(Auth::check())
@include('includes.lenguaje')
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title> REDIL | Actualizar Reporte</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  @include('includes.styles')
  <link href="/css/ionicons.min.css" rel="stylesheet" type="text/css" />
  <!-- DATA TABLES -->
  <link href="/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
  <link href="/css/datepicker.css" rel="stylesheet" type="text/css" />
  <link href="/css/datepicker3.css" rel="stylesheet" type="text/css" />
  <!-- DATA TABLES -->
  <link href="/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
  <!-- Bootstrap time Picker -->
  <link href="/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>


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
      </aside>

      <form role="form"  action="../update/{{ $reporte->id }}" method="post" >
        <!-- Right side column. Contains the navbar and content of the page -->
        <aside class="right-side"> 

          <!-- contendio cabezote -->
          <section class="content-header">
            <div class="box-header">
              <h3 class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-padding content-header barra-titulo">
                  <span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">ACTUALIZAR REPORTE DE REUNIÓN </span>
                  <small class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">Aqui se podrán actualizar los reportes de reuniones.</small>
              </h3>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-padding pull-right box-tools">
                  <ul class="pull-right nav nav-pills">
                    <li role="presentation" class="active"><a href="/reporte-reuniones/actualizar/{{ $reporte->id }}"><small class="badge">1</small> Información Principal</a></li>
                    <li role="presentation"><a href="/reporte-reuniones/anadir-asistentes/{{ $reporte->id }}"><small class="badge">2</small> Añadir Asistentes</a></li>
                    <li role="presentation"><a href="/reporte-reuniones/anadir-ingresos/{{ $reporte->id }}"><small class="badge">3</small> Añadir Ingresos</a></li>
                  </ul>
              </div>
                
                
            </div>
          </section>
          <!-- /contendio cabezote --> 


            <!-- contenido principal -->
            <section class="content">

              <!-- columna del boton guardar -->
              <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">  
                <button type="submit" class="btn btn-danger"> <i class="fa fa-save"></i> Guardar </button>
                <a href="/reporte-reuniones/index" class="btn bg-light-redil"> <i class="fa fa-undo"></i> Cancelar</a>
              </div>
              <!-- /columna del boton guardar --> 

                <!-- abre row de contenido de asistentes-->
              <div id="contenido-informacion" name="contenido-informacion" class="row" style="margin-left:1px;margin-right:1px;">
                  
                <!-- columna del boton guardar -->
                <div class="mensaje col-lg-12 col-md-12 col-sm-12 col-xs-12">

                  <?php $status=Session::get('status'); ?>
                  @if($status=='ok_save')
                  <div class="alert alert-success col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom:7px; padding-top:5px;margin-bottom: -7px" >
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    El Reporte "{{Session::get('codigo_reunion')}}" fue creado correctamente. Ahora podrás añadir asistentes e ingresos
                  </div>
                  @elseif($status=='ok_update')
                  <div class="alert alert-success col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom:7px; padding-top:5px;margin-bottom: -7px" >
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    El Reporte de "{{Session::get('nombre_reunion')}}" fue actualizado satisfactoriamente. 
                  </div>
                  @endif
                </div>


                  <!-- columna Seleccionar grupo -->
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="panel">
                      <div class="panel-heading">
                       <h4 class="modal-title"> Información Principal</h4>     
                      </div>
                      <div class="panel-body">
                        <div class="col-md-6 col-md-6 col-sm-6 col-xs-12">


                          <!-- Reunion-->
                          <div class="nav navbar-nav panel-ppl-busqueda" style="margin-bottom: 30px;">
                            <label> Seleccione la reunión que desea reportar:</label>
                            <li class="dropdown messages-menu">
                              <div class="input-group "  >

                                <input type="text" id="busqueda_reunion" class="form-control busqueda-fb" autocomplete="off" placeholder="Buscar reunión por código, nombre o día..." />
                                <span class="input-group-btn">
                                  <button type='button' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                                </span>
                              </div> 

                              <ul id="panel-ppl-reuniones" class="panel-busqueda-moviles dropdown-menu ">
                                <li>
                                  <!-- inner menu: contains the actual data -->
                                  <ul class="menu" id="panel-reuniones">
                                  </ul>
                                </li>
                              </ul>
                              <div class="footer">Mostrando 0 resultados de 0</div>
                            </li>
                          </div>  

                          <div id="reunion-seleccionada">  
                            
                          </div>   

                          <input id="reunion_id" name="reunion_id" type="text" class="form-control" value="{{ $reunion_seleccionada->id }}" placeholder="" title="Seleccione la reunión para poder continuar" required style="position:relative; top:-34px; z-index:-1;"/>

                          <!-- Fecha de reunion mm/dd/yyyy -->
                          <div class="form-group">
                            <label>Fecha</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <?php $fecha=date_create($reporte->fecha); ?>
                              <input id="fecha" name ="fecha" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask value="{{ date_format($fecha, 'd/m/Y') }}"/>
                            </div>
                          </div>
                          <!-- /.fin Fecha de reunion -->

                          <!-- Observaciones -->
                          <div class="form-group">
                            <label>Observaciones</label>
                            <textarea id ="observaciones" name="observaciones" class="form-control" rows="7"  maxlength="500" placeholder="" >{{$reporte->observaciones}}</textarea>
                          </div>
                          <!-- /Observaciones -->
                        </div>
                        <div class="col-md-6 col-md-6 col-sm-6 col-xs-12">

                          <h4 class="box-title">Predicadores Locales</h4>
                          <br>


                          <!-- predicador --> 
                          <div class="nav navbar-nav panel-ppl-busqueda panel-ppl-busqueda" style="margin-bottom: 30px;">
                            <label> Seleccione el predicador de la reunión:</label>
                            <li class="dropdown messages-menu">
                              <div class="input-group "  >
                                <input type="text" id="busqueda_predicador" class="form-control buscar" autocomplete="off" placeholder="Buscar predicador por código, nombre o cédula..."/>
                                <span class="input-group-btn">
                                  <button type='button' class="btn btn-flat" style="border-color:#CCC;background:#fff" ><i class="fa fa-search" style="color:#00545E" ></i></button>
                                </span>
                              </div> 

                              <ul id="panel-ppl-predicadores" class="panel-busqueda-moviles dropdown-menu">
                                <li>
                                  <!-- el siguiente es el panel que se llenara con los registros de la busqueda, se deja vacio -->
                                  <ul class="menu" id="panel-predicadores">

                                  </ul>
                                </li>
                              </ul>
                              <div class="footer">Mostrando 0 resultados de 0</div>
                            </li>
                          </div>  
                          <div id="predicador-seleccionado">  

                          </div>    


                          <input id="predicador_id" name="predicador_id" type="text" class="form-control" value="{{$reporte->asistentePredicador['id']}}" placeholder="" title="Seleccione el predicador para poder continuar" style="position:relative; top:-34px; z-index:-1;"/>

                          <!-- /predicador -->          

                          <!-- predicador diezmos--> 
                          <div class="nav navbar-nav panel-ppl-busqueda" style="margin-bottom: 30px;">
                            <label> Seleccione el predicador de diezmos y ofrendas:</label>
                            <li class="dropdown messages-menu">
                              <div class="input-group "  >
                                <input type="text" id="busqueda_predicadordiezmos" class="form-control buscar" autocomplete="off" placeholder="Buscar predicador por código, nombre o cédula..." />
                                <span class="input-group-btn">
                                  <button type='button' class="btn btn-flat" style="border-color:#CCC;background:#fff" ><i class="fa fa-search" style="color:#00545E" ></i></button>
                                </span>
                              </div> 

                              <ul id="panel-ppl-predicadoresdiezmos" class="panel-busqueda-moviles dropdown-menu ">
                                <li>
                                  <!-- el siguiente es el panel que se llenara con los registros de la busqueda, se deja vacio -->
                                  <ul class="menu" id="panel-predicadoresdiezmos">

                                  </ul>
                                </li>
                              </ul>
                              <div class="footer">Mostrando 0 resultados de 0</div>
                            </li>
                          </div>  
                          <div id="predicadordiezmos-seleccionado">  


                          </div>   


                          <input id="predicadordiezmos_id" name="predicadordiezmos_id" type="text" class="form-control" value="{{$reporte->asistentePredicadorDiezmos['id']}}" placeholder="" title="Seleccione el predicador de diezmos para poder continuar" style="position:relative; top:-34px; z-index:-1;"/>

                          <!-- /predicador diezmos-->  
                          <h4 class="box-title">Predicadores Invitados</h4>
                          <br>

                          <!-- Predicador invitado-->
                          <div class="form-group">
                            <label>Predicador invitado</label>
                            <input type="text" id="invitado" name="invitado" class="form-control" placeholder="" value="{{$reporte->predicador_invitado}}" />
                          </div>
                          <!-- /Predicador invitado -->

                          <!-- Predicador invitado de diezmos y ofendas -->
                          <div class="form-group">
                           <label>Predicador invitado de diezmos y ofrendas </label>
                           <input type="text" id="invitado_diezmos" name="invitado_diezmos" class="form-control" placeholder="" value="{{$reporte->predicador_diezmos_invitado}}" />
                         </div>
                         <!-- /Predicador invitado de diezmos y ofendas  -->

                       </div>
                     </div>
                   </div>
                 </div>
                 <!-- /columna  Seleccionar grupo -->

                 <!-- columna del boton reportar -->
                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class=" box-header">
                   <button type="submit" class="btn btn-danger"> <i class="fa fa-save"></i> Guardar </button>
                   <a href="/reporte-reuniones/index" class="btn bg-light-redil"> <i class="fa fa-undo"></i> Cancelar</a>
                 </div>
               </div>
               <!-- /columna del boton reportar -->

                </div>  
             <!-- /row de contenido de asistentes-->  

           
          </section>
         <!-- contenido principal -->
        </aside>  
      </form>
    </div>

   @include('includes.scripts') 

   <script src="/js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
   <script src="/js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
   <script src="/js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>

   <!-- bootstra datepicker-->
   <script src="/js/bootstrap-datepicker.js"></script>
   <script src="/js/locales/bootstrap-datepicker.es.js"></script>

   <script src="/js/AdminLTE/busqueda-fc.js" type="text/javascript"></script>


   <!-- script para buscar los reuniones de un grupo -->
    <script type="text/javascript">
    //la siguiente variable "bandera_alterar_resultados_busqueda" es opcional 
    //y se enciende cuando un reunion es eliminado o añadido y al volver a abrir el panel de resulatdos de busqueda
    //necesito actualizarlo para que desaparazca o aparezca nuevamente como opcion para vovler a añadir
        var bandera_alterar_resultados_busqueda=0;
        ////la siguiente variable es pla que nos guardara el objeto de la busqueda tipo facebook
        var busqueda_reunion;
        var nombre_class_reunion="reunion"
        ///este es el panel donde se cargaran los registros seleccioandos por el usuario
        var panel_reuniones_seleccionados=$("#reunion-seleccionada"); 

        var pastores_ppl=new Array();//un array para guardar los pastores principales y poder comprobar que estos no vayan a ser añadidos a un grupo

        ///esta función nos permitira determinar que evento sucedera si se le da clic 
        //a un item de los resultados de la busqueda o a cualquier objeto denrto del item, como el boton cerrar
        function seleccionar_reunion(){
          ///la class .seleccionar-xxx viene del controlador en el metodo ajax
          //que nos hace la respectiva busqueda. Su contenido dependera de lo que se quiera hacer al selccionar el item
          $('.seleccionar-'+nombre_class_reunion).unbind('click');///primero se eliminan todos los ateriores eventos click
          $('.seleccionar-'+nombre_class_reunion).click(function () {
            var id_reunion = $(this).attr("data-id");
            $("#reunion_id").val(id_reunion+"");
            construyeItemReunion(id_reunion, panel_reuniones_seleccionados, "", nombre_class_reunion);
          });
        }

          ///esta función construye el item seleccionado en el panel de resultados
          function construyeItemReunion(id, panel, input, nombre_cl){
            // solo añade el cargando si no existe ya uno en pantalla.
            if (!$('#item-cargando').length){
             panel_reuniones_seleccionados.html('<div style="padding: 5px;" id="item-cargando" class="col-lg-12 col-md-12 col-xs-12 col-sm-12"><center><img class="img-responsive" src="/img/ajax-loader1.gif" /><center></div>'); 
            }
          ///el primer parametro es el ID el segundo el nombre de la class adicionales, el tercero cantidad de col para lg y md y el cuarto cantidad de col para sm y xs
            $.ajax({url:"/reuniones/reunion-seleccionada/"+id,cache:false, type:"POST",success:function(resp)
                {
                  
                  $("#reunion-seleccionada #item-cargando").remove();
                  panel_reuniones_seleccionados.html(resp); 
                  $("#ico-"+nombre_cl).css("height", $("#info-"+nombre_cl).height());

                }
              });
          }


        $(document).ready(function() {
          var sql_adicional="" //si no hay sql adicional dejar la variable vacia
          
          ///las sgtes lineas cargan los registros seleccionados que estan ya guardados en la base de datos
          
          construyeItemReunion({{ $reporte->reunion->id }}, panel_reuniones_seleccionados, "", nombre_class_reunion);

          //se crea un objeto de la Clase BusquedaFB y se cargan los primeros registros
          
          busqueda_reunion = new BusquedaFB($("#busqueda_reunion"), $("#panel-ppl-reuniones"), "panel-reuniones", "/reuniones/obtiene-reuniones-para-busqueda-ajax", seleccionar_reunion, sql_adicional);
          busqueda_reunion.cargarPrimerosRegistros();

          ///en caso de que el panel de resultados de la busqueda se necesite abrir con 
          ///un evento se colocan las siguientes lineas, en este caso con el evento focus del input de busqueda
          
          $("#busqueda_reunion").focus(function() {
              if(bandera_alterar_resultados_busqueda)
              {
                bandera_alterar_resultados_busqueda=0;
                busqueda_reunion.actualizaPanel($("html"));
              }
              else
              {
                busqueda_reunion.muestraPanel($("html"));
              }
          });
        });
        
    </script> 
    <!-- fin script busqueda de reuniones -->


<!-- Script de funciones para las busquedas de predicadores (palabra principal y diezmos)-->
<script type="text/javascript">                  

var nombre_class_predicador="predicador"
///este es el panel donde se cargaran los registros seleccioandos por el usuario
var panel_predicador_seleccionado=$("#predicador-seleccionado"); 

function seleccionar_predicador(){
  $('.seleccionar-'+nombre_class_predicador).unbind('click');///primero se eliminan todos los ateriores eventos click
  $('.seleccionar-'+nombre_class_predicador).click(function () {
    var idpredicador = $(this).attr("data-id");
    $("#predicador_id").val(idpredicador);
    construyeItemPredicador(idpredicador, panel_predicador_seleccionado, $("#predicador_id"), nombre_class_predicador);
  });
} 


function construyeItemPredicador(id, panel, input, nombre_cl){
  // solo añade el cargando si no existe ya uno en pantalla.
  if (!$('#predicador-seleccionado #item-cargando').length){
   panel_predicador_seleccionado.html('<div style="padding: 5px;" id="item-cargando" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><center><img class="img-responsive" src="/img/ajax-loader1.gif" /><center></div>'); 
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
  var busqueda_predicador = new BusquedaFB($("#busqueda_predicador"), $("#panel-ppl-predicadores"), "panel-predicadores", "/asistentes/obtiene-asistentes-para-busqueda-ajax/"+nombre_class_predicador+"/todos", seleccionar_predicador, sql_adicional);
  busqueda_predicador.cargarPrimerosRegistros();


  ///las sgtes lineas cargan los registros seleccionados
  @if(isset($reporte->asistentePredicador->id))
  construyeItemPredicador({{ $reporte->asistentePredicador->id }}, panel_predicador_seleccionado, $("#predicador_id"), nombre_class_predicador);
  @endif

  ///en caso de que el panel de resultados de la busqueda se necesite abrir con 
  ///un evento se colocan las siguientes lineas, en este caso con el evento focus del input de busqueda
  $("#busqueda_predicador").focus(function() {
    busqueda_predicador.muestraPanel($("html"));
  });

});
</script>
<!--Finaliza Script del document ready para la busqueda de predicadores-->

<!-- Script de funciones para las busquedas de predicadores ( diezmos)-->
<script type="text/javascript">                  

var nombre_class_diezmos="predicador_diezmos"
///este es el panel donde se cargaran los registros seleccioandos por el usuario
var panel_predicador_diezmos_seleccionado=$("#predicadordiezmos-seleccionado"); 


function seleccionar_predicador_diezmos(){
  $('.seleccionar-'+nombre_class_diezmos).unbind('click');///primero se eliminan todos los ateriores eventos click
  $('.seleccionar-'+nombre_class_diezmos).click(function () {
    var idpredicador = $(this).attr("data-id");
    $("#predicadordiezmos_id").val(idpredicador);
    construyeItemPredicadorDiezmos(idpredicador, panel_predicador_diezmos_seleccionado, $("#predicadordiezmos_id"), nombre_class_diezmos);
  });
}

function construyeItemPredicadorDiezmos(id, panel, input, nombre_cl){
  // solo añade el cargando si no existe ya uno en pantalla.
  if (!$('#predicadordiezmos-seleccionado #item-cargando').length){
   panel_predicador_diezmos_seleccionado.html('<div style="padding: 5px;" id="item-cargando" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><center><img class="img-responsive" src="/img/ajax-loader1.gif" /><center></div>'); 
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
  var busqueda_predicador_diezmos = new BusquedaFB($("#busqueda_predicadordiezmos"), $("#panel-ppl-predicadoresdiezmos"), "panel-predicadoresdiezmos", "/asistentes/obtiene-asistentes-para-busqueda-ajax/"+nombre_class_diezmos+"/todos", seleccionar_predicador_diezmos, sql_adicional);
  busqueda_predicador_diezmos.cargarPrimerosRegistros();

  @if(isset($reporte->asistentePredicadorDiezmos->id))
  construyeItemPredicadorDiezmos({{ $reporte->asistentePredicadorDiezmos->id }}, panel_predicador_diezmos_seleccionado, $("#predicadordiezmos_id"), nombre_class_diezmos);
  @endif

  ///en caso de que el panel de resultados de la busqueda se necesite abrir con 
  ///un evento se colocan las siguientes lineas, en este caso con el evento focus del input de busqueda

  $("#busqueda_predicadordiezmos").focus(function() {
    busqueda_predicador_diezmos.muestraPanel($("html"));
  });
});
</script>
<!--Finaliza Script del document ready para la busqueda de predicadores-->


<!-- Script de del document ready para el calendario-->
<script type="text/javascript">

$(document).ready(function() {

    $("#menu_reuniones").children("a").first().trigger('click');
      //Date range picker
      $('#fecha').datepicker({
        language: 'es',
        format: 'dd/mm/yyyy'
      });

      //para las mascaras en los input
                $("[data-mask]").inputmask();
    });

</script>

</body>
</html>
@endif