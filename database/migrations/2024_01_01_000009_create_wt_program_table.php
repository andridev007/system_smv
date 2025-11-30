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
        Schema::create('wt_program', function (Blueprint $table) {
            $table->id('id_prog');
            $table->unsignedBigInteger('id_group');
            $table->string('nama_prog');
            $table->decimal('hrg_prog', 15, 2);
            $table->decimal('min_depo', 15, 2);
            $table->decimal('est_balik', 15, 2)->nullable();
            $table->decimal('est_terima', 15, 2)->nullable();

            $table->foreign('id_group')->references('id_group')->on('wt_join_group')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wt_program');
    }
};
