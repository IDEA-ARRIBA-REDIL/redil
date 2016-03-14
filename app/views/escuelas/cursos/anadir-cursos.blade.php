@if(Auth::check())
@include('includes.lenguaje')

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Redil |  Añadir Cursos </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        
        @include('includes.styles')


        <!-- Ionicons -->
        <link href="/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    
        <!-- HTML5 Shim and Repond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-black">
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
            <form role="form" action="../../cursos/new/{{ $escuela->id }}" method="post">
                <aside class="right-side">
                    <!-- contendio cabezote -->
                    <section class="content-header">
                      <div class="box-header">
                        <h3 class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-padding content-header barra-titulo">
                            <span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">Añadir Cursos</span>
                            <small class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">Aqui podrás añadir cursos a la escuela: <b> {{ $escuela->nombre }} </b></small>
                        </h3>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-padding pull-right box-tools">
                            <ul class="pull-right nav nav-pills">
                              <li role="presentation"><a href="/escuelas/actualizar/{{ $escuela->id }}"><small class="badge">1</small> Información Principal</a></li>
                              <li class="active" role="presentation"><a href="/cursos/anadir-cursos/{{ $escuela->id }}"><small class="badge">2</small> Añadir Cursos</a></li>
                            </ul>
                        </div>
                          
                          
                      </div>
                    </section>
                    <!-- /contendio cabezote -->             
                   
                    <!-- Contenido Principal -->
                     <section class="content">
                            
                            <!-- columna del boton guardar -->
                            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">  
                                    <button type="submit" class="btn btn-danger"> <i class="fa fa-save"></i> {{ Lang::get('general.btn_guardar') }}</button>
                                    <a href="../../escuelas/lista/todos" class="btn bg-light-redil"> <i class="fa fa-undo"></i> {{ Lang::get('general.btn_cancelar') }}</a>   
                                
                            </div>
                            <!-- /columna del boton guardar --> 
                    
                            <div class="row">
                                
                              <!-- Mensaje de información -->
                              <div class="mensaje col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                  <div >
                                    <?php
                                        $status=Session::get('status');
                                      ?>
                                      @if($status=='ok_new')
                                      <?php
                                        $id=Session::get('id_nuevo');
                                        $nombre=Session::get('nombre_nuevo'); 
                                      ?>
                                    <div class="alert alert-success col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom:5px; padding-top:5px; margin-bottom: -5px" >
                                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                      <b>El nuevo curso (Id: {{ $id }} , Nombre: {{ $nombre }}) fue creado correctamente</b>  
                                    </div>
                                    @endif
                                  </div>
                              </div>
                               <!-- /Mensaje de información -->

                             <div class="col-lg-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                       <h4 class="modal-title"> {{ Lang::get('escuelas.ne_mt_informacion_principal') }}</h4>     
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label> Nombre </label>
                                                <input name= "nombre" type="text" class="form-control" placeholder=" Escribe el nombre del curso " value="" required/>
                                            </div>
                                        
                                            <div class="form-group">
                                                <label> Descripción </label> 
                                                <textarea name="descripcion" class="form-control" rows="3" placeholder="Escribe una descripción acerca del curso"></textarea>
                                            </div>   

                                            <div class="form-group">
                                                <label> Objetivos </label> 
                                                <textarea name="objetivos" class="form-control" rows="10" placeholder="Escribe los objetivos del curso"></textarea>
                                            </div>                                        
                                        </div>
                                            
                                        <div class="col-lg-6">        

                                            <div class="form-group">
                                                <label> Requisitos </label> 
                                                <textarea name= "requisitos" class="form-control" rows="2" placeholder="Escribe los requisitos del curso"></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label> ¿El curso es obligatorio para graduarse? </label> 
                                                 <div class="radio">
                                                    <label>
                                                        <input type="radio" name="radio" id="radio1" value="opcion1" checked>
                                                        Si
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="radio" id="radio2" value="opcion2">
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                            <br>

                                            <!-- Panel para seleccionar el paso_crecimiento -->
                                            <div class="nav navbar-nav panel-ppl-busqueda" style="margin-bottom: 30px;">
                                                <label>Si este curso culmina un paso de crecimiento, puedes seleccionarlo </label>
                                                <li class="dropdown messages-menu">
                                                  <div class="input-group "  >
                                                    <input type="text" id="busqueda-paso-crecimiento" class="form-control busqueda-fb" autocomplete="off" placeholder="Buscar el paso de crecimiento" />
                                                    <span class="input-group-btn">
                                                        <button type='button' class="btn btn-flat" style="border-color:#CCC;background:#fff" ><i class="fa fa-search" style="color:#00545E" ></i></button>
                                                    </span>
                                                  </div>

                                                  <ul id="panel-ppl-paso-crecimiento" class="panel-busqueda-moviles dropdown-menu ">
                                                    <li>
                                                        <!-- el siguiente es el panel que se llenará con los registros de la búsqueda, se deja vacio -->
                                                      <ul class="menu" id="panel-paso-crecimiento">
                                                      </ul>
                                                    </li>
                                                  </ul>
                                                  <div class="footer">Mostrando 10 de 100</div>

                                                </li>
                                            </div>
                                            <!-- Fin de Panel para seleccionar el paso_crecimiento --> 
                                            <!-- el siguiente es el panel que se llenara con los registros que seleccione el usuario, se deja vacio -->
                                            <div id="paso-crecimiento-seleccionado">
                                            </div>
                                            
                                            <!-- Fin del panel que se llenara con los registros que seleccione el usuario, se deja vacio -->    
                                            <!-- Input para guardar el id del paso_crecimiento seleccionado -->  
                                            <input id="paso_crecimiento_id" name="paso_crecimiento_id" type="hidden" class="form-control" value="" placeholder="" />
                                        
                                        </div> <!-- div que cierra la col-lg6 del lado derecho del panel completo-->  
                                    </div><!-- div que cierra el panel body-->
                                </div> <!-- div que cierra box box primary-->
                            </div> <!-- div que cierra la col-lg12 principal-->

                            <!-- columna del boton guardar -->
                            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">  
                                    <button type="submit" class="btn btn-danger"> <i class="fa fa-save"></i> {{ Lang::get('general.btn_guardar') }}</button>
                                    <a href="../../escuelas/lista/todos" class="btn bg-light-redil"> <i class="fa fa-undo"></i> {{ Lang::get('general.btn_cancelar') }}</a>     
                            </div>
                            <!-- /columna del boton guardar --> 
                            
                            <!-- Inicio de div para listar cursos creados --> 
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:30px">
                                <!-- Añadir integrantes --> 
                                <div class="panel">
                                    <div class="panel-heading">
                                       <h4 class="modal-title"> Listado de Cursos de la Escuela: <b>{{ $escuela->nombre }}</b></h4>    
                                    </div>
                                    <div class="panel-body">
                                        
                                        @include('includes.listado-general')
                                         
                                    </div>
                                </div> 
                                <!-- fin añadir integrantes --> 
                            </div>
                            <!-- Fin de div para listar cursos creados --> 

                    </section><!-- /.content -->
                </aside>
            </form>
        </div><!-- ./wrapper -->

        <!-- /modal  para decirle al usuario que ese usuario ya esta seleccionado -->
        <div id="modal_mensaje_asistente_seleccionado" class="modal-informacion modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <h3 class="titulo"> </h3>
                </div>
                <div class="modal-body">
                      <h4 class="mensaje modal-title bg-danger"> El paso de crecimiento cod. "Codigo" "Nombre " ya ha sido seleccionado </h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-redil" data-dismiss="modal">Aceptar</button>
                </div>
            </div>
          </div>
        </div>
        <!-- /modal   -->


        @include('includes.scripts')

        <!-- busqueda tipo facebook -->
        <script src="/js/AdminLTE/busqueda-fc.js" type="text/javascript"></script>

         <!-- script para buscar los paso_crecimientoes de una escuela -->
        <script type="text/javascript">
        //la siguiente variable "bandera_alterar_resultados_busqueda" es opcional 
        //y se enciende cuando un paso_crecimiento es eliminado o añadido y al volver a abrir el panel de resulatdos de busqueda
        //necesito actualizarlo para que desaparazca o aparezca nuevamente como opcion para vovler a añadir
            var bandera_alterar_resultados_busqueda=0;
            ////la siguiente variable es pla que nos guardara el objeto de la busqueda tipo facebook
            var busqueda_paso_crecimiento;
            var nombre_class_paso_crecimiento="paso_crecimiento"
            ///este es el panel donde se cargaran los registros seleccioandos por el usuario
            var panel_paso_crecimiento_seleccionado=$("#paso-crecimiento-seleccionado"); 

            var id_paso_crecimiento_seleccionado=""; //esta variable solo es para saber cuales son los paso_crecimientos del grupo y poder mostrar el mensaje se alerta si se intenta seleccionar de nuevo

            ///esta función nos permitira determinar que evento sucedera si se le da clic 
            //a un item de los resultados de la busqueda o a cualquier objeto denrto del item, como el boton cerrar
            function seleccionar_paso_crecimiento(){
                ///la class .seleccionar-xxx viene del controlador en el metodo ajax
                //que nos hace la respectiva busqueda. Su contenido dependera de lo que se quiera hacer al selccionar el item
                $('.seleccionar-'+nombre_class_paso_crecimiento).unbind('click');///primero se eliminan todos los ateriores eventos click
                $('.seleccionar-'+nombre_class_paso_crecimiento).click(function () {
                  var id_paso_crecimiento = $(this).attr("data-id");
                  var nombre_paso_crecimiento= $(this).attr("data-nombre");
                  ///verifica si el seleccionado si esta en el mismo grupo de los otros paso_crecimientoes
                  if(id_paso_crecimiento_seleccionado==id_paso_crecimiento)
                  {
                    $('#modal_mensaje_asistente_seleccionado .titulo').html("Paso de Crecimiento previamente seleccionado")
                    $('#modal_mensaje_asistente_seleccionado .mensaje').html("El paso de crecimiento <b>"+nombre_paso_crecimiento+"</b> ya ha sido seleccionado para este curso")
                    $('#modal_mensaje_asistente_seleccionado').modal('show');
                  }
                  //si el seleccionado si es apto lo crea en la vista y lo guarda en la base de datos
                  else{

                    construyeItemPasoCrecimiento(id_paso_crecimiento, panel_paso_crecimiento_seleccionado, "", nombre_class_paso_crecimiento);
                    bandera_alterar_resultados_busqueda=1;
                    id_paso_crecimiento_seleccionado=id_paso_crecimiento;
                    construyeSqlAdicionalPasoCrecimiento();//se reconstruye el sql adicional para actualizar el panel de busqueda
                    $("#paso_crecimiento_id").val(id_paso_crecimiento);
                  }
                });
              }

              ///esta función construye el item seleccionado en el panel de resultados
              function construyeItemPasoCrecimiento(id, panel, input, nombre_cl){
                // solo añade el cargando si no existe ya uno en pantalla.
                if (!$('#item-cargando').length){
                 panel_paso_crecimiento_seleccionado.html('<div style="padding: 5px;" id="item-cargando" class="col-lg-12 col-md-12 col-lg-12 col-lg-12"><center><img class="img-responsive" src="/img/ajax-loader1.gif" /><center></div>'); 
                }
                panel_paso_crecimiento_seleccionado.find('#mensaje_no_hay').remove();
              ///el primer parametro pppes el ID el segundo el nombre de la class adicionales, el tercero cantidad de col para lg y md y el cuarto cantidad de col para sm y xs
                $.ajax({url:"/pasos-crecimiento/paso-crecimiento-seleccionado/"+id+"/"+nombre_cl+"/12/12",cache:false, type:"POST",success:function(resp)
                    {
                      mensajeNoPasosCrecimiento();/// para comprobar si se debe mostrar el mensaje de 'no hay paso_crecimientoes' u ocultar
                      $("#paso-crecimiento-seleccionado #item-cargando").remove();
                      panel_paso_crecimiento_seleccionado.html(resp); 
                      $("#ico-"+nombre_cl).css("height", $("#info-"+nombre_cl).height());

                      //////////evento eliminar paso_crecimiento seleccionado, primero elimina si se han creado eventos anteriormente
                      $('.cerrar-'+nombre_cl+'-seleccionado').unbind('click');///primero se eliminan todos los ateriores click
                      $('.cerrar-'+nombre_cl+'-seleccionado').click(function () {
                        id_eliminado= $(this).attr("data-id"); //se obtiene el id del asistente a eliminar
                        $("#item-"+nombre_cl+"-"+id_eliminado+' .cerrar-'+nombre_cl+'-seleccionado').html("<img class='img-responsive' width='30px' src='/img/ajax-loader.gif' />");
                        $("#item-"+nombre_cl+"-"+id_eliminado).remove();
                        bandera_alterar_resultados_busqueda=1;
                        id_paso_crecimiento_seleccionado="";
                        construyeSqlAdicionalPasoCrecimiento();//se reconstruye el sql adicional para actualizar el panel de busqueda
                        mensajeNoPasosCrecimiento();/// para comprobar si se debe mostrar el mensaje de 'no hay paso_crecimientoes' u ocultar
                        $("#paso_crecimiento_id").val("");
                      }); 
                    }
                  });
              }

              function construyeSqlAdicionalPasoCrecimiento()
              {
                if(id_paso_crecimiento_seleccionado=="")
                    sql_adicional="";
                else
                    sql_adicional="pasos_crecimiento.id<>"+id_paso_crecimiento_seleccionado;
                busqueda_paso_crecimiento.actualizarSqlAdicional(sql_adicional);
              }

              ///muestra mensaje informativo cuando el grupo no tiene paso_crecimientoes
              function mensajeNoPasosCrecimiento(){
                if(id_paso_crecimiento_seleccionado=="")
                {
                  grupo_paso_crecimiento="";
                  panel_paso_crecimiento_seleccionado.html("<p id='mensaje_no_hay'>El curso no contiene algún paso de crecimiento a culminar </p>");
                }
                else
                {
                  //if (!panel_paso_crecimiento_seleccionado.find('#mensaje_no_hay').length){
                    panel_paso_crecimiento_seleccionado.find('#mensaje_no_hay').remove();
                  //}
                }
              }

            $(document).ready(function() {
              var sql_adicional=""; //si no hay sql adicional dejar la variable vacia

              mensajeNoPasosCrecimiento();

              //se crea un objeto de la Clase BusquedaFB y se cargan los primeros registros
              
              busqueda_paso_crecimiento = new BusquedaFB($("#busqueda-paso-crecimiento"), $("#panel-ppl-paso-crecimiento"), "panel-paso-crecimiento", "/pasos-crecimiento/obtiene-pasos-crecimiento-para-busqueda-ajax/"+nombre_class_paso_crecimiento, seleccionar_paso_crecimiento, sql_adicional);
              busqueda_paso_crecimiento.cargarPrimerosRegistros();

              ///en caso de que el panel de resultados de la busqueda se necesite abrir con 
              ///un evento se colocan las siguientes lineas, en este caso con el evento focus del input de busqueda
              
              $("#busqueda-paso-crecimiento").focus(function() {

                  if(bandera_alterar_resultados_busqueda)
                  {
                    bandera_alterar_resultados_busqueda=0;
                    busqueda_paso_crecimiento.actualizaPanel($("html"));
                  }
                  else
                  {
                    busqueda_paso_crecimiento.muestraPanel($("html"));
                  }
              });
            });
            
        </script> 
        <!-- fin script busqueda de paso_crecimientoes -->

        <!-- page script -->
        <script type="text/javascript">
        
            $(document).ready(function() {
                $("#menu_escuelas").children("a").first().trigger('click');
            });
        </script> 

    </body>
</html>
@endif