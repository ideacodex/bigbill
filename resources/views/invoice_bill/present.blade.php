<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>

</head>

<body style=" font: Arial">
    <div name="factura">
        <div class="row">
            <div class="col-md-2 col-sm-3 col-xs-2 clearfix"
                style="background: #092863;border: 1px solid #000;padding: 10px;">
                <table>
                    <tr>
                        <td>
                            <h2 style="color: rgb(91, 155, 238); font: Arial; ">Factura</h2>
                            <h2 style="color: rgb(91, 155, 238);">{{ $data->company->name }}</h2>
                        </td>
                        <td>
                            <strong style="color: #092863; ">---------------------------------</strong>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div>
            <div class="row">
                <div class="col-md-2 col-sm-3 col-xs-2 clearfix"
                    style="background: #092863; border:1px solid #000; padding:10px;">
                    <strong style="color: #ffffff">No. Factura: 20<?php echo date('y'); ?>-
                        {{ $data->id }}</strong>
                    <br>
                    <strong style="color: #ffffff">Dirección:  {{ $data->company->address }}</strong>
                    <br>
                    <strong style="color: #ffffff">Teléfono:  {{ $data->company->phone }}</strong>
                    <br>
                    <strong style="color: #ffffff">Nit:  {{ $data->company->nit }}</strong>
                    <br>
                    <strong style="color: #ffffff">Fecha:  <?php echo date('d/m/y'); ?></strong>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #d1cfcbd0">
            <h3><b> Datos del Cliente: </b></h3>
        </div>

            <Strong>Nombre: </Strong>
            @if ($data->customer)
                {{ $data->customer->name }} {{ $data->customer->lastname }}
            @else

            C/F

        @endif
        <br>
        <Strong>Nit: </Strong>
        @if ($data->customer)
            {{ $data->customer->nit }}
        @else

            xxxx

        @endif
        <br>
        <Strong>Tel: </Strong>
        @if ($data->customer)
            {{ $data->customer->phone }}
        @else

            00000000

        @endif
        <br>
        <Strong>Direccion: </Strong>
        Guatemala
        <br>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #d1cfcbd0">
            <h3><b> Detalle: </b></h3>
        </div>

        <div class="row">
            <table>
                <tr>
                    <th>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black"> No.
                        </div>
                    </th>
                    <th>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"
                            style="background: #dddbd9; color: black; color: black"> Cantidad </div>
                    </th>
                    <th>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black">
                            Descripción</div>
                    </th>
                    <th>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black"> P/U
                        </div>
                    </th>
                    <th>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black">
                            Subtotal</div>
                    </th>
                </tr>
                @foreach ($data->detail as $item)
                    <tr>
                        <th>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">
                                {{ $loop->index + 1 }}
                            </div>
                        </th>
                        <th>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff, color: black">
                                {{ $item->quantity }}
                            </div>
                        </th>
                        <th>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">
                                {{ $item->product->name }}
                        </th>
                        <th>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">
                                {{ $item->unit_price }}
                        </th>
                        <th>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">
                                {{ $item->subtotal }}
                        </th>
                    </tr>
                @endforeach

                <tr>
                    <td colspan="4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"
                            style="background: #69a9f1;color:black ;text-align: right">
                            <b>IVA</b> </div>
                    </td>
                    <td>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"
                            style="background: #ffffff; text-align: right">

                            {{ $data->iva }}
                        </div>
                    </td>
                </tr>

                <tr>
                    <td colspan="4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"
                            style="background: #69a9f1; text-align: right">
                            <b>Total</b></div>
                    </td>
                    <td>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"
                            style="background: #ffffff; text-align: right">
                            {{ $data->total }}
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <br>
    <br><br>
    <br>

    <label style="background: #69a9f1 ; color:black"><b>Atendido por:</b></label>
    {{ $data->user->name }} {{ $data->user->lastname }}
</body>
</html>
