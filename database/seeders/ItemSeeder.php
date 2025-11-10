<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Administration\Supplier;
use App\Models\InventoryManagement\Purchase;
use App\Models\InventoryManagement\Item;
use App\Models\InventoryManagement\ItemCategory;
use App\Models\Settings\Group;
use App\Models\Settings\Category;
use App\Models\Settings\Status;
use App\Models\User;

use Log;
use Str;
use DB;
use Carbon\Carbon;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        


        $user = User::first();

        $supplier_first = Supplier::first();
        $supplier_last = Supplier::orderBy('id', 'desc')->first();

        $undiboned_meat_category = Itemcategory::where('item_category', 'Undiboned Meat')->first();
        $bonned_meat_category = Itemcategory::where('item_category', 'Boned Meat')->first();
        $pork_category = Itemcategory::where('item_category', 'Pork')->first();
        $chicken_category = Itemcategory::where('item_category', 'Chicken')->first();
        $ingredients_category = Itemcategory::where('item_category', 'Ingredients')->first();

        $item_status = Status::where('status', 'available')->first();
        $purchase_status = Status::where('status', 'paid')->first();
        
        $seeded_items = [

            [
                'item_reference'=> Str::uuid(), 
                'item' => 'Meat', 
                'physical_stock' => 50000, 
                'current_stock' => 50000, 
                'minimum_stock' => 10, 
                'amount' => 10000,
                'item_category_id' =>$undiboned_meat_category->id, 
                'supplier_id' => $supplier_first->id,
                'user_id' => $user->id, 
                'status_id' => $item_status->id,
                'created_at' => now()
            ],


            [
                'item_reference'=> Str::uuid(), 
                'item' => 'Pork', 
                'physical_stock' => 20000, 
                'current_stock' => 15000, 
                'minimum_stock' => 20, 
                'amount' => 15000,
                'item_category_id' =>$pork_category->id, 
                'supplier_id' => $supplier_first->id,
                'user_id' => $user->id, 
                'status_id' => $item_status->id,
                'created_at' => now()
            ],


            [
                'item_reference'=> Str::uuid(), 
                'item' => 'Onions', 
                'physical_stock' => 100, 
                'current_stock' => 100, 
                'minimum_stock' => 5, 
                'amount' => 5000,
                'item_category_id' =>$ingredients_category->id, 
                'supplier_id' => $supplier_last->id,
                'user_id' => $user->id, 
                'status_id' => $item_status->id,
                'created_at' => now()
            ],

            [
                'item_reference'=> Str::uuid(), 
                'item' => 'Tomatoes', 
                'physical_stock' => 500, 
                'current_stock' => 400, 
                'minimum_stock' => 5, 
                'amount' => 3000,
                'item_category_id' =>$ingredients_category->id, 
                'supplier_id' => $supplier_last->id,
                'user_id' => $user->id, 
                'status_id' => $item_status->id,
                'created_at' => now()
            ],
            
        ];              

        $items = Item::insert($seeded_items);

        $all_items = Item::get();

        foreach($all_items as $item){

            $validated['item_id'] = $item->id;
            $validated['supplier_id'] = $item->supplier_id;
            $validated['user_id'] = $item->user_id;
            $validated['purchase'] = "PURCHASE-#".$item->id;
            $validated['purchase_reference'] = Str::uuid();
            $validated['created_at'] = $item->created_at;
            $validated['date_of_purchase'] = Carbon::now();
            $validated['quantity'] = $item->current_stock;
            $validated['unit_cost'] = $item->amount;
            $validated['manufacture_date'] = "2025-01-01";
            $validated['expiry_date'] = "2026-12-31";
            $validated['status_id'] = $purchase_status->id;

            $purchase = Purchase::create($validated);

        }

    }
}
