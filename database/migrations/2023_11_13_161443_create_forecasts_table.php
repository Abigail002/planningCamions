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
            $table->string('consignee');
            $table->string('vessel');
            $table->string('voyage');
            $table->date('ETA');
            $table->integer('idTrakit');
            $table->date('forecastDate');
            $table->integer('numbTruck');
            $table->date('loadDate');
            $table->date('loadPlace');
            $table->date('deliveryPlace');

            $table->foreignId('customers_id')->constrained()->onDelete('cascade');
            $table->foreignId('users_id')->constrained()->onDelete('cascade');
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
