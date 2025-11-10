<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\InventoryManagement\ItemCategory;
use App\Models\Settings\Group;
use App\Models\Settings\Category;
use App\Models\User;

use Str;
use DB;

class ItemCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $user = User::first();

        $supplier_group = Group::where('group', 'supplier')->first();
        $customer_group = Group::where('group', 'customer')->first();
        $item_group = Group::where('group', 'item')->first();
        $production_group = Group::where('group', 'production')->first();
        $product_group = Group::where('group', 'product')->first();
        $sales_group = Group::where('group', 'sales')->first();
        $stock_group = Group::where('group', 'stock')->first();
        $payment_group = Group::where('group', 'payment')->first();
        $expense_group = Group::where('group', 'expense')->first();

        $stock_unbonned_meat_category = Category::where('category', 'Undiboned Meat')->first();
        $stock_boned_meat_category = Category::where('category', 'Boned Meat')->first();
        $stock_neck_category = Category::where('category', 'Neck')->first();
        $stock_skin_uncooked_category = Category::where('category', 'Skin Uncooked')->first();        
        $stock_pork_category = Category::where('category', 'Pork')->first();
        $stock_chicken_category = Category::where('category', 'Chicken')->first();
        $stock_animal_fat_category = Category::where('category', 'Animal Fat')->first();

        $production_raw_material_category = Category::where('category', 'Raw material')->first();
        
        $item_ingredient_category = Category::where('category', 'ingredients')->first();
        $item_packaging_category = Category::where('category', 'packaging')->first();
        $item_detergent_category = Category::where('category', 'detergent')->first();
        $item_protective_gear_category = Category::where('category', 'protective gear')->first();
        $item_stationary_category = Category::where('category', 'stationery')->first();
        $item_catering_category = Category::where('category', 'catering')->first();

        $expense_bills_category = Category::where('category', 'bills')->first();
        $expense_ingredient_category = Category::where('category', 'ingredients')->first();
        $expense_packaging_category = Category::where('category', 'packaging')->first();
        $expense_detergent_category = Category::where('category', 'detergent')->first();
        $expense_protective_gear_category = Category::where('category', 'protective gear')->first();
        $expense_stationary_category = Category::where('category', 'stationery')->first();
        $expense_catering_category = Category::where('category', 'catering')->first();

        $seeded_item_categories = [

            ['item_category_reference'=> Str::uuid(), 'item_category' => 'Undiboned Meat', 'created_by' => $user->id, 'created_at' => now()],
            ['item_category_reference'=> Str::uuid(), 'item_category' => 'Boned Meat', 'created_by' => $user->id, 'created_at' => now()],
            ['item_category_reference'=> Str::uuid(), 'item_category' => 'Neck', 'created_by' => $user->id, 'created_at' => now()],
            ['item_category_reference'=> Str::uuid(), 'item_category' => 'Skin Uncooked', 'created_by' => $user->id, 'created_at' => now()],
            ['item_category_reference'=> Str::uuid(), 'item_category' => 'Pork', 'created_by' => $user->id, 'created_at' => now()],
            ['item_category_reference'=> Str::uuid(), 'item_category' => 'Chicken', 'created_by' => $user->id, 'created_at' => now()],
            ['item_category_reference'=> Str::uuid(), 'item_category' => 'Animal fat', 'created_by' => $user->id, 'created_at' => now()],            
           
            ['item_category_reference'=> Str::uuid(), 'item_category' => 'Ingredients', 'created_by' => $user->id, 'created_at' => now()],
            ['item_category_reference'=> Str::uuid(), 'item_category' => 'Packaging', 'created_by' => $user->id, 'created_at' => now()],
            ['item_category_reference'=> Str::uuid(), 'item_category' => 'Detergents', 'created_by' => $user->id, 'created_at' => now()],
            ['item_category_reference'=> Str::uuid(), 'item_category' => 'Protective Gears', 'created_by' => $user->id, 'created_at' => now()],
            ['item_category_reference'=> Str::uuid(), 'item_category' => 'Stationary', 'created_by' => $user->id, 'created_at' => now()],
            ['item_category_reference'=> Str::uuid(), 'item_category' => 'Catering', 'created_by' => $user->id, 'created_at' => now()],
            
            ['item_category_reference'=> Str::uuid(), 'item_category' => 'Bills', 'created_by' => $user->id, 'created_at' => now()],
        ];
              

        $item_category = ItemCategory::insert($seeded_item_categories);

        $all_item_categories = ItemCategory::get();

        foreach($all_item_categories as $item_category){

            if($item_category->item_category == 'Undiboned Meat' || $item_category->item_category == 'Boned Meat' || $item_category->item_category == 'Neck' || 
            $item_category->item_category == 'Skin Uncooked' || $item_category->item_category == 'Pork' || $item_category->item_category == 'Chicken' || 
            $item_category->item_category == 'Animal fat'){

                $stock = DB::table('item_categories')->where('id', $item_category->id)
                ->update([

                    'group_id' => $stock_group->id,
                   
                ]);
            }
            else if($item_category->item_category == 'Ingredients' || $item_category->item_category == 'Packaging' || $item_category->item_category == 'Detergents' || 
            $item_category->item_category == 'Stationary' || $item_category->item_category == 'Catering' || $item_category->item_category == 'Protective Gears' ){
               
                $stock = DB::table('item_categories')->where('id', $item_category->id)
                ->update([

                    'group_id' => $item_group->id,
                   
                ]);
            }
            else if($item_category->item_category == 'Bills' ){

                $stock = DB::table('item_categories')->where('id', $item_category->id)
                ->update([

                    'group_id' => $expense_group->id,
                   
                ]);
            }
            else{

            }

        }

    }
}
