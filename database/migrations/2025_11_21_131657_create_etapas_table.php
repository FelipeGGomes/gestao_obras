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
        Schema::create('etapas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('obra_id')->constrained()->onDelete('cascade');
            $table->string('nome_etapa');
            $table->date('data_inicio')->nullable();
            $table->date('data_fim')->nullable();
            $table->date('fim_real')->nullable();
            $table->enum('status', [
                'Nao Iniciada',
                'Em progresso',
                'Bloqueada',
                'Concluída',
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etapas');
    }
};
