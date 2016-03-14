@if(Auth::check())
@include('includes.lenguaje')
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{{Lang::get('grupos.lg_titulo_pestaña')}} |  {{ Lang::get('grupos.lg_title') }} </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        @include('includes.styles')
         <!-- DATA TABLES -->
        <link href="/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
       <!-- iCheck for checkboxes and radio inputs -->
        <link href="/css/iCheck/all.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap multiselect-->
        <link rel="stylesheet" href="/css/bootstrap-multiselect.css" type="text/css"/>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
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
                        <div class="pull-right box-tools" >
                           <a href="../nuevo" class="btn btn-danger btn-md"> <i class="fa fa-plus"></i> {{ Lang::get('grupos.lg_bt_nuevo') }} </a>
                            <button data-toggle="tooltip" title="" class="btn btn-info" data-original-title=" {{ Lang::get('general.dot_imprimir') }} "  onclick="window.print();" ><i class="fa fa-print"></i></button>
                            <button data-toggle="tooltip" title="" class="btn btn-info" data-original-title=" {{ Lang::get('general.dot_email') }} "><i class="fa fa-envelope"></i></button>
                            <a target="_blank" href="../reportes-grupos/{{ $tipo }}"  data-toggle="tooltip" title="" class="btn btn-info" data-original-title=" {{ Lang::get('general.dot_pdf') }} "><i class="fa fa-file-pdf-o "></i></a>
                            <!--<button class="btn btn-danger btn-md" data-widget='collapse' data-toggle="tooltip" title="{{ Lang::get('general.ttl_filtro') }}"><i class="fa fa-filter"></i></button>-->
                           
                        </div> 	
                   	    <h3 class="content-header barra-titulo">
                             {{ Lang::get('grupos.lg_header') }} ( {{ str_replace("-"," ", ucwords($tipo) ); }} )
                            <small>{{ Lang::get('grupos.lg_subtitulo') }} </small>
                        </h3>
                    </div>
                </section>
                <!-- /contendio cabezote --> 

                <!-- contenido principal -->
                <section class="content">
                <!-- row de cuadro de colores -->
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 no-padding">
                        <!-- cuadro todos -->
                        <div class="col-lg-3 col-md-2 col-xs-6 col-sm-3 contador" data-toggle="tooltip" data-placement="top" title= "{{ Lang::get('grupos.lg_ttl_todos') }}">
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>{{ $cantidad_todos }}</h3>
                                    <p>
                                        {{ Lang::get('grupos.lg_fil_todos') }}
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-certificate"></i>
                                </div>
                                <a href="todos" class="small-box-footer"> {{ Lang::get('grupos.lg_fil_ver') }} <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- /cuadro todos -->
                        <!-- cuadro nuevos -->
                        <div class="col-lg-3 col-md-2 col-xs-6 col-sm-3 contador"  data-toggle="tooltip" data-placement="top" title= "{{ Lang::get('grupos.lg_ttl_nuevos') }}" >
                        <div class="small-box bg-teal">
                                <div class="inner">
                                    <h3>
                                        {{ $cantidad_nuevos }}
                                    </h3>
                                    <p>
                                        {{ Lang::get('grupos.lg_fil_nuevos') }}
                                    </p>
                                </div>
                            <div class="icon">
                                    <i class="fa fa-heart"></i>
                            </div>
                              <a href="nuevos" class="small-box-footer"> {{ Lang::get('grupos.lg_fil_ver') }} <i class="fa fa-arrow-circle-right"></i>
                              </a>
                          </div>
                        </div>
                        <!-- /cuadro nuevos -->
                    
                        <!-- cuadro sin actividad --> 
                        <div class="col-lg-2 col-md-2 col-xs-4 col-sm-2 contador"  data-toggle="tooltip" data-placement="top" title= "{{ Lang::get('grupos.lg_ttl_sin_actividad') }}" >
                            <div class="small-box bg-red">
                                    <div class="inner">
                                        <h3>
                                            {{ $cantidad_sin_actividad }}
                                        </h3>
                                        <p>
                                            {{ Lang::get('grupos.lg_fil_sin_actividad') }}
                                        </p>
                                    </div>
                                <div class="icon">
                                    <i class="fa fa-heart-o"></i>
                                </div>
                                <a href="sin-actividad" class="small-box-footer"> {{ Lang::get('grupos.lg_fil_ver') }} <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- /cuadro sin actividad -->

                        <!-- cuadro grupos sin lider -->
                        <div class="col-lg-2 col-md-2 col-xs-4 col-sm-2 contador"  data-toggle="tooltip" data-placement="top" title= "{{ Lang::get('grupos.lg_ttl_sin_lider') }}" >
                                
                              <div class="small-box bg-green">
                                    <div class="inner">
                                        <h3>{{ $cantidad_grupos_sin_lideres }}</h3>
                                        <p>
                                            {{ Lang::get('grupos.lg_fil_sin_lider') }}
                                        </p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-star-half-o"></i>
                                    </div>
                                    <a href="grupos-sin-lideres" class="small-box-footer"> {{ Lang::get('grupos.lg_fil_ver') }} <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                              </div>
                        </div>
                        <!-- /cuadro grupos sin lider-->

                        <!-- cuadro dados de alta -->
                        <div class="col-lg-2 col-md-2 col-xs-4 col-sm-2 contador"  data-toggle="tooltip" data-placement="top" title= "{{ Lang::get('grupos.lg_ttl_dados_baja') }}" >
                                
                              <div class="small-box bg-gray">
                                    <div class="inner">
                                        <h3>{{ $cantidad_dados_baja }}</h3>
                                        <p>
                                            {{ Lang::get('grupos.lg_fil_dados_baja') }}
                                        </p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-minus-circle"></i>
                                    </div>
                                    <a href="dados-de-baja" class="small-box-footer"> {{ Lang::get('grupos.lg_fil_ver') }} <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                              </div>
                        </div>
                        <!-- /cuadro dados de alta -->
                    </div>
                    <!-- /row de cuadro de colores -->

                    <div class="row"> 
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  
                            <div class="box box-primary"> 
                                <div class="panel-body">
                                    <!-- tabla -->
                                    <div class="box-body table-responsive">
                                        <div class="collapse" id="busqueda-avanzada">
                                          <div class="well">
                                            {{Lang::get('grupos.texto_simple_busqueda_detallada')}}
                                          </div>
                                        </div>   
                                        <!-- div de busqueda-->
                                        <div class="col-md-8 col-xs-12">
                                            @if(isset($buscar))
                                                @if($buscar!="")
                                                    @if($cantidad_busqueda == 1)
                                                       <h4>{{Lang::get('grupos.texto_resultado_busqueda')}} <b>{{ $cantidad_busqueda }}</b> {{Lang::get('grupos.texto_simple_termino_grupo_singular')}}.</h4>
                                                     @else
                                                       <h4>{{Lang::get('grupos.texto_resultado_busqueda')}} <b>{{ $cantidad_busqueda }}</b> {{Lang::get('grupos.texto_simple_termino_grupo_plural')}}. </h4>
                                                     @endif  
                                                @endif
                                            @endif
                                          <form action="/grupos/lista/{{$tipo}}/" method="get" role="form" class="form-inline">
                                            <div class="input-group">
                                                
                                                <input type="text" id="buscar" name="buscar" class="form-control" value="{{ Input::get('buscar') }}" placeholder=" {{Lang::get('grupos.texto_place_holder_busqueda')}}" >
                                                <span class="input-group-btn">
                                                    @if(isset($buscar))
                                                    <a class="btn btn-danger" href="/grupos/lista/{{$tipo}}" type="submit"><i class="fa fa-times"></i></a>
                                                    @endif
                                                    <button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
                                                    <!--<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#busqueda-avanzada" aria-expanded="false" aria-controls="collapseExample">
                                                     Busqueda avanzada 
                                                    </button>-->
                                                </span>
                                            </div>
                                          </form>
                                        </div>
                                        <!-- fin div de busqueda-->
                                        
                                        <!-- div vacio-->
                                        <div class="col-md-4">
                                          
                                        </div>
                                         <!-- fin vacio-->
                                         
                                         <br><br>
                                         <!-- div de paginacion-->
                                        <div class="col-md-12  col-xs-12">
                                            <h4 ALIGN=right> <b>{{ $grupos->getCurrentPage() }}</b> de <b>{{ $grupos->getLastPage() }}</b>  </h4>                                           
                                        </div>
                                        <!-- fin de paginacion-->

                                        <table id="example1" class="table table-striped display " cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                	<th>{{ Lang::get('grupos.lg_th_1') }}</th>
                                                    <th>{{ Lang::get('grupos.texto_titulo_info_ministerial') }}</th>
                                                    <th>{{ Lang::get('grupos.lg_th_3') }}</th>                                                    
                                                    <th> Ultimo reporte </th>                                                    
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                             @foreach($grupos as $grupo)
                                             <?php
                                                $style_td="";
                                                if($grupo->dado_baja==1)
                                                {
                                                    $color="label-info";
                                                }
                                                else if($grupo->inactivo==1)
                                                {
                                                    $color="label-info";
                                                    $style_td="background-color: #FDF2F1!important;";
                                                }
                                                else
                                                {
                                                    $color="label-info";
                                                }
                                             ?>          
                                                <tr>                                                    
                                                    <td style="{{ $style_td }}">
                                                    	<label class="label arrowed-right {{$color}}" data-toggle="tooltip" data-placement="top" title= " {{ Lang::get('grupos.lg_ttl_codigo') }} "> {{ Lang::get('grupos.lg_lb_codigo') }} </label> {{ $grupo->id }}<br>
                                                    	<a href="../perfil/{{ $grupo->id }}"><label class="label arrowed-right {{$color}}" data-toggle="tooltip" data-placement="top" title= " {{ Lang::get('grupos.lg_ttl_nombre') }} "><i class="fa  fa-share-alt" style="margin-right:7px;"> </i> {{ Lang::get('grupos.lg_lb_nombre') }} </label> <span class="capitalize">{{ $grupo->nombre }}</span></a><br>
                                                        <label class="label arrowed-right {{$color}}" data-toggle="tooltip" data-placement="top" title= " {{ Lang::get('grupos.lg_ttl_fecha_creacion') }} "> {{ Lang::get('grupos.lg_lb_fecha_creacion') }} </label> {{ Helper::fechaFormateada($grupo->fecha_apertura) }}                                                           					
                                                    					
                                                    </td>

                                                    <td style="{{ $style_td }}">
                                                        @foreach($grupo->encargados as $encargado)
                                                            @if ($encargado->tipoAsistente['id']==5)
                                                                <label class="label arrowed-right bg-purple" data-toggle="tooltip" data-placement="top" title="{{ $encargado->tipoAsistente['nombre'] }}"><i class="fa fa-book" style="margin-right:15 px;"> </i></label> 
                                                            @elseif($encargado->tipoAsistente['id']==4)
                                                                <label class="label arrowed-right bg-orange" data-toggle="tooltip" data-placement="top" title="{{ $encargado->tipoAsistente['nombre'] }}"><i class="fa fa-star" style="margin-right:15 px;"> </i></label> 
                                                            @endif
                                                            <span class="capitalize">{{ $encargado["nombre"] ." ".$encargado["apellido"] }}</span><br>
                                                        @endforeach  
                                                        <?php $linea=$grupo->linea(); ?>
                                                        @if (isset($linea->nombre)) 
                                                           <label class="label arrowed-right {{$color}}" data-toggle="tooltip" data-placement="top" title="{{ Lang::get('grupos.lg_ttl_linea') }} "> {{ Lang::get('grupos.lg_lb_linea') }}</label> {{ $linea->nombre }} <br> 
                                                        @endif
                                                        
                                                    </td>
                                                    
                                                    <td style="{{ $style_td }}">
                                                        <label class="label arrowed-right {{$color}}" data-toggle="tooltip" data-placement="top" title= " {{ Lang::get('grupos.lg_ttl_dia_reunion') }} ">{{ Lang::get('grupos.lg_lb_dia_reunion') }} </label> @if($grupo->dia != 0 && $grupo->dia !="" ){{ Lang::choice('general.dias', $grupo->dia) }} ,@endif {{ date("g:i a",strtotime("$grupo->hora")) }} <br> 

                                                        <label class="label arrowed-right {{$color}}" data-toggle="tooltip" data-placement="top" title=" {{ Lang::get('grupos.lg_ttl_tipo_grupo') }} "> {{ Lang::get('grupos.lg_lb_tipo_grupo') }} </label> {{ $grupo->tipoGrupo['nombre'] }} <br>

                                                        
                                                        <label class="label arrowed-right {{$color}}" data-toggle="tooltip" data-placement="top" title=" {{ Lang::get('grupos.lg_ttl_red') }} "> {{ Lang::get('grupos.lg_lb_red') }} </label> 
                                                            <?php $arrayRedes = array(); ?>
                                                            @foreach($grupo->redes as $red)
                                                                <?php $arrayRedes[]= $red['nombre'] ?>
                                                            @endforeach
                                                            {{ implode(", ", $arrayRedes) }}
                                                    </td>
                                                   
                                                    <td style="{{ $style_td }}">
                                                        <?php $reporte=ReporteGrupo::where('grupo_id', "$grupo->id")->orderBy('fecha', 'desc')->first(); ?>
                                                        @if(isset($reporte->id))
                                                        <span class="badge bg-aqua">{{Lang::get('grupos.texto_simple-campo_ultimo_reporte')}} {{ $reporte->fecha }} </span>
                                                        @else
                                                        <span class="badge bg-red">
                                                            {{Lang::get('grupos.texto_simple-campo_nunca_reportado')}}
                                                        </span>
                                                        @endif
                                                        @if($grupo->alDia())
                                                            <span class="badge bg-green" data-toggle="tooltip" data-placement="top" title= " {{ Lang::get('grupos.lg_al_dia_title') }} "><i class="fa fa-check-circle" style="margin-right:7px;"> </i>{{ Lang::get('grupos.lg_al_dia') }} </span> 
                                                        @endif
                                                    </td>
                                                    
                                                    <td style="{{ $style_td }}">
                                                    	<div class="btn-group">
                                                            <button type="button" class="btn btn-success btn-info dropdown-toggle" data-toggle="dropdown">
                                                                {{ Lang::get('grupos.lg_bt_opciones') }}  
                                                                <i class="fa fa-caret-down"> </i>
                                                           </button>
                                                            <ul class="dropdown-menu">
                                                                @if($grupo->dado_baja==0)
                                                                    <li><a href="../perfil/{{$grupo->id}}">{{ Lang::get('grupos.lg_bt_opciones_0') }}</a></li>
                                                                    <li><a href="../actualizar/{{$grupo->id}}">{{ Lang::get('grupos.lg_bt_opciones_1') }}</a></li>
                                                                    <li><a href="../dado-baja-alta/{{$grupo->id}}">{{ Lang::get('grupos.lg_bt_opciones_3') }}</a></li>
                                                                @else
                                                                    <li><a href="../dado-baja-alta/{{$grupo->id}}">{{Lang::get('grupos.texto_simple_dar_alta_grupo')}}</a></li>
                                                                @endif
                                                                <li><a href="#">{{ Lang::get('grupos.lg_bt_opciones_2') }}</a></li>                                                               
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    
                                                </tr>
                                                
                                               @endforeach
                                            </tbody>  
                                        </table>
                                    </div>
                                    <!-- /tabla -->
                                </div>
                                <div class="box-footer">                                   
                                    <div class="row">                                        
                                        <div class="col-lg-4">                                            
                                          <h4> <b>{{ $grupos->getFrom() }}</b> - <b>{{ $grupos->getTo() }}</b> de <b>{{ $grupos->getTotal() }} </b> {{Lang::get('grupos.texto_simple_registros')}}</h4> 
                                        </div>
                                        @if(!isset($buscar))
                                        <div class="col-lg-8 text-right" style="padding-right: 30px!important;"> {{ $grupos->links() }}</div>
                                        @else
                                        <div class="col-lg-8 text-right" style="padding-right: 30px!important;"> {{ $grupos->appends(array('buscar' => $buscar))->links() }}</div>
                                        @endif
                                    </div>
                                </div>
                            
                        </div>
                        <!-- /div de 12 columnas -->
                    </div>
                	<!-- /row de la tabla -->
                </section>
                <!-- contenido principal -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        


        @include('includes.scripts')   

        <!-- DATA TABES SCRIPT -->
         <script src="{{ Lang::get('general.url-datatables') }}" type="text/javascript"></script>
        <script src="/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
       <!-- bootstrap multiselect -->
        <script type="text/javascript" src="/js/bootstrap-multiselect.js"></script>
     
        
        <!-- page script -->
        <script type="text/javascript">
			
            $(document).ready(function() {
                $('.multiselectRedes').multiselect();
                $("#menu_grupos").children("a").first().trigger('click');

				/*$('#example1').dataTable( {
					 
				} );*/

			} );

            
        </script>

        
        
    </body>
</html>
@endif