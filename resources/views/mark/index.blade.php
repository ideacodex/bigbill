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
            font-mark: Arial;
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
                    @if (Auth::user()->role_id == 1 || Auth::user()->company_id)
                        <!-- Tabla mark -->
                        <div class="col-ml-6 col-md-6 col-ms-12   col-xs-12 ">
                            <div style="background-color: black; border-radius: 15px; color: white"
                                class="col-ml-12 col-md-12 col-ms-12   col-xs-12 ">
                                <div class="titulo">Ver Datos</div>
                            </div>
                            <div style="background-color: white;border-radius: 5px 5px 5px 5px;-moz-border-radius: 5px 5px 5px 5px;-webkit-border-radius: 5px 5px 5px 5px;"
                                class="col-ml-12 col-md-12 col-ms-12   col-xs-12 ">
                                <br><br>

                                <div class="row table-responsive">
                                    <div class="col-12">
                                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                            <br>
                                            <thead style="border-radius: 15px; background-color: black; color:white">
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Marca</th>
                                                    @if (Auth::user()->role_id == 1)
                                                        <th>Compañia</th>
                                                    @endif
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody style="background-color: rgba(224, 220, 220, 0.993); ">
                                                @foreach ($mark as $item)
                                                    <tr>

                                                        @if (Auth::user()->role_id == 1)
                                                            <th style="border-left: #325ff5 7px solid;">{{ $item->id }}
                                                            </th>
                                                        @else
                                                            <th style="border-left: #325ff5 7px solid;">
                                                                {{ $loop->index + 1 }}</th>
                                                        @endif
                                                        <td>{{ $item->name }}</td>
                                                        @if (Auth::user()->role_id == 1)
                                                            <td>{{ $item->company->name }}</td>
                                                        @endif
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                                <a class="rounded-circle btn btn-sm btn-primary"
                                                                    href="{{ url('marcas/' . $item->id . '/edit') }}"
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
                                                                    action="{{ url('marcas/' . $item->id) }}"
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

                                <br>
                                <br>
                            </div>
                        </div>

                        {{-- insertar Datos mark --}}
                        <div class="col-ml-6 col-md-6 col-ms-12   col-xs-12 ">
                            <div style="background-color: black; border-top-right-radius: 25px; border-top-left-radius: 25px;"
                                class="col-ml-12 col-md-12 col-ms-12   col-xs-12 ">
                                <div style="color: white" class="titulo">Ingresar Datos</div>
                            </div>
                            <div class="col-ml-12 col-md-12 col-ms-12 col-xs-12 bg-frm">
                                <br>
                                <br>
                                <div class="col-ml-12 col-md-12 col-ms-12  col-xs-12">
                                    <form action="{{ url('marcas') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        {{-- Nombre --}}
                                        <div class="col-12 col-md- input-group input-group-lg mb-3">
                                            <div class="input-group-prepend">
                                                <span style="background: transparent; border-left: #325ff5 7px solid;"
                                                class="border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                id="inputGroup-sizing-sm">
                                                    <i class="text-primary fas fa-users"></i>
                                                </span>
                                            </div>
                                            <input style="background: transparent" id="name" name="name" type="text"
                                                class="text-dark form-control border-0 @error('name') is-invalid @enderror"
                                                value="{{ old('name') }}" placeholder="Marca" required
                                                autocomplete="name" autofocus>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        {{-- <!--Company_id--> --}}
                                        @if (Auth::user()->role_id == 1)
                                            <div class="col-12 col-md- input-group input-group-lg mb-3">
                                                <div class="input-group-prepend">
                                                    <span style="background: transparent; border-left: #325ff5 7px solid;"
                                                    class="border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                    id="inputGroup-sizing-sm">
                                                        <i title="company" class="text-primary far fa-building"></i>
                                                    </span>
                                                </div>
                                                <select style="background: transparent" name="company_id" id="company_id"
                                                    class="form-control border-0 @error('company_id') is-invalid @enderror">
                                                    @if (auth()->user()->company_id)
                                                        <option value="{{ auth()->user()->company_id }}" selected>
                                                            <p>
                                                                Su companía: {{ auth()->user()->companies->name }}
                                                            </p>
                                                        </option>
                                                    @endif

                                                    @foreach ($company as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('company_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </div>
                                        @else
                                            <input type="hidden" value="{{ Auth::user()->company_id }}"
                                                name="company_id">
                                        @endif

                                        {{-- <!--Button--> --}}
                                        <div class="container mt-4">
                                            <div class="col-12">
                                                <div class="col text-center">
                                                    <button type="submit" style="border-radius: 50px"
                                                        class="btn btn-primary mt-3" name="enviar">
                                                        <i class="text-light fas fa-save"></i>
                                                        {{ __('GUARDAR') }}
                                                    </button>
                                                </div>
                                                <br>
                                                <br>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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
                </aside>

            </div>
        </div>
    </div>
@endsection
