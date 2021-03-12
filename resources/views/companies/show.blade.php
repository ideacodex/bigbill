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

    {{-- Estilo de imagen --}}
    <style>
        * {
            box-sizing: border-box;
        }

        .image {
            filter: blur(3px);
            display: block;
            height: auto;
            background-color: transparent;
            transition: transform .2s;
            position: center;
            block-padding: center;
            height: 200px;
            width: 200px;
            margin: 0 auto;
            border-radius: 8px;
            margin-left: auto;
            margin-right: auto;

        }

        .image:hover {
            filter: none;
            -ms-transform: scale(1.75);
            /* IE 9 */
            -webkit-transform: scale(1.75);
            /* Safari 3-8 */
            transform: scale(1.5);
            box-shadow: 0 0 4px 3px rgba(0, 140, 186, 0.5);
        }

    </style>
    {{-- Fin del estilo de la imagen --}}
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card bg-card">
                        <div class="card-header bg-cardheader"
                            style="background-color: black; border-top-right-radius: 25px; border-top-left-radius: 25px;">
                            <strong class="card-title text-light">Ver Datos Companía</strong>
                        </div>
                        <div class="card-body bg-frm" style=" border-bottom-right-radius: 15px; border-bottom-left-radius:
                                            15px">
                            <div>
                                {{-- imagen --}}
                                <img src="{{ asset('/storage/companias/' . $companies->file) }}" class="image"
                                    width="150px" height="150px" alt="Compania">
                                <br>
                                <br>
                                <br>
                                {{-- Nombre de la companía --}}
                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span
                                            class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent">
                                            <i title="Nombre" class="text-primary fas fa-building "></i>
                                        </span>
                                    </div>
                                    <span title="{{ $companies->name }}"
                                        class="border-0 bg-input text-dark form-control ">
                                        Nombre de la companía : {{ $companies->name }}
                                    </span>
                                </div>
                                {{-- Nit --}}
                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span
                                            class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent">
                                            <i title="Nit" class="text-primary fas fa-sort-amount-down"></i>
                                        </span>
                                    </div>
                                    <span title="{{ $companies->nit }}" class="border-0 bg-input text-dark form-control ">
                                        Nit : {{ $companies->nit }}
                                    </span>
                                </div>
                                {{-- Dirección --}}
                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span
                                            class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent">
                                            <i title="Direccion" class="text-primary fas fa-map-marker-alt"></i>
                                        </span>
                                    </div>
                                    <span title="{{ $companies->address }}"
                                        class="border-0 bg-input text-dark form-control ">
                                        Direccion : {{ $companies->address }}
                                    </span>
                                </div>

                                {{-- Teléfono --}}
                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span
                                            class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent">
                                            <i title="Telefono" class="text-primary fas fa-mobile"></i>
                                        </span>
                                    </div>
                                    <span title="{{ $companies->phone }}"
                                        class="border-0 bg-input text-dark form-control ">
                                        Telefono : {{ $companies->phone }}
                                    </span>
                                </div>
                                {{-- Regresar a vista de companias --}}
                                <a href="{{ url('empresas') }}">

                                    <div class="container mt-4">
                                        <div class="col-12">
                                            <div class="col text-center">
                                                <button type="submit" style="border-radius: 50px"
                                                    class="btn btn-primary mt-3">
                                                    <i class="fas fa-undo"></i>
                                                    {{ __('VOLVER') }}
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
