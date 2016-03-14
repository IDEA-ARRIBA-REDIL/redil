                <!-- sidebar menu: : style can be found in sidebar.less -->
                <?php $asistente=""; ?>
                    @if(Auth::user()->id==1)
                    <?php $foto='iglesia/logo-iglesia-1.jpg';?>
                    @else
                    <?php 
                    $asistente=Auth::user()->asistente;
                    $foto="fotos/".$asistente->foto; ?>
                    @endif
                @if(Auth::user()->id!=1)
                <a href="/asistentes/perfil/{{$asistente->id}}">@endif
                    <div class="user-panel">
                    

                        <div class="pull-left image">
                          <img style="border: none!important;" src="/img/{{$foto}}" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p class="capitalize puntos">
                                @if(Auth::user()->id==1)
                                    Administrador
                                @else
                                    {{Auth::user()->asistente->nombre}}
                                @endif 
                            </p>
                            @if(Auth::user()->id==1)
                                    <label class="label arrowed-right" style="background-color: #00A65A;"> <i class="fa fa-key"></i> Super Administrador</label> 
                            @else
                                <label class="label arrowed-right bg-light-redil">Cod. {{ Auth::user()->asistente->id }}</label>
                                @if ($asistente->tipoAsistente['id']==5)
                                    <label class="label arrowed-right" style="background-color: purple;"> <i class="fa fa-book"></i> {{ $asistente->tipoAsistente['nombre'] }}</label> 
                                @elseif($asistente->tipoAsistente['id']==3)
                                    <label class="label arrowed-right bg-blue"><i class="fa fa-child"></i> {{ $asistente->tipoAsistente['nombre'] }}</label> 
                                @elseif($asistente->tipoAsistente['id']==4)
                                    <label class="label arrowed-right bg-orange"><i class="fa fa-star-o"></i> {{ $asistente->tipoAsistente['nombre'] }}</label> 
                                @elseif($asistente->tipoAsistente['id']==2)
                                    <label class="label arrowed-right bg-aqua"><i class="fa fa-group"></i> {{ $asistente->tipoAsistente['nombre'] }}</label> 
                                @elseif($asistente->tipoAsistente['id']==1)
                                    <label class="label arrowed-right bg-teal"><i class="fa fa-heart"></i> {{ $asistente->tipoAsistente['nombre'] }}</label> 
                                @endif 
                            @endif
                          <!--<a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
                        </div>
                    </div>
                @if(Auth::user()->id!=1)
                </a>@endif

                    <ul class="sidebar-menu">
                        <li class="header">MENU</li>
                        <li>
                            <a href="/inicio">
                                <i class="fa fa-th"></i> <span> {{ Lang::get('menu.inicio') }} </span>
                            </a>
                        </li>
                        <li id="menu_asistentes" class="treeview">
                            <a href="#">
                                <i class="fa fa-users"></i>
                                <?php 
                                if(Auth::user()->id!=1)
                                {
                                    $asistente=Auth::user()->asistente;
                                }
                                ?>
                                    <span>{{ Lang::get('menu.asistentes') }} <small id="prueba" class="badge pull-right bg-red">@if(Auth::user()->id==1){{ Asistente::all()->count();}} @else {{ $asistente->discipulos()->count() }} @endif</small></span> 
                                <i id="flecha_asistente" class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul id="submenu_asistentes" class="treeview-menu">
                                <li><a href="/asistentes"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.lista_asistentes') }}</a></li>
                                <li><a href="/asistentes/nuevo"><i class="fa fa-angle-double-right"></i> {{Lang::get('menu.nuevo_asistente')}}</a></li>
                                <!--<li><a href="/visitas"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.lista_visitas') }}</a></li>
                                <li><a href="/visitas/nuevo"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.nueva_visita') }}</a></li>-->
                            </ul>
                        </li>
                        <li id="menu_grupos" class="treeview">
                            <a href="#">
                                <i class="fa fa-share-alt"></i>
                                <span>{{ Lang::get('menu.grupos') }} <small class="badge pull-right bg-red">@if(Auth::user()->id==1){{ Grupo::where('dado_baja', '=', '0')->count();}} @else {{ $asistente->gruposMinisterio()->count() }}@endif </small></span>
                                <i id="flecha_grupos" class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul id="submenu_grupos" class="treeview-menu">
                                <li><a href="/grupos"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.lista_grupos') }}</a></li>
                                <?php 
                                $lineas=0;
                                    if(isset(Auth::user()->asistente))
                                        $lineas=Auth::user()->asistente->lineas()->count();
                                ?>
                                @if($lineas > 0 || Auth::user()->id==1)
                                <li><a href="/grupos/nuevo"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.nuevo_grupo') }}</a></li>
                                @endif
                                <li><a href="/reporte-grupos"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.lista_reportes_grupo') }}</a></li>
                                <li><a href="/reporte-grupos/nuevo"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.reportar_grupo') }}</a></li>
                                <li><a href="/grupos/informes"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.informes_grupo') }}</a></li>
                                <li><a href="/grupos/mapa"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.mapa_grupos') }}</a></li>
                            </ul>
                        <?php 
                        if(Auth::user()->id!=1)
                            $iglesia_enc= Auth::user()->asistente->iglesiaEncargada()->count(); 
                        ?>
                        
                        </li>
                            <li id="menu_reuniones" class="treeview">
                            <a href="#">
                                <i class="fa fa-home"></i>
                                <span>{{ Lang::get('menu.reuniones') }}<small class="badge pull-right bg-red">{{ Reunion::where('dado_baja', '=', '0')->count() }}</small></span>
                                <i id="flecha_reuniones" class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul id="submenu_reuniones" class="treeview-menu">
                                <li><a href="/reuniones"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.lista_reuniones') }}</a></li>
                                @if(Auth::user()->id==1)
                                <li><a href="/reuniones/nuevo"><i class="fa fa-angle-double-right"></i>  {{ Lang::get('menu.nueva_reunion') }}</a></li>@endif
                                <li><a href="/reporte-reuniones"><i class="fa fa-angle-double-right"></i> Listado de Reportes</a></li>
                                 @if(Auth::user()->id==1)
                                <li><a href="/reporte-reuniones/nuevo"><i class="fa fa-angle-double-right"></i> Nuevo Reporte</a></li>
                                @endif
                                <li><a href="/reuniones/informes"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.informes_reuniones') }}</a></li>
                            </ul>
                        </li>

                        @if($lineas > 0 || Auth::user()->id==1 || $iglesia_enc>0)
                        <li id="menu_lineas" class="treeview">
                            <a href="#">
                                <i class="fa fa-code-fork"></i>
                                <span>{{ Lang::get('menu.lineas') }} <small class="badge pull-right bg-red">@if(Auth::user()->id==1 || $iglesia_enc>0){{ Linea::all()->count() }} @else {{ Auth::user()->asistente->lineas->count() }} @endif</small></span>
                                <i id="flecha_lineas" class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul id="submenu_lineas" class="treeview-menu">
                                <li><a href="/lineas"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.lista_lineas') }}</a></li>
                                @if(Auth::user()->id==1)
                                <li><a href="/lineas/nuevo"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.nueva_linea') }}</a></li>
                                @endif
                           </ul>
                        </li>
                        @endif
                        
                        <li id ="menu_ofrendas" class="treeview">
                            <a href="#">
                                <i class="fa fa-money"></i>
                                <span>{{ Lang::get('menu.ingresos') }} </span>
                                <i id="flecha_ofrendas" class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul id="submenu_ofrendas" class="treeview-menu">
                                <li><a href="/ofrendas" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.lista_ingresos') }}</a></li>
                                 @if(Auth::user()->id==1)
                                <li><a href="/ofrendas/nuevo" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.nuevo_ingreso') }}</a></li>
                                @endif
                            </ul>
                        </li>
                        <?php

                        /*
                        <li id="menu_escuelas" class="treeview">
                            <a href="#">
                                <i class="fa fa-graduation-cap"></i>
                                <span>{{ Lang::get('menu.escuelas') }} <small class="badge pull-right bg-red">{{ Escuela::all()->count();}} </small></span>
                                <i id="flecha_escuelas" class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul id="submenu_escuelas" class="treeview-menu">
                                <li><a href="/escuelas"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.lista_escuelas') }}</a></li>
                                <li><a href="/escuelas/nuevo"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.nueva_escuela') }}</a></li>
                                <li><a href="/finanzas"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.lista_cursos') }}</a></li>
                                <li><a href="/finanzas"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.lista_periodos') }}</a></li>
                                <li><a href="formulario_financiero.html"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.nuevo_periodo') }}</a></li>
                                <li><a href="/finanzas"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.lista_calificaciones') }}</a></li>
                                <li><a href="/finanzas"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.asignar_calificaciones') }}</a></li>
                                <li><a href="/finanzas"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.lista_estudiantes') }}</a></li>
                            </ul>
                        </li>
                        
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-institution"></i>
                                <span>{{ Lang::get('menu.reuniones') }} </span>
                                <i id="flecha_reuniones" class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="/reporte-reuniones/index"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.lista_reuniones') }}</a></li>
                                <li><a href="/reporte-reuniones/nuevo"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.nuevo_reporte') }} </a></li>
                               
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-cubes"></i>
                                <span> {{ Lang::get('menu.departamentos') }}</span>
                                <i id="flecha_departamentos" class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="/departamentos/lista"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.lista_departamentos') }}</a></li>
                                <li><a href="/departamentos/nuevo"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.nuevo_departamento') }}</a></li>
                            </ul>
                        </li>
                        
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-money"></i>
                                <span>{{ Lang::get('menu.finanzas') }} </span>
                                <i id="flecha_finanzas" class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="/finanzas"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.lista_ingresos') }}</a></li>
                                <li><a href="/finanzas/nuevo"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.nuevo_ingreso') }}</a></li>
                            </ul>
                        </li>

                        <li id="menu_escuelas" class="treeview">
                            <a href="#">
                                <i class="fa fa-graduation-cap"></i>
                                <span>{{ Lang::get('menu.escuelas') }} </span>
                                <i id="flecha_escuelas" class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul id="submenu_escuelas" class="treeview-menu">
                                <li><a href="/escuelas"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.lista_escuelas') }}</a></li>
                                <li><a href="/escuelas/nuevo"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.nueva_escuela') }}</a></li>
                                <li><a href="/finanzas"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.lista_cursos') }}</a></li>
                                <li><a href="formulario_financiero.html"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.nuevo_curso') }}</a></li>
                                <li><a href="/finanzas"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.lista_periodos') }}</a></li>
                                <li><a href="formulario_financiero.html"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.nuevo_periodo') }}</a></li>
                                <li><a href="/finanzas"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.lista_matriculas') }}</a></li>
                                <li><a href="formulario_financiero.html"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.nueva_matricula') }}</a></li>
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-calendar"></i>
                                <span>{{ Lang::get('menu.eventos') }} </span>
                                <i id="flecha_eventos" class="fa fa-angle-left pull-right"></i>
                            </a>
                          
                            <ul id="submenu_eventos" class="treeview-menu">
                                <li><a href="/grupos"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.lista_eventos') }}</a></li>
                                <li><a href="/grupos/nuevo"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.nuevo_eventos') }}</a></li>
                             </ul>
                        </li>

                        <li class="treeview">

                            <a href="#">
                                <i class="fa fa-bar-chart-o"></i>
                                <span>{{ Lang::get('menu.estadisticas') }} <small class="badge pull-right bg-red">12</small></span>
                                <i id="flecha_estadisticas" class="fa fa-angle-left pull-right"></i>
                            </a>
                        
                            <ul id "submenu_estadisticas" class="treeview-menu">
                                <li><a href="/asistentes/estadisticas"><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.estadisticas_generales') }}</a></li>
                                <li><a href=""><i class="fa fa-angle-double-right"></i> {{ Lang::get('menu.estadisticas_especificas') }}</a></li>
                            </ul>
                        </li>
                        */
                        ?>
                        <li>
                             <a href="/tutoriales">
                                <i class="fa fa-video-camera"></i>
                                <span> Tutoriales </span>
                             </a>
                        </li>
                        <li>
                             <a href="/logout">
                                <i class="fa fa-sign-out"></i>
                                <span> {{ Lang::get('menu.cerrar') }}</span>
                             </a>
                        </li>
                       
                        
                    </ul>
                </section>
                <!-- /.sidebar -->