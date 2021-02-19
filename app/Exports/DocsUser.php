<?php

namespace App\Exports;

use App\User;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DocsUser implements FromCollection, Responsable, WithHeadings
{
    use Exportable;
    private $fileName = 'UsuariosListado.xlsx';
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'No',
            'Role',
            'Nombre',
            'Apellido',
            'Teléfono',
            'Nit',
            'Dirección',
            'Correo',
            'Verificación de correo',
            'Contraseña',
            'Historial de companías',
            'Historial de roles',
            'Companía',
            'Sucursal',
            'Token',
            'Fecha de creación',
        ];
    }

    public function collection()
    {
        return User::all();
    }
}

