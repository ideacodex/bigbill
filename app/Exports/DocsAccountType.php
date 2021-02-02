<?php

namespace App\Exports;

use App\AccountType;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class DocsAccountType implements FromCollection, Responsable
{
    use Exportable;
    private $fileName = 'TiposCuentasListado.xlsx';
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AccountType::all();
    }
}
