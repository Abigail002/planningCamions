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
        Schema::create('forecasts', function (Blueprint $table) {
            $table->id();
            $table->string('operation');
            $table->string('BL');
            $table->string('vessel');
            $table->string('voyage');
            $table->date('ETA');
            $table->integer('idTrakit');
            $table->date('forecastDate');
            $table->integer('numbTruck');
            $table->date('loadDate');
            $table->string('loadPlace');
            $table->string('deliveryPlace');
            $table->string('status')->default('Pending');

            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forecasts');
    }
};
