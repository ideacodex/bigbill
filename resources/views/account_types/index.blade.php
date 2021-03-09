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
        <button type="button" style="border-radius: 95px;" class="btn btn-success mb-1 ml-2 mt-2" data-toggle="modal"
            data-target="#exampleModal" data-whatever="@mdo">
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
                                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
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
                                                    title="{{ $loop->index + 1 }}">{{ $loop->index + 1 }}</th>
                                                <td title="{{ $item->status }}">{{ $item->status }}</td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic example">
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
        <img class="derecha" src="{{ asset('images/ideacode.png') }}">
    </div><!-- .content -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border-radius: 15px" >
                <div class="modal-header" style="background-color: black; ">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: white"><b>Nuevo tipo de cuenta</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style="color: red" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-frm" >
                    <form method="POST" action="{{ route('TipodeCuenta.store') }}" onsubmit="return checkSubmit();">
                        @csrf
                        <div class="form-group">
                            <input id="status" type="text" style="border-left: #325ff5 7px solid; background-color: rgba(214, 254, 255, 0.993);"
                                class="text-dark form-control @error('status') is-invalid @enderror" name="status"
                                value="{{ old('status') }}" placeholder="Estado financiero" required autocomplete="status"
                                autofocus>
                        </div>

                        <div class="modal-footer">
                            <button style="border-radius: 50px; height: 35px" type="button" class="btn btn-danger mt-3" data-dismiss="modal"><i
                                    class="fas fa-times-circle"></i> CERRAR
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

@endsection
