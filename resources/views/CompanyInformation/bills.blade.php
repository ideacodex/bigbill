{{-- <body style=" font: Arial">
   <div name="factura">
       <div class="row">
           <div class="col-md-2 col-sm-3 col-xs-2 clearfix"
               style="background: #092863;border: 1px solid #000;padding: 10px;">
               <table>
                   <tr>
                       <td>
                           <h2 style="color: rgb(91, 155, 238); font: Arial; ">Factura</h2>
                           <h2 style="color: rgb(91, 155, 238);">{{ $data->company->name }}</h2>
                       </td>
                       <td>
                           <strong style="color: #092863; ">---------------------------------</strong>
                       </td>
                   </tr>
               </table>
           </div>
       </div>
       <div>
           <div class="row">
               <div class="col-md-2 col-sm-3 col-xs-2 clearfix"
                   style="background: #092863; border:1px solid #000; padding:10px;">
                   <strong style="color: #ffffff">No. Factura: 20<?php echo date('y'); ?>-
                       {{ $data->id }}</strong>
                   <br>
                   <strong style="color: #ffffff">Dirección: {{ $data->company->address }}</strong>
                   <br>
                   <strong style="color: #ffffff">Teléfono: {{ $data->company->phone }}</strong>
                   <br>
                   <strong style="color: #ffffff">Nit: {{ $data->company->nit }}</strong>
                   <br>
                   <strong style="color: #ffffff">Fecha: <?php echo date('d/m/y'); ?></strong>
               </div>
           </div>
       </div>
       <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #d1cfcbd0">
           <h3 style="color: black"><b> Datos del Cliente: </b></h3>
       </div>

       <Strong style="color: black">Nombre: </Strong>
       @if ($data->customer)
           <strong style="color: black">{{ $data->customer->name }} {{ $data->customer->lastname }}</strong>
       @else

           <strong style="color: black">C/F</strong>

       @endif
       <br>
       <Strong style="color: black">Nit: </Strong>
       @if ($data->customer)
           <strong style="color: black">{{ $data->customer->nit }}</strong>
       @else

           <strong style="color: black">xxxx</strong>

       @endif
       <br>
       <Strong style="color: black">Tel: </Strong>
       @if ($data->customer)
           <strong style="color: black">{{ $data->customer->phone }}</strong>
       @else

           <strong style="color: black"> 00000000 </strong>

       @endif
       <br>
       <Strong style="color: black">Direccion: </Strong>
       <strong style="color: black"> Guatemala</strong>
       <br>
       <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #d1cfcbd0">
           <h3 style="color: black"><b> Detalle: </b></h3>
       </div>

       <div class="row">
           <table>
               <tr>
                   <th>
                       <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black"> No.
                       </div>
                   </th>
                   <th>
                       <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"
                           style="background: #dddbd9; color: black; color: black"> Cantidad </div>
                   </th>
                   <th>
                       <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black">
                           Descripción</div>
                   </th>
                   <th>
                       <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black"> P/U
                       </div>
                   </th>
                   <th>
                       <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black">
                           Subtotal</div>
                   </th>
               </tr>
               @foreach ($data->detail as $item)
                   <tr>
                       <th>
                           <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">
                               {{ $loop->index + 1 }}
                           </div>
                       </th>
                       <th>
                           <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">
                               {{ $item->quantity }}
                           </div>
                       </th>
                       <th>
                           <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">
                               {{ $item->product->name }}
                       </th>
                       <th>
                           <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">
                               {{ $item->unit_price }}
                       </th>
                       <th>
                           <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">
                               {{ $item->subtotal }}
                       </th>
                   </tr>
               @endforeach

               <tr>
                   <td colspan="4">
                       <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"
                           style="background: #69a9f1;color:black ;text-align: right">
                           <b>IVA</b>
                       </div>
                   </td>
                   <td>
                       <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"
                           style="background: #ffffff; text-align: right">

                           {{ $data->iva }}
                       </div>
                   </td>
               </tr>

               <tr>
                   <td colspan="4">
                       <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"
                           style="background: #69a9f1; color:black; text-align: right">
                           <b>Total</b>
                       </div>
                   </td>
                   <td>
                       <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"
                           style="background: #ffffff; color: black; text-align: right">
                           {{ $data->total }}
                       </div>
                   </td>
               </tr>
           </table>
       </div>
   </div>
   <br>
   <br><br>
   <br>

   <label style="background: #9dc2ec; color:black"><b>Atendido por:</b></label>
   <strong style="color: black"> {{ $data->user->name }} {{ $data->user->lastname }}</strong>
</body>


<table>
    <tr>
        <td>id</td>
        <td>nombre</td>
        <td>apellido</td>
    </tr>
    @foreach ($usuarios as $usuario)
        <tr>
            <td>{{ $usuario->id }}</td>
            <td>{{ $usuario->name }}</td>

            <td>{{ $usuario->company_id }}</td>
        </tr>
    @endforeach
</table> --}}





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>

