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
        <B>REPORTE DEL GRUPO: {{$grupo->nombre}}<br>
         NUMERO DEL REPORTE: {{$reporte->id}}
            
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
                 <B> REPORTE DE GRUPO No: </B>  
            </td>
            <td style='border: 1px solid #dddddd;'>
                {{$reporte->id}}
            </td>    
            <td style='border: 1px solid #dddddd;' >
                  <B>DIA DE REUNION:  <B> 
            </td>
            <td style='border: 1px solid #dddddd;'>
              
                                        @if($grupo->dia=="2"){{ Lang::choice ('general.dias', 2) }}@endif
                                        @if($grupo->dia=="3"){{ Lang::choice ('general.dias', 3) }}@endif
                                        @if($grupo->dia=="4"){{ Lang::choice ('general.dias', 4) }}@endif
                                        @if($grupo->dia=="5"){{ Lang::choice ('general.dias', 5) }}@endif
                                        @if($grupo->dia=="6"){{ Lang::choice ('general.dias', 6) }}@endif
                                        @if($grupo->dia=="7"){{ Lang::choice ('general.dias', 7) }}@endif
                                        @if($grupo->dia=="1"){{ Lang::choice ('general.dias', 1) }}@endif 
            </td>  
        </tr>
        <tr >
            <td style='border: 1px solid #dddddd;' >
               <B> LIDER(ES) DE GRUPO: <B>
            </td>
            <td  width="30%"style='border: 1px solid #dddddd;'>
                 @foreach($grupo->encargados as $encargado)  
                                                 
                                                 COD:{{ $encargado['id'] }}-
                                                    {{ $encargado['nombre'].' '.$encargado['apellido'] }}
                                                
                                                @endforeach
            </td>    
            <td  width="30%" style='border: 1px solid #dddddd;' >
                 <B> HORA DE REUNION: <B>  
            </td>
            <td  width="30%" style='border: 1px solid #dddddd;'>
              {{ date('h:i A', strtotime($grupo->hora)) }}                                        
            </td>  
          </tr>
        <tr >
            <td  width="30%" style='border: 1px solid #dddddd;' >
                <B>  GRUPO: <B>
            </td>
            <td style='border: 1px solid #dddddd;'>
                COD: {{ $reporte->grupo['id'].' - '.$reporte->grupo['nombre'] }}
            </td>    
            <td  width="30%" style='border: 1px solid #dddddd;' >
                 <b>TEMA <b>
            </td>
            <td style='border: 1px solid #dddddd;'>
               {{ $reporte->tema }}                                        
            </td>  
      
        </tr>
        <tr >
            <td  width="30%" style='border: 1px solid #dddddd;' >
                <b> LINEA: <b>
            </td>
            <td  width="30%" style='border: 1px solid #dddddd;'>
                {{ $grupo->linea->nombre }}
                                
            </td>    
            <td  width="30%" style='border: 1px solid #dddddd;' >
             <b> DIRECCIÓN Y TELEFONO: <b>
            </td>
            <td  width="30%" style='border: 1px solid #dddddd;'>
              {{$grupo->direccion}} / 
              {{$grupo->telefono}}                                    
            </td>  
      
        </tr>

     </table> <br> 
     RESUMEN FINANCIERO
     <table style='border: 1px solid #dddddd;' cellspacing="0" width="100%">
                                                  <thead>
                                                      <tr>
                                                          <th style='border: 1px solid #dddddd;' cellspacing="0"  width="30%">TIPO</th>
                                                          <th style='border: 1px solid #dddddd;' cellspacing="0"  width="30%">TOTAL</th>
                                                          <th style='border: 1px solid #dddddd;' cellspacing="0"  width="30%">TIPO</th>
                                                          <th style='border: 1px solid #dddddd;' cellspacing="0"  width="30%">TOTAL</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                             
                                                      <tr>
                                                          <td style='border: 1px solid #dddddd;' cellspacing="0" width="30%">
                                                              Diezmos 
                                                          </td>

                                                          <td style='border: 1px solid #dddddd;' cellspacing="0" width="30%">
                                                              $ {{$reporte->ofrendas()->where('tipo_ofrenda',0)->sum('valor')}}

                                                          </td>


                                                          
                                                          
                                                          <td style='border: 1px solid #dddddd;' cellspacing="0"  width="30%">
                                                               Pro-templo 
                                                          </td>

                                                          <td style='border: 1px solid #dddddd;' cellspacing="0"  width="30%">
                                                              $ {{$reporte->ofrendas()->where('tipo_ofrenda',3)->sum('valor')}} 

                                                          </td>
                                                          
                                                      </tr>

                                                       <tr>
                                                          
                                                          
                                                          <td style='border: 1px solid #dddddd;' cellspacing="0" width="30%">
                                                               Ofrendas 
                                                          </td>

                                                          <td style='border: 1px solid #dddddd;' cellspacing="0"  width="30%">
                                                            $ {{$reporte->ofrendas()->where('tipo_ofrenda',1)->sum('valor')}}

                                                          </td>
                                                          <td style='border: 1px solid #dddddd;' cellspacing="0"  width="30%">
                                                              Siembra 
                                                          </td>

                                                          <td style='border: 1px solid #dddddd;' cellspacing="0"  width="30%">
                                                            $ {{$reporte->ofrendas()->where('tipo_ofrenda',4)->sum('valor')}}  

                                                          </td>
                                                          
                                                      </tr>
                                                      <tr>
                                                          
                                                          
                                                          <td style='border: 1px solid #dddddd;' cellspacing="0"  width="30%">
                                                               Pactos 
                                                          </td>

                                                          <td style='border: 1px solid #dddddd;' cellspacing="0"  width="30%">
                                                            $ {{$reporte->ofrendas()->where('tipo_ofrenda',2)->sum('valor')}}

                                                          </td>
                                                              <td style='border: 1px solid #dddddd;' cellspacing="0"  width="30%">
                                                               Otro 
                                                          </td>

                                                          <td style='border: 1px solid #dddddd;' cellspacing="0"  width="30%">
                                                             $ {{$reporte->ofrendas()->where('tipo_ofrenda',6)->sum('valor')}}

                                                          </td>
                                                         
                                                      </tr>
                                                      <tr>
                                                          
                                                          
                                                          <td style='border: 1px solid #dddddd;' cellspacing="0"  width="30%">
                                                               Primicias 
                                                          </td>

                                                          <td style='border: 1px solid #dddddd;' cellspacing="0"  width="30%">
                                                             $ {{$reporte->ofrendas()->where('tipo_ofrenda',5)->sum('valor')}}

                                                          </td>

                                                              <td style='border: 1px solid #dddddd;' cellspacing="0"  width="30%">
                                                               Ofrendas sueltas 
                                                          </td>

                                                          <td style='border: 1px solid #dddddd;' cellspacing="0"  width="30%">
                                                             $ {{$reporte->ofrendas()->where('tipo_ofrenda',7)->sum('valor')}}
                                                          </td>    
                                                                                                                     
                                                     </tr>

                                                       <tr>
                                                          <td style='border: 1px solid #dddddd;' cellspacing="0"  width="30%">
                                                              <b>TOTAL</b>
                                                          </td>
                                                            <td>
                                                           </td>
                                                           <td>
                                                           </td>
                                                      
                                                          <td style='border: 1px solid #dddddd;' cellspacing="0"  width="30%">
                                                             $ {{$reporte->ofrendas->sum('valor')}}
                                                          </td>
                                                        </tr>
                                                  </tbody>
                                                  
                                              </table>
