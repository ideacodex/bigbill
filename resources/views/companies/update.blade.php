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
                        @if ((Auth::user()->work_permits == 1 && Auth::user()->role_id == 2 && Auth::user()->company_id == $companies->id) || Auth::user()->role_id == 1)
                            <div class="card-header bg-cardheader" style="border-top-right-radius: 25px; 
                        border-top-left-radius: 25px;">
                                <strong class="card-title text-light">Editar Companía</strong>
                            </div>
                            <div class="card-body bg-frm">
                                <form action="{{ url('empresas/' . $companies->id) }}" method="POST" file="true"
                                    enctype="multipart/form-data" onsubmit="return checkSubmit();">
                                    @csrf @method('PATCH')
                                    {{-- Nombre de la Compania --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span
                                                class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                id="inputGroup-sizing-sm">
                                                <i title="Nombre de la companía" class="text-primary fas fa-building"></i>
                                            </span>
                                        </div>
                                        <input id="name" type="text"
                                            class="border-0 bg-input text-dark form-control @error('name') is-invalid @enderror"
                                            name="name" value="{{ $companies->name }}" placeholder="Nombre de la companía"
                                            required autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- Nit --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span
                                                class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                id="inputGroup-sizing-sm">
                                                <i title="Nit" class="text-primary fas fa-sort-amount-down"></i>
                                            </span>
                                        </div>
                                        <input id="nit" placeholder="Nit" type="number"
                                            class="border-0 bg-input text-dark form-control @error('nit') is-invalid @enderror"
                                            name="nit" value="{{ $companies->nit }}" required autocomplete="nit"
                                            autofocus>

                                        @error('nit')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        @error('nit')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- Dirección --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span
                                                class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                id="inputGroup-sizing-sm">
                                                <i title="Dirección" class="text-primary fas fa-map-marker-alt"></i>
                                            </span>
                                        </div>
                                        <input id="address" placeholder="Dirección" type="text"
                                            class="border-0 bg-input text-dark form-control @error('address') is-invalid @enderror"
                                            name="address" value="{{ $companies->address }}" required
                                            autocomplete="address" autofocus>

                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- Teléfono --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span
                                                class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                id="inputGroup-sizing-sm">
                                                <i title="Número de teléfono" class="text-primary fas fa-mobile"></i>
                                            </span>
                                        </div>
                                        <input id="phone" placeholder="Número de teléfono" type="number"
                                            class="border-0 bg-input text-dark form-control @error('phone') is-invalid @enderror"
                                            name="phone" value="{{ $companies->phone }}" required autocomplete="phone"
                                            autofocus>

                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- imagen --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3 ">
                                        <img src="{{ asset('/storage/companias/' . $companies->file) }}" width="150px"
                                            height="150px" alt="compania">
                                        <Strong> Actualizar <i class="fas fa-arrow-circle-right"></i> <br> imagen <div
                                                class=""></div></Strong>
                                        <input type="file" id="file" name="file" accept="image/*"
                                            class=" @error('file') is-invalid @enderror">
                                        @error('file')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- boton de actualizar --}}
                                    <div class="container mt-4">
                                        <div class="col-12">
                                            <div class="col text-center">
                                                <button type="submit" style="border-radius: 50px"
                                                    class="btn btn-primary mt-3">
                                                    <i class="far fa-save"></i>
                                                    {{ __('GUARDAR') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @else
                            <span style="text-align:center ; font-size:70px" id="countdown"></span>
                            <script>
                                window.onload = updateClock;
                                var totalTime = 10;

                                function updateClock() {
                                    document.getElementById('countdown').innerHTML = totalTime;
                                    if (totalTime == 0) {
                                        console.log('Salga de esta pestaña');
                                        var texto =
                                            "Salga de esta pestaña de lo contrario tendra serios problemas con el administrador"
                                        document.getElementById('countdown').innerHTML = texto;
                                    } else {
                                        totalTime -= 1;
                                        setTimeout("updateClock()", 1000);
                                    }
                                }
                            </script>
                        @endif
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

@endsection
