@if(Auth::check())
@include('includes.lenguaje')

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Redil |  {{ Lang::get('grupos.ag_title') }} </title>
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
            <form role="form" action="../update/{{ $grupo->id }}" method="post">
                <aside class="right-side">
                    <!-- contendio cabezote -->
                    <section class="content-header">
                      <div class="box-header">
                        <h3 class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-padding content-header barra-titulo">
                            <span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">{{ Lang::get('grupos.ag_header') }}</span>
                            <small class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">{{ Lang::get('grupos.ag_subtitulo') }} </small>
                        </h3>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-padding pull-right box-tools">
                            <ul class="pull-right nav nav-pills">
                              <li class="active" role="presentation"><a href="/grupos/actualizar/{{ $grupo->id }}"><small class="badge">1</small> Información Principal</a></li>
                              <li role="presentation"><a href="/grupos/anadir-lideres/{{ $grupo->id }}"><small class="badge">2</small> Añadir Lideres</a></li>
                              <li role="presentation"><a href="/grupos/anadir-asistentes/{{ $grupo->id }}"><small class="badge">3</small> Añadir Integrantes</a></li>
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
                                <a href="../../grupos/lista/todos" class="btn bg-light-redil"> <i class="fa fa-undo"></i> {{ Lang::get('general.btn_cancelar') }}</a>   
                            </div>
                            <!-- /columna del boton guardar --> 
                    
                            <div class="row">
                         		
                                <!-- columna del boton guardar -->
                                <div class="mensaje col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div >
                                      <?php
                                        $status=Session::get('status');
                                      ?>
                                      @if($status=='ok_update')
                                      <?php
                                        $id=Session::get('id_nuevo');
                                        $nombre=Session::get('nombre_nuevo'); 
                                      ?>
                                      <div class="alert alert-success col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom:5px; padding-top:5px; margin-bottom: -5px" >
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>{{ Lang::get('grupos.ag_msn_parte_1') }}</b>  
                                      </div>
                                      @endif
                                    </div>
                                </div>
                                 <!-- /columna del boton guardar -->
                                    
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            	    <div class="panel">
                                	    <div class="panel-heading">
                                    	   <h4 class="modal-title"> {{ Lang::get('grupos.ng_mt_informacion_principal') }}</h4>     
                                        </div>
                                        <div class="panel-body">
                                        	<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                            	    <div class="form-group">
                                                        <label> {{ Lang::get('grupos.ng_lb_nombre')}} </label>
                                                        <input name= "nombre" type="text" class="form-control" placeholder=" {{ Lang::get('grupos.ng_ph_nombre')}} " value="{{ $grupo->nombre }}" required/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label> {{ Lang::get('grupos.ng_lb_telefono') }} </label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-phone"></i>
                                                            </div>
                                                            <input name="telefono" type="text" class="form-control"  placeholder="{{ Lang::get('grupos.ng_ph_telefono') }}" value="{{ $grupo->telefono}} " />
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label> {{ Lang::get('grupos.ng_lb_direccion') }} </label> 
                                                        <textarea name="direccion" class="form-control" rows="3" placeholder="{{ Lang::get('grupos.ng_ph_direccion') }}">{{ $grupo->direccion }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label> {{ Lang::get('grupos.ng_lb_rhema') }} </label>
                                                        <input name="rhema" type="text" class="form-control" placeholder=" {{ Lang::get('grupos.ng_ph_rhema') }} " value="{{ $grupo->rhema }}"/>
                                                    </div>
                                                 
                                 		    </div>
                        						
                                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">                                 
                                        	    <div class="form-group">
                                                    <label>{{ Lang::get('grupos.ng_lb_dia') }}</label>
                                                    <select name="dia" class="form-control" required>
                                                        <option value="" @if($grupo->dia=="0") selected @endif >{{ Lang::choice ('general.dias', 0) }}</option>
                               			 	            <option value="2" @if($grupo->dia=="2") selected @endif >{{ Lang::choice ('general.dias', 2) }}</option>
                               			 	            <option value="3" @if($grupo->dia=="3") selected @endif >{{ Lang::choice ('general.dias', 3) }}</option>
                               			 	            <option value="4" @if($grupo->dia=="4") selected @endif >{{ Lang::choice ('general.dias', 4) }}</option>
                               			 	            <option value="5" @if($grupo->dia=="5") selected @endif >{{ Lang::choice ('general.dias', 5) }}</option>
                               			 	            <option value="6" @if($grupo->dia=="6") selected @endif >{{ Lang::choice ('general.dias', 6) }}</option>
                               			 	            <option value="7" @if($grupo->dia=="7") selected @endif >{{ Lang::choice ('general.dias', 7) }}</option>
                               			 	            <option value="1" @if($grupo->dia=="1") selected @endif >{{ Lang::choice ('general.dias', 1) }}</option>
                       			 	                </select>
                                                </div>
                                                <!-- time Picker -->
                                                <div class="form-group">
                                                    <div class="bootstrap-timepicker">
                                                        <label>{{ Lang::get('grupos.ng_lb_hora_reunion') }}</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"> <i class="fa fa-clock-o"></i></div>
                                                            <input name="hora" type="text" class="form-control timepicker" value="{{ date('h:i A', strtotime($grupo->hora)) }}" />
                                                        </div><!-- div que cierra el input donde aparece la fecha-->
                                                    </div> <!-- div que cierrra el bootstrap picker-->
                                                </div>
                                		        <div class="form-group">
                                            	    <label for="datepicker" class="control-label">{{ Lang::get('grupos.ng_lb_fecha_creacion') }}</label>
                                                    <div class="input-group">
                                               		    <div class="input-group-addon">
                                            	 			<i class="glyphicon glyphicon-calendar"></i>
                                               		    </div>
                                                        <?php $fecha_aper=date_create($grupo->fecha_apertura); ?>
                                       			        <input name="fecha" id="creacion"  type="text" class="date-picker form-control" />
                                 		            </div><!-- div que cierra el bootstrap picker-->
                        				        </div> <!-- div que cierra el formulario de fecha creacion ministerio-->
                                                <!-- Lista de redes del grupo-->
                                                <div class="form-group">
                                                    <label> {{ Lang::get('grupos.ng_lb_redes') }}</label> 
                                                    <br>                                         
                                                    <select name="redes[]" class="multiselectRedes" multiple="multiple">
                                                        @foreach ($redes as $red)
                                                            <?php
                                                                $la_red= $grupo->redes()->get();
                                                                         
                                                                $la_red=  $la_red->find($red->id);
                                                            ?>
                                                             <option value="{{ $red->id }}"  @if(isset ($la_red)) selected @endif> {{ $red->nombre }} </option>
                                                        @endforeach
                                                    </select>
                                                    
                                                </div> <!-- fin lista de redes -->

                                                <!-- tipo de grupo-->
                                                <div class="form-group">   
                                                    <label>{{ Lang::get('grupos.ng_lb_tipo_grupo') }}</label>  
                                                    <select name="tipo_grupo" class="form-control">
                                                        @foreach ($tipo_grupos as $tipo_grupo)
                                                             
                                                            <option value="{{ $tipo_grupo->id }}" @if($grupo->tipo_grupo->id == $tipo_grupo->id ) selected @endif> {{ $tipo_grupo->nombre }} </option>
                                                        @endforeach
                                                    </select>
                                                </div> <!-- fin tipo de grupos -->

                                            </div> <!-- div que cierra la col-lg6 del lado derecho del panel completo-->  
                                        </div><!-- div que cierra el panel body-->
                                    </div> <!-- div que cierra box box primary-->
                                </div> <!-- div que cierra la col-lg12 principal-->

                               
                            <!-- columna del boton guardar -->
                            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">  
                                    <button type="submit" class="btn btn-danger"> <i class="fa fa-save"></i> {{ Lang::get('general.btn_guardar') }}</button>
                                    <a href="../../grupos/lista/todos" class="btn bg-light-redil"> <i class="fa fa-undo"></i> {{ Lang::get('general.btn_cancelar') }}</a>     
                            </div>
                            <!-- /columna del boton guardar --> 
                            <br><br>
                           
                            
                            <input id="integrantes_id" name="integrantes_id" type="text" class="hide form-control" placeholder="" readonly value=""/>
                            <input id="integrantes_eliminados" name="integrantes_eliminados" type="text" class="hide form-control" placeholder="" readonly value=""/>
                            <input id="integrantes_anadidos" name="integrantes_anadidos" type="text" class="hide form-control" placeholder="" readonly value=""/>       
                        
                                                                			 	 
                    </section><!-- /.content -->
                </aside>
            </form>
        </div><!-- ./wrapper -->
                
                
   

    <!-- /modal   -->
    <div id="msn_modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <br>
            </div>
            <div class="modal-body">
                  <h4 id="msn_confirmacion" class="modal-title bg-danger text-center" id="myModalLabel"> Julanito se encuentra actualmente en el grupo TALES, ¿Esta seguro que quiere cambiarlo de grupo? </h4>
      
            </div>
            <div class="modal-footer">
                <button id="si" type="button" class="btn btn-primary">Si</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
            </div>
        </div>
      </div>
    </div>
    <!-- /modal   -->

            


            @include('includes.scripts')

            <!-- InputMask -->
            <script src="/js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
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

            <!-- page script -->
            <script type="text/javascript">
            
                $(document).ready(function() {
                    $("#menu_grupos").children("a").first().trigger('click');

                    // multiselect, este es el selector de redes
                    $('.multiselectRedes').multiselect();

                    //Datemask dd/mm/yyyy de fecha de reunion 
                     $("#creacion").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
                    
                    $("#creacion").datepicker({
                        language: 'es',
                        format: 'dd/mm/yyyy'
                    });

                    //Timepicker hora de reunion
                    $(".timepicker").timepicker({
                        showInputs: false
                    });
                });
            </script> 



    </body>
</html>
@endif