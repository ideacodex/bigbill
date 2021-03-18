<?php

namespace App\Http\Controllers;

use App\Adds;
use App\Company;
use App\Family;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FamilyController extends Controller
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
    public function index()
    {
        $rol = Auth::user()->role_id;
        if ($rol == 1) {
            $company = Company::all();
            $family = Family::with('company')->get();
            return view("family.index", ['family' => $family, 'company' => $company]); //generala vista
        } else {
            $company = Auth::user()->company_id; //guardo la variable de compañia del ususario autentificado
            $family = Family::where('company_id', $company)->with('company')->get(); //Obtener los valores de tu request:
            $anuncios = Adds::all();
            if ($anuncios->first()) {
                return view("family.index", ['family' => $family, 'anuncios' => $anuncios->random(1)]);
            } else {
                return view("family.index", ['family' => $family, 'anuncios' => null]);
            }
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
            'company_id' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $family = new Family();
            $family->name = $request->name;
            $family->company_id = $request->company_id;
            $family->save();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            abort(500, $e->errorInfo[2]);
            return response()->json($e, 500);
        }
        DB::commit();
        return back()->with('datosEliminados', 'Registro Guardado');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\family  $family
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $family = Family::findOrFail($id);
        $rol = Auth::user()->role_id;
        if ($rol == 1) {
            $company = Company::all();
            return view('family.edit', ['company' => $company, 'family' => $family]);
        } else {
            $anuncios = Adds::all();
            if ($anuncios->first()) {
                return view('family.edit', ['family' => $family, 'anuncios' => $anuncios->random(1)]);
            } else {
                return view('family.edit', ['family' => $family, 'anuncios' => null]);
            }
        }
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
            'company_id' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $family = Family::findOrFail($id);
            // nombre
            $family->name = $request->name;
            // compañia
            $family->company_id = $request->company_id;
            // guardar registros
            $family->save();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            abort(500, $e->errorInfo[2]);
            return response()->json($e, 500);
        }
        DB::commit();
        return redirect()->action('FamilyController@index')
            ->with('datosEliminados', 'Registro modificado');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $branch_office = Family::destroy($id);
        return back()->with('datosEliminados', 'La familia de la categoria fue eliminada exitosamente');
    }
}
