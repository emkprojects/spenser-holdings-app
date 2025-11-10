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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('customer_id')->nullable()->constrained();  
            $table->Uuid('sale_reference');           
            $table->string('sale_reference_no')->nullable();
            $table->datetime('date_of_sale');            
            $table->string('status')->default('pending approval');  
            // $table->integer('amount')->default(0);
            // $table->integer('balance')->default(0); 
            $table->decimal('amount', total: 10, places: 2)->nullable();
            $table->decimal('balance', total: 10, places: 2)->nullable();
            
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->foreign('approved_by')->nullable()->references('id')->on('users');
            $table->datetime('approval_date')->nullable();
            $table->unsignedBigInteger('confirmed_by')->nullable();
            $table->foreign('confirmed_by')->nullable()->references('id')->on('users');
            $table->datetime('confirm_date')->nullable();
            $table->unsignedBigInteger('declined_by')->nullable();
            $table->foreign('declined_by')->nullable()->references('id')->on('users');
            $table->datetime('decline_date')->nullable();
            $table->text('decline_remarks')->nullable();  
            $table->boolean('vat_inclusive')->default(true);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
