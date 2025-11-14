<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('puestos', function (Blueprint $table) {
            // La hacemos nullable para que SQLite nos deje agregarla
            $table->string('codigo')->nullable()->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('puestos', function (Blueprint $table) {
            $table->dropColumn('codigo');
        });
    }
};
