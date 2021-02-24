@extends('layouts.'. auth()->user()->getRoleNames()[0])
@section('content')
    @if (session('datosEliminados'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            <span class="badge badge-pill badge-success">Atención</span>
            {{ session('datosEliminados') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif
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
    <style>
        .titulo {
            font-family: Arial;
            font-size: 30px;
            text-align: center;
        }

        .button1 {
            background-color: #2b364f;
            color: white;
            font-size: 25px;
            border-radius: 5px 5px 5px 5px;
            -moz-border-radius: 5px 5px 5px 5px;
            -webkit-border-radius: 5px 5px 5px 5px;
        }

        .button2 {
            background-color: #2b364f;
            color: white;
            border-radius: 5px;
            font-size: 25px;
            font-size: 25px;
            border-radius: 10px 10px 10px 10px;
            -moz-border-radius: 10px 10px 10px 10px;
            -webkit-border-radius: 10px 10px 10px 10px;
        }

        #contenedor {
            width: 50%;
            margin: 0 auto;
        }

    </style>

    <div class="content mt-3">
        <div class="row">
            <div class="col-md-12 ml-9 ms-12">
                <aside class="profile-nav alt">
                    <!-- Tabla iva -->
                    <div class="col-ml-6 col-md-6 col-ms-12   col-xs-12 ">
                        <div style="background-color: #2b364f; color: white; border-radius: 5px 5px 5px 5px;-moz-border-radius: 5px 5px 5px 5px;-webkit-border-radius: 5px 5px 5px 5px;"
                            class="col-ml-12 col-md-12 col-ms-12   col-xs-12 ">
                            <div class="titulo">Ver Datos</div>
                        </div>
                        <div style="background-color: white;border-radius: 5px 5px 5px 5px;-moz-border-radius: 5px 5px 5px 5px;-webkit-border-radius: 5px 5px 5px 5px;"
                            class="col-ml-12 col-md-12 col-ms-12   col-xs-12 ">
                            <br><br>
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">Ajuste de IVA</h4>
                                <p>Puedes Modificar el Iva de todos tus productos o quitarles el Iva a ellos, de manera que
                                    tengas el control de tus transacciones.</p>
                                <hr>
                                <p class="mb-0">Seleciona una opcion para trabajar</p>
                            </div>

                            @if (Auth::user()->role_id == 1 || Auth::user()->company_id)
                                <div class="row table-responsive">
                                    <div class="col-12">
                                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                            <br>
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>IVA</th>
                                                    <th>Tasa de Cambio</th>
                                                    @if (Auth::user()->role_id == 1)
                                                        <th>Compañia</th>
                                                    @endif
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($settings as $item)
                                                    <tr>

                                                        @if (Auth::user()->role_id == 1)
                                                            <th>{{ $item->id }}</th>
                                                            <td>{{ $item->tax }}</td>
                                                            <td>{{ $item->exchange_rate }}</td>
                                                            <td>{{ $item->company->name }}</td>
                                                            <td>
                                                                <div class="btn-group" role="group"
                                                                    aria-label="Basic example">
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
                                                        @else
                                                            @if ($loop->index + 1 == 1)
                                                                <th> {{ $loop->index + 1 }}</th>
                                                                <td>{{ $item->tax }}</td>
                                                                <td>{{ $item->exchange_rate }}</td>
                                                                <td>
                                                                    <div class="btn-group" role="group"
                                                                        aria-label="Basic example">
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
                                                            @endif
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

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
                            <br>
                            <br>
                        </div>
                    </div>
                    <!-- LISTA DE PRECIOS -->
                    <div class="col-ml-6 col-md-6 col-ms-12   col-xs-12 ">
                        <div style="background-color: #2b364f; color: white;border-radius: 5px 5px 5px 5px;-moz-border-radius: 5px 5px 5px 5px;-webkit-border-radius: 5px 5px 5px 5px;"
                            class="col-ml-12 col-md-12 col-ms-12   col-xs-12 ">
                            <div class="titulo">Ingresar Datos</div>
                        </div>
                        <div style="background-color: white;border-radius: 5px 5px 5px 5px;-moz-border-radius: 5px 5px 5px 5px;-webkit-border-radius: 5px 5px 5px 5px;"
                            class="col-ml-12 col-md-12 col-ms-12   col-xs-12 ">
                            <br>
                            <br>
                            <div style="background-color: white;border-radius: 5px 5px 5px 5px;-moz-border-radius: 5px 5px 5px 5px;-webkit-border-radius: 5px 5px 5px 5px;"
                                class="col-ml-12 col-md-12 col-ms-12   col-xs-12 ">
                                <div class="alert alert-success" role="alert">
                                    <h4 class="alert-heading">Agregara precios generales de Productos</h4>
                                    <p>Puedes agregar precios en general para ahorar tu trabajo al momento de ingresar un
                                        producto</p>
                                    <hr>
                                    <p class="mb-0">Seleciona una opcion para trabajar</p>
                                </div>


                                <form action="{{ url('Ajustes') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @if (Auth::user()->role_id == 1)
                                        {{-- tax --}}
                                        <div class="col-ml-12 col-md-12 col-ms-12  col-xs-12 ">

                                            <div class="row">
                                                <div class="col-ml-12 col-md-12 col-ms-12  col-xs-12 ">
                                                    <strong>Monto de Iva</strong>
                                                    <br>
                                                    <br>
                                                </div>
                                                <div class="col-ml-1 col-md-1 col-ms-1 col-xs-1  ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text transparent"
                                                            id="inputGroup-sizing-sm">
                                                            <i class="fas fa-coins"></i>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col-ml-8 col-md-8 col-ms-8 col-xs-8 ">
                                                    <input id="tax" name="tax" type="text"
                                                        class="text-dark form-control @error('tax') is-invalid @enderror"
                                                        value="{{ old('tax') }}"
                                                        style="text-align: right; text-shadow: 5px 5px 5px #FF0000;"
                                                        placeholder="Monto de Iva %" required autocomplete="tax" autofocus>
                                                    @error('tax')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="col-ml-2 col-md-2 col-ms-2 col-xs-2 ">
                                                    <strong class="input-group-text "> <b> %</b> </strong>
                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                        <br>
                                        <br>
                                        {{-- <!--Tada de cambio--> --}}
                                        <div class="col-ml-12 col-md-12 col-ms-12  col-xs-12 ">

                                            <div class="row">
                                                <div class="col-ml-12 col-md-12 col-ms-12  col-xs-12 ">
                                                    <strong>Tasa de Cambio</strong>
                                                    <br>
                                                    <br>
                                                </div>
                                                <div class="col-ml-4 col-md-4 col-ms-4 col-xs-4  ">
                                                    <div class="row">
                                                        <div class="col-ml-5 col-md-5 col-ms-5 col-xs-5  ">
                                                            <span class="input-group-text transparent"
                                                                id="inputGroup-sizing-sm">
                                                                <i class="fas fa-piggy-bank"></i>
                                                            </span>
                                                        </div>
                                                        <div class="col-ml-7 col-md-7 col-ms-7 col-xs-7  ">
                                                            <input type="text" class="text-dark form-control"
                                                                placeholder="$1 Dollar" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-ml-2 col-md-2 col-ms-2 col-xs-2 ">
                                                    <span class="input-group-text transparent">
                                                        <i class="fas fa-exchange-alt"></i>
                                                    </span>
                                                </div>
                                                <div class="col-ml-6 col-md-6 col-ms-6 col-xs-6 ">
                                                    <input id="exchange_rate" name="exchange_rate" type="text"
                                                        class="text-dark form-control @error('name') is-invalid @enderror"
                                                        value="{{ old('exchange_rate') }}" placeholder="Q. valor"
                                                        required autocomplete="exchange_rate" autofocus>
                                                    @error('exchange_rate')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                        {{-- <!--Company_id--> --}}
                                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                                    <i title="company" class="far fa-building"></i>
                                                </span>
                                            </div>
                                            <select name="company_id" id="company_id"
                                                class="form-control @error('company_id') is-invalid @enderror">
                                                @if (auth()->user()->company_id)
                                                    <option value="{{ auth()->user()->company_id }}" selected>
                                                        <p>
                                                            Su companía:
                                                            {{ auth()->user()->companies->name }}
                                                        </p>
                                                    </option>
                                                @endif

                                                @foreach ($company as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('company_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                        {{-- <!--Button--> --}}
                                        <div class="container mt-4">
                                            <div class="col-12">
                                                <div class="col text-center">
                                                    <button type="submit" style="border-radius: 10px"
                                                        class="btn btn-lg btn-primary mt-3" name="enviar">
                                                        <i class="fas fa-cogs"></i>
                                                        {{ __('Guardar') }}
                                                    </button>
                                                </div>
                                                <br>
                                                <br>
                                            </div>
                                        </div>
                                    @else
                                        @if (!$settings->first())
                                            {{-- tax --}}
                                            <div class="col-ml-12 col-md-12 col-ms-12  col-xs-12 ">

                                                <div class="row">
                                                    <div class="col-ml-12 col-md-12 col-ms-12  col-xs-12 ">
                                                        <strong>Monto de Iva</strong>
                                                        <br>
                                                        <br>
                                                    </div>
                                                    <div class="col-ml-1 col-md-1 col-ms-1 col-xs-1  ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text transparent"
                                                                id="inputGroup-sizing-sm">
                                                                <i class="fas fa-coins"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-ml-8 col-md-8 col-ms-8 col-xs-8 ">
                                                        <input id="tax" name="tax" type="text"
                                                            class="text-dark form-control @error('tax') is-invalid @enderror"
                                                            value="{{ old('tax') }}"
                                                            style="text-align: right; text-shadow: 5px 5px 5px #FF0000;"
                                                            placeholder="Monto de Iva %" required autocomplete="tax"
                                                            autofocus>
                                                        @error('tax')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-ml-2 col-md-2 col-ms-2 col-xs-2 ">
                                                        <strong class="input-group-text "> <b> %</b> </strong>
                                                    </div>
                                                </div>
                                                <br>
                                            </div>
                                            <br>
                                            <br>
                                            {{-- <!--Tada de cambio--> --}}
                                            <div class="col-ml-12 col-md-12 col-ms-12  col-xs-12 ">

                                                <div class="row">
                                                    <div class="col-ml-12 col-md-12 col-ms-12  col-xs-12 ">
                                                        <strong>Tasa de Cambio</strong>
                                                        <br>
                                                        <br>
                                                    </div>
                                                    <div class="col-ml-4 col-md-4 col-ms-4 col-xs-4  ">
                                                        <div class="row">
                                                            <div class="col-ml-5 col-md-5 col-ms-5 col-xs-5  ">
                                                                <span class="input-group-text transparent"
                                                                    id="inputGroup-sizing-sm">
                                                                    <i class="fas fa-piggy-bank"></i>
                                                                </span>
                                                            </div>
                                                            <div class="col-ml-7 col-md-7 col-ms-7 col-xs-7  ">
                                                                <input type="text" class="text-dark form-control"
                                                                    placeholder="$1 Dollar" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-ml-2 col-md-2 col-ms-2 col-xs-2 ">
                                                        <span class="input-group-text transparent">
                                                            <i class="fas fa-exchange-alt"></i>
                                                        </span>
                                                    </div>
                                                    <div class="col-ml-6 col-md-6 col-ms-6 col-xs-6 ">
                                                        <input id="exchange_rate" name="exchange_rate" type="text"
                                                            class="text-dark form-control @error('name') is-invalid @enderror"
                                                            value="{{ old('exchange_rate') }}" placeholder="Q. valor"
                                                            required autocomplete="exchange_rate" autofocus>
                                                        @error('exchange_rate')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <br>
                                            </div>
                                            {{-- <!--Company_id--> --}}
                                            <input type="hidden" value="{{ Auth::user()->company_id }}"
                                                name="company_id">
                                            {{-- <!--Button--> --}}
                                            <div class="container mt-4">
                                                <div class="col-12">
                                                    <div class="col text-center">
                                                        <button type="submit" style="border-radius: 10px"
                                                            class="btn btn-lg btn-primary mt-3" name="enviar">
                                                            <i class="fas fa-cogs"></i>
                                                            {{ __('Guardar') }}
                                                        </button>
                                                    </div>
                                                    <br>
                                                    <br>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>



                </aside>

            </div>
        </div>
    </div>
@endsection
