<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role_id'   =>  '1',
            'name'      =>  'GEOVANNI',
            'email'     =>  'TEST@gmail.com',
            'password'  =>  Hash::make('password'),

        ]);
    }
}
