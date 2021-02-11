


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
    <div id="contenedor">
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
                                        <h2 style="color: #00096d; font: Arial; ">Factura <br> {{ $data->company->name }}</h2>

                                        <strong style="color: #00096d">Dirección: {{ $data->company->address }}</strong>
                                        <br>
                                        <strong style="color: #00096d">Teléfono: {{ $data->company->phone }}</strong>
                                        <br>
                                        <strong style="color: #00096d">Nit: {{ $data->company->nit }}</strong>
                                        <br>
                                        <strong style="color: #00096d">Fecha: <?php echo date('d/m/y'); ?></strong>
                                        <br>

                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </td>
                <!-- Datos Factura -->
                <td colspan="3">
                    <div>
                        <table style="font-size:15px">
                            <tr>
                                <td colspan="3" 
                                style="
                                background: #ff7400;padding: 12px;
                                text-align: center;
                                border-top: black 2px solid;
                                border-right: black 2px solid;
                                border-left: black 2px solid; 
                                border-radius: 15px 15px 0px 0px ; 
                                -moz-border-radius:  15px 15px 0px 0px ; 
                                -webkit-border-radius:15px 15px 0px 0px "
                                >
                                    <strong style="color: white">DATOS DE LA FACTURA</strong>
                                </td>
                            </tr>
                            <tr>
                                <td style="  border-radius :3px;border-bottom:  black 2px solid; border-left: black 2px solid;">
                                    <strong style="color: #00096d;">FECHA DE EMISION: </strong> <label>{{ $data->created_at }}</label>
                                    <br>
                                    <strong style="color: #00096d">SERIE DE DOCUMENTO: </strong><label>aaaaa</label>
                                    <br>
                                    <strong style="color: #00096d">No. FACTURA: </strong> <label>20<?php echo date('y'); ?>-
                                        {{ $data->id }}</label>
                                    <br>
                                    <strong style="color: #00096d">LUGAR DE EMISION: </strong> <label>{{ $data->company->address }}</label>
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
                            @if ($data->customer)
                            <label style="color: black">{{ $data->customer->name }} {{ $data->customer->lastname }}</label>
                            @else
                            <label style="color: black">Consumidor Final</label>
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
                        <input type="text" style="border: none;background:none;text-align:right" id="inputNumero" value="{{ $data->total }}">

                    </div>
                </td>
            </tr>
            <!-- Total letras -->
            <tr>

                <td colspan="2">
                    <div style="border-radius:7px; background: #092863; color:white; text-align: right">
                        <b>Total en letras</b> <strong style="color:#092863">----</strong>
                    </div>
                </td>
                <td colspan="3" style="border-bottom:  #092863  double;">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black; text-align: right">
                        <p id="salida">Aquí aparecerá la cantidad como letras</p>
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
                       
                        <strong style="color: white"> <b>Atendido por: </b>{{ $data->user->name }} {{ $data->user->lastname }} |  {{ $data->company->name }} ® | Copyright©</strong>

                    </div>

                    <script>
                        const inputNumero = document.querySelector("#inputNumero"),
                            botonConvertir = document.querySelector("#factura"),
                            salida = document.querySelector("#salida");


                        // Escuchar el click del botón
                        botonConvertir.addEventListener("click", function() {
                            // Obtener valor que hay en el input
                            let valor = parseFloat(inputNumero.value);
                            // Simple validación
                            if (!valor) return alert("Escribe un valor");

                            // Obtener la representación
                            let letras = numeroALetras(valor, {
                                plural: "QUETZALES",
                                singular: "QUETZAL",
                                centPlural: "CENTAVOS",
                                centSingular: "CENTAVO"
                            });
                            // Y a la salida ponerle el resultado
                            salida.innerText = letras;
                        });
                    </script>
                </td>
            </tr>
        </table>
    </div>
    <!-- funcion de convertir numeros a letras -->
    <script src="NUMEROSLETRAS.js"></script> 
    

</body>

</html>