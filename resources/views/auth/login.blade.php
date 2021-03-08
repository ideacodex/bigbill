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
<style>


</style>

{{-- register --}}

@section('contentr')

    {{-- FIN ONDAS --}}


    {{-- Tarjeta con diseño y logo --}}
    <div class="tarjeta">


    </div>
@endsection
{{-- login --}}
@section('content')
    <div class="col-6 col-md-6 col-sm-12 col-xs-12 ">
        {{-- Tarjeta con diseño y logo --}}
        <div class="tarjetal">
            <div class="textotarjeta">
                <img src="{{ asset('/img/lgo.svg') }}" width="80px" height="60px" alt="">
                <br>
                <span style="font-size: 30px ">SISTEMA DE</span>
                <br>
                <b> <strong style="font-size: 50px ">FACTURACIÓN DIGITAL</strong></b>
            </div>
        </div>
    </div>




    <div class="col-6 col-md-6 col-sm-12 col-xs-12 ">
        <div class="cuerpo">
            <div class="titulolog">
                <a href="login">
                    <strong style=" color: #3766ff; font-size:30px; font-family: Arial;">
                        ¡Bienvenido!
                    </strong>
                </a>
            </div>


            <div class="row">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    {{-- <!-- correo Electronico --> --}}
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <input id="email" name="email" type="email" class="cajatexto @error('email') is-invalid @enderror"
                            value="{{ old('email') }}" placeholder="Correo electrónico" required autocomplete="email"
                            autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <br>
                    {{-- <!--Contraseña--> --}}
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <input id="password" name="password" type="password"
                            class=" cajatexto @error('password') is-invalid @enderror" value="{{ old('password') }}"
                            placeholder="Contraseña" required autocomplete="password" autofocus>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    {{-- Guardar sesion --}}
                    <div class="checklog">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label style="color: rgb(163, 163, 202); font-size:16px; "> Mantener Sesión</label>
                        </div>
                    </div>
                    {{-- Enviar formulario para logearte --}}
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <button type="submit" class="botonlogin">
                            {{ __('INICIAR SESIÓN') }}
                        </button>
                    </div>



                    {{-- ¿Olvidó tu contraseña? --}}
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="linkssesion">
                            <!-- restaura contraseña -->
                            @if (Route::has('password.request'))
                                <b>
                                    <a href="{{ route('password.request') }}" style="color: rgb(163, 163, 202); ">
                                        {{ __('¿Olvidó tu contraseña?') }}
                                    </a>
                                </b>
                            @endif
                        </div>
                    </div>
                    {{-- Registrarme --}}
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="linkssesion">
                            <p style="margin-top: 3%;">
                                <a href="register" style="color: #0059ff; ">
                                    Registrarme
                                </a>
                            </p>
                        </div>
                    </div>
                </form>
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
