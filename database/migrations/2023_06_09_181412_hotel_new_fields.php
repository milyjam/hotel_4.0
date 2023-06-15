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
        Schema::table('hotel', function (Blueprint $table) {
            $table->enum('status', ['ativo', 'inativo'])->after('estado')->default('ativo');
            $table->text('imagem')->after('status')->nullAble();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotel', function (Blueprint $table) {
        $table->dropColumn('status');
        $table->dropColumn('imagem');
    });
    }
};
