@if(Auth::check())
@include('includes.lenguaje')
<!DOCTYPE html>
<?php
$band=false;
if(Auth::user()->asistente['id'] == $visitas->asignado_por)
{
  $band= true;
}

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Redil | Actualizar Visita</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        @include('includes.styles')
        <!-- datepicker.css -->
        <link href="/css/datepicker.css" rel="stylesheet" type="text/css" />
       <link href="/css/datepicker3.css" rel="stylesheet" type="text/css" />
        
        <!-- DATA TABLES -->
        <link href="/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- iCheck for checkboxes and radio inputs -->
        <link href="/css/iCheck/all.css" rel="stylesheet" type="text/css" />
       
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
        <!-- header logo: style can be found in header.less -->
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
            <!-- Content Header (Page header) -->
           <section class="content-header">
				
                </section>
				
                <!-- Contenido Principal -->
                 <section class="content">
                    <form action="../update/{{$visitas->id}}" method="post"role=-"form">
                
                     <div class="row">
                 		<!-- columna del boton guardar -->
	                    <div class="col-lg-12"style="margin-bottom: 10px;">
                            <div class=" box-header">
                              <div class="col-lg-4">
                                <button type="submit" class="btn btn-danger"> <i class="fa fa-save"></i> {{ Lang::get('lineas.al_bt_guardar') }}</button>
                                <a href="/visitas/lista/todas" class="btn bg-light-redil"> <i class="fa fa-undo"></i> {{ Lang::get('lineas.al_bt_volver') }}</a>
                                
                              </div>
                              <div class="col-lg-8">
                              <?php $status=Session::get('status'); ?>
                              @if($status=='ok_update')
                              <div class="alert alert-success col-lg-12 desvanecer" style="padding-bottom:5px; padding-top:5px; margin-bottom: -5px" >
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              Ha modificado exitosamente la visita a {{$visitas->asistente->nombre}} {{$visitas->asistente->apellido}}
                              </div>
                              @endif
                            </div>
                            </div>
                        </div>
                        <!-- /columna del boton guardar -->
                        
                        <div class="col-lg-12">
                        	<div class="box box-primary">
                            	<div class="panel-heading">
                                	<h2 class="modal-title"> Información programación visita</h2>     
                                </div>
                                <div class="panel-body">
                                	<div  class="col-lg-6">
                                    	<div  class="form-group">
                                        <!-- boton que me permite escoger el asistente-->
                                           
                                            <label id="grupo-ppal">Visitado</label>
                                            <div @if (!$band) class="hide" @endif align="right" style="padding-bottom:10px;">
                                                <button class="btn btn-primary btn-sm " data-toggle="modal" data-target="#grupop">
                                                    <i class="fa fa-plus" style="margin-right:5px;"> </i> 
                                                    Elegir Asistente 
                                                </button> 
                                            </div>
                                            <div class="form-group">
                                            <input id="nombre_asistente" name="nombre_asistente" type="text" class="form-control" placeholder="Nombre Asistente..." readonly value="{{$visitas->asistente->nombre}}  {{$visitas->asistente->apellido}}"/></div>
                                             
                                             <h4 class="modal-title"> lider que realizara la visita</h4> 
                                            <div class="form-group">                                         
                                                        <table id="tabla_encargado_visita" class="table table-striped display">
                                                                 <thead>
                                                                        <th style="width: 10px"> {{ Lang::get('lineas.ln_th_tabla_añadir_id') }}</th>
                                                                   
                                                                        <th>{{ Lang::get('lineas.ln_th_mini_tabla_añadir_lider') }}</th>
                                                                    
                                                        </thead>
                                                        <BODY>
                                                         
                                                            <?php
                                                              $asis=Asistente::find($visitas->asistente_id);
                                                              $grupo=$asis->grupo;
                                                             ?>

                                                             
                                                            @foreach($grupo->encargados as $encargado)
                                                             <tr>
                                                                <td>
                                                                  {{$encargado->id}}

                                                                </td>

                                                                <td>
                                                                  {{$encargado->nombre}}  {{$encargado->apellido}}
                                                                </td>
                                                            </tr>  
                                                            @endforeach
                                                        </BODY>
                                                       
                                                            
                                                        </table>
                                          
                                                    
                                            </div><!-- el lider debe ser puesto automatiamente  al escoger el asistente a quien se realizara la visita-->                         
                                            <!-- aqui cierra el  button que me permite escoger el asistente-->
                                                                                            
                                            <!-- opcion para escoger tipo de visita-->
                                            <div class="form-group">   
                         					              <label>Tipo de Visita</label>
                                               <select @if(!$band)disabled @endif id="tipo_visita" name="tipo_visita" class="form-control">
                                                        <option value="0" @if($visitas->tipo=="0") selected @endif>Telefonica</option>
                                                        <option value="1" @if($visitas->tipo=="1") selected @endif>Presencial</option>
                                                   
                       							          </select>
                                            </div>
                                            <!-- div que cierra el select de tipo de visita-->

                                            <!-- div que arranca el estado de la visita-->
                                            <div class="form-group">   
                         					   <label>Estado de Visita</label>	
                                               <select @if(!$band) disabled @endif id="estado" name="estado" class="form-control">
                                                    <option value="0" @if($visitas->estado=="0") selected @endif>Programada</option>
                                                    <option value="1" @if($visitas->estado=="1") selected @endif>Realizada</option>
                                                    <option value="2" @if($visitas->estado=="2") selected @endif>No Realizada</option>   
                       							          </select>
                                            </div>
                                            <!-- div que cierra el select de estado visita-->

                                            <!-- datepicker boostrap-->                                        
                                        	<label for="datepicker" class="control-label">Fecha limite de visita:</label>
                                            <div class="input-group">
                                            		
                                           		<div class="input-group-addon">
                                        	 		<i class="glyphicon glyphicon-calendar"></i>
                                           		</div>
                                   			    <input @if(!$band) disabled @endif  id="fecha_limite" name="fecha_limite" type="text" class="date-picker form-control" value="{{$visitas->fecha_limite}}" />
                             		       </div><!-- div que cierra el bootstrap date picker-->
                                           
                                            <!-- datepicker boostrap-->                                        
                                        	<label title="aqui debes  poner la fecha en la cual fue realizada la visita" for="datepicker" class="control-label">Fecha de Visita:</label>
                                            <div class="input-group">
                                           		<div class="input-group-addon">
                                        	 	    <i class="glyphicon glyphicon-calendar"></i>
                                           		</div>
                                   			    <input  value="{{$visitas->fecha}}" id="fecha_visita" name="fecha_visita" type="text" class="date-picker form-control" />
                             		       </div><!-- div que cierra el bootstrap date picker-->                 
                                           
                                        </div> <!-- div que cierra el formulario de visita-->
                                                                      
                                    </div> <!-- div que cierra la col-lg6 del lado derecho del panel completo-->  
                               
                                    <div class="col-lg-6">  <!-- div que arranca la segunda col, la del lado izquierdo del formulario visitas-->  
                                        <div class="form-group"><!-- formgroup de toda la col6-->

                                            <div class="form-group"> <!-- form group del motivo visita-->
                                                <label title=" si tiene el motivo de visita antes de realizar la misma describirlo aca, de lo contrario conforme realice esa visita describir el motivo.">Motivo de la visita</label>
                                                <textarea id="motivo" name="motivo" class="form-control" rows="5"  maxlength="500" placeholder="">{{$visitas->motivo}}</textarea>
                                            </div>
                                            <!-- time Picker  -->
                                            <div class="bootstrap-timepicker">
                                                  
                                                <label>Hora de Visita:</label>
                                                   
                                                <div class="input-group">
                                                    <div class="input-group-addon"> 
                                                        <i class="fa fa-clock-o"></i>
                                                    </div>
                                                    <input id="hora" name="hora" type="text" value="{{$visitas->hora}}"class="form-control timepicker"/>
                                                </div><!-- div que cierra el input donde aparece la hora-->

                                            </div> <!-- div que cierrra el bootstrap picker-->
                                            <div class="form-group">
                                                  <label title="si tiene algun tipo de observacion como por ejemplo, oración especifica, citas con lideres o pastores, cambio de direccion u otro evento describir en este campo.">Observaciones</label>
                                                  <textarea  id="observacion" name="observacion" class="form-control" rows="5"  maxlength="500" placeholder="">{{$visitas->observacion}}</textarea>
                                            </div>
                                        </div><!-- div que cierra el fomulario del lado derecho-->
                                    </div>   <!-- div que cierra la seunda col6-->
                     		    </div><!-- div que cierra el panel body-->
                            <input id="integrantes_id" name="integrantes_id" type="text" class="hide form-control" placeholder="" readonly value="{{$visitas->asistente_id}}"/>
                             <input id="asignado_por" name="asignado_por" type="text" class="hide form-control" placeholder="" readonly value="{{$visitas->asignado_por}}"/>
                            
                           </div> <!-- div que cierra box box primary-->
                        </div> <!-- div que cierra la col-lg12 principal-->
                    </div> <!-- div que cierra toda la row numero 1 de informacion principal del grupo-->

           <!-- columna del boton guardar -->
          
        </form>                                        			 	 
     </section><!-- /.content -->
                
                
