<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::get();
        return view("product.index", ["products" => $product]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::all();
        $companies = User::with('companies')->get();
        return view("product.create", ["user" => $user, "companies" => $companies]);
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
            'company_id' => 'required',
            'quantity_values',
            'date_values' => 'required',
            'income_amount',
            'date_admission' => 'required',
            'amount_expenses',
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
            if($product->quantity_values >= 1){
                $product->active = 1;
            }else{
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
            'company_id' => 'required',
            'quantity_values',
            'date_values' => 'required',
            'income_amount',
            'date_admission' => 'required',
            'amount_expenses',
            'date_discharge' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $products = Product::findOrFail($id);
            $products->name = $request->name;
            $products->description = $request->description;
            $products->price = $request->price;
            $products->company_id = $request->company_id;
            $products->quantity_values = $request->quantity_values;
            $products->date_values = $request->date_values;
            $products->income_amount = $request->income_amount;
            $products->date_admission = $request->date_admission;
            $products->amount_expenses = $request->amount_expenses;
            $products->date_discharge = $request->date_discharge;
            if($products->quantity_values >= 1){
                $products->active = 1;
            }else{
                $products->active = 0;
            }
            $products->save();
        }catch(\Illuminate\Database\QueryException $e){
            DB::rollback();
            abort(500, $e->errorInfo[2]);
            return response()->json($response, 500);

        }DB::commit();
        return redirect()->action('ProductController@index')->with(['message' => 'Registro Modificado', 'alert' => 'success']);
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
            }else{
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
}
