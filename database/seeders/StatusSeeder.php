<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Settings\Group;
use App\Models\Settings\Status;
use App\Models\User;

use Str;
use DB;

class StatusSeeder extends Seeder
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

        $seeded_statuses = [

            ['status_reference'=> Str::uuid(), 'status' => 'In Stock', 'created_by' => $user->id, 'created_at' => now()],
            ['status_reference'=> Str::uuid(), 'status' => 'Out of Stock', 'created_by' => $user->id, 'created_at' => now()],
            ['status_reference'=> Str::uuid(), 'status' => 'Expired', 'created_by' => $user->id, 'created_at' => now()],
            ['status_reference'=> Str::uuid(), 'status' => 'Damaged', 'created_by' => $user->id, 'created_at' => now()],
            ['status_reference'=> Str::uuid(), 'status' => 'Returned', 'created_by' => $user->id, 'created_at' => now()],

            ['status_reference'=> Str::uuid(), 'status' => 'Pending', 'created_by' => $user->id, 'created_at' => now()],
            ['status_reference'=> Str::uuid(), 'status' => 'Available', 'created_by' => $user->id, 'created_at' => now()],
            ['status_reference'=> Str::uuid(), 'status' => 'In-production', 'created_by' => $user->id, 'created_at' => now()],
            ['status_reference'=> Str::uuid(), 'status' => 'Packaging', 'created_by' => $user->id, 'created_at' => now()],
            ['status_reference'=> Str::uuid(), 'status' => 'Shipped', 'created_by' => $user->id, 'created_at' => now()],
            ['status_reference'=> Str::uuid(), 'status' => 'Delivered', 'created_by' => $user->id, 'created_at' => now()],

            //['status_reference'=> Str::uuid(), 'status' => 'Pending Payment', 'created_by' => $user->id, 'created_at' => now()],
            ['status_reference'=> Str::uuid(), 'status' => 'Partial Payment', 'created_by' => $user->id, 'created_at' => now()],
            ['status_reference'=> Str::uuid(), 'status' => 'Paid', 'created_by' => $user->id, 'created_at' => now()],

        ];

                
        // $statuses = [

        //     ['status_reference'=> Str::uuid(), 'group_id' => $stock_group->id, 'status' => 'In Stock', 'created_by' => $user->id,],
        //     ['status_reference'=> Str::uuid(), 'group_id' => $stock_group->id, 'status' => 'Out of Stock', 'created_by' => $user->id,],
        //     ['status_reference'=> Str::uuid(), 'group_id' => $stock_group->id, 'status' => 'Expired', 'created_by' => $user->id,],
        //     ['status_reference'=> Str::uuid(), 'group_id' => $stock_group->id, 'status' => 'Damaged', 'created_by' => $user->id,],
        //     ['status_reference'=> Str::uuid(), 'group_id' => $stock_group->id, 'status' => 'Returned', 'created_by' => $user->id,],

        //     ['status_reference'=> Str::uuid(), 'group_id' => $sales_group->id, 'status' => 'Pending', 'created_by' => $user->id,],
        //     ['status_reference'=> Str::uuid(), 'group_id' => $sales_group->id, 'status' => 'In-production', 'created_by' => $user->id,],
        //     ['status_reference'=> Str::uuid(), 'group_id' => $sales_group->id, 'status' => 'Packaging', 'created_by' => $user->id,],
        //     ['status_reference'=> Str::uuid(), 'group_id' => $sales_group->id, 'status' => 'Shipped', 'created_by' => $user->id,],
        //     ['status_reference'=> Str::uuid(), 'group_id' => $sales_group->id, 'status' => 'Delivered', 'created_by' => $user->id,],

        //     ['status_reference'=> Str::uuid(), 'group_id' => $payment_group->id, 'status' => 'Pending', 'created_by' => $user->id,],
        //     ['status_reference'=> Str::uuid(), 'group_id' => $payment_group->id, 'status' => 'Partial payment', 'created_by' => $user->id,],
        //     ['status_reference'=> Str::uuid(), 'group_id' => $payment_group->id, 'status' => 'Paid', 'created_by' => $user->id,],

        // ];

        $statuses = Status::insert($seeded_statuses);

        $all_statuses = Status::get();

        foreach($all_statuses as $status){

            if($status->status == 'In Stock' || $status->status == 'Out of Stock' || $status->status == 'Expired' || 
            $status->status == 'Damaged' || $status->status == 'Returned'){

                $stock = DB::table('status_group')->insert([

                    ['status_id'=> $status->id, 'group_id' => $stock_group->id, 'created_at' => now(),],
                   
                ]);
            }
            else if($status->status == 'In-production' || $status->status == 'Packaging' || 
            $status->status == 'Available' || $status->status == 'Shipped' || $status->status == 'Delivered'){

                $stock = DB::table('status_group')->insert([

                    ['status_id'=> $status->id, 'group_id' => $sales_group->id, 'created_at' => now(),],
                   
                ]);
            }
            else if($status->status == 'Partial Payment' || $status->status == 'Paid'){

                $stock = DB::table('status_group')->insert([

                    ['status_id'=> $status->id, 'group_id' => $payment_group->id, 'created_at' => now(),],
                   
                ]);
            }
            else if($status->status == 'Pending'){

                $stock = DB::table('status_group')->insert([

                    ['status_id'=> $status->id, 'group_id' => $sales_group->id, 'created_at' => now(),],
                    ['status_id'=> $status->id, 'group_id' => $payment_group->id, 'created_at' => now(),],
                   
                ]);
            }
            else{

            }
            

        }

    }
}
