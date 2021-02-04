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
    public function index()
    {
        $user = User::all();
        $company = User::with('company')->get();
        return view("userInfo.UsuarioEmpresa.usuarios", ["user" => $user, "company" => $company]);
    }
    public function edit($id)
    {
        $user = User::findOrFail($id) and $companies = Company::all();
        return view('userInfo.UsuarioEmpresa.update', compact('user'), ["companies" => $companies]);
    }
    public  function update(Request $request, $id)
    {
        $user = request()->except((['_token', '_method']));
        User::where('id', '=', $id)->update($user);

        return redirect()->action('UsuarioEmpresaController@index')->with('MENSAJEEXITOSO', 'Registro Modificado');
    }
    public function show(Request $request)
    {
        /**si existe la columna company_id realizar: Filtrado de inforcion*/
        if (!empty($request->company_id)) {
            $usuarios = User::where('company_id', $request->company_id)->with('company')->get(); //Obtener los valores de tu request:
            $pdf = PDF::loadView('CompanyInformation.users', compact('usuarios')); //genera el PDF la vista
            return $pdf->download('Usuarios-Compañia.pdf'); // descarga el pdf
        }
    }
}
