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
        <form action="{{ route('clientes.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return checkSubmit();">
            @csrf
            <div class="card-body card-block">

                <!--Nombre-->
                <div class="form-group">
                    <label class=" form-control-label">Nombre</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fas fa-user"></i>
                        </div>
                        <input id="name" name="name" type="text"  class="form-control">
                    </div>
                    <small class="form-text text-muted">ex. Peter</small>
                </div>

                <!--Apellido-->
                <div class="form-group">
                    <label class=" form-control-label">Apellido</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fas fa-user"></i>
                        </div>
                        <input id="lastname" name="lastname" type="text"  class="form-control">
                    </div>
                    <small class="form-text text-muted">ex. Solorzano</small>
                </div>

                <!--Teléfono-->
                <div class="form-group">
                    <label class=" form-control-label">Teléfono</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <input id="phone" name="phone" type="number" class="form-control">
                    </div>
                    <small class="form-text text-muted">ex. 2545-451</small>
                </div>

                <!--Email-->
                <div class="form-group">
                    <label class=" form-control-label">Correo</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fas fa-at"></i>
                        </div>
                        <input id="email" name="email" type="text"  class="form-control">
                    </div>
                    <small class="form-text text-muted">ex. example@example.es</small>
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
                    <small class="form-text text-muted">ex. 515151-0</small>
                </div>

                <!--Dpi-->
                <div class="form-group">
                    <label class=" form-control-label">Dpi</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="far fa-file-image"></i>
                        </div>
                        <input type="number" id="dpi" name="dpi" class="form-control">
                    </div>
                    <small class="form-text text-muted">ex. 5515151</small>
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
