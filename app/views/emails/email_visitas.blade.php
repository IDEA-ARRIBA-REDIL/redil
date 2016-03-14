
@include('includes.lenguaje')
<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
     <style type="text/css">
      

      .shadow {
      
      }


      .centrar-text{
        text-align: center;
      }

      .btn {
      -webkit-border-radius: 10;
      -moz-border-radius: 10;
      border-radius: 10px;
      font-family: 'Century Gothic', Arial;
      color: #ffffff;
      font-size: 28px;
      background: #f56954;
      padding: 10px 20px 10px 20px;
      text-decoration: none;
    }

    .btn:hover {
      background: #db5948;
      text-decoration: none;
    }

    </style>
	</head>
  <body style="background: #f2f2f2;">
  <table  bgcolor="#eef0f1;" style="background:#f2f2f2;color: #EEF0F1;font:15px/1.25em 'Century Gothic',Arial,Helvetica" border="0" cellpadding="0" cellspacing="0" align="center" width="100%">
        <tbody>
          <tr>
            <td align="center">
              <br>
              <table border="0" cellpadding="0" cellspacing="0" align="center" style="width:500px;margin:0 auto;background-color:#f2f2f2">
                <tbody style="box-shadow: rgba(220,220,220,.65) 3px 3px 10px 5px inset;">
                  <tr>
                    <td valign="top" align="center" style="text-align:center;background-color:#008e9c;border-top-left-radius:8px;border-top-right-radius:8px;padding:16px;text-align:center">
                      <img src="http://www.redil.co/img-correos/logo-xs.png" align="middle" alt="Redil"  style="font-weight:bold;font-size:18px;color:#fff;vertical-align:top" >
                    </td>
                  </tr>
                  <tr>
                    <td valign="top" align="left" style="border-bottom-left-radius:4px;border-bottom-right-radius:4px;background:#ffffff;padding:10px 20px 20px 20px">
                      <div style="margin-bottom:15px">
                        <br><br>                       
                        <p style="font:15px/1.25em 'Century Gothic',Arial,Helvetica;color:#939393"> ¡ Hola !  </p>
                        <p style=" font-weight:bold; font:15px/1.25em 'Century Gothic',Arial,Helvetica;color:#939393">te ha sido asignado una visita para tu discipulo </p>  
                        <br> <br>  
                        <table  bgcolor="#eef0f1;" style=" font-weight:bold;background:#f2f2f2;color: #EEF0F1;font:15px/1.25em 'Century Gothic',Arial,Helvetica" border="1" bordercolor="#fff"cellpadding="5" cellspacing="0" align="center" width="100%">
                        <thead style=" background:#f56954; box-shadow: rgba(220,220,220,.65) 3px 3px 10px 5px inset;">
                  <th> <p align="center"  style="font-weight:bolder;font:15px/1.25em 'Century Gothic',Arial,Helvetica;color:#FFFFFF"><b>VISITA</b></p> </th>
                                     
                  <th>  <p align="center"  style="f;font:15px/1.25em 'Century Gothic',Arial,Helvetica;color:#FFFFFF"><b>DATOS</b> </p> </th>
                                      
             </thead>
            <tbody  style="box-shadow: rgba(220,220,220,.65) 3px 3px 10px 5px inset;">
               <tr>
                  <td>
                     <p  align="center"  style="font-weight:bold;font:15px/1.25em 'Century Gothic',Arial,Helvetica;color:#394545"> Nombre</p>
                  </td>
                  <td>
                     <p  align="center" style=" font-weight:bold; font:15px/1.25em 'Century Gothic',Arial,Helvetica;color:#394545"> {{$nombre}} {{$apellido}} </p>
                  </td>
               </tr>
               <tr>
                  <td>
                     <p  align="center"  style="font-weight:bold;font:15px/1.25em 'Century Gothic',Arial,Helvetica;color:#394545"> Tipo de Visita </p>
                  </td>
                  <td>
                     <p  align="center" style=" font-weight:bold; font:15px/1.25em 'Century Gothic',Arial,Helvetica;color:#394545"> <?php if($tipo=0){ echo'Telefonica';}
                                                                                                                                        elseif ($tipo=1){ echo'Presencial';} ?>  </p>
                  </td>
               </tr>
               <tr>
                  <td>
                     <p  align="center"  style="font-weight:bold;font:15px/1.25em 'Century Gothic',Arial,Helvetica;color:#394545"> Estado de Visita </p>
                  </td>
                  <td>
                     <p  align="center" style=" font-weight:bold; font:15px/1.25em 'Century Gothic',Arial,Helvetica;color:#394545">  <?php if($estado=0){ echo'Programada';}
                                                                                                                                        elseif ($estado=1){ echo'Realizada';}
                                                                                                                                        elseif ($estado=2) {echo'No Realizada';} ?>  </p>
                  </td>
               </tr>
               <tr>
                  <td>
                     <p  align="left"  style="font-weight:bold;font:15px/1.25em 'Century Gothic',Arial,Helvetica;color:#394545"> Fecha limite de visita </p>
                  </td>
                  <td>
                     <p  align="left" style=" font-weight:bold; font:15px/1.25em 'Century Gothic',Arial,Helvetica;color:#394545">  {{$fecha_limite}}  </p>
                  </td>
               </tr>
                <tr>
                  <td>
                     <p  align="left"  style="font-weight:bold;font:15px/1.25em 'Century Gothic',Arial,Helvetica;color:#394545">Fecha visita </p>
                  </td>
                  <td>
                     <p  align="left" style=" font-weight:bold; font:15px/1.25em 'Century Gothic',Arial,Helvetica;color:#394545">  {{$fecha}}  </p>
                  </td>
               </tr>
               <tr>
                  <td>
                     <p  align="left"  style="font-weight:bold;font:15px/1.25em 'Century Gothic',Arial,Helvetica;color:#394545"> Motivo de la visita</p>
                  </td>
                  <td>
                     <p  align="left" style=" font-weight:bold; font:15px/1.25em 'Century Gothic',Arial,Helvetica;color:#394545">  {{$motivo}}  </p>
                  </td>
               </tr>
               <tr>
                  <td>
                     <p  align="left"  style="font-weight:bold;font:15px/1.25em 'Century Gothic',Arial,Helvetica;color:#394545"> Hora de la visita </p>
                  </td>
                  <td>
                     <p  align="left" style=" font-weight:bold; font:15px/1.25em 'Century Gothic',Arial,Helvetica;color:#394545">  {{$hora}}  </p>
                  </td>
               </tr>
               <tr>
                  <td>
                     <p  align="left"  style="font-weight:bold;font:15px/1.25em 'Century Gothic',Arial,Helvetica;color:#394545"> Observaciones </p>
                  </td>
                  <td>
                     <p  align="left" style=" font-weight:bold; font:15px/1.25em 'Century Gothic',Arial,Helvetica;color:#394545">  {{$observacion}}  </p>
                  </td>
               </tr>
            </tbody>
      </table>
      <br> <br>
       
             
             
              <!-- datepicker boostrap--> 
              <div style="height:20px; width:500px; padding-bottom:5px;">                                       
                <label align="center"  style="font:15px/1.25em 'Century Gothic',Arial,Helvetica;color:#939393" title="aqui debes  poner la fecha en la cual fue realizada la visita" for="datepicker" class="control-label">Visita asignada al Lider <b> COD- {{$id_lider}} {{$nombre_lider}} {{$apellido_lider}} </b> </label>
              </div><!-- div que cierra el bootstrap date picker-->                 
               
                          
       </div>   


                        
                      </div>
                    </td>
                  </tr>
                  
                </tbody>
              </table>
            </td>
          </tr>
        </tbody>
      </table>
      
       <a href="http://WWW.REDIL.CO" style="text-decoration:none; " valign="top" align="center" >
         <p style="font:15px/2.25em 'Century Gothic',Arial,Helvetica;color:#939393; line-height: 90%"> REDIL - PASTOREO DE MULTITUDES <BR>  <b> WWW.REDIL.CO </b></p>
        </a>           		   
	</body>

</html>
