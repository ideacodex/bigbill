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
                <!-- Diseño de los blocks -->

                <div class="col-ml-6 col-md-6 col-ms-12   col-xs-12 ">
                    <div style="background-color: #2b364f; color: white; border-radius: 5px 5px 5px 5px;-moz-border-radius: 5px 5px 5px 5px;-webkit-border-radius: 5px 5px 5px 5px;" class="col-ml-12 col-md-12 col-ms-12   col-xs-12 ">
                        <div class="titulo">Agregar IVA Producto</div>
                    </div>
                    <div style="background-color: white;border-radius: 5px 5px 5px 5px;-moz-border-radius: 5px 5px 5px 5px;-webkit-border-radius: 5px 5px 5px 5px;" class="col-ml-12 col-md-12 col-ms-12   col-xs-12 ">
                        <br><br>
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Ajuste de IVA</h4>
                            <p>Puedes Modificar el Iva de todos tus productos o quitarles el Iva a ellos, de manera que tengas el control de tus transacciones.</p>
                            <hr>
                            <p class="mb-0">Seleciona una opcion para trabajar</p>
                        </div>
                        <div id="contenedor">

                            <br>
                        </div>
                        <br>
                    </div>
                </div>
                <!-- LISTA DE PRECIOS -->
                <div class="col-ml-6 col-md-6 col-ms-12   col-xs-12 ">
                    <div style="background-color: #2b364f; color: white;border-radius: 5px 5px 5px 5px;-moz-border-radius: 5px 5px 5px 5px;-webkit-border-radius: 5px 5px 5px 5px;" class="col-ml-12 col-md-12 col-ms-12   col-xs-12 ">
                        <div class="titulo">Lista de precios </div>
                    </div>
                    <div style="background-color: white;border-radius: 5px 5px 5px 5px;-moz-border-radius: 5px 5px 5px 5px;-webkit-border-radius: 5px 5px 5px 5px;" class="col-ml-12 col-md-12 col-ms-12   col-xs-12 ">
                        <br>
                        <br>
                        <div style="background-color: white;border-radius: 5px 5px 5px 5px;-moz-border-radius: 5px 5px 5px 5px;-webkit-border-radius: 5px 5px 5px 5px;" class="col-ml-12 col-md-12 col-ms-12   col-xs-12 ">
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">Agregara precios generales de Productos</h4>
                                <p>Puedes agregar precios en general para ahorar tu trabajo al momento de ingresar un producto</p>
                                <hr>
                                <p class="mb-0">Seleciona una opcion para trabajar</p>
                            </div>
                            <div id="contenedor">
                                <!-- 
                                    <a class="nav-link" href="{{ route('lista.create') }}">
                                    <button class="button1"><i class="fas fa-plus-circle"></i> Agregar Precio</button>
                                </a>
                                 -->
                                <a class="nav-link" href="{{ route('lista.index') }}">
                                    <button class="button2"><i class="far fa-eye"></i> Ver precios</button>
                                </a>
                                <br>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>

            </aside>

        </div>
    </div>
</div>
@endsection