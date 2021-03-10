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
                            <div class="card-header bg-cardheader" style="border-top-right-radius: 25px; 
                                        border-top-left-radius: 25px;">
                                <strong class="card-title text-light">Actualizar Usuario : Rol:
                                    {{ $user->role_id }}</strong>
                            </div>
                            <div class="card-body bg-frm">

                                @if (Auth::user()->work_permits == 1 || Auth::user()->role_id == 1)

                                    <form action="{{ url('UsuariosEmpresa/' . $user->id) }}" method="POST"
                                        enctype="multipart/form-data" onsubmit="return checkSubmit();">
                                        @csrf @method('PATCH')
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
                                                class="form-control border-0 bg-input @error('role_id') is-invalid @enderror">
                                                <option value="{{ $user->role_id }}">Actualizar Rol</option>
                                                @if (Auth::user()->role_id == 1)
                                                    <option value="1">1. Administrador</option>
                                                    <option value="2">2. Gerente</option>
                                                    <option value="3">3. Contador</option>
                                                    <option value="4">4. Vendedor</option>
                                                @else
                                                    @if (Auth::user()->role_id == 2)
                                                        <option value="2">1. Gerente</option>
                                                        <option value="3">2. Contador</option>
                                                        <option value="4">3. Vendedor</option>
                                                    @endif
                                                @endif

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
                                        <!--Nombre-->
                                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                            <div class="input-group-prepend">
                                                <span
                                                    class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                    id="inputGroup-sizing-sm">
                                                    <i class="text-primary fas fa-user"></i>
                                                </span>
                                            </div>
                                            <input id="name" name="name" type="text"
                                                class="text-dark form-control border-0 bg-input @error('name') is-invalid @enderror"
                                                value="{{ $user->name }}" placeholder="Nombre" required
                                                autocomplete="name" autofocus>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <!-- lastname -->
                                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                            <div class="input-group-prepend">
                                                <span
                                                    class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                    id="inputGroup-sizing-sm">
                                                    <i class="text-primary far fa-user"></i>
                                                </span>
                                            </div>
                                            <input id="lastname" name="lastname" type="text"
                                                class="text-dark form-control border-0 bg-input @error('lastname') is-invalid @enderror"
                                                value="{{ $user->lastname }}" placeholder="Apellidos" required
                                                autocomplete="lastname" autofocus>
                                            @error('lastname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <!-- phone -->
                                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                            <div class="input-group-prepend">
                                                <span
                                                    class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                    id="inputGroup-sizing-sm">
                                                    <i class="text-primary fas fa-phone"></i>
                                                </span>
                                            </div>
                                            <input id="phone" name="phone" type="text"
                                                class="text-dark form-control border-0 bg-input @error('phone') is-invalid @enderror"
                                                value="{{ $user->phone }}" placeholder="Telefono" required
                                                autocomplete="phone" autofocus>
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <!--  nit -->
                                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                            <div class="input-group-prepend">
                                                <span
                                                    class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                    id="inputGroup-sizing-sm">
                                                    <i class="text-primary fas fa-id-badge"></i>
                                                </span>
                                            </div>
                                            <input id="nit" name="nit" type="text"
                                                class="text-dark form-control border-0 bg-input @error('nit') is-invalid @enderror"
                                                style="color:white" value="{{ $user->nit }}" placeholder="nit" required
                                                autocomplete="nit" autofocus>
                                            @error('nit')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <!--  address -->
                                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                            <div class="input-group-prepend">
                                                <span
                                                    class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                    id="inputGroup-sizing-sm">
                                                    <i class="text-primary fas fa-map-marker-alt"></i>
                                                </span>
                                            </div>
                                            <input id="address" name="address" type="text"
                                                class="text-dark form-control border-0 bg-input @error('address') is-invalid @enderror"
                                                value="{{ $user->address }}" placeholder="guatemala, guatemla" required
                                                autocomplete="address" autofocus>
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- email  -->
                                        <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                            <div class="input-group-prepend">
                                                <span
                                                    class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                    id="inputGroup-sizing-sm">
                                                    <i class="text-primary fas fa-envelope"></i>
                                                </span>
                                            </div>
                                            <input id="email" name="email" type="text"
                                                class="text-dark form-control border-0 bg-input @error('email') is-invalid @enderror"
                                                value="{{ $user->email }}" placeholder="email@extension.com" required
                                                autocomplete="email" autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        {{-- company --}}
                                        <div class="col-12 col-md-6 input-group input-group-lg mb-4">
                                            <div class="input-group-prepend">
                                                <span
                                                    class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                    id="inputGroup-sizing-sm">
                                                    <i title="company" class="text-primary far fa-building"></i>
                                                </span>
                                            </div>
                                            <select name="company_id" id="company_id"
                                                class="form-control border-0 bg-input @error('company_id') is-invalid @enderror">
                                                @if ($user->company_id)
                                                    <option value="{{ $user->company_id }}" selected>
                                                        <p>
                                                            Companía: {{ $user->companies->name }}
                                                        </p>
                                                    </option>
                                                    <option value="">Quitar Companía</option>
                                                @else
                                                    <option value="" selected disabled>
                                                        <p>Sin Companía</p>
                                                    </option>
                                                @endif

                                                @foreach ($companies as $item)
                                                    @if ($item->id != $user->company_id)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endif


                                                @endforeach
                                            </select>
                                            @error('company_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        {{-- Sucursal --}}
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
                                                        <option value="{{ $item->id }}">{{ $item->company->name }} -
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('branch_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!--Button-->
                                        <div class="container mt-4">
                                            <div class="col-12">
                                                <div class="col text-center">
                                                    <button type="submit" style="border-radius: 50px"
                                                        class="btn btn-primary mt-3">
                                                        <i class="far fa-save"></i>
                                                        {{ __('Actualizar Información') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                @endif
                            </div>

                        </div>
                    </div>

                </div>
                <img class="derecha" src="{{ asset('images/ideacode.png') }}">
            </div><!-- .animated -->
        </div><!-- .content -->

    @endsection
