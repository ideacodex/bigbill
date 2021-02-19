<?php

namespace App\Exports;

use App\DetailBill;
use App\InvoiceBill;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DocsBill implements FromCollection, Responsable, WithHeadings
{
    use Exportable;
    private $fileName = 'FacturasListado.xlsx';
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'No',
            'Facturador',
            'Companía',
            'Sucursal',
            'Cliente',
            'Iva', 
            'Adquisición',
            'Estado',
            'Código',
            'Total',
            'Total en letras',
            'Cuenta contable',
            'Cliente C/F',
            'Correo C/F',
            'Descripción',
            'Fecha de vencimiento'
        ];
    }

    public function collection()
    {
        return  InvoiceBill::with('user')->with('company')->with('customer')->get();
    }
}
