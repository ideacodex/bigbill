<?php

namespace App\Http\Controllers;

use DB;
use App\Company;
use App\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;

class CompaniesController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador']);
        $companies = Company::all();
        return view("companies.index", ["companies" => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador']);
      
        return view("companies.create");
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
            'nit' => 'required|unique'
        ]);
        DB::beginTransaction();
        try{
            $companies = new Company;
            $companies->name = $request->name;
            $companies->nit = $request->nit;
            $companies->phone = $request->phone;
            $companies->address = $request->address;
            $companies->save();

        }catch(\Illuminate\Database\QueryException $e){
            DB::rollback();
            abort(500, $e->errorInfo[2]); //en la poscision 2 del array está el mensaje
            return response()->json($response, 500);
        }
        DB::commit();
        return redirect()->action('CompaniesController@index')
        ->with('datosAgregados', 'Registro exitoso');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)//editform
    {
        $request->user()->authorizeRoles(['Administrador']);
        $companies = Company::findOrFail($id);
        return view('companies.update', compact('companies'));
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
        $companies = request()->except((['_token', '_method']));
        Company::where('id', '=', $id)->update($companies);
        return redirect()->action('CompaniesController@index')
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
        $record=Company::destroy($id);
        return back()->with('datosEliminados', 'Registro Eliminado');
    }
}
