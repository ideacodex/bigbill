<?php

namespace App\Http\Controllers;

use DB;
use App\Company;
use App\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;

class CompaniesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); //autentificacion del usuario
    }
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador']);
        $companies = Company::all();
        return view("companies.index", ["companies" => $companies]);
    }
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador']);
        $companies = Company::all();
        return view("companies.create", ['companies' => $companies]);
    }
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'nit' => 'required', 
            'phone',
            'address'
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
    public function edit($id,Request $request)//editform
    {
        $request->user()->authorizeRoles(['Administrador']);
        $companies = Company::findOrFail($id);
        return view('companies.update', compact('companies'));
    }
    public function update(Request $request, $id)
    {
        $companies = request()->except((['_token', '_method']));
        Company::where('id', '=', $id)->update($companies);

        return redirect()->action('CompaniesController@index')
        ->with('datosModificados', 'Registro Modificado');
    }
    public function destroy($id)
    {
        $record=Company::destroy($id);
        return back()->with('datosEliminados', 'Registro Eliminado');
    }
}
