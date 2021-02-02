<?php

namespace App\Exports;

use App\Company;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class DocsCompany implements FromCollection, Responsable
{
    use Exportable;
    private $fileName = 'Companiasistado.xlsx';
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Company::all();
    }
}

