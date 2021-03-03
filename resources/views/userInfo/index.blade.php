@extends('layouts.'. auth()->user()->getRoleNames()[0])
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
<!--Mensaje flash-->
<div class="content mt-3">
    <div class="row">
        <div class="col-md-9 ml-2">
            <aside class="profile-nav alt">
                <section class="card">
                    <div class="card-header user-header alt bg-dark">
                        <div class="media">
                            @if (Auth::user()->file != null)
                            {{-- imagen --}}
                            <img src="{{ asset('/storage/usuarios/' . Auth::user()->file) }}" class="image" width="130px" height="130px" alt="Compania">
                            @endif
                            

                            <div class="media-body" >



                                <h2 class="text-light display-6">     {{ Auth::user()->name }}
                                    {{ Auth::user()->lastname }}
                                </h2> 
                                 <p>  {{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </div>


                    <ul class="list-group list-group-flush">

                        <li class="list-group-item">
                            <a href="#"> <i class="fas fa-user"></i> {{ Auth::user()->name }}
                                <span style="color: #00bf27;">
                                    <i class="fas fa-check-circle  pull-right"></i>
                                </span>
                        </li>
                        <li class="list-group-item">
                            <a href="#"> <i class="fas fa-user"></i> {{ Auth::user()->lastname }}
                                <span style="color: #00bf27;">
                                    <i class="fas fa-check-circle  pull-right"></i>
                                </span>
                        </li>
                        <li class="list-group-item">
                            <a href="#"> <i class="fas fa-phone"></i> {{ Auth::user()->phone }}
                                <span style="color: #00bf27;">
                                    <i class="fas fa-check-circle  pull-right"></i>
                                </span>
                        </li>
                        <li class="list-group-item">
                            <a href="#"> <i class="fas fa-tag"></i> {{ Auth::user()->nit }}
                                <span style="color: #00bf27;">
                                    <i class="fas fa-check-circle  pull-right"></i>
                                </span>
                        </li>
                        <li class="list-group-item">
                            <a href="#"><i class="fas fa-user-shield"></i> {{ Auth::user()->address }}
                                <span style="color: #00bf27;">
                                    <i class="fas fa-check-circle  pull-right"></i>
                                </span>
                        </li>
                        <li class="list-group-item">
                            <a href="#"><i class="fas fa-envelope"></i> {{ Auth::user()->email }}
                                <span style="color: #00bf27;">
                                    <i class="fas fa-check-circle  pull-right"></i>
                                </span>
                        </li>
                        <li class="list-group-item">
                            <a href="#"><i class="fas fa-building"></i>
                                @if (Auth::user()->company_id)


                                @foreach ($company as $item)
                                {{ $item->name }}
                                @endforeach


                                <span style="color: #00bf27;">
                                    <i class="fas fa-check-circle  pull-right"></i>
                                </span>

                                @else
                                Sin Compañia
                                <span style="color: Tomato;">
                                    <i class="fas fa-times-circle pull-right"></i>
                                </span>
                                @endif
                            </a>
                        </li>



                        <li class="list-group-item">
                            <a href="#"><i class="fas fa-building"></i>
                                @if (Auth::user()->branch_id)
                                @foreach ($branch_offices as $item)
                                {{ $item->name }}
                                @endforeach
                                <span style="color: #00bf27;">
                                    <i class="fas fa-check-circle  pull-right"></i>
                                </span>

                                @else
                                Sin Sucursal
                                <span style="color: #003be6;">
                                    <i class="fas fa-lightbulb pull-right"></i>
                                </span>
                                @endif
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a class="btn btn-sm btn-primary" href="{{ url('home/' . Auth::user()->id . '/edit') }}" title="Editar">
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
