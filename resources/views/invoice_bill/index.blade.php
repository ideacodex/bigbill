@extends('layouts.editar')
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
                                <a href="{{ route('facturas.create') }}" class="btn btn-success btn-sm">&nbsp;
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
                            style="width: 197px;" aria-label="Salary: activate to sort column ascending">Iva</th>
                        <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1"
                            style="width: 197px;" aria-label="Salary: activate to sort column ascending">Subtotal</th>
                        <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1"
                            style="width: 197px;" aria-label="Salary: activate to sort column ascending">Total</th>
                        <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table" rowspan="1" colspan="1"
                            style="width: 197px;" aria-label="Salary: activate to sort column ascending">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoice_bill as $item)
                        <tr>
                            <th scope="row"> {{ $item->id }}</th>
                            <td>{{ $item->user_id }}</td>
                            <td>{{ $item->company_id }}</td>
                            <td>{{ $item->iva }}</td>
                            <td>{{ $item->subtotal }}</td>
                            <td>{{ $item->total }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a class="btn btn-sm btn-secondary" href="" title="Ver Detalles">
                                        <span><i class="fas fa-eye"></i></span>
                                    </a>
                                    <a class="btn btn-sm btn-primary" href="{{ url('empresas/' . $item->id . '/edit') }}"
                                        title="Editar">
                                        <span><i class="fas fa-edit"></i></span>
                                    </a>
                                    <a class="btn btn-sm btn-danger" title="Eliminar"
                                        onclick="event.preventDefault();
                                                                                                                                                                                                            document.getElementById('formDel{{ $item->id }}').submit();">
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
    <div class="row">
        <div class="col-sm-12 col-md-5">
            <div class="dataTables_info" id="bootstrap-data-table_info" role="status" aria-live="polite">Tabla de
                elementos
            </div>
        </div>
        <div class="col-sm-12 col-md-7">
            <div class="dataTables_paginate paging_simple_numbers" id="bootstrap-data-table_paginate">
                <ul class="pagination">
                    <li class="paginate_button page-item previous disabled" id="bootstrap-data-table_previous">
                        <a href="#" aria-controls="bootstrap-data-table" data-dt-idx="0" tabindex="0"
                            class="page-link">Previous</a>
                    </li>
                    <li class="paginate_button page-item active">
                        <a href="#" aria-controls="bootstrap-data-table" data-dt-idx="1" tabindex="0"
                            class="page-link">1</a>
                    </li>
                    <li class="paginate_button page-item ">
                        <a href="#" aria-controls="bootstrap-data-table" data-dt-idx="2" tabindex="0"
                            class="page-link">2</a>
                    </li>
                    <li class="paginate_button page-item ">
                        <a href="#" aria-controls="bootstrap-data-table" data-dt-idx="3" tabindex="0"
                            class="page-link">3</a>
                    </li>
                    <li class="paginate_button page-item ">
                        <a href="#" aria-controls="bootstrap-data-table" data-dt-idx="4" tabindex="0"
                            class="page-link">4</a>
                    </li>
                    <li class="paginate_button page-item ">
                        <a href="#" aria-controls="bootstrap-data-table" data-dt-idx="5" tabindex="0"
                            class="page-link">5</a>
                    </li>
                    <li class="paginate_button page-item ">
                        <a href="#" aria-controls="bootstrap-data-table" data-dt-idx="6" tabindex="0"
                            class="page-link">6</a>
                    </li>
                    <li class="paginate_button page-item next" id="bootstrap-data-table_next">
                        <a href="#" aria-controls="bootstrap-data-table" data-dt-idx="7" tabindex="0"
                            class="page-link">Next</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
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
