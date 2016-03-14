
<!DOCTYPE html>
@include('includes.lenguaje')
<html>
    <head>
        <meta charset="UTF-8">
        <title>Redil | Tutoriales</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        @include('includes.styles')
        <!-- daterangepicker -->
        <link href="/css/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="/css/chosen/bootstrap-chosen.css">
          <!--style necesario para usar el recoret de la imagen -->
        <style type="text/css">
        </style>
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
              	<h1>TUTORIALES
                  <small>Aquí encontraras videos que te pueden ser de mucha ayuda.</small>
                </h1>                        
              </section>
              <!-- /contendio cabezote -->               
                 

              <!-- contenido principal -->
              <section class="content">
              		<div class="row-fluit" >
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 campo-filtro">
                        <form id="filtros" action="" method="get" role="form" class="form-inline">                   
                            <select  style="width:30%" id="categoria" name="categoria" class="chosen-select" data-placeholder="Filtro por categoria">
                              <option  value="" @if(isset($seleccionada)) @if($seleccionada=="") selected @endif @endif ></option>
                              <option  value="todas" @if(isset($seleccionada)) @if($seleccionada=="todas") selected @endif @endif>Todas</option>
                              @foreach($categorias as $categoria)
                              <option value="{{$categoria->categoria}}" @if(isset($seleccionada)) @if($seleccionada==$categoria->categoria) selected @endif @endif>
                                @if($categoria->categoria == 0)
                                  General
                                @elseif($categoria->categoria == 1)
                                  Personas
                                @elseif($categoria->categoria == 2)
                                  Celulas o grupos
                                @elseif($categoria->categoria == 3)
                                  Cultos
                                @elseif($categoria->categoria == 6)
                                  Iglesia
                                @endif 
                              </option>
                              @endforeach
                            </select>                               
                        </form>
                      </div>
                      @foreach($tutoriales as $tutorial)
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 " style="margin-top:30px; padding-left: 5px;">  
                          <div class="embed-responsive embed-responsive-16by9"  style="background-color: #fff;">
                            <iframe width="100%"  class="embed-responsive-item" src="{{$tutorial->url}}" frameborder="0" allowfullscreen ></iframe>
                            <div style="padding:10px 10px 10px 10px ;">
                              <h3><b>{{$tutorial->titulo}}</b></h3>
                              
                              <small class="badge bg-blue">
                              @if($tutorial->categoria == 0)
                                <i class="fa fa-users"></i> General
                              @elseif($tutorial->categoria == 1)
                                 <i class="fa fa-users"></i> Personas
                              @elseif($tutorial->categoria == 2)
                                <i class=" fa fa-share-alt"></i> Celulas o grupos 
                              @elseif($tutorial->categoria == 3)
                                <i class=" fa fa-home"></i> Cultos
                              @elseif($tutorial->categoria == 6)
                                <i class=" fa fa-users"></i> Iglesia
                              @endif 
                              </small>
                            </div>
                            
                          </div>
                                                   
                        </div>

                      @endforeach   

                </div>
              </section>
              <!-- contenido principal -->
            </aside>  


        <!-- aqui inicia el modal que me permite agregar el o los lideres del grupo actual.-->              

        @include('includes.scripts')

        
        <!-- plugins para filtros -->
        <script src="/js/plugins/moment/moment.js" type="text/javascript"></script>
        <script src="/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <script type="text/javascript" src="/js/plugins/chosen/chosen.js"></script>


        <!-- Script para los filtros -->
        <script type="text/javascript">
          $(function() {
            //select con buscador
            $('#categoria').chosen({ allow_single_deselect: true });


            $("#categoria").on('change', function(){
              $("#filtros").submit();
            });

          });
        </script>

    </body>
</html>
