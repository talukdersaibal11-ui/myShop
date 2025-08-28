<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('bn_BD');
        $users = [];

        for ($i = 1; $i <= 100; $i++) {
            $users[] = [
                'name'               => $faker->name,
                'email'              => $faker->unique()->safeEmail,
                'phone_number'       => '017' . str_pad(mt_rand(10000000, 99999999), 8, '0', STR_PAD_LEFT),
                'address'            => $faker->address,
                'verification_token' => Str::random(10),
                'is_verified'        => $faker->boolean(70),
                'email_verified_at'  => $faker->boolean(70) ? Carbon::now() : null,
                'password'           => Hash::make('password123'),
                'status'             => 'active',
                'created_at'         => Carbon::now(),
                'updated_at'         => Carbon::now(),
            ];
        }

        DB::table('users')->insert($users);
    }
}
