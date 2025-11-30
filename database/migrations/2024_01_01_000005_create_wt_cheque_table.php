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
        Schema::create('wt_cheque', function (Blueprint $table) {
            $table->id('id_cheque');
            $table->unsignedBigInteger('id_user');
            $table->decimal('jumlah_cheque', 15, 2);
            $table->dateTime('tgl_cheque');
            $table->text('keterangan')->nullable();

            $table->foreign('id_user')->references('id_user')->on('wt_user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wt_cheque');
    }
};
