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
            if (!Schema::hasColumn('clientes', 'apellido')) {
                $table->string('apellido')->nullable()->after('nombre');
            }
        });

        Schema::table('empleados', function (Blueprint $table) {
            if (!Schema::hasColumn('empleados', 'apellido')) {
                $table->string('apellido')->nullable()->after('nombre');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropColumn('apellido');
        });

        Schema::table('empleados', function (Blueprint $table) {
            $table->dropColumn('apellido');
        });
    }
};
