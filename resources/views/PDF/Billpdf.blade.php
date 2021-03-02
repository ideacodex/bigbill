<!DOCTYPE html>
<html>

<body style=" font-family:Helvetica;">
    <table>
        <!-- Encabezado -->
        <tr>
            <!--  Informe de CUENTAS -->
            <td colspan="4">
                <div>
                    <div style="background: white;padding: 10px;">
                        <h2 style="color: #00096d; font: Arial; ">Informe de FACTURAS</h2>
                        <br>
                        <strong style="color: #00096d">Ultima Actualizacion: <?php echo date('d/m/y');
                            ?>
                        </strong>
                        <br>
                    </div>
                </div>
            </td>
            <!-- Datos Emision de informe -->
            <td colspan="8">
                <div>
                    <table style="font-size:20px">
                        <tr>
                            <td colspan="2"
                                style="background: #ff7400;text-align: center; border-radius :7px; border-top: black 2px solid;border-right: black 2px solid;border-left: black 2px solid;">
                                <strong style="color: white">Datos de Emision de Informe</strong>
                            </td>
                        </tr>
                        <tr>
                            <td
                                style="  border-radius :3px;border-bottom:  black 2px solid; border-left: black 2px solid;">
                                <strong style="color: #00096d;">Emitido por: </strong>
                                <br>
                                <strong style="color: #00096d">Fecha: </strong>
                                <br>
                                <strong style="color: #00096d">Nit</strong>
                                <br>
                                <strong style="color: #00096d">Correo: </strong>
                                <br>
                            </td>
                            <td style=" border-bottom:  black 2px solid; border-right: black 2px solid;">
                                <label>{{ Auth::user()->name }} , {{ Auth::user()->lastname }}</label>
                                <br>
                                <label><?php echo date('d/m/y'); ?></label>
                                <br>
                                <label>{{ Auth::user()->nit }}</label>
                                <br>
                                <label>{{ Auth::user()->email }}</label>
                                <br>
                            </td>
                        </tr>

                    </table>

                </div>
            </td>
        </tr>
        <!-- Nota: detalle -->
        <tr>
            <td colspan="12">
                <br>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #d1cfcbd0;
                border-radius: 35px 35px 0px 0px ;
                -moz-border-radius:  35px 35px 0px 0px ;
                -webkit-border-radius:35px 35px 0px 0px ; ">
                    <h3 style="color: black;text-align:center"> <b> Detalle De Informe: </b></h3>
                </div>
            </td>
        </tr>
        <!-- Encabezado Detalle -->


        <tr style="background: #2b204b ; color:white">


            <th scope="col" style="background: #dddbd9; color: black;">#</th>
            <th scope="col" style="background: #dddbd9; color: black;">Factura</th>
            <th scope="col" style="background: #dddbd9; color: black;">producto</th>
            <th scope="col" style="background: #dddbd9; color: black;">cat</th>
            <th scope="col" style="background: #dddbd9; color: black;">Unitario</th>
            <th scope="col" style="background: #dddbd9; color: black;">SubTotal</th>
            <th scope="col" style="background: #dddbd9; color: black;">Id</th>
            <th scope="col" style="background: #dddbd9; color: black;">Responsable</th>
            <th scope="col" style="background: #dddbd9; color: black;">compania</th>
            <th scope="col" style="background: #dddbd9; color: black;">iva </th>
            <th scope="col" style="background: #dddbd9; color: black;">Total </th>
        </tr>

        @foreach ($InvoiceBill as $dato)

            @foreach ($dato->detail as $items)

                <tr style=" color:#2b204b ; border: #2b204b 1px solid">

                    <td>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">
                            {{ $loop->index + 1 }}
                        </div>
                    </td>
                    <th style="background: #ffffff; color: black" scope="row">{{ $items->invoice_id }}
                    </th>
                    <td style="background: #ffffff; color: black">{{ $items->product->name }}</td>
                    <td style="background: #ffffff; color: black">{{ $items->quantity }}</td>
                    <td style="background: #ffffff; color: black">{{ $items->unit_price }}</td>
                    <td style="background: #ffffff; color: black">{{ $items->subtotal }}</td>

                    <th style="background: #ffffff; color: black" scope="row">{{ $items->invoice_id }}
                    </th>
                    <td style="background: #ffffff; color: black">{{ $dato->user->name }} <br>
                        {{ $dato->user->lastname }}</td>
                    <td style="background: #ffffff; color: black">{{ $dato->company->name }}</td>
                    <td style="background: #ffffff; color: black">{{ $dato->iva }}</td>
                    <td style="background: #ffffff; color: black">{{ $dato->total }}</td>

                </tr>
            @endforeach



        @endforeach


        <!-- responsable -->
        <tr>
            <td colspan="12">
                <br>
                <br>
                <br>
                <br>

                <div style="background: #092863;border: 1px solid #000;padding: 12px;text-align: center;">

                    <strong style="color: white"> <b>Informe emitido: por: </b>{{ Auth::user()->name }}
                        {{ Auth::user()->lastname }} | Copyright©</strong>

                </div>


            </td>
        </tr>


    </table>
</body>

</html>
