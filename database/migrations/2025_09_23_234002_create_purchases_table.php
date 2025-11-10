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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('item_id')->nullable()->constrained();         
            $table->foreignId('supplier_id')->nullable()->constrained(); 
            $table->Uuid('purchase_reference'); 
            $table->string('purchase_reference_no')->nullable(); 
            $table->string('purchase')->nullable();
            $table->string('description')->nullable();          
            $table->decimal('quantity', total: 10, places: 2)->nullable();
            $table->decimal('unit_cost', total: 10, places: 2)->nullable();   
            // $table->integer('quantity')->default(0);
            // $table->integer('unit_cost')->default(0);  
            $table->date('manufacture_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->date('date_of_purchase');
            $table->string('invoice_id')->nullable();
            $table->string('invoice')->nullable();
            //$table->string('status')->default('paid');
            $table->foreignId('status_id')->nullable()->constrained();
            $table->boolean('is_active')->default(true);
            $table->foreignId('user_id')->nullable()->constrained();            
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
