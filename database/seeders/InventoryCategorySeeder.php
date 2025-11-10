<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ProductionManagement\InventoryCategory;
use App\Models\Settings\Category;
use App\Models\Settings\SubCategory;
use App\Models\User;

use Str;
use DB;

class InventoryCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $user = User::first();

        $stock_unbonned_meat_category = Category::where('category', 'Undiboned Meat')->first();
        $stock_boned_meat_category = Category::where('category', 'Boned Meat')->first();
        $stock_neck_category = Category::where('category', 'Neck')->first();
        $stock_skin_uncooked_category = Category::where('category', 'Skin Uncooked')->first();        
        $stock_pork_category = Category::where('category', 'Pork')->first();
        $stock_chicken_category = Category::where('category', 'Chicken')->first();
        $stock_animal_fat_category = Category::where('category', 'Animal Fat')->first();
        $stock_ingredients_category = Category::where('category', 'Ingredients')->first();

        $seeded_inventory_categories = [

            ['inventory_category_reference'=> Str::uuid(), 'inventory_category' => 'Meat', 'created_by' => $user->id, 'created_at' => now()],           
            ['inventory_category_reference'=> Str::uuid(), 'inventory_category' => 'Bread', 'created_by' => $user->id, 'created_at' => now()],
            ['inventory_category_reference'=> Str::uuid(), 'inventory_category' => 'Beef Fillet', 'created_by' => $user->id, 'created_at' => now()],
            
            ['inventory_category_reference'=> Str::uuid(), 'inventory_category' => 'Bacon Smoked Unsliced', 'created_by' => $user->id, 'created_at' => now()],           
            ['inventory_category_reference'=> Str::uuid(), 'inventory_category' => 'Ribs Unsliced', 'created_by' => $user->id, 'created_at' => now()],
            ['inventory_category_reference'=> Str::uuid(), 'inventory_category' => 'Chops Unsliced', 'created_by' => $user->id, 'created_at' => now()],
            
            ['inventory_category_reference'=> Str::uuid(), 'inventory_category' => 'Neck', 'created_by' => $user->id, 'created_at' => now()],
            
            ['inventory_category_reference'=> Str::uuid(), 'inventory_category' => 'Chicken', 'created_by' => $user->id, 'created_at' => now()],
            
            ['inventory_category_reference'=> Str::uuid(), 'inventory_category' => 'Soup', 'created_by' => $user->id, 'created_at' => now()],
        
            ['inventory_category_reference'=> Str::uuid(), 'inventory_category' => 'Ingredients', 'created_by' => $user->id, 'created_at' => now()],
        
        ];
              

        $inventory_category = InventoryCategory::insert($seeded_inventory_categories);

        $all_inventory_categories = InventoryCategory::get();

        foreach($all_inventory_categories as $inventory_category){

            if($inventory_category->inventory_category == 'Meat' || $inventory_category->inventory_category == 'Bread' || $inventory_category->inventory_category == 'Beef Fillet' ){

                $stock = DB::table('inventory_categories')->where('id', $inventory_category->id)
                ->update([

                    'category_id' => $stock_unbonned_meat_category->id,
                   
                ]);

            }        
            else if($inventory_category->inventory_category == 'Bacon Smoked Unsliced' || $inventory_category->inventory_category == 'Ribs Unsliced'
             || $inventory_category->inventory_category == 'Chops Unsliced'){

                $stock = DB::table('inventory_categories')->where('id', $inventory_category->id)
                ->update([

                    'category_id' => $stock_pork_category->id,
                   
                ]);
            }
            else if($inventory_category->inventory_category == 'Neck'){

                $stock = DB::table('inventory_categories')->where('id', $inventory_category->id)
                ->update([

                    'category_id' => $stock_neck_category->id,
                   
                ]);
            }
            else if($inventory_category->inventory_category == 'Chicken' ){

                $stock = DB::table('inventory_categories')->where('id', $inventory_category->id)
                ->update([

                    'category_id' => $stock_chicken_category->id,
                   
                ]);
            }
            else if($inventory_category->inventory_category == 'Soup' ){


                $stock = DB::table('inventory_categories')->where('id', $inventory_category->id)
                ->update([

                    'category_id' => $stock_skin_uncooked_category->id,
                   
                ]);
            }
            else if($inventory_category->inventory_category == 'Ingredients' ){


                $stock = DB::table('inventory_categories')->where('id', $inventory_category->id)
                ->update([

                    'category_id' => $stock_ingredients_category->id,
                   
                ]);
            }
            else{
                

            }


        }

    }
}
