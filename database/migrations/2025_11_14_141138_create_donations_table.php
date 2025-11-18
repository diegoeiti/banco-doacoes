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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Ex: "Arroz 5kg", "Feijão 1kg"
            $table->text('description')->nullable(); // Descrição detalhada
            $table->string('category'); // Ex: "Alimento", "Roupa", "Higiene"
            $table->integer('quantity'); // Quantidade disponível: 10, 5, 20
            $table->enum('status', ['disponivel', 'entregue'])->default('disponivel');

            // CHAVE ESTRANGEIRA - liga com a tabela users
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->timestamps(); // created_at e updated_at automáticos
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
