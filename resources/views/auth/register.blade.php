@extends('layouts.app')

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
        input:invalid {
            border: 1px solid rgb(0, 60, 255);
        }

        input:invalid:focus {
            background-image: linear-gradient(rgb(192, 198, 255), rgb(255, 255, 255));
        }

    </style>

    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <img style="display:scroll;
                                position:fixed; bottom:0px; right:0px;" width="15%" src="../img/not-found.png" />
                    <a href="register">
                        <label class="align-content" style="color: white; font-size:30px; font-family: georgia;">Registrar
                            Usuario</label>
                    </a>
                </div>
                <div class="login-form">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <!--Name -->
                        <div class="form-group">
                            <label>Nombre</label>
                            <input id="name" type="text" class="form-control" @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!--Lastname -->
                        <div class="form-group">
                            <label>Apellido</label>
                            <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror"
                                name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname">
                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!--Phone -->
                        <div class="form-group">
                            <label>No. Celular</label>
                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                name="phone" value="{{ old('phone') }}" required autocomplete="phone" minlength="7"
                                pattern="[0-9]{7,13}">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!--Nit -->
                        <div class="form-group">
                            <label>Nit</label>
                            <input id="nit" type="text" class="form-control @error('nit') is-invalid @enderror" name="nit"
                                minlength="5" value="{{ old('nit') }}" minlength="8" pattern="[0-9]{6,15}" required
                                autocomplete="nit">
                            @error('nit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!--Address -->
                        <div class="form-group">
                            <label>Dirección</label>
                            <input id="address" type="text" class="form-control @error('address') is-invalid @enderror"
                                name="address" value="{{ old('address') }}" required autocomplete="address">

                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!--Email -->
                        <div class="form-group">
                            <label>Correo electrónico</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!--Password -->
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password" minlength="8">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!--Password confirm -->
                        <div class="form-group">
                            <label>Confirmar Contraseña</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                required autocomplete="new-password" minlength="8">
                        </div>
                        <!--terminos y condiciones -->
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" required> Acepto los terminos y politicas de uso
                            </label>
                        </div>
                        <!--boton de registrar -->
                        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30"> <i class="fas fa-save"></i>
                            {{ __('Guardar') }}</button>

                        <!--Ncomentarios extrasame -->
                        <div class="register-link m-t-15 text-center">
                            <p>¿Ya tienes cuenta? <a href="login"> Inicia sesion</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>










@endsection
