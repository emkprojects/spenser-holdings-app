<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Settings\PaymentMethod;
use App\Models\User;

use Str;
use DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $user = User::first();
        
        $seeded_payment_methods = [

            ['payment_method_reference'=> Str::uuid(), 'payment_method' => 'Cash', 'payment_method_code' => 'CSH', 'created_by' => $user->id, 'created_at' => now()],
            ['payment_method_reference'=> Str::uuid(), 'payment_method' => 'Bank', 'payment_method_code' => 'BNK', 'created_by' => $user->id, 'created_at' => now()],
            ['payment_method_reference'=> Str::uuid(), 'payment_method' => 'Cheque', 'payment_method_code' => 'CHQ', 'created_by' => $user->id, 'created_at' => now()],
            ['payment_method_reference'=> Str::uuid(), 'payment_method' => 'Mobile Money', 'payment_method_code' => 'MM', 'created_by' => $user->id, 'created_at' => now()],
            ['payment_method_reference'=> Str::uuid(), 'payment_method' => 'Credit Card', 'payment_method_code' => 'CC', 'created_by' => $user->id, 'created_at' => now()],
            ['payment_method_reference'=> Str::uuid(), 'payment_method' => 'Crypto', 'payment_method_code' => 'CPT', 'created_by' => $user->id, 'created_at' => now()],
        ];

        $payment_methods = PaymentMethod::insert($seeded_payment_methods);

    }
}
