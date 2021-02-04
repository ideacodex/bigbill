<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>

</head>

<body style=" font: Georgia">
    <div name="Customerpdf">
        <div class="row">
            <div class="col-md-2 col-sm-3 col-xs-2 clearfix"
                style="background: #2b204b;border: 1px solid #000;padding: 10px;">
                <table>
                    <tr style="text-align: right">
                        <td style="text-align: right">
                            <strong style="color: #ed8405; font: Italic;  ">Informe de</strong>
                            <strong style="color: #2b204b; ">--------------</strong>
                            <h1 style="color: #ed8405; font: Italic;text ;text-align: right">FACTURAS</h1>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div>
            <div class="row">
                <div class="col-md-2 col-sm-3 col-xs-2 clearfix"
                    style="background: #2b204b;border: 1px solid #000;padding: 10px;">
                    <input type="text" value="<?php echo date('d/m/y'); ?>"
                        style="border: none; background: none; float: right;color: #ffffff">
                    <table>
                        <tr>
                            <td rowspan="2">
                                <Strong style="color: #ffffff">Nombre:
                                    <!-- nombre-->
                                </Strong>
                            </td>
                            <td style="color: #ffffff">
                                {{ Auth::user()->name }}
                                <!-- name-->
                            </td>
                        </tr>
                        <tr>
                            <td style="color: #ffffff">
                                {{ Auth::user()->lastname }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <Strong style="color: #ffffff">Nit:</Strong>
                            </td>
                            <td style="color: #ffffff">
                                {{ Auth::user()->nit }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <Strong style="color: #ffffff">correo: </Strong>
                            </td>
                            <td style="color: #ffffff">
                                {{ Auth::user()->email }}
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>

    </div>
    <table>
        <tr>
            <td>
                <table class="table table-dark">
                    <thead style="background: #2b204b ; color:white">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Responsable</th>
                            <th scope="col">compania</th>
                            <th scope="col">iva </th>
                            <th scope="col">Total </th>
                        </tr>

                    </thead>
                    <tbody style=" color:#2b204b ; border: #2b204b 1px solid">
                        @foreach ($InvoiceBill as $item)
                            <tr>

                                <th scope="row">{{ $item->id }}</th>
                                <td>{{ $item->user->name }} <br> {{ $item->user->lastname }}</td>
                                <td>{{ $item->company->name }}</td>
                                <td>{{ $item->iva }}</td>
                                <td>{{ $item->total }}</td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </td>
            <td>
                <table class="table table-dark">
                    <thead style="background: #2b204b ; color:white">
                        <tr>
                            <th scope="col">Factura</th>
                            <th scope="col">producto</th>
                            <th scope="col">cat</th>
                            <th scope="col">Unitario</th>
                            <th scope="col">SubTotal</th>
                        </tr>
                    </thead>
                    <tbody style=" color:#2b204b ; border: #2b204b 1px solid">
                        @foreach ($DetailBill as $items)
                            <tr>
                                <th scope="row">{{ $items->invoice_id }}</th>
                                <td>{{ $items->product->name }}</td>
                                <td>{{ $items->quantity }}</td>
                                <td>{{ $items->unit_price }}</td>
                                <td>{{ $items->subtotal }}</td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>

            </td>
        </tr>
    </table>

</body>

</html>
