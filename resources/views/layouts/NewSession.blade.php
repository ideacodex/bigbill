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
    .wavesNormal {
        width: 100%;
        height: 97%;
        /*Fix for safari gap*/
        /* min-height: 50px;
        max-height: 230px; */
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

    .FondoParteDeOndasDecabeza {
        height: 20%;
        width: 100%;
        position: absolute;
        top: 0%;
    }

    .FondoParteDeOndasNormal {
        height: 18%;
        width: 100%;
        position: absolute;
        bottom: 0%;
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
<div class="row">
    <div class="col-6 col-md-6 col-sm-12 col-xs-12 ">
        @yield('contentr')
    </div>
    <div class="col-6 col-md-6 col-sm-12 col-xs-12 ">
        @yield('contentl')
    </div>
</div>


    <div id="FondoParteDeOndasNormal" class="FondoParteDeOndasNormal">
        <svg class="wavesNormal" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
                <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="parallax">
                <use xlink:href="#gentle-wave" x="40" y="0" fill="rgba(133,184,255,0.5)" />
                <use xlink:href="#gentle-wave" x="25" y="6" fill="rgba(124,198,255,0.3)" />
                <use xlink:href="#gentle-wave" x="25" y="6" fill="rgba(124,198,255,0.3)" />
                <use xlink:href="#gentle-wave" x="35" y="3" fill="rgba(140,210,253,0.7" />
                <use xlink:href="#gentle-wave" x="48" y="9" fill="rgba(255,255,255,0.3)" />
            </g>
        </svg>
    </div>
</body>

</html>
