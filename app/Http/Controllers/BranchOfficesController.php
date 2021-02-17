<?php

namespace App\Http\Controllers;

use App\BranchOffice;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BranchOfficesController extends Controller
{
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
            $branch_office = BranchOffice::with('company')->get();
            return view('branchoffice.index', ['branch_office' => $branch_office]); //retorna vista con los datos correspondientes
        } else {
            $company = Auth::user()->company_id; //guardo la variable de compañia del ususario autentificado
            $branch_office = BranchOffice::where('company_id', $company)->get(); //Obtener los valores relacionados a su compañia
            return view('branchoffice.index', ['branch_office' => $branch_office]); //retorna vista con los datos correspondientes
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        return view('branchoffice.create', ['companies' => $companies]);
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
            'phone' => 'required',
            'address' => 'required',
            'company_id' => 'required'
        ]);
        DB::beginTransaction();
        try {
            $branch_office = new BranchOffice;
            $branch_office->name = $request->name;
            $branch_office->phone = $request->phone;
            $branch_office->pbx = $request->pbx;
            $branch_office->address = $request->address;
            $branch_office->company_id = $request->company_id;
            $branch_office->save();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            dd($e);
            abort(500, $e->errorInfo[2]); //en la poscision 2 del array está el mensaje
            return response()->json($response, 500);
        }
        DB::commit();
        return redirect()->action('BranchOfficesController@index')
            ->with('usuarioGuardado', 'Sucursal Registrada');
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
        $branch_office = BranchOffice::findOrFail($id);
        return view('branchoffice.edit', compact('branch_office'));
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
        request()->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'company_id' => 'required'
        ]);
        DB::beginTransaction();
        try {
            $branch_office = BranchOffice::findOrFail($id);
            $branch_office->name = $request->name;
            $branch_office->phone = $request->phone;
            $branch_office->pbx = $request->pbx;
            $branch_office->address = $request->address;
            $branch_office->company_id = $request->company_id;
            $branch_office->save();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            abort(500, $e->errorInfo[2]);
            return response()->json($response, 500);
        }
        DB::commit();
        return redirect()->action('BranchOfficesController@index')->with(['message' => 'Sucursal actualizada', 'alert' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $branch_office = BranchOffice::destroy($id);
        return back()->with('datosEliminados', 'Sucursal Eliminada');
    }
}
