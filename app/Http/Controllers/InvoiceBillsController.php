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
        $invoice_bill = InvoiceBill::all();
        $user = InvoiceBill::with('user')->get();
        $company = InvoiceBill::with('company')->get();
        $customer = InvoiceBill::with('customer')->get();
        return view("invoice_bill.index", ["invoice_bill" => $invoice_bill, "company" => $company, "user" => $user, "customer" => $customer]);
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
        return view("invoice_bill.create", ["product" => $product, "company" => $company, "customer" => $customer]);    }

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
        
        try{
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
                $detail_bill->quantity = $request->quantity[$i];
                $detail_bill->unit_price = $request->unit_price[$i];
                $detail_bill->subtotal = $request->subtotal[$i];
                $detail_bill->invoice_id = $bill->id;
                $detail_bill->save();
            }
        }catch(\Illuminate\Database\QueryException $e){
            DB::rollback();
            dd($e);
            abort(500, $e->errorInfo[2]); //en la poscision 2 del array está el mensaje
            return response()->json($response, 500);
        }
        DB::commit();
        return redirect()->action('InvoiceBillsController@index')
        ->with('usuarioGuardado', 'Factura Registrada');      
        
        /*
        if($request->ajax())
        {
            $rules = array(
                'product_id.*' => 'required',
                'quantity.*' => 'required', 
                'unit_price.*' => 'required', 
                'total.*' => 'required'
            );
            $error = Validator::make($request->all(), $rules);
            if($error->fails()){
                return response()->json([
                    'error' => $error->errors()->all()
                ]);
            }
            $product_id =  $request->product_id;
            $quantity = $request->quantity;
            $unit_price = $request->unit_price;
            $total = $request->total;
            for($count = 0; $count < count($product_id); $count++)
            {
                $data = array(
                    'product_id' => $product_id[$count], 
                    'quantity' => $quantity[$count],
                    'unit_price' => $unit_price[$count],
                    'total' => $total[$count]
                );
                $insert_data[] = $data;
                dd($insert_data);
            }
            InvoiceBill::insert($insert_data);
            return response()->json([
                'success' => 'Datos ingresados correctamente.'
            ]);
        }
        */         
        
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
    public function edit($id )
    {
        $InvoiceBill = InvoiceBill::findOrFail($id);
        $user = InvoiceBill::with('user')->get();
        $company = InvoiceBill::with('company')->get();
        $customer = InvoiceBill::with('customer')->get();
        

        $DetailBill = DetailBill::findOrFail($id);
        $product = DetailBill::with('product')->get();
        
        $pdf = PDF::loadView('PDF.Factura', compact('DetailBill') , compact('InvoiceBill') );
        return $pdf->download('FacturaEnviada.pdf' );
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

    public function getMail(){
        $data = ['name' => 'Facturador'];
        Mail::to(['alfrediviris2017@gmail.com'])->send(new ComprobanteMailable($data));  
    }
}
