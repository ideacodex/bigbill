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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
            $companies = Company::all();
            

        $user = Auth::user();
        if (!$user->hasAnyRole(Role::all())){
            auth()->user()->syncRoles('Usuario');
        }
        // return view('usuario.frmusuario');
        return view('userInfo.index', ['companies' => $companies, ]);
        
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('userInfo.edit', compact('user'));
    }
    
    public  function update(Request $request,$id)
    {
        $user = request()->except((['_token', '_method']));
        User::where('id', '=', $id)->update($user);

        return redirect()->action('HomeController@index')->with('MENSAJEEXITOSO', 'Registro Modificado');
    }
}
