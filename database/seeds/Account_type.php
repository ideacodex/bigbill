<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\AccountType;

class Account_type extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seed = AccountType::first();

        if (!$seed) {
            $account_type = new AccountType;
            $account_type->status = "Activo";
            $account_type->save();
        }
    }
}
