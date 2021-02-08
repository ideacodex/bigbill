@extends('layouts.'. auth()->user()->getRoleNames()[0])
@section('content')
    <!--Validación de errores-->
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

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Actualizar Informacion</strong>
                        </div>
                        <div class="card-body">
                            <div>
                                <form action="{{ url('home/' . $user->id) }}" method="POST" enctype="multipart/form-data"
                                    onsubmit="return checkSubmit();">
                                    @csrf @method('PATCH')

                                    <!--Nombre-->
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i class="fas fa-user"></i>
                                            </span>
                                        </div>
                                        <input id="name" name="name" type="text"
                                            class="text-dark form-control @error('name') is-invalid @enderror"
                                            value="{{ $user->name }}" placeholder="Nombre" required autocomplete="name"
                                            autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- lastname -->
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i class="far fa-user"></i>
                                            </span>
                                        </div>
                                        <input id="lastname" name="lastname" type="text"
                                            class="text-dark form-control @error('lastname') is-invalid @enderror"
                                            value="{{ $user->lastname }}" placeholder="Apellidos" required
                                            autocomplete="lastname" autofocus>
                                        @error('lastname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- phone -->
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i class="fas fa-phone"></i>
                                            </span>
                                        </div>
                                        <input id="phone" name="phone" type="text"
                                            class="text-dark form-control @error('phone') is-invalid @enderror"
                                            value="{{ $user->phone }}" placeholder="Telefono" required
                                            autocomplete="phone" autofocus>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <!--  nit -->
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i class="fas fa-id-badge"></i>
                                            </span>
                                        </div>
                                        <input id="nit" name="nit" type="text"
                                            class="text-dark form-control @error('nit') is-invalid @enderror"
                                            style="color:white" value="{{ $user->nit }}" placeholder="nit" required
                                            autocomplete="nit" autofocus>
                                        @error('nit')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <!--  address -->
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </span>
                                        </div>
                                        <input id="address" name="address" type="text"
                                            class="text-dark form-control @error('address') is-invalid @enderror"
                                            value="{{ $user->address }}" placeholder="guatemala, guatemla" required
                                            autocomplete="address" autofocus>
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <!-- email  -->
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                        </div>
                                        <input id="email" name="email" type="text"
                                            class="text-dark form-control @error('email') is-invalid @enderror"
                                            value="{{ $user->email }}" placeholder="email@extension.com" required
                                            autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!--Button-->
                                    <div class="container mt-4">
                                        <div class="col-12">
                                            <div class="col text-center">
                                                <button type="submit" style="border-radius: 10px"
                                                    class="btn btn-lg btn-primary mt-3">
                                                    <i class="far fa-save"></i>
                                                    {{ __('Actualizar Informacion') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

@endsection
