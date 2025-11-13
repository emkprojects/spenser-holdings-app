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
        Schema::create('productions', function (Blueprint $table) {
            $table->id();             
            $table->string('production_reference_no')->nullable();
            $table->string('production');
            $table->text('description')->nullable();
            $table->foreignId('status_id')->nullable()->constrained();
            $table->boolean('is_active')->default(true);
            $table->date('date_of_production')->default(now()); 
            $table->foreignId('user_id')->nullable()->constrained(); 
            $table->unsignedBigInteger('supervisor')->nullable();
            $table->foreign('supervisor')->nullable()->references('id')->on('users'); 
            $table->uuid('production_reference')->unique(); 
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productions');
    }
};
