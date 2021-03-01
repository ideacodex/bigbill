@extends('layouts.'. auth()->user()->getRoleNames()[0])
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

    <div class="content mt-3">
        <div class="animated fadeIn">
            @if (Auth::user()->company_id || Auth::user()->role_id ==1 )
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                @if (Auth::user()->company_id )
                                <strong class="card-title">Usuarios de {{ Auth::user()->company->name }} </strong>
                                @endif
                            </div>

                            <div class="card-body">
                                <div class="row table-responsive">
                                    <div class="col-12">
                                        <table id="bootstrap-data-table-export" id="tblData"
                                            class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>id</th>
                                                    <th>Role</th>
                                                    <th>Nombre</th>
                                                    <th>Teléfono</th>
                                                    <th>Nit</th>
                                                    <th>Dirección</th>
                                                    <th>Correo</th>
                                                    <th>Sucursal</th>
                                                    <th>Despedir</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($user as $item)
                                                    <tr>
                                                        <th>{{ $item->id }}</th>
                                                        <td>{{ $item->role_id }}</td>
                                                        <td>{{ $item->name }} {{ $item->lastname }}</td>
                                                        <td>{{ $item->phone }}</td>
                                                        <td>{{ $item->nit }}</td>
                                                        <td>{{ $item->address }}</td>
                                                        <td>{{ $item->email }}</td>
                                                        @if ($item->branch_office)
                                                            <td>{{ $item->branch_office->name }}</td>
                                                        @else
                                                            <td>Oficina central</td>
                                                        @endif
                                                        <td>
                                                            @if (Auth::user()->id != $item->id)
                                                                <a class="btn btn-sm btn-primary"
                                                                    href="{{ url('Personal/' . $item->id ) }}"
                                                                    title="Eliminar Empleado">
                                                                    <span class="text-light"><i class="fas fa-trash-alt"></i></span>
                                                                </a>

                                                            @endif
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

        </div><!-- .animated -->
    </div><!-- .content -->
@endsection
