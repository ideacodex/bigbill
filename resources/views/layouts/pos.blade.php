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

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    {{-- selec2 --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    {{-- selec2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

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
   
    <div id="app">
        <!-- example 1 - using absolute position for center -->
        <nav class="navbar navbar-expand-md navbar-dark bg-theme-1">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse" id="collapsingNavbar">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{ url('/') }}" class="nav-link">
                                <span class="nav-app-icon text-light">
                                    <i class="fas fa-home"> </i>
                                </span>
                            </a>
                        </li>
                    </ul>
                    @guest
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ route('login') }}">
                                    <span class="nav-app-icon text-light">
                                        <i class="fas fa-sign-in-alt"> </i>
                                    </span>
                                    {{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ route('register') }}"> <span
                                        class="nav-app-icon text-light"><i class="fas fa-user-plus"> </i> </span>
                                    {{ __('Register') }}</a>
                            </li>
                        </ul>
                    @else
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <button type="button" class="btn btn-lg" style="background:#f7921c" data-toggle="modal" data-target="#exampleModalCenter">
                                    <span class="nav-app-icon text-light"><i class="fas fa-user"></i></span>
                                    <span class="text-light" style="margin-top: -5px;"> 
                                        {{ Auth::user()->name }} {{ Auth::user()->lastname }} 
                                    </span>
                                </button>
                            </li>

                            <!-- Modal -->
                            <form method="POST" action="{{ url('updateUser') }}" onsubmit="return checkSubmit();">
                                @csrf
                                <input type="hidden" name="userID" value="{{ Auth::user()->id }}" >
                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">
                                                <span class="text-black" style="margin-top: -5px;"> 
                                                    {{ Auth::user()->name }} {{ Auth::user()->lastname }} 
                                                </span>
                                            </h5>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container ">
                                                    <div class="row justify-content-around" style="margin-top: 1em;">
                                                        <img src="https://image.flaticon.com/icons/svg/2633/2633848.svg" class="img-fluid" width="20%"
                                                            alt="Responsive image">
                                                    </div>
                                                    <div class="input-group input-group-lg mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                                <i class="text-primary fas fa-user-edit"></i>
                                                            </span>
                                                        </div>
                                                        <input id="name" placeholder="Nombres" type="text"
                                                            class="text-primary form-control @error('name') is-invalid @enderror" name="name"
                                                            value="{{ Auth::user()->name }}" required autofocus>
                                    
                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                    
                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="input-group input-group-lg mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                                <i class="text-primary fas fa-user-edit"></i>
                                                            </span>
                                                        </div>
                                                        <input id="lastname" placeholder="Apellidos" type="text"
                                                            class="text-primary form-control @error('lastname') is-invalid @enderror" name="lastname"
                                                            value="{{ Auth::user()->lastname }}" required autofocus>
                                    
                                                        @error('lastname')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                    
                                                        @error('lastname')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="input-group input-group-lg mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                                <i class="text-primary fas fa-at"></i>
                                                            </span>
                                                        </div>
                                                        <input id="email" placeholder="Correo " type="text"
                                                            class="text-primary form-control @error('email') is-invalid @enderror" name="email"
                                                            value="{{ Auth::user()->email }}" required autocomplete="email" autofocus>
                                    
                                                        @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                    
                                                        @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="input-group input-group-lg mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                                <i class="text-primary fas fa-mobile"></i>
                                                            </span>
                                                        </div>
                                                        <input id="phone" type="text" placeholder="Número de móvil"
                                                            class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ Auth::user()->phone }}"
                                                            required autofocus>
                                    
                                                        @error('phone')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                <input type="submit" class="btn btn-success" data-toggle="modal" value="Actualizar">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            @role('User')
                            <li class="nav-item" style="margin-right: 1em;">
                                <a class="nav-link"
                                    onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                                    <span class="nav-app-icon"><i class="fas fa-sign-out-alt"></i></span>
                                    <span class="" style="margin-top: -5px;"> Salir </span></a>
                            </li>
                        @else
                            <li class="nav-item active dropdown" style="margin-right: 1em;">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-cog"></i>
                                    Administrar
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('adminPost') }}"> <span><i
                                                class="fas fa-newspaper"></i></span> Publicaciones</a>
                                    
                                    <a class="dropdown-item" href="{{ url('home') }}"> <span><i
                                                class="fas fa-newspaper"></i></span> Vista usuario</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item"
                                        onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                                        <span class="nav-app-icon"><i class="fas fa-sign-out-alt"></i></span>
                                        <span class="" style="margin-top: -5px;"> Salir </span></a>
                                </div>
                            </li>
                            @endrole
                        </ul>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endguest
                </div>
            </div>
        </nav>

        <main class="mb-5">
            @yield('content')
        </main>
        <span class="mb-5"> .</span>

    </div>
    
    <nav class="navbar-light bg-light fixed-bottom mt-5" style="padding-bottom: 0;">
        @guest
            <ul class="nav justify-content-around" style="margin-bottom: -1em;">
                <li class="nav-item text-center">
                    <a class="nav-link" href="{{ url('/home') }}">
                        <span class="nav-app-icon text-light"><i class="fas fa-home"></i></span>
                        <p class="text-dark" style="margin-top: -5px;"> Home</p>
                    </a>
                </li>
                <li class="nav-item text-center">
                    <a class="nav-link" href="{{ url('/login') }}">
                        <span class="nav-app-icon text-dark"><i class="fas fa-sign-in-alt"></i></span>
                        <p class="text-dark" style="margin-top: -5px;"> Ingresar</p>
                    </a>
                </li>
                <li class="align-self-end nav-item text-center">
                    <a class="nav-link" href="{{ url('/register') }}">
                        <span class="nav-app-icon text-dark"><i class="fas fa-user-plus"></i></span>
                        <p class="text-dark" style="margin-top: -5px;"> Registrarse</p>
                    </a>
                </li>
            </ul>
        @else
            <ul class="nav justify-content-around" style="margin-bottom: -1em;">
                <li class="nav-item text-center">
                    <a class="nav-link" href="{{ url('/home') }}">
                        <span class="nav-app-icon text-dark"><i class="fas fa-newspaper"></i></span>
                        <p class="text-dark" style="margin-top: -5px;"> Noticias</p>
                    </a>
                </li>
                <li class="nav-item text-center">
                    <a class="nav-link" href="{{ url('/team') }}">
                        <span class="nav-app-icon text-dark"><i class="fas fa-hard-hat"></i></span>
                        <p class="text-dark" style="margin-top: -5px;"> Tecun</p>
                    </a>
                </li>
                <li class="align-self-end nav-item text-center">
                    <a class="nav-link" href="{{ url('entretenimiento') }}">
                        <span class="nav-app-icon text-dark"><i class="fas fa-gamepad"></i></span>
                        <p class="text-dark" style="margin-top: -5px;"> Juegos</p>
                    </a>
                </li>
            </ul>
        @endguest
    </nav>


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
