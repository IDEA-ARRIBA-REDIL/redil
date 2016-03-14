@if(Auth::check())
@include('includes.lenguaje')
<?php $id_integrante; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Redil |</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        @include('includes.styles')
        <!-- datepicker.css -->
        <link href="/css/datepicker.css" rel="stylesheet" type="text/css" />
        <link href="/css/datepicker3.css" rel="stylesheet" type="text/css" />
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
                        ACTUALIZAR REPORTE DE GRUPO
                        <small> Aqui podra actualizar un reporte de grupo. </small></h1>
                    
                        
                        <br>
                 </section>
                 <!-- /contendio cabezote -->
                 

             <!-- contenido principal -->
              <section class="content">
                  <form id="form-reporte" action="../update/{{ $reporte->id }}" method="post" role="form" >
                  
                  <!-- row para el formulario -->
                    <div class="container-fluid">

                      <div class="row">
                        <!-- columna del boton guardar -->
                        <div class="col-md-12">
                            <div class=" box-header">
                                <div class="col-lg-4">
                                <button type="submit" class="btn btn-danger">Actualizar Reporte</button>
                                <a href="../lista/todos" class="btn bg-light-redil"> <i class="fa fa-undo"></i> Cancelar</a>
                                <br><br>
                              </div>
                              <div class="col-lg-8">
                                <?php $status=Session::get('status');  ?>
                                  @if($status=='ok_update')
                                  <div class="alert alert-success col-lg-12 desvanecer" style="" >
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <b>Actualización Completa!</b> El reporte fue actualizado satisfactoriamente
                                  </div>
                                   @elseif($status=='error_update')
                                  <div class="alert alert-danger col-lg-12" style="" >
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <?php 
                                    $fecha_buscar=date("Y-m-d", strtotime(str_replace('/', '-',Session::get('fecha')) ));
                                    ?>
                                    Ya existe un reporte para este grupo con la fecha {{ Session::get('fecha') }}, Verifique y actualice nuevamente. puede dirigirse al <a title="Clic Aqui!" target='blank' href="../lista/todos/{{ $reporte->grupo_id.' '.$reporte->grupo->nombre.'/'.$fecha_buscar }}">Listado de Reportes</a> y verficar.
                                  </div>
                                  @endif
                              </div>
                            </div>
                            <br>
                        </div>
                         <!-- /columna del boton reportar -->
                      </div>

                      <div class="row">
                         <!-- columna Seleccionar grupo -->
                        <div class="col-md-5">
                                <div class="box box-primary">
                                    <div class="panel-heading">
                                        <h3 class="box-title">Información del grupo</h3>
                                    </div>
                                    
                                    <div class="panel-body">
                                            
                                        
                                        <!-- informacion Grupo inmediato-->
                                        <div class="form-group">
                                             <label>Grupo</label>
                                             <input id="grupo" name="grupo" type="text" class="form-control" placeholder="" readonly required value="{{ $reporte->grupo['id'].' - '.$reporte->grupo['nombre'] }}" />
                                             <input id="grupo_id" name="grupo_id" type="text" class="form-control" placeholder="" title="Seleccione el grupo para poder continuar" value="{{ $reporte->grupo['id'] }}" required style="position:relative; top:-34px; z-index:-1;"/>
                                             
                                        </div>
                                        <!-- informacion Grupo inmediato -->
                                        
                                        <!-- informacion del lider-->
                                        <div class="form-group">
                                            <label>Líder(es)</label>
                                            <table id="tabla_encargados" class="table table-striped display " cellspacing="0" width="100%">
                                              <thead>
                                                  <tr>
                                                      <th>COD.</th>
                                                      <th>NOMBRE</th>
                                                </tr>
                                              </thead>
                                              <tbody> 
                                                <?php $grupo=Grupo::find($reporte->grupo['id']);  ?>
                                                @foreach($grupo->encargados as $encargado)  
                                                  <tr>
                                                    <td>{{ $encargado['id'] }}</td>
                                                    <td>{{ $encargado['nombre'].' '.$encargado['apellido'] }}</td>
                                                  </tr>
                                                @endforeach
                                              </tbody>
                                            </table>
                                        </div>
                                        <!-- informacion del lider -->
                                     
                                        <!-- informacion Linea-->
                                        <div class="form-group">
                                             <label>Linea </label>
                                             <input id="linea" name="linea" type="text" class="form-control" placeholder="" readonly value="{{ $grupo->linea->nombre }}"/>
                                        </div>
                                        <!-- informacion Linea -->
                                    </div>
                                </div>
                        </div>
                        <!-- /columna  Seleccionar grupo -->

                        <!-- columna Seleccionar grupo -->
                        <div class="col-md-7">
                                <div class="box box-primary">
                                    <div class="panel-heading">
                                        <h3 class="box-title"></h3>
                                    </div>
                                    
                                    <div class="panel-body">
                                            
                                        <!-- Fecha de reunion mm/dd/yyyy -->
                                        <div class="form-group">
                                            <label>Fecha de reunión</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <?php $fecha=date_create($reporte->fecha); ?>
                                                <input id="seleccionaFecha" name="fecha" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask value="{{ date_format($fecha, 'd/m/Y') }}" readonly='readonly' required/>
                                            </div>
                                        </div>
                                        <!-- /.fin Fecha de reunion -->
                                         <!-- predicaicon o tema -->
                                          <div class="form-group">
                                             <label>Predicación o tema</label>
                                             <input name="tema" type="text" class="form-control" placeholder="Ej: El unico DIOS verdadero" value="{{ $reporte->tema }}" required/>
                                             <input id="finanzas" name="finanzas" class="hide" type="text" class="form-control" />
                                             <input id="ofrendas_eliminar" name="ofrendas_eliminar" class="hide" type="text" class="form-control" />
                                             <input id="ids_integrantes" name="ids_integrantes" class="hide" type="text" class="form-control" />
                                          </div>
                                          <!-- /predicaicon o tema -->
                                          <!-- Observaciones -->
                                          <div class="form-group">
                                              <label>Observaciones</label>
                                              <textarea name="observacion" class="form-control" rows="5"  maxlength="500" placeholder="">{{ $reporte->observacion }}</textarea>
                                          </div>
                                          <!-- /Observaciones -->
                                    </div>
                                    <br>
                                    <br>
                                </div>
                        </div>
                        <!-- /columna  Seleccionar reportar -->   
                      </div>                    

                                             
                        

                      <div class="row">
                        <div class="col-md-7">
                             <div class="box box-primary">
                                    <div class="panel-heading">
                                        <h3 class="box-title"><span class="badge bg-light-blue"> <i class="fa fa-male fa-3x"></i> <i class="fa fa-female fa-3x"></i></span>
                                            Integrantes - <span class="label arrowed-right label-info" id="cantidad_integrantes"> {{ $reporte->asistentes()->count() }} Personas</span></h3>
                                        
                                    </div>
                                    
                                    <div class="panel-body">
                                        <!-- tabla -->
                                        <div id="div_integrantes" class="box-body table-responsive">
                                              <table id="tabla_integrantes" class="table table-striped display stripe" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>ASISTENTE</th>
                                                            <th class="text-center">INFORMACIÓN FINANCIERA</th>
                                                            <th></th>
                                                            <th class="text-center">¿ASISTÍO?</th>
                                                            
                                                            
                                                            
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                      @foreach($reporte->asistentes as $integrante)
                                                        <tr>
                                                                                                              
                                                          <td>
                                                              <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Codigo">Cod</label> {{ $integrante->id }}<br>
                                                              <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Nombre"> <i class="fa fa-user"></i></label> {{ $integrante->nombre.' '.$integrante->apellido }}                                                                                
                                                          </td>
                                                          
                                                          <td class= "text-left">
                                                             
                                                                   <h4><label class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="Diezmo/ofrenda"> <i class="fa fa-money"></i></label> <label id="ofrenda_{{$integrante->id}}">$0 </label>
                                                                   
                                                                   </h4> 
                                                                                                                                                                            
                                                          </td>
                                                                  
                                                          <td class= "text-center">
                                                                  <button class="btn btn-success abrir-panel-ofrendas" data-nombre="{{$integrante->nombre.' '.$integrante->apellido}}" data-id="{{$integrante->id}}" data-toggle="modal" data-target=".modal-financiero"> + </button>
                                                          </td>
                                                          
                                                          <td class= "text-center">
                                                               <div class="form-group"> 
                                                                  <!-- /asitio SI NO -->
                                                                    <div class="form-group"> 
                                                                        
                                                                              <div class="radio">
                                                                                  <label>
                                                                                    
                                                                                      <input type="radio" name="asistio{{$integrante->id}}" id="optionsRadios1" value="1" required @if($integrante->pivot->asistio=="1") checked @endif> Si
                                                                                  </label>
                                                                                  <label>
                                                                                      <input type="radio" name="asistio{{$integrante->id}}" id="optionsRadios2" value="0" required @if($integrante->pivot->asistio=="0") checked @endif> No
                                                                                  </label>
                                                                              </div> 
                                                                             
                                                                    </div>
                                                                  <!-- /asitio SI NO -->
                                                                                
                                                              </div>    


                                                          </td>
                                                          
                                                      </tr>  
                                                      @endforeach
                                                    </tbody>
                                                    
                                                </table>
                                         </div>
                                         <!-- /tabla -->
                                    </div>
                                 </div>
                        </div>



                        <!-- columna Resumen Financiero -->
                        <div class="col-md-5">
                            <div class="box box-success">
                                <div class="panel-heading">
                                    <h3 class="box-title"> <span class="badge bg-green">  <i class="fa fa-money fa-3x"></i> </span> Resumen Financiero</h3>
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
                                                    <h4><label class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="">$</label> <label id="diezmos"> 0 </label> </h4> 

                                                </td>
                                                    
                                                 <td>
                                                      
                                                                                        
                                                </td>
                                                
                                            </tr>

                                             <tr>
                                                
                                                
                                                <td>
                                                    <h4> Ofrendas </h4>
                                                </td>

                                                <td>
                                                    <h4><label class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="">$</label> <label id="ofrendas"> 0 </label> </h4> 

                                                </td>
                                                    
                                                 <td>
                                                      
                                                                                        
                                                </td>
                                                
                                            </tr>
                                            <tr>
                                                
                                                
                                                <td>
                                                    <h4> Pactos </h4>
                                                </td>

                                                <td>
                                                    <h4><label class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="">$</label> <label id="pactos"> 0 </label> </h4> 

                                                </td>
                                                    
                                                 <td>
                                                      
                                                                                        
                                                </td>
                                                
                                            </tr>
                                            <tr>
                                                
                                                
                                                <td>
                                                    <h4> Primicias </h4>
                                                </td>

                                                <td>
                                                    <h4><label class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="">$</label> <label id="primicias"> 0 </label> </h4> 

                                                </td>
                                                    
                                                 <td>
                                                      
                                                                                        
                                                </td>
                                                
                                            </tr>
                                            <tr>
                                                
                                                
                                                <td>
                                                    <h4> Pro-templo </h4>
                                                </td>

                                                <td>
                                                    <h4><label class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="">$</label> <label id="protemplo"> 0 </label> </h4> 

                                                </td>
                                                    
                                                 <td>
                                                      
                                                                                        
                                                </td>
                                                
                                            </tr>

                                            <tr>
                                                
                                                
                                                <td>
                                                    <h4> Siembra </h4>
                                                </td>

                                                <td>
                                                    <h4><label class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="">$</label> <label id="siembras"> 0 </label> </h4> 

                                                </td>
                                                    
                                                 <td>
                                                      
                                                                                        
                                                </td>
                                                
                                            </tr>

                                            <tr>
                                                
                                                
                                                <td>
                                                    <h4> Otro </h4>
                                                </td>

                                                <td>
                                                    <h4><label class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="">$</label> <label id="otros"> 0 </label> </h4> 

                                                </td>
                                                    
                                                 <td>
                                                      
                                                                                        
                                                </td>
                                                
                                            </tr>
                                            
                                            <tr>
                                                <td>
                                                    <h4> Ofrendas sueltas </h4>
                                                </td>

                                                <td>
                                                    <h4><label class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="">$</label> <label id="sueltas"> 0 </label> </h4> 
                                                </td>
                                                    
                                                 <td> 
                                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target=".modal-ofrenda-suelta"> <i class="fa ">+</i> añadir  </button>
                                                <!--
                                                    <input name="ofrenda_suelta" type="number" class="form-control" placeholder="$" data-toggle="tooltip" data-placement="top" title="Si hay ofrenda suelta ingrese el valor en este campo, de lo contrario simplemente dejelo vacio"/>
                                                --></td>
                                                
                                            </tr>

                                             <tr>
                                                <td class="text-right">
                                                    <h4><b>TOTAL</b></h4>
                                                </td>

                                                <td>
                                                    <h4><label class="label arrowed-right label-success" data-toggle="tooltip" data-placement="top" title="">$</label> <label id="total"> 0 </label> </h4> 
                                                </td>
                                                    
                                                 <td>
                                                </td>

                                            </tr>
                                        </tbody>
                                        
                                    </table>
                                </div> <!-- /box-body -->
                            </div>
                                
                        </div>
                        <!-- /columna  Resumen Financiero -->   
                      </div>   

                      <div class="row">
                        <!-- columna del boton reportar -->
                        <div class="col-md-12">
                            <div class=" box-header">
                                  <button type="submit" class="btn btn-danger">Actualizar Reporte</button>
                            </div>
                        </div>
                         <!-- /columna del boton reportar -->
                      </div>
                        
                    
                   </div>  
                    <!-- inputs ofrenda suelta -->
                    <input id="valor_ofrenda_suelta" name="valor_ofrenda_suelta" type="text" class="hide form-control" placeholder=""/>
                    <textarea id="observacion_ofrenda_suelta" name="observacion_ofrenda_suelta" class=" hide form-control" rows="5"  maxlength="500" placeholder=""></textarea>
                    <!-- /input ofrenda suelta  -->
                    <!-- /row para el formulario -->  
                   </form>
              </section>
              <!-- contenido principal -->
            </aside>  
        </div>


            


            <!-- modal informacion financiera  -->
            <div class="modal fade modal-financiero" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 id="titulo-informacion-financiera" class="modal-title" id="myModalLabel">INFORMACIÓN FINANCIERA </h4>
                                </div>
                            <div class="modal-body">

                                <div class="box box-filtro collapsed-box" >
                                  <div class="box-header">
                                    <div class="pull-right box-tools" >
                                      
                                      <button class="btn btn-info btn-md" data-widget='collapse' data-toggle="tooltip" title="Crear una nueva ofrenda para el integrante"><i class="fa fa-money"></i> Nueva Ofrenda</button>
                                    </div>
                                        
                                  </div>
                                  
                                  <div class="box-body" style="display:none">
                                    <!-- Valor -->
                                      <div class="form-group">
                                         <label>Valor</label>
                                         <input id="valor" type="number" class="number form-control" placeholder=""/>
                                      </div>
                                      <!-- /valor -->
                                      <!-- Tipo de id -->
                                           <div class="form-group">
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
                                      <div class="form-group">
                                          <label>Observaciones</label>
                                          <textarea id="observacion" class="form-control" rows="5"  maxlength="500" placeholder=""></textarea>
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
                    <div class="modal fade modal-ofrenda-suelta" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                                         <?php $ofrenda_suelta=$reporte->ofrendas()->where('tipo_ofrenda', '=', 7)->first(); ?>
                                         <input id="valor_o_s" type="text" class="number form-control" placeholder="" @if(isset($ofrenda_suelta->valor)) value="{{ $ofrenda_suelta->valor }}" @else value="0" @endif required/>
                                         
                                      </div>
                                      <!-- /valor -->
                                      <!-- Observaciones -->
                                      <div class="form-group">
                                          <label>Observaciones</label>
                                          <textarea id="observacion_o_s" class="form-control" rows="5"  maxlength="500" placeholder="">@if(isset($ofrenda_suelta->observacion)){{ $ofrenda_suelta->observacion }} @endif</textarea>
                                          
                                      </div>
                                      <!-- /Observaciones -->
                                      <div class="modal-footer">
                                        <div class="col-lg-12">
                                      <div id="error_add_ofrenda_suelta" class="alert alert-danger col-lg-8" style="display:none;" >
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        Faltan campos por llenar                                      
                                      </div>
                                        <!-- Boton añadir -->
                                        <button class="add-ofrenda-suelta btn btn-success btn-md" ><i class="fa fa-save"></i>  Actualizar</button>  
                                        <button type="button" class="btn btn-danger btn-md" data-dismiss="modal"><i class="fa fa-times-cricle"></i>   Cerrar</button>
                                      </div>
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
        <script src="/js/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
        
        <!-- bootstra datepicker-->
        <script src="/js/bootstrap-datepicker.js"></script>
        <script src="/js/locales/bootstrap-datepicker.es.js"></script>

        <!-- page script -->
                <script type="text/javascript">
                    
                    $(document).ready(function() {
                        var aPos;///esta variable me guarda la posicion de la tabla a la que le dieron clic para abrir el panel de ofrendas
                        var diezmos=0, ofrendas=0, pactos=0, primicias=0;
                        var total=0, protemplo=0, siembras=0, otros=0;
                        var cant_ofrendas=0;

                        $("#menu_grupos").attr('class', 'treeview active');
                        $("#submenu_grupos").attr('style', 'display: block;');
                        $("#flecha_grupos").attr('class', 'fa fa-angle-down pull-right');

                        


                      var tabla_integrantes = $('#tabla_integrantes').dataTable({

                        "bPaginate": false,
                      });

                        var id_seleccionado={{$reporte->grupo_id}};

                        /////fecha del reporte

                        $.ajax({url:"/grupos/dia-celula/"+id_seleccionado,cache:false, type:"POST",success:function(resp)
                              {
                                dia_reunion=resp;
                                //alert(resp);
                                //Date range picker$
                                if(dia_reunion!="")
                                {
                                  $('#seleccionaFecha').datepicker({
                                    beforeShowDay: function (date){ 

                                      var day = date.getDay();
                                      var actual = new Date();
                                      // aqui indicamos el numero correspondiente a los dias que ha de bloquearse (el 0 es Domingo, 1 Lunes, etc...) en el ejemplo bloqueo todos menos los lunes y jueves.
                                      if(day==(dia_reunion-1) && date <= actual)
                                        return true;
                                      else
                                        return false;
                                      },

                                      language: 'es',
                                      format: 'dd/mm/yyyy',
                                      maxDate: '+0m +0d',

                                  });

                                  $('#seleccionaFecha').datepicker({ format: 'mm-dd-yyyy', endDate: '+0d', autoclose: true });
                                  //alert(id_seleccionado);
                                  
                                }//cierre if
                                else
                                {
                                  $('#mensaje').modal('show');
                                }
                              }
                            });

                            $( "#form-reporte" ).submit(function( event ) {
                              if($("input[aria-controls=tabla_integrantes]").val()!='')
                              {
                                tabla_integrantes.fnFilter('');
                                event.preventDefault();
                                setTimeout(function(){ //alert("Hello");
                                  $( "#btn-reportar" ).trigger("click");
                                 }, 100);
                                
                                
                              }
                              
                             // event.preventDefault();
                            });


     ///////////////////////////////llenando las finanzas de los integrantes
                        var finanzas= new Array();
                        var ids_integrantes= new Array();
                        var ofrendas_eliminar= new Array();
                        <?php $k=0; ?>
                        @foreach($reporte->asistentes as $integrante)
                          
                          finanzas.push(new Array({{ $integrante->id }}, new Array(), 0));
                          <?php global $id_integrante;
                          $id_integrante=$integrante->id; ?>
                          @foreach($reporte->ofrendas()->whereHas('reporte_grupo', function($q){ global $id_integrante;  $q->where('asistente_id', '=', $id_integrante );})->get() as $ofrenda)
                            finanzas[{{$k}}][1].push(new Array({{$ofrenda->valor}}, {{$ofrenda->tipo_ofrenda}}, '{{$ofrenda->observacion}}', 0, {{ $ofrenda->id }}));
                            //ids_ofrenda.push({{ $ofrenda->id }});
                            finanzas[{{$k}}][2]+={{ $ofrenda->valor }};

                            cant_ofrendas++;


                            var tipo_ofrenda="";

                            @if($ofrenda->tipo_ofrenda==0)
                                tipo_ofrenda="Diezmo";
                                diezmos+=parseInt("{{ $ofrenda->valor }}");
                                $("#diezmos").html(diezmos);
                            @elseif($ofrenda->tipo_ofrenda==1)
                                tipo_ofrenda="Ofrenda";
                                ofrendas+=parseInt("{{ $ofrenda->valor }}");
                                $("#ofrendas").html(ofrendas);
                            @elseif($ofrenda->tipo_ofrenda==2)
                                tipo_ofrenda="Pacto";
                                pactos+=parseInt("{{ $ofrenda->valor }}");
                                $("#pactos").html(pactos);
                            @elseif($ofrenda->tipo_ofrenda==3)
                                tipo_ofrenda="Pro-templo";
                                protemplo+=parseInt("{{ $ofrenda->valor }}");
                                $("#protemplo").html(protemplo);
                            @elseif($ofrenda->tipo_ofrenda==4)
                                tipo_ofrenda="Siembra";
                                siembras+=parseInt("{{ $ofrenda->valor }}");
                                $("#siembras").html(siembras);
                            @elseif($ofrenda->tipo_ofrenda==5)
                                tipo_ofrenda="Primicia";
                                primicias+=parseInt("{{ $ofrenda->valor }}");
                                $("#primicias").html(primicias);
                            @elseif($ofrenda->tipo_ofrenda==6)
                                tipo_ofrenda="Otro";
                                otros+=parseInt("{{ $ofrenda->valor }}");
                                $("#otros").html(otros);
                            @endif

                            $("#ofrenda_"+finanzas[{{ $k }}][0]).html("$"+finanzas[{{ $k }}][2]);
                            total+=parseInt("{{ $ofrenda->valor }}");
                            

                          @endforeach
                          ids_integrantes.push({{ $integrante->id }});
                          <?php $k++; ?>


                        @endforeach
                        @if(isset($ofrenda_suelta))
                          total+=parseInt("{{ $ofrenda_suelta->valor }}");
                          $("#sueltas").html("{{ $ofrenda_suelta->valor }}");
                        @endif
                        $("#total").html(total);
                        //alert(JSON.stringify(finanzas));
                        $('#ids_integrantes').val(ids_integrantes);

                        var tabla_ofrendas= $('#ofrendas-integrante').dataTable( {
                          "bPaginate": true,
                          "bLengthChange": false,
                          "bFilter": false,
                          "bSort": true,
                          "bInfo": false,
                          "bAutoWidth": false
                                         
                        });

                        $('.abrir-panel-ofrendas').click (function () {

                          tabla_ofrendas.fnClearTable();
                          var nombre_integrantre=$(this).attr('data-nombre');
                          $("#titulo-informacion-financiera").html("INFORMACIÓN FINANCIERA - "+nombre_integrantre);
                          var fila = $(this).parent().parent().get(0); // this line did the trick
                          aPos = tabla_integrantes.fnGetPosition(fila); ///me tiene la posicion del tr al que le dieron clic para abrir el panel de ofrendas
                          var count=finanzas[aPos][1].length;
                          
                          for(var i=0; i<count; i++)
                          {
                              var tipo_ofrenda="";
                              if(finanzas[aPos][1][i][1]==0) tipo_ofrenda="Diezmo";
                              else if(finanzas[aPos][1][i][1]==1) tipo_ofrenda="Ofrenda";
                              else if(finanzas[aPos][1][i][1]==2) tipo_ofrenda="Pacto";
                              else if(finanzas[aPos][1][i][1]==3) tipo_ofrenda="Pro-templo";
                              else if(finanzas[aPos][1][i][1]==4) tipo_ofrenda="Siembra";
                              else if(finanzas[aPos][1][i][1]==5) tipo_ofrenda="Primicia";
                              else if(finanzas[aPos][1][i][1]==6) tipo_ofrenda="Otro";

                              tabla_ofrendas.fnAddData( [
                                  finanzas[aPos][1][i][0],
                                  tipo_ofrenda,
                                  finanzas[aPos][1][i][2],
                              '<a class="borrar-ofrenda'+i+' btn btn-danger btn-sm" > <b>X</b> </a>'
                              ]);

                              $('.borrar-ofrenda'+i).click (function () {
                                    var target_row = $(this).parent().parent().get(0); // this line did the trick
                                    var fila = tabla_ofrendas.fnGetPosition(target_row); 
                                    tabla_ofrendas.fnDeleteRow(fila);
                                    ofrendas_eliminar.push(finanzas[aPos][1][fila]);
                                    eliminada=finanzas[aPos][1].splice(fila, 1);
                                    
                                    $("#ofrendas_eliminar").val(JSON.stringify(ofrendas_eliminar));
                                    finanzas[aPos][2]-=parseInt(eliminada[0]);
                                    $("#ofrenda_"+finanzas[aPos][0]).html("$"+finanzas[aPos][2]);
                                    total-=(parseInt(eliminada[0][0]));
                                    $("#total").html(total);
                                    if(eliminada[0][1]==0)
                                    {
                                        diezmos-=(parseInt(eliminada[0][0]));
                                        $("#diezmos").html(diezmos);
                                    }
                                    else if(eliminada[0][1]==1)
                                    {
                                        ofrendas-=(parseInt(eliminada[0][0]));
                                        $("#ofrendas").html(ofrendas);
                                    }
                                    else if(eliminada[0][1]==0)
                                    {
                                        pactos-=(parseInt(eliminada[0][0]));
                                        $("#pactos").html(pactos);
                                    }
                                    else if(eliminada[0][1]==0)
                                    {
                                        protemplo-=(parseInt(eliminada[0][0]));
                                        $("#protemplo").html(protemplo);
                                    }
                                    else if(eliminada[0][1]==0)
                                    {
                                        siembras-=(parseInt(eliminada[0][0]));
                                        $("#siembras").html(siembras);
                                    }
                                    else if(eliminada[0][1]==0)
                                    {
                                        primicias-=(parseInt(eliminada[0][0]));
                                        $("#primicias").html(primicias);
                                    }
                                    else if(eliminada[0][1]==0)
                                    {
                                        otros-=(parseInt(eliminada[0][0]));
                                        $("#otros").html(otros);
                                    }
                                    $("#finanzas").val(JSON.stringify(finanzas));
                                    cant_ofrendas--;
                                });
                          }
                                    
                        });

                        

                        $('.add-ofrenda').click (function () {
                            if($("#valor").val()!="" && $("#tipo-ofrenda").val()!="")
                            {
                                var tipo_ofrenda="";
                                finanzas[aPos][1].push(new Array($("#valor").val(), $("#tipo-ofrenda").val(), $("#observacion").val(), 1, 0));
                                if($("#tipo-ofrenda").val()==0){
                                    tipo_ofrenda="Diezmo";
                                    diezmos+=parseInt($("#valor").val());
                                    $("#diezmos").html(diezmos);
                                } 
                                else if($("#tipo-ofrenda").val()==1)
                                {
                                    tipo_ofrenda="Ofrenda";
                                    ofrendas+=parseInt($("#valor").val());
                                    $("#ofrendas").html(ofrendas);
                                } 
                                else if($("#tipo-ofrenda").val()==2)
                                {
                                    tipo_ofrenda="Pacto";
                                    pactos+=parseInt($("#valor").val());
                                    $("#pactos").html(pactos);
                                } 
                                else if($("#tipo-ofrenda").val()==3)
                                {
                                    tipo_ofrenda="Pro-templo";
                                    protemplo+=parseInt($("#valor").val());
                                    $("#protemplo").html(protemplo);
                                } 
                                else if($("#tipo-ofrenda").val()==4)
                                {
                                    tipo_ofrenda="Siembra";
                                    siembras+=parseInt($("#valor").val());
                                    $("#siembras").html(siembras);
                                } 
                                else if($("#tipo-ofrenda").val()==5){
                                    tipo_ofrenda="Primicia";
                                    primicias+=parseInt($("#valor").val());
                                    $("#primicias").html(primicias);
                                } 
                                else if($("#tipo-ofrenda").val()==6)
                                {
                                    tipo_ofrenda="Otro";
                                    otros+=parseInt($("#valor").val());
                                    $("#otros").html(otros);
                                } 
                                finanzas[aPos][2]+=parseInt($("#valor").val());
                                $("#ofrenda_"+finanzas[aPos][0]).html("$"+finanzas[aPos][2]);
                                total+=parseInt($("#valor").val());
                                $("#total").html(total);
                                tabla_ofrendas.fnAddData( [
                                    $("#valor").val(),
                                    tipo_ofrenda,
                                    $("#observacion").val(),
                                '<a class="borrar-ofrenda'+cant_ofrendas+' btn btn-danger btn-sm" > <b>X</b> </a>'
                                ]);
                                $('.borrar-ofrenda'+cant_ofrendas).click (function () {
                                    var target_row = $(this).parent().parent().get(0); // this line did the trick
                                    var fila = tabla_ofrendas.fnGetPosition(target_row); 
                                    tabla_ofrendas.fnDeleteRow(fila);
                                    eliminada=finanzas[aPos][1].splice(fila, 1);
                                    ofrendas_eliminar.push(eliminada);
                                    $("#ofrendas_eliminar").val(JSON.stringify(ofrendas_eliminar));
                                    finanzas[aPos][2]-=parseInt(eliminada[0]);
                                    $("#ofrenda_"+finanzas[aPos][0]).html("$"+finanzas[aPos][2]);
                                    total-=(parseInt(eliminada[0][0]));
                                    $("#total").html(total);
                                    if(eliminada[0][1]==0)
                                    {
                                        diezmos-=(parseInt(eliminada[0][0]));
                                        $("#diezmos").html(diezmos);
                                    }
                                    else if(eliminada[0][1]==1)
                                    {
                                        ofrendas-=(parseInt(eliminada[0][0]));
                                        $("#ofrendas").html(ofrendas);
                                    }
                                    else if(eliminada[0][1]==0)
                                    {
                                        pactos-=(parseInt(eliminada[0][0]));
                                        $("#pactos").html(pactos);
                                    }
                                    else if(eliminada[0][1]==0)
                                    {
                                        protemplo-=(parseInt(eliminada[0][0]));
                                        $("#protemplo").html(protemplo);
                                    }
                                    else if(eliminada[0][1]==0)
                                    {
                                        siembras-=(parseInt(eliminada[0][0]));
                                        $("#siembras").html(siembras);
                                    }
                                    else if(eliminada[0][1]==0)
                                    {
                                        primicias-=(parseInt(eliminada[0][0]));
                                        $("#primicias").html(primicias);
                                    }
                                    else if(eliminada[0][1]==0)
                                    {
                                        otros-=(parseInt(eliminada[0][0]));
                                        $("#otros").html(otros);
                                    }

                                    cant_ofrendas--;
                                    $("#finanzas").val(JSON.stringify(finanzas));
                                });
                                cant_ofrendas++;
                                $("#valor").val("");
                                $("#tipo-ofrenda").val("");
                                $("#observacion").val("");
                                $("#finanzas").val(JSON.stringify(finanzas));
                                $("#tipo-ofrenda").css("background-color", "#fff");
                                $("#valor").css("background-color", "#fff");
                            }
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
                            }
                        });


                        $('.add-ofrenda-suelta').click (function () {
                            
                            if($("#valor_o_s").val()!="")
                            {
                                total=diezmos+ofrendas+pactos+primicias+protemplo+otros+siembras+parseInt($("#valor_o_s").val());
                                $("#sueltas").html($("#valor_o_s").val());
                                $("#total").html(total);
                                $("#valor_o_s").css("background-color", "#fff");
                                $("#valor_ofrenda_suelta").val($("#valor_o_s").val());
                                $("#observacion_ofrenda_suelta").val($("#observacion_o_s").val());
                            }
                            else
                            {
                              $("#error_add_ofrenda_suelta").html("El campo Valor no puede estar vacio, verifique e intente nuevamente");
                              $("#valor_o_s").css("background-color", "#f2dede");
                                    
                                $("#error_add_ofrenda_suelta").show(300);
                                setTimeout(function() {
                                    $("#error_add_ofrenda").hide(300)
                                }, 6000);
                                $("#error_add_ofrenda_ofrenda_suelta").attr("alert alert-danger col-lg-12 desvanecer")
                            }
                        });
                        

                        $('#example2').dataTable({
                        });

                        ////para poner bonitos los check
                                //iCheck for checkbox and radio inputs
                        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                            checkboxClass: 'icheckbox_minimal',
                            radioClass: 'iradio_minimal'
                        });
                        //Red color scheme for iCheck
                        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                            checkboxClass: 'icheckbox_minimal-red',
                            radioClass: 'iradio_minimal-red'
                        });
                        //Flat red color scheme for iCheck
                        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                            checkboxClass: 'icheckbox_flat-red',
                            radioClass: 'iradio_flat-red'
                        });

                        
            });
        </script>

    </body>
</html>

@endif