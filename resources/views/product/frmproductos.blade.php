@extends('layouts.Admin')
@section('content')
    <!--Mensaje flash-->
    @if (session('ProductosAgregados'))
        <div class="alert alert-success">
            {{ session('ProductosAgregados') }}
        </div>
    @endif
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
    <form action="{{ url('productos') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body card-block">

            <!-- nombre -->
            <div class="form-group">
                <label class=" form-control-label">Producto</label>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fas fa-people-carry"></i></div>
                    <input id="name" name="name" type="text" class="form-control"
                        placeholder="Nombre del Producto: ej. computadora">
                </div>
            </div>
            <!-- descripcion -->
            <div class="form-group">
                <label class=" form-control-label">Description</label>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fas fa-book"></i></div>
                    <input id="description" name="description" type="text" class="form-control"
                        placeholder="Descripcion del Producto: ej. especificaciones">
                </div>
            </div>
            <!-- precio -->
            <div class="form-group">
                <label class=" form-control-label">Precio</label>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fas fa-hand-holding-usd"></i></div>
                    <input id="price" name="price" type="text" class="form-control"
                        placeholder="Precio del Producto: ej. computadora">
                </div>
            </div>
            <!-- company_id -->
            <div class="form-group">
                <label class=" form-control-label">Id Compañia</label>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fas fa-building"></i></div>
                    <input id="company_id" name="company_id" type="text" class="form-control"
                        placeholder="Id de la Compañia: ej. 1 = pc tecnologi">
                </div>
            </div>
            <!-- cantidad stock -->
            <div class="form-group">
                <label class=" form-control-label">Cantidad en stock</label>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fas fa-cart-arrow-down"></i></div>
                    <input id="quantity_values" name="quantity_values" type="text" class="form-control" value="000">
                </div>
            </div>
            <!-- fecha de stock  -->
            <div class="form-group">
                <label class=" form-control-label">Fecha de stock </label>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fas fa-calendar-alt"></i></div>
                    <input id="date_values" name="date_values" type="datetime" readonly="readonly " class="form-control"
                        value="<?php echo date('y/m/d'); ?>">
                </div>
            </div>
            <!-- cantidad de ingreso -->
            <div class="form-group">
                <label class=" form-control-label">Cantidad ingreso</label>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fas fa-cart-arrow-down"></i></div>
                    <input id="income_amount" name="income_amount" type="text" class="form-control" value="000">
                </div>
            </div>
            <!-- fecha de ingreso  -->
            <div class="form-group">
                <label class=" form-control-label">Fecha ingreso</label>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fas fa-calendar-alt"></i></div>
                    <input id="date_admission" name="date_admission" type="datetime" readonly="readonly "
                        class="form-control" value="<?php echo date('y/m/d'); ?>">
                </div>
            </div>
            <!-- cantidad egresos -->
            <div class="form-group">
                <label class=" form-control-label">Cantidad egresos</label>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fas fa-cart-arrow-down"></i></div>
                    <input id="amount_expenses" name="amount_expenses" type="text" class="form-control" value="000"
                        readonly="readonly">
                </div>
            </div>
            <!-- fecha de egresos  -->
            <div class="form-group">
                <label class=" form-control-label">Fecha de egresos </label>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fas fa-calendar-alt"></i></div>
                    <input id="date_discharge" name="date_discharge" type="datetime" readonly="readonly "
                        class="form-control" value="<?php echo date('y/m/d'); ?>">
                </div>
            </div>
        </div>
        <!--Button-->
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <input type="submit" class="btn btn-outline-primary btn-lg btn-block" name="enviar" value="Guardar">
                </div>
            </div>
        </div>

    </form>



@endsection
