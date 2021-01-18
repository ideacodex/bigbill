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
    @if (session('datosModificados'))
        <div class="alert alert-success">
            {{ session('datosModificados') }}
        </div>
    @endif
    <!--Mensaje flash-->

    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

    <div class="card">
        <div class="alert alert-info text-center" role="alert">
            Editar Productos
        </div>
        <div class="card-header">
        </div>
        <form action="{{ url('productos/' . $products->id) }}" method="POST" enctype="multipart/form-data"
            onsubmit="return checkSubmit();">
            @csrf @method('PATCH')
            <div class="card-body card-block">

                <!--Nombre-->
                <div class="form-group">
                    <label class=" form-control-label">Producto</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fas fa-building"></i></div>
                        <input value="{{ $products->name }}" id="name" name="name" type="text"
                            placeholder="Nombre del Producto: ej. computadora" class="form-control">
                    </div>
                </div>
                <!-- descripcion -->
                <div class="form-group">
                    <label class=" form-control-label">Descripcion</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fas fa-building"></i></div>
                        <input value="{{ $products->description }}" id="description" name="description" type="text"
                            placeholder="Descripcion del Producto: ej. especificaciones" class="form-control">
                    </div>
                </div>
                <!-- precio -->
                <div class="form-group">
                    <label class=" form-control-label">Precio</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fas fa-building"></i></div>
                        <input value="{{ $products->price }}" id="price" name="price" type="text"
                            placeholder="Precio del Producto: ej. 100" class="form-control">
                    </div>
                </div>
                <!-- company_id -->
                <div class="form-group">
                    <label class=" form-control-label">Company_id</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fas fa-building"></i></div>
                        <input style="color:white" value="{{ $products->company_id }}" id="company_id" name="company_id" type="text"
                            readonly="readonly" class="form-control">
                    </div>
                </div>
                <!-- cantidad stock -->
                <div class="form-group">
                    <label class=" form-control-label">Cantidad Stock </label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fas fa-building"></i></div>
                        <input value="{{ $products->quantity_values }}" id="quantity_values" name="quantity_values"
                            type="text" placeholder="Cantidad Stock " class="form-control">
                    </div>
                </div>
                <!-- fecha de stock  -->
                <div class="form-group">
                    <label class=" form-control-label">Fecha de Stock </label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fas fa-building"></i></div>
                        <input value="<?php echo date('y/m/d'); ?>" id="date_values"
                            name="date_values" type="datetime" class="form-control" readonly="readonly">
                    </div>
                </div>
                <!-- cantidad de ingreso -->
                <div class="form-group">
                    <label class=" form-control-label">Cantidad de ingreso</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fas fa-building"></i></div>
                        <input value="{{ $products->income_amount }}" id="income_amount" name="income_amount" type="text"
                            placeholder="Cantidad de ingreso" class="form-control">
                    </div>
                </div>
                <!-- fecha de ingreso  -->
                <div class="form-group">
                    <label class=" form-control-label">Fecha de ingreso</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fas fa-building"></i></div>
                        <input value="<?php echo date('y/m/d'); ?>" id="date_admission"
                            name="date_admission" type="datetime" class="form-control" readonly="readonly">
                    </div>
                </div>
                <!-- cantidad egresos -->
                <div class="form-group">
                    <label class=" form-control-label">Cantidad Egresos</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fas fa-building"></i></div>
                        <input value="{{ $products->amount_expenses }}" id="amount_expenses" name="amount_expenses"
                            type="text" class="form-control" readonly="readonly"> >
                    </div>
                </div>
                <!-- fecha de egresos  -->
                <div class="form-group">
                    <label class=" form-control-label">Fecha de Egresos</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fas fa-building"></i></div>
                        <input value="<?php echo date('y/m/d'); ?>" id="date_discharge"
                            name="date_discharge" type="datetime" class="form-control" readonly="readonly">
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
