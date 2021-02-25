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
                                    file="true" enctype="multipart/form-data" onsubmit="return checkSubmit();">
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
                                    {{-- Tipo de producto --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i class="fas fa-user"></i>
                                            </span>
                                        </div>
                                        <select name="kind_product" id="kind_product" onchange="mostrarInput();"
                                            class="form-control @error('kind_product') is-invalid @enderror" required>

                                            @if ($products->kind_product == 'Artículo de venta')
                                                <option value="1" selected> {{ $products->kind_product }}</option>
                                                <option value="2">Artículo de compra</option>
                                                <option value="3">Artículo de compra y venta
                                                </option>
                                            @else
                                                @if ($products->kind_product == 'Artículo de compra')
                                                    <option value="1">Artículo de venta</option>
                                                    <option value="2" selected> {{ $products->kind_product }}</option>
                                                    <option value="3">Artículo de compra y venta</option>
                                                @else
                                                    @if ($products->kind_product == 'Artículo de compra y venta')
                                                        <option value="1">Artículo de venta</option>
                                                        <option value="2">Artículo de compra</option>
                                                        <option value="3" selected> {{ $products->kind_product }}</option>
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
                                    {{-- <!-- precio --> --}}
                                    <div id="d" @if ($products->kind_product == 'Artículo de venta' || $products->kind_product == 'Artículo de compra y venta') class=" col-12 col-md-6 input-group input-group-lg mb-3"
                                        @else
                                        class="d-none col-12 col-md-6 input-group input-group-lg mb-3" @endif>
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
                                    <div id="b" @if ($products->kind_product == 'Artículo de venta' || $products->kind_product == 'Artículo de compra y venta') class=" col-12 col-md-6 input-group input-group-lg mb-3"
                                        @else
                                                                                                    class="d-none col-12 col-md-6 input-group input-group-lg mb-3" @endif>
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
                                    <div id="c" @if ($products->kind_product == 'Artículo de venta' || $products->kind_product == 'Artículo de compra y venta') class=" col-12 col-md-6 input-group input-group-lg mb-3"
                                        @else
                                                                                                    class="d-none col-12 col-md-6 input-group input-group-lg mb-3" @endif>
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
                                    {{-- <!--costos--> --}}
                                    <div id="a" @if ($products->kind_product == 'Artículo de compra' || $products->kind_product == 'Artículo de compra y venta') class=" col-12 col-md-6 input-group input-group-lg mb-3"
                                            @else
                                                                                                        class="d-none col-12 col-md-6 input-group input-group-lg mb-3" @endif>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent">
                                                <i class="fas fa-coins"></i>
                                            </span>
                                        </div>
                                        <input value="{{ $products->cost }}" id="cost" name="cost" type="text"
                                            onchange="mostrarInput();"
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



                                    {{-- ¿Agregar dimensiones? --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i class="fas fa-balance-scale"></i>
                                            </span>
                                        </div>
                                        <select name="dimensiones" id="dimensiones" onchange="MostrarDimensiones();"
                                            class="form-control" required>
                                            @if ($products->weight >= 1 || $products->tall >= 1 || $products->broad >= 1 || $products->depth >= 1)
                                                <option value="0" selected>Contiene dimensiones</option>
                                                <option value="1">¿Quitar dimensiones?</option>
                                            @else
                                                <option value="0">¿Agregar dimensiones?</option>
                                                <option value="1" selected>No contiene dimensiones</option>
                                            @endif
                                        </select>
                                    </div>
                                    {{-- <!--Peso--> --}}
                                    <div  @if ($products->weight >= 1 || $products->tall >= 1 || $products->broad >= 1 || $products->depth >= 1)
                                        class=" col-12 col-md-6 input-group input-group-lg mb-3"
                                        @else
                                        class="d-none col-12 col-md-6 input-group input-group-lg mb-3"
                                        @endif
                                        id="Peso">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i class="fas fa-shopping-bag"></i>
                                            </span>
                                        </div>
                                        <input id="weight" name="weight" type="text" value="{{$products->weight}}"
                                            class="text-dark form-control @error('weight') is-invalid @enderror"
                                            placeholder="Peso lbs ó kgs" autocomplete="weight" autofocus>
                                        @error('weight')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- <!--Altura --> --}}
                                    <div
                                    @if ($products->weight >= 1 || $products->tall >= 1 || $products->broad >= 1 || $products->depth >= 1)
                                        class=" col-12 col-md-6 input-group input-group-lg mb-3"
                                        @else
                                        class="d-none col-12 col-md-6 input-group input-group-lg mb-3"
                                        @endif
                                     id="Altura">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i class="fas fa-ruler-vertical"></i>
                                            </span>
                                        </div>
                                        <input id="tall" name="tall" type="text" value="{{ $products->tall}}"
                                            class="text-dark form-control @error('tall') is-invalid @enderror"
                                            placeholder="Altura" autocomplete="tall" autofocus>
                                        @error('tall')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- <!--Ancho --> --}}
                                    <div @if ($products->weight >= 1 || $products->tall >= 1 || $products->broad >= 1 || $products->depth >= 1)
                                        class=" col-12 col-md-6 input-group input-group-lg mb-3"
                                        @else
                                        class="d-none col-12 col-md-6 input-group input-group-lg mb-3"
                                        @endif
                                     id="Ancho">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i class="fas fa-ruler-horizontal"></i>
                                            </span>
                                        </div>
                                        <input id="broad" name="broad" type="text" value="{{$products->broad}}"
                                            class="text-dark form-control @error('broad') is-invalid @enderror"
                                            placeholder="Ancho" autocomplete="broad" autofocus>
                                        @error('broad')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- <!--Profundidad --> --}}
                                    <div @if ($products->weight >= 1 || $products->tall >= 1 || $products->broad >= 1 || $products->depth >= 1)
                                        class=" col-12 col-md-6 input-group input-group-lg mb-3"
                                        @else
                                        class="d-none col-12 col-md-6 input-group input-group-lg mb-3"
                                        @endif id="Profundidad">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                <i class="fas fa-ruler"></i>
                                            </span>
                                        </div>
                                        <input id="depth" name="depth" type="text" value="{{$products->depth}}"
                                            class="text-dark form-control @error('depth') is-invalid @enderror"
                                            placeholder="Profundidad" autocomplete="depth" autofocus>
                                        @error('depth')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- imagen --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3 ">
                                        <img src="{{ asset('/storage/productos/' . $products->file) }}" width="150px"
                                            height="150px" alt="producto">
                                        <Strong> Actualizar <i class="fas fa-arrow-circle-right"></i> <br> imagen <div
                                                class=""></div></Strong>
                                        <input type="file" id="file" name="file" accept="image/*"
                                            class=" @error('file') is-invalid @enderror">
                                        @error('file')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- Inicio Inputs de tipo hydden --}}
                                    <!--  cantidad egresos -->
                                    <input id="amount_expenses" name="amount_expenses" type="hidden"
                                        value="{{ $products->amount_expenses }}" readonly>
                                    <!--En este input se va a cargar el total de ingresos del producto-->
                                    <input type="hidden" id="total" name="total_revenue" value="0" readonly>
                                    <!-- grandTotal -->
                                    <input type="hidden" id="grandTotal" value="{{ $products->quantity_values }}"
                                        readonly name="quantity_values">
                                    {{-- FIN Inputs de tipo hydden --}}
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

            // console.log("Que viene en select ", select);
            // console.log("Que viene en a ", a);
            // console.log("Que viene en b ", b);
            // console.log("Que viene en c ", c);
            // console.log("Que viene en d ", d);

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

        //selecionando si hay dimensiones
        function MostrarDimensiones() {
            var select = document.getElementById('dimensiones').value;
            var Peso = document.getElementById('Peso');
            var Altura = document.getElementById('Altura');
            var Ancho = document.getElementById('Ancho');
            var Profundidad = document.getElementById('Profundidad');

            if (select == '1') {
                Peso.className = "d-none col-12 col-md-6 input-group input-group-lg mb-3";
                Altura.className = "d-none col-12 col-md-6 input-group input-group-lg mb-3";
                Ancho.className = "d-none col-12 col-md-6 input-group input-group-lg mb-3";
                Profundidad.className = "d-none col-12 col-md-6 input-group input-group-lg mb-3";
            }
            if (select == '0') {
                Peso.className = "col-12 col-md-6 input-group input-group-lg mb-3";
                Altura.className = "col-12 col-md-6 input-group input-group-lg mb-3";
                Ancho.className = "col-12 col-md-6 input-group input-group-lg mb-3";
                Profundidad.className = "col-12 col-md-6 input-group input-group-lg mb-3";
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


{{-- Crear select dinamicos con etiquetas (select multiple)
    https://translate.google.com/translate?hl=es-419&sl=en&u=https://select2.org/getting-started/basic-usage&prev=search&pto=aue


     <select
                            class="js-example-basic-multiple js-states form-control @error('category_id') is-invalid @enderror"
                            name="category_id[]" id="category_id" multiple="multiple" required>
                            <option disabled selected>Categorias</option>
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>

    <script>
        $('.js-example-basic-multiple').select2();

    </script>
    --}}
