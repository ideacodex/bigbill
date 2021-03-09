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
        <div class="alert alert-danger">
            {{ session('datosEliminados') }}
        </div>
    @endif
    <!--Mensaje flash-->
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <button class="nav-link active" onclick="toggleActive(event)" type="button" data-toggle="collapse"
                data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Compras
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link collapsed" onclick="toggleActive(event)" type="button" data-toggle="collapse"
                data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                formulario
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link collapsed" onclick="toggleActive(event)" type="button" data-toggle="collapse"
                data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                formulario
            </button>
        </li>
    </ul>

    <div class="card-body d-flex justify-content-between align-items-center">
        <a href="{{ route('compras.create') }}" style="border-radius: 95px;" class="btn btn-success btn-sm">&nbsp;
            + REGISTRAR COMPRA
        </a>
        <a class="btn btn-danger btn-sm mt-2" style="border-radius: 95px;" type="submit"
            href="{{ route('Factura.pdf') }}">REPORTE PDF
        </a>
    </div>
    <div class="accordion" id="accordionExample">
        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="background-color: black; border-radius: 15px">
                            <strong style="color: white" class="card-title">Compras registradas</strong>
                        </div>
                        <div class="card-body">
                            <div class="row table-responsive">
                                <div class="col-sm-12">
                                    <table id="bootstrap-data-table"
                                        class="table table-striped table-bordered dataTable no-footer" role="grid"
                                        aria-describedby="bootstrap-data-table_info">

                                        <thead style="border-radius: 15px; background-color: black; color:white">
                                            <tr>
                                                <th>No</th>
                                                <th>Registrado por</th>
                                                <th>Companía</th>
                                                <th>Sucursal</th>
                                                <th>Proveedor</th>
                                                <th>Descripción</th>
                                                <th>Total</th>
                                                <th>Tipo de artículo</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>

                                        <tbody style="background-color: rgba(224, 220, 220, 0.993); ">
                                            @if ($records)
                                                @foreach ($records as $item)
                                                    <tr>
                                                        <th style="border-left: #325ff5 7px solid;" scope="row">
                                                            {{ $item->id }} </th>
                                                        <td>{{ $item->user->name }} {{ $item->user->lastname }}</td>
                                                        <td>{{ $item->company->name }}</td>
                                                        @if ($item->branch_id != null)
                                                            <td>{{ $item->branch_office->name }}</td>
                                                        @else
                                                            <td>Central</td>
                                                        @endif
                                                        <td>{{ $item->supplier }}</td>
                                                        <td>{{ $item->description }}</td>
                                                        <td>{{ $item->total }}</td>
                                                        @if ($item->type_product == 1)
                                                            <td>Artículo de compra</td>
                                                        @elseif($item->type_product == 2)
                                                            <td>Artículo de compra y venta</td>
                                                        @endif
                                                        <td>
                                                            <a class="btn btn-sm btn-secondary"
                                                                href="{{ url('facturas/' . $item->id) }}"
                                                                title="Ver factura">
                                                                <span><i class="text-light fas fa-eye"></i></span>
                                                            </a>

                                                            <a class="btn btn-sm btn-danger" title="Eliminar"
                                                                data-toggle="modal" data-target="#largeModal"
                                                                onclick="event.preventDefault(); document.getElementById('formDel{{ $item->id }}').submit();">
                                                                <span class="text-light"><i
                                                                        class="fas fa-trash-alt"></i></span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div>
                <div class="card-body">
                    <form method="POST" action="{{ url('textoXml') }}" onsubmit="return checkSubmit();"
                        enctype="multipart/form-data" file="true">
                        @csrf
                        {{-- texto xml --}}
                        <div class="row form-group">
                            <div class="col-12 col-md-9"><textarea name="xml" id="textarea-input" rows="9"
                                    placeholder="Content..." class="form-control"></textarea></div>
                        </div>

                        {{-- imagen --}}
                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                            <input type="file" id="file" name="file" accept="image/*"
                                class="text-dark form-control @error('file') is-invalid @enderror">
                            @error('file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Boton --}}
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
            </div>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
            <div class="card-body">
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
                wolf
                moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                eiusmod.
                Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda
                shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente
                ea
                proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw
                denim
                aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
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
            // OR simply
            /* TableExport(document.getElementsByTagName("table")); */
            // OR using jQuery

        </script>
        <script>
            function toggleActive(event) {
                var target = event.target || event.srcElement;
                var buttonList = document.querySelectorAll(".nav-link");
                buttonList.forEach(function(button) {
                    if (button === target && !button.classList.contains("active")) {
                        return button.classList.add("active");
                    }
                    return button.classList.remove("active");
                });
            }

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
