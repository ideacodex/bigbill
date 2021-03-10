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
<style>
    * {
        box-sizing: border-box;
    }

    .image {
        filter: blur(3px);
        display: block;
        height: auto;
        background-color: transparent;
        transition: transform .2s;
        position: center;
        block-padding: center;
        height: 200px;
        width: 200px;
        margin: 0 auto;
        border-radius: 8px;
        margin-left: auto;
        margin-right: auto;

    }

    .image:hover {
        filter: none;
        -ms-transform: scale(1.75);
        /* IE 9 */
        -webkit-transform: scale(1.75);
        /* Safari 3-8 */
        transform: scale(1.5);
        box-shadow: 0 0 4px 3px rgba(0, 140, 186, 0.5);
    }

    .text:hover {
        -ms-transform: scale(1.05);
        -webkit-transform: scale(1.05);
    }

</style>
<!--Mensaje flash-->
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card bg-card">
                    <div class="card-header bg-cardheader"
                    style="border-top-right-radius: 25px; border-top-left-radius: 25px;">
                        <strong class="card-title text-light">Visualizar Producto</strong>
                    </div>
                    <div class="card-body bg-frm">
                        <br> <br>
                        {{-- imagen --}}
                        <img src="{{ asset('/storage/productos/' . $products->file) }}" class="image" width="150px" height="150px" alt="producto">
                        <br><br><br>
                        {{-- <!--Nombre--> --}}
                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                            <span class="bg-span border-top-0 border-bottom-0 border-right-0 text text-dark form-control">
                                <i title="text-primary Nombre" class="text-primary fas fa-people-carry"></i>
                                Producto: {{ $products->name }}</span>
                        </div>
                        {{-- <!-- descripcion --> --}}
                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                            <span class="bg-span border-top-0 border-bottom-0 border-right-0 text text-dark form-control">
                                <i title="text-primary Descripción" class="text-primary fas fa-book"></i>
                                Descripcion:{{ $products->description }}</span>
                        </div>
                        {{-- Tipo de producto --}}
                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                            <span class="bg-span border-top-0 border-bottom-0 border-right-0 text text-dark form-control">
                                <i class="text-primary fas fa-wallet"></i> Tipo de producto:
                                {{ $products->kind_product }}</span>
                        </div>
                        {{-- <!-- precio --> --}}
                        <div @if ($products->kind_product == 'Artículo de venta' || $products->kind_product == 'Artículo de compra y venta')
                            class=" col-12 col-md-6 input-group input-group-lg mb-3"
                            @else
                            class="d-none col-12 col-md-6 input-group input-group-lg mb-3"
                            @endif
                            >
                            <span class="bg-span border-top-0 border-bottom-0 border-right-0 text text-dark form-control">
                                <i class="text-primary fas fa-hand-holding-usd"></i> Precio:{{ $products->price }}</span>
                        </div>
                        <!--Precio especial-->
                        <div @if ($products->kind_product == 'Artículo de venta' || $products->kind_product == 'Artículo de compra y venta') class=" col-12 col-md-6 input-group input-group-lg mb-3"
                            @else
                            class="d-none col-12 col-md-6 input-group input-group-lg mb-3" @endif>
                            <span class="bg-span border-top-0 border-bottom-0 border-right-0 text text-dark form-control">
                                <i class="text-primary fas fa-star"></i> Precio
                                especial:{{ $products->special_price }}</span>
                        </div>
                        <!--Precio crédito-->
                        <div @if ($products->kind_product == 'Artículo de venta' || $products->kind_product == 'Artículo de compra y venta') class=" col-12 col-md-6 input-group input-group-lg mb-3"
                            @else
                            class="d-none col-12 col-md-6 input-group input-group-lg mb-3" @endif>
                            <span class="bg-span border-top-0 border-bottom-0 border-right-0 text text-dark form-control">
                                <i class="text-primary fas fa-credit-card"></i> Precio
                                crédito:{{ $products->credit_price }}</span>
                        </div>
                        {{-- <!--costos--> --}}
                        <div id="a" @if ($products->kind_product == 'Artículo de compra' || $products->kind_product == 'Artículo de compra y venta') class=" col-12 col-md-6 input-group input-group-lg mb-3"
                            @else class="d-none col-12 col-md-6 input-group input-group-lg mb-3" @endif>
                            <span class="bg-span border-top-0 border-bottom-0 border-right-0 text text-dark form-control">
                                <i class="text-primary fas fa-coins"></i> Precio de compra:
                                {{ $products->cost }}</span>
                        </div>
                        {{-- <!--Company_id--> --}}
                        @if (Auth::user()->role_id == 1)
                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                            <span class="bg-span border-top-0 border-bottom-0 border-right-0 text text-dark form-control">
                                <i class="text-primary far fa-building"></i>
                                Companía: {{ $products->company->name }}
                            </span>
                        </div>
                        @endif
                        <!--Nuevos ingresos-->
                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                            <span class="bg-span border-top-0 border-bottom-0 border-right-0 text text-dark form-control">
                                <i class="text-primary fas fa-plus-square"></i>
                                Ultimos Ingresos: {{ $products->new_income }}
                            </span>
                        </div>
                        {{-- ¿Agregar dimensiones? --}}
                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                            @if ($products->weight >= 1 || $products->tall >= 1 || $products->broad >= 1 || $products->depth >= 1)
                            <span class="bg-span border-top-0 border-bottom-0 border-right-0 text text-dark form-control">
                                <i class="text-primary fas fa-balance-scale"></i> Contiene dimensiones
                            </span>
                            @else
                            <span class="bg-span border-top-0 border-bottom-0 border-right-0 text text-dark form-control">
                                <i class="text-primary fas fa-balance-scale"></i>No contiene dimensiones
                            </span>
                            @endif
                        </div>
                        {{-- <!--Peso--> --}}
                        <div @if ($products->weight >= 1 || $products->tall >= 1 || $products->broad >= 1 || $products->depth >= 1) class=" col-12 col-md-6 input-group input-group-lg mb-3"
                            @else
                            class="d-none col-12 col-md-6 input-group input-group-lg mb-3" @endif id="Peso">
                            <span class="bg-span border-top-0 border-bottom-0 border-right-0 text text-dark form-control">
                                <i class="text-primary fas fa-shopping-bag"></i> Peso
                                :{{ $products->weight }}</span>
                        </div>
                        {{-- <!--Altura --> --}}
                        <div @if ($products->weight >= 1 || $products->tall >= 1 || $products->broad >= 1 || $products->depth >= 1) class=" col-12 col-md-6 input-group input-group-lg mb-3"
                            @else
                            class="d-none col-12 col-md-6 input-group input-group-lg mb-3" @endif id="Altura">
                            <span class="bg-span border-top-0 border-bottom-0 border-right-0 text text-dark form-control">
                                <i class="text-primary fas fa-ruler-vertical"></i> Altura
                                :{{ $products->tall }}</span>
                        </div>
                        {{-- <!--Ancho --> --}}
                        <div @if ($products->weight >= 1 || $products->tall >= 1 || $products->broad >= 1 || $products->depth >= 1) class=" col-12 col-md-6 input-group input-group-lg mb-3"
                            @else
                            class="d-none col-12 col-md-6 input-group input-group-lg mb-3" @endif id="Ancho">
                            <span class="bg-span border-top-0 border-bottom-0 border-right-0 text text-dark form-control">
                                <i class="text-primary fas fa-ruler-horizontal"></i> Ancho
                                :{{ $products->broad }}</span>
                        </div>
                        {{-- <!--Profundidad --> --}}
                        <div @if ($products->weight >= 1 || $products->tall >= 1 || $products->broad >= 1 || $products->depth >= 1) class=" col-12 col-md-6 input-group input-group-lg mb-3"
                            @else
                            class="d-none col-12 col-md-6 input-group input-group-lg mb-3" @endif id="Profundidad">
                            <span class="bg-span border-top-0 border-bottom-0 border-right-0 text text-dark form-control">
                                <i class="text-primary fas fa-ruler"></i> Profundidad
                                :{{ $products->depth }}</span>
                        </div>
                        {{-- <!--  cantidad egresos --> --}}
                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">

                            <span class="bg-span border-top-0 border-bottom-0 border-right-0 text text-dark form-control">
                                <i class="text-primary fas fa-sign-out-alt"></i> Cantidad
                                egresos:
                                {{ $products->amount_expenses }}</span>
                        </div>
                        {{-- <!--En este input se va a cargar el total de ingresos del producto--> --}}
                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                            <span class="bg-span border-top-0 border-bottom-0 border-right-0 text text-dark form-control">
                                <i class="text-primary fas fa-globe"></i> Ingresos totales :
                                {{ $products->total_revenue }}</span>
                        </div>
                        {{-- <!-- grandTotal --> --}}
                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                            <span class="bg-span border-top-0 border-bottom-0 border-right-0 text text-dark form-control">
                                <i class="text-primary fas fa-cubes"></i> Stock :
                                {{ $products->stock }}</span>
                        </div>
                        {{-- categorias familias --}}
                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                            <span class="bg-span border-top-0 border-bottom-0 border-right-0 text text-dark form-control">
                                <i class="text-primary fas fa-cubes"></i> categorias :
                                @foreach ($pivote_family as $datos)
                                @if ($datos->product_id == $products->id)
                                {{ $datos->families->name }} |
                                @endif
                                @endforeach
                            </span>
                        </div>
                        {{-- categorias marca --}}
                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                            <span class="bg-span border-top-0 border-bottom-0 border-right-0 text text-dark form-control">
                                <i class="text-primary fas fa-cubes"></i>
                                Marcas :
                                @foreach ($pivote_mark as $datos)
                                @if ($datos->product_id == $products->id)
                                {{ $datos->marks->name }} |
                                @endif
                                @endforeach
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <img class="derecha" src="{{ asset('images/ideacode.png') }}">
    </div>
</div>
@endsection
