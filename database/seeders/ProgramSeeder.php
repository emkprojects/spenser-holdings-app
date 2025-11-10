<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use DB;
use Str;

use App\Models\User;
use App\Models\Web\LearningMaterials\Program;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = User::first();

        $mental_health =  Program::create(

            [
            'program_reference' => Str::uuid(),
            'program' => 'MENTAL HEALTH',
            'description' => 'Mental Health',
            'created_by' => $user->id,
            ],

        );
    }
}
