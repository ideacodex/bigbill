<!DOCTYPE html>
<html>

<body style=" font-family:Helvetica;">
    <table>
        <!-- Encabezado -->
        <tr>
            <!--  Informe de CUENTAS -->
            <td colspan="5">
                <div>
                    <div style="background: white;padding: 10px;">
                        <h2 style="color: #00096d; font: Arial; ">Informe de USUARIOS</h2>
                        <br>
                        <strong style="color: #00096d">Ultima Actualizacion: {{ Auth::user()->updated_at }} </strong>
                        <br>
            </td>
            </div>
            </div>
            </td>
            <!-- Datos Emision de informe -->
            <td colspan="5">
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
            <td @if(Auth::user()->role_id == 1)colspan="10" @else colspan="9" @endif>
                <br>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #d1cfcbd0; 
                border-radius: 35px 35px 0px 0px ; 
                -moz-border-radius:  35px 35px 0px 0px ; 
                -webkit-border-radius:35px 35px 0px 0px ; ">
                    <h3 style="color: black;text-align:center"> <b> Detalle De Informe: </b></h3>
                </div>
            </td>
        </tr>
        
        {{-- <!-- Encabezado Detalle --> --}}
        <tr>
            <th class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black;" scope="col">#</th>
            @if(Auth::user()->role_id == 1)
            <th class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black;" scope="col">Id</th>
            @endif
            <th class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black;" scope="col" scope="col">Rol</th>
            <th class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black;" scope="col" scope="col">Nombre</th>
            <th class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black;" scope="col" scope="col">Apellido</th>
            <th class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black;" scope="col" scope="col">telefono </th>
            <th class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black;" scope="col" scope="col">Nit</th>
            <th class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black;" scope="col" scope="col">Direccion </th>
            <th class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black;" scope="col" scope="col">Correo</th>
            <th class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black;" scope="col" scope="col">Compañia</th>
        </tr>
        <!-- Detalle -->
        @foreach ($User as $item)
        <tr>
            <th class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black" scope="row">{{ $loop->index + 1 }}</th>
            @if(Auth::user()->role_id == 1)
            <th class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">{{ $item->id }}</th>
            @endif
            <td class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black"><b> {{ $item->role_id }}</b></td>
            <td class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">{{ $item->name }}</td>
            <td class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">{{ $item->lastname }}</td>
            <td class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">{{ $item->phone }}</td>
            <td class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">{{ $item->nit }}</td>
            <td class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">{{ $item->address }}</td>
            <td class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">{{ $item->email }}</td>
            @if ($item->company)
            <td class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">{{ $item->company->name }}</td>
            @else
            {
            <td class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">Sin companía</td>
            }
            @endif
        </tr>
        @endforeach
        <!-- responsable -->
        <tr>
            <td @if(Auth::user()->role_id == 1)colspan="10" @else colspan="9" @endif>
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
    <!-- Nota: detalle -->
    <p style="color: black;text-align:center">
       Areas de trabajo
    </p>
    <p style="color: black;text-align:center">
        <b> Gerente </b>= 2
        <b> Contador</b> = 3
        <b> vendedor</b> = 4
    </p>
</body>

</html>
