<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sesion</title>

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
        integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
        integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <!-- CUSTOM CSS -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('sufee/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sufee/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('sufee/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sufee/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('sufee/assets/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('sufee/assets/assets/css/lib/datatable/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sufee/assets/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sufee/assets/css/jqvmap.min.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!--Js-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!--Js-->

</head>

<body class="bg-dark">



    <main class="py-4">
        @yield('content')
    </main>
    </div>

    <script>
        function baseUrl(url) {
            return '{{ url('
            ') }}/' + url;
        }

    </script>

</body>

</html>
