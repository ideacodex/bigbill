<?php

namespace App\Http\Controllers;

use App\Company;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
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
            $company = Company::all();
            $settings = Setting::with('company')->get();
            return view("settings.index", ['settings' => $settings, 'company' => $company]); //generala vista
        } else {
            $company = Auth::user()->company_id; //guardo la variable de compañia del ususario autentificado
            $settings = Setting::where('company_id', $company)->with('company')->get(); //Obtener los valores de tu request:
            return view("settings.index", ['settings' => $settings]); //generala vista
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
            'tax' => 'required',
            'exchange_rate' => 'required',
            'company_id' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $Setting = new Setting();
            $Setting->tax = $request->tax;
            $Setting->exchange_rate = $request->exchange_rate;
            $Setting->company_id = $request->company_id;
            $Setting->favcolor = $request->favcolor;
            $Setting->save();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            dd($e);
            abort(500, $e->errorInfo[2]);
            return response()->json($response, 500);
        }
        DB::commit();
        return back()->with('datosEliminados', 'Registro Guardado');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
