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
                                <table id="bootstrap-data-table"
                                    class="table table-striped table-bordered dataTable no-footer" role="grid"
                                    aria-describedby="bootstrap-data-table_info">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Cargo</th>
                                            <th>Nombre</th>
                                            <th>Teléfono</th>
                                            <th>Nit</th>
                                            <th>Dirección</th>
                                            <th>Correo</th>
                                            <th>Companía</th>
                                            <th>Sucursal</th>
                                            <th>Pago</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user as $item)
                                            <tr>
                                                <th> {{ $loop->index + 1 }} </th>
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

                                                @if ($item->suscriptions)
                                                    @if ($item->suscriptions->active == 0)
                                                        <td>
                                                            <a class="btn btn-sm btn-danger" title="Suscripción inactiva"
                                                                data-toggle="modal"
                                                                data-target="#largeModalUser{{ $item->id }}">
                                                                <span class="text-light"> <i title="Suscripción inactiva"
                                                                        class="text-light fas fa-window-close"></i></span>
                                                            </a>
                                                        </td>
                                                    @elseif($item->suscriptions->active == 1)
                                                        <td>
                                                            <a class="btn btn-sm btn-success" title="Suscripción activa"
                                                                data-toggle="modal"
                                                                data-target="#largeModalUser{{ $item->id }}"
                                                                {{-- onclick="event.preventDefault(); document.getElementById('formDel{{ $item->id }}').submit();" --}}>
                                                                <span class="text-light"> <i title="Suscripción activa"
                                                                        class="text-light fas fa-check-circle"></i></span>
                                                            </a>
                                                        </td>
                                                    @endif
                                                @endif
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a class="btn btn-sm btn-secondary" href="" title="Ver Detalles">
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

                                            <!-- Modal para registrar pagos -->
                                            <div class="modal fade" id="largeModalUser{{ $item->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="largeModalUser{{ $item->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="largeModalLabel">Gestión de pagos
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="{{ route('pago.store') }}"
                                                                onsubmit="return checkSubmit();">
                                                                @csrf
                                                                <input type="hidden" name="user_id"
                                                                    value="{{ $item->id }}">

                                                                {{-- Suscription_id --}}
                                                                <div>
                                                                    <input id="suscription_id" type="hidden"
                                                                        class="text-dark form-control @error('suscription_id') is-invalid @enderror"
                                                                        name="suscription_id"
                                                                        value="{{ $item->suscriptions->id }}"
                                                                        placeholder="Suscripción" required
                                                                        autocomplete="suscription_id" autofocus>
                                                                </div>

                                                                {{-- Monto --}}
                                                                <div
                                                                    class="col-12 col-md-6 input-group input-group-lg mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text transparent"
                                                                            id="inputGroup-sizing-sm">
                                                                            <i title="Monto"
                                                                                class="text-dark fas fa-money-bill-wave-alt"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input id="amount" placeholder="Monto" type="number"
                                                                        class="text-dark form-control @error('amount') is-invalid @enderror"
                                                                        name="amount" value="{{ old('amount') }}"
                                                                        required autocomplete="amount" autofocus>

                                                                    @error('amount')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror

                                                                    @error('amount')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>

                                                                {{-- Cantidad de meses a pagar --}}
                                                                <div
                                                                    class="col-12 col-md-6 input-group input-group-lg mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text transparent"
                                                                            id="inputGroup-sizing-sm">
                                                                            <i title="Tiempo de suscripción"
                                                                                class="text-dark fas fa-clock"></i>
                                                                        </span>
                                                                    </div>
                                                                    <select name="suscription_time" id="suscription_time"
                                                                        class="form-control @error('suscription_time') is-invalid @enderror"
                                                                        required>
                                                                        <option selected disabled>Tiempo de suscripción
                                                                        </option>
                                                                        <option value="1">1 mes</option>
                                                                        <option value="2">2 meses</option>
                                                                        <option value="3">3 meses</option>
                                                                        <option value="4">4 meses</option>
                                                                        <option value="5">5 meses</option>
                                                                        <option value="6">6 meses</option>
                                                                        <option value="7">7 meses</option>
                                                                        <option value="8">8 meses</option>
                                                                        <option value="9">9 meses</option>
                                                                        <option value="10">10 meses</option>
                                                                        <option value="11">11 meses</option>
                                                                        <option value="12">1 año</option>
                                                                    </select>

                                                                    @error('suscription_time')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror

                                                                    @error('suscription_time')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>

                                                                {{-- Plan a pagar --}}
                                                                <div
                                                                    class="col-12 col-md-6 input-group input-group-lg mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text transparent"
                                                                            id="inputGroup-sizing-sm">
                                                                            <i title="Tiempo de suscripción"
                                                                                class="text-dark fas fa-gem"></i>
                                                                        </span>
                                                                    </div>
                                                                    <select name="type_plan" id="type_plan"
                                                                        class="form-control @error('type_plan') is-invalid @enderror"
                                                                        required>
                                                                        <option selected disabled>Plan a contratar
                                                                        </option>
                                                                        <option value="0">Básico</option>
                                                                        <option value="1">Avanzado</option>
                                                                    </select>

                                                                    @error('type_plan')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror

                                                                    @error('type_plan')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>

                                                                {{-- Comentarios --}}
                                                                <textarea class="form-control" rows="5" id="comments"
                                                                    placeholder="Comentarios" name="comments"></textarea>

                                                                <div class="container mt-4">
                                                                    <div class="col-12">
                                                                        <div class="col text-center">
                                                                            <button type="submit"
                                                                                style="border-radius: 10px"
                                                                                class="btn btn-lg btn-primary mt-3">
                                                                                <i class="far fa-save"></i>
                                                                                {{ __('Guardar') }}
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" style="border-radius: 10px"
                                                                class="btn btn-danger" data-dismiss="modal"><i
                                                                    class="fas fa-times-circle"></i> Cerrar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal para registrar pagos -->
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
@endsection
