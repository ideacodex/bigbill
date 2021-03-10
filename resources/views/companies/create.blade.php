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
    <!--Mensaje flash-->
    @if (session('datosAgregados'))
        <div class="alert alert-success">
            {{ session('datosAgregados') }}
        </div>
    @endif
    <!--Mensaje flash-->

    <div class="content mt-5">
        <div class="animated fadeIn">
            <div class="row"> 

                <div class="col-md-12">
                    <div class="card" style=" border-radius: 35px; box-shadow: 8px 8px 10px 0 #0883ad">
                        <div class="card-header"
                            style="background-color: black; border-top-right-radius: 25px; border-top-left-radius: 25px;">
                            <strong class="card-title" style="color: white">Agregar Companía</strong>
                        </div>
                        <div class="card-body bg-frm"
                            style="border-bottom-right-radius: 15px; border-bottom-left-radius: 15px">
                            <form method="POST" action="{{ route('empresas.store') }}" onsubmit="return checkSubmit();"
                                enctype="multipart/form-data" file="true">
                                @csrf
                                {{-- Nombre de la companía --}}
                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span style="background: transparent; border-left: #325ff5 7px solid;"
                                            class="border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                            id="inputGroup-sizing-sm">
                                            <i title="Nombre de la companía" class="text-primary fas fa-building"></i>
                                        </span>
                                    </div>
                                    <input id="name" type="text" style="background: transparent"
                                        class="text-dark form-control border-0 @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" placeholder="Nombre de la companía" required
                                        autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Nit --}}
                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span style="background: transparent; border-left: #325ff5 7px solid;"
                                            class="border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                            id="inputGroup-sizing-sm">
                                            <i title="Nit" class="text-primary fas fa-sort-amount-down"></i>
                                        </span>
                                    </div>
                                    <input id="nit" placeholder="Nit" type="number" style="background: transparent"
                                        class="text-dark form-control border-0 @error('nit') is-invalid @enderror"
                                        name="nit" value="{{ old('nit') }}" required autocomplete="nit" autofocus>

                                    @error('nit')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    @error('nit')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Dirección --}}
                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span style="background: transparent; border-left: #325ff5 7px solid;"
                                            class="border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                            id="inputGroup-sizing-sm">
                                            <i title="Dirección" class="text-primary fas fa-map-marker-alt"></i>
                                        </span>
                                    </div>
                                    <input id="address" placeholder="Dirección" type="text" style="background: transparent"
                                        class="text-dark form-control border-0 @error('address') is-invalid @enderror"
                                        name="address" value="{{ old('address') }}" autocomplete="address" autofocus>

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Teléfono --}}
                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span style="background: transparent; border-left: #325ff5 7px solid;"
                                            class="border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                            id="inputGroup-sizing-sm">
                                            <i title="Número de teléfono" class="text-primary fas fa-mobile"></i>
                                        </span>
                                    </div>
                                    <input id="phone" type="text" maxlength="8" placeholder="Número de teléfono"
                                        style="background: transparent"
                                        class="text-dark form-control border-0 @error('phone') is-invalid @enderror"
                                        name="phone" value="{{ old('phone') }}" autocomplete="phone" autofocus>

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- imagen --}}
                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <input type="file" id="file" name="file" accept="image/*"
                                        style="background: transparent"
                                        class="text-dark form-control border-0 @error('file') is-invalid @enderror">
                                    @error('file')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Boton --}}
                                <div class="container mt-4">
                                    <div class="col-12">
                                        <div class="col text-center">
                                            <button type="submit" style="border-radius: 50px"
                                                class="btn btn-primary mt-3">
                                                <i class="far fa-save"></i>
                                                {{ __('GUARDAR') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <img class="derecha" src="{{ asset('images/ideacode.png') }}">
        </div><!-- .animated -->
    </div><!-- .content -->

@endsection
