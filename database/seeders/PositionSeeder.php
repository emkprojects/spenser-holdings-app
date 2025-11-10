<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Settings\Position;
use App\Models\User;
use Str;
use DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        

        $user = User::first();

        $seeded_positions = [

            ['position_reference'=> Str::uuid(), 'position' => 'Specialist', 'slug' => 'specialist', 'created_at' => now()],
            ['position_reference'=> Str::uuid(), 'position' => 'Managing Director (MD)', 'slug' => 'managing-director', 'created_at' => now()],
            ['position_reference'=> Str::uuid(), 'position' => 'Chief Operations Officer (COO)', 'slug' => 'chief-operations-officer', 'created_at' => now()],
            ['position_reference'=> Str::uuid(), 'position' => 'Chief Technology Officer (CTO)', 'slug' => 'chief-technology-officer', 'created_at' => now()],
            ['position_reference'=> Str::uuid(), 'position' => 'Chief Finance Officer (CFO)', 'slug' => 'chief-finance-officer', 'created_at' => now()],
            ['position_reference'=> Str::uuid(), 'position' => 'Supervisor', 'slug' => 'supervisor', 'created_at' => now()],
            ['position_reference'=> Str::uuid(), 'position' => 'Accountant', 'slug' => 'accountant', 'created_at' => now()],
            ['position_reference'=> Str::uuid(), 'position' => 'Cashier', 'slug' => 'cashier', 'created_at' => now()],
            ['position_reference'=> Str::uuid(), 'position' => 'Proprietor', 'slug' => 'proprietor', 'created_at' => now()],
            ['position_reference'=> Str::uuid(), 'position' => 'Manager', 'slug' => 'manager', 'created_at' => now()],
            ['position_reference'=> Str::uuid(), 'position' => 'Operations Officer', 'slug' => 'operation-officer', 'created_at' => now()],
            ['position_reference'=> Str::uuid(), 'position' => 'Head Chef', 'slug' => 'head-chef', 'created_at' => now()],
                  

        ];

        $position = Position::insert($seeded_positions);

    }
}
