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
    public function exportProductPDF(){
        $companies = Product::with('companies')->get();
        $pdf = PDF::loadView('PDF.Productpdf', compact('Products'));
        return $pdf->download('Product.pdf' , ["companies" => $companies]);
    }
    //Company
    public function exportCompanyPDF(){
        $Company = Company::get();
        $pdf = PDF::loadView('PDF.Companypdf', compact('Company'));
        return $pdf->download('Company.pdf');
    }
    //clientes
    public function exportCustomerPDF(){
        $Customer = Customer::get();
        $pdf = PDF::loadView('PDF.Customerpdf', compact('Customer'));
        return $pdf->download('Customer.pdf');
    }
    //Account
    public function exportAccountPDF(){
        $account_types = Account::with('account_types')->get();
        $pdf = PDF::loadView('PDF.Accountpdf', compact('Account') );
        return $pdf->download('Account.pdf' , ["account_types" => $account_types]);
    }
    //facturas
    public function exportfacturatPDF(){
        $company = InvoiceBill::with('company')->get();
        $user = InvoiceBill::with('user')->get();

        $DetailBill = DetailBill::all();
        $product = DetailBill::with('product')->get();

        $pdf = PDF::loadView('PDF.Billpdf', compact('DetailBill') , compact('InvoiceBill') );
        return $pdf->download('Factura.pdf' , ["product" => $product , "company" => $company , "user" => $user]);
    }
    //User
    public function exportUserPDF(){
        $User = User::all();
        $companies =  User::with('companies')->get();
        $pdf = PDF::loadView('PDF.Userpdf', compact('User'));
        return $pdf->download('User.pdf', ["companies"=>$companies]);
    }
    //home 2.0 PERFIL
    public function Perfil(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador','Gerente','Contador','Vendedor']);//autentificacion y permisos
        $companies = Company::all();
        return view('userInfo.index', ['companies' => $companies,]);
    }
    //usuarios de una empresa
    public function Personal(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador', 'Gerente', 'Contador']); //autentificacion y permisos

        $company = Auth::user()->company_id; //guardo la variable de compañia del ususario autentificado
        $branch_office = BranchOffice::all();
        $user = User::where('company_id',$company)->with('company')->get(); //Obtener los valores
        return view("users.index", ["user" => $user, "branch_office" => $branch_office]); //generala vista   
    }
    
    public function facturaCompañia(Request $request)
    {
        $request->user()->authorizeRoles(['Administrador', 'Gerente', 'Contador']); //autentificacion y permisos
        /**si existe la columna company_id realizar: Filtrado de inforcion*/
        if (!empty($request->company_id)) {
            $records = InvoiceBill::with('user')->with('company')->with('customer')->with('detail.product')->find($request);
            $pdf = PDF::loadView('CompanyInformation.bills', compact('InvoiceBill','DetailBill')); //genera el PDF la vista
            return $pdf->download('Cuentas-Compañia.pdf', ['records' => $records]); // descarga el pdf
        }
    }

}
