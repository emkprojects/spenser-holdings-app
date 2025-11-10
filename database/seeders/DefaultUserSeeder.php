<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Str;

use App\Models\User;
use App\Models\UserDetail;
use App\Models\UserStatus;
use App\Models\Settings\Position;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

       
        $user_status =  UserStatus::select('id', 'user_status')->where('user_status', 'Active')->first();

        $specialist_position =  Position::select('id', 'position')->where('slug', 'specialist')->first();
        $md_position =  Position::select('id', 'position')->where('slug', 'managing-director')->first();
        $coo_position =  Position::select('id', 'position')->where('slug', 'chief-operations-officer')->first();
        
        $super_admin =  User::create(

            [
            'user_reference' => Str::uuid(),
            'name' => 'superadmin',
            'email' => 'super@spenserholdings.org',
            'phone' => '256750075055',
            'password' =>  bcrypt('Admin@1234!'),
            'user_status_id' => $user_status->id,
            'position_id' => $specialist_position->id,
            ],

        );



        $director =  User::create(

            [
            'user_reference' => Str::uuid(),
            'name' => 'director',
            'email' => 'director@spenserholdings.org',
            'phone' => '256772123456',
            'password' =>  bcrypt('Admin@1234!'),
            'user_status_id' => $user_status->id,
            'position_id' => $md_position->id,
            ],

        );


        $admin =  User::create(

            [
            'user_reference' => Str::uuid(),
            'name' => 'administrator',
            'email' => 'admin@spenserholdings.org',
            'phone' => '256778802878',
            'password' =>  bcrypt('Admin@1234!'),
            'user_status_id' => $user_status->id,
            'position_id' => $coo_position->id,
            ],

        );



        $super_details =  UserDetail::create(
            [
                'user_id' => $super_admin->id,
                'first_name' => 'Super',
                'last_name' =>  'Admin',
                'other_name' =>  '',
                'gender' => 'Male',
                'date_of_birth' => '1992-10-09',                
                'physical_address' => 'Plot 69 Bukoto Street - Kololo',             
                
            ]
        );


        $director_details =  UserDetail::create(
            [
                'user_id' => $director->id,
                'first_name' => 'Spenser',
                'last_name' =>  'Precious',
                'other_name' =>  '',
                'gender' => 'Female',
                'date_of_birth' => '1999-12-31',
                'physical_address' => 'Plot 123 Spenser Close - Mutungo',             
                
            ]
        );


        $admin_details =  UserDetail::create(
            [
                'user_id' => $admin->id,
                'first_name' => 'Admin',
                'last_name' =>  'Edgar',
                'gender' => 'Male',
                'date_of_birth' => '1995-01-01',
                'physical_address' => 'Plot 123 Edgar Road - Mutungo',             
                
            ]
        );


        $super_admin->assignRole('super admin');
        $director->assignRole('director');
        $admin->assignRole('administrator');
        
    }
}