</head>

<body style=" font: Arial">
    <div name="factura">
        <div class="row">
            <div class="col-md-2 col-sm-3 col-xs-2 clearfix"
                style="background: #092863;border: 1px solid #000;padding: 10px;">
                <table>
                    <tr>
                        <td>
                            <h2 style="color: rgb(91, 155, 238); font: Arial; ">Factura</h2>
                            <h2 style="color: rgb(91, 155, 238);">{{ $records->company->name }}</h2>
                        </td>
                        <td>
                            <strong style="color: #092863; ">---------------------------------</strong>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div>
            <div class="row">
                <div class="col-md-2 col-sm-3 col-xs-2 clearfix"
                    style="background: #092863; border:1px solid #000; padding:10px;">
                    <strong style="color: #ffffff">No. Factura: 20<?php echo date('y'); ?>-
                        {{ $records->id }}</strong>
                    <br>
                    <strong style="color: #ffffff">Dirección: {{ $records->company->address }}</strong>
                    <br>
                    <strong style="color: #ffffff">Teléfono: {{ $records->company->phone }}</strong>
                    <br>
                    <strong style="color: #ffffff">Nit: {{ $records->company->nit }}</strong>
                    <br>
                    <strong style="color: #ffffff">Fecha: <?php echo date('d/m/y'); ?></strong>
                    <br>
                    <strong style="color: #ffffff">Adquisición de: </strong>

                    @if ($records->acquisition == 1)
                        <strong style="color: #ffffff">Bienes</strong>
                    @elseif($records->acquisition == 2)
                        <strong style="color: #ffffff">Servicios</strong>
                    @elseif($records->acquisition == 3)
                        <strong style="color: #ffffff">Bienes y Servicios</strong>
                    @endif

                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #d1cfcbd0">
            <h3 style="color: black"><b> Datos del Cliente: </b></h3>
        </div>

        <Strong style="color: black">Nombre: </Strong>
        @if ($records->customer)
            <strong style="color: black">{{ $records->customer->name }} {{ $records->customer->lastname }}</strong>
        @else

            <strong style="color: black">C/F</strong>

        @endif
        <br>
        <Strong style="color: black">Nit: </Strong>
        @if ($records->customer)
            <strong style="color: black">{{ $records->customer->nit }}</strong>
        @else

            <strong style="color: black">xxxx</strong>

        @endif
        <br>
        <Strong style="color: black">Tel: </Strong>
        @if ($records->customer)
            <strong style="color: black">{{ $records->customer->phone }}</strong>
        @else

            <strong style="color: black"> 00000000 </strong>

        @endif
        <br>
        <Strong style="color: black">Direccion: </Strong>
        <strong style="color: black"> Guatemala</strong>
        <br>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #d1cfcbd0">
            <h3 style="color: black"><b> Detalle: </b></h3>
        </div>

        <div class="row">
            <table>
                <tr>
                    <th>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black"> No.
                        </div>
                    </th>
                    <th>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"
                            style="background: #dddbd9; color: black; color: black"> Cantidad </div>
                    </th>
                    <th>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black">
                            Descripción</div>
                    </th>
                    <th>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black"> P/U
                        </div>
                    </th>
                    <th>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #dddbd9; color: black">
                            Subtotal</div>
                    </th>
                </tr>
                @foreach ($records->detail as $item)
                    <tr>
                        <th>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">
                                {{ $loop->index + 1 }}
                            </div>
                        </th>
                        <th>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">
                                {{ $item->quantity }}
                            </div>
                        </th>
                        <th>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">
                                {{ $item->product->name }}
                        </th>
                        <th>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">
                                {{ $item->unit_price }}
                        </th>
                        <th>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="background: #ffffff; color: black">
                                {{ $item->subtotal }}
                        </th>
                    </tr>
                @endforeach

                <tr>
                    <td colspan="4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"
                            style="background: #69a9f1;color:black ;text-align: right">
                            <b>IVA</b>
                        </div>
                    </td>
                    <td>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"
                            style="background: #ffffff; text-align: right">

                            {{ $records->iva }}
                        </div>
                    </td>
                </tr>

                <tr>
                    <td colspan="4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"
                            style="background: #69a9f1; color:black; text-align: right">
                            <b>Total</b>
                        </div>
                    </td>
                    <td>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"
                            style="background: #ffffff; color: black; text-align: right">
                            {{ $records->total }}
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <br>
    <br><br>
    <br>

    <label style="background: #9dc2ec; color:black"><b>Atendido por:</b></label>
    <strong style="color: black"> {{ $records->user->name }} {{ $records->user->lastname }}</strong>
</body>

</html>
