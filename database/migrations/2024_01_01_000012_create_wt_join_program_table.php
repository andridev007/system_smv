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
        Schema::create('wt_join_program', function (Blueprint $table) {
            $table->id('id_join_prog');
            $table->unsignedBigInteger('id_prog');
            $table->unsignedBigInteger('id_join');
            $table->string('nama_prog');
            $table->decimal('hrg_prog', 15, 2);
            $table->decimal('min_depo', 15, 2);

            $table->foreign('id_prog')->references('id_prog')->on('wt_program')->onDelete('cascade');
            $table->foreign('id_join')->references('id_join')->on('wt_join')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wt_join_program');
    }
};
