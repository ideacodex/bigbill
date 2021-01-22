<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade  as PDF;
use App\Product;
class ArchivosController extends Controller
{
    public function exportPDF(){
        $products = Product::get();
        $pdf = PDF::loadView('PDF.productospdf', compact('products'));

        return $pdf->download('products.pdf');
    }

}
