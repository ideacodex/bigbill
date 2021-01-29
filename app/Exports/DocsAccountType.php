<?php

namespace App\Exports;

use App\AccountType;
use Maatwebsite\Excel\Concerns\FromCollection;

class DocsAccountType implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AccountType::all();
    }
}
