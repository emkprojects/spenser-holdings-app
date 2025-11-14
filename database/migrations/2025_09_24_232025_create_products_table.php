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
        Schema::create('products', function (Blueprint $table) {
            $table->id();            
            $table->string('product_reference_no')->nullable();
            $table->string('product_code')->nullable();
            $table->string('product');
            $table->string('description')->nullable();
            $table->decimal('physical_stock', total: 10, places: 2)->nullable();
            $table->decimal('current_stock', total: 10, places: 2)->nullable();
            $table->decimal('minimum_stock', total: 10, places: 2)->nullable();
            $table->decimal('amount', total: 10, places: 2)->nullable();
            $table->datetime('last_updated')->nullable();
            $table->foreignId('status_id')->nullable()->constrained();
            $table->boolean('is_active')->default(true);
            $table->foreignId('product_category_id')->constrained();  
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');           
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users'); 
            $table->uuid('product_reference')->unique();              
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
