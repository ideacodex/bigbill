<!DOCTYPE html>
<html class="no-js" lang="en">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Inicio Usuario">

    <title>{{ config('Admin.name', 'Inicio') }}</title>
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">
    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
        integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
        integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <!-- CUSTOM CSS -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('sufee/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sufee/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('sufee/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sufee/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('sufee/assets/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('sufee/assets/assets/css/lib/datatable/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sufee/assets/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sufee/assets/css/jqvmap.min.css') }}">
    <style>
    </style>
</head>
<!--Body-->

<body>
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu"
                    aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><img src="images/logo.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="/admin"> <i class="menu-icon fas fa-toolbox"></i>Administrador</a>
                    </li>
                    <h3 class="menu-title">Interacciones</h3><!-- /.menu-title -->

                    <li class="active">
                        <a href="{{ route('empresas.index') }}"> <i class="menu-icon fas fa-building"></i>Companías </a>
                    </li>

                    <li class="active">
                        <a href="{{ route('clientes.index') }}"> <i class="menu-icon fas fa-users"></i>Clientes</a>
                    </li>
                    <li class="active">
                        <a href="productos/"> <i class="menu-icon fas fa-box-open"></i>Productos</a>
                    </li>

                    <h3 class="menu-title">Facturar</h3><!-- /.menu-title -->

                    <li class="active">
                        <a href="{{ route('facturas.index') }}"> <i class="menu-icon fas fa-file-alt"></i>Crear
                            factura</a>
                    </li>
                    <li>
                        <a href="widgets.html"> <i class="menu-icon ti-email"></i>Widgets </a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-bar-chart"></i>Charts</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-line-chart"></i><a href="charts-chartjs.html">Chart JS</a>
                            </li>
                            <li><i class="menu-icon fa fa-area-chart"></i><a href="charts-flot.html">Flot Chart</a></li>
                            <li><i class="menu-icon fa fa-pie-chart"></i><a href="charts-peity.html">Peity Chart</a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-area-chart"></i>Maps</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-map-o"></i><a href="maps-gmap.html">Google Maps</a></li>
                            <li><i class="menu-icon fa fa-street-view"></i><a href="maps-vector.html">Vector Maps</a>
                            </li>
                        </ul>
                    </li>
                    <h3 class="menu-title">Extras</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-glass"></i>Paginas</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="/login">Login</a></li>
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="/register">Register</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="header-menu">
                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fas fa-compass"></i></a>
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..."
                                    aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>

                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="count bg-danger">5</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="notification">
                                <p class="red">You have 3 Notification</p>
                                <a class="dropdown-item media bg-flat-color-1" href="#">
                                    <i class="fa fa-check"></i>
                                    <p>Server #1 overloaded.</p>
                                </a>
                                <a class="dropdown-item media bg-flat-color-4" href="#">
                                    <i class="fa fa-info"></i>
                                    <p>Server #2 overloaded.</p>
                                </a>
                                <a class="dropdown-item media bg-flat-color-5" href="#">
                                    <i class="fa fa-warning"></i>
                                    <p>Server #3 overloaded.</p>
                                </a>
                            </div>
                        </div>

                        <div class="dropdown for-message">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="message"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ti-email"></i>
                                <span class="count bg-primary">9</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="message">
                                <p class="red">You have 4 Mails</p>
                                <a class="dropdown-item media bg-flat-color-1" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="images/avatar/1.jpg"></span>
                                    <span class="message media-body">
                                        <span class="name float-left">Jonathan Smith</span>
                                        <span class="time float-right">Just now</span>
                                        <p>Hello, this is an example msg</p>
                                    </span>
                                </a>
                                <a class="dropdown-item media bg-flat-color-4" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="images/avatar/2.jpg"></span>
                                    <span class="message media-body">
                                        <span class="name float-left">Jack Sanders</span>
                                        <span class="time float-right">5 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                    </span>
                                </a>
                                <a class="dropdown-item media bg-flat-color-5" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="images/avatar/3.jpg"></span>
                                    <span class="message media-body">
                                        <span class="name float-left">Cheryl Wheeler</span>
                                        <span class="time float-right">10 minutes ago</span>
                                        <p>Hello, this is an example msg</p>
                                    </span>
                                </a>
                                <a class="dropdown-item media bg-flat-color-3" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="images/avatar/4.jpg"></span>
                                    <span class="message media-body">
                                        <span class="name float-left">Rachel Santos</span>
                                        <span class="time float-right">15 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                    </span>
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
                            <a class="nav-link" href="#"><i class="fa fa-user"></i> My Profile</a>

                            <a class="nav-link" href="#"><i class="fa fa-user"></i> Notifications <span
                                    class="count">13</span></a>

                            <a class="nav-link" href="#"><i class="fa fa-cog"></i> Settings</a>

                            <a class="nav-link" href="#"><i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </div>

                    <div class="language-select dropdown" id="language-select">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown" id="language" aria-haspopup="true"
                            aria-expanded="true">
                            <i class="flag-icon flag-icon-us"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="language">
                            <div class="dropdown-item">
                                <span class="flag-icon flag-icon-fr"></span>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-es"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-us"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-it"></i>
                            </div>
                        </div>
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
        <!-- Page Content -->
        {{--
        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-dark bg-theme-1 border-bottom">
                <button id="menu-toggle" class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#sidebar-wrapper" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                </button>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class=""><i class="fas fa-ellipsis-v"></i></span>
                </button>



                {{---
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item active dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-cog"></i>
                                Nombre de usuario
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('adminPost') }}"> <span><i
                        class="fas fa-newspaper"></i></span> Publicaciones</a>
                <a class="dropdown-item" href="{{ url('users') }}"> <span><i class="fas fa-users"></i></span>
                    Usuarios</a>
                <a class="dropdown-item" href="{{ url('home') }}"> <span><i class="fas fa-newspaper"></i></span> Vista
                    Usuario</a>
                <div class="dropdown-divider"></div>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                    <span class="nav-app-icon"><i class="fas fa-sign-out-alt"></i></span>
                    <span class="" style="margin-top: -5px;"> Salir </span></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
        </div>
        </li>
        </ul>
    </div>
    --}}
    </nav>

    <main class="mb-5">
        @yield('content')
    </main>
    </div>
    <!-- /#page-content-wrapper -->
</body>

</html>

<!--Script-->
<script src="{{ asset('sufee/js/jquery.min.js') }}"></script>
<script src="{{ asset('sufee/js/popper.min.js') }}"></script>
<script src="{{ asset('sufee/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('sufee/js/main.js') }}"></script>

<script src="{{ asset('sufee/js/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('sufee/js/dashboard.js') }}"></script>
<script src="{{ asset('sufee/js/widgets.js') }}"></script>
<script src="{{ asset('sufee/js/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('sufee/js/jquery.vmap.sampledata.js') }}"></script>
<script src="{{ asset('sufee/js/jquery.vmap.world.js') }}"></script>

<script src="{{ asset('sufee/assets/js/vendor/jquery-2.1.4.min.js') }}"></script>
<script src="{{ asset('sufee/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('sufee/assets/js/plugins.js') }}"></script>
<script src="{{ asset('sufee/assets/js/main.js') }}"></script>
<script src="{{ asset('sufee/assets/js/lib/data-table/datatables.min.js') }}"></script>
<script src="{{ asset('sufee/assets/js/lib/data-table/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('sufee/assets/js/lib/data-table/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('sufee/assets/js/lib/data-table/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset('sufee/assets/js/lib/data-table/jszip.min.js') }}"></script>
<script src="{{ asset('sufee/assets/js/lib/data-table/pdfmake.min.js') }}"></script>
<script src="{{ asset('sufee/assets/js/lib/data-table/vfs_fonts.js') }}"></script>
<script src="{{ asset('sufee/assets/js/lib/data-table/buttons.html5.min.js') }}"></script>
<script src="{{ asset('sufee/assets/js/lib/data-table/buttons.print.min.js') }}"></script>
<script src="{{ asset('sufee/assets/js/lib/data-table/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('sufee/assets/js/lib/data-table/datatables-init.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="{{ asset('sufee/vendors/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('sufee/vendors/jquery/dist/jquery.js') }}"></script>
<script src="{{ asset('sufee/vendors/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('sufee/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
    integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#bootstrap-data-table-export').DataTable();
    });

</script>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
    (function($) {
        "use strict";

        jQuery('#vmap').vectorMap({
            map: 'world_en',
            backgroundColor: null,
            color: '#ffffff',
            hoverOpacity: 0.7,
            selectedColor: '#1de9b6',
            enableZoom: true,
            showTooltip: true,
            values: sample_data,
            scaleColors: ['#1de9b6', '#03a9f5'],
            normalizeFunction: 'polynomial'
        });
    })(jQuery);

</script>

<!--Bower-->
<script src="{{ url('bower_components/riot/riot.min.js') }}"></script>
<script src="{{ url('bower_components/riot/riot+compiler.min.js') }}"></script>

@yield('bottom')
<!--Bower-->
