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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();            
            $table->string('inventory_reference_no')->nullable();
            $table->string('inventory')->nullable();
            $table->string('description')->nullable();
            $table->decimal('physical_stock', total: 10, places: 2)->nullable();
            $table->decimal('current_stock', total: 10, places: 2)->nullable();
            $table->date('date_of_inventory');
            $table->foreignId('status_id')->nullable()->constrained();
            $table->boolean('is_active')->default(true);
            $table->foreignId('raw_material_id')->nullable()->constrained();
            $table->foreignId('purchase_id')->nullable()->constrained();  
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');          
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users'); 
            $table->uuid('inventory_reference')->unique();              
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
