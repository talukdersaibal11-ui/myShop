<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
       $this->call([
           GodownSeeder::class,
            UserSeeder::class,
            CustomerTypeSeeder::class,
            ColorSeeder::class,
            SizeSeeder::class,
            CategorySeeder::class,
            SubCategorySeeder::class,
            BrandSeeder::class,
            LaratrustSeeder::class,
            UnitSeeder::class,
            SupplierSeeder::class,
       ]);
    }
}
