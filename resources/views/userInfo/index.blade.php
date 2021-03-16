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


    {{-- perfil --}}

 {{-- Anuncios --}}
 <input type="checkbox" id="cerrar">
 <label for="cerrar" id="btn-cerrar"> <b>X</b></label>
 <div class="modals">
     @if ($records)
         <div class="contenido">
             @foreach ($records as $item)
                 @if ($item != null)
                     <h2 class=" Rubik-Medium " style="color: rgba(5, 9, 46, 1)">
                         <strong> {{ $item->title }}</strong>
                     </h2>
                     <br>
                     <br>
                     <div style="background-color: #050033; border-radius: 100% 100% 0 0/ 20% 20% 0 0; margin-top: -3em;"
                         class="card-text">
                         @if ($item->file != null)
                             <img src="{{ asset('/storage/adds/' . $item->file) }}" class="mt-3" height="180px"
                                 width="175px">
                         @else
                             <img src="img/simbolo_logo.png" class="mt-3" width="175px">
                         @endif

                         <p class="pt-1 ml-4 mr-3 Rubik-Medium">
                             {{ $item->description }}
                         </p>
                         @if ($item->link != null)
                             <hr>
                             <a href=" {{ $item->link }}">
                                 <button class="bttn-unite bttn-md bttn-primary">
                                     ¡Conoce más!
                                 </button>
                             </a>
                             <br>
                         @endif
                         <br>
                     </div>

                 @else
                     <h2 class=" Rubik-Medium " style="color: rgba(5, 9, 46, 1)">
                         <strong> Bienvenido a Big Bill</strong>
                     </h2>
                     <br>
                     <br>
                     <div style="background-color: #050033; border-radius: 100% 100% 0 0/ 20% 20% 0 0; margin-top: -3em;"
                         class="card-text">
                         <img src="img/simbolo_logo.png" class="mt-3" width="175px">
                         <p class="pt-1 ml-4 mr-3 Rubik-Medium">
                             Plataforma en línea que te permitirá emitir comprobantes de pagos, además de crear facturas,
                             podrás llevar el control de tu stock de productos.
                         </p>

                         <hr>
                         <a href="{{ url('/register') }}">
                             <button class="bttn-unite bttn-md bttn-primary">
                                 ¡Unete y prueba la diferencia!
                             </button>
                         </a>
                         <br>
                         <br>
                     </div>
                 @endif
             @endforeach
         </div>
     @else
         <div class="contenido">
             <h2 class=" Rubik-Medium " style="color: rgba(5, 9, 46, 1)">
                 <strong> Bienvenido a Big Bill</strong>
             </h2>
             <br>
             <br>
             <div style="background-color: #050033; border-radius: 100% 100% 0 0/ 20% 20% 0 0; margin-top: -3em;"
                 class="card-text">
                 <img src="img/simbolo_logo.png" class="mt-3" width="175px">
                 <p class="pt-1 ml-4 mr-3 Rubik-Medium">
                     Plataforma en línea que te permitirá emitir comprobantes de pagos, además de crear facturas,
                     podrás llevar el control de tu stock de productos.
                 </p>

                 <hr>
                 <a href="{{ url('/register') }}">
                     <button class="bttn-unite bttn-md bttn-primary">
                         ¡Unete y prueba la diferencia!
                     </button>
                 </a>
                 <br>
                 <br>
             </div>
         </div>
     @endif
 </div>
 {{-- fin de anuncios --}}


    <div class="content mt-3">
        <div class="row">
            <div class="col-md-9 ml-2">
                <aside class="profile-nav alt">
                    <section class="card rounded border-0">
                        <div class="card-header user-header border-radius: 15px"
                            style="background-color: black; border-radius: 15px">
                            <div class="media" style="background-color: black">
                                @if (Auth::user()->file != null)
                                    {{-- imagen --}}
                                    <img src="{{ asset('/storage/usuarios/' . Auth::user()->file) }}" class="image"
                                        class="rounded-circle" width="80px" height="80px" alt="Usuario">
                                @else
                                    <img src="{{ asset('img/user.png') }}" class="image" width="130px" height="130px"
                                        alt="Usuario">
                                @endif
                                <div class="media-body">

                                    <h2 class="text-primary display-6 ml-5"> <b> {{ Auth::user()->name }}
                                            {{ Auth::user()->lastname }}</b>
                                    </h2>
                                    <p class="text-light ml-5"> {{ Auth::user()->email }}</p>
                                </div>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush">
                            <strong class="list-group-item mt-2 border-top-0 border-bottom-0"
                                style="background-color: rgba(224, 220, 220, 0.993); border-top-right-radius: 15px; border-bottom-right-radius: 15px; border-left: #1e4ce4 7px solid;">
                                <a href="#"><i class="text-primary fas fa-user"></i>
                                    <label style="color: rgb(61, 59, 59)"> {{ Auth::user()->name }}</label>
                            </strong>

                            <li class="list-group-item mt-2 border-top-0 border-bottom-0"
                                style="background-color: rgba(224, 220, 220, 0.993); border-top-right-radius: 15px; border-bottom-right-radius: 15px; border-left: #1e4ce4 7px solid;">
                                <a href="#"> <i class="text-primary  fas fa-user"></i>
                                    <label style="color: rgb(61, 59, 59)">
                                        {{ Auth::user()->lastname }}</label>
                            </li>
                            <li class="list-group-item mt-2 border-top-0 border-bottom-0"
                                style="background-color: rgba(224, 220, 220, 0.993); border-top-right-radius: 15px; border-bottom-right-radius: 15px; border-left: #1e4ce4 7px solid;">
                                <a href="#"> <i class="fas fa-phone text-primary "></i>
                                    <label style="color: rgb(61, 59, 59)">
                                        {{ Auth::user()->phone }}</label>
                            </li>
                            <li class="list-group-item mt-2 border-top-0 border-bottom-0"
                                style="background-color: rgba(224, 220, 220, 0.993); border-top-right-radius: 15px; border-bottom-right-radius: 15px; border-left: #1e4ce4 7px solid;">
                                <a href="#"> <i class="fas fa-tag text-primary "></i>
                                    <label style="color: rgb(61, 59, 59)">
                                        {{ Auth::user()->nit }}</label>
                            </li>
                            <li class="list-group-item mt-2 border-top-0 border-bottom-0"
                                style="background-color: rgba(224, 220, 220, 0.993); border-top-right-radius: 15px; border-bottom-right-radius: 15px; border-left: #1e4ce4 7px solid;">
                                <a href="#"><i class="fas fa-user-shield text-primary "></i>
                                    <label style="color: rgb(61, 59, 59)">
                                        {{ Auth::user()->address }}</label>
                            </li>
                            <li class="list-group-item mt-2 border-top-0 border-bottom-0"
                                style="background-color: rgba(224, 220, 220, 0.993); border-top-right-radius: 15px; border-bottom-right-radius: 15px; border-left: #1e4ce4 7px solid;">
                                <a href="#"><i class="fas fa-envelope text-primary "></i>
                                    <label style="color: rgb(61, 59, 59)">
                                        {{ Auth::user()->email }}</label>
                            </li>
                            <li class="list-group-item mt-2 border-top-0 border-bottom-0"
                                style="background-color: rgba(224, 220, 220, 0.993); border-top-right-radius: 15px; border-bottom-right-radius: 15px; border-left: #1e4ce4 7px solid;">
                                <a href="#"><i class="fas fa-building text-primary "></i>
                                    @if (Auth::user()->company_id)


                                        @foreach ($company as $item)
                                            <label style="color: rgb(61, 59, 59)">
                                                {{ $item->name }}</label>
                                        @endforeach
                                    @else
                                        <label style="color: rgb(61, 59, 59)">
                                            Sin Compañia</label>
                                    @endif
                                </a>
                            </li>
                            <li class="list-group-item mt-2 border-top-0 border-bottom-0"
                                style="background-color: rgba(224, 220, 220, 0.993); border-top-right-radius: 15px; border-bottom-right-radius: 15px; border-left: #3766ff 7px solid;">
                                <a href="#"><i class="fas fa-building text-primary "></i>
                                    @if (Auth::user()->branch_id)
                                        @foreach ($branch_offices as $item)
                                            <label style="color: rgb(61, 59, 59)">
                                                {{ $item->name }}</label>
                                        @endforeach
                                    @else
                                        <label style="color: rgb(61, 59, 59)">
                                            Sin Sucursal</label>
                                    @endif
                                </a>
                            </li>
                            <li class="list-group-item border-0">
                                <a class="btn btn-sm btn-primary" style="border-radius: 15px ; "
                                    href="{{ url('home/' . Auth::user()->id . '/edit') }}" title="Editar">
                                    <span><b>ACTUALIZAR INFORMACIÓN</b></span>
                                </a>
                            </li>
                        </ul>
                    </section>
                </aside>
            </div>
        </div>
    </div>
@endsection
