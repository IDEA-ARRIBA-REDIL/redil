@if(Auth::check())
@include('includes.lenguaje')
<!DOCTYPE html>
<!-- Vista creada por: Darwin Castaño
     Fecha creacíón: 24-07-2014
     Fecha Ultima modificación: 24-07-2014 02:36pm
     funcion vista: esta es la vista que me permite actualizar un departamento.
     software REDIL version 1.0
-->
<html>
    <head>
      <meta charset="UTF-8">
      <title>Redil | {{Lang::get('departamentos.ad_title')}} </title>
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
                {{Lang::get('departamentos.ad_header')}} 
                <small>{{Lang::get('departamentos.ad_subtitulo')}}  </small>
              </h1>  
              <br>
            </section>
            <!-- /contendio cabezote -->
                 

             <!-- contenido principal -->
            <section class="content">
              <form role="form" action="../update/{{ $departamentos->id }}" method="post">
                <!-- row  -->
                <div class="row">   
                  <!-- columna del boton guardar -->
                  <div class="col-lg-12"style="margin-bottom: 10px;">
                    <div class=" box-header">
                      <div class="col-lg-4">
                        <button type="submit" class="btn btn-danger"> <i class="fa fa-save"></i> {{ Lang::get('departamentos.ad_bt_guardar') }}</button>
                        <a href="/departamentos/lista" class="btn bg-light-redil"> <i class="fa fa-undo"></i> {{ Lang::get('departamentos.ad_bt_volver') }}</a>
                      <!--  <a href="../lista/todos" class="btn bg-light-redil"> <i class="fa fa-minus-circle"></i> {{ Lang::get('departamentos.ad_bt_dar_de_baja') }}</a> -->
                      </div>
                      <div class="col-lg-8">
                        <?php $status=Session::get('status'); ?>
                        @if($status=='ok_update')
                          <div class="alert alert-success col-lg-12 desvanecer" style="padding-bottom:5px; padding-top:5px; margin-bottom: -5px" >
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ Lang::get('departamentos.ad_ms_ok_update') }} 
                          </div>
                        @endif
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
                           <input required  type="text" id="nombre" name="nombre" class="form-control" value="{{$departamentos->nombre}}" placeholder="{{Lang::get('departamentos.nd_for_nombre_ph_form')}}" />
                        </div>
                        <!-- /Nombre-->
                        <!-- Descripcion -->
                        <div class="form-group">
                           <label>{{Lang::get('departamentos.nd_for_lb_descripcion')}}</label>
                           <textarea id="descripcion" name= "descripcion" class="form-control" rows="3"  maxlength="200"  placeholder="{{Lang::get('departamentos.nd_for_ph_descripcion')}} ">{{$departamentos->descripcion}}</textarea>
                        </div>
                        <!-- /Descripcion -->  
                        <!-- palabra rhema departamento -->
                        <div class="form-group">
                           <label>{{Lang::get('departamentos.nd_for_lb_rhema')}}</label>
                           <textarea id="rhema" name="rhema" class="form-control" rows="3"  maxlength="200" placeholder="{{Lang::get('departamentos.nd_for_ph_rhema')}} ">{{$departamentos->rhema}}</textarea>
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
                                    <th> </th>
                              </thead>
                              <tbody>
                                <?php $funcion=""; ?>
                                @foreach ($departamentos->encargados as $encargado)
                                <tr>
                                  <td> {{$encargado->id}} </td>
                                  <td class="capitalize"> {{$encargado->nombre}} {{$encargado->apellido}}</td>
                                  <td class="text-center"><a id="encontrar-director-{{$encargado->id}}" class="hide" ></a> </td>
                                </tr>
                                <?php $funcion= $encargado->pivot->funcion; ?>
                                @endforeach    

                              </tbody>
                                        
                            </table>
                          </div>
                          <!-- funciones del director -->
                          <div class="form-group">
                              <label>{{ Lang::get('departamentos.nd_for_lb_funciones_director') }}</label>
                              <textarea  id="funciones_director" name="funciones_director" class="form-control" rows="3"  maxlength="200" >{{$funcion}}</textarea>
                          </div>                            
                          <!-- /Funciones-->
                          
                          <!-- fecha creacion del departamento-->
                          <div class="form-group">
                              <label for="datepicker" class="control-label">{{ Lang::get('departamentos.nd_for_lb_fecha_cre_departamento') }}</label>
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="glyphicon glyphicon-calendar"></i>
                                  </div>
                                  <input value='{{$departamentos->fecha_creacion}}' name="fecha_creacion" id="fecha_creacion" type="text" class="date-picker form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
                               </div><!-- div que cierra el bootstrap picker-->
                          </div>                                   
                      </div><!-- /div que cierra el panelbody-->
                    </div><!-- /div que cierra el boxprimary-->
                  </div> <!-- /cierra col-6 columna derecha -->
                </div> <!-- /row principal -->
                              
                <!-- aqui cree los inputs oculos que me permiten contener todos los arreglos necesarios para
                hacer las modificaciones a cada unod e los arreglos del actualizar que reprensentan los cambios hechos tanto a los directoes
                encargados como a las funciones y los ontegrantes del departamento-->
                <input id="integrantes_id" name="integrantes_id" type="text" class=" hide form-control" placeholder="" readonly value=""/>
                <input id="integrantes_anadidos_ids" name="integrantes_anadidos_ids" type="text" class=" hide form-control" placeholder="" readonly value=""/>
                <input id="integrantes_eliminados_ids" name="integrantes_eliminados_ids" type="text" class=" form-control" placeholder="" readonly value=""/>
                <input id="integrantes_cargo_anadidos" name="integrantes_cargo_anadidos" type="text" class=" hide form-control" placeholder="" readonly value=""/>
                <input id="integrantes_funciones_anadidos" name="integrantes_funciones_anadidos" type="text" class=" hide form-control" placeholder="" readonly value=""/>
                <input id="encargados_ids" name="encargados_ids" type="text" class=" hide form-control" placeholder="" readonly value=""/>
                <input id="encargados_eliminados_ids" name="encargados_eliminados_ids" type="text" class=" hide form-control" placeholder="" readonly value=""/>
                <input id="encargados_anadidos_ids" name="encargados_anadidos_ids" type="text" class=" hide form-control" placeholder="" readonly value=""/>
        
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
                          </div>
                          <!-- servidor-->     
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
                        </div> <!-- /row-->                             
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
                                  @foreach ($departamentos->integrantes as $integrante)
                                  <tr>
                                        <td> Cod. {{$integrante->id}} - {{$integrante->nombre}} {{$integrante->apellido}}</td>
                                        <td> {{$integrante->pivot->cargo}}</td>
                                        <td> {{$integrante->pivot->funcion}} <a id="encontrar-{{$integrante->id}}" class="hide" ></a></td>
                                 </tr>
                                  @endforeach

                                                    
                                 </tbody>
                                
                              </table>
                        </div>
                        <!-- cierra tabla que contiene los datos de quien es el servidor-->                                
                      </div> <!-- / cierre panel body-->
                  </div> <!-- / cierra el box priamay-->
                </div><!-- / cierra el col 12 completo-->
              </form>
            </section>
            <!-- contenido principal -->
          </aside>  
        </div>
        
        <!-- modal seleccionar Director  -->
        <div class="modal fade modal-seleccionarDirector" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="myModalLabel"> {{ Lang::get('departamentos.ab_md_tit_director') }} </h4>
              </div>
              <div class="modal-body">
                <table id="seleccionar_director" class="table table-striped display " cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>{{ Lang::get('departamentos.ab_md_th1_director') }}</th>
                      <th>{{ Lang::get('departamentos.ab_md_th2_director') }}</th>
                      <th>{{ Lang::get('departamentos.ab_md_th3_director') }}</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                        $lista_encargados=$departamentos->encargados()->get();
                      ?>
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
                            <?php
                            $encar=$lista_encargados->find($asistente->id);                                          
                            ?>
                                   
                            @if(isset($encar))
                              <button style="display:none" id="director-{{$asistente->id }}" data-id="{{ $asistente->id }}"  data-nombre="{{ $asistente->nombre.' '.$asistente->apellido }}" class="seleccionar-dir btn btn-success btn-sm" ><i class="fa fa-check"></i></button>
                              <button id="borrar_director-{{ $asistente->id }}" data-id="{{ $asistente->id }}"  class="borrar_fila_director btn btn-danger btn-sm" ><b>X</b></button>
                            @else
                              <button id="director-{{$asistente->id }}" data-id="{{ $asistente->id }}"  data-nombre="{{ $asistente->nombre.' '.$asistente->apellido }}" class="seleccionar-dir btn btn-success btn-sm" ><i class="fa fa-check"></i></button>
                              <button style="display:none" id="borrar_director-{{ $asistente->id }}" data-id="{{ $asistente->id }}"  class="borrar_fila_director btn btn-danger btn-sm" ><b>X</b></button>                                                  
                            @endif
                          </td>                                                 
                        </tr>
                      @endforeach                                           
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- modal seleccionar Director  -->
            
        <!-- modal seleccionar Servidor  -->
        <div id="modal_servidor" class="modal fade modal-seleccionarServidor" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">{{ Lang::get('departamentos.ab_md_tit_integrante') }} </h4>
                </div>
              <div class="modal-body"> 
                <table id="seleccionar_servidor" class="table table-striped display " cellspacing="0" width="100%">
                  <thead>                                                   
                    <tr>
                      <th>{{ Lang::get('departamentos.ab_md_th1_integrante') }}</th>
                      <th>{{ Lang::get('departamentos.ab_md_th2_integrante') }}</th>
                      <th>{{ Lang::get('departamentos.ab_md_th3_integrante') }}</th>
                      <th></th>
                    </tr>
                  </thead>
                    <tbody>
                      <?php
                      $lista_integrantes=$departamentos->integrantes()->get();
                      ?>
                      @foreach($asistentes_lista_integrantes as $asistente)    
                        <tr>
                          <td>
                            <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="{{ Lang::get('departamentos.nb_md_tit_cod_integrante') }}">{{ Lang::get('departamentos.nb_md_lb_cod_director') }}</label> {{ $asistente->id }}<br>
                          </td>                                                
                          <td>
                           <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="{{ Lang::get('departamentos.nb_md_tit_nom_integrante') }}"> <i class="fa fa-user"></i></label> {{ $asistente->nombre }} {{$asistente->apellido}}<br>                                                                                                     
                          </td>
                          <td>
                            <?php   
                            $id_linea_int= $asistente->grupo['linea_id'];
                            $linea_int= Linea::find($id_linea_int);
                            ?>
                            <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="{{ Lang::get('departamentos.nb_md_tit_nom_linea') }}"> <i class="fa fa-code-fork"></i></label> @if ($id_linea_int != "") {{ $linea_int->nombre }} @endif<br>                                                                                                     
                          </td>
                          <td> 
                            <?php
                            $encar=$lista_integrantes->find($asistente->id);
                            ?>                                                   
                            @if(isset($encar))
                                <button style="display:none" id="asistente-{{$asistente->id }}" data-id="{{ $asistente->id }}"  data-nombre="{{ $asistente->nombre.' '.$asistente->apellido }}" class="seleccionar btn btn-success btn-sm" ><i class="fa fa-check"></i></button>
                                <button id="borrar-{{ $asistente->id }}" data-id="{{ $asistente->id }}"  class="borrar-fila btn btn-danger btn-sm" ><b>X</b></button>
                            @else
                                <button id="asistente-{{$asistente->id }}" data-id="{{ $asistente->id }}"  data-nombre="{{ $asistente->nombre.' '.$asistente->apellido }}" class="seleccionar btn btn-success btn-sm" ><i class="fa fa-check"></i></button>
                                <button style="display:none" id="borrar-{{ $asistente->id }}" data-id="{{ $asistente->id }}"  class="borrar-fila btn btn-danger btn-sm" ><b>X</b></button>                                                  
                            @endif
                          </td>
                        </tr>                                          
                      @endforeach
                    </tbody>                                        
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- modal seleccionar Servidor -->


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
          $(document).ready(function() 
          {
              //arreglos para verificar los actuales integrantes, los nuevos y los a eliminar
              var integrantes_id=new Array();
              var nuevos_integrantes=new Array();
              var integrantes_a_eliminar=new Array();
              //fin de los arreglos para verificar los actuales integrantes, los nuevos y los a eliminar
              


              //arreglos para verificar las funciones de los integrantes actuales, las funciones agregadas y las funciones a eliminar
              var integrantes_funciones=new Array();
              var integrantes_funciones_eliminados=new Array();
              var integrantes_funciones_anadidos=new Array();
              // fin de los arreglos para verificar las funciones de los integrantes actuales, las funciones agregadas y las funciones a eliminar

              // arreglos para verificar el cargo de los integrantes actuales, las funciones agregadas y las funciones eliminadas
              var integrantes_cargo= new Array();
              var integrantes_cargo_eliminados=new Array();
              var integrantes_cargo_anadidos=new Array();


              var t=""; 
              var boton_borrar="";
              var boton_borrar_director= "";
              
           

              // fin de las variables del js

              //arreglos para verificar los directores ya seleccionados, o cambios para eliminar o crear
              var directores_seleccionados= new Array();
              var nuevos_directores_seleccionados= new Array();
              var directores_a_eliminar= new Array();
              // fin arreglos de directores

            

              // js que me construye el listado de los encargados de departamento ya seleccionados
              @foreach($departamentos->encargados as $encargado)
                 directores_seleccionados.push('{{$encargado->id}}');    
              @endforeach 
               $('#encargados_ids').val(directores_seleccionados);
              
              // fin del listado de los encargados de departamento

              // js que me construye el listado de los integrantes ya seleccionados en el departamento
              @foreach($departamentos->integrantes as $integrante)

              integrantes_id.push('{{$integrante->id}}');
              $('#integrantes_id').val(integrantes_id);

              @endforeach
            //fin del js que me construye el listado de los integrantes



            

        
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

                    /// js que me 
                     nuevos_integrantes.push($('#asistente-'+boton_borrar).attr('data-id'));
                     $("#integrantes_anadidos_ids").val(JSON.stringify(nuevos_integrantes));
                     
                     integrantes_cargo_anadidos.push($("#cargo_servidor").val());
                     $("#integrantes_cargo_anadidos").val(JSON.stringify(integrantes_cargo_anadidos));
                     

                     integrantes_funciones_anadidos.push($("#funciones_servidor").val());
                      $("#integrantes_funciones_anadidos").val(JSON.stringify(integrantes_funciones_anadidos));
                      

                      // este js me permite alterar o revisar si el integrante sus funcion
                      // han sido modificados o alterados al agregarlo a la tabla.

                        /// estos son los inputs de la informacion de ese integrante agrgado que se limpian para poder 
                        /// agregar mas integrantes al departamento.
                          $("#servidor").val("");
                          $("#cargo_servidor").val("");
                          $("#funciones_servidor").val("");
                 }


                    
           });
                    
                        // este codigo me permite borrar una fila de la tabla de integrantes departamento
                   $('.borrar-fila').on( 'click', function () {

                              var id_eliminar_integrante= $(this).attr('data-id');

                              
                
                      var tabla_servidor=  $('#lista_servidores_departamento').dataTable();
                      var target_row = $('#encontrar-'+id_eliminar_integrante).parent().parent().get(0); // this line did the trick
                      var aPos = tabla_servidor.fnGetPosition(target_row); 
                      tabla_servidor.fnDeleteRow(aPos);
                    
                    
                      
                              $(this).hide(),
                              $('#asistente-'+id_eliminar_integrante).show();

                              if(integrantes_id.indexOf(id_eliminar_integrante)!=-1)
                              {

                                   integrantes_a_eliminar.push(id_eliminar_integrante); 


                              }

                              else
                              { 
                                  var pos2=nuevos_integrantes.indexOf(id_eliminar_integrante);
                                  nuevos_integrantes.splice(pos2,1);
                                  
                                  integrantes_cargo_anadidos.splice(pos2,1);
                                  integrantes_funciones_anadidos.splice(pos2,1);



                              }

                            
                                $("#integrantes_eliminados_ids").val(integrantes_a_eliminar);
                                $("#integrantes_anadidos_ids").val(JSON.stringify(nuevos_integrantes));
                                $("#integrantes_cargo_anadidos").val(JSON.stringify(integrantes_cargo_anadidos));
                                $("#integrantes_funciones_anadidos").val(JSON.stringify(integrantes_funciones_anadidos));
                                $("#integrantes_cargo_eliminados").val(JSON.stringify(integrantes_cargo_eliminados));
                                $("#integrantes_funciones_eliminados").val(JSON.stringify(integrantes_funciones_eliminados));


                    }); 
                    
           
               
               //////ajax para cambiar la tabla que me asigna los directores de departamento


               $('.seleccionar-dir').click (function () {

                            

                            var id_director_seleccionado = $(this).attr("data-id");
                            var nombre_director = $(this).attr("data-nombre");
                          

                                boton_borrar_director=id_director_seleccionado;

                              $(this).hide();
                              $("#borrar_director-"+boton_borrar_director).show();

                          $('#tabla_director_departamento').append('<tr>'+
                            '<td>'+id_director_seleccionado+'</td>'+
                            '<td>'+nombre_director+'</td>'+
                            '<td class="text-center"><a id="encontrar-director-'+id_director_seleccionado+'" class="hide" ></a> </td>'+

                             '</tr>');
                              
                           if (directores_seleccionados.indexOf(id_director_seleccionado)!=-1)
                                  {
                                    
                                    var pos2=directores_a_eliminar.indexOf($(this).attr('data-id')); // obtengo la posicion de arreglo segun el data-id
                                    directores_a_eliminar.push(pos2,1);
                                  }
                                  else
                                  {
                                    
                                    nuevos_directores_seleccionados.push(id_director_seleccionado);
                                   
                                  }

                                  $("#encargados_eliminados_ids").val(directores_a_eliminar);

                                  $("#encargados_anadidos_ids").val(nuevos_directores_seleccionados);


                                  
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
              ////////////////////envio de datos de las funciones del director

                
                    
            //

                           $('.borrar_fila_director').click (function () {
                            
                              var id_eliminar_director= $(this).attr('data-id');


                              var td= $('#encontrar-director-'+id_eliminar_director).parent();
                              var tr=td.parent();
                              var pos=directores_seleccionados.indexOf($(this).attr('data-id')); // obtengo la posicion de arreglo segun el data-id
                                          
                                          $("#encargados_id").val(directores_seleccionados);
                                          tr.remove();
                              
                              $(this).hide(),
                              $('#director-'+id_eliminar_director).show();
                              
                                  if(directores_seleccionados.indexOf(id_eliminar_director)!=-1)
                                  {
                                    
                                    directores_a_eliminar.push(id_eliminar_director);

                                  }
                                  else
                                  {
                                    var pos2=nuevos_directores_seleccionados.indexOf($(this).attr('data-id')); // obtengo la posicion de arreglo segun el data-id
                                    nuevos_directores_seleccionados.splice(pos2,1);
                                  }

                                  $("#encargados_eliminados_ids").val(directores_a_eliminar);

                                  $("#encargados_anadidos_ids").val(nuevos_directores_seleccionados);

                                  alert(directores_a_eliminar);
                             
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
                        /////////// codigo que me permite evitar el envio de formulario presionando enter
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