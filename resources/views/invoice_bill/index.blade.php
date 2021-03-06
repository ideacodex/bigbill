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

    <div class="card-body d-flex justify-content-between align-items-center">
        <a href="{{ route('facturas.create') }}" style="border-radius: 95px;" class="btn btn-success btn-sm">&nbsp;
            + REGISTRAR VENTA
        </a>
        <a class="btn btn-danger btn-sm mt-2" style="border-radius: 95px;" type="submit"
            href="{{ route('Factura.pdf') }}">REPORTE PDF
        </a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: black; border-radius: 15px">
                    <strong style="color: white" class="card-title">Ventas registradas</strong>
                </div>
                <div class="card-body">
                    <div class="row table-responsive">
                        <div class="col-sm-12">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered dataTable no-footer"
                                role="grid" aria-describedby="bootstrap-data-table_info">

                                <thead style="border-radius: 15px; background-color: black; color:white">
                                    <tr>
                                        <th>No</th>
                                        <th>Encargado de venta</th>
                                        <th>Companía</th>
                                        <th>Sucursal</th>
                                        <th>Cliente</th>
                                        <th>Nit</th>
                                        <th>Descripción</th>
                                        <th>Total</th>
                                        <th>Tipo de venta</th>
                                        <th>Actividad</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>

                                <tbody style="background-color: rgba(224, 220, 220, 0.993);">
                                    @if ($records)
                                        @foreach ($records as $item)
                                            <tr>
                                                <th style="border-left: #325ff5 7px solid;" scope="row">
                                                    {{ $loop->index + 1 }} </th>
                                                <td>{{ $item->user->name }} {{ $item->user->lastname }}
                                                </td>
                                                <td>{{ $item->company->name }}</td>

                                                @if ($item->branch_office)
                                                    <td>{{ $item->branch_office->name }}</td>
                                                @else
                                                    <td>Central</td>
                                                @endif

                                                @if ($item->customer)
                                                    <td>{{ $item->customer->name }}
                                                        {{ $item->customer->lastname }}
                                                    </td>
                                                @else
                                                    <td>{{ $item->customer_name }}</td>
                                                @endif
                                                @if ($item->customer)
                                                    <td>{{ $item->customer->nit }} </td>
                                                @else
                                                    <td>C/F</td>
                                                @endif

                                                <td>{{ $item->description }}</td>

                                                <td>{{ $item->total }}</td>

                                                @if ($item->invoice_type == 1)
                                                    <td>Venta con iva</td>
                                                @elseif($item->invoice_type == 0)
                                                    <td>Venta sin iva</td>
                                                @endif

                                                @if ($item->active == 0)
                                                    <td class="text-danger"><b>Venta cancelada</b></td>
                                                @elseif($item->active == 1)
                                                    <td class="text-success"><b>Venta emitida</b></td>
                                                @endif

                                                @if ($item->document_type == 1)
                                                    <td>
                                                        <h6 class="text-primary"
                                                            style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif">
                                                            <b>Factura</b>
                                                        </h6>
                                                    </td>
                                                @elseif($item->document_type == 0)
                                                    <td>
                                                        <h6 class="text-danger"
                                                            style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif">
                                                            <b>Cotización</b>
                                                        </h6>
                                                    </td>
                                                @endif

                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        @if ($item->customer_id)
                                                            <a class="btn btn-sm btn-warning rounded-circle"
                                                                href="{{ url('facturas/' . $item->id . '/edit') }}"
                                                                title="Enviar correo">
                                                                <span><i class="text-light fas fa-paper-plane"></i></span>
                                                            </a>
                                                        @elseif($item->customer_email)
                                                            <a class="btn btn-sm btn-warning rounded-circle"
                                                                href="{{ url('facturas/' . $item->id . '/edit') }}"
                                                                title="Enviar correo">
                                                                <span><i class="text-light fas fa-paper-plane"></i></span>
                                                            </a>
                                                        @endif

                                                        <a class="btn btn-sm rounded-circle"
                                                            href="{{ url('facturas/' . $item->id) }}" title="Ver factura"
                                                            style="background-color: #f55d00">
                                                            <span><i class="text-light fas fa-eye"></i></span>
                                                        </a>

                                                        @if ($item->active == 1)
                                                            <a class="btn btn-sm btn-danger rounded-circle" title="Eliminar"
                                                                data-toggle="modal"
                                                                data-target="#largeModal{{ $item->id }}"
                                                                onclick="event.preventDefault(); document.getElementById('formDel{{ $item->id }}').submit();">
                                                                <span class="text-light"><i
                                                                        class="fas fa-trash-alt"></i></span>
                                                            </a>
                                                            @if ($item->document_type == 0)
                                                                <a class="btn btn-sm btn-info rounded-circle"
                                                                    title="Facturar"
                                                                    href="{{ url('editar', $item->id) }}">
                                                                    <span><i class="text-light fas fa-edit"></i></span>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </div>  
                                                </td>
                                            </tr>
                                            <!--Modal-->
                                            <div class="modal fade" id="largeModal{{ $item->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="largeModal{{ $item->id }}Label"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content bg-card">
                                                        <div class="modal-header bg-cardheader">
                                                            <h5 class="modal-title text-light"
                                                                id="largeModal{{ $item->id }}Label">
                                                                <b>Atención</b>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span class="text-danger" aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body bg-frm">
                                                            <div class="alert alert-danger">
                                                                <h4>¿Desea cancelar la venta?
                                                                </h4>
                                                            </div>
                                                            <form id="formDel"
                                                                action="{{ url('facturas/' . $item->id) }}" method="POST"
                                                                style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="modal-footer">
                                                                    <input type="text">
                                                                    <button type="button" style="border-radius: 50px"
                                                                        class="btn btn-secondary"
                                                                        data-dismiss="modal">Cancelar</button>
                                                                    <button id="{{ $item->id }}"
                                                                        style="border-radius: 50px" type="submit"
                                                                        class="btn btn-danger">Confirmar</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Modal-->
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
