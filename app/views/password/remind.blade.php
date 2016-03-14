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

        <div class="col-md-12 bg-blue-dark">
            <div class=" box-header">
                <br>
                <a href="/" class="btn bg-red pull-right"> <i class="fa fa-user">  </i>  Acceder  </a>
                
            </div>
        </div>

        <div class="form-box" id="login-box">
            <br>
            <div class="bg-light-redil"><img src="/img/log_peque.png" class="img-responsive center-block" /></div>
                    

            <form action="{{ action('RemindersController@postRemind') }}" method="POST">
                <div class="header bg-light-redil">
                    <h3><b>¿OLVIDASTE TU CONTRASEÑA?</b></h3>
                    <h5 class="text-center">Por favor, ingresa tu <b> correo electronico </b> y recibirás un mensaje que te permitirá restablecer tu contraseña. </h5>
                </div>


                @if(Session::has('error'))
             
                <div class="alert alert-danger alert-dismissable" style="margin-bottom: -20px; margin-left: 18px; margin-right: 18px;margin-top: 10px;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b class="text-center"> El correo esta mal escrito o no corresponde a un usuario</b>, por favor verifique e intente nuevamente.  
                </div>
                @endif

                @if(Session::has('status'))
                 
                <div class="alert alert-success alert-dismissable" style="margin-bottom: -20px; margin-left: 18px; margin-right: 18px;margin-top: 10px;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b> Revista tu correo </b>, ya te enviamos las instrucciones para reiniciar tu contraseña. 
                </div>
                @endif   

                <div class="body bg-gray bg-light-redil">
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="{{ Lang::get( 'login.email' )}}" required/>
                    </div>
                    <button type="submit" class="btn bg-red btn-block">Enviar</button> 
                </div>
            </form>
            
        </div>


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="/js/bootstrap.min.js" type="text/javascript"></script>        

    </body>
</html>