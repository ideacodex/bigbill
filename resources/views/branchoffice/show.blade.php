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

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Editar sucursal</strong>
                        </div>
                        <div class="card-body">


                            {{-- <!--Company_id--> --}}

                            {{-- company --}}
                            <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text transparent" style="color: blue" id="inputGroup-sizing-sm">
                                        <i title="company" class="far fa-building"></i>
                                    </span>
                                </div>
                                <span class="form-control">
                                    Compania Asignada:
                                    {{ $branch_office->company->name }}
                                </span>

                            </div>


                            {{-- Nombre de la sucursal --}}
                            <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text transparent" style="color: blue" id="inputGroup-sizing-sm">
                                        <i title="Nombre de sucursal" class="far fa-building"></i>
                                    </span>
                                </div>
                                <span class="form-control">
                                    Nombre de sucursal:
                                    {{ $branch_office->name }}
                                </span>
                            </div>

                            {{-- Teléfono --}}
                            <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text transparent" style="color: blue" id="inputGroup-sizing-sm">
                                        <i title="Teléfono" class="fas fa-phone-square"></i>
                                    </span>
                                </div>
                                <span class="form-control">
                                    Teléfono:
                                    {{ $branch_office->company->name }}
                                </span>
                            </div>

                            {{-- PBX --}}
                            <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text transparent" style="color: blue" id="inputGroup-sizing-sm">
                                        <i title="PBX" class="fas fa-phone-volume"></i>
                                    </span>
                                </div>
                                <span class="form-control">
                                    PBX:
                                    {{ $branch_office->pbx }}
                                </span>
                            </div>

                            {{-- Dirección --}}
                            <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text transparent" style="color: blue" id="inputGroup-sizing-sm">
                                        <i title="Dirección" class="fas fa-map-marker"></i>
                                    </span>
                                </div>

                                <span class="form-control">
                                    Dirección:
                                    {{ $branch_office->address }}
                                </span>
                            </div>

                            {{-- Regresar a vista de companias --}}
                            <a href="{{ url('sucursales') }}">
                                <div class="container mt-4">
                                    <div class="col-12">
                                        <div class="col text-center">
                                            <button type="submit" style="border-radius: 10px"
                                                class="btn btn-lg btn-success mt-3">
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
        </div><!-- .animated -->
    </div><!-- .content -->

@endsection
