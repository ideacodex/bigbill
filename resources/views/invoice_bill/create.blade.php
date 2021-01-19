@extends('layouts.Admin')
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
                                <option selected disabled>Companía</option>
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
                            <input id="grandTotal" type="number"
                                class="text-dark form-control @error('grandTotal') is-invalid @enderror" name="grandTotal"
                                value="{{ old('grandTotal') }}" required autocomplete="grandTotal" autofocus>

                            @error('grandTotal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            @error('grandTotal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!--Button-->
                        <button class="ml-4 mb-4 btn btn-success add_form_field" style="border-radius: 95px;">
                            Agregar productos <i class="fas fa-plus-circle"></i>
                        </button>
                        <!--Button-->

                        
                        <!--Aquí van agregandose los input-->
                        <div class="ml-5 container1">

                        </div>
                        <!--Aquí van agregandose los input-->

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

    </div>
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
                                             </div>
                                                 <input style="color: white" id="quantity[]" placeholder="Cantidad" type="text"
                                                     class="text-dark form-control @error('quantity') is-invalid @enderror" required quantity="quantity[]"
                                                     value="{{ old('quantity') }}" autocomplete="quantity" autofocus>
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
                                             </div>
                                                 <input style="color: white" id="unit_price[]" placeholder="P.U" type="text"
                                                     class="text-primary form-control @error('unit_price') is-invalid @enderror" required name="unit_price[]"
                                                     value="{{ old('unit_price') }}" autocomplete="unit_price" autofocus>
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
                                                 </div>
                                                     <input style="color: white" id="total[]" placeholder="Total" type="number"
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
                                         </div>`
                    ); //add input box
                } else {
                    alert('Límite de productos agregados completo.')
                }
            });

            $(wrapper).on("click", ".delete", function(e) {
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })
        });

    </script>
    <!--Script-->


    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('jquery-ui-1.12.1/jquery-ui.min.css') }}">
    <link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css" />
    <script src="https://unpkg.com/jquery@2.2.4/dist/jquery.js"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

@endsection
