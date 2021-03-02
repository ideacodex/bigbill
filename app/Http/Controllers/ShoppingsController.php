<?php

namespace App\Http\Controllers;

use App\Company;
use App\DetailShoppings;
use Illuminate\Http\Request;
use App\Shopping;
use Illuminate\Support\Facades\DB;

class ShoppingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $records = Shopping::with('user')->with('company')->get(); //busca todas las facturas
        return view("shopping.index", ["records" => $records]); //generala vista
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("shopping.create");
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
            $shopping->save();

            /**Detalle de compra */
            for ($i = 0; $i < sizeof($request->product); $i++) {
                /* dd('está llegando aquí'); */
                $detail_shopping = new DetailShoppings();
                $detail_shopping->product = $request->product[$i];
                $detail_shopping->quantity = $request->quantity[$i];
                $detail_shopping->unit_price = $request->unit_price[$i];
                $detail_shopping->subtotal = $request->subtotal[$i];
                $detail_shopping->shopping_id = $shopping->id;
                $detail_shopping->save();
            }
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            abort(500, $e->errorInfo[2]); //en la poscision 2 del array está el mensaje
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
        //
    }
}
