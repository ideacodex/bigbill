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
                    <div class="card bg-card">
                        <div class="card-header bg-cardheader" style="border-top-right-radius: 25px; 
                        border-top-left-radius: 25px;">
                            <strong class="card-title text-light">Editar Cliente</strong>
                        </div>
                        <div class="card-body bg-frm">

                            <div>

                                <form action="{{ url('clientes/' . $customers->id) }}" method="POST"
                                    enctype="multipart/form-data" onsubmit="return checkSubmit();">
                                    @csrf @method('PATCH')
                                    {{-- Nombre --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title="Nombre" class="text-primary fas fa-user"></i>
                                            </span>
                                        </div>
                                        <input id="name" type="text"
                                            class="text-dark form-control border-0 bg-input @error('name') is-invalid @enderror" name="name"
                                            value="{{ $customers->name }}" placeholder="Nombre" required
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

                                    {{-- Apellido --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title="Apellido" class="text-primary fas fa-user"></i>
                                            </span>
                                        </div>
                                        <input id="lastname" placeholder="Apellido" type="text"
                                            class="text-dark form-control border-0 bg-input @error('lastname') is-invalid @enderror"
                                            name="lastname" value="{{ $customers->lastname }}" required
                                            autocomplete="lastname" autofocus>

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

                                    {{-- Teléfono --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title="Número de teléfono" class="text-primary fas fa-mobile"></i>
                                            </span>
                                        </div>
                                        <input id="phone" placeholder="Número de teléfono" type="number"
                                            class="text-dark form-control border-0 bg-input @error('phone') is-invalid @enderror" name="phone"
                                            value="{{ $customers->phone }}" required autocomplete="phone" autofocus>

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

                                    {{-- Email --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title="Correo electrónico" class="text-primary fas fa-at"></i>
                                            </span>
                                        </div>
                                        <input id="email" placeholder="Correo electrónico" type="text"
                                            class="text-dark form-control border-0 bg-input @error('email') is-invalid @enderror" name="email"
                                            value="{{ $customers->email }}" required autocomplete="email" autofocus>

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

                                    {{-- Nit --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title="Nit" class="text-primary fas fa-sort-amount-down"></i>
                                            </span>
                                        </div>
                                        <input id="nit" placeholder="Nit" type="number"
                                            class="text-dark form-control border-0 bg-input @error('nit') is-invalid @enderror" name="nit"
                                            value="{{ $customers->nit }}" required autocomplete="nit" autofocus>

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


                                    {{-- <!--Company_id--> --}}
                                @if (Auth::user()->role_id == 1)
                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent" id="inputGroup-sizing-sm">
                                            <i title="company" class="text-primary far fa-building"></i>
                                        </span>
                                    </div>
                                    <select name="company_id" id="company_id" class="border-0 bg-input form-control @error('company_id') is-invalid @enderror">
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
                                    @error('company_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                @else
                                <input type="hidden" value="{{ Auth::user()->company_id }}" name="company_id">
                                @endif
                                
                                    <div class="container mt-4">
                                        <div class="col-12">
                                            <div class="col text-center">
                                                <button type="submit" style="border-radius: 50px"
                                                    class="btn btn-primary mt-3">
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

            </div>
        </div><!-- .animated -->
        <img class="derecha" src="{{ asset('images/ideacode.png') }}">
    </div><!-- .content -->

@endsection
