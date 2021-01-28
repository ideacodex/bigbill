<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade  as PDF;
use App\Product;
use App\Company;
use App\Customer;
use App\Account;
use App\DetailBill;
use App\InvoiceBill;
use App\User;
class ArchivosController extends Controller
{
    //Productos
    public function exportProductPDF(){
        $Products = Product::get();
        $pdf = PDF::loadView('PDF.Productpdf', compact('Products'));

        return $pdf->download('Product.pdf');
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
        $Account = Account::get();
        $pdf = PDF::loadView('PDF.Accountpdf', compact('Account'));

        return $pdf->download('Account.pdf');
    }
    //factura
    public function exportfacturatPDF(){
        $DetailBill = DetailBill::get();
        $InvoiceBill = InvoiceBill::get();

        $pdf = PDF::loadView('PDF.Billpdf', compact('DetailBill') , compact('InvoiceBill'));

        return $pdf->download('Factura.pdf');
    }
    //User
    public function exportUserPDF(){
        $User = User::get();
        $pdf = PDF::loadView('PDF.Userpdf', compact('User'));

        return $pdf->download('User.pdf');
    }
}
