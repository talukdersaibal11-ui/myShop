<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeaveTypeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('leave_types')->insert([
            [
                'name'              => 'Casual Leave',
                'max_days_per_year' => 10,
                'created_by'        => 1,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'Sick Leave',
                'max_days_per_year' => 12,
                'created_by'        => 1,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'Annual Leave',
                'max_days_per_year' => 20,
                'created_by'        => 1,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'Maternity Leave',
                'max_days_per_year' => 90,
                'created_by'        => 1,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'Paternity Leave',
                'max_days_per_year' => 7,
                'created_by'        => 1,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ]);
    }
}
