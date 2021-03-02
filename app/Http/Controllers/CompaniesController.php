<?php

namespace App\Http\Controllers;

use App\Company;
use App\Status;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class CompaniesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador']);
        $companies = Company::all();
        return view("companies.index", ["companies" => $companies]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador', 'Vendedor']);
        return view("companies.create");
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = Auth::user()->role_id;

        request()->validate([
            'name' => 'required',
            'nit' => 'required|unique:companies,nit|min:5',
            'phone' => 'required',
            'address' => 'required',
            'file' => 'image',
        ]);
        DB::beginTransaction();
        try {
            $usuarioID = Auth::user()->id;
            $companies = new Company;
            $companies->name = $request->name;
            $companies->nit = $request->nit;
            $companies->phone = $request->phone;
            $companies->address = $request->address;
            $companies->user = $usuarioID;
            $companies->save();
            if ($usuario == 4) {
                $datosususario = Auth::user();
                $user = User::findOrFail($usuarioID); //edito al usuario por medio el id
                $role = Role::find(2); //edito el rol por medio el role_id
                $user->syncRoles($role); //actualizo el rol en la tabla de permisos
                $user->role_id = 2; //actualizo el rol en la tabla de usuarios
                $user->name = $datosususario->name; //actualizo el nombre
                $user->lastname = $datosususario->lastname; //actualizo el apellido
                $user->phone = $datosususario->phone; //actualizo el telefono
                $user->nit = $datosususario->nit; //actualizo el nit
                $user->address = $datosususario->address; //actualizo el direccion
                $user->email = $datosususario->email; //actualizo el correo
                $user->company_id = $datosususario->company_id; //actualizo el Compañia
                $user->branch_id = $datosususario->branch_id; //actualizo el sucursal
                $user->save();
            
        }

           

            //***carga de imagen***//
            if ($request->hasFile('file')) {
                $extension = $request->file('file')->getClientOriginalExtension();
                $imageNameToStore = $companies->id . '.' . $extension;
                // Upload file //***nombre de carpeta para almacenar**
                $path = $request->file('file')->storeAs('public/companias', $imageNameToStore);
                //dd($path);
                $companies->file = $imageNameToStore;
                $companies->save();
            } else {
                $imageNameToStore = 'no_image.jpg';
            }
            //***carga de imagen***//
            
            
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            abort(500, $e->errorInfo[2]); //en la poscision 2 del array está el mensaje
            return response()->json($response, 500);
        }
        DB::commit();
        if ($usuario == 1) {
            return redirect()->action('CompaniesController@index')
                ->with('datosAgregados', 'Registro exitoso');
        } else {
            return redirect()->action('ArchivosController@Perfil')
                ->with('datosAgregados', 'Registro exitoso');
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request) //editform
    {
        $request->user()->authorizeRoles(['Administrador']);
        $companies = Company::findOrFail($id);
        return view('companies.update', compact('companies'));
    }
    //Show
    public function show($id, Request $request) //editform
    {
        $request->user()->authorizeRoles(['Administrador']);
        $companies = Company::findOrFail($id);
        return view('companies.show', compact('companies'));
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
            'nit' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'file' => 'image',

        ]);
        DB::beginTransaction();
        try {
            //mandamos a llamar al modelo
            $companies = Company::findOrFail($id);
            //Actualizamos los datos con todo lo que venga del request
            $companies->name = $request->name;
            $companies->nit = $request->nit;
            $companies->address = $request->address;
            $companies->phone = $request->phone;
            $companies->save();

            //si viene alguna imagen nueva va a guardar la imagen actualizando el archivo
            if ($request->file) {
                //***carga de imagen***//
                if ($request->hasFile('file')) {
                    $extension = $request->file('file')->getClientOriginalExtension();
                    $imageNameToStore = $companies->id . '.' . $extension;
                    // Upload file //***nombre de carpeta para almacenar**
                    $path = $request->file('file')->storeAs('public/companias', $imageNameToStore);
                    //dd($path);
                    $companies->file = $imageNameToStore;
                    $companies->save();
                } else {
                    $imageNameToStore = 'no_image.jpg';
                }
            }
            //***carga de imagen***//

        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            abort(500, $e->errorInfo[2]);
            return response()->json($response, 500);
        }
        DB::commit();
        return redirect()->action('CompaniesController@index')
            ->with('datosModificados', 'Registro modificado');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Company::destroy($id);
        return back()->with('datosEliminados', 'Registro Eliminado');
    }
}
