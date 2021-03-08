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
    }

    .wavesdecabeza {
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


    @font-face {

        font-family: A-FOR-A;
        src: url("{{ asset('/fonts/fonts/A FOR A.ttf') }}");
        font-family: aAlloyInk;
        src: url("{{ asset('/fonts/fonts/aAlloyInk.otf') }}");
        font-family: aAmneSans;
        src: url("{{ asset('/fonts/fonts/aAmneSans.otf') }}");
        font-family: aAntiCorona;
        src: url("{{ asset('/fonts/fonts/aAntiCorona.otf') }}");
        font-family: aAtmospheric;
        src: url("{{ asset('/fonts/fonts/aAtmospheric.otf') }}");
        font-family: aAutobusOmnibus;
        src: url("{{ asset('/fonts/fonts/aAutobusOmnibus.otf') }}");
        font-family: aBigDeal;
        src: url("{{ asset('/fonts/fonts/aBigDeal.otf') }}");
        font-family: aBlackLives;
        src: url("{{ asset('/fonts/fonts/aBlackLives.otf') }}");
        font-family: aBusterDown;
        src: url("{{ asset('/fonts/fonts/aBusterDown.otf') }}");
        font-family: Aurella;
        src: url("{{ asset('/fonts/fonts/Aurella.ttf') }}");
        font-family: arial_narrow_7;
        src: url("{{ asset('/fonts/fonts/arial_narrow_7.ttf') }}");




    }


    /* diseño formularios*/

    /* tamaño de pantallas */

    /* Cuando la pantalla mida 1920px o menos */
    @media screen and (max-width: 1920px) {


        .textotarjeta {
            margin-top: 45%;
            color: white;
            font-weight: bold;
            font-family: arial_narrow_7;


        }

        /* Inicio Ondas */
        /*Tamano de ondas*/
        .wavesNormal {
            width: 100%;
            height: 97%;
            margin-bottom: -0%;
            bottom: -0%;
            /*Fix for safari gap*/
            /* min-height: 50px;
            max-height: 230px; */
        }

        .FondoParteDeOndasNormal {
            z-index: -500;
            height: 18%;
            width: 100%;
            position: absolute;
            margin-bottom: -9.8%;
            bottom: -9.8%;
        }

        /* FIn ondas */
        .tarjeta {
            background: linear-gradient(128deg, rgba(6, 0, 138, 1) 0%, rgba(8, 9, 179, 1) 29%, rgba(2, 165, 238, 1) 67%, rgba(0, 209, 255, 1) 92%, rgba(198, 244, 254, 1) 100%);
            height: 121%;
            width: 100%;
            position: absolute;
            text-align: center;
            top: 0%;
        }

        .titulo {
            text-align: center;
        }

        .titulolog {
            text-align: center;
            margin-left: 70%;
            width: 100%;
            margin-bottom: 2%;
            margin-left: 2%;
        }

        /* REGISTRAR */
        .cajatexto2 {
            /* borde del input */
            border: none;
            border-left: #3766ff 7px solid;
            border-radius: 0px 15px 15px 0px;
            -moz-border-radius: 0px 15px 15px 0px;
            -webkit-border-radius: 0px 15px 15px 0px;
            /* fondo del input */
            background: #dddddd;
            padding: 6px;
            /* efectos del texto */
            text-align: left;
            font-size: 18px;
            color: #3766ff;
            font-weight: bold;
            /* ancho del input */
            width: 150%;
            /* posicion del input */
            margin-left: 70%;
            margin-bottom: 5%;
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
            font-size: 18px;
            color: rgb(163, 163, 202);
            /* font-weight: bold; */
            /*Negrita*/
            /* ancho del input */
            width: 100%;
            /* posicion del input */
            margin-top: 3%;
            margin-left: 95%;
            margin-bottom: 2%;
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
            margin-left: 104%;
            margin-bottom: 2%;
        }

        /* link y texto REGISTRAR */
        .linkssesion2 {
            margin-top: 3%;
            margin-bottom: 5% color: #747474;
            font-size: 15px;
        }

        /* link y texto LOGIN */
        .linkssesion {
            text-align: center;
            /* efectos del texto */
            font-size: 18px;
            /* font-weight: bold; */
            /*Negrita*/
            /* ancho del input */
            width: 150%;
            /* posicion del input */
            margin-top: 3%;
            margin-left: 90%;
            margin-bottom: 2%;
        }

        /* LOGIN */
        .cajatexto {
            /* borde del input */
            border: none;
            border-left: #3766ff 7px solid;
            border-radius: 0px 15px 15px 0px;
            -moz-border-radius: 0px 15px 15px 0px;
            -webkit-border-radius: 0px 15px 15px 0px;
            /* fondo del input */
            background: #dddddd;
            padding: 13px;
            /* efectos del texto */
            text-align: left;
            font-size: 20px;
            color: #ffffff;
            font-weight: bold;
            /* ancho del input */
            width: 150%;
            /* posicion del input */
            margin-left: 90%;
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
            font-family: Arial;
            font-size: 20px;
            margin: 2px;
            margin-left: 120%;
            padding: 12px;
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
            font-family: Arial;
            font-size: 20px;
            margin: 2px;
            margin-left: 95%;
            margin-top: -1.5%;
            padding: 12px;
            width: 97%;
        }





    }

    /* Cuando la pantalla mida 1440px o menos */
    @media screen and (max-width: 1440px) {
        .textotarjeta {
            margin-top: 50%;
            color: white;
            font-family: arial_narrow_7;
            font-weight: bold;
        }

        .tarjeta {
            background: rgb(6, 0, 138);
            background: linear-gradient(235deg, rgba(6, 0, 138, 1) 0%, rgba(8, 9, 179, 1) 29%, rgba(2, 165, 238, 1) 67%, rgba(0, 209, 255, 1) 92%, rgba(198, 244, 254, 1) 100%);
            height: 99%;
            width: 50%;
            margin-left: 50%;
            position: absolute;
            top: 0%;
            color: white;
            text-align: center;
        }

        /* login */
        .tarjetal {
            background: rgb(6, 0, 138);
            background: linear-gradient(128deg, rgba(6, 0, 138, 1) 0%, rgba(8, 9, 179, 1) 29%, rgba(2, 165, 238, 1) 67%, rgba(0, 209, 255, 1) 92%, rgba(198, 244, 254, 1) 100%);
            height: 151.5%;
            width: 50%;
            margin-right: 50%;
            left: 50%;
            position: absolute;
            top: 0%;
            color: white;
            text-align: center;
           
        }

        .titulo {
            text-align: center;
        }

        .titulolog {
            text-align: center;
            margin-left: 70%;
            width: 100%;
            margin-bottom: 2%;
            margin-left: 2%;
        }

        /* REGISTRAR */
        .cajatexto2 {
            /* borde del input */
            border: none;
            border-left: #3766ff 7px solid;
            border-radius: 0px 15px 15px 0px;
            -moz-border-radius: 0px 15px 15px 0px;
            -webkit-border-radius: 0px 15px 15px 0px;
            /* fondo del input */
            background: #dddddd;
            padding: 5px;
            /* efectos del texto */
            text-align: left;
            font-size: 12px;
            color: #3766ff;
            font-weight: bold;
            /* ancho del input */
            width: 150%;
            /* posicion del input */
            margin-left: 55%;
            margin-bottom: 5%;
        }

        .cuerpo2 {
            margin-top: 11%;
            position: center;
        }

        /*  Checked REGISTRAR */
        .checkreg {
            margin-top: 3%;
            color: #a3a3ca;
            font-size: 15px;
            margin-left: 75%;
        }

        /* link y texto REGISTRAR */
        .linkssesion2 {
            margin-top: 1%;
            color: #747474;
            font-size: 15px;
        }

        /* LOGIN */
        .cajatexto {
            /* borde del input */
            border: none;
            border-left: #3766ff 7px solid;
            border-radius: 0px 15px 15px 0px;
            -moz-border-radius: 0px 15px 15px 0px;
            -webkit-border-radius: 0px 15px 15px 0px;
            /* fondo del input */
            background: #dddddd;
            padding: 12px;
            /* efectos del texto */
            text-align: left;
            font-size: 20px;
            color: #ffffff;
            font-weight: bold;
            /* ancho del input */
            width: 140%;
            /* posicion del input */
            margin-left: 60%;
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
            font-family: Arial;
            font-size: 20px;
            margin: 2px;
            margin-left: 75%;
            padding: 12px;
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
            font-family: Arial;
            font-size: 20px;
            margin: 2px;
            margin-left: 75%;
            padding: 12px;
            width: 100%;
        }

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
            margin-left: 70%;
            margin-bottom: 2%;
        }

        .linkssesion {
            text-align: center;
            /* efectos del texto */
            font-size: 18px;
            /* font-weight: bold; */
            /*Negrita*/
            /* ancho del input */
            width: 100%;
            /* posicion del input */
            margin-top: 3%;
            margin-left: 79%;
            margin-bottom: 2%;
        }

        /* LOGIN */
        .cuerpo {
            margin-top: 20%;
            position: center;

        }

        /* Inicio Ondas */
        /*Tamano de ondas*/
        .wavesNormal {
            width: 100%;
            height: 97%;
            margin-bottom: 0%;
            bottom: 0%;
            /*Fix for safari gap*/
            /* min-height: 50px;
            max-height: 230px; */
        }

        .FondoParteDeOndasNormal {
            z-index: -500;
            height: 18%;
            width: 100%;
            position: absolute;
            margin-bottom: 0.1%;
            bottom: 0%;
        }

        /* FIn ondas */


    }

    /* Cuando la pantalla mida 413px o menos */
    @media screen and (max-width: 413px) {
        .logoimg {
            visibility: hidden;
            display: none;
        }

        .textotarjetal {
            background: none;visibility: hidden;
            display: none;
        }

        /* Inicio Ondas */
        /*Tamano de ondas*/
        .wavesNormal {
            width: 100%;
            height: 97%;
            margin-bottom: -0%;
            bottom: -0%;
            /*Fix for safari gap*/
            /* min-height: 50px;
            max-height: 230px; */
        }

        .FondoParteDeOndasNormal {
            z-index: -500;
            height: 18%;
            width: 100%;
            position: absolute;
            margin-bottom: 0%;
            bottom: 0%;
        }

        /* FIn ondas */


        .tarjeta {
            background: none;visibility: hidden;
            display: none;

        }

        .titulo {
            text-align: center;
            margin-left: 70%;
            width: 100%;
        }

        .titulolog {
            text-align: center;
            margin-left: 70%;
            width: 100%;
            margin-bottom: 2%;
            margin-left: 80%;
        }

        /* Register */
        .cuerpo2 {
            margin-top: 11%;
            position: center;
        }

        /* REGISTRAR */
        .cajatexto2 {
            /* borde del input */
            border: none;
            border-left: #3766ff 7px solid;
            border-radius: 0px 15px 15px 0px;
            -moz-border-radius: 0px 15px 15px 0px;
            -webkit-border-radius: 0px 15px 15px 0px;
            /* fondo del input */
            background: #dddddd;
            padding: 5px;
            /* efectos del texto */
            text-align: left;
            font-size: 12px;
            color: #3766ff;
            font-weight: bold;
            /* ancho del input */
            width: 120%;
            /* posicion del input */
            margin-left: 50%;
            margin-bottom: 5%;
        }


        /*  Checked REGISTRAR */
        .checkreg {
            /* efectos del texto */
            font-size: 12px;
            color: #a3a3ca;
            /* ancho del input */
            width: 120%;
            /* posicion del input */
            margin-bottom: 5%;
            margin-top: 3%;
            margin-left: 48%;
        }

        /* link y texto REGISTRAR */
        .linkssesion2 {
            margin-top: 1%;
            color: #747474;
            font-size: 15px;

            /* efectos del texto */
            font-size: 12px;
            color: #a3a3ca;
            /* ancho del input */
            width: 120%;
            /* posicion del input */
            margin-bottom: 5%;
            margin-top: 3%;
            margin-left: 48%;
        }

        /* LOGIN */
        .cajatexto {
            /* borde del input */
            border: none;
            border-left: #3766ff 7px solid;
            border-radius: 0px 15px 15px 0px;
            -moz-border-radius: 0px 15px 15px 0px;
            -webkit-border-radius: 0px 15px 15px 0px;
            /* fondo del input */
            background: #dddddd;
            padding: 12px;
            /* efectos del texto */
            text-align: left;
            font-size: 20px;
            color: #ffffff;
            font-weight: bold;
            /* ancho del input */
            width: 140%;
            /* posicion del input */
            margin-left: 60%;
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
            font-family: Arial;
            font-size: 20px;
            margin: 2px;
            margin-left: 65%;
            padding: 12px;
            width: 100%;
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
            font-family: Arial;
            font-size: 20px;
            margin: 2px;
            margin-left: 75%;
            padding: 12px;
            width: 100%;
        }



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
            margin-left: 70%;
            margin-bottom: 2%;
        }

        .linkssesion {
            text-align: center;
            /* efectos del texto */
            font-size: 18px;
            /* font-weight: bold; */
            /*Negrita*/
            /* ancho del input */
            width: 100%;
            /* posicion del input */
            margin-top: 3%;
            margin-left: 79%;
            margin-bottom: 2%;
        }

        /* LOGIN */
        .cuerpo {
            margin-top: 20%;
            position: center;

        }
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
