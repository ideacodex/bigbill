@extends('layouts.editar')
@section('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!--Mensajes-->
    <div>
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
                    <div class="col-xs-12"><br><br>

                        {{--Company_id--}}
                        <div class="col-12 col-md-6 input-group input-group-lg mb-4">
                            <div class="input-group-prepend">
                            </div>
                            <select style="width: 25em" name="company_id" id="company_id"
                                class="form-control @error('company_id') is-invalid @enderror" required>
                                <option selected disabled>Companías</option>
                                @foreach ($company as $item)
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

                        {{--Iva--}}
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

                        {{--Total--}}
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
                        <!-- Trigger the modal with a button -->
                        <button type="button" onclick="agregarProducto()" style="border-radius: 95px;"
                            class="btn btn-success text-light" data-dismiss="modal">Agregar Producto <i
                                class="fas fa-cart-plus text-light"></i></button>

                        <input type="hidden" id="ListaPro" name="ListaPro" value="" />
                        <table id="TablaPro" class="table">
                            <thead>
                                <tr>
                                    <th>Código de producto</th>
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

                        <!-- Modal -->
                        <div class="modal fade" id="myModal" role="dialog">

                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" data-dismiss="modal"><i
                                                class="fas fa-times-circle text-danger"></i></button>
                                        <h4 class="modal-title">Agregar producto a la lista</h4>
                                    </div>
                                    <div class="modal-body">

                                    </div>
                                    <div class="modal-footer">
                                        <!--Uso la funcion onclick para llamar a la funcion en javascript-->
                                        <button type="button" onclick="agregarProducto()" style="border-radius: 95px;"
                                            class="btn btn-warning text-dark" data-dismiss="modal">Agregar <i
                                                class="fas fa-cart-plus text-dark"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Button-->
                    <div class="container">
                        <div class="col-12">
                            <div class="col text-center">
                                <button type="submit" style="border-radius: 10px" class="btn btn-lg btn-primary mt-3">
                                    <i class="far fa-save"></i>
                                    {{ __('Guarda') }}
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
    <form>


        <!--Script-->
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
                newtr = newtr + '<td class="iProduct" >' + sel + '</td>';
                newtr = newtr +
                    '<td><select class="selectpicker form-control" id="product_id[]" name="product_id[]"></option>@foreach ($product as $item)><option value="{{ $item->id }}">{{ $item->name }}</option>@endforeach</select><td><input class="form-control" type="number" id="cantidad[]" name="quantity[]" onChange="Calcular(this);" value="0" /></td><td><input class="form-control" type="number" id="precunit[]" name="unit_price[]" onChange="Calcular(this);" value="1"/></td><td><input class="form-control" type="number" id="totalitem[]" name="subtotal[]" readonly/></td>';
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

            function Calcular(ele) {
                var cantidad = 0,
                    precunit = 0,
                    totalitem = 0;
                spTotal = 0;
                var tr = ele.parentNode.parentNode;
                var nodes = tr.childNodes;
                var tasa = 12;
                var monto = $("#spTotal").val();
                
                var iva = (monto * tasa) / 100;
                //se carga el iva en el campo correspondiente
                $("#iva").val(iva);
                
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

                /* Sumar dos números. 
                function sumar(valor) {
                    var total = 0;
                    valor = parseInt(valor); // Convertir el valor a un entero (número).
                    total = document.getElementById('spTotal').innerHTML;
                    // Aquí valido si hay un valor previo, si no hay datos, le pongo un cero "0".
                    total = (total == null || total == undefined || total == "") ? 0 : total;
                    /* Esta es la suma. 
                    total = (parseInt(total) + parseInt(valor));
                    // Colocar el resultado de la suma en el control "span".
                    document.getElementById('spTotal').innerHTML = total;
                    var t = document.getElementById('spTotal');
                    t.value = total;
                    console.log(t);*/

            }


        </script>

        <!--Script-->

        <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ asset('jquery-ui-1.12.1/jquery-ui.min.css') }}">
        <link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css" />
        <script src="https://unpkg.com/jquery@2.2.4/dist/jquery.js"></script>
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    @endsection
