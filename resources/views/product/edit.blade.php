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

                                    {{-- <!--Nombre--> --}}
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
                                    {{-- <!-- descripcion --> --}}
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
                                    {{-- <!-- precio --> --}}
                                    <div  id="d" class="d-none col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title="Precio" class="fas fa-hand-holding-usd"></i>
                                            </span>
                                        </div>
                                        <input id="price" name="price" type="text"
                                            class="text-dark form-control @error('price') is-invalid @enderror"
                                            value="{{ $products->price }}" placeholder="Precio del Producto" required
                                            autocomplete="price" autofocus>
                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <!--Precio especial-->
                                    <div id="b" class="d-none col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i class="fas fa-star"></i>
                                            </span>
                                        </div>
                                        <input id="special_price" name="special_price" type="number" step="0.01"
                                            class="text-dark form-control special_price  @error('special_price') is-invalid @enderror"
                                            value="{{ $products->special_price }}" placeholder="Precio especial"
                                            autocomplete="special_price" autofocus>
                                        @error('special_price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <!--Precio crédito-->
                                    <div id="c" class="d-none col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i class="fas fa-credit-card"></i>
                                            </span>
                                        </div>
                                        <input id="credit_price" name="credit_price" type="number" step="0.01"
                                            class="text-dark form-control credit_price  @error('credit_price') is-invalid @enderror"
                                            value="{{ $products->credit_price }}" placeholder="Precio al crédito"
                                            autocomplete="credit_price" autofocus>
                                        @error('credit_price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- Tipo de producto --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i class="fas fa-user"></i>
                                            </span>
                                        </div>
                                        <select name="kind_product" id="kind_product" onchange="mostrarInput();"
                                            class="form-control @error('kind_product') is-invalid @enderror" required
                                            autofocus>
                                            <option selected disabled>Tipo de producto</option>
                                            <option value="{{ $products->kind_product }}" selected>
                                                @if ($products->kind_product == 1)
                                                    Artículo de venta
                                            </option>
                                            <option value="2">Artículo de compra</option>
                                            <option value="3">Artículo de compra y venta</option>
                                        @else
                                            @if ($products->kind_product == 2)
                                                Artículo de compra
                                                </option>
                                                <option value="1">Artículo de venta</option>
                                                <option value="3">Artículo de compra y venta</option>
                                            @else
                                                @if ($products->kind_product == 3)
                                                    Artículo de compra y venta
                                                    </option>
                                                    <option value="1">Artículo de venta</option>
                                                    <option value="2">Artículo de compra</option>
                                                @endif
                                            @endif
                                            @endif
                                        </select>
                                        @error('kind_product')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- <!--costos--> --}}
                                    <div id="a" @if ($products->kind_product == 2 || $products->kind_product == 3) class=" col-12 col-md-6 input-group input-group-lg mb-3"
                                            @else
                                        class="d-none col-12 col-md-6 input-group input-group-lg mb-3" @endif>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent">
                                                <i class="fas fa-coins"></i>
                                            </span>
                                        </div>
                                        <input @if ($products->kind_product == 2 || $products->kind_product == 3) value="{{ $products->cost }}" min="0.01"
                                        @else
                                                            value="" @endif id="cost" name="cost"
                                            type="number" step="0.01" onchange="mostrarInput();"
                                            class="text-dark form-control @error('cost') is-invalid @enderror"
                                            placeholder="Precio de compra" autocomplete="cost" autofocus>
                                        @error('cost')
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
                                        {{-- Company_id --}}
                                        <input type="hidden" value="{{ Auth::user()->company_id }}" name="company_id">
                                    @endif
                                    <!--Nuevos ingresos-->
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title=" Nuevos ingresos" class="fas fa-plus-square"></i>
                                            </span>
                                        </div>
                                        <input type="number" value="" id="txt_campo_2" name="new_income"
                                            class="monto form-control" onchange="sumar();" placeholder="Nuevos ingresos"
                                            required />

                                        @error('quantity_values')
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
                                    <!--En este input se va a cargar el total de ingresos del producto-->
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        {{-- <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i title=" Ingresos totales " class="fas fa-shipping-fast"></i>
                                            </span> --}}
                                        <input class="form-control" type="hidden" id="total" name="total_revenue" value="0"
                                            readonly />
                                        @error('quantity_values')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <!-- grandTotal -->
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3 hydden">

                                        {{-- <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                            <i title=" Stock " class="fas fa-box-open"></i>
                                        </span> --}}

                                        <input class="form-control" type="hidden" id="grandTotal"
                                            value="{{ $products->quantity_values }}" readonly name="quantity_values" />
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

                                            <!-- Ingresos registrados -->
                                            <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                                <input value="{{ $products->total_revenue }}" type="hidden"
                                                    id="txt_campo_1" class="monto" onchange="sumar();" name="income_amount"
                                                    readonly />
                                            </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        //seleccionando elementos
        function mostrarInput() {
            var select = document.getElementById('kind_product').value;
            var b = document.getElementById('b');
            var c = document.getElementById('c');
            var d = document.getElementById('d');

            var a = document.getElementById('a');

            console.log("Que viene en select ", select);
            console.log("Que viene en a ", a);
            console.log("Que viene en b ", b);
            console.log("Que viene en c ", c);
            console.log("Que viene en d ", d);
            if (select == '1') {
                a.className = "d-none col-12 col-md-6 input-group input-group-lg mb-3";
                b.className = "col-12 col-md-6 input-group input-group-lg mb-3";
                c.className = "col-12 col-md-6 input-group input-group-lg mb-3";
                d.className = "col-12 col-md-6 input-group input-group-lg mb-3";
            }
            if (select == '2') {
                a.className = "col-12 col-md-6 input-group input-group-lg mb-3";
                b.className = "d-none col-12 col-md-6 input-group input-group-lg mb-3";
                c.className = "d-none col-12 col-md-6 input-group input-group-lg mb-3";
                d.className = "d-none col-12 col-md-6 input-group input-group-lg mb-3";
            }
            if (select == '3') {
                a.className = "col-12 col-md-6 input-group input-group-lg mb-3";
                b.className = "col-12 col-md-6 input-group input-group-lg mb-3";
                c.className = "col-12 col-md-6 input-group input-group-lg mb-3";
                d.className = "col-12 col-md-6 input-group input-group-lg mb-3";
            }

        }

    </script>
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
