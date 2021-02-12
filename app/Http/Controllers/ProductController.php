<?php

namespace App\Http\Controllers;

use App\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
use GuzzleHttp\Psr7\Message;

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
        $company = Auth::user()->company_id; //guardo la variable de compañia del ususario autentificado
        $product = Product::where('company_id', $company)->get(); //Obtener los valores de tu request:
        return view("product.index", ['products' => $product]); //generala vista   
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador', 'Gerente', 'Contador', 'Vendedor']); //autentificacion y permisos
        $product = Product::all();
        return view("product.create", ['product' => $product]);
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
            'price' => 'required',
            'kind_product' => 'required',
            'company_id' => 'required',
            'quantity_values',
            'income_amount',
            'date_admission' => 'required',
            'amount_expenses',
        ]);
        DB::beginTransaction();
        try {

            $product = new Product;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->kind_product = $request->kind_product;
            $product->company_id = $request->company_id;
            $product->quantity_values = $request->quantity_values;
            $product->stock = $request->quantity_values;
            $product->income_amount = $request->income_amount;
            $product->new_income = 0;
            $product->total_revenue = $request->income_amount;
            $product->date_admission = $request->date_admission;
            $product->amount_expenses = $request->amount_expenses;
            if ($product->quantity_values >= 1) {
                $product->active = 1;
            } else {
                $product->active = 0;
            }
            $product->save();
        } catch (\Illuminate\Database\QueryException $e) {

            DB::rollback();
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
        /**si existe la columna company_id realizar: Filtrado de inforcion*/
        if (!empty($request->company_id)) {
            $Products = Product::where('company_id', $request->company_id)->with('company')->get(); //Obtener los valores de tu request:
            $pdf = PDF::loadView('CompanyInformation.products', compact('Products')); //genera el PDF la vista
            return $pdf->download('Productos-Compañia.pdf'); // descarga el pdf
        }
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
        return view('product.edit', ['products' => $products]);
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
            'company_id' => 'required',
            'quantity_values',
            'income_amount',
            'date_admission' => 'required',
            'amount_expenses',
        ]);

        DB::beginTransaction();
        try {
            $products = Product::findOrFail($id);
            $products->name = $request->name;
            $products->description = $request->description;
            $products->price = $request->price;
            $products->kind_product = $request->kind_product;
            $products->company_id = $request->company_id;
            //**Ingresos anteriores */
            $products->income_amount = $request->income_amount;
            /**Nuevos ingresos */
            $products->new_income = $request->new_income;
            /**Total de ingresos */
            $products->total_revenue = $request->total_revenue;
            $products->date_admission = $request->date_admission;
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
