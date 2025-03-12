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
        Schema::create('support_staff_roles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('support_staff_id')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();
            $table->smallInteger('mastery_level');
            $table->string('notes', 255)->nullable();
            $table->foreign('support_staff_id')->references('id')->on('support_staff');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_staff_roles');
    }
};
