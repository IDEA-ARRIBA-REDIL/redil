@if(Auth::check())
@include('includes.lenguaje')
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Redil</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        @include('includes.styles')

         <!-- Morris charts -->
        <link href="/css/morris/morris.css" rel="stylesheet" type="text/css" />

        <!-- daterange picker -->
        <link href="/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />

        <link href="http://cdn.datatables.net/1.10.0/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
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
                	
                    	<h1>
                        ESTADISTICAS GENERAL - ASISTENTES
                        <small> Aqui podras ver las graficas, estadisticas y comportamiento de los asistentes. </small></h1>
                                            
                        <br>
                 </section>
                 <!-- /contendio cabezote -->
                 

             <!-- contenido principal -->
              <section class="content">

                                                     
              		<!-- row  -->
                    <div class="row">

                        <div class="col-md-12 ">
                             <button data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Imprimir"  onclick="window.print();" ><i class="fa fa-print"></i></button>
                             <button data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Enviar por Email"><i class="fa fa-envelope"></i></button>
                             <button data-toggle="tooltip" title="" class="btn btn-info" data-original-title="Generar Archivo PDF"><i class="fa fa-file-pdf-o "></i></button>
                             <br>
                             <br>

                            <div class="alert alert-danger alert-dismissable">
                                <i class="fa fa-info"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <b> ¡Ten en cuenta! </b> las estadisticas que se muestra por defecto, parten desde <b>1 Enero</b> hasta la fecha del presente año, si desea modificar el rango de tiempo, puede hacerlo en el campo seleccionar rango.
                            </div>

                            <!-- Fecha con rango -->
                            <div class="form-group col-md-6">
                                <label>Selecciona rango</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <?php 
                                        $fecha_actual=date('d/m/Y');
                                        $fecha_inicio="01/".date('m/Y');

                                    ?>
                                    <input type="text" class="form-control pull-right" id="rango-estadisticas" value="{{ $fecha_inicio.' - '.$fecha_actual }}" readonly />
                                </div><!-- /.input group -->
                            </div>
                            <!-- /fecha con rango -->


                        </div>

                        <div class="col-md-12 ">

                             <div class="col-md-6">
                                    <button id="bn-generar-estadisticas" data-toggle="tooltip" title="" class="btn btn-warning" data-original-title="Generar Estadisticas"><i class="fa fa-refresh fa-1x"></i> Generar Estadisticas </button>
                             </div>
                             <br><br><br>

                        </div>

                        
                        <div class="col-md-12">
                            <!-- Estadistica Crecimiento del año actual -->
                                <div class="box box-danger">

                                    <div class="box-header">
                                        <h3 class="box-title"><span class="badge bg-red">  <i class="fa fa-bar-chart-o fa-3x"></i> </span> Crecimiento de asistencia </h3>

                                        <div class="pull-right box-tools">
                                             <button class="btn btn-info btn-sm " data-toggle="tooltip" title="" data-original-title="Esta grafica muestra el crecimiento en el año actual a través de los meses."><i class="fa fa-info"></i></button>

                                             <button class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                    <div class="box-body chart-responsive">
                                        <div class="chart" id="graf-crecimiento-año" style="height: 300px;"></div>
                                    </div><!-- /.box-body -->
                                </div><!-- /.box -->
                            <!-- /Estadistica Crecimiento del año actual  -->
                        </div>     

                        <div class="col-md-6">
                            <!-- Estadistica de asistencia por clasificacion-->
                            <div class="box box-danger">
                                <div class="box-header">
                                    <h3 class="box-title"><span class="badge bg-red">  <i class="fa fa-bar-chart-o fa-3x"></i> </span> Graficación por tipo</h3>
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-info btn-sm " data-toggle="tooltip" title="" data-original-title="Esta grafica muestra el total de asistentes distribuidos según su la clasificacion de los asistentes."><i class="fa fa-info"></i></button> 
                                        <button class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>                                       
                                    </div>



                                </div>
                                <div class="box-body chart-responsive">
                                    <div class="chart" id="sales-chart-clasificacion" style="height: 300px; position: relative;"></div>

                                    <table class="table table-condensedres table-hover" cellspacing="0" width="100%">
                                        
                                        <tbody>
                                            <thead>
                                                <tr>
                                                    <th>TIPO</th>
                                                    <th># DE ASISTENTES</th>                                                      
                                                </tr>
                                            </thead>  
                                                   
                                            <tr>
                                                <td>
                                                    Nuevos                  
                                                </td>
                                                <td>
                                                    50
                                                </td>
                                                
                                            </tr>
                                            <tr>
                                                <td>
                                                    Ovejas
                                                                                        
                                                </td>
                                                <td>
                                                    300                                
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Miembros                             
                                                </td>
                                                <td>
                                                    550                               
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Lideres                             
                                                </td>
                                                <td>
                                                    90                               
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Pastores
                                                                                        
                                                </td>
                                                <td>
                                                    10                               
                                                </td>
                                            </tr>
                                            
                                        </tbody>
                                        
                                    </table>    
                                </div><!-- /.box-body -->
                            </div>
                            <!-- /Estadistica de asistencia por clasificacion-->



                             <!-- Asistencia por edades-->
                            <div class="box box-danger">
                                <div class="box-header">
                                    <h3 class="box-title"><span class="badge bg-red">  <i class="fa fa-bar-chart-o fa-3x"></i> </span> Graficación por edades</h3>
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-info btn-sm " data-toggle="tooltip" title="" data-original-title="Esta grafica muestra como esta distribuidos la cantidad total asistente por edades."><i class="fa fa-info"></i></button>  
                                        <button class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>                                      
                                    </div>
                                </div>
                                <div class="box-body chart-responsive">
                                    <div class="chart" id="sales-chart-etapas" style="height: 300px; position: relative;"></div>

                                    <table class="table table-condensedres table-hover" cellspacing="0" width="100%">
                                        
                                        <tbody>
                                            <thead>
                                                <tr>
                                                    <th>ETAPA</th> 
                                                    <th># DE ASISTENTES</th>                                                      
                                                </tr>
                                            </thead>  
                                                   
                                            <tr>
                                               
                                                <td>
                                                     Niños
                        
                                                                                        
                                                </td>
                                                <td>
                                                    250
                                                </td>
                                                
                                                
                                            </tr>
                                            <tr>
                                                
                                                <td>
                                                    Jovenes  
                                                                                        
                                                </td>
                                                <td>
                                                    400                                
                                                </td>
                                            </tr>
                                            <tr>
                                                
                                                <td>
                                                   Adultos                           
                                                </td>
                                                <td>
                                                    350                             
                                                </td>
                                            </tr>
                                            
                                        </tbody>
                                        
                                    </table>    
                                </div><!-- /.box-body -->
                            </div>
                            <!-- /Asistencia por edades-->
                                                                 
                        </div>  
                        
                        <div class="col-md-6">
                            <!-- Asistencia por lineas-->
                            <div class="box box-danger">
                                <div class="box-header">
                                    <h3 class="box-title"><span class="badge bg-red">  <i class="fa fa-bar-chart-o fa-3x"></i> </span> Graficación por lineas</h3>

                                    <div class="pull-right box-tools">
                                        <button class="btn btn-info btn-sm " data-toggle="tooltip" title="" data-original-title="Esta grafica muestra la asistencia total distribuidas por las lineas que existen en la iglesia."><i class="fa fa-info"></i></button>
                                        <button class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button> 
                                    </div>

                                </div>
                                <div class="box-body chart-responsive">
                                    <div class="chart" id="sales-chart-lineas" style="height: 300px; position: relative;"></div>

                                    <table class="table table-condensedres table-hover" cellspacing="0" width="100%">
                                        
                                        <tbody>
                                            <thead>
                                                <tr>
                                                    <th>COLOR</th>
                                                    <th>LINEA</th> 
                                                    <th># DE ASISTENTES</th>                                                      
                                                </tr>
                                            </thead>  
                                                   
                                            <tr>
                                                
                                                <td>
                                                    <span class="badge bg-blue" >Color</span>
                                                </td>
                                                <td>
                                                     M01                           
                                                </td>
                                                <td>
                                                    50
                                                </td>
                                            </tr>

                                            <tr>
                                                
                                                <td>
                                                    <span class="badge bg-red" >Color</span>
                                                </td>
                                                <td>
                                                     M02                           
                                                </td>
                                                <td>
                                                    150
                                                </td>
                                            </tr>
                                            <tr>
                                                
                                                <td>
                                                    
                                                </td>
                                                <td>
                                                    M03
                                                                                        
                                                </td>
                                                <td>
                                                    200                                
                                                </td>
                                            </tr>
                                            <tr>
                                                
                                                <td>
                                                    
                                                </td>
                                                <td>
                                                    M04                              
                                                </td>
                                                <td>
                                                    150                               
                                                </td>
                                            </tr>
                                            <tr>
                                                
                                                <td>
                                                    
                                                </td>
                                                <td>
                                                    M05                             
                                                </td>
                                                <td>
                                                    60                                
                                                </td>
                                            </tr>
                                            <tr>
                                                
                                                <td>
                                                    
                                                </td>
                                                <td>
                                                    M06
                                                                                        
                                                </td>
                                                <td>
                                                    40                                
                                                </td>
                                            </tr>
                                            <tr>
                                                
                                                <td>
                                                    
                                                </td>
                                                <td>
                                                    M07 
                                                                                        
                                                </td>
                                                <td>
                                                    280                                 
                                                </td>
                                            </tr>
                                            <tr>
                                                
                                                <td>
                                                    
                                                </td>
                                                <td>
                                                    M08                            
                                                </td>
                                                <td>
                                                    70                                
                                                </td>
                                            </tr>
                                        </tbody>
                                        
                                    </table>    
                                </div><!-- /.box-body -->
                            </div>
                            <!-- /Asistencia por lineas-->


                              <!-- Asistencia por sexo-->
                            <div class="box box-danger">
                                <div class="box-header">
                                    <h3 class="box-title"><span class="badge bg-red">  <i class="fa fa-bar-chart-o fa-3x"></i> </span> Graficación por sexo</h3>
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-info btn-sm " data-toggle="tooltip" title="" data-original-title="Esta grafica muestra como esta distribuidos la cantidad total asistente por sexo."><i class="fa fa-info"></i></button> 
                                        <button class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>                                       
                                    </div>
                                </div>
                                <div class="box-body chart-responsive">
                                    <div class="chart" id="sales-chart-sexo" style="height: 300px; position: relative;"></div>

                                    <table class="table table-condensedres table-hover" cellspacing="0" width="100%">
                                        
                                        <tbody>
                                            <thead>
                                                <tr>
                                                    <th>SEXO</th> 
                                                    <th># DE ASISTENTES</th>                                                      
                                                </tr>
                                            </thead>  
                                                   
                                            <tr>
                                               
                                                <td>
                                                    Masculino
                        
                                                                                        
                                                </td>
                                                <td>
                                                    440
                                                </td>
                                                
                                                
                                            </tr>
                                            <tr>
                                                
                                                <td>
                                                    Femenino  
                                                                                        
                                                </td>
                                                <td>
                                                    560                                
                                                </td>
                                            </tr>
                                                                                      
                                        </tbody>
                                        
                                    </table>    
                                </div><!-- /.box-body -->
                            </div>
                            <!-- /Asistencia por sexo-->
                           
                        </div>
                       
                       
                   </div>  
                    <!-- /row --> 
                   
              </section>
              <!-- contenido principal -->
            </aside>  



           
      
        @include('includes.scripts')

        <!-- Morris.js charts -->
        <script src="/js/raphael-min.js"></script>
        <script src="/js/plugins/morris/morris.min.js" type="text/javascript"></script>

        <!-- InputMask -->
        <script src="/js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="/js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="/js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>

        <!-- date-range-picker -->
        <script src="/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>

        <!-- date-range-picker -->
        <script src="/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        
        <!-- bootstra datepicker-->
        <script src="/js/bootstrap-datepicker.js"></script>
        <script src="/js/locales/bootstrap-datepicker.es.js"></script>
        
        <!-- page script -->
        <script type="text/javascript">
        var mesesC = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre", "Diciembre");
        var meses = new Array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov", "Dic");
            $(document).ready(function() {

                $('#bn-generar-estadisticas').click (function () {
                    $.ajax({url:"ajax-estadisticas",cache:false, type:"POST", data: {fecha:"08/10/2014"}, success:function(resp)
                      {
                        tbody=resp;
                        
                        // ESTADISTICA Crecimiento año actual
                        var line = new Morris.Line({
                            element: 'graf-crecimiento-año',
                            resize: true,
                            data: [
                                {y: '2013-07-01', x: 280}
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
                              if(fecha.getMonth()=='12')
                              mes=mesesC[0];
                              return mes+"<br><span class='text-blue'>Nº Asistentes: "+row.x+"</span>";
                            },
                            xLabelFormat: function (x) { return meses[x.getMonth()]; }
                        });
                        
                      }
                    });

                });

                //Fecha con rango 
                $('#rango-estadisticas').daterangepicker(
                    {
                            format: 'DD/MM/YYYY', 
                            ranges: {
                                
                                'Mes actual': [moment().startOf('month'), moment()],
                                'Mes actual y 2 meses atras': [moment().subtract('month', 2).startOf('month'),  moment()],
                                'Mes actual y 5 meses atras': [moment().subtract('month', 5).startOf('month'),  moment()],
                                'Año actual': [moment().startOf('year'),  moment()],
                                'Año anterior': [moment().subtract('year', 1).startOf('year'),  moment().subtract('year', 1).endOf('year')]

                            },
                            startDate: moment().subtract('days', 29),
                            endDate: moment(),

                    },
                   function(start, end) {
                         $('#rango-estadisticas span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                    }

                );

            
                //Date range picker$
                $('#seleccionaFecha').datepicker({
                    language: 'es'
                });
                // ESTADISTICA Crecimiento año actual
                var line = new Morris.Line({
                    element: 'graf-crecimiento-año',
                    resize: true,
                    data: [
                        {y: '2013-07-01', x: {{ Asistente::where('fecha_ingreso', '<', '2013-08-01')->count() }} },
                        {y: '2013-08-01', x: {{ Asistente::where('fecha_ingreso', '<', '2013-09-01')->count() }} },
                        {y: '2013-09-01', x: {{ Asistente::where('fecha_ingreso', '<', '2013-10-01')->count() }} },
                        {y: '2013-10-01', x: {{ Asistente::where('fecha_ingreso', '<', '2013-11-01')->count() }} },
                        {y: '2013-11-01', x: {{ Asistente::where('fecha_ingreso', '<', '2013-12-01')->count() }} },
                        {y: '2013-12-01', x: {{ Asistente::where('fecha_ingreso', '<', '2014-01-01')->count() }} },
                        {y: '2014-01-01', x: {{ Asistente::where('fecha_ingreso', '<', '2014-02-01')->count() }} },
                        {y: '2014-02-01', x: {{ Asistente::where('fecha_ingreso', '<', '2014-03-01')->count() }} },
                        {y: '2014-03-01', x: {{ Asistente::where('fecha_ingreso', '<', '2014-04-01')->count() }} },
                        {y: '2014-04-01', x: {{ Asistente::where('fecha_ingreso', '<', '2014-05-01')->count() }} },
                        {y: '2014-05-01', x: {{ Asistente::where('fecha_ingreso', '<', '2014-06-01')->count() }} },
                        {y: '2014-06-01', x: {{ Asistente::where('fecha_ingreso', '<', '2014-07-01')->count() }} },
                        
                        
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
                      if(fecha.getMonth()=='12')
                      mes=mesesC[0];
                      return mes+"<br><span class='text-blue'>Nº Asistentes: "+row.x+"</span>";
                    },
                    xLabelFormat: function (x) { return meses[x.getMonth()]; }
                });
                               
                //ESTADISTICAS POR LINEAS
                var donut = new Morris.Donut({
                    element: 'sales-chart-lineas',
                    resize: true,
                    colors: ["#3c8dbc", "#f56954", "#00a65a","#3c8923", "#f56321", "#00a600"],
                    data: [
                        {label: "M01", value: 50},
                        {label: "M02", value: 150},
                        {label: "M03", value: 200},
                        {label: "M04", value: 150},
                        {label: "M05", value: 60},
                        {label: "M06", value: 40},
                        {label: "M07", value: 280},
                        {label: "M08", value: 70}
                    ],
                    hideHover: 'auto'
                });

                //ESTADISTICA POR ETAPAS
                var donut = new Morris.Donut({
                    element: 'sales-chart-etapas',
                    resize: true,
                    colors: ["#3c8923", "#f56321", "#00a600"],
                    data: [
                        {label: "Niños", value: 40},
                        {label: "Jovenes", value: 200},
                        {label: "Adultos", value: 300},
                        
                    ],
                    hideHover: 'auto'
                });

                //ESTADISTICAS POR CLASIFICACION
                var donutn = new Morris.Donut({
                    element: 'sales-chart-clasificacion',
                    resize: true,
                    colors: ["#3c8dbc", "#f56954", "#00a65a","#3c8923", "#f56321", "#00a600"],
                    data: [
                        {label: "Nuevos", value: 50},
                        {label: "Ovejas", value: 300},
                        {label: "Miembros", value: 550},
                        {label: "Lideres", value: 80},
                        {label: "Pastores", value: 10}
                    ],
                    hideHover: 'auto'
                });


                //ESTADISTICAS POR SEXO
                var donutn = new Morris.Donut({
                    element: 'sales-chart-sexo',
                    resize: true,
                    colors: ["#3c8dbc", "#f7819f"],
                    data: [
                        {label: "Masculino", value: 440},
                        {label: "Femenino", value: 560}
                    ],
                    hideHover: 'auto'
                });
           
        });

       </script>

    </body>
</html>

@endif