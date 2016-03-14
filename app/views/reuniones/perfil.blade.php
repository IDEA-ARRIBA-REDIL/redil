@if(Auth::check())
@include('includes.lenguaje')
<?php $id_integrante; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Redil | Perfil de Reunión</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        @include('includes.styles')
        <!-- datepicker.css -->
        <link href="/css/datepicker.css" rel="stylesheet" type="text/css" />
        <link href="/css/datepicker3.css" rel="stylesheet" type="text/css" />
         <!-- DATA TABLES -->
        <link href="/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        
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
                  <div class="row">
                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <h3 class="content-header barra-titulo">
                       PERFIL DE REUNIÓN
                        <small> Aquí podrás ver el perfil de la reunión</small>
                      </h3> 
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <a style="float:right; font-size:16px;" href="../lista/todos" class=" btn bg-light-redil"> <i class="fa fa-undo"></i> Volver</a>
                    </div>
               </div>
                  <div class="panel-default">
                  <div class="row">

                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="box-body text-left"> 
                              <!-- informacion Grupo inmediato-->
                             <h1> 
                              <i class="fa fa-home"> </i> 
                              {{ $reunion->nombre }}    
                             </h1>  
                             <h3 class="page-header"> Código de Reunión:  
                              {{$reunion->id}}
                             </h3> 
                             <small class="label label-success" style="font-size: 14px"><i class="fa fa-check-square"></i> Vigente </small>                          
                            </div>
                     </div>
                    <div class="col-md-offset-3 col-md-3 col-xs-12">
                        <div class="small-box bg-teal"  style="color:white">
                                <div class="inner">
                                    <h3>
                                       
                                        <sub style="font-size: 16px;">Día</sub>
                                    </h3>
                                        
                                </div>
                                <div class="icon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <div class="small-box-footer">
                                    <h3>
                                    @if($reunion->dia != 0 && $reunion->dia !="" )
                                    {{ Lang::choice('general.dias', $reunion->dia) }} 
                                    @endif
                                    </h3>
                                </div>
                            </div>
                    </div>
                    <div class="col-md-offset-6 col-lg-4">
                            <div class="box-body text-left"> 
                                  @if(Auth::user()->id==1)
                                  <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-info dropdown-toggle" data-toggle="dropdown">
                                        {{ Lang::get('grupos.lg_bt_opciones') }}  
                                        <i class="fa fa-caret-down"> </i>
                                   </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="../actualizar/{{$reunion->id}}">{{ Lang::get('grupos.lg_bt_opciones_1') }}</a></li>
                                        <li><a href="../eliminar/{{$reunion->id}}">Eliminar</a></li>
                                    </ul> 
                                   </div>   
                                   @endif                                            
                                        <button data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Imprimir"  onclick="window.print();" ><i class="fa fa-print"></i></button>
                                       <!-- <button data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Enviar por Email"><i class="fa fa-envelope"></i></button> -->
                                        <a href="../informepdf/{{$reunion->id}}" target="_blank" data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Por medio de este botón podrás crear un archivo pdf con la información del informe"><i class="fa fa-file-pdf-o "></i></a>
                                  <br>
                            </div>
            </div>

                  
                  <!-- row para el formulario -->
                                         
                 </section>
                 <!-- /contendio cabezote -->
                 

             <!-- contenido principal -->
              <section class="content">
              

                      <div class="row">
                         <!-- columna Seleccionar grupo -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h4 class="modal-title"> Información principal de la Reunión </h4>
                                    </div>
                                    
                                    <div class="panel-body">
                                        
                                        <!-- /.fin Fecha de reunion -->
                                         <!-- predicaicon o tema -->
                                        <h4>
                                          <i class="fa fa-clock-o"></i>  Hora:  
                                            {{ $reunion->hora }} 
                                         </h4>
                                          <!-- /predicaicon o tema -->
                                          <h4>
                                          <i class="fa fa-home"></i>  Lugar:  
                                            {{ $reunion->lugar }} 
                                         </h4>
                                          <h4>
                                          <i class="fa fa-info-circle"></i>  Descripción:  
                                            {{ $reunion->descripcion }} 
                                         </h4>                                    
 
                                  </div>    
                               </div>
                               
                        </div>

                        <!-- /columna  Seleccionar grupo -->

                        <!-- columna Seleccionar grupo -->
                       </div> 
                        </section>      
        

        @include('includes.scripts')
       
        

         <!-- DATA TABES SCRIPT -->
         <script src="{{ Lang::get('general.url-datatables') }}" type="text/javascript"></script>
        <script src="/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script src="/js/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
        
        <!-- bootstra datepicker-->
        <script src="/js/bootstrap-datepicker.js"></script>
        <script src="/js/locales/bootstrap-datepicker.es.js"></script>
        <script type="text/javascript">
          $(document).ready(function() {
            
            $("#menu_reuniones").children("a").first().trigger('click');
          });
        </script>

    </body>
</html>

@endif