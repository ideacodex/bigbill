@extends('layouts.'. Auth::user()->getRoleNames()[0])
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
    @if (session('MENSAJEEXITOSO'))
        <div class="alert  alert-success alert-dismissible fade show" role="alert">
            <div class="alert alert-success">
                {{ session('MENSAJEEXITOSO') }}
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!--Mensaje flash-->

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card bg-card">
                        <div class="card-header bg-cardheader"
                            style="border-top-right-radius: 25px; border-top-left-radius: 25px;">
                            <strong class="card-title text-light">Actualizar Información</strong>
                        </div>
                        <div class="card-body bg-frm">
                            <div>
                                <form action="{{ url('home/' . $user->id) }}" method="POST" file="true"
                                    enctype="multipart/form-data" onsubmit="return checkSubmit();">
                                    @csrf @method('PATCH')

                                    @if (Auth::user()->role_id == 2 || Auth::user()->role_id == 1)
                                        {{-- <!--Role Id--> --}}
                                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                            <div class="input-group-prepend">
                                                <span
                                                    class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                    id="inputGroup-sizing-sm">
                                                    <i title="Nombre" class="text-primary fas fa-people-carry"></i>
                                                </span>
                                            </div>
                                            <select name="role_id" id="role_id"
                                                class="form-control border-0 bg-input @error('role_id') is-invalid @enderror"
                                                required>
                                                <option value="{{ $user->role_id }}">Actualizar Rol</option>
                                                <option value="Gerente">1. Gerente</option>
                                                <option value="Contador">2. Contador</option>
                                                <option value="Vendedor">3. Vendedor</option>
                                            </select>
                                            @error('role_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!--PERMISOS-->
                                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                            <div class="input-group-prepend">
                                                <span
                                                    class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                    id="inputGroup-sizing-sm">
                                                    <i title="Permisos" class="text-primary fas fa-globe"></i>
                                                </span>
                                            </div>
                                            <select name="work_permits" id="work_permits"
                                                class="form-control border-0 bg-input @error('work_permits') is-invalid @enderror">
                                                <option value="{{ $user->work_permits }}">Permisos</option>
                                                <option value="1">Habiliar permisos</option>
                                                <option value="0"> Bloquear permisos</option>
                                            </select>
                                            @error('work_permits')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    @else
                                        <input type="text" value="{{ $user->role_id }}" name="role_id" hidden>
                                        <input type="text" value="{{ $user->work_permits }}" name="work_permits" hidden>

                                    @endif
                                    {{-- <!--Nombre--> --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span
                                                class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                id="inputGroup-sizing-sm">
                                                <i class="text-primary fas fa-user"></i>
                                            </span>
                                        </div>
                                        <input id="name" name="name" type="text"
                                            class="border-0 bg-input text-dark form-control @error('name') is-invalid @enderror"
                                            value="{{ $user->name }}" placeholder="Nombre" required autocomplete="name"
                                            autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- <!-- lastname --> --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span
                                                class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                id="inputGroup-sizing-sm">
                                                <i class="text-primary far fa-user"></i>
                                            </span>
                                        </div>
                                        <input id="lastname" name="lastname" type="text"
                                            class="border-0 bg-input text-dark form-control @error('lastname') is-invalid @enderror"
                                            value="{{ $user->lastname }}" placeholder="Apellidos" required
                                            autocomplete="lastname" autofocus>
                                        @error('lastname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- <!-- phone --> --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span
                                                class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                id="inputGroup-sizing-sm">
                                                <i class="text-primary fas fa-phone"></i>
                                            </span>
                                        </div>
                                        <input id="phone" name="phone" type="text" minlength="6" pattern="[0-9]{6,15}"
                                            class="border-0 bg-input text-dark form-control @error('phone') is-invalid @enderror"
                                            value="{{ $user->phone }}" placeholder="Telefono" required
                                            autocomplete="phone" autofocus>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- <!--  nit --> --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span
                                                class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                id="inputGroup-sizing-sm">
                                                <i class="text-primary fas fa-id-badge"></i>
                                            </span>
                                        </div>
                                        <input id="nit" name="nit" type="text"
                                            class="border-0 bg-input text-dark form-control @error('nit') is-invalid @enderror"
                                            style="color:white" value="{{ $user->nit }}" placeholder="nit" required
                                            autocomplete="nit" autofocus>
                                        @error('nit')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- <!--  address --> --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span
                                                class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                id="inputGroup-sizing-sm">
                                                <i class="text-primary fas fa-map-marker-alt"></i>
                                            </span>
                                        </div>
                                        <input id="address" name="address" type="text"
                                            class="border-0 bg-input text-dark form-control @error('address') is-invalid @enderror"
                                            value="{{ $user->address }}" placeholder="guatemala, guatemla" required
                                            autocomplete="address" autofocus>
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- <!-- email  --> --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span
                                                class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                id="inputGroup-sizing-sm">
                                                <i class="text-primary fas fa-envelope"></i>
                                            </span>
                                        </div>
                                        <input id="email" name="email" type="text"
                                            class="border-0 bg-input text-dark form-control @error('email') is-invalid @enderror"
                                            value="{{ $user->email }}" placeholder="email@extension.com" required
                                            autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- imagen --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3 ">
                                        <img src="{{ asset('/storage/usuarios/' . $user->file) }}" width="150px"
                                            height="150px" alt="Usuario">
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
                                    {{-- <!--Company_id--> --}}
                                    @if (Auth::user()->role_id == 2 && Auth::user()->company_id != null)
                                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                            <div class="input-group-prepend">
                                                <span
                                                    class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                    id="inputGroup-sizing-sm">
                                                    <i title="company" class="text-primary far fa-building"></i>
                                                </span>
                                            </div>
                                            <select name="company_id" id="company_id"
                                                class="border-0 bg-input form-control @error('company_id') is-invalid @enderror"
                                                required>

                                                <option value="{{ Auth::user()->companies->nit }}" selected>
                                                    <p>
                                                        Su companía: {{ Auth::user()->companies->name }}
                                                    </p>
                                                </option>
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
                                                    <span
                                                        class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                        id="inputGroup-sizing-sm">
                                                        <i title="company" class="text-primary far fa-building"></i>
                                                    </span>
                                                </div>
                                                <select name="company_id" id="company_id"
                                                    class="border-0 bg-input form-control @error('company_id') is-invalid @enderror"
                                                    required>
                                                    @if (Auth::user()->company_id)
                                                        <option value="{{ Auth::user()->companies->nit }}" selected>
                                                            <p>
                                                                Su companía: {{ auth::user()->companies->name }}
                                                            </p>
                                                        </option>

                                                        @foreach ($company as $item)
                                                            @if ($item->id != Auth::user()->company_id)
                                                                <option value="{{ $item->nit }}">{{ $item->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <option value="" selected>
                                                            <p>
                                                                Elija una Empresa
                                                            </p>
                                                        </option>
                                                        @foreach ($company as $item)
                                                            <option value="{{ $item->nit }}">{{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        @else
                                            {{-- company_id --}}
                                            @if (!Auth::user()->company_id)
                                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                                    <div class="input-group-prepend">
                                                        <span
                                                            class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                            id="inputGroup-sizing-sm">
                                                            <i title="company" class="text-primary far fa-building"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" minlength="8" pattern="[0-9]{6,15}" name="company_id"
                                                        id="company_id"
                                                        class="border-0 bg-input form-control  @error('company_id') is-invalid @enderror"
                                                        placeholder="Nit de la empresa">
                                                    @error('company_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            @else
                                                <input type="hidden" value="{{ Auth::user()->companies->nit }}"
                                                    name="company_id">
                                                {{-- <!-- compania para tosdos los usuarios que ya tengan empresa  --> --}}
                                                <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                                    <div class="input-group-prepend">
                                                        <span
                                                            class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                            id="inputGroup-sizing-sm">
                                                            <i title="company" class="text-primary far fa-building"></i>
                                                        </span>
                                                    </div>
                                                    <span class="border-0 bg-input text-dark form-control ">
                                                        {{ Auth::user()->companies->name }}
                                                    </span>
                                                </div>
                                            @endif
                                        @endif
                                    @endif
                                    {{-- Sucursal --}}
                                    @if ((Auth::user()->role_id == 4 || Auth::user()->role_id == 3) && Auth::user()->branch_id == null)
                                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                            <div class="input-group-prepend">
                                                <span
                                                    class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                    id="inputGroup-sizing-sm">
                                                    <i title="company" class="text-primary far fa-building"></i>
                                                </span>
                                            </div>
                                            <span class="border-0 bg-input text-dark form-control ">
                                                Sucursal Central
                                            </span>
                                        </div>
                                    @else
                                        <div class="col-12 col-md-6 input-group input-group-lg mb-4">
                                            <div class="input-group-prepend">
                                                <span
                                                    class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                    id="inputGroup-sizing-sm">
                                                    <i title="company" class="text-primary far fa-building"></i>
                                                </span>
                                                <select name="branch_id" id="branch_id"
                                                    class="select2 form-control border-0 bg-input @error('branch_id') is-invalid @enderror">
                                                    @if ($user->branch_id)
                                                        <option value="{{ $user->company_id }}" selected>
                                                            <p>
                                                                Sucursal: {{ $user->branch_offices->name }}
                                                            </p>
                                                        </option>
                                                        <option value="">Quitar Sucursal</option>
                                                    @else
                                                        <option value="" selected disabled>
                                                            <p>Sin Sucursal</p>
                                                        </option>
                                                    @endif
                                                    @foreach ($branch_office as $item)
                                                        @if (Auth::user()->role_id == 1)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->company->name }} -
                                                                {{ $item->name }}</option>
                                                        @else
                                                            @if (Auth::user()->role_id == 2)
                                                                @if ($item != null)
                                                                    @if ($item->company->nit == Auth::user()->companies->nit)
                                                                        @if ($user->branch_id)
                                                                            @if ($item->id != $user->branch_id)
                                                                                <option value="{{ $item->id }}">
                                                                                    {{ $item->company->name }} -
                                                                                    {{ $item->name }}</option>
                                                                            @endif
                                                                        @else
                                                                            <option value="{{ $item->id }}">
                                                                                {{ $item->company->name }} -
                                                                                {{ $item->name }}</option>
                                                                        @endif
                                                                    @endif
                                                                @else
                                                                    <option> Sin sucursales</option>

                                                                @endif

                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @error('branch_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif

                                    {{-- <!--Button--> --}}
                                    <div class="container mt-4">
                                        <div class="col-12">
                                            <div class="col text-center">
                                                <button type="submit" style="border-radius: 50px"
                                                    class="btn btn-lg btn-primary mt-3">
                                                    <i class="far fa-save"></i>
                                                    {{ __('Actualizar Informacion') }}
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
        </div><!-- .animated -->
    </div><!-- .content -->

@endsection
