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

    <div class="card-body d-flex justify-content-between align-items-center">
        <a href="{{ route('sucursales.create') }}" style="border-radius: 95px;"
            class="btn btn-success btn-sm mt-3 ml-3">&nbsp;
            AGREGAR SUCURSAL
            <i class="fas fa-plus-square"></i>
        </a>
        <a class="btn btn-danger btn-sm mt-2" style="border-radius: 95px;" type="submit"
            href="{{ route('Company.pdf') }}">REPORTE PDF <i class="fas fa-file-alt"></i>
        </a>
    </div>
    <div class="content mt-5">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="background-color: black; border-radius: 15px; color: white">
                            <strong class="card-title">Sucursales Registradas</strong>
                        </div>
                        <div class="card-body">
                            <div class="row table-responsive">
                                <div class="col-12">
                                    @if (Auth::user()->role_id == 1 || Auth::user()->company_id)

                                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                            <thead style="border-radius: 15px; background-color: black; color:white">
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
                                            <tbody style="background-color: rgba(224, 220, 220, 0.993); ">
                                                @foreach ($branch_office as $item)
                                                    <tr>
                                                        @if (Auth::user()->role_id == 1)
                                                            <th style="border-left: #325ff5 7px solid;">{{ $item->id }}
                                                            </th>
                                                        @else
                                                            <th style="border-left: #325ff5 7px solid;">
                                                                {{ $loop->index + 1 }}</th>
                                                        @endif


                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->phone }}</td>
                                                        <td>{{ $item->pbx }}</td>
                                                        <td>{{ $item->address }}</td>
                                                        <td>{{ $item->company->name }}</td>
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                                <a class="btn btn-sm rounded-circle text-light"
                                                                    href="{{ url('sucursales/' . $item->id) }}"
                                                                    style="background-color: #f55d00;" title="Ver Detalles">
                                                                    <span><i class="fas fa-eye"></i></span>
                                                                </a>


                                                                <a class="btn btn-sm btn-primary rounded-circle"
                                                                    href="{{ url('sucursales/' . $item->id . '/edit') }}"
                                                                    title="Editar">
                                                                    <span><i class="fas fa-edit"></i></span>
                                                                </a>
                                                                <a class="btn btn-sm btn-danger rounded-circle"
                                                                    title="Eliminar"
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
            <img class="derecha" src="{{ asset('images/ideacode.png') }}">
        </div><!-- .animated -->
    </div><!-- .content -->
@endsection
