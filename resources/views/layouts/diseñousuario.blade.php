<!DOCTYPE html>
<html class="no-js" lang="en">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Inicio Usuario">

    <title>{{ config('diseñousuario.name', 'Inicio') }}</title>
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">
 <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
   
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <!-- CUSTOM CSS -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/flag-icon.min.css"> 
    <link rel="stylesheet" href="css/jqvmap.min.css">
    <style>
    </style>
</head>
{{--Body--}}
<body>
<aside id="left-panel" class="left-panel">  
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
           
            <a class="navbar-brand hidden" href="/admin"><img src="images/logo2.png" alt="Logo"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="/admin"> <i class="menu-icon fas fa-toolbox"></i>Administrador</a>
                </li>
                <h3 class="menu-title">Interacciones</h3><!-- /.menu-title -->

                <li class="active">
                    <a href="company"> <i class="menu-icon fas fa-building"></i>Companías </a>
                </li>

                <li class="active">
                    <a href="company"> <i class="menu-icon fas fa-users"></i>Clientes</a>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Forms</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-th"></i><a href="forms-basic.html">Basic Form</a></li>
                        <li><i class="menu-icon fa fa-th"></i><a href="forms-advanced.html">Advanced Form</a></li>
                    </ul>
                </li>

                <h3 class="menu-title">Icons</h3><!-- /.menu-title -->

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Icons</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-fort-awesome"></i><a href="font-fontawesome.html">Font Awesome</a></li>
                        <li><i class="menu-icon ti-themify-logo"></i><a href="font-themify.html">Themefy Icons</a></li>
                    </ul>
                </li>
                <li>
                    <a href="widgets.html"> <i class="menu-icon ti-email"></i>Widgets </a>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bar-chart"></i>Charts</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-line-chart"></i><a href="charts-chartjs.html">Chart JS</a></li>
                        <li><i class="menu-icon fa fa-area-chart"></i><a href="charts-flot.html">Flot Chart</a></li>
                        <li><i class="menu-icon fa fa-pie-chart"></i><a href="charts-peity.html">Peity Chart</a></li>
                    </ul>
                </li>

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-area-chart"></i>Maps</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-map-o"></i><a href="maps-gmap.html">Google Maps</a></li>
                        <li><i class="menu-icon fa fa-street-view"></i><a href="maps-vector.html">Vector Maps</a></li>
                    </ul>
                </li>
                <h3 class="menu-title">Extras</h3><!-- /.menu-title -->
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-glass"></i>Paginas</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-sign-in"></i><a href="/login">Login</a></li>
                        <li><i class="menu-icon fa fa-sign-in"></i><a href="/register">Register</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->
  <!-- Page Content -->
  <div id="page-content-wrapper">

    <nav class="navbar navbar-expand-lg navbar-dark bg-theme-1 border-bottom">
        <button id="menu-toggle" class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#sidebar-wrapper" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class=""><i class="fas fa-ellipsis-v"></i></span>
        </button>

    <!---
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
                        <a class="dropdown-item" href="{{ url('users') }}"> <span><i
                                    class="fas fa-users"></i></span> Usuarios</a>
                        <a class="dropdown-item" href="{{ url('home') }}"> <span><i
                                    class="fas fa-newspaper"></i></span> Vista Usuario</a>
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                            <span class="nav-app-icon"><i class="fas fa-sign-out-alt"></i></span>
                            <span class="" style="margin-top: -5px;"> Salir </span></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    -->
    </nav>

    <main class="mb-5">
        @yield('content')
    </main>
</div>
<!-- /#page-content-wrapper -->
</body>
</html>

<!--Script-->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>

<script src="js/Chart.bundle.min.js"></script>
<script src="js/dashboard.js"></script>
<script src="js/widgets.js"></script>
<script src="js/jquery.vmap.min.js"></script>
<script src="js/jquery.vmap.sampledata.js"></script>
<script src="js/jquery.vmap.world.js"></script>

<script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/lib/data-table/datatables.min.js"></script>
<script src="assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
<script src="assets/js/lib/data-table/dataTables.buttons.min.js"></script>
<script src="assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
<script src="assets/js/lib/data-table/jszip.min.js"></script>
<script src="assets/js/lib/data-table/pdfmake.min.js"></script>
<script src="assets/js/lib/data-table/vfs_fonts.js"></script>
<script src="assets/js/lib/data-table/buttons.html5.min.js"></script>
<script src="assets/js/lib/data-table/buttons.print.min.js"></script>
<script src="assets/js/lib/data-table/buttons.colVis.min.js"></script>
<script src="assets/js/lib/data-table/datatables-init.js"></script>
<script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
        } );
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


