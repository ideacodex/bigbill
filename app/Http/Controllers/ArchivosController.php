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
use App\DetailBill;
use App\InvoiceBill;
use App\User;
use Illuminate\Support\Facades\Crypt; //desenciptar
use Illuminate\Database\Console\Migrations\StatusCommand;
use Illuminate\Support\Facades\Auth;

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
}
