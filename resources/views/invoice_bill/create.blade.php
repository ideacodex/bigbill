@extends('layouts.Administrador')
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
    <div class="row">
        <div class="col-lg-12">
            <div class="card-body card-block">
                <form method="POST" action="{{ route('facturas.store') }}" onsubmit="return checkSubmit();">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <div class="col-xs-12">

                        {{-- Company_id --}}
                        <input type="hidden" name="company_id" value="{{ auth()->user()->company_id }}">
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

                        {{-- Customer_id --}}
                        <div class="col-12 col-md-6 input-group input-group-lg mb-4">
                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-secondary mb-1" data-toggle="modal"
                                    data-target="#largeModal"><i class="fas fa-user-plus text-light"></i>
                                </button>
                            </div>
                            <select name="customer_id" id="cifrado" onchange="mostrarInput();"
                                class="select2 form-control @error('customer_id') is-invalid @enderror">
                                <option selected disabled>Clientes</option>
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

                        {{-- Iva --}}
                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                    <label>Iva</label>
                                </span>
                            </div>
                            <input id="iva" type="number" class="text-dark form-control @error('iva') is-invalid @enderror"
                                name="iva" value="{{ old('iva') }}" required autocomplete="iva" autofocus readonly>

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
                        </div>

                        {{-- Total --}}
                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                    <label>Total</label>
                                </span>
                            </div>

                            <input id="spTotal" class="text-dark form-control @error('spTotal') is-invalid @enderror"
                                name="spTotal" autofocus readonly>

                            @error('spTotal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            @error('spTotal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Nombre del cliente --}}
                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                            <input class="text-dark form-control" name="customer_name" placeholder="Nombre del cliente"
                                id="numero" type="text">
                        </div>

                        {{-- Correo del cliente --}}
                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                            <input class="text-dark form-control" name="customer_email" placeholder="Correo" id="text"
                                type="text">
                        </div>

                        <input type="hidden" name="date" id="date" required>

                        <!-- Trigger the modal with a button -->
                        <button type="button" onclick="agregarProducto()" style="border-radius: 95px;"
                            class="btn btn-success text-light" data-dismiss="modal">Agregar Producto<i
                                class="fas fa-cart-plus text-light"></i>
                        </button>

                        <input type="hidden" id="ListaPro" name="ListaPro" value="" />

                        <table id="TablaPro" class="table">
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
                    <!--Button-->
                    <div class="container">
                        <div class="col-12">
                            <div class="col text-center">
                                <button type="submit" style="border-radius: 10px" class="btn btn-lg btn-primary mt-3">
                                    <i class="far fa-save"></i>
                                    {{ __('Guardar') }}
                                </button>
                            </div>
                        </div>
                    </div>
                    <!--Button-->
                </form>
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
            var ipt = JSON.stringify(ip); //Convierto la Lista de Productos a un JSON para procesarlo en tu controlador
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
                `<td>
                                                                                                                        <select id="stock[]" onchange="showStockSelect()" class="selectpicker form-control" id="product_id[]" name="product_id[]"><option disabled selected>Tus productos</option>@foreach ($product as $item)><option value="{{ $item->id }}" valuestock="{{ $item->stock }}">{{ $item->name }}@if ($item->stock < 5)({{ $item->stock }} unidades)@endif</option>@endforeach</select><td><input class="form-control" type="number" id="cantidad[]" name="quantity[]" onChange="Calcular(this);" value="0" /></td><td><input class="form-control" type="number" id="precunit[]" name="unit_price[]" onChange="Calcular(this);" value="1"/></td><td><input class="form-control" type="number" id="totalitem[]" name="subtotal[]" readonly/></td>';`
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
                    alert(`Solo tienes en existencia ${value}`);
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
                    cantidad = parseFloat(nodes[x].firstChild.value, 0);
                }
                if (nodes[x].firstChild.id == 'precunit[]') {
                    precunit = parseFloat(nodes[x].firstChild.value, 0);
                }
                if (nodes[x].firstChild.id == 'totalitem[]') {
                    anterior = nodes[x].firstChild.value;
                    totalitem = parseFloat((precunit * cantidad), 0);
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
    </script>
    <!--Script-->



    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('jquery-ui-1.12.1/jquery-ui.min.css') }}">
    <link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css" />
    <script src="https://unpkg.com/jquery@2.2.4/dist/jquery.js"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
@endsection
