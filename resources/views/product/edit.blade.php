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

    <script>
        function Suma() {
            var stock = document.calculadora.stock.value;
            var nombre2 = document.calculadora.nombre2.value;
            try {
                //Calculamos el número escrito:
                stock = (isNaN(parseInt(stock))) ? 0 : parseInt(stock);
                nombre2 = (isNaN(parseInt(nombre2))) ? 0 : parseInt(nombre2);
                document.calculadora.resultado.value = stock + nombre2;
            }
            //Si se produce un error no hacemos nada
            catch (e) {}
        }

    </script>

    <!--Mensaje flash-->
    @if (session('datosEliminados'))
        <div class="alert alert-danger">
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
                            <strong class="card-title">Editar Productos</strong>
                        </div>
                        <div class="card-body">

                            <div>
                                <form name="calculadora" action="{{ url('productos/' . $products->id) }}" method="POST"
                                    enctype="multipart/form-data" onsubmit="return checkSubmit();">
                                    @csrf @method('PATCH')

                                    <!--Nombre-->
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title="Nombre" class="fas fa-people-carry"></i>
                                            </span>
                                        </div>
                                        <input id="name" name="name" type="text"
                                            class="text-dark form-control @error('name') is-invalid @enderror"
                                            value="{{ $products->name }}"
                                            placeholder="Nombre del Producto: ej. computadora" required autocomplete="name"
                                            autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- descripcion -->
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title="Descripción" class="fas fa-book"></i>
                                            </span>
                                        </div>
                                        <input id="description" name="description" type="text"
                                            class="text-dark form-control @error('name') is-invalid @enderror"
                                            value="{{ $products->description }}"
                                            placeholder="Descripcion del Producto: ej. especificaciones" required
                                            autocomplete="description" autofocus>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- precio -->
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title="Precio" class="fas fa-hand-holding-usd"></i>
                                            </span>
                                        </div>
                                        <input id="price" name="price" type="text"
                                            class="text-dark form-control @error('price') is-invalid @enderror"
                                            value="{{ $products->price }}"
                                            placeholder="Precio del Producto: ej. computadora" required autocomplete="price"
                                            autofocus>
                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- Company_id --}}
                                    <input type="hidden" name="company_id" value="{{ auth()->user()->company_id }}">

                                    <!-- fecha de stock  -->
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title="Fecha de stock" class="fas fa-calendar-alt"></i>
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

                                    <!-- cantidad stock -->
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title=" Stock " class="fas fa-box-open"></i>
                                            </span>
                                        </div>
                                        <input class="form-control" type="number" id="grandTotal"
                                            value="{{ $products->quantity_values }}" readonly name="quantity_values" />
                                        @error('quantity_values')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!--Nuevos ingresos-->
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title=" Nuevos ingresos" class="fas fa-plus-square"></i>
                                            </span>
                                        </div>
                                        <input type="number" id="txt_campo_2" name="new_income" class="monto"
                                            onchange="sumar();" placeholder="Nuevos ingresos" required />

                                        @error('quantity_values')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- fecha de ingreso  -->
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <input id="date_admission" name="date_admission" type="hidden"
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
                                        <input id="amount_expenses" name="amount_expenses" type="hidden"
                                            class="text-dark form-control @error('amount_expenses') is-invalid @enderror"
                                            value="{{ $products->amount_expenses }}" placeholder="000" required
                                            autocomplete="amount_expenses" autofocus readonly="readonly">
                                        @error('amount_expenses')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- fecha de egresos  -->
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <input id="date_discharge" name="date_discharge" type="hidden"
                                            class="text-dark form-control @error('date_discharge') is-invalid @enderror"
                                            value="<?php echo date('y/m/d'); ?>" required
                                            autocomplete="date_discharge" autofocus readonly="readonly ">
                                        @error('date_discharge')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!--En este input se va a cargar el total de ingresos del producto-->
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title=" Ingresos totales " class="fas fa-shipping-fast"></i>
                                            </span>
                                        </div>
                                        <input class="form-control" type="number" id="total" name="total_revenue" value="0"
                                            readonly />
                                        @error('quantity_values')
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
                                                    class="btn btn-lg btn-primary mt-3">
                                                    <i class="far fa-save"></i>
                                                    {{ __('Guardar') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Ingresos registrados -->
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <input value="{{ $products->total_revenue }}" type="hidden" id="txt_campo_1"
                                            class="monto" onchange="sumar();" name="income_amount" readonly />
                                    </div>

                                    

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

    <script>
        function sumar() {
            const $total = document.getElementById('total');
            let subtotal = 0;
            [...document.getElementsByClassName("monto")].forEach(function(element) {
                if (element.value !== '') {
                    subtotal += parseFloat(element.value);
                    
                }
            });
            $total.value = subtotal;
        }

    </script>


@endsection
