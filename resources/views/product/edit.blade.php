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
                    <div class="card bg-card">
                        <div class="card-header bg-cardheader" style="border-top-right-radius: 25px; 
                                                border-top-left-radius: 25px;">
                            <strong class="card-title text-light">Editar Productos</strong>
                        </div>
                        <div class="card-body bg-frm">
                            <div>
                                <form name="calculadora" action="{{ url('productos/' . $products->id) }}" method="POST"
                                    file="true" enctype="multipart/form-data" onsubmit="return checkSubmit();">
                                    @csrf @method('PATCH')
                                    {{-- <!--Nombre--> --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span
                                                class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                id="inputGroup-sizing-sm">
                                                <i title="Nombre" class="text-primary fas fa-people-carry"></i>
                                            </span>
                                        </div>
                                        <input id="name" name="name" type="text"
                                            class="border-0 bg-input text-dark form-control @error('name') is-invalid @enderror"
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
                                            <span
                                                class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                id="inputGroup-sizing-sm">
                                                <i title="Descripción" class="text-primary fas fa-book"></i>
                                            </span>
                                        </div>
                                        <input id="description" maxlength="50" name="description" type="text"
                                            class="border-0 bg-input text-dark form-control @error('name') is-invalid @enderror"
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
                                            <span
                                                class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                id="inputGroup-sizing-sm">
                                                <i class="text-primary fas fa-user"></i>
                                            </span>
                                        </div>
                                        <select name="kind_product" id="kind_product" onchange="mostrarInput();"
                                            class="border-0 bg-input form-control @error('kind_product') is-invalid @enderror"
                                            required>

                                            @if ($products->kind_product == 1)
                                                <option value="{{ $products->kind_product }}" selected>Artículo de venta
                                                </option>
                                                <option value="2">Artículo de compra</option>
                                                <option value="3">Artículo de compra y venta
                                                </option>
                                            @else
                                                @if ($products->kind_product == 2)
                                                    <option value="1">Artículo de venta</option>
                                                    <option value="{{ $products->kind_product }}" selected>Articulo de
                                                        compra </option>
                                                    <option value="3">Artículo de compra y venta</option>
                                                @else
                                                    @if ($products->kind_product == 3)
                                                        <option value="1">Artículo de venta</option>
                                                        <option value="2">Artículo de compra</option>
                                                        <option value="{{ $products->kind_product }}" selected> Articulo
                                                            de
                                                            compra y venta</option>
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
                                    <div id="d" @if ($products->kind_product == 1 || $products->kind_product == 3) class=" col-12 col-md-6 input-group input-group-lg mb-3"
                                        @else
                                                                                                    class="d-none col-12 col-md-6 input-group input-group-lg mb-3" @endif>
                                        <div class="input-group-prepend">
                                            <span
                                                class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                id="inputGroup-sizing-sm">
                                                <i title="Precio" class="text-primary fas fa-hand-holding-usd"></i>
                                            </span>
                                        </div>
                                        <input id="price" name="price" type="text"
                                            class="border-0 bg-input text-dark form-control @error('price') is-invalid @enderror"
                                            value="{{ $products->price }}" placeholder="Precio del Producto" required
                                            autocomplete="price" autofocus>
                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <!--Precio especial-->
                                    <div id="b" @if ($products->kind_product == 1 || $products->kind_product == 3) class=" col-12 col-md-6 input-group input-group-lg mb-3"
                                        @else
                                                                                                                                                                class="d-none col-12 col-md-6 input-group input-group-lg mb-3" @endif>
                                        <div class="input-group-prepend">
                                            <span
                                                class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                id="inputGroup-sizing-sm">
                                                <i class="text-primary fas fa-star"></i>
                                            </span>
                                        </div>
                                        <input id="special_price" name="special_price" type="number" step="0.01"
                                            class="border-0 bg-input text-dark form-control special_price  @error('special_price') is-invalid @enderror"
                                            value="{{ $products->special_price }}" placeholder="Precio especial"
                                            autocomplete="special_price" autofocus>
                                        @error('special_price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <!--Precio crédito-->
                                    <div id="c" @if ($products->kind_product == 1 || $products->kind_product == 3) class=" col-12 col-md-6 input-group input-group-lg mb-3"
                                        @else
                                                                                                                                                                class="d-none col-12 col-md-6 input-group input-group-lg mb-3" @endif>
                                        <div class="input-group-prepend">
                                            <span
                                                class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                id="inputGroup-sizing-sm">
                                                <i class="text-primary fas fa-credit-card"></i>
                                            </span>
                                        </div>
                                        <input id="credit_price" name="credit_price" type="number" step="0.01"
                                            class="border-0 bg-input text-dark form-control credit_price  @error('credit_price') is-invalid @enderror"
                                            value="{{ $products->credit_price }}" placeholder="Precio al crédito"
                                            autocomplete="credit_price" autofocus>
                                        @error('credit_price')
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
                                            <span
                                                class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent">
                                                <i class="text-primary fas fa-coins"></i>
                                            </span>
                                        </div>
                                        <input value="{{ $products->cost }}" id="cost" name="cost" type="text"
                                            onchange="mostrarInput();"
                                            class="border-0 bg-input text-dark form-control @error('cost') is-invalid @enderror"
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
                                                <span
                                                    class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                    id="inputGroup-sizing-sm">
                                                    <i title="company" class="text-primary far fa-building"></i>
                                                </span>
                                            </div>
                                            <select name="company_id" id="company_id"
                                                class="border-0 bg-input form-control @error('company_id') is-invalid @enderror">
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
                                            <span
                                                class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                id="inputGroup-sizing-sm">
                                                <i title=" Nuevos ingresos" class="text-primary fas fa-plus-square"></i>
                                            </span>
                                        </div>
                                        <input type="number" value="" id="txt_campo_2" name="new_income"
                                            class="border-0 bg-input monto form-control" onchange="sumar();"
                                            placeholder="Nuevos ingresos" required />
                                        @error('quantity_values')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- ¿Agregar dimensiones? --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span
                                                class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                id="inputGroup-sizing-sm">
                                                <i class="text-primary fas fa-balance-scale"></i>
                                            </span>
                                        </div>
                                        <select name="dimensiones" id="dimensiones" onchange="MostrarDimensiones();"
                                            class="border-0 bg-input form-control" required>
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
                                    <div @if ($products->weight >= 1 || $products->tall >= 1 || $products->broad >= 1 || $products->depth >= 1) class=" col-12 col-md-6 input-group input-group-lg mb-3"
                                        @else
                                                                                                    class="d-none col-12 col-md-6 input-group input-group-lg mb-3" @endif id="Peso">
                                        <div class="input-group-prepend">
                                            <span
                                                class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                id="inputGroup-sizing-sm">
                                                <i class="text-primary fas fa-shopping-bag"></i>
                                            </span>
                                        </div>
                                        <input id="weight" name="weight" type="text" value="{{ $products->weight }}"
                                            class="border-0 bg-input text-dark form-control @error('weight') is-invalid @enderror"
                                            placeholder="Peso lbs ó kgs" autocomplete="weight" autofocus>
                                        @error('weight')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- <!--Altura --> --}}
                                    <div @if ($products->weight >= 1 || $products->tall >= 1 || $products->broad >= 1 || $products->depth >= 1) class=" col-12 col-md-6 input-group input-group-lg mb-3"
                                        @else
                                                                                                    class="d-none col-12 col-md-6 input-group input-group-lg mb-3" @endif id="Altura">
                                        <div class="input-group-prepend">
                                            <span
                                                class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                id="inputGroup-sizing-sm">
                                                <i class="text-primary fas fa-ruler-vertical"></i>
                                            </span>
                                        </div>
                                        <input id="tall" name="tall" type="text" value="{{ $products->tall }}"
                                            class="border-0 bg-input text-dark form-control @error('tall') is-invalid @enderror"
                                            placeholder="Altura" autocomplete="tall" autofocus>
                                        @error('tall')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- <!--Ancho --> --}}
                                    <div @if ($products->weight >= 1 || $products->tall >= 1 || $products->broad >= 1 || $products->depth >= 1) class=" col-12 col-md-6 input-group input-group-lg mb-3"
                                        @else
                                                                                                    class="d-none col-12 col-md-6 input-group input-group-lg mb-3" @endif id="Ancho">
                                        <div class="input-group-prepend">
                                            <span
                                                class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                id="inputGroup-sizing-sm">
                                                <i class="text-primary fas fa-ruler-horizontal"></i>
                                            </span>
                                        </div>
                                        <input id="broad" name="broad" type="text" value="{{ $products->broad }}"
                                            class="border-0 bg-input text-dark form-control @error('broad') is-invalid @enderror"
                                            placeholder="Ancho" autocomplete="broad" autofocus>
                                        @error('broad')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- <!--Profundidad --> --}}
                                    <div @if ($products->weight >= 1 || $products->tall >= 1 || $products->broad >= 1 || $products->depth >= 1) class=" col-12 col-md-6 input-group input-group-lg mb-3"
                                        @else
                                                                                                    class="d-none col-12 col-md-6 input-group input-group-lg mb-3" @endif id="Profundidad">
                                        <div class="input-group-prepend">
                                            <span
                                                class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                id="inputGroup-sizing-sm">
                                                <i class="text-primary fas fa-ruler"></i>
                                            </span>
                                        </div>
                                        <input id="depth" name="depth" type="text" value="{{ $products->depth }}"
                                            class="border-0 bg-input text-dark form-control @error('depth') is-invalid @enderror"
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
                                            class="border-0 bg-input @error('file') is-invalid @enderror">
                                        @error('file')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- select etiquetas FAMILIA --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span
                                                class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text text-primary"
                                                id="inputGroup-sizing-sm">
                                                <i class="fas fa-users"></i>
                                            </span>
                                        </div>
                                        <select
                                            class="border-0 bg-input js-example-basic-multiple js-states form-control @error('family_id') is-invalid @enderror"
                                            name="family_id[]" id="family_id" multiple="multiple" required>
                                            <option disabled>Categorias Seleccionadas:</option>
                                            @foreach ($products->pivotFamily as $datos)
                                                @if ($datos->product_id == $products->id)
                                                    <option selected value="{{ $datos->family_id }}">
                                                        {{ $datos->families->name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                            <option disabled>Otras Categorias::</option>
                                            @foreach ($family as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('family_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- select etiquetas MARCAS --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span
                                                class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text text-primary"
                                                id="inputGroup-sizing-sm">
                                                <i class="fas fa-users"></i>
                                            </span>
                                        </div>
                                        <select
                                            class="border-0 bg-input js-example-basic-multiple js-states form-control @error('mark_id') is-invalid @enderror"
                                            name="mark_id[]" id="mark_id" multiple="multiple" required>
                                            <option disabled>Marcas Seleccionadas:</option>

                                            @foreach ($products->pivotMark as $datos)
                                                @if ($datos->product_id == $products->id)
                                                    <option selected value="{{ $datos->mark_id }}">
                                                        {{ $datos->marks->name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                            <option disabled>Otras Marcas::</option>
                                            @foreach ($mark as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('mark_id')
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
                                                <button type="submit" style="border-radius: 50px"
                                                    class="btn btn-primary mt-3">
                                                    <i class="far fa-save"></i>
                                                    {{ __('GUARDAR') }}
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Ingresos registrados -->
                                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                            <input value="{{ $products->total_revenue }}" type="hidden" id="txt_campo_1"
                                                class="monto" onchange="sumar();" name="income_amount" readonly />
                                        </div>
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

@section('js')
    <script>
        $('.js-example-basic-multiple').select2();

    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

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

    </script> --}}
