<?php

namespace App\Exports;

use App\DetailBill;
use App\InvoiceBill;
use Maatwebsite\Excel\Concerns\FromCollection;

class DocsBill implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return  InvoiceBill::all();
    }
}
