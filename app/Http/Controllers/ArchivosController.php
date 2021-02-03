<?php

namespace App\Http\Controllers;

use AccountType;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade  as PDF;
use App\Product;
use App\Company;
use App\Customer;
use App\Account;
use App\DetailBill;
use App\InvoiceBill;
use App\User;
use Illuminate\Database\Console\Migrations\StatusCommand;

class ArchivosController extends Controller
{
    //Productos
    public function exportProductPDF(){
        $Products = Product::all();
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
        $Account = Account::all();
        $account_types = Account::with('account_types')->get();
        $pdf = PDF::loadView('PDF.Accountpdf', compact('Account') );
        return $pdf->download('Account.pdf' , ["account_types" => $account_types]);
    }
    //facturas
    public function exportfacturatPDF(){

        $InvoiceBill = InvoiceBill::all();
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
    //ImprimirFacturaDeVenta
}
