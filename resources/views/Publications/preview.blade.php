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
    @if (session('Mensaje'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            <span class="badge badge-pill badge-success">Atención</span>
            {{ session('Mensaje') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!--Mensaje flash-->

    <div class="card-body d-flex justify-content-between align-items-center">
        <button type="button" style="border-radius: 95px;" class="btn btn-success mb-1 ml-2 mt-2" data-toggle="modal"
            data-target="#exampleModal" data-whatever="@mdo">
            + AGREGAR ANUNCIO
        </button>
    </div>
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="background-color: black; color: white; border-radius: 15px">
                            <strong class="card-title">Anuncio</strong>
                        </div>
                        <div class="card-body">
                            <div class="row table-responsive">
                                <div class="col-12">
                                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                        <thead style="border-radius: 15px; background-color: black; color:white">
                                            <tr>
                                                <th>No. </th>
                                                <th>Titulo</th>
                                                <th>Descripcion</th>
                                                <th>URL</th>
                                                <th>Imagen</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody style="background-color: rgba(224, 220, 220, 0.993);">
                                            @foreach ($records as $item)
                                                <tr>
                                                    <th style="border-left: #325ff5 7px solid;"
                                                        title="{{ $loop->index + 1 }}">{{ $loop->index + 1 }}</th>
                                                    <td title="{{ $item->title }}">{{ $item->title }}</td>
                                                    <td title="{{ $item->description }}">{{ $item->description }}</td>
                                                    @if ($item->link != null)
                                                        <td title="{{ $item->link }}">
                                                            <a href=" {{ $item->link }}">
                                                                <button class="bttn-unite bttn-md bttn-primary">
                                                                    ¡Conoce más!
                                                                </button>
                                                            </a>
                                                        </td>
                                                    @else
                                                        <td>
                                                            No cuenta con enlace
                                                        </td>
                                                    @endif

                                                    @if ($item->file != null)
                                                        <td>
                                                            <img src="{{ asset('/storage/adds/' . $item->file) }}"
                                                                height="100px" width="100px">
                                                        </td>
                                                    @else
                                                        <td>
                                                            si 
                                                            No Existe
                                                        </td>
                                                    @endif

                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a title="Actualizar Tipo de Cuenta"
                                                                class="btn btn-sm btn-primary rounded-circle"
                                                                href="{{ url('Publicaciones/' . $item->id . '/edit') }}"
                                                                title="Editar">
                                                                <span><i class="fas fa-edit"></i></span>
                                                            </a>

                                                        </div>
                                                    </td>
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border-radius: 15px">
                <div class="modal-header" style="background-color: black; ">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: white"><b>Nuevo tipo de cuenta</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style="color: red" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-frm">
                    <form method="POST" action="{{ route('Publicaciones.store') }}" onsubmit="return checkSubmit();"
                        enctype="multipart/form-data" file="true">
                        @csrf
                        <div class="form-group">
                            {{-- Titulo --}}
                            <div class="col-12 col-md-12 input-group input-group-lg mb-3 mt-2">
                                <div class="input-group-prepend">
                                    <span style="background: transparent; border-left: #325ff5 7px solid;"
                                        class="border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                        id="inputGroup-sizing-sm">
                                        <i title="Titulo" class="text-primary fas fa-font"></i>
                                    </span>
                                </div>
                                <input style="background: transparent" id="title" name="title" type="text"
                                    class="border-0 text-dark form-control @error('title') is-invalid @enderror"
                                    value="{{ old('title') }}" placeholder="Titulo" required autocomplete="title"
                                    autofocus>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- Descripcion --}}
                            <div class="col-12 col-md-12 input-group input-group-lg mb-3 mt-2">
                                <div class="input-group-prepend" style="border-left: #325ff5 7px solid; border-radius:10px">
                                    <span style="background: transparent; "
                                        class="border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                        id="inputGroup-sizing-sm">
                                        <i title="Nombre" class="text-primary far fa-comment-alt"
                                            style="   font-size: 25px; "></i>
                                    </span>
                                </div>
                                <textarea rows="3" cols="30" style="background: transparent" id="description"
                                    name="description" class="text-dark @error('description') is-invalid @enderror"
                                    value="{{ old('description') }}" placeholder="Descripcion" required
                                    autocomplete="description" autofocus></textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- Link --}}
                            <div class="col-12 col-md-12 input-group input-group-lg mb-3 mt-2">
                                <div class="input-group-prepend">
                                    <span style="background: transparent; border-left: #325ff5 7px solid; "
                                        class="border-top-0 border-bottom-0 border-right-0 input-group-text transparent"
                                        id="inputGroup-sizing-sm">
                                        <i title="link" class="text-primary fas fa-link"></i>
                                    </span>

                                </div>
                                <input style="background: transparent" id="link" name="link" type="url"
                                    class="border-0 text-dark form-control @error('link') is-invalid @enderror"
                                    value="{{ old('link') }}" placeholder="Enlace de publicacion" autocomplete="link"
                                    autofocus>
                                @error('link')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- imagen --}}
                            <div class="col-12 col-md-12 input-group input-group-lg mb-3">
                                <input style="background: transparent" type="file" id="file" name="file" accept="image/*"
                                    class="border-0 text-dark form-control @error('file') is-invalid @enderror" required>
                                @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button style="border-radius: 50px; height: 35px" type="button" class="btn btn-danger mt-3"
                                data-dismiss="modal"><i class="fas fa-times-circle"></i> CERRAR
                            </button>
                            <button type="submit" style="border-radius: 50px; height: 35px" class="btn btn-primary mt-3">
                                <i class="far fa-save"></i>
                                {{ __('GUARDAR') }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
















{{-- controlador --}}

{{-- // namespace App\Http\Controllers;

// use App\Adds;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

// class publicaciones extends Controller
// {
//     // Publicaciones - vista ususario
//     public function Publications()
//     {
//        
//     }

//     // Publicaciones - vista administrador
//     public function viewPublications()
//     {
//        
//     }
//     public function store(Request $request)
//     {
//         
//     }
// } --}}
