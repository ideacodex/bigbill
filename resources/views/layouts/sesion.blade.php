<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('diseñologin.name', 'Bienvenido') }}</title>

    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
        integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
        integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">


    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />


    {{-- estilos de letras --}}
    <link rel="stylesheet" href="{{ asset('css/EstiloLetras.css') }}" />


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

    </style>
</head>

<body>
    @yield('content')

</body>

</html>
