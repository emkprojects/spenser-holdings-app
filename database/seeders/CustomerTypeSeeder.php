<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Administration\customerType;
use App\Models\Settings\Group;
use App\Models\Settings\Category;
use App\Models\User;

use Str;
use DB;

class CustomerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        


        $user = User::first();
        
        $customer_group = Group::where('group', 'customer')->first();
        $company_group = Group::where('group', 'company')->first();
        $individual_group = Group::where('group', 'individual')->first();

        $seeded_customer_types = [

            ['customer_type_reference'=> Str::uuid(), 'customer_type' => 'Loyal Customer', 'description' => 'These customers have an established, long-term relationship with the brand and are likely to be repeat buyers and advocates', 'created_by' => $user->id, 'created_at' => now()],
            ['customer_type_reference'=> Str::uuid(), 'customer_type' => 'Impulse Customer', 'description' => 'They make spontaneous purchasing decisions, often driven by emotion, and are less focused on research or specific features', 'created_by' => $user->id, 'created_at' => now()],
            ['customer_type_reference'=> Str::uuid(), 'customer_type' => 'Discount Customer', 'description' => 'Motivated by price, these customers primarily look for deals, sales, and special offers', 'created_by' => $user->id, 'created_at' => now()],
            ['customer_type_reference'=> Str::uuid(), 'customer_type' => 'Need-Based', 'description' => 'They purchase products or services to fulfill a specific, immediate need', 'created_by' => $user->id, 'created_at' => now()],
            ['customer_type_reference'=> Str::uuid(), 'customer_type' => 'New Customer', 'description' => 'Individuals who are engaging with a brand for the first time or have recently made their initial purchase', 'created_by' => $user->id, 'created_at' => now()],
            ['customer_type_reference'=> Str::uuid(), 'customer_type' => 'Prospect Customer ', 'description' => 'People who have shown interest in a product or service but have not yet made a buying decision', 'created_by' => $user->id, 'created_at' => now()],
            ['customer_type_reference'=> Str::uuid(), 'customer_type' => 'Company', 'description' => '', 'created_by' => $user->id, 'created_at' => now()],
            ['customer_type_reference'=> Str::uuid(), 'customer_type' => 'Individual', 'description' => '', 'created_by' => $user->id, 'created_at' => now()],
                     
        ];

        $customer_types =  CustomerType::insert($seeded_customer_types);


    }
}
