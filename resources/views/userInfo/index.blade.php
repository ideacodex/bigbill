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






    <div class="content mt-3">
        <div class="row">
            <div class="col-md-9 ml-2">
                <aside class="profile-nav alt">
                    <section class="card">
                        <div class="card-header user-header alt bg-dark">
                            <div class="media">

                                <img class="align-self-center rounded-circle ml-" style="width:85px; height:85px;" alt=""
                                    src="images/admin.jpg">

                                <div class="media-body">
                                    <h2 class="text-light display-6"> {{ Auth::user()->name }} {{ Auth::user()->lastname }}
                                    </h2>
                                    <p>{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                        </div>


                        <ul class="list-group list-group-flush">

                            <li class="list-group-item">
                                <a href="#"> <i class="fa fa-envelope-o"></i> {{ Auth::user()->name }} <span
                                        class="badge badge-primary pull-right">10</span></a>
                            </li>
                            <li class="list-group-item">
                                <a href="#"> <i class="fa fa-envelope-o"></i> {{ Auth::user()->lastname }} <span
                                        class="badge badge-primary pull-right">10</span></a>
                            </li>
                            <li class="list-group-item">
                                <a href="#"> <i class="fa fa-envelope-o"></i> {{ Auth::user()->phone }} <span
                                        class="badge badge-primary pull-right">10</span></a>
                            </li>
                            <li class="list-group-item">
                                <a href="#"> <i class="fa fa-envelope-o"></i> {{ Auth::user()->nit }} <span
                                        class="badge badge-primary pull-right">10</span></a>
                            </li>
                            <li class="list-group-item">
                                <a href="#"> <i class="fa fa-envelope-o"></i> {{ Auth::user()->address }} <span
                                        class="badge badge-primary pull-right">10</span></a>
                            </li>
                            <li class="list-group-item">
                                <a href="#"> <i class="fa fa-envelope-o"></i> {{ Auth::user()->email }} <span
                                        class="badge badge-primary pull-right">10</span></a>
                            </li>
                            <li class="list-group-item">
                                <a href="#"> <i class="fa fa-envelope-o"></i> {{ Auth::user()->company_id }} <span
                                        class="badge badge-primary pull-right">10</span></a>
                            </li>

                            <li class="list-group-item">
                                <a class="btn btn-sm btn-primary" href="{{ url('home/' . Auth::user()->id . '/edit') }}"
                                    title="Editar">
                                    <span><i class="fas fa-edit"></i>Actualizar Informacion</span>
                                </a>
                            </li>
                        </ul>
                    </section>
                </aside>
            </div>
        </div>
    </div>
@endsection
