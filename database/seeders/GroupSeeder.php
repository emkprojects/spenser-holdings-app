<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Settings\Group;
use App\Models\User;
use Str;
use DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = User::first();

        $groups = [

            ['group_reference'=> Str::uuid(), 'group' => 'Supplier', 'created_by' => $user->id, 'created_at' => now()],
            ['group_reference'=> Str::uuid(), 'group' => 'Customer', 'created_by' => $user->id, 'created_at' => now()],
            ['group_reference'=> Str::uuid(), 'group' => 'Item', 'created_by' => $user->id, 'created_at' => now()],
            ['group_reference'=> Str::uuid(), 'group' => 'Production', 'created_by' => $user->id, 'created_at' => now()],
            ['group_reference'=> Str::uuid(), 'group' => 'Product', 'created_by' => $user->id, 'created_at' => now()],
            ['group_reference'=> Str::uuid(), 'group' => 'Sales', 'created_by' => $user->id, 'created_at' => now()],
            ['group_reference'=> Str::uuid(), 'group' => 'Stock', 'created_by' => $user->id, 'created_at' => now()],
            ['group_reference'=> Str::uuid(), 'group' => 'Payment', 'created_by' => $user->id, 'created_at' => now()],
            ['group_reference'=> Str::uuid(), 'group' => 'Expense', 'created_by' => $user->id, 'created_at' => now()],
            ['group_reference'=> Str::uuid(), 'group' => 'Company', 'created_by' => $user->id, 'created_at' => now()],
            ['group_reference'=> Str::uuid(), 'group' => 'Individual', 'created_by' => $user->id, 'created_at' => now()],
            

        ];

        $group = Group::insert($groups);
    }
}
