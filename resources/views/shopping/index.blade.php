@extends('layouts.'. auth()->user()->getRoleNames()[0])

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
                    <strong class="card-title">Compras registradas</strong>
                </div>
                <div class="card-body d-flex justify-content-between align-items-center">
                    <a href="{{ route('compras.create') }}" style="border-radius: 95px;"
                        class="btn btn-success btn-sm">&nbsp;
                        Registrar compra
                        <i class=" fas fa-plus-square"></i>
                    </a>
                    <a class="btn btn-danger btn-sm mt-2" style="border-radius: 95px;" type="submit"
                        href="{{ route('Factura.pdf') }}">Reporte pdf <i class="fas fa-file-alt"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="row table-responsive">
                        <div class="col-sm-12">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered dataTable no-footer"
                                role="grid" aria-describedby="bootstrap-data-table_info">

                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Registrado por</th>
                                        <th>Companía</th>
                                        <th>Sucursal</th>
                                        <th>Proveedor</th>
                                        <th>Descripción</th>
                                        <th>Total</th>
                                        <th>Tipo de artículo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if ($records)
                                        @foreach ($records as $item)
                                            <tr>
                                                <th scope="row"> {{ $item->id }} </th>
                                                <td>{{ $item->user->name }} {{ $item->user->lastname }}</td>
                                                <td>{{ $item->company->name }}</td>
                                                @if ($item->branch_id != null)
                                                    <td>{{ $item->branch_office->name }}</td>
                                                @else
                                                    <td>Central</td>
                                                @endif
                                                <td>{{ $item->supplier }}</td>
                                                <td>{{ $item->description }}</td>
                                                <td>{{ $item->total }}</td>
                                                @if ($item->type_product == 1)
                                                    <td>Artículo de compra</td>
                                                @elseif($item->type_product == 2)
                                                    <td>Artículo de compra y venta</td>
                                                @endif
                                                <td>
                                                    <a class="btn btn-sm btn-secondary"
                                                        href="{{ url('facturas/' . $item->id) }}" title="Ver factura">
                                                        <span><i class="text-light fas fa-eye"></i></span>
                                                    </a>

                                                    <a class="btn btn-sm btn-danger" title="Eliminar" data-toggle="modal"
                                                        data-target="#largeModal"
                                                        onclick="event.preventDefault(); document.getElementById('formDel{{ $item->id }}').submit();">
                                                        <span class="text-light"><i class="fas fa-trash-alt"></i></span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.js"
        integrity="sha512-UNbeFrHORGTzMn3HTt00fvdojBYHLPxJbLChmtoyDwB6P9hX5mah3kMKm0HHNx/EvSPJt14b+SlD8xhuZ4w9Lg=="
        crossorigin="anonymous"></script>
    <script src="https://unpkg.com/tableexport@5.2.0/dist/js/tableexport.min.js"></script>
    <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
    <script>
        new TableExport(document.getElementsByTagName("table"));
        // OR simply
        /* TableExport(document.getElementsByTagName("table")); */
        // OR using jQuery

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