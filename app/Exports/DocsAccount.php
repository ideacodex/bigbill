<?php

namespace App\Exports;

use App\Account;
use Maatwebsite\Excel\Concerns\FromCollection;

class DocsAccount implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Account::all();
    }
}
