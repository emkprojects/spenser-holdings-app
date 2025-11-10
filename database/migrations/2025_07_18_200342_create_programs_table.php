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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();             
            $table->Uuid('program_reference'); 
            $table->text('program');
            $table->text('description')->nullable();
            #$table->foreignId('created_by')->constrained('users')->index();  
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');    
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
