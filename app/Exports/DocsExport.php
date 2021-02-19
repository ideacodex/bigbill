<?php

namespace App\Exports;

use App\Product;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DocsExport implements FromCollection, Responsable, WithHeadings
{
    use Exportable;
    private $fileName = 'ProductosListado.xlsx';
    /**
     * @return \Illuminate\Support\Collection
     */

    public function headings(): array
    {
        return [
            'No',
            'Nombre',
            'Descripción',
            'Precio',
            'Costo',
            'Precio especial',
            'Precio de crédito',
            'Companía',
            'Impuesto',
            'Cantidad en valores',
            'Tipo de producto',
            'Stock',
            'Activo',
            'Ingresos',
            'Nuevos ingresos',
            'Total de ingresos',
            'Egresos'
        ];
    }

    public function collection()
    {
        return Product::all();
    }
}
