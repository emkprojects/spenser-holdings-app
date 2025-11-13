<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Administration\Referrer;
use App\Models\Administration\ReferrerType;
use App\Models\Settings\Group;
use App\Models\Settings\Category;
use App\Models\User;

use Str;
use DB;

class ReferrerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        $referrer_type   = ReferrerType::where('referrer_type', 'Others')->first();
        
        $seeded_referrers = [

            [
             'created_by' => $user->id,
             'referrer_reference' => Str::uuid(), 
             'first_name' => 'John',
             'last_name' => 'Doe',
             'phone_number' => '256703003647',
             'email_address' => 'referrer@spenserholdings.org',
             'physical_address' => 'Plot 123 Mutungo Avenue - Mutungo',
             'referrer_type_id' => $referrer_type->id,
             'gender' => 'Male',    
             'created_at' => now(),         

            ],

            [
             'created_by' => $user->id,
             'referrer_reference' => Str::uuid(),
             'first_name' => 'Jane',
             'last_name' => 'Doe',
             'phone_number' => '256703003647',
             'email_address' => 'referrer@spenserholdings.org',
             'physical_address' => 'Plot 123 Hotel Street - Nakasero',             
             'referrer_type_id' => $referrer_type->id,
             'gender' => 'Female',     
             'created_at' => now(),         

            ],
        ];


        $referrers =  Referrer::insert($seeded_referrers);
    }
}
