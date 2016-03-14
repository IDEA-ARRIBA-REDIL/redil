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
        <B>INFORME DE LA REUNIÓN: {{$reunion->id}}    
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
            <td colspan="1"  style='border: 1px solid #dddddd;' >
                <b> NOMBRE: <b>
            </td>
            <td colspan="3"  style='border: 1px solid #dddddd;'>
                {{$reunion->nombre}}
                                
            </td>    
      
        </tr>
        <tr >
            <td width="40%" style='border: 1px solid #dddddd;' >
                 <B> CÓDIGO DE REUNIÓN No: </B>  
            </td>
            <td style='border: 1px solid #dddddd;'>
                {{$reunion->id}}
            </td>    
            <td style='border: 1px solid #dddddd;' >
                  <B>ESTADO:  <B> 
            </td>
            <td style='border: 1px solid #dddddd;'>
                Vigente
           </td> 
        </tr>
        <tr >
            <td style='border: 1px solid #dddddd;' >
               <B> DÍA: <B>
            </td>
            <td  width="30%"style='border: 1px solid #dddddd;'>
                 @if($reunion->dia != 0 && $reunion->dia !="" )
                 {{ Lang::choice('general.dias', $reunion->dia) }} 
                 @endif
            </td>    
            <td  width="30%" style='border: 1px solid #dddddd;' >
                 <B> HORA: <B>  
            </td>
            <td  width="30%" style='border: 1px solid #dddddd;'>
               {{$reunion->hora}}                             
            </td>  
          </tr>
            <tr >
            <td colspan="1"  style='border: 1px solid #dddddd;' >
                <b> LUGAR: <b>
            </td>
            <td colspan="3"  style='border: 1px solid #dddddd;'>
                {{$reunion->lugar}}
                                
            </td>    
         </tr>
         <tr >
            <td colspan="1"  style='border: 1px solid #dddddd;' >
                <b> DESCRIPCIÓN: <b>
            </td>
            <td colspan="3"  style='border: 1px solid #dddddd;'>
                {{$reunion->descripcion}}
                                
            </td>    
        </tr>
     </table> 

     <br> 
    
</body>
</html>
@endif