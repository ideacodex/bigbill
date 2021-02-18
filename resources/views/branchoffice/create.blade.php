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
                            <strong class="card-title">Agregar sucursal a la companía</strong>
                        </div>
                        @if (Auth::user()->role_id == 1 || Auth::user()->company_id)
                            <div class="card-body">
                                <form method="POST" action="{{ route('sucursales.store') }}"
                                    onsubmit="return checkSubmit();">
                                    @csrf

                                    {{-- Nombre de la sucursal --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title="Nombre de sucursal" class="text-dark far fa-building"></i>
                                            </span>
                                        </div>
                                        <input id="name" placeholder="Nombre de sucursal" type="text"
                                            class="text-dark form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" required autocomplete="name" autofocus>

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

                                    {{-- Teléfono --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title="Teléfono" class="text-dark fas fa-phone-square"></i>
                                            </span>
                                        </div>
                                        <input id="phone" placeholder="Teléfono" type="number"
                                            class="text-dark form-control @error('phone') is-invalid @enderror" name="phone"
                                            value="{{ old('phone') }}" required autocomplete="phone" autofocus>

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

                                    {{-- PBX --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title="PBX" class="text-dark fas fa-phone-volume"></i>
                                            </span>
                                        </div>
                                        <input id="pbx" placeholder="PBX" type="number"
                                            class="text-dark form-control @error('pbx') is-invalid @enderror" name="pbx"
                                            value="{{ old('pbx') }}" required autocomplete="pbx" autofocus>

                                        @error('pbx')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        @error('pbx')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- Dirección --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title="Dirección" class="text-dark fas fa-map-marker"></i>
                                            </span>
                                        </div>
                                        <input id="address" placeholder="Dirección" type="text"
                                            class="text-dark form-control @error('address') is-invalid @enderror"
                                            name="address" value="{{ old('address') }}" required autocomplete="address"
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

                                    @if (Auth::user()->role_id == 1)
                                        {{-- company --}}
                                        <div class="col-12 col-md-6 input-group input-group-lg mb-4">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                    <i title="company" class="far fa-building"></i>
                                                </span>
                                            </div>
                                            <select name="company_id" id="company_id"
                                                class="form-control @error('company_id') is-invalid @enderror">

                                                @if (Auth::user()->company_id)
                                                    <option value="{{ Auth::user()->company_id }}" selected disabled>
                                                        <p>{{ Auth::user()->companies->name }}</p>
                                                    </option>
                                                @endif
                                                @foreach ($companies as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @else
                                        <input type="hidden" name="company_id" id="company_id"
                                            value="{{ Auth::user()->company_id }}" @error('company_id') is-invalid
                                            @enderror">
                                    @endif
                                    @error('company_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror


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
                        @else
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">upss!</h4>
                                <p>Bienvenido al sistema de Facturacion <b> TU CONTA</b> </p>
                                <hr>
                                <p class="mb-0">Al parecer aún no cuentas con una companía, comunícate con tu
                                    superior
                                    para poderte asignar una companía y empezar a trabajar.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

@endsection
