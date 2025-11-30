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
        Schema::create('wt_profit_setting', function (Blueprint $table) {
            $table->id('id_profit_setting');
            $table->integer('level_profit_setting');
            $table->decimal('persen_profit_setting', 10, 4);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wt_profit_setting');
    }
};
