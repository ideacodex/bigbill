@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-card">
                    <div class="card-header bg-cardheader text-light">{{ __('RESTAURAR CONTRASEÑA') }}</div>

                    <div class="card-body bg-frm">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{-- {{ session('status') }} --}}
                                ¡Hemos enviado su enlace de restablecimiento de contraseña por correo electrónico!
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __(' Escribe tu Correo Electronico') }}</label>

                                <div class="col-md-6">
                                    <input id="email" style="border-left: #325ff5 7px solid;" type="email"
                                        class="form-control bg-input border-0 @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email"
                                        placeholder="correo@extensión.com" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>Este correo electronico no está registrado. <br>Si tienes algún problema
                                                comunícate con los administradores. </strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" style="font-size: 12px">
                                        {{ __('Restaurar contraseña') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
