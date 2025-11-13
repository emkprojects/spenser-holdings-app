<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sub_counties', function (Blueprint $table) {
            $table->id();
            $table->string('sub_county');
            $table->string('slug'); 
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true); 
            $table->foreignId('district_id')->nullable()->constrained('districts');  
            $table->uuid('sub_county_reference')->unique();                
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_counties');
    }
};
