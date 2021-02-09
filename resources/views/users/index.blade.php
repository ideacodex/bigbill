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

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Usuarios de {{Auth::user()->company->name}} </strong>
                        </div>

                        <div class="card-body">
                            <div class="row table-responsive">
                                <div class="col-12">
                                    <table id="bootstrap-data-table-export" id="tblData"
                                        class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>Role</th>
                                                <th>Nombre</th>
                                                <th>Teléfono</th>
                                                <th>Nit</th>
                                                <th>Dirección</th>
                                                <th>Correo</th>
                                                <th>Sucursal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($user as $item)
                                                <tr>
                                                    <th>{{ $item->id }}</th>
                                                    <td>{{ $item->role_id }}</td>
                                                    <td>{{ $item->name }} {{ $item->lastname }}</td>
                                                    <td>{{ $item->phone }}</td>
                                                    <td>{{ $item->nit }}</td>
                                                    <td>{{ $item->address }}</td>
                                                    <td>{{ $item->email }}</td>
                                                    @if ($item->branch_office)
                                                        <td>{{ $item->branch_office->name }}</td>
                                                    @else
                                                        <td>Oficina central</td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
@endsection
