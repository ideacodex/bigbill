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


    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        {{-- <div class="card-header">
                            <strong class="card-title">Actualizar Usuario : Rol: {{ $user->role_id }}</strong>
                        </div> --}}
                        <div class="card-body">

                            @if (Auth::user()->company_id || Auth::user()->role_id == 1)
                                <form action="{{ url('PersonalEliminado/' . $user->id) }}" method="GET"
                                    enctype="multipart/form-data" onsubmit="return checkSubmit();">
                                    @csrf @method('GET')
                                    <!--Role Id-->
                                    <select name="role_id" id="role_id" hidden>
                                        <option value="{{ $user->role_id }}">Actualizar Rol</option>
                                    </select>
                                    <!--Nombre-->
                                    <input id="name" name="name" type="hidden" value="{{ $user->name }}">
                                    <!-- lastname -->
                                    <input id="lastname" name="lastname" type="hidden" value="{{ $user->lastname }}">
                                    <!-- phone -->
                                    <input id="phone" name="phone" type="hidden" value="{{ $user->phone }}">
                                    <!--  nit -->
                                    <input id="nit" name="nit" type="hidden" value="{{ $user->nit }}">
                                    <!--  address -->
                                    <input id="address" name="address" type="hidden" value="{{ $user->address }}">
                                    <!-- email  -->
                                    <input id="email" name="email" type="hidden" value="{{ $user->email }}">
                                    {{-- company --}}
                                    <select name="company_id" id="company_id" hidden>
                                        <option value="{{ $user->company_id }}" selected>compañia</option>
                                    </select>
                                    {{-- Sucursal --}}
                                    <select name="branch_id" id="branch_id" hidden>
                                        @if ($user->branch_id)
                                            <option value="{{ $user->branch_offices->id }}" selected>Sucursal:
                                                {{ $user->branch_offices->name }}</option>
                                        @else
                                            <option value=" " selected>Sucursal:</option>
                                        @endif
                                    </select>
                                    {{-- NOmbre del usuario --}}
                                    <span class="form-control" style="color: white; background:black; text-align: center;"
                                        value="">{{ $user->name }}
                                        {{ $user->lastname }}
                                    </span>
                                    <!--Button-->

                                    <div class="container mt-4">
                                        <div class="col-12">
                                            <div class="col text-center">
                                                <button type="submit" style="border-radius: 10px"
                                                    class="btn btn-lg btn-primary mt-3">
                                                    <i class="fas fa-trash-alt"></i>
                                                    {{ __('Eliminar Usuario de Compañia') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <strong><i class="fas fa-ban"></i> Si desea cancelar esta accion de <a
                                            href="{{ url('Personal') }}">Click aqui</a> </strong>
                                </form>

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
        </div><!-- .animated -->
    </div><!-- .content -->

@endsection
