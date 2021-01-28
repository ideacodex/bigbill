<?php

namespace App\Http\Controllers;

use App\AccountType;
use DB;
use App\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;

class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = Account::all();
        $account_type = AccountType::all();
        $account_types = Account::with('account_types')->get();
        return view("accounts.index",['accounts' => $accounts, 'account_types' => $account_types, 'account_type' => $account_type]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'status_id' => 'required'
        ]);
        DB::beginTransaction();
        try{
            $accounts = new Account;
            $accounts->name = $request->name;
            $accounts->status_id = $request->status_id;
            
            $accounts->save();
        }catch(\Illuminate\Database\QueryException $e){
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
