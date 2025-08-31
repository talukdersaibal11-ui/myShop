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
        $faker = Faker::create();
        $godownCodes = DB::table('godowns')->pluck('code')->toArray();

        $users = [];

        for ($i = 1; $i <= 20; $i++) {
            $users[] = [
                'godown_code'        => $faker->randomElement($godownCodes),
                'name'               => $faker->name,
                'email'              => $faker->unique()->safeEmail,
                'phone_number'       => $faker->unique()->numerify('017########'),
                'address'            => $faker->address,
                'verification_token' => Str::random(10),
                'is_verified'        => $faker->boolean,
                'email_verified_at'  => $faker->boolean ? Carbon::now() : null,
                'password'           => Hash::make('password'),
                'status'             => $faker->randomElement(['active', 'inactive']),
                'remember_token'     => Str::random(10),
                'created_at'         => Carbon::now(),
                'updated_at'         => Carbon::now(),
            ];
        }

        DB::table('users')->insert($users);
    }
}
