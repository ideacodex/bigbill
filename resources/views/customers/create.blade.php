@extends('layouts.Administrador')
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
                        <strong class="card-title">Agregar Cliente</strong>
                    </div>
                    <div class="card-body">
                        
                        <div>
                            @if (Auth::user()->company_id)
                            <form method="POST" action="{{ route('clientes.store') }}" onsubmit="return checkSubmit();">
                                @csrf
                                {{--Nombre--}}
                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                            <i title="Nombre" class="text-dark fas fa-user"></i>
                                        </span>
                                    </div>
                                    <input id="name" type="text" class="text-dark form-control @error('name') is-invalid @enderror"
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
        
                                {{--Apellido--}}
                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                            <i title="Apellido" class="text-dark fas fa-user"></i>
                                        </span>
                                    </div>
                                    <input id="lastname" placeholder="Apellido" type="text"
                                        class="text-dark form-control @error('lastname') is-invalid @enderror" name="lastname"
                                        value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>
        
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
        
                                {{--Teléfono--}}
                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                            <i title="Número de teléfono" class="text-dark fas fa-mobile"></i>
                                        </span>
                                    </div>
                                    <input id="phone" placeholder="Número de teléfono" type="number"
                                        class="text-dark form-control @error('phone') is-invalid @enderror"
                                        name="phone" value="{{ old('phone') }}" required
                                        autocomplete="phone" autofocus>
        
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
        
                                {{--Email--}}
                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                            <i title="Correo electrónico" class="text-dark fas fa-at"></i>
                                        </span>
                                    </div>
                                    <input id="email" placeholder="Correo electrónico" type="text"
                                        class="text-dark form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>
        
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
        
                                 {{--Nit--}}
                                 <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                            <i title="Nit" class="text-dark fas fa-sort-amount-down"></i>
                                        </span>
                                    </div>
                                    <input id="nit" placeholder="Nit" type="number"
                                        class="text-dark form-control @error('nit') is-invalid @enderror" name="nit"
                                        value="{{ old('nit') }}" required autocomplete="nit" autofocus>
        
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
                                            <button type="submit" style="border-radius: 10px" class="btn btn-lg btn-primary mt-3">
                                                <i class="far fa-save"></i>
                                                {{ __('Guardar') }}
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
                                <p class="mb-0">Al parecer aun no cuentas con una compañia, comunicate con tu superior para poderte asignar una compañia y empezar a trabajar</p>
                              </div>
                            @endif
                        </div>
                    </div>
                   
                </div>
            </div>

        </div>
    </div><!-- .animated -->
</div><!-- .content -->

@endsection