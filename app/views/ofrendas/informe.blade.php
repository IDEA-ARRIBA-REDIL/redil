@if(Auth::check())
@include('includes.lenguaje')
<?php $id_integrante; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Redil | Informe de Ofrenda</title>
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
                     <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                      <h3>
                       INFORME DE INGRESO 
                        <small> Aquí podrás ver el informe del ingreso</small>
                      </h3> 
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <a style="float:right; font-size:16px;" href="../lista/todos" class=" btn bg-light-redil"> <i class="fa fa-undo"></i> Volver</a>
                    </div>
               </div>

                      <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                            <div class="box-body text-left"> 
                                 <!-- informacion Grupo inmediato-->
                                         <h1> 
                                            Código de Ingreso:  {{$ofrenda->id}}
                                         </h1>  
                                         <h3 class="page-header"> Ingresado Por: 
                                         <?php $tipo=$ofrenda->ingresada_por; ?>
                                          @if($tipo==0)
                                          Reunion
                                          @elseif ($tipo==1)
                                          Grupo
                                          @elseif ($tipo==2)
                                          Otros
                                          @endif
                                         </h3> 
                                         <small class="label label-success" style="font-size: 14px"><i class="fa fa-check-square"></i> Aprobado </small>                          
                            </div>
                     </div>

                    <div class="col-md-offset-3 col-lg-offset-3 col-sm-offset-3 col-sm-3 col-md-3 col-xs-offset-1 col-lg-3 col-xs-10">
                        <div class="small-box bg-green"  style="color:white">
                                <div class="inner">
                                    <h3>
                                       
                                        <sub style="font-size: 16px;">Tipo</sub>
                                    </h3>
                                        
                                </div>
                                <div class="icon">
                                    <i class="fa fa-money"></i>
                                </div>
                                <div class="small-box-footer">
                                    <h3>
                                      @if ($ofrenda->tipo_ofrenda==0)
                                      Diezmo
                                      @elseif ($ofrenda->tipo_ofrenda==1)
                                      Ofrenda
                                      @elseif ($ofrenda->tipo_ofrenda==2)
                                      Pacto
                                      @elseif ($ofrenda->tipo_ofrenda==3)
                                      Pro-Templo
                                      @elseif ($ofrenda->tipo_ofrenda==4)
                                      Siembra
                                      @elseif ($ofrenda->tipo_ofrenda==5)
                                      Primicia
                                      @elseif ($ofrenda->tipo_ofrenda==6)
                                      Otro
                                      @elseif ($ofrenda->tipo_ofrenda==7)
                                      Suelta
                                      @endif
                                    </h3>
                                </div>
                            </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <div class="box-body text-left"> 
                                <h3>
                                  @if(isset($ofrenda->asistente->linea->nombre))
                                  <i class="fa fa-share-alt"> </i> Linea 
                                  {{ $ofrenda->asistente->linea->nombre }}    
                                  @endif
                                </h3>
                      </div>
                    </div>
                  
                    <div class="col-md-offset-2 col-lg-4">
                            <div class="box-body text-left"> 
                                  <div class="btn-group">
                                    @if(Auth::user()->id==1)
                                    <button type="button" class="btn btn-success btn-info dropdown-toggle" data-toggle="dropdown">
                                        {{ Lang::get('grupos.lg_bt_opciones') }}  
                                        <i class="fa fa-caret-down"> </i>
                                   </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="../actualizar/{{$ofrenda->id}}">{{ Lang::get('grupos.lg_bt_opciones_1') }}</a></li>
                                        <li><a href="../eliminar/{{$ofrenda->id}}">Eliminar</a></li>
                                    </ul> 
                                    @endif
                                   </div>                                               
                                        <button data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Imprimir"  onclick="window.print();" ><i class="fa fa-print"></i></button>
                                       <!-- <button data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Enviar por Email"><i class="fa fa-envelope"></i></button> -->
                                        <a href="../informe-pdf/{{$ofrenda->id}}" target="_blank" data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Por medio de este botón podrás crear un archivo pdf con la información del informe"><i class="fa fa-file-pdf-o "></i></a>
                                  <br><br>
                            </div>
            </div>
                             
                  <form id="form-reporte" action="../update/{{ $ofrenda->id }}" method="post" role="form" >
                  
                  <!-- row para el formulario -->
                                         
                 </section>
                 <!-- /contendio cabezote -->
                 

             <!-- contenido principal -->
              <section class="content">
              

                      <div class="row">
                         <!-- columna Seleccionar grupo -->
                         <?php $tamano=12; ?>
                         @if(isset($ofrenda->asistente->id))
                         <?php $tamano=6; ?>
                         @endif
                        <div class="col-lg-{{$tamano}} col-md-{{$tamano}} col-sm-{{$tamano}} col-xs-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h3 class="modal-title"> Información principal del Ingreso </h3>
                                    </div>
                                    
                                    <div class="panel-body">
                                            
                                        
                                        
                                        <!-- Fecha de reunion mm/dd/yyyy -->
                                        <h4> 
                                           <i class="fa fa-calendar"></i>   Fecha de Ingreso:  
                                            <?php $fecha=date_create($ofrenda->fecha); ?>
                                               {{ date_format($fecha, 'd/m/Y') }}
                                        </h4>
                                        
                                        <!-- /.fin Fecha de reunion -->
                                         <!-- predicaicon o tema -->
                                        <h4>
                                          <i class="fa fa-money"></i>  Valor:  
                                            {{ $ofrenda->valor }} 
                                         </h4>
                                          <!-- /predicaicon o tema -->
                                          <!-- Observaciones -->
                                          <h4>
                                             <i class="fa fa-info-circle"></i> Observaciones:
                                              <div>{{ $ofrenda->observacion }}</div>
                                          </h4>
                                         <!-- /Observaciones -->                                          
 
                                  </div>    
                               </div>
                               
                        </div>

                        <!-- /columna  Seleccionar grupo -->

                        <!-- columna Seleccionar grupo -->
                         @if(isset($ofrenda->asistente))
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h3 class="modal-title "></span> Asistente que realizó el Ingreso</h3>
                                    </div>
                                    
                                    <div class="panel-body">
                                     @if($ofrenda->asistente->dado_baja==1)
                                    <label class="label arrowed-right label-danger"><i class="fa fa-minus-circle"></i> ASISTENTE DADO DE BAJA </label>
                                    @endif
                                        <!-- informacion del lider -->
                                    <h4><i class="fa fa-user"></i> Codigo: {{ $ofrenda->asistente_id }} </h4>
                                    <h4><i class="fa fa-user"></i> Nombre: {{ $ofrenda->asistente->nombre }} {{ $ofrenda->asistente->apellido }}</h4>
                                    <h4><i class="fa fa-phone"></i> Teléfono: {{ $ofrenda->asistente->telefono_fijo }} </h4>
                                    <h4><i class="fa fa-mobile-phone"></i> Teléfono Movil: {{ $ofrenda->asistente->telefono_movil }} </h4>
                                    <h4><i class="fa fa-phone-square"></i> Teléfono Otro: {{ $ofrenda->asistente->telefono_otro }} </h4>
                                    <h4><i class="fa fa-envelope-o"></i> Email: {{ $ofrenda->asistente->user->email }} </h4>
                                    <h4><i class="fa fa-star"></i> Líder(es): 
                                    <?php $encargados=$ofrenda->asistente->grupo->encargados;
                                    $c=0; ?>
                                    @foreach($encargados as $encargado) 
                                    @if($c!=0)
                                    ,
                                    @endif
                                    <span class="capitalize">{{ $encargado->nombre }} {{ $encargado->apellido }} </span>
                                    <?php $c=$c+1; ?>
                                    @endforeach
                                    </h4>
                                    @endif
                               </div> 
                        </div>
                        <!-- /columna  Seleccionar reportar -->   
                      </div>                    

                      </div>	                     
                                        
        

        @include('includes.scripts')
       
        

         <!-- DATA TABES SCRIPT -->
         <script src="{{ Lang::get('general.url-datatables') }}" type="text/javascript"></script>
        <script src="/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script src="/js/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
        
        <!-- bootstra datepicker-->
        <script src="/js/bootstrap-datepicker.js"></script>
        <script src="/js/locales/bootstrap-datepicker.es.js"></script>

    </body>
</html>

@endif