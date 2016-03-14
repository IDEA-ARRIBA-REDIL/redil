@if(Auth::check())
@include('includes.lenguaje')

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> {{Lang::get('grupos.lg_titulo_pestaña')}} | {{ Lang::get('grupos.ag_title') }} - {{Lang::Get('grupos.texto_simple_cod_grupo')}} {{ $grupo->id }} - {{ $grupo->nombre }} </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        
        @include('includes.styles')

        <!-- datepicker.css -->
        <link href="/css/datepicker.css" rel="stylesheet" type="text/css" />
        <link href="/css/datepicker3.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="/css/ionicons.min.css" rel="stylesheet" type="text/css" />
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
                      <div class="box-header">
                        <h3 class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-padding content-header barra-titulo">
                            <span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">{{ Lang::get('grupos.ag_header') }} <h4>({{Lang::Get('grupos.texto_simple_cod_grupo')}} {{ $grupo->id }} - {{ $grupo->nombre }})</h4></span>
                            <small class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">{{ Lang::get('grupos.ag_subtitulo') }} </small>
                        </h3>
                        <div class="pull-right box-tools">
                            <ul class="nav nav-pills">
                              <li role="presentation"><a href="/grupos/actualizar/{{ $grupo->id }}"><small class="badge">1</small> {{Lang::get('grupos.texto_pestaña_info_principal')}}</a></li>
                              <li role="presentation"><a href="/grupos/anadir-lideres/{{ $grupo->id }}"><small class="badge">2</small> {{Lang::get('grupos.texto_pestaña_anadir_lideres')}}</a></li>
                              <li class="active" role="presentation"><a href="/grupos/anadir-asistentes/{{ $grupo->id }}"><small class="badge">3</small> {{Lang::get('grupos.texto_pestaña_anadir_asistentes')}}</a></li>
                            </ul>
                        </div>
                          
                          
                      </div>
                    </section>
                    <!-- /contendio cabezote -->             
                   
                    <!-- Contenido Principal -->
                     <section class="content">
                     
                            <div class="row">
                         		
                                <!-- columna del boton guardar -->
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"style="margin-bottom: 10px;">
                                    <div >
                                      <?php 
                                        $status=Session::get('status'); 
                                      ?>
                                      @if($status=='ok_update')
                                      <?php 
                                        $id=Session::get('id_nuevo'); 
                                        $nombre=Session::get('nombre_nuevo'); 
                                      ?>
                                      <div class="desvanecer alert alert-success col-lg-12" style="padding-bottom:5px; padding-top:5px; margin-bottom: -5px" >
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>{{ Lang::get('grupos.ag_msn_parte_1') }}</b>  
                                      </div>
                                      @endif
                                    </div>
                                </div>
                                
                                <!-- Información Ministerial del grupo --> 
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <!-- Añadir integrantes --> 
                                    <div class="panel">
                                        <div class="panel-heading">
                                           <h4 class="modal-title"> {{Lang::get('grupos.texto_titulo_info_ministerial_grupo')}} </h4>    
                                        </div>
                                        <div class="panel-body">
                                            <!-- predicador --> 
                                            <div class="nav navbar-nav panel-ppl-busqueda" style="margin-bottom: 30px;">
                                                <label>{{Lang::get('grupos.texto_campo_integrantes_grupo')}}: </label>
                                                <li class="dropdown messages-menu">
                                                  <div class="input-group "  >
                                                    <input type="text" id="busqueda_integrante" class="form-control busqueda-fb" autocomplete="off" placeholder="{{Lang::get('grupos.texto_campo_placeholder_encargado')}}" />
                                                    <span class="input-group-btn">
                                                        <button type='button' class="btn btn-flat" style="border-color:#CCC;background:#fff" ><i class="fa fa-search" style="color:#00545E" ></i></button>
                                                    </span>
                                                  </div> 

                                                  <ul id="panel-ppl-integrantes" class="dropdown-menu panel-busqueda-moviles">
                                                    <li>
                                                        <!-- el siguiente es el panel que se llenara con los registros de la busqueda, se deja vacio -->
                                                      <ul class="menu" id="panel-integrantes">
                                                      </ul>
                                                    </li>
                                                  </ul>
                                                  <div class="footer">{{Lang::get('grupos.texto_simple_mostrando_cantidad_resultados')}}</div>

                                                </li>
                                                
                                            </div>  
                                            <!-- el siguiente es el panel que se llenara con los registrosque seleccione el usuario, se deja vacio -->
                                            <div id="integrantes-seleccionados"> 
                                            @if($grupo->encargados->count()>0) 
                                              <div style="padding: 5px;" id="item-cargando" class="col-lg-12 col-md-12 col-lg-12 col-lg-12">
                                                <center><img class='img-responsive' src='/img/ajax-loader1.gif' /></center>
                                              </div>
                                            @endif 
                                            </div>  
                                             
                                        </div>
                                    </div> 
                                    <!-- fin añadir integrantes --> 
                                  </div>
                            </div> 
                            <br><br>			 	 
                    </section><!-- /.content -->
                </aside>
            
        </div><!-- ./wrapper -->
                

    <!-- /modal para avisarle al usuario que el asistente no es del mismo grupo del ya seleccionado  -->
    <div id="modal_mensaje_solicitar_asistente" class="modal-advertencia modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <form id="form_traspasar">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h3 class="titulo"> </h3>
            </div>
            <div class="modal-body">
              <h4 class="mensaje modal-title bg-danger"> Julanito se encuentra actualmente en el grupo TALES, ¿Esta seguro que quiere cambiarlo de grupo? </h4>
              <div class="form-group">
                <label> Motivo del traslado</label>
                <select id="motivo_traspaso" name="motivo_traspaso" class="form-control" required>
                    <option value="" selected >Seleccione una opción</option>
                    <option value="Error en la asignación del grupo" >Error en la asignación del grupo</option>
                    <option value="El asistente cambió de grupo" >El asistente cambió de grupo</option>
                </select>
              </div>
              <div class="form-group">
                <label>Describa la razón del traslado</label>
                <textarea id="descripcion" name="descripcion" class="form-control" rows="3"  maxlength="500"  placeholder="Explica la razón del traslado del asistente..."></textarea>
              </div>
            </div>
            <div class="modal-footer">
                <input type="submit" id="boton-solicitar-traspaso" class="si btn bg-light-redil" value="Solicitar Traslado">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /modal   -->

     <!-- /modal  para decirle al usuario que ese usuario ya esta seleccionado -->
    <div id="modal_mensaje_asistente_seleccionado" class="modal-informacion modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h3 class="titulo"> </h3>
            </div>
            <div class="modal-body">
                  <h4 class="mensaje modal-title bg-danger"> Julanito se encuentra actualmente en el grupo TALES, ¿Esta seguro que quiere cambiarlo de grupo? </h4>
              <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
              </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /modal   -->

    <!-- /modal  para decirle al usuario que ese usuario ya esta seleccionado -->
    <div id="modal_solicitud_enviada" class="modal-sugerencia modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h3 class="titulo">Solicitud Enviada</h3>
            </div>
            <div class="modal-body">
                  <h4 class="mensaje modal-title bg-danger">La solicitud se ha realizado satisfactoriamente.<br><br>Una vez sea respondida por alguno de los lideres encargados o el Super Administrador te llegará una notificación</h4>
              <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
              </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /modal   -->

    <!-- /modal para avisarle al usuario que el asistente ya esta en otro grupo  -->
    <div id="modal_trasladar_asistente" class="modal-advertencia modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h3 class="titulo">Trasladar el asistente</h3>
            </div>
            <div class="modal-body">
              <h4 class="mensaje modal-title bg-danger"> 
                
              </h4>
            </div>
            <div class="modal-footer">
                <input style="display:none;" target="_blank" id="aceptar-con-ministerio" type="button" class="si btn bg-light-redil" value="Si, trasladar con su ministerio">
                <input style="display:none;" target="_blank" id="aceptar-sin-ministerio" type="button" class="si btn bg-light-redil" value="No, trasladar solo al asistente">
                <input style="display:none;" target="_blank" id="aceptar" type="button" class="si btn bg-light-redil" value="Si, trasladarlo">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
      </div>
    </div>
    <!-- /modal   -->

    

            


            @include('includes.scripts')

            <!-- InputMask -->
            <script src="/js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"> </script>
            <script src="/js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
            <script src="/js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
               
            <!-- js data tables-->
            <script src="{{ Lang::get('general.url-datatables') }}" type="text/javascript"></script>
            <script src="/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

            <script type="text/javascript"src="/js/plugins/timepicker/bootstrap-timepicker.min.js" ></script>

            <!-- bootstra datepicker-->
            <script src="/js/bootstrap-datepicker.js"></script>
            <script src="/js/locales/bootstrap-datepicker.es.js"></script>

              <!-- bootstrap multiselect -->
            <script type="text/javascript" src="/js/bootstrap-multiselect.js"></script>
            <script src="/js/AdminLTE/busqueda-fc.js" type="text/javascript"></script>

             <!-- script para buscar los integrantes de un grupo -->
            <script type="text/javascript">
            //la siguiente variable "bandera_alterar_resultados_busqueda" es opcional 
            //y se enciende cuando un integrante es eliminado o añadido y al volver a abrir el panel de resulatdos de busqueda
            //necesito actualizarlo para que desaparazca o aparezca nuevamente como opcion para vovler a añadir
                var bandera_alterar_resultados_busqueda=0;
                ////la siguiente variable es pla que nos guardara el objeto de la busqueda tipo facebook
                var busqueda_integrante;
                var nombre_class_integrante="integrante"
                ///este es el panel donde se cargaran los registros seleccioandos por el usuario
                var panel_integrantes_seleccionados=$("#integrantes-seleccionados"); 

                var ids_integrantes=new Array(); //esta variable solo es para saber cuales son los integrantes del grupo y poder mostrar el mensaje se alerta si se intenta seleccionar de nuevo 

                var id_grupo="";
                var id_asistente = "";
                var nombre_asistente= "";
                var nombre_grupo= "";
                var cant_discipulos= "";
                var cant_grupos= "";

                //lideres indirectos y directos del lider de este grupo que se esta editando
                var lideres=new Array();
                //alert(lideres);

                //lideres del grupo actual, esto es para luego impdir que un lider se añada como ingrante del mismo grupo
                var lideres_grupo=new Array();
                
                
                var pastores_ppl=new Array();//un array para guardar los pastores principales y poder comprobar que estos no vayan a ser añadidos a un grupo
                
                ///esta función nos permitira determinar que evento sucedera si se le da clic 
                //a un item de los resultados de la busqueda o a cualquier objeto denrto del item, como el boton cerrar
                function seleccionar_integrante(){
                    ///la class .seleccionar-xxx viene del controlador en el metodo ajax
                    //que nos hace la respectiva busqueda. Su contenido dependera de lo que se quiera hacer al selccionar el item
                    $('.seleccionar-'+nombre_class_integrante).unbind('click');///primero se eliminan todos los ateriores eventos click
                    $('.seleccionar-'+nombre_class_integrante).click(function () {
                      id_grupo=$(this).attr("data-grupo-id");
                      id_asistente = $(this).attr("data-id");
                      nombre_asistente= $(this).attr("data-nombre");
                      nombre_grupo= $(this).attr("data-grupo-nombre");
                      cant_grupos= $(this).attr("data-cant-grupos-min");
                      cant_discipulos= $(this).attr("data-cant-discipulos");
                      //verifica si el seleccionado ya no habia sido seleccionado antes
                      if(ids_integrantes.indexOf(id_asistente)!=-1)
                      {
                        $('#modal_mensaje_asistente_seleccionado .titulo').html({{Lang::get('grupos.texto_mensaje_asistente_seleccionado_titulo')}})
                        $('#modal_mensaje_asistente_seleccionado .mensaje').html({{Lang::get('grupos.texto_mensaje_modal_cambio_asistente')}})
                        $('#modal_mensaje_asistente_seleccionado').modal('show');
                      }
                      //verifica si el seleccionado es un pastor principal y no lo deja avanzar
                      else if(pastores_ppl.indexOf(id_asistente)!=-1)
                      {
                        $('#modal_mensaje_asistente_seleccionado .titulo').html({{Lang::get('grupos.texto_mensaje_asistente_seleccionado_titulo')}})
                        $('#modal_mensaje_asistente_seleccionado .mensaje').html({{Lang::get('grupos.texto_mensaje_modal_cambio_asistente_es_pastor')}})
                        $('#modal_mensaje_asistente_seleccionado').modal('show');
                      }
                      //verifica si el seleccionado es un lider indirecto de este grupo
                      else if(lideres.indexOf(id_asistente)!=-1)
                      {
                        $('#modal_mensaje_asistente_seleccionado .titulo').html({{Lang::get('grupos.texto_mensaje_asistente_seleccionado_titulo')}})
                        $('#modal_mensaje_asistente_seleccionado .mensaje').html({{Lang::get('grupos.texto_mensaje_modal_cambio_asistente_es_encargado')}})
                        $('#modal_mensaje_asistente_seleccionado').modal('show');
                      }
                      //verifica si el seleccionado es un lider directo del encargado de este grupo
                      else if(lideres_grupo.indexOf(id_asistente)!=-1)
                      {
                        $('#modal_mensaje_asistente_seleccionado .titulo').html({{Lang::get('grupos.texto_mensaje_asistente_seleccionado_titulo')}})
                        $('#modal_mensaje_asistente_seleccionado .mensaje').html({{Lang::get('grupos.texto_mensaje_modal_cambio_asistente_es_encargado_directo')}})
                        $('#modal_mensaje_asistente_seleccionado').modal('show');
                      }
                      else if($(this).parent().attr("class")=="item-bloqueado")
                      {
                        $('#modal_mensaje_solicitar_asistente .titulo').html({{Lang::get('grupos.texto_mensaje_asistente_seleccionado_titulo')}})
                        $('#modal_mensaje_solicitar_asistente .mensaje').html({{Lang::get('grupos.texto_mensaje_modal_cambio_asistente_pertenece_otro_grupos')}})
                        $('#modal_mensaje_solicitar_asistente').modal('show');
                      }
                      //si el seleccionado si es apto lo crea en la vista y lo guarda en la base de datos
                      else{
                        ////////////////////////////////////////////////////////////////////////////////////////////////
                        /////////////////////////////ESTE ES EL QUE HAY QUE CAMBIAR/////////////////////////////////////
                        if(id_grupo=="" && cant_grupos=="0")
                        {
                          anadirIntegrante("sin-ministerio");
                        }
                        else if(id_grupo=="" && cant_grupos!="0")////// este filtro es para una persona que se encuentra sin una linea asignada pero que aun dirige un grupo: ejemplo yo no tengo asignado un lider de linea pero a un dirijo un grupo, resulta que ahora me quieren asignar a un nuevo grupo este aviso permite decir si mi traslado es solo o con todo mi ministerio
                        {
                          $('#modal_trasladar_asistente .titulo').html({{Lang::get('grupos.texto_modal_titulo_asistente_otro_grupo')}})
                          mensaje= {{Lang::get('grupos.texto_modal_mensaje_asistente_otro_grupo_sin_linea')}};
                          $("#aceptar-con-ministerio").show();
                          $("#aceptar-sin-ministerio").show();
                          $("#aceptar").hide();

                          $('#modal_trasladar_asistente .mensaje').html(mensaje);
                          $('#modal_trasladar_asistente').modal('show');
                        }
                        else
                        {/////esta opcion es para cuando quien se traslada tiene una celula o grupo que esta en mi mismo nivel y esta activo en alguna linea
                          $('#modal_trasladar_asistente .titulo').html({{Lang::get('grupos.texto_modal_titulo_asistente_otro_grupo')}})
                          mensaje= {{Lang::get('grupos.texto_modal_mensaje_asistente_otro_grupo_con_linea_')}};
                          if(cant_grupos>0)
                          {
                            mensaje+={{LAng::get('grupos.texto_modal_mensaje_asistente_otro_grupo_con_linea_con_grupo')}};
                            $("#aceptar-con-ministerio").show();
                            $("#aceptar-sin-ministerio").show();
                            $("#aceptar").hide();
                          }
                          else{
                            $("#aceptar-con-ministerio").hide();
                            $("#aceptar-sin-ministerio").hide();
                            $("#aceptar").show();
                            mensaje+={{Lang::get('grupos.texto_modal_mensaje_asistente_otro_grupo_con_linea_sin_grupo')}};
                          }
                          

                          $('#modal_trasladar_asistente .mensaje').html(mensaje);
                          $('#modal_trasladar_asistente').modal('show');                         
                        }
                        
                      }
                    });
                  }

                  function anadirIntegrante(ministerio){
                    $.ajax({url:"/grupos/asignar-integrante-grupo-ajax/{{ $grupo->id }}/"+id_asistente+"/"+ministerio,cache:false, type:"POST",success:function(resp)
                      {
                        $('#modal_trasladar_asistente').modal("hide");
                        if(resp=="true")
                        {
                          construyeItemIntegrante(id_asistente, panel_integrantes_seleccionados, "", nombre_class_integrante);
                          bandera_alterar_resultados_busqueda=1;
                          ids_integrantes.push(id_asistente);
                          construyeSqlAdicionalintegrante();//se reconstruye el sql adicional para actualizar el panel de busqueda
                        }
                        else{
                          alert({{Lang::get('grupos.texto_alert_error_traslado_asistente')}});
                        }
                      }
                    });
                  }

                  ///esta función construye el item seleccionado en el panel de resultados
                  function construyeItemIntegrante(id, panel, input, nombre_cl){
                    // solo añade el cargando si no existe ya uno en pantalla.
                    if (!$('#item-cargando').length){
                     panel_integrantes_seleccionados.append('<div style="padding: 5px;" id="item-cargando" class="col-lg-4 col-md-6 col-lg-12 col-lg-12"><center><img class="img-responsive" src="/img/ajax-loader1.gif" /><center></div>'); 
                    }
                    panel_integrantes_seleccionados.find('#mensaje_no_hay').remove();
                  ///el primer parametro es el ID el segundo el nombre de la class adicionales, el tercero cantidad de col para lg y md y el cuarto cantidad de col para sm y xs
                    $.ajax({url:"/asistentes/asistente-seleccionado/"+id+"/"+nombre_cl+"/4/6/6",cache:false, type:"POST",success:function(resp)
                        {
                           mensajeNointegrantes();/// para comprobar si se debe mostrar el mensaje de 'no hay integrantes' u ocultar
                          $("#integrantes-seleccionados #item-cargando").remove();
                          panel_integrantes_seleccionados.append(resp); 
                          $("#ico-"+nombre_cl).css("height", $("#info-"+nombre_cl).height());

                          //////////evento eliminar integrante seleccionado, primero elimina si se han creado eventos anteriormente
                          $('.cerrar-'+nombre_cl+'-seleccionado').unbind('click');///primero se eliminan todos los ateriores click
                          $('.cerrar-'+nombre_cl+'-seleccionado').click(function () {
                            id_eliminado= $(this).attr("data-id"); //se obtiene el id del asistente a eliminar
                            $("#item-"+nombre_cl+"-"+id_eliminado+' .cerrar-'+nombre_cl+'-seleccionado').html("<img class='img-responsive' width='30px' src='/img/ajax-loader.gif' />");
                            $.ajax({url:"/grupos/eliminar-integrante-grupo-ajax/{{ $grupo->id }}/"+id_eliminado,cache:false, type:"POST",success:function(resp)
                              {
                                if(resp=="true")
                                {
                                  $("#item-"+nombre_cl+"-"+id_eliminado).remove();
                                  bandera_alterar_resultados_busqueda=1;
                                  pos_eliminar=ids_integrantes.indexOf(id_eliminado);
                                  ids_integrantes.splice(pos_eliminar,1);
                                  construyeSqlAdicionalintegrante();//se reconstruye el sql adicional para actualizar el panel de busqueda
                                  mensajeNointegrantes();/// para comprobar si se debe mostrar el mensaje de 'no hay integrantes' u ocultar
                                }
                                else{
                                  alert({{Lang::get('grupos.texto_alert_error_eliminar_asistente')}});
                                }
                              }
                            });
                          }); 
                        }
                      });
                  }

                  function construyeSqlAdicionalintegrante()
                  {
                     $.ajax({url:"/grupos/construye-sql-integrantes-aptos-ajax/{{ $grupo->id }}",cache:false, type:"POST",success:function(resp)
                      {
                        sql_adicional=resp;
                        busqueda_integrante.actualizarSqlAdicional(sql_adicional);
                      }
                    });
                  }

                  ///muestra mensaje informativo cuando el grupo no tiene integrantes
                  function mensajeNointegrantes(){
                    if(ids_integrantes.length==0)
                    {
                      panel_integrantes_seleccionados.html("{{Lang::get('grupos.texto_mensaje_no_hay_integrantes_grupo')}}");
                    }
                    else
                    {
                      //if (!panel_integrantes_seleccionados.find('#mensaje_no_hay').length){
                        panel_integrantes_seleccionados.find('#mensaje_no_hay').remove();
                      //}
                    }
                  }


                $(document).ready(function() {
                  var sql_adicional="" //si no hay sql adicional dejar la variable vacia
                  
                  ///las sgtes lineas cargan los registros seleccionados que estan ya guardados en la base de datos
                    sql_adicional="(1=1 ";
                    @foreach($grupo->asistentes as $asistente)
                    //se construye el item de los que ya estan guardados
                      construyeItemIntegrante({{ $asistente->id }}, panel_integrantes_seleccionados, "", nombre_class_integrante);
                      sql_adicional+=" AND asistentes.id<>{{ $asistente->id }}";
                      ids_integrantes.push("{{ $asistente->id }}");
                    @endforeach
                    //se verifican los lideres del grupo para inactivarlos en el listado
                    @if(isset($grupo->encargados->first()->id))
                      @foreach($grupo->encargados->first()->lideres()->get() as $encargado)
                        sql_adicional+=" AND asistentes.id<>{{ $encargado->id }}";
                        lideres.push("{{ $encargado->id }}");
                      @endforeach
                    @endif
                    @foreach($grupo->encargados as $encargado)
                      sql_adicional+=" AND asistentes.id<>{{ $encargado->id }}";
                      lideres_grupo.push("{{ $encargado->id }}");
                    @endforeach
                    <?php $pastores=Iglesia::find(1)->pastoresEncargados; ?>
                    @foreach($pastores as $encargado)
                      sql_adicional+=" AND asistentes.id<>{{ $encargado->id }}";
                      pastores_ppl.push("{{ $encargado->id }}");
                    @endforeach
                    sql_adicional+=") OR asistentes.grupo_id IS NULL";

                  //alert(sql_adicional);

                  mensajeNointegrantes();

                  //se crea un objeto de la Clase BusquedaFB y se cargan los primeros registros
                  
                  busqueda_integrante = new BusquedaFB($("#busqueda_integrante"), $("#panel-ppl-integrantes"), "panel-integrantes", "/asistentes/obtiene-asistentes-para-busqueda-ajax/"+nombre_class_integrante+"/todos", seleccionar_integrante, sql_adicional, "todos");
                  busqueda_integrante.cargarPrimerosRegistros();

                  ///en caso de que el panel de resultados de la busqueda se necesite abrir con 
                  ///un evento se colocan las siguientes lineas, en este caso con el evento focus del input de busqueda
                  
                  $("#busqueda_integrante").focus(function() {
                      if(bandera_alterar_resultados_busqueda)
                      {
                        bandera_alterar_resultados_busqueda=0;
                        busqueda_integrante.actualizaPanel($("html"));
                      }
                      else
                      {
                        busqueda_integrante.muestraPanel($("html"));
                      }
                  });
                });
                
            </script> 
            <!-- fin script busqueda de integrantes -->

           

            <!-- script general evento del modal de cambiar de grupo a un asistente para poder ser añadido como servidor -->
            <script type="text/javascript">
              $("#boton-solicitar-traspaso").click(function(){
                if($("#motivo_traspaso").val()!=""){
                  var motivo=$("#motivo_traspaso").val();
                  var descripcion=$("#descripcion").val();
                  $("#form_traspasar").submit(function(){
                     event.preventDefault();
                  });
                  $('#modal_mensaje_solicitar_asistente').modal("hide");
                  $.ajax({url:"/solicitudes-traspaso/crear-solicitud-ajax/"+id_asistente+"/{{ $grupo->id }}/"+id_grupo,data:{ motivo: motivo, descripcion: descripcion },cache:false, type:"POST",success: function(resp){
                    $("#modal_solicitud_enviada").modal("show");
                  }});
                }
                else{
                  $("#form_traspasar").submit(function(){
                     event.preventDefault();
                  });
                }
              });

              $("#aceptar-con-ministerio").click(function(){
                anadirIntegrante("con-ministerio");
              });

              $("#aceptar-sin-ministerio").click(function(){
                anadirIntegrante("sin-ministerio");
              });

              $("#aceptar").click(function(){
                anadirIntegrante("sin-ministerio");
              });

              $('#modal_mensaje_solicitar_asistente').on('hidden.bs.modal', function () {
                  $("#motivo_traspaso").val("");
                  $("#descripcion").html("");
              });

              $(document).ready(function() {
                $("#menu_grupos").children("a").first().trigger('click');
                $('.multiselectServicios').multiselect();
              });

            </script>

    </body>
</html>
@endif