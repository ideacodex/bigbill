<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Account;
use App\AccountType;
use App\Company;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountTypesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador', 'Gerente', 'Contador']); //autentificacion y permisos
        $company = Auth::user()->company_id; //guardo la variable de compañia del ususario autentificado
        $account_types = AccountType::get(); //Obtener los valores 
        return view("account_types.index", ['account_types' => $account_types]); //generala vista   

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
    public function edit($id, Request $request)
    {
        $request->user()->authorizeRoles(['Administrador']); //autentificacion y permisos
        $account_type = AccountType::findOrFail($id);
        return view('account_types.edit', ['account_type' => $account_type]);
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
        $account_type = request()->except((['_token', '_method']));
        AccountType::where('id', '=', $id)->update($account_type);

        return redirect()->action('AccountTypesController@index')
            ->with('datosModificados', 'Registro Modificado');
    }
}
