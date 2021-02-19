<?php

namespace App\Exports;

use App\Company;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DocsCompany implements FromCollection, Responsable, WithHeadings
{
    use Exportable;
    private $fileName = 'Companiasistado.xlsx';
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'No',
            'Nombre',
            'Nit',
            'Teléfono',
            'Dirección',
            'Fecha de creación',
        ];
    }

    public function collection()
    {
        return Company::all();
    }
}

