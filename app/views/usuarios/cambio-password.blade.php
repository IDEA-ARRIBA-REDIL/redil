@if(Auth::check())
@include('includes.lenguaje')
<!DOCTYPE html>
<!-- Vista creada por: Juan Carlos Velasquez 
     Fecha creacíón: 20-02-2015
     Fecha Ultima modificación: 22-02-2015 02:58pm
     funcion vista: esta es la vista que me permite la configuracion de la contraseña del usuario logueado.
     software REDIL version 1.0
-->
<html>
  <head>
    <meta charset="UTF-8">
    <title>Redil | {{Lang::get('departamentos.nd_title')}} </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
     @include('includes.styles')
    <!-- Ionicons -->
    <link href="/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    
   
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
           CONTRASEÑA 
           <small>Aqui podrás cambiar la contraseña las veces que desees. </small>
          </h1>  
          <br>
        </section>
        <!-- /contendio cabezote -->
        <!-- contenido principal -->
        <section class="content">
          <form action="/usuarios/update-password" method="post" role=-"form">
            <div class="row">
            
              <!-- columna del boton guardar -->
              <div class="col-lg-12"style="margin-bottom: 10px;">
                <div class=" box-header">
                  <div class="col-lg-12">
                    <?php $status=Session::get('status'); ?>
                    <?php $validation=Session::get('errors'); ?>
                    @if($status=='ok')
                    <div class="desvanecer alert alert-success col-lg-12" style="padding-bottom:5px; padding-top:5px; margin-bottom: -5px" >
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      La <b>Nueva contraseña</b> se guardo correctamente. 
                    </div>
                    @endif

                    @if($status=='no_ok')
                    <div class="desvanecer alert alert-warning col-lg-12" style="padding-bottom:5px; padding-top:5px; margin-bottom: -5px" >
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      La contraseña no se guardo correctamente, por favor, intente nuevamente. 
                    </div>
                    @endif

                    @if($status=='pass_invalid')
                    <div class="desvanecer alert alert-danger col-lg-12" style="padding-bottom:5px; padding-top:5px; margin-bottom: -5px" >
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      La <b>Contraseña actual</b> no es correcta. 
                    </div>
                    @endif

                    @if($validation!=NULL )
                    <div class="desvanecer alert alert-danger col-lg-12" style="padding-bottom:5px; padding-top:5px; margin-bottom: -5px" >
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <b>{{$validation->first() }}</b>
                    </div>
                    @endif
                  </div>
                </div>
              </div>
               <!-- /columna del boton guardar -->

              <!-- columna de formulario cambio de contraseña -->
              <div class="col-md-8">
                <div class="box box-primary">
                  <div class="panel-heading">
                    <h3 class="box-title">Cambiar Contraseña</h3>
                  </div>
                    <div class="panel-body">
                      <!-- Contraseña actual -->
                        <div class="form-group">
                          <label>Contraseña actual</label>
                          <input id="password-actual" name="actual" type="password" class="form-control" placeholder="Escribe tu contraseña actual" value="" required/>
                        </div>
                      <!-- /Contraseña actual -->
                      <!-- Nueva contraseña  -->
                        <div class="form-group">
                          <label>Nueva contraseña</label>
                          <input id="password-nuevo" name="nueva" type="password" class="form-control" placeholder="Escribe tu nueva contraseña" value="" required pattern="(?=.*\d)(?=.*[A-Za-z]).{5,}" title="La contraseña debe contener como minimo 5 caracteres alfanumericos, es decir, debe contener como minimo letras y numeros.  " />
                        </div>
                      <!-- /Nueva contraseña -->
                      <!-- confirmar contraseña -->
                        <div class="form-group">
                          <label>Confirmar contraseña</label>
                          <input id="password-confirmar" name="confirmar" type="password" class="form-control" placeholder="Escribe otra vez la nueva contraseña" value="" required/>
                        </div>
                      <!-- /confirmar contraseña -->
                      <br><br>
                      <button type="submit" class="btn btn-danger"> <i class="fa fa-save"></i> Guardar cambios </button>
                      <a href="/inicio" class="btn bg-light-redil"> <i class="fa fa-undo"></i> Cancelar</a>
                    </div> <!-- /box-body -->
                </div>
              </div>
              <!-- /columna de formulario cambio de contraseña  -->

              <!-- Cuadro de informacion-->
              <div class="col-lg-4 col-md-6">
                <div class="box">
                  <div class="panel-heading text-center bg-light-redil ">
                                      
                  </div>
                  <div class="panel-body text-center bg-light-redil ">
                                  
                  <i class="fa fa-info fa-4x"></i>
                  <h2><b>Recuerda</b></h2>
                  <p> 
                    La contraseña debe contener como minimo 5 caracteres, una letra minuscula y un numero. 
                  </p>
                  </div>
                </div>
                <div class="box">
                  <div class="panel-heading text-center bg-blue ">
                                      
                  </div>
                  <div class="panel-body text-center bg-blue ">
                                  
                  <i class="fa fa-bell-o fa-4x"></i>
                  <h2><b>Recomendación</b></h2>
                  <p> 
                    Para protección de sus datos, se recomienda cambiar la contraseña constantemente. 
                  </p>
                  </div>
                </div>
              </div>
              <!-- /Cuadro de informacion -->
            </div>
          </form>
        </section>
        <!-- fin contenido principal -->
      </aside>
    </div>    


    
    @include('includes.scripts') 
        
    
         
   
    <!-- bootstra datepicker-->
    <script src="/js/bootstrap-datepicker.js"></script>
    <script src="/js/locales/bootstrap-datepicker.es.js"></script>         
        
  </body>
</html>
@endif