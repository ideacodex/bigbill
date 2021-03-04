<?php

namespace App\Http\Controllers;

use App\BranchOffice;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\User;
use App\Company;
use App\Suscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleXMLElement;

class UsuarioEmpresaController extends Controller
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
        $request->user()->authorizeRoles(['Administrador']); //autentificacion y permisos
        $user = User::with('companies')->with('branch_offices')->with('suscriptions')->get();

        /* $xmlstr =
            '<?xml version="1.0" encoding="UTF-8"?>
                <keys>
                <key lang="en">&lt;Insert&gt;</key>
                <key lang="de">&lt;Einfügen&gt;</key>
                </keys>';

        $sxe = new SimpleXMLElement($xmlstr);

        $output = $sxe->asXML();
        dd($output); */

        return view("userInfo.UsuarioEmpresa.usuarios", ["user" => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {

        $request->user()->authorizeRoles(['Administrador', 'Gerente']); //autentificacion y permisos
        $user = User::findOrFail($id) and $companies = Company::all() and  $branch_office = BranchOffice::with('company')->get();
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
        $request->user()->authorizeRoles(['Administrador', 'Gerente']); //autentificacion y permisos

        request()->validate([ //validando campos requeridos
            'role_id' => 'required',
            'name' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'nit' => 'required',
            'address' => 'required',
            'email' => 'required',
            'work_permits' => 'required'
        ]);
        DB::beginTransaction(); //transaccion en base de datos
        try {
            $user = User::findOrFail($id); //edito al usuario por medio el id
            $role = Role::find($request->role_id); //edito el rol por medio el role_id
            $user->syncRoles($role); //actualizo el rol en la tabla de permisos
            $user->role_id = $request->role_id; //actualizo el rol en la tabla de usuarios
            $user->name = $request->name; //actualizo el nombre
            $user->lastname = $request->lastname; //actualizo el apellido
            $user->phone = $request->phone; //actualizo el telefono
            $user->nit = $request->nit; //actualizo el nit
            $user->address = $request->address; //actualizo el direccion
            $user->email = $request->email; //actualizo el correo

            if ($request->company_id >= 1) {
                $user->company_id = $request->company_id; //actualizo la Compañia
                $user->branch_id = $request->branch_id; //actualizo el sucursal
                if ($request->work_permits == 1) {
                    $user->work_permits = $request->work_permits; //actualizo Permisos
                } else {
                    $user->work_permits = 0; //actualizo Permisos
                }
            } else {
                $user->company_id = null; //actualizo Compañia
                $user->branch_id = null; //actualizo el sucursal
                $user->work_permits = 0; //actualizo Permisos
            }



            $user->save();
        } catch (\Illuminate\Database\QueryException $e) { //si ocurre algo inesperado en la DB que me de error 500
            DB::rollback();
            abort(500, $e->errorInfo[2]);
            return response()->json($response, 500);
        }
        DB::commit();

        if (Auth::user()->role_id == 1) {
            return redirect()->action('UsuarioEmpresaController@index')->with('MENSAJEEXITOSO', 'Registro Modificado'); //redirecciono a mi pagina de inicio
        } else {
            return redirect()->action('ArchivosController@Personal')->with('MENSAJEEXITOSO', 'Registro Modificado'); //redirecciono a mi pagina de inicio
        }
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
        $suscription = Suscription::where('user_id', $id)->delete();
        //$suscription->destroy();
        $record = User::destroy($id);
        return back()->with('datosEliminados', 'Registro Eliminado');
    }

    public function suscription_user()
    {
        //Finaliza la suscripción de 15 días.
        $suscriptions = Suscription::where('active', 1)->whereDate('date_expiration', '<=', now())->with('user')->get();
        /* dd($suscriptions); */

        for ($i = 0; $i < $suscriptions->count(); $i++) {
            //$days = $suscriptions[$i]->created_at->diff(date('Y-m-d'))->format('%a');
            $suscriptions[$i]->user->history_company_id = $suscriptions[$i]->user->company_id;
            $suscriptions[$i]->user->company_id = null;
            $suscriptions[$i]->user->history_role_id = $suscriptions[$i]->user->role_id;
            $suscriptions[$i]->user->syncRoles('Vendedor');
            $suscriptions[$i]->user->save();
            $suscriptions[$i]->active = 0;
            $suscriptions[$i]->save();
        }
        return redirect()->action('UsuarioEmpresaController@index')->with('MENSAJEEXITOSO', 'Gestión actualizada');
    }
}
