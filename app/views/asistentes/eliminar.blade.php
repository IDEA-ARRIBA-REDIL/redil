@if(Auth::check())
@include('includes.lenguaje')
<!DOCTYPE html>
<!-- Vista creada por: Juan Carlos Velasquez 
     Fecha creacíón: 08-09-2015
     Fecha Ultima modificación: 08-09-2015
     funcion vista: Esta vista permite ELIMINAR al asistente.
     software REDIL version 1.0
-->
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    <title>Redil | {{ Lang::get('asistentes.title_eliminar')}}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    @include('includes.styles')
    <!-- Ionicons -->
    <link href="/css/ionicons.min.css" rel="stylesheet" type="text/css" />
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

        <!-- contenido principal -->
        <section class="content">   
          <!-- row de cuadro de colores -->
            <!-- row de la tabla -->
          <div class="row">  

            <!-- columna del boton guardar -->
            <div class="col-lg-12" style="margin-bottom: 10px;">
              <div class=" box-header">
                <div class="col-lg-12">
                  <?php $mensaje=Session::get('mensaje'); ?>
                  @if($mensaje != "") 
                    <div class="desvanecer alert alert-success" style="padding-bottom:5px; padding-top:5px; margin-bottom: -5px" >
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <b> {{$mensaje}} </b>  
                    </div>
                  @endif
                </div>                
              </div>
            </div>
            <!-- /columna del boton guardar --> 

            <!-- columna formulario dado (baja/alta)-->
            <div class="col-md-7">
                <div class="box box-primary">
                  <div class="panel-heading">
                    <h3 class="box-title">Deseas dar de @if($asistente->dado_baja == 0) baja @else alta @endif  a <b>  {{ $asistente->nombre }} {{ $asistente->apellido }} </b></h3>
                    </div>
                    <div class="panel-body">
                      <form role="form" action="../cambiar-dado-baja-alta/{{ $asistente->id }}" method="post">
                        <!-- Motivo de dado (baja/alta) -->
                        <div class="form-group">
                           <label>Motivo</label>
                           <input id="motivo" name="motivo" type="text" class="form-control" maxlength="100" placeholder=""  required/>
                        </div>
                        <!-- /Motivo de dado (baja/alta) -->

                        <!-- Observaciones del dado (baja/alta) -->
                        <div class="form-group">
                            <label>Observaciones</label>
                            <textarea id="observaciones" name="observaciones" class="form-control" rows="5"  maxlength="500" placeholder="" required> </textarea>
                        </div>
                        <!-- /Observaciones del dado (baja/alta) -->

                        @if($asistente->dado_baja == 1) 
                   
                        <!-- Tipo de asistente -->
                        <div class="form-group">
                           <label>Tipo de asistente</label>                         
                            <select id="tipo_asistente_id" name="tipo_asistente_id" class="form-control" required>
                                <option value="" @if($asistente->tipo_asistente_id=="") selected @endif ></option>
                                <option value="1" @if($asistente->tipo_asistente_id=="1") selected @endif>Nuevo</option>
                                <option value="2" @if($asistente->tipo_asistente_id=="2") selected @endif>Oveja</option>
                                <option value="3" @if($asistente->tipo_asistente_id=="3") selected @endif>Miembro</option>
                                <option value="4" @if($asistente->tipo_asistente_id=="4") selected @endif>Lider</option>
                                @if(Auth::user()->id==1)
                                <option value="5" @if($asistente->tipo_asistente_id=="5") selected @endif>Pastor</option>
                                @endif                                
                            </select>
                        </div>
                        <!-- /Tipo de asistente-->
                        @endif

                        <br><br>
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Aceptar </button>
                        <a href="/asistentes" class="btn bg-btn btn-danger"> <i class="fa fa-undo"></i> Cancelar</a>
                      </form>
                    </div>
                </div>
            </div>
            <!-- /columna formulario dado (baja/alta)-->

             <!-- Cuadro de informacion-->
              <div class="col-lg-5 col-md-6">
              
                
                @if($asistente->dado_baja == 0)
                  <div class="box">
                    <div class="panel-heading text-center bg-light-redil ">
                      <div class="box-body text-center" > 
                        <img src="/img/fotos/{{ $asistente->foto }}" class="img-circle" style= "height: 120px; width: 120px;" alt="User Image" />
                      </div>                
                    </div>
                    <div class="panel-body text-center bg-light-redil ">
                      <i class="fa fa-hand-o-down fa-4x"></i>
                      <h2><b>Dar de baja</b></h2>  
                      <h4><b>Nombre: </b> {{$asistente->nombre}} {{$asistente->apellido}}</h4>
                      <h4><b>Tipo de asistente: </b>  {{$asistente->tipoAsistente->nombre}} </h4> 
                      @if($lineas > 0)
                        <h4><b> N° de Lineas a cargo: </b> {{$lineas}} </h4> 
                      @endif 
                      @if($grupos_directos > 0)
                        <h4><b> N° de grupos directos: </b> {{$grupos_directos}} </h4> 
                      @endif 

                      @if($grupos_indirectos > 0)
                        <h4><b> N° de grupos indirectos: </b> {{$grupos_indirectos}} </h4> 
                      @endif 

                                           
                    </div>
                  </div>
                @else 
                  <div class="box">
                    <div class="panel-heading text-center bg-blue ">
                                        
                    </div>
                    <div class="panel-body text-center bg-blue ">
                                    
                    <i class="fa fa-hand-o-up fa-4x"></i>
                    <h2><b>Dar de alta</b></h2>
                      <p> 
                       Por defecto se dara de alta a <b> {{$asistente->nombre}} {{$asistente->apellido}} </b> con el tipo de asistente <b>"{{ $asistente->tipo_asistente->nombre}}"</b>, pero puedes cambiarlo en el campo Tipo Asistente.                 
                      </p>
                    </div>
                  </div>
                @endif 
                <div class="box">
                  <div class="panel-heading text-center bg-light-redil ">
                                      
                  </div>
                  <div class="panel-body text-center bg-light-redil ">
                                  
                  <i class="fa fa-info fa-4x"></i>
                  <h2><b>Recuerda</b></h2>
                  <p> 
                    Es importante especificar el motivo por el cual el asistente sera dado de baja o dado de alta.  
                  </p>
                  </div>
                </div>
              </div>
              <!-- /Cuadro de informacion -->
          </div><!-- /row -->
        </section>
      <!-- contenido principal -->
      </aside>  
    </div>  
    
    @include('includes.scripts')
        
            
      <!-- page script -->
      <script type="text/javascript">

      </script>
  @endif
  </body>
</html>