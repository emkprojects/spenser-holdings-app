<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Administration\ReferrerType;
use App\Models\Settings\Group;
use App\Models\Settings\Category;
use App\Models\User;

use Str;
use DB;

class ReferrerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $user = User::first();

        $seeded_referrer_types = [

            ['referrer_type_reference'=> Str::uuid(), 'referrer_type' => 'Employee', 'created_by' => $user->id, 'created_at' => now()],
            ['referrer_type_reference'=> Str::uuid(), 'referrer_type' => 'Customer', 'created_by' => $user->id, 'created_at' => now()],
            ['referrer_type_reference'=> Str::uuid(), 'referrer_type' => 'Supplier', 'created_by' => $user->id, 'created_at' => now()],
            ['referrer_type_reference'=> Str::uuid(), 'referrer_type' => 'Others', 'created_by' => $user->id, 'created_at' => now()],
            ['referrer_type_reference'=> Str::uuid(), 'referrer_type' => 'Self', 'created_by' => $user->id, 'created_at' => now()],
           
        ];

        $referrer_types = ReferrerType::insert($seeded_referrer_types);


    }
}
