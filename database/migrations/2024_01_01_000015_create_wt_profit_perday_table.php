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
        Schema::create('wt_profit_perday', function (Blueprint $table) {
            $table->id('id_profit_day');
            $table->decimal('persen_day', 10, 4);
            $table->decimal('profit_day', 15, 2);
            $table->dateTime('tgl_profit_day');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wt_profit_perday');
    }
};
