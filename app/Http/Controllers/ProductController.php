<?php

namespace App\Http\Controllers;

use DB;
use App\Product;
use App\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        return view("product.frmlistproductos" , ["products" => $product]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("product.frmproductos");
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
            //nombre
            'name' => 'required',
            //descripcion
            'description' => 'required',
            //precio
            'price' => 'required',
            //company_id
            'company_id' => 'required',
            //cantidad stock
            'quantity_values',
            //fecha de stock 
            'date_values' => 'required',
            //cantidad ingreso 
            'income_amount',
            //fecha de ingreso 
            'date_admission' => 'required',
            //cantidad egresos
            'amount_expenses',
            //fecha de egresos 
            'date_discharge' => 'required'
        ]);
        DB::beginTransaction();
        try {
            
            $product = new Product;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->company_id = $request->company_id;
            $product->quantity_values = $request->quantity_values;
            $product->date_values = $request->date_values;
            $product->income_amount = $request->income_amount;
            $product->date_admission = $request->date_admission;
            $product->amount_expenses = $request->amount_expenses;
            $product->date_discharge = $request->date_discharge;        
            $product->save();
        } catch (\Illuminate\Database\QueryException $e) {
            
            DB::rollback();
            // dd($e);
            abort(500, $e->errorInfo[2]); //en la poscision 2 del array está el mensaje
            return response()->json($response, 500);
        }
        DB::commit();
        return redirect()->action('ProductController@create')
            ->with('ProductosAgregados', 'Registro exitoso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
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
        return view('product.frmupdateproductos', compact('products'));
    }

      /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public  function update(Request $request,$id)
    {
        $product = request()->except((['_token', '_method']));
        Product::where('id', '=', $id)->update($product);

        return redirect()->action('ProductController@index')
        ->with('datosEliminados', 'Registro Modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $record=Product::destroy( $id );
        return back()->with('datosEliminados', 'Registro Eliminado');
    }
}
