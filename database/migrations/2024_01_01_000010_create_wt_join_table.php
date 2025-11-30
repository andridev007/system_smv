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
        Schema::create('wt_join', function (Blueprint $table) {
            $table->id('id_join');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_prog');
            $table->decimal('nominal_join', 15, 2);
            $table->decimal('insurance', 15, 2)->nullable();
            $table->string('kode_unik')->nullable();
            $table->decimal('total_bayar', 15, 2);
            $table->dateTime('tgl_join');
            $table->string('status_join')->default('pending');
            $table->string('method')->nullable();
            $table->text('note')->nullable();
            $table->string('wd_status')->default('enabled');

            $table->foreign('id_user')->references('id_user')->on('wt_user')->onDelete('cascade');
            $table->foreign('id_prog')->references('id_prog')->on('wt_program')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wt_join');
    }
};
