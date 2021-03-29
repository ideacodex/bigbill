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

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <button class="nav-link active bg-cardheader" onclick="toggleActive(event)" type="button" data-toggle="collapse"
                data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Tipo de cuentas
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link collapsed bg-cardheader text-light" onclick="toggleActive(event)" type="button" data-toggle="collapse"
                data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Cuentas
            </button>
        </li>
    </ul>

    <div class="accordion" id="accordionExample">
        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body d-flex justify-content-between align-items-center">
                <button type="button" style="border-radius: 95px;" class="btn btn-success mb-1 ml-2 mt-2"
                    data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">
                    + AGREGAR TIPO DE CUENTA
                </button>
            </div>
            <div class="content mt-3">
                <div class="animated fadeIn">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" style="background-color: black; color: white; border-radius: 15px">
                                    <strong class="card-title">Tipos de cuentas</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row table-responsive">
                                        <div class="col-12">
                                            <table id="bootstrap-data-table-export"
                                                class="table table-striped table-bordered">
                                                <thead style="border-radius: 15px; background-color: black; color:white">
                                                    <tr>
                                                        <th>No. </th>
                                                        <th>Tipo de cuenta</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="background-color: rgba(224, 220, 220, 0.993);">
                                                    @foreach ($account_types as $item)
                                                        <tr>
                                                            <th style="border-left: #325ff5 7px solid;"
                                                                title="{{ $loop->index + 1 }}">{{ $loop->index + 1 }}
                                                            </th>
                                                            <td title="{{ $item->status }}">{{ $item->status }}</td>
                                                            <td>
                                                                <div class="btn-group" role="group"
                                                                    aria-label="Basic example">
                                                                    <a title="Actualizar Tipo de Cuenta"
                                                                        class="btn btn-sm btn-primary rounded-circle"
                                                                        href="{{ url('TipodeCuenta/' . $item->id . '/edit') }}"
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

                            </div>
                        </div>
                    </div>
                </div><!-- .animated -->
            </div><!-- .content -->
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body d-flex justify-content-between align-items-center">
                <button type="button" style="border-radius: 95px;" class="btn btn-success mb-1 ml-2 mt-2"
                    data-toggle="modal" data-target="#largeModal">
                    + AGREGAR CUENTA
                </button>
                <a class="btn btn-danger btn-sm mt-2" style="border-radius: 95px;" type="submit"
                    href="{{ route('Account.pdf') }}">REPORTE PDF
                </a>
            </div>
            <div class="content mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header" style="background-color: black; color: white; border-radius: 15px">
                                <strong class="card-title">Cuentas Registradas</strong>
                            </div>
                            <div class="card-body">
                                <div class="row table-responsive">
                                    <div class="col-12">
                                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                            <thead style="border-radius: 15px; background-color: black; color:white">
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Nombre de la cuenta</th>
                                                    <th>Estado de cuenta </th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody style="background-color: rgba(224, 220, 220, 0.993);">
                                                @foreach ($account as $item)
                                                    <tr>
                                                        <th style="border-left: #325ff5 7px solid;"
                                                            title="{{ $loop->index + 1 }}">{{ $loop->index + 1 }}</th>
                                                        <td title="{{ $item->name }}">{{ $item->name }}</td>
                                                        <td title="{{ $item->account_types->status }}">
                                                            {{ $item->account_types->status }}</td>
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                                <a class="btn btn-sm btn-primary rounded-circle"
                                                                    href="{{ url('cuentas/' . $item->id . '/edit') }}"
                                                                    title="Editar Cuenta">
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
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border-radius: 15px">
                <div class="modal-header" style="background-color: black; ">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: white"><b>Nuevo tipo de cuenta</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style="color: red" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-frm">
                    <form method="POST" action="{{ route('TipodeCuenta.store') }}" onsubmit="return checkSubmit();">
                        @csrf
                        <div class="form-group">
                            <input id="status" type="text"
                                style="border-left: #325ff5 7px solid; background-color: rgba(214, 254, 255, 0.993);"
                                class="text-dark form-control @error('status') is-invalid @enderror" name="status"
                                value="{{ old('status') }}" placeholder="Estado financiero" required
                                autocomplete="status" autofocus>
                        </div>

                        <div class="modal-footer">
                            <button style="border-radius: 50px; height: 35px" type="button" class="btn btn-danger mt-3"
                                data-dismiss="modal"><i class="fas fa-times-circle"></i> CERRAR
                            </button>
                            <button type="submit" style="border-radius: 50px; height: 35px" class="btn btn-primary mt-3">
                                <i class="far fa-save"></i>
                                {{ __('GUARDAR') }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Modal create-->
    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="border-radius: 20px">
                <div class="modal-header" style="background-color: black;"">
                        <h5 class=" modal-title" id="largeModalLabel" style="color: white">Agregar Cuenta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: red">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-frm">
                    <form method="POST" action="{{ route('cuentas.store') }}" onsubmit="return checkSubmit();">
                        @csrf
                        {{-- Nombre de la cuenta --}}
                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                            <div class="input-group-prepend">
                                <span style="border-left: #325ff5 7px solid; background-color: rgba(214, 254, 255, 0.993);" class="input-group-text transparent" id="inputGroup-sizing-sm">
                                    <i title="Nombre de la cuenta" class="text-primary fas fa-lira-sign"></i>
                                </span>
                            </div>
                            <input style="background-color: rgba(214, 254, 255, 0.993);"
                                id="name" type="text" class="text-dark form-control @error('name') is-invalid @enderror"
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

                        {{-- Tipos de Cuentas --}}
                        <div class="col-12 col-md-6 input-group input-group-lg mb-4">
                            <div class="input-group-prepend">
                                <span style="border-left: #325ff5 7px solid; background-color: rgba(214, 254, 255, 0.993);" class="input-group-text transparent" id="inputGroup-sizing-sm">
                                    <i title="accounttype" class="text-primary fas fa-calculator"></i>
                                </span>
                            </div>
                            <select style="background-color: rgba(214, 254, 255, 0.993);" class="form-control" class="selectpicker form-control" id="status_id" name="status_id">
                                <option disabled selected>Tipo de cuenta</option>
                                @foreach ($account_type as $item)
                                    <option value="{{ $item->id }}">{{ $item->status }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger mt-3"  style="border-radius: 50px; height: 35px"
                                data-dismiss="modal">CERRAR
                                <i class="fas fa-window-close"></i>
                            </button>
                            <button type="submit"  style="border-radius: 50px; height: 35px" class="btn btn-primary mt-3">
                                <i class="far fa-save"></i>
                                {{ __('GUARDAR') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
