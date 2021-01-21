@extends('layouts.Admin')
@section('content')

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

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
                                name="iva" value="{{ old('iva') }}" required autocomplete="iva" autofocus>

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

                        {{--Subtotal--}}
                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                    <label>Subtotal</label>
                                </span>
                            </div>
                            <input id="subtotal" type="number"
                                class="text-dark form-control @error('subtotal') is-invalid @enderror" name="subtotal"
                                value="{{ old('subtotal') }}" required autocomplete="subtotal" autofocus>

                            @error('subtotal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            @error('subtotal')
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
                                name="spTotal" autofocus>

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

                        <!--Desde aquí empieza a agregar en la tabla Detalle Factura-->
                        <!--Button-->
                        <button class="btn btn-success add_form_field" style="border-radius: 95px;">
                            Agregar producto <i class="fas fa-plus-circle"></i>
                        </button>
                        <!--Button-->

                        <!--Aquí van agregandose los input-->
                        <div class="container1"></div>
                        <!--Aquí van agregandose los input-->
                        <!--Desde aquí empieza a agregar en la tabla Detalle Factura-->

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

    <!--Script-->
    <script>
        $(document).ready(function() {
        var max_fields = 10;
        var wrapper = $(".container1");
        var add_button = $(".add_form_field");
        var x = 1;
            $(add_button).click(function(e) {
            e.preventDefault();
            if (x < max_fields) {
            x++;
            $(wrapper).append(
                        /**Detalle_factura*/
                        `<div class="col-xs-12">
                                <div class="col-md-12 well text-center" style="background: transparent; border:none;">
                                    <div class="form-row">
                                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                            <div class="input-group-prepend">
                                                </div>
                                                <select name="product_id[]" id="product_id[]"
                                                    class="form-control @error('product_id') is-invalid @enderror" required>   
                                                    <option selected disabled>Producto</option>
                                                    @foreach ($product as $item) 
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach                                 
                                                </select>
                                                    @error('product_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                    @enderror                                                                             
                                                    @error('product_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                    @enderror
                                            </div>
                                                                                                        
                                            <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                        <label>Cantidad</label>
                                                    </span>
                                                </div>
                                                    <input style="color: white" id="quantity[]" name="quantity[]" placeholder="Cantidad" type="text"
                                                    class="text-dark form-control @error('quantity') is-invalid @enderror" required quantity="quantity[]"
                                                    value="{{ old('quantity') }}" autocomplete="quantity" onchange="sumar(this.value);" autofocus> 
                                                        @error('quantity')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                        @enderror
                                                        @error('quantity')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                        @enderror
                                            </div>

                                            <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                        <label>P.U</label>
                                                    </span>
                                                </div>
                                                    <input style="color: white" id="unit_price[]" placeholder="P.U" type="text"
                                                    class="text-primary form-control @error('unit_price') is-invalid @enderror" required name="unit_price[]"
                                                    value="{{ old('unit_price') }}" onchange="sumar(this.value);" autocomplete="unit_price" autofocus>
                                                        @error('unit_price')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                        @enderror
                                                        @error('unit_price')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                        @enderror
                                            </div>

                                            <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                        <label>Total</label>
                                                    </span>
                                                </div>
                                                    <input style="color: white" id="total[]" placeholder="Total" type="text"
                                                    class="text-primary form-control @error('total') is-invalid @enderror" required name="total[]"
                                                    value="{{ old('total') }}" autocomplete="total" autofocus>
                                                        @error('total')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                        @enderror
                                                        @error('total')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                        @enderror
                                                     </div>
                                            </div>

                                            </div>
                                                 <button class="ml-4 btn btn-danger mb-3 delete">
                                                    Eliminar <i class="fas fa-times-circle"></i>
                                                </button>
                                            </div>
                                            `); //add input box
                } else {
                    alert('Limite de productos agregados')
                }
            });

            $(wrapper).on("click", ".delete", function(e) {
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })
        });

        //Resultado dinámico en los inputs
        function sumar(valor) {
            var total = 0;
            valor = parseInt(valor); // Convertir el valor a un entero (número).
            total = document.getElementById('spTotal').innerHTML;
            // Aquí valido si hay un valor previo, si no hay datos, le pongo un cero "0".
            total = (total == null || total == undefined || total == "") ? 0 : total;
            /* Esta es la suma. */
            total = (parseInt(total) + parseInt(valor));
            // Colocar el resultado de la suma en el control "span".
            document.getElementById('spTotal').innerHTML = total;
            //Se agregan los valores al input del total.
            var t = document.getElementById('spTotal');
            t.value = total;
            console.log(t);
        }
    });
  
    </script>
    <!--Script-->

    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('jquery-ui-1.12.1/jquery-ui.min.css') }}">
    <link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css" />
    <script src="https://unpkg.com/jquery@2.2.4/dist/jquery.js"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
@endsection
