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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->unsignedBigInteger('play_id')->nullable();
            $table->dateTime('date');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('description', 100)->nullable();
            $table->string('url_info', 255)->nullable();
            $table->string('url_tickets', 255)->nullable();
            $table->unsignedBigInteger('location_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('play_id')->references('id')->on('plays');
            $table->foreign('location_id')->references('id')->on('locations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
