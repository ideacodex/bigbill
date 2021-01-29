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
                            style="width: 197px;" aria-label="Salary: activate to sort column ascending">Iva</th>
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
                            <td>{{ $item->user->name }} {{ $item->user->lastname }}</td>
                            <td>{{ $item->company->name }}</td>
                            @if ($item->customer)
                                <td>{{ $item->customer->name }} {{ $item->customer->lastname }}</td>
                            @else
                                {
                                <td>C/F</td>
                                }
                            @endif

                            @if ($item->customer)
                                <td>{{ $item->customer->nit }} </td>
                            @else
                                {
                                <td>XXXX</td>
                                }
                            @endif
                            <td>{{ $item->iva }}</td>
                            <td>{{ $item->total }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a class="btn btn-sm btn-primary" title="FACTURA" data-toggle="modal"
                                        data-target="#Email">
                                        <span><i class="fas fa-print"></i></span>
                                    </a>
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



    <!-- Modal para agregar clientes -->
    <div class="modal fade" id="Email" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="largeModalLabel">Correo Electronico </h5>
                    <a href="{{ url('facturas/' . $item->id . '/edit') }}">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </a>
                </div>
                <div class="modal-body">
                    {{--Email--}}
                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                <i title="Correo electrónico" class="text-dark fas fa-at"></i>
                            </span>
                        </div>
                        <input id="email" placeholder="Correo electrónico" type="text"
                            class="text-dark form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <a href="{{ url('facturas/' . $item->id . '/edit') }}">
                 
                    <div class="container mt-4">
                        <div class="col-12">
                            <div class="col text-center">
                                <button type="submit" style="border-radius: 10px" class="btn btn-lg btn-danger mt-3">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    {{ __('Guardar') }}
                                </button>
                            </div>
                        </div>
                    </div>
                   
                </a>
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
