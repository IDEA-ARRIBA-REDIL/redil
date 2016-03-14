@if(Auth::check())
@include('includes.lenguaje')
<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
    <style type="text/css">
      

      .shadow {
      box-shadow: rgba(220,220,220,.65) 3px 3px 10px 5px inset;
      }


      .centrar-text{
        text-align: center;
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
                <tbody class="shadow">
                  <tr>
                    <td valign="top" align="center" style="text-align:center;background-color:#f39c12;border-top-left-radius:8px;border-top-right-radius:8px;padding:16px;text-align:center">
                      <img src="http://www.redil.co/img-correos/logo-xs.png" align="middle" alt="Redil"  style="font-weight:bold;font-size:18px;color:#fff;vertical-align:top" >
                    </td>
                  </tr>
                  <tr>
                    <td valign="top" align="left" style="border-bottom-left-radius:4px;border-bottom-right-radius:4px;background:#ffffff;padding:10px 20px 20px 20px">
                      <div style="margin-bottom:15px">
                        <br><br>
                        <center><p style="font:15px/1.25em 'Century Gothic',Arial,Helvetica;color:#939393"> <b> IDEA ENVIADA POR: </b> <br> {{$nombre}} {{$apellido}} de la iglesia {{$iglesia_nombre}} <br> {{$iglesia_ciudad}} - {{$iglesia_pais}} </p></center>  
                        <p style="font:15px/1.25em 'Century Gothic',Arial,Helvetica;color:#939393"> <b> LA IDEA ES: </b> {{$mensaje}} </p>                                            
                        <br>
                        <p  class="centrar-text" style="font:15px/1.25em 'Century Gothic',Arial,Helvetica;color:#939393"><b></b></p>                       
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



@endif