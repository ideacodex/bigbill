<?php

namespace App\Exports;

use App\Product;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class DocsExport implements FromCollection, Responsable
{
    use Exportable;
    private $fileName = 'ProductosListado.xlsx';
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::all();
    }
}
