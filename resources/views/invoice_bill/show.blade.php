<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<style>
    #opacidad {
        background-color: Gray;
        opacity: 0.5;
        height: 60px;
        width: 160px;
        position: absolute;
        top: 40px;
        text-align: right;
        padding-top: 1em;
        padding: 10px;

    }

    #texto {
        height: 60px;
        width: 150px;
        -webkit-text-stroke: 2px rgb(255, 255, 255);
        color: transparent;
        color: rgb(255, 255, 255);
        position: absolute;
        top: 35px;
        text-align: right;
        padding-top: 1em;
    }

</style>

<body style="font-family:Helvetica; ">
    <div class="row">
        <div class="col-lg-3 col-md-2 col-sm-1 col-xs-1">.</div>

        <div class="col-lg-6 col-md-8 col-sm-10 col-xs-10">
            <br>
            <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <img src="{{ asset('pdfestilo/Fondo.png') }}" class="image" width="100%" height="100px"
                        alt="Usuario">
                </div>

                <div id="opacidad">

                </div>
                <div id="texto">
                    <h2> Reporte </h2>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <img src="{{ asset('pdfestilo/Fondo2.png') }}" class="image" width="100%" height="100px"
                        alt="Usuario">
                </div>
                <br>
            </div>
            <br>
            <div class="row">
                {{-- <!-- Nota --> --}}
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7"><br><br></div>
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-8">
                    <br>
                    <br>
                    <strong style="color : #030303;">Venta</strong>
                    <br>
                    <strong style="color : #0026a7;">Comprobante electrónico</strong>
                </div>

                {{-- <!-- Encabezado --> --}}

                {{-- <!-- Datos Empresa --> --}}
                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-5" style="color: #00096d;font-size:20px">
                    <br>
                    @if ($records->active == 1)
                        <h2>Venta {{ $records->company->name }}</h2>
                    @elseif($records->active == 0)
                        <h2>Venta cancelada <br> {{ $records->company->name }}</h2>
                    @endif
                    <strong style="color: #00096d;">Dirección:</strong> {{ $records->company->address }}
                    <br>
                    <strong style="color: #00096d">Teléfono:</strong> {{ $records->company->phone }}
                    <br>
                    <strong style="color: #00096d">Nit: </strong> {{ $records->company->nit }}
                    <br>
                    <strong style="color: #00096d;">Fecha:</strong> <?php echo date('d/m/y'); ?> <br><br>
                </div>
                {{-- <!-- Datos Factura --> --}}
                <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
                    <br>
                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: white; background: #ff7400;
                                        text-align: center;
                                        border-top: black 2px solid;
                                        border-right: black 2px solid;
                                        border-left: black 2px solid;
                                        border-radius: 15px 15px 0px 0px ;
                                        -moz-border-radius:  15px 15px 0px 0px ;
                                        -webkit-border-radius:15px 15px 0px 0px">
                            <strong>DATOS DE LA VENTA</strong>
                        </div>
                        <br>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"
                            style="border-radius :3px;border-bottom:  black 2px solid; border-left: black 2px solid;border-right: black 2px solid">
                            <br> <strong style="color: #00096d;">FECHA DE EMISION:</strong>
                            {{ $records->created_at }}
                            <br>
                            <strong style="color: #00096d">SERIE DE DOCUMENTO:</strong> A
                            <br>
                            <strong style="color: #00096d">No. FACTURA: </strong> 20<?php echo date('y');
                            ?>-{{ $records->id }}
                            <br>
                            <strong style="color: #00096d">LUGAR DE EMISION: </strong>
                            {{ $records->company->address }}
                            <br>
                            <strong style="color: #00096d;">FECHA DE EXPIRACION:</strong>
                            {{ $records->expiration_date }}
                        </div>
                    </div>
                </div>




                {{-- <!-- Nota --> --}}
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"
                    style="color: white; background: #092863 ; text-align: Center">
                    <h3>
                        <b>
                            Datos del Cliente:
                        </b>
                    </h3>
                </div>
                {{-- <!-- Datos Cliente --> --}}
                <div class="col-lg-12 col-md-4 col-sm-6 col-xs-12" style="font-family:Courier New;">
                    <Strong style="color: black">Nombre: </Strong>
                    @if ($records->customer)
                        <label style="color: black">{{ $records->customer->name }}
                            {{ $records->customer->lastname }}</label>
                    @else
                        @if ($records->customer_name)
                            <label style="color: black">{{ $records->customer_name }}
                            </label>
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
                            <label style="color: black">{{ $records->customer_email }}
                            </label>
                        @else
                        @endif
                    @endif
                </div>
                {{-- <!-- Nota: detalle --> --}}
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: black ;
                        background: #d1cfcbd0 ;
                        text-align: center;
                        border-radius: 15px 15px 0px 0px ;
                        -moz-border-radius:  15px 15px 0px 0px ;
                        -webkit-border-radius:15px 15px 0px 0px">
                    <h3>
                        <b>
                            Detalle de venta
                        </b>
                    </h3>
                </div>
                <!-- Encabezado Detalle -->
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"
                    style="text-align: center;color: black ;background: #d1cfcbd0 ;border-top: white 2px solid;">
                    No.
                </div>
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5"
                    style="color: black ;background: #d1cfcbd0 ;border-top: white 2px solid;">
                    Descripción
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"
                    style="color: black ;background: #d1cfcbd0 ;border-top: white 2px solid;">
                    Cantidad
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"
                    style="text-align: right;color: black ;background: #d1cfcbd0 ;border-top: white 2px solid;">
                    P/U
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"
                    style="text-align: right;color: black ;background: #d1cfcbd0 ;border-top: white 2px solid;">
                    Subtotal
                </div>
                {{-- <!-- Detalle --> --}}
                @foreach ($records->detail as $item)
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style="text-align: center;">
                        {{ $loop->index + 1 }}
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                        {{ $item->product->name }}
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                        {{ $item->quantity }}
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="text-align: right;">
                        {{ $item->unit_price }}
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="text-align: right;">
                        {{ $item->subtotal }}
                    </div>
                @endforeach
                <!-- Operaciones -->
                <?php
                $a = $records->total;
                $b = $records->iva;
                $c = $a - $b;
                ?>
                <br>
                <!-- Subtotal -->
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 ">
                </div>
                <div style=" border-radius:7px;background: #092863;color:white ;text-align: right"
                    class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <b>Subtotal</b>
                </div>

                <div style="background: #ffffff; text-align: right" class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <label><?php echo $c; ?></label>
                </div>
                <!-- Iva -->
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 ">
                </div>
                <div style=" border-radius:7px;background: #092863;color:white ;text-align: right"
                    class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <b>IVA</b>
                </div>
                <div style="background: #ffffff; text-align: right" class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <label><?php echo $b; ?></label>
                </div>
                <!-- Total -->
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 ">
                </div>
                <div style=" border-radius:7px;background: #092863;color:white ;text-align: right"
                    class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <b>Total</b>
                </div>
                <div style="background: #ffffff; text-align: right ;border-bottom:  #092863  double;"
                    class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <label>{{ $records->total }}</label>
                </div>
                <div style="background: #ffffff; " class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                    <br>
                    {{-- salto de linea --}}
                </div>
                {{-- <!-- Total letras --> --}}
                <div style=" background: #092863;color:white ;text-align: right"
                    class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <b>Total en letras</b>
                </div>
                <div style="background: #ffffff; text-align: right" class="col-lg-10 col-md-10 col-sm-10 col-xs-10 ">
                    <label> {{ $records->totalletras }}</label>
                </div>
                <div style="background: #ffffff; " class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                    <br>
                    {{-- salto de linea --}}
                </div>
                {{-- <!-- Te atendio --> --}}
                <div style="background: #092863;border: 1px solid #000;padding: 12px;text-align: center; color: white"
                    class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <strong>
                        <b>
                            Atendido por:
                        </b>{{ $records->user->name }} {{ $records->user->lastname }}
                        |{{ $records->company->name }}® |Copyright©
                    </strong>
                </div>

            </div>
        </div>
        <div class="col-lg-3 col-md-2 col-sm-1 col-xs-1">.</div>
    </div>
</body>

</html>
