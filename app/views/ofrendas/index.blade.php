@if(Auth::check())
@include('includes.lenguaje')
<!DOCTYPE html>
<!-- Vista creada por: Felipe Fajardo
     Fecha creacíón: 24-04-2015
     Fecha Ultima modificación: 05-05-2015 12:05pm
     funcion vista: esta es la vista que contiene el listado de todas las ofrendas.
     software REDIL version 1.0
-->
<html>
<head>
  <meta charset="UTF-8">
  <title> Redil | Lista de ingresos</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  
  @include('includes.styles')
  <!-- daterangepicker -->
  <link href="/css/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="/css/chosen/bootstrap-chosen.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond../js/1.3.0/respond.min.js"></script>
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

                <!-- sidebar menu: : style can be found in sidebar.less -->

                @include('includes.menu')

              </section>
              <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
              <!-- contendio cabezote -->
              <section class="content-header">
                <div class="box-header"> <!-- Inicio del Box Header del Box Filtro -->
                  <div class="pull-right box-tools">
                     @if(Auth::user()->id==1)
                     <a href="/ofrendas/nuevo" class="btn btn-danger btn-md"> <i class="fa fa-plus"></i> Nuevo Ingreso </a>
                     @endif
                     <button data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Imprimir" onclick="window.print();"><i class="fa fa-print"></i></button>
                     <!-- <button data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Enviar por Email"><i class="fa fa-envelope"></i></button> -->
                     <a target="blank" href="../reportes-ofrendas/{{ $fecha_inicio }}/{{ $fecha_fin }}@if(isset($linea))/{{ $linea }}@endif" data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Generar Archivo PDF"><i class="fa fa-file-pdf-o "></i></a>
                     <button class="btn btn-danger btn-md" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Desplegar Filtros"><i class="fa fa-filter"></i></button>
                  </div>
                   
                  <h3 class=" content-header" style="font-size:24px">
                    LISTA DE INGRESOS 
                    <small style="font-size:15px; font-weight:300;"> Aquí encuentras la lista de donaciones de la membresía de tu iglesia. </small>
                  </h3>
                </div> <!-- Fin de Box Header del Box Filtro -->
              </section>

              <div class="col-lg-12">
                <?php $status=Session::get('status'); 
                $ofrenda_id_eliminada=Session::get('ofrenda_id_eliminada'); 
                ?>
                @if($status=='ok_delete')
                <div class="alert alert-success col-lg-12 desvanecer" style="padding-bottom:5px; padding-top:5px; margin-bottom: -5px">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  El Ingreso con Id: {{$ofrenda_id_eliminada}} fue eliminado satisfactoriamente. 
                </div>
                @endif
              </div>
            <!-- /contendio cabezote -->

            <!-- contenido principal -->
            <section class="content">

              <!-- row de cuadro de colores -->
              <div class="row-fluid">
                <!-- cuadro todos -->
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 contador" data-toggle="tooltip" data-placement="top" >
                  <div class="small-box bg-yellow">
                    <div class="inner">
                      <h3>
                        <br>
                      </h3>
                      <p>
                        Listar por ingreso
                      </p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-certificate"></i>
                    </div>
                    <a href="por-ingreso?buscar={{ $buscar }}&fecha-inicio={{ $fecha_inicio }}&fecha-fin={{ $fecha_fin }}&linea={{ $linea }}" class="small-box-footer">Ver<i class="fa fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div>
                <!-- /cuadro todos -->

                <!-- cuadro por reunion --> 
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 contador">
                  <div class="small-box bg-light-blue">
                    <div class="inner">
                      <h3>
                        <br>
                      </h3>
                      <p>
                        Listar por asistente
                      </p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-user"></i>
                    </div>
                    <a href="por-asistente?buscar={{ $buscar }}&fecha-inicio={{ $fecha_inicio }}&fecha-fin={{ $fecha_fin }}&linea={{ $linea }}" class="small-box-footer">Ver<i class="fa fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div><!-- /cuadro por reunion -->


                <!-- cuadro por reunion 
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 contador">
                  <div class="small-box bg-red">
                    <div class="inner">
                      <h3>
                        <br>
                      </h3>
                      <p>
                        Por reunion
                      </p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-home"></i>
                    </div>
                    <a href="por-reunion?buscar={{ $buscar }}&fecha-inicio={{ $fecha_inicio }}&fecha-fin={{ $fecha_fin }}&linea={{ $linea }}" class="small-box-footer">Ver<i class="fa fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div><!-- /cuadro por reunion 


                <!-- cuadro por grupo 
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 contador">
                  <div class="small-box bg-teal">
                    <div class="inner">
                      <h3>
                        <br>
                      </h3>
                      <p>
                        Por grupo
                      </p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-users"></i>
                    </div>
                    <a href="por-grupo" class="small-box-footer">Ver<i class="fa fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div>
                <!-- /cuadro por grupo 


                <!-- Cuadro otros 
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 contador">
                  <div class="small-box bg-aqua">
                    <div class="inner">
                      <h3>
                        <br>
                      </h3>
                      <p>
                        Otros
                      </p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-align-justify"></i>
                    </div>
                    <a href="otros?buscar={{ $buscar }}&fecha-inicio={{ $fecha_inicio }}&fecha-fin={{ $fecha_fin }}&linea={{ $linea }}" class="small-box-footer">Ver<i class="fa fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div>
                <!-- /cuadro otros -->
 
              
                <?php $fecha_actual=new DateTime();
                $ano = $fecha_actual->format('Y');

                $mes = $fecha_actual->format('m');
                ?>

                <!-- 
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 contador">
                  <div class="small-box bg-blue">
                    <div class="inner">
                      <h3 class="mes-seleccionado">
                      <?php $mes_nombre="Mes Actual";
                      if($mes==1)
                      $mes_nombre="Enero";
                      else if($mes==2)
                      $mes_nombre="Febrero";
                      else if($mes==3)
                      $mes_nombre="Marzo";
                      else if($mes==4)
                      $mes_nombre="Abril";
                      else if($mes==5)
                      $mes_nombre="Mayo";
                      else if($mes==6)
                      $mes_nombre="Junio";
                      else if($mes==7)
                      $mes_nombre="Julio";
                      else if($mes==8)
                      $mes_nombre="Agosto";
                      else if($mes==9)
                      $mes_nombre="Septiembre";
                      else if($mes==10)
                      $mes_nombre="Octubre";
                      else if($mes==11)
                      $mes_nombre="Noviembre";
                      else if($mes==12)
                      $mes_nombre="Diciembre";
                      ?>
                      {{ $mes_nombre }}
                      </h3>
                      <p>
                        Mes Actual
                      </p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <a href="mes" class="small-box-footer">Ver<i class="fa fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 contador">
                  <div class="small-box bg-orange">
                    <div class="inner">
                      <h3>
                        {{ $ano }}
                      </h3>
                      <p>
                        Año Actual
                      </p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <a href="año" class="small-box-footer">Ver<i class="fa fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div> 
                /cuadro  Mes actual -->
              </div>
              <!-- /row de cuadro de colores -->

              <!-- row de la tabla -->
              <div class="row">   

                <!-- div de 12 columnas -->                     
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" style="padding-right:0px;">
                  <div class="box box-primary">
                    <div class="panel-body">
                      <!-- tabla -->
                      <div class="box-body table-responsive">

                        <!--<div class="collapse" id="busqueda-avanzada">
                          <div class="well">
                            Proximamente busqueda detallada ... 
                          </div>
                        </div>  --> 

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                          @if(isset($buscar))
                          @if($buscar!="")
                          @if($ofrendas->getTotal() == 1)
                          <h4>La busqueda arrojo <b>{{ $ofrendas->getTotal() }}</b> ofrenda. </h4>
                          @else
                          <h4>La busqueda arrojo <b>{{ $ofrendas->getTotal() }}</b> ofrendas. </h4>
                          @endif                       
                          @endif
                          @endif
                          <form id="filtros" action="" method="get" role="form" class="form-inline">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 campo-filtro">
                              <div class="input-group">
                                <input type="text" id="buscar" name="buscar" class="form-control" value="{{ Input::get('buscar') }}" placeholder=" Busque aqui ..." >
                                <span class="input-group-btn">
                                  @if(isset($buscar) && $buscar!="")
                                  <button id="limpiar" class="btn btn-danger" ><i class="fa fa-times"></i></button>
                                  
                                  @endif 
                                  <button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
                                  <!--<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#busqueda-avanzada" aria-expanded="false" aria-controls="collapseExample">
                                   Busqueda avanzada 
                                 </button>-->
                                </span>
                              </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 campo-filtro">
                              <input id="fecha-filtro-inicio" name="fecha-inicio" type="hidden" />
                              <input id="fecha-filtro-fin" name="fecha-fin" type="hidden" />
                              <div id="reportrange" style="background: #fff; cursor: pointer; padding: 6px 10px; border: 1px solid #ccc;">
                                  <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                  <span></span> <b class="caret"></b>
                              </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 campo-filtro">
                              <select style="width:100%" id="linea" name="linea" class="chosen-select" data-placeholder="Filtro por línea" >
                                  <option value="" @if(isset($linea)) @if($linea=="") selected @endif @endif >Todas las líneas</option>
                                  @foreach($lineas as $lin) <!-- Se le coloco lin porque linea ya era una variable que viene del controlador -->
                                  <option value="{{ $lin->id }}" @if(isset($linea)) @if($linea==$lin->id) selected @endif @endif>{{ $lin->id." - ".$lin->nombre  }}</option>
                                  @endforeach
                              </select>
                            </div>
                            @if($tipo=="por-asistente")
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 campo-filtro">
                              <select style="width:100%" id="ordenado-por" name="ordenado-por" class="form-control" data-placeholder="Filtro por línea" >
                                <option value="asistentes.id" @if(isset($ordenado_por)) @if($ordenado_por=="asistentes.id") selected @endif @endif >Ordenado por Cod. Asistente</option>
                                <option value="total" @if(isset($ordenado_por)) @if($ordenado_por=="total") selected @endif @endif >Ordenado por Total</option>
                              </select>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 campo-filtro">
                              <select style="width:100%" id="orden" name="orden" class="form-control" data-placeholder="Filtro por línea" >
                                <option value="asc" @if(isset($orden)) @if($orden=="asc") selected @endif @endif >Ascendente</option>
                                <option value="desc" @if(isset($orden)) @if($orden=="desc") selected @endif @endif >Descendente</option>
                              </select>
                            </div>
                            @endif
                         </form>
                     <br>
                     <br>

                     <h4 id="contenido-listado" class="col-lg-12 col-md-12 col-sm-12 colxs-12"> </h4>

                       <table id="example1" class="table table-striped display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                           <th>Asistente</th>
                           <th>Valor</th>
                           @if($tipo=='por-ingreso')
                           <th>Información</th>
                           <th></th>
                           @endif
                         </tr>
                        </thead>
                        <tbody>

                        @if($tipo=="por-ingreso")
                           @foreach($ofrendas as $ofrenda)

                          <tr>

                            <td>
                              <?php $nombre_asistente=""; ?>
                              @if(isset($ofrenda->asistente->nombre))
                              <?php $nombre_asistente=$ofrenda->asistente->nombre." ".$ofrenda->asistente->apellido; ?>
                              <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Codigo">Cod</label>  {{ $ofrenda->asistente_id }} <br>
                              <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Nombre"> <i class="fa fa-user"></i></label> <span class="capitalize"> {{ $nombre_asistente }} </span><br>
                              @if($ofrenda->asistente->dado_baja==1)
                              <label class="label arrowed-right label-danger" data-toggle="tooltip" data-placement="top" title="Dado de baja"> <i class="fa fa-minus-circle"></i></label> ASISTENTE DADO DE BAJA <br>
                              @endif
                              @else
                              <br> <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Ofrenda Suelta"> <i class="fa fa-user"></i></label>  OFRENDA SUELTA <br>
                              @endif

                            </td>

                            <td>

                              @if($ofrenda->tipo_ofrenda==0)
                              <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top"> Diezmo </label> <br>
                              @elseif($ofrenda->tipo_ofrenda==1)
                              <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top"> Ofrenda </label> <br>
                              @elseif($ofrenda->tipo_ofrenda==2)
                              <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top"> Pacto </label> <br>
                              @elseif($ofrenda->tipo_ofrenda==3)
                              <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top"> Pro-Templo </label> <br>
                              @elseif($ofrenda->tipo_ofrenda==4)
                              <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top"> Siembra </label> <br>
                              @elseif($ofrenda->tipo_ofrenda==5)
                              <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top"> Primicia </label> <br>
                              @elseif($ofrenda->tipo_ofrenda==6)
                              <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top"> Otro </label> <br>
                              @elseif($ofrenda->tipo_ofrenda==7)
                              <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top"> Suelta </label> <br>
                              @endif 

                              <h4><label class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="" data-original-title=""> <i class="fa fa-money"></i></label> {{ $ofrenda->valor }}  </h4>
                            </td>

                            <td>
                              <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Fecha"> <i class="fa fa-calendar"></i></label> {{ $ofrenda->fecha }}<br>
                              @if ($ofrenda->ingresada_por==0)
                              <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Ingresado por"> Ingresado por </label> Reunión <br>
                              @elseif($ofrenda->ingresada_por==1)
                              <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Ingresado por"> Ingresado por </label> Grupo <br>
                              @else
                              <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Ingresado por"> Ingresado por </label> Otro <br>
                              @endif 
                            </td>

                            <td>
                              <div class="btn-group">
                               @if(Auth::user()->id==1)

                                <button type="button" class="btn btn-success btn-info dropdown-toggle" data-toggle="dropdown">
                                  Opciones  
                                  <i class="fa fa-caret-down"> </i>
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a href="../informe/{{$ofrenda->id}}">Ver Informe</a></li>
                                  <li><a href="../actualizar/{{$ofrenda->id}}">Modificar</a></li>
                                  <li><a class="eliminar" style="cursor:pointer" 
                                    data-ofrenda-id="{{$ofrenda->id}}" data-ofrenda-valor="{{$ofrenda->valor}}"
                                    data-ofrenda-tipo="{{$ofrenda->tipo_ofrenda}}" data-asistente-nombre="{{ $nombre_asistente }}"
                                      >Eliminar</a></li>
                                </ul>
                                @else
                                <br>
                                <a href="../informe/{{$ofrenda->id}}" type="button" class="btn btn-success btn-info dropdown-toggle">
                                Ver Informe 
                                </a>
                                @endif
                              </div>
                            </td>
                          </tr>
                        @endforeach
                      @elseif($tipo=="por-asistente")
                        @foreach($asistentes as $asistente)

                          <tr>

                            <td>
                              <?php $nombre_asistente=""; ?>
                              <?php $nombre_asistente=$asistente->nombre." ".$asistente->apellido; ?>
                              <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Codigo">Cod</label>  {{ $asistente->id }} <br>
                              <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Nombre"> <i class="fa fa-user"></i></label> <span class="capitalize"> {{ $nombre_asistente }} </span><br>
                              

                            </td>

                            <td>
                              <?php 
                              $valor=$asistente->total;
                              ?>
                              <h4><label class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="" data-original-title=""> <i class="fa fa-money"></i></label> {{ Helper::separadorMiles($valor) }}  </h4>
                            </td>


                          </tr>
                        @endforeach
                      @endif

                        </tbody>
                      </table>
                    </div>

                     
                </div> 
              </div>
              <!-- /tabla -->
            </div> <!-- /panel body -->

            @if($tipo=="por-ingreso")
            <div class="box-footer">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                  <h4> <b>{{ $ofrendas->getFrom() }}</b> - <b>{{ $ofrendas->getTo() }}</b> de <b>{{ $ofrendas->getTotal() }} </b> registros.</h4> 
                </div>
                
                <div class="col-lg-12 text-right" style="padding-right: 30px!important;"> {{ $ofrendas->appends(array('buscar' => $buscar, 'fecha-inicio' => $fecha_inicio, 'fecha-fin' => $fecha_fin, 'linea' => $linea))->links() }}</div>

              </div>                  
            </div>
            @elseif($tipo=='por-asistente')
            <div class="box-footer">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                  <h4> <b>{{ $asistentes->getFrom() }}</b> - <b>{{ $asistentes->getTo() }}</b> de <b>{{ $asistentes->getTotal() }} </b> registros.</h4> 
                </div>
                
                <div class="col-lg-12 text-right" style="padding-right: 30px!important;"> {{ $asistentes->appends(array('buscar' => $buscar, 'fecha-inicio' => $fecha_inicio, 'fecha-fin' => $fecha_fin, 'orden' => $orden, 'ordenado-por' => $ordenado_por, 'linea' => $linea))->links() }}</div>

              </div>                  
            </div>
            @endif

          </div><!-- /col lg-8 -->
          <div class="col-lg-4 col-sm-4 col-xs-12 col-sm-12">
                      <div class="panel">
                        <div class="panel-heading">
                            <h4 class="modal-title"> <span class="badge bg-green">  <i class="fa fa-money fa-1x"></i> </span> Resumen Financiero</h4>
                        </div>
                        <div class="panel-body">

                        <table id="tabla_resumen_financiero" class="table table-condensedres table-hover" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>TIPO</th>
                              <th>TOTAL</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>      
                            <tr>
                                <td>
                                    <h4> Diezmos </h4>
                                </td>
                                <td>
                                    <h4><label id="total_diezmos" class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="">$</label> <label id="diezmos"> {{Helper::separadorMiles($total_diezmos)}} </label> </h4> 
                                </td>
                                <td>                                    
                                </td>
                            </tr>

                            <tr>
                              <td>
                                <h4> Ofrendas </h4>
                              </td>
                              <td>
                                  <h4><label id="total_ofrendas" class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="">$</label> <label id="ofrendas"> {{Helper::separadorMiles($total_ofrendas)}} </label> </h4> 
                              </td>   
                              <td>                                  
                              </td>
                            </tr>
                              <tr>
                                <td>
                                  <h4> Pactos </h4>
                                </td>
                                <td>
                                  <h4><label id="total_pactos" class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="">$</label> <label id="pactos"> {{Helper::separadorMiles($total_pactos)}} </label> </h4> 
                                </td>
                                 <td>                                  
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <h4> Primicias </h4>
                                </td>
                                <td>
                                  <h4><label id="total_primicias" class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="">$</label> <label id="primicias"> {{Helper::separadorMiles($total_primicias)}} </label> </h4> 
                                </td>
                                <td>                                   
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <h4> Pro-templo </h4>
                                </td>
                                <td>
                                  <h4><label id="total_protemplo" class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="">$</label> <label id="protemplo"> {{Helper::separadorMiles($total_protemplo)}} </label> </h4> 
                                </td> 
                                <td>   
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <h4> Siembra </h4>
                                </td>
                                <td>
                                  <h4><label id="total_siembras" class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="">$</label> <label id="siembras"> {{Helper::separadorMiles($total_siembras)}} </label> </h4> 
                                </td>
                                <td>
                                </td>
                              </tr>

                              <tr>
                                <td>
                                  <h4> Otro </h4>
                                </td>
                                <td>
                                  <h4><label id="total_otros" class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="">$</label> <label id="otros"> {{Helper::separadorMiles($total_otros)}} </label> </h4> 
                                </td>
                                <td>                                   
                                </td>
                              </tr>
                              
                              <tr>
                                <td>
                                  <h4> Ofrendas sueltas </h4>
                                </td>
                                <td>
                                    <h4><label id="total_ofrendas_sueltas" class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="">$</label> <label id="sueltas"> {{Helper::separadorMiles($total_ofrendas_sueltas)}} </label> </h4> 
                                </td>
                                <td>                                                
                                <!--
                                    <input name="ofrenda_suelta" type="number" class="form-control" placeholder="$" data-toggle="tooltip" data-placement="top" title="Si hay ofrenda suelta ingrese el valor en este campo, de lo contrario simplemente dejelo vacio"/>
                                --></td> 
                              </tr>
                              <tr>
                                <td class="text-right">
                                    <h4><b>TOTAL</b></h4>
                                </td>
                                <td>
                                    <h4><label id="total_ingresos" class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="">$</label> <label id="total"> {{Helper::separadorMiles($total_ingresos)}} </label> </h4> 
                                </td>
                                <td>
                                </td>
                              </tr>
                            </tbody>
                              
                          </table>
                        </div>
                      </div> <!-- /box-body -->
                    </div> 
        </div><!-- /row -->


  </section>
  <!-- contenido principal -->
