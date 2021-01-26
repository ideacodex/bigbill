@extends('layouts.Administrador')
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!--Validación de errores-->
    <!--Mensaje flash-->
    @if (session('MENSAJEEXITOSO'))
        <div class="alert  alert-success alert-dismissible fade show" role="alert">
            <div class="alert alert-success">
                {{ session('MENSAJEEXITOSO') }}
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif






    <div class="col-md-9" style="margin-left:10%; " >
        <aside class="profile-nav alt " >
            <section class="card">
                <div class="card-header user-header alt bg-dark">
                    <div class="media">
                       
                            <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt=""
                                src="images/admin.jpg">
                        
                        <div class="media-body">
                            <h2 class="text-light display-6"> {{ Auth::user()->name }} {{ Auth::user()->lastname }}</h2>
                            <p>{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </div>


                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="#"> <i class="fas fa-mobile-alt"></i> Tel: {{ Auth::user()->phone }}</a>
                    </li>
                    <li class="list-group-item">
                        <a href="#"> <i class="fa fa-tasks"></i> Direccion: {{ Auth::user()->address }}</a>
                    </li>
                    <li class="list-group-item">
                        <a href="#"><i class="fas fa-code-branch"></i> NIT: {{ Auth::user()->nit }}</a>
                    </li>
                
                    <a class="btn btn-sm btn-primary" href="{{ url('home/' . Auth::user()->id . '/edit') }}" title="Editar">
                        <span><i class="fas fa-edit"></i></span>
                    </a>

                </ul>

            </section>
        </aside>
    </div>


@endsection
