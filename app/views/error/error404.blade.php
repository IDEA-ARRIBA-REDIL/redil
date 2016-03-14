@include('includes.lenguaje')
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Redil | 404 Página no encontrada </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        @include('includes.styles')
        
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
                    <h1>
                       Pagina de error 404
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="/inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <li><a href="#">Pagina de Error</a></li>
                        <li class="active">Error 404 </li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                 
                    <div class="error-page">
                        <h2 class="headline text-info"> 404</h2>
                        <div class="error-content">
                            <h3><i class="fa fa-warning text-yellow"></i> Oops! Página no encontrada.</h3>
                            <p>
                                No hemos podido encontrar la página que estabas buscando. Probablemente la página no exista o no tengas permisos para acceder a ella. Mientras tanto, puedes <a href='/inicio'>regresar al Inicio</a>.
                            </p>
                        </div><!-- /.error-content -->
                    </div><!-- /.error-page -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        @include('includes.scripts')
    </body>
</html>