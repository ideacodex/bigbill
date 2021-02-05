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
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador','Gerente','Contador']);//autentificacion y permisos
        $account_types = AccountType::all();
        return view("account_types.index", ['account_types' => $account_types]);
    }
    public function create()
    {
    }
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
    public function show(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador','Gerente','Contador']);//autentificacion y permisos
        /**si existe la columna company_id realizar: Filtrado de inforcion*/
        if (!empty($request->company_id)) {
            $AccountTypes = AccountType::where('company_id', $request->company_id)->with('company')->get(); //Obtener los valores de tu request:
            $pdf = PDF::loadView('CompanyInformation.types', compact('AccountTypes')); //genera el PDF la vista
            return $pdf->download('TiposCuentas-Compañia.pdf'); // descarga el pdf
        }
    }
    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
