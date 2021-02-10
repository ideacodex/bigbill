<?php

namespace App\Http\Controllers;

use App\BranchOffice;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\User;
use App\Company;

class UsuarioEmpresaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth'); //autentificacion del usuario
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador']); //autentificacion y permisos
        $user = User::with('companies')->get();
        $branch_office = BranchOffice::all();
        return view("userInfo.UsuarioEmpresa.usuarios", ["user" => $user, "branch_office" => $branch_office]);
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
        $user = User::findOrFail($id) and $companies = Company::all();
        $branch_office = BranchOffice::all();
        return view('userInfo.UsuarioEmpresa.update', compact('user'), ["companies" => $companies, "branch_office" => $branch_office]);
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
        $request->user()->authorizeRoles(['Administrador']); //autentificacion y permisos
        $user = request()->except((['_token', '_method']));
        User::where('id', '=', $id)->update($user);
        $user = User::find($id);
        $role= Role::find($request->role_id);
        $user->syncRoles($role);
        return redirect()->action('UsuarioEmpresaController@index')->with('MENSAJEEXITOSO', 'Registro Modificado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador', 'Gerente', 'Contador']); //permisos y autentificacion
        /**si existe la columna company_id realizar: Filtrado de inforcion*/
        if (!empty($request->company_id)) {
            $usuarios = User::where('company_id', $request->company_id)->with('company')->get(); //Obtener los valores de tu request:
            $pdf = PDF::loadView('CompanyInformation.users', compact('usuarios')); //genera el PDF la vista
            return $pdf->download('Usuarios-Compañia.pdf'); // descarga el pdf
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = User::destroy($id);
        return back()->with('datosEliminados', 'Registro Eliminado');
    }
}
