<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Settings\Group;
use App\Models\Settings\Category;
use App\Models\Settings\SubCategory;
use App\Models\User;

use Str;
use DB;

class SubCategorySeeder extends Seeder
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
        
        $item_ingredient_category = Category::where('category', 'ingridents')->first();
        $item_packaging_category = Category::where('category', 'packaging')->first();
        $item_detergent_category = Category::where('category', 'detergent')->first();
        $item_protective_gear_category = Category::where('category', 'protective gear')->first();
        $item_stationary_category = Category::where('category', 'stationery')->first();
        $item_catering_category = Category::where('category', 'catering')->first();

        $expense_bills_category = Category::where('category', 'bills')->first();
        $expense_ingredient_category = Category::where('category', 'ingridents')->first();
        $expense_packaging_category = Category::where('category', 'packaging')->first();
        $expense_detergent_category = Category::where('category', 'detergent')->first();
        $expense_protective_gear_category = Category::where('category', 'protective gear')->first();
        $expense_stationary_category = Category::where('category', 'stationery')->first();
        $expense_catering_category = Category::where('category', 'catering')->first();



        $seeded_sub_categories = [

            ['sub_category_reference'=> Str::uuid(), 'sub_category' => 'Meat', 'created_by' => $user->id, 'created_at' => now()],           
            ['sub_category_reference'=> Str::uuid(), 'sub_category' => 'Bread', 'created_by' => $user->id, 'created_at' => now()],
            ['sub_category_reference'=> Str::uuid(), 'sub_category' => 'Beef Fillet', 'created_by' => $user->id, 'created_at' => now()],
            
            ['sub_category_reference'=> Str::uuid(), 'sub_category' => 'Bacon Smoked Unsliced', 'created_by' => $user->id, 'created_at' => now()],           
            ['sub_category_reference'=> Str::uuid(), 'sub_category' => 'Ribs Unsliced', 'created_by' => $user->id, 'created_at' => now()],
            ['sub_category_reference'=> Str::uuid(), 'sub_category' => 'Chops Unsliced', 'created_by' => $user->id, 'created_at' => now()],
            
            ['sub_category_reference'=> Str::uuid(), 'sub_category' => 'Neck', 'created_by' => $user->id, 'created_at' => now()],
            
            ['sub_category_reference'=> Str::uuid(), 'sub_category' => 'Chicken', 'created_by' => $user->id, 'created_at' => now()],
            
            ['sub_category_reference'=> Str::uuid(), 'sub_category' => 'Soup', 'created_by' => $user->id, 'created_at' => now()],


        ];
        
       
        // $sub_categories = [

        //     ['sub_category_reference'=> Str::uuid(), 'category_id' => $stock_unbonned_meat_category->id, 
        //     'group_id' => $production_raw_material_category->group_id, 'sub_category' => 'Meat', 'created_by' => $user->id,],
           
        //     ['sub_category_reference'=> Str::uuid(), 'category_id' => $stock_unbonned_meat_category->id, 
        //     'group_id' => $production_raw_material_category->group_id, 'sub_category' => 'Bread', 'created_by' => $user->id,],

        //     ['sub_category_reference'=> Str::uuid(), 'category_id' => $stock_unbonned_meat_category->id, 
        //     'group_id' => $production_raw_material_category->group_id, 'sub_category' => 'Beef Fillet', 'created_by' => $user->id,],


        //     ['sub_category_reference'=> Str::uuid(), 'category_id' => $stock_pork_category->id, 
        //     'group_id' => $production_raw_material_category->group_id, 'sub_category' => 'Bacon Smoked Unsliced', 'created_by' => $user->id,],
           
        //     ['sub_category_reference'=> Str::uuid(), 'category_id' => $stock_pork_category->id, 
        //     'group_id' => $production_raw_material_category->group_id, 'sub_category' => 'Ribs Unsliced', 'created_by' => $user->id,],

        //     ['sub_category_reference'=> Str::uuid(), 'category_id' => $stock_pork_category->id, 
        //     'group_id' => $production_raw_material_category->group_id, 'sub_category' => 'Chops Unsliced', 'created_by' => $user->id,],


        //     ['sub_category_reference'=> Str::uuid(), 'category_id' => $stock_neck_category->id, 
        //     'group_id' => $production_raw_material_category->group_id, 'sub_category' => 'Neck', 'created_by' => $user->id,],

        //     ['sub_category_reference'=> Str::uuid(), 'category_id' => $stock_chicken_category->id, 
        //     'group_id' => $production_raw_material_category->group_id, 'sub_category' => 'Chicken', 'created_by' => $user->id,],

        //     ['sub_category_reference'=> Str::uuid(), 'category_id' => $stock_skin_uncooked_category->id, 
        //     'group_id' => $production_raw_material_category->group_id, 'sub_category' => 'Soup', 'created_by' => $user->id,],


        // ];

        $sub_category = SubCategory::insert($seeded_sub_categories);

        $all_sub_categories = SubCategory::get();

        foreach($all_sub_categories as $sub_category){

            if($sub_category->sub_category == 'Meat' || $sub_category->sub_category == 'Bread' || $sub_category->sub_category == 'Beef Fillet' ){

                $stock = DB::table('sub_category_category')->insert([

                    ['sub_category_id'=> $sub_category->id, 'category_id' => $stock_unbonned_meat_category->id, 'created_at' => now(),],
                   
                ]);

            }        
            else if($sub_category->sub_category == 'Bacon Smoked Unsliced' || $sub_category->sub_category == 'Ribs Unsliced'
             || $sub_category->sub_category == 'Chops Unsliced'){

                $stock = DB::table('sub_category_category')->insert([

                    ['sub_category_id'=> $sub_category->id, 'category_id' => $stock_pork_category->id, 'created_at' => now(),],
                    
                ]);
            }
            else if($sub_category->sub_category == 'Neck'){

                $stock = DB::table('sub_category_category')->insert([

                    ['sub_category_id'=> $sub_category->id, 'category_id' => $stock_neck_category->id, 'created_at' => now(),],
                    
                ]);
            }
            else if($sub_category->sub_category == 'Chicken' ){

                $stock = DB::table('sub_category_category')->insert([

                    ['sub_category_id'=> $sub_category->id, 'category_id' => $stock_chicken_category->id, 'created_at' => now(),],
                   
                ]);
            }
            else if($sub_category->sub_category == 'Soup' ){

                $stock = DB::table('sub_category_category')->insert([

                    ['sub_category_id'=> $sub_category->id, 'category_id' => $stock_skin_uncooked_category->id, 'created_at' => now(),],
                   
                ]);
            }
            else{
                

            }

            $stock = DB::table('sub_category_group')->insert([

                ['sub_category_id'=> $sub_category->id, 'group_id' => $production_group->id, 'created_at' => now(),],
                
            ]);

        }

    }
}
