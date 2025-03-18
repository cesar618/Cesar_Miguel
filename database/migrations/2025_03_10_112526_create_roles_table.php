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
        Schema::create('characters', function (Blueprint $table) {  // Assuming table name is 'characters'
            $table->id();
            $table->string('name', 40);
            $table->string('work', 100)->nullable();  // Added work column
            $table->string('notes', 255)->nullable();
            $table->string('image')->nullable();      // Assuming this exists for the photo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};