@extends('layouts.'. auth()->user()->getRoleNames()[0])
@section('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!--Mensajes-->
    <div>
        <!--Validación de errores-->
        @if ($errors->any())
            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                <span class="badge badge-pill badge-danger">Atención</span>
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        <!--Validación de errores-->

        <!--Mensaje flash-->
        @if (session('usuarioGuardado'))
            <div class="alert alert-success">
                {{ session('datosEliminados') }}
            </div>
        @endif
        <!--Mensaje flash-->
    </div>
    <!--Mensajes-->

    <!--Factura-->
    <div class="content mt-3" id="factura">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Emitir factura </strong>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('facturas.store') }}" onsubmit="return checkSubmit();">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                                {{-- Fecha de emisión --}}
                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                            <i title="Fecha de emisión" class="fas fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input id="date_issue" name="date_issue" type="date"
                                        class="text-dark form-control @error('date_issue') is-invalid @enderror"
                                        value="<?php echo date('y/m/d'); ?>"
                                        onchange="addDays(30);" required autocomplete="date_issue" autofocus>
                                    @error('date_issue')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Fecha de vencimiento --}}
                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                            <i title="Fecha de vencimiento" class="fas fa-calendar-times"></i>
                                        </span>
                                    </div>
                                    <input id="expiration_date" name="expiration_date" type="date"
                                        class="text-dark form-control @error('expiration_date') is-invalid @enderror"
                                        required autocomplete="expiration_date" autofocus readonly>
                                    @error('expiration_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                @if (Auth::user()->role_id == 1)
                                    {{-- company --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-4">
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
                                                        Su compañia: {{ auth()->user()->companies->name }}
                                                    </p>
                                                </option>
                                            @endif

                                            @foreach ($company as $item)
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
                                    <input type="hidden" name="company_id" value="{{ auth()->user()->company_id }}">
                                @endif

                                {{-- Sucursal --}}
                                <input type="hidden" name="branch_id" value="{{ auth()->user()->branch_id }}">

                                {{-- Adquisición --}}
                                <div class="col-12 col-md-6 input-group input-group-lg mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <select name="acquisition" id="acquisition"
                                        class="form-control @error('acquisition') is-invalid @enderror" required>
                                        <option selected disabled>Adquisición</option>
                                        <option value="1">Bienes</option>
                                        <option value="2">Servicios</option>
                                        <option value="3">Bienes y servicios</option>
                                    </select>
                                    @error('acquisition')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    @error('acquisition')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Iva --}}
                                {{-- <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                            <label>Iva</label>
                                        </span>
                                    </div>
                                    <input id="iva" type="number"
                                        class="text-dark form-control @error('iva') is-invalid @enderror" name="iva"
                                        value="{{ old('iva') }}" required autocomplete="iva" autofocus readonly>

                                    @error('iva')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    @error('iva')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div> --}}

                                {{-- Customer_id --}}
                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <a type="submit" class="btn btn-secondary mb-1" data-toggle="modal"
                                            data-target="#largeModal"><i class="fas fa-user-plus text-light"></i>
                                        </a>
                                    </div>
                                    <select name="customer_id" id="cifrado" onchange="mostrarInput();"
                                        class="select2 form-control @error('customer_id') is-invalid @enderror">
                                        <option selected disabled>Cliente</option>
                                        <option value="0">C/F</option>
                                        @foreach ($customer as $item)
                                            <option value="{{ $item->id }}">Cliente: {{ $item->name }}
                                                {{ $item->lastname }} Nit: {{ $item->nit }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('customer_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    @error('customer_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Nombre del cliente --}}
                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <input class="text-dark form-control" name="customer_name"
                                        placeholder="Nombre del cliente" id="numero" type="text">
                                </div>

                                {{-- Correo del cliente --}}
                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <input class="text-dark form-control" name="customer_email" placeholder="Correo"
                                        id="text" type="text">
                                </div>

                                {{-- Descripción --}}
                                <textarea class="form-control" rows="5" id="description" placeholder="Descripción"
                                    name="description"></textarea>

                                <input type="hidden" name="date" id="date">
                                <br>

                                <!-- Trigger the modal with a button -->
                                <button type="button" onclick="agregarProducto()" style="border-radius: 95px;"
                                    class="btn btn-success text-light" data-dismiss="modal">Agregar Producto<i
                                        class="fas fa-cart-plus text-light"></i>
                                </button>

                                <input type="hidden" id="ListaPro" name="ListaPro" value="" />

                                <div class="row table-responsive">
                                    <table id="TablaPro" class="table table-striped table-bordered dataTable no-footer">
                                        <thead>
                                            <tr>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>Precio</th>
                                                <th>Subtotal</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody id="ProSelected">
                                            <!--Ingreso un id al tbody-->
                                            <tr>

                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td>Total</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td><span id="total">0</span>
                                                <td>&nbsp;</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                {{-- Total --}}
                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                            <label>Total</label>
                                        </span>
                                    </div>

                                    <input id="spTotal" onchange="numbersToText()"
                                        class="text-dark form-control @error('spTotal') is-invalid @enderror"
                                        name="spTotal" readonly>

                                    @error('spTotal')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- totalletras --}}
                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <input id="totalletras"
                                        class="text-dark form-control @error('totalletras') is-invalid @enderror"
                                        name="totalletras" autofocus value="total letras" readonly>
                                    @error('totalletras')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!--Button-->
                                <div class="container">
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
                                <!--Button-->

                                <select id="pizza" onchange="mostrarprecio()">
                                    <option selected disabled>Productos</option>
                                    @foreach ($product as $item)
                                        <option value="{{ $item->price}}">Producto: {{ $item->name }}
                                            Precio : {{ $item->price }} 
                                        </option>
                                    @endforeach
                                </select>
                                <input type="text" id="precio" />
                            </form>
                            <div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Factura-->

    <!-- Modal para agregar clientes -->
    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="largeModalLabel">Registrar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('clientes.store') }}" onsubmit="return checkSubmit();">
                        @csrf

                        {{-- Nombre --}}
                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                    <i title="Nombre" class="text-dark fas fa-user"></i>
                                </span>
                            </div>
                            <input id="name" type="text" class="text-dark form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" placeholder="Nombre" required autocomplete="name"
                                autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Apellido --}}
                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                    <i title="Apellido" class="text-dark fas fa-user"></i>
                                </span>
                            </div>
                            <input id="lastname" placeholder="Apellido" type="text"
                                class="text-dark form-control @error('lastname') is-invalid @enderror" name="lastname"
                                value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Teléfono --}}
                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                    <i title="Número de teléfono" class="text-dark fas fa-mobile"></i>
                                </span>
                            </div>
                            <input id="phone" placeholder="Número de teléfono" type="number"
                                class="text-dark form-control @error('phone') is-invalid @enderror" name="phone"
                                value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                    <i title="Correo electrónico" class="text-dark fas fa-at"></i>
                                </span>
                            </div>
                            <input id="email" placeholder="Correo electrónico" type="text"
                                class="text-dark form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Nit --}}
                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                    <i title="Nit" class="text-dark fas fa-sort-amount-down"></i>
                                </span>
                            </div>
                            <input id="nit" placeholder="Nit" type="number"
                                class="text-dark form-control @error('nit') is-invalid @enderror" name="nit"
                                value="{{ old('nit') }}" required autocomplete="nit" autofocus>

                            @error('nit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            @error('nit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="container mt-4">
                            <div class="col-12">
                                <div class="col text-center">
                                    <button type="submit" style="border-radius: 10px" class="btn btn-lg btn-primary mt-3">
                                        <i class="far fa-save"></i>
                                        {{ __('Guardar') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" style="border-radius: 10px" class="btn btn-danger" data-dismiss="modal"><i
                            class="fas fa-times-circle"></i> Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal para agregar clientes -->

    <!--Script inputs dinámicos-->
    <script>
        /*Fecha de vencimiento*/
        function addDays(days) {
            var date = document.getElementById("date_issue").value;
            console.log(date);
            var result = new Date(date);
            result.setDate(result.getDate() + days);
            console.log(result);
            var dateDays = document.getElementById("expiration_date");
            dateDays.placeholder = result;
            dateDays.valueAsDate = result;
            console.log(dateDays);
            return result;
        }

        /*Tabla factura*/
        function RefrescaProducto() {
            var ip = [];
            var i = 0;
            $('#guardar').attr('disabled', 'disabled'); //Deshabilito el Boton Guardar
            $('.iProduct').each(function(index, element) {
                i++;
                ip.push({
                    pro_id: $(this).val()
                });
            });
            // Si la lista de Productos no es vacia Habilito el Boton Guardar
            if (i > 0) {
                $('#guardar').removeAttr('disabled', 'disabled');
            }
            var ipt = JSON.stringify(
                ip); //Convierto la Lista de Productos a un JSON para procesarlo en tu controlador
            $('#ListaPro').val(encodeURIComponent(ipt));

        }

        function agregarProducto() {
            var sel = $('#producto_id').find(':selected').val(); //Capturo el Value del Producto
            var text = $('#producto_id').find(':selected')
                .text(); //Capturo el Nombre del Producto- Texto dentro del Select

            var sptext = text.split();
            var newtr = '<tr class="item"  data-id="' + sel + '">';
            var newtr = '<tr class=""  data-id="' + sel + '">';
            newtr = newtr +
                `<td><select id="stock[]" onchange="mostrarprecio()" onchange="showStockSelect()" class="selectpicker form-control" id="product_id[]" name="product_id[]"><option disabled selected>Tus productos</option>@foreach ($product as $item)><option value="{{ $item->price }}" valuestock="{{ $item->stock }}">{{ $item->name }}@if ($item->stock < 5)({{ $item->stock }} unidades)@endif</option>@endforeach</select><td><input class="form-control" type="number" id="cantidad[]" name="quantity[]" onChange="Calcular(this);" value="0" /></td><td><input class="form-control" type="number" id="precio[]" id="precunit[]" step="0.01" name="unit_price[]" onChange="Calcular(this);" value="1"/></td><td><input class="form-control" type="number" id="totalitem[]" name="subtotal[]" readonly/></td>';`
            newtr = newtr +
                '<td><button type="button" class="btn btn-danger btn-xs remove-item" ><i class="far fa-trash-alt"></i></button></td></tr>';


            $('#ProSelected').append(newtr); //Agrego el Producto al tbody de la Tabla con el id=ProSelected
            RefrescaProducto(); //Refresco Productos
            $('.remove-item').off().click(function(e) {
                var total = document.getElementById("total");
                total.innerHTML = parseFloat(total.innerHTML) - parseFloat(this.parentNode.parentNode
                    .childNodes[3].childNodes[0].value);
                $(this).parent('td').parent('tr').remove(); //En accion elimino el Producto de la Tabla
                if ($('#ProSelected tr.item').length == 0)
                    $('#ProSelected .no-item').slideDown(300);
                RefrescaProducto();

                Calcular(e.target);
            });
            $('.iProduct').off().change(function(e) {
                RefrescaProducto();

            });
        }

        function showStockSelect() {
            let valueStock = true;
            let indexStock = document.getElementsByName("product_id[]");
            /* console.log(indexStock); */

            for (let i = 0; i < indexStock.length; i++) {
                let value = indexStock[i].selectedOptions[0].attributes.valuestock.value;
                /* let indexStockValue = indexStock[i].selectedOptions[0].index; */
                if (value <= 5) {
                    alert(`${value} unidades en existencia.`);
                    /*  notShow.push(indexStockValue); */
                } else {
                    /*  notShow.push(indexStockValue); */
                }
            }
        }

        function Calcular(ele) {
            var cantidad = 0,
                precunit = 0,
                totalitem = 0;
            spTotal = 0;
            var tr = ele.parentNode.parentNode;
            var nodes = tr.childNodes;

            /* Saca el iva
            var tasa = 12;
            var monto = $("#spTotal").val();

            var iva = (monto * tasa) / 100;
            //se carga el iva en el campo correspondiente
            $("#iva").val(iva); */


            for (var x = 0; x < nodes.length; x++) {
                if (nodes[x].firstChild.id == 'cantidad[]') {
                    cantidad = parseFloat(nodes[x].firstChild.value, 10);
                }
                if (nodes[x].firstChild.id == 'precunit[]') {
                    precunit = parseFloat(nodes[x].firstChild.value, 10);
                }
                if (nodes[x].firstChild.id == 'totalitem[]') {
                    anterior = nodes[x].firstChild.value;
                    totalitem = parseFloat((precunit * cantidad), 10);
                    nodes[x].firstChild.value = totalitem;
                }
            }
            // Resultado final de cada fila ERROR, al editar o eliminar una fila
            var total = document.getElementById("total");
            if (total.innerHTML == 'NaN') {
                total.innerHTML = 0;
            }
            //Imprimo el valor del total en mi input SpTotal
            total.innerHTML = parseFloat(total.innerHTML) + totalitem - anterior;
            var t = document.getElementById('spTotal');
            t.value = total.innerText;
            console.log(total);
            numbersToText();
        }

        //seleccionando elementos
        var inputDate = document.getElementById('date');
        var inputText = document.getElementById('text');
        var inputNumero = document.getElementById('numero');
        var select = document.getElementById('cifrado');

        //ocultar input fecha y numero
        inputDate.style.display = "none";
        inputNumero.style.display = "none";
        inputText.style.display = "none";

        function mostrarInput() {
            var valorSeleccionado = select.value;
            if (valorSeleccionado == '0') {
                //Muestra el input date
                inputDate.style.display = "block";
                //mostrar input text y número
                inputNumero.style.display = "block";
                inputText.style.display = "block";
            } else {
                //ocultar input fecha en caso de estar mostrandolo
                inputNumero.style.display = "none";
                inputText.style.display = "none";
                //mostrar input numero
                inputDate.style.display = "none";
            }

        }

        function mostrarprecio() {
            var pizza = document.getElementById("stock[]"),
                precio = document.getElementById("precio[]");

            precio.value = pizza.value;
        }

    </script>

    {{-- cantidad en letras --}}
    {{-- le da valores a mi moneda --}}
    <script>
        function numbersToText() {
            console.log('entrando a la funcion');
            var inputNumero = document.getElementById("spTotal");
            var botonConvertir = document.querySelector("#factura"),
                totalletras = document.getElementById("totalletras");

            console.log('input ', inputNumero);
            // Escuchar el click del botón
            // Obtener valor que hay en el input
            let valor = parseFloat(inputNumero.value);
            // Simple validación
            if (!valor) return alert("Escribe un valor");

            // Obtener la representación
            let letras = numeroALetras(valor, {
                plural: "QUETZALES",
                singular: "QUETZAL",
                centPlural: "CENTAVOS",
                centSingular: "CENTAVO"
            });
            // Y a la totalletras ponerle el resultado
            console.log('letras: ', letras);
            totalletras.value = letras;
            console.log('input ', totalletras);
        }

    </script>
    {{-- le da valores a mi moneda --}}
    <script>
        var numeroALetras = (function() {
            function Unidades(num) {
                switch (num) {
                    case 1:
                        return 'UN';
                    case 2:
                        return 'DOS';
                    case 3:
                        return 'TRES';
                    case 4:
                        return 'CUATRO';
                    case 5:
                        return 'CINCO';
                    case 6:
                        return 'SEIS';
                    case 7:
                        return 'SIETE';
                    case 8:
                        return 'OCHO';
                    case 9:
                        return 'NUEVE';
                }

                return '';
            } //Unidades()

            function Decenas(num) {

                let decena = Math.floor(num / 10);
                let unidad = num - (decena * 10);

                switch (decena) {
                    case 1:
                        switch (unidad) {
                            case 0:
                                return 'DIEZ';
                            case 1:
                                return 'ONCE';
                            case 2:
                                return 'DOCE';
                            case 3:
                                return 'TRECE';
                            case 4:
                                return 'CATORCE';
                            case 5:
                                return 'QUINCE';
                            default:
                                return 'DIECI' + Unidades(unidad);
                        }
                        case 2:
                            switch (unidad) {
                                case 0:
                                    return 'VEINTE';
                                default:
                                    return 'VEINTI' + Unidades(unidad);
                            }
                            case 3:
                                return DecenasY('TREINTA', unidad);
                            case 4:
                                return DecenasY('CUARENTA', unidad);
                            case 5:
                                return DecenasY('CINCUENTA', unidad);
                            case 6:
                                return DecenasY('SESENTA', unidad);
                            case 7:
                                return DecenasY('SETENTA', unidad);
                            case 8:
                                return DecenasY('OCHENTA', unidad);
                            case 9:
                                return DecenasY('NOVENTA', unidad);
                            case 0:
                                return Unidades(unidad);
                }
            } //Unidades()

            function DecenasY(strSin, numUnidades) {
                if (numUnidades > 0)
                    return strSin + ' Y ' + Unidades(numUnidades)

                return strSin;
            } //DecenasY()

            function Centenas(num) {
                let centenas = Math.floor(num / 100);
                let decenas = num - (centenas * 100);

                switch (centenas) {
                    case 1:
                        if (decenas > 0)
                            return 'CIENTO ' + Decenas(decenas);
                        return 'CIEN';
                    case 2:
                        return 'DOSCIENTOS ' + Decenas(decenas);
                    case 3:
                        return 'TRESCIENTOS ' + Decenas(decenas);
                    case 4:
                        return 'CUATROCIENTOS ' + Decenas(decenas);
                    case 5:
                        return 'QUINIENTOS ' + Decenas(decenas);
                    case 6:
                        return 'SEISCIENTOS ' + Decenas(decenas);
                    case 7:
                        return 'SETECIENTOS ' + Decenas(decenas);
                    case 8:
                        return 'OCHOCIENTOS ' + Decenas(decenas);
                    case 9:
                        return 'NOVECIENTOS ' + Decenas(decenas);
                }

                return Decenas(decenas);
            } //Centenas()

            function Seccion(num, divisor, strSingular, strPlural) {
                let cientos = Math.floor(num / divisor)
                let resto = num - (cientos * divisor)

                let letras = '';

                if (cientos > 0)
                    if (cientos > 1)
                        letras = Centenas(cientos) + ' ' + strPlural;
                    else
                        letras = strSingular;

                if (resto > 0)
                    letras += '';

                return letras;
            } //Seccion()

            function Miles(num) {
                let divisor = 1000;
                let cientos = Math.floor(num / divisor)
                let resto = num - (cientos * divisor)

                let strMiles = Seccion(num, divisor, 'UN MIL', 'MIL');
                let strCentenas = Centenas(resto);

                if (strMiles == '')
                    return strCentenas;

                return strMiles + ' ' + strCentenas;
            } //Miles()

            function Millones(num) {
                let divisor = 1000000;
                let cientos = Math.floor(num / divisor)
                let resto = num - (cientos * divisor)

                let strMillones = Seccion(num, divisor, 'UN MILLON DE', 'MILLONES DE');
                let strMiles = Miles(resto);

                if (strMillones == '')
                    return strMiles;

            } //Millones()

            return function NumeroALetras(num, currency) {
                currency = currency || {};
                let data = {
                    numero: num,
                    enteros: Math.floor(num),
                    centavos: (((Math.round(num * 100)) - (Math.floor(num) * 100))),
                    letrasCentavos: '',
                    letrasMonedaPlural: currency.plural ||
                        'PESOS CHILENOS', //'PESOS', 'Dólares', 'Bolívares', 'etcs'
                    letrasMonedaSingular: currency.singular ||
                        'PESO CHILENO', //'PESO', 'Dólar', 'Bolivar', 'etc'
                    letrasMonedaCentavoPlural: currency.centPlural || 'CHIQUI PESOS CHILENOS',
                    letrasMonedaCentavoSingular: currency.centSingular || 'CHIQUI PESO CHILENO'
                };

                if (data.centavos > 0) {
                    data.letrasCentavos = 'CON ' + (function() {
                        if (data.centavos == 1)
                            return Millones(data.centavos) + ' ' + data.letrasMonedaCentavoSingular;
                        else
                            return Millones(data.centavos) + ' ' + data.letrasMonedaCentavoPlural;
                    })();
                };

                if (data.enteros == 0)
                    return 'CERO ' + data.letrasMonedaPlural + ' ' + data.letrasCentavos;
                if (data.enteros == 1)
                    return Millones(data.enteros) + ' ' + data.letrasMonedaSingular + ' ' + data
                        .letrasCentavos;
                else
                    return Millones(data.enteros) + ' ' + data.letrasMonedaPlural + ' ' + data
                        .letrasCentavos;
            };
        })();

    </script>
    {{-- cantidad en letras --}}




    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('jquery-ui-1.12.1/jquery-ui.min.css') }}">
    <link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css" />
    <script src="https://unpkg.com/jquery@2.2.4/dist/jquery.js"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
@endsection
