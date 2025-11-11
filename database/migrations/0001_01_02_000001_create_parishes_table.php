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
        Schema::create('parishes', function (Blueprint $table) {
            $table->id();
            $table->uuid('parish_reference'); 
            $table->string('parish');
            $table->string('slug'); 
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);  
            $table->foreignId('sub_county_id')->nullable()->constrained('sub_counties');   
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parishes');
    }
};
