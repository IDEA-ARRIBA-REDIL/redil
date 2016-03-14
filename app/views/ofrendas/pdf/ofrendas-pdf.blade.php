@if(Auth::check())
@include('includes.lenguaje')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Informe de ingresos</title>
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

        #derecha {
            float:right;
        }

    </style>
</head>
<body>
 <div id="header">
        <B>LISTA DE OFRENDAS POR ASISTENTE 
            <br><small>(Desde el {{Helper::fechaFormateada($fecha_inicio)}} hasta el {{Helper::fechaFormateada($fecha_fin)}}) @if($linea!="") {{$linea->id}} {{$linea->nombre}} @endif </small>
        </B> 
    </div>
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
      <table style='border: 1px solid #dddddd;' cellspacing=0 cellpadding=2 bordercolor='#aaa' width='100%'>
        <thead>
            <tr>
                <th>COD</th>  
                <th>ASISTENTE</th>  
                <th>TIPO</th>
                <th>VALOR</th>
                <th>FECHA</th> 
                <th>INGRESADA POR</th> 
            </tr>
        </thead>   
        <tbody>    
        @foreach($ofrendas as $ofrenda)
        <tr >
            <td style='border: 1px solid #dddddd;'> 
                @if(isset($ofrenda->asistente->id)) {{ $ofrenda->asistente_id }} @endif
            </td>
            <td style='border: 1px solid #dddddd;' >
                @if(isset($ofrenda->asistente->id))     
                    <span style="text-transform: capitalize;">{{ $ofrenda->asistente->nombre }} {{ $ofrenda->asistente->apellido }}</span>
                @else
                    Ofrenda Suelta
                @endif
            </td> 
            <td style='border: 1px solid #dddddd;' >
                  @if($ofrenda->tipo_ofrenda==0)
                <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top"> Diezmo </label> <br>
                @elseif($ofrenda->tipo_ofrenda==1)
                <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top"> Ofrenda </label> <br>
                @elseif($ofrenda->tipo_ofrenda==2)
                <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top"> Pacto </label> <br>
                @elseif($ofrenda->tipo_ofrenda==3)
                <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top"> Pro-Templo </label> <br>
                @elseif($ofrenda->tipo_ofrenda==4)
                <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top"> Siembra </label> <br>
                @elseif($ofrenda->tipo_ofrenda==5)
                <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top"> Primicia </label> <br>
                @elseif($ofrenda->tipo_ofrenda==6)
                <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top"> Otro </label> <br>
                @elseif($ofrenda->tipo_ofrenda==7)
                <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top"> Suelta </label> <br>
                @endif 
            </td>
            <td style='border: 1px solid #dddddd;'>
                ${{$ofrenda->valor}}
            </td>
            <td style='border: 1px solid #dddddd;'>
                {{ Helper::fechaFormateada($ofrenda->fecha) }} <br>
            </td>
            <td style='border: 1px solid #dddddd;'>
              @if ($ofrenda->ingresada_por==0)
               Reunión <br>
              @elseif($ofrenda->ingresada_por==1)
              Grupo <br>
              @else
              Otro <br>
              @endif   
            </td>    
            
        </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
@endif