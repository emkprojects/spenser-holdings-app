<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call([ 

            PermissionSeeder::class,
            RoleSeeder::class,
            PositionSeeder::class,

            UserStatusSeeder::class,
            DefaultUserSeeder::class,
            
            GroupSeeder::class,
            CategorySeeder::class,
            #SubCategorySeeder::class,
            
            CurrencySeeder::class,
            PaymentMethodSeeder::class,
            MetricSeeder::class,
            StatusSeeder::class,                      

            SupplierTypeSeeder::class,
            CustomerTypeSeeder::class,
            ItemCategorySeeder::class,
            InventoryCategorySeeder::class,            
            ProductCategorySeeder::class,

            SupplierSeeder::class,
            CustomerSeeder::class,
            
            ItemSeeder::class, 
            RawMaterialSeeder::class,

            ProductionSeeder::class,                       
            ProductSeeder::class,

        ]);
    }
}
