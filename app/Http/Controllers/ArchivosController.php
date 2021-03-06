<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade  as PDF;
use App\Product;
use App\Company;
use App\Customer;
use App\Account;
use App\Adds;
use App\BranchOffice;
use App\InvoiceBill;
use App\Shopping;
use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArchivosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); //autentificacion del usuario
        $this->middleware('verified');
    }
    //Todos los usuarios
    public function exportUserAllPDF()
    {
        $rol = Auth::user()->role_id;
        if ($rol == 1) {
            $User = User::all();
            $companies =  User::with('companies')->get();
            $pdf = PDF::loadView('PDF.Userpdf', compact('User'));
            return $pdf->download('Todos-los-Usuarios.pdf', ["companies" => $companies]);
        } else {
            return redirect()->action('ArchivosController@Perfil'); //redirecciono a mi pagina de inicio
        }
    }
    //User  - Usuarios por compania
    public function exportUserPDF()
    {
        $rol = Auth::user()->role_id;
        $company_id = Auth::user()->company_id;
        if ($rol == 1 && $company_id == null) {
            $User = User::all();
            $companies =  User::with('companies')->get();
            $pdf = PDF::loadView('PDF.Userpdf', compact('User'));
            return $pdf->download('User.pdf', ["companies" => $companies]);
        } else {
            if ($rol == 2 || $rol == 3 || ($rol == 1 && $company_id != null)) {
                $User = User::where('company_id', $company_id)->with('company')->get(); //Obtener los valores de tu request:
                $pdf = PDF::loadView('PDF.Userpdf', ["User" => $User]); //genera el PDF la vista
                return $pdf->download('User.pdf'); // descarga el pdf
            } else {
                return back();
            }
        }
    }
    //clientes
    public function exportCustomerPDF()
    {
        $rol = Auth::user()->role_id;
        $company_id = Auth::user()->company_id;
        if ($rol == 1 && $company_id == null) {
            $Customer = Customer::get();
            $pdf = PDF::loadView('PDF.Customerpdf', compact('Customer'));
            return $pdf->download('Customer.pdf');
        } else {
            if ($rol == 2 || $rol == 4 || ($rol == 1 && $company_id != null)) {
                $Customer = Customer::where('company_id', $company_id)->with('company')->get();
                $pdf = PDF::loadView('PDF.Customerpdf', ["Customer" => $Customer]);
                return $pdf->download('Customer.pdf');
            } else {
                return back();
            }
        }
    }
    //Account
    public function exportAccountPDF()
    {
        $account_types = Account::with('account_types')->get();
        $pdf = PDF::loadView('PDF.Accountpdf', ["Account" => $account_types]);
        return $pdf->download('Account.pdf', ["account_types" => $account_types]);
    }
    //Company
    public function exportCompanyPDF()
    {
        $Company = Company::all();
        $pdf = PDF::loadView('PDF.Companypdf', ["Company" => $Company]);
        return $pdf->download('Company.pdf');
    }
    //Sucursales
    public function exportBranchPDF()
    {
        $rol = Auth::user()->role_id;
        $company_id = Auth::user()->company_id;
        if ($rol == 1 && $company_id == null) {
            $records =  BranchOffice::with('company')->get();
            $pdf = PDF::loadView('PDF.Branchpdf', ["records" => $records]);
            return $pdf->download('Sucursales.pdf');
        } else {
            if ($rol == 2 || $rol == 3 || ($rol == 1 && $company_id != null)) {
                $records = BranchOffice::where('company_id', $company_id)->with('company')->get(); //Obtener los valores de tu request:
                $pdf = PDF::loadView('PDF.Branchpdf', ["records" => $records]); //genera el PDF la vista
                return $pdf->download('Sucursales.pdf'); // descarga el pdf
            } else {
                return redirect()->action('ArchivosController@Perfil'); //redirecciono a mi pagina de inicio
            }
        }
    }
    //Productos
    public function exportProductPDF()
    {
        $rol = Auth::user()->role_id;
        if ($rol == 1) {
            $Products = Product::with('companies')->get();
            $pdf = PDF::loadView('PDF.Productpdf', ["Products" => $Products]);
            return $pdf->download('Product.pdf');
        } else {
            /**si existe la columna company_id realizar: Filtrado de inforcion*/
            $companipdf = Auth::user()->company_id;
            $Products = Product::where('company_id', $companipdf)->with('company')->get(); //Obtener los valores de tu request:
            $pdf = PDF::loadView('CompanyInformation.products', compact('Products')); //genera el PDF la vista
            return $pdf->download('Productos-Compa??ia.pdf'); // descarga el pdf
        }
    }
    //Reporte facturas
    public function exportfacturatPDF()
    {
        $infoUser = Auth::user(); //traemos datos del usuario
        if ($infoUser->role_id == 1) { //si el usuario es ROL 1
            $InvoiceBill = InvoiceBill::with('user')->with('company')->with('detail')->get(); //RETORNA TODAS LAS FACTURAS
            $pdf = PDF::loadView('PDF.Billpdf', ["InvoiceBill" => $InvoiceBill]); //GENERA VISTA DE PDF
            return $pdf->download('Ventas.pdf'); //descarga el Docuemnto PDF
        } else { //SINO
            if ($infoUser->company_id != null) { // SI EL USUSARIO TRAE ALGUNA COMPANIA
                $InvoiceBill = InvoiceBill::where('company_id', $infoUser->company_id)->with('user')->with('company')->with('detail')->get(); //TRAER LAS FACTURAS SEGUN LA EMPRESA QUE TRAE EL USUSAIRO CON TODOS LOS DATOS DE LA FACTURA
                $pdf = PDF::loadView('PDF.Billpdf', ["InvoiceBill" => $InvoiceBill]); //GENERA VISTA DE PDF
                return $pdf->download('Ventas.pdf'); //descarga el Docuemnto PDF
            } else {
                # code...
                return back(); //regresa
            }
        }
    }

    //Reporte compras
    public function exportCompraPDF()
    {
        $shopping = Shopping::with('user')->with('company')->with('detail')->get();
        $pdf = PDF::loadView('PDF.Shoppingpdf', ["shopping" => $shopping]);
        /* $pdf = PDF::loadView('PDF.Billpdf', compact('DetailBill') , compact('InvoiceBill')); */
        return $pdf->download('Compras.pdf');
    }
    //Impresion de Compras     ----REVISION
    public function comprasCompa??ia(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador', 'Gerente', 'Contador']); //autentificacion y permisos
        /**si existe la columna company_id realizar: Filtrado de inforcion*/
        if (!empty($request->company_id)) {
            $records = Shopping::with('user')->with('company')->with('detail.product')->find($request);
            $pdf = PDF::loadView('CompanyInformation.bills', compact('Shopping', 'DetailShoppings')); //genera el PDF la vista
            return $pdf->download('Cuentas-Compa??ia.pdf', ['records' => $records]); // descarga el pdf
        }
    }

    //home 2.0 PERFIL
    public function Perfil()
    {
        $company_id = Auth::user()->company_id; //guardo la variable de compa??ia del ususario autentificado
        $branch_id = Auth::user()->branch_id; //guardo la variable de Sucursal del ususario autentificado
        $branch_offices =  BranchOffice::where('id', $branch_id)->get(); //realiza consulta mysql
        $company =  Company::where('id', $company_id)->get(); //realiza consulta mysql
        $anuncios = Adds::all();
        if ($anuncios->first()) {
            return view('userInfo.index', ["branch_offices" => $branch_offices, "company" => $company, 'anuncios' => $anuncios->random(1)]);
        } else {
            return view('userInfo.index', ["branch_offices" => $branch_offices, "company" => $company, 'anuncios' => null]);
        }
    }
    //usuarios de una empresa
    public function Personal(Request $request)
    {
        $rol = Auth::user()->role_id;
        if ($rol == 1 || $rol == 2  || $rol == 3) {
            $request->user()->authorizeRoles(['Administrador', 'Gerente', 'Contador']); //autentificacion y permisos
            $company = Auth::user()->company_id; //guardo la variable de compa??ia del ususario autentificado
            $branch_office = BranchOffice::all();
            $user = User::where('company_id', $company)->with('company')->get(); //Obtener los valores
            $anuncios = Adds::all();
            if ($anuncios->first()) {
                return view("users.index", ["user" => $user, "branch_office" => $branch_office, 'anuncios' => $anuncios->random(1)]); //generala vista

            } else {
                return view("users.index", ["user" => $user, "branch_office" => $branch_office, 'anuncios' => null]); //generala vista
            }
        } else {
            return redirect()->action('ArchivosController@Perfil'); //redirecciono a mi pagina de inicio

        }
    }
    //Vista de ajustes
    public function settings(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador', 'Gerente']); //autentificacion y permisos
        $company =  Company::where('id', (Auth::user()->company_id))->get(); //realiza consulta mysql
        $anuncios = Adds::all();
        if ($anuncios->first()) {
            return view('settings.index', ["company" => $company, 'anuncios' => $anuncios->random(1)]); //generala vista

        } else {
            return view('settings.index', ["company" => $company, 'anuncios' => null]); //generala vista
        }
    }
    //Eliminar USUSARIO DESDE VISTA GENERENTE
    //El gerente podra eliminar a los ususarios de su empresa: Es decir le quita la compania
    public function eliminar($id)
    {
        $user = User::findOrFail($id) and $companies = Company::all() and  $branch_office = BranchOffice::with('company')->get();
        $anuncios = Adds::all();
        if ($anuncios->first()) {
            return view('users.delete', compact('user'), ["companies" => $companies, "branch_office" => $branch_office, 'anuncios' => $anuncios->random(1)]); //generala vista

        } else {
            return view('users.delete', compact('user'), ["companies" => $companies, "branch_office" => $branch_office, 'anuncios' => null]); //generala vista
        }
    }
    //muestra datos del ususario a quitar empresa por el gerente
    public  function deleteuser(Request $request, $id)
    {
        $request->user()->authorizeRoles(['Administrador', 'Gerente']); //autentificacion y permisos

        request()->validate([ //validando campos requeridos
            'role_id' => 'required',
            'name' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'nit' => 'required',
            'address' => 'required',
            'email' => 'required'
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
            $user->company_id = null; //actualizo el Compa??ia
            $user->branch_id = null; //actualizo el sucursal
            $user->save();
        } catch (\Illuminate\Database\QueryException $e) { //si ocurre algo inesperado en la DB que me de error 500
            DB::rollback();
            abort(500, $e->errorInfo[2]);
            return response()->json($e, 500);
        }
        DB::commit();
        return redirect()->action('ArchivosController@Personal')->with('MENSAJEEXITOSO', 'Acaba de eliminar el usuario de su empresa'); //redirecciono a mi pagina de inicio
    }
    public function customersave(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'nit' => 'required',
            'company_id'
        ]);
        DB::beginTransaction();
        try {
            $customers = new Customer;
            $customers->name = $request->name;
            $customers->lastname = $request->lastname;
            $customers->phone = $request->phone;
            $customers->email = $request->email;
            $customers->nit = $request->nit;
            $customers->company_id = $request->company_id;
            $customers->save();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            abort(500, $e->errorInfo[2]); //en la poscision 2 del array est?? el mensaje
            return response()->json($e, 500);
        }
        DB::commit();
        return redirect()->action('InvoiceBillsController@create')
            ->with('datosAgregados', 'Registro exitoso');
    }
}
