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
                    <strong style="color : #030303;">Factura</strong><strong
                        style="color : #ffffff;">-----------------------</strong>
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
                                        <h2 style="color: #00096d; font: Arial; ">Factura <br>
                                            {{ $records->company->name }}</h2>

                                        <strong style="color: #00096d">Dirección:
                                            {{ $records->company->address }}</strong>
                                        <br>
                                        <strong style="color: #00096d">Teléfono:
                                            {{ $records->company->phone }}</strong>
                                        <br>
                                        <strong style="color: #00096d">Nit: {{ $records->company->nit }}</strong>
                                        <br>
                                        <strong style="color: #00096d">Fecha: <?php echo date('d/m/y');
                                            ?></strong>
                                        <br>

                                    </td>
                                    <td>
                                        <strong
                                            style="color: #ffffff; ">----------------------------------------------</strong>
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
                            <tr>
                                <td colspan="3" style="
                                background: #ff7400;padding: 12px;
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
                                <td
                                    style="  border-radius :3px;border-bottom:  black 2px solid; border-left: black 2px solid;">
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
                                <td
                                    style=" border-radius :3px; border-bottom:  black 2px solid; border-right: black 2px solid;">
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
                        <h3 style="color: white; background: #092863 ; text-align: Center"><b> Datos del Cliente: </b>
                        </h3>
                        <div style="font-family:Courier New;">

                            <Strong style="color: black">Nombre: </Strong>
                            @if ($records->customer)
                                <label style="color: black">{{ $records->customer->name }}
                                    {{ $records->customer->lastname }}</label>
                            @else
                                @if ($records->customer_name)
                                    <label style="color: black">{{ $records->customer_name }} </label>
                                @else
                                    <label style="color: black">Consumidor Final</label>
                                @endif
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
                            <br>
                            @if ($records->customer)
                                <Strong style="color: black">Correo: </Strong>
                                <label style="color: black">{{ $records->customer->email }}</label>
                            @else
                                @if ($records->customer_email)
                                    <Strong style="color: black">Correo: </Strong>
                                    <label style="color: black">{{ $records->customer_email }} </label>
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
            $c = $a * $b;
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
                        <label><?php echo $d; ?></label>
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

                        <label><?php echo $c; ?></label>
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
                            value="{{ $records->total }}">
                    </div>
                </td>
            </tr>
            <!-- Total letras -->
            <tr>

                <td>
                    <div style="border-radius:7px; background: #092863; color:white; text-align: right">
                        <b>Total en letras</b> <strong style="color:#092863">----</strong>
                    </div>
                </td>
                {{-- Aqui aparecera como la cantidad en letras --}}
                <td colspan="4" style="border-bottom:  #092863  double;">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"
                        style="background: #ffffff; color: black; text-align: right">
                        <label> {{ $records->totalletras }}</label>
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

                        <strong style="color: white"> <b>Atendido por: </b>{{ $records->user->name }}
                            {{ $records->user->lastname }} | {{ $records->company->name }} ® | Copyright©</strong>

                    </div>
                    {{-- le da valores a mi moneda --}}
                    {{-- <script>
                        const inputNumero = document.querySelector("#inputNumero"),
                            botonConvertir = document.querySelector("#factura"),
                            salida = document.querySelector("#salida");
                        // Escuchar el click del botón
                        botonConvertir.addEventListener("mouseout", function() {
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

                    </script> --}}
                    {{-- le da valores a mi moneda --}}
                </td>
            </tr>
        </table>
    </div>
    {{-- cantidad en letras --}}
    {{-- <script>
        var numeroALetras = (function() {
            function Unidades(num) {
                switch (num) {
                    case 1:
                        return 'UN';
                    case 2:
                        return 'DOS';
                    case 3:
                        return 'TRES';
                    case 4:
                        return 'CUATRO';
                    case 5:
                        return 'CINCO';
                    case 6:
                        return 'SEIS';
                    case 7:
                        return 'SIETE';
                    case 8:
                        return 'OCHO';
                    case 9:
                        return 'NUEVE';
                }

                return '';
            } //Unidades()

            function Decenas(num) {

                let decena = Math.floor(num / 10);
                let unidad = num - (decena * 10);

                switch (decena) {
                    case 1:
                        switch (unidad) {
                            case 0:
                                return 'DIEZ';
                            case 1:
                                return 'ONCE';
                            case 2:
                                return 'DOCE';
                            case 3:
                                return 'TRECE';
                            case 4:
                                return 'CATORCE';
                            case 5:
                                return 'QUINCE';
                            default:
                                return 'DIECI' + Unidades(unidad);
                        }
                        case 2:
                            switch (unidad) {
                                case 0:
                                    return 'VEINTE';
                                default:
                                    return 'VEINTI' + Unidades(unidad);
                            }
                            case 3:
                                return DecenasY('TREINTA', unidad);
                            case 4:
                                return DecenasY('CUARENTA', unidad);
                            case 5:
                                return DecenasY('CINCUENTA', unidad);
                            case 6:
                                return DecenasY('SESENTA', unidad);
                            case 7:
                                return DecenasY('SETENTA', unidad);
                            case 8:
                                return DecenasY('OCHENTA', unidad);
                            case 9:
                                return DecenasY('NOVENTA', unidad);
                            case 0:
                                return Unidades(unidad);
                }
            } //Unidades()

            function DecenasY(strSin, numUnidades) {
                if (numUnidades > 0)
                    return strSin + ' Y ' + Unidades(numUnidades)

                return strSin;
            } //DecenasY()

            function Centenas(num) {
                let centenas = Math.floor(num / 100);
                let decenas = num - (centenas * 100);

                switch (centenas) {
                    case 1:
                        if (decenas > 0)
                            return 'CIENTO ' + Decenas(decenas);
                        return 'CIEN';
                    case 2:
                        return 'DOSCIENTOS ' + Decenas(decenas);
                    case 3:
                        return 'TRESCIENTOS ' + Decenas(decenas);
                    case 4:
                        return 'CUATROCIENTOS ' + Decenas(decenas);
                    case 5:
                        return 'QUINIENTOS ' + Decenas(decenas);
                    case 6:
                        return 'SEISCIENTOS ' + Decenas(decenas);
                    case 7:
                        return 'SETECIENTOS ' + Decenas(decenas);
                    case 8:
                        return 'OCHOCIENTOS ' + Decenas(decenas);
                    case 9:
                        return 'NOVECIENTOS ' + Decenas(decenas);
                }

                return Decenas(decenas);
            } //Centenas()

            function Seccion(num, divisor, strSingular, strPlural) {
                let cientos = Math.floor(num / divisor)
                let resto = num - (cientos * divisor)

                let letras = '';

                if (cientos > 0)
                    if (cientos > 1)
                        letras = Centenas(cientos) + ' ' + strPlural;
                    else
                        letras = strSingular;

                if (resto > 0)
                    letras += '';

                return letras;
            } //Seccion()

            function Miles(num) {
                let divisor = 1000;
                let cientos = Math.floor(num / divisor)
                let resto = num - (cientos * divisor)

                let strMiles = Seccion(num, divisor, 'UN MIL', 'MIL');
                let strCentenas = Centenas(resto);

                if (strMiles == '')
                    return strCentenas;

                return strMiles + ' ' + strCentenas;
            } //Miles()

            function Millones(num) {
                let divisor = 1000000;
                let cientos = Math.floor(num / divisor)
                let resto = num - (cientos * divisor)

                let strMillones = Seccion(num, divisor, 'UN MILLON DE', 'MILLONES DE');
                let strMiles = Miles(resto);

                if (strMillones == '')
                    return strMiles;

            } //Millones()

            return function NumeroALetras(num, currency) {
                currency = currency || {};
                let data = {
                    numero: num,
                    enteros: Math.floor(num),
                    centavos: (((Math.round(num * 100)) - (Math.floor(num) * 100))),
                    letrasCentavos: '',
                    letrasMonedaPlural: currency.plural ||
                    'PESOS CHILENOS', //'PESOS', 'Dólares', 'Bolívares', 'etcs'
                    letrasMonedaSingular: currency.singular ||
                    'PESO CHILENO', //'PESO', 'Dólar', 'Bolivar', 'etc'
                    letrasMonedaCentavoPlural: currency.centPlural || 'CHIQUI PESOS CHILENOS',
                    letrasMonedaCentavoSingular: currency.centSingular || 'CHIQUI PESO CHILENO'
                };

                if (data.centavos > 0) {
                    data.letrasCentavos = 'CON ' + (function() {
                        if (data.centavos == 1)
                            return Millones(data.centavos) + ' ' + data.letrasMonedaCentavoSingular;
                        else
                            return Millones(data.centavos) + ' ' + data.letrasMonedaCentavoPlural;
                    })();
                };

                if (data.enteros == 0)
                    return 'CERO ' + data.letrasMonedaPlural + ' ' + data.letrasCentavos;
                if (data.enteros == 1)
                    return Millones(data.enteros) + ' ' + data.letrasMonedaSingular + ' ' + data
                        .letrasCentavos;
                else
                    return Millones(data.enteros) + ' ' + data.letrasMonedaPlural + ' ' + data
                        .letrasCentavos;
            };
        })();

    </script> --}}
    {{-- cantidad en letras --}}
</body>

</html>
