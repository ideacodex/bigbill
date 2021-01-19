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
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="login">
                        
                        <label class="align-content" style="color: white; font-size:30px; font-family: georgia;">Sesion</label>
                    </a>
                </div>
                <div class="login-form">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <!-- correo Electronico -->
                        <div class="form-group">
                            <label>Correo Electronico</label>
                            <input id="email" name="email" type="email" class="form-control"
                                placeholder="Correo electrónico" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!--Contraseña-->
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input id="password" name="password" type="password" placeholder="Contraseña"
                                class="form-control" @error('password') is-invalid @enderror" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Recordarme') }}
                            </label>
                            <!-- restaura contraseña -->
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">
                                    {{ __('¿Olvidó su contraseña?') }}
                                </a>
                            @endif
                        </div>
                        {{-- Enviar formulario para logearte --}}
                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">
                            {{ __('Ingresar') }}
                            <i class="fas fa-sign-in-alt"></i>
                        </button>
                        <div class="register-link m-t-15 text-center">
                            <p>¿Aun no tienes cuenta? <a href="register"> Registrate aqui</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
