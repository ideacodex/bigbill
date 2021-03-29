<?php

namespace App\Http\Controllers;

use App\Company;
use App\BranchOffice;
use App\Adds;
use App\Status;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class CompaniesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); //autentificacion del usuario
        $this->middleware('verified');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador']);
        $companies = Company::all();
        $rol = Auth::user()->role_id;
        if ($rol == 1) {
            $branch_office = BranchOffice::with('company')->get();
            return view('companies.index', ["companies" => $companies, 'branch_office' => $branch_office]); //retorna vista con los datos correspondientes
        } else {
            $company = Auth::user()->company_id; //guardo la variable de compañia del ususario autentificado
            $branch_office = BranchOffice::where('company_id', $company)->get(); //Obtener los valores relacionados a su compañia
            $anuncios = Adds::all();
            if ($anuncios->first()) {
                return view("companies.index", ["companies" => $companies, 'branch_office' => $branch_office, 'anuncios' => $anuncios->random(1)]);
            }
            else {
                return view('companies.index', ["companies" => $companies, 'branch_office' => $branch_office, 'anuncios' => null]); //generala vista
            }
        }
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
        $messege = 'Registro Modificado'; //mensaje
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
                if ($datosususario->company_id != null) {
                    $user->company_id = $datosususario->company_id; //actualizo el Compañia
                } else {
                    $cps = Company::where('nit', $request->nit)->first();
                    if ($cps) {
                        //Asignación de empresa 
                        $user->company_id = $cps->id;
                        $messege = "Se le agrego a la Empresa solicitada, " . $cps->name;
                    } else {
                        $user->company_id = null;
                        $messege = "Error de asignacion de empresa, porfavor vaya a actualizar su informacion manualmente";
                    }
                }
                $user->branch_id = $datosususario->branch_id; //actualizo el sucursal
                $user->work_permits = 1; //actualizo el sucursal
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
            return response()->json($e, 500);
        }
        DB::commit();
        if ($usuario == 1) {
            return redirect()->action('CompaniesController@index')
                ->with('datosAgregados', $messege);
        } else {
            return redirect()->action('ArchivosController@Perfil')
                ->with('MENSAJEEXITOSO', $messege);
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
        $permisos = Auth::user()->work_permits;
        $rol = Auth::user()->role_id;
        if ($permisos == 1 || $rol == 1) {
            $request->user()->authorizeRoles(['Administrador', 'Gerente']);
            $companies = Company::findOrFail($id);
            return view('companies.update', compact('companies'));
        } else {
            return redirect()->action('ArchivosController@Perfil')
                ->with('MENSAJEEXITOSO', 'Usted no esta autorizado para actualizar o gestionar informacion');
        }
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
        $permisos = Auth::user()->work_permits;
        $rol = Auth::user()->role_id;
        if ($permisos == 1 || $rol == 1) {
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
                return response()->json($e, 500);
            }
            DB::commit();
            if ($rol == 1) {
                return redirect()->action('CompaniesController@index')
                    ->with('datosModificados', 'Registro modificado');
            } else {
                return redirect()->action('ArchivosController@Perfil')
                    ->with('MENSAJEEXITOSO', 'Registro modificado');
            }
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
        $record = Company::destroy($id);
        return back()->with('datosEliminados', 'Registro Eliminado');
    }
}
