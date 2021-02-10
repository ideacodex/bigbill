<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('account_types')->insert([
            'status' => 'Ingresos'
        ]);

        DB::table('accounts')->insert([
            'name' => 'Ventas', 
            'status_id' => '1'
        ]); 
    }
}
