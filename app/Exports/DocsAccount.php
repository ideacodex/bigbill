<?php

namespace App\Exports;

use App\Account;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class DocsAccount implements FromCollection, Responsable
{
    use Exportable;
    private $fileName = 'CuentasListado.xlsx';
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Account::all();
    }
}
