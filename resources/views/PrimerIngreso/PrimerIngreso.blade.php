@extends('layouts.'. auth()->user()->getRoleNames()[0])
@section('content')
    {{-- Google chart --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    {{-- Google chart --}}
    @if (Auth::user()->suscriptions->active && Auth::user()->company_id)

        {{-- Clientes frecuentes --}}
        <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart(){

                var data = google.visualization.arrayToDataTable([
                    ['Nombre', 'Ventas'],
                    
                    @foreach ($customer as $customers)
                        ['{{ $customers->name }}', {{ $customers->bills->count()}}],
                    @endforeach
                ]);

                var options = {
                    title: 'Clientes frecuentes'
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                chart.draw(data, options);
            }
        </script>

        <div>
            <div class="card-header" style="background-color: black; border-radius: 15px; color: white; box-shadow: 8px 8px 10px 0 #0883ad">
                <strong class="card-title">Estadísticas</strong>
            </div>
            <div id="piechart" class="col-sm-6 col-lg-3 mt-3" style="height: 500px; height: 500px; box-shadow: 8px 8px 10px 0 #0883ad; border-radius: 35px">
            </div>
        </div>

        {{-- Productos más vendidos --}}
        <script>
            google.charts.load('current', {packages: ['corechart', 'bar']});
                google.charts.setOnLoadCallback(drawMultSeries);

                function drawMultSeries() {
                    var data = google.visualization.arrayToDataTable([
                        ['Nombre', 'Ventas'],
                        @foreach ($products as $product)
                        ['{{ $product->name }}', {{ $product->stock}}],
                    @endforeach
                    ]);

                    var options = {
                        title: 'Productos más vendidos',
                        chartArea: {width: '50%'},
                        hAxis: {
                        title: 'Total',
                        minValue: 0
                        },
                        vAxis: {
                        title: 'City'
                        }
                    };

                    var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
                    chart.draw(data, options);
                    }
        </script>

        <div id="chart_div" class="col-sm-6 col-lg-3 mt-3" style="height: 500px; height: 500px; box-shadow: 8px 8px 10px 0 #0883ad; border-radius: 35px"></div>
        
        <div class="col-sm-6 col-lg-3 mt-3">
            <div class="card text-white bg-flat-color-2 estadisticas">
                <div class="card-body pb-0 estadisticas">
                    <div class="dropdown float-right">
                        <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button"
                            id="dropdownMenuButton2" data-toggle="dropdown">
                            <i class="fa fa-cog"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                            <div class="dropdown-menu-content">
                                <a class="dropdown-item" href="{{ url('facturas') }}">Ir a ventas</a>
                            </div>
                        </div>
                    </div>
                    <p class="text-light"><b>Ventas totales</b></p>
                    <h4 class="mb-0">
                        <span class="count"><b>{{ $bill }}</b></span>
                    </h4>
                    <img style="width: 25%; float: right" class="user-avatar" src="{{ asset('images/ventas.png') }}"
                            alt="Ventas">
                    <div class="chart-wrapper px-0" style="height:70px;" height="70">
                        <canvas id="widgetChart2"></canvas>
                    </div>

                </div>
            </div>
        </div>
        <!--/.col-->

        <div class="col-sm-6 col-lg-3 mt-3">
            <div class="card text-white bg-warning estadisticas">
                <div class="card-body pb-0 estadisticas">
                    <div class="dropdown float-right">
                        <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button"
                            id="dropdownMenuButton4" data-toggle="dropdown">
                            <i class="fa fa-cog"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                            <div class="dropdown-menu-content">
                                <a class="dropdown-item" href="{{ url('compras')}}">Ver compras</a>
                            </div>
                        </div>
                    </div>
                    <p class="text-light"><b>Compras Totales</b></p>
                    <h4 class="mb-0">
                        <span class="count"><b>{{ $shopping }}</b></span>
                    </h4>
                    <img style="width: 25%; float: right" class="user-avatar" src="{{ asset('images/compra.png') }}"
                            alt="Compras">

                    <div class="chart-wrapper px-3" style="height:70px;" height="70">
                        <canvas id="widgetChart4"></canvas>
                    </div>

                </div>
            </div>
        </div>
        <!--/.col-->

        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-flat-color-4 estadisticas">
                <div class="card-body pb-0 estadisticas">
                    <div class="dropdown float-right">
                        <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button"
                            id="dropdownMenuButton4" data-toggle="dropdown">
                            <i class="fa fa-cog"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                            <div class="dropdown-menu-content">
                                <a class="dropdown-item" href="{{ url('UsuariosEmpresa')}}">Usuarios registrados</a>
                            </div>
                        </div>
                    </div>
                    <p class="text-light"><b>Usuarios del sistema</b></p>
                    <h4 class="mb-0">
                        <span class="count"><b>{{ $users }}</b></span>
                    </h4>
                    <img style="width: 25%; float: right" class="user-avatar" src="{{ asset('images/team.png') }}"
                            alt="Usuarios">

                    <div class="chart-wrapper px-3" style="height:70px;" height="70">
                        <canvas id="widgetChart4"></canvas>
                    </div>

                </div>
            </div>
        </div>
        <!--/.col-->

        {{-- <div class="col-lg-3 col-md-6">
            <div class="social-box facebook">
                <i class="fa fa-facebook"></i>
                <ul>
                    <li>
                        <span class="count">40</span> k
                        <span>friends</span>
                    </li>
                    <li>
                        <span class="count">450</span>
                        <span>feeds</span>
                    </li>
                </ul>
            </div>
            <!--/social-box-->
        </div> --}}
        <!--/.col-->


        {{-- <div class="col-lg-3 col-md-6">
            <div class="social-box twitter">
                <i class="fa fa-twitter"></i>
                <ul>
                    <li>
                        <span class="count">30</span> k
                        <span>friends</span>
                    </li>
                    <li>
                        <span class="count">450</span>
                        <span>tweets</span>
                    </li>
                </ul>
            </div>
            <!--/social-box-->
        </div> --}}
        <!--/.col-->


        {{-- <div class="col-lg-3 col-md-6">
            <div class="social-box linkedin">
                <i class="fa fa-linkedin"></i>
                <ul>
                    <li>
                        <span class="count">40</span> +
                        <span>contacts</span>
                    </li>
                    <li>
                        <span class="count">250</span>
                        <span>feeds</span>
                    </li>
                </ul>
            </div>
            <!--/social-box-->
        </div> --}}
        <!--/.col-->


        <div class="col-lg-3 col-md-6">
            <div class="social-box google-plus">
                <i class="fa fa-google-plus"></i>
                <ul>
                    <li>
                        <span class="count">94</span> k
                        <span>followers</span>
                    </li>
                    <li>
                        <span class="count">92</span>
                        <span>circles</span>
                    </li>
                </ul>
            </div>
            <!--/social-box-->
        </div>
        <!--/.col-->

        {{-- <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <h4 class="card-title mb-0">Traffic</h4>
                            <div class="small text-muted">October 2017</div>
                        </div>
                        <!--/.col-->
                        <div class="col-sm-8 hidden-sm-down">
                            <button type="button" class="btn btn-primary float-right bg-flat-color-1"><i
                                    class="fa fa-cloud-download"></i></button>
                            <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                                <div class="btn-group mr-3" data-toggle="buttons" aria-label="First group">
                                    <label class="btn btn-outline-secondary">
                                        <input type="radio" name="options" id="option1"> Day
                                    </label>
                                    <label class="btn btn-outline-secondary active">
                                        <input type="radio" name="options" id="option2" checked=""> Month
                                    </label>
                                    <label class="btn btn-outline-secondary">
                                        <input type="radio" name="options" id="option3"> Year
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!--/.col-->


                    </div>
                    <!--/.row-->
                    <div class="chart-wrapper mt-4">
                        <canvas id="trafficChart" style="height:200px;" height="200"></canvas>
                    </div>

                </div>
                <div class="card-footer">
                    <ul>
                        <li>
                            <div class="text-muted">Visits</div>
                            <strong>29.703 Users (40%)</strong>
                            <div class="progress progress-xs mt-2" style="height: 5px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 40%;"
                                    aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </li>
                        <li class="hidden-sm-down">
                            <div class="text-muted">Unique</div>
                            <strong>24.093 Users (20%)</strong>
                            <div class="progress progress-xs mt-2" style="height: 5px;">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 20%;" aria-valuenow="20"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </li>
                        <li>
                            <div class="text-muted">Pageviews</div>
                            <strong>78.706 Views (60%)</strong>
                            <div class="progress progress-xs mt-2" style="height: 5px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 60%;"
                                    aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </li>
                        <li class="hidden-sm-down">
                            <div class="text-muted">New Users</div>
                            <strong>22.123 Users (80%)</strong>
                            <div class="progress progress-xs mt-2" style="height: 5px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 80%;"
                                    aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </li>
                        <li class="hidden-sm-down">
                            <div class="text-muted">Bounce Rate</div>
                            <strong>40.15%</strong>
                            <div class="progress progress-xs mt-2" style="height: 5px;">
                                <div class="progress-bar" role="progressbar" style="width: 40%;" aria-valuenow="40"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div> --}}

        <div class="col-xl-3 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="ti-money text-success border-success"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">Total en ventas</div>
                            <div class="stat-digit">{{ $ibill }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="ti-user text-primary border-primary"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">New Customer</div>
                            <div class="stat-digit">961</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="col-xl-3 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="ti-layout-grid2 text-warning border-warning"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">Active Projects</div>
                            <div class="stat-digit">770</div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        
    @else

        <div style="margin: 1rem;  padding: 1rem;">
            <!-- Button trigger modal -->
            <button style="margin: 1rem;  padding: 1rem;" type="button" class="btn btn-primary" data-toggle="modal"
                data-target="#company">
                Crear Empresa
            </button>
            <!-- Button trigger modal -->
            <a style="margin: 1rem;  padding: 1rem;" type="button" class="btn btn-primary" href="{{ url('perfil') }}">
                Asignarse una empresa
            </a>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="company" tabindex="-1" aria-labelledby="companyLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="companyLabel">Agregar información de mi empresa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <form method="POST" action="{{ route('empresas.store') }}" onsubmit="return checkSubmit();"
                                enctype="multipart/form-data" file="true">
                                @csrf
                                {{-- Nombre de la companía --}}
                                <div class="col-12 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                            <i title="Nombre de la companía" class="text-dark fas fa-building"></i>
                                        </span>
                                    </div>
                                    <input id="name" type="text"
                                        class="text-dark form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" placeholder="Nombre de la companía" required
                                        autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Nit --}}
                                <div class="col-12 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                            <i title="Nit" class="text-dark fas fa-sort-amount-down"></i>
                                        </span>
                                    </div>
                                    <input id="nit" placeholder="Nit" type="number"
                                        class="text-dark form-control @error('nit') is-invalid @enderror" name="nit"
                                        value="{{ old('nit') }}" required autocomplete="nit" autofocus>

                                    @error('nit')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Dirección --}}
                                <div class="col-12 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                            <i title="Dirección" class="text-dark fas fa-map-marker-alt"></i>
                                        </span>
                                    </div>
                                    <input id="address" placeholder="Dirección" type="text"
                                        class="text-dark form-control @error('address') is-invalid @enderror" name="address"
                                        value="{{ old('address') }}" autocomplete="address" autofocus>

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Teléfono --}}
                                <div class="col-12 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text transparent" id="inputGroup-sizing-sm">
                                            <i title="Número de teléfono" class="text-dark fas fa-mobile"></i>
                                        </span>
                                    </div>
                                    <input id="phone" type="text" maxlength="8" placeholder="Número de teléfono"
                                        class="text-dark form-control @error('phone') is-invalid @enderror" name="phone"
                                        value="{{ old('phone') }}" autocomplete="phone" autofocus>

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- imagen --}}
                                <div class="col-12 input-group input-group-lg mb-3">
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
                                            <button type="submit" style="border-radius: 10px"
                                                class="btn btn-lg btn-primary mt-3">
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
            </div>
        </div>

        <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel">Asignar Companía</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Verificacion de Datos de: {{ Auth::user()->name }}</strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                        <hr>

                                        <form action="{{ url('home/' . Auth::user()->id) }}" method="POST" file="true"
                                            enctype="multipart/form-data" onsubmit="return checkSubmit();">
                                            @csrf @method('PATCH')

                                            {{-- <!--Nombre--> --}}
                                            <input name="name" type="hidden" value="{{ Auth::user()->name }}">
                                            {{-- <!-- lastname --> --}}
                                            <input name="lastname" type="hidden" value="{{ Auth::user()->lastname }}">
                                            {{-- <!-- phone --> --}}
                                            <input name="phone" type="hidden" value="{{ Auth::user()->phone }}">
                                            {{-- <!--  nit --> --}}
                                            <input name="nit" type="hidden" value="{{ Auth::user()->nit }}">
                                            {{-- <!--  address --> --}}
                                            <input name="address" type="hidden" value="{{ Auth::user()->address }}">
                                            {{-- <!-- email  --> --}}
                                            <input name="email" type="hidden" value="{{ Auth::user()->email }}">
                                            {{-- imagen --}}
                                            <div class="col-12 col-md-6 input-group input-group-lg mb-3 ">
                                                <img src="{{ asset('/storage/usuarios/' . Auth::user()->file) }}"
                                                    width="150px" height="150px" alt="Usuario">
                                                <Strong> Actualizar
                                                    <i class="fas fa-images"></i>
                                                </Strong>
                                                <input type="file" id="file" name="file" accept="image/*">
                                            </div>
                                            {{-- <!--Company_id--> --}}
                                            @if (Auth::user()->role_id == 2)
                                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text transparent"
                                                            id="inputGroup-sizing-sm">
                                                            <i title="company" class="far fa-building"></i>
                                                        </span>
                                                    </div>
                                                    <select name="customer_id" id="cifrado" onchange="mostrarInput();"
                                                        class="select2 form-control @error('customer_id') is-invalid @enderror">
                                                        <option selected disabled>Companía</option>
                                                        <option selected value="0">Asignarse Companía</option>
                                                        @if (Auth::user()->company_id)
                                                            <option value="{{ Auth::user()->company_id }}" selected>
                                                                <p>
                                                                    Su companía: {{ Auth::user()->companies->name }}
                                                                </p>
                                                            </option>
                                                        @else
                                                            @foreach ($companies as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @error('company_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            @else
                                                @if (Auth::user()->role_id == 1)
                                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text transparent"
                                                                id="inputGroup-sizing-sm">
                                                                <i title="company" class="far fa-building"></i>
                                                            </span>
                                                        </div>
                                                        <select name="company_id" id="company_id"
                                                            class="form-control @error('company_id') is-invalid @enderror">
                                                            @if (Auth::user()->company_id)
                                                                <option value="{{ Auth::user()->company_id }}" selected>
                                                                    <p>
                                                                        Su companía: {{ auth::user()->companies->name }}
                                                                    </p>
                                                                </option>
                                                                @foreach ($company as $item)

                                                                    <option value="{{ $item->id }}">
                                                                        {{ $item->name }}</option>

                                                                @endforeach
                                                            @else
                                                                @foreach ($company as $item)
                                                                    <option value="{{ $item->id }}">
                                                                        {{ $item->name }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>

                                                    </div>
                                                @else
                                                    {{-- company_id --}}
                                                    @if (!Auth::user()->company_id)
                                                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                                            <select class="form-control select2" id="company_id"
                                                                name="company_id">
                                                                <option selected disabled>Companía</option>
                                                                <option selected value="0">Asígnate a la companía</option>
                                                                @foreach ($company as $item)
                                                                    <option value="{{ $item->id }}">Nombre:
                                                                        {{ $item->name }} Nit: {{ $item->nit }}
                                                                    </option>
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
                                                @endif
                                            @endif

                                            {{-- <!--Button--> --}}
                                            <div class="container mt-4">
                                                <div class="col-12">
                                                    <div class="col text-center">
                                                        <button type="submit" style="border-radius: 10px"
                                                            class="btn btn-primary">
                                                            <i class="fas fa-clipboard-check"></i>
                                                            {{ __('Asignarme') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div> <!-- .card -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                    </div>
                </div>
            </div>
        </div>
        
    @endif

    <script>
        $(".js-example-tags").select2({
            tags: true
        });
    </script>

@endsection
