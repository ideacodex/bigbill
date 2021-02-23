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
                            <strong class="card-title">Agregar Producto: </strong>
                        </div>
                        <div class="card-body">
                            <div>
                                @if (Auth::user()->role_id == 1 || Auth::user()->company_id)
                                    {{-- funcion en script suma de los nuevos ingresos con los que estaban --}}
                                    <script>
                                        function sumar() {
                                            const $total = document.getElementById('income_amount');
                                            let subtotal = 0;
                                            [...document.getElementsByClassName("quantity_values")].forEach(function(
                                                element) {
                                                if (element.value !== '') {
                                                    subtotal += parseFloat(element.value);
                                                }
                                            });
                                            $total.value = subtotal;
                                        }

                                    </script>
                                    <form action="{{ url('productos') }}" method="POST" enctype="multipart/form-data"
                                        file="true">
                                        @csrf
                                        {{-- Nombre --}}
                                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                    <i title="Nombre" class="fas fa-people-carry"></i>
                                                </span>
                                            </div>
                                            <input id="name" name="name" type="text"
                                                class="text-dark form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name') }}" placeholder="Producto" required
                                                autocomplete="name" autofocus>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        {{-- <!--descripcion--> --}}
                                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                    <i title="Descripción" class="fas fa-book"></i>
                                                </span>
                                            </div>
                                            <input id="description" name="description" type="text"
                                                class="text-dark form-control @error('name') is-invalid @enderror"
                                                value="{{ old('description') }}" placeholder="Descripción del producto"
                                                required autocomplete="description" autofocus>
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
                                                <option selected disabled>Tipo de producto</option>
                                                <option value="1">Artículo de venta</option>
                                                <option value="2">Artículo de compra</option>
                                                <option value="3">Artículo de compra y venta</option>
                                            </select>
                                            @error('kind_product')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        {{-- <!--costos--> --}}
                                        <div class="d-none col-12 col-md-6 input-group input-group-lg mb-3" id="a">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text transparent">
                                                    <i class="fas fa-coins"></i>
                                                </span>
                                            </div>
                                            <input id="cost" name="cost" type="number"
                                                class="text-dark form-control @error('cost') is-invalid @enderror"
                                                placeholder="Precio de compra" autocomplete="cost" autofocus>
                                            @error('cost')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        {{-- <!--precio--> --}}
                                        <div class="d-none col-12 col-md-6 input-group input-group-lg mb-3" id="b">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                    <i title="Precio" class="fas fa-hand-holding-usd"></i>
                                                </span>
                                            </div>
                                            <input id="price" name="price" type="number"
                                                class="text-dark form-control @error('price') is-invalid @enderror"
                                                placeholder="Precio de venta" autocomplete="price" autofocus>
                                            @error('price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            {{-- precio nuevo --}}

                                        </div>
                                        {{-- <!--Precio especial--> --}}
                                        <div class="d-none col-12 col-md-6 input-group input-group-lg mb-3" id="c">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                    <i class="fas fa-star"></i>
                                                </span>
                                            </div>
                                            <input id="special_price" name="special_price" type="number" step="0.01"
                                                value="" min="0.01"
                                                class="text-dark form-control @error('special_price') is-invalid @enderror"
                                                placeholder="Precio Especial" autocomplete="special_price" autofocus>
                                            @error('special_price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        {{-- <!--Precio crédito--> --}}
                                        <div id="d" class="d-none col-12 col-md-6 input-group input-group-lg mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                    <i class="fas fa-credit-card"></i>
                                                </span>
                                            </div>
                                            <input id="credit_price" name="credit_price" type="number" step="0.01" value=""
                                                min="0.01"
                                                class="text-dark form-control @error('credit_price') is-invalid @enderror"
                                                placeholder="Precio Credito" autocomplete="credit_price" autofocus>
                                            @error('credit_price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        {{-- <!--Company_id--> --}}
                                        @if (Auth::user()->role_id == 1)
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
                                            <input type="hidden" value="{{ Auth::user()->company_id }}"
                                                name="company_id">
                                        @endif
                                        {{-- <!--Impuestos--> --}}
                                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                    <i class="fas fa-piggy-bank"></i>
                                                </span>
                                            </div>
                                            <select name="tax" id="tax"
                                                class="form-control @error('tax') is-invalid @enderror" required>
                                                <option selected disabled>¿Aplicar impuesto?</option>
                                                <option value="1">Sí</option>
                                                <option value="0">No</option>
                                            </select>
                                            @error('tax')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        {{-- <!--cantidad ingreso--> --}}
                                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                    <i title="Ingresos" class="fas fa-box-open"></i>
                                                </span>
                                            </div>
                                            <input id="quantity_values" name="quantity_values" type="number"
                                                class="text-dark form-control quantity_values  @error('quantity_values') is-invalid @enderror"
                                                onchange="sumar();" value="" placeholder="Cantidad a Ingresar" required
                                                autocomplete="quantity_values" autofocus>
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
                                                <option selected disabled>¿Desea agregar dimensiones?</option>
                                                <option value="0">Si</option>
                                                <option value="1">No</option>
                                            </select>
                                        </div>
                                        {{-- <!--Peso--> --}}
                                        <div class="d-none col-12 col-md-6 input-group input-group-lg mb-3" id="Peso">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                    <i class="fas fa-shopping-bag"></i>
                                                </span>
                                            </div>
                                            <input id="weight" name="weight" type="text"
                                                class="text-dark form-control @error('weight') is-invalid @enderror"
                                                placeholder="Peso lbs ó kgs" autocomplete="weight" autofocus>
                                            @error('weight')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        {{-- <!--Altura --> --}}
                                        <div class="d-none col-12 col-md-6 input-group input-group-lg mb-3" id="Altura">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                    <i class="fas fa-ruler-vertical"></i>
                                                </span>
                                            </div>
                                            <input id="tall" name="tall" type="text"
                                                class="text-dark form-control @error('tall') is-invalid @enderror"
                                                placeholder="Altura" autocomplete="tall" autofocus>
                                            @error('tall')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        {{-- <!--Ancho --> --}}
                                        <div class="d-none col-12 col-md-6 input-group input-group-lg mb-3" id="Ancho">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                    <i class="fas fa-ruler-horizontal"></i>
                                                </span>
                                            </div>
                                            <input id="broad" name="broad" type="text"
                                                class="text-dark form-control @error('broad') is-invalid @enderror"
                                                placeholder="Ancho" autocomplete="broad" autofocus>
                                            @error('broad')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        {{-- <!--Profundidad --> --}}
                                        <div class="d-none col-12 col-md-6 input-group input-group-lg mb-3"
                                            id="Profundidad">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                    <i class="fas fa-ruler"></i>
                                                </span>
                                            </div>
                                            <input id="depth" name="depth" type="text"
                                                class="text-dark form-control @error('depth') is-invalid @enderror"
                                                placeholder="Profundidad" autocomplete="depth" autofocus>
                                            @error('depth')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        {{-- imagen --}}
                                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                            <input type="file" id="file" name="file" accept="image/*"
                                                class="text-dark form-control @error('file') is-invalid @enderror">
                                            @error('file')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        {{-- <!--cantidad egresos--> --}}
                                        <input id="amount_expenses" name="amount_expenses" type="hidden" value="0">
                                        {{-- <!--Button--> --}}
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
                                @else
                                    <div class="alert alert-success" role="alert">
                                        <h4 class="alert-heading">upss!</h4>
                                        <p>Bienvenido al sistema de Facturacion <b> TU CONTA</b> </p>
                                        <hr>
                                        <p class="mb-0">Al parecer aun no cuentas con una compañia, comunicate con tu
                                            superior para poderte asignar una compañia y empezar a trabajar</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- este script es el primer Selec dinamico que despliega los sigueintes 3 --}}
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

@endsection
