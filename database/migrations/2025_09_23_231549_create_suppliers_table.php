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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();            
            $table->string('supplier');
            $table->string('national_identification_number')->nullable();
            $table->string('tax_identification_number')->nullable();
            $table->string('phone_number');
            $table->string('alternative_phone')->nullable();
            $table->string('email_address')->nullable();
            $table->string('alternative_email')->nullable();
            $table->string('physical_address')->nullable();
            $table->string('contact_first_name')->nullable();
            $table->string('contact_last_name')->nullable();
            $table->string('contact_other_name')->nullable();             
            $table->string('contact_phone_number')->nullable();
            $table->string('contact_alternative_phone')->nullable();
            $table->string('contact_email_address')->nullable();
            $table->string('contact_alternative_email')->nullable();
            $table->string('contact_physical_address')->nullable();
            $table->string('contact_gender')->nullable();
            $table->date('contact_date_of_birth')->nullable();
            $table->foreignId('position_id')->nullable()->constrained(); 
            $table->boolean('is_active')->default(true);
            $table->foreignId('supplier_type_id')->constrained();            
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users'); 
            $table->uuid('supplier_reference')->unique();                
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
