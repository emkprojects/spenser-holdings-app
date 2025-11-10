<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Settings\Metric;
use App\Models\Settings\Group;
use App\Models\User;
use Str;
use DB;

class MetricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = User::first();

        $item_group = Group::where('group', 'item')->first();
        $production_group = Group::where('group', 'production')->first();
        $product_group = Group::where('group', 'product')->first();
        $sales_group = Group::where('group', 'sales')->first();
        $stock_group = Group::where('group', 'stock')->first();
        $payment_group = Group::where('group', 'payment')->first();
        $expense_group = Group::where('group', 'expense')->first();


        $seeded_metrics = [

            ['metric_reference'=> Str::uuid(), 'metric' => 'Ton', 'metric_code' => 'Ton', 'created_by' => $user->id, 'created_at' => now()],
            ['metric_reference'=> Str::uuid(), 'metric' => 'Sack', 'metric_code' => 'Sck', 'created_by' => $user->id, 'created_at' => now()],
            ['metric_reference'=> Str::uuid(), 'metric' => 'Box', 'metric_code' => 'Bx', 'created_by' => $user->id, 'created_at' => now()],
            ['metric_reference'=> Str::uuid(), 'metric' => 'Jerican', 'metric_code' => 'Jcn', 'created_by' => $user->id, 'created_at' => now()],
            ['metric_reference'=> Str::uuid(), 'metric' => 'Crate', 'metric_code' => 'Crt', 'created_by' => $user->id, 'created_at' => now()],
            ['metric_reference'=> Str::uuid(), 'metric' => 'Carton', 'metric_code' => 'Ctn', 'created_by' => $user->id, 'created_at' => now()],
            
            ['metric_reference'=> Str::uuid(), 'metric' => 'Round', 'metric_code' => 'Rn', 'created_by' => $user->id, 'created_at' => now()],
            
            ['metric_reference'=> Str::uuid(), 'metric' => 'Kilogram', 'metric_code' => 'Kg', 'created_by' => $user->id, 'created_at' => now()],
            ['metric_reference'=> Str::uuid(), 'metric' => 'Gram', 'metric_code' => 'Gm', 'created_by' => $user->id, 'created_at' => now()],            
            ['metric_reference'=> Str::uuid(), 'metric' => 'Bottle', 'metric_code' => 'Btl', 'created_by' => $user->id, 'created_at' => now()],
            ['metric_reference'=> Str::uuid(), 'metric' => 'Piece', 'metric_code' => 'Pc', 'created_by' => $user->id, 'created_at' => now()],
            ['metric_reference'=> Str::uuid(), 'metric' => 'Litre', 'metric_code' => 'Ltr', 'created_by' => $user->id, 'created_at' => now()],
            ['metric_reference'=> Str::uuid(), 'metric' => 'Tin', 'metric_code' => 'Tin', 'created_by' => $user->id, 'created_at' => now()],
            ['metric_reference'=> Str::uuid(), 'metric' => 'Packet', 'metric_code' => 'Pkt', 'created_by' => $user->id, 'created_at' => now()],
            ['metric_reference'=> Str::uuid(), 'metric' => 'Bar', 'metric_code' => 'Bar', 'created_by' => $user->id, 'created_at' => now()],
                        
        ];

        // $metrics = [

        //     ['metric_reference'=> Str::uuid(), 'metric' => 'Ton', 'metric_code' => 'Ton', 'group_id' => $stock_group->id, 'created_by' => $user->id,],
        //     ['metric_reference'=> Str::uuid(), 'metric' => 'Sack', 'metric_code' => 'Sck', 'group_id' => $stock_group->id, 'created_by' => $user->id,],
        //     ['metric_reference'=> Str::uuid(), 'metric' => 'Box', 'metric_code' => 'Bx', 'group_id' => $stock_group->id, 'created_by' => $user->id,],
        //     ['metric_reference'=> Str::uuid(), 'metric' => 'Jerican', 'metric_code' => 'Jcn', 'group_id' => $stock_group->id, 'created_by' => $user->id,],
        //     ['metric_reference'=> Str::uuid(), 'metric' => 'Crate', 'metric_code' => 'Crt', 'group_id' => $stock_group->id, 'created_by' => $user->id,],
        //     ['metric_reference'=> Str::uuid(), 'metric' => 'Carton', 'metric_code' => 'Ctn', 'group_id' => $stock_group->id, 'created_by' => $user->id,],

        //     ['metric_reference'=> Str::uuid(), 'metric' => 'Round', 'metric_code' => 'Rn', 'group_id' => $production_group->id, 'created_by' => $user->id,],
        //     ['metric_reference'=> Str::uuid(), 'metric' => 'Kilograms', 'metric_code' => 'Kg', 'group_id' => $production_group->id, 'created_by' => $user->id,],
        //     ['metric_reference'=> Str::uuid(), 'metric' => 'Grams', 'metric_code' => 'Gm', 'group_id' => $production_group->id, 'created_by' => $user->id,],            
        //     ['metric_reference'=> Str::uuid(), 'metric' => 'Bottle', 'metric_code' => 'Btl', 'group_id' => $production_group->id, 'created_by' => $user->id,],
        //     ['metric_reference'=> Str::uuid(), 'metric' => 'Piece', 'metric_code' => 'Pc', 'group_id' => $production_group->id, 'created_by' => $user->id,],
        //     ['metric_reference'=> Str::uuid(), 'metric' => 'Litre', 'metric_code' => 'Ltr', 'group_id' => $production_group->id, 'created_by' => $user->id,],
        //     ['metric_reference'=> Str::uuid(), 'metric' => 'Tin', 'metric_code' => 'Tin', 'group_id' => $production_group->id, 'created_by' => $user->id,],
        //     ['metric_reference'=> Str::uuid(), 'metric' => 'Packet', 'metric_code' => 'Pkt', 'group_id' => $production_group->id, 'created_by' => $user->id,],
        //     ['metric_reference'=> Str::uuid(), 'metric' => 'Bar', 'metric_code' => 'Bar', 'group_id' => $production_group->id, 'created_by' => $user->id,],
            
        //     ['metric_reference'=> Str::uuid(), 'metric' => 'Kilograms', 'metric_code' => 'Kg', 'group_id' => $sales_group->id, 'created_by' => $user->id,],
        //     ['metric_reference'=> Str::uuid(), 'metric' => 'Grams', 'metric_code' => 'Gm', 'group_id' => $sales_group->id, 'created_by' => $user->id,],
           
        // ];

        $metrics = Metric::insert($seeded_metrics);

        $all_metrics = Metric::get();

        foreach($all_metrics as $metric){

            if($metric->metric == 'Kilogram' || $metric->metric == 'Gram' ){

                $stock = DB::table('metric_group')->insert([

                    ['metric_id'=> $metric->id, 'group_id' => $sales_group->id, 'created_at' => now(),],
                    ['metric_id'=> $metric->id, 'group_id' => $production_group->id, 'created_at' => now(),],
                   
                ]);

            }
            else if($metric->metric == 'Ton' || $metric->metric == 'Sack' || $metric->metric == 'Box' || 
            $metric->metric == 'Jerican' || $metric->metric == 'Crate' || $metric->metric == 'Carton'){

                $stock = DB::table('metric_group')->insert([

                    ['metric_id'=> $metric->id, 'group_id' => $stock_group->id, 'created_at' => now(),],
                   
                ]);
            }
            else if($metric->metric == 'Round' || $metric->metric == 'Bottle' || $metric->metric == 'Piece' || 
            $metric->metric == 'Litre' || $metric->metric == 'Tin' || $metric->metric == 'Bar' || 
            $metric->metric == 'Packet'){

                $stock = DB::table('metric_group')->insert([

                    ['metric_id'=> $metric->id, 'group_id' => $production_group->id, 'created_at' => now(),],
                   
                ]);
            }
            else{

            }

        }

    }
}
