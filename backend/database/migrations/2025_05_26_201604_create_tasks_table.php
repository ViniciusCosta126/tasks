<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 255);
            $table->foreignId('responsavel_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('criador_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('coluna_id')->constrained()->onDelete('cascade');
            $table->text('descricao');
            $table->boolean('ativa')->default(true);
            $table->dateTime('data_vencimento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
