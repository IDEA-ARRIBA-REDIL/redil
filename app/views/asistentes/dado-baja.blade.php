@if(Auth::check())
@include('includes.lenguaje')
<!DOCTYPE html>
<!-- Vista creada por: Juan Carlos Velasquez 
     Fecha creacíón: 09-09-2015
     Fecha Ultima modificación: 09-09-2015 
     funcion vista: Esta vista permite dar de Baja a los asistentes y especificar el motivo y hacer las observaciones pertinentes.
     software REDIL version 1.0
-->
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    <title>{{Lang::get('asistentes.na_title_pagina')}} | {{ Lang::get('asistentes.title_dadobaja')}} </title>
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

            <!-- columna formulario dado (baja)-->
            <div class="col-md-7">
                <div class="box box-primary">
                  <div class="panel-heading">
                    <h3 class="box-title">{{Lang::get('asistentes.texto_simple_desea_dar_baja')}}<b> {{ $asistente->nombre }} {{ $asistente->apellido }}</b></h3>
                    </div>
                    <div class="panel-body">
                      <form role="form" action="../dar-de-baja/{{ $asistente->id }}" method="post">
                        <!-- Motivo de dado (baja) -->
                        <div class="form-group">
                           <label>{{lang::get('asistentes.texto_simple_motivo')}}</label>
                           <input id="motivo" name="motivo" type="text" class="form-control" maxlength="100" placeholder=""  required/>
                        </div>
                        <!-- /Motivo de dado (baja) -->

                        <!-- Observaciones del dado (baja) -->
                        <div class="form-group">
                            <label>{{Lang::get('asistentes.texto_simple_observaciones')}}</label>
                            <textarea id="observaciones" name="observaciones" class="form-control" rows="5"  maxlength="500" placeholder="" required> </textarea>
                        </div>
                        <!-- /Observaciones del dado (baja) -->

                        <br><br>
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> {{Lang::get('asistentes.texto_boton_aceptar')}} </button>
                        <a href="/asistentes" class="btn bg-btn btn-danger"> <i class="fa fa-undo"></i> {{Lang::get('asistentes.boton_cancelar')}}</a>
                      </form>
                    </div>
                </div>
            </div>
            <!-- /columna formulario dado (baja)-->

             <!-- Cuadro de informacion-->
              <div class="col-lg-5 col-md-6"> 
                <div class="box">
                  <div class="panel-heading text-center bg-light-redil ">
                    <div class="box-body text-center" > 
                      <img src="/img/fotos/{{ $asistente->foto }}" class="img-circle" style= "height: 120px; width: 120px;" alt="User Image" />
                    </div>                
                  </div>
                  <div class="panel-body text-center bg-light-redil ">
                    <i class="fa fa-hand-o-down fa-4x"></i>
                    <h2><b>{{Lang::get('asistentes.title_dadobaja')}}</b></h2>  
                    <h4><span class="capitalize"><b>{{Lang::get('asistentes.texto_simple_nombre_asistente_baja')}}: </b> </span>{{$asistente->nombre}} {{$asistente->apellido}}</h4>
                    <h4><b>{{Lang::get('asistentes.texto_campo_tipo_asistente')}}: </b>  {{$asistente->tipoAsistente->nombre}} </h4> 
                    @if($lineas > 0)
                      <h4><b> {{Lang::get('asistentes.texto_simple_No_linea_cargo')}} </b> {{$lineas}} </h4> 
                    @endif 
                    @if($grupos_directos > 0)
                      <h4><b> {{Lang::get('asistentes.texto_simple_No_grupos_directos')}}: </b> {{$grupos_directos}} </h4> 
                    @endif 

                    @if($grupos_indirectos > 0)
                      <h4><b> {{Lang::get('asistentes.texto_simple_No_grupos_indirectos')}} </b> {{$grupos_indirectos}} </h4> 
                    @endif               
                  </div>
                </div>
                <div class="box">
                  <div class="panel-heading text-center bg-light-redil ">
                                      
                  </div>
                  <div class="panel-body text-center bg-light-redil ">
                                  
                  <i class="fa fa-info fa-4x"></i>
                  <h2><b>{{Lang::get('asistentes.texto_simple_recuerda_alta')}}</b></h2>
                  <p> 
                   {{Lang::get('asistentes.texto_mensaje_dar_recuerda_dar_alta')}}
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