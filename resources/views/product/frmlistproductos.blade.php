@extends('layouts.Admin')
@section('content')
    <!--Validación de errores-->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!--Validación de errores-->


    <!--Mensaje flash-->
    @if (session('datosEliminados'))
        <div class="alert alert-danger">
            {{ session('datosEliminados') }}
        </div>
    @endif
    <!--Mensaje flash-->

    
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Productos Registrados</strong>
                </div>
                <div class="card-body">
                    <div id="bootstrap-data-table_wrapper"
                        class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                
                                <a href="{{ url('productos/create') }}"
                                class="btn btn-success btn-sm">&nbsp;
                                Agregar
                                <i class="fas fa-plus-square"></i>
                            </a>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
                <div class="row table-responsive">
                    <div class="col-sm-12">
                        <table id="bootstrap-data-table"
                        class="table table-striped table-bordered dataTable no-footer" role="grid"
                        aria-describedby="bootstrap-data-table_info">
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
                                    <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table"
                                    rowspan="1" colspan="1" style="width: 197px;"
                                    aria-label="Salary: activate to sort column ascending">Acciones</th>
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
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a class="btn btn-sm btn-secondary" href="" title="Ver Detalles">
                                                <span><i class="fas fa-eye"></i></span>
                                            </a>
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ url('productos/' . $item->id . '/edit') }}"
                                                title="Editar">
                                                <span><i class="fas fa-edit"></i></span>
                                            </a>
                                            <a class="btn btn-sm btn-danger" title="Eliminar"
                                                onclick="event.preventDefault();
                                                               document.getElementById('formDel{{ $item->id }}').submit();">
                                                <span class="text-light"><i class="fas fa-trash-alt"></i></span>
                                            </a>
                                            <form id="formDel{{ $item->id }}"
                                                action="{{ url('productos/' . $item->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    
    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>

    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="assets/js/init-scripts/data-table/datatables-init.js"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');

    </script>

@endsection
