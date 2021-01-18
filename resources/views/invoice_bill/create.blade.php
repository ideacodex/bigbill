@extends('layouts.Admin')
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
        <div class="alert alert-danger">
            {{ session('datosEliminados') }}
        </div>
    @endif
    <!--Mensaje flash-->
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('jquery-ui-1.12.1/jquery-ui.min.css') }}">
    <script src="https://unpkg.com/jquery@2.2.4/dist/jquery.js"></script>

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <!--Cliente-->
                <div class="well well-sm">
                    <div class="row">
                        <div class="col-xs-6">
                            <input id="name" name="name" class="form-control" type="text" placeholder="Cliente" />
                        </div>
                        <div class="col-xs-2">
                            <input id="nit" name="nit" class="form-control" type="text" placeholder="Nit" />
                        </div>
                        <div class="col-xs-4">
                            <input id="address" name="address" class="form-control" type="text" placeholder="Dirección" />
                        </div>
                    </div>
                </div>

                <!--Productos-->
                <div class="row">
                    <!--Product-->
                    <div class="col-xs-6">
                        <select name="id_product" id="id_product"
                            class="form-control @error('id_product') is-invalid @enderror" required>
                            <option selected disabled>Producto</option>
                            @foreach ($product as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('id_product')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        @error('id_product')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--Cantidad-->
                    <div class="col-xs-2">
                        <input id="quantity" name="quantity" class="form-control" type="text" placeholder="Cantidad" />
                    </div>
                    <!--Precio-->
                    <div class="col-xs-2">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Q.</span>
                            <input id="price" name="price" class="form-control" type="text" placeholder="Precio" />
                        </div>
                    </div>
                    <div class="col-xs-1">
                        <button class="btn btn-primary form-control" id="btn-agregar">
                            <i class="far fa-plus-square"></i>
                        </button>
                    </div>
                </div>

                <hr />

                <!--Tabla-->
                <div class="row">
                    <div class="table-responsive">
                        <form method="POST" id="dynamic_form">
                            @csrf
                            <span id="result"></span>
                            <table class="table table-bordered table-striped" id="user_table">
                                <thead>
                                    <tr>
                                        <th width="35%">Producto</th>
                                        <th width="35%">Cantidad</th>
                                        <th width="35%">P.U</th>
                                        <th width="35%">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
                <hr />
            </div>
        </div>
    </div>

    <div class="container1">
        <div class="col-12">
            <div class="col text-center">
                <button type="submit" style="border-radius: 10px" class="btn btn-lg btn-primary mt-3">
                    <i class="far fa-save"></i>
                    {{ __('Guardar') }}
                </button>
            </div>
        </div>
    </div>

    <!--Input dinámico-->
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
                        '<div><input type="text" name="mytext[]"/><a href="#" class="delete">Delete</a></div>'
                    ); //add input box
                } else {
                    alert('You Reached the limits')
                }
            });

            $(wrapper).on("click", ".delete", function(e) {
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })
        });

    </script>
    <!--Input dinámico-->

    <!--Autocompletar el nombre de los clientes-->
    <script>
        var self = this;
        self.on('mount', function() {
            //Levantar los plugins de JQuery
            _clientAutocomplete();
        })

        function _clientAutocomplete() {
            var options = {
                url: function(phrase) {
                    return baseUrl('Invoice/findClient?q' + q)
                    "api/countrySearch.php?phrase=" + phrase + "&format=json";
                },
                getValue: function(e) {
                    self.nit = e.nit;
                    self.update();
                    return e.name;
                },
                list: {
                    onClickEvent: function() {
                        alert("Click !");
                    }
                }
            };
            $("#name").easyAutocomplete(options);
        }

    </script>
    <!--Autocompletar el nombre de los clientes-->

    <!--Tabla dinamica para inserción de campos
            <script>
                $(document).ready(function() {
                    var count = 1;
                    dynamic_field(count);

                    function dynamic_field(number) {
                        var html = '<tr>';
                        html += '<td><input type = "text" name="product_id[]" required class="form-control"/></td>';
                        html += '<td><input type = "text" name="quantity[]" required class="form-control"/></td>';
                        html += '<td><input type = "text" name="unit_price[]" required class="form-control"/></td>';
                        html += '<td><input type = "text" name="total[]" required class="form-control"/></td>';
                        if (number > 1) {
                            html +=
                                '<td><button type="button" name="remove" id="remove" class="btn btn-danger">Eliminar</button></td>';
                            $('tbody').append(html);
                        } else {
                            html +=
                                '<td><button type="button" name="add" id="add" class="btn btn-success">Agregar</button></td></td></tr>';
                            $('tbody').html(html);
                        }
                    }
                    $('#add').click(function() {
                        count++;
                        dynamic_field(count);
                    });
                    $(document).on('click', '#remove', function() {
                        count--;
                        dynamic_field(count);
                    });
                    $('#dynamic_form').on('submit', function() {
                        event.preventDefault();
                        $.ajax({
                            url: '{{ route('facturas.store') }}',
                            method: 'post',
                            data: $(this).serialize(),  
                            dataType: 'json',
                            beforeSend: function() {
                                $('#save').attr('disabled', 'disabled');
                            },
                            success: function(data) {
                                if (data.error) {
                                    var error_html = '';
                                    for (var count = 0; count < data.error.length; count++) {
                                        error_html += '<p>' + data.error[count] + '</p>';
                                    }
                                    $('#result').html('<div class="alert alert-danger">' + error_html +
                                        '</div>')
                                } else {
                                    dynamic_field(1);
                                    $('#result').html('<div class="alert alert-success">' + data
                                        .success + '</div>');
                                }
                                $('#save').attr('disabled', false);
                            }
                        })
                    });
                });

            </script>
            Tabla dinamica para inserción de campos-->

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
                        `
                            <div class="col-xs-12">
                                <div class="col-md-12 well text-center" style="background: transparent; border:none;">
                                    <div class="form-row">
                                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                    <i class="text-light fas fa-question-circle"></i>
                                                </span>
                                            </div>
                                            <select name="relation_type[]" id="relation_type[]"
                                                class="form-control @error('relation_type') is-invalid @enderror" required>
                                                <option disabled selected>Parentesco</option>
                                                <option value="1">Padre</option>
                                                <option value="2">Madre</option>
                                                <option value="3">Hijo</option>
                                                <option value="3">Hija</option>
                                                <option value="4">Esposa</option>
                                                <option value="5">Esposo</option>
                                                <option value="6">Hermana</option>
                                                <option value="3">Hermano</option>
                                        
                                            </select>
                                            @error('relation_type')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                            @enderror
                                                    
                                            @error('relation_type')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                    <i class="text-light fas fa-file-signature"></i>
                                                </span>
                                            </div>
                                            <input style="color: white" id="name[]" placeholder="Nombre y Apellido" type="text"
                                                class="text-primary form-control @error('name') is-invalid @enderror" required name="name[]"
                                                @if (isset($family->name)) value="{{ $family->name }}" 
                                            @else
                                                    value="{{ old('name') }}" @endif  
                                                autocomplete="name" autofocus>

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

                                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                    <i class="text-light fas fa-clock"></i>
                                                </span>
                                            </div>
                                            <input style="color: white" id="age[]" placeholder="Edad" type="number"
                                                class="text-primary form-control @error('age') is-invalid @enderror" required name="age[]"
                                                @if (isset($family->age)) value="{{ $family->age }}"
                                            @else
                                                    value="{{ old('age') }}" @endif   
                                                autocomplete="age" autofocus>

                                            @error('age')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                            @enderror

                                            @error('age')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-danger mb-3 delete">
                                    Eliminar <i class="fas fa-times-circle"></i>
                                </button>
                            </div>
                                
                        `); //add input box
                } else {
                    alert('Limite de familiares agregados completado!!!')
                }
            });

            $(wrapper).on("click", ".delete", function(e) {
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })
        });

    </script>

    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css" />
@endsection
