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
                            <strong class="card-title">Cuentas Registradas</strong>
                        </div>
                        @if (Auth::user()->company_id)
                        <div>
                            <button type="button" style="border-radius: 95px;" class="btn btn-success mb-1 ml-2 mt-2"
                                data-toggle="modal" data-target="#largeModal">
                                Agregar Cuenta
                                <i class="fas fa-plus-square"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row table-responsive">
                                <div class="col-12">
                                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Nombre de la cuenta</th>
                                                <th>Estado de cuenta </th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($accounts as $item)
                                                <tr>
                                                    <th>{{ $item->id }}</th>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->account_types->status}}</td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a class="btn btn-sm btn-secondary" href=""
                                                                title="Ver Detalles">
                                                                <span><i class="fas fa-eye"></i></span>
                                                            </a>
                                                            <a class="btn btn-sm btn-primary"
                                                                href="{{ url('cuentas/' . $item->id . '/edit') }}"
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
                                                                action="{{ url('cuentas/' . $item->id) }}" method="POST"
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

                        @else
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">upss!</h4>
                            <p>Bienvenido al sistema de Facturacion <b> TU CONTA</b> </p>
                            <hr>
                            <p class="mb-0">Al parecer aun no cuentas con una compañia, comunicate con tu superior para poderte asignar una compañia y empezar a trabajar</p>
                          </div>
                        @endif
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

    <!--Modal create-->
    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="largeModalLabel">Agregar Cuenta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('cuentas.store') }}" onsubmit="return checkSubmit();">
                        @csrf
                        {{--Nombre de la cuenta--}}
                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                    <i title="Nombre de la cuenta" class="text-dark fas fa-lira-sign"></i>
                                </span>
                            </div>
                            <input id="name" type="text" class="text-dark form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" placeholder="Nombre de la cuenta" required
                                autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{--Company_id--}}
                        <div class="col-12 col-md-6 input-group input-group-lg mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                    <i title="Companía" class="fas fa-calculator"></i>
                                </span>
                            </div>
                            <select name="status_id" id="status_id"
                                class="form-control @error('status_id') is-invalid @enderror" required>

                                @foreach ($account_type as $item)
                                    <option value="{{ $item->id }}">{{ $item->status }}</option>
                                @endforeach
                            </select>
                            @error('status_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            @error('status_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="container mt-4">
                            <div class="col-12">
                                <div class="col text-center">
                                    <button type="submit" style="border-radius: 10px" class="btn btn-lg btn-primary mt-3">
                                        <i class="far fa-save"></i>
                                        {{ __('Guardar') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" style="border-radius: 10px" data-dismiss="modal">Cancelar
                        <i class="fas fa-window-close"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection