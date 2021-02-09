<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'name'      =>  'PC TECNOLOGI',
            'nit'       =>  '000000',
            'phone'     =>  '58251362',
            'address'   =>  'Guatemala Z4 Torre 1',
        ]);
    }
}
