<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('servicio_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('numero'); // correlativo por servicio y día
            $table->boolean('prioritario')->default(false);
            $table->enum('estado', ['en_espera','llamado','atendiendo','atendido','ausente'])->default('en_espera');
            $table->timestamp('llamado_at')->nullable();
            $table->timestamp('atendido_at')->nullable();
            $table->unsignedTinyInteger('reintentos')->default(0);
            $table->timestamps();

            $table->index(['servicio_id','estado']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
