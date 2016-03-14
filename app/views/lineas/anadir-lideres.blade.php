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

                        <div class="row">

                           <!-- /columna del boton guardar -->
                          <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                       	   	<div class="panel">
                              <div class="panel-heading"> <!-- aqui arranca en panel heading del formulario -->
                              	<h4 class="modal-title"> {{ Lang::get('lineas.al_mt_titulo') }}</h4>     
                              </div><!-- aqui termina en panel heading del formulario -->

                              <div class="panel-body"> <!-- aqui arranca en panel body del formulario -->
                                <!-- lideres --> 
                                <div class="nav navbar-nav panel-ppl-busqueda" style="margin-bottom: 30px;">
                                    <label>Seleccione los encargados del grupo: </label>
                                    <li class="dropdown messages-menu">
                                      
                                      <div class="input-group "  >
                                        <input @if(Auth::user()->id!=1) @if(isset($linea->encargados()->find(Auth::user()->asistente->id)->id)) disabled @endif @endif type="text" id="busqueda_lider" class="form-control busqueda-fb" autocomplete="off" placeholder="Buscar asistente por código, nombre o cédula..." />
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
                                      <div class="footer">Mostrando 0 resultados de 0</div>
                                      
                                    </li>
                                    
                                </div>  
                                <!-- el siguiente es el panel que se llenara con los registrosque seleccione el usuario, se deja vacio -->
                                <div id="lideres-seleccionados"> 
                                @if($linea->encargados->count()>0) 
                                  <div style="padding: 5px;" id="item-cargando" class="col-lg-4 col-md-4 col-lg-12 col-lg-12">
                                    <center><img class='img-responsive' src='/img/ajax-loader1.gif' /></center>
                                  </div>
                                @endif 
                                </div>    
                                          
                     		      </div><!-- div que cierra el panel body-->
                                    
                            </div> <!-- div que cierra box box primary-->
                          </div>
                        </div> <!-- div que cierra toda la row numero 1 de informacion principal del grupo-->


                                                           			 	 
                </section><!-- /.content -->
            </aside><!-- /.right- side -->
            </form> 
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
                <!-- Grupo principal al que será trasladado -->
                <div class="form-group">
                        <label style="float: left;">Grupo principal al que será trasladado</label>
                        <select id="grupo_principal" name="grupo_principal" class="form-control">
                          <option value="0">Seleccione un grupo principal</option>
                          @foreach($grupos_principales as $grupo_principal)
                            <option value="{{ $grupo_principal->id }}">{{ $grupo_principal->nombre }}</option>
                          @endforeach
                        </select>
                </div>
                <div id="error_seleccioanr_grupo" class="desvanece alert alert-danger col-lg-12" style="display: none;">
                  Seleccione un grupo principal para poder continuar
                </div>
                <!-- /Grupo principal al que será trasladado -->
                <button id="boton-cambiar-grupo" type="button" class="si btn bg-light-redil">Cambiarlo de Grupo</a>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
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
                 
   

    @include('includes.scripts') 
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
                ///la linea a continuación es porque necesitaba el id del asistente seleccioando para el evento del boton cambair de grupo
                var id_asistente = "";
                ///este es el panel donde se cargaran los registros seleccioandos por el usuario
                var panel_lideres_seleccionados=$("#lideres-seleccionados"); 

                var ids_lideres=new Array(); //esta variable solo es para saber cuales son los liders del grupo y poder mostrar el mensaje se alerta si se intenta seleccionar de nuevo

                var ids_asistentes=new Array(); //esta variable solo es para saber cuales son los asistentes del grupo y poder mostrar el mensaje se alerta si se intenta seleccionar alguno de ellos como lider

                var pastores_ppl=new Array();//un array para guardar los pastores principales y poder comprobar que estos no vayan a ser añadidos a un grupo

                var grupo_lider="";
                @if(isset($linea->encargados()->first()->grupo->id))
                  grupo_lider={{ $linea->encargados()->first()->grupo->id }};
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
                          id_asistente = $(this).attr("data-id");
                      var nombre_asistente= $(this).attr("data-nombre");
                      
                      ///verifica si el selccionado es asistente de algun grupo
                      //alert(ids_lideres.length>0);
                      /*if(grupo_lider=="" && ids_lideres.length>0)
                      {
                        $('#modal_mensaje_asistente_inhabilitado .titulo').html("No es posible añadir el asistente")
                        $('#modal_mensaje_asistente_inhabilitado .mensaje').html("Los actuales encargados de la línea no pertenece a ningún grupo principal. Para poder añadir mas encargados a esta línea debera añadir a los encargados a un grupo principal.")
                        $('#boton-cambiar-grupo').html('Asignar al grupo principal');
                        $('#boton-cambiar-grupo').attr('href', '/asistentes/actualizar/'+ids_lideres[0]);
                        $('#modal_mensaje_asistente_inhabilitado').modal('show');
                      }
                      else if(id_linea=="")
                      {
                        $('#modal_mensaje_asistente_inhabilitado .titulo').html("No es posible añadir el asistente")
                        $('#modal_mensaje_asistente_inhabilitado .mensaje').html("El asistente <b>cod. "+id_asistente+" "+nombre_asistente+"</b> no esta asignado a ninguna línea. <br>Para poder ser encargado de un grupo debe asignarlo primeramente a una línea.")
                        $('#boton-cambiar-grupo').html('Asignar a una línea');
                        $('#boton-cambiar-grupo').attr('href', '/asistentes/actualizar/'+id_asistente);
                        $('#modal_mensaje_asistente_inhabilitado').modal('show');
                      }
                      else */if(id_grupo=="")
                      {
                        $('#modal_mensaje_asistente_inhabilitado .titulo').html("Debe asignar a un grupo para continuar")
                        if(grupo_lider!="")
                        {
                          $('#grupo_principal > option[value="'+grupo_lider+'"]').attr('selected', 'selected');
                          $('#grupo_principal option:not(:selected)').attr('disabled',true);
                          $('#modal_mensaje_asistente_inhabilitado .mensaje').html("El asistente <b>cod. "+id_asistente+" "+nombre_asistente+"</b> no asiste a ningún grupo. <br>Para poder ser encargado de una línea debe asignarlo a uno de los grupos principales.")
                        }
                        else
                        {
                          $('#modal_mensaje_asistente_inhabilitado .mensaje').html("El asistente <b>cod. "+id_asistente+" "+nombre_asistente+"</b> no asiste a ningún grupo. <br>Para poder ser encargado de esta línea debe asignarlo al grupo del encargado actual.")
                        }
                        $('#boton-cambiar-grupo').html('Asignar al grupo seleccionado');
                        $('#modal_mensaje_asistente_inhabilitado').modal('show');
                      }
                      //verifica si el seleccionado es un pastor principal y no lo deja avanzar
                      else if(pastores_ppl.indexOf(id_asistente)!=-1)
                      {
                        $('#modal_mensaje_asistente_seleccionado .titulo').html("No es posible añadir el asistente")
                        $('#modal_mensaje_asistente_seleccionado .mensaje').html("El asistente <b>cod. "+id_asistente+" "+nombre_asistente+"</b> es uno de los pastores principales de la iglesia. @if(Auth::user()->id==1 || isset($linea->encargados()->find(Auth::user()->asistente->id)->id)) Por la integridad de la información no puede ser añadido como encargado de la línea @endif")
                        $('#modal_mensaje_asistente_seleccionado').modal('show');
                      }
                      ///verifica si el seleccionado si esta en el mismo grupo de los otros lideres
                      else if(id_grupo!=grupo_lider && grupo_lider!="")
                      {
                        $('#grupo_principal > option[value="'+grupo_lider+'"]').attr('selected', 'selected');
                        $('#grupo_principal option:not(:selected)').attr('disabled',true);
                       
                        $('#modal_mensaje_asistente_inhabilitado .titulo').html("Debe trasladar de grupo al asistente para continuar")
                        $('#modal_mensaje_asistente_inhabilitado .mensaje').html("El asistente <b>cod. "+id_asistente+" "+nombre_asistente+"</b> pertenece a un grupo diferente al de los lideres ya seleccionados. <br><br> Para añadirlo como lider de este grupo debes cambiarlo primero al grupo <b>cod. "+grupo_lider+" @if(isset($linea->encargados()->first()->grupo->nombre)){{$linea->encargados()->first()->grupo->nombre }} @endif</b>")
                        $('#boton-cambiar-grupo').html('Trasladarlo al grupo seleccionado y continuar');
                        $('#modal_mensaje_asistente_inhabilitado').modal('show');
                      }
                      //verifica si el seleciconado ya no habia sido seleccionado antes
                      else if(ids_lideres.indexOf(id_asistente)!=-1)
                      {
                        $('#modal_mensaje_asistente_seleccionado .titulo').html("No es posible añadir el asistente")
                        $('#modal_mensaje_asistente_seleccionado .mensaje').html("El asistente <b>cod. "+id_asistente+" "+nombre_asistente+"</b> ya es lider de este grupo")
                        $('#modal_mensaje_asistente_seleccionado').modal('show');
                      }
                      //si el seleccionado si es apto lo crea en la vista y lo guarda en la base de datos
                      else{

                        $.ajax({url:"/lineas/asignar-lider-linea-ajax/{{ $linea->id }}/"+id_asistente,cache:false, type:"POST",success:function(resp)
                          {
                            if(resp=="true")
                            {
                              construyeItemLider(id_asistente, panel_lideres_seleccionados, "", nombre_class_lider);
                              bandera_alterar_resultados_busqueda=1;
                              ids_lideres.push(id_asistente);
                              grupo_lider=id_grupo;
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
                     panel_lideres_seleccionados.append('<div style="padding: 5px;" id="item-cargando" class="col-lg-4 col-md-4 col-lg-12 col-lg-12"><center><img class="img-responsive" src="/img/ajax-loader1.gif" /><center></div>'); 
                    }
                    panel_lideres_seleccionados.find('#mensaje_no_hay').remove();
                  ///el primer parametro es el ID el segundo el nombre de la class adicionales, el tercero cantidad de col para lg y md y el cuarto cantidad de col para sm y xs
                    $.ajax({url:"/asistentes/asistente-seleccionado/"+id+"/"+nombre_cl+"/4/12",cache:false, type:"POST",success:function(resp)
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
                              $.ajax({url:"/lineas/eliminar-lider-linea-ajax/{{ $linea->id }}/"+id_eliminado,cache:false, type:"POST",success:function(resp)
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
                              $('#modal_mensaje_imposible_eliminar .mensaje').html("No puedes eliminarte de tu propia línea.")
                              $('#modal_mensaje_imposible_eliminar').modal('show');
                            }
                            @endif
                          }); 
                        }
                      });
                  }

                  function construyeSqlAdicionalLider()
                  {
                     $.ajax({url:"/lineas/construye-sql-lideres-aptos-ajax/{{ $linea->id }}",cache:false, type:"POST",success:function(resp)
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
                      panel_lideres_seleccionados.html("<p id='mensaje_no_hay'>No hay lideres seleccionados para este grupo</p>");
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
                  @if(isset($linea->encargados()->first()->grupo->id))
                    sql_adicional+="AND asistentes.grupo_id="+grupo_lider;
                  @endif

                    @foreach($linea->encargados as $encargado)
                    //se construye el item de los que ya estan guardados
                      construyeItemLider({{ $encargado->id }}, panel_lideres_seleccionados, "", nombre_class_lider);
                      sql_adicional+=" AND asistentes.id<>{{ $encargado->id }}";
                      ids_lideres.push("{{ $encargado->id }}");
                    @endforeach


                    <?php $pastores=Iglesia::find(1)->pastoresEncargados; ?>
                    @foreach($pastores as $encargado)
                      sql_adicional+=" AND asistentes.id<>{{ $encargado->id }}";
                      pastores_ppl.push("{{ $encargado->id }}");
                    @endforeach

                    if(grupo_lider=="" && ids_lideres.length>0){
                      sql_adicional+="AND 2=3";
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

            <!-- script general evento del modal de cambiar de grupo a un asistente para poder ser añadido como servidor -->
            <script type="text/javascript">
              $("#boton-cambiar-grupo").click(function(){
                //alert($("#grupo_principal").val());
                if($("#grupo_principal").val()!="0")
                {
                  $.ajax({url:"/lineas/asignar-lider-linea-ajax/{{ $linea->id }}/"+id_asistente+"/"+$("#grupo_principal").val(),cache:false, type:"POST",success:function(resp)
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
                  $('#modal_mensaje_asistente_inhabilitado').modal('hide');
                  $("#error_seleccioanr_grupo").hide();
                }
                else{
                  $("#error_seleccioanr_grupo").show(200);
                }
                
                //bandera_alterar_resultados_busqueda_servidores=1;
              });

              $(document).ready(function() {
                $("#menu_lineas").children("a").first().trigger('click');
              });

            </script>
       
    </body>
</html>
@endif