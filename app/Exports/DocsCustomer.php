<?php

namespace App\Exports;

use App\Customer;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DocsCustomer implements FromCollection, Responsable, WithHeadings
{
    use Exportable;
    private $fileName = 'ClientesListado.xlsx';
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'No',
            'Nombre',
            'Apellido',
            'Teléfono',
            'Correo electrónico',
            'Nit', 
            'Fecha de creación',
        ];
    }

    public function collection()
    {
        return Customer::all();
    }
}

