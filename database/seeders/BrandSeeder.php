<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('brands')->insert([
            ['name' => 'Nike',          'slug' => Str::slug('Nike')],
            ['name' => 'Adidas',        'slug' => Str::slug('Adidas')],
            ['name' => 'Puma',          'slug' => Str::slug('Puma')],
            ['name' => 'Reebok',        'slug' => Str::slug('Reebok')],
            ['name' => 'Under Armour',  'slug' => Str::slug('Under Armour')],
            ['name' => 'New Balance',   'slug' => Str::slug('New Balance')],
            ['name' => 'ASICS',         'slug' => Str::slug('ASICS')],
            ['name' => 'Converse',      'slug' => Str::slug('Converse')],
            ['name' => "Levi's",        'slug' => Str::slug("Levi's")],
            ['name' => 'Gucci',         'slug' => Str::slug('Gucci')],
        ]);
    }
}
