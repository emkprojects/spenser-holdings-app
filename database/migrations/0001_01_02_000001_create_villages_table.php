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
        Schema::create('villages', function (Blueprint $table) {
            $table->id();
            $table->string('village');
            $table->string('slug'); 
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true); 
            $table->foreignId('parish_id')->nullable()->constrained('parishes'); 
            $table->uuid('village_reference')->unique();               
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('villages');
    }
};
