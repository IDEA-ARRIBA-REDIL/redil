@if(Auth::check())
@include('includes.lenguaje')
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{{Lang::get('reuniones.texto_reporte_index_titulo_pagina')}} |  {{Lang::get('reuniones.texto_simple_titulo_pagina_reuniones')}} </title>
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
                    <div class="box" style="background-color:transparent; border:none; box-shadow:none; margin-left:-5px; margin-bottom:-40px; ">
                        <div class="box-header">
                            <div class="pull-right box-tools" >
                                @if(Auth::user()->id==1)
                                <a href="../nuevo" class="btn btn-danger btn-md"> <i class="fa fa-plus"></i> {{Lang::get('reuniones.texto_simple_boton_nueva_reunion')}} </a>
                                @endif
                                <button data-toggle="tooltip" title="" class="btn btn-info" data-original-title=" {{ Lang::get('general.dot_imprimir') }} "  onclick="window.print();" ><i class="fa fa-print"></i></button>
                                <button data-toggle="tooltip" title="" class="btn btn-info" data-original-title=" {{ Lang::get('general.dot_email') }} "><i class="fa fa-envelope"></i></button>
                                <a href="#"  data-toggle="tooltip" title="" class="btn btn-info" data-original-title=" {{ Lang::get('general.dot_pdf') }} "><i class="fa fa-file-pdf-o "></i></a>
                            </div> 	
                       	    <h3 class="content-header" style="font-size:24px">
                                {{Lang::get('reuniones.texto_simple_lista_reuniones')}}
                                <small> {{Lang::get('reuniones.texto_simple_subtitulo_lista_reuniones')}} </small>
                            </h3>
                        </div>
                    </div>
                </section>
                <!-- /contendio cabezote --> 
                <br>
                <!-- contenido principal -->
                <section class="content">
                    <!-- row de la tabla -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="box box-primary">
                                <div class="panel-body">
                                    <!-- tabla -->
                                    <div class="box-body table-responsive">
                                    <?php $status=Session::get('status'); 
                                     $nombre_reunion=Session::get('nombre_reunion')
                                    ?>
                                    @if($status=='ok_down')
                                    <div class="col-lg-12">
                                    <div class="alert alert-success" style="padding-bottom:5px; padding-top:5px" >
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{Lang::get('reuniones.texto_simple_reunion1')}} "{{ $nombre_reunion }}" {{Lang::get('reuniones.texto_simple_reunion2')}}
                                    </div>
                                    </div>
                                    @endif

                                        <!-- div de busqueda-->
                                        <div class="col-md-8 col-xs-12">
                                            @if(isset($buscar))
                                                @if($buscar!="")
                                                    @if($cantidad_busqueda == 1)
                                                       <h4>{{Lang::get('reuniones.texto_simple_busqueda_arrojo')}}<b>{{ $cantidad_busqueda }}</b> {{Lang::get('reuniones.texto_simple_reunion')}}. </h4>
                                                     @else
                                                       <h4>{{Lang::get('reuniones.texto_simple_busqueda_arrojo')}} <b>{{ $cantidad_busqueda }}</b> {{Lang::get('reuniones.texto_simple_reuniones')}}. </h4>
                                                     @endif
                                                @endif
                                            @endif
                                          <form action="/reuniones/lista/todos" method="get" role="form" class="form-inline">
                                            <div class="input-group">
                                                
                                                <input type="text" id="buscar" name="buscar" class="form-control" value="{{ Input::get('buscar') }}" placeholder=" Busque aqui ..." >
                                                <span class="input-group-btn">
                                                    @if(isset($buscar))
                                                    <a class="btn btn-danger" href="/reuniones/lista/todos" type="submit"><i class="fa fa-times"></i></a>
                                                    @endif
                                                    <button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
                                                   
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
                                            <h4 ALIGN=right> {{Lang::get('reuniones.texto_simple_pagina')}}<b>{{ $reuniones->getCurrentPage() }}</b> {{Lang::get('reuniones.texto_simple_de')}} <b>{{ $reuniones->getLastPage() }}</b>  </h4>                                           
                                        </div>
                                        <!-- fin de paginacion-->
                                        <table id="example1" class="table table-striped display " cellspacing="0" width="100%">
                                            <thead>
                                                <tr>  
                                                	<th>{{Lang::get('reuniones.texto_simple_tabla_col1')}}</th>
                                                    <th>{{Lang::get('reuniones.texto_simple_tabla_col2')}}</th>
                                                    <th>{{Lang::get('reuniones.texto_simple_tabla_col3')}}</th>                                                                                                    
                                                    <th></th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                             @foreach($reuniones as $reunion)     
                                                <tr>                                                    
                                                    <td>
                                                    	<label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title= " Código ">{{Lang::get('reuniones.texto_simple_cod')}}</label> {{ $reunion->id }}<br>
                                                        <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title= " Nombre "> <i class="fa fa-home"> </i>{{Lang::get('reuniones.texto_simple_campo_nombre')}}</label> {{ $reunion->nombre }} <br>                                                           								
                                                    </td>

                                                    <td>
                                                        <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title= " Hora "><i class="fa fa-clock-o"></i>{{Lang::get('reuniones.texto_simple_campo_hora')}}</label> {{ $reunion->hora }} <br> 
                                                        <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title= " Día "><i class="fa fa-calendar"></i> {{Lang::get('reuniones.texto_simple_campo_dia')}} </label> @if($reunion->dia != 0 && $reunion->dia !="" ){{ Lang::choice('general.dias', $reunion->dia) }} @endif <br>   
                                                        <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title= " Lugar "><i class="fa fa-home"> </i>{{Lang::get('reuniones.texto_simple_campo_lugar')}}</label> {{ $reunion->lugar }} <br> 
                                                    </td>
                                                    
                                                    <td>

                                                        <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title=" Descripción "><i class="fa fa-info-circle"> </i> {{Lang::get('reuniones.texto_simple_campo_descripcion')}}</label> {{ $reunion->descripcion }} <br>

                                                    </td>

                                                    <td>
                                                        <div class="btn-group">
                                                            @if(Auth::user()->id==1)
                                                            <button type="button" class="btn btn-success btn-info dropdown-toggle" data-toggle="dropdown">
                                                                Opciones  
                                                                <i class="fa fa-caret-down"> </i>
                                                           </button>
                                                            <ul class="dropdown-menu">
                                                                
                                                                    <li><a href="../perfil/{{$reunion->id}}"> {{Lang::get('reuniones.texto_boton_opciones_perfil')}} </a></li>
                                                                    <li><a href="../actualizar/{{$reunion->id}}">{{Lang::get('reuniones.texto_boton_opciones_modificar')}}  </a></li>
                                                                    <li><a href="../dardebaja/{{$reunion->id}}"> {{Lang::get('reuniones.texto_boton_opciones_dar_baja')}}</a></li>                                                            
                                                            </ul>
                                                            @else
                                                                    <a href="../perfil/{{$reunion->id}}" type="button" class="btn btn-success btn-info dropdown-toggle">
                                                                   {{Lang::get('reuniones.texto_boton_opciones_perfil')}}
                                                                    </a>
                                                            @endif
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
                                          <h4> <b>{{ $reuniones->getFrom() }}</b> - <b>{{ $reuniones->getTo() }}</b> de <b>{{ $reuniones->getTotal() }} </b> registros.</h4> 
                                        </div>
                                        @if(!isset($buscar))
                                        <div class="col-lg-8 text-right" style="padding-right: 30px!important;"> {{ $reuniones->links() }}</div>
                                        @else
                                        <div class="col-lg-8 text-right" style="padding-right: 30px!important;"> {{ $reuniones->appends(array('buscar' => $buscar))->links() }}</div>
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
                $("#menu_reuniones").attr('class', 'treeview active');
                $("#submenu_reuniones").attr('style', 'display: block;');
                $("#flecha_reuniones").attr('class', 'fa fa-angle-down pull-right');

				/*$('#example1').dataTable( {
					 
				} );*/

			} );

        </script>

        
        
    </body>
</html>
@endif