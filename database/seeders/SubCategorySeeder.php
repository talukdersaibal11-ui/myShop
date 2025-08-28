<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubCategorySeeder extends Seeder
{
    public function run(): void
    {
        $subCategories = [
            ['category_id' => 1, 'name' => 'Mobile Phones'],
            ['category_id' => 1, 'name' => 'Laptops'],
            ['category_id' => 1, 'name' => 'Cameras'],

            ['category_id' => 2, 'name' => 'Men Clothing'],
            ['category_id' => 2, 'name' => 'Women Clothing'],
            ['category_id' => 2, 'name' => 'Shoes'],

            ['category_id' => 3, 'name' => 'Furniture'],
            ['category_id' => 3, 'name' => 'Home Decor'],
            ['category_id' => 3, 'name' => 'Kitchen Appliances'],
        ];

        foreach ($subCategories as $subCategory) {
            DB::table('sub_categories')->insert([
                'category_id' => $subCategory['category_id'],
                'name'       => $subCategory['name'],
                'slug'       => Str::slug($subCategory['name']),
            ]);
        }
    }
}
