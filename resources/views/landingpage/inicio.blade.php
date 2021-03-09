@extends('layouts.sesion')

@section('content')
    <style>
        .test {
            background-image: url("{{ asset('img/bg/bg-blue1.svg') }}");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
            background-color: #66999;
        }

    </style>
    <!-- NAVIGATION -->
    @if (Route::has('login'))
        <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: #000000">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img src="img/Logo-BigBill.svg" height="40px">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">INICIO</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/soluciones') }}">SOLUCIONES</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/beneficios') }}">BENEFICIOS</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="btn btn-primary nav-link" style="border-radius: 15px;"
                                    href="{{ url('/perfil') }}">PERFIL</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="btn btn-primary nav-link" style="border-radius: 15px;"
                                    href="{{ route('login') }}">Incio de sesion</a>
                            </li>
                        @endauth

                    </ul>
                </div>
            </div>
        </nav>
    @endif

    {{-- section top --}}
    <div class="test pt-5 pb-5">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 offset-md-1 offset-lg-1 text-center justify-content-center mt-5">
                <img src="img/Isotipo-BigBill.svg" width="30%" class="img-fluid mx-auto d-block mt-5">
                <h1 class="text-light">
                    SISTEMA DE <br> <strong>FACTURACIÓN DIGITAL</strong>
                </h1>
                <p class="text-light">Plataforma en línea que te permitirá emitir comprobantes de pago, además de crear
                    facturas, podrás llevar el control de inventario de tus productos</p>
                <a href="#leer" class="btn btn-light" style="border-radius: 15px;">
                    <span class="text-primary">EMPIEZA HOY MISMO</span>
                </a>
            </div>
            <div
                class="col-12 col-sm-12 col-md-6 col-lg-6 mt-3 animate__animated animate__pulse animate__infinite animate__slower">
                <img src="img/Computadora-Telefono.svg" width="75%" class="img-fluid mx-auto d-block">
            </div>
        </div>
    </div>


    <div class="bg-light mt-5">
        <div class="mt-5">
            <div
                class="col-12 col-sm-12 col-md-8 col-lg-8  offset-md-2 offset-lg-2 text-center justify-content-center mt-5">
                <h1>
                    <strong> <span class="text-primary">CONTROLA TU EMPRESA </span> <br> <span>DESDE CUALQUIER LUGAR
                            <br> CON ESTE SISTEMA</span> </strong>
                </h1>
                </a>
                <div class="card-deck mt-4">
                    <div class="card rounded" style="background-color: #ffffff;">
                        <div class="">
                            <div class="bg-primary media pt-3 pb-5">
                                <img src="img/Computadora-Telefono.svg" class="m-3" height="60px">
                                <div class="media-body">
                                    <h5 class="mt-0 mr-2 ml-2 text-light">SEGURIDAD EN LA NUBE</h5>
                                </div>
                            </div>
                            <div style="background-color: #ffffff; border-radius: 100% 100% 0 0/ 20% 20% 0 0; margin-top: -3em;"
                                class="card-text">
                                <p class="pt-5 ml-4 mr-4">Solo tú tienes acceso a tus documentos por medio de tu contraseña. Toda
                                    tu información se almacena de forma segura, BIG BILL proporciona alta privacidad y
                                    seguridad</p>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="background-color: #ffffff;">
                        <div class="">
                            <div class="bg-primary media pt-3 pb-5">
                                <img src="img/Computadora-Telefono.svg" class="m-3" height="60px">
                                <div class="media-body">
                                    <h5 class="mt-0 mr-2 ml-2 text-light">SEGURIDAD EN LA NUBE</h5>
                                </div>
                            </div>
                            <div style="background-color: #ffffff; border-radius: 100% 100% 0 0/ 20% 20% 0 0; margin-top: -3em;"
                                class="card-text">
                                <p class="pt-5 ml-4 mr-4">Solo tú tienes acceso a tus documentos por medio de tu contraseña. Toda
                                    tu información se almacena de forma segura, BIG BILL proporciona alta privacidad y
                                    seguridad</p>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="background-color: #ffffff;">
                        <div class="">
                            <div class="bg-primary media pt-3 pb-5">
                                <img src="img/Computadora-Telefono.svg" class="m-3" height="60px">
                                <div class="media-body">
                                    <h5 class="mt-0 mr-2 ml-2 text-light">SEGURIDAD EN LA NUBE</h5>
                                </div>
                            </div>
                            <div style="background-color: #ffffff; border-radius: 100% 100% 0 0/ 20% 20% 0 0; margin-top: -3em;"
                                class="card-text">
                                <p class="pt-5 ml-4 mr-4">Solo tú tienes acceso a tus documentos por medio de tu contraseña. Toda
                                    tu información se almacena de forma segura, BIG BILL proporciona alta privacidad y
                                    seguridad</p>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-light pb-5 pt-5">
        <div class="row">
            <div
                class="col-12 col-sm-12 col-md-6 col-lg-6  offset-md-3 offset-lg-3 text-center justify-content-center mt-5">
                <h1>
                    <strong> <span class="text-primary">SISTEMA DE </span> <br> <span>FACTURACIÓN INTEGRAL </strong>
                </h1>
                </a>
                <p>Al hablar de un sistema de facturación diseñado para las pequeñas y medianas empresas nos referimos
                    específicamente a un software capaz de satisfacer el volumen de facturación de estos negocios, y que
                    al mismo tiempo les ofrece funcionalidades que permiten una mejor gestión, sin importar el nivel de
                    especializacion de quien lo utiliza. </p>
            </div>
        </div>
    </div>
    <div>
        <div class="row pb-5">
            <div class="col-6 col-md-3 col-lg-3 bg-primary justify-content-center text-center">
                <img src="img/Isotipo-BigBill.svg" width="30%" class="img-fluid mx-auto d-block mt-5">
                <strong><h4 class="text-light mt-3">Gastos</h4></strong>
            </div>
            <div class="col-6 col-md-3 col-lg-3 bg-primary justify-content-center text-center">
                <img src="img/Isotipo-BigBill.svg" width="30%" class="img-fluid mx-auto d-block mt-5">
                <strong><h4 class="text-light mt-3">Reportes</h4></strong>
            </div>
            <div class="col-6 col-md-3 col-lg-3 bg-primary justify-content-center text-center">
                <img src="img/Isotipo-BigBill.svg" width="30%" class="img-fluid mx-auto d-block mt-5">
                <strong><h4 class="text-light mt-3">Inventarios</h4></strong>
            </div>
            <div class="col-6 col-md-3 col-lg-3 bg-primary justify-content-center text-center">
                <img src="img/Isotipo-BigBill.svg" width="30%" class="img-fluid mx-auto d-block mt-5">
                <strong><h4 class="text-light mt-3">Múltiples <br> Usuarios</h4></strong>
            </div>
        </div>
    </div>



    <!-- BOOTSTRAP SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
        integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous">
    </script>
@endsection
