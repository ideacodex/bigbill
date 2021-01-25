@extends('layouts.Administrador')
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
    @if (session('datosModificados'))
        <div class="alert alert-success">
            {{ session('datosModificados') }}
        </div>
    @endif
    <!--Mensaje flash-->

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Editar Companía</strong>
                        </div>
                        <div class="card-body">

                            <div>

                                <form action="{{ url('empresas/' . $companies->id) }}" method="POST"
                                    enctype="multipart/form-data" onsubmit="return checkSubmit();">
                                    @csrf @method('PATCH')
                                    {{--Nombre de la companía--}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title="Nombre de la companía" class="text-dark fas fa-building"></i>
                                            </span>
                                        </div>
                                        <input id="name" type="text"
                                            class="text-dark form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ $companies->name }}" placeholder="Nombre de la companía" required
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

                                    {{--Nit--}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title="Nit" class="text-dark fas fa-sort-amount-down"></i>
                                            </span>
                                        </div>
                                        <input id="nit" placeholder="Nit" type="number"
                                            class="text-dark form-control @error('nit') is-invalid @enderror" name="nit"
                                            value="{{ $companies->nit }}" required autocomplete="nit" autofocus>

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

                                    {{--Dirección--}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title="Dirección" class="text-dark fas fa-map-marker-alt"></i>
                                            </span>
                                        </div>
                                        <input id="address" placeholder="Dirección" type="text"
                                            class="text-dark form-control @error('address') is-invalid @enderror"
                                            name="address" value="{{ $companies->address }}" required autocomplete="address"
                                            autofocus>

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

                                    {{--Teléfono--}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title="Número de teléfono" class="text-dark fas fa-mobile"></i>
                                            </span>
                                        </div>
                                        <input id="phone" placeholder="Número de teléfono" type="number"
                                            class="text-dark form-control @error('phone') is-invalid @enderror" name="phone"
                                            value="{{ $companies->phone }}" required autocomplete="phone" autofocus>

                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="container mt-4">
                                        <div class="col-12">
                                            <div class="col text-center">
                                                <button type="submit" style="border-radius: 10px"
                                                    class="btn btn-lg btn-primary mt-3">
                                                    <i class="far fa-save"></i>
                                                    {{ __('Guardar') }}
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
