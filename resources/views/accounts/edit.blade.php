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
                    <div class="card bg-card">
                        <div class="card-header bg-cardheader" style="border-top-right-radius: 25px; 
                            border-top-left-radius: 25px;">
                            <strong class="card-title text-light">Editar Cuenta</strong>
                        </div>
                        <div class="card-body bg-frm">
                            <form action="{{ url('cuentas/' . $accounts->id) }}" method="POST"
                                enctype="multipart/form-data" onsubmit="return checkSubmit();">
                                @csrf @method('PATCH')
                                {{-- Nombre de la cuenta --}}
                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span
                                            class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                            id="inputGroup-sizing-sm">
                                            <i title="Nombre de la cuenta" class="text-dark fas fa-lira-sign"></i>
                                        </span>
                                    </div>
                                    <input id="name" type="text"
                                        class="text-dark form-control border-0 bg-input @error('name') is-invalid @enderror"
                                        name="name" value="{{ $accounts->name }}" placeholder="Nombre de la cuenta"
                                        required autocomplete="name" autofocus>

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

                                {{-- Tipos de Cuentas --}}
                                <div class="col-12 col-md-6 input-group input-group-lg mb-4">
                                    <div class="input-group-prepend">
                                        <span
                                            class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                            id="inputGroup-sizing-sm">
                                            <i title="accounttype" class="fas fa-calculator"></i>
                                        </span>
                                    </div>
                                    <select name="status_id" id="status_id"
                                        class="form-control border-0 bg-input @error('status_id') is-invalid @enderror"
                                        required>
                                        @foreach ($account_type as $item)
                                            <option value="{{ $item->id }}">{{ $item->status }}</option>
                                        @endforeach
                                    </select>
                                    @error('status_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="container mt-4">
                                    <div class="col-12">
                                        <div class="col text-center">
                                            <button type="submit" style="border-radius: 50px" class="btn btn-primary mt-3">
                                                <i class="far fa-save"></i>
                                                {{ __('GUARDAR') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <img class="derecha" src="{{ asset('images/ideacode.png') }}">
        </div><!-- .animated -->
    </div><!-- .content -->

@endsection
