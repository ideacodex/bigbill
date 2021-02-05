
@extends('layouts.sesion')
   
  </head>
  <body>
    <!-- NAVIGATION -->
    @if (Route::has('login'))    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="/">
          <img src="img/bannerlogo.png" style="width: 70%;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
          @auth
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/perfil') }}">Casa</a>
            </li>
            @else
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">Incio de sesion</a>
            </li>
            @if (Route::has('register'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">Registrar</a>
            </li>
            @endif
            @endauth

          </ul>
        </div>
      </div>
    </nav>
    @endif 




 <!-- HEADER -->



    <header class="main-header">
      <div class="background-overlay text-white py-5">
        <div class="container">
          <div class="row d-flex h-100">
            <div class="col-sm-6 text-center justify-content-center align-self-center">
              <h1>
              Bienvenidos al sistema de control
              </h1>
              <p>sistema de ingreso de empleados e informacion</p>
              <a href="#leer" class="btn btn-outline-secondary btn-lg text-white">
              Leer mas
              </a>
            </div>
            <div class="col-sm-6">
              <img src="img/1.jpg" class="img-fluid d-none d-sm-block">
            </div>
          </div>
        </div>
      </div>
    </header>






    <!-- vista previa -->
   <a name="leer">
    <section class="m5 text-center bg-light">
      <div class="container">
        <div class="row">
          <div class="m-5">
            <h3>sistema de ingreso de empleados e informacion</h3>
            <p>
              breve descripcion de la pagina pendiente al terminar el sistema web
            </p>
          </div>
        </div>
      </div>
    </section>
    </a>


    <!-- preguntas tipo acordion -->
    <section class="container text-center p-5">
      <div class="row">
        <div class="accordion" id="accordionExample">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  ¿como crear mi usuario?
                </button>
              </h5>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">
               La forma de loguearte y  crar tu usuario es es la parte de a hay una opcion de "REGISTRO", seleccionas la opcion y luego llenaras los campos solicitados sucesivamente podras loguearte en la opcioon de "INICIAR SESION"
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingTwo">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  olvide mi contraseña ¿como la restablezco?
                </button>
              </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
              <div class="card-body">
                Si olvidaste tu contraseña para iniciar secion y ver tu informacion, entonces debes de enviar un correo espeficando tu ususario y el motivo del cambio de contraseña. El formulario esta en la parte inferior de la pagina.
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingThree">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  forma de trabajo de la pagina
                </button>
              </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
              <div class="card-body">
                pendiente descripcion...
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- CONTACTAR POR MEDIO DE CORREO /    ENVIO DE CORREO -->
    <section class="bg-light py-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-9">
            <h3>contacto</h3>
            <p>
              Dejanos tus comentarios, dudas o recomendaciones
            </p>
            <form action="">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <i class="fas fa-user input-group-text"></i>
                </div>
                <input type="text" class="form-control" placeholder="Nombre" aria-label="Username" aria-describedby="basic-addon1">
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <i class="fas fa-envelope input-group-text"></i>
                </div>
                <input type="text" class="form-control" placeholder="Correo" aria-label="Username" aria-describedby="basic-addon1">
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <i class="fas fa-pencil-alt input-group-text"></i>
                </div>
                <textarea name="" cols="30" rows="10" placeholder="Mensaje" class="form-control"></textarea>
              </div>
              <button type="submit" class="btn btn-primary btn-block">enviar</button>
            </form>
          </div>
          <div class="col-lg-3 align-self-center">
            <img src="img/pctec.jpeg" >
          </div>
        </div>
      </div>
    </section>

    <footer>
      <div class="container p-3">
        <div class="row text-center text-white">
          <div class="col ml-auto">
            <p>Copyright &copy; 2021</p>
            <p>maria zarazua </p>
          </div>
        </div>
      </div>       
    </footer>

    <!-- BOOTSTRAP SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>
