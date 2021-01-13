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
        <div class="card-header">
            <strong>Agregar Companía</strong> <small></small>
        </div>
        <div class="card-header">
        </div>
        <form action="{{ route('empresas.store') }}" method="POST" enctype="multipart/form-data"
            onsubmit="return checkSubmit();">
            @csrf
            <div class="card-body card-block">
                <!--Nombre-->
                <div class="form-group">
                    <label class=" form-control-label">Nombre</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fas fa-building"></i>
                        </div>
                        <input id="name" name="name" type="text" class="form-control">
                    </div>
                    <small class="form-text text-muted">ex. Peter</small>
                </div>

                <!--Nit-->
                <div class="form-group">
                    <label class=" form-control-label">Nit</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fas fa-list-ol"></i>
                        </div>
                        <input id="nit" name="nit" type="number" class="form-control">
                    </div>
                    <small class="form-text text-muted">ex. 5515152-0</small>
                </div>

                <!--No. Celular-->
                <div class="form-group">
                    <label class=" form-control-label">No. Celular</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <input type="number" id="phone" name="phone" class="form-control">
                    </div>
                    <small class="form-text text-muted">ex. 5100-1510</small>
                </div>

                <!--Dirección-->
                <div class="form-group">
                    <label class=" form-control-label">Dirección</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fas fa-map-marker"></i>
                        </div>
                        <input type="text" id="address" name="address" class="form-control">
                    </div>
                    <small class="form-text text-muted">ex. Calle los altos 9-01</small>
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
