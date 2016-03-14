@include('includes.lenguaje')
<!DOCTYPE html>
<html class="bg-light-redil">
    <head>
        <meta charset="UTF-8">
        <title>Redil | Restablecer contraseña</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="/css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-light-redil">

        <div class="form-box" id="login-box">
            <div class="bg-light-redil"><img src="/img/log_peque.png" class="img-responsive center-block" /></div>
            


            <form action="{{ action('RemindersController@postReset') }}" method="POST">
                <div class="header bg-light-redil">
                    <h3><b>RESTABLECIMIENTO DE CONTRASEÑA</b></h3>
                    <h5 class="text-center">Por favor, llene el siguiente formulario con su correo y la nueva contraseña.</h5>
                </div>

                @if(Session::has('error'))             
                <div class="alert alert-danger alert-dismissable" style="margin-bottom: -20px; margin-left: 18px; margin-right: 18px;margin-top: 10px;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b class="text-center"> El correo esta mal escrito, o las contraseñas no coinciden</b>, por favor verifique e intente nuevamente.  
                </div>
                @endif 
                <br> <br> 

                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group">
                    <input type="email" class="form-control" name="email"  placeholder="{{ Lang::get( 'login.email' )}}"  required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password"  placeholder="Nueva contraseña" required pattern="(?=.*\d)(?=.*[A-Za-z]).{5,}" title="La contraseña debe contener como minimo 5 caracteres alfanumericos, es decir, debe contener como minimo letras y numeros.">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirmar contraseña" required>
                </div>
                <button type="submit" class="btn bg-red btn-block">Cambiar contraseña</button>
                
            </form>
            
        </div>


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="/js/bootstrap.min.js" type="text/javascript"></script>        

    </body>
</html>