@include('includes.lenguaje')
<!DOCTYPE html>
<html class="bg-light-redil">
    <head>
        <meta charset="UTF-8">
        <title>Redil | Login</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-light-redil">

        <div class="form-box" id="login-box">
            <div class="bg-light-redil"><img src="img/log_peque.png" class="img-responsive center-block" /></div>
            @if(Session::has('login_errors'))
             
            <div class="alert alert-warning alert-dismissable" style="margin-bottom: -20px; margin-left: 18px!important; margin-right: 18px;margin-top: 10px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <b>{{ Lang::get( 'login.mensaje_error_titulo' )}}</b> {{ Lang::get( 'login.mensaje_error' )}}
            </div>
            @endif

            @if(Session::has('repassword_ok'))
             
            <div class="alert alert-success alert-dismissable" style="margin-bottom: -20px; margin-left: 18px; margin-right: 18px;margin-top: 10px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Ya puedes ingresar con tu <b> nueva contraseña </b>. 
            </div>
            @endif

            <form action="login" method="post">
                <div class="body bg-gray bg-light-redil">
                    <div class="form-group">
                        <input autofocus type="email" name="username" id="username" class="form-control" placeholder="{{ Lang::get( 'login.email' )}}" required/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" class="form-control" placeholder="{{ Lang::get( 'login.password' )}}" required/>
                    </div>          
                    <div class="form-group">
                        <input type="checkbox" name="remember_me"/> {{ Lang::get( 'login.no_cerrar' )}}
                    </div>
                </div>
                <div class="footer bg-light-redil">                                                               
                    <button type="submit" class="btn bg-red btn-block">{{ Lang::get( 'login.ingresar' )}}</button>  
                    <a href="password/remind" class="text-teal">{{ Lang::get( 'login.olvide' )}}</a>
                </div>
            </form>

            <div class="margin text-center">
                <span>{{ Lang::get( 'login.redes' )}}</span>
                <br/>
                <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
                <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
                <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>

            </div>
        </div>


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>        

    </body>
</html>