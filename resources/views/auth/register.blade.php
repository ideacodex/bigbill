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
    /* tamaño de pantallas */

    /* Cuando la pantalla mida 1920px o menos */
    @media screen and (max-width: 1920px) {
        .titulo {
            text-align: center;
        }
        .titulolog {
            text-align: center;
            margin-left: 70%;
            width: 100%;
            margin-bottom: 2%;
            margin-left: 2%;
        }
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
            font-size: 18px;
            color: #3766ff;
            font-weight: bold;
            /* ancho del input */
            width: 150%;
            /* posicion del input */
            margin-left: 70%;
            margin-bottom: 5%;
        }

        /* REGISTRAR */
        .cuerpo2 {
            margin-top: 12.5%;
            position: center;
        }

        /* LOGIN */
        .cuerpo {
            margin-top: 20%;
            position: center;
        }

        /*  Checked REGISTRAR */
        .checkreg {
            /* efectos del texto */
            font-size: 18px;
            color: rgb(163, 163, 202);
            /* font-weight: bold; */
            /*Negrita*/
            /* ancho del input */
            width: 100%;
            /* posicion del input */
            margin-top: 3%;
            margin-left: 95%;
            margin-bottom: 2%;
        }

        /*  Checked LOGIN */
        .checklog {
            text-align: center;
            /* efectos del texto */
            font-size: 18px;
            /* font-weight: bold; */
            /*Negrita*/
            /* ancho del input */
            width: 100%;
            /* posicion del input */
            margin-top: 3%;
            margin-left: 104%;
            margin-bottom: 2%;
        }

        /* link y texto REGISTRAR */
        .linkssesion2 {
            margin-top: -1%;
            margin-bottom: 5% color: #747474;
            font-size: 15px;
        }

        /* link y texto LOGIN */
        .linkssesion {
            text-align: center;
            /* efectos del texto */
            font-size: 18px;
            /* font-weight: bold; */
            /*Negrita*/
            /* ancho del input */
            width: 150%;
            /* posicion del input */
            margin-top: 3%;
            margin-left: 90%;
            margin-bottom: 2%;
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
            width: 150%;
            /* posicion del input */
            margin-left: 90%;
        }

        /* Boton LOGIN */
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
            margin-left: 120%;
            padding: 12px;
            width: 100%;
        }

        /* Registro boton */
        .botonregister {
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
            margin-left: 95%;
            margin-top: -1.5%;
            padding: 12px;
            width: 97%;
        }
    }

    /* Cuando la pantalla mida 1440px o menos */
    @media screen and (max-width: 1440px) {
        .titulo {
            text-align: center;
        }

       

        .titulolog {
            text-align: center;
            margin-left: 70%;
            width: 100%;
            margin-bottom: 2%;
            margin-left: 2%;
        }

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
            padding: 5px;
            /* efectos del texto */
            text-align: left;
            font-size: 12px;
            color: #3766ff;
            font-weight: bold;
            /* ancho del input */
            width: 150%;
            /* posicion del input */
            margin-left: 55%;
            margin-bottom: 5%;
        }

        .cuerpo2 {
            margin-top: 11%;
            position: center;
        }

        /*  Checked REGISTRAR */
        .checkreg {
            margin-top: 3%;
            color: #a3a3ca;
            font-size: 15px;
            margin-left: 75%;
        }

        /* link y texto REGISTRAR */
        .linkssesion2 {
            margin-top: 1%;
            color: #747474;
            font-size: 15px;
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
            padding: 12px;
            /* efectos del texto */
            text-align: left;
            font-size: 20px;
            color: #ffffff;
            font-weight: bold;
            /* ancho del input */
            width: 140%;
            /* posicion del input */
            margin-left: 60%;
        }

        /* Boton LOGIN */
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
            margin-left: 75%;
            padding: 12px;
            width: 100%;
        }

        /* Registro boton */
        .botonregister {
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
            margin-left: 75%;
            padding: 12px;
            width: 100%;
        }

        .checklog {
            text-align: center;
            /* efectos del texto */
            font-size: 18px;
            /* font-weight: bold; */
            /*Negrita*/
            /* ancho del input */
            width: 100%;
            /* posicion del input */
            margin-top: 3%;
            margin-left: 70%;
            margin-bottom: 2%;
        }

        .linkssesion {
            text-align: center;
            /* efectos del texto */
            font-size: 18px;
            /* font-weight: bold; */
            /*Negrita*/
            /* ancho del input */
            width: 100%;
            /* posicion del input */
            margin-top: 3%;
            margin-left: 79%;
            margin-bottom: 2%;
        }

        /* LOGIN */
        .cuerpo {
            margin-top: 20%;
            position: center;

        }
    }

    /* Cuando la pantalla mida 413px o menos */
    @media screen and (max-width: 413px) {
        .titulo {
            text-align: center;
            margin-left: 70%;
            width: 100%;
        }

        .titulolog {
            text-align: center;
            margin-left: 70%;
            width: 100%;
            margin-bottom: 2%;
            margin-left: 80%;
        }
        
        /* Register */
        .cuerpo2 {
            margin-top: 11%;
            position: center;
        }

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
            padding: 5px;
            /* efectos del texto */
            text-align: left;
            font-size: 12px;
            color: #3766ff;
            font-weight: bold;
            /* ancho del input */
            width: 120%;
            /* posicion del input */
            margin-left: 50%;
            margin-bottom: 5%;
        }


        /*  Checked REGISTRAR */
        .checkreg {
            /* efectos del texto */
            font-size: 12px;
            color: #a3a3ca;
            /* ancho del input */
            width: 120%;
            /* posicion del input */
            margin-bottom: 5%;
            margin-top: 3%;
            margin-left: 48%;
        }

        /* link y texto REGISTRAR */
        .linkssesion2 {
            margin-top: 1%;
            color: #747474;
            font-size: 15px;

            /* efectos del texto */
            font-size: 12px;
            color: #a3a3ca;
            /* ancho del input */
            width: 120%;
            /* posicion del input */
            margin-bottom: 5%;
            margin-top: 3%;
            margin-left: 48%;
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
            padding: 12px;
            /* efectos del texto */
            text-align: left;
            font-size: 20px;
            color: #ffffff;
            font-weight: bold;
            /* ancho del input */
            width: 140%;
            /* posicion del input */
            margin-left: 60%;
        }

        /* Registro boton */
        .botonregister {
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
            margin-left: 65%;
            padding: 12px;
            width: 100%;
        }

        /* Boton LOGIN */
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
            margin-left: 75%;
            padding: 12px;
            width: 100%;
        }



        .checklog {
            text-align: center;
            /* efectos del texto */
            font-size: 18px;
            /* font-weight: bold; */
            /*Negrita*/
            /* ancho del input */
            width: 100%;
            /* posicion del input */
            margin-top: 3%;
            margin-left: 70%;
            margin-bottom: 2%;
        }

        .linkssesion {
            text-align: center;
            /* efectos del texto */
            font-size: 18px;
            /* font-weight: bold; */
            /*Negrita*/
            /* ancho del input */
            width: 100%;
            /* posicion del input */
            margin-top: 3%;
            margin-left: 79%;
            margin-bottom: 2%;
        }

        /* LOGIN */
        .cuerpo {
            margin-top: 20%;
            position: center;

        }
    }

</style>

{{-- register --}}

@section('contentr')
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
                    <input id="address" type="text" class="cajatexto2 @error('address') is-invalid @enderror" name="address"
                        value="{{ old('address') }}" required autocomplete="address" placeholder="Dirección">

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
@endsection
{{-- login --}}
@section('contentl')
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



@endsection
