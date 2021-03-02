<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

use App\Company;
use App\Post;
use App\Reaction;
use App\Question;
use App\Category;
use App\Award;
use App\User;
use App\Score;
use Illuminate\Support\Facades\DB;

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
        if (!$user->hasAnyRole(['Administrador', 'Gerente', 'Contador', 'Vendedor'])) {
            auth()->user()->syncRoles('Vendedor');
        }
        return view('PrimerIngreso.PrimerIngreso');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $request->user()->authorizeRoles(['Administrador', 'Gerente', 'Contador', 'Vendedor']); //autentificacion y permisos
        $role_id = Auth::user()->role_id;
        $user = User::findOrFail($id);
        if ($role_id == 2) {
            $companies = Company::where('user', $id)->get();
            return view('userInfo.edit', ['companies' => $companies, 'user' => $user]);
            
        } else {
            $company = Company::all();
            return view('userInfo.edit', ['company' => $company, 'user' => $user]);
        }
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

        request()->validate([
            'name' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'nit' => 'required',
            'address' => 'required',
            'email' => 'required',
            'file' => 'image',

        ]);
        DB::beginTransaction();
        try {
            //mandamos a llamar al modelo
            $user = User::findOrFail($id);
            //Actualizamos los datos con todo lo que venga del request
            $user->name = $request->name;
            $user->lastname = $request->lastname;
            $user->phone = $request->phone;
            $user->nit = $request->nit;
            $user->address = $request->address;
            $user->email = $request->email;
            $user->company_id = $request->company_id;
            //Guarda Informacion
            $user->save();

            //si viene alguna imagen nueva va a guardar la imagen actualizando el archivo
            if ($request->file) {
                //***carga de imagen***//
                if ($request->hasFile('file')) {
                    $extension = $request->file('file')->getClientOriginalExtension();
                    $imageNameToStore = $user->id . '.' . $extension;
                    // Upload file //***nombre de carpeta para almacenar**
                    $path = $request->file('file')->storeAs('public/usuarios', $imageNameToStore);
                    //dd($path);
                    $user->file = $imageNameToStore;
                    $user->save();
                } else {
                    $imageNameToStore = 'no_image.jpg';
                }
            }
            //***carga de imagen***//

        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            abort(500, $e->errorInfo[2]);
            return response()->json($e, 500);
        }
        DB::commit();
        return redirect()->action('ArchivosController@Perfil')
            ->with('MENSAJEEXITOSO', 'Registro modificado');
    }
}
