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

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <button class="nav-link active bg-cardheader" onclick="toggleActive(event)" type="button" data-toggle="collapse"
                data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Marcas
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link collapsed bg-cardheader text-light" onclick="toggleActive(event)" type="button" data-toggle="collapse"
                data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Categorías
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link collapsed bg-cardheader text-light" onclick="toggleActive(event)" type="button" data-toggle="collapse"
                data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Productos
            </button>
        </li>
    </ul>

    <div class="accordion" id="accordionExample">
        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
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
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="content mt-3">
                <div class="row">
                    <div class="col-md-12 ml-9 ms-12">
                        <aside class="profile-nav alt">
                            @if (Auth::user()->role_id == 1 || Auth::user()->company_id)
                                <!-- Tabla family -->
                                <div class="col-ml-6 col-md-6 col-ms-12   col-xs-12 ">
                                    <div style="background-color:black; color: white; border-radius: 15px;"
                                        class="col-ml-12 col-md-12 col-ms-12   col-xs-12 ">
                                        <div class="titulo">Ver Datos</div>
                                    </div>
                                    <div style="background-color: white;border-radius: 5px 5px 5px 5px;-moz-border-radius: 5px 5px 5px 5px;-webkit-border-radius: 5px 5px 5px 5px;"
                                        class="col-ml-12 col-md-12 col-ms-12   col-xs-12 ">
        
        
                                        <div class="row table-responsive">
                                            <div class="col-12">
                                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                                    <br>
                                                    <thead style="border-radius: 15px; background-color: black; color:white">
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Categoría</th>
                                                            @if (Auth::user()->role_id == 1)
                                                                <th>Compañia</th>
                                                            @endif
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody style="background-color: rgba(224, 220, 220, 0.993); ">
                                                        @foreach ($family as $item)
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
        
                                                                        <a class="btn btn-sm btn-primary rounded-circle"
                                                                            href="{{ url('familias/' . $item->id . '/edit') }}"
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
                                                                            action="{{ url('familias/' . $item->id) }}"
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
        
                                {{-- insertar Datos Family --}}
                                <div class="col-ml-6 col-md-6 col-ms-12   col-xs-12 ">
                                    <div style="background-color: black; border-top-right-radius: 25px; border-top-left-radius: 25px;"
                                        class="col-ml-12 col-md-12 col-ms-12   col-xs-12 ">
                                        <div style="color: white" class="titulo">Ingresar Datos</div>
                                    </div>
                                    <div class="col-ml-12 col-md-12 col-ms-12  col-xs-12  bg-frm">
                                        <br>
                                        <br>
                                        <div class="col-ml-12 col-md-12 col-ms-12  col-xs-12 bg-frm">
        
                                            <form action="{{ url('familias') }}" method="POST" enctype="multipart/form-data">
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
                                                        value="{{ old('name') }}" placeholder="Categoria" required
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
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
            <div class="card-body d-flex justify-content-between align-items-center">
                <a href="{{ url('productos/create') }}" style="border-radius: 95px;" class="btn btn-success btn-sm">&nbsp;
                    + AGREGAR PRODUCTO
                </a>
        
                <a class="btn btn-danger btn-sm mt-2" style="border-radius: 95px;" type="submit"
                    href="{{ route('Product.pdf') }}">REPORTE PDF
                </a>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="background-color: black; border-radius: 15px; color: white">
                            <strong class="card-title">Productos Registrados</strong>
                        </div>
                        <div class="card-body">
                            <div id="bootstrap-data-table_wrapper"
                                class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dataTables_length" id="bootstrap-data-table_length">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        @if (Auth::user()->role_id == 1 || Auth::user()->company_id)
                            <div class="card-body">
                                <div class="row table-responsive">
                                    <div class="col-sm-12">
                                        <table id="bootstrap-data-table"
                                            class="table table-striped table-bordered dataTable no-footer" role="grid"
                                            aria-describedby="bootstrap-data-table_info">
                                            <thead style="border-radius: 15px; background-color: black; color:white">
                                                <tr>
                                                    @if (Auth::user()->role_id == 1)
                                                        <th>Id</th>
                                                    @else
                                                        <th>No</th>
                                                    @endif
        
                                                    <th>Productos</th>
                                                    <th>Descripción</th>
                                                    <th>Precio </th>
                                                    <th>Stock</th>
                                                    <th>Ingresos totales </th>
                                                    <th>Egreso</th>
                                                    <th>Estado</th>
                                                    <th>Vista previa</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
        
                                            <tbody style="background-color: rgba(224, 220, 220, 0.993); ">
                                                @foreach ($products as $item)
                                                    <tr>
                                                        @if (Auth::user()->role_id == 1)
        
                                                            <th style="border-left: #325ff5 7px solid;">{{ $item->id }}</th>
                                                        @else
                                                            <th style="border-left: #325ff5 7px solid;"> {{ $loop->index + 1 }}
                                                            </th>
                                                        @endif
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->description }}</td>
                                                        <td>{{ $item->price }}</td>
        
                                                        @if ($item->stock == 0)
                                                            <td><i class="text-danger fas fa-times-circle"></i></td>
                                                        @else
                                                            <td>{{ $item->stock }}</td>
                                                        @endif
        
                                                        <td>{{ $item->total_revenue }}</td>
                                                        <td>{{ $item->amount_expenses }}</td>
        
                                                        @if ($item->active == 1)
                                                            <td>Disponible <i class="text-success fas fa-check-circle"></i></td>
                                                        @elseif ($item->active == 0)
                                                            <td>Agotado <i class="text-danger fas fa-times-circle"></i></td>
                                                        @endif
                                                        @if ($item->file != null)
                                                            <td>
                                                                <img src="{{ asset('/storage/productos/' . $item->file) }}"
                                                                    height="50px" width="50px">
                                                            </td>
                                                        @else
                                                            <td class="text-danger">
                                                                <b>Sin vista previa</b>
                                                            </td>
                                                        @endif
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Basic example">
        
                                                                <a href="{{ url('productos/' . $item->id) }}"
                                                                    class="btn btn-sm rounded-circle"
                                                                    style="background-color: #f55d00" title="Ver Detalles">
                                                                    <span><i class="text-light fas fa-eye"></i></span>
                                                                </a>
                                                                <a class="btn btn-sm btn-primary rounded-circle"
                                                                    href="{{ url('productos/' . $item->id . '/edit') }}"
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
                                    tu
                                    superior
                                    para poderte asignar una compañia y empezar a trabajar</p>
                            </div>
        
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');

    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.js"
        integrity="sha512-UNbeFrHORGTzMn3HTt00fvdojBYHLPxJbLChmtoyDwB6P9hX5mah3kMKm0HHNx/EvSPJt14b+SlD8xhuZ4w9Lg=="
        crossorigin="anonymous"></script>
    <script src="https://unpkg.com/tableexport@5.2.0/dist/js/tableexport.min.js"></script>
    <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
    <script>
        new TableExport(document.getElementsByTagName("table"));

    </script>
@endsection
@section('js')
    <!-- Menu Toggle Script -->
    <script>
        $(document).ready(function() {
            $('#tableID').DataTable();
        });

    </script>
@endsection
