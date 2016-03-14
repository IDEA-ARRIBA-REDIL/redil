@if(Auth::check())
@include('includes.lenguaje')
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{{Lang::get('grupos.lg_titulo_pestaña')}} | {{ Lang::get('reuniones.ir_title') }} </title>
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
                    <div class="box-header">	
                   	    <h3 class="content-header barra-titulo">
                             {{ Lang::get('reuniones.ir_header') }} 
                            <small>{{ Lang::get('reuniones.ir_subtitulo') }} </small>
                        </h3>
                    </div>
                </section>
                <!-- /contendio cabezote --> 

                <!-- contenido principal -->
                <section class="content">
                    <div class="row"> 
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  
                            <div class="box box-primary"> 
                                <div class="panel-body">
                                    <!-- tabla -->
                                    <div class="box-body table-responsive">
                                        <table id="example1" class="table table-striped display " cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                	<th>Nombre del Informe</th>
                                                    <th>Descripcion del Informe</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>                                                    
                                                    <td >
                                                    	<b>{{ Lang::get('reuniones.informe_promedio_asistencia_titulo') }}</b>  
                                                    </td>
                                                    <td>
                                                        {{ Lang::get('reuniones.informe_promedio_asistencia_descripcion') }}
                                                    </td>
                                                    <td>
                                                        <a href="informe-promedios-asistencia" class="btn btn-info"> Ver Informe </a>
                                                    </td>
                                                </tr>
                                                <tr>                                                    
                                                    <td >
                                                        <b>{{ Lang::get('reuniones.informe_general_titulo') }}</b>  
                                                    </td>
                                                    <td>
                                                        {{ Lang::get('reuniones.informe_general_descripcion') }}
                                                    </td>
                                                    <td>
                                                        <a href="informe-general" class="btn btn-info"> Ver Informe </a>
                                                    </td>
                                                </tr>
                                            </tbody>  
                                        </table>
                                    </div>
                                    <!-- /tabla -->
                                </div>
                                
                            </div>
                            <!-- /div de 12 columnas -->
                        </div>
                    </div>
                	<!-- /row de la tabla -->
                </section>
                <!-- contenido principal -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        


        @include('includes.scripts')   

        <!-- DATA TABES SCRIPT -->
         <script src="{{ Lang::get('general.url-datatables') }}" type="text/javascript"></script>
        <script src="/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        
        <!-- page script -->
        <script type="text/javascript">
			
            $(document).ready(function() {
                $("#menu_reuniones").children("a").first().trigger('click');

			} );

            
        </script>

        
        
    </body>
</html>
@endif