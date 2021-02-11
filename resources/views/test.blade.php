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
        <table style="font-family:Helvetica; ">
            <!-- Nota -->
            <tr>
                <td colspan="5" style="background:white; text-align: right;">
                    <strong style="color : #6a6a6a;">Factura</strong><strong style="color : #ffffff;">-----------------------</strong>
                    <br>
                    <strong style="color : #0026a7;">Documento Electronico</strong>

                </td>
            </tr>
            <!-- Encabezado -->
            <tr>
                <!-- Datos Empresa -->
                <td colspan="2">
                    <div>
                        <div style="background: white;padding: 10px;">
                            <table>
                                <tr>
                                    <td>
                                        <h2 style="color: #00096d; font: Arial; ">Factura <br> {{ $records->company->name }}</h2>

                                        <strong style="color: #00096d">Dirección: {{ $records->company->address }}</strong>
                                        <br>
                                        <strong style="color: #00096d">Teléfono: {{ $records->company->phone }}</strong>
                                        <br>
                                        <strong style="color: #00096d">Nit: {{ $records->company->nit }}</strong>
                                        <br>
                                        <strong style="color: #00096d">Fecha: <?php echo date('d/m/y'); ?></strong>
                                        <br>

                                    </td>
                                    <td>
                                        <strong style="color: #ffffff; ">----------------------------------------------</strong>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </td>
                <!-- Datos Factura -->
                <td colspan="3">
                    <div>
                        <table style="font-size:20px">
                            <tr style="background: #ff7400;padding: 12px;text-align: center;">
                                <td colspan="3" style=" border-radius :7px; border-top: black 2px solid;border-right: black 2px solid;border-left: black 2px solid;">
                                    <strong style="color: white">DATOS DE LA FACTURA</strong>
                                </td>
                            </tr>
                            <tr>
                                <td style="  border-radius :3px;border-bottom:  black 2px solid; border-left: black 2px solid;">
                                    <strong style="color: #00096d;">FECHA DE EMISION:</strong>
                                    <br>
                                    <strong style="color: #00096d">SERIE DE DOCUMENTO:</strong>
                                    <br>
                                    <strong style="color: #00096d">No. FACTURA: </strong>
                                    <br>
                                    <strong style="color: #00096d">LUGAR DE EMISION: </strong>
                                    <br>
                                </td>
                                <td style=" border-bottom:  black 2px solid;">
                                    <label>{{ $records->created_at }}</label>
                                    <br>
                                    <label>aaaaa</label>
                                    <br>
                                    <label>20<?php echo date('y'); ?>-
                                        {{ $records->id }}</label>
                                    <br>
                                    <label>{{ $records->company->address }}</label>
                                    <br>
                                </td>
                                <td style=" border-radius :3px; border-bottom:  black 2px solid; border-right: black 2px solid;">
                                    <strong style="color: white; ">---------------------------------</strong>
                                </td>
                            </tr>

                        </table>

                    </div>
                </td>
            </tr>
            <!-- Datos Cliente -->
            <tr>
                <td colspan="5">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <h3 style="color: white; background: #092863 ; text-align: Center"><b> Datos del Cliente: </b></h3>
                        <div style="font-family:Courier New;">

                            <Strong style="color: black">Nombre: </Strong>
                            @if ($records->customer)
                            <label style="color: black">{{ $records->customer->name }} {{ $records->customer->lastname }}</label>
                            @else
                            <label style="color: black">Consumidor Final</label>
                            @endif
                            <br>
                            <Strong style="color: black">Nit: </Strong>
                            @if ($records->customer)
                            <label style="color: black">{{ $records->customer->nit }}</label>
                            @else

                            <label style="color: black">C/F</label>

                            @endif
                            <br>
                            <Strong style="color: black">Tel: </Strong>
                            @if ($records->customer)
                            <label style="color: black">{{ $records->customer->phone }}</label>
                            @else
                            <label style="color: black"> 00000000 </label>
                            @endif
                            <br>
                            <Strong style="color: black">Direccion: </Strong>
                            <label style="color: black"> Guatemala</label>
                        </div>
                    </div>

                </td>
            </tr>
            <!-- Nota: detalle -->
            <tr>
                <td colspan="5">
                    <br>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #d1cfcbd0">
                        <h3 style="color: black"><b> Detalle: </b></h3>
                    </div>
                </td>
            </tr>
            <!-- Encabezado Detalle -->
            <tr>
                <td>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black">
                        No.
                    </div>
                </td>
                <td>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black; color: black">
                        Cantidad
                    </div>
                </td>
                <td>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black">
                        Descripción
                    </div>
                </td>
                <td>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black">
                        P/U
                    </div>
                </td>
                <td>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black">
                        Subtotal
                    </div>
                </td>
            </tr>
            <!-- Detalle -->
            @foreach ($records->detail as $item)
            <tr>
                <td>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">
                        {{ $loop->index + 1 }}
                    </div>
                </td>
                <td>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">
                        {{ $item->quantity }}
                    </div>
                </td>
                <td>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">
                        {{ $item->product->name }}
                    </div>
                </td>
                <td>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">
                        {{ $item->unit_price }}
                    </div>
                </td>
                <td>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">
                        {{ $item->subtotal }}
                    </div>
                </td>
            </tr>
            @endforeach
            <!-- Operaciones -->
            <?php
            $a = $records->total;
            $b = 0.12;
            $c = ($a * $b);
            $d = $a - $c;
            ?>
            <!-- Subtotal -->
            <tr>
                <td colspan="2">
                </td>
                <td colspan="2">
                    <div style=" border-radius:7px;background: #092863;color:white ;text-align: right">
                        <b>Subtotal</b> <strong style="color:#092863">----</strong>
                    </div>
                </td>
                <td colspan="1">
                    <div style="background: #ffffff; text-align: right">
                        <label><?php echo $d ?></label>
                    </div>
                </td>
            </tr>
            <!-- Iva -->
            <tr>
                <td colspan="2">
                </td>
                <td colspan="2">
                    <div style="border-radius:7px; background: #092863;color:white ;text-align: right">
                        <b>IVA</b> <strong style="color:#092863">----</strong>
                    </div>
                </td>
                <td colspan="1" style="border-bottom:  #092863 1px solid;">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; text-align: right">

                        <label><?php echo $c ?></label>
                    </div>
                </td>
            </tr>

            <!-- Total -->
            <tr>
                <td colspan="2">
                </td>
                <td colspan="2">
                    <div style="border-radius:7px; background: #092863; color:white; text-align: right">
                        <b>Total</b> <strong style="color:#092863">----</strong>
                    </div>
                </td>
                <td colspan="1" style="border-bottom:  #092863  double;">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black; text-align: right">
                        {{ $records->total }}
                    </div>
                </td>
            </tr>
        </table>

    </div>
    <br>
    <br>
    <br>
    <br>

    <div style="background: #092863;border: 1px solid #000;padding: 12px;text-align: center;">
        <label style="background: white; color:#092863"><b>Atendido por:</b></label>
        <strong style="color: white"> {{ $records->user->name }} {{ $records->user->lastname }}</strong>

    </div>


</body>

</html>