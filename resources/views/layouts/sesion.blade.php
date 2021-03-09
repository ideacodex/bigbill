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
    <style>
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
