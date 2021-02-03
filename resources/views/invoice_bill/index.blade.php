@extends('layouts.Administrador')
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
                    <strong class="card-title">Facturas registradas</strong>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div id="bootstrap-data-table_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="dataTables_length" id="bootstrap-data-table_length">

                        <div>
                            <a href="{{ route('facturas.create') }}" style="border-radius: 95px;"
                                class="btn btn-success btn-sm">&nbsp;
                                Crear Factura
                                <i class=" fas fa-plus-square"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row table-responsive">
        <div class="col-sm-12">
            <table id="bootstrap-data-table" class="table table-striped table-bordered dataTable no-footer" role="grid"
                aria-describedby="bootstrap-data-table_info">

                <thead>
                    <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1"
                            style="width: 322px;" aria-sort="ascending"
                            aria-label="Name: activate to sort column descending">Id</th>
                        <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1"
                            style="width: 509px;" aria-label="Position: activate to sort column ascending">Facturador
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1"
                            style="width: 249px;" aria-label="Office: activate to sort column ascending">Companía</th>
                        <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1"
                            style="width: 249px;" aria-label="Office: activate to sort column ascending">Cliente</th>
                        <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1"
                            style="width: 249px;" aria-label="Office: activate to sort column ascending">Nit</th>
                        <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1"
                            style="width: 197px;" aria-label="Salary: activate to sort column ascending">Total</th>
                        <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1"
                            style="width: 197px;" aria-label="Salary: activate to sort column ascending">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($records as $item)
                        <tr>
                            <th scope="row"> {{ $item->id }}</th>
                            <td>{{ $item->user->name }} {{ $item->user->lastname }}</td>
                            <td>{{ $item->company->name }}</td>
                            @if ($item->customer)
                                <td>{{ $item->customer->name }} {{ $item->customer->lastname }}</td>
                            @else

                                <td>C/F</td>

                            @endif

                            @if ($item->customer)
                                <td>{{ $item->customer->nit }} </td>
                            @else

                                <td>XXXX</td>

                            @endif
                            <td>{{ $item->total }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">

                                    <a class="btn btn-sm btn-primary" href="{{ url('facturas/' . $item->id . '/edit') }}"
                                        title="Enviar correo">
                                        <span><i class="text-light fas fa-paper-plane"></i></span>
                                    </a>

                                    <a class="btn btn-sm btn-secondary" href="{{ url('facturas/' . $item->id) }}"
                                        title="Ver factura">
                                        <span><i class="text-light fas fa-eye"></i></span>
                                    </a>

                                    <a class="btn btn-sm btn-danger" title="Eliminar"
                                        onclick="event.preventDefault();                                                                                                                                                                                                                                 document.getElementById('formDel{{ $item->id }}').submit();">
                                        <span class="text-light"><i class="fas fa-trash-alt"></i></span>
                                    </a>
                                    <form id="formDel{{ $item->id }}" action="{{ url('empresas/' . $item->id) }}"
                                        method="POST" style="display: none;">
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



    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');

    </script>
@endsection
@section('js')
    <!-- Menu Toggle Script -->
    <script>
        $(document).ready(function() {
            $('#tableID').DataTable();
        });

    </script>
@endsection
