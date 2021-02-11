<!DOCTYPE html>
<html>

<body style=" font-family:Helvetica;">
    <table>
        <!-- Encabezado -->
        <tr>
            <!--  Informe de CUENTAS -->
            <td colspan="2">
                <div>
                    <div style="background: white;padding: 10px;">
                        <h2 style="color: #00096d; font: Arial; ">Informe de CUENTAS</h2>
                        <br>
                        <strong style="color: #00096d">Ultima Actualizacion: <?php echo date('d/m/y'); ?></strong>
                        <br>
            </td>

            </div>
            </div>
            </td>
            <!-- Datos Emision de informe -->
            <td colspan="2">
                <div>
                    <table style="font-size:20px">
                        <tr style="background: #ff7400;padding: 12px;text-align: center;">
                            <td colspan="2" style=" border-radius :7px; border-top: black 2px solid;border-right: black 2px solid;border-left: black 2px solid;">
                                <strong style="color: white">Datos de Emision de Informe</strong>
                            </td>
                        </tr>
                        <tr>
                            <td style="  border-radius :3px;border-bottom:  black 2px solid; border-left: black 2px solid;">
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
            <td colspan="4">
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
        <tr>
            <td>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black;">
                    No.
                </div>
            </td>
            <td>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black">
                    Id.
                </div>
            </td>
            <td>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black; ">
                    Nombre de la Cuenta
                </div>
            </td>
            <td>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black">
                    Tipo De Cuenta
                </div>
            </td>
        </tr>
        <!-- Detalle -->
        @foreach ($Account as $item)
        <tr>
            <td>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">
                    {{ $loop->index + 1 }}
                </div>
            </td>
            <td>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">
                    {{ $item->id }}
                </div>
            </td>
            <td>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">
                    {{ $item->name }}
                </div>
            </td>
            <td>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">
                    {{ $item->account_types->status }}
                </div>
            </td>

        </tr>
        @endforeach

        <!-- responsable -->
        <tr>
            <td colspan="4">
                <br>
                <br>
                <br>
                <br>

                <div style="background: #092863;border: 1px solid #000;padding: 12px;text-align: center;">

                    <strong style="color: white"> <b>Informe emitido: por: </b>{{ Auth::user()->name }} {{ Auth::user()->lastname }} | Copyright©</strong>

                </div>


            </td>
        </tr>


    </table>
</body>

</html>