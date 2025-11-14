<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Administration\Supplier;
use App\Models\InventoryManagement\Purchase;
use App\Models\InventoryManagement\Item;
use App\Models\InventoryManagement\ItemCategory;
use App\Models\ProductionManagement\Inventory;
use App\Models\ProductionManagement\RawMaterial;
use App\Models\ProductionManagement\InventoryCategory;
use App\Models\Settings\Group;
use App\Models\Settings\Category;
use App\Models\Settings\Status;
use App\Models\User;

use Log;
use Str;
use DB;
use Carbon\Carbon;

class RawMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        

        $user = User::first();

        $meat_item = Purchase::where('item_id', 1)->first();
        $pork_item = Purchase::where('item_id', 2)->first();

        $meat_category = Inventorycategory::where('inventory_category', 'Meat')->first();
        $bread_category = Inventorycategory::where('inventory_category', 'Bread')->first();
        $bacon_smoked_unsliced_category = Inventorycategory::where('inventory_category', 'Bacon Smoked Unsliced')->first();
        $ribs_unsliced_category = Inventorycategory::where('inventory_category', 'Ribs Unsliced')->first();
        
        $raw_material_status = Status::where('status', 'in stock')->first();
        $inventory_status = Status::where('status', 'in stock')->first();
        
        $seeded_raw_materials = [

            [
                'raw_material_reference'=> Str::uuid(), 
                'raw_material' => 'Meat', 
                'physical_stock' => 20000, 
                'current_stock' => 15000, 
                'minimum_stock' => 100,
                'inventory_category_id' =>$meat_category->id, 
                'created_by' => $user->id, 
                'status_id' => $raw_material_status->id,
                'created_at' => now()
            ],


            [
                'raw_material_reference'=> Str::uuid(), 
                'raw_material' => 'Bread', 
                'physical_stock' => 22000, 
                'current_stock' => 17000, 
                'minimum_stock' => 50,
                'inventory_category_id' =>$bread_category->id, 
                'created_by' => $user->id, 
                'status_id' => $raw_material_status->id,
                'created_at' => now()
            ],


            [
                'raw_material_reference'=> Str::uuid(), 
                'raw_material' => 'Bacon', 
                'physical_stock' => 10000, 
                'current_stock' => 8000, 
                'minimum_stock' => 50,
                'inventory_category_id' =>$bacon_smoked_unsliced_category->id, 
                'created_by' => $user->id, 
                'status_id' => $raw_material_status->id,
                'created_at' => now()
            ],

            [
                'raw_material_reference'=> Str::uuid(), 
                'raw_material' => 'Ribs', 
                'physical_stock' => 8000, 
                'current_stock' => 6000, 
                'minimum_stock' => 40,
                'inventory_category_id' =>$ribs_unsliced_category->id, 
                'created_by' => $user->id, 
                'status_id' => $raw_material_status->id,
                'created_at' => now()
            ],
            
        ];              

        $raw_materials = RawMaterial::insert($seeded_raw_materials);

        $all_raw_materials = RawMaterial::get();

        foreach($all_raw_materials as $raw_material){

            $validated['raw_material_id'] = $raw_material->id;

            if($raw_material->id == 3 || $raw_material->id == 4){
                $validated['purchase_id'] = $pork_item->id;
            }
            else{
                $validated['purchase_id'] = $meat_item->id;
            }
           
            $validated['created_by'] = $raw_material->created_by;
            $validated['inventory_reference'] = Str::uuid();
            $validated['inventory'] = "INVENTORY-#".$raw_material->id;
            $validated['physical_stock'] = $raw_material->physical_stock;
            $validated['current_stock'] = $raw_material->current_stock;
            $validated['created_at'] = $raw_material->created_at;
            $validated['date_of_inventory'] = Carbon::now();            
            $validated['status_id'] = $inventory_status->id;

            $inventory = Inventory::create($validated);

        }



    }
}
