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
            @if($tipo=="nuevos")
                {{ Lang::get('grupos.lg_ttl_nuevos') }}
            @elseif($tipo=="sin-actividad")
                {{ Lang::get('grupos.lg_ttl_sin_actividad') }}
            @elseif($tipo=="dados-de-baja")
               {{ Lang::get('grupos.lg_ttl_dados_baja') }}
            @elseif($tipo=="grupos-sin-lideres")
                {{ Lang::get('grupos.lg_ttl_sin_lider') }}
            @else
                {{ Lang::get('grupos.lg_ttl_todos') }}
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
                    <th>GRUPO</th>  
                    <th>INFORMACIÓN</th>
                    <th>CONTACTO</th> 
                    @if($tipo!="grupos-sin-lideres")
                        <th >ENCARGADOS</th>
                    @endif
              </tr>
            </thead>                    
            <tbody>
            @foreach($grupos as $grupo)
                <tr style='border-top: 1px solid #dddddd;'>
                    <td style='border-top: 1px solid #dddddd;'>
                       Codigo: {{$grupo->id}} <br>
                       Nombre: {{$grupo->nombre}}<br>
                       @if($grupo->dia != 0 && $grupo->dia !="" ){{ Lang::choice('general.dias', $grupo->dia) }} ,@endif {{ date("g:i a",strtotime("$grupo->hora")) }} <br>   
                    </td>
                    <td style='border-top: 1px solid #dddddd;'>
                        Tipo: {{ $grupo->tipoGrupo['nombre'] }} <br>
                        Redes: <?php $arrayRedes = array(); ?>
                        @foreach($grupo->redes as $red)
                            <?php $arrayRedes[]= $red['nombre'] ?>
                        @endforeach
                        {{ implode(", ", $arrayRedes) }} <br>
                        Línea: 
                        @if ($grupo->linea['nombre'] != "") 
                           <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="{{ Lang::get('grupos.lg_ttl_linea') }} "> {{ Lang::get('grupos.lg_lb_linea') }}</label> {{ $grupo->linea['nombre'] }} <br> 
                        @endif

                    </td>
                    <td style='border-top: 1px solid #dddddd;'>
                        Tel: {{ $grupo->telefono }} <br>
                        Dirección: {{ $grupo->direccion }} <br>   
                                                   
                    </td>
                     @if($tipo!="grupos-sin-lideres")
                    <td style='border-top: 1px solid #dddddd;'>                         
                         @foreach($grupo->encargados as $encargado)
                            {{ $encargado["nombre"] ." ".$encargado["apellido"] }}<br>
                        @endforeach 
                    </td>   
                    @endif             
                </tr>
            @endforeach
            </tbody> 
        </table> 
    </div>
      
</body>
</html>
@endif