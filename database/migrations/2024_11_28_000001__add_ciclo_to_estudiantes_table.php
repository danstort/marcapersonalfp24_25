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
        Schema::table('estudiantes', function (Blueprint $table) {
            $table->string('ciclo', 100)->nullable();
            $table->string('apellidos', 100)->nullable()->after('nombre');
            $table->string('direccion', 100)->nullable()->after('apellidos');
            $table->integer('votos')->nullable()->after('direccion');
            $table->boolean('confirmado');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('estudiantes', function (Blueprint $table) {
            $table->dropColumn('ciclo');
            $table->dropColumn('apellidos');
            $table->dropColumn('direccion');
            $table->dropColumn('votos');
            $table->dropColumn('confirmado');

        });
    }
};

