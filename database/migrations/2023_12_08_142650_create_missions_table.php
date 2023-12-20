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
        Schema::create('missions', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->string('truck');
            $table->string('trailer');

            $table->foreignId('forecast_id')->constrained()->onDelete('cascade');

            //first container
            $table->unsignedBigInteger('first_container_id');
            $table->foreign('first_container_id')->references('id')->on('containers');
            //second container
            $table->unsignedBigInteger('second_container_id')->nullable();
            $table->foreign('second_container_id')->references('id')->on('containers');
            //driver
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->foreign('driver_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('missions');
    }
};
