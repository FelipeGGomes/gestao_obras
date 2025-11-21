<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('obras', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->string('nome_obra');
        $table->text('descricao')->nullable();
        $table->date('data_inicio')->nullable();
        $table->date('data_fim')->nullable();
        $table->dateTime('fim_real')->nullable();
        $table->enum('status', [
            'Em Planejamento',
            'Em Andamento',
            'Cancelada',
            'Concluída'
        ]);
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obras');
    }
};
