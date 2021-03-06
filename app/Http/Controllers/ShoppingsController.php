<?php

namespace App\Http\Controllers;

use App\Company;
use App\DetailShoppings;
use App\Product;
use Illuminate\Http\Request;
use App\Shopping;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShoppingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); //autentificacion del usuario
        $this->middleware('verified');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rol = Auth::user()->role_id;
        if ($rol == 1) {
            $records = Shopping::with('user')->with('company')->get(); //busca todas las facturas
            return view("shopping.index", ["records" => $records]); //generala vista
        } else {
            $company = Auth::user()->company_id;
            $records = Shopping::where('company_id', $company)->with('user')->with('company')->get(); //busca todas las facturas
            return view("shopping.index", ["records" => $records]); //generala vista
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rol = Auth::user()->role_id;
        if ($rol == 1) {
            $product = Product::where('kind_product', '!=', 1)->get();
            return view("shopping.create", ['product' => $product]);
        } else {
            $product = Product::where('kind_product', '!=', 1)->where('company_id', Auth()->user()->company_id)->get();
            return view("shopping.create", ['product' => $product]);
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
            'company_id' => 'required',
            'type_product' => 'required',
            'supplier' => 'required',
            'total'
        ]);

        DB::beginTransaction();
        try {
            $shopping = new Shopping();
            $shopping->user_id = $request->user_id;
            $shopping->company_id = $request->company_id;
            $shopping->branch_id =  $request->branch_id;
            $shopping->type_product = $request->type_product;
            $shopping->supplier = $request->supplier;
            $shopping->ListaPro = $request->ListaPro;
            $shopping->total = $request->spTotal;
            $shopping->totalletras = $request->totalletras;
            $shopping->date_issue = $request->date_issue;
            $shopping->description = $request->description;
            $shopping->account_id = 2;
            $shopping->new_existing = $request->new_existing;
            $shopping->active = 1;
            $shopping->save();

            /**Detalle de compra */
            if ($request->type_product == 2 && $request->new_existing == 1) {
                for ($i = 0; $i < sizeof($request->product_id); $i++) {
                    /* dd('est?? llegando aqu??'); */
                    $detail_shopping = new DetailShoppings();
                    $detail_shopping->quantity = $request->quantity[$i];
                    $detail_shopping->unit_price = $request->unit_price[$i];
                    $detail_shopping->subtotal = $request->subtotal[$i];
                    $detail_shopping->shopping_id = $shopping->id;
                    $detail_shopping->product_id = $request->product_id[$i];
                    $detail_shopping->save();

                    $product = Product::find($request->product_id[$i]);
                    /**Declaro una variable temporal que sea igual a mi cantidad en stock */
                    $temp = $product->stock;
                    $temporal = $product->quantity_values;
                    $tempo = $product->new_income;
                    $tempo1 = $product->income_amount;
                    $tempo2 = $product->total_revenue;
                    /**A mi cantidad en stock le resto la cantidad que tengo en la request ej: 9-2 = 7 */
                    $product->stock = $temp + $request->quantity[$i];
                    $product->quantity_values = $temporal + $request->quantity[$i];
                    $product->new_income = $tempo + $request->quantity[$i];
                    $product->income_amount = $tempo1 + $request->quantity[$i];
                    $product->total_revenue = $tempo2 + $request->quantity[$i];
                    $product->kind_product = 3;
                    if ($product->active == 0) {
                        $product->active = 1;
                    } elseif ($product->active == 1) {
                        $product->active = 1;
                    }
                    $product->save();
                }
            } elseif ($request->type_product == 1 && $request->new_existing == 1) {
                for ($i = 0; $i < sizeof($request->product_id); $i++) {
                    $detail_shopping = new DetailShoppings();
                    $detail_shopping->quantity = $request->quantity[$i];
                    $detail_shopping->unit_price = $request->unit_price[$i];
                    $detail_shopping->subtotal = $request->subtotal[$i];
                    $detail_shopping->shopping_id = $shopping->id;
                    $detail_shopping->product_id = $request->product_id[$i];
                    $detail_shopping->save();

                    $product = Product::find($request->product_id[$i]);
                    /**Declaro una variable temporal que sea igual a mi cantidad en stock */
                    $temp = $product->stock;
                    $temporal = $product->quantity_values;
                    $tempo = $product->new_income;
                    $tempo1 = $product->income_amount;
                    $tempo2 = $product->total_revenue;
                    /**A mi cantidad en stock le resto la cantidad que tengo en la request ej: 9-2 = 7 */
                    $product->stock = $temp + $request->quantity[$i];
                    $product->quantity_values = $temporal + $request->quantity[$i];
                    $product->new_income = $tempo + $request->quantity[$i];
                    $product->income_amount = $tempo1 + $request->quantity[$i];
                    $product->total_revenue = $tempo2 + $request->quantity[$i];
                    $product->kind_product = 2;
                    if ($product->active == 0) {
                        $product->active = 0;
                    } elseif ($product->active == 1) {
                        $product->active = 0;
                    }
                    $product->save();
                }
            }
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            /* dd($e); */
            abort(500, $e->errorInfo[2]); //en la poscision 2 del array est?? el mensaje
            return response()->json($response, 500);
        }
        DB::commit();
        return redirect()->action('ShoppingsController@index')
            ->with('usuarioGuardado', 'Compra Registrada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
            $detail_shopping = Shopping::with('detail.products')->where('id', $id)->first();
            
            if ($detail_shopping->active == 1) {
                $detail_shopping->active = 0;
                foreach ($detail_shopping->detail as $record) {
                    /* dd($record->products); */
                    /**Declaro una variable temporal que sea igual a mi cantidad en stock */
                    $temp = $record->products->stock;
                    $temporal = $record->products->quantity_values;
                    $tempo = $record->products->new_income;
                    $tempo1 = $record->products->income_amount;
                    $tempo2 = $record->products->total_revenue;

                    /**A mi cantidad en stock le resto la cantidad que tengo en la request ej: 9-2 = 7 */
                    $record->products->stock = $temp - $record->quantity;
                    $record->products->quantity_values = $temporal - $record->quantity;
                    $record->products->new_income = $tempo - $record->quantity;
                    $record->products->income_amount = $tempo1 - $record->quantity;
                    $record->products->total_revenue = $tempo2 - $record->quantity;
                    $record->products->save();
                }
                $detail_shopping->save();
            }
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            abort(500, $e->errorInfo[2]);
            return response()->json($response, 500);
        }
        DB::commit();
        return redirect()->action('ShoppingsController@index');
    }

    public function xml(Request $request)
    {
        $path = public_path('files/xml/1.xml');
        $xmlfile = file_get_contents($path);

        $document = new \DOMDocument();
        $document->loadXML($xmlfile);
        $xpath = new \DOMXpath($document);

        $items = [];
        //dd('documentos ',  $xpath->evaluate('*'));
        // iterate the Table nodes
        foreach ($xpath->evaluate('//dte:Items/dte:Item') as $tableNode) {
            //dd('tableNode: ',  $tableNode);
            $items[] = [
                // read CMan_Code as string 
                'code' => trim($xpath->evaluate('string(dte:Descripcion)', $tableNode)),
                // read CMan_Name as string 
                'name' => trim($xpath->evaluate('string(dte:PrecioUnitario)', $tableNode))
            ];
        }
        dd('item ',  $items);
    }
}
