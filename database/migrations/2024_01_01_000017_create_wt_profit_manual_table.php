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
        Schema::create('wt_profit_manual', function (Blueprint $table) {
            $table->id('id_manual');
            $table->unsignedBigInteger('id_user');
            $table->decimal('tambah_manual', 15, 2)->default(0);
            $table->decimal('kurang_manual', 15, 2)->default(0);
            $table->dateTime('tgl_manual');
            $table->text('keterangan')->nullable();

            $table->foreign('id_user')->references('id_user')->on('wt_user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wt_profit_manual');
    }
};
