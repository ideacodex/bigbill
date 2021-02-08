<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
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
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador']);
        $user = User::all();
        $company = User::with('company')->get();
        return view("userInfo.UsuarioEmpresa.usuarios", ["user" => $user, "company" => $company]);
    }
    public function edit($id, Request $request)
    {
        $request->user()->authorizeRoles(['Administrador']);
        $user = User::findOrFail($id) and $companies = Company::all();
        return view('userInfo.UsuarioEmpresa.update', compact('user'), ["companies" => $companies]);
    }
    public  function update(Request $request, $id)
    {
        $user = request()->except((['_token', '_method']));
        $request->user()->authorizeRoles(['Administrador']);
        User::where('id', '=', $id)->update($user);
        return redirect()->action('UsuarioEmpresaController@index')->with('MENSAJEEXITOSO', 'Registro Modificado');
    }
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
    public function destroy($id)
    {
        $record = User::destroy($id);
        return back()->with('datosEliminados', 'Registro Eliminado');
    }
}