<br> 
       LISTADO DE ASISTENTES PARA EL REPORTE ACTUAL
      <table  style='border: 1px solid #dddddd;' cellspacing=0 cellpadding=4 bordercolor='#aaa' width="100%" >
        <thead>
            <tr>
                <th style='border: 1px solid #dddddd;' cellspacing="0"  width="30%">
                    Nombre Asistente
                </th>  
                <th style='border: 1px solid #dddddd;' cellspacing="0"  width="30%">
                    Información financiera
                </th>  
                <th style='border: 1px solid #dddddd;' cellspacing="0"  width="30%">
                    Asistencia
                </th>
              
           </tr>
        </thead>
        <tbody style='border: 1px solid #dddddd;' cellspacing=0 cellpadding=1 bordercolor='#aaa'  >
            @foreach($reporte->asistentes as $integrante)

                     
                        <tr>
                                                                              
                          <td style='border: 1px solid #dddddd;' cellspacing="0"  width="70%">
                             Cod-{{ $integrante->id }}-
                         {{ $integrante->nombre.' '.$integrante->apellido }}                                                                                
                          </td>
                          
                          <td style='border: 1px solid #dddddd;' cellspacing="0"  width="10%" class= "text-center">
                             
                                  $  {{$reporte->ofrendas()->where('asistente_id',$integrante->id)->sum('valor')}} 
                                   
                                   
                                                                                                                                            
                          </td>
                          
                          <td style='border: 1px solid #dddddd;' cellspacing="0"  width="10%" class="texte-center">
                               
                                  <!-- /asitio SI NO -->
                                   @if($integrante->pivot->asistio=="1")    
                                                  
                                                     Si       
                                    @else ($integrante->pivot->asistio=="2") 
                                                        No   
                                    @endif     
                                  
                                  <!-- /asitio SI NO -->

                          </td>
                        
                          
                        
                          @endforeach

        </tbody>
    </table>


</body>
</html>
@endif