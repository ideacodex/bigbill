<?php

namespace App\Http\Controllers;

use App\Adds;
use App\Company;
use App\mark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MarkController extends Controller
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
            $mark = mark::with('company')->get();
            $company = Company::all();
            return view("mark.index", ['mark' => $mark, 'company' => $company]); //generala vista
        } else {
            $company = Auth::user()->company_id; //guardo la variable de compañia del ususario autentificado
            $mark = mark::where('company_id', $company)->with('company')->get(); //Obtener los valores de tu request:
            $anuncios = Adds::all();
            if ($anuncios->first()) {
                return view("mark.index", ['mark' => $mark, 'anuncios' => $anuncios->random(1)]);
            } else {
                return view("mark.index", ['mark' => $mark, 'anuncios' => null]);
            } 
        }
    }
    /**
     * Show the form for creating a new resource.
     *
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
            $mark = new mark();
            $mark->name = $request->name;
            $mark->company_id = $request->company_id;
            $mark->save();
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
     * @param  \App\mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mark = mark::findOrFail($id);
        $rol = Auth::user()->role_id;
        if ($rol == 1) {
            $company = Company::all();
            return view('mark.edit', ['company' => $company, 'mark' => $mark]);
        } else {
            $anuncios = Adds::all();
            if ($anuncios->first()) {
                return view('mark.edit', ['mark' => $mark, 'anuncios' => $anuncios->random(1)]);
            } else {
                return view('mark.edit', ['mark' => $mark, 'anuncios' => null]);
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
            $mark = mark::findOrFail($id);
            // nombre
            $mark->name = $request->name;
            // compañia
            $mark->company_id = $request->company_id;
            // guardar registros
            $mark->save();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            abort(500, $e->errorInfo[2]);
            return response()->json($e, 500);
        }
        DB::commit();
        return redirect()->action('MarkController@index')
            ->with('datosEliminados', 'Registro modificado');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\mark  $mark
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $branch_office = mark::destroy($id);
        return back()->with('datosEliminados', 'La familia de la categoria fue eliminada exitosamente');
    }
}
