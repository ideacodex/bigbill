@extends('layouts.Administrador')
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
    @if (session('datosEliminados'))
        <div class="alert alert-success">
            {{ session('datosEliminados') }}
        </div>
    @endif
    <!--Mensaje flash-->


    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Agregar Producto</strong>
                        </div>
                        <div class="card-body">

                            <div>


                                <form action="{{ url('productos') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    {{--Nombre--}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title="Nombre" class="fas fa-people-carry"></i>
                                            </span>
                                        </div>
                                        <input id="name" name="name" type="text"
                                            class="text-dark form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}" placeholder="Nombre del Producto: ej. computadora"
                                            required autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <!--descripcion-->
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title="descripcion" class="fas fa-book"></i>
                                            </span>
                                        </div>
                                        <input id="description" name="description" type="text"
                                            class="text-dark form-control @error('name') is-invalid @enderror"
                                            value="{{ old('description') }}"
                                            placeholder="Descripcion del Producto: ej. especificaciones" required
                                            autocomplete="description" autofocus>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <!--precio-->
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title="Precio" class="fas fa-hand-holding-usd"></i>
                                            </span>
                                        </div>
                                        <input id="price" name="price" type="text"
                                            class="text-dark form-control @error('price') is-invalid @enderror"
                                            value="{{ old('price') }}" placeholder="Precio del Producto: ej. computadora"
                                            required autocomplete="price" autofocus>
                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{--Company_id--}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title="Companía" class="far fa-building"></i>
                                            </span>
                                        </div>
                                        <select style="width: 25em" name="company_id" id="company_id"
                                            class="form-control @error('company_id') is-invalid @enderror" required>
                                            <option selected disabled>Companía</option>
                                            @foreach ($companies as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('company_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        @error('company_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <!--cantidad stock -->
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title=" cantidad_stock " class="fas fa-cart-arrow-down"></i>
                                            </span>
                                        </div>
                                        <input id="quantity_values" name="quantity_values" type="number"
                                            class="text-dark form-control @error('quantity_values') is-invalid @enderror"
                                            value="000" placeholder="000" required autocomplete="quantity_values" autofocus>
                                        @error('quantity_values')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <!-- fecha de stock  -->
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title=" fecha_stock " class="fas fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input id="date_values" name="date_values" type="datetime"
                                            class="text-dark form-control @error('date_values') is-invalid @enderror"
                                            value="<?php echo date('y/m/d'); ?>" required
                                            autocomplete="date_values" autofocus readonly="readonly">
                                        @error('date_values')
                                            <span class="date_values-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <!-- cantidad ingreso -->
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title=" cantidad_ingreso " class="fas fa-cart-arrow-down"></i>
                                            </span>
                                        </div>
                                        <input id="income_amount" name="income_amount" type="number"
                                            class="text-dark form-control @error('income_amount') is-invalid @enderror"
                                            value="000" placeholder="000" required autocomplete="income_amount" autofocus>
                                        @error('income_amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <!-- fecha de ingreso  -->
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title=" fecha_ingreso " class="fas fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input id="date_admission" name="date_admission" type="datetime"
                                            class="text-dark form-control @error('date_admission') is-invalid @enderror"
                                            value="<?php echo date('y/m/d'); ?>" required
                                            autocomplete="date_admission" autofocus readonly="readonly ">
                                        @error('date_admission')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <!--  cantidad egresos -->
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title=" cantidad_egresos " class="fas fa-cart-arrow-down"></i>
                                            </span>
                                        </div>
                                        <input id="amount_expenses" name="amount_expenses" type="number"
                                            class="text-dark form-control @error('amount_expenses') is-invalid @enderror"
                                            value="000" placeholder="000" required autocomplete="amount_expenses" autofocus
                                            readonly="readonly">
                                        @error('amount_expenses')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <!-- fecha de egresos  -->
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title=" fecha_egresos " class="fas fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input id="date_discharge" name="date_discharge" type="date_discharge"
                                            class="text-dark form-control @error('date_discharge') is-invalid @enderror"
                                            value="<?php echo date('y/m/d'); ?>" required
                                            autocomplete="date_discharge" autofocus readonly="readonly ">
                                        @error('date_discharge')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <!--Button-->
                                    <div class="container mt-4">
                                        <div class="col-12">
                                            <div class="col text-center">
                                                <button type="submit" style="border-radius: 10px"
                                                    class="btn btn-lg btn-primary mt-3" name="enviar">
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

            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

@endsection
