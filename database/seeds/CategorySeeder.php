<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Hygiène et Toilette',
        ]);
        DB::table('categories')->insert([
            'name' => 'Soins Esthétiques',
        ]);
        DB::table('categories')->insert([
            'name' => 'Solaires',
        ]);
        DB::table('categories')->insert([
            'name' => 'La beauté des mains et des pieds',
        ]);
        DB::table('categories')->insert([
            'name' => 'Epilation',
        ]);
        DB::table('categories')->insert([
            'name' => ' Maquillage',
        ]);
        DB::table('categories')->insert([
            'name' => 'Entretien capillaires',
        ]);
        DB::table('categories')->insert([
            'name' => 'Parfums',
        ]);
    }
}
