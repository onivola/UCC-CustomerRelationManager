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
        Schema::create('devis_models', function (Blueprint $table) {
            $table->id();
            $table->string('agent');
            $table->string('id_lead');
            $table->string('email');
            $table->string('raison_social');
            $table->string('numero_siret');
            $table->string('Id_signature');
            $table->integer('total_led');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devis_models');
    }
};
