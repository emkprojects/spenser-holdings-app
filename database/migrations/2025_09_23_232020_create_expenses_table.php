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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();            
            $table->string('expense_reference_no')->nullable();
            $table->string('expense')->nullable();
            $table->string('description')->nullable();
            $table->decimal('quantity', total: 10, places: 2)->nullable();
            $table->decimal('unit_cost', total: 10, places: 2)->nullable();
            $table->date('date_of_expense')->default(now());
            $table->foreignId('status_id')->nullable()->constrained();
            $table->boolean('is_active')->default(true);
            $table->foreignId('item_id')->constrained();
            $table->foreignId('production_id')->nullable()->constrained();            
            $table->foreignId('user_id')->nullable()->constrained();
            $table->unsignedBigInteger('approved_by');
            $table->foreign('approved_by')->references('id')->on('users');
            $table->uuid('expense_reference')->unique();                 
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
