@if(Auth::check())
@include('includes.lenguaje')
<?php include '../app/views/includes/terminos.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>{{Lang::get('asistentes.na_title_pagina')}}| | {{Lang::get('asistentes.texto_titulo_perfil')}} {{ $asistente->nombre}} {{$asistente->apellido}}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
     @include('includes.styles')
    <!-- Morris charts -->
    <link href="/css/morris/morris.css" rel="stylesheet" type="text/css" />
    
    
    
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
        

        <!-- Main content -->
        <section class="content">
          <!-- Foto del asistente -->
          <div class="panel-default">
          	<div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-sm-12">
                <div class="box box-widget biografia-user">
                   @if ($asistente->tipoAsistente['id']==5)
                      <?php $class="bg-purple"; $icon="fa-book" ?>
                    @elseif($asistente->tipoAsistente['id']==4)
                      <?php $class="bg-yellow"; $icon="fa-star" ?>
                    @elseif($asistente->tipoAsistente['id']==3)
                      <?php $class="bg-blue"; $icon="fa-child" ?>
                    @elseif($asistente->tipoAsistente['id']==2)
                      <?php $class="bg-aqua"; $icon="fa-group" ?>
                    @elseif($asistente->tipoAsistente['id']==1)
                      <?php $class="bg-teal"; $icon="fa-heart" ?>
                    @endif
                  <!-- Nombre y fecha de entrada a la iglesia-->
                  <div class="biografia-user-header {{ $class }}">
                    <div class="biografia-caja">
                      <div class="biografia-caja-header">
                        <h4><i class="fa {{ $icon }} fa-1x"></i> {{ $asistente->tipoAsistente['nombre'] }} </h4>
                        <h3 class="biografia-user-username capitalize">
                          <b>{{ $asistente->nombre." ".$asistente->apellido }}</b>
                        </h3>
                        <h5 class="biografia-user-desc">@if($asistente->fecha_ingreso!="") Asiste desde el {{ Helper::fechaFormateada($asistente->fecha_ingreso) }} @else {{Lang::get('asistentex.texto_sin_fecha_ingreso')}}. @endif</h5>        
                        <h4 class="user-header">
                          @if(isset($asistente->linea->nombre)) Linea: {{ $asistente->linea->nombre }} @endif
                        </h4>
                      </div>
                    </div>

                    <div class="biografia-header-right pull-right"> 
                      <div class="btn-group">
                        <button type="button" class="btn {{ $class }} dropdown-toggle" data-toggle="dropdown">
                            Opciones  
                            <i class="fa fa-caret-down"> </i>
                        </button>
                        <ul class="dropdown-menu">                           
                          @if($asistente->trashed())
                             <li><a href="../dado-alta/{{ $asistente->id }}">{{Lang::get('asistentes.texto_opciones_dar_alta')}}</a></li>
                          @else
                             <li><a href="../actualizar/{{$asistente->id}}">{{Lang::get('asistentes.texto_opciones_modificar')}}</a></li>  
                            <li><a href="../dado-baja/{{ $asistente->id }}">{{Lang::get('asistentes.texto_opciones_dar_baja')}}</a></li>
                            @if(Auth::user()->id==1)
                              <li><a href="/usuarios/actualizar-password-usuario/{{$asistente->id}}">{{Lang::get('asistentes.texto_opciones_contraseña')}}</a></li>
                            @endif
                           
                          @endif
                          <li><a href="#">{{Lang::get('asistentes.texto_simple_eliminar')}}</a></li>                                    
                        </ul>
                      </div>
                      <button data-toggle="tooltip" title="{{Lang::get('asistentes.texto_simple_title_imprimir')}}" class="btn {{ $class }} btn-sm" data-original-title=""  onclick="window.print();" ><i class="fa fa-print"></i></button>
                      <br><br>
                    </div>
                  </div>

                  <div class="biografia-user-image">
                      <img src="/img/fotos/{{ $asistente->foto }}" class="img-circle" alt="User Image" />
                  </div>

                </div>
                  
                <!-- Estadisticas de creciemiento, escuelas y aistencia  -->
                <!--
                <div class="col-md-2 col-xs-4 col-lg-1 text-center" style="border-right: 1px solid #f4f4f4">
                  <input type="text" class="knob" data-readonly="true" value="80" data-width="60" data-height="60" data-fgColor="#03B7CD"/>
                  <div class="knob-label">Crecimiento</div>
                </div>
                
                <div class="col-md-2 col-xs-4 col-lg-1 text-center" style="border-right: 1px solid #f4f4f4">
                  <input type="text" class="knob" data-readonly="true" value="70" data-width="60" data-height="60" data-fgColor="#DF0045"/>
                  <div class="knob-label">Asistencia</div>
                </div>

                <div class="col-md-2 col-xs-4 col-lg-1 text-center" style="border-right: 1px solid #f4f4f4">
                  <input type="text" class="knob" data-readonly="true" value="100" data-width="60" data-height="60" data-fgColor="#FFB703"/>
                  <div class="knob-label">Escuelas</div>
                </div>
                -->
          	  </div>  
            </div>                  
          </div>
          
          <!-- ///////////////////////Informacion Personal -->
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="panel box box-primary">
                <!-- Default panel contents -->
                <div class="panel-heading"><h4 class="text-left modal-title"><i class="glyphicon glyphicon-user"></i> {{Lang::get('asistentes.texto_simple_titulo_informacion_principal')}}</h4></div>
                  <div class="panel-body">
                    <!-- Datos principales -->
                    <div class="col-lg-6">
                     	<div class="panel panel-default">
                        <div class="panel-body">
                          <h3 class="page-header">{{Lang::get('asistentes.texto_informacion_basica_asistente')}}</h3>
                          <table class="table-hover" width="100%">
                            <tr>
                              <td><b>Fec{{Lang::get('asistentes.texto_campo_fecha_nacimiento')}}</b></td> <td>{{ $asistente->fecha_nacimiento }}</td>
                            </tr>
                            <tr> <td><b>{{Lang::get('asistentes.texto_simple_campo_edad')}}</b></td> <td> 
                              <?php 
                              if($asistente->fecha_nacimiento == ""){
                                  $edad="Sin dato";                                

                              }else{
                                  $fecha_naci=date_create($asistente->fecha_nacimiento);
                                  $fecha_naci=date_format($fecha_naci, 'Y-m-j') ; 
                                  list($Y,$m,$d) = explode("-",$fecha_naci);
                                  $edad=( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );

                              }                              
                              ?> {{$edad}}</td>
                            </tr>
                            <tr><td><b>{{Lang::get('asistentes.texto_campo_genero')}}</b></td><td> 
                                @if( $asistente->genero==0 )
                                    <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="{{Lang::get('asistentes..texto_simple_title_campo_sexo')}}"> {{Lang::get('asistentes.texto_campo_genero_masculino')}} </label>
                                @else  
                                    <label class="label arrowed-right" style="background-color: pink;" data-toggle="tooltip" data-placement="top" title="{{Lang::get('asistentes..texto_simple_title_campo_sexo')}}"> {{Lang::get('asistentes.texto_campo_genero_femenino')}} </label> 
                                    @endif
                                </td>
                            </tr>
                            <tr><td><b>{{Lang::get('asistentes.texto_campo_estado_civil')}}</b></td><td> @if(isset($asistente->estado_civil)) {{ Lang::choice('asistentes.estado_civil', $asistente->estado_civil) }} @endif </td></tr>
                            <tr><td><b>{{Lang::get('asistentes.texto_campo_tipoid')}}</b></td><td>  @if($asistente->tipo_identificacion!=""){{ Lang::choice('asistentes.na_tipo_id', $asistente->tipo_identificacion) }}@endif </td></tr>
                            <tr><td><b>No. {{Lang::get('asistentes.texto_campo_identificacion')}}</b></td><td> {{ $asistente->identificacion }} </td></tr>
                            <tr><td><b>{{Lang::get('asistentes.texto_simple_ocupacion')}}</b></td> <td>{{ $asistente->ocupacion }}</td></tr>
                            <tr> <td><b>{{Lang::get('asistentes.texto_campo_nacionalidad')}}</b></td> <td> {{ $asistente->nacionalidad }} </td></tr>
                          </table>
                        </div> 
                      </div><!-- Fin datos principales -->
                    </div> <!-- fin col 6 -->                                    
                    <!-- Datos de contacto -->
                    <div class="col-lg-6">
                    	<div class="panel panel-default">
                        <div class="panel-body">
                          <h3 class="page-header">{{Lang::get('asistentes.texto_title_info_contacto')}}</h3>
                          <table class="table-hover" width="100%">
                            <tr>
                              <td><b>{{Lang::get('asistentes.texto_campo_direccion')}}</b></td> <td>{{ $asistente->direccion }}</td></tr>
                              <tr> <td><b>{{Lang::get('asistentes.texto_campo_tel_fijo')}}</b></td> <td> {{ $asistente->telefono_fijo }} </td></tr>
                              <tr><td><b>{{Lang::get('asistentes.texto_campo_tel_movil')}}</b></td><td> {{ $asistente->telefono_movil }} </td></tr>
                              <tr><td><b>{{Lang::get('asistentes.texto_campo_tel_otro')}} no (Otro)</b></td><td> {{ $asistente->telefono_otro }}</td></tr>
                              <tr><td><b>{{Lang::get('asistentes.texto_campo_correo')}}</b></td><td> {{ $asistente->user['email'] }} </td></tr>
                          </table>
                        </div> 
                      </div>
                       <!-- Fin div Datos de Contacto -->
                       <!-- Información Medica -->
                    	<div class="panel panel-default">
                        <div class="panel-body">
                          <h3 class="page-header">{{Lang::get('asistentes.texto_title_info_medica')}}</h3>
                          <table class="table-hover" width="100%">
                            <tr><td><b>{{Lang::get('asistentes.texto_campo_tipo_sangre')}}</b></td> <td>{{ strtoupper($asistente->tipo_sangre) }}</td></tr>
                            <tr> <td><b>{{Lang::get('asistentes.texto_campo_indicaciones_medicas')}}</b></td> <td> {{  $asistente->indicaciones_medicas }}</td></tr>
                            <tr><td><b>{{Lang::get('asistentes.texto_campo_limitaciones')}}</b></td><td> {{ $asistente->limitaciones }} </td></tr>
                          </table>
                        </div> 
                      </div><!-- Fin div Informacion Medica -->
                    </div>
                  </div><!-- Fin div panel body -->
              </div>
            </div>
          </div> 

          <!-- ///////////////////////Informacion Ministerial -->
          <div class="row">
          	<div class="col-lg-12">
            	<div class="panel box box-primary">
                <!-- Default panel contents -->
                <div class="panel-heading"><h4 class="text-left modal-title"><i class="fa fa-users"></i> {{Lang::get('asistentes.texto_title_info_ministerial')}}</h3></div>
                <div class="panel-body">
                  <!-- Inofrmacion Basica -->
                      <div class="col-lg-6">
                      	<div class="panel panel-default">
                            <div class="panel-body">
                                <h3 class="page-header">{{Lang::Get('asistentes.texto_informacion_basica_perfil')}}</h3>
                                <table class="table-hover" width="100%">
                                <tr><td><b>{{Lang::get('asistentes.texto_simple_tipoasistente_perfil')}}</b></td> <td><span class="badge bg-orange"><i class="fa fa-star"></i> {{Lang::get('asistentes.texto_simple_lider')}}</span></td></tr>
                                <!--<tr><td><b>Fecha en que fue Bautizado</b></td> <td>Junio 28 de 2005</td></tr> -->
                                <?php $grupo= Grupo::find($asistente['grupo_id']); ?>
                                <?php $linea= Linea::find($asistente['linea_id']); ?>
                                  @if($grupo!="")
                                      <tr> <td><b>{{Lang::get('asistentes.texto_simple_lider_singular_y_plural_inmediato')}}</b></td> <td> 
                                          @foreach($grupo->encargados as $encargado)
                                              {{ $encargado['nombre']." ".$encargado['apellido'] }} <br>
                                          @endforeach
                                      </td></tr>
                                      @if($linea!="")
                                      <tr> <td><b>{{Lang::get('asistentes.texto_simple_lider_linea_singular_y_plural')}}</b></td> <td> 
                                        
                                          @foreach($linea->encargados as $encargado)
                                              {{ $encargado['nombre']." ".$encargado['apellido'] }} <br>
                                          @endforeach
                                       
                                      </td></tr>
                                       @endif
                                      <tr><td><span class="capitalize"><b>{{Lang::get('asistentes.texto_simple_grupo_pertenece')}}</b></span></td><td>Cod. {{ $grupo->id }} - {{ $grupo->nombre }} </td></tr>
                                      @if($asistente->linea['id'] != "")<tr><td> <span class="capitalize"><b>{{Lang::get('asistentes.texto_simple_linea')}}</b></span></td><td>{{Lang::get('asistentes.texto_simple_cod')}} {{ $asistente->linea['id'] }} - {{ $asistente->linea['nombre'] }}</td></tr>@endif
                                  @endif
                                  
                                </table>
                                <?php 
                                  $servidores_grupos= ServidorGrupo::where("asistente_id","=", $asistente->id)->get(); 
                                ?>
                                @if(count($servidores_grupos)>0)
                                <hr>
                                <h4>{{Lang::get('asistentes.texto_servicios_grupos')}}</h4>
                                  <table class="table-hover" width="100%">
                                  <thead class="text-light-blue"><tr><th><b>{{Lang::get('asistentes.texto_simple_cod')}}  - {{Lang::get('asistentes.')}} {{Lang::get('asistentes.texto_simple_servicios')}}</b></th><th><b>{{Lang::get('asistentes.texto_simple_servicio')}}</b></th></tr></thead>
                                  
                                  @foreach($servidores_grupos as $servidor_grupo)
                                  <?php $grupo_servicio= Grupo::find($servidor_grupo->grupo_id); ?>
                                  @if(isset($grupo_servicio->id))
                                  <tr><td><b>{{Lang::get('asistentes.texto_simple_cod')}}{{ $grupo_servicio->id }} - {{ $grupo_servicio->nombre }}</b></td><td>
                                    @foreach($servidor_grupo->tipoServicioGrupo as $tipo_servicio)
                                      - {{$tipo_servicio->nombre}} <br>
                                    @endforeach
                                    </td></tr>
                                  @endif
                                  @endforeach
                                </table>
                                @endif
                          </div> 
                        </div><!-- Fin informacion basica -->
                         
                        <?php $grupo_encargado=$asistente->grupos()->get(); ?>
                         <!-- Grupos Directos -->
                        @if(count($grupo_encargado)>0)
                      	<div class="panel panel-default">
                            <div class="panel-body">
                                <h3 class="page-header">{{Lang::get('asistentes.texto_simple_grupos_a_cargo')}}</h3>
                                  <table class="table-hover" width="100%">
                                    <?php //$total_grupos_directos= $asistente->grupos()->where("dado_baja", "=", "0")->count();
                                      $total_grupos_directos= $asistente->grupos()->where('dado_baja', 0)->count();
                                      $total_grupos=$asistente->gruposMinisterio()->count(); ?>
                                  <tr><td><span class="capitalize"><b>{{Lang::get('asistentes.texto_simple_grupos_dirige')}}</b></span></td> <td><span class="badge bg-light-redil">{{ $total_grupos_directos }}</span></td></tr>
                                  <tr><td><span class="capitalize"><b>{{Lang::get('asistentes.texto_simple_grupos_indirecto')}}</b></span></td> <td><span class="badge bg-light-redil">{{ $total_grupos-$total_grupos_directos }}</span></td></tr>
                                  <tr><td><b>{{Lang::get('asistentes.total_grupos_ministerio')}}</b></td><td><span class="badge bg-orange"> {{ $total_grupos }} </span></td></tr>
                                  <tr><td><span class="capitalize"><b>{{Lang::get('asistentes.total_asistentes_ministerio')}}</b></span></td><td><span class="badge bg-orange">{{ $asistente->discipulos()->count() }}</span>  </td></tr>
                                </table>
                                
                                <hr>
                                <h4>{{Lang::get('asistentes.texto_simple_info_grupo_directos')}}</h4>
                                  <table class="table-hover" width="100%">
                                  <thead class="text-light-blue"><tr><th><b>{{Lang::get('asistentes.texto_simple_nombre_grupo')}} {{Lang::get('asistentes.texto_grupo_individual')}}</b></th><th><b>{{Lang::get('asistentes.texto_campo_direccion')}}</b></th></tr></thead>
                                  @foreach($grupo_encargado as $grupo)
                                    <tr><td><b>{{Lang::get('asistentes.texto_simple_cod')}}: {{ $grupo->id }} - {{ $grupo->nombre}}</b></td> <td> {{ $grupo->direccion }} </td></tr>
                                  @endforeach
                                </table>
                          </div> 
                         </div><!-- Fin div Grupos Dierctos -->
                      	@endif

                        <?php $departamentos_integrantes=$asistente->departamentosIntegrante()->get(); ?>
                        <?php $departamentos_encargado=$asistente->departamentosEncargados()->get(); ?>
                          <!--departamentos donde sirve -->
                        @if(count($departamentos_integrantes)>0 || count($departamentos_encargado)>0)
                          <div class="panel panel-default">
                            <div class="panel-body">
                                <h3 class="page-header">{{Lang::get('asistentes.texto_departamentos_presta_servicios')}}</h3>
                                  <table class="table-hover" width="100%">
                                  <thead class="text-light-blue"><tr><th>{{Lang::get('asistentes.texto_simple_departamento')}}</th><th>{{Lang::get('asistentes.texto_simple_cargo')}}</th><th>{{Lang::get('asistentes.texto_simple_funcion')}}</th></tr></thead>
                                		@foreach($departamentos_encargado as $departamento_encargado)
                                      <tr><td><b>{{ $departamento_encargado->nombre }}</b></td> <td> {{Lang::get('asistentes.texto_simple_directorlang')}} </td> <td>{{ $departamento_encargado->funcion }}</td></tr>
                                    @endforeach
                                 		@foreach($departamentos_integrantes as $departamento_integrante)
                                      <tr><td><b>{{ $departamento_integrante->nombre }}</b></td> <td> {{ $departamento_integrante->pivot->cargo }} </td> <td>{{ $departamento_integrante->pivot->funcion }}</td></tr>
                                    @endforeach
                                  
                                </table>
                          </div> 
                         </div>
                        @endif
                         <!-- /departamentos -->
                         
                      </div> <!-- fin col 6 -->
                      
                       
                      <div class="col-lg-6">                      
                        <!-- Pasos Creciemiento -->
                      	<div class="panel panel-default">
                            <div class="panel-body">
                                <h3 class="page-header">{{Lang::get('asistentes.texto_simple_pasos_crecimiento')}}</h3>
                                  <table class="table-hover" width="100%">
                                    <?php $pasos=PasoCrecimiento::all();?>
                                    @foreach($pasos as $paso)
                                      <tr><td><b>{{ $paso->nombre }}</b></td> <td>
                                        <?php $paso_culminado=$asistente->pasosCrecimiento()->get()->find($paso->id); ?>
                                        @if($paso_culminado!="")
                                        <span class="badge bg-green"><i class="fa fa-check"></i></span>
                                        @else
                                        <span class="badge bg-red"><i class="fa fa-times"></i></span>
                                        @endif
                                        </td></tr>
                                    @endforeach
                                  
                                </table>
                          </div> 
                         </div><!-- Fin div Pasos creciemiento -->
                         
                         <!-- Informacion Asistencia Grupos -->
                    	  <div class="panel panel-default">
                          <div class="panel-body">
                            <h3 class="page-header">{{Lang::get('asistentes.texto_informacion_asistencia_grupo')}}</h3>
                            <table class="table-hover" width="100%">
                              @if(isset($asistente->grupo->id))
                                <?php 
                                global $id_asistente;
                                $id_asistente=$asistente->id;
                                // Este codigo me obtiene las ultimas asistencias. 
                                $ultimas_asistencias =$asistente->grupo->reportes()->whereHas('asistentes', function($q){ global $id_asistente;  $q->where('asistente_id', '=', $id_asistente )->where('asistio', '1');})                            
                                 ->orderBy('fecha','desc')
                                 ->take(4)
                                 ->get();
                                // FIN Este codigo me obtiene las ultimas asistencias. 

                                ?>

                                <?php
                                  // Este codigo cuenta la asistencia de los ultimos meses, mes tras mes.
                                  $mes_actual = date('Y-m'); // Me trae la fecha actual de sistema

                                  $un_mes_atras = strtotime ( '-1 month' , strtotime ( $mes_actual ) ); // Esta funcion me coge el mes_actual y le resta n meses
                                  $un_mes_atras = date ( 'Y-m' , $un_mes_atras ); // le doy formato Y-M a mi nueva fecha

                                  $segundo_mes_atras = strtotime ( '-2 month' , strtotime ( $mes_actual ) ); // Esta funcion me coge el mes_actual y le resta n meses
                                  $segundo_mes_atras = date ( 'Y-m' , $segundo_mes_atras ); // le doy formato Y-M a mi nueva fecha

                                  $tercer_mes_atras = strtotime ( '-3 month' , strtotime ( $mes_actual ) ); // Esta funcion me coge el mes_actual y le resta n meses
                                  $tercer_mes_atras = date ( 'Y-m' , $tercer_mes_atras ); // le doy formato Y-M a mi nueva fecha

                                  $cuarto_mes_atras = strtotime ( '-4 month' , strtotime ( $mes_actual ) ); // Esta funcion me coge el mes_actual y le resta n meses
                                  $cuarto_mes_atras = date ( 'Y-m' , $cuarto_mes_atras ); // le doy formato Y-M a mi nueva fecha

                                  $quinto_mes_atras = strtotime ( '-5 month' , strtotime ( $mes_actual ) ); // Esta funcion me coge el mes_actual y le resta n meses
                                  $quinto_mes = date ( 'Y-m-j' , $quinto_mes_atras ); // le doy formato Y-M-J a mi nueva fecha, este lo necesito para la comparacion de la consulta. 
                                  $quinto_mes_atras = date ( 'Y-m' , $quinto_mes_atras ); // le doy formato Y-M a mi nueva fecha
                                 
                                  $m0=0;
                                  $m1=0;
                                  $m2=0;
                                  $m3=0;
                                  $m4=0;
                                  $m5=0;  

                                  
                                  $asistencias_semestral =$asistente->grupo->reportes()->whereHas('asistentes', function($q){ global $id_asistente;  $q->where('asistente_id', '=', $id_asistente )->where('asistio', '1');})->where("fecha", ">=" , $quinto_mes)->get();
                                  //$reportes= $asistencias_semestral->whereHas('reporte_grupo', function($q){ global $id_integrante;  $q->where('asistente_id', '=', $id_integrante );})->get();
                                ?>
                                
                                @foreach($asistencias_semestral as $asistencia)
                                  @if($asistencia->fecha != "")
                                    <?php $fecha_asistencia=date_create($asistencia->fecha);
                                          $fecha_asistencia=date_format($fecha_asistencia, 'Y-m') ; 
                                    ?>
                                 

                                      @if ($fecha_asistencia==$mes_actual)
                                          <?php  $m0=$m0+1 ?>
                                      @endif
                                      @if($fecha_asistencia==$un_mes_atras)
                                           <?php  $m1=$m1+1 ?>
                                      @endif
                                      @if($fecha_asistencia==$segundo_mes_atras)
                                          <?php  $m2=$m2+1 ?>
                                      @endif
                                      @if($fecha_asistencia==$tercer_mes_atras)
                                          <?php  $m3=$m3+1 ?>
                                      @endif
                                      @if($fecha_asistencia==$cuarto_mes_atras)
                                          <?php  $m4=$m4+1 ?>
                                      @endif
                                      @if($fecha_asistencia==$quinto_mes_atras)
                                          <?php  $m5=$m5+1 ?>
                                      @endif

                                   @endif
                                @endforeach

                                @if($ultimas_asistencias->count() >= 1)
                                <tr><td rowspan="{{$ultimas_asistencias->count()+1}}"><b>{{Lang::get('asistentes.texto_simple_ultimas_asistencias')}}</b></td></tr>
                                  @foreach($ultimas_asistencias as $ultima_asistencia)
                                  <tr><td> {{ Lang::choice ('general.dias2', date('N', strtotime($ultima_asistencia->fecha)))}}, {{$ultima_asistencia->fecha}}</td> </tr>
                                  @endforeach
                                @else
                                  <tr><td><b>{{Lang::get('asistentes.texto_simple_ultimas_asistencias')}}  </b>{{Lang::get('asistentes.texto_simple_sin_registro')}} </td></tr> 
                                                                     
                                @endif

                                <tr><td colspan="2"><br><b>{{Lang::get('asistentes.texto_simple_grafica')}}</b></td></tr><tr> <td colspan="2" align="center">  <!-- AREA CHART -->
                                  <div class="chart" id="graf-grupo" style="height: 120px;"></div>
                                </td></tr>  
                              @else
                                <tr><td colspan="2"><br><b>{{Lang::get('asistentes.texto_asistente_no_pertenece_grupo')}}</b></td></tr>
                              @endif                                
                            </table>
                          </div> 
                        </div>
                        <!-- Fin div Asistencia a grupos -->
                         
                         <!-- Asistencia a Iglesia 

                      	<div class="panel panel-default">
                          <div class="panel-body">
                            <h3 class="page-header">Informacion Asistencia a Iglesia</h3>
                            <table class="table-hover" width="100%">
                            <tr>
                              <td rowspan="3"><b>Ultimas Asistencias</b></td> <td>Miercoles - Culto Sanidad y Milagros - 21 de Mayo de 2014</td></tr>
                              <tr><td>Sabado - Culto Juvenil - 24 de Mayo de 2014</td></tr>
                              <tr><td>Miercoles -culto Sanidad y Milagros - 28 de Mayo de 2014</td></tr>
                              <tr> <td colspan="2"><br><b>Grafica de Asistencia Iglesia - Año 2014</b></td></tr><tr> <td colspan="2" align="center">  <!-- AREA CHART 
                               <div class="chart" id="graf-iglesia" style="height: 120px;"></div>
                              </td>
                            </tr>
                            </table>
                          </div> 
                        </div> Fin div Asistencia a la Iglesia -->
                      </div>
                </div><!-- Fin div panel body -->
              </div>
         	  </div>
          </div><!-- /Informacion Ministerial -->
                  
          <!-- //////////////////////////////////////Informacion Academica -->
          <!--
          <div class="row">
          	<div class="col-lg-12">
              <div class="panel box box-primary">
                <!-- Default panel contents 
                <div class="panel-heading"><h4 class="text-left modal-title"><i class="fa fa-pencil-square-o"></i> Informacion Academica</h3></div>
                <div class="panel-body">
                  <!-- Inofrmacion Basica 
                  <div class="col-lg-12">
                  	<div class="panel panel-default">
                      <div class="panel-body">
                        <h3 class="page-header">Escuela Principal <span class="badge bg-red" data-toggle="tooltip" title="Esta escuela es necesaria para el crecimiento del lider">Requerida</span></h3>
                        <div class="col-lg-6">
                          <table class="table-hover" width="100%">
                          <tr><td colspan="2"><span class="badge bg-teal"><i class="fa fa-bank"></i> Maestro</span> <span class="badge bg-navy"><i class="fa fa-graduation-cap"></i> Graduado</span>  <span class="badge bg-yellow"><i class="fa fa-smile-o"></i> Estudiante</span><br><br></td></tr>
                          <tr><td><b>Curso Actual </b></td> <td>Maestría</td></tr>
                            
                            <tr><td><b>Nota 1</b></td><td><span class="badge bg-light-redil">4</span></td></tr>
                            <tr><td><b>Nota 2</b></td><td><span class="badge bg-light-redil">4</span></td></tr>
                            <tr><td><b>Nota 3</b></td><td><span class="badge bg-light-redil"> - </span></td></tr>
                            <tr><td><b>Nota Final</b></td><td><span class="badge bg-green"> - </span></td></tr>
                            
                          </table>
                          <hr>
                          <h4>Desempeño - Estadistica general (Nota/Nivel)</h4>
                            <table class="table-hover" width="100%">
                            <tr> <td colspan="2"><br><b>Grafica Nota Final - Año 2014</b></td></tr><tr> <td colspan="2" align="center">  <!-- AREA CHART 
                            <div class="chart" id="escuelades" style="height: 150px;"></div>
                         	</td></tr>
                          </table>
                        </div>                                    
                        <div class="col-lg-6">
                        	<h4>Cursos Necesarios para el Creciemiento</h4>
                          <table class="table-hover" width="100%">
                            <tr><td><b>Postencuentro</b></td> <td><span class="badge bg-green"><i class="fa fa-check"></i> Nota Final: 4,2</span> <span class="badge bg-yellow">Puesto: 9</span></td></tr>
                              <tr> <td><b>Nivel 1 - Afirmandome en la vida Cristiana</b></td> <td><span class="badge bg-green"><i class="fa fa-check"></i> Nota Final: 4,2</span> <span class="badge bg-yellow">Puesto: 9</span></td></tr>
                              <tr> <td><b>Nivel 2 - Preparandome para ser enviado</b></td> <td> <span class="badge bg-green"><i class="fa fa-check"></i> Nota Final: 4,2</span> <span class="badge bg-yellow">Puesto: 9</span></td></tr>
                              <tr><td><b>Nivel 3 - Liderando mi celula</b></td><td><span class="badge bg-green"><i class="fa fa-check"></i> Nota Final: 4,2</span> <span class="badge bg-yellow">Puesto: 9</span></td></tr>
                              <tr><td><b>Nivel 4 - Ministerial</b></td><td><span class="badge bg-green"><i class="fa fa-check"></i> Nota Final: 4,2</span> <span class="badge bg-yellow">Puesto: 9</span></td></tr>
                              <tr><td><b>Nivel 5 - Ministerial</b></td><td><span class="badge bg-green"><i class="fa fa-check"></i> Nota Final: 4,2</span> <span class="badge bg-yellow">Puesto: 9</span></td></tr>
                              <tr><td><b>Nivel 6 - Ministerial</b></td><td><span class="badge bg-green"><i class="fa fa-check"></i> Nota Final: 4,2</span> <span class="badge bg-yellow">Puesto: 9</span></td></tr>
                              <tr><td style="padding-right: 10%">
                              <div class="clearfix">
                                <span class="pull-left"><b>Nivel 7 - Maestría</b></span>
                                <small class="pull-right">70%</small>
                              </div>
                            <div class="progress xs">
                              <div class="progress-bar progress-bar-green" style="width: 70%;"></div>
                            </div></td><td> </td></tr>
                          </table>
                            
                          <h4>Cursos Opcionales</h4>
                          <table class="table-hover" width="100%">
                            <tr><td><b>Teología</b></td> <td></td></tr>
                          </table>                                        
                        </div>
                      </div> 
                    </div><!-- Fin Escuela Principal 
                  </div>
                </div><!-- Fin div panel body 
              </div>
         	  </div>
          </div><!-- /Inofrmacion Academica                   
          -->         
          <!-- //////////////////////////////////////Informacion de Eventos -->
          <!--
          <div class="row">
          	<div class="col-lg-12">
            	<div class="panel box box-primary">
                <!-- Default panel contents 
                <div class="panel-heading"><h4 class="text-left modal-title"><i class="fa fa-calendar"></i> Informacion Participación de Eventos</h4></div>
                <div class="panel-body">
                	<!-- Retiros Principales 
                  <div class="col-lg-6">
                  	<div class="panel panel-default">
                      <div class="panel-body">
                        <h3 class="page-header">Participación en Retiros Principales</h3>
                        <table class="table-hover" width="100%">
                          <tr><td><b>Encuentro Guardando el corazón del Rey</b></td> <td>Julio 25 de 2006</td></tr>
                          <tr> <td><b>Encuentro de Efrain</b></td> <td>Noviembre 18 de 2006</td></tr>
                          <tr><td><b>Reencuentro Marcado por su presencia</b></td><td>Junio 12 2007 </td></tr>
                          <tr><td><b>Reencuentro Buscando la Gloria de Dios</b></td><td>Agosto 11 2009  </td></tr>
                        </table>
                        <hr>
                        <h4>Ultimos Retiros donde ha Prestado Servicios</h4>
                        <table class="table-hover" width="100%">
                          <thead class="text-light-blue"><tr><th>Nombre del Retiro</th><th>Fecha</th><th>Tipo de servicio</th></tr></thead>
                        	<tr><td><b>Encuentro Buscando su Presencia</b></td><td>Julio 14 2009  </td><td>Servicios Varios</td></tr>
                          <tr><td><b>Encuentro Restaurando el Altar</b></td><td>Febrero 12 2010  </td><td>Predicador</td></tr>
                        </table>
                      </div> 
                    </div><!-- Fin Retiros Principales                     
                  </div> <!-- fin col 6                      
                 	<!-- Otros Eventos 
                  <div class="col-lg-6">
                  	<div class="panel panel-default">
                      <div class="panel-body">
                        <h3 class="page-header">Participación en Otros Eventos (Últimos)</h3>
                        <table class="table-hover" width="100%">
                          <tr><td><b>Campamento de Neftaly Apasionados por su Presencia</b></td> <td>Diciembre 25 de 2013</td></tr>
                          <tr><td><b>Retiro de Lideres</b></td> <td>Febrero 25 de 2014</td></tr>
                          <tr> <td><b>Congreso Marcando Mis Generaciones</b></td> <td>Marzo 18 de 2014</td></tr>
                          <tr><td><b>Noche de Talentos</b></td><td>Mayo 12 2014 </td></tr>
                          <tr><td><b>Macrocelula Neftaly</b></td><td>Mayo 15 2014  </td></tr>
                        </table>                                
                      </div> 
                    </div>
                      
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <h3 class="page-header">Eventos Donde esta Inscrito Actualmente</h3>
                        <table class="table-hover" width="100%">
                        <thead class="text-light-blue"><tr><th>Nombre del Retiro</th><th>Fecha</th><th>Participacion</th></tr></thead>
                          <tr><td><b>Encuentro Buscando la Gloria de Dios</b></td><td>Junio 06 de 2014</td><td>Predicador</td></tr>
                          <tr><td><b>Retiro de Escuelas</b></td><td>Junio 16 de 2014</td><td>Asistente</td></tr>
                        </table>                                
                      </div>
                    </div><!-- Fin Otros Eventos                      
                  </div> <!-- fin col 6 -->                      
                <!-- Fin div panel body 
              </div>
         	  </div>
          </div> 
          -->
          <!-- /Informacion de Eventos -->


          </section><!-- /.content -->
        </aside><!-- /.right-side -->
      <!-- ./wrapper -->
      </div>

      @include('includes.scripts')
      <script src="/js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        
      <!-- Morris.js charts -->
      <script src="/js/raphael-min.js"></script>
      <script src="/js/plugins/morris/morris.min.js" type="text/javascript"></script>
      
      <!-- jQuery Knob -->
      <script src="/js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        
      <script type="text/javascript">
        $(document).ready(function() {   
          $("#menu_asistentes").children("a").first().trigger('click');
        });

        $(function() {
          "use strict";
				  var mesesC = new Array ("Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre", "Diciembre","Enero");
				  var meses = new Array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov", "Dic");
          // Grafica de Asistencia al Grupo
          @if(isset($asistente->grupo))
          var line = new Morris.Line({
              element: 'graf-grupo',
              resize: true,
              data: [
                { y: "{{ $quinto_mes_atras }}-01", a: {{ $m5 }} },
                { y: "{{ $cuarto_mes_atras }}-01" , a: {{ $m4 }} },
                { y: "{{ $tercer_mes_atras }}-01" , a: {{ $m3 }} },
                { y: "{{ $segundo_mes_atras }}-01" , a: {{ $m2 }} },
                { y: "{{ $un_mes_atras }}-01" , a: {{ $m1 }} },
                { y: "{{ $mes_actual }}-01" , a: {{ $m0 }} }
              ],
              xkey: 'y',
              ykeys: ['a'],
              labels: ['Asistencias'],
              lineColors: ['#3c8dbc'],
              hideHover: 'auto',
              xLabels: 'month',
              hoverCallback: function (index, options, content) {
                var row = options.data[index];
                var f=Date.parse(row.y);
                var fecha = new Date(f);
                var mes=mesesC[fecha.getMonth()];
                var anio=fecha.getFullYear();
                if(fecha.getMonth()=="11")
                anio+=1;
                return mes+" "+anio+"<br><span class='text-blue'>Asistencias: "+row.a+"</span>";
              },
              
              xLabelFormat: function (x) { return meses[x.getMonth()]; }
            });
            @endif
				
				 // Grafica de Asistencia a Iglesia
                var line = new Morris.Line({
                    element: 'graf-iglesia',
                    resize: true,
                    data: [
                        {y: '2014-01-01', x: 13},
                        {y: '2014-02-01', x: 14},
                        {y: '2014-03-01', x: 12},
                        {y: '2014-04-01', x: 10},
                        {y: '2014-05-01', x: 6},
                        {y: '2014-06-01', x: 8}
                    ],
                    xkey: 'y',
                    ykeys: ['x'],
                    labels: ['Asistencias'],
                    lineColors: ['#3c8dbc'],
                    hideHover: 'auto',
					xLabels: 'month',
					hoverCallback: function (index, options, content) {
					  var row = options.data[index];
					  var f=Date.parse(row.y);
					  var fecha = new Date(f);
					  var mes=mesesC[fecha.getMonth()+1];
					  if(fecha.getMonth()=='11')
					  mes=mesesC[0];
					  return mes+"<br><span class='text-blue'>Asistencias: "+row.x+"</span>";
					},
  					xLabelFormat: function (x) { return meses[x.getMonth()]; }
                });
				
				//DESEMPEÑO DE ESTUDIANTE (NOTA FINAL/NIVEL)
                var bar = new Morris.Bar({
                    element: 'escuelades',
                    resize: true,
                    data: [
                        {y: 'Post...', a: 5},
                        {y: 'Nivel 1', a: 4.3},
                        {y: 'Nivel 2', a: 3.6},
                        {y: 'Nivel 3', a: 4.0},
                        {y: 'Nivel 4', a: 3.7},
                        {y: 'Nivel 5', a: 4.2},
                        {y: 'Nivel 6', a: 0}
                    ],
                    barColors: ['#00a65a'],
                    xkey: 'y',
                    ykeys: ['a'],
					ymax: 5,
                    labels: ['Nota Final'],
                    hideHover: 'auto'
                });
			});
		</script>
        
        <!-- page script -->
        <script type="text/javascript">
            $(function() {
                /* jQueryKnob */

                $(".knob").knob({
                    /*change : function (value) {
                     //console.log("change : " + value);
                     },
                     release : function (value) {
                     console.log("release : " + value);
                     },
                     cancel : function () {
                     console.log("cancel : " + this.value);
                     },*/
                    draw: function() {

                        // "tron" case
                        if (this.$.data('skin') == 'tron') {

                            var a = this.angle(this.cv)  // Angle
                                    , sa = this.startAngle          // Previous start angle
                                    , sat = this.startAngle         // Start angle
                                    , ea                            // Previous end angle
                                    , eat = sat + a                 // End angle
                                    , r = true;

                            this.g.lineWidth = this.lineWidth;

                            this.o.cursor
                                    && (sat = eat - 0.3)
                                    && (eat = eat + 0.3);

                            if (this.o.displayPrevious) {
                                ea = this.startAngle + this.angle(this.value);
                                this.o.cursor
                                        && (sa = ea - 0.3)
                                        && (ea = ea + 0.3);
                                this.g.beginPath();
                                this.g.strokeStyle = this.previousColor;
                                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                                this.g.stroke();
                            }

                            this.g.beginPath();
                            this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
                            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                            this.g.stroke();

                            this.g.lineWidth = 2;
                            this.g.beginPath();
                            this.g.strokeStyle = this.o.fgColor;
                            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                            this.g.stroke();

                            return false;
                        }
                    }
                });
                /* END JQUERY KNOB */
			});

        </script>
        
    </body>
</html>
@endif