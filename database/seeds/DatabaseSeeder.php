<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);

      //   $this->call(ClientSeeder::class);
      //   $this->call(CategorySeeder::class);
      //   $this->call(MarqueSeeder::class);
        // $this->call(ProductSeeder::class);
        // $this->call(ImageSeeder::class);
    }
}
