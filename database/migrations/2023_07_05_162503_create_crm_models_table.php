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
        Schema::create('crm_models', function (Blueprint $table) {
            $table->id();
            $table->string('Noms_commerciaux');
            $table->string('Adresse_postale');
            $table->string('code_postale');
            $table->string('Numero_SIRET');
            $table->string('ville');
            $table->string('name');
            $table->string('first_name');
            $table->string('function');
            $table->string('phone');
            $table->string('fixe')->nullable();
            $table->string('email');
            $table->string('exterieur');
            $table->string('type');
            $table->string('Agent');
            $table->string('PR30WMCEE');
            $table->string('PR50WMCEE');
            $table->string('PR100WMCEE');
            $table->string('HUB1600RWBCEE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_models');
    }
};
