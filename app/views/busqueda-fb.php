<!-- Información Ministerial del grupo --> 
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <!-- Añadir predicadores --> 
  <div class="panel">
      <div class="panel-heading">
         <h4 class="modal-title"> Información ministerial del grupo </h4>    
      </div>
      <div class="panel-body">
          <!-- predicador --> 
          <div class="nav navbar-nav panel-ppl-busqueda" style="margin-bottom: 30px;">
              <label>Seleccione el (los) encargado(s) del grupo: </label>
              <li class="dropdown messages-menu">
                <div class="input-group "  >
                  <input type="text" id="busqueda_predicador" class="form-control busqueda-fb buscar" autocomplete="off" placeholder="Buscar predicador por código, nombre o cédula..." />
                  <span class="input-group-btn">
                      <button type='button' class="btn btn-flat" style="border-color:#CCC;background:#fff" ><i class="fa fa-search" style="color:#00545E" ></i></button>
                  </span>
                </div> 

                <ul id="panel-ppl-predicadores" class="dropdown-menu panel-busqueda-moviles">
                  <li>
                      <!-- el siguiente es el panel que se llenara con los registros de la busqueda, se deja vacio -->
                    <ul class="menu" id="panel-predicadores">
                    </ul>
                  </li>
                </ul>
                <div class="footer">Mostrando 10 de 100</div>

              </li>
              
          </div>  
          <!-- el siguiente es el panel que se llenara con los registrosque seleccione el usuario, se deja vacio -->
          <div id="predicadores-seleccionados"> 
          @if($grupo->encargados->count()>0) 
            <div style="padding: 5px;" id="item-cargando" class="col-lg-12 col-md-12 col-lg-12 col-lg-12">
              <center><img class='img-responsive' src='/img/ajax-loader1.gif' /><center>
            </div>
          @endif 
          </div>  
           
      </div>
  </div> 
  <!-- fin añadir predicadores --> 
