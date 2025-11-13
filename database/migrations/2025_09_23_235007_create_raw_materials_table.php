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
        Schema::create('raw_materials', function (Blueprint $table) {
            $table->id();            
             $table->string('raw_material_reference_no')->nullable();
            $table->string('raw_material')->nullable();
            $table->string('description')->nullable();
            $table->decimal('physical_stock', total: 10, places: 2)->nullable();
            $table->decimal('current_stock', total: 10, places: 2)->nullable();
            $table->decimal('minimum_stock', total: 10, places: 2)->nullable();
            $table->foreignId('status_id')->nullable()->constrained();
            $table->boolean('is_active')->default(true);
            $table->foreignId('inventory_category_id')->constrained();          
            $table->foreignId('user_id')->nullable()->constrained(); 
            $table->uuid('raw_material_reference')->unique();             
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raw_materials');
    }
};
