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
    <!--Mensaje flash-->
    @if (session('datosEliminados'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            <span class="badge badge-pill badge-success">Atención</span>
            {{ session('datosEliminados') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    <div class="card-body d-flex justify-content-between align-items-center">
        <a href="{{ url('productos/create') }}" style="border-radius: 95px;" class="btn btn-success btn-sm">&nbsp;
            + AGREGAR PRODUCTO
        </a>

        <a class="btn btn-danger btn-sm mt-2" style="border-radius: 95px;" type="submit"
            href="{{ route('Product.pdf') }}">REPORTE PDF
        </a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: black; border-radius: 15px; color: white">
                    <strong class="card-title">Productos Registrados</strong>
                </div>
                <div class="card-body">
                    <div id="bootstrap-data-table_wrapper"
                        class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_length" id="bootstrap-data-table_length">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if (Auth::user()->role_id == 1 || Auth::user()->company_id)
                    <div class="card-body">
                        <div class="row table-responsive">
                            <div class="col-sm-12">
                                <table id="bootstrap-data-table"
                                    class="table table-striped table-bordered dataTable no-footer" role="grid"
                                    aria-describedby="bootstrap-data-table_info">
                                    <thead style="border-radius: 15px; background-color: black; color:white">
                                        <tr>
                                            @if (Auth::user()->role_id == 1)
                                                <th>Id</th>
                                            @else
                                                <th>#</th>
                                            @endif

                                            <th>Productos</th>
                                            <th>Descripción</th>
                                            <th>Precio </th>
                                            <th>Stock</th>
                                            <th>Ingresos totales </th>
                                            <th>Egreso</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>

                                    <tbody style="background-color: rgba(224, 220, 220, 0.993); ">
                                        @foreach ($products as $item)
                                            <tr>
                                                @if (Auth::user()->role_id == 1)

                                                    <th style="border-left: #325ff5 7px solid;">{{ $item->id }}</th>
                                                @else
                                                    <th style="border-left: #325ff5 7px solid;"> {{ $loop->index + 1 }}
                                                    </th>
                                                @endif
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->description }}</td>
                                                <td>{{ $item->price }}</td>

                                                @if ($item->stock == 0)
                                                    <td><i class="text-danger fas fa-times-circle"></i></td>
                                                @else
                                                    <td>{{ $item->stock }}</td>
                                                @endif

                                                <td>{{ $item->total_revenue }}</td>
                                                <td>{{ $item->amount_expenses }}</td>

                                                @if ($item->active == 1)
                                                    <td>Disponible <i class="text-success fas fa-check-circle"></i></td>
                                                @elseif ($item->active == 0)
                                                    <td>Agotado <i class="text-danger fas fa-times-circle"></i></td>
                                                @endif

                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic example">

                                                        <a href="{{ url('productos/' . $item->id) }}"
                                                            class="btn btn-sm rounded-circle"
                                                            style="background-color: #f55d00" title="Ver Detalles">
                                                            <span><i class="text-light fas fa-eye"></i></span>
                                                        </a>
                                                        <a class="btn btn-sm btn-primary rounded-circle"
                                                            href="{{ url('productos/' . $item->id . '/edit') }}"
                                                            title="Editar">
                                                            <span><i class="fas fa-edit"></i></span>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">upss!</h4>
                        <p>Bienvenido al sistema de Facturacion <b> TU CONTA</b> </p>
                        <hr>
                        <p class="mb-0">Al parecer aun no cuentas con una compañia, comunicate con
                            tu
                            superior
                            para poderte asignar una compañia y empezar a trabajar</p>
                    </div>

                @endif
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
