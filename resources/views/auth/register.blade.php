@extends('layouts.NewSession')



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


{{-- register --}}

@section('content')
    {{-- Tarjeta con diseño y logo --}}
    <div class="tarjeta">
        <div class="textotarjeta">
            <img src="{{ asset('/img/lgo.svg') }}" width="80px" height="60px" alt="">
            <br>
            <span style="font-size: 30px ">SISTEMA DE</span>
            <br>
            <b> <strong style="font-size: 50px ">FACTURACIÓN DIGITAL</strong></b>
        </div>
    </div>

    <div class="col-6 col-md-6 col-sm-12 col-xs-12 ">
        <div class="cuerpo2" style="text-align: center;">
            <div class="titulo" style="margin-bottom: 2%;">
                <a href="login">
                    <strong style="text-align: center; color: #3766ff; font-size:30px; font-family: Arial;">
                        ¡Bienvenido!
                    </strong>
                </a>
            </div>
            <div class="row">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    {{-- <!--Name --> --}}
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <input id="name" type="text" class="cajatexto2 @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" required autocomplete="name" placeholder="Nombre" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- <!--Lastname --> --}}
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <input id="lastname" type="text" class="cajatexto2 @error('lastname') is-invalid @enderror"
                            name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname"
                            placeholder="Apellido">
                        @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- <!--Phone --> --}}
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <input id="phone" type="text" class="cajatexto2 @error('phone') is-invalid @enderror" name="phone"
                            value="{{ old('phone') }}" required autocomplete="phone" minlength="7" pattern="[0-9]{7,13}"
                            placeholder="No. Celular">
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- <!--Nit --> --}}
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <input id="nit" type="text" class="cajatexto2 @error('nit') is-invalid @enderror" name="nit"
                            minlength="5" value="{{ old('nit') }}" minlength="8" pattern="[0-9]{6,15}" required
                            placeholder="NIT" autocomplete="nit">
                        @error('nit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!--Address -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <input id="address" type="text" class="cajatexto2 @error('address') is-invalid @enderror"
                            name="address" value="{{ old('address') }}" required autocomplete="address"
                            placeholder="Dirección">

                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!--Email -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <input id="email" type="email" class="cajatexto2 @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" placeholder="Correo Electrónico">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- <!--Password --> --}}
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <input id="password" type="password" class="cajatexto2 @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password" minlength="8" placeholder="Contraseña">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    {{-- <!--Password confirm --> --}}
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <input id="password-confirm" type="password" class="cajatexto2" name="password_confirmation"
                            placeholder="Confirmar Contraseña" required autocomplete="new-password" minlength="8">
                    </div>
                    {{-- <!--terminos y condiciones --> --}}
                    <div class="col-lg-12 col-md-122 col-sm-12 col-xs-12">
                        <div class="checkreg">
                            <p>
                                <input type="checkbox" required>
                                Acepto los terminos y politicas de uso
                            </p>
                        </div>

                    </div>
                    {{-- <!--boton de registrar --> --}}
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <button type="submit" class="botonregister">
                            {{ __('REGISTRARSE') }}
                        </button>
                    </div>

                </form>
                {{-- <!--Ya tienes cuenta? Inicia sesion --> --}}
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="linkssesion2">
                        <p>¿Ya tienes cuenta? <a href="login"> Inicia sesion</a></p>
                    </div>
                </div>
            </div>

        </div>
    </div>




    {{-- Inicio ondas --}}
    <div id="FondoParteDeOndasNormal" class="FondoParteDeOndasNormal">
        <svg class="wavesNormal" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
                <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="parallax">
                <use xlink:href="#gentle-wave" x="40" y="0" fill="rgba(133,184,255,0.5)" />
                <use xlink:href="#gentle-wave" x="25" y="6" fill="rgba(124,198,255,0.3)" />
                <use xlink:href="#gentle-wave" x="25" y="6" fill="rgba(124,198,255,0.3)" />
                <use xlink:href="#gentle-wave" x="35" y="3" fill="rgba(140,210,253,0.7" />
                <use xlink:href="#gentle-wave" x="48" y="9" fill="rgba(255,255,255,0.3)" />
            </g>
        </svg>
    </div>
    {{-- FIN ONDAS --}}




@endsection
