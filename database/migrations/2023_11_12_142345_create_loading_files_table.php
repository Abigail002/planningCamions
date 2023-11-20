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
            $table->dateTime('departCFS');
            $table->dateTime('entreeGate3');
            $table->dateTime('arriveeGate10');
            $table->dateTime('passageGate10');
            $table->dateTime('chargementTC');
            $table->dateTime('passageScanner');
            $table->dateTime('resultatScanner');
            $table->dateTime('sortieDouane');
            $table->dateTime('sortieGate3');
            $table->dateTime('arriveeClient');
            $table->dateTime('debutDehargement');
            $table->dateTime('finDechargement');
            $table->dateTime('departClient');
            $table->dateTime('arriveeGate3');
            $table->dateTime('arriveeCFS');
            $table->timestamps();
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
