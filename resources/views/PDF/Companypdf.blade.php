<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>

</head>

<body style=" font: Georgia">
    <div name="company">
        <div class="row">
            <div class="col-md-2 col-sm-3 col-xs-2 clearfix"
                style="background: #2b204b;border: 1px solid #000;padding: 10px;">
                <table>
                    <tr style="text-align: right">
                        <td style="text-align: right">
                            <strong style="color: #ed8405; font: Italic;  ">Informe de</strong>
                            <strong style="color: #2b204b; ">--------------</strong>
                            <h1 style="color: #ed8405; font: Italic;text ;text-align: right">COMPAÑIAS</h1>
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
                <th scope="col"> <h3> No.</h3></th>
                <th scope="col"><h3> Nombre</h3></th>
                <th scope="col"><h3> Nit</h3></th>
                <th scope="col"><h3> Telefono </h3></th>
                <th scope="col"><h3> Direccion</h3></th>
            </tr>
        </thead>
        <tbody style=" color:#2b204b ; border: #2b204b 1px solid">
            @foreach ($Company as $item)
                <tr>
                    <th scope="row"> {{ $item->id }}</th>
                    <td> <b> {{ $item->name }}</b></td>
                    <td> {{ $item->nit }}</td>
                    <td> {{ $item->phone }}</td>
                    <td> {{ $item->address }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


</body>

</html>
