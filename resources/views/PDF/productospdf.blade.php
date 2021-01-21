<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
    <table >
        <thead>
            <tr role="row">
                <th class="sorting_asc" tabindex="0" aria-controls="bootstrap-data-table"
                    rowspan="1" colspan="1" style="width: 322px;" aria-sort="ascending"
                    aria-label="Name: activate to sort column descending">Id</th>
                <th class="sorting_asc" tabindex="0" aria-controls="bootstrap-data-table"
                    rowspan="1" colspan="1" style="width: 322px;" aria-sort="ascending"
                    aria-label="Name: activate to sort column descending">Productos</th>
                <th class="sorting_asc" tabindex="0" aria-controls="bootstrap-data-table"
                    rowspan="1" colspan="1" style="width: 322px;" aria-sort="ascending"
                    aria-label="Name: activate to sort column descending">Descrpcion</th>
                <th class="sorting_asc" tabindex="0" aria-controls="bootstrap-data-table"
                    rowspan="1" colspan="1" style="width: 322px;" aria-sort="ascending"
                    aria-label="Name: activate to sort column descending">Precio </th>
                <th class="sorting_asc" tabindex="0" aria-controls="bootstrap-data-table"
                    rowspan="1" colspan="1" style="width: 322px;" aria-sort="ascending"
                    aria-label="Name: activate to sort column descending">#Compañia </th>
                <th class="sorting_asc" tabindex="0" aria-controls="bootstrap-data-table"
                    rowspan="1" colspan="1" style="width: 322px;" aria-sort="ascending"
                    aria-label="Name: activate to sort column descending">Cant. Stock</th>
                <th class="sorting_asc" tabindex="0" aria-controls="bootstrap-data-table"
                    rowspan="1" colspan="1" style="width: 322px;" aria-sort="ascending"
                    aria-label="Name: activate to sort column descending">Fecha Stock</th>
                <th class="sorting_asc" tabindex="0" aria-controls="bootstrap-data-table"
                    rowspan="1" colspan="1" style="width: 322px;" aria-sort="ascending"
                    aria-label="Name: activate to sort column descending">Cant. Ingreso </th>
                <th class="sorting_asc" tabindex="0" aria-controls="bootstrap-data-table"
                    rowspan="1" colspan="1" style="width: 322px;" aria-sort="ascending"
                    aria-label="Name: activate to sort column descending">Fecha Ingreso</th>
                <th class="sorting_asc" tabindex="0" aria-controls="bootstrap-data-table"
                    rowspan="1" colspan="1" style="width: 322px;" aria-sort="ascending"
                    aria-label="Name: activate to sort column descending">Cant. Egreso</th>
                <th class="sorting_asc" tabindex="0" aria-controls="bootstrap-data-table"
                    rowspan="1" colspan="1" style="width: 322px;" aria-sort="ascending"
                    aria-label="Name: activate to sort column descending">Fecha Egreso</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $item)
                <tr>
                    <th scope="row"> {{ $item->id }}</th>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->company_id }}</td>
                    <td>{{ $item->quantity_values }}</td>
                    <td>{{ $item->date_values }}</td>
                    <td>{{ $item->income_amount }}</td>
                    <td>{{ $item->date_admission }}</td>
                    <td>{{ $item->amount_expenses }}</td>
                    <td>{{ $item->date_discharge }}</td>
                </tr>
            @endforeach
        </tbody>

    </table>
</body>
</html>