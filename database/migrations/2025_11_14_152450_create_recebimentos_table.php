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
        Schema::create('recebimentos', function (Blueprint $table) {
            $table->id();

            // CHAVE ESTRANGEIRA - qual doação foi recebida
            $table->foreignId('donation_id')->constrained()->onDelete('cascade');

            // CHAVE ESTRANGEIRA - quem recebeu
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Quantidade que foi recebida
            $table->integer('quantidade_recebida');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recebimentos');
    }
};
