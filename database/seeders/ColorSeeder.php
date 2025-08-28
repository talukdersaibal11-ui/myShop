<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('colors')->insert([
            ['name' => 'Red',       'hex_code' => '#FF0000'],
            ['name' => 'Blue',      'hex_code' => '#0000FF'],
            ['name' => 'Green',     'hex_code' => '#008000'],
            ['name' => 'Yellow',    'hex_code' => '#FFFF00'],
            ['name' => 'Black',     'hex_code' => '#000000'],
            ['name' => 'White',     'hex_code' => '#FFFFFF'],
            ['name' => 'Orange',    'hex_code' => '#FFA500'],
            ['name' => 'Purple',    'hex_code' => '#800080'],
            ['name' => 'Gray',      'hex_code' => '#808080'],
            ['name' => 'Pink',      'hex_code' => '#FFC0CB'],
        ]);
    }
}
