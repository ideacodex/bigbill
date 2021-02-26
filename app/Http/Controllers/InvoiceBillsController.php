<?php

namespace App\Http\Controllers;

use App\DetailBill;
use App\Company;
use Illuminate\Support\Facades\DB;
use App\InvoiceBill;
use App\Mail\ComprobanteMailable;
use App\Product;
use App\Customer;
use App\Suscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceBillsController extends Controller
{
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
            $records = InvoiceBill::with('user')->with('company')->with('customer')->get(); //busca todas las facturas
            return view("invoice_bill.index", ["records" => $records]); //generala vista
        } else {

            $company = Auth::user()->company_id; //guardo la variable de companía del ususario autentificado
            $records = InvoiceBill::where('company_id', $company)->with('user')->with('company')->with('customer')->get(); //busca facturas por autentificacion
            return view("invoice_bill.index", ["records" => $records]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = Product::where('active', 1)->where('kind_product', '!=', 2)->get();
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
            'invoice_type' => 'required',
            'applied_price' => 'required',
            'ListaPro',
            'total'
        ]);

        DB::beginTransaction();

        try {
            //dd($request);
            $bill = new InvoiceBill();
            $bill->user_id = $request->user_id;
            $bill->company_id = $request->company_id;
            if ($request->customer_id == 0) {
                $bill->customer_id == null;
            } else {
                $bill->customer_id = $request->customer_id;
            }
            $bill->branch_id = $request->branch_id;
            $bill->invoice_type = $request->invoice_type;
            $bill->ListaPro = $request->ListaPro;
            $bill->total = $request->spTotal;
            $bill->totalletras = $request->totalletras;
            $bill->active = 1;
            $bill->account_id = 1;
            $bill->customer_name = $request->customer_name;
            $bill->customer_email = $request->customer_email;
            $bill->description = $request->description;
            $bill->date_issue = $request->date_issue;
            $bill->expiration_date = $request->expiration_date;
            $bill->document_type = $request->document_type;
            $bill->applied_price = $request->applied_price;
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

                if ($request->document_type == 1) {
                    /**Trae el product_id que tengo en la request*/
                    $product = Product::find($request->product_id[$i]);
                    /**Declaro una variable temporal que sea igual a mi cantidad en stock */
                    $temp = $product->stock;
                    $temporal = $product->quantity_values;
                    $tempo = $product->amount_expenses;
                    /**A mi cantidad en stock le resto la cantidad que tengo en la request ej: 9-2 = 7 */
                    $product->stock = $temp - $request->quantity[$i];
                    $product->amount_expenses = $tempo + $request->quantity[$i];
                    $product->quantity_values = $temporal - $request->quantity[$i];

                    if ($product->stock == 0) {
                        $product->active = 0;
                    } else {
                        $product->active = 1;
                    }
                    $product->save();
                }
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
        return view('invoice_bill.show', ['records' => $records]);
    }

    public function editar($id)
    {
        $product = Product::where('active', 1)->get();
        $company = Company::all();
        $customer = Customer::all();
        $invoice = InvoiceBill::with('detail.product')->with('customer')->find($id);
        /* dd($invoice); */
        return view("invoice_bill.edit", ["invoice" => $invoice, "product" => $product, "company" => $company, "customer" => $customer]);
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

        $data = json_decode($records);
        if (isset($data)) {
            /**Envía el correo a los clientes registrados si no está registrado se va al else */
            if ($records->customer_id) {
                Mail::to([$records->customer->email])->send(new ComprobanteMailable($data));
            } else {
                Mail::to([$records->customer_email])->send(new ComprobanteMailable($data));
            }
        }

        return redirect()->action('InvoiceBillsController@index');
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
        request()->validate([
            'user_id',
            'company_id' => 'required',
            'invoice_type' => 'required',
            'applied_price' => 'required',
            'ListaPro',
            'total'
        ]);

        DB::beginTransaction();
        try {
            $bill = InvoiceBill::findOrFail($id);
            $bill->user_id = $request->user_id;
            $bill->company_id = $request->company_id;
            if ($request->customer_id == 0) {
                $bill->customer_id == null;
            } else {
                $bill->customer_id = $request->customer_id;
            }
            $bill->branch_id = $request->branch_id;
            $bill->invoice_type = $request->invoice_type;
            $bill->ListaPro = $request->ListaPro;
            $bill->total = $request->spTotal;
            $bill->totalletras = $request->totalletras;
            $bill->active = 1;
            $bill->account_id = 1;
            $bill->customer_name = $request->customer_name;
            $bill->customer_email = $request->customer_email;
            $bill->description = $request->description;
            $bill->date_issue = $request->date_issue;
            $bill->expiration_date = $request->expiration_date;
            $bill->document_type = $request->document_type;
            $bill->applied_price = $request->applied_price;
            $bill->save();

            /* Detalle */
            for ($i = 0; $i < sizeof($request->product_id[$i]); $i++) {
                $detail_bill = DetailBill::findOrFail($id);
                $detail_bill->product_id = $request->product_id[$i];
                $detail_bill->quantity = $request->quantity[$i];
                $detail_bill->unit_price = $request->unit_price[$i];
                $detail_bill->subtotal = $request->subtotal[$i];
                $detail_bill->invoice_id = $bill->id;
                $detail_bill->save();

                if ($request->document_type == 1) {
                    /**Trae el product_id que tengo en la request*/
                    $product = Product::find($request->product_id[$i]);
                    /**Declaro una variable temporal que sea igual a mi cantidad en stock */
                    $temp = $product->stock;
                    $temporal = $product->quantity_values;
                    $tempo = $product->amount_expenses;
                    /**A mi cantidad en stock le resto la cantidad que tengo en la request ej: 9-2 = 7 */
                    $product->stock = $temp - $request->quantity[$i];
                    $product->amount_expenses = $tempo + $request->quantity[$i];
                    $product->quantity_values = $temporal - $request->quantity[$i];

                    if ($product->stock == 0) {
                        $product->active = 0;
                    } else {
                        $product->active = 1;
                    }
                    $product->save();
                }
            }
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            abort(500, $e->errorInfo[2]);
            return response()->json($response, 500);
        }
        DB::commit();
        return redirect()->action('InvoiceBillsController@index')
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
            $bill = InvoiceBill::find($id);

            if ($bill->active == 1) {
                $bill->where('id', $id)->update(['active' => 0]);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            abort(500, $e->errorInfo[2]);
            return response()->json($response, 500);
        }
        DB::commit();
        return redirect()->action('InvoiceBillsController@index');
    }

    /* public function getInfoCustomer($nit){

        $customer = Customer::where($nit)->first();

        if(isset($customer))
        {
            return response()->json(['customer' => $customer]);
        }
        else
        {
            return "No se enceontraron resultados";
        }
    } */
}
