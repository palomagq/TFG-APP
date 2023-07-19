

    <a href="{{route('listarusuarios')}}" class="brand-link">
        <!--<img src="" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8;" />-->
        <span class="brand-text font-weight-light" style="margin-left:1em;">FitEnerGym</span>
    </a>

    <div class="sidebar">
       <!-- <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition">
            <div class="os-resize-observer-host observed"><div class="os-resize-observer" style="left: 0px; right: auto;"></div></div>
            <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;"><div class="os-resize-observer"></div></div>
            <div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 664px;"></div>
            <div class="os-padding">
                <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
                    <div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">-->

                        <nav class="mt-2" >
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            
                                @if(!Session::has('pagado'))
                                    @if(Session('idRole') == 1)

                                        <li 
                                        @if(session('active')=='Usuarios')
                                            class="nav-item menu-is-opening menu-open"
                                        @else
                                            class="nav-item"
                                        @endif>
                                            <a href="#" 
                                            @if(session('active')=='Usuarios')
                                                class="nav-link active"
                                            @else
                                                class="nav-link"
                                            @endif>
                                                <i class="nav-icon fa-solid fa-user"></i>
                                                <p>
                                                    Usuarios
                                                <i class="fas fa-angle-left right"></i>
                                                <!-- <span class="badge badge-info right">6</span>-->
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="nav-item">
                                                    <a href="{{route('listarusuarios')}}" 
                                                    @if(session('active')=='Usuarios')
                                                        class="nav-link active"
                                                    @else
                                                        class="nav-link"
                                                    @endif>
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Listado de Usuarios</p>
                                                    </a>
                                                </li>       
                                                
                                            </ul>
                                        </li>
                                    @endif

                                    @if((Session('idRole') == 1) || (Session('idRole') == 2))

                                        <li 
                                        @if(session('active')=='Jefes')
                                            class="nav-item menu-is-opening menu-open"
                                        @else
                                            class="nav-item"
                                        @endif>
                                            <a href="#" 
                                            @if(session('active')=='Jefes')
                                                class="nav-link active"
                                            @else
                                                class="nav-link"
                                            @endif>
                                            <i class="nav-icon fa-solid fa-user"></i>
                                                <p>
                                                    Jefes
                                                    <i class="right fas fa-angle-left"></i>
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview"> 
                                                <li class="nav-item">
                                                    <a href="{{route('jefes')}}" 
                                                    @if(session('active')=='Jefes')
                                                        class="nav-link active"
                                                    @else
                                                        class="nav-link"
                                                    @endif>
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Listado de Jefes</p>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    @endif
                    

                                    

                                    @if((Session('idRole') == 1) || (Session('idRole') == 2))

                                        <li 
                                        @if(session('active')=='Personal')
                                            class="nav-item menu-is-opening menu-open"
                                        @else
                                            class="nav-item"
                                        @endif>
                                            <a href="#" 
                                            @if(session('active')=='Personal')
                                                class="nav-link active"
                                            @else
                                                class="nav-link"
                                            @endif>
                                                <i class="nav-icon fa-solid fa-user"></i>
                                                <p>
                                                    Personal
                                                <i class="fas fa-angle-left right"></i>
                                                <!-- <span class="badge badge-info right">6</span>-->
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="nav-item">
                                                    <a href="{{route('personal')}}"
                                                    @if(session('active')=='Personal')
                                                        class="nav-link active"
                                                    @else
                                                        class="nav-link"
                                                    @endif>
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Listado de Personal</p>
                                                    </a>
                                                </li>       
                                                
                                            </ul>
                                        </li>
                                    @endif

                                    @if((Session('idRole') == 1) || (Session('idRole') == 2))

                                        <li 
                                        @if(session('active')=='Recepcion')
                                            class="nav-item menu-is-opening menu-open"
                                        @else
                                            class="nav-item"
                                        @endif>
                                            <a href="#" 
                                            @if(session('active')=='Recepcion')
                                                class="nav-link active"
                                            @else
                                                class="nav-link"
                                            @endif>

                                                <i class="nav-icon fa-solid fa-user"></i>

                                                <p>
                                                    Recepción
                                                <i class="fas fa-angle-left right"></i>
                                                <!-- <span class="badge badge-info right">6</span>-->
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="nav-item">
                                                    <a href="{{route('recepcion')}}" 
                                                    @if(session('active')=='Recepcion')
                                                        class="nav-link active"
                                                    @else
                                                        class="nav-link"
                                                    @endif>
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Listado de Recepcionistas</p>
                                                    </a>
                                                </li>       
                                                
                                            </ul>
                                        </li>
                                    @endif


                                    @if((Session('idRole') == 1) || (Session('idRole') == 2) || (Session('idRole') == 3) || (Session('idRole') == 4))
                                        <li 
                                        @if(session('active')=='Socios')
                                            class="nav-item menu-is-opening menu-open"
                                        @else
                                            class="nav-item"
                                        @endif>
                                            <a href="#" 
                                            @if(session('active')=='Socios')
                                                class="nav-link active"
                                            @else
                                                class="nav-link"
                                            @endif>

                                                <i class="nav-icon fa-solid fa-user"></i>

                                                <p>
                                                    Socios
                                                <i class="fas fa-angle-left right"></i>
                                                <!-- <span class="badge badge-info right">6</span>-->
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="nav-item">
                                                    <a href="{{route('socios')}}" 
                                                    @if(session('active')=='Socios')
                                                        class="nav-link active"
                                                    @else
                                                        class="nav-link"
                                                    @endif>
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Listado de Socios</p>
                                                    </a>
                                                </li>       
                                                
                                            </ul>
                                        </li>
                                    @endif

                                    @if(Session('idRole') == 1)
                            
                                        <li 
                                        @if(session('active')=='Gimnasios')
                                            class="nav-item menu-is-opening menu-open"
                                        @else
                                            class="nav-item"
                                        @endif>
                                            <a href="#"
                                            @if(session('active')=='Gimnasios')
                                                class="nav-link active"
                                            @else
                                                class="nav-link"
                                            @endif>
                                                <i class="nav-icon fa-solid fa-dumbbell"></i>
                                                <p>
                                                    Gimnasios
                                                <i class="fas fa-angle-left right"></i>
                                                <!-- <span class="badge badge-info right">6</span>-->
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="nav-item">
                                                    <a href="{{route('gimnasio')}}" 
                                                    @if(session('active')=='Gimnasios')
                                                        class="nav-link active"
                                                    @else
                                                        class="nav-link"
                                                    @endif>
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Listado de Gimnasios</p>
                                                    </a>
                                                </li>       
                                                
                                            </ul>
                                        </li>
                                    @endif

                                    @if((Session('idRole') == 1) || (Session('idRole') == 2) || (Session('idRole') == 3) || (Session('idRole') == 4))

                                        <li  
                                        @if(session('active')=='Clases')
                                            class="nav-item menu-is-opening menu-open"
                                        @else
                                            class="nav-item"
                                        @endif>
                                            <a href="#"
                                            @if(session('active')=='Clases')
                                                class="nav-link active"
                                            @else
                                                class="nav-link"
                                            @endif>
                                                <i class="nav-icon fa-solid fa-list"></i>
                                                <p>
                                                    Clases
                                                <i class="fas fa-angle-left right"></i>
                                                <!-- <span class="badge badge-info right">6</span>-->
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="nav-item">
                                                    <a href="{{route('clase')}}"
                                                    @if(session('active')=='Clases')
                                                        class="nav-link active"
                                                    @else
                                                        class="nav-link"
                                                    @endif>
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Listado de Clases</p>
                                                    </a>
                                                </li>       
                                                
                                            </ul>
                                        </li>
                                    @endif

                                    @if((Session('idRole') == 1) || (Session('idRole') == 2) || (Session('idRole') == 3) || (Session('idRole') == 4))

                                        <li  
                                        @if(session('active')=='Sala')
                                            class="nav-item menu-is-opening menu-open"
                                        @else
                                            class="nav-item"
                                        @endif>
                                            <a href="#" 
                                            @if(session('active')=='Sala')
                                                class="nav-link active"
                                            @else
                                                class="nav-link"
                                            @endif>
                                            <i class="nav-icon fa-solid fa-list"></i>
                                            <p>
                                                    Salas
                                                <i class="fas fa-angle-left right"></i>
                                                <!-- <span class="badge badge-info right">6</span>-->
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="nav-item">
                                                    <a href="{{route('sala')}}"
                                                    @if(session('active')=='Sala')
                                                        class="nav-link active"
                                                    @else
                                                        class="nav-link"
                                                    @endif>
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Listado de Salas</p>
                                                    </a>
                                                </li>       
                                                
                                            </ul>
                                        </li>
                                    @endif


                                    <li     
                                        @if(session('active')=='HorarioClases' || session('active')=='CalendarioHorarioClases')
                                            class="nav-item menu-is-opening menu-open"
                                        @else
                                            class="nav-item"
                                        @endif>
                                        <a href="#"     
                                            @if(session('active')=='HorarioClases' || session('active')=='CalendarioHorarioClases')
                                                class="nav-link active"
                                            @else
                                                class="nav-link"
                                            @endif>
                                            <i class="nav-icon fa-regular fa-calendar-days"></i>
                                            <p>
                                                Horario
                                            <i class="fas fa-angle-left right"></i>
                                            <!-- <span class="badge badge-info right">6</span>-->
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">

                                            @if(Session('idRole') != 5)

                                                <li class="nav-item">
                                                    <a href="{{route('horarioclases')}}"
                                                     @if(session('active')=='HorarioClases')
                                                        class="nav-link active"
                                                    @else
                                                        class="nav-link"
                                                    @endif>
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Listado del Horario/Clases</p>
                                                    </a>
                                                </li> 

                                            @endif
                                            
                                                <li class="nav-item">
                                                    <a href="{{route('CalendarioHorarioClase')}}"
                                                     @if(session('active')=='CalendarioHorarioClases')
                                                        class="nav-link active"
                                                    @else
                                                        class="nav-link"
                                                    @endif>
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Calendario de Clases</p>
                                                    </a>
                                                </li> 
                                        </ul>
                                    </li>

                                    @if((Session('idRole') == 5) || (Session('idRole') == 1))

                                        <li 
                                            @if(session('active')=='ClasesMatriculadas')
                                                class="nav-item menu-is-opening menu-open"
                                            @else
                                                class="nav-item"
                                            @endif>
                                            <a href="#" 
                                                @if(session('active')=='ClasesMatriculadas')
                                                    class="nav-link active"
                                                @else
                                                    class="nav-link"
                                                @endif>
                                                <i class="nav-icon fa-solid fa-list"></i>
                                                <p>
                                                    Clases Matriculadas
                                                <i class="fas fa-angle-left right"></i>
                                                <!-- <span class="badge badge-info right">6</span>-->
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li class="nav-item">
                                                    <a href="{{route('ClasesMatriculadas')}}"
                                                     @if(session('active')=='ClasesMatriculadas')
                                                        class="nav-link active"
                                                    @else
                                                        class="nav-link"
                                                    @endif>
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Listado de Clases Matriculadas</p>
                                                    </a>
                                                </li>       
                                                
                                            </ul>
                                        </li>
                                    @endif
                                            
                                    
                                       
                                    @if((Session('idRole') == 1) || (Session('idRole') == 4) || (Session('idRole') == 5))

                                        <li 
                                            @if(session('active')=='CategoriaEjercicios' )
                                                class="nav-item menu-is-opening menu-open"
                                            @else
                                                class="nav-item"
                                            @endif>
                                            <a href="#" 
                                                @if(session('active')=='CategoriaEjercicios')
                                                    class="nav-link active"
                                                @else
                                                    class="nav-link"
                                                @endif>
                                                <i class="nav-icon fa-solid fa-list"></i>
                                                <p>
                                                    Categoria de Ejercicios
                                                <i class="fas fa-angle-left right"></i>
                                                <!-- <span class="badge badge-info right">6</span>-->
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                               
                                                <li class="nav-item">
                                                    <a href="{{route('CategoriaEjercicios')}}" 
                                                        @if(session('active')=='CategoriaEjercicios')
                                                            class="nav-link active"
                                                        @else
                                                            class="nav-link"
                                                        @endif>
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Listado de Categorías de Ejercicios</p>
                                                    </a>
                                                </li>    
                                            </ul>
                                        </li>
                                    @endif

                                    @if((Session('idRole') == 1) || (Session('idRole') == 4) || (Session('idRole') == 5))

                                        <li @if(session('active')=='TipoEjercicios' )
                                                class="nav-item menu-is-opening menu-open"
                                            @else
                                                class="nav-item"
                                            @endif>
                                            <a href="#"
                                             @if(session('active')=='TipoEjercicios')
                                                class="nav-link active"
                                            @else
                                                class="nav-link"
                                            @endif>
                                            <i class="nav-icon fa-solid fa-list"></i>
                                            <p>
                                                    Tipos de Ejercicios
                                                <i class="fas fa-angle-left right"></i>
                                                <!-- <span class="badge badge-info right">6</span>-->
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                               
                                                <li class="nav-item">
                                                    <a href="{{route('TipoEjercicios')}}" 
                                                    @if(session('active')=='TipoEjercicios')
                                                        class="nav-link active"
                                                    @else
                                                        class="nav-link"
                                                    @endif>
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Listado de Tipos de Ejercicios</p>
                                                    </a>
                                                </li>    
                                            </ul>
                                        </li>
                                    @endif


                                    @if((Session('idRole') == 1) || (Session('idRole') == 4) || (Session('idRole') == 5))

                                        <li 
                                            @if(session('active')=='TabladeEjercicios' || session('active')=='Ejercicios' )
                                                class="nav-item menu-is-opening menu-open"
                                            @else
                                                class="nav-item"
                                            @endif
                                        >
                                            <a href="#" 
                                                @if(session('active')=='TabladeEjercicios' || session('active')=='Ejercicios'  )
                                                    class="nav-link active"
                                                @else
                                                    class="nav-link"
                                                @endif
                                            >
                                                <i class="nav-icon fa-solid fa-person-walking"></i>
                                                <p>
                                                    Ejercicios
                                                <i class="fas fa-angle-left right"></i>
                                                <!-- <span class="badge badge-info right">6</span>-->
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                           
                                                <li class="nav-item">
                                                    <a href="{{route('Ejercicios')}}" 
                                                    
                                                    @if(session('active')=='Ejercicios')
                                                        class="nav-link active"
                                                    @else
                                                        class="nav-link"
                                                    @endif
                                                    >
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Listado de Ejercicios</p>
                                                    </a>
                                                </li>

                                                <li class="nav-item">
                                                    <a href="{{route('TabladeEjercicios')}}" 
                                                        @if(session('active')=='TabladeEjercicios')
                                                        class="nav-link active"
                                                        @else
                                                            class="nav-link"
                                                        @endif
                                                    >
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Listado de Tablas de Ejercicios</p>
                                                    </a>
                                                </li>                                         
                                                    
                                                
                                            </ul>
                                        </li>
                                    @endif

                                    @if((Session('idRole') == 1) || (Session('idRole') == 4) || (Session('idRole') == 5))

                                    <li 
                                        @if(session('active')=='EntrenamientoDiario' || session('active')=='EvolucionEjercicios' )
                                            class="nav-item menu-is-opening menu-open"
                                        @else
                                            class="nav-item"
                                        @endif
                                    >
                                        <a href="#" 
                                            @if(session('active')=='EntrenamientoDiario' || session('active')=='EvolucionEjercicios')
                                                class="nav-link active"
                                            @else
                                                class="nav-link"
                                            @endif
                                        >
                                            <i class="nav-icon fa-solid fa-person-walking"></i>
                                            <p>
                                                Entrenamientos
                                            <i class="fas fa-angle-left right"></i>
                                            <!-- <span class="badge badge-info right">6</span>-->
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                       
                                                                                 
                                            <li class="nav-item">
                                                <a href="{{route('EntrenamientoDiario')}}" 
                                                    @if(session('active')=='EntrenamientoDiario')
                                                        class="nav-link active"
                                                    @else
                                                        class="nav-link"
                                                    @endif>
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Entrenamiento Diario</p>
                                                </a>
                                            </li>      
                                            <li class="nav-item">
                                                <a href="{{route('EvolucionEjercicios')}}" 
                                                    @if(session('active')=='EvolucionEjercicios')
                                                        class="nav-link active"
                                                    @else
                                                        class="nav-link"
                                                    @endif>
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Evolución de Ejercicios</p>
                                                </a>
                                            </li>    
                                            
                                        </ul>
                                    </li>
                                @endif

                                    @if((Session('idRole') == 1) || (Session('idRole') == 2) || (Session('idRole') == 3))

                                        <li class="nav-item">
                                            <a href="{{route('HistorialdePago')}}"
                                             @if(session('active')=='HistorialdePago')
                                                class="nav-link active"
                                            @else
                                                class="nav-link"
                                            @endif>
                                                <i class="nav-icon fa-regular fa-credit-card"></i>
                                                <p>
                                                    Historial de Pago
                                                
                                                <!-- <span class="badge badge-info right">6</span>-->
                                                </p>
                                            </a>
                                            
                                        </li>
                                    @endif

                                @else
                                    <li class="nav-item">
                                        <a href="{{redirect('checkout')}}" class="nav-link active">
                                            <i class="nav-icon far fa-image"></i>
                                            <p>
                                            Pago mensualidad
                                            </p>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                   <!-- </div>
                </div>
            </div>-->
            <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
                <div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div></div>
            </div>
            <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
                <div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="height: 48.933%; transform: translate(0px, 0px);"></div></div>
            </div>
            <div class="os-scrollbar-corner"></div>
        </div>


