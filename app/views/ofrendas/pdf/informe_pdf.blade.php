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

        #derecha {
            float:right;
        }

    </style>
</head>
<body>
 <div id="header">
        <B>INFORME DEL INGRESO FINANCIERO: {{$ofrenda->id}}    
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
        <tr >
            <td style='border: 1px solid #dddddd;' >
                 <B> CÓDIGO DE INGRESO No: </B>  
            </td>
            <td style='border: 1px solid #dddddd;'>
                {{$ofrenda->id}}
            </td>    
            <td style='border: 1px solid #dddddd;' >
                  <B>LINEA:  <B> 
            </td>
            <td style='border: 1px solid #dddddd;'>
              @if(isset($ofrenda->asistente->grupo->linea()->nombre))
              {{ $ofrenda->asistente->grupo->linea()->nombre }}
              @endif
           </td> 
        </tr>
        <tr >
            <td style='border: 1px solid #dddddd;' >
               <B> TIPO DE INGRESO: <B>
            </td>
            <td  width="30%"style='border: 1px solid #dddddd;'>
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
            <td  width="30%" style='border: 1px solid #dddddd;' >
                 <B> INGRESADO POR: <B>  
            </td>
            <td  width="30%" style='border: 1px solid #dddddd;'>
              @if ($ofrenda->ingresada_por==0)
              <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Ingresado por"> Ingresado por </label> Reunión <br>
              @elseif($ofrenda->ingresada_por==1)
              <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Ingresado por"> Ingresado por </label> Grupo <br>
              @else
              <label class="label arrowed-right label-info" data-toggle="tooltip" data-placement="top" title="Ingresado por"> Ingresado por </label> Otro <br>
              @endif                                         
            </td>  
          </tr>
        <tr >
            <td  width="30%" style='border: 1px solid #dddddd;' >
                <B>  VALOR: <B>
            </td>
            <td style='border: 1px solid #dddddd;'>
                ${{$ofrenda->valor}}
            </td>    
            <td  width="30%" style='border: 1px solid #dddddd;' >
                 <b>FECHA <b>
            </td>
            <td style='border: 1px solid #dddddd;'>
               {{ $ofrenda->fecha }}                                        
            </td>  
      
        </tr>
             <tr >
            <td colspan="1"  style='border: 1px solid #dddddd;' >
                <b> OBSERVACIONES: <b>
            </td>
            <td colspan="3"  style='border: 1px solid #dddddd;'>
                {{$ofrenda->observacion}}
                                
            </td>    
      
        </tr>
     </table> 

     <br> 
     @if(isset($ofrenda->asistente))
     INFORMACIÓN DE ASISTENTE QUE REALIZÓ EL INGRESO
        <table style='border: 1px solid #dddddd;' cellspacing=0 cellpadding=2 bordercolor='#aaa' width='100%'>
        <tr >
            <td style='border: 1px solid #dddddd;' >
                 <B> CODIGO DE ASISTENTE No: </B>  
            </td>
            <td style='border: 1px solid #dddddd;'>
                {{ $ofrenda->asistente_id }}
            </td>    
            <td style='border: 1px solid #dddddd;' >
                  <B>NOMBRE:  <B> 
            </td>
            <td style='border: 1px solid #dddddd;'>
              {{ $ofrenda->asistente->nombre }} {{ $ofrenda->asistente->apellido }}
           </td>  
        </tr>
        <tr >
            <td style='border: 1px solid #dddddd;' >
               <B> TELÉFONO: <B>
            </td>
            <td  width="30%"style='border: 1px solid #dddddd;'>
                 {{ $ofrenda->asistente->telefono_fijo }}
            </td>    
            <td  width="30%" style='border: 1px solid #dddddd;' >
                 <B> TELÉFONO MOVIL: <B>  
            </td>
            <td  width="30%" style='border: 1px solid #dddddd;'>
              {{ $ofrenda->asistente->telefono_movil }}                                       
            </td>  
          </tr>
        <tr >
            <td  width="30%" style='border: 1px solid #dddddd;' >
                <B>  TELÉFONO OTRO: <B>
            </td>
            <td style='border: 1px solid #dddddd;'>
                {{ $ofrenda->asistente->telefono_otro }}
            </td>    
            <td  width="30%" style='border: 1px solid #dddddd;' >
                 <b>EMAIL: <b>
            </td>
            <td style='border: 1px solid #dddddd;'>
               {{ $ofrenda->asistente->user->email }}                                       
            </td>  

        </tr>
             <tr >
            <td  colspan="1" style='border: 1px solid #dddddd;' >
                <b> LIDER(ES): <b>
            </td>
            <td  colspan="3" style='border: 1px solid #dddddd;'>
                <?php $encargados=$ofrenda->asistente->grupo->encargados;
                $c=0; ?>
                @foreach($encargados as $encargado) 
                @if($c!=0)
                ,
                @endif
                <span class="capitalize">{{ $encargado->nombre }} {{ $encargado->apellido }} </span>
                <?php $c=$c+1; ?>
                @endforeach
            </td>  
      
        </tr>
        
        @if($ofrenda->asistente->dado_baja==1)
        <tr >
            <td colspan="1" style='border: 1px solid #dddddd;' >
                <b> ESTADO: <b>
            </td>
            <td colspan="3" style='border: 1px solid #dddddd;' >
                <b> ASISTENTE DADO DE BAJA <b>
            </td>
            </tr>
        @endif
     </table>

<br> 
 @endif
</body>
</html>
@endif