<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>

</head>

<body style=" font: Arial;">
    <div name="factura">
        <div class="row">
            <div class="col-md-2 col-sm-3 col-xs-2 clearfix"
                style="background: #2b204b;border: 1px solid #000;padding: 10px;">
                <table>
                    <tr>
                        <td>
                            <strong style="color: #ed8405; font: Italic; ">Nombre de la Empresa</strong>
                        </td>
                        <td>
                            <strong style="color: #2b204b; ">---------------------------------</strong>
                        </td>
                        <td>
                            <h1 style="color: #ed8405; font: Italic;text ;text-align: right">FACTURA</h1>
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
                            <td rowspan="2">
                                <Strong style="color: #ffffff">Direccion:
                                    <!-- direccion-->
                                </Strong>
                            </td>
                            <td style="color: #ffffff">
                                No. Factura
                                <!-- factura-->
                            </td>
                        </tr>
                        <tr>
                            <td style="color: #ffffff">
                                xxxx-0000
                                <!-- factura-->
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <Strong style="color: #ffffff">Telefono:</Strong>
                            </td>
                            <td style="color: #ffffff">
                                Fecha
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <Strong style="color: #ffffff">Nit: </Strong>
                            </td>
                            <td style="color: #ffffff">
                                <input type="text" value="<?php echo date('d/m/y'); ?>"
                                    style="border: none; background: none">
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
        <br>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ed8405"> Factura para: </div>
        <Strong>----------------------------------------------------------------------------------------------------------------------------------</Strong>
        <br>
        <Strong>Nombre Cliente: </Strong>
        <br>
        <Strong>Nit: </Strong> <Strong>Tel: </Strong>
        <br>
        <Strong>Direccion: </Strong>
        <div class="row">
            <table>
                <tr>
                    <th>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ed8405"> No. </div>
                    </th>
                    <th>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ed8405"> Cant </div>
                    </th>
                    <th>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ed8405"> Description</div>
                    </th>
                    <th>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ed8405"> Precio Unit</div>
                    </th>
                    <th>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ed8405"> Sub-Total</div>
                    </th>
                </tr>
                <tr>
                    <th>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #d0d4d4"> No. </div>
                    </th>
                    <th>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #d0d4d4"> Cant </div>
                    </th>
                    <th>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #d0d4d4"> Description</div>
                    </th>
                    <th>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #d0d4d4"> Precio Unit</div>
                    </th>
                    <th>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #d0d4d4"> Sub-Total</div>
                    </th>
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
                            Total</div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
   
</body>

</html>
