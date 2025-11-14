<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\ProductionManagement\Production;
use App\Models\Settings\CategoryType;
use App\Models\Settings\Category;

use Str;
use DB;

class productionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $user = User::first();

        $seeded_productions = [

            [
                
             'created_by' => $user->id,
             'production_reference' => Str::uuid(), 
             'production_reference_no' => date("Y/m/d/his/0001"), 
             'production' => 'PRODUCTION #1000001', 
             'date_of_production' => now(),  
             'created_at' => now(),         

            ],

             [
                
             'created_by' => $user->id,
             'production_reference' => Str::uuid(), 
             'production_reference_no' => date("Y/m/d/his/0002"), 
             'production' => 'PRODUCTION #1000002', 
             'date_of_production' => now(),  
             'created_at' => now(),         

            ],

        ];


        $productions =  Production::insert($seeded_productions);
    }
}
