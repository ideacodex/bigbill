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
    @else
        @if (session('MENSAJE'))
            <div class="alert alert-success">
                {{ session('MENSAJE') }}
            </div>
        @endif
    @endif
    <!--Mensaje flash-->

    <!-- boton agregar -->
    <div class="card-body d-flex justify-content-between align-items-center">
        <a href="{{ route('clientes.create') }}" style="border-radius: 95px;"
            class="btn btn-success btn-sm mt-2 ml-3">&nbsp;
            + AGREGAR CLIENTE
        </a>
        <a class="btn btn-danger btn-sm mt-2" style="border-radius: 95px;" type="submit"
            href="{{ route('Customer.pdf') }}">REPORTE PDF
        </a>
    </div>
    <!-- boton agregar -->
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="background-color: black; border-radius: 15px; color: white">
                            <strong class="card-title">Clientes Registrados</strong>
                        </div>
                        <div class="card-body">
                            <div class="row table-responsive">
                                <div class="col-12">
                                    @if (Auth::user()->role_id == 1 || Auth::user()->company_id)
                                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                            <thead style="border-radius: 15px; background-color: black; color:white">
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Nombre</th>
                                                    <th>Apellido</th>
                                                    <th>Teléfono</th>
                                                    <th>Nit</th>
                                                    <th>Companía</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody style="background-color: rgba(224, 220, 220, 0.993); ">
                                                @foreach ($customers as $item)
                                                    <tr>
                                                        <th style="border-left: #325ff5 7px solid;">{{ $loop->index + 1 }}
                                                        </th>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->lastname }}</td>
                                                        <td>{{ $item->phone }}</td>
                                                        <td>{{ $item->nit }}</td>
                                                        <td>{{ $item->company->name }}</td>
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                                <a class="btn btn-sm btn-primary rounded-circle"
                                                                    style="align-items: center;"
                                                                    href="{{ url('clientes/' . $item->id . '/edit') }}"
                                                                    title="Editar">
                                                                    <span><i class="fas fa-edit"></i></span>
                                                                </a>
                                                                @if (Auth::user()->role_id == 1)
                                                                    <a class="btn btn-sm btn-danger rounded-circle"
                                                                        title="Eliminar" style="align-items: center;"
                                                                        onclick="event.preventDefault(); document.getElementById('formDel{{ $item->id }}').submit();">
                                                                        <span class="text-light">
                                                                            <i class="fas fa-trash-alt"></i>
                                                                        </span>
                                                                    </a>
                                                                    <form id="formDel{{ $item->id }}"
                                                                        action="{{ url('clientes/' . $item->id) }}"
                                                                        method="POST" style="display: none;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                    </form>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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
                    </div>
                </div>

            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

@endsection
