<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use DB;
use App\Post;
use App\Reaction;
use App\Question;
use App\Category;
use App\Award;
use App\User;
use App\Company;

class UsuarioEmpresaController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
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
        $usuarios = User::query();
        //Obtienes los valores de tu request:
        $company_id = $request->company_id;
        //Compruebas que tengan algo los valores que envía el usuario:
        //Agregas los campos que te sean necesarios aquí...
        if (!empty($company_id)) {
            $usuarios = $usuarios->where('company_id', $company_id);
        }
        //Obtienes los resultados aquí:

        $usuarios = $usuarios->get(); //También puedes paginar los resultados pero es algo muy fácil de hacer y sugiero cheques la documentación

        //Para llenar el select del formulario, en el caso que tuvieras las opciones en base de datos:
        $tipos = Company::all();

        return view('CompanyInformation.users')->with(compact('usuarios', 'tipos'));
    }
}
