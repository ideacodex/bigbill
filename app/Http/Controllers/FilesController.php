<?php
namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade  as PDF;
use App\Product;
use App\Company;
use App\Customer;
use App\Account;
use App\DetailBill;
use App\InvoiceBill;
use App\User;

class FilesController extends Controller
{   
    public function show($id)
    {
        // $InvoiceBill = InvoiceBill::findOrFail($id);
        // $user = InvoiceBill::with('user')->get();
        // $company = InvoiceBill::with('company')->get();
        // $customer = InvoiceBill::with('customer')->get();
        

        // $DetailBill = DetailBill::findOrFail($id);
        // $product = DetailBill::with('product')->get();
        
        // $pdf = PDF::loadView('PDF.Factura', compact('DetailBill') , compact('InvoiceBill') );
        // return $pdf->download('FacturaEnviada.pdf' );
    }

    
}
