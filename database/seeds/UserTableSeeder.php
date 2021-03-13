<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'username' => 'admin',
            'password' => Hash::make('123456'),
            'role' => 'admin',
        ]);
        DB::table('magazins')->insert([
            'id' => 1,
            'name' => 'BENDJEDDOU ELECTROMENAGER' ,
            'address' => 'Rue Grande Maghreb Cité Zaaf Rabah'  ,
            'commune' => 'Azzada Skikda',
            'telephone' => '06.75.07.90.83' ,
            'fax' => '05.50.01.90.68' ,
        ]);
    }
}