</div>


  <!-- script para buscar los predicadors de un grupo -->
  <script type="text/javascript">
  //la siguiente variable "bandera_alterar_resultados_busqueda" es opcional 
  //y se enciende cuando un predicador es eliminado o añadido y al volver a abrir el panel de resulatdos de busqueda
  //necesito actualizarlo para que desaparazca o aparezca nuevamente como opcion para vovler a añadir
      var bandera_alterar_resultados_busqueda=0;
      ////la siguiente variable es pla que nos guardara el objeto de la busqueda tipo facebook
      var busqueda_predicador;
      var nombre_class_predicador="encargado"
      ///este es el panel donde se cargaran los registros seleccioandos por el usuario
      var panel_predicadores_seleccionados=$("#predicadores-seleccionados"); 

      var ids_predicadores=new Array(); //esta variable solo es para saber cuales son los predicadors del grupo y poder mostrar el mensaje se alerta si se intenta seleccionar de nuevo

      var grupo_predicador="";
      @if(isset($grupo->encargados()->first()->grupo_id))
        grupo_predicador={{ $grupo->encargados()->first()->grupo_id }};
      @endif
      ///esta función nos permitira determinar que evento sucedera si se le da clic 
      //a un item de los resultados de la busqueda o a cualquier objeto denrto del item, como el boton cerrar
      function seleccionar_predicador(){
          ///la class .seleccionar-xxx viene del controlador en el metodo ajax
          //que nos hace la respectiva busqueda. Su contenido dependera de lo que se quiera hacer al selccionar el item
          $('.seleccionar-'+nombre_class_predicador).unbind('click');///primero se eliminan todos los ateriores eventos click
          $('.seleccionar-'+nombre_class_predicador).click(function () {
            var id_grupo=$(this).attr("data-grupo-id");
            var id_asistente = $(this).attr("data-id");
            var nombre_asistente= $(this).attr("data-nombre");
            ///verifica si el seleccionado si esta en el mismo grupo de los otros predicadores
            if(id_grupo!=grupo_predicador && grupo_predicador!="")
            {
              $('#modal_mensaje_asistente_inhabilitado .titulo').html("No es posible añadir el asistente")
              $('#modal_mensaje_asistente_inhabilitado .mensaje').html("El asistente <b>cod. "+id_asistente+" "+nombre_asistente+"</b> pertenece a un grupo diferente al de los predicadores ya seleccioandos. <br><br> Para añadirlo como predicador de este grupo debes cambiarlo primero al grupo <b>cod. "+grupo_predicador+" @if($grupo->encargados()->count()>0){{$grupo->encargados()->first()->grupo->nombre }} @endif</b>")
              $('#boton-cambiar-grupo').attr('href', '/grupos/actualizar/'+grupo_predicador);
              $('#modal_mensaje_asistente_inhabilitado').modal('show');
            }
            //verifica si el seleciconado ya no habia sido seleccionado antes
            else if(ids_predicadores.indexOf(id_asistente)!=-1)
            {
              $('#modal_mensaje_asistente_seleccionado .titulo').html("No es posible añadir el asistente")
              $('#modal_mensaje_asistente_seleccionado .mensaje').html("El asistente <b>cod. "+id_asistente+" "+nombre_asistente+"</b> ya es predicador de este grupo")
              $('#modal_mensaje_asistente_seleccionado').modal('show');
            }
            //si el seleccionado si es apto lo crea en la vista y lo guarda en la base de datos
            else{

              $.ajax({url:"/grupos/asignar-predicador-grupo-ajax/{{ $grupo->id }}/"+id_asistente,cache:false, type:"POST",success:function(resp)
                {
                  if(resp=="true")
                  {
                    construyeItempredicador(id_asistente, panel_predicadores_seleccionados, "", nombre_class_predicador);
                    bandera_alterar_resultados_busqueda=1;
                    ids_predicadores.push(id_asistente);
                    construyeSqlAdicionalpredicador();//se reconstruye el sql adicional para actualizar el panel de busqueda
                  }
                  else{
                    alert("Hubo un error al asignar el predicador");
                  }
                }
              });
            }
          });
        }

        ///esta función construye el item seleccionado en el panel de resultados
        function construyeItempredicador(id, panel, input, nombre_cl){
          // solo añade el cargando si no existe ya uno en pantalla.
          if (!$('#item-cargando').length){
           panel_predicadores_seleccionados.append('<div style="padding: 5px;" id="item-cargando" class="col-lg-6 col-md-12 col-lg-12 col-lg-12"><center><img class="img-responsive" src="/img/ajax-loader1.gif" /><center></div>'); 
          }
          panel_predicadores_seleccionados.find('#mensaje_no_hay').remove();
        ///el primer parametro es el ID el segundo el nombre de la class adicionales, el tercero cantidad de col para lg y md y el cuarto cantidad de col para sm y xs
          $.ajax({url:"/asistentes/asistente-seleccionado/"+id+"/"+nombre_cl+"/6/12",cache:false, type:"POST",success:function(resp)
              {
                 mensajeNopredicadores();/// para comprobar si se debe mostrar el mensaje de 'no hay predicadores' u ocultar
                $("#predicadores-seleccionados #item-cargando").remove();
                panel_predicadores_seleccionados.append(resp); 
                $("#ico-"+nombre_cl).css("height", $("#info-"+nombre_cl).height());

                //////////evento eliminar predicador seleccionado, primero elimina si se han creado eventos anteriormente
                $('.cerrar-'+nombre_cl+'-seleccionado').unbind('click');///primero se eliminan todos los ateriores click
                $('.cerrar-'+nombre_cl+'-seleccionado').click(function () {
                  id_eliminado= $(this).attr("data-id"); //se obtiene el id del asistente a eliminar
                  $("#item-"+nombre_cl+"-"+id_eliminado+' .cerrar-'+nombre_cl+'-seleccionado').html("<img class='img-responsive' width='30px' src='/img/ajax-loader.gif' />");
                  $.ajax({url:"/grupos/eliminar-predicador-grupo-ajax/{{ $grupo->id }}/"+id_eliminado,cache:false, type:"POST",success:function(resp)
                    {
                      if(resp=="true")
                      {
                        $("#item-"+nombre_cl+"-"+id_eliminado).remove();
                        bandera_alterar_resultados_busqueda=1;
                        pos_eliminar=ids_predicadores.indexOf(id_eliminado);
                        ids_predicadores.splice(pos_eliminar,1);
                        construyeSqlAdicionalpredicador();//se reconstruye el sql adicional para actualizar el panel de busqueda
                        mensajeNopredicadores();/// para comprobar si se debe mostrar el mensaje de 'no hay predicadores' u ocultar
                      }
                      else{
                        alert("Hubo un error al eliminar el predicador");
                      }
                    }
                  });
                }); 
              }
            });
        }

        function construyeSqlAdicionalpredicador()
        {
           $.ajax({url:"/grupos/construye-sql-predicadores-aptos-ajax/{{ $grupo->id }}",cache:false, type:"POST",success:function(resp)
            {
              sql_adicional=resp;
              busqueda_predicador.actualizarSqlAdicional(sql_adicional);
            }
          });
        }

        ///muestra mensaje informativo cuando el grupo no tiene predicadores
        function mensajeNopredicadores(){
          if(ids_predicadores.length==0)
          {
            panel_predicadores_seleccionados.html("<p id='mensaje_no_hay'>No hay predicadores seleccionados para este grupo</p>");
          }
          else
          {
            //if (!panel_predicadores_seleccionados.find('#mensaje_no_hay').length){
              panel_predicadores_seleccionados.find('#mensaje_no_hay').remove();
            //}
          }
        }


      $(document).ready(function() {
        var sql_adicional="" //si no hay sql adicional dejar la variable vacia
        
        ///las sgtes lineas cargan los registros seleccionados que estan ya guardados en la base de datos
        @if($grupo->encargados->count()>0)
          grupo_id=grupo_predicador;
          sql_adicional="(asistentes.grupo_id="+grupo_id;
          @foreach($grupo->encargados as $encargado)
          //se construye el item de los que ya estan guardados
            construyeItempredicador({{ $encargado->id }}, panel_predicadores_seleccionados, "", nombre_class_predicador);
            sql_adicional+=" AND asistentes.id<>{{ $encargado->id }}";
            ids_predicadores.push("{{ $encargado->id }}");
          @endforeach
          sql_adicional+=")";
        @endif

        mensajeNopredicadores();

        //se crea un objeto de la Clase BusquedaFB y se cargan los primeros registros
        
        busqueda_predicador = new BusquedaFB($("#busqueda_predicador"), $("#panel-ppl-predicadores"), "panel-predicadores", "/asistentes/obtiene-asistentes-para-busqueda-ajax/"+nombre_class_predicador, seleccionar_predicador, sql_adicional);
        busqueda_predicador.cargarPrimerosRegistros();

        ///en caso de que el panel de resultados de la busqueda se necesite abrir con 
        ///un evento se colocan las siguientes lineas, en este caso con el evento focus del input de busqueda
        
        $("#busqueda_predicador").focus(function() {
            if(bandera_alterar_resultados_busqueda)
            {
              bandera_alterar_resultados_busqueda=0;
              busqueda_predicador.actualizaPanel($("html"));
            }
            else
            {
              busqueda_predicador.muestraPanel($("html"));
            }
        });
      });
      
  </script> 
  <!-- fin script busqueda de predicadores -->