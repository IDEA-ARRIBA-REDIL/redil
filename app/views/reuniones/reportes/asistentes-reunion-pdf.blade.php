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
        <B>REPORTE ASISTENTES DE GRUPO:</B> <br> <b>Cod.</b> {{$grupo->id}} / <b>Grupo:</b> {{$grupo->nombre }} / 
        @if (isset($grupo->linea->nombre))
        <b>Línea: </b> {{$grupo->linea->nombre}} 
        @endif
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
                    <th><i class='fa fa-warning'> </i>CÓD.</th>
                    <th>NOMBRE</th>  
                    <th>TELEFONO (S)</th>
                    <th>DIRRECCIÓN </th> 
                    <th >OBSERVACIÓN</th>
              </tr>
            </thead>                    
            <tbody>
            @foreach($grupo->asistentes as $asistente)
                <tr style='border-top: 1px solid #dddddd;'>
                    <td style='border-top: 1px solid #dddddd;'>
                        {{$asistente->id}}
                    </td>
                    <td style='border-top: 1px solid #dddddd;'>
                       {{$asistente->nombre." ".$asistente->apellido }}    
                    </td>
                    <td style='border-top: 1px solid #dddddd;'>
                        {{$asistente->telefono_fijo}} <br>
                        {{$asistente->telefono_movil}}
                    </td>
                    <td style='border-top: 1px solid #dddddd;'>                         
                        {{$asistente->direccion}} <br>
                    </td>
                    <td style='border-top: 1px solid #dddddd;'>
                    </td>
                
                </tr>
            @endforeach
            </tbody> 
        </table> 
    </div>
      
</body>
</html>