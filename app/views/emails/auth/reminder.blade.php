
@include('includes.lenguaje')
<!DOCTYPE html>

<html >
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
	<body style="background: #f2f2f2">
   
      <table  bgcolor="#eef0f1;" style="background:#f2f2f2;color: #EEF0F1;font:15px/1.25em 'Century Gothic',Arial,Helvetica" border="0" cellpadding="0" cellspacing="0" align="center" width="100%">
        <tbody>
          <tr>
            <td align="center">
              <br>
              <table border="0" cellpadding="0" cellspacing="0" align="center" style="width:500px;margin:0 auto;background-color:#f2f2f2">
                <tbody style="box-shadow: rgba(220,220,220,.65) 3px 3px 10px 5px inset;">
                  <tr>
                    <td valign="top" align="center" style="text-align:center;background-color:#008e9c;border-top-left-radius:8px;border-top-right-radius:8px;padding:16px;text-align:center">
                      <img src="http://www.redil.co/img-correos/logo-xs.png" align="middle" alt="Debitoor"  style="font-weight:bold;font-size:18px;color:#fff;vertical-align:top" >
                    </td>
                  </tr>
                  <tr>
                    <td valign="top" align="left" style="border-bottom-left-radius:4px;border-bottom-right-radius:4px;background:#ffffff;padding:10px 20px 20px 20px">
                      <div style="margin-bottom:15px">
                        <br><br>
                        <?php
                        	$email= implode ( "," , Input::only('email'));
                        	$usuario= User::where('email','=', $email)->first();
                        ?>
                        <p style="font:15px/1.25em 'Century Gothic',Arial,Helvetica;color:#939393"> ¡ Hola ! <b> {{$usuario->asistente->nombre}} {{$usuario->asistente->apellido}} </b> </p>
                        <p style="font:15px/1.25em 'Century Gothic',Arial,Helvetica;color:#939393"> Has solicitado el restablecimiento de su contraseña, haz clic en el siguiente boton para continuar con el proceso. </p>
                        <br> <br>   	
                       	<center><a href="{{ URL::to('password/reset', array($token)) }}" style= "-webkit-border-radius: 10; -moz-border-radius: 10; border-radius: 10px; font-family: 'Century Gothic', Arial; color: #ffffff; font-size: 14px; background: #f56954; padding: 10px 20px 10px 20px; text-decoration: none;" target="_blank">
          					Restablecer contraseña
				        </a></center>
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


	