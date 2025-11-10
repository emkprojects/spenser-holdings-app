<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use Str;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                
        $seeded_permissions = [
           
            ['permission_reference'=> Str::uuid(), 'name' => 'manage-dashboard', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'manage-settings', 'guard_name' => 'web', 'created_at' => now()],

            ['permission_reference'=> Str::uuid(), 'name' => 'manage-users', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'view-users', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'add-users', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'edit-users', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'delete-users', 'guard_name' => 'web', 'created_at' => now()],

            ['permission_reference'=> Str::uuid(), 'name' => 'manage-roles', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'view-roles', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'add-roles', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'edit-roles', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'delete-roles', 'guard_name' => 'web', 'created_at' => now()],

            ['permission_reference'=> Str::uuid(), 'name' => 'manage-permissions', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'view-permissions', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'add-permissions', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'edit-permissions', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'delete-permissions', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'assign-role-permissions', 'guard_name' => 'web', 'created_at' => now()],            
            
            ['permission_reference'=> Str::uuid(), 'name' => 'manage-groups', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'view-groups', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'add-groups', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'edit-groups', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'delete-groups', 'guard_name' => 'web', 'created_at' => now()],
            
            ['permission_reference'=> Str::uuid(), 'name' => 'manage-statuses', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'view-statuses', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'add-statuses', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'edit-statuses', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'delete-statuses', 'guard_name' => 'web', 'created_at' => now()],           
            
            ['permission_reference'=> Str::uuid(), 'name' => 'manage-metrics', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'view-metrics', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'add-metric', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'edit-metric', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'delete-metric', 'guard_name' => 'web', 'created_at' => now()],
            
            ['permission_reference'=> Str::uuid(), 'name' => 'manage-payment-methods', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'view-payment-methods', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'add-payment-methods', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'edit-payment-methods', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'delete-payment-methods', 'guard_name' => 'web', 'created_at' => now()],

            ['permission_reference'=> Str::uuid(), 'name' => 'manage-currencies', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'view-currencies', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'add-currencies', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'edit-currencies', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'delete-currencies', 'guard_name' => 'web', 'created_at' => now()],

            ['permission_reference'=> Str::uuid(), 'name' => 'manage-categories', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'view-categories', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'add-categories', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'edit-categories', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'delete-categories', 'guard_name' => 'web', 'created_at' => now()],

            ['permission_reference'=> Str::uuid(), 'name' => 'manage-item-categories', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'view-item-categories', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'add-item-categories', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'edit-item-categories', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'delete-item-categories', 'guard_name' => 'web', 'created_at' => now()],

            ['permission_reference'=> Str::uuid(), 'name' => 'manage-productions', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'view-productions', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'add-productions', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'edit-productions', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'delete-productions', 'guard_name' => 'web', 'created_at' => now()],

            ['permission_reference'=> Str::uuid(), 'name' => 'manage-raw-materials', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'view-raw-materials', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'add-raw-materials', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'edit-raw-materials', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'delete-raw-materials', 'guard_name' => 'web', 'created_at' => now()],

            ['permission_reference'=> Str::uuid(), 'name' => 'manage-inventory-categories', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'view-inventory-categories', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'add-inventory-categories', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'edit-inventory-categories', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'delete-inventory-categories', 'guard_name' => 'web', 'created_at' => now()],

            ['permission_reference'=> Str::uuid(), 'name' => 'manage-inventories', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'view-inventories', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'add-inventories', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'edit-inventories', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'delete-inventories', 'guard_name' => 'web', 'created_at' => now()],

            ['permission_reference'=> Str::uuid(), 'name' => 'manage-product-categories', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'view-product-categories', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'add-product-categories', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'edit-product-categories', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'delete-product-categories', 'guard_name' => 'web', 'created_at' => now()],

            ['permission_reference'=> Str::uuid(), 'name' => 'manage-supplier-types', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'view-supplier-types', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'add-supplier-types', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'edit-supplier-types', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'delete-supplier-types', 'guard_name' => 'web', 'created_at' => now()],

            ['permission_reference'=> Str::uuid(), 'name' => 'manage-suppliers', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'view-suppliers', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'add-suppliers', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'edit-suppliers', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'delete-suppliers', 'guard_name' => 'web', 'created_at' => now()],

            ['permission_reference'=> Str::uuid(), 'name' => 'manage-customer-types', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'view-customer-types', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'add-customer-types', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'edit-customer-types', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'delete-customer-types', 'guard_name' => 'web', 'created_at' => now()],

            ['permission_reference'=> Str::uuid(), 'name' => 'manage-customers', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'view-customers', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'add-customers', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'edit-customers', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'delete-customers', 'guard_name' => 'web', 'created_at' => now()],

            ['permission_reference'=> Str::uuid(), 'name' => 'manage-items', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'view-items', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'add-items', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'edit-items', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'delete-items', 'guard_name' => 'web', 'created_at' => now()],

            ['permission_reference'=> Str::uuid(), 'name' => 'manage-products', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'view-products', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'add-products', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'edit-products', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'delete-products', 'guard_name' => 'web', 'created_at' => now()],

            ['permission_reference'=> Str::uuid(), 'name' => 'manage-stock', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'view-stock', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'add-stock', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'edit-stock', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'delete-stock', 'guard_name' => 'web', 'created_at' => now()],

            ['permission_reference'=> Str::uuid(), 'name' => 'manage-expenses', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'view-expenses', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'add-expenses', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'edit-expenses', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'delete-expenses', 'guard_name' => 'web', 'created_at' => now()],

            ['permission_reference'=> Str::uuid(), 'name' => 'manage-purchases', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'view-purchases', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'add-purchases', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'edit-purchases', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'delete-purchases', 'guard_name' => 'web', 'created_at' => now()],

            ['permission_reference'=> Str::uuid(), 'name' => 'manage-orders', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'view-orders', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'add-order', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'edit-orders', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'delete-orders', 'guard_name' => 'web', 'created_at' => now()],

            ['permission_reference'=> Str::uuid(), 'name' => 'manage-sales', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'view-sales', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'add-sales', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'edit-sales', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'delete-sales', 'guard_name' => 'web', 'created_at' => now()],

            ['permission_reference'=> Str::uuid(), 'name' => 'manage-reports', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'view-reports', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'export-reports', 'guard_name' => 'web', 'created_at' => now()],
            ['permission_reference'=> Str::uuid(), 'name' => 'share-reports', 'guard_name' => 'web', 'created_at' => now()],

        ];    

        $permissions =  Permission::insert($seeded_permissions);

    }
}
