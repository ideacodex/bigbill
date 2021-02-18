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
    <!--Mensaje flash-->
    @if (session('datosEliminados'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            <span class="badge badge-pill badge-success">Atención</span>
            {{ session('datosEliminados') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif
    <!--Mensaje flash-->
    <!-- .content -->
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Listado de Precios</strong>
                        </div>
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <button type="button" style="border-radius: 95px;" class="btn btn-success mb-1 ml-2 mt-2"
                                data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">
                                Agregar tipo de cuenta
                                <i class="fas fa-plus-square"></i>
                            </button>
                        </div>
                        @if (Auth::user()->role_id == 1 || Auth::user()->company_id)
                            <div class="card-body">
                                <div class="row table-responsive">
                                    <div class="col-12">
                                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    @if (Auth::user()->role_id == 1)
                                                        <th>Id</th>
                                                    @else
                                                        <th>#</th>
                                                    @endif

                                                    <th>Tipo de precio</th>
                                                    <th>Precio</th>

                                                    @if (Auth::user()->role_id == 1)
                                                        <th>Compañia</th>
                                                    @endif

                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($price as $item)
                                                    <tr>
                                                        @if (Auth::user()->role_id == 1)
                                                            <td>{{ $item->id }}</td>
                                                        @else
                                                            <td> {{ $loop->index + 1 }}</td>
                                                        @endif
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->price }}</td>
                                                        @if (Auth::user()->role_id == 1)
                                                            <td>{{ $item->companies->name }}</td>
                                                        @endif

                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                                <a class="btn btn-sm btn-secondary" href=""
                                                                    title="Ver Detalles">
                                                                    <span><i class="fas fa-eye"></i></span>
                                                                </a>
                                                                <a class="btn btn-sm btn-primary"
                                                                    href="{{ url('lista/' . $item->id . '/edit') }}"
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
                        @else
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">upss!</h4>
                                <p>Bienvenido al sistema de Facturacion <b> TU CONTA</b> </p>
                                <hr>
                                <p class="mb-0">Al parecer aun no cuentas con una compañia, comunicate con
                                    tu superior para poderte asignar una compañia y empezar a trabajar</p>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div>
    <!-- .content -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Precio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('lista.store') }}" onsubmit="return checkSubmit();">
                        @csrf
                        {{-- name --}}
                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                            <input id="name" placeholder="Tipo Precio" type="text"
                                class="text-dark form-control @error('name') is-invalid @enderror" name="name" required
                                autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- price --}}
                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                            <input id="price" placeholder="precio Q." type="number"step="0.01"
                                class="text-dark form-control @error('price') is-invalid @enderror" name="price" required
                                autocomplete="price" autofocus>

                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <!-- Company_id -->
                        @if (Auth::user()->role_id == 1)
                            {{-- company --}}
                            <div class="col-12 col-md-6 input-group input-group-lg mb-4">
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
                                                Su compañia: {{ auth()->user()->companies->name }}
                                            </p>
                                        </option>
                                    @endif

                                    @foreach ($company as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        @else
                            {{-- Company_id --}}
                            <div class="col-12 col-md-6 input-group input-group-lg mb-4">
                                <input type="hidden" value="{{ Auth::user()->company_id }} " name="company_id"
                                    readonly="readonly" id="company_id"
                                    class="form-control @error('company_id') is-invalid @enderror" required>
                            </div>
                        @endif
                        @error('company_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror





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
