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
        Schema::create('contribuyentes', function (Blueprint $table) {
            $table->id();
            $table->string("nombres_razon_social");
            $table->string("dni_ruc");
            $table->string("direccion_fiscal");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contribuyentes');
    }
};
