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
        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
            <span class="badge badge-pill badge-danger">Atención</span>
            {{ session('datosEliminados') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!--Mensaje flash-->


    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Sucursales Registradas</strong>
                        </div>
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <a href="{{ route('sucursales.create') }}" style="border-radius: 95px;"
                                class="btn btn-success btn-sm mt-3 ml-3">&nbsp;
                                Agregar sucursal
                                <i class="fas fa-plus-square"></i>
                            </a>
                            <a class="btn btn-danger btn-sm mt-2" style="border-radius: 95px;" type="submit"
                                href="{{ route('Company.pdf') }}">Reporte pdf <i class="fas fa-file-alt"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row table-responsive">
                                <div class="col-12">
                                    @if (Auth::user()->role_id == 1 || Auth::user()->company_id)

                                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Nombre</th>
                                                    <th>Teléfono</th>
                                                    <th>PBX</th>
                                                    <th>Dirección</th>
                                                    <th>Empresa</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($branch_office as $item)
                                                    <tr>
                                                        @if (Auth::user()->role_id == 1)
                                                            <th>{{ $item->id }}</th>
                                                        @else
                                                            <th> {{ $loop->index + 1 }}</th>
                                                        @endif


                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->phone }}</td>
                                                        <td>{{ $item->pbx }}</td>
                                                        <td>{{ $item->address }}</td>
                                                        <td>{{ $item->company->name }}</td>
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                                <a class="btn btn-sm btn-secondary" href=""
                                                                    title="Ver Detalles">
                                                                    <span><i class="fas fa-eye"></i></span>
                                                                </a>
                                                                <a class="btn btn-sm btn-primary"
                                                                    href="{{ url('sucursales/' . $item->id . '/edit') }}"
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
                                                                    action="{{ url('sucursales/' . $item->id) }}"
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
                                    @else
                                        <div class="alert alert-success" role="alert">
                                            <h4 class="alert-heading">upss!</h4>
                                            <p>Bienvenido al sistema de Facturacion <b> TU CONTA</b> </p>
                                            <hr>
                                            <p class="mb-0">Al parecer aún no cuentas con una companía, comunícate con tu
                                                superior
                                                para poderte asignar una companía y empezar a trabajar.</p>
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