</aside>  
</div><!-- /row -->

    <!-- /modal   -->
    <div id="confirmacion" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header" style="background:#F56954;color:white">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h3 style="font-size:20px">Eliminar Ingreso Financiero</h3>
            </div>
            <div class="modal-body" id="modal-body">
                  <h4 id="msn_confirmacion" class="modal-title bg-danger text-center" id="myModalLabel">  </h4>
      
            </div>
            <div class="modal-footer">
                <a href="#" id="si" type="button" class="btn btn-primary">Si</a>
                <button id="no" type="button" class="btn btn-danger" data-dismiss="modal">No</button>
            </div>
        </div>
      </div>
    </div>
    <!-- /modal   -->

<!-- incluye librerias script -->
@include('includes.scripts')

<!-- DATA TABES SCRIPT -->
<script src="/js/plugins/moment/moment.js" type="text/javascript"></script>
<script src="/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script type="text/javascript" src="/js/plugins/chosen/chosen.js"></script>

<script type="text/javascript">
$(function() {
  //select con buscador
  $('#linea').chosen({ allow_single_deselect: true });

  //esta bandera impide que entre en un bucle cuando se ejecuta la funcion cb(start, end)
  band=0;

  moment.locale('es');
    function cb(start, end) {
      $('#fecha-filtro-inicio').val(start.format('YYYY-MM-DD'));
      $('#fecha-filtro-fin').val(end.format('YYYY-MM-DD'));
      $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
      if(band==1)
      $("#filtros").submit();
      band=1;
    }

    //comprobamos si existe la fecha incio y fecha fin y creamos las fechas con el formato aceptado
    @if(isset($fecha_inicio))
    var fecha_ini = moment('{{$fecha_inicio}}'); 
    fecha_ini.format("MM-DD-YYYY"); //2014-07-10
    @endif

    @if(isset($fecha_fin))
    var fecha_fin = moment('{{$fecha_fin}}'); 
    fecha_fin.format("MM-DD-YYYY"); //2014-07-10
    @endif

    @if(isset($fecha_inicio) && isset($fecha_fin))
    cb(fecha_ini, fecha_fin);
    @else
    cb(moment().startOf('month'), moment().endOf('month'));
    @endif

   

    $('#reportrange').daterangepicker({
        ranges: {
           'Hoy': [moment(), moment()],
           //'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Ultimos 7 Dias': [moment().subtract(6, 'days'), moment()],
           'Untimos 30 Dias': [moment().subtract(29, 'days'), moment()],
           'Este mes': [moment().startOf('month'), moment().endOf('month')],
           'Mes anterior': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
           'Este año': [moment().startOf('year'), moment().endOf('year')],
           'Año anterior': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
        },
        "locale": {
          "format": "MM/DD/YYYY",
          "separator": " - ",
          "applyLabel": "Aplicar",
          "cancelLabel": "Cancelar",
          "fromLabel": "Desde",
          "toLabel": "Hasta",
          "customRangeLabel": "Otro Rango",
          "monthNames": [
              "Enero ",
              "Febrero",
              "Marzo",
              "Abril",
              "Mayo",
              "Junio",
              "Julio",
              "Agosto",
              "Septiembre",
              "Octubre",
              "Noviembre",
              "Diciembre"
          ],
          "firstDay": 1
        },
        @if(isset($fecha_inicio))
        "startDate": fecha_ini,
        @endif
        @if(isset($fecha_fin))
        "endDate": fecha_fin,
        @endif
        showDropdowns: true
        
    }, cb);

   

});
</script>

