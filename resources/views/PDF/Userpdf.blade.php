<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>

</head>

<body style=" font: Georgia">
    <div name="user">
        <div class="row">
            <div class="col-md-2 col-sm-3 col-xs-2 clearfix"
                style="background: #2b204b;border: 1px solid #000;padding: 10px;">
                <table>
                    <tr style="text-align: right">
                        <td style="text-align: right">
                            <strong style="color: #ed8405; font: Italic;  ">Informe de</strong>
                            <strong style="color: #2b204b; ">--------------</strong>
                            <h1 style="color: #ed8405; font: Italic;text ;text-align: right">USUARIOS</h1>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div>
            <div class="row">
                <div class="col-md-2 col-sm-3 col-xs-2 clearfix"
                    style="background: #2b204b;border: 1px solid #000;padding: 10px;">
                    <input type="text" value="<?php echo date('d/m/y'); ?>"
                        style="border: none; background: none; float: right;color: #ffffff">
                    <table>
                        <tr>
                            <td rowspan="2">
                                <Strong style="color: #ffffff">Nombre:
                                    <!-- nombre-->
                                </Strong>
                            </td>
                            <td style="color: #ffffff">
                                {{ Auth::user()->name }}
                                <!-- name-->
                            </td>
                        </tr>
                        <tr>
                            <td style="color: #ffffff">
                                {{ Auth::user()->lastname }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <Strong style="color: #ffffff">Nit:</Strong>
                            </td>
                            <td style="color: #ffffff">
                                {{ Auth::user()->nit }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <Strong style="color: #ffffff">correo: </Strong>
                            </td>
                            <td style="color: #ffffff">
                                {{ Auth::user()->email }}
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>

    </div>
    <table class="table table-dark">
        <thead style="background: #2b204b ; color:white">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Rol</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">telefono </th>
                <th scope="col">Nit</th>
                <th scope="col">Direccion </th>
                <th scope="col">Correo</th>
                <th scope="col">Compañia</th>
            </tr>
        </thead>
        <tbody style=" color:#2b204b ; border: #2b204b 1px solid">
            @foreach ($User as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td><b> {{ $item->role_id }}</b></td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->lastname }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->nit }}</td>
                    <td>{{ $item->address }}</td>
                    <td>{{ $item->email }}</td>
                    @if ($item->company)
                        <td>{{ $item->company->name }}</td>
                    @else
                        {
                        <td>Sin companía</td>
                        }
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
