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



    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Editar Familias de categorias</strong>
                        </div>
                        <div class="card-body">

                            <div>
                                <form action="{{ url('marcas/' . $mark->id) }}" method="POST" file="true"
                                    enctype="multipart/form-data" onsubmit="return checkSubmit();">
                                    @csrf @method('PATCH')
                                    {{-- <!--Nombre--> --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title="Nombre" class="fas fa-people-carry"></i>
                                            </span>
                                        </div>
                                        <input id="name" name="name" type="text"
                                            class="text-dark form-control @error('name') is-invalid @enderror"
                                            value="{{ $mark->name }}" placeholder="Nombre del Producto: ej. computadora"
                                            required autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- <!--Company_id--> --}}
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
                                                            Su companía: {{ auth()->user()->company->name }}
                                                        </p>
                                                    </option>
                                                @endif

                                                @foreach ($company as $item)
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
                                        {{-- Company_id --}}
                                        <input type="hidden" value="{{ Auth::user()->company_id }}" name="company_id">
                                    @endif
                                    <!--Button-->
                                    <div class="container mt-4">
                                        <div class="col-12">
                                            <div class="col text-center">
                                                <button type="submit" style="border-radius: 10px"
                                                    class="btn btn-lg btn-primary mt-3">
                                                    <i class="far fa-save"></i>
                                                    {{ __('Guardar') }}
                                                </button>
                                            </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
