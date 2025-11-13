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
        Schema::create('multimedia_types', function (Blueprint $table) {
            $table->id();
            $table->string('multimedia_type');
            $table->string('slug'); 
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);  
            $table->uuid('multimedia_type_reference')->unique();              
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('multimedia_types');
    }
};
