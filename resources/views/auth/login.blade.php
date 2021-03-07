@extends('layouts.NewSession')

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
    <style>
        /* REGISTRAR */
        .cajatexto2 {
            /* borde del input */
            border: none;
            border-left: #3766ff 7px solid;
            border-radius: 0px 15px 15px 0px;
            -moz-border-radius: 0px 15px 15px 0px;
            -webkit-border-radius: 0px 15px 15px 0px;
            /* fondo del input */
            background: #dddddd;
            padding: 6px;
            /* efectos del texto */
            text-align: left;
            font-size: 20px;
            color: #ffffff;
            font-weight: bold;
            /* ancho del input */
            width: 100%;
            /* posicion del input */
            margin-left: 40%;
        }

        /* LOGIN */
        .cajatexto {
            /* borde del input */
            border: none;
            border-left: #3766ff 7px solid;
            border-radius: 0px 15px 15px 0px;
            -moz-border-radius: 0px 15px 15px 0px;
            -webkit-border-radius: 0px 15px 15px 0px;
            /* fondo del input */
            background: #dddddd;
            padding: 13px;
            /* efectos del texto */
            text-align: left;
            font-size: 20px;
            color: #ffffff;
            font-weight: bold;
            /* ancho del input */
            width: 100%;
            /* posicion del input */
            margin-left: 40%;
        }

        .botonlogin {
            border: none;
            border-radius: 30px 30px 30px 30px;
            -moz-border-radius: 30px 30px 30px 30px;
            -webkit-border-radius: 30px 30px 30px 30px;
            background: #3766ff;
            color: #ffffff;
            text-align: center;
            font-weight: bold;
            font-family: Arial;
            font-size: 20px;
            margin: 2px;
            margin-left: 42%;
            padding: 12px;
            width: 97%;
        }

        .linkssesion {
            text-align: center;
            margin-top: 3%;
            margin-left: 30%;
        }

        /* REGISTRAR */
        .linkssesion2 {
            text-align: center;
            margin-top: 1%;
            margin-left: 30%;
        }

        /* REGISTRAR */
        .cuerpo2 {
            margin-top: 12%;
            position: center;
        }

        /* LOGIN */
        .cuerpo {
            margin-top: 15%;
            position: center;

        }

    </style>


    <div class="row">
        {{-- register --}}
        <div class="col-6 col-md-6 col-sm-12 col-xs-12 ">
            <div class="cuerpo2">
                <a href="login" style=" margin-left: 42%;text-align: center;">
                    <strong style="text-align: center; color: #3766ff; font-size:30px; font-family: Arial;">
                        ¡Bienvenido!
                    </strong>
                </a>
                <div style="margin-top: 1%">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        {{-- <!--Name --> --}}
                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">

                            <input id="name" type="text" class="cajatexto2" @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}" required autocomplete="name" placeholder="Nombre" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>
                        {{-- <!--Lastname --> --}}
                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                            <input id="lastname" type="text" class="cajatexto2 @error('lastname') is-invalid @enderror"
                                name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname"
                                placeholder="Apellido">
                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>
                        {{-- <!--Phone --> --}}
                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                            <input id="phone" type="text" class="cajatexto2 @error('phone') is-invalid @enderror"
                                name="phone" value="{{ old('phone') }}" required autocomplete="phone" minlength="7"
                                pattern="[0-9]{7,13}" placeholder="No. Celular">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>
                        {{-- <!--Nit --> --}}
                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                            <input id="nit" type="text" class="cajatexto2 @error('nit') is-invalid @enderror" name="nit"
                                minlength="5" value="{{ old('nit') }}" minlength="8" pattern="[0-9]{6,15}" required
                                placeholder="NIT" autocomplete="nit">
                            @error('nit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>
                        <!--Address -->
                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                            <input id="address" type="text" class="cajatexto2 @error('address') is-invalid @enderror"
                                name="address" value="{{ old('address') }}" required autocomplete="address"
                                placeholder="Dirección">

                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>
                        <!--Email -->
                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                            <input id="email" type="email" class="cajatexto2 @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email"
                                placeholder="Correo Electrónico">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>
                        {{-- <!--Password --> --}}
                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                            <input id="password" type="password" class="cajatexto2 @error('password') is-invalid @enderror"
                                name="password" required autocomplete="new-password" minlength="8" placeholder="Contraseña">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>
                        {{-- <!--Password confirm --> --}}
                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                            <input id="password-confirm" type="password" class="cajatexto2" name="password_confirmation"
                                placeholder="Confirmar Contraseña" required autocomplete="new-password" minlength="8">
                        </div>
                        {{-- <!--terminos y condiciones --> --}}
                        <div class="linkssesion2">
                            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                <input type="checkbox" required>
                                <label style="color: rgb(163, 163, 202); font-size:16px; "> Acepto los terminos y politicas
                                    de
                                    uso</label>
                            </div>
                        </div>
                        {{-- <!--boton de registrar --> --}}
                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                            <button type="submit" class="botonlogin">
                                {{ __('REGISTRARSE') }}
                            </button>
                        </div>
                        {{-- <!--comentarios EXTRAS --> --}}
                        <div class="register-link m-t-15 text-center">
                            <p>¿Ya tienes cuenta? <a href="login"> Inicia sesion</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- login --}}

        <div class="col-6 col-md-6 col-sm-12 col-xs-12 ">
            <div class="cuerpo">

                <a href="login" style=" margin-left: 42%;text-align: center;">
                    <strong style="text-align: center; color: #3766ff; font-size:30px; font-family: Arial;">
                        ¡Bienvenido!
                    </strong>
                </a>
                <br>
                <br>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    {{-- <!-- correo Electronico --> --}}
                    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
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
                    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
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
                    <div class="linkssesion">
                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label style="color: rgb(163, 163, 202); font-size:16px; "> Mantener Sesión</label>
                        </div>
                    </div>
                    {{-- Enviar formulario para logearte --}}
                    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                        <button type="submit" class="botonlogin">
                            {{ __('INICIAR SESIÓN') }}
                        </button>
                    </div>

                    {{-- texto --}}
                    <div class="linkssesion">
                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                            <!-- restaura contraseña -->
                            @if (Route::has('password.request'))
                                <b>
                                    <a href="{{ route('password.request') }}" style="color: rgb(163, 163, 202); ">
                                        {{ __('¿Olvidó tu contraseña?') }}
                                    </a>
                                </b>
                            @endif
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
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

@endsection
