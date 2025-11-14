<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('puestos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');   // Ej: "Módulo 1"
            $table->string('codigo');   // Ej: "1" (para mostrar en pantalla)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('puestos');
    }
};
