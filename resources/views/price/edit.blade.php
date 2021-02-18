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
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Editar Precio</strong>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('lista/' . $price->id) }}" method="POST" enctype="multipart/form-data"
                                onsubmit="return checkSubmit();">
                                @csrf @method('PATCH')
                                {{-- Nombre de la tipo de precio --}}
                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                            <i class="fas fa-money-check"></i>
                                        </span>
                                    </div>
                                    <input id="name" type="text"
                                        class="text-dark form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ $price->name }}" placeholder="Nombre de la cuenta" required
                                        autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                {{-- Cant. de la tipo de precio --}}
                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                            <i class="fas fa-money-bill-wave"></i>
                                        </span>
                                    </div>
                                    <input id="price" type="text" name="price"
                                        class="text-dark form-control @error('price') is-invalid @enderror" price="price"
                                        value="{{ $price->price }}" placeholder="Nombre de la cuenta" required
                                        autocomplete="price" autofocus>

                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!--Company_id-->
                                @if (Auth::user()->role_id == 1)
                                    {{-- company --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title="company" class="far fa-building"></i>
                                            </span>
                                        </div>
                                        <select name="company_id" id="company_id"
                                            class="form-control @error('company_id') is-invalid @enderror">
                                            @if (auth()->user()->company_id)
                                                <option value="{{ auth()->user()->company_id }}" selected>
                                                    <p>
                                                        Su companía: {{ auth()->user()->companies->name }}
                                                    </p>
                                                </option>
                                            @endif
                                            @foreach ($companies as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                    {{-- Company_id --}}
                                    <input type="hidden" value="{{ Auth::user()->company_id }}" name="company_id"
                                        id="company_id">
                                @endif
                                @error('company_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror


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
        </div><!-- .animated -->
    </div><!-- .content -->

@endsection
