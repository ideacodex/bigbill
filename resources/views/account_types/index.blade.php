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
                            <strong class="card-title">Estados financieros</strong>
                        </div>
{{--                         @if (Auth::user()->company_id) --}}
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <button type="button" style="border-radius: 95px;" class="btn btn-success mb-1 ml-2 mt-2"
                                    data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">
                                    Agregar tipo de cuenta
                                    <i class="fas fa-plus-square"></i>
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="row table-responsive">
                                    <div class="col-12">


                                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tipo de cuenta</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($account_types as $item)
                                                    <tr>
                                                        <th>{{ $loop->index + 1 }}</th>
                                                        <td>{{ $item->status }}</td>
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
                                                                    action="{{ url('cuentas/' . $item->id) }}"
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

                                    </div>
                                </div>
                            </div>
                      {{--   @else
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">upss!</h4>
                                <p>Bienvenido al sistema de Facturacion <b> TU CONTA</b> </p>
                                <hr>
                                <p class="mb-0">Al parecer aun no cuentas con una compañia, comunicate con tu superior para
                                    poderte asignar una compañia y empezar a trabajar</p>
                            </div>
                        @endif --}}
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo estado financiero</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('TipodeCuenta.store') }}" onsubmit="return checkSubmit();">
                        @csrf
                        <div class="form-group">
                            <input id="status" type="text"
                                class="text-dark form-control @error('status') is-invalid @enderror" name="status"
                                value="{{ old('status') }}" placeholder="Estado financiero" required
                                autocomplete="status" autofocus>
                        </div>
                        {{-- company_id --}}
                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                            <input id="company_id" placeholder="company_id" type="hidden"
                                class="text-dark form-control @error('company_id') is-invalid @enderror" name="company_id"
                                value="{{ Auth::user()->company_id }}" required autocomplete="company_id" autofocus>

                            @error('company_id')
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
                    <button style="border-radius: 20%" type="button" class="btn btn-danger" data-dismiss="modal"><i
                            class="fas fa-times-circle"></i> Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection
