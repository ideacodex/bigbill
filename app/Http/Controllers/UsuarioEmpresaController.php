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
        return view('userInfo.UsuarioEmpresa.update', compact('user'),["companies" => $companies]);
    }
    
    public  function update(Request $request,$id)
    {
        $user = request()->except((['_token', '_method']));
        User::where('id', '=', $id)->update($user);

        return redirect()->action('UsuarioEmpresaController@index')->with('MENSAJEEXITOSO', 'Registro Modificado');
    }


}