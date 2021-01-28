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
    @if (session('datosModificados'))
        <div class="alert alert-success">
            {{ session('datosModificados') }}
        </div>
    @endif
    <!--Mensaje flash-->

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Editar Cuenta</strong>
                        </div>
                        <div class="card-body">

                            <div>

                                <form action="{{ url('cuentas/' . $accounts->id) }}" method="POST"
                                    enctype="multipart/form-data" onsubmit="return checkSubmit();">
                                    @csrf @method('PATCH')
                                    {{--Nombre de la cuenta--}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title="Nombre de la cuenta" class="text-dark fas fa-lira-sign"></i>
                                            </span>
                                        </div>
                                        <input id="name" type="text"
                                            class="text-dark form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ $accounts->name }}" placeholder="Nombre de la cuenta" required
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

                                    {{--Estado--}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title="Estado contable" class="text-dark fas fa-thermometer-empty"></i>
                                            </span>
                                        </div>
                                        <input id="status" placeholder="Estado contable" type="text"
                                            class="text-dark form-control @error('status') is-invalid @enderror"
                                            name="status" value="{{ $accounts->status }}" required autocomplete="status"
                                            autofocus>

                                        @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="container mt-4">
                                        <div class="col-12">
                                            <div class="col text-center">
                                                <button type="submit" style="border-radius: 10px"
                                                    class="btn btn-lg btn-primary mt-3">
                                                    <i class="far fa-save"></i>
                                                    {{ __('Guardar') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

@endsection
