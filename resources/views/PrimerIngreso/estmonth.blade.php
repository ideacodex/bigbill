@extends('layouts.'. auth()->user()->getRoleNames()[0])
@section('content')
    {{-- Google chart --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    {{-- Google chart --}}
    @if (Auth::user()->suscriptions->active && Auth::user()->company_id)

        {{-- Montos mensuales --}}
        <div class="content mt-3" id="mensual">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0">
                            <div class="card-header bg-carddashheader border-0" style="position: absolute; top: 0%; width: 100%">
                                <strong class="card-title text-light"> Estadísticas Mensuales</strong>
                            </div>
                            <div class="col-md-12 card-body mt-5">
                                {{-- Estadísticas anuales --}}
                                    {{-- Conteo de registros totales --}}
                                    <div class="col-xl-3 col-lg-6" style="height: 150px; height: 150px;">
                                        <div class="card bg-carddash border-0">
                                            <div class="card-header bg-cardtotales rounded-top">
                                                <strong class="text-light">VENTAS MENSUALES</strong>
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
                                                        <div class="stat-digit text-center">{{ $bill }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="col-xl-3 col-lg-6" style="height: 150px; height: 150px;">
                                        <div class="card bg-carddash border-0">
                                            <div class="card-header bg-cardtotales rounded-top">
                                                <strong class="text-light">COMPRAS MENSUALES</strong>
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
                                                       <div class="stat-digit text-center">{{ $shopping }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="col-xl-3 col-lg-6" style="height: 150px; height: 150px;">
                                        <div class="card bg-carddash border-0">
                                            <div class="card-header bg-cardtotales rounded-top">
                                                <strong class="text-light">USUARIOS REGISTRADOS</strong>
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
                                                        <div class="stat-digit text-center">{{ $users }}</div>
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
                                                            
                                                            @foreach ($invoicem as $invoicesm)
                                                                ['{{ $invoicesm->id }}', {{ $invoicesm->total}}],
                                                            @endforeach
                                                        ]);
    
                                                        var options = {
                                                            title: 'Monto de ventas mensuales'
                                                        };
    
                                                        var chart = new google.visualization.PieChart(document.getElementById('facturasm'));
                                                        chart.draw(data, options);
                                                    }
                                                </script>
    
                                                <div class="col-12 col-md-6 col-xl-3 col-lg-6 mt-2" style="height: 250px; height: 250px;">
                                                    <div class="card bg-carddash border-0" style="height: 250px; height: 250px;">
                                                        <div class="card-header bg-cardtotales rounded-top">
                                                            <strong class="text-light">MONTO DE VENTA MENSUAL</strong>
                                                        </div>
                                                        <div class="card-body bg-light" id="facturasm" style="border-radius: 20px; height: 250px; height: 250px;">
                                                        </div>
                                                    </div>
                                                </div>    
                                    {{-- Montos de ventas --}}
                            </div>
                            <div class="col-md-12 card-body" style="height: 600px">
                                                        {{-- Clientes frecuentes por mes--}}
                                                        <script type="text/javascript">
                                                            google.charts.load('current', {packages:['corechart', 'bar']});
                                                            google.charts.setOnLoadCallback(drawMultSeries);
                                            
                                                            function drawMultSeries(){
                                                                var data = google.visualization.arrayToDataTable([
                                                                    ['Nombre', 'Compras realizadas'],
                                                                    
                                                                    @foreach ($customerf as $customerfs)
                                                                        ['{{ $customerfs->name }}', {{ $customerfs->bills->count()}}],
                                                                    @endforeach
                                                                ]);
                                            
                                                                var options = {
                                                                    title: 'Clientes frecuentes del mes'
                                                                };
                                            
                                                                var chart = new google.visualization.BarChart(document.getElementById('clientesf'));
                                                                chart.draw(data, options);
                                                            }
                                                        </script>
    
                                                        <div class="d-none d-lg-block col-12 col-sm-10 col-md-12 mt-2"  style="width: 75%; height: 400px">
                                                            <div class="card bg-carddash border-0 col-12 col-sm-10 col-md-12" style="width: 100%;">
                                                                <div class="card-header col-md-12 bg-cardtotales rounded-top text-center">
                                                                    <strong class="text-light">CLIENTES FRECUENTES DEL MES</strong>
                                                                </div>
                                                                <div class="card-body bg-light col-12 col-sm-10 col-md-12" id="clientesf" style="border-radius: 20px; width: 100%; height: 400px">
                                                                </div>
                                                            </div>
                                                        </div>   
                                                        {{-- Clientes frecuentes por mes--}}
    
                                                {{-- Productos disponibles --}}
                                               {{-- Productos más vendidos por mes --}}
                                                        <script>
                                                            google.charts.load('current', {packages: ['corechart', 'bar']});
                                                                google.charts.setOnLoadCallback(drawMultSeries);
    
                                                                function drawMultSeries() {
                                                                    var data = google.visualization.arrayToDataTable([
                                                                        ['Nombre', 'Vendidos'],
                                                                        @foreach ($productos as $productm)
                                                                        ['{{ $productm->name }}', {{ $productm->amount_expenses }}],
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
    
                                                                    var chart = new google.visualization.BarChart(document.getElementById('productm'));
                                                                    chart.draw(data, options);
                                                                    }
                                                        </script>
    
                                                <div class="col-xl-3 col-lg-6"  style="height: 300px; height: 300px;">
                                                    <div class="card bg-carddash border-0" style="height: 300px; height: 300px;">
                                                        <div class="card-header bg-cardtotales rounded-top">
                                                            <strong class="text-light">PRODUCTOS MÁS VENDIDOS</strong>
                                                        </div>
                                                        <div class="card-body bg-light" id="productm" style="border-radius: 20px; height: 300px; height: 300px;">
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
                                                                <div class="stat-text text-dark">Gastos mensuales</div>
                                                                <div class="stat-digit">{{ 'Q. ' . number_format($ishoppingm->sum('total'), 2, '.', ',') }}</div>
                                                            </div>
                                                        </div>
                                                        <div class="stat-widget-one bg-carddash bg-fondo mt-2">
                                                            <div class="stat-icon dib bg-fondo"><img style="width: 50%;" class="user-avatar" src="{{ asset('images/quetzal.png') }}"
                                                                alt="Ventas"></div>
                                                            <div class="stat-content dib">
                                                                <div class="stat-text text-dark">Ventas mensuales</div>
                                                                <div class="stat-digit">{{ 'Q. ' . number_format($ibillm->sum('total'), 2, '.', ',') }}</div>
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
        {{-- Montos mensuales --}}

    @endif
@endsection