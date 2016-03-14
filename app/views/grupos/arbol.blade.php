@if(Auth::check())
@include('includes.lenguaje')
<?php include '../app/views/includes/terminos.php'; ?>
<!DOCTYPE html>
<html>
  <head>
      <meta charset="UTF-8">
      <title>{{Lang::get('reporte_grupos.texto_reporte_index_titulo_pagina')}} | {{Lang::get('reporte_grupos.texto_reporte_nombre_pagina')}}</title>
      <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
      @include('includes.styles')
      <!-- daterangepicker -->
      <link rel="stylesheet" href="/css/chosen/bootstrap-chosen.css">

      <link rel="stylesheet" href="/css/jorgchart/jquery.jOrgChart.css"/>
      
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
      <!-- contendio cabezote -->
      <section class="content-header">
        <div class="box box-filtro" >
          <div class="box-header">
            <div class="pull-right box-tools" >
              <a href="../nuevo" class="btn btn-danger btn-md"> <i class="fa fa-plus"></i> Nuevo Reporte </a>
              <!--<button data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Imprimir"  onclick="window.print();" ><i class="fa fa-print"></i></button>-->
              <!--<button data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Enviar por Email"><i class="fa fa-envelope"></i></button> -->
              <!--<button data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Generar Archivo PDF"><i class="fa fa-file-pdf-o "></i></button> -->
             
            </div>
            <h3 class="content-header" style="font-size:24px">
              {{Lang::get('reporte_grupos.texto_titulo_header')}}
              <small>{{Lang::get('reporte_grupos.texto_subtitulo_header')}} </small></h3>
            </h3>  
          </div>
                  
          <div class="box-body">
          </div>
        </div>
      </section>
      <!-- /contendio cabezote -->
      
      <!-- contenido principal -->
      <section class="content">
        <!-- row de la tabla -->
        <div class="row">   
          <!-- div de 12 columnas -->                    
          <div class="col-xs-12">
            <div class="box box-primary">
              <div class="panel-body">
                <!-- tabla lista-->
                <div class="box-body table-responsive">
                  <!--<div class="collapse" id="busqueda-avanzada">
                    <div class="well">
                      Proximamente busqueda detallada ... 
                    </div>
                  </div> --> 
                  <!-- div de busqueda-->
                  <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <form id="filtros" action="" method="get" role="form" class="form-inline">
                      @if($lineas->count()>0)
                      <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 campo-filtro">
                        <select style="width:100%" id="linea" name="linea" class="chosen-select" data-placeholder="Filtro por línea" >
                            <option value="" @if(isset($linea)) @if($linea=="") selected @endif @endif >Todas las líneas</option>
                            @foreach($lineas as $lin) <!-- Se le coloco lin porque linea ya era una variable que viene del controlador -->
                            <option value="{{ $lin->id }}" @if(isset($linea)) @if($linea==$lin->id) selected @endif @endif>{{ $lin->id." - ".$lin->nombre  }}</option>
                            @endforeach
                        </select>
                      </div>
                      @endif

                      @if($grupos->count()>0)
                      <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 campo-filtro">
                        <select style="width:100%" id="grupo" name="grupo" class="chosen-select" data-placeholder="Filtro por línea" >
                            <option value="" @if(isset($grupo)) @if($grupo=="") selected @endif @endif >Todas los grupos</option>
                            @foreach($grupos as $grup) <!-- Se le coloco grup porque grupo ya era una variable que viene del controlador -->
                            <option value="{{ $grup->id }}" @if(isset($grupo)) @if($grupo==$grup->id) selected @endif @endif>{{ $grup->id." - ".$grup->nombre  }}</option>
                            @endforeach
                        </select>
                      </div>
                      @endif
                      
                    </form>
                  </div>
                  <!-- fin div de busqueda-->
                 
                  <ul id="org" style="display:none">
                    <li>
                       <div class="box box-danger">
                        <div class="box-header with-border">
                          <h3 class="box-title">Latest Members</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                          <ul class="users-list clearfix">
                            <li>
                              <img src="/img/fotos/asistente-1.jpg" alt="User Image">
                              <a class="users-list-name" href="#">Alexander Pierce</a>
                            </li>
                            <li>
                              <img src="/img/fotos/asistente-300.jpg" alt="User Image">
                              <a class="users-list-name" href="#">Norman</a>
                            </li>
                          </ul>
                          <!-- /.users-list -->
                        </div>
                      </div>
                       <ul>
                         <li id="beer">Beer</li>
                         <li>Vegetables
                           <a href="http://wesnolte.com" target="_blank">Click me</a>
                           <ul>
                             <li>Pumpkin</li>
                             <li>
                                <a href="http://tquila.com" target="_blank">Aubergine</a>
                                <p>A link and paragraph is all we need.</p>
                             </li>
                           </ul>
                         </li>
                         <li class="fruit">Fruit
                           <ul>
                             <li>Apple
                               <ul>
                                 <li>Granny Smith</li>
                               </ul>
                             </li>
                             <li>Berries
                               <ul>
                                 <li>Blueberry</li>
                                 <li><img style="width:40px; border-radius: 50%; height: 40px;" src="/img/fotos/asistente-1.jpg" alt="Raspberry"/>
                                 <img style="width:40px; border-radius: 50%; height: 40px;" src="/img/fotos/asistente-1.jpg" alt="Raspberry"/></li>
                                 <li>Cucumber</li>
                               </ul>
                             </li>
                           </ul>
                         </li>
                         <li>Bread</li>
                         <li class="collapsed">Chocolate
                           <ul>
                             <li>Topdeck</li>
                             <li>Reese's Cups</li>
                           </ul>
                         </li>
                       </ul>
                     </li>
                   </ul>            
                    
                    <div id="arbol" class="orgChart col-lg-12 col-md-12 col-xs-12 col-sm-12"></div>
                  
                   
                </div>
                <!-- /tabla -->
              </div>        

            </div><!-- /Box primary -->

          </div><!-- /Div de 12 columnas -->
        </div><!-- /row -->
      </section>
      <!-- contenido principal -->
    </aside>  

    <!-- /modal mensaje para cuando se apruebe reporte -->
    <div id="msn_modal_aprobado_exito" class="modal modal-exito fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h3 class="titulo"> REPORTE APROBADO </h3 class="titulo">
            </div>
            <div class="modal-body">
                  <h4 id="msn_aprobado_exito" class="modal-title bg-danger" id="myModalLabel"> Mensaje ...  </h4>
      
            </div>
            <div class="modal-footer">
              <center><a id="btn_aprobado_exito" href="#" type="button" class="btn bg-light-redil" data-dismiss="modal">Aceptar</a></center>
            </div>
        </div>
      </div>
    </div>
    <!-- /modal   -->

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="/js/AdminLTE/app.js" type="text/javascript"></script>
      
    <!-- plugins para filtros -->
    <script type="text/javascript" src="/js/plugins/chosen/chosen.js"></script>

    <!--plugin para el arbol -->
    
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
    <script src="/js/plugins/jorgchart/jquery.jOrgChart.js"></script>

    <script>
    <?php $grupos_aux2=Grupo::gruposNivel(1)->get(); ?>
    @foreach($grupos_aux2 as $grupo1)
    alert("{{ $grupo1->nombre }}");
    @endforeach
    jQuery(document).ready(function() {
        $("#org").jOrgChart({
            chartElement : '#arbol',
            dragAndDrop  : true
        });
    });
    </script>

    <!-- Script para los filtros -->
    <script type="text/javascript">
      $(function() {
        //select con buscador para lineas
        $('#linea').chosen({ allow_single_deselect: true });

        //select con buscador para grupos
        $('#grupo').chosen({ allow_single_deselect: true });

        
         
          $("#linea").on('change', function(){
            $("#grupo").val('');
            $("#filtros").submit();

          });

          $("#grupo").on('change', function(){
            $("#filtros").submit();
          });

          $("#limpiar").on('click', function(){
            $("#buscar").val("");
            $("#filtros").submit();
          });
      });
      </script>
  </body>
</html>

@endif