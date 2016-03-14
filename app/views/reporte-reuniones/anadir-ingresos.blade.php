@if(Auth::check())
@include('includes.lenguaje')
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Redil | Actualizar Reporte</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
         @include('includes.styles')
        <link href="/css/ionicons.min.css" rel="stylesheet" type="text/css" />
         <!-- DATA TABLES -->
        <link href="/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="/css/datepicker.css" rel="stylesheet" type="text/css" />
        <link href="/css/datepicker3.css" rel="stylesheet" type="text/css" />
         <!-- DATA TABLES -->
        <link href="/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap time Picker -->
        <link href="/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <!-- header logo: style can be found in header.less -->
        <!-- Header Navbar: style can be found in header.less -->
             @include('includes.header')

        <div id ="contenedor" name="contenedor" class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">               
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    @include('includes.menu')
                </section>
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- contendio cabezote -->
              <section class="content-header">
                <div class="box-header">
                  <h3 class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-padding content-header barra-titulo">
                      <span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">ACTUALIZAR REPORTE DE REUNIÓN </span>
                      <small class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">Aqui se podrán actualizar los reportes de reuniones.</small>
                  </h3>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-padding pull-right box-tools">
                      <ul class="pull-right nav nav-pills">
                        <li role="presentation"><a href="/reporte-reuniones/actualizar/{{ $reporte->id }}"><small class="badge">1</small> Información Principal</a></li>
                        <li role="presentation"><a href="/reporte-reuniones/anadir-asistentes/{{ $reporte->id }}"><small class="badge">2</small> Añadir Asistentes</a></li>
                        <li role="presentation" class="active"><a href="/reporte-reuniones/anadir-ingresos/{{ $reporte->id }}"><small class="badge">3</small> Añadir Ingresos</a></li>
                      </ul>
                  </div>
                    
                    
                </div>
              </section>
              <!-- /contendio cabezote --> 
                 

             <!-- contenido principal -->
              <section class="content">
                <!-- -aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa /row de contenido de asistentes-->  

                <div id="contenido-ingresos" name="contenido-ingresos" class="panel col-lg-12 col-sm-12 col-xsm-12 col-xs-12">

                    <div class="row">                                   
                     
                      <!-- div de busqueda-->

                          <div class="col-md-7 col-lg-7 col-sm-7  col-xs-12" >
                            <br>
                            <div class="form-group pull-center" style="text-align:center" >
                              <h1> 
                                  <span class="badge bg-blue">  
                                  <i class="fa fa-money fa-4x"></i>
                                  </span>
                              </h1>
                              <br>
                              <h4 >Buscar asistentes para asignarles ingresos financieros</h4>

                            </div>
                            <!-- asistente --> 
                            <div class="nav navbar-nav">
                              <li class="dropdown lista-busqueda">
                                <div class="input-group "  >
                                  <input type="text" id="busqueda_asistente" class="form-control buscar" autocomplete="off" placeholder="Buscar predicador por código, nombre o cédula..." />
                                  <span class="input-group-btn">
                                      <button type='button' class="btn btn-flat" style="border-color:#CCC;background:#fff" ><i class="fa fa-search" style="color:#00545E" ></i></button>
                                  </span>
                                </div> 

                                <ul id="panel-ppl-asistentes" class="panel-busqueda-moviles dropdown-menu " style="overflow: auto; width: 100%; max-height: 685px; position: relative; display:block;z-index:200">
                                  <li>
                                      <!-- inner menu: contains the actual data -->
                                    <ul class="menu" id="panel-asistentes" style="overflow-y: hidden;">
                                      
                                    </ul>
                                  </li>
                                </ul>

                              </li>
                            </div>    
                            <!-- /asistente -->     

                          </div>
                    <!-- /busqueda de asistentes -->   


                          <div class="col-md-5 col-lg-5 col-sm-5 col-xs-12">
                            <br>
                            <div class="col-lg-5  col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2 small-box bg-green abrir-modal-o-s" style="color:white;cursor:pointer;" >
                              <div class="inner">
                                  <h3>
                                      <sub id="etiqueta_o_s" style="font-size: 16px;">Total: ${{$total_ofrendas_sueltas}}.</sub>
                                  </h3>
                                      
                              </div>
                              <div class="icon">
                                  <i class="fa fa-money"></i>
                              </div>
                              <div class="small-box-footer">
                                  <h4>
                                 Ingresar Ofrenda Suelta
                                  </h4>
                              </div>
                            </div>

                            <div class="col-lg-12 col-sm-12 col-xs-12 col-sm-12 no-padding box box-success">
                              <div class="panel-heading">
                                  <h3 class="box-title"> <span class="badge bg-green">  <i class="fa fa-money fa-2x"></i> </span> Resumen Financiero</h3>
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
                                              <h4><label id="total_diezmos" data-total="{{$total_diezmos}}" class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="">$</label> <label id="diezmos"> {{$total_diezmos}} </label> </h4> 
                                          </td>
                                          <td>                                    
                                          </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          <h4> Ofrendas </h4>
                                        </td>
                                        <td>
                                            <h4><label id="total_ofrendas" data-total="{{$total_ofrendas}}" class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="">$</label> <label id="ofrendas"> {{$total_ofrendas}} </label> </h4> 
                                        </td>   
                                        <td>                                  
                                        </td>
                                      </tr>
                                        <tr>
                                          <td>
                                            <h4> Pactos </h4>
                                          </td>
                                          <td>
                                            <h4><label id="total_pactos" data-total="{{$total_pactos}}" class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="">$</label> <label id="pactos"> {{$total_pactos}} </label> </h4> 
                                          </td>
                                           <td>                                  
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>
                                            <h4> Primicias </h4>
                                          </td>
                                          <td>
                                            <h4><label id="total_primicias" data-total="{{$total_primicias}}" class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="">$</label> <label id="primicias"> {{$total_primicias}} </label> </h4> 
                                          </td>
                                          <td>                                   
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>
                                            <h4> Pro-templo </h4>
                                          </td>
                                          <td>
                                            <h4><label id="total_protemplo" data-total="{{$total_protemplo}}" class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="">$</label> <label id="protemplo"> {{$total_protemplo}} </label> </h4> 
                                          </td> 
                                          <td>   
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>
                                            <h4> Siembra </h4>
                                          </td>
                                          <td>
                                            <h4><label id="total_siembras" data-total="{{$total_siembras}}" class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="">$</label> <label id="siembras"> {{$total_siembras}} </label> </h4> 
                                          </td>
                                          <td>
                                          </td>
                                        </tr>

                                        <tr>
                                          <td>
                                            <h4> Otro </h4>
                                          </td>
                                          <td>
                                            <h4><label id="total_otros" data-total="{{$total_otros}}" class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="">$</label> <label id="otros"> {{$total_otros}} </label> </h4> 
                                          </td>
                                          <td>                                   
                                          </td>
                                        </tr>
                                        
                                        <tr>
                                          <td>
                                            <h4> Ofrendas sueltas </h4>
                                          </td>
                                          <td>
                                              <h4><label id="total_ofrendas_sueltas" data-total="{{$total_ofrendas_sueltas}}" class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="">$</label> <label id="sueltas"> {{$total_ofrendas_sueltas}} </label> </h4> 
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
                                              <h4><label id="total_ingresos" data-total="{{$total_ingresos}}" class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="">$</label> <label id="total"> {{$total_ingresos}} </label> </h4> 
                                          </td>
                                          <td>
                                          </td>
                                        </tr>
                                      </tbody>
                                        
                                    </table>
                                  </div> <!-- /box-body -->
                                </div>        
                            </div>



                    </div>
                </div>
                                        <!-- /cierra row  --> 


              <!-- modal informacion financiera de los integrantes -->
              <div class="modal fade modal-financiero" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                      <h4 id="titulo-informacion-financiera" class="modal-title" id="myModalLabel">INFORMACIÓN FINANCIERA </h4>
                                  </div>
                              <div class="modal-body">

                                  <div class="box box-filtro " >
                                    
                                    <div class="box-body">
                                      <!-- Valor -->
                                        <div class="form-group col-lg-6">
                                           <label>Valor</label>
                                           <input id="valor" type="text" class="number form-control" placeholder=""/>
                                        </div>
                                        <!-- /valor -->
                                        <!-- Tipo de id -->
                                             <div class="form-group col-lg-6">
                                                      <label>Tipo</label>
                                                      <select id="tipo-ofrenda" class="form-control">
                                                          <option value=""></option>
                                                          <option value="0">Diezmo</option>
                                                          <option value="1">Ofrenda</option>
                                                          <option value="2">Pacto</option>
                                                          <option value="3">Pro-templo</option>
                                                          <option value="4">Siembra</option>
                                                          <option value="5">Primicia</option>
                                                          <option value="6">Otro</option>
                                                      </select>
                                             </div>
                                             <!-- /tipo de id -->
                                        <!-- Observaciones -->
                                        <div class="form-group col-lg-12">
                                            <label>Observaciones</label>
                                            <textarea id="observacion" name="observacion" class="form-control" rows="2"  maxlength="500" placeholder="" value=""></textarea>
                                        </div>
                                        <!-- /Observaciones -->

                                         <!-- Boton añadir -->
                                         <div class="col-lg-12">
                                        <div id="error_add_ofrenda" class="alert alert-danger col-lg-8" style="display:none;" >
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                          Faltan campos por llenar                                      
                                        </div>
                                        <button class="col-lg-3 add-ofrenda btn btn-success btn-lg pull-right" ><i class="fa fa-plus"></i>  Añadir</button>
                                        </div>
                                    </div>
                                  </div> <br><br>
                                        <!-- /Boton añadir -->
                                      <table id="ofrendas-integrante" class="table table-striped display stripe" cellspacing="0" width="100%">
                                          <thead>
                                              <tr>
                                                  <th>VALOR</th>
                                                  <th>TIPO</th>
                                                  <th>OBSERVACIONES</th>
                                                  <th></th>
                                                  
                                                  
                                            </tr>
                                          </thead>
                                          <tbody>
                                                     
                                              
                                          </tbody>
                                          
                                      </table>
                                  </div>
                              </div>
                      </div>
              </div>





 <!-- modal informacion ofrenda suelta  -->
                      <div id="modal-o-s" name="modal-o-s" class="modal fade modal-ofrenda-suelta" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                      <h4 class="modal-title" id="myModalLabel"><i class="fa fa-money fa-1x"></i> OFRENDA SUELTA</h4>
                                  </div>
                              <div class="modal-body">
                                    
                                    <div class="box-body">
                                      <!-- Valor -->
                                        <div class="form-group">
                                           <label>Valor</label>
                                           <input id="valor_o_s" type="text" name="valor_o_s" class="number form-control" placeholder="" required/>
                                           
                                        </div>
                                        <!-- /valor -->
                                        <!-- Observaciones -->
                                        <div class="form-group">
                                            <label>Observaciones</label>
                                            <textarea id="observacion_o_s" class="form-control" rows="5"  maxlength="500" placeholder=""></textarea>
                                            
                                        </div>
                                        <!-- /Observaciones -->
                                        <div class="modal-footer">
                                          <!-- Boton añadir -->
                                          <button class="add-ofrenda-suelta btn btn-success btn-md" data-dismiss="modal" ><i class="fa fa-save"></i>  Guardar</button>  
                                          <button type="button" class="btn btn-danger btn-md" data-dismiss="modal"><i class="fa fa-times-cricle"></i>   Cancelar</button>
                                        </div>
                                    </div>
                                  </div> 
                              </div>
                          </div>
                      </div>



         @include('includes.scripts') 
        <!-- DATA TABES SCRIPT -->
        <script src="{{ Lang::get('general.url-datatables') }}" type="text/javascript"></script>
        <script src="/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

        <!-- busqueda tipo facebook -->
        <script src="/js/AdminLTE/busqueda-fc.js" type="text/javascript"></script>

        <!-- script para buscar los asistentes de un grupo -->
        <script type="text/javascript">

            ////la siguiente variable es pla que nos guardara el objeto de la busqueda tipo facebook
            var busqueda_asistente;

            var idreporte = "{{ $reporte->id }}";

            ///esta función nos permitira determinar que evento sucedera si se le da clic 
            //a un item de los resultados de la busqueda o a cualquier objeto denrto del item, como el boton cerrar
            function seleccionar_asistente(){
            }

            $(document).ready(function() {
              var sql_adicional="" //si no hay sql adicional dejar la variable vacia
              idreporte = "{{ $reporte->id }}";
              //se crea un objeto de la Clase BusquedaFB y se cargan los primeros registros
              
              busqueda_asistente = new BusquedaFB($("#busqueda_asistente"), $("#panel-ppl-asistentes"), "panel-asistentes","/reporte-reuniones/obtener-asistentes-ajax/"+idreporte+";0;0;0/otro", abrir_modal_ingresos, sql_adicional);
              //busqueda_asistente.inicializar();
              busqueda_asistente.cargarPrimerosRegistros();
              
            });
            
        </script> 
        <!-- fin script busqueda de asistentes -->

            <!-- Script para la manipulación de los modales -->
            <script type="text/javascript">


                var id_integrante=0;
                var valor=0;
                var count=0;
                var tabla_ofrendas= "";

                var diezmos="";
                var ofrendas="";
                var pactos="";
                var primicias="";
                var protemplo="";
                var siembras="";
                var otros="";
                var ofrendas_sueltas="";
                var total="";


                var cant_ofrendas=0;
                var valor_anterior=0;
                var valor_actual=0;
                var id_ofrenda_suelta=0;


                $(document).ready(function() {
                                    
                          tabla_ofrendas= $('#ofrendas-integrante').dataTable( {
                              "bPaginate": false,
                              "bLengthChange": false,
                              "bFilter": false,
                              "bSort": true,
                              "bInfo": false,
                              "bAutoWidth": false
                               
                          });

                          diezmos=$("#total_diezmos").attr("data-total")+"";
                          ofrendas=$("#total_ofrendas").attr("data-total")+"";
                          pactos=$("#total_pactos").attr("data-total")+"";
                          primicias=$("#total_primicias").attr("data-total")+"";
                          protemplo=$("#total_protemplo").attr("data-total")+"";
                          siembras=$("#total_siembras").attr("data-total")+"";
                          otros=$("#total_otros").attr("data-total")+"";
                          ofrendas_sueltas=$("#total_ofrendas_sueltas").attr("data-total")+"";
                          total=$("#total_ingresos").attr("data-total")+"";


                          $("#diezmos").html(Moneda(diezmos+""));
                          $("#ofrendas").html(Moneda(ofrendas+""));
                          $("#pactos").html(Moneda(pactos+""));
                          $("#primicias").html(Moneda(primicias+""));
                          $("#protemplo").html(Moneda(protemplo+""));
                          $("#siembras").html(Moneda(siembras+""));
                          $("#otros").html(Moneda(otros+""));
                          $("#sueltas").html(Moneda(ofrendas_sueltas+""));
                          $("#total").html(Moneda(total+""));


                          $('.add-ofrenda').click (function () {

                              if($("#valor").val()!="" && $("#tipo-ofrenda").val()!="")
                              {
                                  var observacion="";
                                  var tipo_ofrenda=$("#tipo-ofrenda").val();
                                  observacion=$("#observacion").val();
                                  var valor_ingresado=$("#valor").val();
                                  valor_ingresado=parseInt(valor_ingresado);

                                  valor_anterior=$("#ofrenda_"+id_integrante).attr('data-total-asistente'); // valor anterior del asistente
                                  valor_actual=parseInt(valor_anterior)+valor_ingresado;
                                  $("#ofrenda_"+id_integrante).attr('data-total-asistente',valor_actual);
                                  $("#ofrenda_"+id_integrante).html("$"+valor_actual);
                                  var url="/reporte-reuniones/anade-ingresos-ajax/"+idreporte+"/"+id_integrante+"/"+valor_ingresado+"/"+tipo_ofrenda;
                                    if(observacion!="")
                                      url=url+"/"+observacion;
                                      $.ajax({url:url,cache:false, type:"POST",success:function(resp)
                                      {
                                        var id_ofrenda=resp; //recibe id de la ofrenda recien creada

                                          if(tipo_ofrenda==0){
                                              tipo_ofrenda="Diezmo";
                                              //diezmos=diezmos.replace(".", "");
                                              diezmos=replaceAll(diezmos, ".", "" );
                                              diezmos=parseInt(diezmos)+valor_ingresado;
                                              $("#diezmos").html(Moneda(diezmos+""));
                                              diezmos=diezmos+"";
                                          }
                                          else if(tipo_ofrenda==1)
                                          {
                                              tipo_ofrenda="Ofrenda";
                                              ofrendas=replaceAll(ofrendas, ".", "" );
                                              ofrendas=parseInt(ofrendas);
                                              ofrendas=ofrendas+valor_ingresado;
                                              $("#ofrendas").html(Moneda(ofrendas+""));
                                              ofrendas=ofrendas+"";
                                          } 
                                          else if(tipo_ofrenda==2)
                                          {
                                              tipo_ofrenda="Pacto";
                                              pactos=replaceAll(pactos, ".", "" );
                                              pactos=parseInt(pactos);
                                              pactos=pactos+valor_ingresado;
                                              $("#pactos").html(Moneda(pactos+""));
                                              pactos=pactos+"";
                                          }
                                          else if(tipo_ofrenda==3)
                                          {
                                              tipo_ofrenda="Pro-templo";
                                              protemplo=replaceAll(protemplo, ".", "" );
                                              protemplo=parseInt(protemplo);
                                              protemplo=protemplo+valor_ingresado;
                                              $("#protemplo").html(Moneda(protemplo+""));
                                              protemplo=protemplo+"";
                                          }
                                          else if(tipo_ofrenda==4)
                                          {
                                              tipo_ofrenda="Siembra";
                                              siembras=replaceAll(siembras, ".", "" );
                                              siembras=parseInt(siembras);
                                              siembras=siembras+valor_ingresado;
                                              $("#siembras").html(Moneda(siembras+""));
                                              siembras=siembras+"";
                                          } 
                                          else if(tipo_ofrenda==5){
                                              tipo_ofrenda="Primicia";
                                              primicias=replaceAll(primicias, ".", "" );
                                              primicias=parseInt(primicias);
                                              primicias=primicias+valor_ingresado;
                                              $("#primicias").html(Moneda(primicias+""));
                                              primicias=primicias+"";
                                          } 
                                          else if(tipo_ofrenda==6)
                                          {
                                              tipo_ofrenda="Otro";
                                              otros=replaceAll(otros, ".", "" );
                                              otros=parseInt(otros);
                                              otros=otros+valor_ingresado;
                                              $("#otros").html(Moneda(otros+""));
                                              otros=otros+"";
                                          } 
                                          
                                          valor+=valor_ingresado;
                                          total=replaceAll(total, ".", "" );
                                          total=parseInt(total)+valor_ingresado;
                                          total=total+"";
                                          $("#total").html(Moneda(total));
                                          id_ofrenda=parseInt(id_ofrenda);
                                          tabla_ofrendas.fnAddData( [
                                              Moneda(valor_ingresado+""),
                                              tipo_ofrenda,
                                              $("#observacion").val(),
                                          '<a class="borrar-ofrenda'+id_ofrenda+' btn btn-danger btn-sm" data-id-ofrenda="'+id_ofrenda+'" > <b>X</b> </a>'
                                          ]);
                                                $('.borrar-ofrenda'+id_ofrenda).click (function () {

                                                    var target_row = $(this).parent().parent().get(0); // this line did the trick
                                                    var posfila = tabla_ofrendas.fnGetPosition(target_row); 
                                                    var fila_eliminada=tabla_ofrendas.fnGetData( posfila );
                                                  
                                                    valor_eliminado=fila_eliminada[0];
                                                    tipo_eliminado=fila_eliminada[1];
                                                    tabla_ofrendas.fnDeleteRow(posfila);
                                                    //valor_eliminado=valor_eliminado.replace(/./gi, "");
                                                    valor_eliminado=replaceAll(valor_eliminado, ".", "" );
                                                    valor_eliminado=parseInt(valor_eliminado);
                                                    valor-=valor_eliminado;
                                                    valor_anterior=$("#ofrenda_"+id_integrante).attr('data-total-asistente'); // valor anterior del asistente
                                                      valor_actual=parseInt(valor_anterior)-valor_eliminado;
                                                      $("#ofrenda_"+id_integrante).attr('data-total-asistente',valor_actual);
                                                      $("#ofrenda_"+id_integrante).html("$"+valor_actual);
               
                                                total-=valor_eliminado;
                                                total=total+"";
                                                $("#total").html(Moneda(total));

                                                if(tipo_eliminado=="Diezmo")
                                                      {
                                                          diezmos-=valor_eliminado;
                                                          diezmos=diezmos+"";
                                                          $("#diezmos").html(Moneda(diezmos));

                                                      }
                                                      else if(tipo_eliminado=="Ofrenda")
                                                      {
                                                          ofrendas-=valor_eliminado;
                                                          ofrendas=ofrendas+"";
                                                          $("#ofrendas").html(Moneda(ofrendas));
                                                      }
                                                      else if(tipo_eliminado=="Pacto")
                                                      {
                                                          pactos-=valor_eliminado;
                                                          pactos=pactos+"";
                                                          $("#pactos").html(Moneda(pactos));
                                                      }
                                                      else if(tipo_eliminado=="Pro-Templo")
                                                      {
                                                          protemplo-=valor_eliminado;
                                                          protemplo=protemplo+"";
                                                          $("#protemplo").html(Moneda(protemplo));
                                                      }
                                                      else if(tipo_eliminado=="Siembra")
                                                      {
                                                          siembras-=valor_eliminado;
                                                          siembras=siembras+"";
                                                          $("#siembras").html(Moneda(siembras));
                                                      }
                                                      else if(tipo_eliminado=="Primicia")
                                                      {
                                                          primicias-=valor_eliminado;
                                                          primicias=primicias+"";
                                                          $("#primicias").html(Moneda(primicias));
                                                      }
                                                      else if(tipo_eliminado=="Otro")
                                                      {
                                                          otros-=valor_eliminado;
                                                          otros=otros+"";
                                                          $("#otros").html(Moneda(otros));
                                                      }

                                                    cant_ofrendas--;
                                                   // $("#finanzas").val(JSON.stringify(finanzas));
                                                    $("#valor").focus();
                                                    $.ajax({url:"/reporte-reuniones/elimina-ingresos-ajax/"+id_ofrenda,cache:false, type:"POST",success:function(resp)
                                                      {
                                                      }
                                                      });

                                                }); //Termina el ajax de borrar ingreso

                                          cant_ofrendas++;
                                          $("#valor").val("");
                                          $("#tipo-ofrenda").val("");
                                          $("#observacion").val("");
                                          //$("#finanzas").val(JSON.stringify(finanzas));
                                          $("#tipo-ofrenda").css("background-color", "#fff");
                                          $("#valor").css("background-color", "#fff");

                                        }//cierra el contenido del ajax de añadir ingreso
                                      }); //termina la funcion ajax de añadir ingreso
                                  
                              }// termina el if que indica si los campos no estan vacios
                              else
                              {
                                  if($("#valor").val()=="")
                                  {
                                      $("#error_add_ofrenda").html("El campo Valor no puede estar vacio, verifique e intente nuevamente");
                                      $("#valor").css("background-color", "#f2dede");
                                      
                                  }
                                  else if($("#tipo-ofrenda").val()=="")
                                  {
                                      $("#error_add_ofrenda").html("Debe seleccionar un Tipo de Ofrenda, verifique e intente nuevamente");
                                      $("#tipo-ofrenda").css("background-color", "#f2dede");
                                      $("#valor").css("background-color", "#fff");
                                  }
                                  
                                  $("#error_add_ofrenda").show(300);
                                  setTimeout(function() {
                                      $("#error_add_ofrenda").hide(300)
                                  }, 6000);
                                  $("#error_add_ofrenda").attr("alert alert-danger col-lg-12 desvanecer")
                              }//Fin de else
                              $("#valor").focus();

                          });//Fin de la clase añadir ingreso




                          $(".abrir-modal-o-s").on('click', function(){
                          $("#modal-o-s").modal({show: 'true'});
                          });

                          $('.add-ofrenda-suelta').click (function () {

                            var valor_ofrenda_suelta=$("#valor_o_s").val();
                            var observacion_ofrenda_suelta=$("#observacion_o_s").val();

                              if(valor_ofrenda_suelta!="")
                              {
                                  valor_ofrenda_suelta=parseInt(valor_ofrenda_suelta);
                                  total=parseInt(diezmos)+parseInt(ofrendas)+parseInt(pactos)+parseInt(primicias)+parseInt(protemplo)+parseInt(otros)+parseInt(siembras)+valor_ofrenda_suelta;
                                  $("#sueltas").html(Moneda(valor_ofrenda_suelta+""));
                                  $("#etiqueta_o_s").html("Total: $"+Moneda(valor_ofrenda_suelta+""));
                                  total=total+"";
                                  $("#total").html(Moneda(total));
                              }
                              else
                              {   
                                  valor_ofrenda_suelta=0;
                                  total=parseInt(diezmos)+parseInt(ofrendas)+parseInt(pactos)+parseInt(primicias)+parseInt(protemplo)+parseInt(otros)+parseInt(siembras);
                                  $("#sueltas").html("0");
                                  $("#etiqueta_o_s").html("Total: $0.");
                                  total=total+"";
                                  $("#total").html(Moneda(total));
                              }
                              var url="/reporte-reuniones/anade-ingresos-ajax/"+idreporte+"/sin asistente/"+valor_ofrenda_suelta+"/7";
                              if(observacion!="")
                                url=url+"/"+observacion_ofrenda_suelta;

                              $.ajax({url:url,cache:false, type:"POST",success:function(resp)
                              {
                                id_ofrenda_suelta=resp;
                              }
                              });

                          });
          

          }); //Cierre de la función document.ready

                      function abrir_modal_ingresos(){


                         $('.abrir-panel-ofrendas').unbind('click'); 

                         $('.abrir-panel-ofrendas').click (function () {

                          tabla_ofrendas.fnClearTable();
                          var nombre_integrante=$(this).attr('data-nombre');
                          id_integrante=$(this).attr('data-id');
                          $("#titulo-informacion-financiera").html("INFORMACIÓN FINANCIERA - <b class='text-uppercase'>"+nombre_integrante+"</b>");
                           
                                $.ajax({url:"/reporte-reuniones/carga-ingresos-ajax/"+idreporte+"/"+id_integrante,cache:false, type:"POST",success:function(resp)
                                {
                                var JSONObject = JSON.parse(resp);
                                var tipo_ofrenda="";

                                          $.each(JSONObject, function(i,item){
                                               
                                                  if(JSONObject[i]["tipo_ofrenda"]==0)
                                                  {
                                                     tipo_ofrenda="Diezmo";
                                                  }
                                                  else if(JSONObject[i]["tipo_ofrenda"]==1)
                                                  {
                                                      tipo_ofrenda="Ofrenda";
                                                  }
                                                  else if(JSONObject[i]["tipo_ofrenda"]==2)
                                                  {
                                                      tipo_ofrenda="Pacto";
                                                  }
                                                  else if(JSONObject[i]["tipo_ofrenda"]==3)
                                                  {
                                                      tipo_ofrenda="Pro-Templo";
                                                  }
                                                  else if(JSONObject[i]["tipo_ofrenda"]==4)
                                                  {
                                                      tipo_ofrenda="Siembra";
                                                  }
                                                  else if(JSONObject[i]["tipo_ofrenda"]==5)
                                                  {
                                                      tipo_ofrenda="Primicia";
                                                  }
                                                  else if(JSONObject[i]["tipo_ofrenda"]==6)
                                                  {
                                                      tipo_ofrenda="Otro";
                                                  }

                                                var id_ofrenda=JSONObject[i]["id"];
                                                tabla_ofrendas.fnAddData( [
                                                    Moneda(JSONObject[i]["valor"]+""),
                                                    tipo_ofrenda,
                                                    JSONObject[i]["observacion"],
                                                '<a class="borrar-ofrenda'+id_ofrenda+' btn btn-danger btn-sm" data-id-ofrenda="'+id_ofrenda+'"> <b>X</b> </a>'
                                                ]);

                                                $('.borrar-ofrenda'+id_ofrenda).click (function () {
                                                      
                                                      var target_row = $(this).parent().parent().get(0); // this line did the trick
                                                      var posfila = tabla_ofrendas.fnGetPosition(target_row);
                                                      var fila_eliminada=tabla_ofrendas.fnGetData( posfila );
                                                    
                                                      valor_eliminado=fila_eliminada[0];
                                                      tipo_eliminado=fila_eliminada[1];
                                                      tabla_ofrendas.fnDeleteRow(posfila);

                                                      valor_eliminado=replaceAll(valor_eliminado, ".", "" );
                                                      valor_eliminado=parseInt(valor_eliminado);
                                                      valor-=valor_eliminado;
                                                      valor_anterior=$("#ofrenda_"+id_integrante).attr('data-total-asistente'); // valor anterior del asistente
                                                      valor_actual=parseInt(valor_anterior)-valor_eliminado;
                                                      $("#ofrenda_"+id_integrante).attr('data-total-asistente',valor_actual);
                                                      $("#ofrenda_"+id_integrante).html("$"+valor_actual);

                                                      total-=valor_eliminado;
                                                      total=total+"";
                                                      $("#total").html(Moneda(total));

                                                      if(tipo_eliminado=="Diezmo")
                                                      {
                                                          diezmos-=valor_eliminado;
                                                          diezmos=diezmos+"";
                                                          $("#diezmos").html(Moneda(diezmos));

                                                      }
                                                      else if(tipo_eliminado=="Ofrenda")
                                                      {
                                                          ofrendas-=valor_eliminado;
                                                          ofrendas=ofrendas+"";
                                                          $("#ofrendas").html(Moneda(ofrendas));
                                                      }
                                                      else if(tipo_eliminado=="Pacto")
                                                      {
                                                          pactos-=valor_eliminado;
                                                          pactos=pactos+"";
                                                          $("#pactos").html(Moneda(pactos));
                                                      }
                                                      else if(tipo_eliminado=="Pro-Templo")
                                                      {
                                                          protemplo-=valor_eliminado;
                                                          protemplo=protemplo+"";
                                                          $("#protemplo").html(Moneda(protemplo));
                                                      }
                                                      else if(tipo_eliminado=="Siembra")
                                                      {
                                                          siembras-=valor_eliminado;
                                                          siembras=siembras+"";
                                                          $("#siembras").html(Moneda(siembras));
                                                      }
                                                      else if(tipo_eliminado=="Primicia")
                                                      {
                                                          primicias-=valor_eliminado;
                                                          primicias=primicias+"";
                                                          $("#primicias").html(Moneda(primicias));
                                                      }
                                                      else if(tipo_eliminado=="Otro")
                                                      {
                                                          otros-=valor_eliminado;
                                                          otros=otros+"";
                                                          $("#otros").html(Moneda(otros));
                                                      }

                                                      cant_ofrendas--;
                                                      //$("#finanzas").val(JSON.stringify(finanzas));
                                                      $("#valor").focus();
                                                      $.ajax({url:"/reporte-reuniones/elimina-ingresos-ajax/"+id_ofrenda,cache:false, type:"POST",success:function(resp)
                                                      {
                                                      }
                                                      });

                                                });//Cierra clase borrar ofrenda

                                          })//Cierra el each para recorrer el JSON

                                ///al abrir el panel se perdia el foco asi que se hace el focus unas milesimas despues de que abre el panel
                                setTimeout(function() {
                                    $("#valor").focus();
                                }, 500);

                                } // Termina el ajax de cargar ingresos
                                }); //Cierra el ajax de cargar ingresos

                          }); //Aquí termina el abrir modal para agregar ingresos






                      }//Termina la función para abrir el modal

                      function replaceAll(text, search, newstring ){
                          while (text.toString().indexOf(search) != -1)
                              text = text.toString().replace(search,newstring);
                          return text;
                      } 

                      $(document).ready(function() {
                        $("#menu_reuniones").children("a").first().trigger('click');
                      });

        </script>

    </body>
</html>
@endif