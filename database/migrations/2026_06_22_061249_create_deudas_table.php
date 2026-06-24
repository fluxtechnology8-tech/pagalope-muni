<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('deudas', function (Blueprint $table) {
            $table->id();
            $table->foreignId("contribuyente_id")->constrained("contribuyentes")->cascadeOnDelete();
            $table->integer("anio_deuda");
            $table->integer("tributo");
            $table->integer("desc_tributo");
            $table->integer("cargo");
            $table->integer("abono");
            $table->integer("debe");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deudas');
    }
};
