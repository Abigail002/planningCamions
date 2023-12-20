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
        Schema::create('loading_files', function (Blueprint $table) {
            $table->id();
            $table->dateTime('departCFS')->nullable();
            $table->dateTime('entreeGate3')->nullable();
            $table->dateTime('arriveeGate10')->nullable();
            $table->dateTime('passageGate10')->nullable();
            $table->dateTime('chargementTC1')->nullable();
            $table->dateTime('chargementTC2')->nullable();
            $table->dateTime('passageScanner')->nullable();
            $table->dateTime('resultatScanner')->nullable();
            $table->dateTime('sortieDouane')->nullable();
            $table->dateTime('sortieGate3')->nullable();
            $table->dateTime('arriveeClient')->nullable();
            $table->dateTime('debutDehargement')->nullable();
            $table->dateTime('finDechargement')->nullable();
            $table->dateTime('departClient')->nullable();
            $table->dateTime('arriveeGate3')->nullable();
            $table->dateTime('arriveeCFS')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loading_files');
    }
};
