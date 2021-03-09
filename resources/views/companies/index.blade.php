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
        <a href="{{ route('empresas.create') }}" style="border-radius: 95px;"
            class="btn btn-success btn-sm mt-3 ml-3">&nbsp;
            + AGREGAR COMPANÍA
        </a>
        <a class="btn btn-danger btn-sm mt-2" style="border-radius: 95px;" type="submit"
            href="{{ route('Company.pdf') }}">REPORTE PDF
        </a>
    </div>

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="background-color: black; color: white; border-radius: 15px">
                            <strong class="card-title">Companías Registradas</strong>
                        </div>
                        <div class="card-body">
                            <div class="row table-responsive">
                                <div class="col-12">
                                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                        <thead style="border-radius: 15px; background-color: black; color:white">
                                            <tr>
                                                <th>No.</th>
                                                <th>Nombre</th>
                                                <th>Nit</th>
                                                <th>Teléfono</th>
                                                <th>Dirección</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody style="background-color: rgba(224, 220, 220, 0.993);">
                                            @foreach ($companies as $item)
                                                <tr>
                                                    <th style="border-left: #325ff5 7px solid;"
                                                        title="{{ $loop->index + 1 }}">{{ $loop->index + 1 }}</th>
                                                    <td title="{{ $item->name }}">{{ $item->name }}</td>
                                                    <td title="{{ $item->nit }}">{{ $item->nit }}</td>
                                                    <td title="{{ $item->phone }}">{{ $item->phone }}</td>
                                                    <td title="{{ $item->address }}">{{ $item->address }}</td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a class="btn btn-sm rounded-circle text-light"
                                                                href="{{ url('empresas/' . $item->id) }}"
                                                                style="background-color: #f55d00;"
                                                                title="Ver Detalles De {{ $item->name }}">
                                                                <span><i class="fas fa-eye text-light"></i></span>
                                                            </a>
                                                            <a class="btn btn-sm btn-primary rounded-circle"
                                                                href="{{ url('empresas/' . $item->id . '/edit') }}"
                                                                title="Editar {{ $item->name }}">
                                                                <span><i class="fas fa-edit"></i></span>
                                                            </a>
                                                            <a class="btn btn-sm btn-danger rounded-circle"
                                                                title="Eliminar {{ $item->name }}"
                                                                onclick="event.preventDefault();
                                                                                                                                                                                                                    document.getElementById('formDel{{ $item->id }}').submit();">
                                                                <span class="text-light"><i
                                                                        class="fas fa-trash-alt"></i></span>
                                                            </a>
                                                            <form id="formDel{{ $item->id }}"
                                                                action="{{ url('empresas/' . $item->id) }}" method="POST"
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
            <img class="derecha" src="{{ asset('images/ideacode.png') }}">
        </div><!-- .animated -->
    </div><!-- .content -->
@endsection
