<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [];

        $faker = Faker::create('bn_BD');

        for ($i = 1; $i <= 50; $i++) {
            $name = 'Supplier ' . $i;
            $suppliers[] = [
                'name'         => $faker->name,
                'party_code'   => 'PARTY-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'company_name' => $name . ' Ltd.',
                'email'        => 'supplier' . $i . '@example.com',
                'phone'        => '+8801' . rand(100000000, 999999999),
                'address'      => rand(100, 999) . ' Main Street',
                'city'         => ['Dhaka','Chittagong','Khulna','Rajshahi','Sylhet'][array_rand(['Dhaka','Chittagong','Khulna','Rajshahi','Sylhet'])],
                'state'        => 'State ' . rand(1,10),
                'country'      => 'Bangladesh',
                'zip_code'     => rand(1000,9999),
                'tin_number'   => 'TIN' . rand(100000,999999),
                'vat_number'   => 'VAT' . rand(100000,999999),
                'notes'        => 'Auto generated supplier for testing.',
                'status'       => ['active','inactive'][array_rand(['active','inactive'])],
                'created_at'   => now(),
                'updated_at'   => now(),
            ];
        }

        DB::table('suppliers')->insert($suppliers);
    }
}
