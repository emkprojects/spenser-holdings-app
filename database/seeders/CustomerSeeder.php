<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Administration\Customer;
use App\Models\Administration\CustomerType;
use App\Models\Administration\ReferrerType;
use App\Models\Settings\Group;
use App\Models\Settings\Category;
use App\Models\Settings\Position;


use Str;
use DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        

        $user = User::first();

        // $individual = Group::leftjoin('category_group', 'groups.id', '=', 'category_group.group_id')
        // ->leftjoin('categories', 'categories.id', '=', 'category_roup.category_id')
        // ->where('categories.category', 'individual')
        // ->where('groups.group', 'customer')->first();

        // $company = Group::leftjoin('category_group', 'groups.id', '=', 'category_roup.group_id')
        // ->leftjoin('categories', 'categories.id', '=', 'category_group.category_id')
        // ->where('categories.category', 'company')
        // ->where('groups.group', 'customer')->first();


        $loyal = CustomerType::where('customer_type', 'Loyal Customer')->first();
        $new   = CustomerType::where('customer_type', 'New Customer')->first();
        $position = Position::where('slug', 'head-chef')->first();

        $referrer_type   = ReferrerType::where('referrer_type', 'Employee')->first();
        
        $seeded_customers = [

            [
             'created_by' => $user->id,
             'customer_reference' => Str::uuid(), 
             'customer' => 'John Doe', 
             'customer_type_id' => $loyal->id,
             'phone_number' => '256750075055',
             'email_address' => 'customer@spenserholdings.org',
             'physical_address' => 'Plot 123 Mutungo Avenue - Mutungo',
             'contact_first_name' => 'John',
             'contact_last_name' => 'Doe',
             'contact_phone_number' => '256750075055',
             'contact_email_address' => 'customer@spenserholdings.org',
             'position_id' => $position->id, 
             'referrer_type_id' => $referrer_type->id,
             'user_id' => $user->id,
             'contact_gender' => 'Male',
             'contact_date_of_birth' => '1985/11/03',    
             'created_at' => now(),         

            ],

            [
             'created_by' => $user->id,
             'customer_reference' => Str::uuid(),
             'customer' => 'Jane Doe', 
             'customer_type_id' => $new->id,
             'phone_number' => '256778802878',
             'email_address' => 'customers@spenserholdings.org',
             'physical_address' => 'Plot 123 Hotel Street - Nakasero',
             'contact_first_name' => 'Jane',
             'contact_last_name' => 'Doe',
             'contact_phone_number' => '256778802878',
             'contact_email_address' => 'customers@spenserholdings.org',
             'position_id' => $position->id, 
             'referrer_type_id' => $referrer_type->id,
             'user_id' => $user->id,
             'contact_gender' => 'Female',
             'contact_date_of_birth' => '1999/01/30',         
             'created_at' => now(),         

            ],
        ];


        $customers =  Customer::insert($seeded_customers);
    }
}
