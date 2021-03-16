<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }} |
        {{ substr(request()->getRequestUri(), 1) }}</title>
    @production
        <!-- Global site tag (gtag.js) - Google Analytics -->

        <script async src="https://www.googletagmanager.com/gtag/js?id=G-1MEL3W36E9"></script>

        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());



            gtag('config', 'G-1MEL3W36E9');

        </script>
    @endproduction
    <meta name="description" content="{{ config('app.name', 'Laravel') }} |
    {{ substr(request()->getRequestUri(), 1) }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
        integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
        integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">


    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />


    {{-- estilos de letras --}}
    <link rel="stylesheet" href="{{ asset('css/EstiloLetras.css') }}">
    {{-- diseño botones --}}
    <link rel="stylesheet" href="{{ asset('css/btn.css') }}">

    {{-- funcion js para cerrar --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}

    {{-- diseno de barra de mensaje 
        <style>
        #hellobar-bar {
            font-family: "Open Sans", sans-serif;
            width: 100%;
            margin: 0;
            height: 30px;
            display: table;
            font-size: 17px;
            font-weight: 400;
            padding: .33em .5em;
            -webkit-font-smoothing: antialiased;
            color: #5c5e60;
            position: absolute;
            background-color: white;
            box-shadow: 0 1px 3px 2px rgba(0, 0, 0, 0.15);
            z-index: 1;
        }

        #hellobar-bar.regular {
            height: 30px;
            font-size: 14px;
            padding: .2em .5em;
        }

        .hb-content-wrapper {
            text-align: center;
            text-align: center;
            position: relative;
            display: table-cell;
            vertical-align: middle;
        }

        .hb-content-wrapper p {
            margin-top: 0;
            margin-bottom: 0;
        }

        .hb-text-wrapper {
            margin-right: .67em;
            display: inline-block;
            line-height: 1.3;
        }

        .hb-text-wrapper .hb-headline-text {
            font-size: 1em;
            display: inline-block;
            vertical-align: middle;
        }

        #hellobar-bar .hb-cta {
            display: inline-block;
            vertical-align: middle;
            margin: 5px 0;
            color: #ffffff;
            background-color: #22af73;
            border-color: #22af73
        }

        .hb-cta-button {
            opacity: 1;
            color: #fff;
            display: block;
            cursor: pointer;
            line-height: 1.5;
            max-width: 22.5em;
            text-align: center;
            position: relative;
            border-radius: 3px;
            white-space: nowrap;
            margin: 1.75em auto 0;
            text-decoration: none;
            padding: 0;
            overflow: hidden;
        }

        .hb-cta-button .hb-text-holder {
            border-radius: inherit;
            padding: 5px 15px;
        }

        .hb-close-wrapper {
            display: table-cell;
            width: 1.6em;
        }

        .hb-close-wrapper .icon-close {
            font-size: 14px;
            top: 15px;
            right: 25px;
            width: 15px;
            height: 15px;
            opacity: .3;
            color: #000;
            cursor: pointer;
            position: absolute;
            text-align: center;
            line-height: 15px;
            z-index: 1;
            text-decoration: none;
        }

    </style> --}}


    <style>
        /* estilo texto */

        /* arial_narrow_7 */

        @font-face {
            font-family: 'arial_narrow_7';
            src: url("{{ asset('/fonts/fonts/arial_narrow_7.ttf') }}");
            font-style: normal;
            font-weight: 400;
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
        }

        /* Rubik_Bold */

        @font-face {
            font-family: 'Rubik_Bold';
            src: url("{{ asset('/fonts/fonts/Rubik_Bold.ttf') }}");
            font-style: normal;
            font-weight: 400;
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
        }

        /* Rubik-Black */

        @font-face {
            font-family: 'Rubik-Black';
            src: url("{{ asset('/fonts/fonts/Rubik-Black.ttf') }}");
            font-style: normal;
            font-weight: 400;
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
        }

        /* Rubik-BlackItalic */

        @font-face {
            font-family: 'Rubik-BlackItalic';
            src: url("{{ asset('/fonts/fonts/Rubik-BlackItalic.ttf') }}");
            font-style: normal;
            font-weight: 400;
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
        }

        /* Rubik-BoldItalic */

        @font-face {
            font-family: 'Rubik-BoldItalic';
            src: url("{{ asset('/fonts/fonts/Rubik-BoldItalic.ttf') }}");
            font-style: normal;
            font-weight: 400;
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
        }

        /* Rubik-Italic */

        @font-face {
            font-family: 'Rubik-Italic';
            src: url("{{ asset('/fonts/fonts/Rubik-Italic.ttf') }}");
            font-style: normal;
            font-weight: 400;
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
        }

        /* Rubik-Light */

        @font-face {
            font-family: 'Rubik-Light';
            src: url("{{ asset('/fonts/fonts/Rubik-Light.ttf') }}");
            font-style: normal;
            font-weight: 400;
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
        }

        /* Rubik-LightItalic */

        @font-face {
            font-family: 'Rubik-LightItalic';
            src: url("{{ asset('/fonts/fonts/Rubik-LightItalic.ttf') }}");
            font-style: normal;
            font-weight: 400;
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
        }

        /* Rubik-Medium */

        @font-face {
            font-family: 'Rubik-Medium';
            src: url("{{ asset('fonts/fonts/Rubik-Medium.ttf') }}");
            font-style: normal;
            font-weight: 400;
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
        }

        /* Rubik-MediumItalic */

        @font-face {
            font-family: 'Rubik-MediumItalic';
            src: url("{{ asset('/fonts/fonts/Rubik-MediumItalic.ttf') }}");
            font-style: normal;
            font-weight: 400;
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
        }

        /* Rubik-Regular */

        @font-face {
            font-family: 'Rubik-Regular';
            src: url("{{ asset('/fonts/fonts/Rubik-Regular.ttf') }}");
            font-style: normal;
            font-weight: 400;
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
        }

        /* Rubik-SemiBold */

        @font-face {
            font-family: 'Rubik-SemiBold';
            src: url("{{ asset('/fonts/fonts/Rubik-SemiBold.ttf') }}");
            font-style: normal;
            font-weight: 400;
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
        }

        /* fin de  estilo texto */

        /* clases css para implementar fuentes */

        .arial_narrow_7 {
            font-family: 'arial_narrow_7';
        }

        .Rubik_Bold {
            font-family: 'Rubik_Bold';
        }

        .Rubik-Black {
            font-family: 'Rubik-Black';
        }

        .Rubik-BlackItalic {
            font-family: 'Rubik-BlackItalic';
        }

        .Rubik-BoldItalic {
            font-family: 'Rubik-BoldItalic';
        }

        .Rubik-Italic {
            font-family: 'Rubik-Italic';
        }

        .Rubik-Light {
            font-family: 'Rubik-Light';
        }

        .Rubik-LightItalic {
            font-family: 'Rubik-LightItalic';
        }

        .Rubik-Medium {
            font-family: 'Rubik-Medium';
        }

        .Rubik-MediumItalic {
            font-family: 'Rubik-MediumItalic';
        }

        .Rubik-Regular {
            font-family: 'Rubik-Medium';
        }

        .Rubik-SemiBold {
            font-family: 'Rubik-MediumItalic';
        }




        /**  fin de estilo de letras**/


        .navbar {
            box-shadow: 2px 2px 5px #000;
            opacity: 0.9;
        }

        .navbar .nav-item .nav-link {
            color: #fff;
        }

        .main-header {
            position: relative;
            background: url(../img/fondo.png);
            background-size: cover;
            min-height 700px;
        }

        .background-overlay {
            background: rgba(48, 51, 107, .7);
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .form-control,
        .btn {
            border-radius: 0;
        }

        .sistDe {
            font-size: 300%;
            color: white;
        }

        .factDigi {
            margin-top: -2%;
            font-size: 350%;
            color: white;
        }

        .platProdu {
            font-size: 16px;
            margin-right: 14%;
            margin-left: 14%;
            color: white;
            text-align: center;
        }

        .btnEmpieza {
            margin: 10px;
            box-shadow: 0px 2px 0px 2px rgb(0, 0, 0);
        }

        .btnEmpieza:hover {
            background: rgb(0, 21, 115);
            background: linear-gradient(172deg, rgba(0, 21, 115, 1) 47%, rgba(5, 9, 46, 1) 100%);
            border: 0px;
        }


        .imgsisdefacin {
            width: 105%;
        }

        .txtsisdefacin {
            color: #000000;
            font-size: 100%;
        }

        .integral {
            color: #097FF5;
            font-size: 175%;
        }


        .imgiconossistema_Facturacion {

            margin: 0%;
            margin-top: 15%;
            margin-bottom: 0%;
            width: 20%;
        }

        .grup_img_iconos {
            background: rgb(0, 24, 132);
            background: -moz-linear-gradient(80deg, rgba(0, 24, 132, 1) 26%, rgba(9, 127, 245, 1) 100%);
            background: -webkit-linear-gradient(80deg, rgba(0, 24, 132, 1) 26%, rgba(9, 127, 245, 1) 100%);
            background: linear-gradient(80deg, rgba(0, 24, 132, 1) 26%, rgba(9, 127, 245, 1) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#001884", endColorstr="#097ff5", GradientType=1);
        }

        .grup_text_iconos {
            margin-bottom: -5%;
            font-family: 'Rubik_Bold';
            color: white;
        }

        .border_card_finish {

            background-color: #ffffff;
            text-align: center;
            background: #38f509;
            border-left: #000 2px solid;
            border-radius: 15px 15px 15px 15px;
            -moz-border-radius: 15px 15px 15px 15px;
            -webkit-border-radius: 15px 15px 15px 15px;
        }

        .team,
        footer {
            background: #30336b;
        }

        .test {
            background-image: url("{{ asset('img/bg/bg-blue1.svg') }}");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
            background-color: #66999;
        }

        .fondoPublicaciones {
            background: rgb(1, 19, 99);
            background: -moz-linear-gradient(63deg, rgba(1, 19, 99, 1) 0%, rgba(0, 24, 132, 1) 42%, rgba(9, 127, 245, 1) 99%);
            background: -webkit-linear-gradient(63deg, rgba(1, 19, 99, 1) 0%, rgba(0, 24, 132, 1) 42%, rgba(9, 127, 245, 1) 99%);
            background: linear-gradient(63deg, rgba(1, 19, 99, 1) 0%, rgba(0, 24, 132, 1) 42%, rgba(9, 127, 245, 1) 99%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#011363", endColorstr="#097ff5", GradientType=1);
        }



        hr {
            background: #011363;
        }

    </style>



</head>

<body class="fondoPublicaciones">




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
                            <a class="nav-link " href="{{ url('/') }}">INICIO </a>
                        </li>

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

    {{-- mensajes de barra superiores 
        <div id="hellobar-bar" class="regular closable">
        <div class="hb-content-wrapper">
            <div class="hb-text-wrapper">
                <div class="hb-headline-text">
                    <a href="javascript:onClick=window.close()"><br>
                        Cerrar</a>
                    <p><span>Regístrate ya en
                            <br> programacion.net y accederas a multitud de tutoriales gratuitos
                            <br> programacion.net y accederas a multitud de tutoriales gratuitos
                            <br> programacion.net y accederas a multitud de tutoriales gratuitos
                            <br> programacion.net y accederas a multitud de tutoriales gratuitos
                            <br> programacion.net y accederas a multitud de tutoriales gratuitos
                            <br> programacion.net y accederas a multitud de tutoriales gratuitos
                            <br> programacion.net y accederas a multitud de tutoriales gratuitos
                            <br> programacion.net y accederas a multitud de tutoriales gratuitos</span></p>

                </div>
            </div>
            <a href="http://www.programacion.net" target="_blank" class="hb-cta hb-cta-button">
                <div class="hb-text-holder">
                    <p>Regístrate</p>
                </div>
            </a>
        </div>
        <div class="hb-close-wrapper">
            <a href="javascript:void(0);" class="icon-close" onclick="$('#hellobar-bar').fadeOut()">✖</a>
        </div>
    </div> --}}


    {{-- controla tu empresa --}}
    <div class="row">
        <div
            class="col-12 col-sm-12 col-md-8 col-lg-8  offset-md-2 offset-lg-2 text-center justify-content-center mt-5">
            <h1>
                <img src="img/Logo-BigBill.svg" height="50px">
                <label class="text-light Rubik_Bold">
                    CONTROLA TU EMPRESA
                </label>
                <br>
            </h1>

            <div class="card-deck mt-4">
                <div class="row justify-content-center">
                    {{-- publicacion --}}
                    @foreach ($records as $item)
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <br>
                            <div class="card rounded" style="background-color: #ffffff;">
                                <div class="fondoPublicaciones media pt-3 pb-5">
                                    <div class="media-body">
                                        <h5 class=" mr-1 ml-1 text-light Rubik-Medium ">
                                            <strong> {{ $item->title }}</strong>
                                        </h5>
                                    </div>
                                </div>
                                {{-- <a href="#popup1"> --}}


                                <div style="background-color: #ffffff; border-radius: 100% 100% 0 0/ 20% 20% 0 0; margin-top: -3em;"
                                    class="card-text">
                                    @if ($item->file != null)
                                        <img src="{{ asset('/storage/adds/' . $item->file) }}" class="mt-3"
                                            height="180px" width="175px">
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
                                {{-- </a> --}}
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
            <br><br><br><br>
        </div>
    </div>




    {{-- <div id="popup1" class="overlay">
        <div class="popup">
            <h2>Here i am</h2>
            <a class="close" href="#">&times;</a>
            <div class="content">
                Thank to pop me out of that button, but now i'm done so you can close this window.
            </div>
        </div>
    </div> --}}
    {{-- <a href="javascript:ventanaSecundaria('https://www.facebook.com/ideacodex') "> Pincha en este enlace para abrir la
        ventana secundaria</a>
    <a href="http://0.0.0.0:3000/Ver_Publicaciones#" target="_blank">Abre el enlace en una nueva ventana</a> --}}
</body>


{{-- <script language=javascript>
    function ventanaSecundaria(URL) {
        window.open(URL, "ventana1", "width=500,height=300,scrollbars=NO")
    }

    ventanaSecundaria("https://www.facebook.com/ideacodex");

</script> --}}
{{-- <script language=javascript>
    function ventanaSecundaria1(URL) {
        window.open(URL, "ventana2", "width=500,height=300,scrollbars=NO")
    }

    ventanaSecundaria1("https://www.facebook.com/ideacodex");

</script>
<script language=javascript>
    function ventanaSecundaria2(URL) {
        window.open(URL, "ventana3", "width=500,height=300,scrollbars=NO")
    }

    ventanaSecundaria2("https://www.facebook.com/ideacodex");

</script>
<script language=javascript>
    function ventanaSecundaria3(URL) {
        window.open(URL, "ventana4", "width=500,height=300,scrollbars=NO")
    }

    ventanaSecundaria3("https://www.facebook.com/ideacodex");

</script>
<script language=javascript>
    function ventanaSecundaria4(URL) {
        window.open(URL, "ventana5", "width=500,height=300,scrollbars=NO")
    }

    ventanaSecundaria4("https://www.facebook.com/ideacodex");

</script> --}}
{{-- <script>
    function ventanaSecundaria(URL) {
        window.open(URL, "ventana1", "width=120,height=300,scrollbars=NO")
    }

</script> --}}

</html>
