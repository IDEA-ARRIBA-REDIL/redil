@if(Auth::check())
@include('includes.lenguaje')
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Redil |</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
       @include('includes.styles')

         <!-- DATA TABLES -->
        <link href="/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="http://cdn.datatables.net/1.10.0/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
        
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
                <!-- contendio cabezote -->
                <section class="content-header">
                	
                    	<h1>
                        LISTA DE ESCUELAS
                        <small>Aqui encontraras el listado de escuelas que se han creado. </small></h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
                        <li><a href="#">Examples</a></li>
                        <li class="active">Blank page</li>
                    	</ol>
                        
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
                                    <!-- columna del boton nuevo escuela-->
                                    <div class="col-md-12">
                                        <br>
                                        <div class=" box-header">
                                              <a href="formulario_escuelas.html" class="btn btn-danger btn-lg" > <i class="fa fa-plus"></i> Nueva Escuela </a>

                                        </div>
                                        
                                        <br>
                                    </div>
                                    <!-- /columna del boton nueva escuela -->
                                    <h3 class="box-title"></h3>
                                </div>
                                
                                <div class="panel-body">
                                    <!-- tabla -->
                                    <div class="box-body table-responsive">
                                          <table id="example1" class="table table-striped display " cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                    	<th>ESCUELA</th>
                                                        <th>DESCRIPCIÓN</th>
                                                        <th>DIRECTOR</th>
                                                        <th></th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                           
                                                    <tr>
                                                        
                                                        <td>
                                                        	<label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Codigo">Cod</label> 1<br>
                                                        	<label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Nombre"> <i class="fa fa-user"></i></label> Escuelas de liderazgo<br>
                                                        </td>
                                                            
                                                        <td>
                                                        	   <p>Escuelas que formaran el caracter de Cristo en ti, y que contribuiran a que seas un lider de influencia.</p>
                                                        </td>
                                                        
                                                        <td>
                                                            <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Codigo">Cod</label> 7<br>
                                                            <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Nombre"> <i class="fa fa-user"></i></label> Ruben Dario Gomez<br>
                                                        </td>
                                                        
                                                        
                                                        <td>
                                                        	<div class="btn-group">
                                                                <button type="button" class="btn btn-success btn-info dropdown-toggle" data-toggle="dropdown">
                                                                    Opciones  
                                                                    <i class="fa fa-caret-down"> </i>
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a href="#">Modificar</a></li>
                                                                    <li><a href="#">Eliminar</a></li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                        
                                                    </tr>
                                                    
                                                    <tr>
                                                        
                                                        <td>
                                                            <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Codigo">Cod</label> 1<br>
                                                            <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Nombre"> <i class="fa fa-user"></i></label> Escuelas de salmistas<br>
                                                        </td>
                                                            
                                                        <td>
                                                               <p>Escuelas en las que seras formado para saber que es la verdadera adoración, que es alabanza. </p>
                                                        </td>
                                                        
                                                        <td>
                                                            <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Codigo">Cod</label> 4<br>
                                                            <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Nombre"> <i class="fa fa-user"></i></label> Catalina Edith Victoria<br>
                                                        </td>
                                                        
                                                        
                                                        <td>
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-success btn-info dropdown-toggle" data-toggle="dropdown">
                                                                    Opciones  
                                                                    <i class="fa fa-caret-down"> </i>
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a href="#">Modificar</a></li>
                                                                    <li><a href="#">Eliminar</a></li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                        
                                                    </tr>
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
        <script src="http://cdn.datatables.net/1.10.0/js/jquery.dataTables.js" type="text/javascript"></script>
        <script src="/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        
        <!-- page script -->
        <script type="text/javascript">

            $(document).ready(function() {
                /////este codigo es para que no se cierre el submenu al actualizar
              $("#menu_escuelas").attr('class', 'treeview active');
              $("#submenu_escuelas").attr('style', 'display: block;');
              $("#flecha_escuelas").attr('class', 'fa fa-angle-down pull-right');
              /////fin codigo del submenu

    		  $('#example1').dataTable({ 
    		  });
			} );

          
        </script>
    </body>
</html>
@endif