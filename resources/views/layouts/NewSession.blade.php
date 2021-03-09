<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Iniciar Sesión</title>

    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
        integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
        integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

</head>
<style>
    /*Tamano de ondas*/
    .FondoParteDeOndasDecabeza {
        height: 20%;
        margin: 0%;
        width: 100%;
        position: absolute;
        top: 0%;
        margin-right: -1%;
    }

    .wavesdecabeza {
        margin-right: -1%;
        width: 100%;
        height: 100%;
        transform: rotate(180deg);
        -ms-transform: rotate(180deg);
        /* IE 9 */
        -webkit-transform: rotate(180deg);
        /* Opera, Chrome, and Safari */
    }

    /* Animation */
    .parallax>use {
        animation: move-forever 25s cubic-bezier(.55, .5, .45, .5) infinite;
    }

    .parallax>use:nth-child(1) {
        animation-delay: -2s;
        animation-duration: 10s;
    }

    .parallax>use:nth-child(2) {
        animation-delay: -3s;
        animation-duration: 15s;
    }

    .parallax>use:nth-child(3) {
        animation-delay: -4s;
        animation-duration: 20s;
    }

    .parallax>use:nth-child(4) {
        animation-delay: -5s;
        animation-duration: 25s;
    }

    @keyframes move-forever {
        0% {
            transform: translate3d(-90px, 0px, 0);
        }

        100% {
            transform: translate3d(85px, 0px, 0);
        }
    }

    /*Shrinking for mobile*/
    @media (max-width: 768px) {
        .waves {
            margin-right: -1%;
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

    /* Rubik */
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
        src: url("{{ asset('/fonts/fonts/Rubik-Medium.ttf') }}");
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



    .imglogotarjeta {
        margin-top: 20%;
        width: 35%;
    }

    /* Diseño tarjeta texto */
    .SisDe {
        color: white;
        font-size: 30px;
        font-family: 'Rubik-Regular';
    }

    .FacDig {
        color: white;
        font-size: 40px;
        font-family: 'Rubik_Bold';
        margin-top: -2%;
    }

    .PlaPro {
        color: white;
        font-size: 10px;
        font-family: 'Rubik-Medium';
        text-align: center;

        margin-left: 29.5%;
        margin-right: 29.5%;
    }

    .titulologYreg {
        font-family: 'Rubik-SemiBold';
        color: #3766ff;
        font-size: 30px;
    }

    /* cajatexto LOGIN */
    .cajatexto {
        /* borde del input */
        border: none;
        font-family: 'Rubik-Regular';
        border-left: #3766ff 7px solid;
        border-radius: 0px 15px 15px 0px;
        -moz-border-radius: 0px 15px 15px 0px;
        -webkit-border-radius: 0px 15px 15px 0px;
        /* fondo del input */
        background: #dddddd;
        padding: 10px;
        /* efectos del texto */
        text-align: left;
        font-size: 20px;
        color: #ffffff;
        font-weight: bold;
        /* ancho del input */
        width: 104%;
    }

    /* cajatexto 2 REGISTRAR */
    .cajatexto2 {
        /* borde del input */
        border: none;
        font-family: 'Rubik-Regular';
        border-left: #3766ff 7px solid;
        border-radius: 0px 15px 15px 0px;
        -moz-border-radius: 0px 15px 15px 0px;
        -webkit-border-radius: 0px 15px 15px 0px;
        /* fondo del input */
        background: #dddddd;
        font-size: 20px;
        color: #3766ff;
        font-weight: bold;
        /* ancho del input */
        width: 100%;
        margin-bottom: 5%;
    }


    /* diseño formularios*/
    /* Inicio Ondas */
    /*Tamano de ondas*/
    .wavesNormal {
        width: 100%;
        height: 97%;
        bottom: 0%;
        /*Fix for safari gap*/
        /* min-height: 50px;
            max-height: 230px; */
    }

    .FondoParteDeOndasNormal {
        margin-bottom: 0%;
        margin-right: -1%;
        bottom: 0%;
        z-index: -1;
        position: absolute;
        width: 100%;
        height: 20%;
    }

    /* FIn ondas */
    .tarjeta {
        margin-right: -1%;
        background: rgb(0, 24, 132);
        background: linear-gradient(85deg, rgba(0, 24, 132, 1) 0%, rgba(9, 127, 245, 1) 100%);
        height: 126.5%;
        width: 100%;
        text-align: center;
        top: 0%;
        margin-bottom: 0;
    }

    .tarjetalog {
        margin-right: -1%;
        margin-bottom: 0%;
        background: rgb(0, 24, 132);
        background: linear-gradient(85deg, rgba(0, 24, 132, 1) 0%, rgba(9, 127, 245, 1) 100%);
        height: 155%;
        width: 100%;
        text-align: center;
        top: 0%;

    }

    /* REGISTRAR */
    .cuerpo2 {
        margin-top: 12.5%;
        position: center;
    }

    /* LOGIN */
    .cuerpo {
        margin-top: 20%;
        position: center;
    }

    /*  Checked REGISTRAR */
    .checkreg {
        /* efectos del texto */
        font-size: 15px;
        color: rgb(163, 163, 202);
        /* font-weight: bold; */
        /*Negrita*/
        /* ancho del input */
        width: 100%;
        /* posicion del input */
        margin-top: 3%;
        margin-bottom: 2%;
        font-family: 'Rubik-Regular';
    }

    /*  Checked LOGIN */
    .checklog {
        text-align: center;
        /* efectos del texto */
        font-size: 18px;
        /* font-weight: bold; */
        /*Negrita*/
        /* ancho del input */
        width: 100%;
        /* posicion del input */
        margin-top: 3%;
        margin-bottom: 2%;
        font-family: 'Rubik-Regular';
    }

    /* link y texto REGISTRAR */
    .linkssesion2 {
        margin-top: 3%;
        margin-bottom: 5% ;
        color: #747474;
        font-size: 14px;
        font-family: 'Rubik-Regular';
    }

    /* link y texto LOGIN */
    .linkssesion {
        text-align: center;
        /* efectos del texto */
        font-size: 16px;
        /* font-weight: bold; */
        /*Negrita*/
        /* ancho del input */
        width: 100%;
        /* posicion del input */
        margin-top: 1%;
        margin-bottom: 0%;
        font-family: 'Rubik-Regular';
    }


    /* Boton LOGIN */
    .botonlogin {
        border: none;
        border-radius: 30px 30px 30px 30px;
        -moz-border-radius: 30px 30px 30px 30px;
        -webkit-border-radius: 30px 30px 30px 30px;
        background: #3766ff;
        color: #ffffff;
        text-align: center;
        font-weight: bold;
        font-size: 20px;
        margin: 2px;
        padding: 12px;
        font-family: 'Rubik-Medium';
        width: 100%;
    }

    /* Registro boton */
    .botonregister {
        border: none;
        border-radius: 30px 30px 30px 30px;
        -moz-border-radius: 30px 30px 30px 30px;
        -webkit-border-radius: 30px 30px 30px 30px;
        background: #3766ff;
        color: #ffffff;
        text-align: center;
        font-weight: bold;
        font-family: 'Rubik-Medium';s
        font-size: 20px;
        margin: 2px;
        margin-top: -1.5%;
        padding: 12px;
        width: 97%;
    }

    /* Fin del diseño formularios*/

</style>

<body>
    <div id="FondoParteDeOndasDecabeza" class="FondoParteDeOndasDecabeza">
        <svg class="wavesdecabeza" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
                <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="parallax">

                <use xlink:href="#gentle-wave" x="60" y="12" fill="#ffffff" />
                <use xlink:href="#gentle-wave" x="50" y="9" fill="rgba(0,161,255,0.3)" />
                <use xlink:href="#gentle-wave" x="40" y="6" fill="rgba(124,198,255,0.3)" />
                <use xlink:href="#gentle-wave" x="30" y="6" fill="rgba(201,219,248,0.4)" />
                <use xlink:href="#gentle-wave" x="20" y="3" fill="rgba(201,217,253,0.5)" />
            </g>
        </svg>
    </div>
    @yield('content')
</body>

</html>
