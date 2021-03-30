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

    {{-- Anuncios --}}
    <input type="checkbox" id="cerrar">
    <label for="cerrar" id="btn-cerrar"> <b>X</b></label>
    <div class="modals">
        {{-- @if ($records) --}}
        {{-- <div class="contenido">
            @foreach ($records as $item)
                @if ($item != null)
                    <h2 class=" Rubik-Medium " style="color: rgba(5, 9, 46, 1)">
                        <strong> {{ $item->title }}</strong>
                    </h2>
                    <br>
                    <br>
                    <div style="background-color: #050033; border-radius: 100% 100% 0 0/ 20% 20% 0 0; margin-top: -3em;"
                        class="card-text">
                        @if ($item->file != null)
                            <img src="{{ asset('/storage/adds/' . $item->file) }}" class="mt-3" height="180px"
                                width="175px">
                        @else
                            <img src="img/simbolo_logo.png" class="mt-3" width="175px">
                        @endif

                        <p class="pt-1 ml-4 mr-3 Rubik-Medium">
                            {{ $item->description }}
                        </p>
                        @if ($item->link != null)
                            <hr>
                            <a href=" {{ $item->link }}">
                                <button class="bttn-unite bttn-md bttn-primary">
                                    ¡Conoce más!
                                </button>
                            </a>
                            <br>
                        @endif
                        <br>
                    </div>

                @else
                    <h2 class=" Rubik-Medium " style="color: rgba(5, 9, 46, 1)">
                        <strong> Bienvenido a Big Bill</strong>
                    </h2>
                    <br>
                    <br>
                    <div style="background-color: #050033; border-radius: 100% 100% 0 0/ 20% 20% 0 0; margin-top: -3em;"
                        class="card-text">
                        <img src="img/simbolo_logo.png" class="mt-3" width="175px">
                        <p class="pt-1 ml-4 mr-3 Rubik-Medium">
                            Plataforma en línea que te permitirá emitir comprobantes de pagos, además de crear facturas,
                            podrás llevar el control de tu stock de productos.
                        </p>

                        <hr>
                        <a href="{{ url('/register') }}">
                            <button class="bttn-unite bttn-md bttn-primary">
                                ¡Unete y prueba la diferencia!
                            </button>
                        </a>
                        <br>
                        <br>
                    </div>
                @endif
            @endforeach
        </div> --}}
        {{-- @else --}}
        <div class="contenido">
            <h2 class=" Rubik-Medium " style="color: rgba(5, 9, 46, 1)">
                <strong> Bienvenido a Big Bill</strong>
            </h2>
            <br>
            <br>
            <div style="background-color: #050033; border-radius: 100% 100% 0 0/ 20% 20% 0 0; margin-top: -3em;"
                class="card-text">
                <img src="img/simbolo_logo.png" class="mt-3" width="175px">
                <p class="pt-1 ml-4 mr-3 Rubik-Medium">
                    Plataforma en linea que te permite registrar y organizar las ventas y compras de tu empresa ,
                    actualmente es una plataforma GRATIS el precio por usuario será un aproximado de Q55 probablemente en
                    Junio 2021
                </p>

                <hr>
                <a href="{{ url('/register') }}">
                    <button class="bttn-unite bttn-md bttn-primary">
                        ¡Unete y prueba la diferencia!
                    </button>
                    <br>
                </a>
                <br>
                <br>
                <br> <br>
            </div>
            <br>
        </div>
        {{-- @endif --}}
    </div>
    {{-- fin de anuncios --}}

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
                <div class="collapse navbar-collapse Rubik-Medium" id="navbarNav">
                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item">
                            <a class="nav-link" href="#soluciones">SOLUCIONES</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#beneficios">BENEFICIOS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#precios">PRECIOS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#guia">GUÍA DE USO</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ url('Ver_Publicaciones') }}">PUBLICACIONES</a>
                        </li> --}}
                        @auth
                            <li class="nav-item">
                                <a class="btn btn-primary nav-link" style="border-radius: 15px;"
                                    href="{{ url('/perfil') }}">PERFIL</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="btn btn-primary nav-link" style="border-radius: 15px;"
                                    href="{{ route('login') }}">INICIO DE SESION</a>
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
                <br><br>
                <img src="img/Isotipo-BigBill.svg" width="20%" class="img-fluid mx-auto d-block mt-5">
                <span class="Rubik-Regular sistDe">
                    SISTEMA DE
                </span>
                <br>
                <h1 class="Rubik_Bold factDigi">
                    FACTURACIÓN DIGITAL
                </h1>

                <label class="Rubik-Medium platProdu">
                    Plataforma en línea que te permitirá emitir comprobantes de pagos, además de crear facturas, podrás
                    llevar el control de tu stock de productos.
                </label>
                <br>

                @auth
                    <a href="{{ url('/perfil') }}" class="btn btn-light Rubik-Medium btnEmpieza" style="border-radius: 15px;">
                        <span class="text-primary ">TRABAJEMOS</span>
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-light Rubik-Medium btnEmpieza"
                        style="border-radius: 15px;">
                        <span class="text-primary ">EMPIEZA HOY MISMO</span>
                    </a>
                @endauth
            </div>
            <div
                class="col-12 col-sm-12 col-md-6 col-lg-6 mt-3 animate__animated animate__pulse animate__infinite animate__slower">
                <img src="img/Computadora-Telefono.svg" width="75%" class="img-fluid mx-auto d-block">
            </div>
        </div>
    </div>
    {{-- sistema de facturacion --}}

    <div class="bg-light pb-5 pt-5" id="beneficios">
        <div class="row">
            <div
                class="col-12 col-sm-12 col-md-6 col-lg-6 offset-md-3 offset-lg-3 text-center justify-content-center mt-5  ">
                <h1>
                    <div class="d-lg-none Rubik_Bold">
                        <label class=" d-lg-none txtsisdefacin">
                            SISTEMA DE FACTURACIÓN
                        </label>
                        <br>
                        <label class=" integral">
                            INTEGRAL
                        </label>
                    </div>
                    <div class="d-none d-lg-block">
                        <img src="{{ asset('/img/sisdefacin.png') }}" class="imgsisdefacin"
                            alt="Sistema de Facturación Integral" title="Sistema de Facturación Integral">
                    </div>
                </h1>
                <label class="Rubik-Medium">
                    Al hablar de un sistema de facturación diseñado INTEGRAL para las pequeñas y medianas empresas nos
                    referimos específicamente a un software capaz de satisfacer el volumen de facturación de estos negocios,
                    y que al mismo tiempo les ofrece funcionalidades que ayuden a una mejor gestión, sin importar el nivel
                    de especialización de quien lo use.
                </label>
            </div>
        </div>
    </div>
    {{-- iconos --}}
    <div class="row pb-5 justify-content-center grup_img_iconos ">
        <div class="col-6 col-md-3 col-lg-2  justify-content-center text-center">
            <img src="{{ asset('img/ICONO_FACTURACIÓN.svg') }}" width="30%" class="imgiconossistema_Facturacion">
            <br> <br>
            <h4 class="grup_text_iconos  mt-3">Facturación</h4>
        </div>
        <div class="col-6 col-md-3 col-lg-2  justify-content-center text-center">
            <img src="{{ asset('img/ICONO_GASTOS.svg') }}" width="30%" class="imgiconossistema_Facturacion">
            <br> <br>
            <h4 class="grup_text_iconos  mt-3">Gastos</h4>
        </div>
        <div class="col-6 col-md-3 col-lg-2  justify-content-center text-center">
            <img src="{{ asset('img/ICONO_REPORTES.svg') }}" width="30%" class="imgiconossistema_Facturacion">
            <br> <br>
            <h4 class="grup_text_iconos  mt-3">Reportes</h4>
        </div>
        <div class="col-6 col-md-3 col-lg-2  justify-content-center text-center">
            <img src="{{ asset('img/ICONO_INVENTARIOS.svg') }}" width="30%" class="imgiconossistema_Facturacion">
            <br> <br>
            <h4 class="grup_text_iconos  mt-3">Inventarios</h4>
        </div>
        <div class="col-6 col-md-3 col-lg-2  justify-content-center text-center">
            <img src="{{ asset('img/ICONO_MULTIPLES_USUARIOS.svg') }}" width="30%" class="imgiconossistema_Facturacion">
            <br> <br>
            <h4 class="grup_text_iconos  mt-3">Múltiples<br> Usuarios</h4>
        </div>
    </div>

    {{-- controla tu empresa --}}
    <div class="bg-light mt-5" id="soluciones">
        <div class="mt-5">
            <div
                class="col-12 col-sm-12 col-md-8 col-lg-8  offset-md-2 offset-lg-2 text-center justify-content-center mt-5">
                <h1>
                    <label class="text-primary Rubik_Bold">
                        CONTROLA TU EMPRESA
                    </label>
                    <br>
                    <label class="Rubik-Medium">
                        DESDE CUALQUIER LUGAR
                        <br>
                        CON ESTE SISTEMA
                    </label>
                </h1>
                </a>
                <div class="card-deck mt-4">
                    {{-- SEGURIDADEN LA NUBE --}}
                    <div class="card rounded" style="background-color: #ffffff;">
                        <div class="bg-primary media pt-3 pb-5">
                            <img src="img/ICONO_SEGURIDAD_EN_LA_NUBE.svg" class="m-3" height="60px">
                            <div class="media-body">
                                <h5 class="mt-0 mr-2 ml-2 text-light Rubik-Medium ">
                                    SEGURIDADEN LA NUBE
                                </h5>
                            </div>
                        </div>
                        <div style="background-color: #ffffff; border-radius: 100% 100% 0 0/ 20% 20% 0 0; margin-top: -3em;"
                            class="card-text">
                            <p class="pt-5 ml-4 mr-4 Rubik-Medium">
                                Solo tú tienes acceso a tus documentos por medio de tu contraseña. Toda tu información se
                                encripta de forma segura BIG BILL te proporciona la más alta privacidad y seguridad.
                            </p>
                        </div>
                    </div>

                    {{-- MANEJO DE MÚLTIPLES EMPRESAS --}}

                    <div class="card rounded" style="background-color: #ffffff;">
                        <div class="bg-primary media pt-3 pb-5">
                            <img src="img/ICONO_MANEJO_MULTIPLE_EMPRESAS.svg" class="m-3" height="60px">
                            <div class="media-body">
                                <h5 class="mt-0 mr-2 ml-2 text-light Rubik-Medium">
                                    MANEJO DE MÚLTIPLES EMPRESAS
                                </h5>
                            </div>
                        </div>
                        <div style="background-color: #ffffff; border-radius: 100% 100% 0 0/ 20% 20% 0 0; margin-top: -3em;"
                            class="card-text">
                            <p class="pt-5 ml-4 mr-4 Rubik-Medium">
                                Puedes tener trabajando más de una empresa desde la misma cuenta sin ningún problema.
                            </p>
                        </div>
                    </div>


                    {{-- EXPERIENCIA INTEGRAL --}}
                    <div class="card rounded" style="background-color: #ffffff;">
                        <div class="bg-primary media pt-3 pb-5">
                            <img src="img/ICONO_EXPERIENCIA_INTEGRAL.svg" class="m-3" height="60px">
                            <div class="media-body">
                                <h5 class="mt-0 mr-2 ml-2 text-light Rubik-Medium">
                                    EXPERIENCIA INTEGRAL
                                </h5>
                            </div>
                        </div>
                        <div style="background-color: #ffffff; border-radius: 100% 100% 0 0/ 20% 20% 0 0; margin-top: -3em;"
                            class="card-text">
                            <p class="pt-5 ml-4 mr-4 Rubik-Medium">
                                Que la experiencia de navegación de los usuarios sea amena, clara y ordenada, para que todos
                                puedan poner en marcha casi al instanteusus procesos administrativos.
                            </p>
                        </div>
                    </div>

                </div>
                <br><br><br><br>
            </div>
        </div>
    </div>

    {{-- Precios --}}
    <div class="bg-frm mt-5" id="precios">

        <style>
            .img-contenedor img {
                -webkit-transition: all .9s ease;
                /* Safari y Chrome */
                -moz-transition: all .9s ease;
                /* Firefox */
                -o-transition: all .9s ease;
                /* IE 9 */
                -ms-transition: all .9s ease;
                /* Opera */
                width: 100%;
            }

            .img-contenedor:hover img {
                -webkit-transform: scale(1.25);
                -moz-transform: scale(1.25);
                -ms-transform: scale(1.25);
                -o-transform: scale(1.25);
                transform: scale(1.25);
            }

        </style>

        <div id="FondoParteDeOndas" class="FondoParteDeOndas">
            <svg class="wavesdecabeza" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <defs>

                    <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                </defs>
                <g class="parallax">

                    <use xlink:href="#gentle-wave" x="25" y="0" fill="rgba(86,174,249,0.7)" />
                    <use xlink:href="#gentle-wave" x="35" y="2" fill="rgba(50,120,250,0.5)" />
                    <use xlink:href="#gentle-wave" x="45" y="5" fill="rgba(255,255,255,0.3)" />
                    <use xlink:href="#gentle-wave" x="55" y="9" fill="rgb(72, 141, 243)" />
                </g>
            </svg>
        </div>
        <div class="mt-5">
            <div
                class="col-12 col-sm-12 col-md-8 col-lg-8  offset-md-2 offset-lg-2 text-center justify-content-center mt-5">
                <div class="card-deck mt-4">
                    {{-- BÁSICO --}}
                    <div id="img-contenedor" class="card rounded border-0 img-contenedor"
                        style="background-color: transparent;">
                        <a href="register"><img src="{{ asset('images/basico.svg') }}" alt=""></a>
                    </div>

                    {{-- ESTÁNDAR --}}
                    <div class="card rounded border-0 img-contenedor" style="background-color: transparent;">
                        <a href="{{ url('https://api.whatsapp.com/send?phone=50233120413') }}"><img
                                src="{{ asset('images/estandar.svg') }}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Precios --}}

    {{-- Guía de uso --}}
    <div class="bg-guia mt-5" id="guia">

        <style>
            .img-contenedor img {
                -webkit-transition: all .9s ease;
                /* Safari y Chrome */
                -moz-transition: all .9s ease;
                /* Firefox */
                -o-transition: all .9s ease;
                /* IE 9 */
                -ms-transition: all .9s ease;
                /* Opera */
                width: 100%;
            }

            .img-contenedor:hover img {
                -webkit-transform: scale(1.25);
                -moz-transform: scale(1.25);
                -ms-transform: scale(1.25);
                -o-transform: scale(1.25);
                transform: scale(1.25);
            }

        </style>
        <div id="FondoParteDeOndas" class="FondoParteDeOndas">
            <svg class="wavesdecabeza" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <defs>

                    <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                </defs>
                <g class="parallax">

                    <use xlink:href="#gentle-wave" x="25" y="0" fill="rgba(86,174,249,0.7)" />
                    <use xlink:href="#gentle-wave" x="35" y="2" fill="rgba(50,120,250,0.5)" />
                    <use xlink:href="#gentle-wave" x="45" y="5" fill="rgba(255,255,255,0.3)" />
                    <use xlink:href="#gentle-wave" x="55" y="9" fill="rgb(72, 141, 243)" />
                </g>
            </svg>
        </div>

        <div class="mt-5">
            <div
                class="col-12 col-sm-12 col-md-8 col-lg-8  offset-md-2 offset-lg-2 text-center justify-content-center mt-5">
                <div class="card-deck mt-4">
                    <div id="img-contenedor" class="card rounded border-0 img-contenedor"
                        style="background-color: transparent;">
                        <h1 class="text-primary"><b>GUÍA RÁPIDA <br> DE USO</b></h1>
                        <h3>
                            <b>Con esta guía aprenderás desde el registro hasta cómo cargar tus productos y hacer una
                                factura.</b>
                        </h3>
                    </div>
                    <div id="img-contenedor" class="card rounded border-0 img-contenedor"
                        style="background-color: transparent;">
                        <div class="card-header bg-primary rounded-top">
                            <strong class="text-light">¡Aprende con nosotros! </strong>
                        </div>
                        <iframe allowfullscreen class="video" src="https://www.youtube.com/embed/ZMu32-FBH9g"></iframe>
                    </div>
                </div>
                <br><br>
                <div id="accordion">
                    {{-- Registro --}}
                    <div class="card">
                        <div class="card-header bg-primary" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link text-light text-left" data-toggle="collapse"
                                    data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <b>Paso #1: ¿Cómo me registro?</b>
                                </button>
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-deck mt-4">
                                <div id="img-contenedor" class="card rounded border-0 img-contenedor"
                                    style="background-color: transparent;">
                                    <div class="card-header bg-primary rounded-top">
                                        <strong class="text-light">¡Aprende con nosotros! </strong>
                                    </div>
                                    <iframe allowfullscreen class="video"
                                        src="https://www.youtube.com/embed/NR7vZmhXujA"></iframe>
                                </div>
                                <div id="img-contenedor" class="card rounded border-0 img-contenedor"
                                    style="background-color: transparent;">
                                    <h1 class="text-primary"><b>¿CÓMO ME REGISTRO?</b></h1>
                                    <h4>
                                        <b>Crea tu usuario desde los siguientes botones.</b>
                                    </h4>
                                    <h4>
                                        <a href="register"><b>Regístrate aquí.</b></a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Ingreso de empresa o negocio --}}
                    <div class="card">
                        <div class="card-header bg-primary" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed text-light text-left" data-toggle="collapse"
                                    data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <b>Paso #2 ¿Cómo ingreso mi empresa o negocio?</b>
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-deck mt-4">
                                <div id="img-contenedor" class="card rounded border-0 img-contenedor"
                                    style="background-color: transparent;">
                                    <h1 class="text-primary"><b>¿CÓMO INGRESO MI EMPRESA O NEGOCIO?</b></h1>
                                    <h4>
                                        <b>Crea tu empresa con los siguientes pasos.</b>
                                    </h4>
                                </div>
                                <div id="img-contenedor" class="card rounded border-0 img-contenedor"
                                    style="background-color: transparent;">
                                    <div class="card-header bg-primary rounded-top">
                                        <strong class="text-light">¡Aprende con nosotros! </strong>
                                    </div>
                                    <iframe allowfullscreen class="video"
                                        src="https://www.youtube.com/embed/6Ty86kO4IbM"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Crear perfil --}}
                    <div class="card">
                        <div class="card-header bg-primary" id="headingThree">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed text-light text-left" data-toggle="collapse"
                                    data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <b>Paso #3: ¿Cómo crear mi perfil?</b>
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-deck mt-4">
                                <div id="img-contenedor" class="card rounded border-0 img-contenedor"
                                    style="background-color: transparent;">
                                    <div class="card-header bg-primary rounded-top">
                                        <strong class="text-light">¡Aprende con nosotros! </strong>
                                    </div>
                                    <iframe allowfullscreen class="video"
                                        src="https://www.youtube.com/embed/MSKaOqXcqd8"></iframe>
                                </div>
                                <div id="img-contenedor" class="card rounded border-0 img-contenedor"
                                    style="background-color: transparent;">
                                    <h1 class="text-primary"><b>¿CÓMO CREAR MI PERFIL</b></h1>
                                    <h4>
                                        <b>Actualiza tu información siguiendo estos pasos.</b>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Agregar productos, sucursales y marcas --}}
                    <div class="card">
                        <div class="card-header bg-primary" id="headingFour">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed text-light text-left" data-toggle="collapse"
                                    data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    <b>Paso #4: ¿Cómo agregar clientes, sucursales, marcas, categorías y productos?</b>
                                </button>
                            </h5>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                            <div class="card-deck mt-4">
                                <div id="img-contenedor" class="card rounded border-0 img-contenedor"
                                    style="background-color: transparent;">
                                    <h1 class="text-primary"><b>REGISTRA CLIENTES Y PRODUCTOS.</b></h1>
                                    <h4>
                                        <b>Lleva el control de tus productos divididos por categorías y marcas.</b>
                                    </h4>
                                </div>
                                <div id="img-contenedor" class="card rounded border-0 img-contenedor"
                                    style="background-color: transparent;">
                                    <div class="card-header bg-primary rounded-top">
                                        <strong class="text-light">¡Aprende con nosotros! </strong>
                                    </div>
                                    <iframe allowfullscreen class="video"
                                        src="https://www.youtube.com/embed/UvRAIvVgrW0"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Registrar una venta --}}
                    <div class="card">
                        <div class="card-header bg-primary" id="headingFive">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed text-light text-left" data-toggle="collapse"
                                    data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    <b>Paso #5: ¿Cómo registrar una venta?</b>
                                </button>
                            </h5>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                            <div class="card-deck mt-4">
                                <div id="img-contenedor" class="card rounded border-0 img-contenedor"
                                    style="background-color: transparent;">
                                    <div class="card-header bg-primary rounded-top">
                                        <strong class="text-light">¡Aprende con nosotros! </strong>
                                    </div>
                                    <iframe allowfullscreen class="video"
                                        src="https://www.youtube.com/embed/cXxZiuPI94c"></iframe>
                                </div>
                                <div id="img-contenedor" class="card rounded border-0 img-contenedor"
                                    style="background-color: transparent;">
                                    <h1 class="text-primary"><b>¿CÓMO REGISTRAR UNA VENTA</b></h1>
                                    <h4>
                                        <b>Lleva el control de tus ventas y descuentos en inventarios de tus productos.</b>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Compras, estadísticas y datos de una empresa --}}
                    <div class="card">
                        <div class="card-header bg-primary" id="headingSix">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed text-light text-left" data-toggle="collapse"
                                    data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    <b>Paso #6: ¿Cómo registrar compras, ver estadísticas y cambiar datos de mi
                                        empresa?</b>
                                </button>
                            </h5>
                        </div>
                        <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                            <div class="card-deck mt-4">
                                <div id="img-contenedor" class="card rounded border-0 img-contenedor"
                                    style="background-color: transparent;">
                                    <h1 class="text-primary"><b>CREAR COMPRAS Y VER GRÁFICAS.</b></h1>
                                    <h4>
                                        <b>Visualiza las estadísticas de tu empresa según las ventas y gastos que hayas
                                            realizado.</b>
                                    </h4>
                                </div>
                                <div id="img-contenedor" class="card rounded border-0 img-contenedor"
                                    style="background-color: transparent;">
                                    <div class="card-header bg-primary rounded-top">
                                        <strong class="text-light">¡Aprende con nosotros! </strong>
                                    </div>
                                    <iframe allowfullscreen class="video"
                                        src="https://www.youtube.com/embed/NzO_w3qEPGA"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
    </div>
    {{-- Guía de uso --}}

    {{-- formulario --}}
    <iframe width="100%" height="680px"
        src="https://forms.office.com/Pages/ResponsePage.aspx?id=AU2umS8CRkKGrC3hIbMvK81dCKmVmN9PovbYEIWk9phUMDE5VFdVOUJaVTUzQVVLTDRPUEtCSzgyRi4u&embed=true"
        frameborder="0" marginwidth="0" marginheight="0" style="border: none; max-width:100%; max-height:100vh"
        allowfullscreen webkitallowfullscreen mozallowfullscreen msallowfullscreen> </iframe>


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
