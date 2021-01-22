<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
    <H1>HOLA MUNDOOO</H1>
    <H2>MARIA</H2>
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