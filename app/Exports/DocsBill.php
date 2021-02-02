<?php

namespace App\Exports;

use App\DetailBill;
use App\InvoiceBill;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class DocsBill implements FromCollection, Responsable
{
    use Exportable;
    private $fileName = 'FacturasListado.xlsx';
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return  InvoiceBill::all();
    }
}
