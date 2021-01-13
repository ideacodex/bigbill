@extends('layouts.Admin')
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

    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

    <div class="card">
        <div class="alert alert-info text-center" role="alert">
            Editar Cliente
        </div>
        <div class="card-header">
        </div>
        <form action="{{ url('clientes/'.$customers->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return checkSubmit();">
            @csrf @method('PATCH')
            <div class="card-body card-block">

                <!--Nombre-->
                <div class="form-group">
                    <label class=" form-control-label"></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fas fa-user"></i>
                        </div>
                        <input value="{{ $customers->name}}" id="name" name="name" type="text" placeholder="Nombre" class="form-control">
                    </div>
                </div>

                <!--Apellido-->
                <div class="form-group">
                    <label class=" form-control-label"></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fas fa-user"></i>
                        </div>
                        <input value="{{ $customers->lastname}}" id="lastname" name="lastname" type="text" placeholder="Apellido" class="form-control">
                    </div>
                </div>

                <!--Teléfono-->
                <div class="form-group">
                    <label class=" form-control-label"></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <input value="{{ $customers->phone}}" id="phone" name="phone" type="number" placeholder="No. Celular" class="form-control">
                    </div>
                </div>

                <!--Email-->
                <div class="form-group">
                    <label class=" form-control-label"></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fas fa-at"></i>
                        </div>
                        <input value="{{ $customers->email}}" id="email" name="email" type="text" placeholder="Correo electrónico" class="form-control">
                    </div>
                </div>

                <!--Nit-->
                <div class="form-group">
                    <label class=" form-control-label"></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fas fa-list-ol"></i>
                        </div>
                        <input value="{{ $customers->nit}}" id="nit" name="nit" type="number" placeholder="Nit" class="form-control">
                    </div>
                </div>

                <!--Dpi-->
                <div class="form-group">
                    <label class=" form-control-label"></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="far fa-file-image"></i>
                        </div>
                        <input value="{{ $customers->dpi}}" type="number" id="dpi" name="dpi" placeholder="Dpi" class="form-control">
                    </div>
                </div>

                <!--Button-->
                <div class="container">
                    <div class="row">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-lg btn-primary">
                                <i class="far fa-save"></i>
                                {{ __('Guardar') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
