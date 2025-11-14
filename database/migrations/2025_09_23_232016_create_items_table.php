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
        Schema::create('items', function (Blueprint $table) {
            $table->id();            
            $table->string('item_reference_no')->nullable();
            $table->string('item_code')->nullable();
            $table->string('item');
            $table->string('description')->nullable();
            $table->decimal('physical_stock', total: 10, places: 2)->nullable();
            $table->decimal('current_stock', total: 10, places: 2)->nullable();
            $table->decimal('minimum_stock', total: 10, places: 2)->nullable();
            $table->decimal('amount', total: 10, places: 2)->nullable();
            $table->foreignId('status_id')->nullable()->constrained();
            $table->boolean('is_active')->default(true);
            $table->foreignId('item_category_id')->constrained();
            $table->foreignId('supplier_id')->constrained(); 
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');            
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users'); 
            $table->uuid('item_reference')->unique();              
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
