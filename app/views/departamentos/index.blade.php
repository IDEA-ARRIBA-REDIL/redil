@if(Auth::check())
@include('includes.lenguaje')
<!DOCTYPE html>
<!-- Vista creada por: Darwin Castaño
     Fecha creacíón: 22-07-2014
     Fecha Ultima modificación: 22-07-2014 05:58pm
     funcion vista: esta es la vista que contiene el listado de todas los departamentos.
     software REDIL version 1.0
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Redil | {{ Lang::get('departamentos.ld_title') }}</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        
         @include('includes.styles')
        
         <!-- DATA TABLES -->
        <link href="/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
         
        
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
                        {{ Lang::get('departamentos.ld_header') }}
                        <small> {{ Lang::get('departamentos.ld_subtitulo') }}</small></h1>
                    
                        
                        <br>
                </section>
                 <!-- /contendio cabezote -->
                 

             <!-- contenido principal -->
               <section class="content">
                     <!-- row de la tabla -->
                     <div class="row">   
                  		 

                        <!-- div de 12 columnas -->                     
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="panel-heading">
                                    <!-- columna del boton nueva linea -->
                                    <div class="col-md-12">
                                        <br>
                                        <div class=" box-header">
                                              <a href="/departamentos/nuevo" class="btn btn-danger btn-lg"> <i class="fa fa-plus"></i> {{ Lang::get('departamentos.ld_boton_nuevo') }} </a>
                                        </div>
                                        
                                        <br>
                                    </div>
                                     <!-- /columna del boton nueva linea -->
                                    <h3 class="box-title"></h3>
                                </div>
                                
                                <div class="panel-body">
                                    <!-- tabla -->
                                    <div class="box-body table-responsive">
                                          <table id="example1" class="table table-striped display " cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                    	<th>{{Lang::get('departamentos.ld_tb_th1') }}</th>
                                                        <th>{{Lang::get('departamentos.ld_tb_th2') }}</th>
                                                        <th>{{Lang::get('departamentos.ld_tb_th3') }}
                                                        </th>
                                                        <th>{{Lang::get('departamentos.ld_tb_th4') }}
                                                        </th>
                                                       
                                                        <th></th>
                                                        
                                                        
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                     @foreach ($departamentos as $departamento)       
                                                    <tr>
                                                        
                                                        <td>
                                                            <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="{{ Lang::get('departamentos.ld_tb_dt_tit_departamento') }}"> <i class="fa fa-cubes"> </i></label>{{ $departamento->nombre }} <br>                             
                                                                        
                                                        </td>
                                                        
                                                        <td>
                                                             <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="{{ Lang::get('departamentos.ld_tb_dt_tit_descripcion') }}"></label> {{ $departamento->descripcion }} <br>      
                                                  
                                                        </td>
                                                        
                                                        
                                                       
                                                        
                                                        <td>
                                                            @foreach($departamento->encargados as $encargado)
                                                            <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="{{ Lang::get('departamentos.ld_tb_dt_tit_nombre') }}"> <i class="fa fa-user"></i></label> {{ $encargado['nombre']." ".$encargado['apellido']  }} <br>
                                                            @endforeach
                                                        </td>

                                                        <td>
                                                             <?php $fecha_cre=date_create($departamento->fecha_creacion); ?>
                                                        <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="{{ Lang::get('departamentos.ld_tb_dt_tit_fecha') }}"><i class="fa fa-calendar"></i></label>{{ date_format($fecha_cre, 'd-m-Y') }}
                                                        </td>
                                                        
                                                        <td>
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-success btn-info dropdown-toggle" data-toggle="dropdown">
                                                                    {{Lang::get('departamentos.ld_bt_opciones') }}  
                                                                    <i class="fa fa-caret-down"> </i>
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a href="../departamentos/perfil/{{$departamento->id}}">{{ Lang::get('departamentos.ld_lb_ver_departamento') }}</a></li>
                                                                    <li><a href="../departamentos/actualizar/{{$departamento->id}}">{{Lang::get('departamentos.ld_lb_modificar') }}</a></li>
                                                                     <li><a href="#">{{Lang::get('departamentos.ld_lb_eliminar') }}</a></li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                        
                                                    </tr>
                                                          @endforeach 
                                                       
                                                        
                                                        
                                                </tbody>
                                            </table>
                                     </div>
                                     <!-- /tabla -->
                                 </div> <!-- /panel body -->
                              
                            </div><!-- /Box primary -->
                        </div><!-- /Div de 12 columnas -->
                     </div><!-- /row -->
               </section>
                <!-- contenido principal -->
            </aside>  
        


        @include('includes.scripts') 
        <!-- DATA TABES SCRIPT -->
        <script src="{{ Lang::get('general.url-datatables') }}" type="text/javascript"></script>
        <script src="/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
           
        
        
        <!-- page script -->
        <script type="text/javascript">

            $(document).ready(function() {
				$('#example1').dataTable( {
					 
				} );
			} );
        </script>

        
        
    </body>
</html>
@endif