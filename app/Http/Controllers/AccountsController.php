<?php

namespace App\Http\Controllers;

use App\AccountType;
use DB;
use App\Account;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;

class AccountsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); //autentificacion del usuario
    }
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador','Gerente','Contador']);//autentificacion y permisos
        $accounts = Account::all();
        $account_type = AccountType::all();
        $account_types = Account::with('account_types')->get();
        return view("accounts.index", ['accounts' => $accounts, 'account_types' => $account_types, 'account_type' => $account_type]);
    }
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador','Gerente','Contador']);//autentificacion y permisos
        $accounts = Account::all();
        return view("accounts.create", ["accounts" => $accounts]);
    }
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'status_id' => 'required',
            'company_id' => 'required'
        ]);
        DB::beginTransaction();
        try {
            $accounts = new Account;
            $accounts->name = $request->name;
            $accounts->status_id = $request->status_id;
            $accounts->company_id = $request->company_id;

            $accounts->save();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            dd($e);
            abort(500, $e->errorInfo[2]);
            return response()->json($response, 500);
        }
        DB::commit();
        return back()->with('usuarioGuardado', 'Registro Guardado');
    }
    public function show(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador','Gerente','Contador']);//autentificacion y permisos
        /**si existe la columna company_id realizar: Filtrado de inforcion*/
        if (!empty($request->company_id)) {
            $Accounts = Account::where('company_id', $request->company_id)->with('types')->with('company')->get(); //Obtener los valores de tu request:
            $pdf = PDF::loadView('CompanyInformation.accuonts', compact('Accounts')); //genera el PDF la vista
            return $pdf->download('Cuentas-Compañia.pdf'); // descarga el pdf
        }
    }
    public function edit($id,Request $request)
    {
        $request->user()->authorizeRoles(['Administrador','Gerente','Contador']);//autentificacion y permisos
        $accounts = Account::findOrFail($id);
        return view('accounts.edit', compact('accounts'));
    }
    public function update(Request $request, $id)
    {
        $accounts = request()->except((['_token', '_method']));
        Account::where('id', '=', $id)->update($accounts);

        return redirect()->action('AccountsController@index')
            ->with('datosModificados', 'Registro Modificado');
    }
    public function destroy($id)
    {
        $record = Account::destroy($id);
        return back()->with('datosEliminados', 'La cuenta ha sido eliminada');
    }
}
