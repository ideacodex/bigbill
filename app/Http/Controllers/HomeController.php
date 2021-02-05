<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use DB;
use App\Company;
use App\Post;
use App\Reaction;
use App\Question;
use App\Category;
use App\Award;
use App\User;
use App\Score;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth'); //autentificacion del usuario
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if (!$user->hasAnyRole(Role::all())) {
            auth()->user()->syncRoles('Vendedor');

            $request->user()->authorizeRoles(['Vendedor',]); //autentificacion y permisos
        }
        return view('PrimerIngreso.PrimerIngreso');
    }

    public function edit($id, Request $request)
    {
        $request->user()->authorizeRoles(['Administrador']); //autentificacion y permisos
        $user = User::findOrFail($id);
        return view('userInfo.edit', compact('user'));
    }

    public  function update(Request $request, $id)
    {
        $request->user()->authorizeRoles(['Administrador', 'Gerente', 'Contador', 'Vendedor']); //autentificacion y permisos
        $user = request()->except((['_token', '_method']));
        User::where('id', '=', $id)->update($user);

        return redirect()->action('ArchivosController@Perfil')->with('MENSAJEEXITOSO', 'Registro Modificado');
    }
}
