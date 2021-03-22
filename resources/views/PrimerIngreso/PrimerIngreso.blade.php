@extends('layouts.'. auth()->user()->getRoleNames()[0])
@section('content')
    {{-- Google chart --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    {{-- Google chart --}}
    @if (Auth::user()->suscriptions->active && Auth::user()->company_id)

    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
            {{-- Montos anuales --}}
            <div class="content mt-3" id="anual">
                <div class="animated fadeIn">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card border-0">
                                <div class="card-header bg-carddashheader border-0">
                                    <strong class="card-title text-light"> Estadísticas Anuales</strong>
                                </div>
                                <div class="col-md-12 card-body">
                                    {{-- Estadísticas anuales --}}
                                        {{-- Conteo de registros totales --}}
                                        <div class="col-xl-3 col-lg-6" style="height: 150px; height: 150px;">
                                            <div class="card bg-carddash border-0">
                                                <div class="card-header bg-cardtotales rounded-top">
                                                    <strong class="text-light">VENTAS TOTALES</strong>
                                                </div>
                                                <div class="card-body bg-fondo" style="border-radius: 20px">
                                                    <div class="stat-widget-one">
                                                        <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button"
                                                            id="dropdownMenuButton2" data-toggle="dropdown">
                                                            <i class="fa fa-cog text-primary"></i>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                            <div class="dropdown-menu-content">
                                                                <a class="dropdown-item" href="{{ url('facturas') }}">Ver ventas</a>
                                                            </div>
                                                        </div>
                                                        <div class="stat-content dib text-center">
                                                            <div class="stat-digit text-center">{{ $bills }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-3 col-lg-6" style="height: 150px; height: 150px;">
                                            <div class="card bg-carddash border-0">
                                                <div class="card-header bg-cardtotales rounded-top">
                                                    <strong class="text-light">COMPRAS TOTALES</strong>
                                                </div>
                                                <div class="card-body bg-fondo" style="border-radius: 20px">
                                                    <div class="stat-widget-one">
                                                        <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button"
                                                            id="dropdownMenuButton2" data-toggle="dropdown">
                                                            <i class="fa fa-cog text-primary"></i>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                            <div class="dropdown-menu-content">
                                                                <a class="dropdown-item" href="{{ url('compras') }}">Ver compras</a>
                                                            </div>
                                                        </div>
                                                        <div class="stat-content dib text-center">
                                                        <div class="stat-digit text-center">{{ $shoppings }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-3 col-lg-6" style="height: 150px; height: 150px;">
                                            <div class="card bg-carddash border-0">
                                                <div class="card-header bg-cardtotales rounded-top">
                                                    <strong class="text-light">USUARIOS DEL SISTEMA</strong>
                                                </div>
                                                <div class="card-body bg-fondo" style="border-radius: 20px">
                                                    <div class="stat-widget-one">
                                                        <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button"
                                                            id="dropdownMenuButton2" data-toggle="dropdown">
                                                            <i class="fa fa-cog text-primary"></i>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                            <div class="dropdown-menu-content">
                                                                <a class="dropdown-item" href="{{ url('UsuariosEmpresa') }}">Usuarios registrados</a>
                                                            </div>
                                                        </div>
                                                        <div class="stat-content dib text-center">
                                                            <div class="stat-digit text-center">{{ $user }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Conteo de registros totales --}}
                                        {{-- Montos de ventas --}}
                                                    <script type="text/javascript">
                                                        google.charts.load('current', {'packages':['corechart']});
                                                        google.charts.setOnLoadCallback(drawChart);
                                                        function drawChart(){

                                                            var data = google.visualization.arrayToDataTable([
                                                                ['Nombre', 'Monto'],
                                                                
                                                                @foreach ($customer as $customers)
                                                                    ['{{ $customers->name }} {{ $customers->lastname }}', {{ $customers->bills->sum('total')}}],
                                                                @endforeach
                                                            ]);

                                                            var options = {
                                                                title: 'Monto de ventas'
                                                            };

                                                            var chart = new google.visualization.PieChart(document.getElementById('facturas'));
                                                            chart.draw(data, options);
                                                        }
                                                    </script>

                                                    <div class="col-12 col-md-6 col-xl-3 col-lg-6 mt-2" style="height: 250px; height: 250px;">
                                                        <div class="card bg-carddash border-0" style="height: 250px; height: 250px;">
                                                            <div class="card-header bg-cardtotales rounded-top">
                                                                <strong class="text-light">MONTO DE VENTA</strong>
                                                            </div>
                                                            <div class="card-body bg-light" id="facturas" style="border-radius: 20px; height: 250px; height: 250px;">
                                                            </div>
                                                        </div>
                                                    </div>    
                                </div>
                                <div class="col-md-12 card-body" style="height: 500px">
                                                    {{-- Clientes frecuentes --}}
                                                    <script type="text/javascript">
                                                        google.charts.load('current', {packages:['corechart', 'bar']});
                                                        google.charts.setOnLoadCallback(drawMultSeries);

                                                        function drawMultSeries(){
                                                            var data = google.visualization.arrayToDataTable([
                                                                ['Nombre', 'Compras realizadas'],
                                                                
                                                                @foreach ($customer as $customers)
                                                                    ['{{ $customers->name }}', {{ $customers->bills->count()}}],
                                                                @endforeach
                                                            ]);

                                                            var options = {
                                                                title: 'Clientes frecuentes'
                                                                
                                                            };

                                                            var chart = new google.visualization.BarChart(document.getElementById('piechart'));
                                                            chart.draw(data, options);
                                                        }
                                                    </script>

                                                    <div class="d-none d-lg-block col-12 col-sm-10 col-md-12 mt-2"  style="width: 75%; height: 400px">
                                                        <div class="card bg-carddash border-0 col-12 col-sm-10 col-md-12" style="width: 100%;">
                                                            <div class="card-header col-md-12 bg-cardtotales rounded-top text-center">
                                                                <strong class="text-light">CLIENTE FRECUENTES</strong>
                                                            </div>
                                                            <div class="card-body bg-light col-12 col-sm-10 col-md-12" id="piechart" style="border-radius: 20px; width: 100%; height: 400px">
                                                            </div>
                                                        </div>
                                                    </div>     

                                                    {{-- Ventas y gastos totales --}}

                                                    {{-- Productos disponibles --}}
                                                    <script type="text/javascript">
                                                        google.charts.load('current', {'packages':['corechart']});
                                                        google.charts.setOnLoadCallback(drawChart);
                                                        function drawChart(){

                                                            var data = google.visualization.arrayToDataTable([
                                                                ['Nombre', 'Stock'],
                                                                
                                                                @foreach ($products as $product)
                                                                    ['{{ $product->name }}', {{ $product->stock}}],
                                                                @endforeach
                                                            ]);

                                                            var options = {
                                                                title: 'Productos disponibles'
                                                            };

                                                            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                                                            chart.draw(data, options);
                                                        }
                                                    </script>

                                                    <div class="col-xl-3 col-lg-6"  style="height: 300px; height: 300px;">
                                                        <div class="card bg-carddash border-0" style="height: 300px; height: 300px;">
                                                            <div class="card-header bg-cardtotales rounded-top">
                                                                <strong class="text-light">PRODUCTOS DISPONIBLES</strong>
                                                            </div>
                                                            <div class="card-body bg-light" id="chart_div" style="border-radius: 20px; height: 300px; height: 300px;">
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    {{-- Productos disponibles --}}

                                                    <div class="col-xl-3 col-lg-6 mt-4 transparent"  style="height: 400px; height: 400px;">
                                                        <div class="card border-0">
                                                            <div class="stat-widget-one bg-carddash bg-fondo">
                                                                <div class="stat-icon dib bg-fondo"><img style="width: 50%;" class="user-avatar" src="{{ asset('images/cart.png') }}"
                                                                    alt="Compras"></div>
                                                                <div class="stat-content dib">
                                                                    <div class="stat-text text-dark">Gastos totales</div>
                                                                    <div class="stat-digit">{{ 'Q. ' . number_format($ishopping, 2, '.', ',') }}</div>
                                                                </div>
                                                            </div>
                                                            <div class="stat-widget-one bg-carddash bg-fondo mt-2">
                                                                <div class="stat-icon dib bg-fondo"><img style="width: 50%;" class="user-avatar" src="{{ asset('images/quetzal.png') }}"
                                                                    alt="Ventas"></div>
                                                                <div class="stat-content dib">
                                                                    <div class="stat-text text-dark">Ventas totales</div>
                                                                    <div class="stat-digit">{{ 'Q. ' . number_format($ibill, 2, '.', ',') }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>   
                                                    
                                                {{-- Ventas y gastos totales --}}
                                        {{-- Montos de ventas --}}        
                                {{-- Estadísticas anuales --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Montos anuales --}}            
    @else

        <div style="margin: 1rem;  padding: 1rem;">
            <!-- Button trigger modal -->
            <button style="margin: 1rem;  padding: 1rem; border-radius: 50px" type="button" class="btn btn-primary" data-toggle="modal"
                data-target="#company">
                Crear Empresa
            </button>
            <!-- Button trigger modal -->
            <a style="margin: 1rem;  padding: 1rem; border-radius: 50px" type="button" class="btn btn-primary" href="{{ url('home/'.Auth::user()->id.'/edit') }}">
                Asignarse una empresa
            </a>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="company" tabindex="-1" aria-labelledby="companyLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content bg-card">
                    <div class="modal-header bg-cardheader">
                        <h5 class="modal-title text-light" id="companyLabel">Agregar información de mi empresa</h5>
                        <button type="button" style="color: red" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body bg-frm">
                        <div>
                            <form method="POST" action="{{ route('empresas.store') }}" onsubmit="return checkSubmit();"
                                enctype="multipart/form-data" file="true">
                                @csrf
                                {{-- Nombre de la companía --}}
                                <div class="col-12 input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent" id="inputGroup-sizing-sm">
                                            <i title="Nombre de la companía" class="text-primary fas fa-building"></i>
                                        </span>
                                    </div>
                                    <input id="name" type="text"
                                        class="border-0 bg-input text-dark form-control @error('name') is-invalid @enderror" name="name"
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
                                        <span class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent" id="inputGroup-sizing-sm">
                                            <i title="Nit" class="text-primary fas fa-sort-amount-down"></i>
                                        </span>
                                    </div>
                                    <input id="nit" placeholder="Nit" type="number"
                                        class="border-0 bg-input text-dark form-control @error('nit') is-invalid @enderror" name="nit"
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
                                        <span class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent" id="inputGroup-sizing-sm">
                                            <i title="Dirección" class="text-primary fas fa-map-marker-alt"></i>
                                        </span>
                                    </div>
                                    <input id="address" placeholder="Dirección" type="text"
                                        class="border-0 bg-input text-dark form-control @error('address') is-invalid @enderror" name="address"
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
                                        <span class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent" id="inputGroup-sizing-sm">
                                            <i title="Número de teléfono" class="text-primary fas fa-mobile"></i>
                                        </span>
                                    </div>
                                    <input id="phone" type="text" maxlength="8" placeholder="Número de teléfono"
                                        class="border-0 bg-input text-dark form-control @error('phone') is-invalid @enderror" name="phone"
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
                                        class="border-0 bg-input text-dark form-control @error('file') is-invalid @enderror">
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
                                            <input name="name" class="border-0 bg-input" type="hidden" value="{{ Auth::user()->name }}">
                                            {{-- <!-- lastname --> --}}
                                            <input name="lastname" class="border-0 bg-input" type="hidden" value="{{ Auth::user()->lastname }}">
                                            {{-- <!-- phone --> --}}
                                            <input name="phone" class="border-0 bg-input" type="hidden" value="{{ Auth::user()->phone }}">
                                            {{-- <!--  nit --> --}}
                                            <input name="nit" class="border-0 bg-input" type="hidden" value="{{ Auth::user()->nit }}">
                                            {{-- <!--  address --> --}}
                                            <input name="address" class="border-0 bg-input" type="hidden" value="{{ Auth::user()->address }}">
                                            {{-- <!-- email  --> --}}
                                            <input name="email" class="border-0 bg-input" type="hidden" value="{{ Auth::user()->email }}">
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
                                                        <span class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                            id="inputGroup-sizing-sm">
                                                            <i title="company" class="far fa-building"></i>
                                                        </span>
                                                    </div>
                                                    <select name="customer_id" id="cifrado" onchange="mostrarInput();"
                                                        class="border-0 bg-input select2 form-control @error('customer_id') is-invalid @enderror">
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
                                                            <span class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                                id="inputGroup-sizing-sm">
                                                                <i title="company" class="far fa-building"></i>
                                                            </span>
                                                        </div>
                                                        <select name="company_id" id="company_id"
                                                            class="border-0 bg-input form-control @error('company_id') is-invalid @enderror">
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
                                                            <select class="border-0 bg-input form-control select2" id="company_id"
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
                                                        <button type="submit" style="border-radius: 50px"
                                                            class="btn btn-primary">
                                                            <i class="fas fa-clipboard-check"></i>
                                                            {{ __('ASIGNARME') }}
                                                        </button>
                                                        <button type="button" style="border-radius: 50px" class="btn btn-secondary" data-dismiss="modal">CERRAR
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
