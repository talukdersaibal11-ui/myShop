<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    public function run(): void
    {
        $units = [
            ['name' => 'Piece',       'symbol' => 'pc'],
            ['name' => 'Kilogram',    'symbol' => 'kg'],
            ['name' => 'Gram',        'symbol' => 'g'],
            ['name' => 'Liter',       'symbol' => 'L'],
            ['name' => 'Milliliter',  'symbol' => 'ml'],
            ['name' => 'Meter',       'symbol' => 'm'],
            ['name' => 'Centimeter',  'symbol' => 'cm'],
            ['name' => 'Inch',        'symbol' => 'in'],
            ['name' => 'Foot',        'symbol' => 'ft'],
            ['name' => 'Box',         'symbol' => 'box'],
            ['name' => 'Pack',        'symbol' => 'pack'],
        ];

        foreach ($units as $unit) {
            DB::table('units')->insert([
                'name'       => $unit['name'],
                'slug'       => Str::slug($unit['name']),
                'symbol'     => $unit['symbol'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
