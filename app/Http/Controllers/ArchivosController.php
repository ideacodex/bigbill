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
    //productos
    public function exportPDF(){
        $products = Product::get();
        $pdf = PDF::loadView('PDF.productospdf', compact('products'));

        return $pdf->download('products.pdf');
    }
    //clientes
    public function exportclientPDF(){
        $products = Product::get();
        $pdf = PDF::loadView('PDF.productospdf', compact('products'));

        return $pdf->download('products.pdf');
    }
    //empleados
    public function exportemployeesPDF(){
        $products = Product::get();
        $pdf = PDF::loadView('PDF.productospdf', compact('products'));

        return $pdf->download('products.pdf');
    }
    //company
    public function exportcompanyPDF(){
        $products = Product::get();
        $pdf = PDF::loadView('PDF.productospdf', compact('products'));

        return $pdf->download('products.pdf');
    }
    //factura
    public function exportbillPDF(){
        $products = Product::get();
        $pdf = PDF::loadView('PDF.productospdf', compact('products'));

        return $pdf->download('products.pdf');
    }

}
