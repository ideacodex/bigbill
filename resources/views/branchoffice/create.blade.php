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
                    <div class="card" style=" border-radius: 35px; box-shadow: 8px 8px 10px 0 #0883ad">
                        <div class="card-header"
                            style="background-color: black; border-top-right-radius: 25px; border-top-left-radius: 25px;">
                            <strong class="card-title" style="color: white">Agregar sucursal a la companía</strong>
                        </div>
                        @if (Auth::user()->role_id == 1 || Auth::user()->company_id)
                            <div class="card-body bg-frm"
                                style="border-bottom-right-radius: 15px; border-bottom-left-radius: 15px">
                                <form method="POST" action="{{ route('sucursales.store') }}"
                                    onsubmit="return checkSubmit();">
                                    @csrf

                                    {{-- Nombre de la sucursal --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span style="background: transparent; border-left: #325ff5 7px solid;"
                                                class="border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                id="inputGroup-sizing-sm">
                                                <i title="Nombre de sucursal" class="text-primary far fa-building"></i>
                                            </span>
                                        </div>
                                        <input style="background: transparent" id="name" placeholder="Nombre de sucursal"
                                            type="text"
                                            class="text-dark form-control border-0  @error('name') is-invalid @enderror"
                                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                                            <span style="background: transparent; border-left: #325ff5 7px solid;"
                                                class="border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                id="inputGroup-sizing-sm">
                                                <i title="Teléfono" class="text-primary fas fa-phone-square"></i>
                                            </span>
                                        </div>
                                        <input style="background: transparent" id="phone" placeholder="Teléfono"
                                            type="number"
                                            class="text-dark form-control border-0  @error('phone') is-invalid @enderror"
                                            name="phone" value="{{ old('phone') }}" required autocomplete="phone"
                                            autofocus>

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
                                            <span style="background: transparent; border-left: #325ff5 7px solid;"
                                                class="border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                id="inputGroup-sizing-sm">
                                                <i title="PBX" class="text-primary fas fa-phone-volume"></i>
                                            </span>
                                        </div>
                                        <input style="background: transparent" id="pbx" placeholder="PBX" type="number"
                                            class="text-dark form-control border-0  @error('pbx') is-invalid @enderror"
                                            name="pbx" value="{{ old('pbx') }}" required autocomplete="pbx" autofocus>

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
                                            <span style="background: transparent; border-left: #325ff5 7px solid;"
                                                class="border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                id="inputGroup-sizing-sm">
                                                <i title="Dirección" class="text-primary fas fa-map-marker"></i>
                                            </span>
                                        </div>
                                        <input style="background: transparent" id="address" placeholder="Dirección"
                                            type="text"
                                            class="text-dark form-control border-0  @error('address') is-invalid @enderror"
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
                                                <span style="background: transparent; border-left: #325ff5 7px solid;"
                                                    class="border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                    id="inputGroup-sizing-sm">
                                                    <i title="company" class="text-primary far fa-building"></i>
                                                </span>
                                            </div>
                                            <select style="background: transparent" name="company_id" id="company_id"
                                                class="form-control border-0  @error('company_id') is-invalid @enderror">

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
            <img class="derecha" src="{{ asset('images/ideacode.png') }}">
        </div><!-- .animated -->
    </div><!-- .content -->

@endsection
