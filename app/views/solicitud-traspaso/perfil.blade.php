@if(Auth::check())
@include('includes.lenguaje')

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Redil | Solicitud de traslado de asistente </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        
        @include('includes.styles')

        <!-- datepicker.css -->
        <link href="/css/datepicker.css" rel="stylesheet" type="text/css" />
        <link href="/css/datepicker3.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- iCheck for checkboxes and radio inputs -->
        <link href="/css/iCheck/all.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap multiselect-->
        <link rel="stylesheet" href="/css/bootstrap-multiselect.css" type="text/css"/>
        <!-- Bootstrap time Picker -->
        <link href="/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
        <!-- HTML5 Shim and Repond.js IE8 support of HTML5 elements and media queries -->
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
                        <h3 class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-padding content-header barra-titulo">
                            <span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">SOLICITUD DE TRASLADO DE ASISTENTE</span>
                            <small class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">Aquí podras ver, aceptar o rechazar la solicitud del traslado a otro grupo de uno de tus asistentes </small>
                        </h3>
                        @if($solicitud->estado==0 && $solicitud->solicitante->id!=Auth::user()->asistente_id)
                        <div class="pull-right box-tools">
                          <button id="aceptar-traspaso" class="btn btn-danger"> <i class="fa fa-check"></i> Aceptar Traslado</button>
                          <button id="rechazar-traspaso" class="btn bg-light-redil"> <i class="fa fa-times"></i> Rechazar Traslado</button>
                        </div>
                        @endif
                      </div>
                    </section>
                    <!-- /contendio cabezote -->             
                   
                    <!-- Contenido Principal -->
                     <section class="content">
                    
                            <div class="row">
                         		
                                <!-- columna del boton guardar -->
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"style="margin-bottom: 10px;">
                                    <div >
                                      <div class="callout callout-info col-lg-12" style="padding-bottom:5px; padding-top:5px; margin-bottom: -5px" >
                                        
                                        @if($solicitud->estado!=0)
                                          <b>Esta solicitud fue respondida por @if($solicitud->responde_id!=0){{ $solicitud->respondidoPor->nombre." ".$solicitud->respondidoPor->apellido }} @else el Super Administrador @endif</b>
                                        @else
                                          @if(Auth::user()->id==1)
                                            <b>Una persona ha solicitado el traslado de un asistente a otro grupo</b>
                                          @elseif(Auth::user()->asistente->id==$solicitud->solicitante->id)
                                            <b>La solicitud aún esta pendiente, debes esperar a que alguno de los encargados responda tu solicitud</b> 
                                          @else
                                            <b>Una persona ha solicitado el traslado de uno de tus asistentes a uno de sus grupos</b> 
                                          @endif 
                                        @endif
                                      </div>
                                    </div>
                                </div>

                                @if($solicitud->estado!=0)
                                  <!-- Información de respuesta de la solicitud --> 
                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="panel">
                                        <div class="panel-heading">
                                           <h4 class="modal-title"> Información de respuesta de la solicitud </h4>    
                                        </div>
                                        <div class="panel-body">  
                                          
                                          <div style="padding: 5px;" class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <h4><b>@if($solicitud->responde_id==0)Usuario que dió respuesta: @else Asistente que dió respuesta: @endif</b></h4>
                                            <div class="item-seleccionado">
                                              <div id="ico-integrante" class="icono-item no-padding col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                                <center>
                                                  <img style="margin-left:-9px;margin-top:4px" src="/img/@if($solicitud->responde_id==0)iglesia/{{ Iglesia::find(1)->logo }} @else{{'fotos/'.$solicitud->respondidoPor->foto}} @endif" class="img-circle img-responsive" width="100px" alt="User Image">
                                                </center>
                                              </div>
                                              <div id="info-integrante" class="no-padding col-xs-12 col-sm-8 col-md-8 col-lg-8 ">
                                                @if($solicitud->responde_id!=0)<h4 class="titulo"><b>Asistente </b></h4>
                                                <p><b>Código: </b>{{ $solicitud->respondidoPor->id }}</p>@endif
                                                <p class="puntos">@if($solicitud->responde_id==0)Administrador @else{{$solicitud->respondidoPor->nombre}} {{$solicitud->respondidoPor->apellido}}@endif</p>
                                                @if($solicitud->responde_id!=0)
                                                  @if ($solicitud->respondidoPor->tipoAsistente['id']==5)
                                                    <label class="label arrowed-right" style="background-color: purple;" data-toggle="tooltip" data-placement="top" title="{{ $solicitud->respondidoPor->tipoAsistente['nombre'] }}"> <i class="fa fa-book"></i> {{ $solicitud->respondidoPor->tipoAsistente['nombre'] }}</label> 
                                                  @elseif($solicitud->respondidoPor->tipoAsistente['id']==3)
                                                    <label class="label arrowed-right bg-blue" data-toggle="tooltip" data-placement="top" title="{{ $solicitud->respondidoPor->tipoAsistente['nombre'] }}"><i class="fa fa-child"></i> {{ $solicitud->respondidoPor->tipoAsistente['nombre'] }}</label> 
                                                  @elseif($solicitud->respondidoPor->tipoAsistente['id']==4)
                                                    <label class="label arrowed-right bg-orange" data-toggle="tooltip" data-placement="top" title="{{ $solicitud->respondidoPor->tipoAsistente['nombre'] }}"><i class="fa fa-star-o"></i> {{ $solicitud->respondidoPor->tipoAsistente['nombre'] }}</label> 
                                                  @elseif($solicitud->respondidoPor->tipoAsistente['id']==2)
                                                    <label class="label arrowed-right bg-aqua" data-toggle="tooltip" data-placement="top" title="{{ $solicitud->respondidoPor->tipoAsistente['nombre'] }}"><i class="fa fa-group"></i> {{ $solicitud->respondidoPor->tipoAsistente['nombre'] }}</label> 
                                                  @elseif($solicitud->respondidoPor->tipoAsistente['id']==1)
                                                    <label class="label arrowed-right bg-teal" data-toggle="tooltip" data-placement="top" title="{{ $solicitud->respondidoPor->tipoAsistente['nombre'] }}"><i class="fa fa-heart"></i> {{ $solicitud->respondidoPor->tipoAsistente['nombre'] }}</label> 
                                                  @endif 
                                                @else
                                                  <label class="label arrowed-right" style="background-color: #00A65A;"> <i class="fa fa-key"></i> Super Administrador</label> 
                                                @endif
                                              </div>
                                            </div>
                                          </div>
                                          <div style="padding: 5px 15px;" class="vertical-medio col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                            <h4><b>Fecha solicitud: </b>{{ $solicitud->fecha_respuesta }}</h4>
                                            <h4><b>Observación: </b>{{ $solicitud->observacion_respuesta }}</h4>
                                            <h2>
                                              @if($solicitud->estado==1)
                                                <label class="label bg-green"><i class="fa fa-check"></i> ACEPTADA</label>
                                              @else
                                                <label class="label bg-red"><i class="fa fa-times"></i> RECHAZADA</label>
                                              @endif
                                            </h2>
                                          </div>
                                        </div>
                                    </div> 
                                  </div> 
                                  <!-- Fin información de respuesta d ela solicitud --> 
                                  @endif
                                
                                <!-- Información del Solicitante --> 
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="panel">
                                        <div class="panel-heading">
                                           <h4 class="modal-title"> Información del solicitante </h4>    
                                        </div>
                                        <div class="panel-body">
                                          <h4><b>Solicitante: </b></h4>
                                          <div style="padding: 5px;" id="item-integrante-558" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="item-seleccionado">
                                              <div id="ico-integrante" class="icono-item no-padding col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                                <center>
                                                  <img style="margin-left:-9px;margin-top:4px" src="/img/fotos/{{$solicitud->solicitante->foto}}" class="img-circle img-responsive" width="100px" alt="User Image">
                                                </center>
                                              </div>
                                              <div id="info-integrante" class="no-padding col-xs-12 col-sm-8 col-md-8 col-lg-8 ">
                                                <h4 class="titulo"><b>Asistente </b></h4>
                                                <p><b>Código: </b>{{ $solicitud->solicitante->id }}</p>
                                                <p class="puntos">{{$solicitud->solicitante->nombre}} {{$solicitud->solicitante->apellido}}</p>
                                                @if ($solicitud->solicitante->tipoAsistente['id']==5)
                                                  <label class="label arrowed-right" style="background-color: purple;" data-toggle="tooltip" data-placement="top" title="{{ $solicitud->solicitante->tipoAsistente['nombre'] }}"> <i class="fa fa-book"></i> {{ $solicitud->solicitante->tipoAsistente['nombre'] }}</label> 
                                                @elseif($solicitud->solicitante->tipoAsistente['id']==3)
                                                  <label class="label arrowed-right bg-blue" data-toggle="tooltip" data-placement="top" title="{{ $solicitud->solicitante->tipoAsistente['nombre'] }}"><i class="fa fa-child"></i> {{ $solicitud->solicitante->tipoAsistente['nombre'] }}</label> 
                                                @elseif($solicitud->solicitante->tipoAsistente['id']==4)
                                                  <label class="label arrowed-right bg-orange" data-toggle="tooltip" data-placement="top" title="{{ $solicitud->solicitante->tipoAsistente['nombre'] }}"><i class="fa fa-star-o"></i> {{ $solicitud->solicitante->tipoAsistente['nombre'] }}</label> 
                                                @elseif($solicitud->solicitante->tipoAsistente['id']==2)
                                                  <label class="label arrowed-right bg-aqua" data-toggle="tooltip" data-placement="top" title="{{ $solicitud->solicitante->tipoAsistente['nombre'] }}"><i class="fa fa-group"></i> {{ $solicitud->solicitante->tipoAsistente['nombre'] }}</label> 
                                                @elseif($solicitud->solicitante->tipoAsistente['id']==1)
                                                  <label class="label arrowed-right bg-teal" data-toggle="tooltip" data-placement="top" title="{{ $solicitud->solicitante->tipoAsistente['nombre'] }}"><i class="fa fa-heart"></i> {{ $solicitud->solicitante->tipoAsistente['nombre'] }}</label> 
                                                @endif 
                                              </div>
                                            </div>
                                          </div>
                                          <br><br>
                                          <h4 style="margin-top: 120px!important"><b>Grupo destino: </b></h4>
                                          <div style="padding: 5px;" id="grupo-seleccionado" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  
                                            <div class="item-seleccionado">
                                              <div id="ico-grupo" class="icono-item col-xs-12 col-sm-4 col-md-4 col-lg-4 bg-blue " >
                                                <center><i class="fa fa fa-share-alt fa-4x" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></i></center>
                                              </div>  
                                              <div id="info-grupo" class="col-xs-12 col-sm-8 col-md-8 col-lg-8 ">
                                                  <h4><b>Grupo </b></h4>
                                                  <p><b>Código: </b>{{$grupo_destino->id}}</p>
                                                  <p class="puntos">{{$grupo_destino->nombre}}</p>
                                                  @if($grupo_destino->id!=1)
                                                  <p><b>Linea: </b>@if(isset($grupo_destino->linea()->id)){{$grupo_destino->linea()->nombre}} @else No tiene linea definida @endif</p><br> 
                                                  @endif
                                                  
                                                    @if($grupo_destino->encargados->count() > 0) 
                                                    <p><b>Encargados: </b> </p>
                                                      @foreach ($grupo_destino->encargados as $encargado)
                                                        @if ($encargado->tipoAsistente['id']==5)
                                                          <label class="label arrowed-right bg-purple" data-toggle="tooltip" data-placement="top" title="{{ $encargado->tipoAsistente['nombre'] }}"><i class="fa fa-book" style="margin-right:15 px;"> </i></label> 
                                                        @elseif($encargado->tipoAsistente['id']==4)
                                                          <label class="label arrowed-right bg-orange" data-toggle="tooltip" data-placement="top" title="{{ $encargado->tipoAsistente['nombre'] }}"><i class="fa fa-star" style="margin-right:15 px;"> </i></label> 
                                                        @endif
                                                        <span class="capitalize">{{ $encargado->nombre." ".$encargado->apellido }} </span>
                                                        <br>
                                                      @endforeach
                                                    @else
                                                     Este Grupo no tiene ningún encargado. 
                                                    @endif
                                              </div> 
                                            </div>
                                          </div>   
                                      </div>
                                    </div> 
                                    <!-- fin informacion solicitante --> 
                                  </div>

                                  <!-- Información del asistente a traspasar --> 
                                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="panel">
                                        <div class="panel-heading">
                                           <h4 class="modal-title"> Información del asistente solicitado para traslado </h4>    
                                        </div>
                                        <div class="panel-body">  
                                          <h4><b>Asistente solicitado: </b></h4>
                                          <div style="padding: 5px;" id="item-integrante-558" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="item-seleccionado">
                                              <div id="ico-integrante" class="icono-item no-padding col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                                <center>
                                                  <img style="margin-left:-9px;margin-top:4px" src="/img/fotos/{{$solicitud->asistente->foto}}" class="img-circle img-responsive" width="100px" alt="User Image">
                                                </center>
                                              </div>
                                              <div id="info-integrante" class="no-padding col-xs-12 col-sm-8 col-md-8 col-lg-8 ">
                                                <h4 class="titulo"><b>Asistente </b></h4>
                                                <p><b>Código: </b>{{ $solicitud->asistente->id }}</p>
                                                <p class="puntos">{{$solicitud->asistente->nombre}} {{$solicitud->asistente->apellido}}</p>
                                                @if ($solicitud->asistente->tipoAsistente['id']==5)
                                                  <label class="label arrowed-right" style="background-color: purple;" data-toggle="tooltip" data-placement="top" title="{{ $solicitud->asistente->tipoAsistente['nombre'] }}"> <i class="fa fa-book"></i> {{ $solicitud->asistente->tipoAsistente['nombre'] }}</label> 
                                                @elseif($solicitud->asistente->tipoAsistente['id']==3)
                                                  <label class="label arrowed-right bg-blue" data-toggle="tooltip" data-placement="top" title="{{ $solicitud->asistente->tipoAsistente['nombre'] }}"><i class="fa fa-child"></i> {{ $solicitud->asistente->tipoAsistente['nombre'] }}</label> 
                                                @elseif($solicitud->asistente->tipoAsistente['id']==4)
                                                  <label class="label arrowed-right bg-orange" data-toggle="tooltip" data-placement="top" title="{{ $solicitud->asistente->tipoAsistente['nombre'] }}"><i class="fa fa-star-o"></i> {{ $solicitud->asistente->tipoAsistente['nombre'] }}</label> 
                                                @elseif($solicitud->asistente->tipoAsistente['id']==2)
                                                  <label class="label arrowed-right bg-aqua" data-toggle="tooltip" data-placement="top" title="{{ $solicitud->asistente->tipoAsistente['nombre'] }}"><i class="fa fa-group"></i> {{ $solicitud->asistente->tipoAsistente['nombre'] }}</label> 
                                                @elseif($solicitud->asistente->tipoAsistente['id']==1)
                                                  <label class="label arrowed-right bg-teal" data-toggle="tooltip" data-placement="top" title="{{ $solicitud->asistente->tipoAsistente['nombre'] }}"><i class="fa fa-heart"></i> {{ $solicitud->asistente->tipoAsistente['nombre'] }}</label> 
                                                @endif 
                                              </div>
                                            </div>
                                          </div>
                                          <br><br>
                                          <h4 style="margin-top: 120px!important"><b>Grupo al que pertenece: </b>{{ $solicitud->grupoActual->id." ".$solicitud->grupoActual->nombre }}</h4>
                                          <h4><b>Fecha solicitud: </b>{{ $solicitud->fecha_solicitud }}</h4>
                                          <h4><b>Motivo: </b>{{ $solicitud->motivo }}</h4>
                                          <h4><b>Descripción: </b>{{ $solicitud->descripcion }}</h4>

                                        </div>
                                    </div> 
                                  </div> 
                                <!-- Fin información del asistente a traspasar --> 
                                  <!-- columna de los botones -->
                                  <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                    @if($solicitud->estado==0 && $solicitud->solicitante->id!=Auth::user()->asistente_id)
                                      <button id="aceptar-traspaso" class="btn btn-danger"> <i class="fa fa-check"></i> Aceptar Traspaso</button>
                                      <button id="rechazar-traspaso" class="btn bg-light-redil"> <i class="fa fa-times"></i> Rechazar Traspaso</button>
                                    @endif
                                  </div>
                            </div> 

                            <br><br>
                           
                                               			 	 
                    </section><!-- /.content -->
                </aside>
            
        </div><!-- ./wrapper -->
                

    <!-- /modal para avisarle al usuario que el asistente no es del mismo grupo del ya seleccionado  -->
    <div id="modal_aceptar_traspaso" class="modal-advertencia modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <form id="hacer-traspaso" method="post" action="/solicitudes-traspaso/responder-solicitud/{{ $solicitud->id }}/1">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h3 class="titulo">Trasladar el asistente</h3>
            </div>
            <div class="modal-body">
              <h4 class="mensaje modal-title bg-danger"> 
                @if($asistente->grupos()->count()>0)
                <?php 
                $grupos_directos=$asistente->grupos()->count();
                $grupos_encargados=$asistente->gruposMinisterio()->count() ?>
                  El asistente <b>{{ "Cod. ".$asistente->id." - ".$asistente->nombre." ".$asistente->apellido }}</b> esta encargado de:<br><br>
                  <b>
                  @if($grupos_encargados>0){{$grupos_encargados }} grupo(s) @endif<br>
                  {{ $asistente->discipulos()->count() }} asistente(s)</b><br><br>
                  ¿Desea trasladarlo junto con su ministerio?
                @else
                  El asistente <b>{{ "Cod. ".$asistente->id." - ".$asistente->nombre." ".$asistente->apellido }}</b> sera cambiado de grupo,<br> ¿Estas seguro que quiere aceptar el traspaso? 
                @endif
              </h4>
              <div class="form-group">
                <label>Observación: </label>
                <textarea id="descripcion" name="descripcion" class="form-control" rows="3"  maxlength="500"  placeholder="Si lo deseas puedes escribir alguna observación..."></textarea>
              </div>
            </div>
            <div class="modal-footer">
              @if($asistente->grupos()->count()>0)
                <input target="_blank" id="aceptar-con-ministerio" type="button" class="si btn btn-danger" value="Si, Trasladar con su ministerio">
                <input target="_blank" id="aceptar" type="submit" class="si btn btn-danger" value="No, Trasladar solo al asistente">
              @else
                <input target="_blank" id="aceptar" type="submit" class="si btn btn-danger" value="Si, Aceptar Traslado">
              @endif
                <button type="button" class="btn bg-light-redil" data-dismiss="modal">Cancelar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /modal   -->

    <!-- /modal para avisarle al usuario que el asistente no es del mismo grupo del ya seleccionado  -->
    <div id="modal_rechazar_traspaso" class="modal-advertencia modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <form id="rechazar-traspaso" method="post" action="/solicitudes-traspaso/responder-solicitud/{{ $solicitud->id }}/2">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h3 class="titulo">Rechazar traslado de asistente</h3>
            </div>
            <div class="modal-body">
              <h4 class="mensaje modal-title bg-danger"> 
                  La solicitud de traslado del asistente <b>{{ "Cod. ".$asistente->id." - ".$asistente->nombre." ".$asistente->apellido }}</b> sera rechazada, ¿Estas seguro que quiere rechazar el traspaso? 
              </h4>
              <div class="form-group">
                <label>Observación: </label>
                <textarea id="descripcion" name="descripcion" class="form-control" rows="3"  maxlength="500"  placeholder="Escribe la razón por la que rechazas la solicitud..." required></textarea>
              </div>
            </div>
            <div class="modal-footer">
                <input target="_blank" id="aceptar" type="submit" class="si btn btn-danger" value="Si, Rechazar el Traslado">
                <button type="button" class="btn bg-light-redil" data-dismiss="modal">Cancelar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /modal   -->


            


            @include('includes.scripts')
               

            <!-- script general evento del modal de cambiar de grupo a un asistente para poder ser añadido como servidor -->
            <script type="text/javascript">
              $("#aceptar-traspaso").click(function(){
                $('#modal_aceptar_traspaso').modal('show');
              });

              $("#aceptar-con-ministerio").click(function(){
                $('#hacer-traspaso').attr("action", "/solicitudes-traspaso/responder-solicitud/{{ $solicitud->id }}/1/con-ministerio");
                 $('#hacer-traspaso').submit();
              });

              $("#rechazar-traspaso").click(function(){
                $('#modal_rechazar_traspaso').modal('show');
              });

              $(document).ready(function() {
                $("#menu_asistentes").children("a").first().trigger('click');
                  
              });

            </script>

    </body>
</html>
@endif