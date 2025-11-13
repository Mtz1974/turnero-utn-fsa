<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('llamados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained()->cascadeOnDelete();
            $table->foreignId('puesto_id')->constrained()->cascadeOnDelete();
            $table->enum('tipo', ['llamar','rellamar','cerrar_atendido','cerrar_ausente','saltar']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('llamados');
    }
};
