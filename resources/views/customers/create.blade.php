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
                            <strong style="color: white" class="card-title">Agregar Cliente</strong>
                        </div>
                        <div class="card-body bg-frm" style=" border-bottom-right-radius: 15px; border-bottom-left-radius:
                                    15px">

                            @if (Auth::user()->role_id == 1 || Auth::user()->company_id)
                                <form method="POST" action="{{ route('clientes.store') }}"
                                    onsubmit="return checkSubmit();">
                                    @csrf

                                    {{-- <!--Company_id--> --}}
                                    @if (Auth::user()->role_id == 1)
                                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                            <div class="input-group-prepend">
                                                <span style="background: transparent; border-left: #325ff5 7px solid;"
                                                    class="border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                    id="inputGroup-sizing-sm">
                                                    <i title="company" class="text-primary far fa-building"></i>
                                                </span>
                                            </div>
                                            <select style="background: transparent" name="company_id" id="company_id"
                                                class="form-control border-0 @error('company_id') is-invalid @enderror">
                                                @if (auth()->user()->company_id)
                                                    <option value="{{ auth()->user()->company_id }}" selected>
                                                        <p>
                                                            Su companía: {{ auth()->user()->companies->name }}
                                                        </p>
                                                    </option>
                                                @endif

                                                @foreach ($companies as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('company_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    @else
                                        <input type="hidden" value="{{ Auth::user()->company_id }}" name="company_id">
                                    @endif
                                    {{-- Nombre --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span style="background: transparent; border-left: #325ff5 7px solid;"
                                                class="border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                id="inputGroup-sizing-sm">
                                                <i title="Nombre" class="text-primary fas fa-user"></i>
                                            </span>
                                        </div>
                                        <input id="name" type="text" style="background: transparent"
                                            class="text-dark form-control border-0 @error('name') is-invalid @enderror"
                                            name="name" value="{{ old('name') }}" placeholder="Nombre" required
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

                                    {{-- Apellido --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span style="background: transparent; border-left: #325ff5 7px solid;"
                                                class="border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                id="inputGroup-sizing-sm">
                                                <i title="Apellido" class="text-primary fas fa-user"></i>
                                            </span>
                                        </div>
                                        <input id="lastname" placeholder="Apellido" type="text"
                                            style="background: transparent"
                                            class="text-dark form-control border-0 @error('lastname') is-invalid @enderror"
                                            name="lastname" value="{{ old('lastname') }}" required
                                            autocomplete="lastname" autofocus>

                                        @error('lastname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        @error('lastname')
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
                                        <input id="phone" placeholder="Número de teléfono" type="number"
                                            style="background: transparent"
                                            class="text-dark form-control border-0 @error('phone') is-invalid @enderror"
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

                                    {{-- Email --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span style="background: transparent; border-left: #325ff5 7px solid;"
                                                class="border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                id="inputGroup-sizing-sm">
                                                <i title="Correo electrónico" class="text-primary fas fa-at"></i>
                                            </span>
                                        </div>
                                        <input id="email" placeholder="Correo electrónico" type="text"
                                            style="background: transparent"
                                            class="text-dark form-control border-0 @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" required autocomplete="email"
                                            autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        @error('email')
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
                            @else
                                <div class="alert alert-success" role="alert">
                                    <h4 class="alert-heading">upss!</h4>
                                    <p>Bienvenido al sistema de Facturacion <b> TU CONTA</b> </p>
                                    <hr>
                                    <p class="mb-0">Al parecer aun no cuentas con una compañia, comunicate con tu
                                        superior para poderte asignar una compañia y empezar a trabajar</p>
                                </div>
                            @endif

                        </div>

                    </div>
                </div>

            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

@endsection
