@if(Auth::check())
@include('includes.lenguaje')
<!DOCTYPE html>
<!-- Vista creada por: Darwin Castaño
     Fecha creacíón: 24-07-2014
     Fecha Ultima modificación: 24-07-2014 02:36pm
     funcion vista: esta es la vista que me permite actualizar un departamento.
     software REDIL version 1.0 -->
<!DOCTYPE html>
<html>
 <head>
        <meta charset="UTF-8">
        <title>Redil | {{Lang::get('departamentos.pd_title')}} </title>
        <link href="/css/ionicons.min.css" rel="stylesheet" type="text/css" />
         <!-- DATA TABLES -->
        <link href="/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        
        @include('includes.styles')
 </head>
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script> -->
      
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

                  
                <!-- contendio cabezote -->
        
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- contendio cabezote -->
                <section class="content-header">
                    	<h1>
                         {{Lang::get('departamentos.pd_header')}}
                        <small>{{Lang::get('departamentos.pd_subtitulo')}} </small>
                      </h1>
                       <br>
                 </section>
                 <!-- /contendio cabezote -->
                    <div style="padding-left:15px;"class"col-md-12">
                       <div class="btn-group">
                          <button type="button" class="btn btn-success btn-info dropdown-toggle" data-toggle="dropdown">
                                  {{ Lang::get('grupos.lg_bt_opciones') }}  
                                 <i class="fa fa-caret-down"> </i>
                          </button>
                              <ul class="dropdown-menu">
                                   <li><a href="../actualizar/{{$departamentos->id}}">{{ Lang::get('grupos.lg_bt_opciones_1') }}</a></li>
                              </ul>
                       </div> 
                    </div>
                 

             <!-- contenido principal -->
                 <section class="content">
                   <div class="row">
                      <div class="col-md-6">
                          <div class="box box-primary">
                              <div class="panel-heading">
                                  <h3 class="box-title">{{Lang::get('departamentos.pd_bb1_title')}}</h3>
                              </div>
                
                            <div class="panel-body">
                        
                              <!-- Nombre -->
                                <div class="form-group">
                                   <h3> <span class="badge bg-claro-redil"><i class="fa fa-cubes fa-3x"> </i> </span> {{$departamentos->nombre}} </h3>
                                  
                                </div>
                                <!-- /Nombre-->
                                <!-- Descripcion -->
                                <div class="form-group">
                                   <h4>{{$departamentos->descripcion}} </h4>
                                </div>
                                <!-- /Descripcion -->  
                                <!-- palabra rhema departamento -->
                                <div class="form-group">
                                   <h3><label>{{Lang::get('departamentos.pd_bb1_rhema')}}</label></h3> <br>
                                   <h4> {{$departamentos->rhema}}</h4>
                                </div>
                                <!-- /palabra rhema departhamento -->   

                                <!-- fecha creación del departamento-->
                                <div class="form-group">
                                    <h3> <label> {{Lang::get('departamentos.pd_bb1_fecha')}}</label></h3> 

                                    <h4> {{$departamentos->fecha_creacion}} </h4>
                                </div>
                                <!-- / fecha creación del departamento-->
                            </div>
                         </div>
                      </div>
                      <!-- /seleccionar departamento -->

                        <!-- seleccionar departamento-->
                      <div class="col-md-6">
                        <div class="box box-danger">
                            <div class="panel-heading">
                                <h3 class="box-title"></h3>
                            </div>
                        <div class="panel-body">
                                <h2 class="box-tittle"> 
                                    <span class="badge bg-red"> 
                                        <i class="fa fa-info-circle fa-3x"></i>
                                    </span>
                                          {{Lang::get('departamentos.pd_bb2_title')}}
                                </h2>
                            <!-- Director-->
                                <div class="form-group">
                                    <h4> 
                                      <?php 
                                         $funcion="";
                                      ?>
                                       @foreach($departamentos->encargados as $encargado)
                                           {{Lang::get('departamentos.pd_bb2_cod')}} - 
                                           {{$encargado->id}}
                                           <span class="capitalize">{{$encargado->nombre}}  {{$encargado->apellido}}</span>
                                            <?php

                                              $funcion=$encargado->pivot->funcion;
                                            ?>
                                           <br>
                                      @endforeach
                                     </h4>
                                </div>
                                      <!-- /Director-->     
                                      
                                        
                                       <!-- funciones del director -->
                                      <div class="form-group">
                                            <h3> <label> {{Lang::get('departamentos.pd_bb2_funciones')}}</label></h3>
                                            <h4>
                                              {{$funcion}}


                                            </h4>
                                      </div>
                            
                              <!-- /Funciones-->                                    
                        </div>
                    </div>
                </div>
                <!-- /cierra col-6 columna derecha -->
    </div> <!-- /row principal -->
                        
                   <div class="row">     
                        <div class="col-md-12">
                            <div class="box box-warning">
                                <div class="panel-heading">
                                    <h2 class="box-title"><span class="badge bg-yellow"> <i class="fa fa-male fa-3x"></i> </span>{{Lang::get('departamentos.pd_bb3_title')}}</h2>  
                                </div>
                              
                              
                                
                                <div class="panel-body">
                                
                                
                                        <!-- tabla listado de seridores departamento-->
                                    <div class="box-body table-responsive">
                                        <table id="lista_departamento" class="table table-striped display stripe" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                          	
                                                            <th> {{Lang::get('departamentos.pd_tb_th1_servidores')}}</th>
                                                            <th> {{Lang::get('departamentos.pd_tb_th2_servidores')}}</th>
                                                            <th> {{Lang::get('departamentos.pd_tb_th3_servidores')}} </th>
                                                           
                                                         </tr>
                                                    
                                                    
                                                    </thead>
                                                    
                                                     <tbody>
                                                        <tr>
                                                            @foreach ($departamentos->integrantes as $integrante)
                                                            <td>
                                                            Cod: {{$integrante->id}}- {{$integrante->nombre}}   {{$integrante->apellido}} </td>
                                                            <td>
                                                            {{$integrante->pivot->cargo}}
                                                            </td>
                                                            <td>
                                                            <p>
                                                            {{$integrante->pivot->funcion}} </p>
                                                            </td>
                                                            
                                                        </tr> 
                                                        @endforeach                  
                                                  </tbody>
                                        
                                            </table>
                                        </div>
                                        <!-- cierra tabla que contiene los datos de quien es el servidor-->
                                
                            </div> <!-- / cierre del panel body-->
                        </div><!-- / cierre box-warning-->
                    </div> <!-- / cierre de la col-md-12 de la tabla-->
                  </div>

                        
                    
                
                
    </section>
                <!-- contenido principal -->
</aside>  


        

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
			
            $(document).ready(function() {
				$('#lista_departamento').dataTable( {
					 
				} );
			} );

            

$(document).ready(function() {
                $('#seleccionar_servidor').dataTable( {
                     
                } );
            } );

            

        </script>

        
        
    </body>
</html>
@endif