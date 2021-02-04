<?php

namespace App\Http\Controllers;

use DB;
use App\Customer;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
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
            'nit' => 'required',
            'company_id'=>'required'
        ]);
        DB::beginTransaction();
        try{
            $customers = new Customer;
            $customers->name = $request->name;
            $customers->lastname = $request->lastname;
            $customers->phone = $request->phone;
            $customers->email = $request->email;
            $customers->nit = $request->nit;
            $customers->company_id = $request->company_id;
            
            
            $customers->save();

        }catch(\Illuminate\Database\QueryException $e){
            DB::rollback();
            abort(500, $e->errorInfo[2]); //en la poscision 2 del array está el mensaje
            return response()->json($response, 500);
        }
        DB::commit();
        return back()->with('datosAgregados', 'Registro Guardado');
    }

    public function show(Request $request)
    {
        /**si existe la columna company_id realizar: Filtrado de inforcion*/
        if (!empty($request->company_id)) {
            $customers = Customer::where('company_id', $request->company_id)->with('company')->get(); //Obtener los valores de tu request:
            $pdf = PDF::loadView('CompanyInformation.customer', compact('customers')); //genera el PDF la vista
            return $pdf->download('Clientes-Compañia.pdf'); // descarga el pdf
        }
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
