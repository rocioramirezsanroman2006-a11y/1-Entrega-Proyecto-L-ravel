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
        Schema::table('clientes', function (Blueprint $table) {
            $table->string('foto')->nullable()->after('empresa');
        });

        Schema::table('productos', function (Blueprint $table) {
            $table->string('imagen')->nullable()->after('stock');
            $table->string('archivo_pdf')->nullable()->after('imagen');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropColumn('foto');
        });

        Schema::table('productos', function (Blueprint $table) {
            $table->dropColumn('imagen');
            $table->dropColumn('archivo_pdf');
        });
    }
};
