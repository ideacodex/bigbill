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
    @if (session('datosModificados'))
        <div class="alert alert-success">
            {{ session('datosModificados') }}
        </div>
    @endif
    <!--Mensaje flash-->

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card bg-card">
                        <div class="card-header bg-cardheader" style="border-top-right-radius: 25px; 
                        border-top-left-radius: 25px;">
                            <strong class="card-title text-light">Editar tipo de cuenta</strong>
                        </div>
                        <div class="card-body bg-frm">
                            <form action="{{ url('TipodeCuenta/' . $account_type->id) }}" method="POST"
                                enctype="multipart/form-data" onsubmit="return checkSubmit();">
                                @csrf @method('PATCH')
                                <div class="form-group">
                                    <input id="status" type="text" class="text-dark form-control border-0 bg-input @error('status') is-invalid @enderror" name="status" value="{{ $account_type->status }}" placeholder="Estado financiero" required autocomplete="status" autofocus>
                                </div>
                                <div class="container mt-4">
                                    <div class="col-12">
                                        <div class="col text-center">
                                            <button type="submit" style="border-radius: 50px"
                                                class="btn btn-primary mt-3">
                                                <i class="far fa-save"></i>
                                                {{ __('GURDAR') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
            <img class="derecha" src="{{ asset('images/ideacode.png') }}">
        </div><!-- .animated -->
    </div><!-- .content -->

@endsection