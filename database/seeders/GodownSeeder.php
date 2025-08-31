<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GodownSeeder extends Seeder
{
    public function run(): void
    {
        $godowns = [
            [
                'name'         => 'Central Godown',
                'slug'         => Str::slug('Central Godown'),
                'code'         => 'GD001',
                'manager'      => 'John Doe',
                'phone_number' => '01710000001',
                'address'      => '123 Main Street, Dhaka',
                'prefix'       => 'CGD',
                'created_by'   => 1,
                'updated_by'   => 1,
                'deleted_by'   => null,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'name'         => 'North Zone Warehouse',
                'slug'         => Str::slug('North Zone Warehouse'),
                'code'         => 'GD002',
                'manager'      => 'Jane Smith',
                'phone_number' => '01710000002',
                'address'      => 'North Street, Sylhet',
                'prefix'       => 'NZW',
                'created_by'   => 1,
                'updated_by'   => 1,
                'deleted_by'   => null,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'name'         => 'South Zone Storage',
                'slug'         => Str::slug('South Zone Storage'),
                'code'         => 'GD003',
                'manager'      => 'David Khan',
                'phone_number' => '01710000003',
                'address'      => 'South Road, Chittagong',
                'prefix'       => 'SZS',
                'created_by'   => 1,
                'updated_by'   => 1,
                'deleted_by'   => null,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'name'         => 'East Distribution Center',
                'slug'         => Str::slug('East Distribution Center'),
                'code'         => 'GD004',
                'manager'      => 'Lisa Rahman',
                'phone_number' => '01710000004',
                'address'      => 'East Avenue, Rajshahi',
                'prefix'       => 'EDC',
                'created_by'   => 1,
                'updated_by'   => 1,
                'deleted_by'   => null,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'name'         => 'West Logistics Hub',
                'slug'         => Str::slug('West Logistics Hub'),
                'code'         => 'GD005',
                'manager'      => 'Mark Hossain',
                'phone_number' => '01710000005',
                'address'      => 'West Lane, Khulna',
                'prefix'       => 'WLH',
                'created_by'   => 1,
                'updated_by'   => 1,
                'deleted_by'   => null,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
        ];

        DB::table('godowns')->insert($godowns);
    }
}
