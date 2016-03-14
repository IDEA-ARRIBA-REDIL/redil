@if(Auth::check())
<!DOCTYPE html>
@include('includes.lenguaje')
<html>
    <head>
        <meta charset="UTF-8">
        <title>Redil | Configuración Iglesia</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        @include('includes.styles')
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- datepicker.css -->
        <link href="css/datepicker.css" rel="stylesheet" type="text/css" />
        <link href="css/datepicker3.css" rel="stylesheet" type="text/css" />
         <!-- DATA TABLES -->
        <link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
         
        <link href="http://cdn.datatables.net/1.10.0/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
        
        <!-- JCrop -->
        <link href="/css/jcrop/jquery.Jcrop.min.css" rel="stylesheet"/>
        <!--style necesario para usar el recoret de la imagen -->
        <style type="text/css">
           .jcrop-keymgr {opacity: 0;}
           .jcrop-holder { margin: 0 auto;}
           #panel-imagen { padding-top: 10px; padding-bottom: 10px; overflow:auto;}
           #footer-imagen { margin-top: 0px; padding: 10px;}
           #header-imagen {padding: 10px;}
           @media(max-height: :450px) {
              .panel-image{
                width: 300px!important;
              }
            }

            @media(max-height: :320px) {
              .panel-image{
                width: 280px!important;
              }
            }
        </style>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
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
                	
                    	<h1>
                        DATOS DE LA IGLESIA
                        <small> Aqui podrá editar la información de la Iglesia</small></h1>
                        
                 </section>
                 <!-- /contendio cabezote -->
                 

             <!-- contenido principal -->
              <section class="content">
              		<form  action="iglesia/update" role="form" id="formulario" method="post" enctype="multipart/form-data">
                	
              		<!-- row para el formulario -->
                    <div class="row">
                     
                      	<!-- columna del boton guardar -->
                        <div class="col-md-12">
                            <div class=" box-header">
                                  <button type="submit" class="btn btn-danger"> <i class="fa fa-save"></i>  Guardar</button>
                            </div>
                            <br>
                        </div>
                         <!-- /columna del boton guardar -->
                    	<!-- columna informacion basica -->
                        <div class="col-md-12">
                            <div class="box box-primary">
                            	<div class="panel-heading">
                            		<h3 class="box-title">Información Básica</h3>
                                </div>
                                <div class="panel-body">
                                      <div class="col-md-6">

                                          <!-- subir foto -->
                                          <div class="form-group">
                                            <label for="exampleInputFile">Subir foto</label><br>
                                            <?php
                                              $fechaSegundos = time(); 
                                              $strNoCache = "?nocache=$fechaSegundos"; 
                                            ?>
                                            <div style="padding-left: 8px; padding-right: 8px" class="col-lg-3 col-md-12 col-xs-12 col-sm-2">
                                              <img style="padding-left: 4px; padding-right: 4px; margin-bottom: 10px" id="foto-cortada" src="/img/iglesia/logo-iglesia-1.jpg" align="left" class="img-circle col-lg-12 col-md-6 col-sm-11 col-xs-5 col-sm-offset-0 col-md-offset-3 col-xs-offset-4 col-lg-offset-0"   />
                                            </div>
                                            
                                            <div class="col-lg-9 col-md-12 col-xs-12 col-sm-10">
                                              <div id="div-nueva-foto" class="input-group" style="display:none">
                                                <div class="input-group-btn">
                                                    <button id="limpiar-foto" type="button" class="btn btn-danger">Limpiar</button>
                                                </div><!-- /btn-group -->                     
                                                <input class="form-control" type="text" id="foto-hide" name="foto-hide" readonly />
                                              </div><br>
                                              <input class="" type="file" id="foto" name="foto" accept="image/*">
                                              <p class="help-block">El ancho y alto en pixeles debe ser minimo 215px</p>
                                            </div>
                                          </div><br><br>
                                          <div id="saltos-linea"><br><br><br></div>
                                          <!-- /subir foto -->

                                          <!-- Nombre -->
                                          <div class="form-group">
                                             <label>Nombre</label>
                                             <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Iglesia Misión..." value="{{$iglesia->nombre}}" required/>
                                          </div>
                                          <!-- /Nombre -->
