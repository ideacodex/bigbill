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
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Usuarios Registrados</strong>
                        </div>
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <a class="btn btn-danger btn-sm mt-2" style="border-radius: 95px;" type="submit"
                                href="{{ route('User.pdf') }}">Reporte de usuarios <i class="fas fa-file-alt"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row table-responsive">
                                <div class="col-12">
                                    <table id="bootstrap-data-table-export" id="tblData"
                                        class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Role</th>
                                                <th>Nombre</th>
                                                <th>Teléfono</th>
                                                <th>Nit</th>
                                                <th>Dirección</th>
                                                <th>Correo</th>
                                                <th>Companía</th>
                                                <th>Sucursal</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($user as $item)
                                                <tr>
                                                    <th> {{ $loop->index + 1 }}</th>
                                                    @if ($item->role_id == 1)
                                                        <td> <strong>Administrador</strong> </td>
                                                    @else
                                                        @if ($item->role_id == 2)
                                                            <td><strong>Gerente</strong></td>
                                                        @else
                                                            @if ($item->role_id == 3)
                                                                <td><strong>Contador</strong></td>
                                                            @else
                                                                @if ($item->role_id == 4)
                                                                    <td><strong>Ventas</strong></td>
                                                                @else
                                                                    <td><strong>Sin Role</strong></td>
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                    <td>{{ $item->name }} {{ $item->lastname }}</td>
                                                    <td>{{ $item->phone }}</td>
                                                    <td>{{ $item->nit }}</td>
                                                    <td>{{ $item->address }}</td>
                                                    <td>{{ $item->email }}</td>
                                                    @if ($item->company)
                                                        <td>{{ $item->company->name }}</td>
                                                    @else
                                                        <td>Sin companía</td>
                                                    @endif


                                                    @if ($item->branch_id)
                                                        <td>{{ $item->branch_offices->name }}</td>
                                                    @else
                                                        <td>Oficina central</td>
                                                    @endif
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a class="btn btn-sm btn-secondary" href=""
                                                                title="Ver Detalles">
                                                                <span><i class="fas fa-eye"></i></span>
                                                            </a>
                                                            <a class="btn btn-sm btn-primary"
                                                                href="{{ url('UsuariosEmpresa/' . $item->id . '/edit') }}"
                                                                title="Editar">
                                                                <span><i class="fas fa-edit"></i></span>
                                                            </a>
                                                            @if (Auth::user()->id != $item->id)
                                                                <a class="btn btn-sm btn-danger" title="Eliminar"
                                                                    onclick="event.preventDefault();
                                                                                                                                        document.getElementById('formDel{{ $item->id }}').submit();">
                                                                    <span class="text-light"><i
                                                                            class="fas fa-trash-alt"></i></span>
                                                                </a>
                                                                <form id="formDel{{ $item->id }}"
                                                                    action="{{ url('UsuariosEmpresa/' . $item->id) }}"
                                                                    method="POST" style="display: none;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
                                                            @else
                                                            @endif
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
@endsection
