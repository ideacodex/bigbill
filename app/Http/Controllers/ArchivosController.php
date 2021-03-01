<?php

namespace App\Http\Controllers;

use AccountType;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade  as PDF;
use App\Product;
use App\Company;
use App\Customer;
use App\Account;
use App\BranchOffice;
use App\InvoiceBill;
use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArchivosController extends Controller
{

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
                return $pdf->download('Productos-Compañia.pdf'); // descarga el pdf
        }
    }
    //Company
    public function exportCompanyPDF()
    {
        $Company = Company::get();
        $pdf = PDF::loadView('PDF.Companypdf', ["Company" => $Company]);
        return $pdf->download('Company.pdf');
    }
    //clientes
    public function exportCustomerPDF()
    {
        $Customer = Customer::get();
        $pdf = PDF::loadView('PDF.Customerpdf', compact('Customer'));
        return $pdf->download('Customer.pdf');
    }
    //Account
    public function exportAccountPDF()
    {
        $account_types = Account::with('account_types')->get();
        $pdf = PDF::loadView('PDF.Accountpdf', ["Account" => $account_types]);
        return $pdf->download('Account.pdf', ["account_types" => $account_types]);
    }
    //Reporte facturas
    public function exportfacturatPDF()
    {
        $InvoiceBill = InvoiceBill::with('user')->with('company')->with('detail')->get();
        $pdf = PDF::loadView('PDF.Billpdf', ["InvoiceBill" => $InvoiceBill]);
        /* $pdf = PDF::loadView('PDF.Billpdf', compact('DetailBill') , compact('InvoiceBill')); */
        return $pdf->download('Factura.pdf');
    }
    //Impresion de Factura
    public function facturaCompañia(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador', 'Gerente', 'Contador']); //autentificacion y permisos
        /**si existe la columna company_id realizar: Filtrado de inforcion*/
        if (!empty($request->company_id)) {
            $records = InvoiceBill::with('user')->with('company')->with('customer')->with('detail.product')->find($request);
            $pdf = PDF::loadView('CompanyInformation.bills', compact('InvoiceBill', 'DetailBill')); //genera el PDF la vista
            return $pdf->download('Cuentas-Compañia.pdf', ['records' => $records]); // descarga el pdf
        }
    }
    //User
    public function exportUserPDF()
    {
        $User = User::all();
        $companies =  User::with('companies')->get();
        $pdf = PDF::loadView('PDF.Userpdf', compact('User'));
        return $pdf->download('User.pdf', ["companies" => $companies]);
    }
    //home 2.0 PERFIL
    public function Perfil()
    {

        $company_id = Auth::user()->company_id; //guardo la variable de compañia del ususario autentificado
        $branch_id = Auth::user()->branch_id; //guardo la variable de Sucursal del ususario autentificado
        $branch_offices =  BranchOffice::where('id', $branch_id)->get(); //realiza consulta mysql
        $company =  Company::where('id', $company_id)->get(); //realiza consulta mysql
        return view('userInfo.index', ["branch_offices" => $branch_offices, "company" => $company]);
    }
    //usuarios de una empresa
    public function Personal(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador', 'Gerente', 'Contador']); //autentificacion y permisos
        $company = Auth::user()->company_id; //guardo la variable de compañia del ususario autentificado
        $branch_office = BranchOffice::all();
        $user = User::where('company_id', $company)->with('company')->get(); //Obtener los valores
        return view("users.index", ["user" => $user, "branch_office" => $branch_office]); //generala vista
    }

    //Vista de ajustes
    public function settings(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador', 'Gerente']); //autentificacion y permisos
        $company =  Company::where('id', (Auth::user()->company_id))->get(); //realiza consulta mysql
        return view('settings.index', ["company" => $company]);
    }


    //Eliminar USUSARIO DESDE VISTA GENERENTE
    //El gerente podra eliminar a los ususarios de su empresa: Es decir le quita la compania

    public function eliminar( $id)
    {
        $user = User::findOrFail($id) and $companies = Company::all() and  $branch_office = BranchOffice::with('company')->get();
        return view('users.delete', compact('user'), ["companies" => $companies, "branch_office" => $branch_office]);
    }
    //muestra datos del ususario a quitar empresa por el gerente

    public  function deleteuser(Request $request, $id)
    {
        $request->user()->authorizeRoles(['Administrador','Gerente']); //autentificacion y permisos

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
            $user->company_id = null; //actualizo el Compañia
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


}