<!-- Direccion -->
                                       <div class="form-group">
                                          <label>Dirección</label>
                                          <textarea class="form-control" id="direccion" name="direccion"  rows="3"  maxlength="200"  placeholder="Escribe tu dirección y barrio ...">{{ $iglesia->direccion }}</textarea>
                                       </div>
                                     <!-- /Direccion -->
                                     
                                         <!-- Ciudad -->
                                          <div class="form-group">
                                             <label>Ciudad</label>
                                             <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Ciudad..." value="{{$iglesia->ciudad}}"/>
                                          </div>
                                          <!-- /Ciudad -->
 
                                  </div> <!-- div que cierra el col6 de la izquierda-->
                                   
                                      <div class="col-md-6">
                                           
                                       
                                            <div class="form-group">
                                                <label>Fecha de creación de la Iglesia:</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                     <?php $fecha=date_create($iglesia->fecha_apertura); ?>
                                                  <input id="fecha" name="fecha" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy"  value="{{ date_format($fecha, 'd-m-Y') }}" data-mask required/>
                                                </div>
                                            </div>
                                            <!-- /.fin Fecha de nacimiento -->
                                            <!-- Telefono 1 -->
                                    <div class="form-group">
                                        <label> Teléfono fijo</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <input type="text" id="telefono1" name="telefono1" class="form-control" data-inputmask='"mask": "999-9999"' value="{{$iglesia->telefono1}}" data-mask/>
                                        </div>
                                    </div>
                                    <!-- /Telefono 1 -->
                                    <!-- Telefono 2 -->
                                    <div class="form-group">
                                        <label> Otro Teléfono</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-mobile-phone"></i>
                                            </div>
                                            <input type="text" id="telefono2" name="telefono2" class="form-control" data-inputmask='"mask": "999-9999"' value="{{$iglesia->telefono2}}" data-mask/>
                                        </div>
                                    </div>
                                    <!-- /Telefono Movil #1 -->
                                            <!-- Departamento/Región/Ciudad -->
                                          <div class="form-group">
                                             <label>Departamento/Región/Estado/Provincia</label>
                                             <input type="text" id="departamento" name="departamento" class="form-control" placeholder="Departamento/Estado/Region/Provincia..." value="{{$iglesia->departamento}}"/>
                                          </div>
                                          <!-- Departamento/Región/Ciudad -->
<!-- Direccion -->

<div class="form-group">
                                             <label>Pais</label>
                                             <input type="text" id="pais" name="pais" class="form-control" placeholder="Escribe el Pais de tu Iglesia..." value="{{$iglesia->pais}}"/>
                                        </div>
                                      </div>
                                 </div> <!-- /box-body -->
                            </div>
                        </div>
                        <!-- /columna informacion basica -->

                   <input id="encargados_ids" name="encargados_ids" type="text" class="hide form-control" placeholder="" readonly value=""/>    

                        <!-- columna informacion Medica -->
                        <div class="col-md-6">
                            <div class="box box-primary">
                            	<div class="panel-heading">
                            		<h3 class="box-title">Información Secundaria</h3>
                                </div>
                                <div class="panel-body">
                                  <div class="form-group">
                                     <label>Cita Rhema</label>
                                     <input type="text" id="rhema" name="rhema" class="form-control" value="{{$iglesia->rhema}}" placeholder="Proverbios 27:23"/>
                                  </div>
                                  <!-- Indicaciones medicas -->
                                  <div class="form-group">
                                      <label>Texto Rhema</label>
                                      <textarea class="form-control" id="texto-rhema" name="texto-rhema" rows="5"  maxlength="500" placeholder="Sé diligente en conocer el estado de tus ovejas,
