<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Administration\Supplier;
use App\Models\Administration\SupplierType;
use App\Models\Settings\Group;
use App\Models\Settings\Category;
use App\Models\Settings\Position;

use Str;
use DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $user = User::first();

        // $individual = Group::leftjoin('category_roup', 'groups.id', '=', 'category_roup.group_id')
        // ->leftjoin('categories', 'categories.id', '=', 'category_roup.category_id')
        // ->where('categories.category', 'individual')
        // ->where('groups.group', 'supplier')->first();

        // $company = Group::leftjoin('category_roup', 'groups.id', '=', 'category_roup.group_id')
        // ->leftjoin('categories', 'categories.id', '=', 'category_roup.category_id')
        // ->where('categories.category', 'company')
        // ->where('groups.group', 'supplier')->first();
        
        $raw_material = SupplierType::where('supplier_type', 'Raw material Supplier')->first();
        $manufacturer = SupplierType::where('supplier_type', 'Manufacturer')->first();
        
        $position   = Position::where('slug', 'manager')->first();
        
        $seeded_suppliers = [

            [
             'created_by' => $user->id,
             'supplier_reference' => Str::uuid(), 
             'supplier' => 'John Doe', 
             'supplier_type_id' => $raw_material->id,
             'phone_number' => '256750075055',
             'email_address' => 'supplier@spenserholdings.org',
             'physical_address' => 'Plot 123 Edgar Road - Mutungo',
             'contact_first_name' => 'John',
             'contact_last_name' => 'Doe',
             'contact_phone_number' => '256750075055',
             'contact_email_address' => 'supplier@spenserholdings.org',
             'position_id' => $position->id,  
             'contact_gender' => 'Male',
             'contact_date_of_birth' => '1978/05/10',          
             'created_at' => now(),    

            ],

            [
             'created_by' => $user->id,
             'supplier_reference' => Str::uuid(),
             'supplier' => 'Jane Doe', 
             'supplier_type_id' => $manufacturer->id,
             'phone_number' => '256778802878',
             'email_address' => 'suppliers@spenserholdings.org',
             'physical_address' => 'Plot 123 Edgar Road - Mutungo',
             'contact_first_name' => 'Jane',
             'contact_last_name' => 'Doe',
             'contact_phone_number' => '256778802878',
             'contact_email_address' => 'suppliers@spenserholdings.org',
             'position_id' => $position->id,
             'contact_gender' => 'Female',
             'contact_date_of_birth' => '2000/10/15',
             'created_at' => now(),          

            ],
        ];


        $suppliers =  Supplier::insert($seeded_suppliers);
    }
}
