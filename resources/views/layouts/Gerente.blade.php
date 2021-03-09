<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Facturador</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/themify-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/selectFX/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    {{-- selec2 --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    {{-- selec2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
        integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
</head>

<style>
    /*buscar select */
    .select2-container .select2-selection--single {
        height: 46px !important;
    }

    .select2-container--default .select2-selection--single {
        border: 1px solid #ccc !important;
        border-radius: 0px !important;
    }

    .img:hover {
        border-radius: 50%;
        -webkit-border-radius: 50%;
        box-shadow: 0px 0px 15px 15px #36d800;
        -webkit-box-shadow: 0px 0px 5px 5px #238a01;
        transform: rotate(360deg);
        -webkit-transform: rotate(360deg);
    }


    .headerwaves {
        position: auto;
        text-align: center;
        background: linear-gradient(60deg, rgba(84, 58, 183, 1) 0%, rgba(0, 172, 193, 1) 100%);
        color: white;
    }

    .inner-headerwaves {
        margin: 0;
        padding: 0;
    }


    /* Animation */
    .parallax>use {
        animation: move-forever 25s cubic-bezier(.55, .5, .45, .5) infinite;
    }

    .parallax>use:nth-child(1) {
        animation-delay: -2s;
        animation-duration: 7s;
    }

    .parallax>use:nth-child(2) {
        animation-delay: -3s;
        animation-duration: 10s;
    }

    .parallax>use:nth-child(3) {
        animation-delay: -4s;
        animation-duration: 13s;
    }

    .parallax>use:nth-child(4) {
        animation-delay: -5s;
        animation-duration: 20s;
    }

    @keyframes move-forever {
        0% {
            transform: translate3d(-90px, 0, 0);
        }

        100% {
            transform: translate3d(85px, 0, 0);
        }
    }

    /*Shrinking for mobile*/
    @media (max-width: 768px) {
        .waves {
            height: 40px;
            min-height: 40px;
        }

        .content {
            height: 30vh;
        }

        h1 {
            font-size: 24px;
        }
    }

    .waves {
        width: 100%;
        height: 70px;
        /*Fix for safari gap*/
        min-height: 50px;
        max-height: 230px;
        margin-top: -1.5%;
        z-index: -1;
    }

    .FondoParteDeOndas {
        background: transparent;
        height: 20%;
        margin: 0%;
        width: 100%;
        top: 0%;
        margin-right: -1%;
    }


    .wavesdecabeza {
        width: 100%;
        height: 70px;
        /*Fix for safari gap*/
        min-height: 50px;
        max-height: 230px;


        transform: rotate(180deg);
        -ms-transform: rotate(180deg);
        /* IE 9 */
        -webkit-transform: rotate(180deg);
        /* Opera, Chrome, and Safari */
    }

</style>

<body style="background-color: white">
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel" style="background: black">
        <nav class="navbar navbar-expand-sm navbar-default" style="background: black">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu"
                    aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                {{-- Logo de la Empresa --}}
                @if (Auth::user()->company_id)
                    @if (Auth::user()->company->file != null)

                        <a class="navbar-brand" href="{{ url('perfil') }}"><img
                                src="{{ asset('/storage/companias/' . Auth::user()->company->file) }}" width="90px"
                                height="70px" alt="Facturador"></a>

                    @else
                        <a class="navbar-brand" href="{{ url('perfil') }}">
                            <img src="{{ asset('images/card.png') }}" alt="Facturador">
                        </a>
                    @endif
                @else
                    <a class="navbar-brand" href="{{ url('perfil') }}">
                        <img src="{{ asset('images/card.png') }}" alt="Facturador">
                    </a>
                @endif
                {{-- Logo Cuando la barra se minimiza --}}
                @if (Auth::user()->company_id)
                    @if (Auth::user()->company->file != null)
                        <a class="navbar-brand hidden" href="{{ url('perfil') }}"><img
                                src="{{ asset('/storage/companias/' . Auth::user()->company->file) }}" width="50px"
                                height="40px" alt="Facturador"></a>
                    @else
                        <a class="navbar-brand hidden" href="{{ url('perfil') }}"><img src="{{ asset('images/card.png') }}"
                                alt="Facturador"></a>
                    @endif
                @else
                    <a class="navbar-brand hidden" href="{{ url('perfil') }}"><img src="{{ asset('images/card.png') }}"
                            alt="Facturador"></a>
                @endif
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="{{ url('perfil') }}"> <i class="menu-icon fas fa-toolbox"></i>Gerencia:
                            {{ Auth::user()->name }}</a>
                    </li>

                    <h3 class=" text-lighT menu-title">Gestiones</h3>{{-- <!-- /.menu-title --> --}}
                    @if (Auth::user()->company_id)
                        @if (Auth::user()->work_permits == 1)
                            <li class="menu-item">
                                <a href="{{ url('Personal') }}">
                                    <i class=" text-light menu-icon fas fa-users"></i>Usuarios
                                </a>
                            </li>
                            <h3 class="text-light menu-title">ACCIONES</h3><!-- /.menu-title -->
                            <li class="menu-item">
                                <a href="{{ url('clientes') }}">
                                    <i class="text-light menu-icon fas fa-user-friends"></i>Clientes
                                </a>
                                <a href="{{ route('sucursales.index') }}">
                                    <i class="text-light menu-icon fas fa-building"></i>Sucursales
                                </a>
                            </li>
                            <!--Productos -->
                            <li class="menu-item-has-children dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false"> <i
                                        class=" text-light menu-icon fas fa-cubes"></i>Productos</a>
                                <ul class="sub-menu children dropdown-menu" style="background: black">
                                    <li>
                                        <i class="text-primary menu-icon fas fa-check"></i>
                                        <a href="{{ route('productos.index') }}">Listado de Productos</a>
                                    </li>
                                    <li>
                                        <i class="text-primary menu-icon fas fa-check"></i>
                                        <a href="{{ route('familias.index') }}">Familias</a>
                                    </li>
                                    <li>
                                        <i class="text-primary menu-icon fas fa-check"></i>
                                        <a href="{{ route('marcas.index') }}">Marcas</a>
                                    </li>
                                </ul>
                            </li>
                            <h3 class="text-light menu-title"> Facturar</h3><!-- /.menu-title -->
                            <li class="menu-item-has-children dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false"> <i
                                        class=" text-light menu-icon fas fa-file-medical-alt"></i>Facturar</a>
                                <ul class="sub-menu children dropdown-menu" style="background: black">
                                    <li>
                                        <i class="text-primary menu-icon fas fa-check"></i>
                                        <a href="{{ url('facturas?company_id=' . Auth::user()->company_id) }}">
                                            Ver Facturas</a>
                                    </li>
                                    @if (Auth::user()->suscriptions->type_plan == 1)
                                        <li>
                                            <i class=" text-light menu-icon fas fa-file-alt"></i>
                                            <a
                                                href="{{ url('facturas/create?company_id=' . Auth::user()->company_id) }}">
                                                Cotizaciones</a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                            <h3 class="menu-title">Documentos</h3><!-- /.menu-title -->

                            <li class="menu-item-has-children dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false"> <i
                                        class="text-light menu-icon fas fa-file-excel"></i>Inventarios</a>
                                <ul class="sub-menu children dropdown-menu" style="background: black">
                                    <li>
                                        <i class="fas fa-file-excel text-success "></i>
                                        <a href="{{ url('/doc-Customer') }}">Clientes</a>
                                    </li>
                                    <li>
                                        <i class="fas fa-file-excel text-success "></i>
                                        <a href="{{ url('/doc') }}">Productos</a>
                                    </li>
                                    <li>
                                        <i class="fas fa-file-excel text-success "></i>
                                        <a href="{{ url('/doc-Account') }}">Cuentas</a>
                                    </li>
                                    <li>
                                        <i class="fas fa-file-excel text-success "></i>
                                        <a href="{{ url('/doc-AccountType') }}">Tipo Cuentas</a>
                                    </li>
                                    <li>
                                        <i class="fas fa-file-excel text-success "></i>
                                        <a href="{{ url('/doc-Companies') }}">Companias</a>
                                    </li>
                                    <li>
                                        <i class="fas fa-file-excel text-success "></i>
                                        <a href="{{ url('/doc-bills') }}">Facturas</a>
                                    </li>
                                    <li>
                                        <i class="fas fa-file-excel text-success "></i>
                                        <a href="{{ url('/doc-User') }}">Usuarios</a>
                                    </li>
                                </ul>
                            </li>
                            <h3 class="text-light menu-title">Extras</h3><!-- /.menu-title -->
                        @else
                            <!--Ups no tienes permisos -->
                            <li class="menu-item">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="menu-icon fas fa-exclamation-triangle" style="color:yellow;"
                                        title="Atencion : Permisos faltantes"></i>
                                    <div style="font-family:Comic Sans">
                                        ¡¡ Atencion !!
                                    </div>
                                    <hr style="background-color: red;"> Ya cuentas con una empresa asignada, pero no
                                    tienes permisos de tu superior para poder trabajar, solicita que te habiliten los
                                    permisos para trabajar
                                </a>
                            </li>
                        @endif
                    @else
                        <script style="background: black; color white">
                            alert("Bienvenido\n Usted aun no cuenta con una compañia");

                        </script>
                    @endif


                    <li class="menu-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            <i class="text-danger menu-icon fas fa-power-off"></i> Cerrar sesión</a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left" style="background: rgb(16, 158, 214)"><i
                            style="background: rgb(16, 158, 214)" class="fa fa fa-tasks"></i></a>
                    <div class="header-left">


                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="user-avatar rounded-circle" src="{{ asset('images/contacts.png') }}"
                                    alt="Información">
                            </button>
                            <div class="dropdown-menu" aria-labelledby="notification">
                                <p class="red">Información</p>
                                <a class="dropdown-item media bg-flat-color-3" href="#">
                                    <i class="fa fa-check"></i>
                                    @if (Auth::user()->role_id == 1)
                                        <strong>Cargo: Administrador.</strong>
                                    @else
                                        @if (Auth::user()->role_id == 2)
                                            <strong>Cargo: Gerente.</strong>
                                        @else
                                            @if (Auth::user()->role_id == 3)
                                                <strong>Cargo: Contador.</strong>
                                            @else
                                                @if (Auth::user()->role_id == 4)
                                                    <strong>Cargo: Ventas.</strong>
                                                @else
                                                    <strong>Cargo: No tiene</strong>
                                                @endif
                                            @endif
                                        @endif
                                    @endif
                                </a>
                                <a class="dropdown-item media bg-flat-color-5" href="#">
                                    <i class="fa fa-info"></i>
                                    <strong>Empresa:
                                        @if (Auth::user()->company_id)
                                            {{ Auth::user()->companies->name }}
                                        @else
                                            Sin Compañia
                                        @endif

                                    </strong>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            @if (Auth::user()->file != null)
                                {{-- imagen --}}
                                <img src="{{ asset('/storage/usuarios/' . Auth::user()->file) }}" class="img"
                                    width="50px" height="50px" alt="Compania">
                            @else
                                <img class="user-avatar rounded-circle" src="{{ asset('images/setting.png') }}"
                                    alt="Más...">
                            @endif
                        </a>
                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa-user"></i> Mi Perfil</a>
                            @if (Auth::user()->company_id)
                                <a class="nav-link" href="{{ url('Personal') }}"><i class="fa fa-users"></i> Usuarios
                                </a>
                                <a class="nav-link" href="{{ url('/Ajustes') }}"><i class="fa fa-cog"></i>
                                    Ajustes</a>
                                @if (Auth::user()->work_permits == 1)
                                    <a class="nav-link"
                                        href="{{ url('empresas/' . Auth::user()->company_id . '/edit') }}">
                                        <i class="fas fa-street-view"></i> Empresa
                                    </a>
                                @endif
                            @endif
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i>
                                {{ __('Salir') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>

                    <div class="language-select dropdown" id="language-select">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown" id="language" aria-haspopup="true"
                            aria-expanded="true">
                            <i class="flag-icon flag-icon-gt"></i>
                        </a>

                    </div>

                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->
        <div id="FondoParteDeOndas" class="FondoParteDeOndas">
            <svg class="wavesdecabeza" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <defs>

                    <path id="gentle-wave"
                        d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                </defs>
                <g class="parallax">

                    <use xlink:href="#gentle-wave" x="25" y="0" fill="rgba(86,174,249,0.7" />
                    <use xlink:href="#gentle-wave" x="35" y="2" fill="rgba(50,120,250,0.5)" />
                    <use xlink:href="#gentle-wave" x="45" y="5" fill="rgba(255,255,255,0.3)" />
                    <use xlink:href="#gentle-wave" x="55" y="9" fill="#a9dcfb" />
                </g>
            </svg>
        </div>
        {{-- ------------------------- --}}
        @yield('content')



        {{-- ---------------------- --}}
        <div id="FondoParteDeOndas" class="FondoParteDeOndas">
            <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <defs>

                    <path id="gentle-wave"
                        d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                </defs>
                <g class="parallax">

                    <use xlink:href="#gentle-wave" x="25" y="0" fill="rgba(86,174,249,0.7" />
                    <use xlink:href="#gentle-wave" x="35" y="2" fill="rgba(50,120,250,0.5)" />
                    <use xlink:href="#gentle-wave" x="45" y="5" fill="rgba(255,255,255,0.3)" />
                    <use xlink:href="#gentle-wave" x="55" y="9" fill="#a9dcfb" />
                </g>
            </svg>
        </div>
    </div><!-- /#right-panel -->
    <!-- Right Panel -->







    <script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('vendors/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendors/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ asset('vendors/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('vendors/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/js/init-scripts/data-table/datatables-init.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    {{-- select con etiquetas --}}
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $('.select2').select2();

    </script>
    <script src="https://unpkg.com/tableexport@5.2.0/dist/js/tableexport.min.js"></script>
    @yield('js')
</body>

</html>
