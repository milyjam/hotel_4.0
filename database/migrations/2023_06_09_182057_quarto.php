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
        Schema::create('quarto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fk_hotel')->constrained('hotel');
            $table->string('nome');
            $table->text('descricao');
            $table->float('valor_diaria');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quarto');
    }
};
