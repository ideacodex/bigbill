<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>

</head>

<body style=" font: Georgia">
    <div name="factura">
        <div class="row">
            <div class="col-md-2 col-sm-3 col-xs-2 clearfix"
                style="background: #2b204b;border: 1px solid #000;padding: 10px;">
                <table>
                    <tr>
                        <td>
                            <h3 style="color: #ed8405; font: Italic; ">Factura</h3>
                        </td>
                        <td>
                            <strong style="color: #2b204b; ">---------------------------------</strong>
                        </td>
                        <td>
                            <h1 style="color: #ed8405; font: Italic;text ;text-align: right">
                                {{ $records->company->name }}
                            </h1>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div>
            <div class="row">
                <div class="col-md-2 col-sm-3 col-xs-2 clearfix"
                    style="background: #2b204b;border: 1px solid #000;padding: 10px;">
                    <table>
                        <tr>
                            <td rowspan="2" style="color: #ffffff">
                                <Strong style="color: #ffffff">Direccion:</Strong>
                                <!-- direccion--> {{ $records->company->address }} .
                            </td>
                            <td>
                                <Strong style="color: #ffffff"> No. Factura </Strong>

                            </td>
                        </tr>
                        <tr>
                            <td style="color: #ffffff">
                                20<?php echo date('y'); ?>- {{ $records->id }}
                                <!-- factura-->
                            </td>
                        </tr>
                        <tr style="color: #ffffff">
                            <td>
                                <Strong style="color: #ffffff">Telefono: </Strong>
                                {{ $records->company->phone }}
                            </td>
                            <td>
                                <Strong style="color: #ffffff">
                                    Fecha
                                </Strong>
                            </td>
                        </tr>
                        <tr style="color: #ffffff">
                            <td>
                                <Strong style="color: #ffffff">Nit:</Strong>
                                {{ $records->company->nit }}
                            </td>
                            <td style="color: #ffffff">
                                <label> <?php echo date('d/m/y'); ?></label>
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
        <br><br>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ed8405">
            <h2><b> Factura para: </b></h2>
        </div>

        <Strong>Nombre Cliente: </Strong>
        @if ($records->customer)
            {{ $records->customer->name }} {{ $records->customer->lastname }}
        @else

            C/F

        @endif
        <br>
        <Strong>Nit: </Strong>
        @if ($records->customer)
            {{ $records->customer->nit }}
        @else

            xxxx

        @endif
        <Strong>Tel: </Strong>
        @if ($records->customer)
            {{ $records->customer->phone }}
        @else

            00000000

        @endif
        <br>
        <Strong>Direccion: </Strong>
        Guatemala
        <br><br>
        <div class="row">
            <table>
                <tr>
                    <th>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ed8405">
                            <h3><b> No. </b></h3>
                        </div>
                    </th>
                    <th>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ed8405">
                            <h3><b> Cantidad </b></h3>
                        </div>
                    </th>
                    <th>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ed8405">
                            <h3><b> Producto </b></h3>
                        </div>
                    </th>
                    <th>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ed8405">
                            <h3><b> Descripción </b></h3>
                        </div>
                    </th>
                    <th>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ed8405">
                            <h3><b> P/U </b></h3>
                        </div>
                    </th>
                    <th>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ed8405">
                            <h3><b> Subtotal </b></h3>
                        </div>
                    </th>
                </tr>
                @foreach ($records->detail as $item)
                    <tr>
                        <th>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #d0d4d4">
                                {{ $loop->index + 1 }}
                            </div>
                        </th>
                        <th>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #d0d4d4">
                                {{ $item->quantity }}
                            </div>
                        </th>
                        <th>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #d0d4d4">
                                {{ $item->product->name }}</td>
                        </th>
                        <th>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #d0d4d4">
                                {{ $item->description }}</td>
                        </th>
                        <th>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #d0d4d4">
                                {{ $item->unit_price }}</td>
                        </th>
                        <th>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #d0d4d4">
                                {{ $item->subtotal }}</td>
                        </th>
                    </tr>
                @endforeach

                <tr>
                    <td colspan="4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"
                            style="background: #2b204b;color:white ;text-align: right">
                            IVA </div>
                    </td>
                    <td>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"
                            style="background: #ffffff; text-align: right">

                            {{ $records->iva }}
                        </div>
                    </td>
                </tr>

                <tr>
                    <td colspan="4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"
                            style="background: #e3ae6f; text-align: right">
                            Total</div>
                    </td>
                    <td>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"
                            style="background: #ffffff; text-align: right">
                            {{ $records->total }}
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <br>
    <br><br>
    <br>

    <label style="background: #2b204b ; color:white">Lo Atendio:</label>
    {{ $records->user->name }} {{ $records->user->lastname }}
</body>
</html>
