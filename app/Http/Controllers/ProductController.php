<?php

namespace App\Http\Controllers;

use App\Company;
use App\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); //autentificacion del usuario
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador', 'Gerente', 'Contador', 'Vendedor']); //autentificacion y permisos
        $rol = Auth::user()->role_id;
        if ($rol == 1) {
            $product = Product::with('companies')->get();
            return view("product.index", ['products' => $product]); //generala vista
        } else {
            $company = Auth::user()->company_id; //guardo la variable de compañia del ususario autentificado
            $product = Product::where('company_id', $company)->with('companies')->get(); //Obtener los valores de tu request:
            return view("product.index", ['products' => $product]); //generala vista
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador', 'Gerente', 'Contador', 'Vendedor']); //autentificacion y permisos
        $rol = Auth::user()->role_id;
        if ($rol == 1) {
            $companies = Company::all(); //Selecciona todos los datos de la tabla compañia
            return view("product.create", ['companies' => $companies]); //retorna vista con los datos correspondientes
        } else {
            return view("product.create",); //retorna vista con los datos correspondientes
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'kind_product' => 'required',
            'company_id' => 'required',
            'quantity_values' => 'required',
            'file' => 'image',
        ]);


        DB::beginTransaction();
        try {

            $product = new Product;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->company_id = $request->company_id;
            $product->tax = $request->tax;
            $product->quantity_values = $request->quantity_values;
            if ($request->kind_product == 1) {
                # code...
                $product->kind_product = "Artículo de venta";
                $product->price = $request->price;
                $product->special_price = $request->special_price;
                $product->credit_price = $request->credit_price;
                $product->cost = 0;
            } else {
                if ($request->kind_product == 2) {
                    # code...
                    $product->kind_product = "Artículo de compra";
                    $product->price = 0;
                    $product->special_price = 0;
                    $product->credit_price = 0;
                    $product->cost = $request->cost;
                } else {
                    $product->kind_product = "Artículo de compra y venta";
                    $product->price = $request->price;
                    $product->special_price = $request->special_price;
                    $product->credit_price = $request->credit_price;
                    $product->cost = $request->cost;
                }
            }
            $product->stock = $request->quantity_values;
            if ($product->quantity_values >= 1) {
                $product->active = 1;
            } else {
                $product->active = 0;
            }
            $product->income_amount = $request->quantity_values;
            $product->new_income = 0;
            $product->total_revenue = $request->quantity_values;
            $product->amount_expenses = $request->amount_expenses;
            $product->weight = $request->weight;
            $product->tall = $request->tall;
            $product->broad = $request->broad;
            $product->depth = $request->depth;

            $product->save();

            //***carga de imagen***//
            if ($request->hasFile('file')) {
                $extension = $request->file('file')->getClientOriginalExtension();
                $imageNameToStore = $product->id . '.' . $extension;
                // Upload file //***nombre de carpeta para almacenar**
                $path = $request->file('file')->storeAs('public/productos', $imageNameToStore);
                //dd($path);
                $product->file = $imageNameToStore;
                $product->save();
            } else {
                $imageNameToStore = 'no_image.jpg';
            }
            //***carga de imagen***//




        } catch (\Illuminate\Database\QueryException $e) {

            DB::rollback();
            dd($e);
            // dd($e);
            abort(500, $e->errorInfo[2]); //en la poscision 2 del array está el mensaje
            return response()->json($response, 500);
        }
        DB::commit();



        return redirect()->action('ProductController@index')
            ->with('datosEliminados', 'Registro exitoso');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador', 'Gerente', 'Contador']); //permisos y autentificacion

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Product::findOrFail($id);
        $companies = Company::all();
        return view('product.edit', ['companies' => $companies, 'products' => $products]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public  function update(Request $request, $id)
    {

        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'kind_product' => 'required',
            'cost' => 'required',
            'company_id' => 'required',
            'quantity_values',
            'income_amount',
            'amount_expenses',
        ]);

        DB::beginTransaction();
        try {
            $products = Product::findOrFail($id);
            $products->name = $request->name;
            $products->description = $request->description;
            if ($request->kind_product == 1) {
                # code...
                $products->kind_product = "Artículo de venta";
                $products->price = $request->price;
                $products->special_price = $request->special_price;
                $products->credit_price = $request->credit_price;
                $products->cost = 0;
            } else {
                if ($request->kind_product == 2) {
                    # code...
                    $products->kind_product = "Artículo de compra";
                    $products->price = 0;
                    $products->special_price = 0;
                    $products->credit_price = 0;
                    $products->cost = $request->cost;
                } else {
                    $products->kind_product = "Artículo de compra y venta";
                    $products->price = $request->price;
                    $products->special_price = $request->special_price;
                    $products->credit_price = $request->credit_price;
                    $products->cost = $request->cost;
                }
            }

            $products->company_id = $request->company_id;
            //**Ingresos anteriores */
            $products->income_amount = $request->income_amount;
            /**Nuevos ingresos */
            $products->new_income = $request->new_income;
            /**Total de ingresos */
            $products->total_revenue = $request->total_revenue;
            $products->amount_expenses = $request->amount_expenses;
            /**Stock anterior */
            $temporal = $products->new_income;
            /**Stock actualizado */
            $products->stock = $temporal + $request->quantity_values;
            $products->quantity_values = $products->stock;
            if ($products->stock >= 1) {
                $products->active = 1;
            } else {
                $products->active = 0;
            }
            $products->save();
            if ($request->file) {
                //***carga de imagen***//
                if ($request->hasFile('file')) {
                    $extension = $request->file('file')->getClientOriginalExtension();
                    $imageNameToStore = $products->id . '.' . $extension;
                    // Upload file //***nombre de carpeta para almacenar**
                    $path = $request->file('file')->storeAs('public/productos', $imageNameToStore);
                    //dd($path);
                    $products->file = $imageNameToStore;
                    $products->save();
                } else {
                    $imageNameToStore = 'no_image.jpg';
                }
            }
            //***carga de imagen***//

        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            abort(500, $e->errorInfo[2]);
            return response()->json($response, 500);
        }
        DB::commit();
        return redirect()->action('ProductController@index')
            ->with('datosEliminados', 'Registro modificado');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $product = Product::find($id);

            if ($product->active == 1) {
                $product->where('id', $id)->update(['active' => 0]);
            } else {
                $product->where('id', $id)->update(['active' => 1]);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            abort(500, $e->errorInfo[2]);
            return response()->json($response, 500);
        }
        DB::commit();
        return redirect()->action('ProductController@index');
    }
    public function getProduct($id)
    {
        /*  $user = auth()->user()->id;
        if (isset($user)) { */
        $product = Product::find($id);
        if (!isset($product)) {
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'Producto inexistente'
            ];
        } else {
            $data = [
                'code' => 200,
                'status' => 'success',
                'stock' => $product->stock,
                'price' => $product->price
            ];
        }
        /*  } else {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Usuario no identificado'
            ];
        } */

        return response()->json($data, $data['code']);
    }
}
