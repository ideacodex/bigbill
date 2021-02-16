<?php

namespace App\Http\Controllers;

use App\Company;
use App\pricelist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PricelistController extends Controller
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
            $company = Company::all(); //pasa todas las compañias para el admin
            $price = pricelist::with('companies')->get();
            return view("price.index", ['price' => $price, 'company' => $company]); //generala vista 
        } else {

            $company = Auth::user()->company_id; //guardo la variable de compañia del ususario autentificado
            $price = pricelist::where('company_id', $company)->with('companies')->get(); //Obtener los valores de tu request:
            return view("price.index", ['price' => $price]); //generala vista   
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'company_id' => 'required'
        ]);
        DB::beginTransaction();
        try {
            $pricelists = new pricelist();
            $pricelists->name = $request->name;
            $pricelists->price = $request->price;
            $pricelists->company_id = $request->company_id;
            $pricelists->save();
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
     * @param  \App\pricelist  $pricelist
     * @return \Illuminate\Http\Response
     */
    public function show(pricelist $pricelist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\pricelist  $pricelist
     * @return \Illuminate\Http\Response
     */
    public function edit(pricelist $pricelist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\pricelist  $pricelist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pricelist $pricelist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\pricelist  $pricelist
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     DB::beginTransaction();
    //     try {
    //         $pricelist = pricelist::find($id);

    //         if ($pricelist->active == 1) {
    //             $pricelist->where('id', $id)->update(['active' => 0]);
    //         } else {
    //             $pricelist->where('id', $id)->update(['active' => 1]);
    //         }
    //     } catch (\Illuminate\Database\QueryException $e) {
    //         DB::rollback();
    //         abort(500, $e->errorInfo[2]);
    //         return response()->json($response, 500);
    //     }
    //     DB::commit();
    //     return redirect()->action('ProductController@index');
    // }
    public function destroy($id)
    {
        $record = pricelist::destroy($id);
        return back()->with('datosEliminados', 'Registro Eliminado');
    }
}
