<!-- Header Navbar: style can be found in header.less -->
             <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="/inicio"  class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
               
                <img src="/img/log_peque2.png" style="height: 40px">
              
                

            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <i class="fa fa-navicon"> </i>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <?php
                        /*
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                <span class="label label-success">4</span>
                            </a>
                            
                            <ul class="dropdown-menu">

                                <li class="header">Tu tienes 3 mensajes</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">

                                        <li><!-- start message -->
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="/img/avatar3.png" class="img-circle" alt="User Image"/>
                                                </div>
                                                <h4>
                                                    Si hay Reunion de lideres
                                                    <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                </h4>
                                                <p>Les informo que que este viernes si hay reunion.</p>
                                            </a>
                                        </li><!-- end message -->
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="/img/avatar2.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    Culto del domingo
                                                    <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                                </h4>
                                                <p>Este domingo el culto sera a las 10:00 pm</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="/img/avatar.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    Ultimo encuentro
                                                    <small><i class="fa fa-clock-o"></i> Today</small>
                                                </h4>
                                                <p>Este 23, 24 y 25 de agosto sera el ultimo encuentro del año.</p>
                                            </a>
                                        </li>
                                        
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">Ver todos los mensajes</a></li>
                            </ul>
                        </li>
                   */

                        ?>     
                        <?php
                            $user=Auth::user();
                            $notif=$user->notificaciones()->where('estado', '0')->get();//esta es para cambiar el estado de las notificaciones que llegaron mientras estaba conectado por ajax
                            foreach($notif as $not)
                            {
                                $not->estado=1;
                                $not->save();
                            }

                            $cant_notif=$user->notificaciones()->where('estado', '1')->count(array('id'));
                            $cant_notif_no_revisadas=$user->notificaciones(array('id'))->where('estado', '<', '3')->count();
                            $notificaciones=$user->notificaciones()
                                ->orderBy("fecha", 'desc')
                                ->take(10)
                                ->get();
                        ?>
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="btn-notificaciones">
                                <i class="fa fa-bell-o"></i>

                                <span id="cant-notificaciones" class="label label-success" @if($cant_notif<=0) style="display:none;" @endif data-cant="{{ $cant_notif }}">{{ $cant_notif }}</span>
                                
                            </a>
                            
                            <ul class="panel-notificaciones-ppl dropdown-menu " >
                                
                                <li class="header" id="header-notificaciones">Tienes <span id="header-cant-notif" class="label label-info">{{ $cant_notif_no_revisadas }}</span> notificaciones sin revisar</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu" id="panel-notificaciones">
                                        @foreach($notificaciones as $notificacion)
                                        <li id="li-{{ $notificacion->id }}" class="@if($notificacion->estado==1 || $notificacion->estado==2)item-notif @else item-notif-revisada @endif"><!-- start message -->
                                            <a id="notificacion-{{ $notificacion->id }}" class="item-notificacion" data-estado="{{ $notificacion->estado }}" data-id="{{ $notificacion->id }}" href="{{$notificacion->url}}">
                                                <div class="pull-left">
                                                    
                                                    @if($notificacion->asistente_id==0)
                                                    <?php $foto='iglesia/logo-iglesia-1.jpg';?>
                                                    @else
                                                    <?php $foto="fotos/".$notificacion->asistente->foto ?>
                                                    @endif
                                                    {{"<img src='/img/".$foto."' class='img-circle' alt='User Image' />"}}
                                                </div>
                                                <h4>
                                                    {{ $notificacion->nombre }}
                                                    <small><i class="fa fa-clock-o"></i> Hace {{ $notificacion->tiempoTranscurrido() }} </small>
                                                </h4>
                                                <p>{{ $notificacion->descripcion }}</p>
                                            </a>
                                        </li><!-- end message -->
                                        @endforeach
                                    </ul>
                                </li>

                                <li class="footer"><a href="#">Ver todos las notificaciones</a></li>
                            </ul>
                        </li>

                        
                        
                        <li class="dropdown user user-menu">
                            @if(Auth::user()->id==1)
                            <?php $foto="iglesia/".Iglesia::find(1)->logo;?>
                            @else
                            <?php $foto="fotos/".Auth::user()->asistente->foto; ?>
                            @endif
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                              <img src='/img/{{$foto}}' class="user-image" alt="User Image">
                              <span class="hidden-xs">
                                @if(Auth::user()->id==1)
                                    Administrador
                                @else
                                    {{Auth::user()->asistente->nombre}}
                                @endif 
                              </span>
                            </a>
                            <ul class="dropdown-menu">
                              <!-- User image -->
                              <li class="user-header bg-light-redil">
                                <img src='/img/{{$foto}}' class="img-circle" alt="User Image">
                                <p class="puntos">
                                    @if(Auth::user()->id==1)
                                        Super Administrador
                                    @else
                                        {{Auth::user()->asistente->nombre." ".Auth::user()->asistente->apellido}}
                                    
                                    <?php $fecha_ingreso=date_create(Auth::user()->asistente->fecha_ingreso); ?>
                                    @if(Auth::user()->asistente->fecha_ingreso!="")<small>Asiste desde {{ date_format($fecha_ingreso, 'd-M-Y') }}</small>@endif
                                    @endif
                                </p>
                              </li>
                              <!-- Menu Body -->
                              <li class="user-body">
                                <div class="col-xs-6 text-center">
                                  <a href="/asistentes">Asistentes</a>
                                </div>
                                <!--<div class="col-xs-4 text-center">
                                  <a href="#">Sales</a>
                                </div>-->
                                <div class="col-xs-6 text-center">
                                  <a href="/grupos">Grupos</a>
                                </div>
                              </li>
                              <!-- Menu Footer-->
                              <li class="user-footer">
                                @if(Auth::user()->id!=1)
                                    <div class="pull-left">  
                                        <a href="/asistentes/perfil/{{ Auth::user()->asistente->id }}" class="btn btn-default btn-flat">Ver perfil</a>
                                    </div>
                                @endif                                    
                                <div class="pull-right">
                                    <a href="/logout" class="btn btn-default btn-flat">
                                        <i class="fa fa-sign-out"></i>
                                           Cerrar sesión 
                                    </a>
                                </div>
                              </li>
                            </ul>
                        </li>
                            <!-- menu de configuraciones -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-gears"></i>
                                <!--<span class="label label-danger">9</span> -->
                            </a>
                            <ul class="dropdown-menu">

                                <li class="header"></li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li><!-- Task item -->
                                            @if(Auth::user()->id==1)
                                            <a href="/iglesia">
                                                    <i class="fa fa-institution" ></i> <span style="font-size: 14px">Configurar datos de iglesia</span>
                                                    <!--<small class="pull-right">20%</small> -->
                                                <!--<div class="progress xs">
                                                    <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">20% Complete</span>
                                                    </div>
                                                </div> -->
                                            </a>

                                            @else
                                            <a href="/asistentes/actualizar/{{ Auth::user()->asistente->id }}">
                                                <i class="bg-aqua fa fa-user" ></i> <span style="font-size: 14px">Editar mi Información</span>
                                                    <!--<small class="pull-right">20%</small> -->
                                                <!--<div class="progress xs">
                                                    <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">20% Complete</span>
                                                    </div>
                                                </div> -->
                                            </a>
                                                                                       
                                            @endif

                                            <a href="/usuarios/actualizar-password">
                                                <i class="bg-yellow fa fa-unlock-alt  " ></i> <span style="font-size: 14px">Cambiar mi contraseña</span>
                                                    <!--<small class="pull-right">20%</small> -->
                                                <!--<div class="progress xs">
                                                    <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">20% Complete</span>
                                                    </div>
                                                </div> -->
                                            </a>  

                                        </li><!-- end task item -->
                                        <!-- end task item -->
                                    </ul>
                                </li>

                                 
                                <li class="footer">
                                    <a href="#"></a>
                                </li>
                                
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="col-lg-10">
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-8" id="panel-avisa-notificacion">
                <!-- Info box -->
                <div class="box box-solid bg-aqua" id="avisa-notificacion">
                    <div class="box-header">
                        <h3 style="font-size: 16px!important;" class="box-title">Nueva Notificacion</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-info btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div id="body-avisa-notif" class="box-body item">
                        
                    </div><!-- /.box-body -->
                    
                </div><!-- /.box -->
            </div><!-- /.col -->
            </div>
            </header>
            