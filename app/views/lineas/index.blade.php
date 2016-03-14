@if(Auth::check())
@include('includes.lenguaje')

<!DOCTYPE html>
<!-- Vista creada por: Darwin Castaño
     Fecha creacíón: 15-07-2014
     Fecha Ultima modificación: 22-07-2014 02:40pm
     funcion vista: esta es la vista que contiene el listado de todas las lineas.
     software REDIL version 1.0
-->
<html>
  <head>
    <meta charset="UTF-8">
    <title>Redil | {{ Lang::get('lineas.ll_title') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
     @include('includes.styles')
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
            <div class="box-header">
              <div class="pull-right box-tools" >
                <a href="/lineas/nuevo" class="btn btn-danger btn-md"> <i class="fa fa-plus"></i> {{ Lang::get('lineas.ll_bt_nuevo_lista') }} </a>
                <button data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Imprimir"  onclick="window.print();" ><i class="fa fa-print"></i></button>
                <!-- <button data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Enviar por Email"><i class="fa fa-envelope"></i></button> -->
                <button data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Generar Archivo PDF"><i class="fa fa-file-pdf-o "></i></button>
                <!--<button class="btn btn-danger btn-md" data-widget='collapse' data-toggle="tooltip" title="Desplegar Filtros"><i class="fa fa-filter"></i></button> -->
              </div>
              <h3 class=" content-header" style="font-size:24px">
                {{ Lang::get('lineas.ll_header') }}
              <small style="font-size:15px; font-weight:300;">Aquí encuentras todas las líneas de la iglesia</small>
              </h3>                          
            </div>           
          <!-- /row de cuadro de colores -->
        </section>
        <!-- /contendio cabezote -->    

        <!-- columna de mensaje -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"style="margin-bottom: 10px;">
          <div class=" box-header">
            <?php $status=Session::get('status'); ?>
            @if($status=='ok_update')
              <?php $id=Session::get('id_nuevo'); 
                $nombre=Session::get('nombre_nuevo'); 
              ?>
              <div class="alert alert-success col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom:5px; padding-top:5px; margin-bottom: -5px" >
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <b> La linea fue eliminada con exito</b> 
              </div>                                        
            @endif
          </div>
        </div>

        <!-- contenido principal -->
        <section class="content">

          <!-- row de la tabla -->
          <div class="row">  
            <!-- div de 12 columnas -->                
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="box box-primary">

                <div class="panel-body">
                  <!-- tabla -->
                  <div class="box-body table-responsive">          
                    
                    <!-- div de busqueda-->
                    <div class="col-lg-12 col-md-8 col-sm-12 col-xs-12">

                      @if(isset($buscar))
                        @if($buscar!="")
                        <h4>La busqueda arrojo <b>{{ $cantidad_busqueda }}</b> lineas. </h4>
                        @endif
                      @endif
                      <form action="/lineas/lista" method="get" role="form" class="form-inline">
                        <div class="input-group">
                          <input type="text" id="buscar" name="buscar" class="form-control" value="{{ Input::get('buscar') }}" placeholder=" Busque aqui ..." >
                          <span class="input-group-btn">
                          @if(isset($buscar))
                                <a class="btn btn-danger" href="/lineas/lista" type="submit"><i class="fa fa-times"></i></a>
                          @endif 
                            <button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
                            
                          </span>
                          
                        </div>
                      </form>
                      <?php $cantidad_grupos=0 ?>

                    </div>
                    <!-- fin div de busqueda-->
                    
                     
                     <br><br>
                     <!-- div de paginacion-->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                       <h4 ALIGN=right> Página<b>{{ $lineas->getCurrentPage() }}</b> de <b>{{ $lineas->getLastPage() }}</b>  </h4> 
                    </div>
                     <!-- fin de paginacion-->

                    <table id="example1" class="table table-striped display " cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>{{ Lang::get('lineas.ll_tb_th1') }}</th>
                          <th>{{ Lang::get('lineas.ll_tb_th3') }}</th>
                          <th> Grupos </th>
                          <th> Asistentes </th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($lineas as $linea)
                        <tr>                                                  
                          <td>
                            <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="{{ Lang::get('lineas.ll_lb_tit_codigo') }}">{{ Lang::get('lineas.ll_lb_codigo') }}</label>  {{ $linea->id }} <br> 
                            <a href="../lineas/perfil/{{$linea->id}}"> <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="{{ Lang::get('lineas.ll_lb_tit_nombre_linea') }}"> {{ Lang::get('lineas.ll_lb_nombre_linea') }}</label> {{ $linea->nombre }} <br>  </a><br>                                                    
                            <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="{{ Lang::get ('lineas.ll_lb_tit_descripcion') }}">{{ Lang::get ('lineas.ll_lb_descripcion') }}</label> {{ $linea->descripcion }}<br>                            
                          </td>       
                          <td>
                            @foreach ($linea->encargados as $encargado)
                              @if ($encargado->tipoAsistente['id']==5)
                                <label class="label arrowed-right bg-purple" data-toggle="tooltip" data-placement="top" title="{{ $encargado->tipoAsistente['nombre'] }}"><i class="fa fa-book" style="margin-right:15 px;"> </i></label> 
                              @elseif($encargado->tipoAsistente['id']==4)
                                <label class="label arrowed-right bg-orange" data-toggle="tooltip" data-placement="top" title="{{ $encargado->tipoAsistente['nombre'] }}"><i class="fa fa-star" style="margin-right:15 px;"> </i></label> 
                              @endif
                              <span class="capitalize">{{ $encargado->nombre." ".$encargado->apellido }} </span>
                              <br>
                            @endforeach                                            
                          </td>
                          <td>
                            <?php $numero_integrantes=0; 
                                  $total_integrantes=$linea->asistentes()->whereRaw('asistentes.deleted_at IS NULL')->count(); 
                                  $total_integrantes_inactivos_grupo=$linea->asistentes()->where('inactivo_grupo', '1')->count();
                                  $total_integrantes_inactivos_culto=$linea->asistentes()->where('inactivo_iglesia', '1')->count();
                                  $cantidad_grupos=$linea->grupos()->count(); 
                                  $cantidad_grupos_inactivos=$linea->grupos()->where('inactivo', '1')->count(); 
                            ?>
                            <small class="badge bg-light-blue">Total grupos: </small>  {{ $cantidad_grupos }}
                            <br>
                            <small class="badge bg-red">Inactivos:</small>
                            {{ $cantidad_grupos_inactivos }}
                          </td>

                          <td>
                            <small class="badge bg-light-blue">Total asistentes: </small>  {{ $total_integrantes }}
                            <br>
                            <small class="badge bg-red">Inactivos en grupo:</small>
                            {{ $total_integrantes_inactivos_grupo }}
                            <br>
                            <small class="badge bg-red">Inactivos en culto:</small>
                            {{ $total_integrantes_inactivos_culto }}
                          </td>

                          <td>
                            <div class="btn-group">
                              <button type="button" class="btn btn-success btn-info dropdown-toggle" data-toggle="dropdown">
                                {{ Lang::get('lineas.ll_bt_opciones') }} 
                                <i class="fa fa-caret-down"> </i>
                              </button>
                              <ul class="dropdown-menu">
                                <li><a href="../lineas/perfil/{{$linea->id}}">{{ Lang::get('lineas.ll_lb_ver_perfil') }}</a></li>
                                <li><a href="../lineas/actualizar/{{$linea->id}}">{{ Lang::get('lineas.ll_lb_modificar') }}</a></li>
                                <li><a href="#">{{ Lang::get('lineas.ll_lb_dar_de_baja') }}</a></li>
                                @if($cantidad_grupos>0)
                                  <li><a href="" data-toggle="modal"  data-cantidad-grupos="{{$cantidad_grupos}}" class="borrar-linea">{{ Lang::get('lineas.ll_lb_eliminar') }}</a></li>
                                @else
                                  <li><a  href="../lineas/eliminar/{{$linea->id}}">{{ Lang::get('lineas.ll_lb_eliminar') }}</a></li>
                                @endif
                              </ul>
                            </div>
                          </td>
                        </tr>
                        @endforeach                                                
                      </tbody>
                    </table>
                  </div>
                  <!-- /tabla -->
                </div> <!-- /panel body -->

                <div class="box-footer">
                  <div class="row">
                    <div class="col-lg-4"> 
                      <h4> <b>{{ $lineas->getFrom() }}</b> - <b>{{ $lineas->getTo() }}</b> de <b>{{ $lineas->getTotal() }} </b> registros.</h4> 
                    </div>
                    @if(!isset($buscar))
                      <div class="col-lg-8 text-right" style="padding-right: 30px!important;"> {{ $lineas->links() }}</div>
                    @else
                      <div class="col-lg-8 text-right" style="padding-right: 30px!important;"> {{ $lineas->appends(array('buscar' => $buscar))->links() }}</div>
                    @endif

                  </div>
                </div> 

              </div><!-- /Box primary --> 
            </div><!-- /Div de 12 columnas -->
          </div><!-- /row -->
        		
        </section>
        <!-- contenido principal -->
      </aside>  
    </div>

    <!-- /modal   -->
    <div id="msn_modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <br>
          </div>
          <div class="modal-body">
            <h4 id="msn_confirmacion" class="modal-title bg-danger text-center" id="myModalLabel">Para poder eliminar esta línea no debe tener ningún grupo vinculada a ella, por favor desvincule @if($cantidad_grupos==1) el {{$cantidad_grupos}} grupo @else los {{$cantidad_grupos}} grupos @endif  existentes. </h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- /modal   -->
      
    @include('includes.scripts') 
    <!-- DATA TABES SCRIPT -->
    <script src="{{ Lang::get('general.url-datatables') }}" type="text/javascript"></script>
    <script src="/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
     
    <!-- page script -->
    <script type="text/javascript">
    $(document).ready(function() {
      //activa (desplega) emnu correspondiente
      $("#menu_lineas").children("a").first().trigger('click');

      $('.borrar-linea').click (function () {

        cant_grupos = $(this).attr("data-cantidad-grupos");  

        $('#msn_modal').modal('show'); 
        $('#msn_confirmacion').html('Para poder eliminar esta línea no debe tener ningún grupo vinculado a ella, falta <b>'+cant_grupos+'</b>  grupo(s) por desvincular. ');
                    

       }); // llama modal msn_modal

			
   	} );
    </script>
  </body>
  @endif
</html>