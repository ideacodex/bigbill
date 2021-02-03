<?php

namespace App\Http\Controllers;

use DB;
use App\Customer;
use App\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return view("customers.index", ["customers" => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        return view("customers.create", ['customers' => $customers]);
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
            'lastname' => 'required', 
            'phone' => 'required',
            'email' => 'required',
            'nit' => 'required'
        ]);
        DB::beginTransaction();
        try{
            $customers = new Customer;
            $customers->name = $request->name;
            $customers->lastname = $request->lastname;
            $customers->phone = $request->phone;
            $customers->email = $request->email;
            $customers->nit = $request->nit;
            
            $customers->save();

        }catch(\Illuminate\Database\QueryException $e){
            DB::rollback();
            abort(500, $e->errorInfo[2]); //en la poscision 2 del array está el mensaje
            return response()->json($response, 500);
        }
        DB::commit();
        return back()->with('datosAgregados', 'Registro Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $records = Customer::with('user')->with('company')->with('customer')->with('detail.product')->find($id);
        return view('invoice_bill.present', ['records' => $records]);
        return 'clientes compania .pdf';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customers = Customer::findOrFail($id);
        return view('customers.edit', compact('customers'));
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
        $customers = request()->except((['_token', '_method']));
        Customer::where('id', '=', $id)->update($customers);

        return redirect()->action('CustomersController@index')
        ->with('datosModificados', 'Regitro Modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Customer::destroy($id);
        return back()->with('datosEliminados', 'Cliente Eliminado');
    }

    public function save(Request $request)
    {
        
        request()->validate([
            'name' => 'required',
            'lastname' => 'required', 
            'phone' => 'required',
            'email' => 'required',
            'nit' => 'required'
        ]);
        DB::beginTransaction();
        try{
            $customers = new Customer;
            $customers->name = $request->name;
            $customers->lastname = $request->lastname;
            $customers->phone = $request->phone;
            $customers->email = $request->email;
            $customers->nit = $request->nit;
            
            $customers->save();

        }catch(\Illuminate\Database\QueryException $e){
            DB::rollback();
            abort(500, $e->errorInfo[2]); //en la poscision 2 del array está el mensaje
            return response()->json($response, 500);
        }
        DB::commit();
        return redirect()->action('InvoiceBillsController@create')
        ->with('datosAgregados', 'Registro exitoso');
    }
}
