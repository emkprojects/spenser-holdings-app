<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Settings\Currency;
use App\Models\User;
use Str;
use DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        
        $currencies = [

            ['currency_reference'=> Str::uuid(), 'currency' => 'Uganda Shillings', 'currency_code' => 'UGX', 'created_by' => $user->id, 'created_at' => now()],
            ['currency_reference'=> Str::uuid(), 'currency' => 'US Dollars', 'currency_code' => 'USD', 'created_by' => $user->id, 'created_at' => now()],
        ];

        $currency = Currency::insert($currencies);

    }
}
