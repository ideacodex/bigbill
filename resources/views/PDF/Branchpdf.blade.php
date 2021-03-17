<!DOCTYPE html>
<html>

<body style=" font-family:Helvetica;">
    <table>
        <!-- Encabezado -->
        <tr>
            <!--  Informe de CUENTAS -->
            <td @if (Auth::user()->role_id == 1) colspan="3" @else colspan="2" @endif>
                <div style="background: white;padding: 10px;">
                    <h2 style="color: #00096d; font: Arial; ">Informe de Sucursales</h2>
                    <br>
                    <strong style="color: #00096d">
                        Ultima Actualizacion:
                        <?php echo date('d/m/y'); ?>
                    </strong>
                    <br>
                </div>
            </td>

            <!-- Datos Emision de informe -->
            <td @if (Auth::user()->role_id == 1) colspan="7" @else colspan="3" @endif>
                <table style="font-size:20px">
                    <tr style="background: #ff7400;padding: 12px;text-align: center;">
                        <td colspan="2"
                            style=" border-radius :7px; border-top: black 2px solid;border-right: black 2px solid;border-left: black 2px solid;">
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
            </td>
        </tr>
        <!-- NOTA: detalle -->
        <tr>
            <td @if (Auth::user()->role_id == 1) colspan="7" @else colspan="5" @endif>
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
            <th class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black;" scope="col">
                <h3> #</h3>
            </th>
            @if (Auth::user()->role_id == 1)
                <th class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black;" scope="col">
                    <h3> Id.</h3>
                </th>
                <th class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black;" scope="col">
                    <h3> Compania</h3>
                </th>
            @endif
            <th class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black;" scope="col">
                <h3> Nombre</h3>
            </th>
            <th class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black;" scope="col">
                <h3> Telefono</h3>
            </th>
            <th class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black;" scope="col">
                <h3> PBX </h3>
            </th>
            <th class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black;" scope="col">
                <h3> Direccion</h3>
            </th>
        </tr>
        <!-- Detalle -->
        @foreach ($records as $item)
            <tr>
                <td class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">
                    {{ $loop->index + 1 }}</td>
                @if (Auth::user()->role_id == 1)
                    <td class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">
                        {{ $item->id }}
                    </td>
                    <td class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">
                        {{ $item->company->name }}
                    </td>
                @endif
                <td class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black"> <b>
                        {{ $item->name }}</b></td>
                <td class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">
                    {{ $item->phone }}</td>
                <td class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">
                    {{ $item->pbx }}</td>
                <td class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">
                    {{ $item->address }}</td>
            </tr>
        @endforeach

        <!-- responsable -->
        <tr>
            <td @if (Auth::user()->role_id == 1) colspan="7" @else colspan="5" @endif>
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
