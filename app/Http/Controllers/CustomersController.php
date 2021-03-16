<?php

namespace App\Http\Controllers;

use App\Company;
use DB;
use App\Customer;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;

class CustomersController extends Controller
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
    public function index(Request $request)
    {
        $rol = Auth::user()->role_id;
        if ($rol == 1) {
            $request->user()->authorizeRoles(['Administrador', 'Gerente', 'Vendedor']); //autentificacion y permisos
            $customers = Customer::get(); //Obtener los valores de la compañia asignada
            return view("customers.index", ["customers" => $customers]); //generala vista   
        } else {
            $request->user()->authorizeRoles(['Administrador', 'Gerente', 'Vendedor']); //autentificacion y permisos
            $company = Auth::user()->company_id; //guardo la variable de compañia del ususario autentificado
            $customers = Customer::where('company_id', Auth()->user()->company_id)->get(); //Obtener los valores de la compañia asignada
            return view("customers.index", ["customers" => $customers]); //generala vista   
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador', 'Gerente', 'Vendedor']);
        $companies = Company::all();
        return view("customers.create", ['companies' => $companies]);
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
            'company_id' => 'required'
        ]);
        DB::beginTransaction();
        try {
            $customers = new Customer;
            $customers->name = $request->name;
            $customers->lastname = $request->lastname;
            $customers->phone = $request->phone;
            $customers->email = $request->email;
            $customers->nit = $request->nit;
            $customers->address = $request->address;
            $customers->delivery_address = $request->delivery_address;
            $customers->company_id = $request->company_id;

            $customers->save();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            abort(500, $e->errorInfo[2]); //en la poscision 2 del array está el mensaje
            return response()->json($e, 500);
        }
        DB::commit();
        return redirect()->action('CustomersController@index')->with('MENSAJE', 'Registro Guardado');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $request->user()->authorizeRoles(['Administrador', 'Gerente', 'Vendedor']);
        $companies = Company::all();
        $customers = Customer::findOrFail($id);
        return view('customers.edit', compact('customers'), ['companies' => $companies]);
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
            'name' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'nit' => 'required',
            'company_id' => 'required'
        ]);
        DB::beginTransaction();
        try {
            $customers = Customer::findOrFail($id);
            $customers->name = $request->name;
            $customers->lastname = $request->lastname;
            $customers->phone = $request->phone;
            $customers->email = $request->email;
            $customers->nit = $request->nit;
            $customers->address = $request->address;
            $customers->delivery_address = $request->delivery_address;
            $customers->company_id = $request->company_id;

            $customers->save();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            abort(500, $e->errorInfo[2]); //en la poscision 2 del array está el mensaje
            return response()->json($e, 500);
        }
        DB::commit();
        return redirect()->action('CustomersController@index')->with('MENSAJE', 'Registro Modificado');
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
            'nit' => 'required',
            'company_id' => 'required'
        ]);
        DB::beginTransaction();
        try {
            $customers = new Customer;
            $customers->name = $request->name;
            $customers->lastname = $request->lastname;
            $customers->phone = $request->phone;
            $customers->email = $request->email;
            $customers->nit = $request->nit;
            $customers->address = $request->address;
            $customers->delivery_address = $request->delivery_address;
            $customers->company_id = $request->company_id;

            $customers->save();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            abort(500, $e->errorInfo[2]); //en la poscision 2 del array está el mensaje
            return response()->json($e, 500);
        }
        DB::commit();
        return redirect()->action('InvoiceBillsController@create')->with('MENSAJE', 'Registro Guardado');
    }
}
