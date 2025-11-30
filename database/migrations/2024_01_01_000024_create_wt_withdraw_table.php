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
        Schema::create('wt_withdraw', function (Blueprint $table) {
            $table->id('id_wd');
            $table->unsignedBigInteger('id_user');
            $table->decimal('nominal_wd', 15, 2);
            $table->decimal('wd_diterima', 15, 2);
            $table->decimal('fee_wd', 15, 2)->default(0);
            $table->dateTime('tgl_wd');
            $table->string('status_wd')->default('pending');
            $table->string('method')->nullable();
            $table->string('payment')->nullable();

            $table->foreign('id_user')->references('id_user')->on('wt_user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wt_withdraw');
    }
};
