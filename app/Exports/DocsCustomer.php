<?php

namespace App\Exports;

use App\Customer;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class DocsCustomer implements FromCollection, Responsable
{
    use Exportable;
    private $fileName = 'ClientesListado.xlsx';
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Customer::all();
    }
}

