<?php

namespace App\Exports;

use App\Account;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DocsAccount implements FromCollection, Responsable, WithHeadings
{
    use Exportable;
    private $fileName = 'CuentasListado.xlsx';
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'No',
            'Cuenta',
            'Tipo de cuenta',
            'Fecha de creación',
        ];
    }

    public function collection()
    {
        return Account::all();
    }
}
