<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserStatus;
use Str;
use DB;

class UserStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seeded_statuses = [

            ['user_status_reference'=> Str::uuid(),    'user_status' => 'Active', 'created_at' => now()],
            ['user_status_reference'=> Str::uuid(),    'user_status' => 'Suspended', 'created_at' => now()],
            ['user_status_reference'=> Str::uuid(),    'user_status' => 'Deactivated', 'created_at' => now()],

        ];

        $user_status = UserStatus::insert($seeded_statuses);
    }
}