<!-- modal de ejemplo para agregar asistente qien se programo la visita -->
				<div id"modal_asistente_visita" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="grupop">
                     <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Seleccione el grupo</h4>
                            </div>
                        <div class="modal-body">
                            <table id="tabla_asistente_visita" class="table table-striped display stripe" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Grupo</th>
                                                <th>Lider</th>
                                                <th>Añadir</th>
                                          </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($asistentes as $asistente)    
                                            <?php $iglesias= $asistente->iglesiaEncargada()->get();
                                                  $iglesia=$iglesias->find("1"); ?>
                                              @if(!isset($iglesia))
                                            <tr>
                                                <td>
                                                    <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Codigo del grupo">Cod</label> {{$asistente->grupo['id']}} <br>
                                                    <label class="label arrowed-right label-info" data-toggle="tooltip"></label> {{$asistente->grupo['nombre']}} 
                                                                  
                                                </td>
                                                <td>
                                                    <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Codigo">Cod</label> {{ $asistente->id }}<br>
                                                    
                                                    @if ($asistente->tipoAsistente['id']==5)
                                                      <label class="label arrowed-right" style="background-color: purple;" data-toggle="tooltip" data-placement="top" title="{{ $asistente->tipoAsistente['nombre'] }}"> <i class="fa fa-book"></i> {{ $asistente->tipoAsistente['nombre'] }}</label>
                                                   @elseif($asistente->tipoAsistente['id']==3)
                                                       <label class="label arrowed-right bg-blue" data-toggle="tooltip" data-placement="top" title="{{ $asistente->tipoAsistente['nombre'] }}"><i class="fa fa-child"></i> {{ $asistente->tipoAsistente['nombre'] }}</label>
                                                           
                                                   @elseif($asistente->tipoAsistente['id']==4)
                                                       <label class="label arrowed-right bg-orange" data-toggle="tooltip" data-placement="top" title="{{ $asistente->tipoAsistente['nombre'] }}"><i class="fa fa-star-o"></i> {{ $asistente->tipoAsistente['nombre'] }}</label> 
                                                   @elseif($asistente->tipoAsistente['id']==2)
                                                       <label class="label arrowed-right bg-aqua" data-toggle="tooltip" data-placement="top" title="{{ $asistente->tipoAsistente['nombre'] }}"><i class="fa fa-group"></i></label> 

                                                   @elseif($asistente->tipoAsistente['id']==1)
                                                       <label class="label arrowed-right bg-teal" data-toggle="tooltip" data-placement="top" title="{{ $asistente->tipoAsistente['nombre'] }}"><i class="fa fa-heart"></i> {{ $asistente->tipoAsistente['nombre'] }}</label> 
                                                   @endif 
                                                  {{ $asistente->nombre." ".$asistente->apellido }}
                                                </td>
                                                <td>
                                                  <?php $grupo= Grupo::find($asistente->grupo_id);?>


                                                  <button  id="{{$asistente->id}}"  data-nombre="{{ $asistente->nombre.' '.$asistente->apellido }}"  class="seleccionar btn btn-success btn-sm"  
                                                    data-lider="@if(isset($grupo))  

                                                    <tbody>
                                                    @foreach($grupo->encargados as $encargado)
                                            
                                                    <tr>  
                                                        <td> {{$encargado->id}}</td>
                                                        <td> {{$encargado->nombre.' '.$encargado->apellido}}</td>
                                                    </tr>
                                                    @endforeach
                                                    </tbody> @endif "><i class="fa fa-check"></i></button>
                                              </td>
                                            </tr>  
                                            @endif  
                                               @endforeach
                                  
                                        </tbody>
                                        
                                    </table>

                        </div>
                        
                    </div>
                </div>
            </div>
                     
                          <!-- aqui inicia el modal que me permite agregar el o los lideres del grupo actual.-->
                


            </aside><!-- /.right-
            side -->
        <!-- ./wrapper -->


        @include('includes.scripts')
        <!-- InputMask -->
    <script src="/js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="/js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
    <script src="/js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
       
    <!-- js data tables-->
    <script src="http://cdn.datatables.net/1.10.0/js/jquery.dataTables.js" type="text/javascript"></script>
    <script src="/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript"src="/js/plugins/timepicker/bootstrap-timepicker.min.js" ></script>
    
    <script src="/js/bootstrap-datepicker.js"></script>
    <script src="/js/locales/bootstrap-datepicker.es.js"></script>
        <!-- page script -->
                <script type="text/javascript">
                    
                    $(document).ready(function() {
                        $('#tabla_asistente_visita').dataTable( {
                             
                  } );
           } );
        </script> 
        <!-- page script -->
                <script type="text/javascript">
                    
                    $(document).ready(function() {
                        $('#lider').dataTable( {
                             
                  } );
           } );
        </script> 
        <!-- bootstrap time picker -->
    
        
      

  <!-- Page script -->
   <script type="text/javascript">
             
              $('.seleccionar').click (function ()
               {
                  var tr= $(this).attr('data-lider')

                  var id_seleccionado = $(this).attr("id");
                
                  var nombre = $(this).attr("data-nombre");

                  $('#nombre_asistente').val('Cod:'+id_seleccionado+' '+'-'+' '+nombre); 
                  
                  $('#tabla_encargado_visita tbody').remove();
                  
                  $('#tabla_encargado_visita').append(tr); 

                  $('#integrantes_id').val(id_seleccionado);
                  
                  
                  

                 });