Y mira con cuidado por tus rebaños...">{{ $iglesia->texto_rhema }}</textarea>
                                  </div>
                                  <!-- /Indicaciones medicas -->
                                  <!-- Limitaciones -->
                                   <div class="form-group">
                                      <label>Metas </label>
                                      <textarea class="form-control" id="metas" name="metas" rows="7"  maxlength="500" placeholder="alcanzar 100 almas">{{ $iglesia->metas }}</textarea>
                                   </div>
                                 <!-- /Limitaciones -->


                                    
                                </div>
                            </div>
                        </div>
                        <!-- /columna informacion Medica -->
                        
                        <!-- columna Pastores Principales-->
                        <div class="col-md-6">
                                <div class="box box-primary">
                                	<div class="panel-heading">
                                		<h3 class="box-title">Pastores Principales</h3>
                                    </div>
                                    
                                    <div class="panel-body">

                                            
                                           <div class="panel panel-default">
                                           		<div class="form-group">
                                         		   <div class="panel-body">
                              
                              						 <div class="form-group">
                                                         <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#pastores"> <i class="fa fa-plus" style="margin-right:5px;"> </i> 
                                                             Añadir Pastor(es) </button> </div>     				
                                                         <div>
                                                            <table id="tabla_pastores_seleccionados"class="table table-condensed table-hover">
                                                                 <thead>
                                                                    <th style="width: 10px">id</th>
                                                                   
                                                                    <th>Pastor(es) Seleccionados</th>
                                                                    
                                                                </thead>
                                                                <tbody>
                                                                  @foreach ($pastores_principales as $pastor)
                                                                  <tr>
                                                                      <td>
                                                                        {{$pastor->id}}
                                                                      </td>
                                                                      <td>
                                                                      {{$pastor->nombre}}  {{$pastor->apellido}} 
                                                                    </td>
                                                                    <td class="text-center"> <a id="encontrar-pastor-{{$pastor->id}}" class="hide"> </a>

                                                                    </td>
                                                                  </tr>
                                                                      @endforeach
                                                                </tbody>    
                                                              
                                                        </table>
                                                     </div>
                                               
                     			                </div>
           					            </div>   
       				             </div>
                                     </div>

                                </div>
                     </div>
                        
                        <!-- /columna pasos culminados -->
                        
                        
                        
                         <!-- columna del boton guardar -->
                        <div class="col-md-12">
                            <div class=" box-header">
                                  <button type="submit" class="btn btn-danger"> <i class="fa fa-save"></i>  Guardar</button>
                            </div>
                        </div>
                         <!-- /columna del boton guardar -->
                        
                       <input id="pastores_id" name="servidores_id" type="text" class=" hide form-control" placeholder="" readonly value=""/>
                        <input id="pastores_actuales_id" name="pastores_actuales_id" type="text" class=" hide form-control" placeholder="" readonly value=""/>
                        <input id="pastores_eliminados_id" name="pastores_eliminados_id" type="text" class=" hide form-control" placeholder="" readonly value=""/>
                        <input id="pastores_actualizados_id" name="pastores_actualizados_id" type="text" class="  hide form-control" placeholder="" readonly value=""/>
                   </div>  
                    <!-- /row para el formulario -->  
                   </form>
              </section>
              <!-- contenido principal -->
            </aside>  


<!-- aqui inicia el modal que me permite agregar el o los lideres del grupo actual.-->
                
