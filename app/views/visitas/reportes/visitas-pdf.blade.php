@if(Auth::check())
@include('includes.lenguaje')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Pdf con header y footer en cada página</title>
    @include('includes.styles')
    <style type="text/css">
        /* estilos para el footer y el numero de pagina */
        @page { margin: 80px 50px; }
        #header { 
            position: fixed; 
            left: 0px; 
            top: -80px; 
            right: 0px; 
            height: 45px; 
            background-color: #333; 
            color: #fff;
            text-align: center; 
            padding-top: 5px;
        }
        #footer { 
            position: fixed; 
            left: 0px; 
            bottom: -80px; 
            right: 0px; 
            height: 45px; 
            background-color: #333; 
            color: #fff;
            text-align: center; 
            padding-top: 5px;
        }
        #footer .page:after { 
            content: counter(page); 
        }
        p{
            margin-top: 0px;
        }

    </style>
</head>
<body>
     <!--header para cada pagina-->
    <div id="header">
        <B>REPORTE DE {{ strtoupper(str_replace("-"," ", ucwords($tipo) )); }}: 
            @if($tipo=="programadas")
                {{ 'PROGRAMADAS' }}
            @elseif($tipo=="realizadas")
                {{ 'REALIZADAS' }}
            @elseif($tipo=="no realizadas")
                {{ 'NO REALIZADAS' }}
            @elseif($tipo=="telefonica")
                {{ 'TELEFONICA' }}
            @elseif($tipo=="presencial")
                {{ 'PRESENCIAL' }}
            @elseif($tipo=="todas")
                {{ 'TODAS' }}
            @endif
            <br> (<b>Cantidad</b> {{$cantidad}}) 
        </B> 
    </div>

     <!--footer para cada pagina-->
    <div id="footer">
        <!--aqui se muestra el numero de la pagina en numeros romanos-->
    <?php 
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $iglesia= Iglesia::find(1);
    ?>
    Redil 1.0 - {{ $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') }} - {{$iglesia->nombre.", ".$iglesia->ciudad }}
    <p class="page">Página </p>
    </div>

    <div id="content">
        <table style='border-top: 1px solid #dddddd;' cellspacing=0 cellpadding=4 bordercolor='#aaa' width='100%' >
            <thead>
                <tr>
                    <th>INFORMACIÓN PRINCIPAL</th>  
                    <th>OTRA INFORMACIÓN</th>
                    <th>CONTACTO</th> 
                    <th>ENCARGADOS</th>
                   
              </tr>
            </thead>                    
            <tbody>
                      @foreach ($visitas as $visita)     
                    <tr>
                        
                        <td>
                            <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Codigo">Cod</label> {{$visita->asistente_id}}<br>
                            <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Nombre del Grupo"><i class="fa fa-user" style="margin-right:7px;"> </i>Nombre Asistente</label> {{$visita->asistente->nombre}} <br>
                             <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Nombre del Grupo"><i class="fa  fa-share-alt" style="margin-right:7px;"> </i>Nombre Grupo</label> {{$visita->asistente->apellido}} <br>
                          <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Nombre del Grupo"><i class="fa  fa-share-alt" style="margin-right:7px;"> </i>Nombre Grupo</label> {{$visita->asistente->grupo->nombre}} <br>
          
                        </td>

                        <td>
                          <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Telefono"><i class="fa fa-phone"> </i> Teléfono</label>{{$visita->asistente->telefono_movil}} <br>                             
                            <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Direccion"><i class="fa fa-home"> </i> </label>{{$visita->asistente->direccion}}<br>      
                        </td>
                        
                        <td>
                            <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Grupo Principal"> Fecha limite Visita</label> {{$visita->fecha_limite}} <br>
                            <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Tipo de Grupo"> Fecha de Visita</label> {{$visita->fecha}} <br>
                            <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Lider Grupo">Estado de Visita</label>@if ($visita->estado == 0) {{"Programada"}}
                                                                                                                                                                   @else($visita->estado == 1) {{"Realizada"}} 
                                                                                                                                                                   @if($visita->estado == 2){{"No realizada"}} @endif @endif <br>
                            
                        </td>
                        <td>
                            <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Lider Grupo">Tipo de Visita</label> @if ($visita->tipo == 0) {{"Telefonica"}}
                                                                                                                                                                    @else {{"Presencial"}} @endif <br>
                            <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Lider Grupo">Motivo de Visita</label> {{$visita->motivo}}<br>
                            <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Lider Grupo">Observacion </label> {{$visita->observacion}}<br>
                        <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Lider Grupo">Asignado por </label>

                        @if($visita->asignado_por == 0)
                              Super Administrador

                              @else 
                                    <?php
                                    $usuario=Asistente::find($visita->asignado_por);
                                    ?>  
                                      {{$usuario->nombre}}
                                      {{$usuario->apellido}}
                        @endif
                        </td>

                        <td>
                            @foreach($visita->asistente->grupo->encargados as $encargado )
                            <label class="label arrowed-right label-warning" data-toggle="tooltip" data-placement="top" title="Nombre del Grupo"><i class="fa fa-star-o" style="margin-right:7px;"> </i></label> {{$encargado->nombre}}<br>
                            @endforeach
                       </td>                                                                    
                    </tr>
                @endforeach
                
            </tbody> 
        </table> 
    </div>
      
</body>
</html>
@endif