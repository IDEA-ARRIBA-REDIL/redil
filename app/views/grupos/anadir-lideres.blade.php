@if(Auth::check())
@include('includes.lenguaje')

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> {{Lang::get('grupos.lg_titulo_pestaña')}} | {{ Lang::get('grupos.ag_title') }} - {{Lang::Get('grupos.texto_simple_cod_grupo')}}{{ $grupo->id }} - {{ $grupo->nombre }}</title>
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
                            <span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">{{ Lang::get('grupos.ag_header') }} <h4>({{Lang::get('grupos.texto_simple_cod_grupo')}}{{ $grupo->id }} - {{ $grupo->nombre }})</h4></span>
                            <small class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">{{ Lang::get('grupos.ag_subtitulo') }} </small>
                        </h3>
                        <div class="pull-right box-tools">
                            <ul class="nav nav-pills">
                              <li role="presentation"><a href="/grupos/actualizar/{{ $grupo->id }}"><small class="badge">1</small>{{Lang::get('grupos.texto_pestaña_info_principal')}}</a></li>
                              <li class="active" role="presentation"><a href="/grupos/anadir-lideres/{{ $grupo->id }}"><small class="badge">2</small> {{Lang::get('grupos.texto_pestaña_anadir_lideres')}}</a></li>
                              <li role="presentation"><a href="/grupos/anadir-asistentes/{{ $grupo->id }}"><small class="badge">3</small>{{Lang::get('grupos.texto_pestaña_anadir_asistentes')}} </a></li>
                            </ul>
                        </div>
                          
                          
                      </div>
                    </section>
                    <!-- /contendio cabezote -->             
                   
                    <!-- Contenido Principal -->
                     <section class="content">
                    
                            <div class="row">
                         		
                                <!-- columna del mensaje de actualizar -->
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
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <!-- Añadir lideres --> 
                                    <div class="panel">
                                        <div class="panel-heading">
                                           <h4 class="modal-title">  {{Lang::get('grupos.texto_titulo_info_ministerial')}} </h4>    
                                        </div>
                                        <div class="panel-body" style="min-height: 255px;">
                                            <!-- lideres --> 
                                            <div class="nav navbar-nav panel-ppl-busqueda" style="margin-bottom: 30px;">
                                                <label>{{Lang::get('grupos.texto_campo_encargados_grupo')}} </label>
                                                <li class="dropdown messages-menu">
                                                  
                                                  <div class="input-group "  >
                                                    <input @if(Auth::user()->id!=1) @if(isset($grupo->encargados()->find(Auth::user()->asistente->id)->id)) disabled @endif @endif type="text" id="busqueda_lider" class="form-control busqueda-fb" autocomplete="off" placeholder=" {{Lang::get('grupos.texto_campo_placeholder_encargado')}} " />
                                                    <span class="input-group-btn">
                                                        <button type='button' class="btn btn-flat" style="border-color:#CCC;background:#fff" ><i class="fa fa-search" style="color:#00545E" ></i></button>
                                                    </span>
                                                  </div> 

                                                  <ul id="panel-ppl-lideres" class="dropdown-menu panel-busqueda-moviles">
                                                    <li>
                                                        <!-- el siguiente es el panel que se llenara con los registros de la busqueda, se deja vacio -->
                                                      <ul class="menu" id="panel-lideres">
                                                      </ul>
                                                    </li>
                                                  </ul>
                                                  <div class="footer"> {{Lang::get('grupos.texto_simple_campo_resultado_busqueda')}}</div>
                                                  
                                                </li>
                                                
                                            </div>  
                                            <!-- el siguiente es el panel que se llenara con los registrosque seleccione el usuario, se deja vacio -->
                                            <div id="lideres-seleccionados"> 
                                            @if($grupo->encargados->count()>0) 
                                              <div style="padding: 5px;" id="item-cargando" class="col-lg-12 col-md-12 col-lg-12 col-lg-12">
                                                <center><img class='img-responsive' src='/img/ajax-loader1.gif' /></center>
                                              </div>
                                            @endif 
                                            </div>  
                                             
                                        </div>
                                    </div> 
                                    <!-- fin añadir lideres --> 
                                  </div>
                                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <!-- Añadir servidores --> 
                                    <div class="panel">
                                        <div class="panel-heading">
                                           <h4 class="modal-title">{{Lang::get('grupos.texto_titulo_servidores_grupo')}}</h4>    
                                        </div>
                                        <div class="panel-body">
                                            <!-- servidor --> 
                                            <div class="nav navbar-nav panel-ppl-busqueda" style="margin-bottom: 30px;">
                                                <label> </label>
                                                <li class="dropdown messages-menu">
                                                  <div class="input-group "  >
                                                    <input type="text" id="busqueda_servidor" class="form-control busqueda-fb" autocomplete="off" placeholder="{{Lang::get('grupos.texto_campo_placeholder_servidor')}}" />
                                                    <span class="input-group-btn">
                                                        <button type='button' class="btn btn-flat" style="border-color:#CCC;background:#fff" ><i class="fa fa-search" style="color:#00545E" ></i></button>
                                                    </span>
                                                  </div> 

                                                  <ul id="panel-ppl-servidores" class="panel-busqueda-moviles dropdown-menu ">
                                                    <li>
                                                        <!-- el siguiente es el panel que se llenará con los registros de la búsqueda, se deja vacio -->
                                                      <ul class="menu" id="panel-servidores">
                                                      </ul>
                                                    </li>
                                                  </ul>
                                                  <div class="footer"> {{Lang::get('grupos.texto_simple_cantidad_de_resultados')}} </div>

                                                </li>
                                            </div>  
                                            <!-- el siguiente es el panel que se llenara con los registros que seleccione el usuario, se deja vacio -->
                                            <div id="servidores-seleccionados">  
                                              @if($grupo->servidores->count()>0) 
                                              <div style="padding: 5px;" id="item-cargando" class="col-lg-12 col-md-12 col-lg-12 col-lg-12">
                                                <center><img class='img-responsive' src='/img/ajax-loader1.gif' /></center>
                                              </div>
                                              @endif
                                            </div>    

                                        </div>
                                        <!-- fin del body--> 
                                    </div> 
                                    <!-- fin añadir servidores --> 

                                </div> 
                                <!-- Fin información Ministerial del grupo --> 

                            </div> <!-- /.fin Row -->

                            <br><br>
                           
                                               			 	 
                    </section><!-- /.content -->
                </aside>
            
        </div><!-- ./wrapper -->
                

    <!-- /modal para avisarle al usuario que el asistente no es del mismo grupo del ya seleccionado  -->
    <div id="modal_mensaje_asistente_inhabilitado" class="modal-sugerencia modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h3 class="titulo"> </h3>
            </div>
            <div class="modal-body">
                  <h4 class="mensaje"> Julanito se encuentra actualmente en el grupo TALES, ¿Esta seguro que quiere cambiarlo de grupo? </h4>
      
            </div>
            <div class="modal-footer">
                <a target="_blank" id="boton-cambiar-grupo" type="button" class="si btn bg-light-redil">Cambiarlo de Grupo</a>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
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
                  <h4 class="mensaje"> Julanito se encuentra actualmente en el grupo TALES, ¿Esta seguro que quiere cambiarlo de grupo? </h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-light-redil" data-dismiss="modal">Aceptar</button>
            </div>
        </div>
      </div>
    </div>
    <!-- /modal   -->

     <!-- /modal  para decirle al usuario que ese usuario ya esta seleccionado -->
    <div id="modal_mensaje_imposible_eliminar" class="modal-informacion modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h3 class="titulo">No es posible eliminar el asistente </h3>
            </div>
            <div class="modal-body">
                  <h4 class="mensaje"> Julanito se encuentra actualmente en el grupo TALES, ¿Esta seguro que quiere cambiarlo de grupo? </h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-light-redil" data-dismiss="modal">Aceptar</button>
            </div>
        </div>
      </div>
    </div>
            


            @include('includes.scripts')

              <!-- bootstrap multiselect -->
            <script type="text/javascript" src="/js/bootstrap-multiselect.js"></script>
            <!-- busqueda tipo facebook -->
            <script src="/js/AdminLTE/busqueda-fc.js" type="text/javascript"></script>

             <!-- script para buscar los liders de un grupo -->
            <script type="text/javascript">
            //la siguiente variable "bandera_alterar_resultados_busqueda" es opcional 
            //y se enciende cuando un lider es eliminado o añadido y al volver a abrir el panel de resulatdos de busqueda
            //necesito actualizarlo para que desaparazca o aparezca nuevamente como opcion para vovler a añadir
                var bandera_alterar_resultados_busqueda=0;
                ////la siguiente variable es pla que nos guardara el objeto de la busqueda tipo facebook
                var busqueda_lider;
                var nombre_class_lider="encargado"
                ///este es el panel donde se cargaran los registros seleccioandos por el usuario
                var panel_lideres_seleccionados=$("#lideres-seleccionados"); 

                var ids_lideres=new Array(); //esta variable solo es para saber cuales son los liders del grupo y poder mostrar el mensaje se alerta si se intenta seleccionar de nuevo

                var ids_asistentes=new Array(); //esta variable solo es para saber cuales son los asistentes del grupo y poder mostrar el mensaje se alerta si se intenta seleccionar alguno de ellos como lider

                var pastores_ppl=new Array();//un array para guardar los pastores principales y poder comprobar que estos no vayan a ser añadidos a un grupo

                var grupo_lider="";
                @if(isset($grupo->encargados()->first()->grupo->id))
                  grupo_lider={{ $grupo->encargados()->first()->grupo->id }};
                @endif
                ///esta función nos permitira determinar que evento sucedera si se le da clic 
                //a un item de los resultados de la busqueda o a cualquier objeto denrto del item, como el boton cerrar
                function seleccionar_lider(){
                    ///la class .seleccionar-xxx viene del controlador en el metodo ajax
                    //que nos hace la respectiva busqueda. Su contenido dependera de lo que se quiera hacer al selccionar el item
                    $('.seleccionar-'+nombre_class_lider).unbind('click');///primero se eliminan todos los ateriores eventos click
                    $('.seleccionar-'+nombre_class_lider).click(function () {
                      var id_grupo=$(this).attr("data-grupo-id");
                      var id_linea=$(this).attr("data-linea-id");
                      var id_asistente = $(this).attr("data-id");
                      var nombre_asistente= $(this).attr("data-nombre");
                      
                      ///verifica si el selccionado es asistente de algun grupo
                      //alert(ids_lideres.length>0);
                      if(grupo_lider=="" && ids_lideres.length>0)
                      {
                        $('#modal_mensaje_asistente_inhabilitado .titulo').html({{Lang::get('grupos.texto_mensaje_asistente_seleccionado_titulo')}})
                        $('#modal_mensaje_asistente_inhabilitado .mensaje').html({{Lang::get('grupos.texto_mensaje_asistente_inhabilitado_falta_asignar_grupo_encargado')}})
                        $('#boton-cambiar-grupo').html({{Lang::get('grupos.texto_boton_asignar_grupo')}});
                        $('#boton-cambiar-grupo').attr('href', '/asistentes/actualizar/'+ids_lideres[0]);
                        $('#modal_mensaje_asistente_inhabilitado').modal('show');
                      }
                      else if(id_linea=="")
                      {
                        $('#modal_mensaje_asistente_inhabilitado .titulo').html({{Lang::get('grupos.texto_mensaje_asistente_seleccionado_titulo')}})
                        $('#modal_mensaje_asistente_inhabilitado .mensaje').html({{Lang::get('grupos.texto_mensaje_asistente_inhabilitado_falta_asignar_linea')}})
                        $('#boton-cambiar-grupo').html({{Lang::get('grupos.texto_boton_asignar_linea')}});
                        $('#boton-cambiar-grupo').attr('href', '/asistentes/actualizar/'+id_asistente);
                        $('#modal_mensaje_asistente_inhabilitado').modal('show');
                      }
                      else if(id_grupo=="")
                      {
                        $('#modal_mensaje_asistente_inhabilitado .titulo').html({{Lang::get('grupos.texto_mensaje_asistente_seleccionado_titulo')}})
                        $('#modal_mensaje_asistente_inhabilitado .mensaje').html({{Lang::get('grupos.texto_mensaje_asistente_nuevo_encargado_sin_grupo')}})
                        $('#boton-cambiar-grupo').html({{Lang::get('grupos.texto_boton_asignar_grupo')}});
                        $('#boton-cambiar-grupo').attr('href', '/asistentes/actualizar/'+id_asistente);
                        $('#modal_mensaje_asistente_inhabilitado').modal('show');
                      }
                      //verifica si el seleccionado es un pastor principal y no lo deja avanzar
                      else if(pastores_ppl.indexOf(id_asistente)!=-1)
                      {
                        $('#modal_mensaje_asistente_seleccionado .titulo').html("No es posible añadir el asistente")
                        $('#modal_mensaje_asistente_seleccionado .mensaje').html("El asistente <b>cod. "+id_asistente+" "+nombre_asistente+"</b> es uno de los pastores principales de la iglesia. @if(Auth::user()->id==1 || isset($grupo->encargados()->find(Auth::user()->asistente->id)->id)) Si lo que desea es tener un nuevo grupo principal debe realizarlo por la configuración de la iglesia. @endif")
                        $('#modal_mensaje_asistente_seleccionado').modal('show');
                      }
                      ///verifica si el seleccionado si esta en el mismo grupo de los otros lideres
                      else if(id_grupo!=grupo_lider && grupo_lider!="")
                      {
                        $('#modal_mensaje_asistente_inhabilitado .titulo').html({{Lang::get('grupos.texto_mensaje_asistente_seleccionado_titulo')}})
                        <?php 
                        $grupo_lider_aux="";
                        if(isset($grupo->encargados()->first()->grupo->id))
                          $grupo_lider_aux= $grupo->encargados()->first()->grupo->nombre;?>
                        $('#modal_mensaje_asistente_inhabilitado .mensaje').html({{Lang::get('grupos.texto_mensaje_asistente_pertenece_a_linea_diferente', array('grupo'=> "$grupo_lider_aux"))}});
                        $('#boton-cambiar-grupo').html({{Lang::get('grupos.texto_boton_cambiar_de_grupo')}});
                        $('#boton-cambiar-grupo').attr('href', '/grupos/anadir-asistentes/'+grupo_lider);
                        $('#modal_mensaje_asistente_inhabilitado').modal('show');
                      }
                      //verifica si el seleciconado ya no habia sido seleccionado antes
                      else if(ids_lideres.indexOf(id_asistente)!=-1)
                      {
                        $('#modal_mensaje_asistente_seleccionado .titulo').html({{Lang::get('grupos.texto_mensaje_asistente_seleccionado_titulo')}})
                        $('#modal_mensaje_asistente_seleccionado .mensaje').html({{Lang::get('grupos.texto_mensaje_lider_asistente_ya_es_encargado_de_grupo')}})
                        $('#modal_mensaje_asistente_seleccionado').modal('show');
                      }
                      //verifica que el seleccionado no este ya en este grupo como asistente
                      else if(ids_asistentes.indexOf(id_asistente)!=-1)
                      {
                        $('#modal_mensaje_asistente_seleccionado .titulo').html({{Lang::get('grupos.texto_mensaje_asistente_seleccionado_titulo')}})
                        $('#modal_mensaje_asistente_seleccionado .mensaje').html({{Lang::get('grupos.texto_mensaje_asistentes_miembro_del_grupo')}})
                        $('#modal_mensaje_asistente_seleccionado').modal('show');
                      }
                      //si el seleccionado si es apto lo crea en la vista y lo guarda en la base de datos
                      else{

                        $.ajax({url:"/grupos/asignar-lider-grupo-ajax/{{ $grupo->id }}/"+id_asistente,cache:false, type:"POST",success:function(resp)
                          {
                            if(resp=="true")
                            {
                              construyeItemLider(id_asistente, panel_lideres_seleccionados, "", nombre_class_lider);
                              bandera_alterar_resultados_busqueda=1;
                              ids_lideres.push(id_asistente);
                              construyeSqlAdicionalLider();//se reconstruye el sql adicional para actualizar el panel de busqueda
                            }
                            else{
                              alert("Hubo un error al asignar el lider");
                            }
                          }
                        });
                      }
                    });
                  }

                  ///esta función construye el item seleccionado en el panel de resultados
                  function construyeItemLider(id, panel, input, nombre_cl){
                    // solo añade el cargando si no existe ya uno en pantalla.
                    if (!$('#item-cargando').length){
                     panel_lideres_seleccionados.append('<div style="padding: 5px;" id="item-cargando" class="col-lg-12 col-md-12 col-lg-12 col-lg-12"><center><img class="img-responsive" src="/img/ajax-loader1.gif" /><center></div>'); 
                    }
                    panel_lideres_seleccionados.find('#mensaje_no_hay').remove();
                  ///el primer parametro es el ID el segundo el nombre de la class adicionales, el tercero cantidad de col para lg y md y el cuarto cantidad de col para sm y xs
                    $.ajax({url:"/asistentes/asistente-seleccionado/"+id+"/"+nombre_cl+"/12/12",cache:false, type:"POST",success:function(resp)
                        {
                           mensajeNoLideres();/// para comprobar si se debe mostrar el mensaje de 'no hay lideres' u ocultar
                          $("#lideres-seleccionados #item-cargando").remove();
                          panel_lideres_seleccionados.append(resp); 
                          

                          //////////evento eliminar lider seleccionado, primero elimina si se han creado eventos anteriormente
                          $('.cerrar-'+nombre_cl+'-seleccionado').unbind('click');///primero se eliminan todos los ateriores click
                          $('.cerrar-'+nombre_cl+'-seleccionado').click(function () {
                            id_eliminado= $(this).attr("data-id"); //se obtiene el id del asistente a eliminar
                            @if(Auth::user()->id!=1)
                            if(id_eliminado!={{ Auth::user()->asistente->id }}) 
                            {
                              @endif
                              $("#item-"+nombre_cl+"-"+id_eliminado+' .cerrar-'+nombre_cl+'-seleccionado').html("<img class='img-responsive' width='30px' src='/img/ajax-loader.gif' />");
                              $.ajax({url:"/grupos/eliminar-lider-grupo-ajax/{{ $grupo->id }}/"+id_eliminado,cache:false, type:"POST",success:function(resp)
                                {
                                  if(resp=="true")
                                  {
                                    $("#item-"+nombre_cl+"-"+id_eliminado).remove();
                                    bandera_alterar_resultados_busqueda=1;
                                    pos_eliminar=ids_lideres.indexOf(id_eliminado);
                                    ids_lideres.splice(pos_eliminar,1);
                                    construyeSqlAdicionalLider();//se reconstruye el sql adicional para actualizar el panel de busqueda
                                    mensajeNoLideres();/// para comprobar si se debe mostrar el mensaje de 'no hay lideres' u ocultar
                                  }
                                  else{
                                    alert("Hubo un error al eliminar el lider");
                                  }
                                }
                              });
                            @if(Auth::user()->id!=1)
                            }
                            else{
                              $('#modal_mensaje_imposible_eliminar .titulo').html("No es posible eliminar el lider")
                              $('#modal_mensaje_imposible_eliminar .mensaje').html("No puedes eliminarte de tu propio grupo.")
                              $('#modal_mensaje_imposible_eliminar').modal('show');
                            }
                            @endif
                          }); 
                        }
                      });
                  }

                  function construyeSqlAdicionalLider()
                  {
                     $.ajax({url:"/grupos/construye-sql-lideres-aptos-ajax/{{ $grupo->id }}",cache:false, type:"POST",success:function(resp)
                      {
                        sql_adicional=resp;
                        if(grupo_lider=="" && ids_lideres.length>0){
                          sql_adicional+="AND 2=3 ";
                        }
                        busqueda_lider.actualizarSqlAdicional(sql_adicional);
                      }
                    });
                  }

                  ///muestra mensaje informativo cuando el grupo no tiene lideres
                  function mensajeNoLideres(){
                    if(ids_lideres.length==0)
                    {
                      grupo_lider="";
                      panel_lideres_seleccionados.html("{{Lang::get('grupos.texto_mensaje_no_lideres_asignados')}}");
                    }
                    else
                    {
                      //if (!panel_lideres_seleccionados.find('#mensaje_no_hay').length){
                        panel_lideres_seleccionados.find('#mensaje_no_hay').remove();
                      //}
                    }
                  }


                $(document).ready(function() {
                  var sql_adicional="(2=2 " //si no hay sql adicional dejar la variable vacia
                  
                  ///las sgtes lineas cargan los registros seleccionados que estan ya guardados en la base de datos
                  @if(isset($grupo->encargados()->first()->grupo->id))
                    sql_adicional+="AND asistentes.grupo_id="+grupo_lider;
                  @endif

                    @foreach($grupo->encargados as $encargado)
                    //se construye el item de los que ya estan guardados
                      construyeItemLider({{ $encargado->id }}, panel_lideres_seleccionados, "", nombre_class_lider);
                      sql_adicional+=" AND asistentes.id<>{{ $encargado->id }}";
                      ids_lideres.push("{{ $encargado->id }}");
                    @endforeach

                    @foreach($grupo->asistentes as $asistente)
                      sql_adicional+=" AND asistentes.id<>{{ $asistente->id }}";
                      ids_asistentes.push("{{ $asistente->id }}");
                    @endforeach

                    <?php $pastores=Iglesia::find(1)->pastoresEncargados; ?>
                    @foreach($pastores as $encargado)
                      sql_adicional+=" AND asistentes.id<>{{ $encargado->id }}";
                      pastores_ppl.push("{{ $encargado->id }}");
                    @endforeach

                    if(grupo_lider=="" && ids_lideres.length>0){
                      sql_adicional+="AND 2=3 ";
                    }

                    sql_adicional+=" AND asistentes.grupo_id IS NOT NULL  AND asistentes.linea_id IS NOT NULL)";
                  

                  mensajeNoLideres();

                  //se crea un objeto de la Clase BusquedaFB y se cargan los primeros registros
                  
                  busqueda_lider = new BusquedaFB($("#busqueda_lider"), $("#panel-ppl-lideres"), "panel-lideres", "/asistentes/obtiene-asistentes-para-busqueda-ajax/"+nombre_class_lider+"/solo_discipulos", seleccionar_lider, sql_adicional);
                  busqueda_lider.cargarPrimerosRegistros();

                  ///en caso de que el panel de resultados de la busqueda se necesite abrir con 
                  ///un evento se colocan las siguientes lineas, en este caso con el evento focus del input de busqueda
                  
                  $("#busqueda_lider").focus(function() {
                      if(bandera_alterar_resultados_busqueda)
                      {
                        bandera_alterar_resultados_busqueda=0;
                        busqueda_lider.actualizaPanel($("html"));
                      }
                      else
                      {
                        busqueda_lider.muestraPanel($("html"));
                      }
                  });
                });
                
            </script> 
            <!-- fin script busqueda de lideres -->

            <!-- ////////////////////////////////////////////// -->
            <!-- ////////////////////////////////////////////// -->
            <!-- ////////////////////////////////////////////// -->
            <!-- script para buscar los servidores de un grupo -->
            <script type="text/javascript">
            //la siguiente variable "bandera_alterar_resultados_busqueda" es opcional 
            //y se enciende cuando un servidor es eliminado o añadido y al volver a abrir el panel de resulatdos de busqueda
            //necesito actualizarlo para que desaparazca o aparezca nuevamente como opcion para vovler a añadir
                var bandera_alterar_resultados_busqueda_servidores=0;
                ////la siguiente variable es pla que nos guardara el objeto de la busqueda tipo facebook
                var busqueda_servidor;
                var nombre_class_servidor="servidor"
                ///este es el panel donde se cargaran los registros seleccioandos por el usuario
                var panel_servidores_seleccionados=$("#servidores-seleccionados"); 

                var ids_servidores=new Array(); //esta variable solo es para saber cuales son los encargados del grupo y poder mostrar el mensaje se alerta si se intenta seleccionar de nuevo

                ///esta función nos permitira determinar que evento sucedera si se le da clic 
                //a un item de los resultados de la busqueda o a cualquier objeto denrto del item, como el boton cerrar
                function seleccionar_servidor(){
                    ///la class .seleccionar-xxxx viene del controlador en el metodo ajax
                    //que nos hace la respectiva busqueda. Su contenido dependera de lo que se quiera hacer al selccionar el item
                    $('.seleccionar-'+nombre_class_servidor).unbind('click');///primero se eliminan todos los ateriores eventos click
                    $('.seleccionar-'+nombre_class_servidor).click(function () {
                      var id_grupo=$(this).attr("data-grupo-id");
                      var id_asistente = $(this).attr("data-id");
                      var nombre_asistente= $(this).attr("data-nombre");

                      //verifica si el seleciconado ya no habia sido seleccionado antes
                      if(ids_servidores.indexOf(id_asistente)!=-1)
                      {
                        $('#modal_mensaje_asistente_seleccionado .titulo').html({{Lang::get('grupos.texto_mensaje_asistente_seleccionado_titulo')}})
                        $('#modal_mensaje_asistente_seleccionado .mensaje').html({{Lang::get('grupos.texto_mensaje_asistente_ya_es_encargado')}})
                        $('#modal_mensaje_asistente_seleccionado').modal('show');
                      }
                      //si el seleccionado si es apto lo crea en la vista y lo guarda en la base de datos
                      else{

                        $.ajax({url:"/grupos/asignar-servidor-grupo-ajax/{{ $grupo->id }}/"+id_asistente,cache:false, type:"POST",success:function(resp)
                          {
                            if(resp=="true")
                            {
                              construyeItemServidor(id_asistente, panel_servidores_seleccionados, "", nombre_class_servidor);
                              bandera_alterar_resultados_busqueda_servidores=1;
                              ids_servidores.push(id_asistente);
                              construyeSqlAdicionalServidores();//se reconstruye el sql adicional para actualizar el panel de busqueda
                            }
                            else{
                              alert("{{Lang::get('grupos.texto_mensaje_error_eliminar_servidor')}}");
                            }
                          }
                        });
                      }
                    });
                  }

                  ///esta función construye el item seleccionado en el panel de resultados
                  function construyeItemServidor(id, panel, input, nombre_cl){
                    // solo añade el cargando si no existe ya uno en pantalla.
                    if (!$('#item-cargando').length){
                      panel_servidores_seleccionados.append('<div style="padding: 5px;" id="item-cargando" class="col-lg-12 col-md-12 col-lg-12 col-lg-12"><center><img class="img-responsive" src="/img/ajax-loader1.gif" /><center></div>'); 
                    }
                    panel_servidores_seleccionados.find('#mensaje_no_hay').remove();
                  ///el primer parametro es el ID el segundo el nombre de la class adicionales, el tercero cantidad de col para lg y md y el cuarto cantidad de col para sm y xs
                    $.ajax({url:"/asistentes/servidor-seleccionado/"+id+"/"+nombre_cl+"/{{$grupo->id}}/12/12",cache:false, type:"POST",success:function(resp)
                        {
                           mensajeNoServidores();/// para comprobar si se debe mostrar el mensaje de 'no hay servidores' u ocultar
                          $("#servidores-seleccionados #item-cargando").remove();
                          panel_servidores_seleccionados.append(resp); 
                          $('.multiselectServicios').multiselect();
                          eventoSeleccionaTipoServicio();
                          

                          //////////evento eliminar servidor seleccionado, primero elimina si se han creado eventos anteriormente
                          $('.cerrar-'+nombre_cl+'-seleccionado').unbind('click');///primero se eliminan todos los ateriores click
                          $('.cerrar-'+nombre_cl+'-seleccionado').click(function () {
                            id_eliminado= $(this).attr("data-id"); //se obtiene el id del asistente a eliminar
                           $("#item-"+nombre_cl+"-"+id_eliminado+' .cerrar-'+nombre_cl+'-seleccionado').html("<img class='img-responsive' width='30px' src='/img/ajax-loader.gif' />");
                            $.ajax({url:"/grupos/eliminar-servidor-grupo-ajax/{{ $grupo->id }}/"+id_eliminado,cache:false, type:"POST",success:function(resp)
                              {
                                if(resp=="true")
                                {
                                  $("#item-"+nombre_cl+"-"+id_eliminado).remove();
                                  bandera_alterar_resultados_busqueda_servidores=1;
                                  pos_eliminar=ids_servidores.indexOf(id_eliminado);
                                  ids_servidores.splice(pos_eliminar,1);
                                  construyeSqlAdicionalServidores();//se reconstruye el sql adicional para actualizar el panel de busqueda
                                  mensajeNoServidores();/// para comprobar si se debe mostrar el mensaje de 'no hay servidores' u ocultar
                                }
                                else{
                                  alert("{{Lang::get('grupos.texto_mensaje_error_eliminar_servidor')}}");
                                }
                              }
                            });
                          }); 
                        }
                      });
                  }

                  function construyeSqlAdicionalServidores()
                  {
                     $.ajax({url:"/grupos/construye-sql-servidores-aptos-ajax/{{ $grupo->id }}",cache:false, type:"POST",success:function(resp)
                      {
                        sql_adicional=resp;
                        busqueda_servidor.actualizarSqlAdicional(sql_adicional);
                      }
                    });
                  }

                  function eventoSeleccionaTipoServicio(){
                    $(".multiselectServicios").unbind("change");
                    $(".multiselectServicios").change(function(){
                      var ids_tipo_servicio="0";
                      var id_asistente;
                      var id_grupo;
                      $( this ).children("option:selected").each(function() {                        
                        ids_tipo_servicio+="-"+$(this).attr('data-tipo-servicio');
                        id_asistente=$(this).attr('data-id-asistente');
                        id_grupo="{{ $grupo->id }}";
                        /**/
                        //alert("asistente: "+$(this).attr('data-id-asistente')+" tipo servicio: "+$(this).attr('data-tipo-servicio'));
                      });  
                      $.ajax({url:"/grupos/asignar-tipo-servicio-servidor-ajax/"+id_grupo+"/"+id_asistente+"/"+ids_tipo_servicio,cache:false, type:"POST",success:function(resp)
                        {
                          if(resp=="false")
                          {
                            alert({{Lang::get('grupos.texto_mensaje_error_asignar_servicio')}})
                          }
                        }
                      }); 

                    });
                  }

                  ///muestra mensaje informativo cuando el grupo no tiene servidores
                  function mensajeNoServidores(){
                    if(ids_servidores.length==0)
                    {
                      panel_servidores_seleccionados.html("{{Lang::get('grupos.texto_servidores_seleccionados_panel')}}");
                    }
                    else
                    {
                      //if (!panel_servidores_seleccionados.find('#mensaje_no_hay').length){
                        panel_servidores_seleccionados.find('#mensaje_no_hay').remove();
                      //}
                    }
                  }


                $(document).ready(function() {
                  var sql_adicional="" //si no hay sql adicional para filtrar los asistentes dejar la variable vacia
                  
                  ///las sgtes lineas cargan los registros seleccionados que estan ya guardados en la base de datos
                  @if($grupo->servidores->count()>0)
                    sql_adicional="(1=1 ";
                    @foreach($grupo->servidores as $servidor)
                    //se construye el item de los que ya estan guardados
                      construyeItemServidor({{ $servidor->id }}, panel_servidores_seleccionados, "", nombre_class_servidor);
                      sql_adicional+=" AND asistentes.id<>{{ $servidor->id }}";
                      ids_servidores.push("{{ $servidor->id }}");
                    @endforeach
                    sql_adicional+=")";
                  @endif

                  mensajeNoServidores();

                  //se crea un objeto de la Clase BusquedaFB y se cargan los primeros registros
                  
                  busqueda_servidor = new BusquedaFB($("#busqueda_servidor"), $("#panel-ppl-servidores"), "panel-servidores", "/asistentes/obtiene-asistentes-para-busqueda-ajax/"+nombre_class_servidor+"/todos", seleccionar_servidor, sql_adicional);
                  busqueda_servidor.cargarPrimerosRegistros();

                  ///en caso de que el panel de resultados de la busqueda se necesite abrir con 
                  ///un evento se colocan las siguientes lineas, en este caso con el evento focus del input de busqueda
                  $("#busqueda_servidor").focus(function() {
                      
                      if(bandera_alterar_resultados_busqueda_servidores)
                      {
                        bandera_alterar_resultados_busqueda_servidores=0;
                        busqueda_servidor.actualizaPanel($("html"));
                      }
                      else
                      {
                        busqueda_servidor.muestraPanel($("html"));
                      }
                  });
                });
                
            </script> 
            <!-- fin script busqueda de servidores -->

            <!-- script general evento del modal de cambiar de grupo a un asistente para poder ser añadido como servidor -->
            <script type="text/javascript">
              $("#boton-cambiar-grupo").click(function(){
                $('#modal_mensaje_asistente_inhabilitado').modal('hide');
                bandera_alterar_resultados_busqueda_servidores=1;
              });

              $(document).ready(function() {
                $("#menu_grupos").children("a").first().trigger('click');
                $('.multiselectServicios').multiselect();
              });

            </script>


    </body>
</html>
@endif