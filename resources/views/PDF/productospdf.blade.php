<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>

</head>

<body style=" font: Arial;">
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" 
    style="background: #2b204b; 
    padding-top: 10px; 
    padding-bottom: 10px; 
    padding-bottom: 10px; 
    padding-left: 10%;"> 
       <br>
       <h1 style="color: #ed8405; font: Italic; ">FACTURA</h1>
       <strong style="color: #ed8405; font: Italic; ">Nombre de la Empresa</strong>
    </div>


    <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Productos</th>
                <th>Descrpcion</th>
                <th>Precio </th>
                <th>Cant. Stock</th>
                <th>Cant. Ingreso </th>
                <th>Cant. Egreso</th>
                <th>Fecha Transaccion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $item)
                <tr>
                    <th>{{ $item->id }}</th>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->quantity_values }}</td>
                    <td>{{ $item->income_amount }}</td>
                    <td>{{ $item->amount_expenses }}</td>
                    <td>{{ $item->date_discharge }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
