<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Administration\SupplierType;
use App\Models\Settings\Group;
use App\Models\Settings\Category;
use App\Models\User;

use Str;
use DB;

class SupplierTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {        

        $user = User::first();
        
        $supplier_group = Group::where('group', 'supplier')->first();
        $company_group = Group::where('group', 'company')->first();
        $individual_group = Group::where('group', 'individual')->first();

        $seeded_supplier_types = [

            ['supplier_type_reference'=> Str::uuid(), 'supplier_type' => 'Manufacturer', 'description' => 'These are the direct producers of goods, creating products from raw materials', 'created_by' => $user->id, 'created_at' => now()],
            ['supplier_type_reference'=> Str::uuid(), 'supplier_type' => 'Distributor', 'description' => 'They purchase large quantities of products from manufacturers and sell them in smaller amounts to retailers or other businesses', 'created_by' => $user->id, 'created_at' => now()],
            ['supplier_type_reference'=> Str::uuid(), 'supplier_type' => 'Wholesaler', 'description' => 'Similar to distributors, they buy in bulk but often sell to retailers for resale to the end-consumer', 'created_by' => $user->id, 'created_at' => now()],
            ['supplier_type_reference'=> Str::uuid(), 'supplier_type' => 'Retailer', 'description' => 'These suppliers do not manufacture goods but sell directly to consumers, either in-store or online', 'created_by' => $user->id, 'created_at' => now()],
            ['supplier_type_reference'=> Str::uuid(), 'supplier_type' => 'Raw material Supplier', 'description' => 'Essential for manufacturers, providing the basic materials needed for production', 'created_by' => $user->id, 'created_at' => now()],
            ['supplier_type_reference'=> Str::uuid(), 'supplier_type' => 'Service Supplier', 'description' => 'Provide intangible items like consulting, maintenance, cleaning, or software', 'created_by' => $user->id, 'created_at' => now()],
            ['supplier_type_reference'=> Str::uuid(), 'supplier_type' => 'Equipment Vendor', 'description' => 'Supply necessary tools and gadgets for operations, such as machinery or computers', 'created_by' => $user->id, 'created_at' => now()],
            ['supplier_type_reference'=> Str::uuid(), 'supplier_type' => 'Company', 'description' => '', 'created_by' => $user->id, 'created_at' => now()],
            ['supplier_type_reference'=> Str::uuid(), 'supplier_type' => 'Individual', 'description' => '', 'created_by' => $user->id, 'created_at' => now()],
                     
        ];

        $supplier_types =  SupplierType::insert($seeded_supplier_types);

    }
}
