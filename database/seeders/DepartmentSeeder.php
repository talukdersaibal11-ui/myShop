<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            [
                'name'       => 'Sales',
                'slug'       => Str::slug('Sales'),
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'       => 'Marketing',
                'slug'       => Str::slug('Marketing'),
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'       => 'Human Resources',
                'slug'       => Str::slug('Human Resources'),
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'       => 'Finance',
                'slug'       => Str::slug('Finance'),
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'       => 'IT',
                'slug'       => Str::slug('IT'),
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('departments')->insert($departments);
    }
}
