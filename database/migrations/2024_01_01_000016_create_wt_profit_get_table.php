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
        Schema::create('wt_profit_get', function (Blueprint $table) {
            $table->id('id_profit_get');
            $table->unsignedBigInteger('id_profit_day');
            $table->unsignedBigInteger('id_join');
            $table->decimal('persen_profit_get', 10, 4);
            $table->decimal('nominal_profit_get', 15, 2);
            $table->dateTime('tgl_profit_get');

            $table->foreign('id_profit_day')->references('id_profit_day')->on('wt_profit_perday')->onDelete('cascade');
            $table->foreign('id_join')->references('id_join')->on('wt_join')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wt_profit_get');
    }
};
