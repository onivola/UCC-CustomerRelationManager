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
        Schema::create('prospect_models', function (Blueprint $table) {
            $table->id();
            $table->string('id_lead');
            $table->string('Numero_SIRET');
            $table->string('etat_signature')->nullable();
            $table->string('maybe')->nullable();
            $table->timestamp('date_signature')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prospect_models');
    }
};
