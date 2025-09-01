<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DesignationSeeder extends Seeder
{
    public function run(): void
    {
        $designations = [
            'Chief Executive Officer',
            'Chief Technology Officer',
            'Project Manager',
            'Senior Software Engineer',
            'Junior Software Engineer',
            'HR Manager',
            'Marketing Executive',
        ];

        foreach ($designations as $designation) {
            DB::table('designations')->insert([
                'name'       => $designation,
                'slug'       => Str::slug($designation),
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