</script>
    <script type="text/javascript"> 
  $(function() {
                //Datemask dd/mm/yyyy
                $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
                //Datemask2 mm/dd/yyyy
                $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                //Money Euro
                $("[data-mask]").inputmask();
/*date picker
$('#sandbox-container input').datepicker({
    startView: 1,
    minViewMode: 1,
    todayBtn: true,
    language: "es",
    calendarWeeks: true
});*/
                //Date range picker$
                $('#fecha_limite').datepicker({
					language: 'es',
          format: 'dd/mm/yyyy'
				});
                
				//Date range picker$
                $('#fecha_visita').datepicker({
					language: 'es',
          format: 'dd/mm/yyyy'
				});
                
                //Date range as a button
                

                //iCheck for checkbox and radio inputs
                $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                    checkboxClass: 'icheckbox_minimal',
                    radioClass: 'iradio_minimal'
                });
                //Red color scheme for iCheck
                $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                    checkboxClass: 'icheckbox_minimal-red',
                    radioClass: 'iradio_minimal-red'
                });
                //Flat red color scheme for iCheck
                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                    checkboxClass: 'icheckbox_flat-red',
                    radioClass: 'iradio_flat-red'
                });

                
                //Timepicker
                $(".timepicker").timepicker({
                    showInputs: false
                });
            });

////accion del boton integrantes departamento  
              
			
        </script>
    </body>
</html>

@endif