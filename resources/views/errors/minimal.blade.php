<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

    <!-- Favicon Icon -->
    <link rel="icon" type="image/png" href="{{asset('img/logo.png')}}" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<style>
    body {
        background: #015e88;
        background: linear-gradient(to right, #07222d, #015e88);
    }

    .transparent {
        background-color: transparent;
        border-right-style: none;
    }

    .form-control::placeholder {
        color: white;
    }

    .form-control {
        background-color: transparent;
        border-left-style: none;
    }

    .form-control::-webkit-input-placeholder {
        background-color: transparent;
        color: white;
    }

    /*vuelve tranparente el color de fondo del input en bootstrap 4*/
    .form-control:valid {
        background-color: transparent !important;
    }
</style>

<body>
    <div class="container">
        <div class="row justify-content-around mt-5" style="margin-top:15em">
            <img src="{{asset('img/not-found.png')}}" class="img-fluid" style="max-height: 300px;">
        </div>

        <div class="row justify-content-around mt-5">
            <p class="h1 text-light">@yield('code')</p>
        </div>
        <div class="row justify-content-around mt-1">
            <p class="h5 text-light">@yield('message')</p>
        </div>
        <div class="row justify-content-center mt-1">
            <span class="text-light"> {{ substr($exception->getMessage(), 0,100) }} ...</span>
        </div>
    </div>
    <nav class="fixed-bottom bg-theme-3 mt-3" style="padding-bottom: 0;">
        <ul class="nav justify-content-around" style="margin-bottom: -1em;">
            <li class="nav-item text-center">
                <a class="nav-link" href="{{ url()->previous() }}">
                    <span class="nav-app-icon text-light"><i class="fas fa-arrow-left"></i></span>
                    <p class="text-light" style="margin-top: -5px;"> Regresar</p>
                </a>
            </li>
            <li class="nav-item text-center">
                <a class="nav-link" href="{{url('/')}}">
                    <span class="nav-app-icon text-light"><i class="fas fa-home"></i></span>
                    <p class="text-light" style="margin-top: -5px;"> {{ 'Inicio' }}</p>
                </a>
            </li>
            <li class="align-self-end nav-item text-center">
                <a class="nav-link"
                    href="{{url('https://api.whatsapp.com/send?phone=50233120413&text='. $exception->getMessage() )}}">
                    <span class="nav-app-icon text-light"><i class="fab fa-whatsapp"></i></span>
                    <p class="text-light" style="margin-top: -5px;"> {{ 'Ayuda' }}</p>
                </a>
            </li>
        </ul>
    </nav>
    <script>
        //Bloquear doble envio de formulario******
        enviando = false; //Obligaremos a entrar el if en el primer submit
        function checkSubmit() {
          if (!enviando) {
            enviando= true;
            return true;
          } else {
            //Si llega hasta aca significa que pulsaron 2 veces el boton submit
            alert("El formulario ya se esta enviando");
            return false;
          }
        }
    </script>
    <script>
        $('.select2').select2();
    </script>
    {{--se agregó esta seccion para evitar conflictos entre select con busqueda y select depeneidntes en departamentos y municipios, --}}
    @yield('sectionJS')
</body>

</html>