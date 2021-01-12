@extends('layouts.diseñousuario')
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
            Agregar Companía
        </div>
        <div class="card-header">
        </div>
        <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data" onsubmit="return checkSubmit();">
            @csrf
            <div class="card-body card-block">
                <!--Nombre-->
                <div class="form-group">
                    <label class=" form-control-label"></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fas fa-building"></i>
                        </div>
                        <input id="name" name="name" type="text" placeholder="Nombre" class="form-control">
                    </div>
                </div>

                <!--Nit-->
                <div class="form-group">
                    <label class=" form-control-label"></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fas fa-list-ol"></i>
                        </div>
                        <input id="nit" name="nit" type="number" placeholder="Nit" class="form-control">
                    </div>
                </div>

                <!--No. Celular-->
                <div class="form-group">
                    <label class=" form-control-label"></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <input type="number" id="phone" name="phone" placeholder="No. Celular" class="form-control">
                    </div>
                </div>

                <!--Dirección-->
                <div class="form-group">
                    <label class=" form-control-label"></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fas fa-map-marker"></i>
                        </div>
                        <input type="text" id="address" name="address" placeholder="Dirección" class="form-control">
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