<!-- page script -->
<script type="text/javascript">

$(document).ready(function() {
  //activa (desplega) menu correspondiente
  $("#menu_ofrendas").children("a").first().trigger('click');

  $("#linea").on('change', function(){
    $("#filtros").submit();
  });

  $("#ordenado-por").on('change', function(){
    $("#filtros").submit();
  });

  $("#orden").on('change', function(){
    $("#filtros").submit();
  });

  $("#limpiar").on('click', function(){
    $("#buscar").val("");
    $("#filtros").submit();
  });

  $(".eliminar").on('click', function(){
    $("#confirmacion").modal({show: 'true'});

    var ofrenda_id=$(this).attr("data-ofrenda-id");
    var ofrenda_valor=$(this).attr("data-ofrenda-valor");
    var ofrenda_tipo=$(this).attr("data-ofrenda-tipo");
    var asistente_nombre=$(this).attr("data-asistente-nombre");  


    var tipo_de_ofrenda="el ingreso";
    var sustantivo1="";
    var sustantivo2="?";

    if(ofrenda_tipo==0)
    {
    tipo_de_ofrenda="el diezmo";
    sustantivo1=" ingresado por el(la) asistente ";
    sustantivo2="de eliminarlo?";
    }
    else if(ofrenda_tipo==1)
    {
    tipo_de_ofrenda="la ofrenda";
    sustantivo1=" ingresada por el(la) asistente ";
    sustantivo2="de eliminarla?";
    }
    else if(ofrenda_tipo==2)
    {
    tipo_de_ofrenda="el pacto";
    sustantivo1=" ingresado por el(la) asistente ";
    sustantivo2="de eliminarlo?";
    }
    else if(ofrenda_tipo==3)
    {
    tipo_de_ofrenda="el ingreso de tipo pro-templo";
    sustantivo1=" ingresado por el(la) asistente ";
    sustantivo2="de eliminarlo?";
    }
    else if(ofrenda_tipo==4)
    {
    tipo_de_ofrenda="la siembra";
    sustantivo1=" ingresada por el(la) asistente ";
    sustantivo2="de eliminarla?";
    }
    else if(ofrenda_tipo==5)
    {
    tipo_de_ofrenda="la primicia";
    sustantivo1=" ingresada por el(la) asistente ";
    sustantivo2="de eliminarla?";
    }
    else if(ofrenda_tipo==6)
    {
    sustantivo1=" depositado por el(la) asistente ";
    sustantivo2="de eliminarlo?";
    }
    else if(ofrenda_tipo==7)
    {
    tipo_de_ofrenda="la ofrenda suelta";
    sustantivo1="";
    sustantivo2="de eliminarla?";
    }

    $("#msn_confirmacion").html("Esta a punto de eliminar "+tipo_de_ofrenda+" con codigo "+ofrenda_id+sustantivo1+asistente_nombre+" por valor de $"+ofrenda_valor+"<br>Esta seguro "+sustantivo2);
    $("#si").attr("href","../eliminar/"+ofrenda_id);
  });
      
});

</script>
@endif
</body>
</html>