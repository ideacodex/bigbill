@extends('layouts.editar')
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
<div class="alert alert-danger">
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
                    <a href="{{ url('productos/create') }}"
                                        class="btn btn-success btn-sm">&nbsp;
                                        Agregar
                                        <i class="fas fa-plus-square"></i>
                                    </a>
                                </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Productos</th>
                                    <th>Descrpcion</th>
                                    <th>Precio </th>
                                    <th>#Compañia </th>
                                    <th>Cant. Stock</th>
                                    <th>Fecha Stock</th>
                                    <th>Cant. Ingreso </th>
                                    <th>Fecha Ingreso</th>
                                    <th>Cant. Egreso</th>
                                    <th>Fecha Egreso</th>
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
                                        <td>{{ $item->company_id }}</td>
                                        <td>{{ $item->quantity_values }}</td>
                                        <td>{{ $item->date_values }}</td>
                                        <td>{{ $item->income_amount }}</td>
                                        <td>{{ $item->date_admission }}</td>
                                        <td>{{ $item->amount_expenses }}</td>
                                        <td>{{ $item->date_discharge }}</td>
                                        <td>
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
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- .animated -->
</div><!-- .content -->


@endsection
