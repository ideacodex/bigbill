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

    <div class="card-body d-flex justify-content-between align-items-center">
        <a class="btn btn-danger btn-sm mt-2" style="border-radius: 95px;" type="submit"
            href="{{ route('Todos-los-Usuarios.pdf') }}">REPORTE PDF
        </a>
    </div>
    <div class="content mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="border-radius: 15px">
                    <div class="card-header" style="background-color: black; border-radius: 15px">
                        <strong style="color: white" class="card-title">Usuarios Registrados</strong>
                    </div>
                    <div class="card-body">
                        <div class="row table-responsive">
                            <div class="col-12">
                                <table id="bootstrap-data-table"
                                    class="table table-striped table-bordered dataTable no-footer" role="grid"
                                    aria-describedby="bootstrap-data-table_info">
                                    <thead style="border-radius: 15px; background-color: black; color:white">
                                        <tr style="border-radius: 15px">
                                            <th>No. </th>
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
                                    <tbody class="mt-2" style="background-color: rgba(224, 220, 220, 0.993); ">
                                        @foreach ($user as $item)
                                            <tr class="mt-2">
                                                <th style="border-left: #325ff5 7px solid;"> {{ $loop->index + 1 }} </th>
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
                                                            <a class="btn btn-sm btn-danger rounded-circle"
                                                                title="Suscripción inactiva" data-toggle="modal"
                                                                data-target="#largeModalUser{{ $item->id }}">
                                                                <span class="text-light"> <i title="Suscripción inactiva"
                                                                        class="text-light fas fa-window-close"></i></span>
                                                            </a>
                                                        </td>
                                                    @elseif($item->suscriptions->active == 1)
                                                        <td>
                                                            <a class="btn btn-sm btn-success rounded-circle"
                                                                title="Suscripción activa" data-toggle="modal"
                                                                data-target="#largeModalUser{{ $item->id }}"
                                                                {{-- onclick="event.preventDefault(); document.getElementById('formDel{{ $item->id }}').submit();" --}}>
                                                                <span class="text-light"> <i title="Suscripción activa"
                                                                        class="text-light fas fa-check-circle"></i></span>
                                                            </a>
                                                        </td>
                                                    @endif
                                                @endif
                                                <td style="border-bottom-right-radius: 15px">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a class="btn btn-sm rounded-circle"
                                                            style="background-color: #f55d00;" href="" title="Ver Detalles">
                                                            <span><i class="fas fa-eye text-light"></i></span>
                                                        </a>
                                                        <a class="btn btn-sm btn-primary rounded-circle"
                                                            href="{{ url('UsuariosEmpresa/' . $item->id . '/edit') }}"
                                                            title="Editar">
                                                            <span><i class="fas fa-edit"></i></span>
                                                        </a>
                                                        {{-- @if (Auth::user()->id != $item->id)
                                                            <a class="btn btn-sm btn-danger rounded-circle" title="Eliminar"
                                                                onclick="event.preventDefault();                                                                                                                                                                                                                                                                                                                                                     document.getElementById('formDel{{ $item->id }}').submit();">
                                                                <span class="text-light"><i
                                                                        class="fas fa-trash-alt"></i></span>
                                                            </a>
                                                            <form id="formDel{{ $item->id }}"
                                                                action="{{ url('UsuariosEmpresa/' . $item->id) }}"
                                                                method="POST" style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        @endif --}}
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Modal para registrar pagos -->
                                            <div class="modal fade" id="largeModalUser{{ $item->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="largeModalUser{{ $item->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content bg-card">
                                                        <div class="modal-header bg-cardheader">
                                                            <h5 class="modal-title text-light" id="largeModalLabel">
                                                                <b>Gestión de pagos</b>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true" class="text-danger">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body bg-frm">
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
                                                                        <span
                                                                            class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                                            id="inputGroup-sizing-sm">
                                                                            <i title="Monto"
                                                                                class="text-primary fas fa-money-bill-wave-alt"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input id="amount" placeholder="Monto" type="number"
                                                                        class="text-dark form-control border-0 bg-input @error('amount') is-invalid @enderror"
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
                                                                        <span
                                                                            class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                                            id="inputGroup-sizing-sm">
                                                                            <i title="Tiempo de suscripción"
                                                                                class="text-primary fas fa-clock"></i>
                                                                        </span>
                                                                    </div>
                                                                    <select name="suscription_time" id="suscription_time"
                                                                        class="form-control border-0 bg-input @error('suscription_time') is-invalid @enderror"
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
                                                                        <span
                                                                            class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                                            id="inputGroup-sizing-sm">
                                                                            <i title="Tiempo de suscripción"
                                                                                class="text-primary fas fa-gem"></i>
                                                                        </span>
                                                                    </div>
                                                                    <select name="type_plan" id="type_plan"
                                                                        class="form-control border-0 bg-input @error('type_plan') is-invalid @enderror"
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
                                                                <textarea class="form-control border-0 bg-input" rows="5"
                                                                    id="comments" placeholder="Comentarios" name="comments"
                                                                    required
                                                                    style="border-radius: 35px; box-shadow: 8px 8px 10px 0 #0883ad"></textarea>

                                                                <div class="container mt-4">
                                                                    <div class="col-12">
                                                                        <div class="col text-center">
                                                                            <button type="submit"
                                                                                style="border-radius: 50px"
                                                                                class="btn btn-primary mt-3">
                                                                                <i class="far fa-save"></i>
                                                                                {{ __('GUARDAR') }}
                                                                            </button>
                                                                            <button type="button"
                                                                                style="border-radius: 50px"
                                                                                class="btn btn-danger mt-3"
                                                                                data-dismiss="modal"><i
                                                                                    class="fas fa-times-circle"></i> CERRAR
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.js"
        integrity="sha512-UNbeFrHORGTzMn3HTt00fvdojBYHLPxJbLChmtoyDwB6P9hX5mah3kMKm0HHNx/EvSPJt14b+SlD8xhuZ4w9Lg=="
        crossorigin="anonymous"></script>
    <script src="https://unpkg.com/tableexport@5.2.0/dist/js/tableexport.min.js"></script>
    <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
    <script>
        new TableExport(document.getElementsByTagName("table"));
        // OR simply
        /* TableExport(document.getElementsByTagName("table")); */
        // OR using jQuery

    </script>
@endsection
