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
                            <strong class="card-title">Ver Datos Companía</strong>
                        </div>
                        <div class="card-body">
                            <div>

                                {{-- Nombre de la companía --}}
                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text transparent" style="color:blue;">
                                            <i title="Nombre" class="fas fa-building "></i>
                                        </span>
                                    </div>
                                    <span title="{{ $companies->name }}" class="text-dark form-control ">
                                        Nombre de la companía : {{ $companies->name }}
                                    </span>
                                </div>
                                {{-- Nit --}}
                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text transparent" style="color:blue;">
                                            <i title="Nit" class="fas fa-sort-amount-down"></i>
                                        </span>
                                    </div>
                                    <span title="{{ $companies->nit }}" class="text-dark form-control ">
                                        Nit : {{ $companies->nit }}
                                    </span>
                                </div>
                                {{-- Dirección --}}
                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text transparent" style="color:blue;">
                                            <i title="Direccion" class="fas fa-map-marker-alt"></i>
                                        </span>
                                    </div>
                                    <span title="{{ $companies->address }}" class="text-dark form-control ">
                                        Direccion : {{ $companies->address }}
                                    </span>
                                </div>

                                {{-- Teléfono --}}
                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text transparent" style="color:blue;">
                                            <i title="Telefono" class="fas fa-mobile"></i>
                                        </span>
                                    </div>
                                    <span title="{{ $companies->phone }}" class="text-dark form-control ">
                                        Telefono : {{ $companies->phone }}
                                    </span>
                                </div>
                                {{-- Regresar a vista de companias --}}
                                <a href="{{ url('empresas') }}">

                                    <div class="container mt-4">
                                        <div class="col-12">
                                            <div class="col text-center">
                                                <button type="submit" style="border-radius: 10px"
                                                    class="btn btn-lg btn-primary mt-3">
                                                    <i class="fas fa-undo"></i>
                                                    {{ __('Regresar') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </a>



                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

@endsection
