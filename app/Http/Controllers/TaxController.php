<?php

namespace App\Http\Controllers;

use App\Company;
use App\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaxController extends Controller
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
        $request->user()->authorizeRoles(['Administrador', 'Gerente', 'Contador', 'Vendedor']); //autentificacion y permisos
        $rol = Auth::user()->role_id;
        if ($rol == 1) {
            $company = Company::all(); //pasa todas las compañias para el admin
            $tax = Tax::with('companies')->get();
            return view("tax.index", ['price' => $tax, 'company' => $company]); //generala vista
        } else {
            $company = Auth::user()->company_id; //guardo la variable de compañia del ususario autentificado
            $tax = Tax::where('company_id', $company)->with('companies')->get(); //Obtener los valores de tu request:
            return view("tax.index", ['price' => $tax]); //generala vista
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
            'name' => 'required',
            'company_id' => 'required'
        ]);
        DB::beginTransaction();
        try {
            $pricelists = new pricelist();
            $pricelists->name = $request->name;
            $pricelists->price = $request->price;
            $pricelists->company_id = $request->company_id;
            $pricelists->save();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            abort(500, $e->errorInfo[2]);
            return response()->json($response, 500);
        }
        DB::commit();
        return back()->with('usuarioGuardado', 'Tipo de cuenta registrado');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tax = Tax::findOrFail($id);
        $companies =  Company::all();
        return view('tax.edit', ['tax' => $tax,'companies' => $companies]);
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
            'Amount' => 'required',
            'company_id' => 'required'

        ]);

        DB::beginTransaction();
        try {
            $pricelist = Tax::findOrFail($id);
            $pricelist->name = $request->name;
            $pricelist->Amount = $request->Amount;
            $pricelist->company_id = $request->company_id;
            $pricelist->save();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            abort(500, $e->errorInfo[2]);
            return response()->json($e, 500);
        }
        DB::commit();
        return redirect()->action('TaxController@index')
            ->with('datosEliminados', 'Registro modificado');
    }
}
