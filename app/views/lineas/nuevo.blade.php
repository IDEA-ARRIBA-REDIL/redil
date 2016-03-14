@if(Auth::check())
@include('includes.lenguaje')
<!DOCTYPE html>
<!-- Vista creada por: Darwin Castaño
     Fecha creacíón: 15-07-2014
     Fecha Ultima modificación: 24-07-2014 11:19pm
     funcion vista: esta es la vista que contiene el formulario que nos permite crear una nueva linea
     software REDIL version 1.0
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Redil | {{ Lang::get('lineas.nl_title') }}</title>
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
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        {{ Lang::get('lineas.nl_header') }}
                        <small>{{Lang::get('lineas.nl_subtitulo')}}</small>
                    </h1>
                    <br>
                </section>

                <!-- Contenido Principal -->    
                <section class="content">
                    <form action="new" method="post" role=-"form">
                
                    <div class="row">
                 		<!-- columna del boton guardar -->
                        <div class="col-lg-12"style="margin-bottom: 10px;">
                            <div class=" box-header">
                                <div class="col-lg-4">
                                   <button type="submit" class="btn btn-danger"> <i class="fa fa-save"></i> {{ Lang::get('lineas.al_bt_guardar') }}</button>
                                   <a href="/lineas/lista" class="btn bg-light-redil"> <i class="fa fa-undo"></i> {{ Lang::get('lineas.al_bt_volver') }}</a>
                                   <br><br>
                                </div>
                                <div class="col-lg-8">
                                    <?php $status=Session::get('status'); ?>
                                    @if($status=='ok_update')
                                    <div class="alert alert-success col-lg-12 desvanecer" style="padding-bottom:5px; padding-top:5px; margin-bottom: -5px" >
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    La línea fue creada satisfactoriamente {{Session::get('linea')}}
                                    @endif
                                    </div>
                               </div>
                           </div>    
                        </div>                        
                        <!-- /columna del boton guardar -->

                        <div class="col-lg-12">
                        	<div class="panel">
                            	<div class="panel-heading"> <!-- aqui arranca en panel heading del formulario -->
                                	<h4 class="modal-title"> Información principal</h4>     
                                </div><!-- aqui termina en panel heading del formulario -->

                                <div class="panel-body"> <!-- aqui arranca en panel body del formulario -->
                                	<div class="col-lg-6">
                                    	<div class="form-group"> <!-- div dodnde se pone el nombre de la linea a crear del formulario -->
                                            <label>{{ Lang::get('lineas.ln_lb_nombre_linea') }}</label>
                                            <input type="text" id="nombre" name="nombre" class="form-control" placeholder="{{Lang::get('lineas.ln_ph_nombre') }}"/>
                                        </div><!-- cierra div dodnde se pone el nombre de la linea a crear del formulario -->
                                                       
                                        <div class="form-group">
                                            <label>{{ Lang::get('lineas.ln_lb_descripcion') }}</label>
                                            <textarea id="descripcion" name="descripcion" class="form-control" rows="3"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>{{ Lang::get('lineas.ln_lb_palabra_rhema') }}</label>
                                            <textarea id="rhema" name="rhema" class="form-control" rows="3" placeholder="{{ Lang::get('lineas.ln_ph_rhema') }}"></textarea>
                                        </div>
                                   </div>
            
                                   <div class="col-lg-6">
                              			<div class="form-group" align="right">
                                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_anadir_lider"> 
                                                <i class="fa fa-list" style="margin-right:5px;"> </i> 
                                                {{ Lang::get('lineas.ln_lb_añadir_lider') }}
                                            </button>      				
                                        </div>
                    
                                        <div class="form-group">                                         
                                            <table id="tabla_encargado_linea" class="table table-striped display">
                                                <thead>
                                                    <th style="width: 10px"> {{ Lang::get('lineas.ln_th_tabla_añadir_id') }}</th>
                                                    <th>{{ Lang::get('lineas.ln_th_mini_tabla_añadir_lider') }}</th>
                                                                    
                                                </thead>
                                                <tbody>

                                                </tbody>
                                                            
                                            </table>
                                        </div>              
                                   </div> <!-- div que cierra la col-lg6  del panel completo-->  
                                        
                   		        </div><!-- div que cierra el panel body-->
                            </div> <!-- div que cierra box box primary-->
                        </div> <!-- div que cierra la col-lg12 principal-->
                        
                        <!-- columna de los botones guardar y cancelar-->
                        <div class="col-md-12">
                            <div class=" box-header">
                                <button type="submit" class="btn btn-danger"><i class="fa fa-save"> </i>  {{ Lang::get('lineas.nl_bt_inf_guardar') }}</button>
                                <a href="/lineas/lista" class="btn bg-light-redil"> <i class="fa fa-undo"></i> {{ Lang::get('lineas.al_bt_volver') }}</a>
                            </div>
                            <br>
                        </div>
                        <!-- /columna de los botones guardar y cancelar -->
                        <input type="text" id="ids_encargados" name="ids_encargados" class="hide" />
                    </div>
                    </form>                                        			 	 
                </section><!-- /.content -->                
            </aside><!-- /.right-
            side -->
        </div><!-- ./wrapper -->
                
        <!-- modal  de ejemplo para añadir el lider -->
        <div id="modal_anadir_lider" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="lider1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">{{Lang::get('lineas.ln_md_titulo')}}</h4>
                    </div>
                    <div class="modal-body">
                        <table id="tabla_modal_lider" class="table  table-striped display stripe" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>{{Lang::get('lineas.ln_md_tb_lider')}}</th>
                                    <th>{{Lang::get('lineas.ln_md_tb_grupo')}}</th> 		                              					
                                    <th>{{Lang::get('lineas.ln_md_tb_añadir')}}</th>
                               </tr>
                            </thead>
                                    
                            <tbody>
                                @foreach ($asistentes as $asistente)
                                <tr>
                                    <td>
                                        <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Codigo del lider">{{Lang::get('lineas.ln_lb_md_codigo')}}</label> {{ $asistente->id }}<br>
                                         @if ($asistente->tipoAsistente['id']==5)
                                            <label class="label arrowed-right" style="background-color: purple;" data-toggle="tooltip" data-placement="top" title="{{ $asistente->tipoAsistente['nombre'] }}"> <i class="fa fa-book"></i></label> 
                                         @elseif($asistente->tipoAsistente['id']==3)

                                             <label class="label arrowed-right bg-blue" data-toggle="tooltip" data-placement="top" title="{{ $asistente->tipoAsistente['nombre'] }}"> 
                                         
                                             <i class="fa fa-child"></i></label> 
                                                 
                                         @elseif($asistente->tipoAsistente['id']==4)

                                             <label class="label arrowed-right bg-orange" data-toggle="tooltip" data-placement="top" title="{{ $asistente->tipoAsistente['nombre'] }}"> 
                                         
                                             <i class="fa fa-star-o"></i></label> 
                                         @elseif($asistente->tipoAsistente['id']==2)

                                             <label class="label arrowed-right bg-aqua" data-toggle="tooltip" data-placement="top" title="{{ $asistente->tipoAsistente['nombre'] }}"> 
                                         
                                             <i class="fa fa-group"></i></label> 
                                         @elseif($asistente->tipoAsistente['id']==1)

                                             <label class="label arrowed-right bg-teal" data-toggle="tooltip" data-placement="top" title="{{ $asistente->tipoAsistente['nombre'] }}"> 
                                         
                                             <i class="fa fa-heart"></i></label> 
                                         @endif     
                                         {{ $asistente->nombre." ".$asistente->apellido }}<br> 
                                    </td>
                                    <td>
                                        <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Codigo del grupo">{{Lang::get('lineas.ln_lb_md_codigo')}}</label>{{"  ".$asistente->grupo['id'] }}<br>
                                        <label class="label arrowed-right label-primary" data-toggle="tooltip">{{Lang::get('lineas.ln_lb_md_nombre')}}</label> {{ $asistente->grupo['nombre'] }}                                                                     
                                    </td>                                              
                                    <td> 
                                            <button id="{{ $asistente->id }}"  data-nombre="{{ $asistente->nombre.' '.$asistente->apellido }}" class="seleccionar btn btn-success btn-sm" ><i class="fa fa-check"></i></button>
                                            <button style="display:none" id="borrar-{{ $asistente->id }}" data-id="{{ $asistente->id }}"  class="borrar-fila btn btn-danger btn-sm" ><b>X</b></button>                                                
                                    </td>   
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- cierre modal que me permite scoger el lider del grupo-->

        @include('includes.scripts') 
       
        <!-- js data tables-->
        <script src="{{ Lang::get('general.url-datatables') }}" type="text/javascript"></script>
        <script src="/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

        <!-- page script -->
                <script type="text/javascript">
                      var lideres_id=new Array(); // array para guardar los  ID de los lideres del linea
                      var id_borrar= 0 ;
                    $(document).ready(function() {
                        
                        ///script que me modifica el contenido de la tabla donde aparecen los lideres de linea                                    
                
                        $('.seleccionar').click (function () {
                        
                            var id = $(this).attr("id");
                            var nombre=$(this).attr("data-nombre");
                            var tr="";
                            $(this).hide();
                            $("#borrar-"+id).show();

                            lideres_id.push(id); 


                            $.ajax({url:"ajax/"+id,cache:false, type:"POST",
                                success:function(resp)
                                {
                                     
                                    tr=resp;
                                    $("#tabla_encargado_linea").append(tr);

                                }
                            });

                            $("#ids_encargados").val(lideres_id);
                           
                            

                        });


                        $('.borrar-fila').click (function () {
                            var id=$(this).attr("data-id");
                                        var tr = $("#tr-"+id);
                                        tr.remove();
                                        $(this).hide();
                                        $("#"+id).show();

                                var pos=lideres_id.indexOf(id); // obtengo la posicion de arreglo segun el data-id
                                lideres_id.splice(pos,1);

                                  $("#ids_encargados").val(lideres_id);;



                                    }); 

                        $('#tabla_modal_lider').dataTable({
                        });

                         
                    });
        </script> 
        <!-- page script -->
                <script type="text/javascript">
                    
                    $(document).ready(function() {
                        $('#lider').dataTable({});

                        //activa (desplega) emnu correspondiente
                        $("#menu_lineas").children("a").first().trigger('click');
                    });
        </script> 
        
    
        
       
      
			
        </script>
    </body>
</html>
@endif