<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Account;
use App\AccountType;
use App\Company;
use Illuminate\Http\Request;

class AccountTypesController extends Controller
{
    public function index()
    {
        $account_types = AccountType::all();
        return view("account_types.index", ['account_types' => $account_types]);
    }
    public function create()
    {
        //
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
        if (!empty($request->company_id)) {
            $AccountTypes = AccountType::where('company_id', $request->company_id)->with('company')->get(); //Obtener los valores de tu request:
        }
        return view('CompanyInformation.types')->with(compact('AccountTypes'));
    }

    public function edit($id)
    {
        //
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
