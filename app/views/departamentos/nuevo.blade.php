@if(Auth::check())
@include('includes.lenguaje')
<!DOCTYPE html>
<!-- Vista creada por: Darwin Castaño
     Fecha creacíón: 22-07-2014
     Fecha Ultima modificación: 22-07-2014 05:58pm
     funcion vista: esta es la vista que me permite crear un departamento.
     software REDIL version 1.0
-->
<html>
    <head>
      <meta charset="UTF-8">
      <title>Redil | {{Lang::get('departamentos.nd_title')}} </title>
      <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
       @include('includes.styles')
      <!-- Ionicons -->
      <link href="/css/ionicons.min.css" rel="stylesheet" type="text/css" />
       <!-- DATA TABLES -->
      <link href="/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
      <!-- datepicker.css -->
      <link href="/css/datepicker.css" rel="stylesheet" type="text/css" />
      <link href="/css/datepicker3.css" rel="stylesheet" type="text/css" />
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
          <!-- /.sidebar -->
        </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
        <aside class="right-side">                
     <!-- contendio cabezote -->
          <section class="content-header">
    	     <h1>
        {{Lang::get('departamentos.nd_header')}} 
        <small>{{Lang::get('departamentos.nd_subtitulo')}}  </small>
           </h1>  
           <br>
         </section>
         <!-- /contendio cabezote -->
         <!-- contenido principal -->
          <section class="content">
           <form action="new" method="post" role=-"form">
          <!-- row  -->
          <div class="row">   
           <!-- columna del boton guardar -->
            <div class="col-lg-12"style="margin-bottom: 10px;">
              <div class=" box-header">
                  <div class="col-lg-4">
                    <button type="submit" class="btn btn-danger"> <i class="fa fa-save"></i> {{ Lang::get('lineas.al_bt_guardar') }}</button>
                    <a href="/departamentos/lista" class="btn bg-light-redil"> <i class="fa fa-undo"></i> {{ Lang::get('lineas.al_bt_volver') }}</a>
                    <a href="../lista/todos" class="btn bg-light-redil"> <i class="fa fa-minus-circle"></i> {{ Lang::get('lineas.al_bt_dar_de_baja') }}</a>
                  </div>
                  <div class="col-lg-8">
                    <?php $status=Session::get('status'); ?>
                    @if($status=='ok_update')
                    <div class="alert alert-success col-lg-12 desvanecer" style="padding-bottom:5px; padding-top:5px; margin-bottom: -5px" >
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          Usted creo correctamente el departamento {{Session::get('departamento')}}
                            @endif
                    </div>
                 </div>
             </div>
            </div>
          <!-- /columna del boton guardar -->
          <!-- seleccionar departamento-->
          <div class="col-md-6">
              <div class="box box-primary">
                  <div class="panel-heading">
                    <h3 class="box-title"> {{Lang::get('departamentos.nd_for_tit_info_principal')}} </h3>
                 </div>
                   <div class="panel-body">
                   <!-- Nombre -->
                       <div class="form-group">
                          <label>{{Lang::get('departamentos.nd_for_lb_nombre')}}</label>
                          <input required  type="text" id="nombre" name="nombre" class="form-control" placeholder="{{Lang::get('departamentos.nd_for_nombre_ph_form')}}" />
                       </div>
                      <!-- /Nombre-->
                      <!-- Descripcion -->
                      <div class="form-group">
                         <label>{{Lang::get('departamentos.nd_for_lb_descripcion')}}</label>
                         <textarea id="descripcion" name= "descripcion" class="form-control" rows="3"  maxlength="200"  placeholder="{{Lang::get('departamentos.nd_for_ph_descripcion')}} "></textarea>
                      </div>
                      <!-- /Descripcion -->  
                      <!-- palabra rhema departamento -->
                      <div class="form-group">
                         <label>{{Lang::get('departamentos.nd_for_lb_rhema')}}</label>
                         <textarea id="rhema" name="rhema" class="form-control" rows="3"  maxlength="200" placeholder="{{Lang::get('departamentos.nd_for_ph_rhema')}}"></textarea>
                      </div>
                      <!-- /palabra rhema departhamento -->   
                      <br>
                      <br> 
                  </div>
              </div>
          </div>
          <!-- /seleccionar departamento -->
          <!-- seleccionar departamento-->
          <div class="col-md-6">
            <div class="box box-primary">
              <div class="panel-heading">
                <h3 class="box-title"></h3>
              </div>

              <div class="panel-body">
                 <button class="btn btn-primary" data-toggle="modal" data-target=".modal-seleccionarDirector">{{Lang::get('departamentos.nd_for_btn_director')}}</button>
                 <div class="form-group">                                         
                   <table id="tabla_director_departamento" class="table table-striped display">
                         <thead>               
                              <th style="width: 10px"> {{ Lang::get('departamentos.nd_for_tb_th1_id_director') }}</th>
                              <th>{{ Lang::get('departamentos.nd_for_tb_th2_nombre_director') }}</th>
                         </thead>
                        <tbody>
                        </tbody>
                   </table>
                 </div>         
                 <!-- funciones del director -->
                <div class="form-group">
                 <label>{{ Lang::get('departamentos.nd_for_lb_funciones_director') }}</label>
                    <textarea id="funciones_director" name="funciones_director"class="form-control" rows="3"  maxlength="200" placeholder="{{ Lang::get('departamentos.nd_for_ph_funciones_director') }}"></textarea>
                </div>
                <!-- /Funciones-->
                <!-- fecha creacion del departamento-->
                <div class="form-group">
                  <label for="datepicker" class="control-label">{{ Lang::get('departamentos.nd_for_lb_fecha_cre_departamento') }}</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                    	 	 <i class="glyphicon glyphicon-calendar"></i>
                      </div>
               			     <input  name="fecha_creacion" id="fecha_creacion" type="text" class="date-picker form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
     		            </div><!-- div que cierra el bootstrap picker-->
                </div> <!-- div que cierra el formulario de fecha creacion departamento-->                                    
              </div><!-- /div que cierra el panelbody-->
            </div><!-- /div que cierra el boxprimary-->
          </div> <!-- /cierra col-6 columna derecha -->
              <input id="integrantes_id" name="integrantes_id" type="text" class="hide form-control" placeholder="" readonly value=""/>
              <input id="integrantes_cargo" name="integrantes_cargo" type="text" class="hide form-control" placeholder="" readonly value=""/>
              <input id="integrantes_funciones" name="integrantes_funciones" type="text" class="hide form-control" placeholder="" readonly value=""/>
              <input id="encargados_ids" name="encargados_ids" type="text" class="hide form-control" placeholder="" readonly value=""/>
           <div class="col-md-12">
            <div class="box box-primary">
              <div class="panel-heading">
                     <h3 class="box-title">{{ Lang::get('departamentos.nd_for_title_servidores') }}</h3>  <h5>{{ Lang::get('departamentos.nd_for_subtitulo_servidores') }}</h5>
               </div>
              <div class="panel-body">
                <div class="row">
                <!-- servidor-->
                <div class="col-md-4 text-left">
                  <button class="btn btn-primary" data-toggle="modal" data-target=".modal-seleccionarServidor"> {{ Lang::get('departamentos.nd_bt_elegir_servidor') }}
                  </button>
                    <div class="form-group" style="margin-top:7px;">
                          <label>{{ Lang::get('departamentos.nd_for_lb_servidor') }}</label>
                          <input id="servidor" name="servidor" type="text" class="form-control" placeholder="" readonly value=""/>
                    </div>
                    <div id="error_integrante" style="display:none" class="callout callout-danger">
                          <h4>ERROR FALTA INTEGRANTE</h4>
                           <p> Por favor ingrese el nombre del integrante</p>
                   </div>
                </div><!-- servidor-->     
                      <!-- cargo -->
                    <br>
                    <br>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{ Lang::get('departamentos.nd_for_lb_cargo') }}</label>
                        <input id="cargo_servidor" name="cargo_servidor"type="text" class="form-control" placeholder="{{ Lang::get('departamentos.nd_for_ph_cargo') }}" />
                      </div>
                    <div id="error_cargo" style="display:none" class="callout callout-danger">
                          <h4>ERROR FALTA CARGO</h4>
                          <p> Por favor ingrese el cargo del integrante</p>
                    </div>
                </div>
                <!-- /cargo-->
                <!-- funciones del servidor -->
                <div class="col-md-4">
                  <div class="form-group">
                        <label>{{ Lang::get('departamentos.nd_for_lb_funciones_servidor') }}</label>
                        <textarea id="funciones_servidor" name="funcionesservidor" class="form-control" rows="3"  maxlength="200" placeholder="{{ Lang::get('departamentos.nd_for_phfunciones_servidor') }}"></textarea>
                  </div>          
                </div>
                <!-- /Funciones-->
                <!-- boton añadir servidor-->
                <div class="col md-4 pull-right ">
                  <div style="padding-right: 50px;">
                        <a id="anadir_servidor" class=" btn btn-success"> <i class="fa fa-plus-circle"> </i> {{ Lang::get('departamentos.nd_bt_añadir_servidor') }}</a>
                  </div>
                </div>
                <!-- / cierra boton añadir servidor-->
                </div> 
                <!-- /row-->
                 
                <br>
                <br>
                <br>
                <br>
                  <!-- tabla listado de seridores departamento-->
                  <div class="box-body table-responsive">
                    <table id="lista_servidores_departamento" class="table table-striped display stripe" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th> {{ Lang::get('departamentos.nd_tb_th2_servidores') }} </th>
                            <th> {{ Lang::get('departamentos.nd_tb_th3_servidores') }}  </th>
                            <th> {{ Lang::get('departamentos.nd_tb_th4_servidores') }}  </th>
                         </tr>
                        </thead>
                         <tbody>         
                         </tbody>
                    </table>
                  </div>
                  <!-- cierra tabla que contiene los datos de quien es el servidor-->
              </div> <!-- / cierre panel body-->
            </div> <!-- / cierra el box priamay-->
           </div><!-- / cierra el col 12 completo-->
            </form>
         </section>
         <!-- fin contenido principal -->
       </aside>
     </div> 

  <!-- modal seleccionar Director  -->
        <div id="modal_director" name="modal_director" class="modal fade modal-seleccionarDirector" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg">
           <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="myModalLabel"> {{ Lang::get('departamentos.nb_md_tit_director') }} </h4>
              </div>
              <div class="modal-body">  
                <table id="seleccionar_director" class="table table-striped display " cellspacing="0" width="100%">
                  <thead>
                    <tr>
                          <th>{{ Lang::get('departamentos.nb_md_th1_director') }}</th>
                          <th>{{ Lang::get('departamentos.nb_md_th2_director') }}</th>
                          <th>{{ Lang::get('departamentos.nb_md_th3_director') }}</th>
                          <th></th>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach ($asistentes_lista_encargados as $asistente) 
                    <tr>
                      <td>
                          <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="{{ Lang::get('departamentos.nb_md_tit_cod_director') }}">{{ Lang::get('departamentos.nb_md_lb_cod_director') }}</label> {{ ($asistente->id) }}<br>
                      </td>
                      <td>
                         <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="{{ Lang::get('departamentos.nb_md_tit_nom_director') }}"> <i class="fa fa-user"></i></label> {{$asistente->nombre}} {{$asistente->apellido}} <br>                                                                                                     
                      </td>
                       <td>
                          <?php   
                          $id_linea= $asistente->grupo['linea_id'];
                          $linea= Linea::find($id_linea);
                          ?>
                         <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="{{ Lang::get('departamentos.nb_md_tit_nom_linea') }}"> <i class="fa fa-code-fork"></i></label> @if($id_linea!=""){{$linea->nombre}} @endif<br>                                                                                                     
                       </td>
                       <td>
                        <button id="director-{{$asistente->id }}" data-id="{{ $asistente->id }}"  data-nombre="{{ $asistente->nombre.' '.$asistente->apellido }}" class="seleccionar-dir btn btn-success btn-sm" ><i class="fa fa-check"></i></button>
                        <button style="display:none" id="borrar_director-{{ $asistente->id }}" data-id="{{ $asistente->id }}"  class="borrar_fila_director btn btn-danger btn-sm" ><b>X</b></button>
                       </td>
                    </tr>
                   @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
  <!-- modal fin seleccionar Director  -->
            
  <!-- modal seleccionar Servidor  -->
        <div id="modal_servidor" name="modal_servidor" class="modal fade modal-seleccionarServidor" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="myModalLabel">{{ Lang::get('departamentos.nb_md_tit_integrante') }} </h4>
              </div>    
              <div class="modal-body"> 
                <table id="seleccionar_servidor" class="table table-striped display " cellspacing="0" width="100%">
                  <thead>
                                         <tr>
                                          <th>{{ Lang::get('departamentos.nb_md_th1_integrante') }}</th>
                                          <th>{{ Lang::get('departamentos.nb_md_th2_integrante') }}</th>
                                          <th>{{ Lang::get('departamentos.nb_md_th3_integrante') }}</th>
                                          <th></th>
                                         </tr>
                  </thead>
                  <tbody>
                   @foreach($asistentes_lista_integrantes as $asistente_linea)    
                    <tr>
                      <td>
                        <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="{{ Lang::get('departamentos.nb_md_tit_cod_integrante') }}">{{ Lang::get('departamentos.nb_md_lb_cod_director') }}</label> {{ $asistente_linea->id }}<br>
                      </td>
                      <td>
                        <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="{{ Lang::get('departamentos.nb_md_tit_nom_integrante') }}"> <i class="fa fa-user"></i></label> {{ $asistente_linea->nombre }} {{$asistente_linea->apellido}}<br>                                                                                                     
                      </td>
                      <td>
                         <?php   
                          $id_linea_int= $asistente_linea->grupo['linea_id'];
                          $linea_int= Linea::find($id_linea_int);
                         ?>
                         <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="{{ Lang::get('departamentos.nb_md_tit_nom_linea') }}"> <i class="fa fa-code-fork"></i></label> @if ($id_linea_int != "") {{ $linea_int->nombre }} @endif<br>                                                                                                     
                      </td>
                      <td> 
                        <button id="asistente-{{ $asistente_linea->id }}" data-id="{{ $asistente_linea->id }}"  data-nombre="{{ $asistente_linea->nombre.' '.$asistente_linea->apellido }}" class="seleccionar btn btn-success btn-sm" ><i class="fa fa-check"></i></button>
                        <button style="display:none" id="borrar-{{ $asistente_linea->id }}" data-id="{{ $asistente_linea->id }}"  class="borrar-fila btn btn-danger btn-sm" ><b>X</b></button>
                      </td>
                     </tr>
                    @endforeach
                  </tbody>
                </table>
             </div>
           </div>
          </div>
        </div>
  <!--fin  modal seleccionar Servidor -->
                   
       @include('includes.scripts') 
        
        <!-- DATA TABLES SCRIPT -->
         <script src="{{ Lang::get('general.url-datatables') }}" type="text/javascript"></script>
        <script src="/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script src="/js/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
        
           
        <!-- InputMask -->
        <script src="/js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="/js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="/js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <!-- bootstra datepicker-->
    <script src="/js/bootstrap-datepicker.js"></script>
    <script src="/js/locales/bootstrap-datepicker.es.js"></script>
        
        <!-- page script -->
        <script type="text/javascript">
			//js de las tablas de la vista
      $("#funciones_director").val("");
            $(document).ready(function() 
          {
              var integrantes_id=new Array();
              var integrantes_funciones=new Array();
              var integrantes_cargo= new Array();
              var directores_seleccionados= new Array();
              var t=""; 
              var boton_borrar="";
              var boton_borrar_director= "";
              //para las mascaras en los input
              $("[data-mask]").inputmask();
              //Date range picker$
              $('#fecha_creacion').datepicker({
        					language: 'es',
                  format:'dd/mm/yyyy'
			        });

                 ////accion del boton integrantes departamento  
              $('.seleccionar').click (function ()
               {
               
                  var id_seleccionado = $(this).attr("data-id");
                
                  var nombre = $(this).attr("data-nombre");
                  $('#servidor').attr("data-id", id_seleccionado);

                  $('#servidor').val('Cod:'+id_seleccionado+' '+'-'+' '+nombre); 


                  boton_borrar=id_seleccionado;  
                 

                   $("#modal_servidor").modal('hide'); // me oculta el modal de seleccionar linea que tiene como id= lineap
                    $("#cargo_servidor").focus();
                 });

            // accion para añadir el integrante seleccionado mas sus otros datos al datatable
              $('#anadir_servidor').on( 'click', function ()
               {

                  if ($("#servidor").val()=="")
                  {

                    $("#error_integrante").show();
                         setTimeout(function() {
                       $("#error_integrante").hide(500)
                                            }, 10000);
                  }

                 else if ($("#cargo_servidor").val()=="")
                  {
                       $("#error_cargo").show();
                       setTimeout(function() {
                       $("#error_cargo").hide(500)
                                            }, 10000);
                  }

                  else
                  {
                     $("#cargo_servidor").val(),
                             

                       t= $('#lista_servidores_departamento').dataTable();

                          t.fnAddData( [
                                        $("#servidor").val(),
                                        $("#cargo_servidor").val(),
                                       
                                        $("#funciones_servidor").val()+' <a id="encontrar-'+boton_borrar+'" class="hide" ></a>',
                                       
                                       ]);

                          $("#asistente-"+boton_borrar).hide();
                          
                          $("#borrar-"+boton_borrar).show();

                          /////////////////////////
                          ///////////////////////////////////////////////////
                          integrantes_id.push($('#servidor').attr("data-id"));
                          $("#integrantes_id").val(JSON.stringify(integrantes_id));
                          integrantes_cargo.push($("#cargo_servidor").val());
                          $("#integrantes_cargo").val(JSON.stringify(integrantes_cargo));
                          //alert($("#integrantes_cargo").val());
                          integrantes_funciones.push($("#funciones_servidor").val());
                          $("#integrantes_funciones").val(JSON.stringify(integrantes_funciones));
                          $("#servidor").val("");
                          $("#cargo_servidor").val("");
                          $("#funciones_servidor").val("");
                 }


                    
           });
                    
                        // este codigo me permite borrar una fila de una tabla
                   $('.borrar-fila').on( 'click', function () {

                              var id_eliminar_integrante= $(this).attr('data-id');

                              
                
                      var tabla_servidor=  $('#lista_servidores_departamento').dataTable();
                      var target_row = $('#encontrar-'+id_eliminar_integrante).parent().parent().get(0); // this line did the trick
                      var aPos = tabla_servidor.fnGetPosition(target_row); 
                      tabla_servidor.fnDeleteRow(aPos);
                      integrantes_id.splice(aPos,1);
                    
                      
                              $(this).hide(),
                              $('#asistente-'+id_eliminar_integrante).show();
                    }); 
                    
           
               
               //////ajax para cambiar la tabla que me asigna los directores de departamento
               $('.seleccionar-dir').click (function () {
                       
                            var id_director_seleccionado = $(this).attr("data-id");
                            var nombre_director = $(this).attr("data-nombre");
                          

                             directores_seleccionados.push($(this).attr("data-id"));
                                $("#encargados_ids").val(directores_seleccionados);


                                boton_borrar_director=id_director_seleccionado;

                              $(this).hide();
                              $("#borrar_director-"+boton_borrar_director).show();

                          $('#tabla_director_departamento').append('<tr>'+
                            '<td>'+id_director_seleccionado+'</td>'+
                            '<td>'+nombre_director+'</td>'+
                            '<td class="text-center"><a id="encontrar-director-'+id_director_seleccionado+'" class="hide" ></a> </td>'+

                             '</tr>');
                           /* $.ajax({url:"ajax/"+id_director_seleccionado,cache:false, type:"POST",
                                success:function(resp)
                                {
                                     
                                    tr=resp;
                                    $("#tabla_director_departamento").append(tr);
                                    $('.borrar_fila_director').click (function () {
                                        var tabla_director = $('#tabla_director_departamento').table-striped();
                                        var tr = td.parent();
                                        tr.remove();

                                     
                                    }); 
                                }
                            });*/
                        });
              //////////////////// aqui empieza el eliminar fila del director

                           $('.borrar_fila_director').click (function () {
                            
                              var id_eliminar_director= $(this).attr('data-id');


                              var td= $('#encontrar-director-'+id_eliminar_director).parent();
                              var tr=td.parent();
                              var pos=directores_seleccionados.indexOf($(this).attr('data-id')); // obtengo la posicion de arreglo segun el data-id
                                          directores_seleccionados.splice(pos,1);
                                          $("#encargados_id").val(directores_seleccionados);
                                          tr.remove();
                              
                              $(this).hide(),
                              $('#director-'+id_eliminar_director).show();

                           });

                           $('#lista_servidores_departamento').dataTable( 
                            {
                               
                            });
                          
                            $('#seleccionar_director').dataTable( 
                            {
                                 
                            });
                         
                            $('#seleccionar_servidor').dataTable( 
                            {
                                 
                            });
                            //////funcion para evitar que cuando le den enter de una no haga el envio del formulario
                            function stopRKey(evt) {
                                var evt = (evt) ? evt : ((event) ? event : null);
                                var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
                                if ((evt.keyCode == 13) && (node.type=="text")) {return false;}
                                }
                                document.onkeypress = stopRKey; 

                                        

              });
                
        </script>

        
        
    </body>
</html>
@endif