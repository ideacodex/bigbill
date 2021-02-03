<?php

namespace App\Http\Controllers;

use App\DetailBill;
use App\Company;
use Illuminate\Support\Facades\DB;
use App\InvoiceBill;
use App\Mail\ComprobanteMailable;
use App\Product;
use App\Customer;
use DetailBill as GlobalDetailBill;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade  as PDF;
use Dotenv\Validator;
use Illuminate\Support\Facades\Mail;

class InvoiceBillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = InvoiceBill::with('user')->with('company')->with('customer')->get();
        return view("invoice_bill.index", ["records" => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = Product::get();
        $company = Company::all();
        $customer = Customer::all();
        return view("invoice_bill.create", ["product" => $product, "company" => $company, "customer" => $customer]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**Factura */
        request()->validate([
            'user_id',
            'company_id' => 'required',
            'iva',
            'ListaPro',
            'total'
        ]);

        DB::beginTransaction();

        try {
            //dd($request);
            $bill = new InvoiceBill();
            $bill->user_id = $request->user_id;
            $bill->company_id = $request->company_id;
            $bill->customer_id = $request->customer_id;
            $bill->iva = $request->iva;
            $bill->ListaPro = $request->ListaPro;
            $bill->total = $request->spTotal;
            $bill->save();

            /* Detalle */
            for ($i = 0; $i < sizeof($request->product_id); $i++) {
                $detail_bill = new DetailBill();
                $detail_bill->product_id = $request->product_id[$i];
                $detail_bill->description = $request->description[$i];
                $detail_bill->quantity = $request->quantity[$i];
                $detail_bill->unit_price = $request->unit_price[$i];
                $detail_bill->subtotal = $request->subtotal[$i];
                $detail_bill->invoice_id = $bill->id;
                $detail_bill->save();
            }
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            dd($e);
            abort(500, $e->errorInfo[2]); //en la poscision 2 del array está el mensaje
            return response()->json($response, 500);
        }
        DB::commit();
        return redirect()->action('InvoiceBillsController@index')
            ->with('usuarioGuardado', 'Factura Registrada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $records = InvoiceBill::with('user')->with('company')->with('customer')->with('detail.product')->find($id);

        $data = json_decode($records);

        if(isset($data)){
            Mail::to(['msarazuac@miumg.edu.gt'])->send(new ComprobanteMailable($data));
        }

        return view('invoice_bill.present', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $records = InvoiceBill::with('user')->with('company')->with('customer')->with('detail.product')->find($id);
        return view('invoice_bill.present', ['records' => $records]);
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

    public function getMail()
    {
        //Envío de comprobante al usuario por medio del correo.
        $data = ['name => Facturador'];
        Mail::to(['msarazuac@miumg.edu.gt'])->send(new ComprobanteMailable($data));
        return redirect()->action('InvoiceBillsController@index');
        //Envío de comprobante al usuario por medio del correo.
    }
}
