<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Settings\Group;
use App\Models\Settings\Category;
use App\Models\User;
use Str;
use DB;

class CategorySeeder extends Seeder
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


        $categories = [

            ['category_reference'=> Str::uuid(), 'category' => 'Company', 'created_by' => $user->id, 'created_at' => now()],
            ['category_reference'=> Str::uuid(), 'category' => 'Individual', 'created_by' => $user->id, 'created_at' => now()],
            
            ['category_reference'=> Str::uuid(), 'category' => 'Undiboned Meat', 'created_by' => $user->id, 'created_at' => now()],
            ['category_reference'=> Str::uuid(), 'category' => 'Boned Meat', 'created_by' => $user->id, 'created_at' => now()],
            ['category_reference'=> Str::uuid(), 'category' => 'Neck', 'created_by' => $user->id, 'created_at' => now()],
            ['category_reference'=> Str::uuid(), 'category' => 'Skin Uncooked', 'created_by' => $user->id, 'created_at' => now()],
            ['category_reference'=> Str::uuid(), 'category' => 'Pork', 'created_by' => $user->id, 'created_at' => now()],
            ['category_reference'=> Str::uuid(), 'category' => 'Chicken', 'created_by' => $user->id, 'created_at' => now()],
            ['category_reference'=> Str::uuid(), 'category' => 'Animal fat', 'created_by' => $user->id, 'created_at' => now()],            
           
            ['category_reference'=> Str::uuid(), 'category' => 'Others', 'created_by' => $user->id, 'created_at' => now()],            
           
            ['category_reference'=> Str::uuid(), 'category' => 'Ingredients', 'created_by' => $user->id, 'created_at' => now()],
            ['category_reference'=> Str::uuid(), 'category' => 'Packaging', 'created_by' => $user->id, 'created_at' => now()],
            ['category_reference'=> Str::uuid(), 'category' => 'Detergents', 'created_by' => $user->id, 'created_at' => now()],
            ['category_reference'=> Str::uuid(), 'category' => 'Protective Gears', 'created_by' => $user->id, 'created_at' => now()],
            ['category_reference'=> Str::uuid(), 'category' => 'Stationary', 'created_by' => $user->id, 'created_at' => now()],
            ['category_reference'=> Str::uuid(), 'category' => 'Catering', 'created_by' => $user->id, 'created_at' => now()],
            
            ['category_reference'=> Str::uuid(), 'category' => 'Bills', 'created_by' => $user->id, 'created_at' => now()],
          
        ];


        // $categories = [

        //     ['category_reference'=> Str::uuid(), 'group_id' => $supplier_group->id, 'category' => 'Company', 'created_by' => $user->id,],
        //     ['category_reference'=> Str::uuid(), 'group_id' => $supplier_group->id, 'category' => 'Individual', 'created_by' => $user->id,],

        //     ['category_reference'=> Str::uuid(), 'group_id' => $customer_group->id, 'category' => 'Company', 'created_by' => $user->id,],
        //     ['category_reference'=> Str::uuid(), 'group_id' => $customer_group->id, 'category' => 'Individual', 'created_by' => $user->id,],

        //     ['category_reference'=> Str::uuid(), 'group_id' => $stock_group->id, 'category' => 'Undiboned Meat', 'created_by' => $user->id,],
        //     ['category_reference'=> Str::uuid(), 'group_id' => $stock_group->id, 'category' => 'Boned Meat', 'created_by' => $user->id,],
        //     ['category_reference'=> Str::uuid(), 'group_id' => $stock_group->id, 'category' => 'Neck', 'created_by' => $user->id,],
        //     ['category_reference'=> Str::uuid(), 'group_id' => $stock_group->id, 'category' => 'Skin Uncooked', 'created_by' => $user->id,],
        //     ['category_reference'=> Str::uuid(), 'group_id' => $stock_group->id, 'category' => 'Pork', 'created_by' => $user->id,],
        //     ['category_reference'=> Str::uuid(), 'group_id' => $stock_group->id, 'category' => 'Chicken', 'created_by' => $user->id,],
        //     ['category_reference'=> Str::uuid(), 'group_id' => $stock_group->id, 'category' => 'Animal fat', 'created_by' => $user->id,],
            
        //     ['category_reference'=> Str::uuid(), 'group_id' => $production_group->id, 'category' => 'Raw Material', 'created_by' => $user->id,],
            
        //     ['category_reference'=> Str::uuid(), 'group_id' => $item_group->id, 'category' => 'Ingridents', 'created_by' => $user->id,],
        //     ['category_reference'=> Str::uuid(), 'group_id' => $item_group->id, 'category' => 'Packaging', 'created_by' => $user->id,],
        //     ['category_reference'=> Str::uuid(), 'group_id' => $item_group->id, 'category' => 'Detergents', 'created_by' => $user->id,],
        //     ['category_reference'=> Str::uuid(), 'group_id' => $item_group->id, 'category' => 'Protective Gears', 'created_by' => $user->id,],
        //     ['category_reference'=> Str::uuid(), 'group_id' => $item_group->id, 'category' => 'Stationary', 'created_by' => $user->id,],
        //     ['category_reference'=> Str::uuid(), 'group_id' => $item_group->id, 'category' => 'Catering', 'created_by' => $user->id,],

        //     ['category_reference'=> Str::uuid(), 'group_id' => $expense_group->id, 'category' => 'Ingridents', 'created_by' => $user->id,],
        //     ['category_reference'=> Str::uuid(), 'group_id' => $expense_group->id, 'category' => 'Packaging', 'created_by' => $user->id,],
        //     ['category_reference'=> Str::uuid(), 'group_id' => $expense_group->id, 'category' => 'Detergents', 'created_by' => $user->id,],
        //     ['category_reference'=> Str::uuid(), 'group_id' => $expense_group->id, 'category' => 'Protective Gears', 'created_by' => $user->id,],
        //     ['category_reference'=> Str::uuid(), 'group_id' => $expense_group->id, 'category' => 'Stationary', 'created_by' => $user->id,],
        //     ['category_reference'=> Str::uuid(), 'group_id' => $expense_group->id, 'category' => 'Catering', 'created_by' => $user->id,],
        //     ['category_reference'=> Str::uuid(), 'group_id' => $expense_group->id, 'category' => 'Bills', 'created_by' => $user->id,],
          
        // ];

        $category = Category::insert($categories);

        $all_categories = Category::get();

        foreach($all_categories as $category){

            if($category->category == 'Company' || $category->category == 'Individual' ){

                $stock = DB::table('category_group')->insert([

                    ['category_id'=> $category->id, 'group_id' => $supplier_group->id, 'created_at' => now(),],
                    ['category_id'=> $category->id, 'group_id' => $customer_group->id, 'created_at' => now(),],
                   
                ]);

            }        
            else if($category->category == 'Undiboned Meat' || $category->category == 'Boned Meat' || $category->category == 'Neck' || 
            $category->category == 'Skin Uncooked' || $category->category == 'Pork' || $category->category == 'Chicken' || 
            $category->category == 'Animal fat'){

                $stock = DB::table('category_group')->insert([

                    ['category_id'=> $category->id, 'group_id' => $stock_group->id, 'created_at' => now(),],
                    ['category_id'=> $category->id, 'group_id' => $production_group->id, 'created_at' => now(),],
                   
                ]);
            }
            else if($category->category == 'Ingredients' || $category->category == 'Packaging' || $category->category == 'Detergents' || 
            $category->category == 'Stationary' || $category->category == 'Catering' || $category->category == 'Protective Gears' ){

                $stock = DB::table('category_group')->insert([

                    ['category_id'=> $category->id, 'group_id' => $item_group->id, 'created_at' => now(),],
                    ['category_id'=> $category->id, 'group_id' => $expense_group->id, 'created_at' => now(),],
                   
                ]);
            }
            else if($category->category == 'Bills' ){

                $stock = DB::table('category_group')->insert([
                    ['category_id'=> $category->id, 'group_id' => $expense_group->id, 'created_at' => now(),],
                   
                ]);
            }
            else{

            }

        }

    }
}
