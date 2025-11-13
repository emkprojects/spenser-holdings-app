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
        Schema::create('referrers', function (Blueprint $table) {
            $table->id();
            $table->string('national_identification_number')->nullable();
            $table->string('tax_identification_number')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('other_name')->nullable();
            $table->string('phone_number');
            $table->string('alternative_phone')->nullable();
            $table->string('email_address')->nullable();
            $table->string('alternative_email')->nullable();
            $table->string('physical_address')->nullable();            
            $table->boolean('is_active')->default(true);
            $table->foreignId('referrer_type_id')->constrained();   
            $table->string('gender')->nullable();         
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->uuid('referrer_reference')->unique();               
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referrers');
    }
};
