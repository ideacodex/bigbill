@extends('layouts.Administrador')
@section('content')
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
        <div class="alert alert-success">
            {{ session('datosEliminados') }}
        </div>
    @endif
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Productos Registrados</strong>
                        </div>
                        <div>
                            <a href="{{ url('productos/create') }}" style="border-radius: 95px;"
                                class="btn btn-success btn-sm mt-3 ml-3">&nbsp;
                                Agregar Producto
                                <i class="fas fa-plus-square"></i>
                            </a>
                            <a href="{{ url('/doc') }}" style="border-radius: 95px;" class="btn btn-info btn-sm mt-3"><i
                                    class="fas fa-file-excel"></i>&nbsp;
                                Excel
                            </a>
                            <p class="ml-3 mt-3"></i><a class="btn btn-danger fas fa-file-pdf"
                                    style="border-radius: 95px;" href="{{ route('products.pdf') }}"> PDF</a></p>
                        </div>
                        <div class="card-body">
                            <div class="row table-responsive">
                                <div class="col-12">
                                    <table id="bootstrap-data-table-export" id="tblData"
                                        class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Productos</th>
                                                <th>Descripción</th>
                                                <th>Precio </th>
                                                <th>Cant. Stock</th>
                                                <th>Cant. Ingreso </th>
                                                <th>Cant. Egreso</th>
                                                <th>Fecha Transacción</th>
                                                <th>Acciones</th>
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
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a class="btn btn-sm btn-secondary" href=""
                                                                title="Ver Detalles">
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
                                                                <span class="text-light"><i
                                                                        class="fas fa-trash-alt"></i></span>
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

            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

@endsection
