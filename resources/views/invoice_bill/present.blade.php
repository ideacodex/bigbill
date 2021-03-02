<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>

</head>
<style>
    #contenedor {
        width: 50%;
        margin: 0 auto;
    }

</style>

<body style=" font: Arial" id="factura">

    <div class="row">



    <div id="contenedor">
        <table style="font-family:Helvetica; ">
            <!-- Nota -->
            <tr>
                <td colspan="5" style="background:white; text-align: right;">
                    <strong style="color : #030303;">Factura</strong>
                    <br>
                    <strong style="color : #0026a7;">Documento Electronico</strong>
                </td>
            </tr>
            <!-- Encabezado -->
            <tr>
                <td colspan="3">
                    <h1 style="color: #00096d;">Factura {{ $data->company->name }}  </h1>
                </td>
                <td colspan="2" style="
                    background: #ff7400;
                    text-align: center;
                    border-top: black 2px solid;
                    border-right: black 2px solid;
                    border-left: black 2px solid;
                    border-radius: 15px 15px 0px 0px ;
                    -moz-border-radius:  15px 15px 0px 0px ;
                    -webkit-border-radius:15px 15px 0px 0px ">
                    <strong style="color: white">DATOS DE LA FACTURA</strong>


                </td>
            </tr>
            <tr>
                <!-- Datos Empresa -->
                <td colspan="2" style="font-size:16px">
                    <strong style="color: #00096d;">Dirección:</strong>
                    <br>
                    <strong style="color: #00096d">Teléfono:</strong>
                    <br>
                    <strong style="color: #00096d">Nit: </strong>
                    <br>
                    <strong style="color: #00096d;">Fecha:</strong>
                </td>
                <td  style="font-size:16px">
                    <label> {{ $data->company->address }}<strong style="color:white;"> ------------ </strong> </label>
                    <br>
                    <label> {{ $data->company->phone }} </label>
                    <br>
                    <label>{{ $data->company->nit }}</label>
                    <br>
                    <label> <?php echo date('d/m/y'); ?></label>
                    <br>
                </td>
                <!-- Datos Factura -->
                <td  colspan="2" style="border-radius :3px;border-bottom:  black 2px solid; border-left: black 2px solid;border-right: black 2px solid;">
                    <strong style="color: #00096d;">FECHA DE EMISION:</strong> <strong>{{ $data->created_at }}</strong>
                    <br>
                    <strong style="color: #00096d">SERIE DE DOCUMENTO:</strong><strong>a</strong>
                    <br>
                    <strong style="color: #00096d">No. FACTURA: </strong><strong>20<?php echo date('y'); ?>-{{ $data->id }}</strong>
                    <br>
                    <strong style="color: #00096d">LUGAR DE EMISION: </strong><strong>{{ $data->company->address }}</strong>
                    <br>
                    <strong style="color: #00096d;">FECHA DE EXPIRACION:</strong><strong>{{ $data->expiration_date }}</strong>
                </td>
            </tr>
            <!-- Datos Cliente -->
            <tr>
                <td colspan="5">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <h3 style="color: white; background: #092863 ; text-align: Center"><b> Datos del Cliente: </b>
                        </h3>
                        <div style="font-family:Courier New;">

                            <Strong style="color: black">Nombre: </Strong>
                            @if ($data->customer)
                                <label style="color: black">{{ $data->customer->name }}
                                    {{ $data->customer->lastname }}</label>
                            @else
                                @if ($data->customer_name)
                                    <label style="color: black">{{ $data->customer_name }} </label>
                                @else
                                    <label style="color: black">Consumidor Final</label>
                                @endif
                            @endif
                            <br>
                            <Strong style="color: black">Nit: </Strong>
                            @if ($data->customer)
                                <label style="color: black">{{ $data->customer->nit }}</label>
                            @else

                                <label style="color: black">C/F</label>
                            @endif
                            <br>
                            <Strong style="color: black">Tel: </Strong>
                            @if ($data->customer)
                                <label style="color: black">{{ $data->customer->phone }}</label>
                            @else
                                <label style="color: black"> 00000000 </label>
                            @endif
                            <br>
                            <Strong style="color: black">Direccion: </Strong>
                            <label style="color: black"> Guatemala</label>
                            <br>
                            @if ($data->customer)
                                <Strong style="color: black">Correo: </Strong>
                                <label style="color: black">{{ $data->customer->email }}</label>
                            @else
                                @if ($data->customer_email)
                                    <Strong style="color: black">Correo: </Strong>
                                    <label style="color: black">{{ $data->customer_email }} </label>
                                @else
                                @endif
                            @endif

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
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"
                        style="background: #dddbd9; color: black; color: black">
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
            @foreach ($data->detail as $item)
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
            $a = $data->total;
            ?>
            <!-- Subtotal -->
            <tr>
                <td colspan="2">
                </td>
                <td colspan="2">
                    <div style=" border-radius:7px;background: #092863;color:white ;text-align: right">
                        <b>Subtotal</b> <strong style="color:#031c49">----</strong>
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
                {{-- aqui esta el total de la factura que se utilizara para pasar en letras --}}
                <td colspan="1" style="border-bottom:  #092863  double;">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"
                        style="background: #ffffff; color: black; text-align: right">
                        <input type="text" style="border: none;background:none;text-align:right" id="total"
                            value="{{ $data->total }}">
                    </div>
                </td>
            </tr>
           <!-- Total letras -->
           <tr>
            <td colspan="2">
                <div style="border-radius:7px; background: #092863; color:white; text-align: right">
                    <strong style="color:#092863">----</strong> <b>Total en letras</b> <strong
                        style="color:#092863">----</strong>
                </div>
            </td>
            {{-- Aqui aparecera como la cantidad en letras --}}
            <td colspan="3" style="border-bottom:  #092863  double;">
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"
                    style="background: #ffffff; color: black; text-align: right">
                    <label> {{ $data->totalletras }}</label>
                    {{-- <p id="salida">Aquí aparecerá la cantidad como letras</p> --}}
                </div>
            </td>
        </tr>
            <!-- Te atendio -->
            <tr>
                <td colspan="5">
                    <br>
                    <br>
                    <br>
                    <br>

                    <div style="background: #092863;border: 1px solid #000;padding: 12px;text-align: center;">

                        <strong style="color: white"> <b>Atendido por: </b>{{ $data->user->name }}
                            {{ $data->user->lastname }} | {{ $data->company->name }} ® | Copyright©</strong>

                    </div>

                </td>
            </tr>
        </table>
    </div>
</div>


</body>

</html>
