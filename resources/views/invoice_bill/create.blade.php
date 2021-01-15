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

    <div class="row">
        <div class="col-xs-7">
            <input id="name" name="name" class="form-control" type="text" placeholder="Producto" />
        </div>
        <div class="col-xs-2">
            <input id="quantity" name="quantity" class="form-control" type="text" placeholder="Cantidad" />
        </div>
        <div class="col-xs-2">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">Q.</span>
                <input id="price" name="price" class="form-control" type="text" placeholder="Precio" />
            </div>
        </div>
        <div class="col-xs-1">
            <button class="btn btn-primary form-control" id="btn-agregar">
                <i class="glyphicon glyphicon-plus"></i>
            </button>
        </div>
    </div>

    <hr />

    <table class="table table-striped">
        <thead>
            <tr>
                <th style="width: 40px;"></th>
                <th>Producto</th>
                <th style="width: 100px;">Cantidad</th>
                <th style="width: 100px;">P.U</th>
                <th style="width: 100px;">Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <button class="btn btn-danger btn-xs btn-block">X</button>
                </td>
                <td>Producto A</td>
                <td class="text-right">10</td>
                <td class="text-right">Q.120.00</td>
                <td class="text-right">Q.1200.00</td>
            </tr>
            <tr>
                <td>
                    <button class="btn btn-danger btn-xs btn-block">X</button>
                </td>
                <td>Producto A</td>
                <td class="text-right">10</td>
                <td class="text-right">Q.120.00</td>
                <td class="text-right">Q.1200.00</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-right"><b>IVA</b></td>
                <td class="text-right"><b>Q.1200.00</b></td>
            </tr>
            <tr>
                <td colspan="4" class="text-right"><b>Sub Total</b></td>
                <td class="text-right"><b>Q.1200.00</b></td>
            </tr>
            <tr>
                <td colspan="4" class="text-right"><b>Total</b></td>
                <td class="text-right"><b>Q.1200.00</b></td>
            </tr>
        </tfoot>
    </table>












    
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


@endsection
@section('bottom')
    <script src="{{ asset('components/invoice.tag') }}" type="riot/tag"></script>
    <script>
        $(document).ready(function() {
            alert(1)
            riot.mount('invoice');
        })

    </script>
@endsection
