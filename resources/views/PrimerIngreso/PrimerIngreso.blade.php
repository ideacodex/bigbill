@extends('layouts.sesion')

<body>
    <!-- HEADER -->
    <header class="main-header">
        <div class="background-overlay text-white py-5">
            <div class="container">
                <div class="row d-flex h-100">
                    <div class="col-sm-6 text-center justify-content-center align-self-center">
                        <h1>
                            Bienvenido <br> {{ Auth::user()->name }}
                        </h1>
                        <p>Te has registrado correctamente</p>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();" class="btn btn-outline-secondary btn-lg text-white">
                            <i class="fas fa-power-off"></i> Logueate
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <img src="img/1.jpg" class="img-fluid d-none d-sm-block">
                    </div>
                </div>
            </div>
        </div>
    </header>


    <!-- BOOTSTRAP SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
        integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous">
    </script>
</body>

</html>
