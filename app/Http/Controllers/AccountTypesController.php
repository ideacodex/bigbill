<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Account;
use App\AccountType;
use App\Company;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class AccountTypesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); //autentificacion del usuario
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador','Gerente','Contador']);//autentificacion y permisos

        if (!empty($request->company_id)) {
            $account_types = AccountType::where('company_id', $request->company_id)->get(); //Obtener los valores 
            return view("account_types.index", ['account_types' => $account_types]);//generala vista   
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'status' => 'required',
            'company_id' => 'required'
        ]);
        DB::beginTransaction();
        try {
            $account_types = new AccountType();
            $account_types->status = $request->status;
            $account_types->company_id = $request->company_id;

            $account_types->save();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            dd($e);
            abort(500, $e->errorInfo[2]);
            return response()->json($response, 500);
        }
        DB::commit();
        return back()->with('usuarioGuardado', 'Tipo de cuenta registrado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador', 'Gerente', 'Contador']); //autentificacion y permisos
        /**si existe la columna company_id realizar: Filtrado de inforcion*/
        if (!empty($request->company_id)) {
            $AccountTypes = AccountType::where('company_id', $request->company_id)->with('company')->get(); //Obtener los valores de tu request:
            $pdf = PDF::loadView('CompanyInformation.types', compact('AccountTypes')); //genera el PDF la vista
            return $pdf->download('TiposCuentas-Compañia.pdf'); // descarga el pdf
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
