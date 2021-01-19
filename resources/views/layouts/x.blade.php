<!DOCTYPE html>
<html class="no-js" lang="en">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Inicio Usuario">

    <title>{{ config('Admin.name', 'Inicio') }}</title>
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">
    <script src="jquery-1.3.2.min.js" type="text/javascript"></script>
    <script src="jquery-2.1.4.min.js" type="text/javascript"></script>
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
    <!-- importacion de librertias temple -->
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <style>
    </style>
</head>
<!--Body-->
<body>

        <main class="mb-5">
            @yield('content')
        </main>
    </div>
    <!-- /#page-content-wrapper -->
</body>
</html>
