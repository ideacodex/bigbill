<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

   <title>{{ config('app.name', 'Login') }}</title>

    {{-- <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

     --}}

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

 <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
   
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
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
</head>

<body class="bg-dark">
    
   
        {{-- <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-black shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                       <h1 style="color: ghostwhite">Sesion</h1>
                       <!-- <img src="img/bannerlogo.png" style="width: 70%;"> -->
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
    
                        </ul>
    
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" style="color: ghostwhite" href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
                                </li>
                                <!-- @if (Route::has('register'))              ----   es para ingresar al formulario de registrar 
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Registro') }}</a>
                                    </li>
                                @endif -->
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>
    
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
    
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
     --}}
            <main class="py-4">
                @yield('content')
            </main>
        </div>

</body>
</html>




