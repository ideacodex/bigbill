<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Inicio</title>
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

</style>

<body>
    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu"
                    aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><img src="images/logo.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="/perfil"> <i class="menu-icon fas fa-toolbox"></i>
                            <h6>Administrador:</h6>
                            <p class="ml-5 text-secondary">{{ Auth::user()->name }} {{ Auth::user()->lastname }}</p>
                        </a>
                    </li>

                    <h3 class="menu-title">Gestiones</h3>{{-- <!-- /.menu-title --> --}}
                    <li class="menu-item">
                        <a href="{{ route('UsuariosEmpresa.index') }}">
                            <i class="menu-icon fa fa-book"></i>Usuarios
                        </a>
                    </li>

                    <h3 class="menu-title">ACCIONES</h3><!-- /.menu-title -->
                    <!--Contabilidad -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fas fa-calculator"></i>Cuentas contables</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-book"></i><a href="{{ route('TipodeCuenta.index') }}">
                                    Tipos</a></li>
                            <li><i class="fa fa-book"></i><a href="{{ route('cuentas.index') }}"> Cuentas</a>
                            </li>
                        </ul>
                    </li>
                    <!--Companías -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fas fa-building"></i>Companías</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-book"></i><a href="{{ route('empresas.index') }}"> Empresas</a>
                            </li>
                            <li><i class="fa fa-id-badge"></i><a
                                    href="{{ route('sucursales.index') }}">Sucursales</a></li>
                        </ul>
                    </li>
                    <!-- Clientes -->
                    <li class="menu-item">
                        <a href="{{ url('clientes?company_id=' . Auth::user()->company_id) }}">
                            <i class="menu-icon fa fa-book"></i>Clientes
                        </a>
                    </li>
                    <!--Productos -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fas fa-box-open"></i>Productos</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-book"></i> <a href="{{ route('productos.index') }}"> Listado</a>
                            </li>
                        </ul>
                    </li>
                    <!--Facturar -->
                    <h3 class="menu-title">Facturar</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Facturar</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li> <i class="menu-icon fas fa-file-alt"></i><a href="{{ route('facturas.index') }}">Ver
                                    Facturas</a></li>
                            <li> <i class="menu-icon fas fa-file-alt"></i><a href="">Cotizaciones
                                </a></li>
                        </ul>
                    </li>
                    <h3 class="menu-title">Documentos</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fas fa-file-excel"></i>Inventarios</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li> <i class="menu-icon fas fa-file-alt"></i><a
                                    href="{{ url('/doc-Customer') }}">Clientes</a></li>
                            <li><i class="fa fa-id-badge"></i><a href="{{ url('/doc') }}">Productos</a>
                            </li>
                            <li><i class="fa fa-id-badge"></i><a href="{{ url('/doc-Account') }}">Cuentas</a>
                            </li>
                            <li><i class="fa fa-id-badge"></i><a href="{{ url('/doc-AccountType') }}">Tipo
                                    Cuentas</a>
                            </li>
                            <li><i class="fa fa-id-badge"></i><a href="{{ url('/doc-Companies') }}">Companias</a>
                            </li>
                            <li><i class="fa fa-id-badge"></i><a href="{{ url('/doc-bills') }}">Facturas</a>
                            </li>
                            <li><i class="fa fa-id-badge"></i><a href="{{ url('/doc-User') }}">Usuarios</a>
                            </li>
                        </ul>
                    </li>

                    <h3 class="menu-title">Extras</h3>{{-- <!-- /.menu-title --> --}}
                    <li class="menu-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"><i
                                class="menu-icon fas fa-power-off"></i> Cerrar sesión</a>
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
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">

                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="notification">
                            <p class="red">Informacion</p>
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
                            <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="{{ url('/perfil') }}"><i class="fa fa-user"></i> Mi Perfil</a>

                            <a class="nav-link" href="{{ route('UsuariosEmpresa.index') }}"><i
                                    class="fa fa-user"></i> Usuarios </a>

                            <a class="nav-link" href="{{ url('/Ajustes') }}"><i class="fa fa-cog"></i> Settings</a>
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i>
                                {{ __('salir') }}
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
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Facturador</h1>
                    </div>
                </div>
            </div>

        </div>
        {{-- ------------------------- --}}

        @yield('content')

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
    <script>
        $('.select2').select2();

    </script>
</body>

</html>
