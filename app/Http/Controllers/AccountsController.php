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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador', 'Gerente', 'Contador']); //autentificacion y permisos
        if (!empty($request->company_id)) {
            $account_type = AccountType::get();
            $account = Account::where('company_id', $request->company_id)->get(); //Obtener los valores de tu request:
            return view("accounts.index", ['account' => $account, 'account_type' => $account_type]); //generala vista   
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador', 'Gerente', 'Contador']); //autentificacion y permisos
        $accounts = Account::all();
        return view("accounts.create", ["accounts" => $accounts]);
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
            $Accounts = Account::where('company_id', $request->company_id)->with('types')->with('company')->get(); //Obtener los valores de tu request:
            $pdf = PDF::loadView('CompanyInformation.accuonts', compact('Accounts')); //genera el PDF la vista
            return $pdf->download('Cuentas-Compañia.pdf'); // descarga el pdf
        }
    }
<<<<<<< HEAD
=======

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
>>>>>>> efa74bfc2eaba79a48a40856a292c4cfcdd51257
    public function edit($id, Request $request)
    {
        $request->user()->authorizeRoles(['Administrador', 'Gerente', 'Contador']); //autentificacion y permisos
        $accounts = Account::findOrFail($id);
        return view('accounts.edit', compact('accounts'));
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
        $accounts = request()->except((['_token', '_method']));
        Account::where('id', '=', $id)->update($accounts);

        return redirect()->action('AccountsController@index')
            ->with('datosModificados', 'Registro Modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Account::destroy($id);
        return back()->with('datosEliminados', 'La cuenta ha sido eliminada');
    }
}
