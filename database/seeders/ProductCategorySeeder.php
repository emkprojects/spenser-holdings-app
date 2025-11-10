<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ProductionManagement\ProductCategory;
use App\Models\Settings\Group;
use App\Models\Settings\Category;
use App\Models\User;

use Str;
use DB;

class ProductCategorySeeder extends Seeder
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

        $seeded_product_categories = [

            ['product_category_reference'=> Str::uuid(), 'product_category' => 'Minced', 'created_by' => $user->id, 'created_at' => now()],           
            ['product_category_reference'=> Str::uuid(), 'product_category' => 'Sasuage', 'created_by' => $user->id, 'created_at' => now()],
            ['product_category_reference'=> Str::uuid(), 'product_category' => 'Beef Fillet', 'created_by' => $user->id, 'created_at' => now()],
            
            ['product_category_reference'=> Str::uuid(), 'product_category' => 'Chops', 'created_by' => $user->id, 'created_at' => now()],
            ['product_category_reference'=> Str::uuid(), 'product_category' => 'Ribs', 'created_by' => $user->id, 'created_at' => now()],           
            ['product_category_reference'=> Str::uuid(), 'product_category' => 'Bacon Streaky', 'created_by' => $user->id, 'created_at' => now()],
            ['product_category_reference'=> Str::uuid(), 'product_category' => 'Bacon Collar', 'created_by' => $user->id, 'created_at' => now()],          
            ['product_category_reference'=> Str::uuid(), 'product_category' => 'Pork Fillets', 'created_by' => $user->id, 'created_at' => now()], 

            ['product_category_reference'=> Str::uuid(), 'product_category' => 'Bones', 'created_by' => $user->id, 'created_at' => now()],            
            ['product_category_reference'=> Str::uuid(), 'product_category' => 'Ox-tail', 'created_by' => $user->id, 'created_at' => now()],
        
        ];
              

        $product_category = ProductCategory::insert($seeded_product_categories);

        // $all_product_categorys = ProductCategory::get();

        // foreach($all_product_categorys as $product_category){

        //     if($product_category->product_category == 'Minced' || $product_category->product_category == 'Sausage'){

        //         $stock = DB::table('product_categories')->where('id', $product_category->id)
        //         ->update([

        //             'category_id' => $stock_unbonned_meat_category->id,
                   
        //         ]);

        //     }        
        //     else if($product_category->product_category == 'Bacon Smoked Unsliced' || $product_category->product_category == 'Ribs Unsliced'
        //      || $product_category->product_category == 'Chops Unsliced'){

        //         $stock = DB::table('product_categorys')->where('id', $product_category->id)
        //         ->update([

        //             'category_id' => $stock_pork_category->id,
                   
        //         ]);
        //     }
        //     else if($product_category->product_category == 'Neck'){

        //         $stock = DB::table('product_categorys')->where('id', $product_category->id)
        //         ->update([

        //             'category_id' => $stock_neck_category->id,
                   
        //         ]);
        //     }
        //     else if($product_category->product_category == 'Chicken' ){

        //         $stock = DB::table('product_categorys')->where('id', $product_category->id)
        //         ->update([

        //             'category_id' => $stock_chicken_category->id,
                   
        //         ]);
        //     }
        //     else if($product_category->product_category == 'Soup' ){


        //         $stock = DB::table('product_categorys')->where('id', $product_category->id)
        //         ->update([

        //             'category_id' => $stock_skin_uncooked_category->id,
                   
        //         ]);
        //     }
        //     else if($product_category->product_category == 'Ingridents' ){


        //         $stock = DB::table('product_categorys')->where('id', $product_category->id)
        //         ->update([

        //             'category_id' => $stock_ingridents_category->id,
                   
        //         ]);
        //     }
        //     else{
                

        //     }


        // }

    }
}
