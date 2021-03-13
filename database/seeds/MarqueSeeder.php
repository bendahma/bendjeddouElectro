<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MarqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('marques')->insert([
            'name' => 'Aroma-Zone',
        ]);
        DB::table('marques')->insert([
            'name' => 'Avène',
        ]);
        DB::table('marques')->insert([
            'name' => 'Avène',
        ]);
        DB::table('marques')->insert([
            'name' => 'Bioderma',
        ]);
        DB::table('marques')->insert([
            'name' => 'Cattier',
        ]);
        DB::table('marques')->insert([
            'name' => 'L\'Occitane',
        ]);
        DB::table('marques')->insert([
            'name' => 'L\'Oréal Paris',
        ]);
        DB::table('marques')->insert([
            'name' => 'Lancôme',
        ]);
        DB::table('marques')->insert([
            'name' => 'Le Petit Marseillais',
        ]);
        DB::table('marques')->insert([
            'name' => 'Weleda',
        ]);
        DB::table('marques')->insert([
            'name' => 'NUXE',
        ]);
        DB::table('marques')->insert([
            'name' => 'Nivea',
        ]);
    }
}
