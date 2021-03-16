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

    <script>
        function Suma() {
            var stock = document.calculadora.stock.value;
            var nombre2 = document.calculadora.nombre2.value;
            try {
                //Calculamos el número escrito:
                stock = (isNaN(parseInt(stock))) ? 0 : parseInt(stock);
                nombre2 = (isNaN(parseInt(nombre2))) ? 0 : parseInt(nombre2);
                document.calculadora.resultado.value = stock + nombre2;
            }
            //Si se produce un error no hacemos nada
            catch (e) {}
        }

    </script>

    <!--Mensaje flash-->
    @if (session('datosEliminados'))
        <div class="alert alert-danger">
            {{ session('datosEliminados') }}
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
                            <strong class="card-title text-light">Editar Noticia</strong>
                        </div>
                        <div class="card-body bg-frm">
                            <div>
                                <form name="calculadora" action="{{ url('Publicaciones/' . $records->id) }}" method="POST"
                                    file="true" enctype="multipart/form-data" onsubmit="return checkSubmit();">
                                    @csrf @method('PATCH')
                                    {{-- <!--Titulo--> --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span
                                                class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                id="inputGroup-sizing-sm">
                                                <i title="Titulo" class="text-primary fas fa-people-carry"></i>
                                            </span>
                                        </div>
                                        <input id="title" name="title" type="text"
                                            class="border-0 bg-input text-dark form-control @error('title') is-invalid @enderror"
                                            value="{{ $records->title }}"
                                            placeholder="Titulo del Producto: ej. computadora" required autocomplete="title"
                                            autofocus>
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- <!-- Descripción --> --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span
                                                class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                id="inputGroup-sizing-sm">
                                                <i title="Descripción" class="text-primary fas fa-book"></i>
                                            </span>
                                        </div>
                                        <input id="description" maxlength="50" name="description" type="text"
                                            class="border-0 bg-input text-dark form-control @error('name') is-invalid @enderror"
                                            value="{{ $records->description }}"
                                            placeholder="Descripción del Producto: ej. especificaciones" required
                                            autocomplete="description" autofocus>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- <!-- link --> --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3">
                                        <div class="input-group-prepend">
                                            <span
                                                class="bg-span border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                                id="inputGroup-sizing-sm">
                                                <i title="{{ $records->link }}" class="text-primary fas fa-book"></i>
                                            </span>
                                        </div>
                                        <input id="link" maxlength="50" name="link" type="text"
                                            class="border-0 bg-input text-dark form-control @error('name') is-invalid @enderror"
                                            value="{{ $records->link }}"
                                            placeholder="Descripcion del Producto: ej. especificaciones" required
                                            autocomplete="link" autofocus title="Url">
                                        @error('link')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- imagen --}}
                                    <div class="col-12 col-md-6 input-group input-group-lg mb-3 ">
                                        <img src="{{ asset('/storage/adds/' . $records->file) }}" width="150px"
                                            height="150px" alt="producto">
                                        <Strong> Actualizar <i class="fas fa-arrow-circle-right"></i> <br> imagen <div
                                                class=""></div></Strong>
                                        <input type="file" id="file" name="file" accept="image/*"
                                            class="border-0 bg-input @error('file') is-invalid @enderror">
                                        @error('file')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
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
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