<!-- modal  de ejemplo para añadir al pastor o pastores de la iglesia -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="pastores">
                     <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Seleccione el/los pastor(es)</h4>
                            </div>
                        <div class="modal-body">
                            <table id="lider" class="table  table-striped display stripe" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Grupo</th>
                                                <th>Pastor</th>		                              					
                                                <th>Añadir</th>
                                           </tr>
                                        </thead>
                                        
                                        <tbody>
                                                 @foreach($pastores as $pastor)
                                            <tr>
                                                
                                                <td>
                                                    <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Codigo del grupo">Cod</label> {{$pastor->grupo['id']}} <br>
                                                    
                                                </td>
                                                <td>
                                                    <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Codigo del lider">Cod</label> {{$pastor->id}} <br>
                                                    <label style="background:purple;" class="label arrowed-right" data-toggle="tooltip" data-placement="top" title="Pastor"> <i class="fa fa-book"></i></label> {{$pastor->nombre}} {{$pastor->apellido}} <br>
                                                           
                                                </td>
                                                
                                                 <td>   <?php $pastor_aux=($iglesia->pastoresEncargados->find($pastor->id)) ?>
                                                        @if ( $pastor_aux != "")
                                                        <button  style="display:none"id="pastor-{{$pastor->id }}"  data-id="{{ $pastor->id }}" data-nombre="{{ $pastor->nombre }}  {{ $pastor->apellido }} " class="añadir-pastor btn btn-success btn-sm" ><i class="fa fa-check"></i></button>
                                                       
                                                        <button id="borrar-{{ $pastor->id }}" data-id="{{ $pastor->id }}"  class="borrar-pastor btn btn-danger btn-sm" ><b>X</b></button>
                                                       @else 
                                                         <button id="pastor-{{$pastor->id }}"  data-id="{{ $pastor->id }}" data-nombre="{{ $pastor->nombre }}  {{ $pastor->apellido }} " class="añadir-pastor btn btn-success btn-sm" ><i class="fa fa-check"></i></button>
                                                       
                                                        <button style="display:none" id="borrar-{{ $pastor->id }}" data-id="{{ $pastor->id }}"  class="borrar-pastor btn btn-danger btn-sm" ><b>X</b></button>   
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
                   <!-- cierre modal que me permite scoger el pastor o pastores de la ilgesia-->

            <!-- Modal -->
            <div id="modal_recorta_foto" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                     <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header" id="header-imagen">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Recorte la Imagen</h4>
                            </div>
                        <div class="modal-body text-center" id="panel-imagen">
                            <img src="/img/ajax-loader1.gif" id="cargando" />
                        </div>
                        <div class="modal-footer" id="footer-imagen">
                          <button id="90" type="button" class="rotar btn btn-primary" title="" data-original-title="Rotar a la izquierda."><i class="fa fa-undo"></i></button>
                          <button id="-90" type="button" class="rotar btn btn-primary" title="" data-original-title="Rotar a la derecha."><i class="fa fa-repeat"></i></button>
                          
                          <button id="recortar" type="button" class="btn btn-primary">Recortar Imágen</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>        
           
         @include('includes.scripts')

        <!-- InputMask -->
        <script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <!-- date-range-picker -->
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- bootstrap color picker -->
        <script src="js/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
        <!-- bootstrap time picker -->
        <script src="js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
        
        <!-- bootstra datepicker-->
        <script src="js/bootstrap-datepicker.js"></script>
        <script src="js/locales/bootstrap-datepicker.es.js"></script>

        <!-- js data tables-->
          <script src="{{ Lang::get('general.url-datatables') }}" type="text/javascript"></script>
        <script src="/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

        <!-- jcrop esta es para la edicion de imagenes -->
        <script type="text/javascript" src="/js/plugins/jcrop/jquery.Jcrop.min.js"></script>

        <script type="text/javascript">

            @include('includes.procesa-foto-js')

            $('#lider').dataTable( {
                               
            });
          });
        </script>
        <!-- Page script -->

        <script type="text/javascript">
            $(function() {
                //Datemask dd/mm/yyyy
                $("#fecha").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
               
                
                var pastores_encargados_actuales=new Array();// Arreglo de los pastores encargados actuales
                
                @foreach ($pastores_principales as $pastor)
                        pastores_encargados_actuales.push('{{$pastor->id}}');
                        $('#pastores_actuales_id').val(pastores_encargados_actuales);
                @endforeach

                var pastores_encargados_actualizados=new Array();// Arreglo de los pastores encargados actualizados
                var pastores_encargados_eliminados=new Array();// Arreglo de los pastores encargados eliminados
                  
                                
                

                var t=""; 
                var boton_borrar="";
                var boton_borrar_pastor="";

                $('.borrar-pastor').click (function () {

                                id_pastor=$(this).attr("data-id");
                                var td = $("#encontrar-pastor-"+id_pastor).parent();
                                var tr = td.parent();
                                var pos=pastores_encargados_actuales.indexOf($(this).attr('data-id')); // obtengo la posicion de arreglo segun el data-id
                                pastores_encargados_actuales.splice(pos,1);
                                tr.remove();

                                pastores_encargados_eliminados.push(id_pastor);
                                    $('#pastores_eliminados_id').val(pastores_encargados_eliminados);
                                  

                              // Este codigo Habilita el boton de seleccionar de la tabla tabla_lideres_seleccionados
                               $(this).hide();
                               $("#pastor-"+id_pastor).show();

                            }); 

                $('.añadir-pastor').click (function()
                {   
                    var id_pastor_seleccionado= $(this).attr('data-id');
                    var nombre_pastor= $(this).attr('data-nombre');
                    
                    pastores_encargados_actualizados.push($(this).attr('data-id'));
                    boton_borrar_pastor=id_pastor_seleccionado;
                    $(this).hide();
                    $("#borrar-"+boton_borrar_pastor).show();

                     $('#tabla_pastores_seleccionados').append('<tr>'+
                            '<td>'+id_pastor_seleccionado+'</td>'+
                            '<td>'+nombre_pastor+'</td>'+
                            '<td class="text-center"><a id="encontrar-pastor-'+id_pastor_seleccionado+'" class="hide" ></a> </td>'+

                             '</tr>');
                     if (pastores_encargados_actualizados.indexOf(id_pastor_seleccionado)!=-1)
                     {

                      $('#pastores_actualizados_id').val(pastores_encargados_actualizados);
                     }

                    /* else {
                        pastores_encargados_actualizados.push(($this).attr('data-id'));
                        $('#pastores_actualizados_id').val(id_pastor_seleccionado);
                      }*/
                  });


                //Date range picker$
                $('#fecha').datepicker({
                    language: 'es',
                    format: 'dd/mm/yyyy'
                });


            });
        </script>

    </body>
</html>
@endif