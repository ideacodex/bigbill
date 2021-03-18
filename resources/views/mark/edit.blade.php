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
                    <div class="card bg-card">
                        @if ((Auth::user()->work_permits == 1 && (Auth::user()->role_id == 2 || Auth::user()->role_id == 4) && Auth::user()->company_id == $mark->company_id) || Auth::user()->role_id == 1)
                            <div class="card-header bg-cardheader" style="border-top-right-radius: 25px; 
                                        border-top-left-radius: 25px;">
                                <strong class="card-title text-light">Editar marca</strong>
                            </div>
                            <div class="card-body bg-frm">
                                <div>
                                    <form action="{{ url('marcas/' . $mark->id) }}" method="POST" file="true"
                                        enctype="multipart/form-data" onsubmit="return checkSubmit();">
                                        @csrf @method('PATCH')
                                        {{-- <!--Nombre--> --}}
                                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                            <div class="input-group-prepend">
                                                <span
                                                    class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                    id="inputGroup-sizing-sm">
                                                    <i title="Nombre" class="text-primary fas fa-people-carry"></i>
                                                </span>
                                            </div>
                                            <input id="name" name="name" type="text"
                                                class="text-dark form-control border-0 bg-input @error('name') is-invalid @enderror"
                                                value="{{ $mark->name }}"
                                                placeholder="Nombre del Producto: ej. computadora" required
                                                autocomplete="name" autofocus>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        {{-- <!--Company_id--> --}}
                                        @if (Auth::user()->role_id == 1)
                                            {{-- company --}}
                                            <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                                <div class="input-group-prepend">
                                                    <span
                                                        class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                        id="inputGroup-sizing-sm">
                                                        <i title="company" class="text-primary far fa-building"></i>
                                                    </span>
                                                </div>
                                                <select name="company_id" id="company_id"
                                                    class="form-control border-0 bg-input @error('company_id') is-invalid @enderror">
                                                    @if (auth()->user()->company_id)
                                                        <option value="{{ auth()->user()->company_id }}" selected>
                                                            <p>
                                                                Su companía: {{ auth()->user()->company->name }}
                                                            </p>
                                                        </option>
                                                    @endif

                                                    @foreach ($company as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('company_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </div>
                                        @else
                                            {{-- Company_id --}}
                                            <input type="hidden" value="{{ Auth::user()->company_id }}" name="company_id">
                                        @endif
                                        <!--Button-->
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
                            </div>

                        @else
                            <span style="text-align:center ; font-size:70px" id="countdown"></span>

                            <script>
                                window.onload = updateClock;
                                var totalTime = 10;

                                function updateClock() {
                                    document.getElementById('countdown').innerHTML = totalTime;
                                    var boton = document.getElementById('botoncito');
                                    if (totalTime == 0) {
                                        console.log('Salga de esta pestaña');
                                        var texto =
                                            "Salga de esta pestaña de lo contrario tendra serios problemas con el administrador"
                                        boton.className = "col-12 col-md-6 input-group input-group-lg mb-3";
                                        document.getElementById('countdown').innerHTML = texto;
                                    } else {
                                        totalTime -= 1;
                                        setTimeout("updateClock()", 1000);
                                    }
                                }

                            </script>
                            <div class="d-none" id="botoncito">
                                <a href="{{ url('marcas') }}">
                                    <div class="container mt-4">
                                        <div class="col-12">
                                            <div class="col text-center">
                                                <button type="submit" style="border-radius: 50px"
                                                    class="btn btn-primary mt-3">
                                                    <i class="fas fa-undo"></i>
                                                    {{ __('VOLVER') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
