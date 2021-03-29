@extends('layouts.'. auth()->user()->getRoleNames()[0])
@section('content')
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

    <!--Compra-->
    <div class="content mt-3" id="factura">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card bg-card">
                        <div class="card-header bg-cardheader" style="border-top-right-radius: 25px; 
                                border-top-left-radius: 25px;">
                            <strong class="card-title text-light">Registrar compra</strong>
                        </div>
                        <div class="card-body bg-frm">
                            <form method="POST" action="{{ route('compras.store') }}" onsubmit="return checkSubmit();">
                                @csrf

                                {{-- user_id --}}
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                                {{-- Fecha de emisión --}}
                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span
                                            class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                            id="inputGroup-sizing-sm">
                                            <i title="Fecha de emisión" class="text-primary fas fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input id="date_issue" name="date_issue" type="date"
                                        class="text-dark form-control border-0 bg-input @error('date_issue') is-invalid @enderror"
                                        value="<?php echo date('y/m/d'); ?>" required
                                        autocomplete="date_issue" autofocus>
                                    @error('date_issue')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Company_id --}}
                                <input type="hidden" name="company_id" value="{{ auth()->user()->company_id }}">

                                {{-- Sucursal --}}
                                <input type="hidden" name="branch_id" value="{{ auth()->user()->branch_id }}">

                                {{-- Tipo de producto --}}
                                <div class="col-12 col-md-6 input-group input-group-lg mb-4">
                                    <div class="input-group-prepend">
                                        <span
                                            class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                            id="inputGroup-sizing-sm">
                                            <i class="text-primary fas fa-file-word"></i>
                                        </span>
                                    </div>
                                    <select name="type_product" id="type_product"
                                        class="form-control border-0 bg-input @error('type_product') is-invalid @enderror"
                                        required>
                                        <option selected disabled>Tipo de producto</option>
                                        <option value="1">Compra</option>
                                        <option value="2">Compra y venta</option>
                                    </select>
                                    @error('type_product')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    @error('type_product')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Elije si es nuevo o existente --}}
                                <div class="col-12 col-md-6 input-group input-group-lg mb-4">
                                    <div class="input-group-prepend">
                                        <span
                                            class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                            id="inputGroup-sizing-sm">
                                            <i class="text-primary fas fa-file-word"></i>
                                        </span>
                                    </div>
                                    <select name="new_existing" id="new_existing"
                                        class="form-control border-0 bg-input @error('new_existing') is-invalid @enderror"
                                        required>
                                        <option selected disabled>Compra en:</option>
                                        <option value="1">Producto existente</option>
                                    </select>
                                    @error('new_existing')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    @error('new_existing')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Proveedor --}}
                                <div class="col-12 col-md-6 input-group input-group-lg mb-4">
                                    <div class="input-group-prepend">
                                        <span
                                            class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                            id="inputGroup-sizing-sm">
                                            <i class="text-primary fas fa-receipt"></i>
                                        </span>
                                    </div>
                                    <input class="text-dark form-control border-0 bg-input" name="supplier"
                                        placeholder="Proveedor" id="supplier" type="text">
                                    @error('supplier')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    @error('supplier')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Descripción --}}
                                <textarea class="border-0 bg-span form-control" rows="5" id="description"
                                    placeholder="Descripción"
                                    style="border-radius: 35px; box-shadow: 8px 8px 10px 0 #0883ad"
                                    name="description"></textarea>

                                <input type="hidden" name="date" id="date">
                                <br>

                                <!-- Trigger the modal with a button -->
                                <button type="button" onclick="agregarProducto()" style="border-radius: 95px;"
                                    class="btn btn-success text-light" data-dismiss="modal">+ AGREGAR PRODUCTO
                                </button>

                                <input type="hidden" id="ListaPro" name="ListaPro" value="" />

                                <div style="border-radius: 35px; box-shadow: 8px 8px 10px 0 #0883ad"
                                    class="row table-responsive">
                                    <table id="TablaPro" class="table table-striped table-bordered dataTable no-footer">
                                        <thead class="bg-cardheader text-light">
                                            <tr>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>Precio de compra</th>
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

                                <br>
                                {{-- Total --}}
                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span style="background: transparent" class="border-0 input-group-text transparent"
                                            id="inputGroup-sizing-sm">
                                            <label>Total</label>
                                        </span>
                                    </div>

                                    <input id="spTotal" onchange="numbersToText()"
                                        class="text-dark form-control border-0 @error('spTotal') is-invalid @enderror" name="spTotal"
                                        style="background: transparent" readonly>

                                    @error('spTotal')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- totalletras --}}
                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                    <input id="totalletras"
                                        class="text-dark form-control border-0 @error('totalletras') is-invalid @enderror"
                                        style="background: transparent" name="totalletras" autofocus value="total letras" readonly>
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
                                            <button type="submit" style="border-radius: 50px" class="btn btn-primary mt-3">
                                                <i class="far fa-save"></i>
                                                {{ __('GUARDAR') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!--Button-->
                            </form>
                            <div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Compra-->

    {{-- Detalle de la compra --}}
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
            dateDays.invoice = result;
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

        var count = 0;

        function agregarProducto() {
            let selectedProduct = document.getElementById('new_existing').value;
            console.error(selectedProduct);
            var tax = 1.12;
            var sel = $('#producto_id').find(':selected').val(); //Capturo el Value del Producto
            var text = $('#producto_id').find(':selected')
                .text(); //Capturo el Nombre del Producto- Texto dentro del Select
            count++;
            console.log("Presionado : ", count);
            var sptext = text.split();
            var newtr = '<tr class="item"  data-id="' + sel + '">';
            var newtr = '<tr class=""  data-id="' + sel + '">';

/*             if (selectedProduct == 1) {
                console.error("Producto existente");
                newtr = newtr +
                    `<td><input class="border-top-0 border-bottom-0 border-right-0 bg-span form-control" placeholder="Producto" type="text" id="product" name="product[]" value="" /><td><input class="form-control bg-input border-0" type="number" id="cantidad[]" name="quantity[]" onChange="Calcular(this);" value="0" /></td><td><input class="form-control border-0" style="background: transparent" type="number" id="precunit${count}" step="0.01" name="unit_price[]" onChange="Calcular(this);" value="1"/></td><td><input class="form-control border-0" style="background: transparent" type="number" id="totalitem[]" name="subtotal[]" readonly/></td>';`
                newtr = newtr +
                    '<td><button type="button" class="rounded-circle btn btn-danger btn-xs remove-item" ><i class="far fa-trash-alt"></i></button></td></tr>';
            } */
            if (selectedProduct == 1) {
                console.error("Producto existente");
                newtr = newtr +
                    `<td><select onchange="mostrarprecio()" class="border-top-0 border-bottom-0 border-right-0 bg-span select2 form-control" onchange="showStockSelect()" class="selectpicker form-control" id="product_id${count}" name="product_id[]"><option disabled selected>Tus productos</option>@foreach ($product as $item)><option value="{{ $item->id }}" valuestock="{{ $item->cost }}">{{ $item->name }}@if ($item->stock < 5)({{ $item->stock }} unidades)@endif</option>@endforeach</select><td><input class="bg-input border-0 form-control" type="number" id="cantidad[]" name="quantity[]" onChange="Calcular(this);" value="0" /></td><td><input class="form-control border-0" style="background: transparent" type="number" id="precunit${count}" step="0.01" name="unit_price[]" onChange="Calcular(this);" value="1"/></td><td><input class="form-control border-0" style="background: transparent" type="number" id="totalitem[]" name="subtotal[]" readonly/></td>';`
                newtr = newtr +
                    '<td><button type="button" class="rounded-circle btn btn-danger btn-xs remove-item" ><i class="far fa-trash-alt"></i></button></td></tr>';
            }

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
                if (nodes[x].firstChild.id == `precunit${count}`) {
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
            var pizza = document.getElementById(`product_id${count}`),
                precio = document.getElementById(`precunit${count}`);

            precio.value = pizza.selectedOptions[0].attributes.valuestock.value;
        }

    </script>
    {{-- Detalle de la compra --}}
@endsection
